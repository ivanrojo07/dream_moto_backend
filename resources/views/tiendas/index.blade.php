@extends('layouts.app')
@section('content')
<div class="container-fluid" align="center">
	<main class="py-4" id="app">
       <div class="container">
		  <div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header pad">
						Tiendas
					</div>
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a class="nav-link active" href="#tienda" data-toggle="tab">Registrar Tienda</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#prod" data-toggle="tab">Productos</a>
						</li>
						
					</ul>
				  <div class="tab-content">
					<div class="card-body tab-pane active" id="tienda">
						<form method="POST" action="http://byw.from-tn.com/pwm/vinicolas">
							<input type="hidden" name="_token" value="5Qxhe1VDy7ZLRTQUwrwHSN6jY6lu9DlLM11yEmQ4">
							
							<div class="form-group row">
								<label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de la Tienda:</label>
								<div class="col-md-6">
									<input id="nombre" type="text" class="form-control " name="nombre" value="" required autofocus="">
																	</div>
							</div>
							<div class="form-group row">
								<label for="distinciones" class="col-md-4 col-form-label text-md-right">Descripcion de la Tienda:</label>
								<div class="col-md-6">
									<textarea id="distinciones" type="text" class="form-control " name="distinciones" value="" ></textarea>
																	</div>
							</div>
							<div class="form-group row">
								<label for="inicio" class="col-md-4 col-form-label text-md-right">Nombre (Completo) del Contacto:</label>
								<div class="col-md-6">
									<input id="inicio" type="text" min="1500" max="2018" class="form-control " name="inicio" value="" required>
																	</div>
							</div>
							<div class="form-group row">		
								<label for="filosofia" class="col-md-4 col-form-label text-md-right">Puesto del Contacto:</label>
								<div class="col-md-6">
									<textarea id="filosofia" type="text" class="form-control " name="filosofia" value="" required></textarea>
																	</div>
							</div>
							<div class="form-group row">
								<label for="locacion" class="col-md-4 col-form-label text-md-right">Correo Electrónico del Contacto:</label>
								<div class="col-md-6">
									<input id="locacion" type="mail" class="form-control " name="locacion" value="" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="enologo" class="col-md-4 col-form-label text-md-right">Teléfono Celular del Contacto:</label>
								<div class="col-md-6">
									<input id="enologo" type="number" class="form-control " name="enologo" value="" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="wine_maker" class="col-md-4 col-form-label text-md-right">Teléfono de la Tienda:</label>
								<div class="col-md-6">
									<input id="wine_maker" type="number" class="form-control " name="wine_maker" value="">
								</div>
							</div>
							<div class="form-group row">
								<label for="wine_maker" class="col-md-4 col-form-label text-md-right">Localización:</label>
								<div class="col-md-6">
									<iframe src="https://www.google.com.mx/maps/@19.4860022,-99.1157951,15z"></iframe>
								</div>
							</div>
							
							
							
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar Tienda
                                </button>
                            </div>
                        </div>
						</form>
					</div>
					<div class="card-body tab-pane" id="prod">
						<h1>Productos</h1>
					</div>
				 </div>
				</div>
			</div>
		</div>
	</div>
        </main>

	
</div>
@endsection