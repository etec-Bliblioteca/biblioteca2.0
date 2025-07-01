<script>
export default {
    name: "CardLib",
    props: {
        userData: Object,
    },
    emits:['btnCheck','btnRecuse'],
    methods:{
        emitBtnCheck(){
            this.$emit("btnCheck",this.userData.rm);
        },
        emitBtnRecuse(){
            this.$emit("btnRecuse",this.userData.rm);
        }
    }
};
</script>

<template>
    <div class="cardContainer">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g
                id="SVGRepo_tracerCarrier"
                stroke-linecap="round"
                stroke-linejoin="round"
            ></g>
            <g id="SVGRepo_iconCarrier">
                <path
                    opacity="0.4"
                    d="M21.0802 8.58003V15.42C21.0802 16.54 20.4802 17.58 19.5102 18.15L13.5702 21.58C12.6002 22.14 11.4002 22.14 10.4202 21.58L4.48016 18.15C3.51016 17.59 2.91016 16.55 2.91016 15.42V8.58003C2.91016 7.46003 3.51016 6.41999 4.48016 5.84999L10.4202 2.42C11.3902 1.86 12.5902 1.86 13.5702 2.42L19.5102 5.84999C20.4802 6.41999 21.0802 7.45003 21.0802 8.58003Z"
                    fill="#607D8B"
                ></path>
                <path
                    d="M11.9999 12.0001C13.2867 12.0001 14.3299 10.9569 14.3299 9.67004C14.3299 8.38322 13.2867 7.34009 11.9999 7.34009C10.7131 7.34009 9.66992 8.38322 9.66992 9.67004C9.66992 10.9569 10.7131 12.0001 11.9999 12.0001Z"
                    fill="var(--cor1)"
                ></path>
                <path
                    d="M14.6792 16.6601C15.4892 16.6601 15.9592 15.7601 15.5092 15.0901C14.8292 14.0801 13.5092 13.4001 11.9992 13.4001C10.4892 13.4001 9.16919 14.0801 8.48919 15.0901C8.03919 15.7601 8.50919 16.6601 9.31919 16.6601H14.6792Z"
                    fill="var(--cor1)"
                ></path>
            </g>
        </svg>
        <div class="cardDataContainer">
            <p class="name">{{ userData.name }}</p>
            <div class="tagContainer">
                <span class="tagName">RM</span>
                <span class="tagValue">{{ userData.rm }}</span>
            </div>
            <div class="tagContainer">
                <span class="tagName">Turma</span>
                <span class="tagValue">{{ userData.turma }}</span>
            </div>
            <div class="tagContainer">
                <span class="tagName">telefone</span>
                <span class="tagValue">{{ userData.telefone }}</span>
            </div>
            <div class="tagContainer">
                <span class="tagName">email</span>
                <span class="tagValue">{{ userData.email }}</span>
            </div>
        </div>
        <div class="containerButtons">
            <!-- LIBERA O USUARIO -->
            <button id="btnCheck" @click="emitBtnCheck">
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
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM16.0303 8.96967C16.3232 9.26256 16.3232 9.73744 16.0303 10.0303L11.0303 15.0303C10.7374 15.3232 10.2626 15.3232 9.96967 15.0303L7.96967 13.0303C7.67678 12.7374 7.67678 12.2626 7.96967 11.9697C8.26256 11.6768 8.73744 11.6768 9.03033 11.9697L10.5 13.4393L12.7348 11.2045L14.9697 8.96967C15.2626 8.67678 15.7374 8.67678 16.0303 8.96967Z"
                            fill="#1C274C"
                        ></path>
                    </g>
                </svg>
            </button>
            <button id="btnCancel" @click="emitBtnRecuse">
                <svg
                    fill="#000000"
                    viewBox="0 0 32 32"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g
                        id="SVGRepo_tracerCarrier"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>cancel</title>
                        <path
                            d="M10.771 8.518c-1.144 0.215-2.83 2.171-2.086 2.915l4.573 4.571-4.573 4.571c-0.915 0.915 1.829 3.656 2.744 2.742l4.573-4.571 4.573 4.571c0.915 0.915 3.658-1.829 2.744-2.742l-4.573-4.571 4.573-4.571c0.915-0.915-1.829-3.656-2.744-2.742l-4.573 4.571-4.573-4.571c-0.173-0.171-0.394-0.223-0.657-0.173v0zM16 1c-8.285 0-15 6.716-15 15s6.715 15 15 15 15-6.716 15-15-6.715-15-15-15zM16 4.75c6.213 0 11.25 5.037 11.25 11.25s-5.037 11.25-11.25 11.25-11.25-5.037-11.25-11.25c0.001-6.213 5.037-11.25 11.25-11.25z"
                        ></path>
                    </g>
                </svg>
            </button>
        </div>
    </div>
</template>

<style scoped>
.cardContainer {
    min-width: 220px;
    min-height: 250px;
    max-width: 300px;
    outline: 1px solid var(--cor1);
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.363);
    border-radius: 5px;
    background: var(--cor3);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 20px;
    padding: 10px 15px;
}

.cardContainer svg {
    width: 90px;
    height: 90px;
}

.cardContainer .cardDataContainer {
    width: 100%;
    /* border: 1px solid red; */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.cardDataContainer .name {
    word-break: break-all;
    text-align: center;
    font-size: 1.5rem;
    text-align: center;
    font-family: var(--raleway);
    font-weight: 800;
    text-transform: uppercase;
}

.cardDataContainer .tagContainer {
    width: 100%;
    height: fit-content;
    /* border: 1px solid blue; */
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex-wrap: nowrap;
    flex-direction: row;
    gap: 10px;
    padding: 2px 0px;
}

.tagContainer .tagName {
    width: fit-content;
    height: fit-content;
    padding: 2px 5px;
    border-radius: 5px;
    background: var(--cor2);
    font-weight: 900;
    text-transform: uppercase;
    font-family: var(--raleway);
    color: var(--cor1);
    font-size: 0.8rem;
}

.tagContainer .tagValue {
    font-weight: 600;
    font-size: 1rem;
    text-transform: uppercase;
    font-family: var(--roboto);
    color: var(--cor1);
}

.containerButtons {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.containerButtons button {
    width: fit-content;
    height: fit-content;
    padding: 5px 20px;
    border-radius: 5px;
    outline: 2px solid;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.containerButtons button svg {
    width: 30px;
    height: 30px;
}

#btnCheck {
    outline-color: #1f7634;
    background: #58d073;
}

#btnCancel {
    outline-color: #d91212;
    background: #ffc6c6;
}
</style>
