<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Four Random Post!</h1>
            </div>
        </div>
        <div class="row">
        <div class="col-3 mt-2" v-for="(post, index) in cards.posts" :key="index">
            <div class="card">
            <img v-if="post.image" :src="'/storage/'+post.image" class="card-img-top" :alt="post.name">
            <img v-else src="/storage/uploads/default.png" :alt="post.name">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ post.content }}</p>
            </div>
            <router-link class="btn btn-info" :to="{ name: 'post', params: { id: post.id } }">View</router-link>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";
  export default {
    name: "Main",
    data() {
      return {
        cards: {
            posts: null
        }
      }
    },
    created() {
      this.getPosts('http://127.0.0.1:8000/api/v1/posts/random');
    },
    methods: {
        changePage(vs) {
            let url = this.cards[vs];
            if(url) {
                this.getPosts(url);
            }
        },
        getPosts(url){
            Axios.get(url).then(
            (result) => {
                this.cards.posts = result.data.results.data;
            });
        }
    }
}
</script>

<style lang="scss">

</style>
