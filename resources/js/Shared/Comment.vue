<template>
    <div class="">
        <div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <span
                    class="font-light text-gray-600">{{ moment(comment.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</span>
                <a class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500"
                    href="#">{{ comment.user.roles[0].name }}</a>
            </div>
            <div class="mt-2">
                <p class="mt-2 text-gray-600">{{ comment.body }}</p>
            </div>
            <div class="flex justify-between items-center mt-4">
                <div class="items-center">
                    <button @click="toggle(comment.id)" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 mt-4 -mx-4 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">Reply</button>
                </div>
                <div>
                    <a class="flex items-center" href="#">
                        <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block"
                            :src="comment.user.profile_photo_url"
                            alt="avatar">
                        <h1 class="text-gray-700 font-bold">{{ comment.user.name }}</h1>
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md" v-if="isCurrent" v-show="isOpen">
            <div class="flex justify-between items-center">
                <span class="font-light text-gray-600">Reply to this comment</span>
            </div>
            <div class="mt-2">
                <div class="w-full md:w-full px-3 mb-2 mt-2">
                    <textarea
                        class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                        name="body" v-model="form.body" placeholder='Type Your Comment' required></textarea>
                    <p v-if="form.error('body')" class="text-red-500">{{ form.error('body') }}</p>
                </div>
                <div class="-mr-1">
                    <input type="submit" @click="submitComment()"
                        class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100"
                        value='Post Comment'>
                </div>
            </div>
        </div>
        <div v-if="comment.replies.length">
            <comment class="ml-6" v-for="reply in comment.replies" :key="'comment_' + reply.id" :comment="reply" :current="current" @setCurrent="replyComment(reply.id)" />
        </div>

    </div>
</template>


<script>

export default {
    components: {
        Comment: () => import('@/Shared/Comment')
    },
    props: {
        comment: {
            Type: Object
        },
        current: {
            Type: Number,
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                body: null
            }, {
                resetOnSuccess: true,
                bag: 'storeRepliedComment'
            }),
            replyToComment: false,
            isOpen: false
        }
    },
    methods: {
        submitComment()
        {
            //
        },
        setCurrentToParent(id)
        {
            this.$emit('setCurrent', id)
        },
        replyComment(id)
        {
            console.log(id)
            this.setCurrentToParent(id)
        },
        toggle(id)
        {
            this.isOpen = !this.isOpen
            this.replyComment(id)
        }
    },
    computed: {
        isCurrent: function() {
            return this.current == this.comment.id
        }
    }
}
</script>
