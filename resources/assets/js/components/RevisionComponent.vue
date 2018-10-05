<template>
	<div>
		<div class="card">
			<div class="card-body">
				<h1>Revisiones:</h1>
				<div class="row">
					<div class="col-4 col-md-4 col-sm-4 col-xs-4 mr-3 mt-3 mb-3">
						<button type="button"  data-toggle="modal" data-target="#create" class="btn btn-dark" @click="clearRevision()">Agregar revisión</button>
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
						    <tr v-for="revision in revisiones">
						      	<th scope="row">{{revision.nombre}}</th>
					      		<td>${{revision.costo}}</td>
						      	<td>
						      		<button class="btn btn-info" data-toggle="modal" data-target="#edit" @click="getRevision(revision.id)">Editar</button>
						      		<button class="btn btn-danger" @click="confirm(revision)">Eliminar</button>
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
		<form method="POST" v-on:submit.prevent="setRevision(revision)">
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
								<input type="text" id="nombre" name="nombre" v-model="revision.nombre" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="costo" class="col-form-label text-md-right">Costo de la revisión:</label>
								<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input type="number" step="0.01" id="costo" name="costo" v-model="revision.costo" class="form-control" required>
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

		<form method="PUT" v-on:submit.prevent="updateRevision(revision.id,revision)">
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
								<input type="text" id="nombre" name="nombre" v-model="revision.nombre" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="costo" class="col-form-label text-md-right">Costo de la revisión:</label>
								<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<input type="number" step="0.01" id="costo" name="costo" v-model="revision.costo" class="form-control" required>
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
						<button class="btn btn-danger" @click="deleteRevision(revision.id)">Eliminar</button>
						<button class="btn btn-success" @click="cancel()">Regresar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
function Revision({id,nombre,costo}){
	this.id = id;
	this.nombre = nombre;
	this.costo = costo;
}
    export default {
    	data(){
    		return{
    			revisiones: [],
    			revision: {'id':'', 'nombre':'','costo':''},
    			mute: false,
    			
    		}
    	},
    	created() {
    		this.getRevisiones();
    	},
    	methods:{
    		
    		getRevisiones(){
    			let url= "revisiones";
    			axios.get(url).then(response=>{
    				let datas = response.data.revisiones;
    				datas.forEach(revision=>{
    					this.revisiones.push(new Revision(revision));
    				});
    			});
    		},
    		setRevision(params){
    			let url = "revision"
    			axios.post(url,{params}).then((response)=>{
    				if(response.data.revision){
    					$('#create').modal('hide');
    					let revision = response.data.revision;
    					this.revisiones.push(new Revision(revision));
    					this.clearRevision();
    				}
    			});
    		},

    		getRevision(id){
    			let url = "revision/";
    			axios.get(url+id).then(response=>{
    				this.revision = response.data.revision;
    			})
    		},
    		updateRevision(id,params){
    			let url = 'revision/';
    			axios.put(url+id,{params}).then((response)=>{
    				$('#edit').modal('hide');
    				let revision = this.revisiones.find(revision=>revision.id=== id);
    				revision.nombre = response.data.revision.nombre;
    				revision.costo = response.data.revision.costo
    				this.mute = false
    			})

    		},
    		confirm(params){
    			this.revision = params;
    			$("#delete").modal('show');
    		},
    		cancel(){
    			$('#delete').modal('hide');
    			this.clearRevision();
    		},
    		clearRevision(){
    			this.revision = {'id':'','nombre':'','costo':''};
    		},
    		deleteRevision(id){
    			let url = "revision/";
    			axios.delete(url+id).then((response)=>{
    				$('#delete').modal('hide');
    				let index = this.revisiones.findIndex(revision=>revision.id === id);
    				this.revisiones.splice(index,1);
    				this.clearRevision();

    			});
    		}
    	},
        mounted() {
            console.log('Component mounted.');            
        }
    }
</script>