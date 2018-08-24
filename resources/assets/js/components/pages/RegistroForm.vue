<template>
    <!-- Modal -->
    <div class="modal fade" id="registroUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
  
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Registro de usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <form action="" method="POST" @submit.prevent="newRegistro()">
                    
                        <!-- nombre -->
                        <div class="form-group">
                            <label class="font-weight-bold" for="nombre">
                                Nombre
                            </label>
                            <input
                                id="nombre"
                                type="text"
                                name="nombre"
                                class="form-control"
                                v-model="nombre"
                            />
                        </div>

                        <!-- email -->
                        <div class="form-group">
                            <label class="font-weight-bold" for="edad">
                                Email
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control"
                                v-model="email"
                            />
                        </div>

                        <!-- submit -->
                        <div class="form-group text-right">
                            <input
                                id="submitRegistro"
                                type="submit"
                                value="registrar"
                                class="btn btn-info"
                            />
                        </div>
                        <p id="mensajeSuccess" class="alert alert-success" style="display:none">Usuario registrado exitosamente</p>
                        <p id="mensajeError" class="alert alert-danger" style="display:none">Sucedio un error intentalo de nuevo</p>
                    </form>
                </div><!-- modal body -->
            
            </div><!-- modal content -->
        
        </div><!--modal dialog -->
    
    </div><!-- modal -->
</template>

<script>
    export default{
        data(){
            return {
                nombre:'',
                email:'',
            }
        },//data
        methods:{

            newRegistro(){//registrar nuevo usuario en la base de datos

                //instanciar variables 
                let btnSubmit = document.getElementById('submitRegistro');
                let mensajeSuccess = document.getElementById('mensajeSuccess');
                let mensajeError = document.getElementById('mensajeError');

                //deshabilitar botón submit para evitar multiples envios del formulario
                btnSubmit.disabled = true;
                
                //tomar valor de los campos del formulario 
                const parametros = {
                    nombre :this.nombre,
                    email: this.email,
                }
                
                //enviar formulario a api, mediante método post
                axios.post('/usuario',parametros).then((response)=>{
                    
                    //borrar mensajes anteriores
                    mensajeSuccess.style.display = "none";
                    mensajeError.style.display = "none";
                    
                    //tomar valores devueltos por la api
                    let result = response.data;
                    
                    
                    if(result == true){//verificar si el usuario se registro correctamente
                        
                        // vaciar campos de formulario
                        this.nombre = '';
                        this.email = '';
                        //mostrar mensaje de exito usuario registrado correctamente
                        mensajeSuccess.style.display = "block";
                    
                    }else{//usuario no registrado

                        //mostrar mensaje de error intenta de nuevo más tarde
                        mensajeError.style.display = "block";
                    
                    }

                    //habilitar botón submit para permitir nuevos envíos del formulario
                    btnSubmit.disabled = false;

                });//axios.post(/usuario)
            
            },//newRegistro

        }//methods
    }//export
</script>