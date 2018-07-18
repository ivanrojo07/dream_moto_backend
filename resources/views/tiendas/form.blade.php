@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						Tienda
					</div>
					<div class="card-body">
						<form method="POST" action="{{ $edit == false ? route('tiendas.store') : route('tiendas.update',$tienda) }}">
							@csrf

							@if ($edit == true)
								{{-- expr --}}
								<input type="hidden" name="_method" value="PUT">
							@endif

							<div class="form-group row">
								<label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de la tienda:</label>
								<div class="col-md-6">
									<input id="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : ''  }}" name="nombre" value="{{ $edit ? $tienda->nombre : old('nombre') }}" required autofocus="">
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
									<textarea id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : ''  }}" name="descripcion" value="{{ $edit ? $tienda->descripcion : old('descripcion') }}" >{{ $edit ? $tienda->descripcion : old('descripcion') }}</textarea>
									@if ($errors->has('descripcion'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("descripcion")}}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="locacion" class="col-md-4 col-form-label text-md-right">Locación del tienda:</label>
								<div class="col-md-6">
									<input id="locacion" type="text" class="form-control {{ $errors->has('locacion') ? ' is-invalid' : ''  }}" name="locacion" value="{{ $edit ? $tienda->locacion : old('locacion') }}" required>
									<input type="hidden" name="lat" id="latitud" value="">
									<input type="hidden" name="long" id="longitud" value="">
									@if ($errors->has('locacion'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("locacion")}}</strong>
										</span>
									@endif
								</div>
								<input name="mapinput" id="pac-input" class="form-control" type="text" style="width: 85%;">
								<div id="map" style="height: 400px;width: 90%;margin-left: 30px;"></div>
							</div>
							<div class="form-group row">
								<label for="nombre_contacto" class="col-md-4 col-form-label text-md-right">Nombre completo del contacto:</label>
								<div class="col-md-6">
									<input id="nombre_contacto" type="text" class="form-control {{ $errors->has('nombre_contacto') ? ' is-invalid' : ''  }}" name="nombre_contacto" value="{{ $edit ? $tienda->nombre_contacto : old('nombre_contacto') }}" required>
									@if ($errors->has('nombre_contacto'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("nombre_contacto")}}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="puesto_contacto" class="col-md-4 col-form-label text-md-right">Puesto del contacto:</label>
								<div class="col-md-6">
									<input id="puesto_contacto" type="text" class="form-control {{ $errors->has('puesto_contacto') ? ' is-invalid' : ''  }}" name="puesto_contacto" value="{{ $edit ? $tienda->puesto_contacto : old('puesto_contacto') }}" required>
									@if ($errors->has('puesto_contacto'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("puesto_contacto")}}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="correo_contacto" class="col-md-4 col-form-label text-md-right">Correo electronico del contacto:</label>
								<div class="col-md-6">
									<input id="correo_contacto" type="text" class="form-control {{ $errors->has('correo_contacto') ? ' is-invalid' : ''  }}" name="correo_contacto" value="{{ $edit ? $tienda->correo_contacto : old('correo_contacto') }}" required>
									@if ($errors->has('correo_contacto'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("correo_contacto")}}</strong>
										</span>
									@endif
								</div>
								<label for="telefono_contacto" class="col-md-4 col-form-label text-md-right">Telefono celular del contacto:</label>
								<div class="col-md-6">
									<input id="telefono_contacto" type="text" class="form-control {{ $errors->has('telefono_contacto') ? ' is-invalid' : ''  }}" name="telefono_contacto" value="{{ $edit ? $tienda->telefono_contacto : old('telefono_contacto') }}" required>
									@if ($errors->has('telefono_contacto'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("telefono_contacto")}}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="telefono" class="col-md-4 col-form-label text-md-right">Telefono de la tienda:</label>
								<div class="col-md-6">
									<input id="telefono" type="text" class="form-control {{ $errors->has('telefono') ? ' is-invalid' : ''  }}" name="telefono" value="{{ $edit ? $tienda->telefono : old('telefono') }}" required>
									@if ($errors->has('telefono'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("telefono")}}</strong>
										</span>
									@endif
								</div>
							</div>
							

						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar tienda
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
	{{-- expr --}}
	<script type="text/javascript">
		function disabled(text) {
			// body...
			alert("Por favor registrar la tienda antes de agregar las "+text);
		}
	</script>
    {{-- <script> --}}
    <script>
    var map;
    function loadScript(src,callback){
        var script = document.createElement("script");
        script.type = "text/javascript";
        if(callback)script.onload=callback;
        document.getElementsByTagName("head")[0].appendChild(script);
        script.src = src;
    }
    loadScript('http://maps.googleapis.com/maps/api/js?v=3&sensor=false&callback=initialize&libraries=places&key=AIzaSyDB7vM7QxW9j-ez6hclJrkwMdAC6RzTbxc',
            function(){/*log('google-loader has been loaded, but not the maps-API ');*/});
    function initialize() 
    {
      //log('maps-API has been loaded, ready to use');
      var mapOptions = {
          zoom: 8,
          center: new google.maps.LatLng(19.390858961426655,-99.14361265000002),
          mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById('map'),
              mapOptions);
      var marker = new google.maps.Marker({
          map: map,
          draggable:true,
          anchorPoint: new google.maps.Point(0, -29)
      });
      marker.setMap( map );
      var input = /** @type {!HTMLInputElement} */(
              document.getElementById('pac-input'));
      google.maps.event.addDomListener(input, 'keydown', function(e) {
          if (e.keyCode == 13) {
              e.preventDefault();
          }
      });
      google.maps.event.addListener(map, 'click', function(event) {
          marker.setPosition( event.latLng );
          map.panTo( event.latLng );
          var geocoder = geocoder = new google.maps.Geocoder();
          geocoder.geocode({ 'latLng': event.latLng }, function (results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  if (results[0]) {
                      document.getElementById('latitud').value = marker.position.lat();
                      document.getElementById('longitud').value = marker.position.lng();
                      document.getElementById('locacion').value = results[0].formatted_address;
                  }
              }
          });
      });
      var types = document.getElementById('type-selector');
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      var infowindow = new google.maps.InfoWindow();

      if(navigator.geolocation) {
          browserSupportFlag = true;
          navigator.geolocation.getCurrentPosition(function(position) {
              initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
              map.setCenter(initialLocation);
              map.setZoom(17);
          }, function() {
              map.setCenter(new google.maps.LatLng(19.390858961426655,-99.14361265000002));
              map.setZoom(17);

          });
      }
      // Browser doesn't support Geolocation
      else {
          browserSupportFlag = false;
          map.setCenter(new google.maps.LatLng(19.390858961426655,-99.14361265000002));
          map.setZoom(17);
      }

      autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
              window.alert("Error");
              return;
          }
          // If the place has a geometry, then present it on a map.

          if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
          } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
              url: place.icon,
              size: new google.maps.Size(50, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
              address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
              ].join(' ');
          }
          document.getElementById('locacion').value = address;
          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
          document.getElementById('latitud').value = marker.position.lat();
          document.getElementById('longitud').value = marker.position.lng();
          document.getElementById('locacion').value = address;
      });
    }
	</script>
@endsection