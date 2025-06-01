<template>
    <div id="carrocelEventos">
        <div id="evento1" class="eventos">1</div>
        <div id="evento2" class="eventos">2</div>
        <div id="evento3" class="eventos">3</div>
        <div id="evento4" class="eventos">4</div>
    </div>
</template>

<script lang="js">
    export default {
        name: "carrocelEventos",
        data() {
            return {

            }
        },
        methods: {
            criarCarrocel() {
            }
        },
        mounted() {
                            const Evento = function (posi, id) {
                    this.posi = posi;
                    this.id = id;
                };

                const ArrayEventos = [];
                const quant = 4;

                for (let i = 1; i <= quant; i++) {
                    const evento = new Evento(i, i);

                    ArrayEventos.push(evento);
                }

                // const evento1 = new Evento(1,1);

                // criar objetos no DOM
                const carrocelDOM = document.getElementById('carrocelEventos');

                ArrayEventos.map((el)=>{
                    const novoEvento = document.createElement('div');

                    novoEvento.setAttribute(id,el.id)
                    novoEvento.setAttribute(classe,'eventos')
                    console.log(novoEvento);
                })
        }

    }
</script>

<style scoped>
    .eventos {
        width: 70%;
        height: 100%;
        background-color: rgb(0, 204, 255);
    }

    div {
        margin-top: 10px;
        width: 100%;
        height: 100%;
        background-color: black;

        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
