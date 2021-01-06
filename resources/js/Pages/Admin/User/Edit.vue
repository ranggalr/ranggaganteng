<template>
    <admin-layout>
        <template #header>
            <inertia-link :href="route('admin.user.index')" class="inline-flex">
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
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Name
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" :class="form.error('name') ? 'border-red-500' : ''"
                        id="grid-first-name" type="text" v-model="form.name" placeholder="Jane">
                    <p class="text-red-500 text-xs italic" v-if="form.error('name')">{{ form.error('name') }}</p>
                </div>
                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-email">
                        Email
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" :class="form.error('email') ? 'border-red-500' : ''"
                        id="grid-email" type="email" v-model="form.email" placeholder="janedoe@gmail.com">
                    <p class="text-red-500 text-xs italic" v-if="form.error('email')">{{ form.error('email') }}</p>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-password">
                        Password
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" :class="form.error('password') ? 'border-red-500' : ''"
                        id="grid-password" type="password" v-model="form.password" placeholder="******************">
                    <p class="text-red-500 text-xs italic" v-if="form.error('password')">{{ form.error('password') }}</p>
                    <p class="text-grey-dark text-xs italic" v-else>Make it as long and as crazy as you'd like</p>
                </div>
            </div>
            <div class="-mx-3 md:flex mb-2">
                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-role">
                        Role
                    </label>
                    <div class="relative">
                        <select v-model="form.role"
                            class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" :class="form.error('role') ? 'border-red-500' : ''"
                            id="grid-role">
                            <option v-for="role in roles" :key="'role_' + role.id" :value="role.name">{{ role.name }}</option>
                        </select>
                        <p class="text-red-500 text-xs italic" v-if="form.error('role')">{{ form.error('role') }}</p>
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
    import AdminLayout from '../../../Layouts/AdminLayout.vue'
    export default {
        components: {
            AdminLayout,
        },
        props: {
            edited_user: Object,
            roles: Array,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.edited_user.name,
                    email: this.edited_user.email,
                    password: null,
                    role: this.edited_user.roles[0].name
                }, {
                    bag: 'updateUser',
                    resetOnSuccess: false
                })
            }
        },
        methods: {
            submitForm()
            {
                this.form.post(route('admin.user.update', {user: this.edited_user.id}), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        if(Object.keys(page.props.errors).length == 0)
                        {
                            this.$swal({
                                icon: 'success',
                                title: 'HOORAY!',
                                text: 'User successfully updated'
                            })
                        }
                    }
                })
            }
        }
    }

</script>
