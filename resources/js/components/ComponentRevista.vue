<template>
  <div class="corpo-revista">
    <img :src="`../storage/images/${imgRevista}`"/>
  </div>
</template>

<script>
export default {
  name: "revista",
  methods:{
    emitClick(){
        this.$emit('clickRevista');
    }
  },
  props:{
    imgRevista: String,
  }
};
</script>

<style scoped>
.corpo-revista {
  width: 170px;
  height: 230px;
}

img{
    width: 100%;
    height: 100%;
    background-color: black;
    border-radius: 5px;
    outline: 2px solid var(--cor1);
}
</style>
