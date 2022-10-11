<template>
    <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
        <div class="rounded bg-white shadow p-6 m-4 w-full mx-[5%] lg:mx-[20%]">
            <div>
                <div class="flex mb-4 items-center" v-for="task in allTasks" :key="task.id">
                    <input id="default-checkbox" type="checkbox" value=""
                        class="w-4 h-4 mr-4 cursor-pointer text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                    <p :class="{ 'line-through': task.finished, 'text-gray-400': task.finished }"
                        class="w-full text-green">{{ task.text }}</p>
                    <button class="text-red-500">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    data() {
        return {}
    },
    methods: {
        ...mapActions("tasks", [
            'fetchTasks'
        ]),
    },
    computed: {
        ...mapGetters("tasks", [
            "allTasks"
        ])
    },
    mounted() {
        this.fetchTasks();
    }
};
</script>
