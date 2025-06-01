<template>
  <div class="carousel-container">
    <div class="carousel">
      <div class="carousel-item" title="Item 1">Item 1</div>
      <div class="carousel-item" title="Item 2">Item 2</div>
      <div class="carousel-item" title="Item 3">Item 3</div>
      <div class="carousel-item" title="Item 4">Item 4</div>
    </div>

    <button class="nav-button prev">❮</button>
    <button class="nav-button next">❯</button>
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
    const carousel = document.querySelector(".carousel");
    const container = document.querySelector(".carousel-container");
    const nextButton = document.querySelector(".next");
    const prevButton = document.querySelector(".prev");

    let isDragging = false;
    let startPos = 0;
    let currentTranslate = 0;
    let prevTranslate = 0;
    let animationID;
    let currentIndex = 1;

    // Clona para loop contínuo
    const items = Array.from(carousel.children);
    const firstClone = items[0].cloneNode(true);
    const lastClone = items[items.length - 1].cloneNode(true);

    firstClone.setAttribute("id", "first-clone");
    lastClone.setAttribute("id", "last-clone");

    carousel.appendChild(firstClone);
    carousel.insertBefore(lastClone, items[0]);

    const allItems = document.querySelectorAll(".carousel-item");

    setPositionByIndex();

    function getItemWidth() {
      const item = allItems[0];
      const style = getComputedStyle(carousel);
      const gap = parseInt(style.gap) || 0;
      return item.clientWidth + gap;
    }

    // ------------------ Toque e Arrasto ------------------
    carousel.addEventListener("touchstart", touchStart);
    carousel.addEventListener("touchend", touchEnd);
    carousel.addEventListener("touchmove", touchMove);

    carousel.addEventListener("mousedown", touchStart);
    carousel.addEventListener("mouseup", touchEnd);
    carousel.addEventListener("mousemove", touchMove);
    carousel.addEventListener("mouseleave", touchEnd);

    function touchStart(event) {
      isDragging = true;
      startPos = getPositionX(event);
      animationID = requestAnimationFrame(animation);
    }

    function touchMove(event) {
      if (!isDragging) return;
      const currentPosition = getPositionX(event);
      currentTranslate = prevTranslate + currentPosition - startPos;
    }

    function touchEnd() {
      cancelAnimationFrame(animationID);
      isDragging = false;

      const movedBy = currentTranslate - prevTranslate;
      const threshold = getItemWidth() / 4;

      if (movedBy < -threshold) {
        currentIndex += 1;
      }
      if (movedBy > threshold) {
        currentIndex -= 1;
      }

      setPositionByIndex();
    }

    function getPositionX(event) {
      return event.type.includes("mouse")
        ? event.pageX
        : event.touches[0].clientX;
    }

    function animation() {
      setCarouselPosition();
      if (isDragging) requestAnimationFrame(animation);
    }

    function setCarouselPosition() {
      carousel.style.transform = `translateX(${currentTranslate}px)`;
    }

    function setPositionByIndex() {
      const itemWidth = getItemWidth();
      currentTranslate = -itemWidth * currentIndex;
      prevTranslate = currentTranslate;
      setCarouselPosition();
      carousel.style.transition = "transform 0.3s ease";

      carousel.addEventListener("transitionend", checkIndex, { once: true });
    }

    function checkIndex() {
      carousel.style.transition = "none";
      const itemWidth = getItemWidth();

      if (allItems[currentIndex].id === "first-clone") {
        currentIndex = 1;
        currentTranslate = -itemWidth * currentIndex;
        prevTranslate = currentTranslate;
        setCarouselPosition();
      }
      if (allItems[currentIndex].id === "last-clone") {
        currentIndex = allItems.length - 2;
        currentTranslate = -itemWidth * currentIndex;
        prevTranslate = currentTranslate;
        setCarouselPosition();
      }
    }

    // ------------------ Botões ------------------
    nextButton.addEventListener("click", () => {
      currentIndex++;
      setPositionByIndex();
    });

    prevButton.addEventListener("click", () => {
      currentIndex--;
      setPositionByIndex();
    });

    // const Evento = function (posi, id) {
    //   this.posi = posi;
    //   this.id = id;
    // };

    // const ArrayEventos = [];
    // const quant = 4;

    // for (let i = 1; i <= quant; i++) {
    //   const evento = new Evento(i, i);

    //   ArrayEventos.push(evento);
    // }

    // // const evento1 = new Evento(1,1);

    // // criar objetos no DOM
    // const carrocelDOM = document.getElementById("carrocelEventos");

    // ArrayEventos.map((el) => {
    //   const novoEvento = document.createElement("div");

    //   novoEvento.setAttribute("id", el.id);
    //   novoEvento.classList.add("eventos");
    //   novoEvento.innerText = el.id;

    //   carrocelDOM.appendChild(novoEvento);
    // });
  },
};
</script>

<style>
/* .eventos {
  margin: 0 0px;
  width: 320px;
  height: 100%;
  background-color: rgb(0, 204, 255);
} */
</style>

<style scoped>
* {
  box-sizing: border-box;
}

.carousel-container {
  position: relative;
  overflow: hidden;
  width: 90%;
  max-width: 600px;
  margin: auto;
}

.carousel {
  display: flex;
  gap: 20px;
  transition: transform 0.3s ease;
}

.carousel-item {
  min-width: 80%;
  background-color: #3498db;
  color: white;
  height: 150px;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  user-select: none;
  flex-shrink: 0;
  font-size: 24px;
}

.nav-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(46, 204, 113, 0.8);
  color: white;
  border: none;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  cursor: pointer;
  font-size: 24px;
  transition: background-color 0.3s;
  z-index: 10;
}

.nav-button:hover {
  background-color: rgba(39, 174, 96, 0.9);
}

.nav-button.prev {
  left: 10px;
}

.nav-button.next {
  right: 10px;
}
</style>
