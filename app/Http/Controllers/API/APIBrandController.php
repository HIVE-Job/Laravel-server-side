<?php

namespace App\Http\Controllers\API;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class APIBrandController extends Controller
{
    protected $brand;

    public function __construct()
    {
        $this->brand = new Brand();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate();
        return response()->json(['brands' => $brands], 200);
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
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title);
        $count = Brand::where('slug', $slug)->count();

        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }

        $data['slug'] = $slug;
        $status = Brand::create($data);

        if ($status) {
            return response()->json(['message' => 'Brand successfully created'], 201);
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
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }

        $this->validate($request, [
            'title' => 'string|required',
        ]);

        $data = $request->all();
        $status = $brand->fill($data)->save();

        if ($status) {
            return response()->json(['message' => 'Brand successfully updated'], 200);
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
        $brand = Brand::find($id);

        if ($brand) {
            $status = $brand->delete();

            if ($status) {
                return response()->json(['message' => 'Brand successfully deleted'], 200);
            } else {
                return response()->json(['message' => 'Error, Please try again'], 500);
            }
        } else {
            return response()->json(['message' => 'Brand not found'], 404);
        }
    }
}
