@extends('layouts.app')
@section('content')
<div class="container-fluid" align="center">
	<main class="py-4" id="app">
       <div class="container">
		  	<div class="row justify-content-center">
				<div class="container-fluid card">
					<div class="container">
						<div class="col">
							<h1>Handbooks</h1>
						</div>
						<div class="col-3 input-group input-group-lg mb-3">
					  		<a href="{{ route('handbooks.create') }}" class="btn btn-primary">Agregar Nuevo Manual</a>
						</div>
					</div>
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Descripción</th>
								<th scope="col">Fecha de creación</th>
								<th scope="col">Acción</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($handbooks as $handbook)
								{{-- expr --}}
								<tr>
									<th scope="row">{{$handbook->nombre}}</th>
									<th>{{$handbook->descripcion}}</th>
									<th>{{$handbook->created_at->format('Y-m-d')}}</th>
								</tr>
							@empty
								{{-- empty expr --}}
								<div class="alert alert-danger" role="alert">
									<span>No hay manuales</span>
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