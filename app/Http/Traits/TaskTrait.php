<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait TaskTrait{
    public function getDates(){
        return ['created_at', 'update_at', 'due_date'];
    }

    public $dueDateFormatting = true;
    public function getDueDateAttribute($value){
        if($this->dueDateFormatting){
            return Carbon::parse($value)->toFormattedDateString();
        } else {
            return $this->attributes['due_date']=$value;
        }
    }

}





