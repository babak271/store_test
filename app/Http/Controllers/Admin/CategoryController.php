<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller implements CategoryInterface
{
    /**
     * Display a listing of the categories.
     *
     * @return View
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $category = Category::create($this->validatedData($request));
        flash($category->name . ' has been created successfully.')->success();
        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified category.
     *
     * @param Category $category
     * @return View
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return View
     */
    public function update(Request $request, Category $category)
    {
        $category->update($this->validatedData($request));
        flash($category->name . ' has been updated successfully.');
        return view('admin.categories.show')
            ->with(compact('category'));
    }

    /**
     * Soft delete (moving to trash) the specified category from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $name = $category->name;
        $category->delete();
        flash($name . ' has been deleted successfully.');
        return redirect(route('admin.categories.index'));
    }

    /**
     * Force delete (permanently delete) the specified category from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function forceDestroy(Category $category)
    {
        $name = $category->name;
        $category->forceDelete();
        flash($name . ' has been deleted permanently.');
        return redirect(route('admin.categories.index'));
    }


    /**
     * Validate every request to Category.
     *
     * @param $request
     * @return mixed
     */
    private function validatedData($request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => '',
        ]);
        return $data;
    }
}