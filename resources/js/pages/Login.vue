<script>
import { Link, useForm, usePage } from "@inertiajs/vue3";
import Swal from "sweetalert2";
export default {
    name: "Login",
    data() {
        return {
            formData: {
                rm: null,
                password: "",
            },
            msg: "",
            submit: false,
            showPassword: false,
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
        login() {
            if (this.formData.rm != 0 || this.formData.password != "") {
                const form = useForm({
                    rm: this.formData.rm,
                    password: this.formData.password,
                });
                form.post("/login");
                this.submit = true;
            }
        },
    },
    beforeUpdate() {
        if (this.submit) {
            Swal.fire({
                title: "Error",
                text: this.errorMsg,
                icon: "error",
            });
            this.submit = false;
        }
    },
    mounted() {
        const flash = usePage();
        if (flash.props.flash.msg != null) {
            Swal.fire({
                title: flash.props.flash.msg.title,
                text: flash.props.flash.msg.text,
                icon: flash.props.flash.msg.icon,
                confirmButtonColor: "var(--cor1)",
                confirmButtonText: "OK",
            });
        }
    },
};
</script>

<template>
    <div class="backgorund">
        <div class="modern-form">
            <div class="form-title">Login</div>
            <div class="form-body">
                <div class="input-group">
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
                                    d="M6.76001 21.11C6.68365 21.1197 6.60637 21.1197 6.53001 21.11C6.34185 21.0413 6.18534 20.9062 6.09001 20.73L1.49001 11.73C1.40445 11.5542 1.38997 11.3521 1.44956 11.1659C1.50916 10.9796 1.63826 10.8235 1.81001 10.73L16.9 3C17.0759 2.90866 17.2809 2.89069 17.47 2.95C17.6582 3.01868 17.8147 3.15385 17.91 3.33L22.51 12.33C22.5956 12.5058 22.61 12.7079 22.5504 12.8941C22.4909 13.0804 22.3618 13.2365 22.19 13.33L7.10001 21C6.99687 21.0628 6.8804 21.1005 6.76001 21.11ZM3.16001 11.68L7.09001 19.35L20.84 12.35L16.91 4.65L3.16001 11.68Z"
                                    fill="var(--cor1)"
                                ></path>
                                <path
                                    d="M8.23 17.09C8.09279 17.0896 7.95841 17.051 7.84186 16.9786C7.72531 16.9062 7.63119 16.8028 7.57 16.68L5.57 12.85C5.52538 12.7628 5.49852 12.6676 5.49098 12.5699C5.48344 12.4723 5.49536 12.3741 5.52606 12.281C5.55676 12.188 5.60562 12.102 5.66981 12.028C5.734 11.954 5.81224 11.8935 5.9 11.85L9.72 9.85C9.89662 9.76261 10.1005 9.74823 10.2877 9.80999C10.4748 9.87174 10.6301 10.0047 10.72 10.18L12.72 14C12.8074 14.1766 12.8218 14.3805 12.76 14.5677C12.6983 14.7548 12.5653 14.9101 12.39 15L8.58 17C8.47113 17.0547 8.35177 17.0854 8.23 17.09ZM7.29 12.84L8.56 15.33L11.05 14.06L9.78 11.57L7.29 12.84Z"
                                    fill="var(--cor1)"
                                ></path>
                            </g>
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
                            required=""
                            placeholder="Senha"
                            class="form-input"
                            :type="showPassword ? 'text' : 'password'"
                            v-model="formData.password"
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

            <button class="submit-button" type="submit" @click="login()">
                <span class="button-text">Logar</span>
                <div class="button-glow"></div>
            </button>

            <div class="form-footer">
                <Link class="login-link" href="/register">
                    Não tem conta? <span>Cadastre-se</span>
                </Link>
                <div class="form-footer">
                    <Link class="login-link" href="/resetpassword">
                        <span>Esqueci minha senha</span>
                    </Link>
                </div>
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
    width: 300px;
    padding: 24px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -2px rgba(0, 0, 0, 0.05),
        inset 0 0 0 1px rgba(148, 163, 184, 0.1);
    font-family: system-ui, -apple-system, sans-serif;
}

.form-title {
    font-size: 22px;
    font-weight: 600;
    color: var(--text-main);
    margin: 0 0 24px;
    text-align: center;
    letter-spacing: -0.01em;
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
    height: 40px;
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
}

.eye-icon {
    width: 16px;
    height: 16px;
}

.submit-button {
    position: relative;
    width: 100%;
    height: 40px;
    margin-top: 8px;
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
    margin-top: 16px;
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
</style>
