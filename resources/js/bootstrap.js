import axios from "axios";
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: "pusher",
    key: "6d73d4fcc6952df0b86", // Your PUSHER_APP_KEY from .env
    cluster: "ap1", // Your PUSHER_APP_CLUSTER from .env
    forceTLS: true,
});
