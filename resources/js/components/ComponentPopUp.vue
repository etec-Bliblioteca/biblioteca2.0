<template>
  <!-- Corpo principal -->
  <div id="corpoPopUp">
    <!-- PopUp -->
    <div id="PopUp">
      <!-- botão de fechar -->
      <button id="btnFechar" @click="desativarPopUp">
        <svg
          viewBox="0 0 1024 1024"
          xmlns="http://www.w3.org/2000/svg"
          fill="#000000"
        >
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g
            id="SVGRepo_tracerCarrier"
            stroke-linecap="round"
            stroke-linejoin="round"
          ></g>
          <g id="SVGRepo_iconCarrier">
            <path
              fill="#000000"
              d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"
            ></path>
          </g>
        </svg>
      </button>

      <!-- imagem da revista -->
      <!-- <img :src="`../storage/images/${img}`"/> -->
      <img :src="`../storage/images/${img}`" />
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
      <button id="btnReservar" @click="clickReservar"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8.5 12.5L10.5 14.5L15.5 9.5" stroke="var(--cor3)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8" stroke="var(--cor3)" stroke-width="1.5" stroke-linecap="round"></path> </g></svg></button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import titulo from "@/components/ComponentTitulos.vue";
import subtitulo from "@/components/ComponentSubtitulo.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { useForm } from "@inertiajs/vue3";

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
    //   verificar se a requisição foi iniciada
      reservando: false,
    };
  },
  components: {
    titulo,
    subtitulo,
  },
  props: {
    // recebe o aviso se ele deve ser ativado ou não
    user: Object,
    active: Boolean,
    descricao: String,
    tema: String,
    quant: Number,
    titulo: String,
    img: String,
    idRevista: {
      type: Number,
      require: true,
    },
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
    // remover uma revista após ela ser reservada.
    resevarRevista() {
      if (this.quant <= 0 || this.reservando) return;
      this.reservando = true;
      if (this.quant > 0) {
        this.quant -= 1;
        // Atualiza o estado do botão imediatamente
        if (this.quant <= 0) {
          document.getElementById("btnReservar").classList.add("bloqueado");
        }
      }
    },
    clickReservar() {
      //impede mais de uma requisição ao mesmo tempo e uma caso a quantidade seja 0
      // VERIFICA SE O USER ESTA AGENDADO
      if(this.user.id){
        //toast que faz a o pedido de forma assincrona para o serve
      toast
        .promise(
          axios.post(`/revistas/${this.idRevista}/${this.user.id}/reservar`),
          {
            pending: "Fazendo pedido...",
            success: "Reserva feita com sucesso!",
            error: "Erro ao fazer reserva. Tente novamente.",
          },
          {
            theme: "auto",
            transition: "slide",
          }
        )
        .then((resposta) => {
            // pega a nova quantidade e atualiza
          this.quant = resposta.data.novaQuantidade;
          this.reservando = false;
        })
        .catch((error) => {
          this.reservando = false;
        });
        return;
      }

      // ENVIAR PARA A PAGINA DE LOGIN
      const form = useForm({});
      form.submit('get','/login');
    },
  },
  updated() {
    // quando o component for mostrado ele desativara o scroll
    if (this.active) {
      document.body.style.overflow = "hidden";
      document.getElementById("PopUp").classList.remove("animacaoSaindo");
      document.getElementById("PopUp").classList.add("animacaoEntrando");
      if (this.quant <= 0) {
        document.getElementById("btnReservar").classList.add("bloqueado");
      } else {
        document.getElementById("btnReservar").classList.remove("bloqueado");
      }
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
  background: none;
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

#btnReservar {
  grid-area: btnReservar;
  width: 230px;
  height: 45px;
  border-radius: 10px;
  margin: 0 auto;
  margin-bottom: 30px;
  cursor: pointer;
  background-color: rgb(20, 165, 20);
  display: flex;
  align-items: center;
  justify-content: center;
}

#btnReservar svg{
  width: 40px;
}

.bloqueado {
  background-color: red !important;
  pointer-events: none;
}
</style>
