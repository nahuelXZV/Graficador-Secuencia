<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagrama extends Model
{
    use HasFactory;
    protected $fillable = [
        'identificador',
        'nombre',
        'markdown',
        'usuario_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }

    // funciones
    static function crear($array)
    {
        $nombre = $array['nombre'];
        $markdown = $array['markdown'];
        $usuario_id = $array['usuario_id'];
        $identificador = $array['identificador'];
        $diagrama = new Diagrama();
        $diagrama->identificador = $identificador;
        $diagrama->nombre = $nombre;
        $diagrama->markdown = $markdown;
        $diagrama->usuario_id = $usuario_id;
        $diagrama->save();
        return $diagrama;
    }

    static function editar($array)
    {
        $id = $array['id'];
        $nombre = $array['nombre'];
        $markdown = $array['markdown'];
        $diagrama = Diagrama::find($id);
        $diagrama->nombre = $nombre;
        $diagrama->markdown = $markdown;
        $diagrama->save();
        return $diagrama;
    }

    static function eliminar($id)
    {
        $diagrama = Diagrama::find($id);
        $diagrama->delete();
        return $diagrama;
    }

    static function obtener($id)
    {
        $diagrama = Diagrama::find($id);
        return $diagrama;
    }

    static function obtenerPorIdentificador($identificador)
    {
        $diagrama = Diagrama::where('identificador', $identificador)->first();
        return $diagrama;
    }

    static function obtenerPorUsuario($usuario_id)
    {
        $diagramas = Diagrama::where('usuario_id', $usuario_id)
            ->orderBy('updated_at', 'desc')
            ->get();
        return $diagramas;
    }

    static function obtenerPorParticipante($usuario_id)
    {
        $diagramas = Diagrama::whereHas('participantes', function ($query) use ($usuario_id) {
            $query->where('usuario_id', $usuario_id);
        })->get();
        return $diagramas;
    }


    static function actualizar($id, $markdown)
    {
        $diagrama = Diagrama::find($id);
        $diagrama->markdown = $markdown;
        $diagrama->save();
        return $diagrama;
    }
}
