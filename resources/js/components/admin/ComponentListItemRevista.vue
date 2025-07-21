<script>
export default {
    name: "ItemListRevista",
    emits:['toggleForm','deleteItem'],
    props:{
        imagem:String,
        titulo:String,
        descricao:String,
        tema:String,
        edicao:String,
        issn:String,
        quantidade:Number,
    }
};
</script>

<template>
    <tr class="listItem">
        <td>
            <img :src="`../storage/images/${imagem}`" />
        </td>
        <td>
            {{ titulo }}
        </td>
        <td>{{ descricao }}</td>
        <td>{{ tema }}</td>
        <td>{{ edicao }}</td>
        <td>{{ issn }}</td>
        <td class="td.qtde">{{ quantidade }}</td>
        <td class="containerButtons">
            <button title="Editar" @click="$emit('toggleForm')">
                <!-- Ícone lápis -->
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z"
                        fill="#0F0F0F"
                    />
                </svg>
            </button>

            <button title="Excluir" @click="$emit('deleteItem')">
                <!-- Ícone lixeira -->
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
                            d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                            stroke="#000000"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </g>
                </svg>
            </button>
        </td>
    </tr>
</template>


<style scoped>
.listItem {
    background: #fff;
    overflow: hidden;
    position: relative;
}

.listItem:hover::after {
    content: "";
    /* display: none; */
    width: 5px;
    height: 100%;
    background: var(--cor2);
    position: absolute;
    top: 0px;
    left: 0px;
    border-radius: 0px 5px 5px 0px;
    animation: scale-up-hor-left 0.1s cubic-bezier(0.39, 0.575, 0.565, 1) both;
}

@keyframes scale-up-hor-left {
    0% {
        -webkit-transform: scaleX(0.4);
        transform: scaleX(0.4);
        -webkit-transform-origin: 0% 0%;
        transform-origin: 0% 0%;
    }
    100% {
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
        -webkit-transform-origin: 0% 0%;
        transform-origin: 0% 0%;
    }
}

.listItem:first-child {
    border-top-left-radius: 5px;
}

.listItem:last-child {
    border-top-right-radius: 5px;
}

.listItem:hover {
    background: #f8f9fa;
}

.listItem td {
    padding: 5px 15px;
    text-align: center;
    height: 100px;
    font-family: var(--raleway);
    font-size: 0.85rem;
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

td.qtde{
    text-align: center;
}

.listItem td img {
    border-radius: 5px;
    width: 60px;
    height: 90px;
    display: flex;
    align-self: center;
    justify-self: center;
    object-fit: cover;
}

.containerButtons {
    display: flex;
    width: fit-content !important;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease;
}

.listItem:hover .containerButtons {
    opacity: 1;
    pointer-events: auto;
}

.containerButtons button {
    width: 40px;
    height: 40px;
    background-color: var(--cor3);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.containerButtons button:hover {
    background-color: var(--cor2);
}

.containerButtons button svg {
    width: 20px;
    height: 20px;
}
</style>