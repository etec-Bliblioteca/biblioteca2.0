<script>
import btnMenu from "@/components/ComponentBtnMenu.vue";
import Menu from "../components/ComponentMenu.vue";
import imgPerfil from "@/components/ComponentImgPerfil.vue";
import cpRevista from "../components/ComponentRevista.vue";
import barraPesquisa from "../components/ComponentBarraPesquisa.vue";
import popUp from "../components/ComponentPopUp.vue"

export default {
  name: "Catalogo",
  data() {
    return {
      menuActive: false,
      showPopUp: false,

      //   quantRevitas e imgRevista tem que ser passado pelo props ou vindo direto do banco de dados
      Revistas: [],
    };
  },
  components: {
    Menu,
    btnMenu,
    imgPerfil,
    cpRevista,
    barraPesquisa,
    popUp,
  },
  props:{
    desativar: Boolean
  },
  methods: {
    // função que muda o estado do pop up
    estadoPopUp(){
        this.showPopUp = !this.showPopUp
    },

    // função que cria as revistas com as suas informações
    criarRevistas() {
      const quant = 101;

      // Função construtora correta
      function CriandoRevista(img) {
        this.imgRevista = img;
      }

      // Inicializa o array se ainda não existir
      for (let i = 0; i < quant; i++) {
        let novaRevista = new CriandoRevista("a");
        this.Revistas.push(novaRevista);
      }
    },
    clickMenu(active) {
      this.menuActive = active;
    },
  },
  mounted() {
    // criar revistas assim que o Dom for montado
    this.criarRevistas();
  }
};
</script>

<template>
  <div id="pg-catalogo">
    <!-- component pop up que ativa através de um props e desativa através de um emit -->
    <pop-up v-show="showPopUp" :active="showPopUp" @desativar="estadoPopUp"></pop-up>
    <header>
      <Menu :active="menuActive" page="1" />
      <!-- botão de menu -->
      <btnMenu @clickMenu="clickMenu"></btnMenu>
      <!-- Icone de Perfil -->
      <img-perfil></img-perfil>
      <barraPesquisa></barraPesquisa>
    </header>
    <div id="catalogo">
        <!-- {{ criarRevistas() }} -->
      <cpRevista
        v-for="(imgRevista,index) in Revistas"
        :imgRevista="imgRevista" :key="index"
        @click="estadoPopUp"
      ></cpRevista>
    </div>
  </div>
</template>

<style scoped>
#pg-catalogo {
  display: grid;
  grid-template-areas:
    "header"
    "catalogo";
  grid-template-rows: 240px;
  height: auto;
}

#catalogo {
  grid-area: catalogo;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
  height: auto;
  margin-bottom: 20px;
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
