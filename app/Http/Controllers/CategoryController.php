<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //index
    public function index()
    {
        $categories = Category::paginate(10);
        return view('pages.category.index', compact('categories'));
    }

    //create
    public function create()
    {
        return view('pages.category.create');
    }

    //store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp'
        ]);
        $filename = $request->hasFile('image') ? time() . '.' . $request->image->extension() : null;
        $filename != null ? $request->image->storeAs('public/categories', $filename): null;
        $data = $request->all();
        $data['image'] = $filename;
        Category::create($data);

        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    //edit
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.category.edit', compact('category'));
    }

    //update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable|max:255',
        ]);
        $imagePath = Category::find($id)->image;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'nullable|image|mimes:png,jpg,jpeg,webp'
            ]);
            if (Storage::disk('public')->exists('categories/' . $imagePath)) {
                Storage::disk('public')->delete('categories/' . $imagePath);
            }
            $imagePath = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/categories', $imagePath);
        }
        $data = $request->all();
        $product = Category::findOrFail($id);
        $data['image'] = $imagePath;
        $product->update($data);
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    //destroy
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if (Storage::disk('public')->exists('categories/' . $category->image)) {
            Storage::disk('public')->delete('categories/' . $category->image);
        }
        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Succesfully Deleted Data'
        ]);
        // return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
