<template>
    <p class="border-bottom pb-2">
        <strong>
            Solicitud:
        </strong>
        {{solicitud.id}}
        <br>
        <strong>
            Total: $
        </strong>
        {{solicitud.total}}
        <br>
        <strong>
            Estatus: 
        </strong>
        {{solicitud.estatus}}
        <br>
        <strong>
            Fecha:
        </strong>
        {{solicitud.created_at}}
    </p>
    
</template>

<script>
    export default {
        props:['solicitud'],
        data(){
            return {
            }//return
        }//data
    }//export
</script>
