<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\NameResource;

class CategoryController extends Controller
{

    public function index()
    {
        $category = Category::all();
        return NameResource::collection($category);
    }

    public function store(StoreCategoryRequest $request)
    {
        $request->validated();
        $category =  Category::create($request->all());
        return $this->MessageResponse('Show Single', 201,  $data = $category);
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);

        return $this->MessageResponse('Show Single', $data = $category);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $request->validated();
        $category = Category::findOrFail($id);
        $category->update($request->all);
        return $this->MessageResponse('Updated', $data = $category);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->MessageResponse('Deleted');
    }

    public function MessageResponse(string $message, int $status = 200, $data = null)
    {


        return response([
            'message' => $message,
            'data' => $data ? new NameResource($data) : '',
        ], $status);
    }
}
