<?php


namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Workshop extends Model
{


    public function events()
    {
        return $this->belongsTo(Event::class);
    }
}
