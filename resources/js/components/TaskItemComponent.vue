<template>
    <form @submit="submitTask" @reset="() => onCancel()" method="POST" action="" class="inline w-full mx-4 my-0">
        <div class="flex items-center my-0">
            <input id="default-checkbox" @change="onMarkAsFinished" type="checkbox"
                class="w-4 h-4 mr-4 cursor-pointer text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
            <input v-model="text" type="text" @blur="() => onCancel()" autofocus
                class="w-full mr-3 p-1 border-sky-500 outline-sky-500" v-if="editing" />
            <p v-else @click.stop="onTextClicked"
                :class="{ 'line-through': task.finished, 'text-gray-400': task.finished }" class="w-full text-green">
                {{
                task.text }}</p>
            <button @click="onDeleteTask" class="text-red-500">
                <i class="fa fa-trash"></i>
            </button>
        </div>
        <div class="w-full py-2 flex justify-start" v-if="editing">
            <button type="reset"
                class="border cursor-pointer text-black border-gray-200 px-5 py-2 text-xs  hover:bg-sky-100">Annuler</button>
        </div>
    </form>

</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: 'TaskItem',
    props: ['task'],
    data() {
        return {
            editing: false,
            text: this.task.text
        }
    },
    methods: {
        ...mapActions("tasks", [
            'updateTask',
            'deleteTask',
            'markAsFinished'
        ]),
        onTextClicked(e) {
            this.editing = true;
        },
        onDeleteTask() {
            this.deleteTask(this.task.id);
        },
        onMarkAsFinished(e) {
            this.markAsFinished({ ...this.task, finished: e.target.checked });
        },
        submitTask(e) {
            e.preventDefault();
            if (this.text === this.task.text) return;
            this.editing = false;
            this.updateTask({ ...this.task, text: this.text });
        },
        onCancel() {
            this.editing = false;
        }
    }
};
</script>
