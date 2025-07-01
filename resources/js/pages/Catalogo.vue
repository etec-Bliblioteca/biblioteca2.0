<script>
import btnMenu from "@/components/ComponentBtnMenu.vue";
import Menu from "../components/ComponentMenu.vue";
import imgPerfil from "@/components/ComponentImgPerfil.vue";
import cpRevista from "../components/ComponentRevista.vue";
import barraPesquisa from "../components/ComponentBarraPesquisa.vue";
import popUp from "../components/ComponentPopUp.vue";
import { useForm } from "@inertiajs/vue3";
export default {
    name: "Catalogo",
    data(props) {
        return {
            menuActive: false,
            showPopUp: false,
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
    props: {
        desativar: Boolean,
        collectionRevista: Array,
        dadosRevista: Object,
    },
    methods: {
        infoPopUp() {
            this.dadosPopUp.imgPopUp = this.dadosRevista.imgPopUp;
            this.dadosPopUp.descricaoPopUp = this.dadosRevista.descricaoPopUp;
            this.dadosPopUp.temaPopUp = this.dadosRevista.temaPopUp;
            this.dadosPopUp.quantPopUp = this.dadosRevista.quantPopUp;
            this.dadosPopUp.tituloPopUp = this.dadosRevista.tituloPopUp;
        },

    // função que muda o estado do pop up
    estadoPopUp(idRevista) {
      const form = useForm({
        idRevista: idRevista,
      });

            form.post("/catalogo/revista", {
                onSuccess: () => {
                    this.infoPopUp();
                    this.showPopUp = !this.showPopUp;
                },
            });
        },

        // função que cria as revistas com as suas informações
        // criarrevistas() {
        //   const quant = 101;

        //   // Função construtora correta
        //   function CriandoRevista(img, descricao, tema, numRevista, titulo) {
        //     this.imgRevista = img;
        //     // this.descricaoRevista = descricao;
        //     this.temaRevista = tema;
        //     this.quantRevista = numRevista;
        //     this.tituloRevista = titulo;
        //   }

        // //   funções feitas apenas para teste, apagar depois
        //   // function txt() {
        //   //   const n = Math.floor(Math.random() * 5) + 1;
        //   //   if (n == 1) {
        //   //     return `Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis
        //   //       Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis`;
        //   //   } else if (n == 2) {
        //   //     return `            Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis
        //   //       Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis            Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis
        //   //       Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis`;
        //   //   } else if (n == 3) {
        //   //     return `            expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis
        //   //       Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis            expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis
        //   //       Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis            expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis
        //   //       Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis`;
        //   //   } else if (n == 4) {
        //   //     return `adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis     adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis     adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis     adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis     adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis     `;
        //   //   } else {
        //   //     return `error perspiciatis     adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipisicing elit. Omnis voluptatum voluptatibus
        //   //       expedita ipsum aut sequi libero? Blanditiis vel error perspiciatis     adipisicing elit. Omnis
        //   //       voluptatum voluptatibus expedita ipsum aut sequi libero? Blanditiis
        //   //       vel error perspiciatis similique. Illo deserunt amet tempora
        //   //       officiis aspernatur esse adipisci eveniet? Lorem ipsum dolor sit
        //   //       amet consectetur adipi`;
        //   //   }
        //   // }

        //   // function num() {
        //   //   const n = Math.floor(Math.random() * 5);
        //   //   return n;
        //   // }

        //   // Inicializa o array se ainda não existir
        //   // for (let i = 0; i < quant; i++) {
        //   //   let novaRevista = new CriandoRevista(
        //   //     "a",
        //   //     txt(),
        //   //     "aleatório",
        //   //     num(),
        //   //     "testando"
        //   //   );
        //   //   this.revistas.push(novaRevista);
        //   // }
        // },
        clickMenu(active) {
            this.menuActive = active;
        },
    },
    mounted() {},
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
            :titulo="dadosPopUp.tituloPopUp"
            :img="dadosPopUp.imgPopUp"
            :descricao="dadosPopUp.descricaoPopUp"
            :quant="dadosPopUp.quantPopUp"
            :tema="dadosPopUp.temaPopUp"
        ></pop-up>
        <header>
            <Menu :active="menuActive" page="1" />
            <!-- botão de menu -->
            <btnMenu @clickMenu="clickMenu"></btnMenu>
            <!-- Icone de Perfil -->
            <img-perfil></img-perfil>
            <barraPesquisa></barraPesquisa>
        </header>
        <div id="catalogo">
            <!-- {{ criarrevistas() }} -->
            <cpRevista
                v-for="revista in revistas"
                :imgRevista="revista.imagem"
                :key="revista.id"
                @click="estadoPopUp(revista.id)"
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
