<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;


class CollectionController extends Controller
{
    public function index($library){
        $collections = Collection::leftJoin('libraries', function($join){
            $join->on('collections.library_id', '=', 'libraries.id');
        })->where('libraries.slug', '=', $library)
        ->select(
            'collections.name as name',
            'collections.slug as slug',
            'collections.picture as picture',
            'libraries.name as library_name',
            'libraries.slug as library_slug'
        )->get();
        return view('collection', [ "collections" => $collections ]);
    }
}
