<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Vehicles;
use App\VehiclesTravel;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleCompleteReportRequest;
use DB;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vehiclesunfinished =DB::table('vehicles')->where('finished','=','0')->leftJoin('vehicles_travel', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();
        $vehiclesfinished = DB::table('vehicles')->where('finished','=','1')->leftJoin('vehicles_travel', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();

     
        return view('vehiculos.index', ['vehiclesfinished' =>$vehiclesfinished,'vehiclesunfinished' =>$vehiclesunfinished]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $date = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');
        $hour = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('H:i');

        $vehicles = Vehicles::all()->where('in_use','=','0');

    

        return view('vehiculos.create',['date'=>$date,'hour'=>$hour,'vehicles' => $vehicles]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleStoreRequest $request)
    {
        
        $vehiclereport = new VehiclesTravel();

        $date = Carbon::parse($request->date_start)->format('Y-m-d');
        $hour = Carbon::parse($request->hour_start)->format('H:i');

        $vehiclereport->date_start = $date;
        $vehiclereport->hour_start = $hour;
        $vehiclereport->km_start = $request->km_start;
        $vehiclereport->driver = $request->driver;
        $vehiclereport->id_car = $request->vehicle;
        $vehiclereport->id_user =  auth()->id();
        $vehiclereport->finished = 0;

        $vehiclereport->save();
        return redirect('vehiculos');

    }

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
        //
    }

    public function finaledit($id)
    {
        $vehiclereport = VehiclesTravel::findOrFail($id);
        $vehiclereport->date_start = Carbon::parse($vehiclereport->date_start)->format('Y-m-d');
        $vehiclereport->hour_start = Carbon::parse($vehiclereport->hour_start)->format('H:i');

        $date = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');
        $hour = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('H:i');

        $vehicle =DB::table('vehicles_travel')->where('vehicles_travel.id','=', $id)->leftJoin('vehicles', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();

        return view('vehiculos/finaledit',['vehiclereport'=>$vehiclereport, 'vehicle'=>$vehicle, 'date' => $date, 'hour'=>$hour]);

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
        

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function completereport(VehicleCompleteReportRequest $request, $id)
    {
        
        $vehiclereport = VehiclesTravel::findOrFail($id);

        $vehiclereport->date_start = $request->date_start;
        $vehiclereport->date_end= $request->date_end;
        $vehiclereport->hour_start = $request->hour_start;
        $vehiclereport->hour_end = $request->hour_end;
        $vehiclereport->driver = $request->driver;
        $vehiclereport->gas_recharge = $request->gas_recharge;
        $vehiclereport->km_start = $request->km_start;
        $vehiclereport->km_end = $request->km_end;
        $vehiclereport->finished = 1;
        $vehiclereport->save();

        return redirect('vehiculos');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehiclereport = VehiclesTravel::findOrFail($id);

        $vehiclereport->delete();

        return redirect('vehiculos');
    }
}
