<script>
import CardLib from "@/components/admin/ComponentCardLib.vue";
import Menu from "@/components/admin/ComponentMenuAdmin.vue";
import Title from "@/components/admin/ComponentTitle.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    name: "Liberacao",
    data() {
        return {};
    },
    components: {
        Menu,
        Title,
        CardLib,
    },
    props: {
        UsersInativos: Array,
    },
    methods: {
        btnCheck(userRm) {
            const form = useForm({
                rm: userRm,
                action: 'lib'
            });

            form.submit("post", "/admin/liberacao");
        },
        btnRecuse(userRm) {
            const form = useForm({
                rm: userRm,
                action: 'rec'
            });

            form.submit("post", "/admin/liberacao");
        },
    },
};
</script>

<template>
    <div class="containerAdmin">
        <Menu page="1"></Menu>
        <div class="painel">
            <Title text="liberação de alunos" />
            <div class="containerCards">
                <cardLib
                    v-for="user in UsersInativos"
                    :key="user.rm"
                    :user-data="user"
                    @btn-check="btnCheck"
                    @btn-recuse="btnRecuse"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
.containerCards {
    width: 100%;
    display: flex;
    align-content: center;
    justify-content: flex-start;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 30px;
}
</style>
