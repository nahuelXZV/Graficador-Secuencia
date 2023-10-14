<?php

namespace App\Http\Controllers;

use App\Models\Diagrama;
use Illuminate\Http\Request;

class JavaController extends Controller
{
    public $generarCodeController;
    public function __construct()
    {
        $this->generarCodeController = new GenerarCodeController();
    }

    public function generar(Request $request, $id)
    {
        $diagrama = Diagrama::obtener($id);
        $estructura = $this->generarCodeController->estructurar($diagrama->markdown);
        dd($estructura);
    }

    public function crear_diagrama()
    {
    }
}
