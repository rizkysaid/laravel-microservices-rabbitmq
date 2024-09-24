<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductController extends Controller
{
    protected Model $model;

    public function __construct(Product $model)
    {
        $this->model = $model;

        // timezone set Indonesia
        date_default_timezone_set('Asia/Jakarta');
    }

    // store
    public function store(Request $request)
    {
        $request = $request->all();
        
        $product = $this->model->create($request);

        return response()->json([
            'data' => $product,
            'message' => 'Product created successfully',
        ]);
    }

    // index
    public function index()
    {
        $products = $this->model->all();
        
        return response()->json([
            'data' => $products,
            'message' => 'Products fetched successfully',
        ]);
    }

    // show
    public function show($id)
    {
        $product = $this->model->find($id);

        if (is_null($product)) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }
        
        return response()->json([
            'data' => $product,
            'message' => 'Product fetched successfully',
        ]);
    }

    // destroy
    public function destroy($id)
    {
        $product = $this->model->find($id);


        if(is_null($product)) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }


        $product->delete();
        
        return response()->json([
            'data' => $product,
            'message' => 'Product deleted successfully',
        ]);
    }
}
