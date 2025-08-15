<script>
import FormRevista from "@/components/admin/ComponentFormRevista.vue";
import ListItemRevista from "@/components/admin/ComponentListItemRevista.vue";
import Menu from "@/components/admin/ComponentMenuAdmin.vue";
import Title from "@/components/admin/ComponentTitle.vue";
import { Link, useForm } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";
export default {
    name: "Revistas",
    data() {
        return {
            showForm: false,
            actualPage: this.Revistas.current_page,
            links: [],
            revistaEdit: null,
            prevUrl: "",
            nextUrl: "",
            showList: true,
            resultPesquisa: [],
            txtPesquisar: "",
            showPesq: false,
        };
    },
    components: {
        Menu,
        Title,
        FormRevista,
        ListItemRevista,
        Link,
    },
    props: {
        Revistas: Object,
    },
    methods: {
        toggleForm(indexRevista) {
            if (indexRevista != null) {
                this.revistaEdit = this.Revistas.data[indexRevista];
            }
            // console.log(this.revistaEdit);
            this.showForm = !this.showForm;
        },
        deleteItem(idRevista, index) {
            Swal.fire({
                title: "Tem certeza?",
                text: "Esta ação pode ser irreversivel",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "var(--cor1)",
                cancelButtonColor: "#d33",
                confirmButtonText: "Deletar Revista",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.Revistas.data.splice(index, 1);
                    const form = useForm({
                        idRevista: idRevista,
                    });
                    form.submit("delete", "/admin/revistas");
                }
            });
        },

        // FUNCÇÔES PARA PESQUISA
        pesquisando(estado) {
            this.showList = !estado;
            this.showPesq = estado;
            console.log(this.showList, this.showPesq);
        },
        pesquisar() {
            if (this.txtPesquisar.trim().length == 0) {
                this.pesquisando(false);
                this.semPesquisa();
                return;
            }

            axios
                .get(`/admin/revistas/${this.txtPesquisar}/pesquisar`)
                // Se a requisição for bem-sucedida, emite o evento com os resultados
                .then((response) => {
                    this.resultPesquisa = response.data.revistas;
                    console.log(response);
                })
                // Se a requisição falhar, emite o evento sem-pesquisa com um array vazio
                .catch((error) => {
                    if (this.txtPesquisar.trim().length > 0){
                        console.error(error.response.data.error);
                    }
                });
            this.pesquisando(true);
        },
        semPesquisa() {
            this.resultPesquisa = [];
        },
    },
    mounted() {
        this.Revistas.links.map((link, index) => {
            if (index == 0) {
                this.prevUrl = link.url;
            }
            if (index == this.Revistas.links.length - 1) {
                this.nextUrl = link.url;
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
        <Menu page="3"></Menu>
        <div class="painel">
            <div class="containerFunctions">
                <div class="searchBar">
                    <input
                        v-model="txtPesquisar"
                        type="text"
                        name="inputPesquisa"
                        id="inputPesquisa"
                        @input="pesquisar()"
                    />
                    <button class="btnSearch">
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
                                    d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                                    stroke="var(--cor1)"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></path>
                            </g>
                        </svg>
                    </button>
                </div>
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
                <table class="listRevista" border="none">
                    <thead class="headerList">
                        <tr>
                            <th></th>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Tema</th>
                            <th>Edição</th>
                            <th>ISSN</th>
                            <th class="qtde">Quantidade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody v-show="showList">
                        <ListItemRevista
                            v-for="(revista, index) in Revistas.data"
                            :key="index"
                            :imagem="revista.imagem"
                            :titulo="revista.titulo"
                            :descricao="revista.descricao"
                            :tema="revista.tema"
                            :quantidade="revista.quantidade"
                            :issn="revista.issn"
                            :edicao="revista.edicao"
                            @toggle-form="toggleForm(index)"
                            @delete-item="deleteItem(revista.id, index)"
                        />
                    </tbody>
                    <tbody v-show="showPesq">
                        <ListItemRevista
                            v-for="(revista, index) in resultPesquisa"
                            :key="index"
                            :imagem="revista.imagem"
                            :titulo="revista.titulo"
                            :descricao="revista.descricao"
                            :tema="revista.tema"
                            :quantidade="revista.quantidade"
                            :issn="revista.issn"
                            :edicao="revista.edicao"
                            @toggle-form="toggleForm(index)"
                            @delete-item="deleteItem(revista.id, index)"
                        />
                    </tbody>
                </table>
            </div>
            <FormRevista
                :showForm="showForm"
                @toggle-form="toggleForm"
                :Revista="revistaEdit"
            />
        </div>
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
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
}

.searchBar input {
    flex: 1;
    height: 40px;
    outline: none;
    font-family: var(--roboto);
    font-weight: 500;
    color: var(--cor1);
    background: white;
    border-radius: 5px;
    border: 1px solid var(--cor1);
    padding: 0 12px;
    font-size: 14px;
    transition: all 0.2s ease;
}

.searchBar input:focus {
    border-color: var(--primary, var(--cor1));
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.searchBar input::placeholder {
    color: #94a3b8;
    font-weight: 400;
}

.btnSearch {
    width: 44px;
    height: 44px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--cor1);
    background: var(--cor3);
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    left: -20px;
}

.btnSearch > svg {
    width: 18px;
    height: 18px;
    color: white;
}

.select-label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-main, #374151);
}

.containerSelect {
    display: flex;
    gap: 12px;
    align-items: flex-end;
}

.custom-select-wrapper {
    flex: 1;
    position: relative;
    min-width: 0;
}


.custom-select {
    height: 44px;
    padding: 0 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    background: var(--bg-input, white);
    color: var(--text-main, #374151);
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
    min-width: 0;
}

.custom-select:hover {
    border-color: #cbd5e1;
}

.custom-select.active,
.custom-select:focus {
    outline: none;
    border-color: var(--primary, #3b82f6);
    background: white;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}


.selected-value {
    flex: 1;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    min-width: 0;
    color: var(--text-main, #374151);
}

.selected-value:empty::before {
    content: "Selecionar...";
    color: #94a3b8;
}


.dropdown-arrow {
    width: 16px;
    height: 16px;
    color: var(--text-secondary, #6b7280);
    transition: transform 0.2s ease;
    margin-left: 8px;
    flex-shrink: 0;
}

.dropdown-arrow.rotated {
    transform: rotate(180deg);
}


.dropdown-list {
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    right: 0;
    z-index: 1000;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    animation: dropdownFadeIn 0.15s ease-out;
    max-height: 200px;
    overflow-y: auto;
}


.dropdown-item {
    padding: 12px 16px;
    font-size: 14px;
    color: var(--text-main, #374151);
    cursor: pointer;
    transition: all 0.15s ease;
    background: white;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.dropdown-item:last-child {
    border-bottom: none;
}

.dropdown-item:hover {
    background: #f8fafc;
    color: var(--primary, #3b82f6);
}

.dropdown-item.selected {
    background: var(--primary-light, rgba(59, 130, 246, 0.1));
    color: var(--primary, #3b82f6);
    font-weight: 500;
}

.dropdown-item.selected::after {
    content: "✓";
    color: var(--primary, #3b82f6);
    font-weight: bold;
    font-size: 16px;
}

/* Animação do dropdown */
@keyframes dropdownFadeIn {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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
