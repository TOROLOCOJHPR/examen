<template>
    <p class="border-bottom pb-2 rounded" :class="[historial.color]">
        <strong>
            Solicitud:
        </strong>
        {{historial.id}}
        <br>
        <strong>
            Total: $
        </strong>
        {{historial.total}}
        <br>
        <strong>
            Porcentaje:
        </strong>
        {{historial.porcentaje}}%
        <br>
        <strong>
            Estatus: 
        </strong>
        {{historial.estatus}}
        <br>
        <strong>
            Fecha:
        </strong>
        {{historial.created_at}}
    </p>
</template>
<script>
    export default {
        props:['historial'],
    }
</script>

