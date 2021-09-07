<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Principal extends Controller
{
    //

    public function index()
    {
        $contenidos=[
            [
                "titulo"=>"Ho",
                "imagen"=>"la",
                "texto"=>"0",
                "color"=>"bg-white",
                "color-texto"=>"text-black",
            ],
            [
                "titulo"=>"como",
                "imagen"=>"es",
                "texto"=>"tas",
                "color"=>"bg-info",
                "color-texto"=>"text-white",
            ],
        ];

        return view('vista',compact('contenidos'));
    }
}
