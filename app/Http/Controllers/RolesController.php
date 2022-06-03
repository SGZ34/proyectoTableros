<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:/roles")->only('index');
        $this->middleware("can:/roles/create")->only(['create', 'store']);
        $this->middleware("can:/roles/edit")->only(['edit', 'update']);
        $this->middleware("can:/roles/updateState")->only('updateState');
    }
    public function index()
    {
        $roles = Role::all();



        return view("roles.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permission::all();

        return view("roles.create", compact("permisos"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'name' => 'required|min:3|max:20|unique:roles'
        ];

        $this->validate($request, $campos);

        $permisos = $request->permisos;



        if ($permisos == null) {
            return back()->with("error", "Por favor seleccione un permiso o varios permisos");
        }

        $rol = Role::create([
            "name" => $request["name"],
            "state" => 1
        ]);

        $rol->syncPermissions($permisos);

        return redirect("/roles")->with("success", "Se ha creado el rol satisfactoriamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Role::find($id);

        $permisos = Permission::all();

        $permisosDelRol = $rol->permissions;

        // dd($permisosDelRol);
        return view("roles.edit", compact("rol", "permisos", "permisosDelRol"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id != null) {
            $rol = Role::findOrFail($id);
            if ($rol) {
                $campos = [
                    'name' => 'required|min:3|max:20|unique:roles,name,' . $rol->id
                ];

                $this->validate($request, $campos);

                $permisos = $request->permisos;

                if ($permisos == null) {
                    return back()->with("error", "Por favor seleccione un permiso o varios permisos");
                }

                $rol->update([
                    "name" => $request["name"],
                ]);

                $rol->syncPermissions($permisos);

                return redirect("/roles")->with("success", "Se ha creado el rol satisfactoriamente");
            }
            return redirect("/roles")->with("error", "El cambio de información de información del rol no se pudo realizar");
        }
        return redirect("/roles")->with("error", "El cambio de información de información del rol no se pudo realizar");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateState($state, $id)
    {
        if (($state >= 0 && $state <= 1) && $id != null) {
            $rol = Role::find($id);
            if ($rol) {
                $rol->update([
                    "state" => $state
                ]);

                $users = User::role($rol->name)->get();

                foreach ($users as $user) {
                    $user->update([
                        "state" => $state
                    ]);
                }

                return redirect("/roles")->with("success", "Cambio de estado exitoso");
            }
            return redirect("/roles")->with("error", "El estado no se pudo cambiar");
        }
        return redirect("/roles")->with("error", "El estado no se pudo cambiar");
    }
}
