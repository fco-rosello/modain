@extends('Layouts.adminLayout')
@section('title',' - Crear producto')
@section('content')
  <section class="container-fluid pt-4">
    <div class="row">
        <div id='registrar_producto' class="col-lg col-sm col-md">
          <form class="form-group" action="/admin/producto" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <div class="card">
               <div class="card-header">
                 <span>Registrar producto</span>
               </div>
               <div class="card-body">
                 <div class="row">
                   <div class="col-lg-8 col-sm-12 col-md-8">
                     <label for="nombre">Nombre</label>
                     <input class="form-control" type="text" name="nombre" id="nombre">
                     <label for="precio_venta">Precio de venta</label>
                     <input class="form-control" type="text" name="precio_venta" id="precio_venta">
                     <label for="tipo_producto">Tipo del producto</label>
                     <select class="form-control" name="tipo_de_producto" id="tipo_de_producto">
                       @foreach ($TipoProductos as $TipoProducto)
                         <option value="{{$TipoProducto->cod_tipo_producto}}">{{$TipoProducto->nombre}}</option>
                       @endforeach
                     </select>
                     <label for="marca">Marca</label>
                     <select class="form-control" name="marca" id='marca'>
                       @foreach ($Marcas as $Marca)
                         <option value="{{$Marca->cod_marca}}">{{$Marca->nombre}}</option>
                       @endforeach
                     </select>
                   </div>
                   <div class="col-lg col-sm col-md">
                     <div class="card mt-4">
                       <div class="card-header">
                         <span>Foto del producto</span>
                       </div>
                       <div class="card-body">

                       </div>
                     </div>
                     <div class="input-group mb-3 mt-4">
                       <div class="custom-file">
                         <input type="file" class="custom-file-input" name="foto_producto" id="foto_producto">
                         <label class="custom-file-label" for="foto_producto">Eliga una imagen</label>
                       </div>
                     </div>
                   </div>
                 </div>
                  <button class="btn btn-primary mt-4" type="submit">Ingresar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
  </section>
@endsection
