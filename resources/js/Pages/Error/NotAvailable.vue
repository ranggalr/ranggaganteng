<template>
    <!-- component -->


<div class="gradient text-white min-h-screen flex items-center">
  <div class="container mx-auto p-4 flex flex-wrap items-center">
    <div class="w-full md:w-5/12 text-center p-4">
      <img src="https://themichailov.com/img/not-found.svg" alt="Not Found" />
    </div>
    <div class="w-full md:w-7/12 text-center md:text-left p-4">
      <div class="text-6xl font-medium">503</div>
      <div class="text-xl md:text-3xl font-medium mb-4">
        Oops. This page will come very soon
      </div>
      <div class="text-lg mb-8">
        Feel free to contact us, if you think there's a problem.
      </div>
      <a :href="route('dashboard')" class="border border-white rounded p-4">Go Home</a>
    </div>
  </div>
</div>
</template>

<style scoped>
  .gradient {
    background-image: linear-gradient(135deg, #684ca0 35%, #1c4ca0 100%);
  }
</style>
