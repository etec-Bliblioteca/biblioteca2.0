<script>
import { Link, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

export default {
    name: "Register",
    data() {
        return {
            clickBtn:false,
            formData: {
                nome: "",
                rm: null,
                telefone: "",
                ano: "",
                turma: "",
                periodo: "",
                email: "",
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
    components: {
        Link,
    },
    props: {
        errorMsg: String,
    },
    methods: {
        togglePassword() {
            this.showPassword = !this.showPassword;
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
        // ENVIAR FORMULARIO DE REGISTRO
        register() {
            if (
                this.formData.nome &&
                this.formData.rm &&
                this.formData.telefone &&
                this.formData.email &&
                this.formData.senha
            ) {
                const form = useForm({
                    nome: this.formData.nome,
                    rm: this.formData.rm,
                    telefone: this.formData.telefone,
                    ano: this.formData.ano,
                    turma: this.formData.turma,
                    periodo: this.formData.periodo,
                    email: this.formData.email,
                    senha: this.formData.senha,
                });
                form.post("/register");
                this.submit = true;
            } else {
                Swal.fire({
                    title: "Erro",
                    text: "Por favor, preencha todos os campos obrigatórios",
                    icon: "error",
                });
            }
        },
    },
    mounted() {
        // Fechar dropdowns ao clicar fora
        document.addEventListener("click", (e) => {
            if (!e.target.closest(".custom-select-wrapper")) {
                this.closeDropdowns();
            }
        });
    },
    beforeUpdate() {
        if (this.submit && this.errorMsg) {
            Swal.fire({
                title: "Error",
                text: this.errorMsg,
                icon: "error",
            });
            this.submit = false;
        }
    },
};
</script>

<template>
    <div class="backgorund">
        <div class="modern-form">
            <div class="form-title">Registrar-SE</div>
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
                    <label class="select-label">Email e Senha:</label>
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
                <!-- Senha -->
                <div class="input-group">
                    <div class="input-wrapper">
                        <svg fill="none" viewBox="0 0 24 24" class="input-icon">
                            <path
                                stroke-width="1.5"
                                stroke="currentColor"
                                d="M12 10V14M8 6H16C17.1046 6 18 6.89543 18 8V16C18 17.1046 17.1046 18 16 18H8C6.89543 18 6 17.1046 6 16V8C6 6.89543 6.89543 6 8 6Z"
                            ></path>
                        </svg>
                        <input
                            required
                            placeholder="Senha"
                            class="form-input"
                            :type="showPassword ? 'text' : 'password'"
                            v-model="formData.senha"
                        />
                        <button
                            class="password-toggle"
                            type="button"
                            @click="togglePassword"
                        >
                            <svg
                                fill="none"
                                viewBox="0 0 24 24"
                                class="eye-icon"
                                v-if="!showPassword"
                            >
                                <path
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    d="M2 12C2 12 5 5 12 5C19 5 22 12 22 12C22 12 19 19 12 19C5 19 2 12 2 12Z"
                                ></path>
                                <circle
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    r="3"
                                    cy="12"
                                    cx="12"
                                ></circle>
                            </svg>
                            <svg
                                fill="none"
                                viewBox="0 0 24 24"
                                class="eye-icon"
                                v-else
                            >
                                <path
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <button class="submit-button" type="submit" @click="register()" v-show="!clickBtn">
                <span class="button-text">Registrar</span>
                <div class="button-glow"></div>
            </button>

            <div class="form-footer">
                <Link class="login-link" href="/login">
                    Já tem uma conta? <span>Entrar</span>
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
.backgorund {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--cor3);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.modern-form {
    --primary: var(--cor2);
    --primary-dark: var(--co1);
    --primary-light: rgba(59, 130, 246, 0.1);
    --success: #10b981;
    --text-main: #1e293b;
    --text-secondary: #64748b;
    --bg-input: var(--cor3);

    position: relative;
    width: 420px;
    padding: 32px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -2px rgba(0, 0, 0, 0.05),
        inset 0 0 0 1px rgba(148, 163, 184, 0.1);
    font-family: system-ui, -apple-system, sans-serif;
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

.login-link:hover {
    color: var(--text-main);
}

.login-link:hover span {
    color: var(--primary-dark);
}

/* Active States */
.submit-button:active {
    transform: translateY(0);
    box-shadow: none;
}

.password-toggle:active {
    transform: scale(0.9);
}

/* Validation States */
.form-input:not(:placeholder-shown):valid {
    border-color: var(--success);
}

.form-input:not(:placeholder-shown):valid ~ .input-icon {
    color: var(--success);
}

/* Animation */
@keyframes shake {
    0%,
    100% {
        transform: translateX(0);
    }
    25% {
        transform: translateX(-4px);
    }
    75% {
        transform: translateX(4px);
    }
}

.form-input:not(:placeholder-shown):invalid {
    border-color: #ef4444;
    animation: shake 0.2s ease-in-out;
}

.form-input:not(:placeholder-shown):invalid ~ .input-icon {
    color: #ef4444;
}

@media (max-width: 480px) {
    .modern-form {
        top: 20px;
        width: 300px;
        padding: 24px;
        margin-top: 50px;
    }

    .form-row {
        flex-direction: column;
        gap: 16px;
    }

    .select-row {
        flex-direction: column;
        gap: 12px;
    }
}
</style>
