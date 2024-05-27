<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Product;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    // Sync Label
    public function sync(Request $request, string $modelType, $modelId)
        {
            // $model = match ($modelType) {
            //     'user' => User::find($modelId),
            //     'team' => Team::find($modelId),
            //     'product' => Product::find($modelId),
            // };
            if($request->user()->can('give.label'))
            {
                if ($modelType === 'user')
                {
                    $model = User::find($modelId);
                }
                elseif ($modelType === 'team')
                {
                    $model = Team::find($modelId);
                }
                elseif ($modelType === 'product')
                {
                    $model = Product::find($modelId);
                }
                if (!$model)
                {
                    return response()->json(['error' => 'Model not found'], 404);
                }
                $labels = $request->input('label_ids');
                $model->labels()->sync($labels);
                return response()->json(['message' => 'Labels synced successfully'], 200);
            }
            else
            {
            return response()->json('User does not have the permission', 403);
            }
        }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.label'))
        {
        if(!$id)
        {
            $labels = Label::orderby('id', 'desc')->paginate(2);
            return response()->json($labels);
        }
        else
        {
            $label = Label::find($id);
            return response()->json($label);
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
    public function store(Request $request)
    {
        if($request->user()->can('create.label'))
        {
        $label = Label::create($request->toArray());
        return response()->json($label);
        }
        else
        {
        return response()->json('User does not have the permission', 403);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $product)
    // {
    //     $product = Product::find($product);
    //     return response()->json($product);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.label'))
        {
        $label = Label::find($id)->update($request->toArray());
        return response()->json($label);
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
        if($request->user()->can('delete.label'))
        {
            Label::destroy($id);
        }
        else
        {
        return response()->json('User does not have the permission', 403);
        }
    }

}


