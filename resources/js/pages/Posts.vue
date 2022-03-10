<template>
  <div class="container">
    <div class="row">
      <div class="col-3 mt-2" v-for="(post, index) in cards.posts" :key="index">
        <div class="card">
          <img v-if="post.image" :src="'/storage/'+post.image" class="card-img-top" :alt="post.name">
          <img v-else src="/storage/uploads/default.png" :alt="post.name">
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">{{ post.content }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3 bg-light" v-if="cards.prev_page_url || cards.next_page_url">
      <ul class="list-inline bg-light p-2">
        <li class="list-inline-item"> <button v-if="cards.prev_page_url" class="btn btn-primary" @click="changePage('prev_page_url')">Prev</button></li>
        <li class="list-inline-item"> <button v-if="cards.next_page_url" class="btn btn-primary" @click="changePage('next_page_url')">Next</button></li>
      </ul>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
  export default {
    name: "Posts",
    data() {
      return {
        cards: {
            posts: null,
            next_page_url: null,
            prev_page_url: null,
        }
      }
    },
    created() {
      this.getPosts('http://127.0.0.1:8000/api/v1/posts');
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
                this.cards.next_page_url = result.data.results.next_page_url;
                this.cards.prev_page_url = result.data.results.prev_page_url;
            });

            console.log(this.cards);
        }
    }
  }
</script>

<style lang="scss" scoped>
</style>
