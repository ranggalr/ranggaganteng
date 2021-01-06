<template>
    <admin-layout>
        <template #header>
            <inertia-link :href="route('admin.movie.index')" class="inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-left w-6 h-6">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Back
            </inertia-link>
        </template>
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8 w-full">
            <div
                class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12 mx-7 mt-5">
                <div class="flex justify-center">
                    <div class="inline-flex border rounded w-7/12 px-2 lg:px-6 h-12 bg-transparent">
                        <div class="flex flex-wrap items-stretch w-full h-full mb-6 relative">
                            <div class="flex">
                                <span
                                    class="flex items-center leading-normal bg-transparent rounded rounded-r-none border border-r-0 border-none lg:px-3 py-2 whitespace-no-wrap text-grey-dark text-sm">
                                    <svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z"
                                            stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text"
                                class="flex-shrink flex-grow flex-auto leading-normal tracking-wide w-px flex-1 border border-none border-l-0 rounded rounded-l-none px-3 relative focus:outline-none text-xxs lg:text-xs lg:text-base text-gray-500 font-thin"
                                placeholder="Search" v-model="keyword" @keyup="searchAfterDebounce">
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg mx-7">
                <!-- component -->
                <div class="flex flex-wrap" v-if="data.length">
                    <div class="container mx-auto py-2 px-6" v-for="movie in data" :key="movie.id">
                        <div class="inline-grid max-w-xs sm:max-w-xs lg:max-w-lg lg:flex bg-white rounded-lg border shadow-lg pb-6 lg:pb-0">
                            <div class="w-full lg:w-1/3 lg:p-4">
                                <!-- <img src="img/profile.jpg" alt="profile picture" class="rounded-lg"> -->
                                <img :src="'https://image.tmdb.org/t/p/original' + movie.poster_path" alt="image" class="h-64 lg:h-full object-cover object-center w-full">
                            </div>

                            <div class="w-full lg:w-2/3 p-4">
                                <div class="inline-grid">
                                    <p class="work-sans font-semibold text-xl text-black">{{ movie.original_title }}</p>
                                    <p class="raleway text-sm my-4 text-black opacity-75">{{ movie.overview }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center -mt-8 rounded-b-lg max-w-xs lg:max-w-lg lg:-mt-8 lg:justify-end lg:pr-8 py-1">
                            <inertia-link as="button" :href="route('admin.movie.import.details', {tmdb: movie.id})" class="px-3 py-2 bg-green-500 my-auto border-green-500 border text-white rounded transition duration-300 hover:bg-green-700 focus:outline-none"><p class="work-sans font-semibold text-sm tracking-wide">Select</p></inertia-link>
                        </div>
                    </div>
                </div>
                <p v-else class="text-center mb-2">Type something</p>
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
        data() {
            return {
                keyword: '',
                data: [],
            }
        },
        methods: {
            searchAfterDebounce: _.debounce(function() {
                this.searchData()
            }, 500),
            searchData() {
                if(this.keyword.length > 2)
                {
                    axios.get('https://api.themoviedb.org/3/search/movie?api_key=87acf0e0e21f306edb333f97605718f0&query=' + this.keyword + '&page=1&include_adult=true').then(resp => {
                        this.data = resp.data.results
                    })
                }
            }
        }
    }

</script>
