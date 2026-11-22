<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $media = $query->latest()->paginate(10);
        return MediaResource::collection($media);
    }

    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());
        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $media = Media::with('users')->findOrFail($id);
        return new MediaResource($media);
    }

    public function update(StoreMediaRequest $request, string $id)
    {
        $media = Media::findOrFail($id);
        $media->update($request->validated());
        return new MediaResource($media);
    }

    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);
        $media->delete();
        return response()->json([
            'message' => 'Media berhasil dihapus dari sistem.'
        ], 200);
    }
}
