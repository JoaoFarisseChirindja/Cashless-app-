<?php

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('actors.staff.dashborad');
    }
    public function profile()
    {
        $user = Auth::user();
        return response()->json(['user' => $user], 200);
    }
}
