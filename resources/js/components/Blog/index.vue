<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <article class="post-preview" v-for="post in blog">
                    <a v-bind:href="'blog/single/' + post.id">
                        <h2 class="post-title">{{ post.title }}</h2>
                        <h3 class="post-subtitle" v-html="post.body"></h3>
                    </a>
                    <p class="post-meta">
                        Posted by <strong>{{ post.user.name }}</strong> on
                        <strong>{{ post.created_at }}</strong>
                    </p>
                </article>
                <hr/>


                <div class="col-12 text-center">
<!--                    {{ $blog->links("pagination::bootstrap-4") }}-->
                </div>
                <br/>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: function () {
        return{
            blog: [],
        }
    },
    mounted() {
        this.loadBlog();
    },methods: {
        loadBlog: function (){
            axios.get('api/blog?trim=true&user=true')
                .then((response) =>{
                    this.blog = response.data.data;
                })
                .catch(function (error){
                    console.log(error);
                });
        }
    }

}
</script>
