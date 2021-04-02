window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if (error.response.status == 401) {
        setTimeout(function () {
            document.getElementById("logout-form").submit();
        }, 2000);
    }
    return Promise.reject(error);
});
let _csrf_tag = document.head.querySelector("meta[name='csrf-token']");
if (_csrf_tag) {
    var _csrf_token = _csrf_tag.content;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": _csrf_token,
            "Accept": "application/json",
            "Content-Type": "application/json",
        }
    });
} else {
    console.error("CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token");
    location.reload();
}
window.Vue = require("vue");

if (process.env.NODE_ENV == "production") {
    Vue.config.devtools = false;
    Vue.config.productionTip = false
}

import { Form, AlertError, AlertErrors, HasError, AlertSuccess } from "vform";
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)

import MainHelper from "./mixins/main-helper";
Vue.mixin(MainHelper);

import swal from "sweetalert2";
window.swal = swal;
window.toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: $fadeTimeOut
});

import NProgress from "nprogress";
import "nprogress/nprogress.css";
window.NProgress = NProgress;
NProgress.configure({ parent: "#comments-container" });

window.Fire = new Vue();
window.Form = Form;

Vue.component("blog-comments", require("./views/CommentView.vue").default);

const app = new Vue({
    el: "#app",
});

