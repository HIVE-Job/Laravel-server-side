<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class APIProductController extends Controller
{
    protected $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate();
        return response()->json(['products' => $products], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            // Add other validation rules as needed
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title);
        $count = Product::where('slug', $slug)->count();

        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }

        $data['slug'] = $slug;
        $status = Product::create($data);

        if ($status) {
            return response()->json(['message' => 'Product successfully created'], 201);
        } else {
            return response()->json(['message' => 'Error, Please try again'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $this->validate($request, [
            'title' => 'string|required',
            // Add other validation rules as needed
        ]);

        $data = $request->all();
        $status = $product->fill($data)->save();

        if ($status) {
            return response()->json(['message' => 'Product successfully updated'], 200);
        } else {
            return response()->json(['message' => 'Error, Please try again'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $status = $product->delete();

            if ($status) {
                return response()->json(['message' => 'Product successfully deleted'], 200);
            } else {
                return response()->json(['message' => 'Error, Please try again'], 500);
            }
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
