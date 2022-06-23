<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{


    public function getChildren()
    {
        $children = [];

        $children = MenuItem::where('parent_id', $this->id)->get();

        foreach ($children as $key => $value) {
            $ch[$key] = $value;
            $ch[$key]['children'] = MenuItem::where('parent_id', $value->id)->get();
        }

        return $children;
    }




}
