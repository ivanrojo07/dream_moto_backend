@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						Handbook
					</div>
					<div class="card-body">
						<form method="POST" action="{{ $edit == false ? route('handbooks.store') : route('handbooks.update',$handbook) }}" @if ($edit == false)
							{{-- expr --}}
							enctype='multipart/form-data'
						@endif>
							@csrf

							@if ($edit == true)
								{{-- expr --}}
								<input type="hidden" name="_method" value="PUT">
							@endif

							<div class="form-group row">
								<label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre del manual:</label>
								<div class="col-md-6">
									<input id="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : ''  }}" name="nombre" value="{{ $edit ? $handbook->nombre : old('nombre') }}" required autofocus="">
									@if ($errors->has('nombre'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("nombre")}}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripción:</label>
								<div class="col-md-6">
									<textarea id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : ''  }}" name="descripcion">{{ $edit ? $handbook->descripcion : old('descripcion') }}</textarea>
									@if ($errors->has('descripcion'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("descripcion")}}</strong>
										</span>
									@endif
								</div>
							</div>
							@if ($edit)
								{{-- true expr --}}
								<div class="form-group row">
									<iframe src="{{ url('storage/handbook/'.$handbook->path) }}" style="width: 100%; height: 300px;"></iframe>
								</div>
							@else
								{{-- false expr --}}
							<div class="form-group row">
								<label for="handbook" class="col-md-4 col-form-label text-md-right">Manual:</label>
								<div class="col-md-6">
									<input type="file" id="handbook" name="handbook" accept="application/pdf" class="form-control {{ $errors->has('handbook') ? ' is-invalid' : ''  }}">
									@if ($errors->has('handbook'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("handbook")}}</strong>
										</span>
									@endif
								</div>
							</div>


							@endif
							
							
							

						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar handbook
                                </button>
                            </div>
                        </div>
						</form>

						
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection