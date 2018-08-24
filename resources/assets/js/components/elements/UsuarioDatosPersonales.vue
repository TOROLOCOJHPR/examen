<template>
    <p class="border-bottom pb-2">
        <strong>Nombre: </strong>
        {{dato.nombre}}
    </p>
</template>

<script>
    export default {
        props:['dato'],
        data(){
            return {
            }
        },
        mounted(){
        }//mounted
    }
</script>

