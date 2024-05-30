<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMediaRequest;
use App\Models\Media;
use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;

class MediaController extends ApiController
{

    // Show specific Media
    public function show(Request $request, string $modelType, $modelId, $mediaId)
    {
        if ($request->user()->can('read.media'))
        {
            if ($modelType === 'avatar')
            {
                $model = User::find($modelId);
                $media = $model->media()->find($mediaId);
            }
            elseif ($modelType === 'product')
            {
                $model = Product::find($modelId);
                $media = $model->media()->find($mediaId);
            }
            elseif ($modelType === 'message')
            {
                $model = Message::find($modelId);
                $media = $model->media()->find($mediaId);
            }
            if (!$model)
            {
                return $this->notFound_response();
            }
            if (!$media)
            {
                return $this->notFound_response();
            }
            return $this->success_response($media);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Store a new Media
    public function store(CreateMediaRequest $request, string $modelType, $modelId)
    {
        if ($request->user()->can('create.media'))
        {
            if ($modelType === 'avatar')
            {
                $model = User::find($modelId);
                $model->addMedia($request->file('file'))->toMediaCollection('avatar', 'local');
            }
            elseif ($modelType === 'product')
            {
                $model = Product::find($modelId);
                $model->addMedia($request->file('file'))->toMediaCollection('product_images');
            }
            elseif ($modelType === 'message')
            {
                $model = Message::find($modelId);
                $model->addMedia($request->file('file'))->toMediaCollection('message_files', 'local');
            }
            if (!$model)
            {
                return $this->notFound_response();
            }
            return $this->success_response();
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Update Media
    public function update(Request $request,string $modelType, $modelId)
    {
        if ($request->user()->can('update.media'))
        {
            if ($modelType === 'avatar')
            {
                $model = User::find($modelId);
                $model->clearMediaCollection('avatar');
                $model->addMedia($request->file('file'))->toMediaCollection('avatar', 'local');
            }
            elseif ($modelType === 'product')
            {
                $model = Product::find($modelId);
                $model->clearMediaCollection('products_images');
                $model->addMedia($request->file('file'))->toMediaCollection('products_images');
            }
            elseif ($modelType === 'message')
            {
                $model = Message::find($modelId);
                $model->clearMediaCollection('messages_files');
                $model->addMedia($request->file('file'))->toMediaCollection('message_files', 'local');
            }
            if (!$model)
            {
                return $this->notFound_response();
            }
            return $this->success_response();
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Destroy Media
    public function destroy(Request $request, string $modelType, $modelId, string $mediaId)
    {
        if ($request->user()->can('delete.media'))
        {
            if ($modelType === 'avatar')
            {
                $model = User::find($modelId);
            }
            elseif ($modelType === 'product')
            {
                $model = Product::find($modelId);
            }
            elseif ($modelType === 'message')
            {
                $model = Message::find($modelId);
            }
            if (!$model)
            {
                return $this->notFound_response();
            }
            $model->media()->find($mediaId)->delete();
            return $this->delete_response();
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Download Media
    public function download(string $modelType, $modelId, string $mediaId)
    {
        if ($modelType === 'avatar')
        {
            $model = User::find($modelId);
        }
        elseif ($modelType === 'product')
        {
            $model = Product::find($modelId);
        }
        elseif ($modelType === 'essage')
        {
            $model = Message::find($modelId);
        }
        $media = $model->media()->find($mediaId);
        $file = $media->getPath();
        $file_name = $media->file_name;
        return response()->download($file, $file_name);
    }
}
