<script>
import carrocelEventos from "../components/ComponentCarrocelEvento.vue";
import carrocelRevistasNovas from "../components/ComponentCarrocelRevistasNovas.vue";
import subtitulosPrincipais from "../components/ComponentTitulos.vue";
import imgPerfil from "../components/ComponentImgPerfil.vue";
import btnMenu from "../components/ComponentBtnMenu.vue";
import Menu from "../components/ComponentMenu.vue";
import { Link } from "@inertiajs/vue3";
import Admin from "./Admin.vue";
export default {
    name: "inicio",
    data() {
        return {
            menuActive: false,
            // Pega esses titulos e joga em um props depois
            titulo1: "Eventos",
            titulo2: "Revistas Novas",
        };
    },
    props: {
        User: Object,
        Revistas: Object,
        Eventos: Object,
    },
    components: {
        Menu,
        btnMenu,
        imgPerfil,
        subtitulosPrincipais,
        carrocelEventos,
        carrocelRevistasNovas,
        Link,
        Admin,
    },
    methods: {
        clickMenu(active) {
            this.menuActive = active;
        },
    },

    beforeMount() {
        console.log(this.Eventos);
    },
};
</script>
<template>
    <div id="pg-inicio">
        <!-- topo da página -->
        <header>
            <Menu :active="menuActive" page="0" :user="User" />
            <!-- botão de menu -->
            <btnMenu @clickMenu="clickMenu"></btnMenu>
            <!-- Icone de Perfil -->
            <img-perfil></img-perfil>
        </header>
        <!-- Corrocel de eventos -->
        <section id="carrocelEventosLugar">
            <subtitulosPrincipais :nomeTitulo="titulo1"></subtitulosPrincipais>
            <carrocelEventos :collectionEventos="Eventos"></carrocelEventos>
        </section>
        <!-- revistas novas -->
        <section id="carrocelRevistasNovasLugar">
            <subtitulosPrincipais :nomeTitulo="titulo2"></subtitulosPrincipais>
            <carrocelRevistasNovas :Revistas="Revistas"></carrocelRevistasNovas>
        </section>
        <!-- botões para navegar entre as páginas -->
        <div id="caixaBotões">
            <div class="links">
                <a href="https://www.instagram.com/etec_franciscomorato/">
                    <svg
                    viewBox="0 0 448 512"
                    xmlns="http://www.w3.org/2000/svg"
                    id="instagram"
                    class="icons-social-media"
                >
                    <path
                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                    ></path>
                </svg>
                </a>
                <a href="https://www.etecfranciscomorato.com.br/">
                    <svg class="icons-social-media" id="website" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#000000" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M39.93,55.72A24.86,24.86,0,1,1,56.86,32.15a37.24,37.24,0,0,1-.73,6"></path><path d="M37.86,51.1A47,47,0,0,1,32,56.7"></path><path d="M32,7A34.14,34.14,0,0,1,43.57,30a34.07,34.07,0,0,1,.09,4.85"></path><path d="M32,7A34.09,34.09,0,0,0,20.31,32.46c0,16.2,7.28,21,11.66,24.24"></path><line x1="10.37" y1="19.9" x2="53.75" y2="19.9"></line><line x1="32" y1="6.99" x2="32" y2="56.7"></line><line x1="11.05" y1="45.48" x2="37.04" y2="45.48"></line><line x1="7.14" y1="32.46" x2="56.86" y2="31.85"></line><path d="M53.57,57,58,52.56l-8-8,4.55-2.91a.38.38,0,0,0-.12-.7L39.14,37.37a.39.39,0,0,0-.46.46L42,53.41a.39.39,0,0,0,.71.13L45.57,49Z"></path></g></svg>
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>
body,
html,
#app {
    color: black;
    width: 100%;
    height: 100%;
    background-color: var(--corFundoPrincipal);
}

#app {
    display: grid;
    grid-template-areas:
        "header"
        "eventos"
        "revistasNovas"
        "botões";
    grid-template-rows: auto 1fr 1.6fr 0.25fr;
}

#caixaBotões {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    grid-area: botões;
    padding-bottom: 20px;
}

#carrocelEventosLugar {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    flex-direction: column;

    padding-top: 50px;

    grid-area: eventos;
}

#carrocelRevistasNovasLugar {
    display: flex;
    height: 350px;
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
/* From Uiverse.io by CPC23 */ 
.icons-social-media {
  align-items: center;
  margin-top: 10px;
  padding: 5px;
  width: 32px;
  cursor: pointer !important;
  transition: 300ms all ease-in-out;
  position: relative;
}

.icons-social-media:hover {
  translate: -0px -10px;
}

#instagram,
    #youtube,#website {
  transition: 300ms all ease-in-out;
  clip-path: circle(65%);
}

#instagram:hover {
  background-color: rgb(221, 157, 189);
}

#website:hover {
  background-color: rgb(114, 114, 114);
}
</style>
