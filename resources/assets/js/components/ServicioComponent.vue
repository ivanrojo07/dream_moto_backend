<template>
	<div>
		<div class="card">
			<div class="card-body">
				<h1>Nuevo servicio:</h1>
                <div class="card">
                    <div class="card-header">
                        <h4>Datos del cliente:</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" @submit.prevent="saveUser(user)">
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Correo electronico</label>
                                    <input type="email" v-if="!user_read"  name="email" @change="searchEmail(user.email)" v-model="user.email" class="form-control" required>
                                    <label name="email" v-if="user_read" class="form-control text-md-left">{{user.email}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Nombre</label>
                                    <input v-if="!user_read" type="text" name="name" v-model="user.name" class="form-control" required>
                                    <label name="name" v-if="user_read" class="form-control text-md-left">{{user.name}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Apellido Paterno</label>
                                    <input type="text" v-if="!user_read" name="appaterno" v-model="user.appaterno" class="form-control" required>
                                    <label name="appaterno" v-if="user_read" class="form-control text-md-left">{{user.appaterno}}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Apellido Materno</label>
                                    <input type="text" v-if="!user_read" name="apmaterno" v-model="user.apmaterno" class="form-control" required>
                                    <label name="appaterno" v-if="user_read" class="form-control text-md-left">{{user.apmaterno}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Número telefonico/celular</label>
                                    <input type="text" v-if="!user_read" name="telefono" v-model="user.telefono" class="form-control" required>
                                    <label name="telefono" v-if="user_read" class="form-control text-md-left">{{user.telefono}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <div class="col-12">
                                        <button type="button" v-if="user_read && !save" @click="clearUser()" class="btn btn-dark">Cambiar correo</button>
                                        <button type="button" v-if="user_read && !save" @click="selectUser()" class="btn btn-dark">Guardar usuario</button>
                                        <input type="submit" v-if="!user_read && !save" class="btn btn-dark" value="Guardar usuario">
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card" v-if="save">
                    <div class="card-header">
                        Datos de la moto en servicio:
                    </div>
                    <div class="card-body">
                        <form method="POST" @submit.prevent="saveMoto(moto)">
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Marca</label>
                                    <input type="email" v-if="!moto_read"  name="email" @change="searchEmail(user.email)" v-model="user.email" class="form-control" required>
                                    <label name="email" v-if="moto_read" class="form-control text-md-left">{{user.email}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Nombre</label>
                                    <input v-if="!moto_read" type="text" name="name" v-model="user.name" class="form-control" required>
                                    <label name="name" v-if="moto_read" class="form-control text-md-left">{{user.name}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Apellido Paterno</label>
                                    <input type="text" v-if="!moto_read" name="appaterno" v-model="user.appaterno" class="form-control" required>
                                    <label name="appaterno" v-if="moto_read" class="form-control text-md-left">{{user.appaterno}}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Apellido Materno</label>
                                    <input type="text" v-if="!moto_read" name="apmaterno" v-model="user.apmaterno" class="form-control" required>
                                    <label name="appaterno" v-if="moto_read" class="form-control text-md-left">{{user.apmaterno}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Número telefonico/celular</label>
                                    <input type="text" v-if="!moto_read" name="telefono" v-model="user.telefono" class="form-control" required>
                                    <label name="telefono" v-if="moto_read" class="form-control text-md-left">{{user.telefono}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <div class="col-12">
                                        <button type="button" v-if="moto_read && !saveM" @click="selectUser()" class="btn btn-dark">Guardar motocicleta</button>
                                        <input type="submit" v-if="!moto_read && !saveM" class="btn btn-dark" value="Guardar motocicleta">
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
        <pre>
            {{ $data }}
        </pre>
        </div>
	</div>
</template>

<script>
function User({id,name,appaterno,apmaterno,email,telefono}) {
    // body...
    this.id=id;
    this.name = name;
    this.appaterno=appaterno;
    this.apmaterno=apmaterno;
    this.email = email;
    this.telefono = telefono;
}
function Moto({id,marca,modelo,version,user_id,anio,km,serie}){
    this.id = id;
    this.marca = marca;
    this.modelo = modelo;
    this.version = version;
    this.user_id = user_id;
    this.anio = anio;
    this.km = km;
    this.serie = serie;

}
function Servicio({id,moto_id,estado,comentario,detalle,costo_obra,costo_revision,costo_refaccion,total}){
	this.id = id;
	this.moto_id = moto_id;
	this.estado = estado;
	this.comentario = comentario;
	this.detalle = detalle;
	this.costo_obra = costo_obra;
	this.costo_revision = costo_revision;
	this.costo_refaccion = costo_refaccion;
	this.total = total;
}
function inServicio({id,tipo_servicio,servicio_id,nombre,costo,comentario}){
	this.id = id;
	this.tipo_servicio = tipo_servicio;
	this.servicio_id = servicio_id;
	this.nombre = nombre;
	this.costo = costo;
	this.comentario = comentario;
}

function Servicio({id,nombre,costo}){
	this.id = id;
	this.nombre = nombre;
	this.costo = costo;
}
    export default {
    	data(){
    		return{
                user:{"id":"","name":"","appaterno":"","apmaterno":"","email":"","telefono":""},
                moto:{"id":"","marca":"","modelo":"","version":"","user_id":"","anio":"","km":"","serie":""},
                servicio :{"id":"","moto_id":"","estado":"","comentario":"","detalle":"","costo_obra":"","costo_revision":"","costo_refaccion":"","total":""},
                inServicios:[],
                revisiones:[],
                revision:{'id':'', 'nombre':'','costo':'','comentarios':""},
                refacciones: [],
                refaccion: {'id':'', 'nombre':'','costo':'','comentarios':""},
                save:false,
                user_read : false,
                saveM:false,
                moto_read : false,
    		}
    	},
    	created() {
    		this.getRefacciones();
            this.getRevisiones();
    	},
    	methods:{
            selectUser(){
                this.save = true;
                this.user_read= true;
            },
            saveUser(user){
                let url = 'saveUser';
                axios.post(url,user).then(response=>{
                    console.log(response);
                    if(response.data.usuario){
                        this.user = new User(response.data.usuario);
                        this.save = true;
                        this.user_read = true;
                    }
                }).
                catch(error=>{
                    console.log(error);
                })
                
            },
            searchEmail(email){
                let url = "searchUser";
                axios.post(url,{email}).then(response=>{
                    console.log(response);
                    this.user = response.data.user;
                    this.user_read = true;
                    // this.save= true;
                }).catch(error=>{
                    console.log(error);
                    this.user_read = false;
                    this.user = {id:"",name:"",appaterno:"",apmaterno:"",email:email,telefono:""};
                });
            },
            clearUser(){
                this.user =  {id:"",name:"",appaterno:"",apmaterno:"",email:"",telefono:""};
                this.user_read = false;
                this.save= false;
            },
    		getRefacciones(){
    			let url= "precargas/refacciones";
    			axios.get(url).then(response=>{
    				this.refacciones=response.data.refacciones;
    			});
    		},
    		clearRefacccion(){
                this.refaccion = {'id':'', 'nombre':'','costo':'','comentarios':""};
            },
            getRevisiones(){
                let url = "precargas/revisiones";
                axios.get(url).then(response=>{
                    this.revisiones=response.data.revisiones;
                })
            },
            clearRevision(){
                this.revision = {'id':'', 'nombre':'','costo':'','comentarios':""};
            },
    	},
        mounted() {
            console.log('Component mounted.');            
        }
    }
</script>