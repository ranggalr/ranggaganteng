<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Watching {{ movie.data.title }}
            </h2>
        </template>

        <div class="py-8">
            <div class="container mx-auto bg-white rounded-lg shadow-lg">
                <div class="flex justify-center">
                    <video controls width="768" height="576" :src="currentSource"></video>
                </div>
                <div class="justify-center flex">
                    <button v-for="source in movie.sources" :key="'source-' + source.id" @click="changeSource(source)" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 mt-4 mx-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">{{ source.name }}</button>
                </div>
                <section class="text-gray-700 body-font overflow-hidden">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="lg:w-4/5 mx-auto flex flex-wrap">
                            <img :alt="movie.data.title"
                                class="lg:w-1/2 h-1/2 w-full object-cover object-center rounded border border-gray-200"
                                :src="'https://image.tmdb.org/t/p/original' + movie.data.poster_path">
                            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                <h2 class="text-sm title-font text-gray-500 tracking-widest">Movie Details</h2>
                                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ movie.data.title }}
                                </h1>
                                <div class="flex mb-4">
                                    <span class="flex items-center">
                                        <span class="text-gray-600 mr-1">{{ movie.data.rating }}</span>
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
                                <p class="leading-relaxed">{{ movie.data.description }}</p>
                                <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                                    <div class="flex">
                                        <span class="mr-3">Genre : </span>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button
                                        class="flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">Import</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="container mx-auto mt-4">
                <div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
                    <div class="flex justify-between items-center">
                        <span class="font-light text-gray-600">Add a new comment</span>
                    </div>
                    <div class="mt-2">
                        <div class="w-full md:w-full px-3 mb-2 mt-2">
                            <textarea
                                class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                                name="body" placeholder='Type Your Comment' required></textarea>
                        </div>
                        <div class="-mr-1">
                            <input type="submit"
                                class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100"
                                value='Post Comment'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props: {
            movie: Object,
        },
        data() {
            return {
                currentSource: null,
                form: null
            }
        },
        created() {
            if(this.movie.sources.length) {
                this.currentSource = this.movie.sources[0].url
            }
            else
            {
                this.$inertia.get(route('503'))
            }
        },
        methods: {
            changeSource(source)
            {
                this.currentSource = source.url
                console.log(this.currentSource)
            }
        }
    }

</script>
