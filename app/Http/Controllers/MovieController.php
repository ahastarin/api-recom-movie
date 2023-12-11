<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CodeBugLab\Tmdb\Facades\Tmdb;

class MovieController extends Controller
{
    public function index() {
        $tmdb = Tmdb::movies()->popular()->get()["results"]; 
        return response()->json($tmdb);
    }

    public function detail(Request $request) {
        $tmdb = Tmdb::movies()->details($request->id)->get();
        return response()->json($tmdb);
    }

    public function search(Request $request){
        $tmdb = Tmdb::search()->multi()->query($request->search)->get(); 
        return response()->json($tmdb);
    }

    
    public function genre(){
        $tmdb = Tmdb::genres()->movieList()->get()["genres"];
        return response()->json($tmdb);
    }

    public function image(Request $request){
        $tmdb = Tmdb::movies()->images($request->id)->get();
        $image = $tmdb["posters"][4]["file_path"]; 
        return redirect("https://image.tmdb.org/t/p/w500/" . $image);
        // return response()->json($tmdb);

        // return $image;
    }
}
