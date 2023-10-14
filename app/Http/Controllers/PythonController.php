<?php

namespace App\Http\Controllers;

use App\Models\Diagrama;
use Illuminate\Http\Request;

class PhpController extends Controller
{
    public $openIAController;

    public function __construct()
    {
        $this->openIAController = new OpenIAController();
    }

    public function generar(Request $request, $id)
    {
        $diagrama = Diagrama::obtener($id);
        $message = 'Necesito que me generes el codigo en php para el siguiente diagrama de secuencia, toma en cuenta todo lo que esta en el texto, solo dame el codigo ningun comentario: ' . $diagrama->markdown;
        $response = $this->openIAController->sendMenssage($message);
        $code = $response['choices'][0]['message']['content'];
        $nameFile = $diagrama->nombre . '.php';
        return response($code)
            ->header('Content-Type', 'text/plain') // Tipo de contenido del archivo
            ->header('Content-Disposition', 'attachment; filename="' . $nameFile . '"'); // Nombre del archivo para la descarga
    }
}
