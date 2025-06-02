<template>
    <div id="btnMenu">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 6H20M4 12H14M4 18H9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
    </div>
</template>

<style scoped>
    #btnMenu {
        position: absolute;
        width: 40px;
        height: 40px;
        left: 25px;
        border: 2px solid #000000;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #btnMenu svg{
        width: 30px;
        height: 30px;
    }
</style>


<script>
    export default {
        name: 'btnMenu',
    }
</script>
