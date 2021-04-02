<template>
    <div class="col-lg-12">
        <div class="sidebar-item comments">
            <div class="sidebar-heading">
                <h2>{{ total_length }} </h2>
            </div>
            <div class="content" id="comments-container">
                <form @submit.prevent="addMode ? storeMethod() : updateMethod()">
                    <div class="form-group" id="MessageContainer">
                        <label class="col-form-label" for="Message">Message</label>
                        <input type="text" v-model="form.message" :disabled="form.busy" :class="{ 'is-invalid': form.errors.has('message') }" class="form-control" id="Message">
                        <has-error :form="form" field="message"></has-error>
                    </div><!-- MessageContainer -->
                    <button :disabled="form.busy" class="btn btn-success text-black" type="submit"> submit </button>
                    <alert-errors :form="form" message="There were some problems with your input."></alert-errors>
                </form>
                <div class="comments">
                    <div v-for="(comment, index) in comments" :key="index" class="media m-2">
                        <img class="mr-3" src="/enduser/images/comment-author-01.jpg">
                        <div class="media-body">
                            <h5 class="mt-0">
                                {{ comment.user ? comment.user.name : '' }}
                                <a v-if="loggedUser.id == comment.user.id" class="text-danger" @click="destoryMethod(comment)"><i class="fa fa-trash fa-1x fa-fw"></i></a>
                            </h5>
                            <p>{{ comment.message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    #comments-container .comments{
        height: 800px;
        overflow: auto
    }
</style>
<script>
    export default {
        props: ["blog"],
        data() {
            return {
                loggedUser: {},
                comments: [],
                addMode: true,
                form: new Form({
                    id: "",
                    identifier: "",
                    blog_id: this.blog.id,
                    message: "",
                }),
            }
        },
        methods: {
            getAllComments(){
                axios.get(`/blog/${this.blog.id}/comments`)
                    .then(res => {
                    this.comments = res.data.payload ?? {};
                });
            },
            storeMethod(){
                NProgress.start()
                this.form.post(`/comment/store`)
                    .then((res) => {
                        NProgress.done();
                        if(res.status == 200){
                            this.form.reset();
                            Fire.$emit(`refreshComments`);
                            swal.fire({ title: res.data.payload , icon: 'success', timer: $fadeTimeOut, })
                        }else{
                            swal.fire({ title: res.data.payload , icon: 'warning', timer: $fadeTimeOut, })
                        }
                    }).catch((res) =>{
                        NProgress.done();
                    });
            },
            editMethod(_comment){
                this.addMode = false;
                this.form.reset();
                this.form.clear();
                this.form.fill(_comment);
            },
            updateMethod(){
                NProgress.start()
                this.form.put(`/comment/${this.form.identifier}/update`)
                    .then((res) => {
                        NProgress.done();
                        if(res.status == 200){
                            this.form.reset();
                            Fire.$emit(`refreshComments`);
                            swal.fire({ title: res.data.payload , icon: 'success', timer: $fadeTimeOut, })
                        }else{
                            swal.fire({ title: res.data.payload , icon: 'warning', timer: $fadeTimeOut, })
                        }
                    }).catch((res) =>{
                        NProgress.done();
                    });
            },
            destoryMethod(_comment) {
                swal.fire({
                    title: `Are you sure?`,
                    text: `You won't be able to revert this!`,
                    icon: `warning`,
                    showCancelButton: true,
                    confirmButtonColor: `#3085d6`,
                    cancelButtonColor: `#d33`,
                    confirmButtonText: `Yes`
                }).then((result) => {
                    this.form.identifier = _comment.id;
                    if (result.value) {
                        this.form.delete(`/comment/${this.form.identifier}/delete`)
                            .then((res) => {
                                NProgress.done();
                                if(res.status == 200){
                                    this.form.reset();
                                    Fire.$emit(`refreshComments`);
                                    swal.fire({ title: res.data.payload , icon: 'success', timer: $fadeTimeOut, })
                                }else{
                                    swal.fire({ title: res.data.payload , icon: 'warning', timer: $fadeTimeOut, })
                                }
                            }).catch((res) => {
                                swal.fire({ title: res.data.errors , icon: 'warning', timer: $fadeTimeOut, })
                            });
                    }
                })
            },
        },
        mounted() {
            this.comments = this.blog.comments;
            this.loggedUser = window.W_User;
        },
        created() {
            Fire.$on(`refreshComments`, () => {
                this.getAllComments()
            });
        },
        computed:{
            total_length(){
                return `${this.comments.length} Comments`
            }
        }
    }
</script>
