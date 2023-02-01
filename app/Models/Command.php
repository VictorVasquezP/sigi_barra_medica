<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Command extends Model
{
    use HasFactory;

    public function scopeCommands($query){
        $role_id = Auth::user()->role_id;
        $role = Role::find($role_id);
        if($role->id > 2){
            return $query->where('type','=',$role->display_name);
        }else{
            return $query;
        }
    }

    public function insumos(){
        return $this->hasMany(ProductCommand::class, 'command_id', 'id');
    }

    public function room(){
        return $this->hasOne(Room::class,'id','room_id');
    }
}
