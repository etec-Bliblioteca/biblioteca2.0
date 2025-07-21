<script>
import { useForm, usePage } from "@inertiajs/vue3";
import Swal from "sweetalert2";

export default {
    name: "FormUser",
    data() {
        return {
            formData: {
                id: null,
                nome: "",
                rm: null,
                telefone: "",
                ano: "",
                turma: "",
                periodo: "",
                email: "",
                nivel: null,
                senha: "",
            },
            showPassword: false,
            submit: false,
            dropdowns: {
                ano: false,
                turma: false,
                periodo: false,
            },
        };
    },
    emits: ["toggleForm"],
    props: {
        showForm: Boolean,
        UserEdit: Object,
    },
    methods: {
        btnSave() {
            const obrigatorios = [
                "rm",
                "nivel",
                "state",
                "email",
                "password",
                "telefone",
                "turma",
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
                    let nivelNum =
                        this.formData.nivel == "Administrador" ? 1 : 0;
                    let turma = `${this.formData.ano} ${this.formData.turma} ${this.formData.periodo}`;
                    const form = useForm({
                        nome: this.formData.nome,
                        rm: this.formData.rm,
                        nivel: nivelNum,
                        turma: turma,
                        telefone: this.formData.telefone,
                        email: this.formData.email,
                    });
                    form.submit("put", "/admin/users", {
                        onSuccess: () => {
                            const flash = usePage();
                            if (flash.props.flash.msg) {
                                Swal.fire({
                                    title: flash.props.flash.msg.title,
                                    text: flash.props.flash.msg.text,
                                    icon: flash.props.flash.msg.icon,
                                    confirmButtonColor: "var(--cor1)",
                                    confirmButtonText: "OK",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        this.toggleForm();
                                    }
                                });
                            }
                        },
                        onError: () => {
                            Swal.fire({
                                title: "Algo deu Errado!",
                                text: "Algo não saiu como esperado",
                                icon: "error",
                                confirmButtonColor: "var(--cor1)",
                                confirmButtonText: "OK",
                            });
                        },
                    });
                } else {
                    let nivelNum =
                        this.formData.nivel == "Administrador" ? 1 : 0;
                    let turma = `${this.formData.ano} ${this.formData.turma} ${this.formData.periodo}`;
                    const form = useForm({
                        id: this.formData.id,
                        nome: this.formData.nome,
                        rm: this.formData.rm,
                        nivel: nivelNum,
                        turma: turma,
                        telefone: this.formData.telefone,
                        email: this.formData.email,
                    });
                    form.submit("post", "/admin/users/edit", {
                        onSuccess: () => {
                            const flash = usePage();
                            if (flash.props.flash.msg) {
                                Swal.fire({
                                    title: flash.props.flash.msg.title,
                                    text: flash.props.flash.msg.text,
                                    icon: flash.props.flash.msg.icon,
                                    confirmButtonColor: "var(--cor1)",
                                    confirmButtonText: "OK",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        this.toggleForm();
                                    }
                                });
                            }
                        },
                        onError: () => {
                            Swal.fire({
                                title: "Algo deu Errado!",
                                text: "Algo não saiu como esperado",
                                icon: "error",
                                confirmButtonColor: "var(--cor1)",
                                confirmButtonText: "OK",
                            });
                        },
                    });
                }
            }
        },
        resetForm() {
            // RESETAR FORMULARIO
            this.formData.id = null;
            this.formData.nome = "";
            this.formData.rm = "";
            this.formData.telefone = "";
            this.formData.ano = "";
            this.formData.turma = "";
            this.formData.periodo = "";
            this.formData.nivel = null;
            this.formData.email = null;
            this.closeDropdowns();
        },
        toggleDropdown(dropdown) {
            // Fecha todos os outros dropdowns
            Object.keys(this.dropdowns).forEach((key) => {
                if (key !== dropdown) {
                    this.dropdowns[key] = false;
                }
            });
            // Toggle do dropdown clicado
            this.dropdowns[dropdown] = !this.dropdowns[dropdown];
        },
        selectOption(type, value) {
            this.formData[type] = value;
            this.dropdowns[type] = false;
        },
        closeDropdowns() {
            Object.keys(this.dropdowns).forEach((key) => {
                this.dropdowns[key] = false;
            });
        },
        toggleForm() {
            this.resetForm();
            this.$emit("toggleForm");
        },
        togglePassword() {
            this.showPassword = !this.showPassword;
        },
    },
    watch: {
        // ATIVA QUANDO O PROPS MUDAR DE VALOR
        UserEdit(user) {
            // PREENCHE OS DADOS ESCOLHIDOS
            this.formData.id = user.id;
            this.formData.nome = user.name;
            this.formData.rm = user.rm;
            if (user.nivel == 0) {
                this.formData.nivel = "Aluno";
            } else {
                this.formData.nivel = "Administrador";
            }
            this.formData.telefone = user.telefone;
            this.formData.email = user.email;
            let turmaSeparada = user.turma.split(" ");
            this.formData.ano = turmaSeparada[0];
            this.formData.turma = turmaSeparada[1];
            this.formData.periodo = turmaSeparada[2];
        },
        Msg(newMsg) {
            console.log(newMsg);
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
                <!-- Nome e RM -->
                <label class="select-label">Dados Escolar:</label>
                <div class="form-row">
                    <div class="input-group">
                        <div class="input-wrapper">
                            <svg
                                fill="none"
                                viewBox="0 0 24 24"
                                class="input-icon"
                            >
                                <path
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7ZM12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                ></path>
                            </svg>
                            <input
                                required
                                placeholder="Nome"
                                class="form-input"
                                type="text"
                                v-model="formData.nome"
                            />
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-wrapper">
                            <svg
                                fill="none"
                                viewBox="0 0 24 24"
                                class="input-icon"
                            >
                                <path
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    d="M10 2V5M14 2V5M7 10H17M6 8H18C19.1046 8 20 8.89543 20 10V18C20 19.1046 19.1046 20 18 20H6C4.89543 20 4 19.1046 4 18V10C4 8.89543 4.89543 8 6 8Z"
                                ></path>
                            </svg>
                            <input
                                required
                                placeholder="RM"
                                class="form-input"
                                type="nunber"
                                maxlength="5"
                                v-model="formData.rm"
                            />
                        </div>
                    </div>
                </div>

                <!-- Telefone -->
                <div class="input-group">
                    <div class="input-wrapper">
                        <svg fill="none" viewBox="0 0 24 24" class="input-icon">
                            <path
                                stroke-width="1.5"
                                stroke="currentColor"
                                d="M3 5C3 3.89543 3.89543 3 5 3H8.27924C8.70967 3 9.09181 3.27543 9.22792 3.68377L10.7257 8.17721C10.8831 8.64932 10.6694 9.16531 10.2243 9.38787L7.96701 10.5165C9.06925 12.9612 11.0388 14.9308 13.4835 16.033L14.6121 13.7757C14.8347 13.3306 15.3507 13.1169 15.8228 13.2743L20.3162 14.7721C20.7246 14.9082 21 15.2903 21 15.7208V19C21 20.1046 20.1046 21 19 21H18C9.71573 21 3 14.2843 3 6V5Z"
                            ></path>
                        </svg>
                        <input
                            required
                            placeholder="(11)99999-9999"
                            class="form-input"
                            type="tel"
                            maxlength="11"
                            v-model="formData.telefone"
                            @change="mascaraTel"
                        />
                    </div>
                </div>

                <!-- Nivel -->
                <div class="input-group">
                    <label class="select-label">Nivel:</label>
                    <div class="select-row">
                        <div class="custom-select-wrapper">
                            <div
                                class="custom-select"
                                @click="toggleDropdown('nivel')"
                                :class="{ active: dropdowns.nivel }"
                            >
                                <span class="selected-value">{{
                                    formData.nivel
                                }}</span>
                                <svg
                                    class="dropdown-arrow"
                                    :class="{ rotated: dropdowns.nivel }"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        d="M19.5 8.25L12 15.75L4.5 8.25"
                                    ></path>
                                </svg>
                            </div>
                            <div class="dropdown-list" v-show="dropdowns.nivel">
                                <div
                                    class="dropdown-item"
                                    @click="
                                        selectOption('nivel', 'Administrador')
                                    "
                                >
                                    Administrador
                                </div>
                                <div
                                    class="dropdown-item"
                                    @click="selectOption('nivel', 'Aluno')"
                                >
                                    Aluno
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Turma -->
                <div class="input-group">
                    <label class="select-label">Turma:</label>
                    <div class="select-row">
                        <!-- Ano -->
                        <div class="custom-select-wrapper">
                            <div
                                class="custom-select"
                                @click="toggleDropdown('ano')"
                                :class="{ active: dropdowns.ano }"
                            >
                                <span class="selected-value">{{
                                    formData.ano
                                }}</span>
                                <svg
                                    class="dropdown-arrow"
                                    :class="{ rotated: dropdowns.ano }"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        d="M19.5 8.25L12 15.75L4.5 8.25"
                                    ></path>
                                </svg>
                            </div>
                            <div class="dropdown-list" v-show="dropdowns.ano">
                                <div
                                    class="dropdown-item"
                                    v-for="ano in ['1°', '2°', '3°']"
                                    :key="ano"
                                    :class="{ selected: formData.ano === ano }"
                                    @click="selectOption('ano', ano)"
                                >
                                    {{ ano }}
                                </div>
                            </div>
                        </div>

                        <!-- Turma -->
                        <div class="custom-select-wrapper">
                            <div
                                class="custom-select"
                                @click="toggleDropdown('turma')"
                                :class="{ active: dropdowns.turma }"
                            >
                                <span class="selected-value">{{
                                    formData.turma
                                }}</span>
                                <svg
                                    class="dropdown-arrow"
                                    :class="{ rotated: dropdowns.turma }"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        d="M19.5 8.25L12 15.75L4.5 8.25"
                                    ></path>
                                </svg>
                            </div>
                            <div class="dropdown-list" v-show="dropdowns.turma">
                                <div
                                    class="dropdown-item"
                                    v-for="turma in [
                                        'Informática',
                                        'Administração',
                                        'Logística',
                                        'Marketing',
                                    ]"
                                    :key="turma"
                                    :class="{
                                        selected: formData.turma === turma,
                                    }"
                                    @click="selectOption('turma', turma)"
                                >
                                    {{ turma }}
                                </div>
                            </div>
                        </div>

                        <!-- Período -->
                        <div class="custom-select-wrapper">
                            <div
                                class="custom-select"
                                @click="toggleDropdown('periodo')"
                                :class="{ active: dropdowns.periodo }"
                            >
                                <span class="selected-value">{{
                                    formData.periodo
                                }}</span>
                                <svg
                                    class="dropdown-arrow"
                                    :class="{ rotated: dropdowns.periodo }"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        d="M19.5 8.25L12 15.75L4.5 8.25"
                                    ></path>
                                </svg>
                            </div>
                            <div
                                class="dropdown-list"
                                v-show="dropdowns.periodo"
                            >
                                <div
                                    class="dropdown-item"
                                    v-for="periodo in [
                                        'Manhã',
                                        'Tarde',
                                        'Noite',
                                    ]"
                                    :key="periodo"
                                    :class="{
                                        selected: formData.periodo === periodo,
                                    }"
                                    @click="selectOption('periodo', periodo)"
                                >
                                    {{ periodo }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Email -->
                <div class="input-group">
                    <label class="select-label">Email:</label>
                    <div class="input-wrapper">
                        <svg fill="none" viewBox="0 0 24 24" class="input-icon">
                            <path
                                stroke-width="1.5"
                                stroke="currentColor"
                                d="M3 8L10.8906 13.2604C11.5624 13.7083 12.4376 13.7083 13.1094 13.2604L21 8M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z"
                            ></path>
                        </svg>
                        <input
                            required
                            placeholder="Email"
                            class="form-input"
                            type="email"
                            v-model="formData.email"
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
    height: fit-content;
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
