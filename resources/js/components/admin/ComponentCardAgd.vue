<script>
export default {
    name: "CardAgd",
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
                    <div class="dataTitle">Devolver</div>
                    <span class="dataText">00/00/00</span>
                </div>
            </div>
            <div class="cardButtons">
                <button id="btnCheck">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM16.0303 8.96967C16.3232 9.26256 16.3232 9.73744 16.0303 10.0303L11.0303 15.0303C10.7374 15.3232 10.2626 15.3232 9.96967 15.0303L7.96967 13.0303C7.67678 12.7374 7.67678 12.2626 7.96967 11.9697C8.26256 11.6768 8.73744 11.6768 9.03033 11.9697L10.5 13.4393L12.7348 11.2045L14.9697 8.96967C15.2626 8.67678 15.7374 8.67678 16.0303 8.96967Z" fill="#1C274C"></path> </g></svg>
                </button>
                <button id="btnAdd">
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
                                d="M11 8C11 7.44772 11.4477 7 12 7C12.5523 7 13 7.44771 13 8V11H16C16.5523 11 17 11.4477 17 12C17 12.5523 16.5523 13 16 13H13V16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16V13H8C7.44772 13 7 12.5523 7 12C7 11.4477 7.44771 11 8 11H11V8Z"
                                fill="#0F0F0F"
                            ></path>
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M23 4C23 2.34315 21.6569 1 20 1H4C2.34315 1 1 2.34315 1 4V20C1 21.6569 2.34315 23 4 23H20C21.6569 23 23 21.6569 23 20V4ZM21 4C21 3.44772 20.5523 3 20 3H4C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21H20C20.5523 21 21 20.5523 21 20V4Z"
                                fill="#0F0F0F"
                            ></path>
                        </g>
                    </svg>
                </button>
                <button id="btnCall">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"></path> </g></svg>
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

#btnAdd{
    outline-color: #BA9E14;
    background: #EEEE56;
}

#btnCall{
    outline-color: #166534;
    background: #BBF7D0;
}



</style>
