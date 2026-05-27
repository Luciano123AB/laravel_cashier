<?php

use App\Http\Controllers\MainController;
use App\Http\Middleware\isGuest;
use App\Http\Middleware\isUser;
use Illuminate\Support\Facades\Route;

Route::middleware([isGuest::class])->group(function () {
    Route::get("/login", [MainController::class, "loginPage"])->name("login");
    Route::get("/login/{id}", [MainController::class, "loginSubmit"])->name("login.submit");
});

Route::middleware([isUser::class])->group(function () {
    Route::redirect("/", "/login");
    Route::get("/logout", [MainController::class, "logout"])->name("logout");
    Route::get("/plans", [MainController::class, "plans"])->name("plans");
    Route::get("/plan_selected/{id}", [MainController::class, "planSelected"])->name("plan.selected");
});