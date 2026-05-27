<?php

use App\Http\Controllers\MainController;
use App\Http\Middleware\hasSubscription;
use App\Http\Middleware\isGuest;
use App\Http\Middleware\isUser;
use App\Http\Middleware\noSubscription;
use Illuminate\Support\Facades\Route;

Route::middleware([isGuest::class])->group(function () {
    Route::get("/login", [MainController::class, "loginPage"])->name("login");
    Route::get("/login/{id}", [MainController::class, "loginSubmit"])->name("login.submit");
});

Route::middleware([isUser::class])->group(function () {
    Route::redirect("/", "/login");
    Route::get("/logout", [MainController::class, "logout"])->name("logout"); 

    Route::middleware([noSubscription::class])->group(function () {
        Route::get("/plans", [MainController::class, "plans"])->name("plans");
        Route::get("/plan_selected/{id}", [MainController::class, "planSelected"])->name("plan.selected");
    });
        
    Route::middleware([hasSubscription::class])->group(function () {
        Route::get("/subscription/success", [MainController::class, "subscriptionSuccess"])->name("subscription.success");
        Route::get("/dashboard", [MainController::class, "dashboard"])->name("dashboard");
        Route::get("/invoice/{id}", [MainController::class, "invoiceDownload"])->name("invoice.download");
    });
});