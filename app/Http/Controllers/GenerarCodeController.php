<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerarCodeController extends Controller
{

    public function __construct()
    {
    }

    public function estructurar($markdown)
    {
        $estructura = explode("\n", $markdown);
        $estructura = array_filter($estructura, function ($value) {
            return $value !== '';
        });
        $estructura = array_map(function ($value) {
            return trim($value);
        }, $estructura);
        $estructura = array_values($estructura);
        return $estructura;
    }

    public function crear_diagrama()
    {
    }
}
