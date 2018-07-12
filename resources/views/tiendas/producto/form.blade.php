@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						{{$tienda->nombre}}
					</div>
					<div class="card-body">
						<h4>Producto:</h4>
						<form method="POST" action="{{ $edit == false ? route('tiendas.productos.store',$tienda) : route('tiendas.productos.update',[$tienda,$producto]) }}">
							@csrf

							@if ($edit == true)
								{{-- expr --}}
								<input type="hidden" name="_method" value="PUT">
							@endif
							<input type="hidden" name="tienda_id" value="{{$tienda->id}}">

							<div class="form-group row">
								<label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de la producto:</label>
								<div class="col-md-6">
									<input id="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : ''  }}" name="nombre" value="{{ old('nombre') }}" required autofocus="">
									@if ($errors->has('nombre'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("nombre")}}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group row">		
								<label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripción de la producto:</label>
								<div class="col-md-6">
									<textarea id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : ''  }}" name="descripcion" value="{{ old('descripcion') }}">{{ old('descripcion') }}</textarea>
									@if ($errors->has('descripcion'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("descripcion")}}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group row">		
								<label for="cantidad" class="col-md-4 col-form-label text-md-right">Cantidad del producto que tienes:</label>
								<div class="col-md-6">
									<input id="cantidad" type="number" min="1" max="100" class="form-control {{ $errors->has('cantidad') ? ' is-invalid' : ''  }}" name="cantidad" value="{{ old('cantidad') }}" required>
									@if ($errors->has('cantidad'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("cantidad")}}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group row">		
								<label for="precio" class="col-md-4 col-form-label text-md-right">Precio por producto:</label>
								<div class="col-md-6">
									<input id="precio" type="number" step="0.01" min="0" class="form-control {{ $errors->has('precio') ? ' is-invalid' : ''  }}" name="precio" value="{{ old('precio') }}" required>
									@if ($errors->has('precio'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("precio")}}</strong>
										</span>
									@endif
								</div>
							</div>


							<div class="form-group row field_wrapper">
								<label for='uva' class="col-md-4 col-form-label text-md-right">Uva:</label>
								<div class="input-group col-md-6">
							        <input type="file" name="imagen[]" class="file-input" accept="image/*">
							        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i></a>
							    </div>
							</div>



						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar producto
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
@section('script')

	<script>
		$(document).ready(function(){
		    var maxField = 10; //Input fields increment limitation
		    var addButton = $('.add_button'); //Add button selector
		    var wrapper = $('.field_wrapper'); //Input field wrapper
		    var fieldHTML = '<div class="input-group offset-md-4 col-md-6"> <select id="uva" class="form-control" name="uva[]"><option value="">Seleccione su uva</option></select><input type="text" placeholder="Hectareas" class="form-control" name="hectarea[]" value=""/><div class="input-group-append"><span class="input-group-text"><strong>ha</strong></span></div><a href="javascript:void(0);" class="remove_button" title="Add field"><i class="fas fa-minus-circle"></i></a></div>'; //New input field html 
		    var x = 1; //Initial field counter is 1
		    
		    //Once add button is clicked
		    $(addButton).click(function(){
		        //Check maximum number of input fields
		        if(x < maxField){ 
		            x++; //Increment field counter
		            $(wrapper).append(fieldHTML); //Add field html
		        }
		    });
		    
		    //Once remove button is clicked
		    $(wrapper).on('click', '.remove_button', function(e){
		        e.preventDefault();
		        $(this).parent('div').remove(); //Remove field html
		        x--; //Decrement field counter
		    });
		});
	</script>	
   
@endsection