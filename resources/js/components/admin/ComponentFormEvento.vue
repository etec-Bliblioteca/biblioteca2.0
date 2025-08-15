<script>
import { useForm, usePage } from "@inertiajs/vue3";
import Swal from "sweetalert2";

export default {
    name: "FormEvento",
    data() {
        return {
            previewUrl: null,
            file: null,
        };
    },
    emits: ["toggleForm"],
    props: {
        showForm: Boolean,
    },
    methods: {
        btnSave() {
            if (this.file) {
                const form = useForm({
                    file: this.file,
                });
                form.submit("post", "/admin/eventos/add", {
                    onSuccess: () => {
                        const flash = usePage();
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
                    },
                });
            } else {
                Swal.fire({
                    title: "Erro!",
                    text: "Selecione uma imagem para adicionar o evento",
                    icon: "error",
                    confirmButtonColor: "var(--cor1)",
                    confirmButtonText: "OK",
                });
            }
        },
        handleImageUpload(event) {
            const file = event.target.files[0];
            this.file = file;
            if (file && file.type.startsWith("image/")) {
                this.previewUrl = URL.createObjectURL(file);
            } else {
                this.previewUrl = null;
            }
        },
        resetForm() {
            this.previewUrl = null;
            this.file = null;
        },

        toggleForm() {
            this.resetForm();
            this.$emit("toggleForm");
        },
    },
    watch: {
        // ATIVA QUANDO O PROPS MUDAR DE VALOR
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
                <!-- CAPA -->
                <label class="select-label">Imagem do Evento:</label>
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
    width: 100%;
    display: flex;
    flex-direction: column;
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
    object-fit: cover;
    width: 350px;
    height: 150px;
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
