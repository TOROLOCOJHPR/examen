<template>
    <div class="h-100">
        <h2 id="error" class="py-2 text-center text-white bg-danger position-absolute w-100" style="display:none"></h2>
        <form action="" @submit.prevent="login" class="d-flex h-100 align-items-center justify-content-center">
            <div class="col-md-5">
                <h1 class="text-center pb-3">EasyCredit</h1>

                <!-- usuario -->
                <div class="form-group lead">
                    <label for="usuario">Usuario</label>
                    <input 
                        type="text"
                        name="email"
                        id="usuario"
                        placeholder="Introduce tu correo electrónico"
                        class="form-control" 
                        v-model="email"
                    />
                </div><!-- usuario -->

                <!-- submit -->
                <div class="text-right">
                    <p>
                        ¿eres nuevo?
                        <button type="button" class="btn btn-link" v-on:click="modalRegistro">
                            Registrate
                        </button>
                        <input
                            type="submit" value="Entrar"
                            class="ml-3 btn btn-secondary"
                        />
                    </p>
                </div><!-- submit -->
            </div><!-- col-md-5 -->
        </form>
        <registro-form></registro-form>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                email : '',
            }
        },//data
        methods:{
            login(){
                axios.post('/login/' + this.email).then((response)=>{
                    let error = document.getElementById('error');
                    let result = response.data; 
                    if(result== false){
                        error.style.cssText = "display:block";
                        error.innerHTML= "usuario no encontrado";
                    }else{
                        location.href ="/panel?user=" + result[0]['id'];
                    }
                });
            },//login
            modalRegistro(){
                let mensajeSuccess = document.getElementById('mensajeSuccess');
                let mensajeError = document.getElementById('mensajeError');
                mensajeSuccess.style.display = "none";
                mensajeError.style.display = "none";
                $('#registroUsuario').modal('show');
            }
        }//methods
    }//export
</script>