<template>
  <!-- Parte externa criada para manter o corrocel dentro da tela -->
  <div class="carrocel">
    <!-- carrocel -->
    <div
      id="carrocelEventos"
      @mousedown="startDrag"
      @mouseup="stopDrag"
      @mousemove="drag"
      @mouseleave="stopDrag"
    >
      <!-- eventos serão inseridos dinamicamente -->
    </div>

    <!-- botões -->
    <button class="btnVoltar" @click="mover(-1)">❮</button>
    <button class="btnAvancar" @click="mover(1)">❯</button>
  </div>
</template>

<script>
export default {
  name: "CarrocelEventos",
  props: {
    quantidadeEventos: {
      type: Number,
      default: 4
    }
  },
  data() {
    return {
      eventos: [],
      isDragging: false,
      startPosX: 0,
      currentTranslate: 0,
      prevTranslate: 0,
      currentIndex: 0,
      maxTranslate: 0,
      minTranslate: 0
    };
  },
  mounted() {
    this.inicializarCarrocel();
    this.calcularLimites();
    window.addEventListener('resize', this.calcularLimites);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.calcularLimites);
  },
  methods: {
    inicializarCarrocel() {
      // array que armazena os eventos
      this.eventos = [];

      // pega o local onde vão ficar cada evento no DOM
      const carrocelDOM = document.getElementById("carrocelEventos");

      // Class que cria os eventos
      const Evento = function(posi, id) {
        this.posi = posi;
        this.id = id;
      };

      // criar os eventos no javascript
      for (let i = 1; i <= this.quantidadeEventos; i++) {
        const evento = new Evento(i, i);
        this.eventos.push(evento);
      }

      // criar objetos no DOM
      this.eventos.forEach((el) => {
        const novoEvento = document.createElement("div");
        novoEvento.setAttribute("id", el.id);
        novoEvento.classList.add("evento");
        novoEvento.innerText = el.id;
        carrocelDOM.appendChild(novoEvento);
      });
    },

    calcularLimites() {
      const carrocelDOM = document.getElementById("carrocelEventos");
      const containerWidth = carrocelDOM.parentElement.clientWidth;
      const contentWidth = carrocelDOM.scrollWidth;

      // Limite esquerdo (quando arrasta para a direita)
      this.maxTranslate = 0;

      // Limite direito (quando arrasta para a esquerda)
      this.minTranslate = containerWidth - contentWidth;

      // Se o conteúdo for menor que o container, não permita arrastar
      if (contentWidth <= containerWidth) {
        this.maxTranslate = 0;
        this.minTranslate = 0;
      }
    },

    startDrag(e) {
      this.isDragging = true;
      this.startPosX = e.pageX;
      const carrocelDOM = document.getElementById("carrocelEventos");
      carrocelDOM.style.cursor = 'grabbing';
      carrocelDOM.style.transition = 'none';
    },

    drag(e) {
      if (!this.isDragging) return;

      const carrocelDOM = document.getElementById("carrocelEventos");
      const currentPosition = e.pageX;
      const moved = currentPosition - this.startPosX;
      let newTranslate = this.prevTranslate + moved;

      // Aplicar limites
      newTranslate = Math.min(this.maxTranslate, newTranslate); // Não passar do limite direito
      newTranslate = Math.max(this.minTranslate, newTranslate); // Não passar do limite esquerdo

      this.currentTranslate = newTranslate;
      carrocelDOM.style.transform = `translateX(${this.currentTranslate}px)`;
    },

    stopDrag() {
      this.isDragging = false;
      this.prevTranslate = this.currentTranslate;
      const carrocelDOM = document.getElementById("carrocelEventos");
      carrocelDOM.style.cursor = 'grab';
      carrocelDOM.style.transition = 'transform 0.3s ease';
    },

    mover(direction) {
      const carrocelDOM = document.getElementById("carrocelEventos");
      const itemWidth = 250 + 30; // width + gap

      this.currentIndex += direction;
      let newTranslate = -itemWidth * this.currentIndex;

      // Aplicar limites
      newTranslate = Math.min(this.maxTranslate, newTranslate);
      newTranslate = Math.max(this.minTranslate, newTranslate);

      this.currentTranslate = newTranslate;
      this.prevTranslate = this.currentTranslate;

      // Ajustar currentIndex se atingiu os limites
      if (this.currentTranslate >= this.maxTranslate) {
        this.currentIndex = 0;
      } else if (this.currentTranslate <= this.minTranslate) {
        this.currentIndex = this.quantidadeEventos - 1;
      }

      carrocelDOM.style.transform = `translateX(${this.currentTranslate}px)`;
      carrocelDOM.style.transition = 'transform 0.3s ease';
    }
  }
};
</script>

<style>
/* Os eventos tem que ser separado porque o javascrip não usa o scoped fazendo com que os novos eventos criados não tenham o estilo */
.evento {
  user-select: none;
  pointer-events: none;
  border-radius: 20px;
  margin: 0 0px;
  min-width: 250px;
  height: 100%;
  max-height: 120px;
  background-color: rgb(0, 204, 255);
  flex-shrink: 0;
}
</style>

<style scoped>
/* Configuração dos botões */
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

.btnVoltar {
  left: 10px;
}

.btnAvancar {
  right: 10px;
}

/* Configuração do bloco que segura o carrocel */
.carrocel {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 15px;
  overflow: hidden;
  position: relative;
  max-width: 99vw;
  height: 150px;
}

/* carrocel */
#carrocelEventos {
  display: flex;
  align-items: center;
  gap: 30px;
  height: 100%;
  cursor: grab;
  transition: transform 0.3s ease;
  will-change: transform; /* Melhora performance da animação */
}

#carrocelEventos:active {
  cursor: grabbing;
}
</style>
