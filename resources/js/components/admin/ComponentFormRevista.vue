<script>
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { compileScript } from "vue/compiler-sfc";

export default {
    name: "FormRevista",
    data() {
        return {
            previewUrl: null,
            formData: {
                id: null,
                previewUrl: "",
                titulo: "",
                tema: "",
                issn: "",
                edicao: "",
                quantidade: 0,
                descricao: "",
                imagem: "",
            },
            file: null,
        };
    },
    emits: ["toggleForm"],
    props: {
        showForm: Boolean,
        Revista: Object,
    },
    methods: {
        btnSave() {
            const obrigatorios = [
                "titulo",
                "descricao",
                "tema",
                "issn",
                "quantidade",
                "edicao",
            ];
            const camposValidos = obrigatorios.every(
                (campo) =>
                    this.formData[campo] !== null && this.formData[campo] !== ""
            );

            if (!camposValidos) {
                Swal.fire({
                    title: "Campos obrigatórios!",
                    text: "Preencha todos os campos antes de continuar.",
                    icon: "warning",
                    confirmButtonColor: "var(--cor1)",
                    confirmButtonText: "OK",
                });
                return;
            } else {
                if (this.formData.id == null) {
                    const form = useForm({
                        titulo: this.formData.titulo,
                        descricao: this.formData.descricao,
                        tema: this.formData.tema,
                        issn: this.formData.issn,
                        quantidade: this.formData.quantidade,
                        edicao: this.formData.edicao,
                        imagem: this.formData.imagem,
                        file: this.file,
                    });

                    form.submit("post", "/admin/revistas", {
                        onSuccess: () => {
                            Swal.fire({
                                title: "Revista Criada!",
                                text: "Revistas foi criada com sucesso",
                                icon: "success",
                                confirmButtonColor: "var(--cor1)",
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.toggleForm();
                                }
                            });
                        },
                    });
                } else {
                    const form = useForm({
                        id: this.formData.id,
                        titulo: this.formData.titulo,
                        descricao: this.formData.descricao,
                        tema: this.formData.tema,
                        issn: this.formData.issn,
                        quantidade: this.formData.quantidade,
                        edicao: this.formData.edicao,
                        imagem: this.formData.imagem,
                        file: this.file,
                    });

                    form.submit("post", "/admin/revistas/update", {
                        onSuccess: () => {
                            Swal.fire({
                                title: "Revista Atualzada!",
                                text: "Revista foi atualizada com sucesso",
                                icon: "success",
                                confirmButtonColor: "var(--cor1)",
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.toggleForm();
                                }
                            });
                        },
                    });
                }
            }
        },
        handleImageUpload(event) {
            const file = event.target.files[0];
            this.file = file;
            this.formData.imagem = file.name;
            if (file && file.type.startsWith("image/")) {
                this.previewUrl = URL.createObjectURL(file);
            } else {
                this.previewUrl = null;
            }
        },
        resetForm() {
            this.previewUrl = null;
            (this.formData.id = null), (this.formData.titulo = "");
            this.formData.imagem = "";
            this.formData.tema = "";
            this.formData.issn = "";
            this.formData.edicao = "";
            this.formData.quantidade = 0;
            this.formData.descricao = "";
            this.formData.imagem = "";
            this.file = null;
        },

        toggleForm() {
            this.resetForm();
            this.$emit("toggleForm");
        },
    },
    watch: {
        // ATIVA QUANDO O PROPS MUDAR DE VALOR
        Revista(revista) {
            // PREENCHE OS DADOS ESCOLHIDOS
            this.formData.id = revista.id;
            this.formData.titulo = revista.titulo;
            this.formData.descricao = revista.descricao;
            this.formData.edicao = revista.edicao;
            this.formData.tema = revista.tema;
            this.formData.issn = revista.issn;
            this.formData.edicao = revista.edicao;
            this.formData.quantidade = revista.quantidade;
            this.formData.imagem = revista.imagem;
            this.previewUrl = `../storage/images/${revista.imagem}`;
        },
    },
    mounted() {
        document.addEventListener("keydown", (key) => {
            if (key.key == "Escape" && this.showForm == true) {
                this.resetForm();
                this.$emit("toggleForm");
            }
        });
    },
};
</script>

<template>
    <div class="background" v-show="showForm">
        <div class="modern-form">
            <button id="btnClose" @click="toggleForm()">
                <svg
                    viewBox="0 0 1024 1024"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="#000000"
                >
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g
                        id="SVGRepo_tracerCarrier"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            fill="#000000"
                            d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"
                        ></path>
                    </g>
                </svg>
            </button>

            <div class="form-body">
                <div class="form-row">
                    <div class="input-group">
                        <label class="select-label">Titulo:</label>
                        <div class="input-wrapper">
                            <svg
                                class="input-icon"
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
                                        d="M11.25 17C11.25 17.4142 11.5858 17.75 12 17.75C12.4142 17.75 12.75 17.4142 12.75 17H11.25ZM15.25 9.75C15.25 10.1642 15.5858 10.5 16 10.5C16.4142 10.5 16.75 10.1642 16.75 9.75H15.25ZM7.25 9.75C7.25 10.1642 7.58579 10.5 8 10.5C8.41421 10.5 8.75 10.1642 8.75 9.75H7.25ZM15.7071 7.32544L16.2646 6.82371V6.82371L15.7071 7.32544ZM9.5 16.25C9.08579 16.25 8.75 16.5858 8.75 17C8.75 17.4142 9.08579 17.75 9.5 17.75V16.25ZM15 17.75C15.4142 17.75 15.75 17.4142 15.75 17C15.75 16.5858 15.4142 16.25 15 16.25V17.75ZM10 7.75H12V6.25H10V7.75ZM12 7.75H14V6.25H12V7.75ZM12.75 17V7H11.25V17H12.75ZM15.25 9.22222V9.75H16.75V9.22222H15.25ZM7.25 9.22222V9.75H8.75V9.22222H7.25ZM14 7.75C14.4949 7.75 14.7824 7.75196 14.9865 7.78245C15.0783 7.79617 15.121 7.8118 15.1376 7.8194C15.148 7.82415 15.1477 7.82503 15.1496 7.82716L16.2646 6.82371C15.96 6.4853 15.579 6.35432 15.2081 6.29891C14.8676 6.24804 14.4479 6.25 14 6.25V7.75ZM16.75 9.22222C16.75 8.71757 16.7513 8.27109 16.708 7.91294C16.6629 7.54061 16.559 7.15082 16.2646 6.82371L15.1496 7.82716C15.1523 7.83015 15.1609 7.83939 15.1731 7.87221C15.1873 7.91048 15.2048 7.97725 15.2188 8.09313C15.2487 8.34011 15.25 8.67931 15.25 9.22222H16.75ZM10 6.25C9.55208 6.25 9.13244 6.24804 8.79192 6.29891C8.42102 6.35432 8.04 6.4853 7.73542 6.82371L8.85036 7.82716C8.85228 7.82503 8.85204 7.82415 8.86242 7.8194C8.87904 7.8118 8.92168 7.79617 9.01354 7.78245C9.21765 7.75196 9.50511 7.75 10 7.75V6.25ZM8.75 9.22222C8.75 8.67931 8.75129 8.34011 8.78118 8.09313C8.7952 7.97725 8.81273 7.91048 8.8269 7.87221C8.83905 7.83939 8.84767 7.83015 8.85036 7.82716L7.73542 6.82371C7.44103 7.15082 7.3371 7.54061 7.29204 7.91294C7.24871 8.27109 7.25 8.71757 7.25 9.22222H8.75ZM9.5 17.75H15V16.25H9.5V17.75Z"
                                        fill="var(--cor1)"
                                    ></path>
                                    <path
                                        d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                                        stroke="var(--cor1)"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    ></path>
                                </g>
                            </svg>
                            <input
                                required
                                placeholder="Titulo aqui"
                                class="form-input"
                                id="txtTitulo"
                                type="text"
                                v-model="formData.titulo"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label class="select-label">Tema:</label>
                        <div class="input-wrapper">
                            <svg
                                class="input-icon"
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
                                        d="M7.0498 7.0498H7.0598M10.5118 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V10.5118C3 11.2455 3 11.6124 3.08289 11.9577C3.15638 12.2638 3.27759 12.5564 3.44208 12.8249C3.6276 13.1276 3.88703 13.387 4.40589 13.9059L9.10589 18.6059C10.2939 19.7939 10.888 20.388 11.5729 20.6105C12.1755 20.8063 12.8245 20.8063 13.4271 20.6105C14.112 20.388 14.7061 19.7939 15.8941 18.6059L18.6059 15.8941C19.7939 14.7061 20.388 14.112 20.6105 13.4271C20.8063 12.8245 20.8063 12.1755 20.6105 11.5729C20.388 10.888 19.7939 10.2939 18.6059 9.10589L13.9059 4.40589C13.387 3.88703 13.1276 3.6276 12.8249 3.44208C12.5564 3.27759 12.2638 3.15638 11.9577 3.08289C11.6124 3 11.2455 3 10.5118 3ZM7.5498 7.0498C7.5498 7.32595 7.32595 7.5498 7.0498 7.5498C6.77366 7.5498 6.5498 7.32595 6.5498 7.0498C6.5498 6.77366 6.77366 6.5498 7.0498 6.5498C7.32595 6.5498 7.5498 6.77366 7.5498 7.0498Z"
                                        stroke="var(--cor1)"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    ></path>
                                </g>
                            </svg>
                            <input
                                placeholder="Ex: Ciência"
                                class="form-input"
                                type="text"
                                id="txtTema"
                                v-model="formData.tema"
                            />
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="select-label">ISSN:</label>
                        <div class="input-wrapper">
                            <svg
                                class="input-icon"
                                viewBox="0 0 512 512"
                                version="1.1"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                fill="var(--cor1)"
                            >
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g
                                    id="SVGRepo_tracerCarrier"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>bar-code</title>
                                    <g
                                        id="Page-1"
                                        stroke="none"
                                        stroke-width="1"
                                        fill="none"
                                        fill-rule="evenodd"
                                    >
                                        <g
                                            id="drop"
                                            fill="var(--cor1)"
                                            transform="translate(42.666667, 85.333333)"
                                        >
                                            <path
                                                d="M42.6666667,1.42108547e-14 L42.6666667,341.333333 L7.10542736e-15,341.333333 L7.10542736e-15,1.42108547e-14 L42.6666667,1.42108547e-14 Z M128,1.42108547e-14 L128,341.333333 L85.3333333,341.333333 L85.3333333,1.42108547e-14 L128,1.42108547e-14 Z M213.333333,1.42108547e-14 L213.333333,341.333333 L170.666667,341.333333 L170.666667,1.42108547e-14 L213.333333,1.42108547e-14 Z M426.666667,1.42108547e-14 L426.666667,341.333333 L384,341.333333 L384,1.42108547e-14 L426.666667,1.42108547e-14 Z M277.333333,1.42108547e-14 L277.333333,341.333333 L256,341.333333 L256,1.42108547e-14 L277.333333,1.42108547e-14 Z M341.333333,1.42108547e-14 L341.333333,341.333333 L320,341.333333 L320,1.42108547e-14 L341.333333,1.42108547e-14 Z"
                                                id="Combined-Shape"
                                            ></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <input
                                required
                                class="form-input"
                                type="text"
                                v-model="formData.issn"
                            />
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="select-label">Edição:</label>
                        <div class="input-wrapper">
                            <svg
                                class="input-icon"
                                viewBox="0 0 16 16"
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
                                        d="M13 0H3V2H13V0Z"
                                        fill="var(--cor1)"
                                    ></path>
                                    <path
                                        d="M2 4H14V6H2V4Z"
                                        fill="var(--cor1)"
                                    ></path>
                                    <path
                                        d="M1 8H15V15H1V8Z"
                                        fill="var(--cor1)"
                                    ></path>
                                </g>
                            </svg>
                            <input
                                class="form-input"
                                type="text"
                                v-model="formData.edicao"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label class="select-label">Quantidade:</label>
                        <div class="input-wrapper">
                            <svg
                                class="input-icon"
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
                                        d="M3.46436 20.5354L20.5354 3.46436"
                                        stroke="var(--cor1)"
                                        stroke-width="1.5"
                                    ></path>
                                    <path
                                        d="M18 17H13"
                                        stroke="var(--cor1)"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    ></path>
                                    <path
                                        d="M10.5 8.00002H8M8 8.00002L5.5 8.00002M8 8.00002L8 5.5M8 8.00002L8 10.5"
                                        stroke="var(--cor1)"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    ></path>
                                    <path
                                        d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                                        stroke="var(--cor1)"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    ></path>
                                </g>
                            </svg>
                            <input
                                required
                                class="form-input"
                                type="number"
                                v-model="formData.quantidade"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label class="select-label">Descrição:</label>
                        <div class="input-wrapper no-icon">
                            <textarea
                                required
                                class="form-input textarea-style"
                                placeholder="Escreva a descrição aqui..."
                                v-model="formData.descricao"
                            ></textarea>
                        </div>
                    </div>
                </div>
                <!-- CAPA -->
                <label class="select-label">Capa da Revista:</label>
                <div class="form-row upload-row">
                    <div class="input-group upload-group">
                        <label class="upload-label">
                            <svg
                                class="upload-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    fill="currentColor"
                                    d="M12 3L12 15M12 15L16 11M12 15L8 11M4 17H20"
                                    stroke="#2563eb"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>

                            <input
                                type="file"
                                accept="image/png, image/gif, image/jpeg"
                                class="upload-input"
                                @change="handleImageUpload"
                            />
                        </label>
                    </div>
                    <div class="preview-wrapper" v-if="previewUrl">
                        <img
                            :src="previewUrl"
                            alt="Preview da capa"
                            class="capa-img"
                        />
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button class="submit-button" @click="btnSave()">
                    <span class="button-text">Salvar</span>
                    <div class="button-glow"></div>
                </button>

                <button
                    class="submit-button cancel-button"
                    @click="toggleForm()"
                >
                    <span class="button-text">Cancelar</span>
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.281);
    border-radius: 10px;
    backdrop-filter: blur(5px);
    z-index: 100;
    overflow: auto;
}

.modern-form {
    --primary: var(--cor2);
    --primary-dark: var(--co1);
    --primary-light: rgba(59, 130, 246, 0.1);
    --success: #10b981;
    --text-main: #1e293b;
    --text-secondary: #64748b;
    --bg-input: var(--cor3);
    overflow-y: scroll;
    width: 500px;
    height: 500px;
    padding: 40px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -2px rgba(0, 0, 0, 0.05),
        inset 0 0 0 1px rgba(148, 163, 184, 0.1);
    font-family: system-ui, -apple-system, sans-serif;
    position: absolute;
    animation: scale-up-center 0.1s cubic-bezier(0.39, 0.575, 0.565, 1) both;
    z-index: 1000;

}

@keyframes scale-up-center {
    0% {
        -webkit-transform: scale(0.5);
        transform: scale(0.5);
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}

.modern-form::-webkit-scrollbar {
    display: none;
}

#btnClose {
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 10px;
    top: 20px;
    right: 20px;
    background: none;
}

.form-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--text-main);
    margin: 0 0 24px;
    text-align: center;
    letter-spacing: -0.01em;
}

.form-row {
    display: flex;
    gap: 12px;
    margin-bottom: 16px;
}

.form-row .input-group {
    flex: 1;
    margin-bottom: 0;
}

.input-group {
    margin-bottom: 16px;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}
.input-wrapper.no-icon {
    padding-left: 0; /* remove espaço do ícone */
}

.textarea-style {
    resize: vertical;
    min-height: 100px;
    padding: 10px 16px !important;
    line-height: 1.5;
    font-size: 14px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    background: var(--bg-input);
    color: var(--text-main);
    transition: all 0.2s ease;
    font-family: system-ui, sans-serif;
}

.textarea-style::placeholder {
    color: var(--text-secondary);
}

.textarea-style:hover {
    border-color: #cbd5e1;
}

.textarea-style:focus {
    outline: none;
    border-color: var(--primary);
    background: white;
    box-shadow: 0 0 0 4px var(--primary-light);
}

.form-input {
    width: 100%;
    height: 44px;
    padding: 0 36px;
    font-size: 14px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    background: var(--bg-input);
    color: var(--text-main);
    transition: all 0.2s ease;
}

.form-input::placeholder {
    color: var(--text-secondary);
}

.input-icon {
    position: absolute;
    left: 12px;
    width: 16px;
    height: 16px;
    color: var(--text-secondary);
    pointer-events: none;
    z-index: 1;
}

.password-toggle {
    position: absolute;
    right: 12px;
    display: flex;
    align-items: center;
    padding: 4px;
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.2s ease;
    z-index: 1;
}

.eye-icon {
    width: 16px;
    height: 16px;
}

.select-label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-main);
}

.select-row {
    display: flex;
    gap: 8px;
}

.custom-select-wrapper {
    flex: 1;
    position: relative;
}

.custom-select {
    height: 44px;
    padding: 0 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    background: var(--bg-input);
    color: var(--text-main);
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
}

.custom-select:hover {
    border-color: #cbd5e1;
}

.custom-select.active,
.custom-select:focus {
    outline: none;
    border-color: var(--primary);
    background: white;
    box-shadow: 0 0 0 4px var(--primary-light);
}

.selected-value {
    flex: 1;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.dropdown-arrow {
    width: 16px;
    height: 16px;
    color: var(--text-secondary);
    transition: transform 0.2s ease;
    margin-left: 8px;
    flex-shrink: 0;
}

.dropdown-arrow.rotated {
    transform: rotate(180deg);
}

.dropdown-list {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 1000;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    margin-top: 4px;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    animation: dropdownFadeIn 0.15s ease-out;
}

.dropdown-item {
    padding: 12px 16px;
    font-size: 14px;
    color: var(--text-main);
    cursor: pointer;
    transition: all 0.15s ease;
    background: white;
    border-bottom: 1px solid #f1f5f9;
}

.dropdown-item:last-child {
    border-bottom: none;
}

.dropdown-item:hover {
    background: #f8fafc;
    color: var(--primary);
}

.dropdown-item.selected {
    background: var(--primary-light);
    color: var(--primary);
    font-weight: 500;
    position: relative;
}

.dropdown-item.selected::after {
    content: "✓";
    position: absolute;
    right: 16px;
    color: var(--primary);
    font-weight: bold;
}

@keyframes dropdownFadeIn {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.submit-button {
    position: relative;
    width: 100%;
    height: 44px;
    margin-top: 12px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.2s ease;
}

.button-glow {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
    );
    transform: translateX(-100%);
    transition: transform 0.5s ease;
}

.form-footer {
    margin-top: 20px;
    text-align: center;
    font-size: 13px;
}

.login-link {
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.2s ease;
}

.login-link span {
    color: var(--primary);
    font-weight: 500;
}

/* Hover & Focus States */
.form-input:hover {
    border-color: #cbd5e1;
}

.form-input:focus {
    outline: none;
    border-color: var(--primary);
    background: white;
    box-shadow: 0 0 0 4px var(--primary-light);
}

.password-toggle:hover {
    color: var(--primary);
    transform: scale(1.1);
}

.submit-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25),
        0 2px 4px rgba(59, 130, 246, 0.15);
}

.submit-button:hover .button-glow {
    transform: translateX(100%);
}

.button-group {
    display: flex;
    gap: 12px;
    margin-top: 16px;
}

.cancel-button {
    background: white;
    color: var(--primary);
    border: 1px solid var(--primary);
    box-shadow: none;
    position: relative;
    overflow: hidden;
}

.cancel-button:hover {
    background: var(--primary-light);
    color: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.cancel-button .button-glow {
    display: none;
}

.upload-group {
    flex: 0 !important;
    gap: 10px !important;
}

.upload-row {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.upload-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: var(--bg-input);
    border: 1px dashed #94a3b8;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.upload-label:hover {
    background-color: #f1f5f9;
    border-color: #2563eb;
}

.upload-input {
    display: none;
}

.upload-icon {
    width: 20px;
    height: 20px;
    color: #2563eb;
}

.upload-text {
    font-size: 14px;
    font-weight: 500;
    color: #1e293b;
}

.preview-wrapper {
    width: 100px;
    height: 140px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    background-color: #f9fafb;
    display: flex;
    align-items: center;
    justify-content: center;
}

.capa-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
