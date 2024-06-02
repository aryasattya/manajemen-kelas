<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){

        $title = 'User';
        return view('users.index', compact('title'));
    }
}
