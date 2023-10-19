<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderListResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductListResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search',false);
        $perPage = request('per_page',10);
        $sortField = request('sort_field','updated_at');
        $sortDirection = request('sort_direction','desc');


        $query = Order::query();
        $query->orderBy($sortField,$sortDirection);

        return OrderListResource::collection($query->paginate($perPage));
    }

    public function view(Order $order){
        return new OrderResource($order);
    }
}
