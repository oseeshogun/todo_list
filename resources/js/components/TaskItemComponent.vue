<template>
    <div>
        <form
            @submit="submitTask"
            @reset="() => onCancelEdition()"
            class="inline w-full mx-4 my-0"
        >
            <div class="flex items-center my-0">
                <input
                    id="default-checkbox"
                    @change="onToggleFinished"
                    :checked="task.finished"
                    type="checkbox"
                    class="w-4 h-4 mr-4 cursor-pointer text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                />
                <input
                    v-if="editing"
                    v-model="text"
                    type="text"
                    @blur="() => onCancelEdition()"
                    autofocus
                    class="w-full mr-3 p-1 border-sky-500 outline-sky-500"
                />
                <p
                    v-else
                    @click.stop="editing = true"
                    :class="{
                        'line-through': task.finished,
                        'text-gray-400': task.finished,
                    }"
                    class="w-full text-green"
                >
                    {{ task.text }}
                </p>
                <span @click.stop="showModal = true" class="text-red-500">
                    <i class="fa fa-trash"></i>
                </span>
            </div>
            <div v-if="editing" class="w-full py-2 flex justify-start">
                <button
                    type="reset"
                    class="border cursor-pointer text-black border-gray-200 px-5 py-2 text-xs hover:bg-sky-100"
                >
                    Annuler
                </button>
            </div>
        </form>
        <div
            v-if="showModal"
            class="fixed top-0 left-0 w-screen h-screen bg-black/20 z-40"
        >
            <ConfirmDelete
                :onCancel="() => (showModal = false)"
                :onConfirmDelete="() => deleteTask(task.id)"
            >
            </ConfirmDelete>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import ConfirmDelete from "./ConfirmDeleteComponent";

export default {
    name: "TaskItem",
    props: ["task"],
    components: {
        ConfirmDelete,
    },
    data() {
        return {
            editing: false,
            showModal: false,
            text: this.task.text,
        };
    },
    methods: {
        ...mapActions("tasks", ["updateTask", "deleteTask", "toggleFinished"]),
        onToggleFinished(e) {
            this.toggleFinished({ ...this.task, finished: e.target.checked });
        },
        submitTask(e) {
            e.preventDefault();
            if (this.text === this.task.text) return;
            this.editing = false;
            this.updateTask({ ...this.task, text: this.text });
        },
        onCancelEdition() {
            this.editing = false;
        },
    },
};
</script>
