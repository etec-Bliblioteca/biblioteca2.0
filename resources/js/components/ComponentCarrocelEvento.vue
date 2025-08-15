<template>
    <div class="carrossel-container">
        <div class="carrossel-wrapper">
            <div
                class="carrossel"
                ref="carrossel"
                @mousedown="startDrag"
                @mouseup="stopDrag"
                @mousemove="drag"
                @mouseleave="stopDrag"
                @touchstart="startTouch"
                @touchmove="touchMove"
                @touchend="endTouch"
            >
                <div v-for="evento in eventos" :key="evento.id" class="evento">
                    <img :src="`../storage/images/evento/${evento.imagem}`" />
                </div>
            </div>
        </div>

        <button class="btn-voltar" @click="mover(-1)">❮</button>
        <button class="btn-avancar" @click="mover(1)">❯</button>
    </div>
</template>

<script>
export default {
    name: "CarrosselEventos",
    props: {
        // puxar os eventos por aqui
        quantidadeEventos: {
            type: Number,
            default: 5,
        },
        collectionEventos: Object,
    },
    data() {
        return {
            // armazena os eventos já como objetos para serem rederizados
            eventos: [],
            //   identifica se está sendo precionada a tela
            isDragging: false,

            startPosX: 0,
            currentTranslate: 0,
            prevTranslate: 0,
            currentIndex: 0,
            animationId: null,
            itemWidth: 280, // 250px (item) + 30px (gap)
        };
    },
    created() {
        // Inicializa os eventos
        for (let i = 0; i < this.collectionEventos.length; i++) {
            this.eventos.push(this.collectionEventos[i]);
        }

        console.log(this.collectionEventos);
    },
    mounted() {
        this.calcularLimites();
        window.addEventListener("resize", this.calcularLimites);
    },
    beforeDestroy() {
        window.removeEventListener("resize", this.calcularLimites);
        cancelAnimationFrame(this.animationId);
    },
    methods: {
        calcularLimites() {
            const containerWidth = this.$el.clientWidth;
            const contentWidth = this.eventos.length * this.itemWidth;

            // Se o conteúdo for menor que o container, centraliza
            if (contentWidth <= containerWidth) {
                this.currentTranslate = (containerWidth - contentWidth) / 2;
                this.setTransform();
            }
        },

        setTransform() {
            this.$refs.carrossel.style.transform = `translateX(${this.currentTranslate}px)`;
        },

        startDrag(e) {
            this.isDragging = true;
            this.startPosX = e.type.includes("touch")
                ? e.touches[0].clientX
                : e.clientX;
            this.$refs.carrossel.style.transition = "none";
            this.$refs.carrossel.style.cursor = "grabbing";
        },

        drag(e) {
            if (!this.isDragging) return;

            const currentX = e.type.includes("touch")
                ? e.touches[0].clientX
                : e.clientX;
            const moved = currentX - this.startPosX;
            this.currentTranslate = this.prevTranslate + moved;

            this.setTransform();
        },

        stopDrag() {
            if (!this.isDragging) return;

            this.isDragging = false;
            this.prevTranslate = this.currentTranslate;
            this.$refs.carrossel.style.transition = "transform 0.3s ease";
            this.$refs.carrossel.style.cursor = "grab";

            // Ajusta a posição se necessário
            this.ajustarPosicao();
        },

        ajustarPosicao() {
            const containerWidth = this.$el.clientWidth;
            const contentWidth = this.eventos.length * this.itemWidth;

            // Limites do carrossel
            const maxTranslate = 0;
            const minTranslate = containerWidth - contentWidth;

            // Se o conteúdo for menor que o container, centraliza
            if (contentWidth <= containerWidth) {
                this.currentTranslate = (containerWidth - contentWidth) / 2;
                this.setTransform();
                return;
            }

            // Ajusta para os limites
            this.currentTranslate = Math.max(
                minTranslate,
                Math.min(this.currentTranslate, maxTranslate)
            );
            this.prevTranslate = this.currentTranslate;

            // Atualiza o índice atual
            this.currentIndex = Math.abs(
                Math.round(this.currentTranslate / this.itemWidth)
            );

            this.setTransform();
        },

        mover(direction) {
            const containerWidth = this.$el.clientWidth;
            const visibleItems = Math.floor(containerWidth / this.itemWidth);
            const maxIndex = Math.max(0, this.eventos.length - visibleItems);

            this.currentIndex = Math.max(
                0,
                Math.min(this.currentIndex + direction, maxIndex)
            );
            this.currentTranslate = -this.currentIndex * this.itemWidth;
            this.prevTranslate = this.currentTranslate;

            this.$refs.carrossel.style.transition = "transform 0.3s ease";
            this.setTransform();
        },

        // Métodos para touch (usam os mesmos métodos com verificações de touch)
        startTouch(e) {
            this.startDrag(e);
        },

        touchMove(e) {
            this.drag(e);
        },

        endTouch() {
            this.stopDrag();
        },
    },
};
</script>

<style scoped>
.carrossel-container {
    position: relative;
    width: 100%;
    max-width: 99vw;
    height: 150px;
    margin-top: 15px;
    overflow: hidden;
}

.carrossel-wrapper {
    width: 100%;
    height: 100%;
}

.carrossel {
    display: flex;
    align-items: center;
    margin-left: 54px;
    gap: 30px;
    height: 100%;
    cursor: grab;
    will-change: transform;
    padding: 0 20px;
}

.carrossel:active {
    cursor: grabbing;
}

.evento {
    user-select: none;
    pointer-events: none;
    border-radius: 20px;
    min-width: 250px;
    height: 100%;
    max-height: 120px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    font-weight: bold;
}

.evento img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
}

button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 1.2rem;
    z-index: 10;
}

button:hover {
    background: rgba(0, 0, 0, 0.8);
}

.btn-voltar {
    left: 10px;
}

.btn-avancar {
    right: 10px;
}
</style>
