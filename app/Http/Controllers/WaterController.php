<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WaterStoreRequest;
use App\Http\Requests\WaterUpdateRequest;
use Carbon\Carbon;
use App\WaterReports;

use DB;

class WaterController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

 
public function index(Request $request)
{

    $DateIni = $request->get('DateIni');
    $DateEnd = $request->get('DateEnd');


    if($DateIni == '' || $DateEnd == ''){
        
        $DateIni = '2021-01-01';
        $DateEnd = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');

        $wreports = DB::table('water_reports')
        ->paginate(30);


return view('reportes.agua.index', ['wreports' => $wreports, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd ]);

    }else{

        // $DateIni = '2021-01-01';
        // $DateEnd = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');

$wreports = DB::table('water_reports')
    ->whereBetween('date',[$DateIni,  $DateEnd])
        ->get();

        // con filtro

        // $wreports = DB::table('water_reports_general as t1')
        // ->select('t1.id','t2.date as date_start','t3.date as date_end',DB::raw('(`t2`.`read` - `t3`.`read`) as `consumption`'))
        // ->leftJoin('water_reports as t2', 't2.id', '=', 't1.id_date_start')
        // ->leftJoin('water_reports as t3', 't3.id', '=', 't1.id_date_end')
        // ->whereBetween('t2.date',[$DateIni, $DateEnd])
        // ->get();

        // $lwreport = DB::table('water_reports_general')
        // ->select('id_date_end')
        // ->orderByDesc('id')
        // ->limit(1)
        // ->get();

        // $lreport = DB::table('water_reports')
        // ->select('id')
        // ->orderByDesc('id')
        // ->limit(1)
        // ->get();

        // $blnactualreport = false;
        // $actualreport = [];

        // if(isset($lwreport[0])){
        // if($lwreport[0]->id_date_end != $lreport[0]->id){

        //     $blnactualreport = true;

        //     $actualreport = DB::table('water_reports')
        //     ->orderByDesc('id')
        //     ->where('id', '>' ,$lwreport[0]->id_date_end)
        //     ->get();

        // }
        // }else{

        //     $actualreport = DB::table('water_reports')
        //     ->orderByDesc('id')
        //     ->get();
        // }

        $seleccion = true;

        return view('reportes.agua.index', ['wreports' => $wreports, 
          'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'seleccion' => $seleccion ]);

    }

}

public function complete( $inicio, $fin)
{

    $nreport = DB::table('water_reports_general')
        ->select('id')
        ->orderByDesc('id')
        ->limit(1)
        ->get();

        if(!isset($nreport[0])){
            $nreg = 0;
        }else{
            $nreg = $nreport[0]->id+1;
        }

        DB::table('water_reports_general')->insert([
            'id' => $nreg,
            'id_date_start' => $inicio,
            'id_date_end' => $fin
        ]);

    return redirect('/reportes/agua');
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
return view('reportes.agua.create',['date'=>$date],['hour'=>$hour]);  

}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */


public function store(WaterStoreRequest $request)
{
    
$water = new WaterReports();

$date = Carbon::parse($request->date)->format('Y-m-d');
$hour = Carbon::parse($request->hour)->format('H:i');

$water->date = $date;
$water->hour = $hour;
$water->read = $request->read;
$water->cloration = $request->cloration;
$water->Observations = $request->observations;
// $water->user_report = auth()->id();
$water->save();
return redirect('reportes/agua');

}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show($id)
{

    $range = DB::table('water_reports_general')
    ->select('id_date_start','id_date_end')
    ->where('id','=',$id)
    ->get();
    
    $consumption = DB::table('water_reports_general as t1')
        ->select(DB::raw('(`t2`.`read` - `t3`.`read`) as `consumption`'))
        ->leftJoin('water_reports as t2', 't2.id', '=', 't1.id_date_start')
        ->leftJoin('water_reports as t3', 't3.id', '=', 't1.id_date_end')
        ->where('t1.id', '=', $id)
        ->get();

    $wreports = DB::table('water_reports')
    ->select('id','date','hour','read','cloration','Observations')
    ->whereBetween('id',[$range[0]->id_date_start, $range[0]->id_date_end])
    ->get();


return view('reportes.agua.show',['wreports'=> $wreports, 'consumption' => $consumption[0]->consumption , 'id' => $id]  );
}


public function showreport($id)
{

$wreport = WaterReports::findOrFail($id);

return view('reportes.agua.showreport',['wreport' => $wreport], ['id' => $id]);


}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{

return view('reportes.agua.edit',['wreport'=> WaterReports::findOrFail($id)]);
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */


public function update(WaterUpdateRequest $request, $id)
{
$water = WaterReports::findOrFail($id);

$water->read = $request->date;
$water->hour = $request->hour;
$water->read = $request->read;
$water->cloration = $request->cloration;
$water->Observations = $request->Observations;

$water->update();   

return redirect('/reportes/agua');
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
$wreport = WaterReports::findOrFail($id);

$wreport->delete();

return redirect('/reportes/agua');
}

/**
 * Funcion create pdf
 */

public function pdf($id){

    $range = DB::table('water_reports_general')
    ->select('id_date_start','id_date_end')
    ->where('id','=',$id)
    ->get();
    
    $consumption = DB::table('water_reports_general as t1')
        ->select(DB::raw('(`t2`.`read` - `t3`.`read`) as `consumption`'))
        ->leftJoin('water_reports as t2', 't2.id', '=', 't1.id_date_start')
        ->leftJoin('water_reports as t3', 't3.id', '=', 't1.id_date_end')
        ->where('t1.id', '=', $id)
        ->get();

    $wreports = DB::table('water_reports')
    ->select('id','date','hour','read','cloration','Observations')
    ->whereBetween('id',[$range[0]->id_date_start, $range[0]->id_date_end])
    ->get();

    $pdf = \PDF::loadView('/reportes/agua/pdf', compact('wreports', 'consumption' ));
    // $pdf->setPaper('letter', 'landscape');
    return $pdf->stream('waterReport');

}


public function exportpdf(Request $request){

    $wreport = WaterReports::findOrFail($id);
    $pdf = \PDF::loadView('/reportes/agua/pdf', compact('wreport'));
    // $pdf->setPaper('letter', 'landscape');
    return $pdf->stream('waterReport');
}

public function pdfgeneral($DateIni, $DateEnd){

    $wreports = DB::table('water_reports')
    // ->select('t1.id','t1.id_date_start', 't1.id_date_end','t2.date as date_start','t3.date as date_end',DB::raw('(`t2`.`read` - `t3`.`read`) as `consumption`'))
    // ->leftJoin('water_reports as t2', 't2.id', '=', 't1.id_date_start')
    // ->leftJoin('water_reports as t3', 't3.id', '=', 't1.id_date_end')
    ->whereBetween('date',[$DateIni, $DateEnd])
    ->get();

    //     $reportes = array();

    //     foreach ($wreports as $indice => $wr) {

    //         $wreport = DB::table('water_reports')
    // ->select('id','date','hour','read','cloration','Observations')
    // ->whereBetween('id',[$wr->id_date_start, $wr->id_date_end])
    // ->get();

    //         array_push($reportes, $wreport);
    //     }

    // $agua = '';

    $pdf = \PDF::loadView('/reportes/agua/pdfgeneral', compact('wreports'));

    // $pdf->setPaper('letter', 'landscape');

    return $pdf->stream('compresorReport');

}




}
