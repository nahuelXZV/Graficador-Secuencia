<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;

class FirebaseController extends Controller
{
    public $firebase;
    public $database;
    public $nodeName;

    public function __construct()
    {
        $dir = env('APP_ENV') !== 'production' ? __DIR__ . '/FirebaseKey.json' : '/app/FirebaseKey.json';
        $this->firebase = (new Factory)
            ->withServiceAccount($dir)
            ->withDatabaseUri('https://graficador-295cc-default-rtdb.firebaseio.com/');

        $this->database = $this->firebase->createDatabase(); // Método actualizado para crear una instancia de Database
        $this->nodeName = 'graficas';
    }

    public function addData($data)
    {
        try {
            $tupla = $this->database->getReference($this->nodeName)->push($data);
            return $tupla->getKey();
        } catch (FirebaseException $e) {
            // Maneja la excepción de Firebase aquí
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function editData($data, $id)
    {
        try {
            // Actualiza el texto en el nodo específico
            $this->database->getReference($this->nodeName . '/' . $id)->set($data);
            return ['success' => true];
        } catch (FirebaseException $e) {
            // Maneja la excepción de Firebase aquí
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
