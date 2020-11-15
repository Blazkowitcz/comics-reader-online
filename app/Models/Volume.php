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

    public static function exist($name, $collection_id){
        $volume = Volume::where('name', $name)->where('collection_id', $collection_id)->first();
        if($volume != null){
            return true;
        }
        return false;
    }

    /**
     * Return collection related to volume
     * @return object
     */
    public function collection(){
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    /**
     * Return collection picture
     * @return string
     */
    public function getPicture(){
        if($this->picture == ""){
            $collection = Collection::where('id', $this->collection_id)->first();
            return $collection->picture;
        }
        return $this->picture;
    }

    /**
     * Return the short name
     * @return string
     */
    public function getShortName(){
        return mb_strimwidth($this->name, 0, 25, '...');
    }

    /**
     * Check if the volume is read
     * @return bool
     */
    public function isRead(){
        $read = VolumeRead::where('user_id', Auth()->user()->id)->where('volume_id', $this->id)->first();
        if($read){
            return true;
        }
        return false;
    }

    /**
     * Check if the volume is on reading
     * @return bool
     */
    public function onReading(){
        $read = VolumeRead::where('volume_id', Auth()->user()->last_volume)->where('user_id', Auth()->user()->id)->first();
        if(!$read){
            if(Auth()->user()->last_volume == $this->id){
                return true;
            }
        }
        return false;
    }
}
