<?php

namespace App\Http\Controllers;

use App\Models\Tablero;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware("can:/dashboard")->only('index');
    }
    public function index()
    {

        $tableros = Tablero::select("*")->where("state", 1)->get();
        return view("dashboard.index", compact("tableros"));
    }
}
