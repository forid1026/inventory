<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{

    public function CategoryAll()
    {
        $categoryAll = Category::latest()->get();
        return view('backend.category.category_all', compact('categoryAll'));
    } //end method

    public function CategoryAdd()
    {

        return view('backend.category.category_add');
    } //end method

    public function CategoryStore(Request $request)
    {
        Category::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category  Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('category.all')->with($notification);
    }

    public function CategoryEdit($id)
    {
        $categories = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('categories'));
    }

    public function CategoryUpdate(Request $request)
    {
        $categoryId  =  $request->id;
        Category::findOrFail($categoryId)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('category.all')->with($notification);
    } //end method

    public function CategoryDelete($id)
    {
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}


