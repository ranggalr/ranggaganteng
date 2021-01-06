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
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col mx-4 my-4">
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Title
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="form.error('name') ? 'border-red-500' : ''"
                        id="grid-first-name" type="text" v-model="form.title" placeholder="Jane">
                    <p class="text-red-500 text-xs italic" v-if="form.error('title')">{{ form.error('title') }}</p>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-3/4 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-password">
                        Description
                    </label>
                    <textarea
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="form.error('password') ? 'border-red-500' : ''"
                        id="grid-password" type="password" rows="10" v-model="form.description" placeholder="******************"></textarea>
                    <p class="text-red-500 text-xs italic" v-if="form.error('password')">{{ form.error('password') }}</p>
                    <p class="text-grey-dark text-xs italic" v-else>Make it as long and as crazy as you'd like</p>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Rating
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="form.error('rating') ? 'border-red-500' : ''"
                        id="grid-first-name" type="text" v-model="form.rating" placeholder="Jane">
                    <p class="text-red-500 text-xs italic" v-if="form.error('rating')">{{ form.error('rating') }}</p>
                </div>
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Poster Path
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="form.error('poster_path') ? 'border-red-500' : ''"
                        id="grid-first-name" type="text" v-model="form.poster_path" placeholder="Jane">
                    <p class="text-red-500 text-xs italic" v-if="form.error('poster_path')">{{ form.error('poster_path') }}</p>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Duration
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="form.error('duration') ? 'border-red-500' : ''"
                        id="grid-first-name" type="text" v-model="form.duration" placeholder="Jane">
                    <p class="text-red-500 text-xs italic" v-if="form.error('duration')">{{ form.error('duration') }}</p>
                </div>
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Release Date
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="form.error('release_date') ? 'border-red-500' : ''"
                        id="grid-first-name" type="text" v-model="form.release_date" placeholder="Jane">
                    <p class="text-red-500 text-xs italic" v-if="form.error('release_date')">{{ form.error('release_date') }}</p>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Trailer Link
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="form.error('trailer_link') ? 'border-red-500' : ''"
                        id="grid-first-name" type="text" v-model="form.trailer_link" placeholder="Jane">
                    <p class="text-red-500 text-xs italic" v-if="form.error('trailer_link')">{{ form.error('trailer_link') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col mx-4 my-4">
            <div
                class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden px-12 mx-7">
                <div class="flex justify-end">
                    <button @click="addSourceModal"
                        class="px-3 py-2 my-auto border-green-500 border text-green-500 rounded transition duration-300 hover:bg-green-700 hover:text-white focus:outline-none">Add source</button>
                </div>
            </div>
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                            Name</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                            Quality</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                            Url</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr v-for="source in movie.sources" :key="source.id">
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-blue-900">{{ source.name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-blue-900">{{ source.quality }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-blue-900">{{ source.url }}</div>
                        </td>
                        <td
                            class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                            <inertia-link as="button" :href="route('admin.movie.edit', {movie: source.id})"
                                class="px-3 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">Edit</inertia-link>
                            <button
                                class="px-3 py-2 border-red-500 border text-red-500 rounded transition duration-300 hover:bg-red-500 hover:text-white focus:outline-none">Trash</button>
                        </td>
                    </tr>
                    <tr v-if="!movie.sources.length">
                        <td rowspan="3">No data available</td>
                    </tr>
                </tbody>
            </table>
            <div class="justify-end flex mt-10">
                <input type="submit" value="Edit" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
            </div>
        </div>
        <jet-dialog-modal :show="showAddSourceModal" @close="showAddSourceModal = false">
            <template #title>
                Add Source
            </template>

            <template #content>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="grid-first-name">
                            Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="newSourceForm.error('name') ? 'border-red-500' : ''"
                            id="grid-first-name" type="text" v-model="newSourceForm.name" placeholder="Jane">
                        <p class="text-red-500 text-xs italic" v-if="newSourceForm.error('name')">{{ newSourceForm.error('name') }}</p>
                    </div>
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="grid-first-name">
                            Quality
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="newSourceForm.error('quality') ? 'border-red-500' : ''"
                            id="grid-first-name" type="text" v-model="newSourceForm.quality" placeholder="720p">
                        <p class="text-red-500 text-xs italic" v-if="newSourceForm.error('quality')">{{ newSourceForm.error('quality') }}</p>
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="grid-first-name">
                            Url
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="newSourceForm.error('url') ? 'border-red-500' : ''"
                            id="grid-first-name" type="text" v-model="newSourceForm.url" placeholder="http://google.com">
                        <p class="text-red-500 text-xs italic" v-if="newSourceForm.error('url')">{{ newSourceForm.error('url') }}</p>
                    </div>
                </div>
            </template>

            <template #footer>
                <button class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" @click="showAddSourceModal = false">Close</button>
                <button class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline" @click="submitNewSource">Add</button>
            </template>
        </jet-dialog-modal>
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import JetDialogModal from '@/Jetstream/DialogModal'
    export default {
        components: {
            AdminLayout,
            JetDialogModal
        },
        data() {
            return {
                showAddSourceModal: false,
                form: this.$inertia.form({
                    title: this.movie.data.title,
                    description: this.movie.data.description,
                    poster_path: this.movie.data.poster_path,
                    release_date: this.movie.data.release_date,
                    rating: this.movie.data.rating,
                    duration: this.movie.data.duration,
                    trailer_link: this.movie.data.trailer_link
                }),
                newSourceForm: this.$inertia.form({
                    name: null,
                    quality: null,
                    url: null
                })
            }
        },
        props: {
            movie: Object
        },
        methods: {
            submitNewSource() {
                this.newSourceForm.post(route('admin.movie.source.store', {movie:this.movie.data.id}), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        if(Object.keys(page.props.errors).length == 0)
                        {
                            this.$swal({
                                icon: 'success',
                                title: 'HOORAY!',
                                text: 'Source successfully added'
                            })
                            this.showAddSourceModal = false
                        }
                    }
                })
            },
            addSourceModal()
            {
                this.showAddSourceModal = true
                console.log(this.showAddSourceModal)
            }
        }
    }

</script>
