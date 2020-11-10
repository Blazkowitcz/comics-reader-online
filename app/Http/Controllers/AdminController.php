<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Library;
use App\Models\Volume;
use Illuminate\Support\Str;
use ZanySoft\Zip\Zip;

class AdminController extends Controller
{
    public function scanFolder($library)
    {
        $library = Library::where('slug', $library)->first();
        $files = scandir($library->path);
        foreach ($files as $file) {
            if (!Collection::exist($file, $library->id)) {
                if ($file[0] != '.' && $file[0] != '@') {
                    $volumes = scandir($library->path . '/' . $file);
                    $number_volumes = $this->countNumberVolumes($volumes);
                    $collection = $this->createCollection($file, Str::slug($file, '-'), $library->id, $number_volumes);
                    foreach ($volumes as $key => $volume) {
                        if ($volume[0] != '.' && $volume[0] != '@' && !is_dir($volume)) {
                            $name = pathinfo($library->path . '/' . $file . '/' . $volume)['filename'];
                            $extension = "";
                            try {
                                $extension = pathinfo($library->path . '/' . $file . '/' . $volume)['extension'];
                            } catch (\Exception $e) {}
                            $volume = $this->createVolume($name, Str::slug($name, '-'), $extension, $collection->id);
                        }
                    }
                }
            }
        }
    }

    private function createCollection($name, $slug, $library, $number_volumes)
    {
        $collection = new Collection();
        $collection->name = $name;
        $collection->slug = $slug;
        $collection->library_id = $library;
        $collection->picture = "";
        $collection->number_volumes = $number_volumes;
        $collection->save();
        return $collection;
    }

    private function createVolume($name, $slug, $extension, $collection)
    {
        $volume = new Volume();
        $volume->name = $name;
        $volume->slug = $slug;
        $volume->extension = $extension;
        $volume->collection_id = $collection;
        $volume->picture = "";
        $volume->pages = 0;
        if ($extension == "cbz") {
            try {
                $current_collection = Collection::where('id', $collection)->first();
                $library = $current_collection->library;
                $zip = Zip::open($library->path . '/' . $current_collection->name . '/' . $name . '.' . $extension);
                $count = count($zip->listFiles());
                $volume->pages = $count;
            } catch (\Exception $e) {}
        }
        $volume->save();
        return $volume;
    }

    private function countNumberVolumes($volumes){
        $number = 0;
        foreach ($volumes as $key => $volume) {
            if (strpos($volume, ".cbr") !== false || strpos($volume, ".cbz") !== false || strpos($volume, ".pdf") !== false) {
                $number ++;
            }
        }
        return $number;
    }
}
