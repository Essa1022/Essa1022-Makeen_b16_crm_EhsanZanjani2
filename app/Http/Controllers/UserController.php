<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    // logout
    public function logout()
    {
        $user = auth()->user();
        $user->currentAccessToken()->delete();
        return response()->json('logout');
    }

    // login
    public function login(Request $request)
    {
        $user = User::select('id', 'phone_number', 'password')
            ->where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return response()->json('user not found');
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json('password incorrect');
        }
        $token = $user->createToken($request->phone_number)->plainTextToken;
        return response()->json(['token' => $token]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.user') || $request->user()->id == $id)
        {
            if (!$id)
            {
                $users = new User();
                $users = $users->with(['orders', 'team:id,name','tasks:id,title', 'ticket:id,subject', 'labels' ]);
                if ($request->has_orders)
                {
                    $users = $users->has('orders');
                }
                if ($request->order_sum)
                {
                    $users = $users->withSum('orders', 'total_amount');
                }
                if ($request->order_count)
                {
                    $users = $users->withCount('orders');
                }
                $users = $users->orderBy('id', 'desc')->paginate(10);
                return response()->json($users);
            }
            else
            {
                $user = User::with(['orders', 'team:id,name','tasks:id,title', 'ticket:id,subject', 'labels' ])->find($id);
                return response()->json($user);
            }
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        if($request->user()->can('create.user'))
        {
            $user = User::create($request->merge([
                "password" => Hash::make($request->password)
            ])->toArray());
            $user->assignRole('user');
            $user->labels()->attach($request->label_ids);
            return response()->json($user);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
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
        if($request->user()->can('update.user') || $request->user()->id == $id)
        {
            $user = User::find($id)->update($request->merge([
                "password" => Hash::make($request->password)
            ])->toArray());
            return response()->json($user);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.user') || $request->user()->id == $id)
        {
            $user = User::destroy($id);
            return response()->json($user);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}


