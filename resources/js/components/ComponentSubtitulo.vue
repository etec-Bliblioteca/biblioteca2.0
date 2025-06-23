<template>
        <h2>{{ nomeSubtitulo }}</h2>
</template>

<script>
    export default{
        name: 'subtitulos',
        props:{
            nomeSubtitulo:String,
        },
    }
</script>

<style scoped>
    h2{
        outline: 3px solid var(--cor1);
        border-radius: 5px;
        height: 30px;
        padding: 0px 15px;
        width: fit-content;
        font-size: 0.75rem;
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
