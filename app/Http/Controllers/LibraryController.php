<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Library;
/**
 * Retrieve libraries list
 */
class LibraryController extends Controller
{
    public function index(){
        $libraries = Library::all();
        return view('library', ['libraries' => $libraries]);
    }
}
