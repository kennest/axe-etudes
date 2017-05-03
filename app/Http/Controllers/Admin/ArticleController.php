<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 08/03/17
 * Time: 14:37
 */

namespace app\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Categorie;
use Illuminate\Support\Str;
use App\Model\Article;

class ArticleController extends Controller
{
    public function index(){
        $params=array(
            'titre'=>'titre 1',
            'slug'=>Str::random(8).'-'.Str::random(3),
            'contenu'=>'un autre contenu'
        );
        $params2=array(
            'titre'=>'titre 1',
            'slug'=>Str::random(8).'-'.Str::random(3)
        );
        $category=Categorie::create($params2);
        $article=Article::create($params);
        $article->categorie()->associate($category);
        $article->save();
        dd($article);
    }

    public function show(){
        $text="SHOW:Oulai kennest davis";
        dd($text);
    }

}