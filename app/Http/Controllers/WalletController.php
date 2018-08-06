<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\WalletTransaction;

class WalletController extends Controller
{
    public function __construct(){
    	return $this->middleware('auth');
    }

    public function index(){
    	$data = [];
    	$data = Wallet::where('user_id',Auth::id())->get();
    	return view('wallet.wallet_index')->with('data',$data);
    }

    public function showFormAdd(){
    	return view('wallet.wallet_add');
    }

    public function add(Request $request){
    	$validatedData = $request->validate([
    		'name' => 'required|max:255|string|unique:wallets',
    		'money' => 'required|numeric',
    	]);

    	Wallet::insert([
    		'name' => $request->input('name'),
    		'balance' => $request->input('money'),
    		'user_id' => Auth::id()
    	]);

    	return redirect()->route('wallet.index')->with('success','Create New Wallet Successfully!');
    }

    public function showFormEdit($id){
        $data = Wallet::find($id);
        return view('wallet.wallet_edit')->with('data',$data);
    }

    public function edit(Request $request, Wallet $wallet){
        if ($request->input('name') === $wallet->name) {
            return redirect()->back()->with('success','Nothing Updated');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255|string|unique:wallets',
        ]);
        $wallet->name = $request->input('name');
        $wallet->save();
        return redirect()->back()->with('success','Wallet Updated Successfully');
    }

    public function showFormTransfer(){
        $data = Wallet::where('user_id',Auth::id())->get();
        return view('wallet.wallet_transfer')->with('data',$data);
    }

    public function transfer(Request $request){
        $validatedData = $request->validate([
            'send' => 'required',
            'receive' => 'required|different:send',
            'money' => 'required|numeric|min:1',
            'note' => 'required'
        ]);

        $walletTran = new WalletTransaction;
        $walletTran->exchange = $request->get('money');
        $walletTran->note = $request->get('note');
        $walletTran->receive_wallet_id = $request->get('receive');
        $walletTran->wallet_id = $request->get('send');
        $walletTran->save();

        $walletSend = Wallet::find($request->get('send'));
        $walletSend->balance -= $request->get('money');
        $walletSend->save();

        $walletReceive = Wallet::find($request->get('receive'));
        $walletReceive->balance += $request->get('money');
        $walletReceive->save();

        return redirect()->route('wallet.showTransfer')->with('success','Money Transfer Successfully!');
    }
}
