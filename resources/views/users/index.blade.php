@extends('layouts.app')

@section('title')
    Usuarios
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                      <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                          @if ($user->state == 1)
                            <span class="badge badge-primary">Activo</span>
                          @else
                            <span class="badge badge-danger">Inactivo</span>
                          @endif
                        </td>
                        <td>
                          <a href="/users/{{$user->id}}/edit" class="btn btn-warning text-white">Editar</a>
                          @if ($user->state == 1)
                          <a href="/users/updateState/0/{{$user->id}}" class="btn btn-danger">Deshabilitar</a>
                          @else
                          <a href="/users/updateState/1/{{$user->id}}" class="btn btn-success">Habilitar</a>
                          @endif
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
    </div>
@endsection