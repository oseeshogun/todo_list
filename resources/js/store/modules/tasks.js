import axios from "axios";

const axiosClient = axios.create({
    withCredentials: true,
    baseURL: window.location.origin,
});

const state = () => ({
    tasks: [],
});

const getters = {
    allTasks: (state) => state.tasks,
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
        console.log("Logg");
        await axiosClient.put(`/tasks/${task.id}`, {
            text: task.text,
        });
        commit("updateTask", task);
    },
};

const mutations = {
    setTasks: (state, tasks) => (state.tasks = tasks),
    newTask: (state, task) => state.tasks.push(task),
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
