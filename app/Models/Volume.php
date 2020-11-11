<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    /**
     * Indicates If The Model Should Be Timestamped
     *
     * @var bool
     */
    public $timestamps = false;
    
    use HasFactory;

    public function collection(){
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function getPicture(){
        if($this->picture == ""){
            $collection = Collection::where('id', $this->collection_id)->first();
            return $collection->picture;
        }
        return $this->picture;
    }

    public function isRead(){
        $read = VolumeRead::where('user_id', Auth()->user()->id)->where('volume_id', $this->id)->first();
        if($read){
            return true;
        }
        return false;
    }
}
