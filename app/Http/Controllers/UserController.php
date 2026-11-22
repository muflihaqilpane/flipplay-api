<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showCollection(string $id)
    {
        $user = User::with('media')->findOrFail($id);
        return new UserResource($user);
    }

    public function addToCollection(Request $request, string $id)
    {
        $request->validate([
            'media_id' => 'required|exists:media,id'
        ]);

        $user = User::findOrFail($id);

        if ($user->media()->where('media_id', $request->media_id)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di dalam koleksi pengguna.'
            ], 409);
        }

        $user->media()->attach($request->media_id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi pengguna.'
        ], 201);
    }

    public function removeFromCollection(string $id, string $mediaId)
    {
        $user = User::findOrFail($id);

        if (!$user->media()->where('media_id', $mediaId)->exists()) {
            return response()->json([
                'message' => 'Media tidak ditemukan di koleksi pengguna.'
            ], 404);
        }

        $user->media()->detach($mediaId);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi pengguna.'
        ], 200);
    }
}
