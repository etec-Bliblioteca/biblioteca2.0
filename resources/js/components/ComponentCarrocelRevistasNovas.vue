<script>
export default {
    name: "carrocelRevistasNovas",
    data() {
        return {
            
        }
    },
    props: {
        Revistas: Object,
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
        }, 3000);
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
        <div class="item" v-for="(revista,index) in Revistas" :key="index">
            <img :src="`../storage/images/${revista.imagem}`"/>
        </div>
    </div>
</template>

<style scoped>
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
    /* animation: scale-in-center 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both; */
}

/* .slide {
    animation: slide-in-fwd-right 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
} */

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
</style>
