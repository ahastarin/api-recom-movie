<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CodeBugLab\Tmdb\Facades\Tmdb;
use Illuminate\Pagination\LengthAwarePaginator;

class MovieController extends Controller
{
    public function index()
    {
        $tmdb = Tmdb::movies()->popular()->get();
        $movies = [];
        foreach ($tmdb['results'] as $movie) {
            array_push($movies, [
                "id" => $movie["id"],
                "title" => $movie["title"],
            ]);
        };

        return array_chunk($movies, 5);
    }

    public function detail(Request $request)
    {
        $tmdb = Tmdb::movies()->details($request->id)->get();
        return response()->json($tmdb);
    }

    public function search(Request $request)
    {
        $tmdb = Tmdb::search()->multi()->query($request->search)->get();
        return response()->json($tmdb);
    }


    public function genre()
    {
        $tmdb = Tmdb::genres()->movieList()->get()["genres"];
        return response()->json($tmdb);
    }

    public function image(Request $request)
    {
        $tmdb = Tmdb::movies()->images($request->id)->get();
        $image = $tmdb["posters"][4]["file_path"];
        return redirect("https://image.tmdb.org/t/p/w500/" . $image);
        // return response()->json($tmdb);

        // return $image;
    }


    public function video(Request $request)
    {
        $tmdb = Tmdb::movies()->videos($request->id)->get();
        $key = $tmdb["results"][0]['key'];
        // return redirect('https://youtu.be/' . $key);
        // return response()->json($key);

        return '<iframe width="853" height="480" src="https://www.youtube.com/embed/' . $key . '" title="FROZEN | Let It Go Sing-along | Official Disney UK" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
    }
}
