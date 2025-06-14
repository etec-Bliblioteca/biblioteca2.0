<script>
export default {
    name: "CardPedido",
};
</script>

<template>
    <div class="card">
        <img :src="'../storage/images/semImagem.jpg'" />
        <div class="cardContent">
            <div class="cardInfo">
                <h1>Nome do aluno</h1>
                <div class="cardData">
                    <div class="dataTitle">RM</div>
                    <span class="dataText">25036</span>
                </div>
                <div class="cardData">
                    <div class="dataTitle">turma</div>
                    <span class="dataText">1º Info Manhã</span>
                </div>
                <div class="cardData">
                    <div class="dataTitle">Pegar</div>
                    <span class="dataText">00/00/00</span>
                </div>
            </div>
            <div class="cardButtons">
                <button id="btnCheck">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM16.0303 8.96967C16.3232 9.26256 16.3232 9.73744 16.0303 10.0303L11.0303 15.0303C10.7374 15.3232 10.2626 15.3232 9.96967 15.0303L7.96967 13.0303C7.67678 12.7374 7.67678 12.2626 7.96967 11.9697C8.26256 11.6768 8.73744 11.6768 9.03033 11.9697L10.5 13.4393L12.7348 11.2045L14.9697 8.96967C15.2626 8.67678 15.7374 8.67678 16.0303 8.96967Z" fill="#1C274C"></path> </g></svg>
                </button>
                <button id="btnCancel">
                    <svg fill="#000000" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>cancel</title> <path d="M10.771 8.518c-1.144 0.215-2.83 2.171-2.086 2.915l4.573 4.571-4.573 4.571c-0.915 0.915 1.829 3.656 2.744 2.742l4.573-4.571 4.573 4.571c0.915 0.915 3.658-1.829 2.744-2.742l-4.573-4.571 4.573-4.571c0.915-0.915-1.829-3.656-2.744-2.742l-4.573 4.571-4.573-4.571c-0.173-0.171-0.394-0.223-0.657-0.173v0zM16 1c-8.285 0-15 6.716-15 15s6.715 15 15 15 15-6.716 15-15-6.715-15-15-15zM16 4.75c6.213 0 11.25 5.037 11.25 11.25s-5.037 11.25-11.25 11.25-11.25-5.037-11.25-11.25c0.001-6.213 5.037-11.25 11.25-11.25z"></path> </g></svg>
                </button>
                
            </div>
        </div>
    </div>
</template>

<style scoped>
.card {
    min-width: 300px;
    /* max-width: 350px; */
    height: 180px;
    width: fit-content;
    border-radius: 5px;
    outline: 2px solid var(--cor1);
    background: var(--cor3);
    display: flex;
    align-content: center;
    justify-content: space-between;
    padding: 10px;
    gap: 10px;
}

.card img {
    width: 30%;
    height: 100%;
    border-radius: 5px;
}

.cardContent {
    width: 100%;
    height: 100%;
    /* border: 1px solid red; */
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    gap: 10px;
}

.cardInfo {
    width: 100%;
    height: fit-content;
    /* border: 1px solid red; */
    display: flex;
    align-content: center;
    justify-content: flex-start;
    gap: 5px;
    flex-direction: column;
}

.cardInfo h1 {
    text-transform: uppercase;
    font-family: var(--raleway);
    font-weight: 900;
    font-size: 1.2rem;
    width: 100%;
    text-align: left;
}

.cardInfo .cardData {
    width: 100%;
    height: fit-content;
    display: flex;
    align-items: center;
    flex-direction: column;
    flex-direction: row;
    flex-wrap: nowrap;
    gap: 5px;
}

.cardInfo .dataTitle {
    width: fit-content;
    height: fit-content;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 15px;
    background: var(--cor2);
    color: var(--cor1);
}

.cardInfo .dataText {
    color: var(--cor1);
    font-size: 20px;
}

.cardButtons {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
}

.cardButtons button {
    width: fit-content;
    height: fit-content;
    padding: 5px 10px;
    border-radius: 5px;
    outline: 2px solid;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.cardButtons button svg {
    width: 20px;
    height: 20px;
}

.cardButtons button svg path {
    fill: var(--cor1);
    stroke: var(--cor1);  
}

#btnCheck{
    outline-color: #1F7634;
    background: #58D073;
}


#btnCancel{
    outline-color:#d91212;
    background: #ffc6c6;
}


</style>
