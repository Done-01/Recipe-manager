<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Laravel\Prompts\autocomplete;

class OrganisationController extends Controller
{
    public function index()
    {
        $organisations = auth()->user()->organisations;
        return view("organisations.index", compact("organisations"));
    }

    public function show($id)
    {
        $organisation = Organisation::find(session("active_organisation"));
        if (!$organisation) {
            abort(404);
        }
        return view("organisations.show", compact("organisation"));
    }

    public function create()
    {
        return view("organisations.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
        ]);

        $userId = auth()->id();

        // The 1st array: Data for the 'organisations' table
        // The 2nd array: Data for the 'organisation_users' pivot table
        $organisation = auth()
            ->user()
            ->organisations()
            ->create(
                [
                    "organisation_name" => $validated["name"],
                    "created_by" => $userId,
                ],
                [
                    "created_by" => $userId,
                    "role" => "admin", // or whatever default role you use
                ],
            );

        session(["active_organisation" => $organisation->id]);

        return redirect()->route("organisations.index");
    }

    public function select(Request $request)
    {
        if (!auth()->user()) {
            abort(404);
        }
        session([
            "active_organisation" => $request->input("organisation"),
        ]);

        return redirect("/dashboard");
    }
}
