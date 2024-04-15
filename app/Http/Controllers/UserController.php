<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderby('desc', 'id')->paginate(2);
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->merge([
            "password" => Hash::make($request->password)
        ])->toArray());
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user)
    {
        $user = User::find($user);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, string $user)
    {
        $user = User::where('id', $user)->update($request->merge([
            "password" => Hash::make($request->password)
        ])->toArray());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user)
    {
        $user = User::destroy($user);
        return response()->json($user);
    }
}
