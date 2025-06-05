<script>
    export default {
        name: 'btnMenu',
        data(){
            return{
                active: false,
            }
        },
        emits:['clickMenu'],
        methods:{
            btnClick(){
                this.active = !this.active
            }
        }
    }
</script>

<template>
    <button id="btnMenu" @click="btnClick();$emit('clickMenu',active)" v-show="!active">
        <svg   viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 6H20M4 12H14M4 18H9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
    </button>
    <button id="btnMenuActive" @click="btnClick();$emit('clickMenu',active)" v-show="active" >
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Menu / Close_SM"> <path id="Vector" d="M16 16L12 12M12 12L8 8M12 12L16 8M12 12L8 16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
    </button>
</template>

<style scoped>
    #btnMenu {
        position: absolute;
        width: 50px;
        height: 50px;

        left: 25px;

        border: 2px solid #000000;
        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
        background: none;
        transition: 0.3s;
    }

    
    #btnMenu svg{
        width: 30px;
        height: 30px;
    }

    #btnMenuActive {
        position: absolute;
        width: 40px;
        height: 40px;
        left: 25px;
        border: 2px solid var(--cor1);
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
        background: none;

    }
    #btnMenuActive svg{
        width: 35px;
        height: 35px;
    }

    #btnMenuActive svg path{
        stroke: var(--cor1);
    }

</style>


