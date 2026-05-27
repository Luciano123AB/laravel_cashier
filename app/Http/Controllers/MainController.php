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

            echo "Logado com sucesso! <br>" . auth()->user()->name;
        }
    }
}
