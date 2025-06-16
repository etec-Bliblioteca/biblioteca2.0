<template>
    <div id="corpo">
        <input type="text">
        <button>
            pesquisar
        </button>
    </div>
</template>

<script>
    export default{
        name: 'barraPesquisa'
    }
</script>

<style scoped>

    button{
    background-color: black;
    border-radius: 0 30px 30px 0;
    }

    input{
        padding: 0 10px 0 20px;
        font-size: 22px;
        outline: none;
        border: none;
        background-color: transparent;
        width: 80%;
    }

    #corpo{
        display: flex;
        justify-content: flex-start;

        border-radius: 30px;
        margin-top: 30px;
        background-color: gray;
        width: 300px;
        height: 45px;
    }
</style>
