@extends('Layouts.adminLayout')
@section('title',' - Ciudades')
@section('content')
  <section class="container-fluid pt-4">
    <div class="row">
      <div id="mostrar_ciudad" class="col-lg col-sm col-md mt-4">
        <div class="card ">
            <div class="card-header">
              <span>Ciudades</span>
            </div>
            <div class="card-body">
              <table id="mostrar_ciudad" class="table table-bordered table-hover table-striped">
                <thead class = "theade-danger">
                  <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th class="no-sort" width=20%>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($Ciudades as $Ciudad)
                      <tr>
                          <td>{{$Ciudad->cod_ciudad}}</td>
                          <td>{{$Ciudad->nom_ciudad}}</td>
                          <td>
                              <a class="btn btn-primary btn-sm" href="#">Editar</a>
                              <a class="btn btn-primary btn-sm" href="#">Eliminar</a>
                          </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="card-footer">
                  <a class="btn btn-primary" href="{{ route('ciudad.create') }}">Crear ciudad</a>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
