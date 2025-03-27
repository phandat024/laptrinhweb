<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    //
    public function show_Login(){
        return view("login");
    }

    public function show_List(){
        return view("list");
    }

    public function show_Register(){
        return view("register");
    }

    public function show_Update(){
        return view("update");
    }

    public function show_View(){
        return view("view");
    }
}
