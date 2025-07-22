<template>
  <li class="corpo-revista">
    <img :src="`../storage/images/${imgRevista}`" />
  </li>
</template>

<script>
export default {
  name: "cpRevista",
  props: {
    imgRevista: {
      type: String,
      required: true,
    },
  },
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
    object-fit: cover;
}

li {
  list-style: none;
}
</style>
