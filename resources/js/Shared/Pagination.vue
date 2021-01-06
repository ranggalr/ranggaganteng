<template>
    <div class="flex flex-col items-center my-12" v-if="data.total > 0 && data.last_page > 1"> <!-- Pagination -->
        <div class="flex text-gray-700">
            <inertia-link as="div" :href="(data.first_page_url) ? data.first_page_url : '#'" preserve-scroll
                class="h-12 w-12 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                <svg class="h-6 w-6"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="11 17 6 12 11 7" />  <polyline points="18 17 13 12 18 7" /></svg>
            </inertia-link>
            <inertia-link as="div" :href="(data.prev_page_url) ? data.prev_page_url : '#'" preserve-scroll
                class="h-12 w-12 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-left w-6 h-6">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </inertia-link>
            <div class="flex h-12 font-medium rounded-full bg-gray-200">
                <inertia-link preserve-scroll as="div" :href="data.path + '?page=' + page" v-for="page in data.last_page" :key="'page_' + page"
                    class="w-12 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in rounded-full" :class="(page == data.current_page) ? activeClass + ' text-white' : '' ">
                    {{ page }}
                </inertia-link>
            </div>
            <inertia-link as="div" :href="(data.next_page_url) ? data.next_page_url : '#'" preserve-scroll
                class="h-12 w-12 ml-1 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-right w-6 h-6">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </inertia-link>
            <inertia-link as="div" :href="(data.last_page_url) ? data.last_page_url : '#'" preserve-scroll
                class="h-12 w-12 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                <svg class="h-6 w-6"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"> <polyline points="13 17 18 12 13 7" />  <polyline points="6 17 11 12 6 7" /></svg>
            </inertia-link>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: Object,
        activeClass: {
            required: false,
            type: String,
            default: 'bg-teal-600'
        }
    }
}
</script>
