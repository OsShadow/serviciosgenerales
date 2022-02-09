<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\ticket_reports;
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

            $treports = DB::table('ticket_reports')
            ->select('ticket_reports.id', 'ticket_reports.date', 'ticket_reports.date', 'ticket_reports.ticket_report','users.name','users.code');

            return view('tickets.index', ['treports' => $treports, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd]);
        }else{
            $selection = true;
            $treports = DB::table('ticket_reports')
            ->select('ticket_reports.id', 'ticket_reports.date', 'ticket_reports.date');
            return view('tickets.index', ['treports' => $treports, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'selection' => $selection]);

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

    public function store(TicketRequest $request){
        
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);
        $treports = new ticket_reports();
        
        $date = Carbon::parse($request->date)->format('Y-m-d');

        $treports->date = $date;
        $treports->ticket_report = $request->ticket_report;
        $treports->employer = $request->employer;
        $treports->date_finish = $request->date_finish;
        $treports->file = $request->file;
        $treports->user_report = auth()->id();

        $treports->save();

        return redirect('tickets');

    }

    public function destroy($id){

    }

}