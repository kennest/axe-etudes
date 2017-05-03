<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 11/04/17
 * Time: 09:24
 */

namespace app\Http\Controllers\Back\Actions;


use App\Http\Controllers\Controller;
use App\Model\Etablissement;
use App\Model\Systeme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemeController extends Controller
{
    public function index()
    {
        $systemes = Auth('etablissements')->user()->systemes()->get();

        return view('Back.List.Systeme', compact('systemes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $systeme = new Systeme();
        $systemes = Systeme::all();
        return view('Back.pages.AddSysteme', compact('systeme', 'systemes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::guard('etablissements')->user();
        $user->systemes()->syncWithoutDetaching($request->get('systemes'));
        return redirect(route('systeme.index'));
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $systeme=Systeme::FindOrfail($id);
       Auth('etablissements')->user()->systemes()->detach($systeme->id);
       return redirect(route('systeme.index'));
    }
}