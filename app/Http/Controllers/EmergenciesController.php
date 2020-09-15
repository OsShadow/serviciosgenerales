<?php

namespace App\Http\Controllers;
use App\Emergencies;
use Carbon\Carbon;

use Illuminate\Http\Request;

class EmergenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $ereports = Emergencies::all();
        return view('emergencias.index', ['ereports' => $ereports]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = Carbon::parse(Carbon::now())->format('Y-m-d');
        return view('emergencias.create',['date'=>$date]);    
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emergencie = new Emergencies();

        $date = Carbon::parse($request->date)->format('Y-m-d');
        $emergencie->date = $request->date;
        $emergencie->description = $request->description;
        $emergencie->observations = $request->observations;
        $emergencie->user_report = auth()->id();
        $emergencie->user_area = auth()->id();

        $emergencie->save();

        return redirect('emergencias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('emergencias.show',['ereport'=> Emergencies::findOrFail($id)]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('emergencias.edit',['ereport'=> Emergencies::findOrFail($id)]);   
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
        $emergencie = Emergencies::findOrFail($id);

        $emergencie->date = $request->date;
        $emergencie->observations = $request->observations;
        $emergencie->description = $request->description;
        $emergencie->save();

        return redirect('emergencias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emergencie = Emergencies::findOrFail($id);

        $emergencie->delete();

        return redirect('emergencias');
    }
}
