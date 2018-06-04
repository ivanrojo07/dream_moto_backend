@extends('layouts.app')
@section('content')
<div class="container-fluid" align="center">
	<main class="py-4" id="app">
       <div class="container">
		  <div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header pad">
						Fomulario de Contacto
					</div>
				<div class="tab-content">
					<div class="card-body tab-pane active" id="tienda">
						<form method="POST" action="http://byw.from-tn.com/pwm/vinicolas">
							<input type="hidden" name="_token" value="5Qxhe1VDy7ZLRTQUwrwHSN6jY6lu9DlLM11yEmQ4">
							
							<div class="form-group row">
								<label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre (Completo):</label>
								<div class="col-md-6">
									<input id="nombre" type="text" class="form-control " name="nombre" value="" required autofocus="">
																	</div>
							</div>
							<div class="form-group row">
								<label for="distinciones" class="col-md-4 col-form-label text-md-right">Asunto:</label>
								<div class="col-md-6">
									<textarea id="distinciones" type="text" class="form-control " name="distinciones" value="" ></textarea>
																	</div>
							</div>
							<div class="form-group row">
								<label for="inicio" class="col-md-4 col-form-label text-md-right">Correo Electrónico:</label>
								<div class="col-md-6">
									<input id="inicio" type="mail" class="form-control " name="inicio" value="" required>
																	</div>
							</div>
							
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
						</form>
					</div>
					
				 </div>
				</div>
			</div>
		</div>
	</div>
        </main>
</div>
@endsection