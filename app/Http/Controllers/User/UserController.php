<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	

    public function __construct(){
    	return $this->middleware('auth');
    }

    public function showFormInformation(){
    	return view('user.information');
    }

    public function changeInformation(Request $request){
    	$user = Auth::user();
    	if ($user->email != $request->input('email')) {
    		$validatedData = $request->validate([
	            'name' => 'required|string|max:255',
	            'email' => 'required|string|email|max:255|unique:users',
                'phone' => array('regex:/^(01[2689]|09)[0-9]{8}$/'),
	    	]);

	    	$user->update([
	    		'name' => $request->input('name'),
	    		'email' => $request->input('email'),
	    		'phone' => $request->input('phone'),
	    		'address' => $request->input('address'),
	    		'birthday' => $request->input('birthday')
	    	]);
    	}

    	else{
    		$validatedData = $request->validate([
	            'name' => 'required|string|max:255',
	            'email' => 'required|string|email|max:255',
                'phone' => array('regex:/^(01[2689]|09)[0-9]{8}$/'),
	    	]);
	    	$user->update([
	    		'name' => $request->input('name'),
	    		'phone' => $request->input('phone'),
	    		'address' => $request->input('address'),
	    		'birthday' => $request->input('birthday')
	    	]);
    	}
    	
    	return redirect()->back()->with("success","Information Changed Successfully");
    }

    public function showFormChangePassword(){
    	return view('user.password');
    }

    public function changePassword(Request $request){
    	if (!(Hash::check($request->input('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Current password is invalid!");
        }
 
        if(strcmp($request->get('current-password'), $request->input('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Your new password must not be same as your current password!");
        }

        $validatedData = $request->validate([
        	'current-password' => 'required|string|min:6',
        	'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");
    }
}
