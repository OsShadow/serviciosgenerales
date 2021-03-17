<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $treports = DB::table('trash_reports')
            ->select('trash_reports.id','trash_reports.date','trash_reports.id','trash_reports.type','trash_reports.user_report','trash_reports.quantity','areas.label')
            ->leftJoin('areas', 'trash_reports.area_report', '=', 'areas.id')
            ->orderBy('date', 'asc')
            ->get();
        $wreports = DB::table('water_reports')
        ->orderBy('date', 'asc')
        ->get();
        $creports = DB::table('compresor_reports')
        ->orderBy('date', 'asc')
        ->get();
        return view('home',compact('treports','wreports','creports'));
    }
}
