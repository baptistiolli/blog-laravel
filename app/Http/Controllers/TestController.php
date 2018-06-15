<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index($nome)
    {
        return view('test/index', ['nome' => $nome]);
    }

    public function notas()
    {
    	$notas = array(
    		0 => 'Anotações 1',
    		1 => 'Anotações 2',
    		2 => 'Anotações 3',
    		3 => 'Anotações 4',
    		4 => 'Anotações 5',
    	);

    	return view('test.notas', compact('notas'));
    }
}
