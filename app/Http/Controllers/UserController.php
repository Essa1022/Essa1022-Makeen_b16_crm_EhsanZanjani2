<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Jobs\SendEmail;
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
        return response()->json('logged out');
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
//        $expirationTime = Carbon::now()->addHours(2);
//        $token->token->expires_at = $expirationTime;
        return response()->json(['token' => $token]);
    }

    // Users index
    public function index(Request $request)
    {
        if($request->user()->can('read.user'))
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
                return $this->responseService->success_response($users);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Show specific User
    public function show(Request $request, $id)
    {
        if ($request->user()->can('read.user') || $request->user()->id == $id)
        {
            $user = User::with(['orders', 'team:id,name','tasks:id,title', 'ticket:id,subject', 'labels' ])->find($id);
            return $this->responseService->success_response($user);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new User
    public function store(CreateUserRequest $request)
    {
        if($request->user()->can('create.user'))
        {
            $user = User::create($request->merge([
                "password" => Hash::make($request->password)
            ])->toArray());
            $user->assignRole('user');
            $user->labels()->attach($request->label_ids);
            SendEmail::dispatch($user);
            return $this->responseService->success_response($user);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update User
    public function update(EditUserRequest $request, string $id)
    {
        if($request->user()->can('update.user') || $request->user()->id == $id)
        {
            $user = User::find($id)->update($request->merge([
                "password" => Hash::make($request->password)
            ])->toArray());
            return $this->responseService->success_response($user);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Users
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.user') || $request->user()->id == $id)
        {
            User::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}


