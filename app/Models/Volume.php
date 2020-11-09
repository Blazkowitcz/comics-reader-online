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
}
