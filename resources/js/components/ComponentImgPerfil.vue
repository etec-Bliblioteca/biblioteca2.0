<template>
    <img id="imgPerfil" :src="`../storage/images/logoBiblioteca.png`" alt="" />
</template>

<style scoped>
#imgPerfil {
    width: 90px;
    height: 90px;
    margin: 0 auto;
    /* border: 2px solid #000000; */
    border-radius: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    object-fit: cover;
}
</style>

<script>
export default {
    name: "imgPerfil",
};
</script>
