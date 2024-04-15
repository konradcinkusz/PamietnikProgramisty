<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private function validateCategoryData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'color_code' => 'required|string|regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/i'
        ], [
            'name.required' => 'The name of the item is required.',
            'name.string' => 'The name must be a valid text string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'color_code.required' => 'A color code is required.',
            'color_code.string' => 'The color code must be a valid text string.',
            'color_code.regex' => 'The color code must be a valid hexadecimal value (e.g., #123ABC or #FFF).'
        ]);
        
    }

    public function createCategory(Request $request)
    {
        $validatedData = $this->validateCategoryData($request);

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
