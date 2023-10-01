<?php

namespace App\Http\Controllers;

use App\Models\Diagrama;
use App\Models\Participantes;
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
        $compartir_url = url('/diagrama/' . $diagrama->identificador);
        if (auth()->user()->id === $diagrama->usuario_id) {
            return view('graficador', compact('diagrama', 'compartir_url'));
        }
        $participantes = Participantes::participaDiagrama(auth()->user()->id, $diagrama->id);
        if (!$participantes) {
            Participantes::crear([
                'usuario_id' => auth()->user()->id,
                'diagrama_id' => $diagrama->id,
            ]);
        }
        return view('graficador', compact('diagrama', 'compartir_url'));
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
