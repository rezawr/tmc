<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Product;
use App\Http\Requests\Api\Product\StoreRequest;
use App\Http\Requests\Api\Product\UpdateRequest;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        try {
            $code = 200;
            $query = Product::whereNotNull('id');

            foreach ($request->all() as $index => $req) {
                if ($index == 'sku') {
                    if (gettype($req) == 'string') {
                        $query->where('sku', $req);
                    } else {
                        $query->whereIn('sku', $req);
                    }
                }
                
                if ($index == 'name') {
                    if (gettype($req) == 'string') {
                        $query->where('name', 'LIKE', $req);
                    } else {
                        $query->whereIn('name', 'LIKE', $req);
                    }
                }

                if ($index == 'price_start') {
                    $query->where('price', '>=', $req);
                }

                if ($index == 'price_end') {
                    $query->where('price', '<=', $req);
                }

                if ($index == 'stock_start') {
                    $query->where('stock', '>=', $req);
                }

                if ($index == 'stock_end') {
                    $query>where('stock', '<=', $req);
                }

                if ($index == 'category_id') {
                    if (gettype($req) == 'string') {
                        $query->whereHas('category', function (Builder $q) use ($req) {
                            $q->where('id', $req);
                        });
                    } else {
                        $query->whereHas('category', function (Builder $q) use ($req) {
                            $q->whereIn('id', $req);
                        });
                    }
                }
                
                if ($index == 'category_name') {
                    if (gettype($req) == 'string') {
                        $query->whereHas('category', function (Builder $q) use ($req) {
                            $q->where('name', 'LIKE', $req);
                        });
                    } else {
                        $query->whereHas('category', function (Builder $q) use ($req) {
                            $q->whereIn('name', 'LIKE', $req);
                        });
                    }
                }
            }

            $products = $query->paginate(10);

            $data = $products;
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
            $product = Product::create($request->all());

            $data['data'] = $product;
        } catch (\Throwable $t) {
            $data['error'] = $t->getMessage();

            $code = 500;
        }

        return $this->_generate_response($data, $code);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) : JsonResponse
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
    public function update(UpdateRequest $request, Product $product) : JsonResponse
    {
        try {
            $code = 200;
            $product->update($request->all());

            $data['data'] = $product;
        } catch (\Throwable $t) {
            $data['error'] = $t->getMessage();

            $code = 500;
        }

        return $this->_generate_response($data, $code);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product) : JsonResponse
    {
        try {
            $code = 200;
            $product->delete();

            $data['data'] = "Product deleted";
        } catch (\Throwable $t) {
            $data['error'] = $t->getMessage();

            $code = 500;
        }

        return $this->_generate_response($data, $code);
    }
}
