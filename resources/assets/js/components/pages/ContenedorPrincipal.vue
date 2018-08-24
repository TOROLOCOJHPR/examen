<template>
    <div class="row mx-0 justify-content-center">
        
        <!-- usuario -->
        <div class="col-sm-10 col-md-8 col-lg-7 col-xl-3 p-2">
        
            <div class="card card-default">
                <div class="card-header bg-info"><h4 class="text-white m-0">Perfil</h4></div>
                <div class="card-body">
                    
                    <usuario-datos-personales 
                        :dato="dato"
                    >
                    </usuario-datos-personales>
                    
                    <usuario-solicitud-pendiente
                        v-for="solicitud in solicitudes"
                        :key="solicitud.id"
                        :solicitud="solicitud"
                    ></usuario-solicitud-pendiente>

                    <p v-if="this.solicitudes.length == 0">Sin solicitudes pendientes</p>

                </div><!-- card body -->
        
            </div><!-- card default-->

        </div><!-- col-md-3 -->

        <!-- historial crediticio -->
        <div class="col-sm-10 col-md-8 col-lg-7 col-xl-3 p-2">
        
            <div class="card card-default">
                <div class="card-header bg-info"><h4 class="text-white m-0">Historial</h4></div>
                <div class="card-body">
                    <historial-element
                        v-for="historial in historiales"
                        :key="historial.id"
                        :historial="historial"
                    ></historial-element>
                    <p v-if="this.historiales.length == 0">Sin historial crediticio</p>
                
                </div><!-- card body -->

            </div><!-- card default-->

        </div><!-- col-md-3 -->

        <!-- solicitud -->
        <div class="col-sm-10 col-md-8 col-lg-7 col-xl-3 p-2">
        
            <div class="card card-default">
                <div class="card-header bg-info"><h4 class="text-white m-0">Solicitud</h4></div>
                    <div class="card-body">
            
                    <solicitud-form :dato="dato" @new="addSolicitud"></solicitud-form>

                    <solicitud-element
                        v-for="solicitud in solicitudes"
                        :key="solicitud.id"
                        :solicitud="solicitud"
                    ></solicitud-element>

                    <p v-if="this.solicitudes.length == 0">No se encontraron solicitudes</p>
                
                    <!-- muestra formulario solicitud -->
                    <div class="text-right">
                       <button type="button" class="btn btn-secondary" v-on:click="modalShow">añadir solicitud</button>
                    </div><!-- /muestra formulario solicitud -->
            
                </div><!-- card body -->
        
            </div><!-- card default-->

        </div><!-- col-md-3 -->
    </div>
</template>
<script>
    export default {
        data(){
            return {
                solicitudes:[],
                historiales:[],
                dato:{},
            }
        },//data
        methods:{
            modalShow(){
                $('#solicitudFormulario').modal('show');
            },//modalShow
            addSolicitud(solicitud){
                // console.log(solicitud);
                this.solicitudes.push(solicitud);
                $('#solicitudFormulario').modal('hide');
            },//addSolicitud
        },//methods
        mounted() {
            //obtener variable get url
            let name = 'user'; let get = '';
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
            get = results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

            //solicitar los datos del usuario
            axios.get('/usuario/'+ get).then((response)=>{

                //tomar los datos del usuario
                let result = response.data;

                //toamr los datos del usuario necesarios
                this.dato = {
                    id:result[0]['id'],
                    nombre:result[0]['nombre']
                }
                
                //buscar las solicitudes con estatus pendiente
                axios.get('/api/solicitud/' + this.dato.id).then((response)=>{
                    this.solicitudes = response.data;
                });

                //buscar el historial de solicitudes con estatus aceptado y rechazado
                axios.post('/historial/' + this.dato.id).then((response)=>{
                    this.historiales = response.data;
                });

            });
            

        },//mounted
    }//export
</script>