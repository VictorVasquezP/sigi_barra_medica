<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    public function insumos(){
        return $this->hasMany(ProductCommand::class, 'command_id', 'id');
    }

    public function room(){
        return $this->hasOne(Room::class,'id','room_id');
    }
}
