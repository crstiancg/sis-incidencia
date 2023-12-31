<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $casts = [
        'updated_at' =>  'datetime',
        'created_at' =>  'datetime',
    ];
    public function etiqueta()
    {
        return $this->belongsTo(Etiqueta::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resueltos()
    {
        return $this->hasMany(Resuelto::class);
    }

    public static $estados = ['Incidencia','Solucionado','Pendiente','Suspendido'];
    public static $niveles = ['Urgente','No urgente'];
}
