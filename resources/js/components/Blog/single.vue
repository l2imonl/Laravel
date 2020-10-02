<template>
    <div class="container" :class="{'loading': loading}">
        <article>

            <div class="row" v-if="data.post">
                <div class="col-lg-8 col-md-10 mx-auto" v-html="data.post.body">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <h5 class="">Leave a Comment :</h5>

                    <form @submit.prevent="postComment">

                        <input type="hidden" name="post_id" v-model="post_id" value="1">
                        <textarea name="commentBody" v-model="commentBody" class="form-control"
                                  rows="3"></textarea>
                        <br>
                        <button type="submit" class="btn btn-info btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <hr/>

<!--            <div class="row">-->
<!--                <div id="comments" class="col-lg-8 col-md-10 mx-auto rounded"-->
<!--                     style="background-color: rgba(203, 209, 208, 0.25)">-->
<!--                    @include('partials._comment_replies', ['comments' => $blog->comments, 'post_id' => $blog->id])-->
<!--                </div>-->
<!--            </div>-->

        </article>
    </div>
</template>
<script>
export default {
    props: ['post_id'],
    data: function () {
        return {
            data: [],
            parent_id: '',
            commentBody: '',
            loading: true,
        }
    },
    mounted() {
        this.fetchPost();
    }, methods: {
        fetchPost: function () {
            this.loading = true;
            axios.get('/api/blog/single/'+ this.post_id +'?replies=true')
                .then((response) => {
                    this.data = response.data;
                })
                .catch(error => console.log(error));
            this.loading = false;
        },
        postComment: function (e){
            axios.post('/api/comment/store',{
                body: this.commentBody,
                parent_id: this.parent_id,
                post_id: this.post_id,
            }).then((res) => {
                console.warn(res);
            })
            .catch(error => console.log(error));
            e.preventDefault();
        },
    }

}
</script>
