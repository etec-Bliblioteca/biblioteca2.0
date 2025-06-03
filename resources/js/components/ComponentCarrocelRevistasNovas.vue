<<<<<<< HEAD
<template>
    <div></div>
=======
<script>
export default {
    name: "carrocelRevistasNovas",
    data() {
        return {
            revistasTeste: [
                { id: 1, capa: "semImagem.jpg", rgb: "rgb(123, 45, 210)" },
                { id: 2, capa: "semImagem.jpg", rgb: "rgb(14, 178, 96)" },
                { id: 3, capa: "semImagem.jpg", rgb: "rgb(220, 12, 140)" },
                { id: 4, capa: "semImagem.jpg", rgb: "rgb(66, 90, 255)" },
                { id: 5, capa: "semImagem.jpg", rgb: "rgb(255, 189, 10)" },
                { id: 6, capa: "semImagem.jpg", rgb: "rgb(33, 33, 33)" },
                { id: 7, capa: "semImagem.jpg", rgb: "rgb(17, 220, 144)" },
                { id: 8, capa: "semImagem.jpg", rgb: "rgb(245, 10, 85)" },
                { id: 9, capa: "semImagem.jpg", rgb: "rgb(70, 150, 200)" },
                { id: 10, capa: "semImagem.jpg", rgb: "rgb(200, 100, 255)" },
            ],
            loop:null,
        };
    },
    props: {
        revistas: [(id) => Number, (capa) => String],
    },
    methods: {
        reset() {
            let items = [...document.querySelectorAll(".item")];

            items.map((item) => {
                item.style.display = "none";
                item.classList.remove("active");
            });
        },
        showItems(container) {
            this.reset();
            container.children[1].style.display = "flex";
            container.children[1].classList.add("active");

            // Next item
            let nextItem = container.children[2];
            nextItem.style.display = "flex";
            nextItem.classList.add("slide");
            // Prev item
            let prevItem = container.children[0];
            prevItem.style.display = "flex";
        },
        moveItem(container, nextIndex) {
            let firstItem = container.children[0];
            container.appendChild(firstItem);
            this.showItems(container, nextIndex);
        },
    },
    mounted() {
        let actualIndex = 1;
        let containerItems = document.getElementById("container");
        this.showItems(containerItems, actualIndex);
        this.loop = setInterval(() => {
            this.moveItem(containerItems, actualIndex);
        }, 2000);
    },
};
</script>

<template>
    <!-- <div id="container">
        <div
            class="item"
            v-for="(revista) in revistasTeste"
            :key="revista.id"
            :style="{ outlineColor: revista.rgb }"
        >
            <img :src="'../storage/images/' + revista.capa" />
        </div>
    </div> -->

    <div id="container">
        <div class="item" v-for="(revista) in revistasTeste" :key="revista.id">
            <img :src="'../storage/images/semImagem.jpg'"/>
        </div>
    </div>
>>>>>>> 0e4ff3a (Menu criado e ajustado)
</template>

<script>
    export default{
        name: 'carrocelRevistasNovas'
    }
</script>

<style scoped>
<<<<<<< HEAD
    div{
        margin-top: 10px;
        width: 100%;
        height: 100%;
        background-color: black;
    }
=======
#container {
    margin-top: 10px;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
    gap: 10px;
}

#container .item {
    width: 50px;
    height: 80px;
    border-radius: 5px;
    outline: 3px solid var(--cor2);
    overflow: hidden;
    transition: all 0.3s ease;
    display: none;
    transition: 0.3s;
}

#container .item.active {
    width: 100px !important;
    height: 160px !important;
    animation: scale-in-center 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}

.slide {
    animation: slide-in-fwd-right 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}

@-webkit-keyframes scale-in-center {
    0% {
        -webkit-transform: scale(0);
        transform: scale(0);
        opacity: 1;
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes scale-in-center {
    0% {
        -webkit-transform: scale(0);
        transform: scale(0);
        opacity: 1;
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes slide-in-fwd-right {
    0% {
        transform: translateZ(-1400px) translateX(10px);
        opacity: 0;
    }
    100% {
        transform: translateZ(0) translateX(0);
        opacity: 1;
    }
}

#container .item > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
>>>>>>> 0e4ff3a (Menu criado e ajustado)
</style>
