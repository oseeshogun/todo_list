<template>
    <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
        <div class="rounded bg-white shadow m-4 w-full mx-[5%] lg:mx-[20%]">
            <div class="hover:bg-gray-100 cursor-pointer px-6 py-1" v-for="task in allTasks.slice().reverse()"
                :key="task.id">
                <TaskItem :task="task"></TaskItem>
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
            "allTasks"
        ])
    },
    mounted() {
        this.fetchTasks();
    }
};
</script>
