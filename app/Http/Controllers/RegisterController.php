<?php

namespace App\Http\Controllers;

use App\Actions\CreateLinkAction;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

/**
 * Tests @see RegisterControllerTest
 */
class RegisterController extends Controller
{
    public function store(RegisterRequest $request, CreateLinkAction $createLinkAction): RedirectResponse
    {
        $user = User::create([
            'username' => $request->validated('username'),
            'phonenumber' => $request->validated('phonenumber'),
        ]);

        $link = $createLinkAction($user);

        return redirect()->back()->with('link', $link);
    }
}
