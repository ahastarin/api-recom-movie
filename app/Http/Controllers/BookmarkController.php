<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookmarkRequest;
use App\Http\Requests\UpdateBookmarkRequest;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add(Request $request)
    {
        $user = Auth::user();

        Bookmark::create([
            "user_id" => $user->id,
            "movie_id" => $request->movieId
        ]);

        return "ok";
    }

    public function get()
    {
        $user = Auth::user();
        $bookmark = Bookmark::where("user_id", $user->id)->get();

        return $bookmark;
    }

    public function delete(Request $request)
    {
        Bookmark::where('movie_id', $request->movieId)->delete();

        return response()->json([
            "status" => "sudah di delete ya tol"
        ]);
    }
}
