<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketStoreImageRequest;
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

        if ($DateIni == '' || $DateEnd == '') {

            $DateIni = '2021-01-01';
            $DateEnd = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');

            $treports = ticket_reports::latest()->paginate(30);
            return view('tickets.index', ['treports' => $treports, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd]);
        } else {
            $selection = true;
            $treports = ticket_reports::whereBetween('date', [$DateIni, $DateEnd])->latest()->paginate(30);
            return view('tickets.index', ['treports' => $treports, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'selection' => $selection]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date = Carbon::parse(Carbon::now())->format('Y-m-d');
        return view('tickets.create', ['date' => $date]);
    }

    public function store(TicketStoreRequest $request)
    {

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

        function upload_global($file, $folder)
        {

            $file_type = $file->getClientOriginalExtension();
            $folder = $folder;
            $destinationPath = public_path() . '/uploads/' . $folder;

            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();


            if ($file->move($destinationPath . '/', $filename)) {
                return $filename;
            }
        }
        
        foreach ((array)$files as $file) {

            $ticket_image = new TicketImages();
            //Esta imagen hace referencia al id del ticket report    
            $ticket_image->ticket_id = $treports->id;
            $ticket_image->file = upload_global($file, $treports->id);

            $ticket_image->save();
        }

        return redirect('tickets');
    }

    public function update(TicketUpdateRequest $request, $id)
    {

        $treports = ticket_reports::findOrFail($id);

        $treports->ticket_report = $request->ticket_report;
        $treports->employer = $request->employer;
        $treports->type = $request->type;
        $treports->date_finish = $request->date_finish;
        $treports->hour_finish = $request->hour_finish;

        if ($request->type == "Cerrado") {
            $treports->closed_at = date("Y-m-d");
        }
        // insertarlo en bd para que no truene

        $treports->save();

        $treports->id;
        $files = $request->file('file');
        // $hasFiles = public_path() . '/uploads/'.$folder;
        // dd($hasFiles);

    

        return view('tickets.edit', [
            'treports' => ticket_reports::findOrFail($id),
            'timages' => TicketImages::where('ticket_id', $id)->get()
        ]);
    }

    public function addimage(TicketStoreImageRequest $request, $id)
    {
        $files = $request->file('file');
        // dd($hasFiles);

        function upload_file($file, $folder)
        {
        
            $folder = $folder;
            $destinationPath = public_path() . '/uploads/' . $folder;

            //ver la localización del archivo que exista y esté situado en la carpeta correspondiente
            // $file_origin = $destinationPath->$file_name; 
            // dd($file_origin);

            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

            // dd($destinationPath, $filename, $file);
            // dd($filename);

            if ($file->move($destinationPath . '/', $filename)) {
                return $filename;
            }
        }

        // Si no tiene contenido dentro de la carpeta
        foreach ((array)$files as $file) {

            $ticket_image = new TicketImages();
            // $ticket_image = TicketImages::findOrFail($id);
            // dd($ticket_image);

            //Esta imagen hace referencia al id del ticket report,  
            $ticket_image->ticket_id = $id;
            // dd($ticket_image);

            // aquí mismo la encuentra y hace match con el ticket report 
            $ticket_image->file = upload_file($file, $id);

            $ticket_image->save();
        }
        
        return redirect()->route('tickets.edit', $id);

    }

    public function deleteimage($id, $ticketid)
    {
        $ticket_image = TicketImages::findOrFail($ticketid);

        // Eliminar imagen de la ruta o carpeta
        $deleteDestination = public_path() . '/uploads/' . $id . '/' .  $ticket_image['file'];

        if (file_exists($deleteDestination)) {
            unlink($deleteDestination);
        }
        // Eliminar imagen de la db
        $ticket_image->delete();
        

        return redirect()->route('tickets.edit', $id);


    }

    public function edit($id)
    {
        return view('tickets.edit', [
            'treports' => ticket_reports::findOrFail($id),
            'timages' => TicketImages::where('ticket_id', $id)->get()
        ]);
    }

    public function show($id)
    {
        return view('tickets.show', [
            'treports' => ticket_reports::findOrFail($id),
            'timages' => TicketImages::where('ticket_id', $id)->get()
        ]);
    }

    public function destroy($id)
    {
        $treports = ticket_reports::findOrFail($id);

        $treports->delete();

        return redirect('tickets');
    }

    public function pdf($id)
    {

        $treport = ticket_reports::findOrFail($id);
        $pdf = \PDF::loadView('/tickets/pdf', compact('treport'));
        return $pdf->stream('ticketreport');
    }

    public function pdfgeneral($DateIni, $DateEnd)
    {

        $treports = ticket_reports::all()->whereBetween('date', [$DateIni, $DateEnd]);

        $pdf = \PDF::loadView('/tickets/pdfgeneral', compact('treports'));
        return $pdf->stream('ticketreport');
    }

    public function panel(Request $request)
    {

        // $DateIni = $request->get('DateIni');
        // $DateEnd = $request->get('DateEnd');
        // //El if sí funciona
        // if ($DateIni == '' || $DateEnd == '') {

        //     $DateIni = '2022-01-01';
        //     $DateEnd = Carbon::parse(Carbon::now())->timezone('America/Mexico_City')->format('Y-m-d');

        //     $fresh_tickets = DB::select("SELECT * FROM ticket_reports WHERE updated_at BETWEEN DATE_SUB(CURDATE(),INTERVAL 15 DAY) AND CURDATE()");
        //     return view('tickets.panel', ['fresh_tickets' => $fresh_tickets, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd]);
        // } else {
        //     $selection = true;
        //     $fresh_tickets = ticket_reports::whereBetween('updated_at', [$DateIni, $DateEnd]);

        //     return view('tickets.panel', ['fresh_tickets' => $fresh_tickets, 'DateIni' => $DateIni, 'DateEnd' => $DateEnd, 'selection' => $selection]);
        // }

        //Original
        $fresh_tickets = DB::select("SELECT * FROM ticket_reports WHERE updated_at BETWEEN DATE_SUB(CURDATE(),INTERVAL 15 DAY) AND CURDATE()");

        return view('tickets.panel', ['fresh_tickets' => $fresh_tickets ]);        

    }
}
