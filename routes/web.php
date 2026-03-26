<?php

use Illuminate\Support\Facades\Route;
use App\Models\Recipe;
use App\Models\Organisation;
use App\Models\User;

// login and logout
Route::get("/login", [
    \App\Http\Controllers\LoginController::class,
    "showLoginForm",
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
    if (auth()->check()) {
        return redirect("/dashboard");
    }
    return view("welcome");
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

Route::post("/login", [
    \App\Http\Controllers\LoginController::class,
    "authenticate",
]);

Route::get("/register", [
    \App\Http\Controllers\RegisterController::class,
    "create",
])->name("register");
Route::post("/register", [
    \App\Http\Controllers\RegisterController::class,
    "store",
]);
