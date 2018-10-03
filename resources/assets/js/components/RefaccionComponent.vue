<template>
	<div id="refaccion">
		<div class="card">
			<div class="card-body">
				<h1>Refacciones:</h1>
				<div class="row">
					<div class="col-4 col-md-4 col-sm-4 col-xs-4 mr-3 mt-3 mb-3">
						<button type="button"  data-toggle="modal" data-target="#create" class="btn btn-dark" @click="clearRefacccion()">Agregar refacción</button>
					</div>
				</div>
				
				<div class="row">
					<table class="table table-dark">
					  	<thead>
						    <tr>
				      			<th scope="col">Nombre</th>
						      	<th scope="col">Costo</th>
						      	<th scope="col">Acciones</th>
						    </tr>
					  	</thead>
					  	<tbody>
						    <tr v-for="refaccion in refacciones">
						      	<th scope="row">{{refaccion.nombre}}</th>
					      		<td>${{refaccion.costo}}</td>
						      	<td>
						      		<button class="btn btn-info" data-toggle="modal" data-target="#edit" @click="getRefaccion(refaccion.id)">Editar</button>
						      		<button class="btn btn-danger" @click="confirm(refaccion)">Eliminar</button>
						      	</td>
						    </tr>
			  			</tbody>
					</table>
				</div>
				<!-- <pre>
					{{ $data }}
				</pre> -->
			</div>
		</div>
		<form method="POST" v-on:submit.prevent="setRefaccion(refaccion)">
			<div class="modal fade" id="create">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4>Crear</h4>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="nombre" class="col-form-label text-md-right">Nombre de la revisión:</label>
								<input type="text" id="nombre" name="nombre" v-model="refaccion.nombre" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="costo" class="col-form-label text-md-right">Costo de la revisión:</label>
								<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input type="number" step="0.01" id="costo" name="costo" v-model="refaccion.costo" class="form-control" required>
								<div class="input-group-append">
								    <span class="input-group-text">MXN</span>
								 </div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-primary" value="Guardar">
						</div>
					</div>
				</div>
			</div>
		</form>

		<form method="PUT" v-on:submit.prevent="updateRefaccion(refaccion.id,refaccion)">
			<div class="modal fade" id="edit">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4>Crear</h4>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="nombre" class="col-form-label text-md-right">Nombre de la revisión:</label>
								<input type="text" id="nombre" name="nombre" v-model="refaccion.nombre" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="costo" class="col-form-label text-md-right">Costo de la revisión:</label>
								<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input type="number" step="0.01" id="costo" name="costo" v-model="refaccion.costo" class="form-control" required>
								<div class="input-group-append">
								    <span class="input-group-text">MXN</span>
								 </div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-primary" value="Guardar">
						</div>
					</div>
				</div>
			</div>
		</form>

		<div class="modal fade" id="delete">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4>Crear</h4>
						<button type="button" class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<label>¿Deseas eliminar esta revisión?</label>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" @click="deleteRefaccion(refaccion.id)">Eliminar</button>
						<button class="btn btn-success" @click="cancel()">Regresar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
function Refaccion({id,nombre,costo}){
	this.id = id;
	this.nombre = nombre;
	this.costo = costo;
}
    export default {
    	data(){
    		return{
    			refacciones: [],
    			refaccion: {'id':'', 'nombre':'','costo':''},
    			mute: false,
    			
    		}
    	},
    	created() {
    		this.getRefacciones();
    	},
    	methods:{
    		
    		getRefacciones(){
    			let url= "refacciones";
    			axios.get(url).then(response=>{
    				let datas = response.data.refacciones;
    				datas.forEach(refaccion=>{
    					this.refacciones.push(new Refaccion(refaccion));
    				});
    			});
    		},
    		setRefaccion(params){
    			let url = "refaccion"
    			axios.post(url,{params}).then((response)=>{
    				if(response.data.refaccion){
    					$('#create').modal('hide');
    					let refaccion = response.data.refaccion;
    					this.refacciones.push(new Refaccion(refaccion));
    					this.clearRefacccion();
    				}
    			});
    		},

    		getRefaccion(id){
    			let url = "refaccion/";
    			axios.get(url+id).then(response=>{
    				this.refaccion = response.data.refaccion;
    			})
    		},
    		updateRefaccion(id,params){
    			let url = 'refaccion/';
    			axios.put(url+id,{params}).then((response)=>{
    				$('#edit').modal('hide');
    				let refaccion = this.refacciones.find(refaccion=>refaccion.id=== id);
    				refaccion.nombre = response.data.refaccion.nombre;
    				refaccion.costo = response.data.refaccion.costo
    				this.mute = false
    			})

    		},
    		confirm(params){
    			this.refaccion = params;
    			$("#delete").modal('show');
    		},
    		cancel(){
    			$('#delete').modal('hide');
    			this.clearRefacccion();
    		},
    		clearRefacccion(){
    			this.refaccion = {'id':'','nombre':'','costo':''};
    		},
    		deleteRefaccion(id){
    			let url = "refaccion/";
    			axios.delete(url+id).then((response)=>{
    				$('#delete').modal('hide');
    				let index = this.refacciones.findIndex(refaccion=>refaccion.id === id);
    				this.refacciones.splice(index,1);
    				this.clearRefacccion();

    			});
    		}
    	},
        mounted() {
            console.log('Component mounted.');            
        }
    }
</script>