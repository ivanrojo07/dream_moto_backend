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
                                    <label for="name" class="col-form-label text-md-right">Marca:</label>
                                    <select class="form-control" name="marca" v-if="!saveM" v-model="searchMarca" required>
                                        <option value="">Seleccione la marca</option>
                                        <option v-for="marca in marcas" v-model="marca.nombre">{{marca.nombre}}</option>
                                    </select>

                                    <label name="marca" v-if="saveM" class="form-control text-md-left">{{moto.marca}}</label>
                                </div>
                                <div class="col-4 form-group" v-if="!searchMarca">
                                    <label for="otro" class="col-form-label text-md-right">Otra marca:</label>
                                 <input type="text" name="otro" class="form-control" v-model="moto.marca">
                                </div>
                                 <div class="col-4 form-group">
                                    <label for="serie" class="col-form-label text-md-right">Númeron de serie:</label>
                                    <input type="text" v-if="!saveM" name="serie" v-model="moto.serie" class="form-control" required>
                                    <label name="serie" v-if="saveM" class="form-control text-md-left">{{moto.serie}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <label for="name" class="col-form-label text-md-right">Modelo:</label>
                                    <input v-if="!saveM" type="text" onclick="this.select()" name="modelo" v-model="moto.modelo" class="form-control" required>
                                    <label name="modelo" v-if="saveM" class="form-control text-md-left">{{moto.modelo}}</label>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label for="version" class="col-form-label text-md-right">Versión:</label>
                                    <input type="text" v-if="!saveM" name="version" v-model="moto.version" class="form-control" required>
                                    <label name="version" v-if="saveM" class="form-control text-md-left">{{moto.version}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <label for="anio" class="col-form-label text-md-right">Año:</label>
                                    <input type="text" v-if="!saveM" name="anio" v-model="moto.anio" class="form-control" required>
                                    <label name="anio" v-if="saveM" class="form-control text-md-left">{{moto.anio}}</label>
                                </div>
                               
                                <div class="col-4 form-group">
                                    <label for="km" class="col-form-label text-md-right">Kilometros:</label>
                                    <input type="text" v-if="!saveM" name="km" v-model="moto.km" class="form-control" required>
                                    <label name="km" v-if="saveM" class="form-control text-md-left">{{moto.km}}</label>
                                </div>
                                <div class="col-4 form-group">
                                    <div class="col-12">
                                        <button type="button" v-if="!saveM" @click="selectMoto()" class="btn btn-dark">Guardar motocicleta</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card" v-if="saveM">
                    <div class="card-header">
                        Servicio:
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <label for="estado" class="col-form-label text-md-center">Estado de la motocicleta:</label>
                                </div>
                                <label name="estado" v-if="saveS" class="form-control text-md-left disabled" disabled>{{servicio.estado}}</label>
                                <div v-if="!saveS" class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="excelente" name="estado"  value="excelente" v-model="servicio.estado" class="custom-control-input">
                                    <label class="custom-control-label" for="excelente">Excelente</label>
                                </div>
                                <div v-if="!saveS" class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="bueno" name="estado" value="bueno" v-model="servicio.estado" class="custom-control-input">
                                    <label class="custom-control-label" for="bueno">Bueno</label>
                                </div>
                                <div v-if="!saveS" class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="regular" name="estado" value="regular" v-model="servicio.estado" class="custom-control-input">
                                    <label class="custom-control-label" for="regular">Regular</label>
                                </div>
                                <div v-if="!saveS" class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="malo" name="estado" value="malo" v-model="servicio.estado" class="custom-control-input">
                                    <label class="custom-control-label" for="malo">Malo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 form-group">
                                <label for="comentario" class="col-form-label text-md-right">Comentarios:</label>
                                <textarea rows="5"  name="comentario" v-model="servicio.comentario" class="form-control" :disabled="saveS"></textarea>
                            </div>
                            <div class="col-4 form-group">
                                <label for="detalle" class="col-form-label text-md-right">Problema de la motocicleta:</label>
                                <textarea rows="5"  name="detalle" v-model="servicio.detalle" class="form-control" :disabled="saveS"></textarea>
                            </div>
                            <div class="col-4 mt-5 form-group">
                                    <div class="col-12">
                                        <button type="button" v-if="!saveS" @click="saveService()" class="btn btn-dark">Guardar servicio</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="card" v-if="saveS">
                    <div class="card-header">
                        Servicio a realizar:
                    </div>
                    <div class="card-body">
                        <div class="card-header">
                            Revisiones o reparaciones:
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-5 col-md-4 col-lg-4 col-xl-4 form-group">
                                <label for="revision" class="col-form-label text-md-right">Revisión/Reparacion:</label>
                                <select class="form-control" name="revision" v-model="searchrev" required>
                                    <option value="">Otro</option>
                                    <option v-for="revision in revisiones" v-model="revision.nombre">{{revision.nombre}}</option>
                                </select>
                            </div>
                            <div v-if="!searchrev" class="col-4 col-sm-5 col-md-4 col-lg-4 col-xl-4 form-group">
                                 <label for="otro" class="col-form-label text-md-right">Otro:</label>
                                 <input type="text" name="otro" class="form-control" v-model="revisionS.nombre">
                             </div>
                             <div class="col-4 col-sm-5 col-md-4 col-lg-4 col-xl-4 form-group">
                                 <label for="costo" class="col-form-label text-md-right">Costo:</label>
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" step="0.01" v-model="revisionS.costo" class="form-control" name="obra">
                                    <div class="input-group-append">
                                        <span class="input-group-text">MXN</span>
                                    </div>
                                </div>
                             </div>
                             <div class="col-4 col-sm-5 col-md-4 col-lg-4 col-xl-4 form-group">
                                 <label for="comentario" class="col-form-label text-md-right">Comentario:</label>
                                 <textarea name="comentario" class="form-control" rows="5" v-model="revisionS.comentario"></textarea>
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <!-- <th scope="col">#</th> -->
                                            <th scope="col">Revisión</th>
                                            <th scope="col">Costo</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="inserrev in inServicioRev">
                                            <th scope="row" >{{inserrev.nombre}}</th>
                                            <td>{{inserrev.costo}}</td>
                                            <td>
                                                <button class="btn btn-danger" @click="deleteInServicio(inserrev.id)">Eliminar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-dark" @click="setRevision(revisionS)">Agregar</button>

                                <div class="mt-5">
                                    <label class="col-form-label-lg">Total de revisiones: ${{servicio.costo_revision}} MXN</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-header">
                            Refacciones:
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-5 col-md-4 col-lg-4 col-xl-4 form-group">
                                <label for="refaccion" class="col-form-label text-md-right">Refacción:</label>
                                <select class="form-control" name="refaccion" v-model="searchref" required>
                                    <option value="">Otro</option>
                                    <option v-for="refaccion in refacciones" v-model="refaccion.nombre">{{refaccion.nombre}}</option>
                                </select>
                            </div>
                             <div v-if="!searchref" class="col-4 col-sm-5 col-md-4 col-lg-4 col-xl-4 form-group">
                                 <label for="otro" class="col-form-label text-md-right">Otro:</label>
                                 <input type="text" name="otro" class="form-control" v-model="refaccion.nombre">
                             </div>
                             <div class="col-4 col-sm-5 col-md-4 col-lg-4 col-xl-4 form-group">
                                 <label for="costo" class="col-form-label text-md-right">Costo:</label>
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" step="0.01" v-model="refaccion.costo" class="form-control" name="obra">
                                    <div class="input-group-append">
                                        <span class="input-group-text">MXN</span>
                                    </div>
                                </div>
                             </div>
                             <div class="col-4 col-sm-5 col-md-4 col-lg-4 col-xl-4 form-group">
                                 <label for="comentario" class="col-form-label text-md-right">Comentario:</label>
                                 <textarea name="comentario" class="form-control" rows="5" v-model="refaccion.comentario"></textarea>
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <!-- <th scope="col">#</th> -->
                                            <th scope="col">Refacción</th>
                                            <th scope="col">Costo</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="inserref in inServicioRef">
                                            <th scope="row" >{{inserref.nombre}}</th>
                                            <td>{{inserref.costo}}</td>
                                            <td>
                                                <button class="btn btn-danger" @click="deleteInServicio(inserref.id)">Eliminar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-dark" @click="setRefaccion(refaccion)">Agregar</button>

                                <div class="mt-5">
                                    <label class="col-form-label-lg">Total de refacciones: {{servicio.costo_refaccion}}</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" v-if="saveS">
                    <div class="card-header">
                        Costos:
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col col-lg-4 col-sm-5 col-md-4 col-xl-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Mano de obra adicional:</label>
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" step="0.01" v-model="servicio.costo_obra" class="form-control" name="obra">
                                    <div class="input-group-append">
                                        <span class="input-group-text">MXN</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col offset-col-lg-2 offset-col-sm-1 offset-col-md-1 offset-col-xl-1 col-lg-4 col-sm-5 col-md-4 col-xl-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Revision:</label>
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <label v-text="servicio.costo_revision" class="form-control input-group-text" name="revision"></label>
                                    <div class="input-group-append">
                                        <span class="input-group-text">MXN</span>
                                    </div>
                                </div>
                            </div>
                        <div class="w-100"></div>
                            <div class="col offset-col-lg-2 offset-col-sm-1 offset-col-md-1 offset-col-xl-1 col-lg-4 col-sm-5 col-md-4 col-xl-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Refacción:</label>
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <label v-text="servicio.costo_refaccion" class="form-control input-group-text" name="refaccion"></label>
                                    <div class="input-group-append">
                                        <span class="input-group-text">MXN</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col offset-col-lg-2 offset-col-sm-1 offset-col-md-1 offset-col-xl-1 col-lg-4 col-sm-5 col-md-4 col-xl-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Total:</label>
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <label v-text="servicio.total" class="form-control input-group-text" name="total"></label>
                                    <div class="input-group-append">
                                        <span class="input-group-text">MXN</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <button class="btn btn-dark" @click="updateService()">Guardar Servicio</button>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        <!-- <pre>
            {{ $data }}
        </pre> -->
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
                servicio :{"id":"","moto_id":"","estado":"","comentario":"","detalle":"","costo_obra":0.00,"costo_revision":"","costo_refaccion":"","total":""},
                revisionS:{'nombre':'','costo':'','comentario':''},
                revisiones:[],
                refaccion: {'id':'', 'nombre':'','costo':'','comentario':""},
                refacciones: [],
                searchMarca:"",
                searchref:"",
                searchrev:"",
                inServicioRev:[],
                inServicioRef:[],
                user:{"id":"","name":"","appaterno":"","apmaterno":"","email":"","telefono":""},
                moto:{"id":"","marca":"","modelo":"","version":"","user_id":"","anio":"","km":"","serie":""},
                marcas:[],
                save:false,
                user_read : false,
                saveM:false,
                moto_read : false,
                saveS:false
    		}
    	},
    	created() {
    		this.getRefacciones();
            this.getRevisiones();
            this.getMarcas();
            // this.debounceGetMoto = _.debounce(this.searchMoto,500);
    	},
        watch:{
            "searchMarca": function(val){
                if(val){
                    console.log('si entra');
                    console.log("val",val);
                    var marca ={'marca':val};
                    this.searchMoto(marca);
                    
                }
                
                // this.debounceGetMoto();
            },
            "moto.modelo":function(val) {
                if(searchMarca){

                }
                var modelo = {'marca': this.moto.marca, 'modelo':val};
                this.searchMoto(modelo);
            },
            "moto.version":function(val){
                if(searchMarca){

                }
                var version = {'marca': this.moto.marca, 'modelo':this.moto.modelo, 'version':val};
                this.searchMoto(version);
            },
            "moto.anio": function(val){
                if(searchMarca){
                    
                }
                var anio = {'marca': this.moto.marca, 'modelo':this.moto.modelo, 'version':this.moto.version, 'anio':val};
                this.searchMoto(anio);
            },
            "moto.serie": function (val){
                var serie = {'marca': this.moto.marca, 'modelo':this.moto.modelo, 'version':this.moto.version, 'anio':this.searchMoto};
                this.searchMoto(serie);
            },
            "searchrev":function(val){
                if(val == ""){
                    this.revisionS = {'nombre':'','costo':'','comentario':''};
                }
                else{

                    this.searchRevision(val);
                }
                // console.log(this.revisionS);
            },
            "searchref":function(val){
                if(val == ""){
                     this.refaccion = {'id':'', 'nombre':'','costo':'','comentarios':""};
                }
                else{
                    this.searchRefaccion(val);
                    
                }
                // console.log(this.revisionS);
            },
            'servicio.costo_obra':function(oldval,val){
                if (val == "") {
                    this.servicio.total = 0 + parseFloat(this.servicio.costo_refaccion)+parseFloat(this.servicio.costo_revision);
                }
                this.servicio.total = parseFloat(this.servicio.costo_obra) + parseFloat(this.servicio.costo_refaccion)+parseFloat(this.servicio.costo_revision);
            }
        },
    	methods:{
            updateService(){
                console.log(this.servicio);
                this.servicio.costo_obra = parseFloat(this.servicio.costo_obra);
                let url=`../updateService/${this.servicio.id}`
                axios.put(url,this.servicio).then(res=>{
                    console.log(res);
                    if(res.data.status == 'creado'){
                        alert("servicio creado");
                        window.location.href="../servicios";
                    }
                }).catch(err=>{
                    console.log(error);
                });
            },
            deleteInServicio(id){
                console.log(id);
                let url = `../inServicio/${this.servicio.id}/delete/${id}`;
                axios.delete(url).then(res=>{
                    console.log(res);
                    this.servicio = res.data.servicio;
                    this.inServicioRef = res.data.refacciones
                    this.inServicioRev = res.data.revisiones;
                }).catch(err=>{
                    console.log(err);
                });
            },
            setRefaccion(refaccion){
                console.log(refaccion)
                let url=`../inServicio/${this.servicio.id}/refaccion`;
               axios.post(url,refaccion).then(
                res=>{
                    console.log(res);
                    this.servicio = res.data.servicio;
                    this.inServicioRef = res.data.refacciones
                    this.refaccion = {'id':'', 'nombre':'','costo':'','comentarios':""};
                })
               .catch(err=>{
                    console.log(err);
               });
            },
            searchRefaccion(rev){
                console.log(rev);
                var find = this.refacciones.find(refaccion=>{
                    return refaccion.nombre === rev;
                });
                if(find){
                    this.refaccion.id = find.id;
                    this.refaccion.nombre = find.nombre;
                    this.refaccion.costo = find.costo;
                }
            },
            searchRevision(rev){
                console.log(rev);
                var find = this.revisiones.find(revision=>{
                    return revision.nombre === rev;
                });
                if(find){
                    this.revisionS.id = find.id;
                    this.revisionS.nombre = find.nombre;
                    this.revisionS.costo = find.costo;
                }
                
            },
            setRevision(revision){
               let url=`../inServicio/${this.servicio.id}/revision`;
               axios.post(url,revision).then(
                res=>{
                    this.servicio = res.data.servicio;
                    this.inServicioRev = res.data.revisiones;
                    this.revisionS = {'nombre':'','costo':''};
                })
               .catch(err=>{
                    console.log(err);
               });
            },
            selectUser(){
                this.save = true;
                this.user_read= true;
            },
            saveUser(user){
                let url = '../saveUser';
                axios.post(url,user).then(response=>{
                    // console.log(response);
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
                let url = "../searchUser";
                axios.post(url,{email}).then(response=>{
                    // console.log(response);
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
            getMarcas(){
                let url="../api/marcas";
                axios.get(url).then(response=>{
                    // console.log(response);
                    this.marcas = response.data.marcas;
                }).catch(error=>{
                    console.log(error);
                });
            },
            searchMoto(query){
                    // console.log(this.user.id);
                let url = `../user/${this.user.id}/searchMoto`;
                console.log(query);
                

                    axios.post(url,query).then(res=>{
                        if(res.data.moto){
                            this.moto = new Moto(res.data.moto);
                        }
                        else{
                            // if(Object.keys(query)){

                            //     this.moto =  {"id":"","marca":query.marca,"modelo":query.modelo,"version":query.version,"user_id":"","anio":query.anio,"km":query.km,"serie":query.serie};
                            // }
                        }
                    }).catch(err=>{
                        // this.moto =  {"id":"","marca":query.marca,"modelo":query.modelo,"version":query.version,"user_id":"","anio":query.anio,"km":query.km,"serie":query.serie};
                    });


            },
            selectMoto(){
                let url = `../user/${this.user.id}/saveMoto`;
                axios.post(url,this.moto).then(res=>{
                    this.moto = new Moto(res.data.moto);
                    this.saveM = true;
                }).catch(err=>{
                    console.log(err);
                });
            },
            saveService(){
                this.servicio.moto_id = this.moto.id;
                let url = "../saveService";
                axios.post(url,this.servicio).then(res=>{
                    this.servicio = res.data.servicio;
                    this.saveS = true;
                }).catch(err=>{
                    console.log(err);
                });

            },
    		getRefacciones(){
    			let url= "../precargas/refacciones";
    			axios.get(url).then(response=>{
    				this.refacciones=response.data.refacciones;
    			});
    		},
    		clearRefacccion(){
                this.refaccion = {'id':'', 'nombre':'','costo':'','comentarios':""};
            },
            getRevisiones(){
                let url = "../precargas/revisiones";
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