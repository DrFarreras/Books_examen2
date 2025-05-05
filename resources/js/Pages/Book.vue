<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  book: Object,
});
</script>

<template>
  <section class="min-h-screen flex items-center justify-center bg-black p-6">
    <div class="bg-opacity-80 bg-gray-900 p-8 rounded-lg shadow-2xl w-full max-w-3xl">
      <div class="flex flex-col md:flex-row items-center gap-8">

        <!-- Informació del llibre -->
        <div class="w-full md:w-2/3 text-white">
          <h1 class="text-4xl font-bold mb-4">{{ book.name }}</h1>

          <p class="text-gray-400 mb-2">
            <span class="font-semibold text-gray-300">Autor:</span> {{ book.artist_id || 'Desconegut' }}
          </p>

          <p class="text-gray-400 mb-2">
            <span class="font-semibold text-gray-300">Codi de barres:</span> {{ book.barcode || 'No disponible' }}
          </p>

          <div class="mt-6">
            <h2 class="text-2xl font-semibold underline mb-2">Descripció</h2>
            <p class="text-gray-300">{{ book.description || 'No hi ha descripció disponible.' }}</p>
          </div>

          <div class="mt-8 flex gap-4">
            <a href="/books" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition">
              Tornar
            </a>
            <Link :href="`/books/edit/${book.id}`" class="mt-4 block text-center bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded-full font-bold transition-colors">Editar el llibre</Link>

          </div>
        </div>

      </div>
    </div>
  </section>
</template>
