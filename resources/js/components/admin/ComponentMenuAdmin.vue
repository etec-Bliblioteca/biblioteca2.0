<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';


let dropdownState = false;
const props = defineProps(['page']);
onMounted(()=>{
    const linkItems = [...document.querySelectorAll('.link')];
    linkItems[props.page].classList.add('active');
    if(props.page == 4 || props.page == 5 || props.page == 6 ){
        dropdownLink();
    };
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

const menuExpand = () =>{
    const menuBackground = document.getElementById("menuBackground");
    menuBackground.style.width = "100px";
}

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
            <div class="link link-dropdown" @click="dropdownLink()">
                <svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm4,11H13v3a1,1,0,0,1-2,0V13H8a1,1,0,0,1,0-2h3V8a1,1,0,0,1,2,0v3h3a1,1,0,0,1,0,2Z"></path></g></svg>
                <span class="linkText">
                    Adicionar
                </span>
                <svg id="dropdownIcon" style="transition: 0.3s;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.70711 9.71069C5.31658 10.1012 5.31658 10.7344 5.70711 11.1249L10.5993 16.0123C11.3805 16.7927 12.6463 16.7924 13.4271 16.0117L18.3174 11.1213C18.708 10.7308 18.708 10.0976 18.3174 9.70708C17.9269 9.31655 17.2937 9.31655 16.9032 9.70708L12.7176 13.8927C12.3271 14.2833 11.6939 14.2832 11.3034 13.8927L7.12132 9.71069C6.7308 9.32016 6.09763 9.32016 5.70711 9.71069Z" fill="#0F0F0F"></path> </g></svg>
            </div>
            <div class="dropdown-container" id="dropdown-container">
                <Link class="link" href="/add/revista">
                    <svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>book-album</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-414.000000, -101.000000)" fill="#000000"> <path d="M418,101 C415.791,101 414,102.791 414,105 L414,126 C414,128.209 415.885,129.313 418,130 L429,133 L429,104 C423.988,102.656 418,101 418,101 L418,101 Z M442,101 C442,101 436.212,102.594 430.951,104 L431,104 L431,133 C436.617,131.501 442,130 442,130 C444.053,129.469 446,128.209 446,126 L446,105 C446,102.791 444.209,101 442,101 L442,101 Z" id="book-album" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                    <span class="linkText">
                        revista
                    </span>
                </Link>
                <Link class="link" href="/add/evento">
                    <svg fill="#000000" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g data-name="Layer 34" id="Layer_34"> <path d="M29.92,21.62A1,1,0,0,0,29,21H23a2,2,0,0,0-2,2v6a1,1,0,0,0,.62.92A.84.84,0,0,0,22,30a1,1,0,0,0,.71-.29l7-7A1,1,0,0,0,29.92,21.62Z"></path> <path d="M22,30H7a5,5,0,0,1-5-5V10.92a1,1,0,0,1,1-1H29a1,1,0,0,1,1,1V22a1,1,0,0,1-.29.71l-7,7A1,1,0,0,1,22,30ZM4,11.92V25a3,3,0,0,0,3,3H21.59L28,21.59V11.92Z"></path> <path d="M25,2H7A5,5,0,0,0,2,7v3.92a1,1,0,0,0,1,1H29a1,1,0,0,0,1-1V7A5,5,0,0,0,25,2ZM9,9a2,2,0,1,1,2-2A2,2,0,0,1,9,9ZM23,9a2,2,0,1,1,2-2A2,2,0,0,1,23,9Z"></path> <path d="M12.81,25.19c-7.75,0-8.81-6-8.81-8.06L3.21,25A3.86,3.86,0,0,0,7,29H21V25S14.87,25.19,12.81,25.19Z"></path> </g> </g></svg>
                    <span class="linkText">
                        Evento
                    </span>
                </Link>
                <Link class="link" href="/add/admin">
                    <svg fill="#000000" height="200px" width="200px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="user-admin"> <path d="M22.3,16.7l1.4-1.4L20,11.6l-5.8,5.8c-0.5-0.3-1.1-0.4-1.7-0.4C10.6,17,9,18.6,9,20.5s1.6,3.5,3.5,3.5s3.5-1.6,3.5-3.5 c0-0.6-0.2-1.2-0.4-1.7l1.9-1.9l2.3,2.3l1.4-1.4l-2.3-2.3l1.1-1.1L22.3,16.7z M12.5,22c-0.8,0-1.5-0.7-1.5-1.5s0.7-1.5,1.5-1.5 s1.5,0.7,1.5,1.5S13.3,22,12.5,22z"></path> <path d="M2,19c0-3.9,3.1-7,7-7c2,0,3.9,0.9,5.3,2.4l1.5-1.3c-0.9-1-1.9-1.8-3.1-2.3C14.1,9.7,15,7.9,15,6c0-3.3-2.7-6-6-6 S3,2.7,3,6c0,1.9,0.9,3.7,2.4,4.8C2.2,12.2,0,15.3,0,19v5h8v-2H2V19z M5,6c0-2.2,1.8-4,4-4s4,1.8,4,4s-1.8,4-4,4S5,8.2,5,6z"></path> </g> </g></svg>
                    <span class="linkText">
                        Admin
                    </span>
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .menuBackground{
        width: 220px;
        height: calc(100% - 10px);
        background: var(--cor2);
        border-radius: 10px;
        padding: 0px 10px;
        grid-area: "Menu";
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
        background: var(--cor1) !important;
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