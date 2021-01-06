<template>
    <div>
        <div class="min-h-screen flex justify-start bg-gray-100">
            <div class="flex w-full max-w-xs p-4 bg-white">
                <ul class="flex flex-col w-full">
                    <div class="p-5 bg-white top-0 w-1/2 mx-auto">
                        <img class="h-24 ml-1 w-24 rounded-full object-cover" :src="$page.user.profile_photo_url">
                        <div class="pt-2 border-t mt-5 w-full text-center text-xl text-gray-600">
                            {{ $page.user.name }}
                        </div>
                    </div>
                    <li class="my-px">
                        <inertia-link :href="route('admin.dashboard')" class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600" :class="route().current('admin.dashboard') ? 'bg-gray-100' : ''">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                    <path
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-3">Dashboard</span>
                        </inertia-link>
                    </li>
                    <li class="my-px">
                        <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">Account</span>
                    </li>
                    <li class="my-px">
                        <inertia-link :href="route('admin.user.index')"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100" :class="route().current('admin.user.*') ? 'bg-gray-100' : ''">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                    <path
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-3">Users</span>
                            <span
                                class="flex items-center justify-center text-sm text-gray-500 font-semibold bg-gray-200 h-6 px-2 rounded-full ml-auto">1k</span>
                        </inertia-link>
                        <inertia-link :href="route('admin.role.index')"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100" :class="route().current('admin.role.*') ? 'bg-gray-100' : ''">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg class="h-6 w-6"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />  <path d="M7 11V7a5 5 0 0 1 10 0v4" /></svg>
                                </svg>
                            </span>
                            <span class="ml-3">Roles</span>
                            <span
                                class="flex items-center justify-center text-sm text-gray-500 font-semibold bg-gray-200 h-6 px-2 rounded-full ml-auto">1k</span>
                        </inertia-link>
                    </li>
                    <li class="my-px">
                        <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">Blog</span>
                    </li>
                    <li class="my-px">
                        <inertia-link :href="route('admin.post.index')"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100" :class="route().current('admin.post.*') ? 'bg-gray-100' : ''">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg class="h-6 w-6"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="17" y1="10" x2="3" y2="10" />  <line x1="21" y1="6" x2="3" y2="6" />  <line x1="21" y1="14" x2="3" y2="14" />  <line x1="17" y1="18" x2="3" y2="18" /></svg>
                            </span>
                            <span class="ml-3">Posts</span>
                            <span
                                class="flex items-center justify-center text-sm text-gray-500 font-semibold bg-gray-200 h-6 px-2 rounded-full ml-auto">1k</span>
                        </inertia-link>
                    </li>
                    <li class="my-px">
                        <inertia-link :href="route('admin.category.index')"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100" :class="route().current('admin.category.*') ? 'bg-gray-100' : ''">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg class="h-6 w-6"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="8" y1="6" x2="21" y2="6" />  <line x1="8" y1="12" x2="21" y2="12" />  <line x1="8" y1="18" x2="21" y2="18" />  <line x1="3" y1="6" x2="3.01" y2="6" />  <line x1="3" y1="12" x2="3.01" y2="12" />  <line x1="3" y1="18" x2="3.01" y2="18" /></svg>
                            </span>
                            <span class="ml-3">Categories</span>
                            <span
                                class="flex items-center justify-center text-sm text-gray-500 font-semibold bg-gray-200 h-6 px-2 rounded-full ml-auto">1k</span>
                        </inertia-link>
                    </li>
                    <li class="my-px">
                        <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">Movies</span>
                    </li>
                    <li class="my-px">
                        <inertia-link :href="route('admin.movie.index')"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100" :class="route().current('admin.movie.*') ? 'bg-gray-100' : ''">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg class="h-6 w-6"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="4" width="16" height="16" rx="2" />  <line x1="8" y1="4" x2="8" y2="20" />  <line x1="16" y1="4" x2="16" y2="20" />  <line x1="4" y1="8" x2="8" y2="8" />  <line x1="4" y1="16" x2="8" y2="16" />  <line x1="4" y1="12" x2="20" y2="12" />  <line x1="16" y1="8" x2="20" y2="8" />  <line x1="16" y1="16" x2="20" y2="16" /></svg>                            </span>
                            <span class="ml-3">Movie</span>
                            <span
                                class="flex items-center justify-center text-sm text-gray-500 font-semibold bg-gray-200 h-6 px-2 rounded-full ml-auto">1k</span>
                        </inertia-link>
                    </li>
                    <li class="my-px">
                        <inertia-link :href="route('admin.category.index')"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100" :class="route().current('admin.category.*') ? 'bg-gray-100' : ''">
                            <span class="flex items-center justify-center text-lg text-gray-400">
                                <svg class="h-6 w-6"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="7" r="4" />  <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            </span>
                            <span class="ml-3">Cast</span>
                            <span
                                class="flex items-center justify-center text-sm text-gray-500 font-semibold bg-gray-200 h-6 px-2 rounded-full ml-auto">1k</span>
                        </inertia-link>
                    </li>
                    <li class="my-px">
                        <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">Other</span>
                    </li>
                    <li class="my-px">
                        <a href="#"
                            class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100">
                            <span class="flex items-center justify-center text-lg text-red-400">
                                <svg class="h-6 w-6"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />  <polyline points="16 17 21 12 16 7" />  <line x1="21" y1="12" x2="9" y2="12" /></svg>
                            </span>
                            <span class="ml-3">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="w-full">
                <header class="bg-white">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header"></slot>
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <slot></slot>
                </main>
            </div>
        </div>
        <portal-target name="modal" multiple>
        </portal-target>
    </div>
</template>

<script>
    export default {
        components: {
            //
        },
    }

</script>
