<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use Illuminate\Http\Request;

class BackEndController extends Controller
{
    public function Dashboard(Request $request){
        // dd($request->all());
        $users = User::where('role_id',2)->latest()->take(5)->get();
        
        return view('admin.dashboard',compact('users'));
    }
}