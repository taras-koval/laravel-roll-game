<?php

namespace App\Http\Controllers;

use App\Actions\CreateLinkAction;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;

/**
 * Tests @see LinkControllerTest
 */
class LinkController extends Controller
{
    public function regenerate(string $uuid, CreateLinkAction $createLinkAction): RedirectResponse
    {
        $oldLink = Link::where('uuid', $uuid)->firstOrFail();

        $newLink = $createLinkAction($oldLink->user);

        return redirect()->route('index')
            ->with('link', route('game.show', $newLink->uuid));
    }

    public function deactivate(string $uuid)
    {
        $link = Link::where('uuid', $uuid)->firstOrFail();

        $link->update(['active' => false]);

        return redirect()->route('index')
            ->with('message', 'Link has been deactivated.');
    }
}
