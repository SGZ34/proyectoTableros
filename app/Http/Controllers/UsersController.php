<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware("can:/users")->only('index');
        $this->middleware("can:/users/create")->only(['create', 'store']);
        $this->middleware("can:/users/edit")->only(['edit', 'update']);
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

        $roles = Role::all();
        return view("users.create", compact("roles"));
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
            'name' => 'required|string|min:4|max:20',
            'email' => 'required|email|min:10|max:80|unique:users',
            'password' => 'required|min:8|max:40|string',
            'confirm-password' => 'required|same:password',
        ];

        $this->validate($request, $campos);

        $roles = $request->roles;

        if ($roles == null) {
            return redirect("/users/create")->with("error", "por favor seleccione un rol o varios roles");
        }

        User::create([
            "name" => $request["name"],
            "email" => $request["email"],
            "password" => Hash::make($request["name"]),
            "state" => 1
        ])->assignRole($roles);

        return redirect("/users")->with("success", "El usuario fue creado satisfactoriamente");
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
        $usuarioEdit = User::find(auth()->user()->id);
        $rolesDelUsuario = $user->getRoleNames();



        if ($usuarioEdit->hasRole("admin")) {
            $roles = Role::all();
            return view("users.edit", compact("user", "roles", "rolesDelUsuario", "usuarioEdit"));
        }

        return view("users.edit", compact("user", "rolesDelUsuario", "usuarioEdit"));
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
        $userEdit = User::find(auth()->user()->id);
        if ($id != null) {
            $user = User::find($id);

            if ($user) {
                $campos = [
                    'name' => 'required|string|min:4|max:20',
                    'email' => 'required|email|min:10|max:80|unique:users,email,' . $user->id
                ];

                $this->validate($request, $campos);


                if ($userEdit->hasRole("admin") && $request->roles == null) {
                    return redirect("/users/" . $user->id . "/edit")->with("error", "por favor seleccione un rol o varios roles");
                }

                if ($userEdit->hasRole("admin")) {
                    $user->roles()->sync($request->roles);
                }

                $user->update([
                    "name" => $request["name"],
                    "email" => $request["email"]
                ]);

                return redirect(($userEdit->hasRole("admin")) ? '/users' : "/home")->with("success", "Usuario editado satisfactoriamente");
            }
            return redirect(($userEdit->hasRole("admin")) ? '/users' : "/home")->with("error", "Usuario no encontrado");
        }
        return redirect(($userEdit->hasRole("admin")) ? '/users' : "/home")->with("error", "Usuario no encontrado");
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

    public function editPassword($id)
    {
        if ($id != null) {
            $user = User::find($id);
            if ($user) {
                return view("users.editPassword", compact("user"));
            }
        }
    }

    public function updatePassword(Request $request, $id)
    {
        if ($id != null) {
            $user = User::findOrFail($id);

            if ($user) {
                $campos = [
                    'password' => 'required|min:8|max:40|string',
                    'new-password' => 'required|min:8|max:40|string',
                    'confirm-password' => 'required|same:new-password'

                ];

                $this->validate($request, $campos);

                if (Hash::check($request->password, auth()->user()->password)) {
                    $user->update([
                        'password' => Hash::make($request["new-password"])
                    ]);

                    return redirect("/home")->with("success", "Contraseña cambiada satisfactoriamente");
                }
                return redirect("/users/editPassword/" . auth()->user()->id)->with("error", "Usted no ha digitado correctamente su contraseña");
            }
        }
    }
}
