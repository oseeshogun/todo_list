import axios from "axios";

const axiosClient = axios.create({
    withCredentials: true,
    baseURL: window.location.origin,
});

const state = () => ({
    tasks: [
        {
            id: 1,
            text: "Hard code TODO",
        },
    ],
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
};

const mutations = {
    setTasks: (state, tasks) => (state.tasks = tasks),
    newTask: (state, task) => state.tasks.push(task),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
