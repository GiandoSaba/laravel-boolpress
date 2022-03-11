<template>
  <div>
    <div class="row row-cols-6 g-4" v-if="post">
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
</template>

<script>
import Axios from "axios";
  export default {
    name: 'Post',
    props: ['id'],
    data() {
      return {
        post: null
      }
    },
    created() {
      const url = 'http://127.0.0.1:8000/api/v1/post/' + this.id;
      this.getPost(url);
    },
    methods: {
      getPost(url){
          Axios.get(url, {headers: {'Authorization': 'Bearer m456ks95lo0sda34'}})
          .then(
            (result) => {
              console.log(result);
              this.post = result.data.results.data;
            }).catch(error => console.log(error));
      }
    }
  }
</script>

<style lang="scss">
</style>
