<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <main class="mt-10 ml-4 mr-4 mb-4">

                        <div class="mb-4 md:mb-0 w-full mx-auto relative">
                            <div class="px-4 lg:px-0">
                                <h2 class="text-4xl font-semibold text-gray-800 leading-tight">
                                    {{ post.title }}
                                </h2>
                                Categories : <a href="#" class="py-2 text-green-700 inline-flex items-center justify-center mb-2">
                                    {{ post.category.name }}
                                </a>
                            </div>

                            <img src="https://images.unsplash.com/photo-1587614387466-0a72ca909e16?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80"
                                class="w-full object-cover lg:rounded" style="height: 28em;" />
                        </div>

                        <div class="flex flex-col lg:flex-row lg:space-x-12">

                            <div class="px-4 lg:px-0 mt-12 text-gray-700 text-lg leading-relaxed w-full lg:w-3/4"
                                v-html="post.body">
                            </div>

                            <div class="w-full lg:w-1/4 m-auto mt-12 max-w-screen-sm">
                                <div class="p-4 border-t border-b md:border md:rounded">
                                    <div class="flex py-2">
                                        <img :src="post.user.profile_photo_url"
                                            class="h-10 w-10 rounded-full mr-2 object-cover" />
                                        <div>
                                            <p class="font-semibold text-gray-700 text-sm"> {{ post.user.name }} </p>
                                            <p class="font-semibold text-gray-600 text-xs"> {{ post.user.roles[0].name }} </p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 py-3">
                                        Mike writes about technology
                                        Yourself required no at thoughts delicate landlord it be. Branched dashwood do
                                        is
                                        whatever it.
                                    </p>
                                    <button
                                        class="px-2 py-1 text-gray-100 bg-green-700 flex w-full items-center justify-center rounded">
                                        Follow
                                        <i class='bx bx-user-plus ml-2'></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </main>
                </div>
                <div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
                    <div class="flex justify-between items-center">
                        <span class="font-light text-gray-600">Add a new comment</span>
                    </div>
                    <div class="mt-2">
                        <div class="w-full md:w-full px-3 mb-2 mt-2">
                            <textarea
                                class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                                name="body" v-model="form.body" placeholder='Type Your Comment' required></textarea>
                            <p v-if="form.error('body')" class="text-red-500">{{ form.error('body') }}</p>
                        </div>
                        <div class="-mr-1">
                            <input :disabled="commentLoading" type="submit" @click="submitComment()"
                                class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100"
                                value='Post Comment'>
                        </div>
                    </div>
                </div>
                <comment v-for="comment in comments.data" :key="'comment_' + comment.id" :comment="comment" :current="currentComment" @setCurrent="setCurrent" />
                <pagination :data="comments" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Pagination from '@/Shared/Pagination'
    import Comment from '@/Shared/Comment'
    export default {
        components: {
            AppLayout,
            Pagination,
            Comment
        },
        props: {
            post: Object,
            comments: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    body: null,
                    post_id: this.post.id
                }, {
                    bag: 'storeComment',
                    resetOnSuccess: true,
                }),
                commentLoading: false,
                currentComment: null,
            }
        },
        methods: {
            submitComment() {
                this.form.post(route('comment.store'), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        if(Object.keys(page.props.errors).length == 0)
                        {
                            this.$swal({
                                icon: 'success',
                                title: 'HOORAY!',
                                text: 'Comment successfully posted'
                            })
                        }
                    }
                })
            },
            setCurrent(id)
            {
                this.currentComment = id
            }
        },
    }

</script>
