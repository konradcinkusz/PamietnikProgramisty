<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'color_code' => 'required'
        ]);

        Category::create($validatedData);

        return redirect('/');
    }

    public function editCategory(Category $category)
    {
        return view('edit-category', ['category' => $category]);
    }

    public function updateCategory(Category $category, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'color_code' => 'required'
        ]);

        $category->update($validatedData);

        return redirect('/');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        return redirect('/');
    }
}
