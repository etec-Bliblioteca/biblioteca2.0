<template>
        <h2>{{nomeTitulo}}</h2>
</template>

<script>
    export default{
        name: 'subtitulosPrincipais',
        props:{
            nomeTitulo:String,
        },
    }
</script>

<style scoped>
    h2{
        border: 1px solid black;
        border-radius: 5px;
        height: 40px;
        padding: 0 20px;
        width: fit-content;
        font-size: 24px;
        background-color: #607D8B;
    }
</style>
