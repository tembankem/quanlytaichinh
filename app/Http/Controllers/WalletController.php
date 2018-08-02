<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use Illuminate\Support\Facades\Auth; 
use App\User;

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
}
