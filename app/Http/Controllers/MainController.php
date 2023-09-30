<?php

namespace App\Http\Controllers;

use App\Models\Diagrama;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function dashboard()
    {
        $diagramas = Diagrama::obtenerPorUsuario(auth()->user()->id);
        return view('dashboard', compact('diagramas'));
    }

    public function crear_diagrama()
    {
    }

    public function guardar_diagrama(Request $request)
    {
        $nombre = $request->input('nombre');
        $markdown = 'sequenceDiagram\n';
        $usuario_id = auth()->user()->id;
        $diagrama = Diagrama::crear(compact('nombre', 'markdown', 'usuario_id'));
        return redirect()->route('show_diagrama', $diagrama->identificador);
    }

    public function diagrama($id)
    {
        $diagrama = Diagrama::obtenerPorIdentificador($id);
        return view('graficador', compact('diagrama'));
    }

    public function eliminar_diagrama($id)
    {
    }

    public function actualizar_diagrama(Request $request, $id)
    {
        $markdown = $request->input('markdown');
        $diagrama = Diagrama::actualizar($id, $markdown);
        return $diagrama;
    }
}
