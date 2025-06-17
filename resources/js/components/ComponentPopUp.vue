<template>
  <!-- Corpo principal -->
  <div id="corpoPopUp">
    <!-- PopUp -->
    <div id="PopUp">
      <!-- botão de fechar -->
      <button id="btnFechar" @click="desativarPopUp"></button>

      <!-- imagem da revista -->
      <img :src="img" alt="" />

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
      <button id="btnResevar"></button>
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
  updated() {
    // quando o component for mostrado ele desativara o scroll
    if (this.active) {
      document.body.style.overflow = "hidden";
            document.getElementById("PopUp").classList.remove("animacaoSaindo");
                        document.getElementById("PopUp").classList.add("animacaoEntrando");
    }
  },
  //   beforeUpdate () {
  //     // quanto for desmontado, ela volta
  //     document.body.style.overflow = "";
  //   },
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
  background-color: white;
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
    "btnResevar";
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
  background-color: rgb(170, 169, 169);
  top: 20px;
  right: 20px;
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
}
#descricao > p {
  overflow: auto;
  font-size: 14px;
}

#btnResevar {
  grid-area: btnResevar;
  background-color: red;
  width: 230px;
  height: 45px;
  border-radius: 10px;
  margin: 0 auto;
  margin-bottom: 30px;
}
</style>
