<template>
    <main>
        <h1>MOVIE SEARCH</h1>

        <div class="SearchBox">
            <input type="text" v-model="query" v-on:change="resetPage" class="SearchBox-input" placeholder="name...">

            <button v-on:click="search" class="SearchBox-button">
                <i class="SearchBox-icon  material-icons">search</i>
            </button>
        </div>
        <template v-if="loader">
            <div style="width: 3rem; height: 3rem;" class="spinner-border text-primary mt-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </template>
        <template v-else>
            <searchItems v-if="response" :items="response"></searchItems>
        </template>
        <pagination v-if="response" :items="response"></pagination>
    </main>
</template>

<script>
import searchItems from "./SearchItems.vue";
import Pagination from "./Pagination.vue";
import config from "../Config/config";

export default {
    name: "Search",
    data() {
        return {
            response: null,
            query: '',
            page: 1,
            loader:false
        }
    },
    methods:{
        search() {
            this.loader = true;
            this.$http.post(`${config.API_MOVIES}movies`,{
                'q': this.query,
                'page': this.page
            }).then((response) => {
                this.response = response.data;
            }).catch(err => {
                // handle errors
            }).finally(() => {
                this.loader = false
            });
        },
        resetPage() {
            this.page = 1;
        }
    },
    mounted() {
        this.emitter.on("changePage", page => {
            this.page = page;
            this.search();
        });
    },
    components: {
        searchItems , Pagination
    }
}
</script>

<style scoped>

</style>
