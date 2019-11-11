<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function principal_estados(){

        $semesterController = new SemesterController();

        return view('reportes.principal',  ['ciclos' => $semesterController->viewSemesters()]);
    }
}
