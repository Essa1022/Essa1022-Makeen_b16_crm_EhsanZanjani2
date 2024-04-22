<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // logout
    public function logout(){
        $user = auth()->user();
        $user->currentAccessToken()->delete();
        return response()->json('logout');
    }

    // login
    public function login(Request $request)
    {
        $user = User::select('id', 'phone_number', 'password')
        ->where('phone_number', $request->phone_number)->first();

        if(!$user){
            return response()->json('user not found');
        }
        if(!Hash::check($request->password, $user->password)){
            return response()->json('password incorrect');
        }
        $token = $user->createToken($request->phone_number)->plainTextToken;
        return response()->json(['token' => $token]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $id = null)
    {
        if(!$id)
        {
            $users = User::orderby('id', 'desc')->paginate(2);
            return response()->json($users);
        }
        else
        {
            $user = User::find($id);
            return response()->json($user);
        }
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
    // public function show(string $user)
    // {
    //     $user = User::find($user);
    //     return response()->json($user);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, string $id)
    {
        $user = User::find( $id)->update($request->merge([
            "password" => Hash::make($request->password)
        ])->toArray());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::destroy($id);
        return response()->json($user);
    }
}
