import axios from "axios";

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

axios.defaults.baseURL = process.env.VUE_APP_API_URL;

axios.defaults.withCredentials = false;

export const Axios = axios;
