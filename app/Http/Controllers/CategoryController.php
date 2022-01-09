<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{

    public function index()
    {
        $category = Category::all();
        return CategoryResource::collection($category);
    }

    public function store(StoreCategoryRequest $request)
    {
        $request->validated();
        $category =  Category::create($request->all());
        return new CategoryResource($category);
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $request->validated();
        $category = Category::findOrFail($id);
        $category->update($request->all);
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        //
    }

    public function MessageResponse(string $message, int $status = 200, $data = null)
    {


        return response([
            'message' => $message,
            'data' => $data ? new CategoryResource($data) : '',
        ], $status);
    }
}
