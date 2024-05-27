<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;

class MediaController extends Controller
{
    use InteractsWithMedia;
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $modelType, $modelId)
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
                return response()->json(['error' => 'Model not found'], 404);
            }
            return response()->json(['message' => 'Media added successfully'], 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $modelType, $modelId)
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
            return response()->json(['error' => 'Model not found'], 404);
        }
        return response()->json(['message' => 'Media added successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $modelType, $modelId, string $mediaId)
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
            return response()->json(['error' => 'Model not found'], 404);
        }
        $model->media()->find($mediaId)->delete();
    }

    // Download meida
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
