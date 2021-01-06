<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="container mx-auto">
                <div>
                    <h1 class="text-2xl font-black text-gray-900 pb-6 px-6 md:px-12">
                        Movie List
                    </h1>
                </div>
                <div class="flex flex-wrap -ml-4" v-if="movies.data.length">
                    <div class="w-64 h-64 bg-gray-100 bg-cover ml-4 mb-4" v-for="movie in movies.data" :key="movie.id" :style="'background-image:url(https://image.tmdb.org/t/p/original' + movie.poster_path + ')'">
                        <div class="flex items-end w-full h-full" style="background-color:rgba(0,0,0,0.6)">
                            <div class="px-4 py-2">
                                <div class="mb-2">
                                    <inertia-link :href="route('movie.watch', {movie:movie.slug})" class="font-semibold leading-tight text-sm text-gray-100 hover:text-gray-100">
                                    {{ movie.title + ' ' + moment(movie.release_date).format('(YYYY)') }}
                                    </inertia-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p v-else>Tidak ada film yang tersedia</p>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Pagination from '@/Shared/Pagination.vue'

    export default {
        components: {
            AppLayout,
            Pagination,
        },
        props: {
            movies: Object,
        }
    }

</script>
