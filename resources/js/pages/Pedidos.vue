<script>
import CardPedido from '@/components/admin/ComponentCardPedido.vue';
import Menu from '@/components/admin/ComponentMenuAdmin.vue';
import Title from '@/components/admin/ComponentTitle.vue';

    export default{
        name:"Pedidos",
        components:{
            Menu,
            Title,
            CardPedido
        }
    }
</script>

<template>
    <div class="containerAdmin">
        <Menu page="2"></Menu>
        <div class="painel">
            <Title text="pedidos de revistas"/>
            <div class="containerCards">
                <CardPedido/>
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