<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('/', compact('widget'));
    }
}
