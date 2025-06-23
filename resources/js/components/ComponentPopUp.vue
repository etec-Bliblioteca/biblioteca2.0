<template>
  <!-- Corpo principal -->
  <div id="corpoPopUp">
    <!-- PopUp -->
    <div id="PopUp">
      <!-- botão de fechar -->
      <button id="btnFechar" @click="desativarPopUp">
        <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#000000" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"></path></g></svg>
      </button>

      <!-- imagem da revista -->
      <!-- <img :src="`../storage/images/${img}`"/> -->
      <img :src="`../storage/images/${img}`"/>
      <!-- titulo da revista -->
      <titulo :nomeTitulo="titulo" id="titulo"></titulo>

      <!-- informações da revista -->
      <section id="informacaoRevista">
        <!-- tema -->
        <section id="tema">
          <subtitulo :nomeSubtitulo="subtitulos.sub1"></subtitulo>
          <span>
            {{ tema }}
          </span>
        </section>

        <!-- quantidade -->
        <section id="quantidade">
          <subtitulo :nomeSubtitulo="subtitulos.sub2"></subtitulo>
          <span>
            {{ quant }}
          </span>
        </section>

        <!-- descrição -->
        <section id="descricao">
          <!-- subtitulo -->
          <subtitulo :nomeSubtitulo="subtitulos.sub3"></subtitulo>

          <!-- descrição texto -->
          <p id="textoDescricao">
            {{ descricao }}
          </p>
        </section>
      </section>
      <!-- botaão para reservar revistas -->
           
      <button class="btnReservar" id="btnHabilidado"  v-if="reservar">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 11L12 14L22 4M16 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V16.2C3 17.8802 3 18.7202 3.32698 19.362C3.6146 19.9265 4.07354 20.3854 4.63803 20.673C5.27976 21 6.11984 21 7.8 21H16.2C17.8802 21 18.7202 21 19.362 20.673C19.9265 20.3854 20.3854 19.9265 20.673 19.362C21 18.7202 21 17.8802 21 16.2V12" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
      </button>

      <button class="btnReservar" id="btnDesabilitado" v-else>
        <svg viewBox="-4 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="var(--cor3)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Lager_45" data-name="Lager 45" transform="translate(-4)"> <g id="Group_16" data-name="Group 16"> <path id="Path_53" data-name="Path 53" d="M26,12H24V7h-.069A7.993,7.993,0,0,0,8.069,7H8v5H6a2,2,0,0,0-2,2V30a2,2,0,0,0,2,2H26a2,2,0,0,0,2-2V14A2,2,0,0,0,26,12ZM12,8a4,4,0,0,1,8,0v4H12ZM23,28H9a1,1,0,0,1-1-1V17a1,1,0,0,1,1-1H23a1,1,0,0,1,1,1V27A1,1,0,0,1,23,28Z" fill="var(--cor3)"></path> <circle id="Ellipse_1" data-name="Ellipse 1" cx="2" cy="2" r="2" transform="translate(14 20)" fill="var(--cor3)"></circle> </g> </g> </g></svg>
      </button>


    </div>
  </div>
</template>

<script>
import titulo from "@/components/ComponentTitulos.vue";
import subtitulo from "@/components/ComponentSubtitulo.vue";

export default {
  name: "popUp",
  data() {
    return {
      //   subtitulos da página que não devem ser mudados
      subtitulos: {
        sub1: "Tema",
        sub2: "Quantidade",
        sub3: "Descrição",
      },
      reservar: this.quant > 0 ? true : false,
    };
  },
  components: {
    titulo,
    subtitulo,
  },
  props: {
    // recebe o aviso se ele deve ser ativado ou não
    active: Boolean,
    descricao: String,
    tema: String,
    quant: Number,
    titulo: String,
    img: String
  },
  methods: {
    // função feita para desativar o elemento e ativar de novo a barra de rolagem no fundo
    desativarPopUp() {
      document.getElementById("PopUp").classList.add("animacaoSaindo");
      setTimeout(() => {
        this.$emit("desativar");
        document.body.style.overflow = "";
      }, 190);
    },
  },
  watch:{
    quant(newValue){
      this.reservar = newValue > 0;
    }
  },  
  beforeMount() {
    this.reservar = this.quant > 0;
    console.log(this.reservar)
  },
  updated() {
    // quando o component for mostrado ele desativara o scroll
    if (this.active) {
      document.body.style.overflow = "hidden";
            document.getElementById("PopUp").classList.remove("animacaoSaindo");
                        document.getElementById("PopUp").classList.add("animacaoEntrando");
    }
  },
};
</script>



<style scoped>
#corpoPopUp {
  overflow: auto;
  /* estilo do corpo/pai */
  background-color: rgba(0, 0, 0, 0.671);
  backdrop-filter: blur(3px);

  /* posicionar o corpo/pai */
  position: fixed;
  width: 100vw;
  height: 100%;
  z-index: 101;
}
#PopUp {
  position: relative;
  background-color: var(--cor3);
  margin: 50px auto;
  /* top: 50%;
  transform: translateY(-50%); */
  width: calc(100% - 50px);
  border-radius: 10px;

  display: grid;
  grid-template-areas:
    "img"
    "titulo"
    "informacaoRevista"
    "btnReservar";
  grid-template-rows: repeat(4, fit-content(1000px));
  gap: 30px;
  /* animation: saida 0.2s ease-in infinite; */
}

.animacaoEntrando {
  animation: entrada 0.2s ease-out alternate;
}

.animacaoSaindo {
  animation: saida 0.2s ease-in alternate;
}

@keyframes entrada {
  0% {
    margin-top: 700px;
    width: 70%;
  }
  100% {
    width: calc(100% - 50px);
  }
}

@keyframes saida {
  100% {
    margin-top: 700px;
    width: 70%;
  }
}

#btnFechar {
  position: absolute;
  width: 50px;
  height: 50px;
  border-radius: 10px;
  top: 20px;
  right: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: none;
  
}

#btnFechar svg{
  width: 70%;
  height: 70%;
}


#btnFechar svg path{
  fill: var(--cor1);
}



img {
  grid-area: img;
  background-color: black;
  height: 230px;
  width: 160px;
  margin: 70px auto 0 auto;
  border-radius: 10px;
}

#titulo {
  grid-area: titulo;
}

/* formatação das informações da revista */
#informacaoRevista {
  grid-area: informacaoRevista;
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 0 20px;
}

#informacaoRevista > section {
  display: flex;
  align-items: center;
  gap: 10px;
}
#descricao {
  display: flex;
  flex-direction: column;
  align-items: flex-start !important;
   text-transform: uppercase;
}
#descricao > p {
  overflow: auto;
  font-size: 14px;
  font-family: var(--raleway);
  font-weight: 500;
  text-align: justify;
  text-transform: uppercase;
}

.btnReservar {
  grid-area: btnReservar;
  width: 150px;
  height: 50px;
  border-radius: 10px;
  margin: 0 auto;
  margin-bottom: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  display: none;
}

.btnReservar svg{
  width: 30px;
}

.btnReservar svg path{
  stroke: var(--cor3);
}

#btnHabilidado{
  background: #038273;
  display: flex;
}

#btnDesabilitado{
  display: flex;
  background: #AC1717;
}

</style>
