<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Room extends Model
{
    use HasFactory;

    public function scopeRooms($query){
        $role_id = Auth::user()->role_id;
        $role = Role::find($role_id);
        $type_room = TypeRoom::all()->where('name','=',$role->display_name)->first();
        return $query->where('status_id','=','1')->where('type','=',$type_room->id);
    }
}
