<script>
import Menu from '@/components/admin/ComponentMenuAdmin.vue';
import Title from '@/components/admin/ComponentTitle.vue';
import CardAgd from '@/components/admin/ComponentCardAgd.vue';
import CardPedido from '@/components/admin/ComponentCardPedido.vue';
    export default{
        name:"AdminHome",
        components:{
            Menu,
            Title,
            CardAgd,
            CardPedido,
        }
    }
</script>

<template>
    <div class="containerAdmin">
        <Menu page="0"></Menu>
        <div class="painel">
            <Title text="Dados atuais"></Title>
            <div class="content">
                <div class="card" id="cardRevistas">
                    <div class="cardDataContainer">
                        <p class="cardData">80</p>
                        <h1 class="cardTitle">revistas</h1>
                    </div>
                    <svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>book-album</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-414.000000, -101.000000)" fill="#000000"> <path d="M418,101 C415.791,101 414,102.791 414,105 L414,126 C414,128.209 415.885,129.313 418,130 L429,133 L429,104 C423.988,102.656 418,101 418,101 L418,101 Z M442,101 C442,101 436.212,102.594 430.951,104 L431,104 L431,133 C436.617,131.501 442,130 442,130 C444.053,129.469 446,128.209 446,126 L446,105 C446,102.791 444.209,101 442,101 L442,101 Z" id="book-album" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                </div>
                <div class="card" id="cardUsers">
                    <div class="cardDataContainer">
                        <p class="cardData">100</p>
                        <h1 class="cardTitle">usuarios</h1>
                    </div>
                    <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z" fill="#000000"></path> <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000"></path> </g></svg>
                </div>
            </div>
            <Title text="agendamentos atuais"></Title>
            <div class="content">
                <CardAgd/>
                <!-- <CardPedido/> -->
            </div>
            <Title text="agendamentos vencidos"></Title>
            <div class="content">
                <CardAgd/>
            </div>
        </div>
    </div>
</template>

<style>
    /* DADOS ATUAIS - CARDS */
    .card{
        width: 200px;
        height: 100px;
        border-radius: 10px;
        padding:  10px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: row;
        position: relative;
    }

    .cardDataContainer{
        width: fit-content;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;
    }
    
    .card .cardData{
        font-size: 2.5rem;
        text-transform: uppercase;
        font-family: var(--roboto);
        font-weight: 900;
        color: var(--corFundoPrincipal);
    }
        
    .card .cardTitle{
        font-size: 1.5rem;
        text-transform: uppercase;
        font-family: var(--raleway);
        font-weight: 900;
    }

    .card svg{
        width: 50px;
        height: 50px;
    }

    #cardRevistas{
        background:#DC3545;
    }

    #cardRevistas .cardTitle{
        color: #B7192C;
    }

    #cardRevistas svg path{
        fill: #B7192C;;
    }

    #cardUsers{
        background:#28A745;
    }
    #cardUsers .cardTitle{
        color: #1F7634;
    }

    #cardUsers svg path{
        fill: #1F7634;;
    }



</style>