<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;
    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
