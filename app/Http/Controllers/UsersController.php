<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware("can:/users")->only('index');
        $this->middleware("can:/users/edit")->only('edit');
        $this->middleware("can:/users/update")->only('update');
        $this->middleware("can:/users/updateState")->only('updateState');
    }

    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);

        $roles = Role::all();

        $rolesDelUsuario = $user->getRoleNames();



        return view("users.edit", compact("user", "roles", "rolesDelUsuario"));
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
            $user = User::find($id);
            if ($user) {
                $campos = [
                    'name' => 'required|string|min:4|max:20',
                    'email' => 'required|email|min:10|max:80|unique:users,email,' . $user->id
                ];

                $this->validate($request, $campos);

                $user->roles()->sync($request->roles);

                $user->update([
                    "name" => $request["name"],
                    "email" => $request["email"]
                ]);

                return redirect("/users")->with("success", "Usuario editado satisfactoriamente");
            }
            return redirect("/users")->with("error", "Usuario no encontrado");
        }
        return redirect("/users")->with("error", "Usuario no encontrado");
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
            $user = User::findOrFail($id);
            if ($user) {
                $user->update([
                    "state" => $state
                ]);
                return redirect("/users")->with("success", "Cambio de estado exitoso");
            }
            return redirect("/users")->with("error", "El estado no se pudo cambiar");
        }
        return redirect("/users")->with("error", "El estado no se pudo cambiar");
    }
}
