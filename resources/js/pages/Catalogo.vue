<script>
import btnMenu from "@/components/ComponentBtnMenu.vue";
import Menu from "../components/ComponentMenu.vue";
import imgPerfil from "@/components/ComponentImgPerfil.vue";
import cpRevista from "../components/ComponentRevista.vue";
import barraPesquisa from "../components/ComponentBarraPesquisa.vue";
import popUp from "../components/ComponentPopUp.vue";
import { useForm } from "@inertiajs/vue3";
import prevPesquisa from "@/components/ComponentPrevPesquisa.vue";

export default {
  name: "Catalogo",
  data() {
    return {
      menuActive: false,
      showPopUp: false,
      showCatalogo: true,
      dadosPopUp: {
        imgPopUp: "semImagem",
        descricaoPopUp: "nenhuma",
        temaPopUp: "nenhum",
        quantPopUp: 0,
        tituloPopUp: "None",
      },

      //   quantRevitas e imgRevista tem que ser passado pelo props ou vindo direto do banco de dados
      collectionRevistas: this.collectionRevista,
      revistas: [],
      prevRevistas: [],
      msgErroPesquisa: "",
    };
  },
  components: {
    Menu,
    btnMenu,
    imgPerfil,
    cpRevista,
    barraPesquisa,
    popUp,
    prevPesquisa,
  },
  props: {
    desativar: Boolean,
    collectionRevista: Array,
    dadosRevista: Object,
  },
  methods: {
    clickCpRevista(revista) {
      this.estadoPopUp(revista);
      this.dadosPopUp.id = revista;
    },
    // objeto popup
    infoPopUp() {
      this.dadosPopUp.imgPopUp = this.dadosRevista.imgPopUp;
      this.dadosPopUp.descricaoPopUp = this.dadosRevista.descricaoPopUp;
      this.dadosPopUp.temaPopUp = this.dadosRevista.temaPopUp;
      this.dadosPopUp.quantPopUp = this.dadosRevista.quantPopUp;
      this.dadosPopUp.tituloPopUp = this.dadosRevista.tituloPopUp;
      this.dadosPopUp.id;
    },

    // função que muda o estado do pop up
    estadoPopUp(idRevista) {
      const form = useForm({
        idRevista: idRevista,
      });

      //   envia o id da revista para o backend através de um post e coloca as informações no pop up antes dele ativar
      form.post("/catalogo/revista", {
        onSuccess: () => {
          this.infoPopUp();
          this.showPopUp = !this.showPopUp;
        },
      });
    },
    // função que ativa o menu
    clickMenu(active) {
      this.menuActive = active;
    },
    // função que apaga o catalogo e mostra a prévia da pesquisa
    apagarCatalogo(dados) {
      this.showCatalogo = !dados;
    },
    // função que recebe as revistas da pesquisa e as coloca na prévia
    gerenciarPesquisa(revistas) {
      revistas.map((revista) => {
        this.prevRevistas.push(revista);
      });
    },
    mostrarErro(erro) {
      this.prevRevistas = [];
      this.msgErroPesquisa = erro;
    },
    semPesquisa() {
      this.prevRevistas = [];
    },
  },
  beforeMount() {
    // console.log(novaRevista);
    // this.criarrevistas();
    // PREPARA AS REVISTAS
    this.collectionRevistas.map((revista) => {
      // console.log(revista.id,revista.imagem);
      this.revistas.push(revista);
    });
  },
};
</script>

<template>
  <div id="pg-catalogo">
    <!-- component pop up que ativa através de um props e desativa através de um emit -->
    <pop-up
      v-show="showPopUp"
      :active="showPopUp"
      @desativar="this.showPopUp = !this.showPopUp"
      @quantidade-atualizada="
        (novaQuantidade) => (dadosPopUp.quantPopUp = novaQuantidade)
      "
      :titulo="dadosPopUp.tituloPopUp"
      :img="dadosPopUp.imgPopUp"
      :descricao="dadosPopUp.descricaoPopUp"
      :quant="dadosPopUp.quantPopUp"
      :tema="dadosPopUp.temaPopUp"
      :idRevista="dadosPopUp.id"
    ></pop-up>
    <header>
      <Menu :active="menuActive" page="1" />
      <!-- botão de menu -->
      <btnMenu @clickMenu="clickMenu"></btnMenu>
      <!-- Icone de Perfil -->
      <img-perfil></img-perfil>
      <barraPesquisa
        @pesquisando="apagarCatalogo"
        @result-pesquisa="gerenciarPesquisa"
        @sem-pesquisa="semPesquisa"
        @erro-pesquisa="mostrarErro"
        @limpar-prev="prevRevistas = []"
      ></barraPesquisa>
    </header>
    <!-- prévia da pesquisa em tempo real -->
    <div id="prevPesquisa">
      <prevPesquisa v-if="!showCatalogo" :prevRevistas="prevRevistas" :msgErro="msgErroPesquisa"
      @click-revista="clickCpRevista"/>
    </div>
    <!-- Catalogo -->
    <div id="catalogo" v-if="showCatalogo">
      <ul id="revistas">
        <!-- revistas -->
        <cpRevista
          v-for="revista in revistas"
          :imgRevista="revista.imagem"
          :key="revista.id"
          @click="clickCpRevista(revista.id)"
        />
      </ul>
    </div>
  </div>
</template>

<style scoped>
#pg-catalogo {
  display: grid;
  grid-template-areas:
    "header"
    "catalogo"
    "prePesquisa";
  grid-template-rows: 240px;
  height: auto;
}

#prevPesquisa {
  grid-area: prePesquisa;
  height: auto;
}

#catalogo {
  grid-area: catalogo;
  height: auto;
  margin-bottom: 20px;
}

#revistas {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

header {
  grid-area: header;
  padding-top: 25px;
  width: 100%;
  display: flex;
  align-items: center;
  flex-direction: column;
}
</style>
