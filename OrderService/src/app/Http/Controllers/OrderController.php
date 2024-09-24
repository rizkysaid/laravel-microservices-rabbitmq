<?php

namespace App\Http\Controllers;

use App\Jobs\OrderCreated;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected Model $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function store(Request $request){

        $order = $this->model->create($request->all());
        OrderCreated::dispatch($order->toArray());
        return response()->json([
            'data' => $order
        ]);

    }

}
