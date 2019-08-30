<?php

namespace App\Models;

use App\Http\Traits\TaskTrait;
use App\Http\Traits\TimestampsTrait;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use TimestampsTrait;
    use TaskTrait;

    public function getDates(){
        return ['created_at','update_at'];
    }
    
    // define table
    protected $table = 'tasks';
    protected $fillable = ['archive'];

    //
}
