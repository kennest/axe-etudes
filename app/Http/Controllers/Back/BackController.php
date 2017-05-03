<?php
namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;

class BackController extends Controller
{

    public function index()
    {
        return view('Back.home');
    }

}

?>