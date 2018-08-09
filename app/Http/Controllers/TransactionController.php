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
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
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

    public function showIndexByMonth(Request $request){
        $validatedData = $request->validate([
            'month' => 'required'
        ]);
        $month = Carbon::parse($request->get('month'));
        $walletTransactions = Auth::user()->walletTransaction()->whereMonth('date',$month->month)->get();
        $transactions = Auth::user()->transaction()->whereMonth('date',$month->month)->get();
        return view('transaction.index_by_month')->with([
            'walletTransactions' => $walletTransactions,
            'transactions' => $transactions,
            'month' => $month,
        ]);
    }

    public function showCategories(){
        $spendCategories = Auth::user()->category()->where('type',config('const.spendType'))->get();
        $receiveCategories = Auth::user()->category()->where('type',config('const.receiveType'))->get();
        return view('transaction.show_categories')->with([
            'spendCategories' => $spendCategories,
            'receiveCategories' => $receiveCategories,
        ]);
    }

    public function showTransactionsByCategory($id){
        $category = Category::find($id);
        $catName = $category->name;
        $catType = $category->type;
        $transactions = $category->transaction;
        return view('transaction.show_transactions_by_category')->with([
            'catName' => $catName,
            'transactions' => $transactions,
            'catType' => $catType,
        ]);
    }

    public function showAddSpendForm(){
    	$categories = Auth::user()->category()->where('type',config('const.spendType'))->get();
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
    	$categories = Auth::user()->category()->where('type',config('const.receiveType'))->get();
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
    	$categories = Auth::user()->category()->where('type',config('const.spendType'))->get();
    	$transaction = Transaction::find($id);
    	return view('transaction.edit_spend')->with([
    		'categories' => $categories,
    		'transaction' => $transaction
    	]);
    }

    public function showEditReceiveForm($id){
    	$categories = Auth::user()->category()->where('type',config('const.receiveType'))->get();
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

    public function showReport(){
        $now = Carbon::now();
        $categories = DB::table('users')->join('categories','users.id','=','categories.user_id')
                                        ->join('transactions','categories.id','=','transactions.category_id')
                                        ->selectRaw('categories.*, sum(transactions.amount) as sum')
                                        ->where('users.id',Auth::id())
                                        ->whereMonth('transactions.date',$now->month)
                                        ->groupBy('categories.name')
                                        ->get();

        return view('transaction.report')->with('categories',$categories);
    }

    public function showReportByMonth(Request $request){
        $validatedData = $request->validate([
            'month' => 'required'
        ]);
        $month = Carbon::parse($request->get('month'));
        $categories = DB::table('users')->join('categories','users.id','=','categories.user_id')
                                        ->join('transactions','categories.id','=','transactions.category_id')
                                        ->selectRaw('categories.*, sum(transactions.amount) as sum')
                                        ->where('users.id',Auth::id())
                                        ->whereMonth('transactions.date',$month->month)
                                        ->groupBy('categories.name')
                                        ->get();

        return view('transaction.report_by_month')->with([
            'categories' => $categories,
            'month' => $month
        ]);
    }
}
