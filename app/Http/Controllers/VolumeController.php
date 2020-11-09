<?php

namespace App\Http\Controllers;

use App\Models\Volume;
use Illuminate\Support\Facades\File;
use ZanySoft\Zip\Zip;

class VolumeController extends Controller
{
    public function index($library, $collection)
    {
        $volumes = Volume::leftJoin('collections', function ($join) {
            $join->on('volumes.collection_id', '=', 'collections.id');
        })->where('collections.slug', '=', $collection)->select('volumes.name as name', 'volumes.slug as slug', 'volumes.picture as picture', 'volumes.id as id')->get();
        return view('volumes', ['volumes' => $volumes, "library" => $library, "collection" => $collection]);
    }

    public function readVolume($library, $collection, $volume)
    {
        return view('volume', ['collection' => $collection, "library" => $library, "volume" => $volume, "user" => Auth()->user()->name]);
    }

    public function uncompressVolume($library, $collection, $volume)
    {
        $volume = Volume::where('slug', $volume)->first();
        $collection = $volume->collection;
        $library = $collection->library;
        $path = $library->path . '/' . $collection->name . '/' . $volume->name . '.' . $volume->extension;
        $this->unzipFile($path);
    }

    private function unzipFile($path)
    {
        $zip = Zip::open($path);
        $zip->extract(Auth()->user()->getPublicPath());
        $this->exportFilesAndClear();
    }

    private function exportFilesAndClear()
    {
        foreach (File::allFiles(Auth()->user()->getPublicPath()) as $file) {
            if (strpos($file, ".jpg") !== false || strpos($file, ".png") !== false) {
                File::move($file, Auth()->user()->getPublicPath() . '/' . $file->getFilename());
            }
        }
        $files = scandir(Auth()->user()->getPublicPath());
        foreach ($files as $key => $file) {
            if (is_dir(Auth()->user()->getPublicPath() . '/' . $file)) {
                if ($file[0] != '.') {
                    File::deleteDirectory(Auth()->user()->getPublicPath() . '/' . $file);
                }
            } else {
                if (strpos($file, ".jpg") === false && strpos($file, ".png") === false) {
                    File::delete(Auth()->user()->getPublicPath() . '/' . $file);
                }
            }
        }
    }

    public function readPage($library, $collection, $volume, $page)
    {
        $files = scandir(Auth()->user()->getPublicPath());
        $array = [];
        foreach ($files as $key => $file) {
            if ($file[0] != '.' && $file[0] != '@') {
                $array[] = $file;
            }
        }
        return $array[$page - 1];
    }
}
