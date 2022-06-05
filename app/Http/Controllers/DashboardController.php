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
        $tableros = Tablero::select("tableros.*", "mimes.name as mimeName", "mimes.description as mimeDescription")
            ->join("mimes", "mimes.id", "=", "tableros.idMime")
            ->where("state", 1)
            ->get();


        return view("dashboard.index", compact("tableros"));
    }

    public function download($id)
    {
        if ($id != null) {
            $tablero = Tablero::where("id", $id)->first();

            if ($tablero) {
                $path = public_path("/files/" . $tablero->file);
                return response()->download($path);
            }
        }
    }
}
