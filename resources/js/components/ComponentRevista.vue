<template>
  <div class="corpo-revista">
    <img :src="img_revista" alt="">
  </div>
</template>

<script>
export default {
  name: "revista",
  data(){
    return{
        img_revista: this.imgRevista,
    }
  },
  methods:{
    emitClick(){
        this.$emit('clickRevista');
    }
  },
  props: {
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
}
</style>
