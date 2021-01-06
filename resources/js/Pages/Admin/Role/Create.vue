<template>
    <admin-layout>
        <template #header>
            <inertia-link :href="route('admin.role.index')" class="inline-flex">
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
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Name
                    </label>
                    <input
                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-2"
                        id="grid-first-name" type="text" v-model="form.name" placeholder="Jane">
                </div>
            </div>
        </div>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col mx-4 my-4">
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                        for="grid-first-name">
                        Permissions
                        <label class="flex items-center mt-3">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-500" v-model="selectAll"><span class="ml-2">Select All</span>
                        </label>
                    </div>
                    <label class="flex items-center mt-3" v-for="perm in permissions" :key="perm.id">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-500" v-model="form.permissions" :value="perm.id"><span class="ml-2">{{ perm.name }}</span>
                    </label>
                </div>
            </div>
            <div class="justify-end flex">
                <input type="submit" value="Create" @click="submitForm" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
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
            permissions: Array
        },
        data() {
            return {
                form: {
                    name: null,
                    permissions: []
                }
            }
        },
        methods: {
            submitForm()
            {
                this.$inertia.post(route('admin.role.store'), this.form , {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        if(Object.keys(page.props.errors).length == 0)
                        {
                            this.$swal({
                                icon: 'success',
                                title: 'HOORAY!',
                                text: 'Role successfully created'
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
        },
        computed: {
            selectAll: {
                get: function () {
                    return this.permissions ? this.form.permissions.length == this.permissions.length : false;
                },
                set: function (value) {
                    var selected = [];

                    if (value) {
                        this.permissions.forEach(function (user) {
                            selected.push(user.id);
                        });
                    }

                    this.form.permissions = selected;
                }
            }
        }
    }

</script>
