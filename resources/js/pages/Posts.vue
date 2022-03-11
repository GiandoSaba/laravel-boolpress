<template>
  <div class="container-fluid">
    <div class="row search mb-3 p-3 bg-light">
        <div class="col-12">
            <form>
                <h2>Search</h2>
                <div class="row">
                    <div class="mb-3 col-2">Order By Column
                        <select class="form-select form-select" name="orderbycolumn" id="orderbycolumn" v-model="form.orderbycolumn">
                            <option value="title">Title</option>
                            <option value="created_at">Created</option>
                            <option value="updated_at">Updated</option>
                        </select>
                    </div>
                    <div class="mb-3 col-2">Order By Versus
                        <select class="form-select form-select" name="orderbysort" id="orderbysort" v-model="form.orderbysort">
                            <option value="asc">Asc</option>
                            <option value="desc">Desc</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">Tags
                        <div class="d-flex align-items-center justify-content-between">
                            <div :key="'tag-' + index" v-for="(tag, index) in tags">
                                <input type="checkbox" name="tags[]" :value="tag.name" v-model="form.tags">
                                <label :for="tag.name">{{tag.name}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <input class="btn btn-info" type="button" value="filtra" @click.prevent="searchPosts">
                    </div>
                </div>
            </form>
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
        tags: [],
        form: {
            orderbycolumn: 'title',
            orderbysort: 'desc',
            tags: []
        },
        cards: {
            posts: null,
            next_page_url: null,
            prev_page_url: null,
        }
      }
    },
    created() {
      this.getPosts('http://127.0.0.1:8000/api/v1/posts');
      this.getTags();
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
        },
        searchPosts() {
                const url = 'http://127.0.0.1:8000/api/v1/posts/search';
                Axios.get(url, {
                    params: this.form
                }).then(
                    (result) => {
                        console.log(result);
                        this.cards.posts = result.data.results.data;
                        this.cards.next_page_url = result.data.results.next_page_url;
                        this.cards.prev_page_url = result.data.results.prev_page_url;
                    });
            },
            getTags() {
                const url = 'http://127.0.0.1:8000/api/v1/tags';
                Axios.get(url).then(
                    (result) => {
                        console.log(result);
                        this.tags = result.data.results.data;
                    });
            }
    }
  }
</script>

<style lang="scss" scoped>
</style>
