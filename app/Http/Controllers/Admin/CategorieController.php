<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 08/03/17
 * Time: 14:38
 */

namespace app\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class CategorieController extends Controller
{
    public function index(){
        $text="Categorie:Oulai kennest davis";
        dd($text);
    }

    public function show(){
        $text="SHOW:Categorie:Oulai kennest davis";
        dd($text);
    }

}