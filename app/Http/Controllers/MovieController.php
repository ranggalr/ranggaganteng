<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Movie/Index', [
            'movies' => Movie::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return Inertia::render('Admin/Movie/Edit', [
            'movie' => [
                'data' => $movie,
                'sources' => $movie->sources
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }

    public function import()
    {
        return Inertia::render('Admin/Movie/Import');
    }

    public function importDetails($tmdb)
    {
        return Inertia::render('Admin/Movie/ImportDetails', [
            'tmdb_id' => $tmdb
        ]);
    }

    public function storeImportedDetails(Request $request)
    {
        $request->validateWithBag('storeImported', [
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string','required'],
            'rating' => ['numeric','required'],
            'poster_path' => ['string','required','nullable'],
            'release_date' => ['date','required'],
            'duration' => ['numeric','required'],
            'trailer_link' => ['url','required', 'nullable'],
            'genre' => ['array', 'required'],
            'cast' => ['array', 'required'],
            'cast.*.name' => ['string','required'],
            'cast.*.gender' => ['string','required'],
            'cast.*.gender' => ['string','required'],
        ]);
        DB::beginTransaction();
        try {
            $movie = Movie::create([
                'title' => $request->title,
                'description' => $request->description,
                'rating' => $request->rating,
                'poster_path' => $request->poster_path,
                'release_date' => $request->release_date,
                'trailer_link' => $request->trailer_link,
                'duration' => $request->duration,
                'slug' => Str::slug($request->title . '-' . date('Y', strtotime($request->release_date)))
            ]);
            $genreNameToId = function($genre) {
                $g = Genre::where('name',$genre);
                if($g->exists())
                {
                    return $g->first()->id;
                }
                else
                {
                    return Genre::create(['name' => $genre])->id;
                }
            };
            $castNameToId = function($cast) {
                $c = Cast::where('name',$cast['name']);
                if($c->exists())
                {
                    return $c->first()->id;
                }
                else
                {
                    return Cast::create(['name' => $cast['name'], 'gender' => $cast['gender'], 'profile_path' => $cast['profile_path']])->id;
                }
            };
            $movie->genres()->sync(array_map($genreNameToId, $request->genre));
            $movie->casts()->sync(array_map($castNameToId, $request->cast));
            DB::commit();
            return redirect()->route('admin.movie.index');
        }
        catch(Exception $e)
        {
            DB::rollback();
            throw $e;
        }
    }
}
