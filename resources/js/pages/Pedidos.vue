<script>
import CardPedido from '@/components/admin/ComponentCardPedido.vue';
import Menu from '@/components/admin/ComponentMenuAdmin.vue';
import Title from '@/components/admin/ComponentTitle.vue';
import { useForm } from '@inertiajs/vue3';

    export default{
        name:"Pedidos",
        components:{
            Menu,
            Title,
            CardPedido
        },
        props:{
            Agendamentos:Array,
        },
        methods:{
            btnAccept(idAgend){
                const form = useForm({
                    'idAgendamento': idAgend,
                });

                form.submit('post','/admin/pedidos/accept');
                console.log(idAgend);
            },
            btnRecuse(idAgend){
                const form = useForm({
                    'idAgendamento': idAgend,
                });

                form.submit('post','/admin/pedidos/recuse');
                console.log(idAgend);
            }
        },
    }
</script>

<template>
    <div class="containerAdmin">
        <Menu page="2"></Menu>
        <div class="painel">
            <Title text="pedidos de revistas"/>
            <div class="containerCards">
                <CardPedido v-for="dataAgend in Agendamentos" :key="dataAgend.id" 
                :idAgend="dataAgend.id"
                :nomeAluno="dataAgend.name" :dtPegar="dataAgend.dt_pegar" :nomeRevista="dataAgend.titulo"
                :rm="dataAgend.rm"
                :turma="dataAgend.turma"
                :revistaImagem="dataAgend.imagem"
                @btnAccept="btnAccept"
                @btnRecuse="btnRecuse"/>
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