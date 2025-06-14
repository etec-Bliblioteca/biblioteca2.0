<template>
    <h2>{{ text }}</h2>
</template>

<script>
export default{
    name: 'Title',
    props:{
        text:String,
    },
}
</script>

<style scoped>
h2{
    width: fit-content;
    height: fit-content;
    outline: 3px solid var(--cor1);
    border-radius: 10px;
    padding: 10px 30px;
    font-size: 1.5rem;
    background-color: var(--cor2);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-self: center;
    text-transform: uppercase;
    font-family: var(--raleway);
    font-weight: 900;;
}
</style>
