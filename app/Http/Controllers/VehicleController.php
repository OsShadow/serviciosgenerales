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
    public function index(Request $request)
    {

        $finalizados = false;
        
        $DateIni = $request->get('DateIni');
        $DateEnd = $request->get('DateEnd');

        $vehiclesunfinished =DB::table('vehicles')->where('finished','=','0')->leftJoin('vehicles_travel', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();
     
        if($DateIni == '' || $DateEnd == ''){

            $DateIni = '2021-01-01';
            $DateEnd = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');

       return view('vehiculos.index', ['vehiclesunfinished' =>$vehiclesunfinished , 'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'finalizados' => $finalizados ]);
    

    }else{
        $seleccion = true;  
        $DateIni = $request->get('DateIni');
            $DateEnd = $request->get('DateEnd');
            
            $vehiclesunfinished = DB::table('vehicles')->where('finished','=','1')
            ->leftJoin('vehicles_travel', 'vehicles_travel.id_car', '=', 'vehicles.id')
            ->where('finished','=','0')
            ->whereBetween('vehicles_travel.date_start',[$DateIni, $DateEnd])
            ->get();
        
            return view('vehiculos.index', ['vehiclesunfinished' =>$vehiclesunfinished , 'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'seleccion' => $seleccion, 'finalizados' => $finalizados]);
        
    }
     
 }

 /**
  * Vista vehiculos finalizados
  */

 public function finalizados(Request $request)
 {
     $finalizados = true;

     $DateIni = $request->get('DateIni');
     $DateEnd = $request->get('DateEnd');

   
     if($DateIni == '' || $DateEnd == ''){

         $DateIni = '2021-01-01';
         $DateEnd = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');

     $vehiclesfinished = DB::table('vehicles')->where('finished','=','1')->leftJoin('vehicles_travel', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();
     return view('vehiculos.index', ['vehiclesfinished' =>$vehiclesfinished , 'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'finalizados' => $finalizados  ]);
 

 } else {

     $seleccion = true;  
     $DateIni = $request->get('DateIni');
         $DateEnd = $request->get('DateEnd');
         
         $vehiclesfinished = DB::table('vehicles')->where('finished','=','1')
         ->leftJoin('vehicles_travel', 'vehicles_travel.id_car', '=', 'vehicles.id')
         ->whereBetween('vehicles_travel.date_start',[$DateIni, $DateEnd])
         ->get();
     
         return view('vehiculos.index', ['vehiclesfinished' =>$vehiclesfinished, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'seleccion' => $seleccion, 'finalizados' => $finalizados ]);
          
 }
  
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

        //Marcar vehiculo en uso
        Vehicles::where('id', $request->vehicle)
        ->update(['in_use' => 1]);

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
        $vehiclereport = VehiclesTravel::findOrFail($id);
        $vehiclereport->date_start = Carbon::parse($vehiclereport->date_start)->format('Y-m-d');
        $vehiclereport->hour_start = Carbon::parse($vehiclereport->hour_start)->format('H:i');

        $vehicle =DB::table('vehicles_travel')->where('vehicles_travel.id','=', $id)->leftJoin('vehicles', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();

        return view('vehiculos/edit',['vehiclereport'=>$vehiclereport, 'vehicle'=>$vehicle]);
    }

    public function finaledit($id)
    {
        $vehiclereport = VehiclesTravel::findOrFail($id);
        $vehiclereport->date_start = Carbon::parse($vehiclereport->date_start)->format('Y-m-d');
        $vehiclereport->hour_start = Carbon::parse($vehiclereport->hour_start)->format('H:i');

        $date = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');
        $hour = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('H:i');

        $vehicle =DB::table('vehicles_travel')->where('vehicles_travel.id','=', $id)->leftJoin('vehicles', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();

        return view('vehiculos/finaledit',['vehiclereport'=>$vehiclereport, 'vehicle'=>$vehicle[0], 'date' => $date, 'hour'=>$hour]);

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
        $vehiclereport = VehiclesTravel::findOrFail($id);

        $vehiclereport->date_start = $request->date_start;
        $vehiclereport->date_end= $request->date_end;
        $vehiclereport->hour_start = $request->hour_start;
        $vehiclereport->hour_end = $request->hour_end;
        $vehiclereport->driver = $request->driver;
        $vehiclereport->gas_recharge = $request->gas_recharge;
        $vehiclereport->km_start = $request->km_start;
        $vehiclereport->km_end = $request->km_end;
        $vehiclereport->observations = $request->observations;
        $vehiclereport->finished = 1;
        $vehiclereport->save();

        return redirect('vehiculos');

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

            //Desmarcar vehiculo en uso
            Vehicles::where('id', $request->vehicle)
            ->update(['in_use' => 0]);

        $vehiclereport->date_start = $request->date_start;
        $vehiclereport->date_end= $request->date_end;
        $vehiclereport->hour_start = $request->hour_start;
        $vehiclereport->hour_end = $request->hour_end;
        $vehiclereport->driver = $request->driver;
        $vehiclereport->gas_recharge = $request->gas_recharge;
        $vehiclereport->km_start = $request->km_start;
        $vehiclereport->km_end = $request->km_end;
        $vehiclereport->observations = $request->observations;
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

     /**
     * PDF
     */

    public function pdf($id){
    
            $vehiclereport = VehiclesTravel::findOrFail($id);
        $vehiclereport->date_start = Carbon::parse($vehiclereport->date_start)->format('Y-m-d');
        $vehiclereport->hour_start = Carbon::parse($vehiclereport->hour_start)->format('H:i');

        $vehicle =DB::table('vehicles_travel')->where('vehicles_travel.id','=', $id)->leftJoin('vehicles', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();
        $vehicle= $vehicle[0];
        $pdf = \PDF::loadView('vehiculos/pdf', compact('vehiclereport','vehicle'));

        // $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('vehicleReport  ');
    }

    /**
     * PDF General
     */

    public function pdfgeneral($DateIni, $DateEnd){



        $vehicles =DB::table('vehicles_travel')->whereBetween('vehicles_travel.date_start',[$DateIni, $DateEnd])->leftJoin('vehicles', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();


        // $vehicles = array();

        // $vehiclereports = VehiclesTravel::whereBetween('date_start',[$DateIni, $DateEnd]);
        
        // foreach ($vehiclereports as $vehicler) {
        //     $vehiclereport->date_start = Carbon::parse($vehiclereport->date_start)->format('Y-m-d');
        //     $vehiclereport->hour_start = Carbon::parse($vehiclereport->hour_start)->format('H:i');

        //     $vehicle =DB::table('vehicles_travel')->where('vehicles_travel.id','=', 4)->leftJoin('vehicles', 'vehicles_travel.id_car', '=', 'vehicles.id')->get();

        //     array_push($vehicles, $vehicle[0]);
        // }
        
        $pdf = \PDF::loadView('vehiculos/pdfgeneral', compact('vehicles'));
        // $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('vehicleReport');
    }


}
