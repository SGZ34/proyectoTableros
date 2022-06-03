<?php

namespace App\Http\Controllers;

use App\Models\Tablero;
use Illuminate\Http\Request;

class TablerosController extends Controller
{

    public function __construct()
    {
        $this->middleware("can:/tableros")->only('index');
        $this->middleware("can:/tableros/create")->only(['create', 'store']);
        $this->middleware("can:/tableros/edit")->only(['edit', 'update']);
        $this->middleware("can:/tableros/updateState")->only('updateState');
    }

    public function index()
    {
        $tableros = Tablero::all();
        return view("tableros.index", compact("tableros"));
    }


    public function create()
    {
        return view("tableros.create");
    }



    public function store(Request $request)
    {

        $campos = [
            'title' => 'required|min:4|max:40|string',
            'description' => 'required|min:10|max:200|string',
            'file' => 'required|file|max:5000|mimes:pdf'
        ];

        $this->validate($request, $campos);

        if ($request->hasFile('file')) {
            $file = $request->file("file");
            $nombre = "file_" . time() . "." . $file->guessExtension();
            $request->file->move(public_path('files'), $nombre);

            Tablero::create([
                "title" => $request["title"],
                "description" => $request["description"],
                "state" => 1,
                "file" => $nombre,
            ]);

            return redirect("/tableros")->with("success", "Tablero creado satisfactoriamente");
        }
        return redirect("/tableros")->with("error", "Ha ocurrido un error al cargar el archivo");
    }



    public function show($id)
    {
    }



    public function edit($id)
    {
        if ($id != null) {
            $tablero = Tablero::findOrFail($id);
            if ($tablero) {
                return view("tableros.edit", compact("tablero"));
            }
            return redirect("/tableros")->with("error", "El tablero no fue encontrado");
        }
        return redirect("/tableros")->with("error", "El tablero no fue encontrado");
    }




    public function update(Request $request, $id)
    {
        if ($id != null) {
            $tablero = Tablero::findOrFail($id);
            if ($tablero) {
                $campos = [
                    'title' => 'required|min:4|max:40|string',
                    'description' => 'required|min:10|max:200|string',
                    'file' => 'required|file|max:5000|mimes:pdf'
                ];

                $this->validate($request, $campos);

                $nombre = $tablero->file;

                if ($tablero->file != null) {
                    unlink("files/" . $tablero->file);
                }

                if ($request->hasFile('file')) {
                    $file = $request->file("file");
                    $nombre = "file_" . time() . "." . $file->guessExtension();
                    $request->file->move(public_path('files'), $nombre);
                    $tablero->update([
                        "title" => $request["title"],
                        "description" => $request["description"],
                        "file" => $nombre,
                    ]);
                }


                return redirect("/tableros")->with("success", "Tablero creado satisfactoriamente");

                return redirect("/tableros")->with("error", "Ha ocurrido un error al cargar el archivo");
            }
        }
    }



    public function destroy($id)
    {
    }

    public function updateState($state, $id)
    {
        if (($state >= 0 && $state <= 1) && $id != null) {
            $tablero = Tablero::findOrFail($id);
            if ($tablero) {
                $tablero->update([
                    "state" => $state
                ]);
                return redirect("/tableros")->with("success", "Cambio de estado exitoso");
            }
            return redirect("/tableros")->with("error", "El estado no se pudo cambiar");
        }
        return redirect("/tableros")->with("error", "El estado no se pudo cambiar");
    }
}
