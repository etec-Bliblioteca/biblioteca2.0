<template>
  <!-- Parte externa criada para manter o corrocel dentro da tela -->
  <div class="carrocel">
    <!-- carrocel -->
    <div id="carrocelEventos">
      <!-- eventos -->
      <div class="evento" title="Item 1">Item 1</div>
      <div class="evento" title="Item 2">Item 2</div>
      <div class="evento" title="Item 3">Item 3</div>
      <div class="evento" title="Item 4">Item 4</div>
    </div>

    <!-- botões -->
    <button class="btnVoltar">❮</button>
    <button class="btnAvancar">❯</button>
  </div>
</template>

<script>
export default {
  name: "carrocelEventos",
  data() {
    return {};
  },
  methods: {
    criarCarrocel() {},
  },
  mounted() {
    // Criar eventos

    // array que armazena os eventos
    const ArrayEventos = [];

    // pega o local onde vão ficar cada evento no DOM
    const carrocelDOM = document.getElementById("carrocelEventos");

    // trocar por um props que vai receber a quantidade de eventos
    const quant = 4;

    // Class que cria os eventos
    const Evento = function (posi, id) {
      this.posi = posi;
      this.id = id;
    };

    // criar os eventos no javascript
    for (let i = 1; i <= quant; i++) {
      const evento = new Evento(i, i);

      ArrayEventos.push(evento);
    }

    // const evento1 = new Evento(1,1);

    // criar objetos no DOM
    ArrayEventos.map((el) => {
      const novoEvento = document.createElement("div");

      novoEvento.setAttribute("id", el.id);
      novoEvento.classList.add("evento");
      novoEvento.innerText = el.id;

      carrocelDOM.appendChild(novoEvento);
    });

    carrocelDOM.addEventListener('mouseup',()=>{
      console.log('foi')
    })

    // let isDragging = false;
    // let startPos = 0;
    // let currentTranslate = 0;
    // let prevTranslate = 0;
    // let animationID;
    // let currentIndex = 1;

    // // Clona para loop contínuo
    // const items = Array.from(carousel.children);
    // const firstClone = items[0].cloneNode(true);
    // const lastClone = items[items.length - 1].cloneNode(true);

    // firstClone.setAttribute("id", "first-clone");
    // lastClone.setAttribute("id", "last-clone");

    // carousel.appendChild(firstClone);
    // carousel.insertBefore(lastClone, items[0]);

    // const allItems = document.querySelectorAll(".carousel-item");

    // setPositionByIndex();

    // function getItemWidth() {
    //   const item = allItems[0];
    //   const style = getComputedStyle(carousel);
    //   const gap = parseInt(style.gap) || 0;
    //   return item.clientWidth + gap;
    // }

    // // ------------------ Toque e Arrasto ------------------
    // carousel.addEventListener("touchstart", touchStart);
    // carousel.addEventListener("touchend", touchEnd);
    // carousel.addEventListener("touchmove", touchMove);

    // carousel.addEventListener("mousedown", touchStart);
    // carousel.addEventListener("mouseup", touchEnd);
    // carousel.addEventListener("mousemove", touchMove);
    // carousel.addEventListener("mouseleave", touchEnd);

    // function touchStart(event) {
    //   isDragging = true;
    //   startPos = getPositionX(event);
    //   animationID = requestAnimationFrame(animation);
    // }

    // function touchMove(event) {
    //   if (!isDragging) return;
    //   const currentPosition = getPositionX(event);
    //   currentTranslate = prevTranslate + currentPosition - startPos;
    // }

    // function touchEnd() {
    //   cancelAnimationFrame(animationID);
    //   isDragging = false;

    //   const movedBy = currentTranslate - prevTranslate;
    //   const threshold = getItemWidth() / 4;

    //   if (movedBy < -threshold) {
    //     currentIndex += 1;
    //   }
    //   if (movedBy > threshold) {
    //     currentIndex -= 1;
    //   }

    //   setPositionByIndex();
    // }

    // function getPositionX(event) {
    //   return event.type.includes("mouse")
    //     ? event.pageX
    //     : event.touches[0].clientX;
    // }

    // function animation() {
    //   setCarouselPosition();
    //   if (isDragging) requestAnimationFrame(animation);
    // }

    // function setCarouselPosition() {
    //   carousel.style.transform = `translateX(${currentTranslate}px)`;
    // }

    // function setPositionByIndex() {
    //   const itemWidth = getItemWidth();
    //   currentTranslate = -itemWidth * currentIndex;
    //   prevTranslate = currentTranslate;
    //   setCarouselPosition();
    //   carousel.style.transition = "transform 0.3s";

    //   carousel.addEventListener("transitionend", checkIndex, { once: true });
    // }

    // function checkIndex() {
    //   carousel.style.transition = "none";
    //   const itemWidth = getItemWidth();

    //   if (allItems[currentIndex].id === "first-clone") {
    //     currentIndex = 1;
    //     currentTranslate = -itemWidth * currentIndex;
    //     prevTranslate = currentTranslate;
    //     setCarouselPosition();
    //   }
    //   if (allItems[currentIndex].id === "last-clone") {
    //     currentIndex = allItems.length - 2;
    //     currentTranslate = -itemWidth * currentIndex;
    //     prevTranslate = currentTranslate;
    //     setCarouselPosition();
    //   }
    // }

    // // ------------------ Botões ------------------
    // nextButton.addEventListener("click", () => {
    //   currentIndex++;
    //   setPositionByIndex();
    // });

    // prevButton.addEventListener("click", () => {
    //   currentIndex--;
    //   setPositionByIndex();
    // });
  },
};
</script>

<style>
/* Os eventos tem que ser separado porque o javascrip não usa o scoped fazendo com que os novos eventos criados não tenham o estilo */
.evento {
  border-radius: 20px;
  margin: 0 0px;
  min-width: 250px;
  height: 100%;
  max-height: 120px;
  background-color: rgb(0, 204, 255);
}
</style>

<style scoped>
/* Cnfiguração dos botões */
button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  transform: translateY(-50%);
}

.btnVoltar {
  left: 10px;
}

.btnAvancar {
  right: 10px;
}

/* Configuração do bloco que segura o carrocel */
.carrocel {
  margin-top: 15px;
  overflow: hidden;
  position: relative;
  max-width: 99vw;
  height: 100%;
}

/* carrocel */
#carrocelEventos {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;

  gap: 30px;

  width: 1000px;
  height: 100%;
}
</style>
