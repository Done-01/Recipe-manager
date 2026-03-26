<?php

use Illuminate\Support\Facades\Route;
use App\Models\Recipe;
use App\Models\Organisation;
use App\Models\User;

// login and logout
Route::post("/login", [
    \App\Http\Controllers\LoginController::class,
    "authenticate",
])->name("login");

Route::get("/logout", [
    \App\Http\Controllers\LoginController::class,
    "confirmLogout",
])->name("logout.confirm");

Route::post("/logout", [
    \App\Http\Controllers\LoginController::class,
    "logout",
])->name("logout");

Route::get("/", function () {
    return view("welcome");
});

Route::get("/onboarding", function () {
    return view("onboarding");
});

// organisation routes wrapped in auth middleware
Route::middleware(["auth"])->group(function () {
    Route::Resource(
        "organisations",
        \App\Http\Controllers\OrganisationController::class,
    );
    Route::post("/organisations/select", [
        \App\Http\Controllers\OrganisationController::class,
        "select",
    ])->name("organisations.select");
});

Route::middleware(["auth", "setup.org"])->group(function () {
    Route::get("/dashboard", function () {
        return view("dashboard");
    });
    Route::Resource("recipes", \App\Http\Controllers\RecipeController::class);
});

Route::get("/login", function () {
    return view("authenticate.login");
});
