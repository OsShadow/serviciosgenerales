<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TrashStoreRequest;
use App\Http\Requests\TrashUpdateRequest;
use Carbon\Carbon;
use App\TrashReports;
use App\Areas;
use DB;

class TrashController extends Controller
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
           
            $treports = DB::table('trash_reports')
            ->select('trash_reports.id','trash_reports.date','trash_reports.id','trash_reports.type','trash_reports.user_report','trash_reports.quantity','areas.label', 'users.name')
            ->leftJoin('areas', 'trash_reports.area_report', '=', 'areas.id')
            ->leftJoin('users', 'trash_reports.user_report', '=', 'users.id')
            ->paginate(30);
            return view('reportes.desechos.index', ['treports' => $treports, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd]);
           

        }else{
            $seleccion = true;
            $treports = DB::table('trash_reports')
            ->select('trash_reports.id','trash_reports.date','trash_reports.id','trash_reports.type','trash_reports.user_report','trash_reports.quantity','areas.label')
            ->leftJoin('areas', 'trash_reports.area_report', '=', 'areas.id')
            ->whereBetween('trash_reports.date',[$DateIni, $DateEnd])
            ->paginate(30);
            return view('reportes.desechos.index', ['treports' => $treports, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'seleccion' => $seleccion  ]);
           
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = Carbon::parse(Carbon::now())->format('Y-m-d');
        return view('reportes.desechos.create',['date'=>$date, 'areports' => Areas::all()]);  

    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrashStoreRequest $request)
    {
        $trash = new TrashReports();

        $date = Carbon::parse($request->date)->format('Y-m-d');
        
        $trash->area_report = $request->area;
        $trash->date = $date;
        $trash->quantity = intval($request->quantity);
        $trash->type = $request->type;
        $trash->user_report = auth()->id();

        $trash->save();

        return redirect('reportes/desechos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $treport = DB::table('trash_reports')
        ->leftJoin('areas', 'trash_reports.area_report', '=', 'areas.id')
        ->where('trash_reports.id','=', $id )
        ->get();

        return view('reportes.desechos.show',[ 'treport'=>$treport  ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $treports = TrashReports::findOrFail($id);
        $area = Areas::findOrFail($treports->area_report);
        return view('reportes.desechos.edit',[ 'treports'=> $treports, 'areports' => Areas::all(),'area' => $area]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(TrashUpdateRequest $request, $id)
    {
        $trash = TrashReports::findOrFail($id);

        $trash->area_report = $request->area;
        $trash->quantity = intval($request->quantity);
        $trash->type = $request->type;
        $trash->save();

        return redirect('reportes/desechos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trash = TrashReports::findOrFail($id);

        $trash->delete();

        return redirect('/reportes/desechos');
    }

    public function pdf($id){
    
        $trash = TrashReports::findOrFail($id);
        $area = Areas::findorfail($trash->area_report);
        $pdf = \PDF::loadView('/reportes/desechos/pdf', compact('trash','area'));
        // $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('trashReport');
    }

    public function pdfgeneral($DateIni, $DateEnd){
    
        $trash = DB::table('trash_reports')
        ->select('trash_reports.id','trash_reports.date','trash_reports.id','trash_reports.type','trash_reports.user_report','trash_reports.quantity','areas.label')
        ->leftJoin('areas', 'trash_reports.area_report', '=', 'areas.id')
        ->whereBetween('trash_reports.date',[$DateIni, $DateEnd])
        ->get();

        $pdf = \PDF::loadView('/reportes/desechos/pdfgeneral', compact('trash'));
        // $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('trashReport');
    }

}
