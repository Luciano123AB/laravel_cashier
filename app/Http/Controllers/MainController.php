<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

        $prices = [
            "monthly" => Crypt::encryptString(env("STRIPE_PRODUCT_ID") . "|" . env("STRIPE_MONTHLY_PRICE_ID")),
            "yearly" => Crypt::encryptString(env("STRIPE_PRODUCT_ID") . "|" . env("STRIPE_YEARLY_PRICE_ID")),
            "longest" => Crypt::encryptString(env("STRIPE_PRODUCT_ID") . "|" . env("STRIPE_LONGEST_PRICE_ID"))
        ];

        return view("plans", compact("prices"));
    }

    public function planSelected($id) {
        
        //Check if $id is valid:
        $plan = Crypt::decryptString($id);

        if (!$plan) {
            return redirect()->route("plans");
        }

        $data = explode("|", $plan);

        echo "Product ID: " . $data[0] . "<br>";
        echo "Price ID: " . $data[1] . "<br>";
    }
}
