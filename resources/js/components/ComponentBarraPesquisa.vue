<template>
    <div id="corpo">
        <input type="text" placeholder="Revista..." />
        <button>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </button>
    </div>
</template>

<script>
export default {
    name: "barraPesquisa",
};
</script>

<style scoped>
button {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--cor2);
    border-radius:10px;
    width: 50px;
    height: 50px;
    position: absolute;
    right: 0px;
    outline: 2px solid var(--cor1);
}

button svg{
    width: 60%;
    height: 60%;
}

button svg path{
    stroke: var(--corFundoPrincipal);
}
input {
    height: 100%;
    width: 100%;
    padding: 0 10px 0 20px;
    outline: none;
    border: none;
    background-color: var(--cor3);
    border-radius: 10px 0px 0px 10px;
    width: 80%;
    text-transform: uppercase;
    font-family: var(--raleway);
    font-weight: 900;
    font-size: 1rem;
    outline: 2px solid var(--cor1);
    color: var(--cor1);
}

#corpo {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    position: relative;
    border-radius: 30px;
    margin-top: 30px;
    width: 300px;
    height: 45px;
}
</style>
