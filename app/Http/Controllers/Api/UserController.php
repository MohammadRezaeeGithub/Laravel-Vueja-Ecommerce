<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Api\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
        $search = request('search',false);
        $perPage = request('per_page',10);
        $sortField = request('sort_field','updated_at');
        $sortDirection = request('sort_direction','desc');
        $query = User::query();
        $query->orderBy($sortField,$sortDirection);

        return UserResource::collection($query->paginate($perPage));
    }


    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['is_admin'] = true;
        $data['email_verified_at'] = Carbon::now()->toDateTimeString();
        $data['password'] = Hash::make($data['password']);
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;


        $user = User::create($data);

        return new UserResource($user);
    }




    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;
        if (!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);

        return new UserResource($user);

    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }

}
