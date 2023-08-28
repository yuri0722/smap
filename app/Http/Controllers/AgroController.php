<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgroController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
        return view('agro.index' );
    }

}
