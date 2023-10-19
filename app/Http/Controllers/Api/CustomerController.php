<?php

namespace App\Http\Controllers\Api;

use App\Enums\AddressType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerListResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class CustomerController extends Controller
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
        $query = Customer::query();
        if ($search){
            $query->where(DB::raw("CONCAT(first_name,' ',last_name)"),'like',"%{$search}%");
        }
        $customers = $query->orderBy($sortField,$sortDirection);


        return CustomerListResource::collection($query->paginate($perPage));
    }



    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }


    public function update(CustomerRequest $request, Customer $customer)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $customer->update($data);


        return new CustomerResource($customer);

    }


    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->noContent();
    }


}
