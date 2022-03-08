<template>
  <div class="container">
    <div class="row">
      <div class="col-3 mt-2" v-for="(post, index) in posts" :key="index">
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
  </div>
</template>

<script>
import Axios from "axios";
  export default {
    name: "Main",
    data() {
      return {
        posts: null
      }
    },
    created() {
      this.getPosts('http://127.0.0.1:8000/api/posts');
    },
    methods: {
      getPosts(url){
          Axios.get(url).then(
            (result) => {
              this.posts = result.data.results.data;
            });
      }

    }
  }
</script>

<style lang="scss" scoped>
</style>

