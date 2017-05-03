<?php

namespace App\Http\Controllers\Back\Actions;

use App\Model\Frais;
use App\Model\Niveau;
use App\Model\Versement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FraisRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FraisController extends Controller
{
    private $fraisRepository;

    public function __construct(FraisRepository $repository)
    {
        $this->FraisRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //recuperation des frais qui on deja ete renseigner de l'utilisateur courant
        $list_frais = $this->FraisRepository->getFraisOfUserIsFilled();

        //recuperation des niveaux dont les frais n'ont pas encore ete renseigner par l'utilisateur courant
        $niveaux = $this->FraisRepository->getNiveauWithEmptyFrais();

        $frais = new Frais();
        $niveau = new Niveau();
        return view('Back.pages.AddFrais', compact('niveaux', 'list_frais', 'niveau', 'frais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Frais::$rules);
        $this->FraisRepository->store($request);
        return redirect(route('frais.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource and store versements
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $frais = Frais::findOrFail($id);

        //recuperation du niveau lié au frais a editer
        $niveau = $this->FraisRepository->getNiveauLinkedToFraisEdited($frais);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $frais = Frais::findOrFail($id);

        //recuperation du niveau lié au frais a editer
        $niveau = $frais->niveau()->get();
        $niveau=$niveau->first();

        //recuperation des frais qui on deja ete renseigner de l'utilisateur courant
        $list_frais = $this->FraisRepository->getFraisOfUserIsFilled();

        return view('Back.pages.AddFrais', compact( 'frais', 'list_frais', 'niveau'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Frais::$rules);
        $this->FraisRepository->update($request, $id);
        return redirect(route('frais.create'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->FraisRepository->destroy($id);

        return redirect(route('frais.create'))->with('operationsucceed', 'operation reussi!');
    }

    /**
     * *Show versement Form
     */
    public function createVersement($frais_id)
    {
        $frais = Frais::where('id', '=', $frais_id)->with('niveau')->first();
        //recuperation des versements du frais
        $versements = $frais->versements()->paginate(4);
        $total = $frais->versements()->sum('valeur');
        $versement = new Versement();
        return view('Back.pages.AddVersement', compact('frais', 'niveau', 'versement', 'versements', 'total'));
    }


    /**
     * *Store Versement on DB
     */

    public function storeVersement(Request $request)
    {
        $this->validate($request, Versement::$rules);
        $this->FraisRepository->storeVersement($request);
        return redirect()->back();
    }

    /**
     * Show Edit Form of versements
     */

    public function editVersement($id)
    {
        $versement = Versement::FindOrFail($id);
        $frais = $versement->frais()->first();

        //recuperation des versements sans celui qui es a editer
        $versements = $frais->versements()->where('id', '!=', $id)->paginate(4);

        $total = $frais->versements()->sum('valeur');
        //$versements = $versements->where('id', '!=', $id)->paginate(4);

        $niveau = $this->FraisRepository->getNiveauLinkedToFraisEdited($frais);
        return view('Back.pages.AddVersement', compact('frais', 'niveau', 'versement', 'versements', 'total'));
    }

    /**
     * Update Versement on niveau
     */
    public function updateVersement(Request $request)
    {
        $this->validate($request, Versement::$rules);
        $this->FraisRepository->updateVersement($request);
        return redirect()->route('versement.create', ['id' => $request->input('frais_id')]);
    }

    /**
     *
     */
    public function destroyVersement($id)
    {
        $versement = Versement::FindOrFail($id);
        $versement->delete();
        return redirect()->back()->with('success', 'Operation Réussi!');
    }

}