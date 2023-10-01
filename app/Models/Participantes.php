<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario_id',
        'diagrama_id',
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function diagrama()
    {
        return $this->belongsTo(Diagrama::class);
    }

    // funciones
    static function crear($array)
    {
        $usuario_id = $array['usuario_id'];
        $diagrama_id = $array['diagrama_id'];
        $participante = new Participantes();
        $participante->usuario_id = $usuario_id;
        $participante->diagrama_id = $diagrama_id;
        $participante->save();
        return $participante;
    }

    static function participaDiagrama($usuario_id, $diagrama_id)
    {
        $participante = Participantes::where('usuario_id', $usuario_id)->where('diagrama_id', $diagrama_id)->first();
        return $participante;
    }

    static function eliminar($id)
    {
        $participante = Participantes::find($id);
        $participante->delete();
        return $participante;
    }
}
