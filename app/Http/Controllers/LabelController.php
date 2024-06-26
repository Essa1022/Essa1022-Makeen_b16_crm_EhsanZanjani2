<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Product;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class LabelController extends Controller
{

    // Sync Labels
    public function sync(Request $request, string $modelType, $modelId)
        {
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
                    return $this->responseService->notFound_response();
                }
                $labels = $request->input('label_ids');
                $model->labels()->sync($labels);
                return $this->responseService->success_response();
            }
            else
            {
            return $this->responseService->unauthorized_response();
            }
        }

    // Labels index
    public function index(Request $request)
    {
        if($request->user()->can('read.label'))
        {
            $labels = Label::orderby('id', 'desc')->paginate(5);
            return $this->responseService->success_response($labels);
        }
        else
        {
        return $this->responseService->unauthorized_response();
        }
    }

    // Show specific Label
    public function show(Request $request, string $id)
    {
        if($request->user()->can('read.label'))
        {
            $label = Label::find($id);
            return $this->responseService->success_response($label);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new Label
    public function store(Request $request)
    {
        if($request->user()->can('create.label'))
        {
        $label = Label::create($request->toArray());
        return $this->responseService->success_response($label);
        }
        else
        {
        return $this->responseService->unauthorized_response();
        }
    }

    // Update Label
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.label'))
        {
        $label = Label::find($id)->update($request->toArray());
        return $this->responseService->success_response($label);
        }
        else
        {
        return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Labels
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.label'))
        {
            Label::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
        return $this->responseService->unauthorized_response();
        }
    }

}


