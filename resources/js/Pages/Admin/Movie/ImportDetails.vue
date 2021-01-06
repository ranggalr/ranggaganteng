<template>
    <admin-layout>
        <template #header>
            <inertia-link :href="route('admin.movie.import')" class="inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-left w-6 h-6">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Back
            </inertia-link>
        </template>
        <div class="my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8 w-full">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg mx-7 pb-2">
                <!-- component -->
                <section class="text-gray-700 body-font overflow-hidden bg-white" v-if="data != null && casts != null">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="lg:w-4/5 mx-auto flex flex-wrap">
                            <img :alt="data.original_title"
                                class="lg:w-1/2 h-1/2 w-full object-cover object-center rounded border border-gray-200"
                                :src="'https://image.tmdb.org/t/p/original' + data.poster_path">
                            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                <h2 class="text-sm title-font text-gray-500 tracking-widest">Movie Details</h2>
                                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ data.original_title }}
                                </h1>
                                <div class="flex mb-4">
                                    <span class="flex items-center">
                                        <span class="text-gray-600 mr-1">{{ data.vote_average }}</span>
                                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                        </svg>
                                    </span>
                                    <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                                        <a class="text-gray-500">
                                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path
                                                    d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a class="ml-2 text-gray-500">
                                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path
                                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a class="ml-2 text-gray-500">
                                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path
                                                    d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                                </path>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                                <p class="leading-relaxed">{{ data.overview }}</p>
                                <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                                    <div class="flex">
                                        <span class="mr-3">Genre : {{ data.genres.map(e => e.name).join(',') }}</span>
                                    </div>
                                    <div class="flex ml-6 items-center">
                                        <span class="mr-3">Loaded {{ casts.length }} casts</span>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button
                                        class="flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded" @click="importData">Import</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <p v-else>Loading...</p>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    export default {
        components: {
            AdminLayout,
        },
        props: {
            tmdb_id: String
        },
        data() {
            return {
                data: null,
                casts: null,
                trailer: null,
            }
        },
        created() {
            this.searchData()
        },
        methods: {
            searchData() {
                axios.get('https://api.themoviedb.org/3/movie/' + this.tmdb_id +
                    '?api_key=87acf0e0e21f306edb333f97605718f0').then(resp => {
                    this.data = resp.data
                })
                axios.get('https://api.themoviedb.org/3/movie/' + this.tmdb_id + '/credits?api_key=87acf0e0e21f306edb333f97605718f0').then(resp => {
                    this.casts = resp.data.cast
                })
                axios.get('https://api.themoviedb.org/3/movie/' + this.tmdb_id + '/videos?api_key=87acf0e0e21f306edb333f97605718f0').then(resp => {
                    this.trailer = resp.data.results.filter(v => v.type == 'Trailer' && v.site == 'YouTube')[0]
                })
            },
            importData() {
                let data = {
                    title: this.data.original_title,
                    description: this.data.overview,
                    rating: this.data.vote_average,
                    genre: this.data.genres.map(e => e.name),
                    poster_path: this.data.poster_path,
                    release_date: this.data.release_date,
                    cast: this.casts.map(e => {
                        const container = {}
                        container.name = e.name
                        container.gender = (e.gender == 1) ? 'female' : (e.gender == 2) ? 'male' : 'not specified'
                        container.profile_path = e.profile_path
                        return container
                    }),
                    duration: this.data.runtime,
                    trailer_link: 'https://youtube.com/watch?v=' + this.trailer.key
                }
                this.$inertia.post(route('admin.movie.import.store', {tmdb:this.tmdb_id}), data, {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        if(Object.keys(page.props.errors).length == 0)
                        {
                            this.$swal({
                                icon: 'success',
                                title: 'HOORAY!',
                                text: 'Movie successfully imported'
                            })
                        }
                        else
                        {
                            this.$swal({
                                icon: 'error',
                                title: 'Oops!',
                                html: Object.values(page.props.errors.storeRole).map((v) => { return '<li>' + v + '</li>'}).join('')
                            })
                        }
                    }
                })
            }
        }
    }

</script>
