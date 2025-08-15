<script>
import Evento from "@/components/admin/ComponentEvento.vue";
import FormEvento from "@/components/admin/ComponentFormEvento.vue";
import Menu from "@/components/admin/ComponentMenuAdmin.vue";
import Title from "@/components/admin/ComponentTitle.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import Swal from "sweetalert2";
export default {
    name: "Usuarios",
    data() {
        return {
            showForm: false,
            eventoEdit: null,
            links: [],
            prevUrl:"",
            nextUrl:'',
        };
    },
    components: {
        Menu,
        Title,
        Link,
        Evento,
        FormEvento,
    },
    props: {
        Users: Object,
        msg: Object,
        CollectionEventos:Object,
    },
    methods: {
        toggleForm() {
            // ARRUMAR O FORM PAR EVENTO
            this.showForm = !this.showForm;
        },
        deleteItem(id, index) {
            Swal.fire({
                title: "Tem certeza?",
                text: "Esta ação pode ser irreversivel",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "var(--cor1)",
                cancelButtonColor: "#d33",
                confirmButtonText: "Deletar Usuário",
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = useForm({
                        id: id,
                    });
                    form.submit("delete", "/admin/eventos", {
                        onSuccess: () => {
                            const flash = usePage();
                            Swal.fire({
                                title: flash.props.flash.msg.title,
                                text: flash.props.flash.msg.text,
                                icon: flash.props.flash.msg.icon,
                                confirmButtonColor: "var(--cor1)",
                                confirmButtonText: "OK",
                            });
                        },
                    });
                }
            });
        },
    },
    beforeMount() {
        console.log(this.CollectionEventos);

        this.CollectionEventos.links.map((link,index) => {
            if(index == 0){
                this.prevUrl = link.url
            }
            if(index == this.CollectionEventos.links.length - 1 ){
                this.nextUrl = link.url
            }

            if (!isNaN(parseInt(link.label))) {
                this.links.push(link);
            }
        });
    },
};
</script>
<template>
    <div class="containerAdmin">
        <Menu page="5"></Menu>
        <div class="painel">
            <div class="containerFunctions">
                <div class="containerActions">
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
                            <Link class="linkIndex" :href="link.url">{{
                                link.label
                            }}</Link>
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
                    <button
                        class="btnAdd"
                        id="btnAdd"
                        @click="toggleForm(null)"
                    >
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"
                            />
                        </svg>
                        <span class="text">Adicionar</span>
                    </button>
                </div>
            </div>
            <div class="containerList">
                <Evento v-for="(evento,index) in CollectionEventos.data" :key="index" :imagem="evento.imagem" @delete-item="deleteItem(evento.id)"/>
            </div>
        </div>
        <FormEvento :showForm="showForm" @toggle-form="toggleForm"/>
    </div>
</template>

<style scoped>
.containerFunctions {
    width: 100%;
    height: fit-content;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.containerActions {
    width: fit-content;
    display: flex;
    align-items: center;
    justify-content: center;
}

.searchBar {
    /* width: 80%; */
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    border-radius: 0px 5px 5px 0px;
}

.searchBar input {
    width: 100%;
    height: 20px;
    outline: none;
    font-family: var(--roboto);
    font-weight: bolder;
    color: var(--cor1);
    gap: 5px;
    background: white;
    border-radius: 5px 0px 0px 5px;
    border: 1px solid var(--cor1);
    padding: 5px 10px;
}

.btnSearch {
    width: 45px;
    height: 35px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    outline: 1px solid var(--cor1);
    background: var(--cor3);
    cursor: pointer;
}

.btnSearch > svg {
    width: 15px;
    height: 15px;
}

.containerPagination {
    width: fit-content;
    height: fit-content;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btnPagination {
    width: 35px;
    height: 35px;
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

.btnAdd {
    height: 40px;
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--cor1);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(96, 125, 139, 0.3);
    overflow: hidden;
    margin-left: 20px;
}

.btnAdd:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(96, 125, 139, 0.4);
    background: var(--cor2);
}

.btnAdd:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(96, 125, 139, 0.3);
}

.btnAdd::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
    );
    transition: left 0.5s ease;
}

.btnAdd:hover::before {
    left: 100%;
}

.btnAdd svg {
    width: 16px;
    height: 16px;
    fill: currentColor;
}

.containerList {
    width: 100%;
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    flex-direction: row;
    flex-wrap: wrap;
    background: var(--corFundoPrincipal);
    gap: 10px;
}

.listRevista {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
    table-layout: fixed;
}

.headerList th {
    background: var(--cor3);
    padding: 15px;
    text-align: center;
    font-size: 0.8rem;
    text-transform: uppercase;
    color: var(--cor1);
    font-family: var(--raleway);
    font-weight: 900;
    width: 10%;
}

th.qtde {
    text-align: center;
}

th:first-child {
    border-top-left-radius: 10px;
}

th:last-child {
    border-top-right-radius: 10px;
}
</style>
