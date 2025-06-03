<script>
export default {
  name: "carrocelRevistasNovas",
};
</script>

<template>
  <div class="container">
    <div class="item" style="outline-color: red;">
      <img :src="'../storage/images/semImagem.jpg'" />
    </div>
    <div class="item active" style="outline-color: blue;">
      <img :src="'../storage/images/semImagem.jpg'" />
    </div>
    <div class="item" style="outline-color: yellow;">
      <img :src="'../storage/images/semImagem.jpg'" />
    </div>
  </div>
</template>

<style scoped>
.container {
  margin-top: 10px;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
  gap: 10px;
}

.container .item {
  width: 50px;
  height: 80px;
  border-radius: 5px;
  outline: 3px solid var(--cor2);
  overflow: hidden;
  transition: all 0.3s ease;
}

.container .item.active {
  width: 100px !important;
  height: 160px !important;
}

.container .item > img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
