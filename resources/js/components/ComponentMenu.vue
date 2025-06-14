<!-- SEM O SETUP NÃO ESTAVA FUNCIONANDO-->
<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted } from 'vue';
const props = defineProps(['active','page']);


onMounted(()=>{
// Inico = 0, catalogo = 1;
const links = [...document.querySelectorAll('.menuLink')];
links[props.page].classList.add('active');
})


</script>

<template>
    <div class="menuBackground" v-show="active">
        <div class="containerLinks">
            <Link class="menuLink" href="/">
                <svg
                    class="linkIcon"
                    viewBox="-1 0 19 19"
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
                        <title>home [#1393]</title>
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
                                transform="translate(-341.000000, -720.000000)"
                                fill="#000000"
                            >
                                <g
                                    id="icons"
                                    transform="translate(56.000000, 160.000000)"
                                >
                                    <path
                                        d="M299.875,576.21213 C299.875,576.76413 299.399,577.00013 298.8125,577.00013 L297.75,577.00013 C297.1635,577.00013 296.6875,576.76413 296.6875,576.21213 L296.6875,575.21213 C296.6875,574.10713 295.736562,573.00013 294.5625,573.00013 L292.4375,573.00013 C291.263438,573.00013 290.3125,574.10713 290.3125,575.21213 L290.3125,576.21213 C290.3125,576.76413 289.8365,577.00013 289.25,577.00013 L288.1875,577.00013 C287.601,577.00013 287.125,576.76413 287.125,576.21213 L287.125,568.14913 C287.125,568.01613 287.181312,567.88913 287.280125,567.79513 L292.738188,562.65913 C293.153625,562.26813 293.826188,562.26813 294.240563,562.65913 L299.719875,567.81513 C299.818688,567.90913 299.875,568.03613 299.875,568.16813 L299.875,576.21213 Z M302,567.62513 C302,567.36013 301.888438,567.10713 301.690812,566.91913 L294.998125,560.58913 C294.169375,559.80613 292.823188,559.80313 291.99125,560.58313 L285.312375,566.84813 C285.112625,567.03613 285,567.29013 285,567.55613 L285,577.21213 C285,578.31713 285.950938,579.00013 287.125,579.00013 L290.3125,579.00013 C291.486562,579.00013 292.4375,578.31713 292.4375,577.21213 L292.4375,576.21213 C292.4375,575.66013 292.9135,575.21213 293.5,575.21213 C294.0865,575.21213 294.5625,575.66013 294.5625,576.21213 L294.5625,577.21213 C294.5625,578.31713 295.513438,579.00013 296.6875,579.00013 L299.875,579.00013 C301.049062,579.00013 302,578.31713 302,577.21213 L302,567.62513 Z"
                                        id="home-[#1393]"
                                    ></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
                <span class="linkText"> Home </span>
            </Link>
            <Link class="menuLink" href="/catalogo">
                <svg class="linkIcon" viewBox="0 -0.5 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>book [#1207]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-260.000000, -2759.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M222,2612.40709 C222,2612.84565 221.729,2613.23594 221.324,2613.3787 L215,2615.60539 L215,2603.71501 L215,2603.53322 L220.676,2601.53454 C221.325,2601.3055 222,2601.80055 222,2602.50615 L222,2612.40709 Z M213,2603.71501 L213,2615.60539 L206.676,2613.3787 C206.271,2613.23594 206,2612.84565 206,2612.40709 L206,2602.50615 C206,2601.80055 206.675,2601.3055 207.324,2601.53454 L213,2603.53322 L213,2603.71501 Z M221.337,2599.11785 L214.331,2601.64444 C214.117,2601.72147 213.883,2601.72147 213.669,2601.64444 L206.663,2599.11785 C205.362,2598.64847 204,2599.6396 204,2601.05592 L204,2613.11577 C204,2613.997 204.547,2614.78065 205.36,2615.06207 L213.68,2617.94608 C213.888,2618.01797 214.112,2618.01797 214.32,2617.94608 L222.64,2615.06207 C223.453,2614.78065 224,2613.997 224,2613.11577 L224,2601.05592 C224,2599.6396 222.638,2598.64847 221.337,2599.11785 L221.337,2599.11785 Z" id="book-[#1207]"> </path> </g> </g> </g> </g></svg>
                <span class="linkText"> Catálogo </span>
            </Link>
        </div>
    </div>
</template>

<style scoped>

.menuBackground {
    width: 70%;
    height: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 100;
    background: var(--cor3);
    border-radius: 0px 20px 20px 0px;
    display: flex;
    justify-content: center;
    backdrop-filter: brightness(50%);
    animation: scale-in-hor-left 0.2s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}

@keyframes scale-in-hor-left {
  0% {
    -webkit-transform: scaleX(0);
            transform: scaleX(0);
    -webkit-transform-origin: 0% 0%;
            transform-origin: 0% 0%;
    opacity: 1;
  }
  100% {
    -webkit-transform: scaleX(1);
            transform: scaleX(1);
    -webkit-transform-origin: 0% 0%;
            transform-origin: 0% 0%;
    opacity: 1;
  }
}



.containerLinks{
    width: 100%;
    height: fit-content;
    margin-top: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 5px;
}

.menuLink {
    width: 80%;
    height: 30px;
    background: none;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0px 10px;
    gap: 5px;
    border-radius: 5px;
    text-decoration: none;
}

.menuLink .linkIcon {
    width: 20px;
    height: 20px;
}

.menuLink .linkIcon path{
    fill: var(--cor1);
}

.menuLink .linkText {
    font-size: 1.3rem;
    text-transform: uppercase;
    font-family: var(--raleway);
    font-weight: bolder;
    color: var(--cor1);
}

.active{
    background: var(--cor1) !important;
}

.active .linkIcon path{
    fill: var(--cor3);
}

.active .linkText {
    color: var(--cor3);
}


</style>
