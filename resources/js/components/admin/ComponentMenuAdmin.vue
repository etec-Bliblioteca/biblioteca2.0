<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';


let dropdownState = false;
const props = defineProps(['page']);
onMounted(()=>{
    const linkItems = [...document.querySelectorAll('.link')];
    linkItems[props.page].classList.add('active');
});

const dropdownLink = () =>{
    dropdownState = !dropdownState;
    const dropdownIcon = document.getElementById('dropdownIcon');
    const dropdownContainer = document.getElementById('dropdown-container'); 
    if(dropdownState){
        dropdownIcon.style.transform = "rotate(180deg)";
        dropdownContainer.style.height = "fit-content";
    }else{
        dropdownIcon.style.transform = "rotate(360deg)";
        dropdownContainer.style.height = "0px";
    }
}

const dropdownLinkEdit = () =>{
    dropdownState = !dropdownState;
    const dropdownIcon = document.getElementById('dropdownEditIcon');
    const dropdownContainer = document.getElementById('dropdown-container-edit'); 
    if(dropdownState){
        dropdownIcon.style.transform = "rotate(180deg)";
        dropdownContainer.style.height = "fit-content";
    }else{
        dropdownIcon.style.transform = "rotate(360deg)";
        dropdownContainer.style.height = "0px";
    }
}

// const menuExpand = () =>{
//     const menuBackground = document.getElementById("menuBackground");
//     menuBackground.style.width = "100px";
// }

</script>

<template>
    <div class="menuBackground" id="menuBackground">
        <div class="menuIcon" @click="menuExpand">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 8h-9m9 4H4m0 0 3-3m-3 3 3 3m13 1h-9"></path></g></svg>
        </div>
        <div class="separator"></div>
        <div class="containerLinks">
            <Link class="link" href="/admin/home">
                <svg viewBox="-1 0 19 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>home [#1393]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-341.000000, -720.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M299.875,576.21213 C299.875,576.76413 299.399,577.00013 298.8125,577.00013 L297.75,577.00013 C297.1635,577.00013 296.6875,576.76413 296.6875,576.21213 L296.6875,575.21213 C296.6875,574.10713 295.736562,573.00013 294.5625,573.00013 L292.4375,573.00013 C291.263438,573.00013 290.3125,574.10713 290.3125,575.21213 L290.3125,576.21213 C290.3125,576.76413 289.8365,577.00013 289.25,577.00013 L288.1875,577.00013 C287.601,577.00013 287.125,576.76413 287.125,576.21213 L287.125,568.14913 C287.125,568.01613 287.181312,567.88913 287.280125,567.79513 L292.738188,562.65913 C293.153625,562.26813 293.826188,562.26813 294.240563,562.65913 L299.719875,567.81513 C299.818688,567.90913 299.875,568.03613 299.875,568.16813 L299.875,576.21213 Z M302,567.62513 C302,567.36013 301.888438,567.10713 301.690812,566.91913 L294.998125,560.58913 C294.169375,559.80613 292.823188,559.80313 291.99125,560.58313 L285.312375,566.84813 C285.112625,567.03613 285,567.29013 285,567.55613 L285,577.21213 C285,578.31713 285.950938,579.00013 287.125,579.00013 L290.3125,579.00013 C291.486562,579.00013 292.4375,578.31713 292.4375,577.21213 L292.4375,576.21213 C292.4375,575.66013 292.9135,575.21213 293.5,575.21213 C294.0865,575.21213 294.5625,575.66013 294.5625,576.21213 L294.5625,577.21213 C294.5625,578.31713 295.513438,579.00013 296.6875,579.00013 L299.875,579.00013 C301.049062,579.00013 302,578.31713 302,577.21213 L302,567.62513 Z" id="home-[#1393]"> </path> </g> </g> </g> </g></svg>
                <span class="linkText">
                    Início
                </span>
            </Link>
            <Link class="link" href="/admin/liberacao">
                <svg viewBox="-4 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Lager_46" data-name="Lager 46" transform="translate(-4)"> <g id="Group_17" data-name="Group 17"> <path id="Path_54" data-name="Path 54" d="M26,12H24V7h-.07A8.18,8.18,0,0,0,8.094,5.537,1.894,1.894,0,0,0,9.925,8h.25a1.975,1.975,0,0,0,1.838-1.348A4.132,4.132,0,0,1,20,8v4H6a2,2,0,0,0-2,2V30a2,2,0,0,0,2,2H26a2,2,0,0,0,2-2V14A2,2,0,0,0,26,12ZM24,27a1,1,0,0,1-1,1H9a1,1,0,0,1-1-1V17a1,1,0,0,1,1-1H23a1,1,0,0,1,1,1Z" fill="#040505"></path></g> </g> </g></svg>
                <span class="linkText">
                    Liberação
                </span>
            </Link>
            <Link class="link" href="/admin/pedidos">
                <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>assignment-priority-solid</title> <g id="Layer_2" data-name="Layer 2"> <g id="invisible_box" data-name="invisible box"> <rect width="48" height="48" fill="none"></rect> <rect width="48" height="48" fill="none"></rect> </g> <g id="icons_Q2" data-name="icons Q2"> <path d="M40,6H36V4a2,2,0,0,0-2-2H14a2,2,0,0,0-2,2V6H8A2,2,0,0,0,6,8V44a2,2,0,0,0,2,2H40a2,2,0,0,0,2-2V8A2,2,0,0,0,40,6ZM24,38a2,2,0,1,1,2-2A2,2,0,0,1,24,38Zm2-10a2,2,0,0,1-4,0V16a2,2,0,0,1,4,0Z"></path> </g> </g> </g></svg>
                <span class="linkText">
                    pedidos
                </span>
            </Link>
            <Link class="link" href="/admin/revistas">
                <svg
                    class="linkIcon"
                    viewBox="0 -0.5 20 20"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    fill="#000000"
                >
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g
                        id="SVGRepo_tracerCarrier"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>book [#1207]</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g
                            id="Page-1"
                            stroke="none"
                            stroke-width="1"
                            fill="none"
                            fill-rule="evenodd"
                        >
                            <g
                                id="Dribbble-Light-Preview"
                                transform="translate(-260.000000, -2759.000000)"
                                fill="#000000"
                            >
                                <g
                                    id="icons"
                                    transform="translate(56.000000, 160.000000)"
                                >
                                    <path
                                        d="M222,2612.40709 C222,2612.84565 221.729,2613.23594 221.324,2613.3787 L215,2615.60539 L215,2603.71501 L215,2603.53322 L220.676,2601.53454 C221.325,2601.3055 222,2601.80055 222,2602.50615 L222,2612.40709 Z M213,2603.71501 L213,2615.60539 L206.676,2613.3787 C206.271,2613.23594 206,2612.84565 206,2612.40709 L206,2602.50615 C206,2601.80055 206.675,2601.3055 207.324,2601.53454 L213,2603.53322 L213,2603.71501 Z M221.337,2599.11785 L214.331,2601.64444 C214.117,2601.72147 213.883,2601.72147 213.669,2601.64444 L206.663,2599.11785 C205.362,2598.64847 204,2599.6396 204,2601.05592 L204,2613.11577 C204,2613.997 204.547,2614.78065 205.36,2615.06207 L213.68,2617.94608 C213.888,2618.01797 214.112,2618.01797 214.32,2617.94608 L222.64,2615.06207 C223.453,2614.78065 224,2613.997 224,2613.11577 L224,2601.05592 C224,2599.6396 222.638,2598.64847 221.337,2599.11785 L221.337,2599.11785 Z"
                                        id="book-[#1207]"
                                    ></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
                <span class="linkText">
                    Revistas
                </span>
            </Link>
            <Link class="link" href="/admin/users">
                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z" fill="#000000"></path> <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000"></path> </g></svg>
                <span class="linkText">
                    Usuários
                </span>
            </Link>
        </div>
    </div>
</template>

<style scoped>
    .menuBackground {
    grid-area: Menu;
    position: sticky;
    top: 10px;
    height: calc(100vh - 20px); /* considera o padding do container */
    background: var(--cor3);
    border-radius: 10px;
    padding: 0px 10px;
    z-index: 10;
    }

    .menuIcon{
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .menuIcon svg{
        width: 100%;
        height: 100%;
    }

    .menuIcon svg path{
        stroke: var(--cor1);
        fill: var(--cor1);
    }

    .separator{
        width: 100%;
        height: 3px;
        border-radius: 5px;
        background: var(--cor1);
        margin: 10px 0px;
    }

    .containerLinks{
        width: 100%;
        height: fit-content;
        overflow: hidden;
        display: flex;
        align-content: center;
        justify-content: center;
        flex-direction: column;
        gap: 10px;
    }

    .link{
        width: calc(100% - 25px);
        height: 25px;
        background: none;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 10px;
        gap: 10px;
        text-decoration: none;
        
    
    }

    .link svg{
        width: 25px;
        height: 25px;
        display: block;
    }

    .link svg path{
        fill: #314b58;
    }

    .linkText{
        font-size: 1.2rem;
        font-family: var(--raleway);
        text-transform: uppercase;
        font-weight: bolder;
        color: #314b58;
    
    }

    .active{
        background: var(--cor2) !important;
    }

    .active > svg path{
        fill: var(--cor3) !important;
    }

    .active > .linkText{
        color: var(--cor3) !important;
    }

    .dropdown-container{
        width: calc(100% - 30px);
        height: 0px;
        margin-top: -10px;
        margin-left: 20px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 5px;
        transition: 0.3s;
    }

    @keyframes scale-in-ver-top {
    0% {
        -webkit-transform: scaleY(0);
                transform: scaleY(0);
        -webkit-transform-origin: 100% 0%;
                transform-origin: 100% 0%;
        opacity: 1;
    }
    100% {
        -webkit-transform: scaleY(1);
                transform: scaleY(1);
        -webkit-transform-origin: 100% 0%;
                transform-origin: 100% 0%;
        opacity: 1;
    }
    }

    .dropdown-container .link svg{
        width: 20px;
        height: 20px;
    }

    .dropdown-container .link .linkText{
        font-size: 1rem;
    }
</style>