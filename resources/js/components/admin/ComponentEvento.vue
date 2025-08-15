<script>

export default {
    name:"Evento",
    props:{
        imagem:String,
    },
    emits:['deleteItem'],
}
</script>

<template>
    <div class="containerEvento">
        <img :src="`../storage/images/evento/${imagem}`" alt="">
        <div class="overlay">
            <button class="btnDelete" @click="$emit('deleteItem')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 6H5H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 11V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 11V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Excluir
            </button>
        </div>
    </div>
</template>

<style scoped>
.containerEvento {
    width: 350px;
    height: 150px;
    border-radius: 5px;
    outline: 1px solid var(--cor2);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.containerEvento img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: filter 0.3s ease;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.containerEvento:hover .overlay {
    opacity: 1;
}

.containerEvento:hover img {
    filter: grayscale(100%);
}

.btnDelete {
    background-color: var(--cor2);
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 500;
    transition: background-color 0.2s ease;
}

.btnDelete:hover {
    background-color: var(--cor2);
}

.btnDelete svg {
    width: 18px;
    height: 18px;
}
</style>