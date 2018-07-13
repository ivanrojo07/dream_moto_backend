@extends('layouts.app')
@section('content')
	{{-- expr --}}
	<div class="container-fluid" align="center">
		<main class="py-4">
			<div class="container card">
				<div class="row justify-content-center">
					<div class="container">
						<div class="col"><h1>Fotos de {{$producto->nombre}}</h1></div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						@foreach ($fotos as $foto)
							{{-- expr --}}
							<div class="col-6" style="padding-bottom: 15px;padding-top: 15px;">
								<div class="card">
									<img src="{{ url('storage/') }}/{{$foto->image_path}}" style="height: 250px; width: 250px;">
									<form method="POST" action="{{ route('tiendas.productos.fotos.destroy',['tienda'=>$tienda,'producto'=>$producto,'foto'=>$foto]) }}">
										@csrf

										<input type="hidden" name="_method" value="DELETE">
										<button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro que desea eliminar esta foto?');">Eliminar</button>
									</form>
								</div>
							</div>
						@endforeach
						
					</div>
				</div>
			</div>
		</main>
	</div>
@endsection