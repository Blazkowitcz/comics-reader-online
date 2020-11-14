<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    /**
     * Indicates If The Model Should Be Timestamped
     *
     * @var bool
     */
    public $timestamps = false;

    use HasFactory;

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public static function exist($name, $library_id)
    {
        $collections = Collection::all();
        foreach ($collections as $key => $collection) {
            if ($collection->name == $name && $collection->library_id = $library_id) {
                return true;
            }
        }
        return false;
    }

    public function volumeLeft()
    {
        $max = Volume::where('collection_id', $this->id)->count();
        $read = Volume::join('volume_reads', function ($join) {
            $join->on('volumes.id', '=', 'volume_reads.volume_id');
        })->where('volumes.collection_id', '=', $this->id)->count();
        return $max - $read;
    }

}
