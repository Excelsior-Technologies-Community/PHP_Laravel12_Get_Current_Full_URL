<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
       public function index() 
        { 
            return view('users', [ 
                'current' => url()->current(), 
                'full' => url()->full(), 
                'previous' => url()->previous(), 
            ]); 
        }

}
