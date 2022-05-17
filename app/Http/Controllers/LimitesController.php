<?php

namespace App\Http\Controllers;

use App\Limite;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Model\Status;
use Flash;

class LimitesController extends Controller
{
    
    public function index(Limite $limites)
    {

        return view('limites.index', ['limites' => $limites->all()]);
    }

    public function create()
    {
        $status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");

        return view('limites.create')->with(compact('status'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $limite= Limite::create($data);
        if($request->status == 1){
              Limite::where('id','<>',$limite->id)->update([
                    'status'=>2,
                ]);
        }

        Flash::success("Registro Agregado Correctamente");

        return redirect()->route('limites.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Limite  $limite
     * @return \Illuminate\Http\Response
     */
    public function show(Limite $limite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Limite  $limite
     * @return \Illuminate\Http\Response
     */
    public function edit(Limite $limite)
    {
        $status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");

        return view('limites.edit', compact('limite','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Limite  $limite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Limite $limite)
    {
        $data = $request->except('_token');
        $limite->update($data);
        if($request->status == 1){
              Limite::where('id','<>',$request->id)->update([
                    'status'=>2,
                ]);
        }

        Flash::success("Registro Actulizado Correctamente");

        return redirect()->route('limites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Limite  $limite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Limite $limite)
    {
        //
    }
}
