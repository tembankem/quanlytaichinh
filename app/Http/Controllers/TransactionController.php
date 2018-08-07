<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Wallet;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Transaction;
use App\WalletTransaction;

class TransactionController extends Controller
{
	private $spend = 1;
	private $receive = 2;
    public function __construct(){
    	return $this->middleware('auth');
    }

    public function index(){
    	$now = Carbon::now();
    	$walletTransactions = Auth::user()->walletTransaction()->whereMonth('date',$now->month)->get();
    	$transactions = Auth::user()->transaction()->whereMonth('date',$now->month)->get();
    	return view('transaction.index')->with([
    		'walletTransactions' => $walletTransactions,
    		'transactions' => $transactions,
    	]);
    }

    public function showAddSpendForm(){
    	$categories = Auth::user()->category()->where('type',$this->spend)->get();
    	$wallets = Auth::user()->wallet;
    	return view('transaction.add_spend')->with([
    		'categories' => $categories,
    		'wallets' => $wallets
    	]);
    }

    public function addSpend(Request $request){
    	$validatedData = $request->validate([
            'category' => 'required',
            'wallet' => 'required',
            'amount' => 'required|numeric|min:1',
            'date' => 'required'
        ]);
        $wallet = Wallet::find($request->get('wallet'));

        $transaction = new Transaction;
        $transaction->amount = $request->get('amount');
        $transaction->note = $request->get('note');
        $transaction->category_id = $request->get('category');
        $transaction->wallet_id = $wallet->id;
        $transaction->user_id = Auth::id();
        $transaction->date = $request->get('date');
        $transaction->save();

        $wallet->balance -= $request->get('amount');
        $wallet->save();

        return redirect()->route('transaction.index')->with('success','Create New Transaction Successfully!');
    }

    public function showAddReceiveForm(){
    	$categories = Auth::user()->category()->where('type',$this->receive)->get();
    	$wallets = Auth::user()->wallet;
    	return view('transaction.add_receive')->with([
    		'categories' => $categories,
    		'wallets' => $wallets
    	]);
    }

    public function addReceive(Request $request){
    	$validatedData = $request->validate([
            'category' => 'required',
            'wallet' => 'required',
            'amount' => 'required|numeric|min:1',
            'date' => 'required'
        ]);
        $wallet = Wallet::find($request->get('wallet'));

        $transaction = new Transaction;
        $transaction->amount = $request->get('amount');
        $transaction->note = $request->get('note');
        $transaction->category_id = $request->get('category');
        $transaction->wallet_id = $wallet->id;
        $transaction->user_id = Auth::id();
        $transaction->date = $request->get('date');
        $transaction->save();

        $wallet->balance += $request->get('amount');
        $wallet->save();

        return redirect()->route('transaction.index')->with('success','Create New Transaction Successfully!');
    }

    public function showEditSpendForm($id){
    	$categories = Auth::user()->category()->where('type',$this->spend)->get();
    	$transaction = Transaction::find($id);
    	return view('transaction.edit_spend')->with([
    		'categories' => $categories,
    		'transaction' => $transaction
    	]);
    }

    public function showEditReceiveForm($id){
    	$categories = Auth::user()->category()->where('type',$this->receive)->get();
    	$transaction = Transaction::find($id);
    	return view('transaction.edit_receive')->with([
    		'categories' => $categories,
    		'transaction' => $transaction
    	]);
    }

    public function editSpend(Request $request, Transaction $transaction){
    	$validatedData = $request->validate([
            'category' => 'required',
            'amount' => 'required|numeric|min:1',
            'date' => 'required'
        ]);

        if ($request->get('category') == $transaction->category_id && $request->get('amount') == $transaction->amount && $request->get('date') == $transaction->date && $request->get('note') == $transaction->note) {
        	return redirect()->back()->with('success','Nothing To Update!');
        }

        if($request->get('amount') != $transaction->amount){
        	$wallet = $transaction->wallet;
        	$wallet->balance = $wallet->balance + $transaction->amount - $request->get('amount');
        	$wallet->save();
        	$transaction->amount = $request->get('amount');
        }
        $transaction->category_id = $request->get('category');
        $transaction->date = $request->get('date');
        $transaction->note = $request->get('note');
        $transaction->save();
        return redirect()->back()->with('success','Transaction Updated Successfully');
    }

    public function editReceive(Request $request, Transaction $transaction){
    	$validatedData = $request->validate([
            'category' => 'required',
            'amount' => 'required|numeric|min:1',
            'date' => 'required'
        ]);

        if ($request->get('category') == $transaction->category_id && $request->get('amount') == $transaction->amount && $request->get('date') == $transaction->date && $request->get('note') == $transaction->note) {
        	return redirect()->back()->with('success','Nothing To Update!');
        }

        if($request->get('amount') != $transaction->amount){
        	$wallet = $transaction->wallet;
        	$wallet->balance = $wallet->balance - $transaction->amount + $request->get('amount');
        	$wallet->save();
        	$transaction->amount = $request->get('amount');
        }
        $transaction->category_id = $request->get('category');
        $transaction->date = $request->get('date');
        $transaction->note = $request->get('note');
        $transaction->save();
        return redirect()->back()->with('success','Transaction Updated Successfully');
    }

    public function deleteSpend($id){
    	$transaction = Transaction::find($id);
    	$wallet = $transaction->wallet;
    	$wallet->balance += $transaction->amount;
    	$wallet->save();
    	$transaction->delete();
    	return redirect()->back()->with('success','Delete Transaction Successfully');
    }

    public function deleteReceive($id){
    	$transaction = Transaction::find($id);
    	$wallet = $transaction->wallet;
    	$wallet->balance -= $transaction->amount;
    	$wallet->save();
    	$transaction->delete();
    	return redirect()->back()->with('success','Delete Transaction Successfully');
    }
}
