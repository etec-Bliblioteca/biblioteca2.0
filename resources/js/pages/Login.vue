<script>
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
export default {
    name: "Login",
    data() {
        return {
            formData: {
                email: "",
                password: "",
            },
            msg: '',
        };
    },
    props: {
        errorMsg: String,
    },
    methods: {
        login() {
            if (this.formData.email != "" || this.formData.password != "") {
                const form = useForm({
                    email: this.formData.email,
                    password: this.formData.password,
                });
                form.post("/login");
            }
        },
    },
    watch: {
        errorMsg(value) {
            Swal.fire({
                title: "Error",
                text: value,
                icon: "error",
            });
        },
    },
    beforeMount() {
      if(this.errorMsg){
        Swal.fire({
            title: "Error",
            text: this.msg,
            icon: "error",
        });
        this.msg = "";
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
                        <svg fill="none" viewBox="0 0 24 24" class="input-icon">
                            <path
                                stroke-width="1.5"
                                stroke="currentColor"
                                d="M3 8L10.8906 13.2604C11.5624 13.7083 12.4376 13.7083 13.1094 13.2604L21 8M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z"
                            ></path>
                        </svg>
                        <input
                            required=""
                            placeholder="Email"
                            class="form-input"
                            type="email"
                            v-model="formData.email"
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
                            type="password"
                            v-model="formData.password"
                        />
                        <button class="password-toggle" type="button">
                            <svg
                                fill="none"
                                viewBox="0 0 24 24"
                                class="eye-icon"
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
                        </button>
                    </div>
                </div>
            </div>

            <button class="submit-button" type="submit" @click="login()">
                <span class="button-text">Logar</span>
                <div class="button-glow"></div>
            </button>

            <div class="form-footer">
                <a class="login-link" href="#">
                    Não tem conta? <span>Cadastre-se</span>
                </a>
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
