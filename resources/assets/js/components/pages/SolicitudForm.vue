<template>
    <!-- Modal -->
    <div class="modal fade" id="solicitudFormulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
  
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Nueva Solicitud</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">

                    <form action="" method="POST" @submit.prevent="newSolicitud()">
                    
                        <!-- monto -->
                        <div class="form-group">
                            <label class="font-weight-bold" for="monto">
                                Monto a soliciitar
                            </label>
                            <input
                                id="monto"
                                type="text"
                                name="monto"
                                class="form-control"
                                v-model="monto"
                                v-on:keydown="numberOnly"
                                v-on:keyup="calculaTotal"
                                required
                            />
                        </div>

                        <!-- edad -->
                        <div class="form-group">
                            <label class="font-weight-bold" for="edad">
                                Edad
                            </label>
                            <input 
                                type="text" 
                                name="edad" 
                                maxlength="3" 
                                class="form-control"
                                v-model="edad"
                                v-on:keydown="numberOnly"
                                required
                            />
                        </div>

                        <!-- tarjeta credito -->
                        <label class="font-weight-bold">¿Cuenta con tarjeta de credito?</label>
                        <div class="form-inline pb-2">
                            <input
                            type="radio" name="tarjetaCredito" 
                            value="1" id="siTC" v-model="tarjeta"
                            required
                            /> 
                            <label for="siTC">&nbsp;Si&nbsp;</label>
                            <input
                                type="radio" name="tarjetaCredito"
                                value="0" id="noTC" v-model="tarjeta"
                                required
                            />
                            <label for="noTC">&nbsp;No</label>
                        </div>
                        
                        <!-- plazo del prestamo -->
                        <div class="form-group">
                            <label class="font-weight-bold" for="plazo">Cantidad de pagos</label>
                            <select class="form-control" name="plazo" id="plazo" v-model="plazo" v-on:change="calculaTotal" required>
                                <option value="" class="text-muted" selected>Selecciona una cantidad de pagos</option>
                                <option value="3" data-porcentaje="5">3 meses -- 5% interes</option>
                                <option value="6" data-porcentaje="7">6 meses -- 7% interes</option>
                                <option value="9" data-porcentaje="12">9 meses -- 12% interes</option>
                            </select>
                        </div>
                        
                        <p><strong>Total a pagar: $</strong><span id="total">0</span></p>

                        <!-- errores de usuario -->
                        <p id="edadError" class="text-danger"></p>
                        
                        <!-- submit -->
                        <div class="form-group">
                            <input type="submit" value="nueva solicitud" class="btn btn-info">
                        </div>
                    
                    </form>
                </div><!-- modal body -->
            
            </div><!-- modal content -->
        
        </div><!--modal dialog -->
    
    </div><!-- modal -->

</template>

<script>
    export default {        
        
        props:['dato'],
        
        data(){
            return {
                monto:'',
                edad:'',
                tarjeta:'',
                plazo:'',
                porcentaje:''
            }

        },   
             
        methods:{
            // ingresar solicitud a la base de datos
            newSolicitud(){

                //instanciar la variable de error de edad
                let edadError = document.getElementById('edadError');

                //limpiar la variable de error de edad
                edadError.innerHTML="";

                //verificar si la edad es mayor a 100 años y menor a 18 años
                if(this.edad < 18 || this.edad > 100){
                    edadError.innerHTML="Edad permitida de 18 a 100 años";
                }else{

                    //tomar valor del atributo data porcentaje de la opción de cantidad de pago seleccionada
                    let porcentaje = document.getElementById('plazo').selectedOptions[0].getAttribute('data-porcentaje');
                    
                    //parametros a enviar a la base de datos
                    const parametros ={
                        id_usuario:this.dato.id,
                        monto:this.monto,
                        edad:this.edad,
                        tarjeta:this.tarjeta,
                        plazo:this.plazo,
                        porcentaje:porcentaje
                    }

                    //enviar metódo ajax a api para guardar los datos de la solicitud en la base de datos
                    axios.post('/api/solicitud',parametros).then((response)=>{
                        const solicitud = response.data;
                        this.$emit('new',solicitud);
                    });

                    //borrar los campos del formulario
                    this.monto = '';
                    this.edad = '';
                    this.tarjeta = '';
                    this.plazo = '';
                    document.getElementById('total').innerHTML="0";
                }//verificar si la edad es mayor a 100 años y menor a 18 años

            },//new solicitud

            //calcula el total del prestamo
            calculaTotal(){

                //tomar el porcentaje del plazo seleccionado
                let porcentaje = document.getElementById('plazo').selectedOptions[0].getAttribute('data-porcentaje');
                
                //verificar que monto y plazo no se encuentren vacios
                if(this.monto == "" || this.plazo == "")
                {
                    document.getElementById('total').innerHTML = "0";                    
                }else{
                    //calcular el total a pagar del plazo seleccionado
                    total = ((this.monto*porcentaje)*this.plazo)/1200;
                    total = parseInt(this.monto) + parseInt(total);
                
                    //verificar si el total es un número
                    if(Number.isNaN(total)){
                        //mostrar total 0
                        document.getElementById('total').innerHTML = "0";
                    }else{
                        //mostrar la cantidad del total a pagar en el plazo seleccionado
                        document.getElementById('total').innerHTML = total;
                    }
                }
            },//calculaTotal

            //permitir ingresar solo números
            numberOnly(e){
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                     //permitir: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // permitir: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40))
                {
                         // no hacer nada
                        return;
                }
                // verificar si no es un número y prevenir su envio
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
               
            },//monto
        },//methods
        mounted(){
        }//mounted
    }//export
</script>