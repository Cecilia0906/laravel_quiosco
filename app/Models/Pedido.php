<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Producto;

class Pedido extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
       

    }

    public function productos(){
        return $this->belongsToMany(Producto::class,'pedido_productos')->withPivot('cantidad');
                     

    }

}
