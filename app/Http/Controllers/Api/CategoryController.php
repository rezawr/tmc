<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Category;
use App\Http\Requests\Api\Category\StoreRequest;
use App\Http\Requests\Api\Category\UpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        try {
            $code = 200;
            $categories = Category::paginate(10);

            $data = $categories;
        } catch (\Throwable $t) {
            $data['error'] = $t->getMessage();

            $code = 500;
        }

        return $this->_generate_response($data, $code);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request) : JsonResponse
    {
        try {
            $code = 200;
            $category = Category::create($request->all());

            $data['data'] = $category;
        } catch (\Throwable $t) {
            $data['error'] = $t->getMessage();

            $code = 500;
        }

        return $this->_generate_response($data, $code);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) : JsonResponse
    {
        try {
            $code = 200;

            $data['data'] = $category;
        } catch (\Throwable $t) {
            $data['error'] = $t->getMessage();

            $code = 404;
        }

        return $this->_generate_response($data, $code);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category) : JsonResponse
    {
        try {
            $code = 200;
            $category->update($request->all());

            $data['data'] = $category;
        } catch (\Throwable $t) {
            $data['error'] = $t->getMessage();

            $code = 500;
        }

        return $this->_generate_response($data, $code);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) : JsonResponse
    {
        try {
            $code = 200;
            $category->delete();

            $data['data'] = "Category deleted";
        } catch (\Throwable $t) {
            $data['error'] = $t->getMessage();

            $code = 500;
        }

        return $this->_generate_response($data, $code);
    }
}
