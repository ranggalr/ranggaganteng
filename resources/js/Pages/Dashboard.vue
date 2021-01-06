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
                        My Blog
                    </h1>
                </div>
                <div class="flex flex-wrap px-6" v-if="posts.data.length">
                    <div class="w-full lg:w-1/2   md:px-4 lg:px-6 py-5" v-for="post in posts.data" :key="post.id">
                        <div class="bg-white hover:shadow-xl">
                            <div>
                                <img src="https://images.pexels.com/photos/956999/milky-way-starry-sky-night-sky-star-956999.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                    alt="" class="h-56 w-full border-white border-8">
                            </div>
                            <div class="px-4 py-4 md:px-10">
                                <h1 class="font-bold text-lg">
                                    {{ post.title }}
                                </h1>
                                <p class="py-4 break-all md:break-words">
                                    {{ post.description }}
                                </p>
                                <div class="flex flex-wrap pt-8">
                                    <div class="w-full text-sm font-medium opacity-75">
                                        Posted at {{ moment(post.created_at).format('MMMM Do YYYY, h:mm:ss a') }} by
                                        {{ post.user.name }} <br />
                                        Category : {{ post.category.name }}
                                    </div>
                                    <inertia-link :href="route('post.read', {post: post.slug})"
                                        class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 mt-4 -mx-4 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                                        Read more
                                    </inertia-link>
                                </div>
                            </div>
                            <pagination :data="posts" />
                        </div>
                    </div>
                </div>
                <div v-else>
                    Post tidak ada
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Pagination from '../Shared/Pagination.vue'

    export default {
        components: {
            AppLayout,
            Pagination,
        },
        props: {
            posts: Object,
        }
    }

</script>
