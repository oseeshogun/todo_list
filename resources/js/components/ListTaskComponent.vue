<template>
    <div>

        <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
            <div class="rounded bg-white shadow m-4 w-full mx-[5%] lg:mx-[20%]">
                <div class="hover:bg-gray-100 cursor-pointer px-6 py-1" v-for="task in notFinishedTaks.slice().reverse()"
                    :key="task.id">
                    <TaskItem :task="task"></TaskItem>
                </div>
            </div>
        </div>
        <div class="mt-20" v-if="finishedTaks.length > 0">
            <div class="mx-[5%] lg:mx-[20%]">
                <h2 class="mb-5 text-lg font-bold">{{ finishedTaks.length }} éléments terminés</h2>
            </div>
            <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
                <div class="rounded bg-white shadow m-4 w-full mx-[5%] lg:mx-[20%]">
                    <div class="hover:bg-gray-100 cursor-pointer px-6 py-1" v-for="task in finishedTaks.slice().reverse()"
                        :key="task.id">
                        <TaskItem :task="task"></TaskItem>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import TaskItem from './TaskItemComponent.vue';

export default {
    components: {
        TaskItem
    },
    methods: {
        ...mapActions("tasks", [
            'fetchTasks'
        ]),
    },
    computed: {
        ...mapGetters("tasks", [
            "allTasks",
            "finishedTaks",
            "notFinishedTaks"
        ])
    },
    mounted() {
        this.fetchTasks();
    }
};
</script>
