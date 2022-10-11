<template>
    <div class="flex items-center justify-center mt-10">
        <form method="POST" class="w-full px-[5%] lg:px-[20%]">
            <div class="relative w-full text-gray-600 focus-within:text-gray-400">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <i class="fa-solid fa-plus"></i>
                </span>
                <input type="text" name="q"
                    class="py-2 px-4 text-sm w-full text-black bg-white-900 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-black-900"
                    placeholder="Ajouter une tâche" autocomplete="off">
            </div>
        </form>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    methods: {
        ...mapActions("todos", [
            'fetchTodos'
        ])
    },
    computed: {
        ...mapGetters("todos", [
            'allTodos',
        ])
    },
    mounted() {
        this.fetchTodos();
    }
};
</script>
