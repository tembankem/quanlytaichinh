<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\Category;

class CategoryController extends Controller
{
	public function __construct(){
    	return $this->middleware('auth');
    }

    public function showSpendIndex(){
    	$data = Category::where('type',1)->get();
    	return view('category.spend_index')->with('data',$data);
    }

    public function showAddSpendForm(){
    	$data = Category::where('type',1)->where('level',1)->orWhere('type',1)->where('level',2)->get();
    	return view('category.add_spend')->with('data',$data);
    }

    public function addSpend(Request $request){
    	$validatedData = $request->validate([
    			'name' => 'required|string|unique:categories',
    	]);
    	if ($request->get('parent') == 0) {
    		$category = new Category;
    		$category->name = $request->get('name');
    		$category->type = 1;
    		$category->level = 1;
    		$category->user_id = Auth::id();
    		$category->save();
    		return redirect()->route('category.spendIndex')->with('success','Create new category successfully!');
    	}
    	else{
    		$parent = Category::find($request->get('parent'));
    		$category = new Category;
    		$category->name = $request->get('name');
    		$category->type = 1;
    		$category->level = $parent->level + 1;
    		$category->parent_id = $parent->id;
    		$category->user_id = Auth::id();
    		$category->save();
    		return redirect()->route('category.spendIndex')->with('success','Create new category successfully!');
    	}
    }

    public function showReceiveIndex(){
    	$data = Category::where('type',2)->get();
    	return view('category.receive_index')->with('data',$data);
    }

    public function showAddReceiveForm(){
    	$data = Category::where('type',2)->where('level',1)->orWhere('type',2)->where('level',2)->get(	);
    	return view('category.add_receive')->with('data',$data);
    }

    public function addReceive(Request $request){
    	$validatedData = $request->validate([
    			'name' => 'required|string|unique:categories',
    	]);
    	if ($request->get('parent') == 0) {
    		$category = new Category;
    		$category->name = $request->get('name');
    		$category->type = 2;
    		$category->level = 1;
    		$category->user_id = Auth::id();
    		$category->save();
    		return redirect()->route('category.receiveIndex')->with('success','Create new category successfully!');
    	}
    	else{
    		$parent = Category::find($request->get('parent'));
    		$category = new Category;
    		$category->name = $request->get('name');
    		$category->type = 2;
    		$category->level = $parent->level + 1;
    		$category->parent_id = $parent->id;
    		$category->user_id = Auth::id();
    		$category->save();
    		return redirect()->route('category.receiveIndex')->with('success','Create new category successfully!');
    	}
    }

    public function showEditSpendForm($id){
    	$data = Category::where('type',1)->where('level',1)->where('id','!=',$id)->orWhere('type',1)->where('level',2)->where('id','!=',$id)->get();
    	$category = Category::find($id);
    	return view('category.edit')->with([
    		'data' => $data,
    		'category' => $category
    	]);
    }

    public function showEditReceiveForm($id){
    	$data = Category::where('type',2)->where('level',1)->where('id','!=',$id)->orWhere('type',2)->where('level',2)->where('id','!=',$id)->get();
    	$category = Category::find($id);
    	return view('category.edit')->with([
    		'data' => $data,
    		'category' => $category
    	]);
    }

    public function edit(Request $request, Category $category){
    	$parent = Category::find($request->get('parent'));
    	if ($request->get('name') == $category->name && $request->get('parent') == $category->parent_id) {
    		return redirect()->back()->with('success', 'Nothing to update!');
    	}
    	$validatedData = $request->validate([
            'name' => 'required|max:255|string|unique:wallets',
        ]);
        if ($request->get('parent') == 0) {
        	$category->name = $request->get('name');
        	$category->parent_id = null;
        	$category->level = 1;
	        $category->save();
	        return redirect()->back()->with('success','Updated Successfully!');
        }
        $category->name = $request->get('name');
        $category->parent_id = $parent->id;
        $category->level = $parent->level + 1;
        $category->save();
        return redirect()->back()->with('success','Updated Successfully!');
    }
}
