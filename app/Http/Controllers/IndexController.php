<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Tests @see IndexControllerTest
 */
class IndexController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }
}
