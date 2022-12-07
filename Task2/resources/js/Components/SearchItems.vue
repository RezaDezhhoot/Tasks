<template>
    <div class="row  d-flex justify-content-center align-items-center mt-4 w-100">
        <div class="col-12 ">
            <div class="card bg-info bg-gradient bg-none rounded-3">
                <div class="card-body">
                    <table class="table mb-4 text-light">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">poster</th>
                            <th scope="col">title</th>
                            <th scope="col">year</th>
                            <th scope="col">country</th>
                            <th scope="col">imdb rating</th>
                            <th scope="col">genres</th>
                        </tr>
                        </thead>
                        <tbody>
                        <transition-group
                            appear
                            type="animation"
                            name="fade"
                            enter-active-class="animate__animated animate__fadeInUp"
                            mode="out-in"
                        >
                        <tr v-for="(item , key) in Items" :key="item.id">
                            <td>{{key + 1}}</td>
                            <td><img class="image-list" v-bind:src="item.poster" alt=""></td>
                            <td>{{item.title}}</td>
                            <td>{{item.year}}</td>
                            <td>{{item.country}}</td>
                            <td>{{item.imdb_rating}}</td>
                            <td>
                                <span v-for="genres in item.genres" class="badge badge-warning m-1">
                                    {{genres}}
                                </span>
                            </td>
                        </tr>
                        </transition-group>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SearchItems",
    computed:{
        Items() {
            return this.items.data.movies.items;
        }
    },
    props:{
        items:{}
    }
}
</script>

<style scoped>

</style>
