import axiosClient from '../../utils/axios_client'

const state = () => ({
    tasks: [],
});

const getters = {
    allTasks: (state) => state.tasks,
    finishedTaks: (state) => state.tasks.filter((task) => task.finished),
    notFinishedTaks: (state) => state.tasks.filter((task) => !task.finished),
};

const actions = {
    async fetchTasks({ commit }) {
        const response = await axiosClient.get("/tasks/");
        commit("setTasks", response.data);
    },
    async addTask({ commit }, text) {
        const response = await axiosClient.post("/tasks/", { text });
        commit("newTask", response.data);
    },
    async updateTask({ commit }, task) {
        await axiosClient.put(`/tasks/${task.id}`, {
            text: task.text,
        });
        commit("updateTask", task);
    },
    async deleteTask({ commit }, id) {
        await axiosClient.delete(`/tasks/${id}`);
        commit("deleteTask", id);
    },
    async toggleFinished({ commit }, task) {
        await axiosClient.put(`/tasks/${task.id}/finished`, {
            finished: task.finished,
        });
        commit("updateTask", task);
    },
};

const mutations = {
    setTasks: (state, tasks) => (state.tasks = tasks),
    newTask: (state, task) => state.tasks.push(task),
    deleteTask: (state, id) =>
        (state.tasks = state.tasks.filter((task) => task.id !== id)),
    updateTask: (state, updatedTask) => {
        const index = state.tasks.findIndex(
            (task) => task.id === updatedTask.id
        );
        if (index !== -1) {
            state.tasks.splice(index, 1, updatedTask);
        }
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
