<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    //

    public function index()
    {
        return view('reportes.index');
    }

    public function crearReporteAgua()
    {
        return view('reportes.agua.crear');
    }

    public function crearReporteCompresor()
    {
        return view('reportes.compresor.crear');
    }

    public function crearReporteDeshechos()
    {
        return view('reportes.deshechos.crear');
    }

    public function verReporteAgua()
    {
        return view('reportes.agua.ver');
    }

    public function verReporteCompresor()
    {
        return view('reportes.compresor.ver');
    }

    public function verReporteDeshechos()
    {
        return view('reportes.deshechos.ver');
    }
}
