<?php

namespace App\Http\Controllers\Back\Actions;


use App\Model\Dossier;
use App\Repositories\DossierRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DossierController extends Controller
{
 private $dossierRepository;
    public function  __construct(DossierRepository $repository)
    {
        $this->dossierRepository=$repository;
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
    public function create()
    {
        $dossier=new Dossier();
        $dossiers=Auth('etablissements')->user()->dossiers()->get();
        return view('Back.pages.AddDossier',compact('dossier','dossiers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,Dossier::$rules);
        $this->dossierRepository->store($request);
       return redirect()->back(302);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dossier=Dossier::FindOrFail($id);
        //On recupere les dossiers sans le dossier a editer
        $dossiers=Auth('etablissements')->user()->dossiers()->get();
        $dossiers=$dossiers->where('id','!=',$id);
        return view('Back.pages.AddDossier',compact('dossier','dossiers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dossier=Dossier::FindOrFail($id);
        $this->validate($request,Dossier::$rules);
        $this->dossierRepository->update($request,$dossier);
        return redirect(route('dossier.create'))->with('success','Operation réussi!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dossier=Dossier::FindOrFail($id);
        $dossier->delete();
        return redirect(route('dossier.create'))->with('success','Operation réussi!');
    }
}
