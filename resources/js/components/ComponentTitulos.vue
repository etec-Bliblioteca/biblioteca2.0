<template>
        <h1>{{ nomeTitulo }}</h1>
</template>

<script>
    export default{
        name: 'titulos',
        props:{
            nomeTitulo:String,
        },
    }
</script>

<style scoped>
    h1{
        outline: 3px solid var(--cor1);
        border-radius: 5px;
        height: 40px;
        padding: 0px 15px;
        width: fit-content;
        font-size: 1rem;
        background-color: var(--cor2);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-self: center;
        text-transform: uppercase;
        font-family: var(--raleway);
        font-weight: 900;
    }
</style>
