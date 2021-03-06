@extends('Layouts.adminLayout')
@section('title',' - Crear ciudad')
@section('meta')
@endsection
@section('content')
  <section class="container-fluid pt-4">
    <div class="row">
      <div id="registrar_ciudad" class="col-lg-10 col-sm-12 col-md-10 mx-auto">
        @include('Common.errorProducto')
        <form class="form-group" action="/admin/existencia-producto" method="post">
          @csrf
          <div class="form-group">
            <div class="card">
              <div class="card-header">
                <span>Agregar existencia de producto</span>
              </div>
              <div class="card-body">

                <label for="cod_producto">Nombre del producto</label>
                <select class="form-control" name="cod_producto" id="cod_producto">
                @if($Producto != null)
                    <option value="{{$Producto->cod_producto}}">{{$Producto->nom_producto}}</option>
                @else
                  @foreach ($Productos as $Producto)
                    @if ($Producto->estado == 0)
                    <option value="{{$Producto->cod_producto}}" {{ old('cod_producto') == $Producto->cod_producto ? "selected" : " " }}>{{$Producto->nom_producto}}</option>
                    @endif
                  @endforeach
                @endif
                </select>

                <label for="cod_talla">Talla</label>
                <select class="form-control" name="cod_talla" id="cod_talla">
                  @foreach ($Tallas as $Talla)
                    @if ($Talla->estado == 0)
                      <option value="{{$Talla->cod_talla}}" {{ old('cod_talla') == $Talla->cod_talla ? "selected" : " " }}>{{$Talla->cod_talla}}</option>
                    @endif
                  @endforeach
                </select>

                <label for="cod_bodega">Tiendas</label>
                <select class="form-control" name="cod_tienda" id="cod_tienda">
                  @foreach ($Tiendas as $Tienda)
                    @if ($Tienda->estado == 0)
                      <option value="{{$Tienda_seleccionada = $Tienda->cod_tienda}}" {{ old('cod_tienda') == $Tienda->cod_tienda ? "selected" : " " }}>{{$Tienda->nom_tienda}}</option>
                    @endif
                  @endforeach
                </select>

                <label for="direccion_bodega">Direccion de la bodega</label>
                <select class="form-control" name="direccion_bodega" id="direccion_bodega">
				    <!--@foreach ($Bodegas as $Bodega)
                     @if ($Bodega->estado == 0 and $Bodega->cod_tienda==old('cod_tienda'))
                       <option value="{{$Direccion_seleccionada = $Bodega->cod_bodega}}" {{ old('cod_bodega') == $Bodega->cod_bodega ? "selected" : " " }}>{{$Bodega->direccion_bodega}}</option>
                    @endif
                   @endforeach
				-->
                </select>

                <label for="proveedor">Proveedor</label>
                <input class="form-control" type="text" id="proveedor" name="proveedor" value="{{ old('proveedor') }}">

                <label for="precio_compra">Precio de compra</label>
                <!--<input class="form-control" type="text" id="precio_compra" name="precio_compra" value="{{ old('precio_compra') }}">-->

                <div id="divPrecioCompra">
                </div>

                <label for="cantidad">Cantidad</label>
                <input class="form-control" type="text" id="cantidad" name="cantidad" value="{{ old('cantidad') }}">
              </div>
              <div class="card-footer">
                <button class="btn btn-primary" type="submit">Ingresar</button>
                <a class="btn btn-primary float-right" href="{{ route('existencia-producto.index') }}">Volver</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection
@section('script')
    <script src="{{asset('js/ajax/ajaxbodegafind.js')}}"></script>
    <script src="{{asset('js/ajax/ajaxprecioproductofind.js')}}"></script>
@endsection
