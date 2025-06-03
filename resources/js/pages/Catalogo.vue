<script>
import btnMenu from '@/components/ComponentBtnMenu.vue';
import Menu from '../components/ComponentMenu.vue';

export default {
    name: "Catalogo",
    data(){
            return{
                menuActive:false,
            }
        },
    components:{
        Menu,
        btnMenu,
    },
    methods:{
            clickMenu(active){
                this.menuActive = active;
            }
        }
}
</script>

<template>
    <div>
        <Menu :active="menuActive" page="1"/>
        <btnMenu @clickMenu="clickMenu"></btnMenu>
        <h1>CATÁLOGO</h1>
    </div>
</template>
