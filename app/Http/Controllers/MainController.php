<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function loginPage() {
        return view("login");
    }

    public function loginSubmit($id) {
        //Direct login:

        $user = User::findOrFail($id);

        if ($user) {
            auth()->login($user);

            return redirect()->route("plans");
        }
    }

    public function logout() {
        auth()->logout();

        return redirect()->route("login");
    }

    public function plans() {
        return view("plans");
    }
}
