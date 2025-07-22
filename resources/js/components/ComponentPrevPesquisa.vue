<template>
  <p class="msg-erro" v-if="prevRevistas.length === 0 && msgErro">
    {{ msgErro }}
  </p>
  <ul class="corpo-PrevPesquisa">
    <cpRevista
      v-for="revista in prevRevistas"
      :imgRevista="revista.imagem"
      :key="revista.id"
      @click="$emit('click-revista', revista.id)"
    />
  </ul>
</template>

<script>
import cpRevista from "./ComponentRevista.vue";

export default {
  name: "prevPesquisa",
  components: {
    cpRevista,
  },
  emits: ["click-revista"],
  props: {
    prevRevistas: {
      type: Array,
      required: true,
    },
    msgErro: {
      type: String,
      default: "",
    },
  },
};
</script>

<style scoped>
.corpo-PrevPesquisa {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
  margin-bottom: 20px;
}
p{
    color: var(--cor1);
    font-size: 24px;
    font-family: var(--roboto);
    text-align: center;
    margin-top: 20px;
}
</style>
