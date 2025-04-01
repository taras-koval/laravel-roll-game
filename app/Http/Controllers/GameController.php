<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Tests @see GameControllerTest
 */
class GameController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user;
        $link = $request->link;

        return view('page-a', compact('user', 'link'));
    }
}
