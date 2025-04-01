<?php

namespace App\Http\Controllers;

use App\Actions\RollAction;
use App\Http\Resources\RollResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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

    public function roll(Request $request, RollAction $rollAction): RollResource
    {
        $result = $rollAction($request->link);

        return RollResource::make($result);
    }

    public function history(Request $request): AnonymousResourceCollection
    {
        $rolls = $request->link->rolls()->latest()->take(3)->get();

        return RollResource::collection($rolls);
    }
}
