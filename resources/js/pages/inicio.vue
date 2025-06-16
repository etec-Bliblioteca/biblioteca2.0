
<script>
    import carrocelEventos from '../components/ComponentCarrocelEvento.vue'
    import carrocelRevistasNovas from '../components/ComponentCarrocelRevistasNovas.vue'
    import subtitulosPrincipais from '../components/ComponentTitulos.vue'
    import btnMudarPg from '../components/ComponentBtnMudarPg.vue'
    import imgPerfil from '../components/ComponentImgPerfil.vue';
    import btnMenu from '../components/ComponentBtnMenu.vue';
    import Menu from '../components/ComponentMenu.vue';
    export default{
        name: 'inicio',
        data(){
            return{
                menuActive:false,
                // Pega esses titulos e joga em um props depois
                titulo1: "Eventos",
                titulo2: "Revistas Novas",

            }
        },
        components: {
            Menu,
            btnMenu,
            imgPerfil,
            btnMudarPg,
            subtitulosPrincipais,
            carrocelEventos,
            carrocelRevistasNovas
        },
        methods:{
            clickMenu(active){
                this.menuActive = active;
            }
        }
    }
</script>
<template>
    <div id="pg-inicio">
        <!-- topo da página -->
        <header>
            <Menu :active="menuActive" page="0"/>
            <!-- botão de menu -->
            <btnMenu @clickMenu="clickMenu"></btnMenu>
            <!-- Icone de Perfil -->
            <img-perfil></img-perfil>
        </header>
        <!-- Corrocel de eventos -->
        <section id="carrocelEventosLugar">
            <subtitulosPrincipais :nomeTitulo="titulo1"></subtitulosPrincipais>
            <carrocelEventos></carrocelEventos>
        </section>
        <!-- revistas novas -->
        <section id="carrocelRevistasNovasLugar">
            <subtitulosPrincipais :nomeTitulo="titulo2" ></subtitulosPrincipais>
            <carrocelRevistasNovas></carrocelRevistasNovas>
        </section>
        <!-- botões para navegar entre as páginas -->
        <div id="caixaBotões">
            <btnMudarPg></btnMudarPg>
            <btnMudarPg></btnMudarPg>
            <btnMudarPg></btnMudarPg>
        </div>
    </div>
</template>



<style scoped>
    #pg-inicio{
        min-height: 100%;
        display: grid;
        grid-template-areas:
        'header'
        'eventos'
        'revistasNovas'
        'botões';
        grid-template-rows: auto 1fr 1.6fr 0.25fr;
    }

    #caixaBotões{
        display: flex;
        align-items: center;
        justify-content: center;

        /* max-width: 200px; */

        gap: 20px;

        grid-area: botões;
    }

    #carrocelEventosLugar{
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-direction: column;

        padding-top: 50px;

        grid-area: eventos;
    }

    #carrocelRevistasNovasLugar{
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-direction: column;

        padding-top: 50px;

        grid-area: revistasNovas;
    }

    header {
        grid-area: header;
        padding-top: 25px;
        width: 100%;
        display: flex;
    }
</style>
