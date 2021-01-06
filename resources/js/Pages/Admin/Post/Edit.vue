<template>
    <admin-layout>
        <template #header>
            <inertia-link :href="route('admin.post.index')" class="inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-left w-6 h-6">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Back
            </inertia-link>
        </template>
        <!-- component -->
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col mx-4 my-4">
            <div class="-mx-3 md:flex mb-6">
                <div class="px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Title
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="form.error('title') ? 'border-red-500' : ''"
                        id="grid-first-name" type="text" v-model="form.title" placeholder="Harry Potter and The Blessed Child">
                    <p class="text-red-500 text-xs italic" v-if="form.error('title')">{{ form.error('title') }}</p>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-description">
                        Description
                    </label>
                    <textarea
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" :class="form.error('description') ? 'border-red-500' : ''"
                        id="grid-description" v-model="form.description" placeholder="Some bullshit">
                    </textarea>
                    <p class="text-red-500 text-xs italic" v-if="form.error('description')">{{ form.error('description') }}</p>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-password">
                        Body
                    </label>
                    <editor apiKey="eeqcuhjt2l487w3xndf2kcsrolwq0rsexhsj9pfqvf6k97rs" v-model="form.body"
                        initialValue="<p>Ngebacot disini bro</p>"
                        :init="{
                        height: 500,
                        width: 750,
                        menubar: false,
                        plugins: [
                            'advlist autolink lists link image charmap',
                            'searchreplace visualblocks code fullscreen',
                            'print preview anchor insertdatetime media',
                            'paste code help wordcount table'
                        ],
                        toolbar:
                            'undo redo | formatselect | bold italic | \
                            alignleft aligncenter alignright | \
                            bullist numlist outdent indent | help | code'
                        }"
                    ></editor>
                    <p class="text-red-500 text-xs italic" v-if="form.error('body')">{{ form.error('body') }}</p>
                    <p class="text-grey-dark text-xs italic" v-else>Make it as long and as crazy as you'd like</p>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-2">
                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-role">
                        Category
                    </label>
                    <div class="relative">
                        <select v-model="form.category"
                            class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" :class="form.error('category') ? 'border-red-500' : ''"
                            id="grid-role">
                            <option disabled>Select category</option>
                            <option v-for="category in categories" :key="'category_' + category.id" :value="category.name">{{ category.name }}</option>
                        </select>
                        <p class="text-red-500 text-xs italic" v-if="form.error('category')">{{ form.error('category') }}</p>
                    </div>
                </div>
            </div>
            <div class="justify-end flex">
                <input type="submit" @click="submitForm" value="Edit" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import Editor from '@tinymce/tinymce-vue'
    import AdminLayout from '../../../Layouts/AdminLayout.vue'
    export default {
        components: {
            AdminLayout,
            Editor
        },
        props: {
            categories: Array,
            post: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    title: this.post.data.title,
                    description: this.post.data.description,
                    body: this.post.data.body,
                    category: this.post.category.name,
                }, {
                    bag: 'storePost',
                    resetOnSuccess: true,
                })
            }
        },
        methods: {
            submitForm()
            {
                this.form.post(route('admin.post.update', {post: this.post.data.id}), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        if(Object.keys(page.props.errors).length == 0)
                        {
                            this.$swal({
                                icon: 'success',
                                title: 'HOORAY!',
                                text: 'Post successfully updated'
                            })
                        }
                    }
                })
            }
        }
    }

</script>
