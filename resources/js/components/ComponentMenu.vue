<script>
import { Link } from "@inertiajs/vue3";
export default {
  name:"Menu",
  data(){
    return{
        userLog: true,
        userPage: false,
        linkLogoff: false,
    }
  },
  props: {
    active: Boolean,
    page: Number,
    user: Object
  },
  components: {
    Link
  },
  created(){
    if(this.user.id != null){
        this.userPage = true;
        this.userLog = false;
    }

    if(this.page == 4){
        this.linkLogoff = true;
        this.userPage = false;
    }
},
  mounted() {
    const links = [...document.querySelectorAll(".menuLink")];
    console.log(links)
    if (links[this.page]) {
      links[this.page].classList.add("active");
    }
  }
};
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
                <span class="linkText">Home</span>
            </Link>
            <Link class="menuLink" href="/catalogo">
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
                <span class="linkText"> Catálogo </span>
            </Link>
            <!-- LINK PARA LOGIN | USUARIO DESLOGADO -->
            <Link class="menuLink active linkBotton" href="/login" id="linkUser" v-if="userLog">
                <svg 
                    class="linkIcon"
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
                            d="M9.39646 2H14.6035C15.7056 1.99999 16.5944 1.99998 17.3138 2.05972C18.0547 2.12125 18.7049 2.25126 19.3049 2.56293C20.2181 3.03731 20.9627 3.78191 21.4371 4.69513C21.7487 5.29513 21.8788 5.94535 21.9403 6.68616C22 7.40557 22 8.29444 22 9.39649V14.6035C22 15.7056 22 16.5944 21.9403 17.3138C21.8788 18.0547 21.7487 18.7049 21.4371 19.3049C20.9627 20.2181 20.2181 20.9627 19.3049 21.4371C18.7049 21.7487 18.0547 21.8788 17.3138 21.9403C16.5944 22 15.7056 22 14.6035 22H9.39649C8.29444 22 7.40557 22 6.68616 21.9403C5.94535 21.8788 5.29513 21.7487 4.69513 21.4371C3.78191 20.9627 3.03731 20.2181 2.56293 19.3049C2.25126 18.7049 2.12125 18.0547 2.05972 17.3138C1.99998 16.5944 1.99999 15.7056 2 14.6035V9.39646C1.99999 8.29442 1.99998 7.40556 2.05972 6.68616C2.12125 5.94535 2.25126 5.29513 2.56293 4.69513C3.03731 3.78191 3.78191 3.03731 4.69513 2.56293C5.29513 2.25126 5.94535 2.12125 6.68616 2.05972C7.40556 1.99998 8.29442 1.99999 9.39646 2ZM6.85168 4.05286C6.23678 4.10393 5.88403 4.19909 5.61708 4.33776C5.06915 4.62239 4.62239 5.06915 4.33776 5.61708C4.19909 5.88403 4.10393 6.23678 4.05286 6.85168C4.0008 7.47856 4 8.28424 4 9.44V14.56C4 15.7158 4.0008 16.5214 4.05286 17.1483C4.10393 17.7632 4.19909 18.116 4.33776 18.3829C4.62239 18.9309 5.06915 19.3776 5.61708 19.6622C5.72641 19.719 5.85015 19.7685 6.00039 19.8107C6.02184 18.531 6.92753 17.5633 7.96833 16.9686C9.04997 16.3505 10.4775 16 12 16C13.5225 16 14.95 16.3505 16.0317 16.9686C17.0725 17.5633 17.9782 18.531 17.9996 19.8107C18.1499 19.7685 18.2736 19.719 18.3829 19.6622C18.9309 19.3776 19.3776 18.9309 19.6622 18.3829C19.8009 18.116 19.8961 17.7632 19.9471 17.1483C19.9992 16.5214 20 15.7158 20 14.56V9.44C20 8.28423 19.9992 7.47856 19.9471 6.85168C19.8961 6.23678 19.8009 5.88403 19.6622 5.61708C19.3776 5.06915 18.9309 4.62239 18.3829 4.33776C18.116 4.19909 17.7632 4.10393 17.1483 4.05286C16.5214 4.0008 15.7158 4 14.56 4H9.44C8.28423 4 7.47856 4.0008 6.85168 4.05286ZM16.0657 19.9929L16.0183 19.9336C16.0164 19.9356 16.0121 19.9404 16.0071 19.9482C15.9992 19.9605 15.9957 19.9707 15.9948 19.9737C15.9943 19.9755 15.9963 19.9694 15.9978 19.9507C15.9996 19.9296 16 19.9074 16 19.8571C16 19.5819 15.7957 19.1372 15.0394 18.7051C14.3114 18.2891 13.2389 18 12 18C10.7611 18 9.6886 18.2891 8.96061 18.7051C8.20432 19.1372 8 19.5819 8 19.8571C8 19.9074 8.0004 19.9296 8.00215 19.9507C8.00371 19.9694 8.00568 19.9755 8.00515 19.9737C8.00427 19.9707 8.00079 19.9605 7.9929 19.9482C7.9879 19.9404 7.9836 19.9356 7.98171 19.9336L7.93427 19.9929C8.36155 19.9998 8.8561 20 9.44 20H14.56C15.1439 20 15.6385 19.9998 16.0657 19.9929ZM12 9C10.8954 9 10 9.89543 10 11C10 12.1046 10.8954 13 12 13C13.1046 13 14 12.1046 14 11C14 9.89543 13.1046 9 12 9ZM8 11C8 8.79086 9.79086 7 12 7C14.2091 7 16 8.79086 16 11C16 13.2091 14.2091 15 12 15C9.79086 15 8 13.2091 8 11Z"
                            fill="#0F1729"
                        ></path>
                    </g>
                </svg>
                <span class="linkText"> Login </span>
            </Link>
            <!-- LINK PARA O PERFIL DO USUARIO | USUARIO LOGADO -->
            <Link class="menuLink linkBotton" href="/perfil" id="linkUser" v-if="userPage">
                <svg class="linkIcon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M16 9C16 11.2091 14.2091 13 12 13C9.79086 13 8 11.2091 8 9C8 6.79086 9.79086 5 12 5C14.2091 5 16 6.79086 16 9ZM14 9C14 10.1046 13.1046 11 12 11C10.8954 11 10 10.1046 10 9C10 7.89543 10.8954 7 12 7C13.1046 7 14 7.89543 14 9Z" fill="#000000"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1C5.92487 1 1 5.92487 1 12C1 18.0751 5.92487 23 12 23C18.0751 23 23 18.0751 23 12C23 5.92487 18.0751 1 12 1ZM3 12C3 14.0902 3.71255 16.014 4.90798 17.5417C6.55245 15.3889 9.14627 14 12.0645 14C14.9448 14 17.5092 15.3531 19.1565 17.4583C20.313 15.9443 21 14.0524 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12ZM12 21C9.84977 21 7.87565 20.2459 6.32767 18.9878C7.59352 17.1812 9.69106 16 12.0645 16C14.4084 16 16.4833 17.1521 17.7538 18.9209C16.1939 20.2191 14.1881 21 12 21Z" fill="#000000"></path> </g></svg>
                <span class="linkText"> Perfil </span>
            </Link>
            <!-- LINK PARA LOGOFF NA PÁGINA DO USUARIO -->
            <Link class="menuLink linkBotton" href="/logoff" v-if="linkLogoff">
                <svg class="linkIcon" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M2.293,11.293l4-4A1,1,0,1,1,7.707,8.707L5.414,11H17a1,1,0,0,1,0,2H5.414l2.293,2.293a1,1,0,1,1-1.414,1.414l-4-4a1,1,0,0,1,0-1.414ZM20,4V20a1,1,0,0,0,2,0V4a1,1,0,0,0-2,0Z"></path></g></svg>
                <span class="linkText"> Sair </span>
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
    animation: scale-in-hor-left 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
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

.containerLinks {
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

.menuLink .linkIcon path {
    fill: var(--cor1);
}

.menuLink .linkText {
    font-size: 1.3rem;
    text-transform: uppercase;
    font-family: var(--raleway);
    font-weight: bolder;
    color: var(--cor1);
}

.active {
    background: var(--cor1) !important;
}

.active .linkIcon path {
    fill: var(--cor3);
}

.active .linkText {
    color: var(--cor3);
}

.linkBotton {
    position: absolute;
    bottom: 20px;
}

</style>
