<template>
    <div class="mt-2 w-75  overflow-auto" v-if="Paginate.page_count > 1">
        <nav aria-label="Page navigation  example">
            <ul class="pagination bg-info bg-gradien d-flex justify-content-center">
                <li v-for="n in Paginate.page_count" v-bind:class="Paginate.current_page == n ? 'active' : '' " v-on:click="gotoPage(n)" class="page-item"><a class="page-link" >{{n}}</a></li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    computed:{
        Paginate(){
            return this.items.data.movies.paginate;
        }
    },
    props:{
        items:{}
    },
    methods:{
        gotoPage(page) {
            if (page != this.Paginate.current_page)
                this.emitter.emit("changePage", page);
        }
    }
}
</script>

<style scoped>

</style>
