<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureOrganisationSelected
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (session()->has("active_organisation")) {
            // Re-validate membership on every request, not just first time
            $orgId = session("active_organisation");
            $isMember = $user
                ->organisations()
                ->where("organisation_id", $orgId)
                ->exists();

            if (!$isMember) {
                session()->forget("active_organisation");
                return redirect()
                    ->route("organisations.index")
                    ->with("error", "Organisation access denied.");
            }

            return $next($request);
        }

        $count = $user->organisations()->count();

        if ($count === 0) {
            return redirect()->route("organisations.create");
        }

        if ($count === 1) {
            $org = $user->organisations()->first();
            session(["active_organisation" => $org->id]);
            return $next($request);
        }

        return redirect()
            ->route("organisations.index")
            ->with("message", "Please select an organisation to continue.");
    }
}
