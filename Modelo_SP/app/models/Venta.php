<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'ventas';
    public $incrementing = true;
    public $timestamps = false;

    const DELETED_AT = 'fecha_baja';
    const CREATED_AT = 'fecha_venta';

    protected $fillable = [
        'id_hortaliza', 'id_empleado', 'cantidad', 'foto', 'cliente'
    ];

}