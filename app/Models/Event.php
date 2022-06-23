<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    public function workshops()
    {
        return Workshop::where('event_id', $this->id)->get();
    }

    /**
     * took a while before I realized I should pick event date from workshop
     *
     */
    public function futureEvents()
    {
        return self::where('created_at' , '>=' , Carbon::now()->toDateTimeString())
            ->get();
    }

}
