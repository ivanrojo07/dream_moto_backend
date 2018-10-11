<template>
	<div class="card">
		<div class="card-header">
			<h1>Servicios:</h1>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">fecha</th>
						<th scope="col">Usuario</th>
						<th scope="col">#Serie</th>
						<th scope="col">Km</th>
						<th scope="col">Marca</th>
						<th scope="col">Modelo</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="servicio in servicios">
						<th scope="row">{{ servicio.updated_at | formatDate }}</th>
						<td>{{ servicio.moto.user.name }} {{ servicio.moto.user.appaterno }} {{ servicio.moto.user.apmaterno ? servicio.moto.user.apmaterno : '' }}</td>
						<td>{{ servicio.moto.serie }}</td>
						<td>{{ servicio.moto.km }}</td>
						<td>{{ servicio.moto.marca }}</td>
						<td>{{ servicio.moto.modelo }} {{index}}</td>
						<td>
							<button class="btn btn-dark" data-toggle="collapse" @click="setServicio(servicio)">información del servicio</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="modal fade" id="showservicio">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4>Servicio: {{ servicio.updated_at | formatDate }}</h4>
						<button type="button" class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-4 form-group">
								<h4>Cliente:</h4>
								
							</div>
						</div>
						<div class="row">
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Nombre:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.user.name}}</label>
                            </div>
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Apellido paterno</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.user.appaterno}}</label>
                            </div>
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Apellido materno</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.user.apmaterno}}</label>
                            </div>
							<div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Correo electronico:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.user.email}}</label>
                            </div>
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Telefono:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.user.telefono}}</label>
                            </div>
						</div>
						<div class="row">
							<div class="col-4 form-group">
								<h4>Motocicleta</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Marca:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.marca}}</label>
                            </div>
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Modelo:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.modelo}}</label>
                            </div>
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Versión:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.version}}</label>
                            </div>
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Año:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.anio}}</label>
                            </div>
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Número de serie:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.serie}}</label>
                            </div>
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Kilometros recorridos:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.moto.km}}</label>
                            </div>
						</div>
						<div class="row">
							<div class="col-4 form-group">
								<h4>Datos del servicio:</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Estado de la motocicleta:</label>
                                <label name="email" class="form-control text-md-left">{{servicio.estado}}</label>
                            </div>
                            <div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Detalles de la motocicleta:</label>
                                <textarea name="email" rows="5" class="form-control text-md-left" disabled>{{servicio.detalle}}</textarea>
                            </div>
							<div class="col-4 form-group">
                                <label for="name" class="col-form-label text-md-right">Comentarios del mecanico:</label>
                                <textarea name="email" rows="5" class="form-control text-md-left" disabled>{{servicio.comentario}}</textarea>
                            </div>
						</div>
						<div class="row">
							<div class="col-4 form-group">
								<h4>Servicios realizados:</h4>
							</div>
						</div>
						<div class="row mr-5 ml-5">
							<table class="table">
							  <thead class="thead-dark">
							    <tr>
							      <th scope="col">Tipo de servicio:</th>
							      <th scope="col">Servicio</th>
							      <th scope="col">Costo</th>
							      <th scope="col">Comentario</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr v-for="inserv in servicio.in_servicio">
							      <th scope="row">{{inserv.tipo_servicio}}</th>
							      <td>{{inserv.nombre}}</td>
							      <td>{{inserv.costo}}</td>
							      <td>{{inserv.comentario}}</td>
							    </tr>
							    <tr>
							    	<th></th>
							    	<th>Total de mano de obra:</th>
							    	<th>{{servicio.costo_obra}}</th>
							    	<th></th>
							    </tr>
							    <tr>
							    	<th></th>
							    	<th>Total de revisiones:</th>
							    	<th>{{servicio.costo_revision}}</th>
							    	<th></th>
							    </tr>
							    <tr>
							    	<th></th>
							    	<th>Total de refacciones:</th>
							    	<th>{{servicio.costo_refaccion}}</th>
							    	<th></th>
							    </tr>
							    <tr>
							    	<th></th>
							    	<th>Total:</th>
							    	<th>{{servicio.total}}</th>
							    	<th></th>
							    </tr>
							  </tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <pre>
			{{$data}}
		</pre> -->
	</div>
</template>
<script>
    export default {
    	data(){
    		return {
    			servicio:{
				      "id": null,
				      "estado": "",
				      "comentario": "",
				      "detalle": "",
				      "costo_obra": "",
				      "costo_revision": "",
				      "costo_refaccion": "",
				      "total": "",
				      "updated_at": "",
				      "in_servicio": [
				        {
				          "id": null,
				          "tipo_servicio": "",
				          "servicio_id": null,
				          "nombre": "",
				          "costo": "",
				          "comentario": null
				        },
				        {
				          "id": null,
				          "tipo_servicio": "",
				          "servicio_id": null,
				          "nombre": "",
				          "costo": "",
				          "comentario": ""
				        }
				      ],
				      "moto": {
				        "id": null,
				        "marca": "",
				        "modelo": "",
				        "version": "",
				        "user_id": null,
				        "anio": null,
				        "km": null,
				        "motor": null,
				        "serie": "",
				        "user": {
				          "id": null,
				          "username": "",
				          "name": "",
				          "appaterno": "",
				          "apmaterno": "",
				          "email": "",
				          "telefono": ""
				        }
				      }
				    },
    			servicios:[]
    		}
    	},
    	methods:{
    		setServicio(servicio){
    			this.servicio = servicio;
    			$("#showservicio").modal("show");
    		},
    		getServicios(){
    			console.log('getServicios');
    			let url = "getService";
    			axios.get(url)
    				.then(res=>{
    					this.servicios= res.data.servicios;
    				})
    				.catch(err=>{
    					console.log(err);
    				});
    		},
    	},
    	filters:{
    		'formatDate':function(val){
    			if(val == null) return '';
    			var date = new Date(val);
    			// console.log(date);
    			return date.getDate()+"/"+date.getMonth()+'/'+date.getFullYear();
			}	
    	},
    	created(){
    		this.getServicios();
    		
    	},
        mounted() {
            console.log('Component mounted');

        }
    }
</script>