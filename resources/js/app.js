import LikeList from "./components/LikeList";

require('./bootstrap');
window.Vue = require("vue");
const app = new Vue({
    el: '#app',
    components: {
        LikeList
    }
});
