import axios from "axios";

const axiosClient = axios.create({
    withCredentials: true,
    baseURL: window.location.origin + '/api',
});

const state = () => ({
    tasks: [],
    token: ''
});

const getters = {
    allTasks: (state) => state.tasks,
    finishedTaks: (state) => state.tasks.filter(task => task.finished),
    notFinishedTaks: (state) => state.tasks.filter(task => !task.finished),
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
    async markAsFinished({ commit }, task) {
        await axiosClient.put(`/tasks/${task.id}/finished`, { finished: task.finished });
        commit("updateTask", task);
    },
    async getAccessToken({ commit }) {
        const response = await axios.get("/token/");
        console.log(response.data);
        // commit("newTask", response.data);
    }
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
            let copyTasks = [...state.tasks];
            copyTasks[index] = updatedTask;
            state.tasks = copyTasks;
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
