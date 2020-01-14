<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index()
    {
        $user = auth()->user();
        return view('user.profile.index', compact('user'));
    }

    public function edit()
    {
        return "edit profile";
    }
}
