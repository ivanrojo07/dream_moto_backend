@extends('layouts.app')
@section('content')
<div class="container-fluid" align="center">
	<main class="py-4" id="app">
       <div class="container">
		  	<div class="row justify-content-center">
				<div class="container-fluid card">
					<div class="container">
						<div class="col">
							<h1>Productos de {{$tienda->nombre}}</h1>
						</div>
						<div class="col-3 input-group input-group-lg mb-3">
					  		<a href="{{ route('tiendas.productos.create',['tienda'=>$tienda]) }}" class="btn btn-primary">Agregar Nuevo Producto</a>
						</div>
					</div>
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Descripción</th>
								<th scope="col">Cantidad</th>
								<th scope="col">Precio</th>
								<th scope="col">Acción</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($productos as $producto)
								{{-- expr --}}
								<tr>
									<th scope="row">{{$producto->nombre}}</th>
									<th>{{$producto->descripcion}}</th>
									<th>{{$producto->cantidad}}</th>
									<th>${{$producto->precio}}</th>
									<th>
										<a href="{{ route('tiendas.productos.edit',['tienda'=>$tienda,'producto'=>$producto]) }}" class="btn btn-link">Editar producto</a>
										<a href="{{ route('tiendas.productos.fotos.index',['tienda'=>$tienda,'producto'=>$producto]) }}" class="btn btn-link">Fotos del producto</a>

										<form method="POST" action="{{ route('tiendas.productos.destroy',['tienda'=>$tienda,'producto'=>$producto]) }}">
											@csrf
											<input type="hidden" name="_method" value="DELETE">
											<button type="submit" class="btn btn-link" onclick="return confirm('¿Estás seguro que desea eliminar este producto?');">Eliminar</button>
										</form>
									</th>
								</tr>
							@empty
								{{-- empty expr --}}
								<div class="alert alert-danger" role="alert">
									<span>No hay productos</span>
								</div>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </main>
</div>
@endsection