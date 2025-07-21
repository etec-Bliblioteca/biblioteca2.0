<script>
import btnMenu from "@/components/ComponentBtnMenu.vue";
import Menu from "../components/ComponentMenu.vue";
import imgPerfil from "@/components/ComponentImgPerfil.vue";
import cpRevista from "../components/ComponentRevista.vue";
import barraPesquisa from "../components/ComponentBarraPesquisa.vue";
import popUp from "../components/ComponentPopUp.vue";
import { Link, useForm } from "@inertiajs/vue3";
export default {
    name: "Catalogo",
    data(props) {
        return {
            menuActive: false,
            showPopUp: false,
            dadosPopUp: {
                idRevista: null,
                imgPopUp: "semImagem",
                descricaoPopUp: "nenhuma",
                temaPopUp: "nenhum",
                quantPopUp: 0,
                tituloPopUp: "None",
            },

            //   quantRevitas e imgRevista tem que ser passado pelo props ou vindo direto do banco de dados
            collectionRevistas: this.collectionRevista,
            revistas: [],
            user: this.User,
            links: [],
            prevUrl: "",
            nextUrl: "",
        };
    },
    components: {
        Menu,
        btnMenu,
        imgPerfil,
        cpRevista,
        barraPesquisa,
        popUp,
        Link,
    },
    props: {
        desativar: Boolean,
        collectionRevista: Array,
        dadosRevista: Object,
        User: Object,
    },
    methods: {
        infoPopUp(idRevista) {
            this.dadosPopUp.idRevista = idRevista;
            this.dadosPopUp.imgPopUp = this.dadosRevista.imgPopUp;
            this.dadosPopUp.descricaoPopUp = this.dadosRevista.descricaoPopUp;
            this.dadosPopUp.temaPopUp = this.dadosRevista.temaPopUp;
            this.dadosPopUp.quantPopUp = this.dadosRevista.quantPopUp;
            this.dadosPopUp.tituloPopUp = this.dadosRevista.tituloPopUp;
        },

        // função que muda o estado do pop up
        estadoPopUp(idRevista) {
            const form = useForm({
                idRevista: idRevista,
            });
            form.post("/catalogo/revista", {
                onSuccess: () => {
                    this.infoPopUp(idRevista);
                    this.showPopUp = !this.showPopUp;
                },
            });
        },
        clickMenu(active) {
            this.menuActive = active;
        },
        prepareLinks() {
            this.links = [];

            this.collectionRevistas.links.map((link, index) => {
                if (index == 0) {
                    this.prevUrl = link.url;
                }
                if (index == this.collectionRevistas.links.length - 1) {
                    this.nextUrl = link.url;
                }

                if (!isNaN(parseInt(link.label))) {
                    this.links.push(link);
                }
            });

            const linksFuncionais = this.collectionRevistas.links.filter(
                (link) => !isNaN(parseInt(link.label))
            );

            this.btnPrev = this.collectionRevistas.links[0];
            this.btnNext =
                this.collectionRevistas.links[
                    this.collectionRevistas.links.length - 1
                ];

            const currentIndex = linksFuncionais.findIndex(
                (link) => link.active
            );
            let start = 0;
            if (currentIndex <= 0) {
                start = 0;
            } else if (currentIndex >= linksFuncionais.length - 1) {
                start = linksFuncionais.length - 3;
            } else {
                start = currentIndex - 1;
            }

            start = Math.max(0, start);
            this.links = linksFuncionais.slice(start, start + 3);
        },
    },
    beforeMount() {
        // PREPARA AS REVISTAS
        this.collectionRevistas.data.map((revista) => {
            // console.log(revista.id,revista.imagem);
            this.revistas.push(revista);
        });

        this.prepareLinks();
    },
};
</script>

<template>
    <div id="pg-catalogo">
        <!-- component pop up que ativa através de um props e desativa através de um emit -->
        <pop-up
            v-show="showPopUp"
            :active="showPopUp"
            @desativar="this.showPopUp = !this.showPopUp"
            :user="user"
            :idRevista="dadosPopUp.idRevista"
            :titulo="dadosPopUp.tituloPopUp"
            :img="dadosPopUp.imgPopUp"
            :descricao="dadosPopUp.descricaoPopUp"
            :quant="dadosPopUp.quantPopUp"
            :tema="dadosPopUp.temaPopUp"
        ></pop-up>
        <header>
            <Menu :active="menuActive" page="1" :user="User" />
            <!-- botão de menu -->
            <btnMenu @clickMenu="clickMenu"></btnMenu>
            <!-- Icone de Perfil -->
            <img-perfil></img-perfil>
            <barraPesquisa></barraPesquisa>
        </header>
        <div id="catalogo">
            <!-- {{ criarrevistas() }} -->
            <cpRevista
                v-for="revista in revistas"
                :imgRevista="revista.imagem"
                :key="revista.id"
                @click="estadoPopUp(revista.id)"
            ></cpRevista>
        </div>
        <div class="containerPagination">
            <Link
                class="btnPagination"
                id="btnPrev"
                v-if="prevUrl"
                :href="prevUrl"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g
                        id="SVGRepo_tracerCarrier"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z"
                            fill="var(--cor1)"
                        ></path>
                    </g>
                </svg>
            </Link>
            <div
                class="btnPagination"
                id="btnLink"
                v-for="(link, index) in links"
                :key="index"
                :class="{ active: link.active }"
            >
                <Link class="linkIndex" :href="link.url">{{ link.label }}</Link>
            </div>
            <Link
                class="btnPagination"
                id="btnNext"
                v-if="nextUrl"
                :href="nextUrl"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g
                        id="SVGRepo_tracerCarrier"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M9.71069 18.2929C10.1012 18.6834 10.7344 18.6834 11.1249 18.2929L16.0123 13.4006C16.7927 12.6195 16.7924 11.3537 16.0117 10.5729L11.1213 5.68254C10.7308 5.29202 10.0976 5.29202 9.70708 5.68254C9.31655 6.07307 9.31655 6.70623 9.70708 7.09676L13.8927 11.2824C14.2833 11.6729 14.2833 12.3061 13.8927 12.6966L9.71069 16.8787C9.32016 17.2692 9.32016 17.9023 9.71069 18.2929Z"
                            fill="var(--cor1)"
                        ></path>
                    </g>
                </svg>
            </Link>
        </div>
    </div>
</template>

<style scoped>
#pg-catalogo {
    display: grid;
    grid-template-areas:
        "header"
        "catalogo"
        "pagination";
    grid-template-rows: 240px;
    height: auto;
    padding: 0px 0px 10px 0px;
}

#catalogo {
    grid-area: catalogo;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    height: auto;
    margin-bottom: 20px;
}

header {
    grid-area: header;
    padding-top: 25px;
    width: 100%;
    display: flex;
    align-items: center;
    flex-direction: column;
}

.containerPagination {
    grid-area: pagination;
    width: 100%;
    height: fit-content;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btnPagination {
    width: 50px;
    height: 50px;
    border-radius: 5px;
    background: var(--cor3);
    display: flex;
    align-items: center;
    justify-content: center;
    outline: 1px solid var(--cor1);
}

.btnPagination svg {
    width: 80%;
}

.btnPagination:hover {
    background: var(--cor1);
    cursor: pointer;
}

.btnPagination:hover .linkIndex {
    color: var(--cor3);
}

.btnPagination:hover svg path {
    fill: var(--cor3);
}

.linkIndex {
    width: 100%;
    height: 100%;
    display: flex;
    font-size: 1.5rem;
    align-items: center;
    justify-content: center;
    font-family: var(--roboto);
    font-weight: bolder;
    text-decoration: none;
    text-transform: uppercase;
    color: var(--cor1);
}

.active {
    background: var(--cor1);
    color: var(--cor3);
}

.active > .linkIndex {
    color: var(--cor3) !important;
}
</style>
