import axios from "axios";

const axiosClient = axios.create({
    withCredentials: true,
    baseURL: window.location.origin,
});

const state = () => ({
    todos: [
        {
            id: 1,
            text: "Hard code TODO",
        },
    ],
});

const getters = {
    allTodos: (state) => state.todos,
};

const actions = {
    async fetchTodos({ commit }) {
        const response = await axiosClient.get("/tasks/");
        console.log(response.data);
    },
};

const mutations = {};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
