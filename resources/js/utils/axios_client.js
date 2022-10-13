import axios from "axios";

const axiosClient = axios.create({
    withCredentials: true,
    baseURL: window.location.origin + "/api",
});

export default axiosClient