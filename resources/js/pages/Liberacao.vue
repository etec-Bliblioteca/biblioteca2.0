<script>
import CardLib from '@/components/admin/ComponentCardLib.vue';
import Menu from '@/components/admin/ComponentMenuAdmin.vue';
import Title from '@/components/admin/ComponentTitle.vue';

    export default{
        name:"Liberacao",
        components:{
            Menu,
            Title,
            CardLib
        }
    }
</script>


<template>
    <div class="containerAdmin">
        <Menu page="1"></Menu>
        <div class="painel">
            <Title text="liberação de alunos"/>
            <div class="containerCards">
                <cardLib/>
                <cardLib/>
                <cardLib/>
            </div>
        </div>
    </div>
</template>

<style scoped>
.containerCards{
    width: 100%;
    display: flex;
    align-content: center;
    justify-content: flex-start;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 30px;
}
</style>