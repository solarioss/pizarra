<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuadro extends Model
{
    
    use HasFactory;
    protected $table='cuadro';
    protected $fillable=[ 'sesion','x','y','nombre','tipo','padre','hijo1','hijo2','hijo3','codificacion','instruccion'];
 
}