<template>
    <div class="flex items-center justify-center mt-10">
        <form
            @submit="submitTodo"
            class="w-full mx-[5%] lg:mx-[20%] p-2 bg-white rounded-xl"
        >
            <div
                :class="{ 'border-b-2': text }"
                class="relative border-sky-200 rounded-2xl w-full text-gray-600 focus-within:text-gray-400"
            >
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <i class="fa-solid fa-plus"></i>
                </span>
                <input
                    v-model="text"
                    type="text"
                    name="q"
                    class="py-2 px-4 text-sm w-full text-black bg-white-900 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-black-900"
                    placeholder="Ajouter une tâche"
                    autocomplete="off"
                />
            </div>
            <div v-if="text" class="w-full py-2 flex justify-end">
                <button
                    type="submit"
                    class="border cursor-pointer text-white border-sky-200 px-5 py-2 rounded-2xl bg-sky-500 hover:bg-sky-700"
                >
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {
            text: "",
        };
    },
    methods: {
        ...mapActions("tasks", ["addTask"]),
        submitTodo(e) {
            e.preventDefault();
            this.addTask(this.text);
            e.target.reset();
            this.text = "";
        },
    },
    computed: {
        ...mapGetters("tasks", []),
    },
    mounted() {},
};
</script>
