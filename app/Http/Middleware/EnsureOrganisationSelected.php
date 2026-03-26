<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureOrganisationSelected
{
    public function handle(Request $request, Closure $next)
    {
        // If already set, keep moving
        if (session()->has("active_organisation")) {
            return $next($request);
        }

        $user = auth()->user();
        $count = $user->organisations()->count();

        if ($count === 0) {
            return redirect()->route("organisations.create");
        }

        if ($count === 1) {
            $org = $user->organisations()->first();
            session(["active_organisation" => $org->id]);
            return $next($request);
        }

        // More than 1? Force them to pick.
        return redirect()->route("organisations.index");
    }
}
