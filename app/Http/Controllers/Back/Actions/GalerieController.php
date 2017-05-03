<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 04/04/17
 * Time: 09:10
 */

namespace App\Http\Controllers\Back\Actions;



use App\Http\Controllers\Controller;
use App\Model\Galerie;
use App\Model\Photo;
use App\Repositories\GalerieRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GalerieController extends Controller
{
    private $galerieRepository;

    public function __construct(GalerieRepository $repository)
    {
        $this->galerieRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPhoto()
    {
        $photo = new Photo();
        $galeries = Auth('etablissements')->user()->galeries()->with('photos')->paginate(1);
        $list_galeries = Auth('etablissements')->user()->galeries()->with('photos')->get();
        return view('Back.pages.AddPhoto', compact('photo', 'galeries', 'photos','list_galeries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storePhoto(Request $request)
    {
        $this->validate($request,Photo::$rules);
        $this->galerieRepository->storePhoto($request);
        return redirect()->back();
    }


    public function editPhoto($id)
    {
        $photo = Photo::FindOrfail($id);
        $galeries = Auth('etablissements')->user()->galeries()->with('photos')->paginate(1);
        $list_galeries = Auth('etablissements')->user()->galeries()->with('photos')->get();
        return view('Back.pages.AddPhoto', compact('photo', 'galeries', 'photos','list_galeries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(Request $request, $id)
    {
        $this->validate($request,Photo::$rules);
        $this->galerieRepository->updatePhoto($request, $id);
        return redirect(route('galerie.createPhoto'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPhoto($id)
    {
        $this->galerieRepository->destroyPhoto($id);
        return redirect(route('galerie.createPhoto'))->with('success','Operation Reussi!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $galerie=new Galerie();
        $galeries=Auth('etablissements')->user()->galeries()->paginate(8);
        return view('Back.pages.AddGalerie',compact('galerie','galeries'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,Galerie::$rules);
        $this->galerieRepository->create($request);
        return redirect(route('galerie.create'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,Galerie::$rules);
        $this->galerieRepository->update($request,$id);
        return redirect(route('galerie.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $galerie=Galerie::FindOrFail($id);
        $galeries=Auth('etablissements')->user()->galeries()->paginate(8);
        return view('Back.pages.AddGalerie',compact('galerie','galeries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $galerie=Galerie::FindOrFail($id);
       if($galerie->delete()){
           foreach ($galerie->photos()->get() as $photo){
               $this->galerieRepository->destroyPhoto($photo->id);
           }
       }
        return redirect(route('galerie.create'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * LISTE LES VIDEOS DE L'ETABLISSEMENT
     */
    public function listVideos(){
        $galeries=Auth('etablissements')->user()->galeries()->with('videos')->get();
        return view('Back.pages.AddVideos',compact('galeries'));
    }
}