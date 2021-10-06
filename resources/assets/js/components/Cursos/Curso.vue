<template>
  
<main>
    <!-- cotaniner inicio-->
       <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Cursos
                                <small>  Panel administrador</small>
                            </h3>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
    <!-- fin container inicio-->
    <!--contenido-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                          
                                <div v-if="vistaFormularioCurso==false">
                                      <button class="btn  btn-primary  pull-right"  @click="abrirModal('curso','registrar')">Registrar Curso</button>
                                 </div>
                                 <div v-else-if="vistaFormularioCurso==true">
                                      <button class="btn  btn-primary  pull-right"  @click="cerrarModal()">Cerrar Formulario</button>
                                 </div>
                                                                                 
                        </div>
                        
                        <div class="card-body">      
                                <div class="col-md-12" v-if="vistaFormularioCurso==true">
                                    <h5 class="text-center">{{tituloModal}}</h5>
                                   <div class="modal-body card">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class=" form-control-label" for="text-input">Nombre (*)</label>
                                                    <input type="text" v-model="nombrecurso" class="form-control" placeholder="Ingrese nombre de servicio">                                              
                                                </div>
                                          
                                                  
                                            </div>
                                            <div v-show="errorCurso" class="form-group row div-error">
                                                <div class="text-center text-error">
                                                    <div v-for="error in errorMostrarMsjCurso" :key="error" v-text="error">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary col-md-12" @click="btnAgregarCurso()"><i class="far fa-save"></i> Guardar</button>
                                                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary col-md-12" @click="actualizarCurso()"><i class="fas fa-redo"></i> Actualizar</button>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-secondary col-md-12" @click="cerrarModal()"><i class="far fa-times-circle"></i> Cancelar</button>
                                                </div>
                                            </div>
                                        </form>     
                                    </div>               
                                </div>      

                                   
                           
                                <div class="col-md-6">
                                     
                                    <div class="input-group"> 
                                        <select class="form-control col-md-3" v-model="criterio">
                                            <option value="nombre">Nombre</option>
                                            <option value="categoria">Categoría</option>
                                            <option value="precio">Precio </option>
                                            <option value="descripcion">Descripcion</option>
                                        </select>             
                                        <input type="text" v-model="buscar" @keyup.enter="listarCurso(1,buscar,criterio)" 
                                        class="form-control form-control" placeholder="Texto a buscar">                                        
                                        <button type="submit" @click="listarCurso(1,buscar,criterio)" 
                                            class="btn btn-outline-primary btn-sm"><i class="fa fa-search"></i>  
                                            <i class="mdi mdi-magnify"></i> Buscar
                                        </button>
                                    </div>
                                </div>                                 
                           
                            <!--tabla de lista de categorias-->
                             <div class="table-responsive col-md-12 mt-4">
                                  <h5 class="text-center">Lista de Cursos</h5><hr>
                                <table class="table table-responsive table-bordered ">
                                    <thead class="">
                                        <tr>
                                        <th scope="col">idespecialidad</th>
                                        <th scope="col">nombre_es</th><th scope="col">abreviatura_es</th>  <th scope="col">descripcion_es</th>
                                        <th scope="col">duracion_es</th>
                                      
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="serv in arrayCurso" :key="serv.id">
                                            <td  v-text="serv.idespecialidad"></td>
                                            <td>{{serv.nombre_es}} <br></td>
                                            <td>S/. {{serv.abreviatura_es}}</td>
                                            <td  v-text="serv.descripcion_es" ></td>
                                            <td  v-text="serv.duracion_es"></td>

                                        
                                        </tr>                                               
                                    </tbody>
                                </table>
                                <!--paginacion-->
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item" v-if="pagination.current_page > 1">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Anterior</a>
                                        </li>
                                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Siguiente</a>
                                        </li>
                                    </ul>
                                </nav>
                                 <!--fin de paginacion-->
                            </div>
                            <!--fin tabla lista de categorias-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--fin contenido-->


</main>

</template>

<script>

    export default {
        props : ['ruta'],
        data(){
            return{
                id_servicio:0,
                nombre:'',
                descripcion:'',
                arrayCurso:[],

                nombrecurso:'',
                categorianombre:'',
                precio:'',
                prestador:0,

                //formulario servicio
                vistaFormularioCurso:false,
                arrayCategoria:[],
                arrayPrestador:[],
                idcategoriaSelect:0,



                 //Paginacion
                pagination : 
                {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                //busqueda
                offset : 3,
                criterio : 'nombre', 
                buscar : '',

                //modal
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorCurso : 0,
                errorMostrarMsjCurso : [],

                codigoservicio:0

                }                
        },
         computed:
        {
                isActived: function(){
                    return this.pagination.current_page;
                },
                //Calcula los elementos de la paginación
                pagesNumber: function() {
                    if(!this.pagination.to) {
                        return [];
                    }
                    
                    var from = this.pagination.current_page - this.offset; 
                    if(from < 1) {
                        from = 1;
                    }

                    var to = from + (this.offset * 2); 
                    if(to >= this.pagination.last_page){
                        to = this.pagination.last_page;
                    }  

                    var pagesArray = [];
                    while(from <= to) {
                        pagesArray.push(from);
                        from++;
                    }
                    return pagesArray;             

                }
        },
        methods:{
             cambiarPagina(page,buscar,criterio)
            {   let me = this;
                me.pagination.current_page = page;
                me.listarCurso(page,buscar,criterio);
            },
           
            listarCurso(page,buscar,criterio){
                let me=this;
                me.listado=2;
                var url= me.ruta+'/curso?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCurso = respuesta.cursos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            btnDescripcion(nombr,descrip){
                Swal.fire({
                    html: '<h5>'+nombr+'</h5><p style="font-size:15px">'+descrip+'</p>',
                   
                    })
            },
            btnAgregarCurso(){
                  if (this.validarServicio()){
                    return;
                }                
                let me = this;
              
                axios.post(me.ruta+'/servicio/registrar',{
                     'codigo': this.codigoservicio,
                    'nombre': this.nombrecurso,
                    'descripcion': this.descripcion,
                    'precio': this.precio,
                    'idcategoria': this.idcategoriaSelect,
                    'idprestador': this.prestador

                }).then(function (response) {
                    me.cerrarModal();
                    Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Serivicio registrado',
                    showConfirmButton: false,
                    timer: 1500
                    })
                     me.listarCurso(1,me.buscar,me.criterio);
                }).catch(function (error) {
                    console.log(error);
                });
              
            },
              Codigo(){
                let me=this;
                 let idserviciou=0;
                var url= this.ruta+'/servicio/ultimoservicio';               
                axios.get(url).then(function (response) {
                let respuesta= response.data;
                if(response.length==0){
                    idserviciou=1;
                }else{
                    idserviciou= respuesta.idultimoservicio[0].id;
                }
               
                me.codigoservicio='S-'+me.zfill(idserviciou,3);
                 
                
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
              zfill(number, width) {
                var numberOutput = Math.abs(number); /* Valor absoluto del número */
                var length = number.toString().length; /* Largo del número */ 
                var zero = "0"; /* String de cero */  

                if (width <= length) {
                    if (number < 0) {
                            return ("-" + numberOutput.toString()); 
                    } else {
                            return numberOutput.toString(); 
                    }
                } else {
                    if (number < 0) {
                        return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
                    } else {
                        return ((zero.repeat(width - length)) + numberOutput.toString()); 
                    }
                }
            },
            actualizarCurso(){
                if (this.validarServicio()){
                    return;
                }
                
                let me = this;

                 axios.put(me.ruta+'/servicio/actualizar',{                  
                    'nombre': this.nombrecurso,
                    'precio': this.precio,
                    'idprestador': this.prestador,
                    'idcategoria': this.idcategoriaSelect,
                    'descripcion': this.descripcion,              
                    'id': this.id_servicio
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCurso(1,'','nombre');
                     Swal.fire(
                    '',
                    'Registro actualizado con éxito',
                    'success'
                    )
                }).catch(function (error) {
                    console.log(error);
                }); 
                
            },
            validarServicio(){
                this.errorCurso=0;
                this.errorMostrarMsjCurso =[];

                if (!this.nombrecurso) this.errorMostrarMsjCurso.push("El nombre del servicio no puede estar vacío.");              
                if (this.idcategoriaSelect==0) this.errorMostrarMsjCurso.push("Debes selecionar una categoria");
                if (this.precio==0) this.errorMostrarMsjCurso.push("Debes ingresar el precio del servicio");
                if (this.prestador==0) this.errorMostrarMsjCurso.push("Debes selecionar un prestador");
                          
                if (this.errorMostrarMsjCurso.length) this.errorCurso = 1;

                return this.errorCurso;
            },
            btnActivar(idcategoria){
                let me=this;
               Swal.fire({
                title: '<span style="font-size:25px">¿Estás seguro de activar el servicio?</span>',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, activar'
                }).then((result) => {
                if (result.value) {
                      axios.put(me.ruta+'/servicio/activar',{
                    'id': idcategoria
                    }).then(function(response){
                        me.listarCurso(1,me.buscar,me.criterio);
                    }).catch(function(error){
                        console.log(error)
                    });
                    Swal.fire(
                    'Activado!',
                    'El servicio se ha activado con éxito',
                    'success'
                    )
                }
                });
            },
            btnDesactivar(idcategoria){
                let me=this;
               Swal.fire({             
                title: '<span style="font-size:25px">¿Estás seguro de desactivar el servicio?</span>',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, desactivar'
                }).then((result) => {
                if (result.value) {
                      axios.put(me.ruta+'/servicio/desactivar',{
                    'id': idcategoria
                    }).then(function(response){
                        me.listarCurso(1,me.buscar,me.criterio);
                    }).catch(function(error){
                        console.log(error)
                    });
                    Swal.fire(
                    '¡Desactivado!',
                    'El servicio se ha desactivado con éxito',
                    'success'
                    )
                }
                })
            },
              cerrarModal(){
                this.modal=0;
                this.nombrecurso='';
                this.idcategoriaSelect=0;
                this.precio=0;
                 this.prestador=0;
                 this.categorianombre='';
                this.descripcion='';  

                this.vistaFormularioCurso=false;
            },
             abrirModal(modelo, accion, data = []){
               this.vistaFormularioCurso=true;
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Servicio';
                                this.nombrecurso='';
                                this.descripcion='';                              
                                this.tipoAccion = 1;
                                this.Codigo();
                                this.selectCategoria();
                                  this.selectPrestador(); 
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Servicio';
                                this.tipoAccion=2;
                                this.id_servicio=data['id'];
                                this.nombrecurso = data['nombre'];
                                this.descripcion = data['descripcion'];  
                                this.precio= data['precio'];     
                                this.prestador= data['idprestador'];    
                                this.idcategoriaSelect= data['idcat']; 
                                
                                this.selectCategoria(); 
                                this.selectPrestador();                       
                                break;
                            }
                        }
                    }
                }
            },
      

        },
     
        mounted() {
             this.listarCurso(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    

 
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color:#ff8084 !important;
        font-weight: bold;
    }
   
</style>
