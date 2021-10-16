<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use DB;


class Puesto_Laboral extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function puesto_usuario(){
		return DB::table('puesto__laborals')
			->join('users','users.id','=','puesto__laborals.user_id')
			->select('users.name','users.id', 'puesto__laborals.titulo','puesto__laborals.tiempo')
            ->where('tipo', '0')
			;
	}

}
