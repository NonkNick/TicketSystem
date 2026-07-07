<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories, alphabetically sorted.
     *
     * Readable by any authenticated user (needed to populate the category
     * picker on the ticket form); management is admin-only.
     */
    public function index()
    {
        Gate::authorize('viewAny', Category::class);

        return CategoryResource::collection(Category::orderBy('name')->get());
    }

    /**
     * Store a newly created category (administrators only).
     */
    public function store(StoreCategoryRequest $request)
    {
        Gate::authorize('create', Category::class);

        $category = Category::create($request->validated());

        return CategoryResource::make($category);
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        Gate::authorize('view', $category);

        return CategoryResource::make($category);
    }

    /**
     * Update the specified category (administrators only).
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Gate::authorize('update', $category);

        $category->update($request->validated());

        return CategoryResource::make($category);
    }

    /**
     * Remove the specified category (administrators only).
     *
     * A category that still has tickets attached cannot be deleted.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);

        if ($category->tickets()->exists()) {
            return response()->json([
                'message' => 'Deze categorie is nog aan tickets gekoppeld en kan niet worden verwijderd.',
            ], 409);
        }

        $category->delete();

        return response()->noContent();
    }
}
