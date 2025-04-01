<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureValidLink
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uuid = $request->route('uuid');
        $link = Link::where('uuid', $uuid)->first();

        if (! $link?->isValid()) {
            abort(403, 'Link expired or inactive');
        }

        $request->merge([
            'link' => $link,
            'user' => $link->user,
        ]);

        return $next($request);
    }
}
