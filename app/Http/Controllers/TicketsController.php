<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\ticket_reports;
use App\TicketImages;
use App\PanelData;
use App\User;
use Carbon\Carbon;
use DB;

class TicketsController extends Controller
{
    public function index(Request $request)
    {

        $DateIni = $request->get('DateIni');
        $DateEnd = $request->get('DateEnd');

        if($DateIni == '' || $DateEnd == ''){

            $DateIni = '2021-01-01';
            $DateEnd = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');
            
            $treports = ticket_reports::paginate(30);
            return view('tickets.index', ['treports' => $treports, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd]);

        }else{
            $selection = true;
            $treports = ticket_reports::whereBetween('date',[$DateIni, $DateEnd])->paginate(30);
            return view('tickets.index', ['treports' => $treports, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'selection' => $selection  ]);

        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $date = Carbon::parse(Carbon::now())->format('Y-m-d');
        return view('tickets.create',['date'=>$date]);
    }

    public function store(TicketStoreRequest $request){
//dd($request->file('file'));
//return;
        $treports = new ticket_reports();
        
        $date = Carbon::parse($request->date)->format('Y-m-d');

        $treports->date = $date;
        $treports->ticket_report = $request->ticket_report;
        $treports->employer = $request->employer;
        $treports->type = $request->type;
        $treports->date_finish = $request->date_finish;
        $treports->hour_finish = $request->hour_finish;
        
        $treports->user_report = auth()->id();
              
        $treports->save();

        //Id de reporte del ticket para hacer referencia a las imagenes a referenciar
        $treports->id;
        $files = $request->file('file');

        function upload_global($file, $folder){ 

            $file_type = $file->getClientOriginalExtension(); 
            $folder = $folder; 
            $destinationPath = public_path() . '/uploads/'.$folder; 
            
            $filename = uniqid().'_'.time() . '.' . $file->getClientOriginalExtension();
            
    
            if ($file->move($destinationPath.'/' , $filename)) { 
                return $filename; 
            } 
        }
        foreach((array)$files as $file){
            
            $ticket_image = new TicketImages();
        //Esta imagen hace referencia al id del ticket report    
            $ticket_image->ticket_id = $treports->id;
            $ticket_image->file = upload_global($file,$treports->id);

            $ticket_image->save();
        }

        return redirect('tickets');
        
    }

    public function update(TicketUpdateRequest $request, $id){

        $treports = ticket_reports::findOrFail($id);

        $treports->ticket_report = $request->ticket_report;
        $treports->employer = $request->employer;
        $treports->type = $request->type;
        $treports->date_finish = $request->date_finish;
        $treports->hour_finish = $request->hour_finish;
        
        $treports->save();

        $treports->id;
        $files = $request->file('file');

        return redirect('tickets');
    }

    public function edit($id)
    {
        return view('tickets.edit',['treports'=> ticket_reports::findOrFail($id),
        'timages'=>TicketImages::where('ticket_id',$id)->get()]);   
    }

    public function show($id)
    {
        return view('tickets.show',['treports'=> ticket_reports::findOrFail($id),
        'timages'=>TicketImages::where('ticket_id',$id)->get()]);
    }

    public function destroy($id){
        $treports = ticket_reports::findOrFail($id);

        $treports->delete();

        return redirect('tickets');
    }

    public function pdf($id){
    
        $treport = ticket_reports::findOrFail($id);
        $pdf = \PDF::loadView('/tickets/pdf', compact('treport'));
        return $pdf->stream('ticketreport');
    }

    public function pdfgeneral($DateIni, $DateEnd){
    
        $treports = ticket_reports::all()->whereBetween('date',[$DateIni, $DateEnd]);

        $pdf = \PDF::loadView('/tickets/pdfgeneral', compact('treports'));
        return $pdf->stream('ticketreport');
    }

    public function panel(){
        
//SELECT date , COUNT(type) as Open FROM ticket_reports WHERE type = 'Abierto' GROUP BY date;
//SELECT DATE(updated_at) as date, COUNT(type) as Close FROM ticket_reports WHERE type = 'Cerrado' GROUP BY DATE(updated_at);

        $tickets_open = DB::table('ticket_reports')
        // ->selectRaw('date')
        ->selectRaw('COUNT(type) AS Open')
        // ->where('type', '=', 'Abierto')
        ->whereType('Abierto')
        // ->exists()
        ->groupBy('date')
        ->get();
        return view('tickets.panel',['tickets_open' =>$tickets_open]);

        $tickets_close = DB::table('ticket_reports')
        // ->select(DB::raw('count(type) as Close'))
        ->selectRaw('DATE(updated_at) AS date')
        // ->where('type', '=', 'Cerrado')
        ->whereType('Cerrado')
        ->exists()
        ->groupBy('DATE(updated_at)')
        ->get();
        return view('tickets.panel',['tickets_close' =>$tickets_close]);
    }

}