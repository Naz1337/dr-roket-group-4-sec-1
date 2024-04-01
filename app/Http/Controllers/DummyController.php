<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DummyController extends Controller
{
    public function show()
    {
        return Inertia::render('Test', [
            'test' => 'Hello world'
        ]);
    }
}
