@extends('layouts.app')
@section('content')
<div class="container-fluid" align="center">
	<main class="py-4" id="app">
       <div class="container">
		  	<div class="row justify-content-center">
				<div class="container-fluid card">
					<div class="container">
						<div class="col">
							<h1>Tiendas</h1>
						</div>
						<div class="col-3 input-group input-group-lg mb-3">
					  		<a href="{{ route('tiendas.create') }}" class="btn btn-primary">Agregar Nueva Tienda</a>
						</div>
					</div>
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Tienda</th>
								<th scope="col">Descripción</th>
								<th scope="col">Locación</th>
								<th scope="col">Contacto</th>
								<th scope="col">Telefono</th>
								<th scope="col">Acción</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($tiendas as $tienda)
								{{-- expr --}}
								<tr>
									<th scope="row">{{$tienda->nombre}}</th>
									<th>{{$tienda->descripcion}}</th>
									<th>{{$tienda->locacion}} <a href="{{$tienda->getMapLink()}}" target="_blank">Ver en GoogleMaps</a></th>
									<th>{{$tienda->nombre_contacto}}</th>
									<th>{{$tienda->telefono_contacto}}</th>
									<th>
										<a href="{{ route('tiendas.productos.index',['tienda'=>$tienda]) }}" class="btn btn-link">Productos</a>
										<a href="{{ route('tiendas.edit',['tienda'=>$tienda]) }}" class="btn btn-link">Editar</a>
										<form method="POST" action="{{ route('tiendas.destroy',['tienda'=>$tienda]) }}">
											@csrf
											<input type="hidden" name="_method" value="DELETE">
											<button type="submit" class="btn btn-link" onclick="return confirm('¿Estás seguro que desea eliminar esta tienda?');">Eliminar</button>
										</form>
									</th>
								</tr>
							@empty
								{{-- empty expr --}}
								<div class="alert alert-danger" role="alert">
									<span>No hay tiendas</span>
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