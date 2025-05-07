<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({ //creamos un props con la variable del controller en este caso 'book' em el return inertia::Render('Book',['book'=>$book]) es el segundo 
  book: Object,             //definimos que es un objeto
});

console.log(props.book);


</script>

<template>
      <section class="min-h-screen flex items-center justify-center bg-black">
        <div class="bg-opacity-80 bg-gray-900 p-8 rounded-lg shadow-2xl w-full max-w-md">
          <div class="flex flex-col md:flex-row items-center gap-8">

        <!-- Informació del llibre -->
        <div class="w-full md:w-2/3 text-white">
          <h1 class="text-4xl font-bold mb-4">{{ props.book.name }}</h1>

          <div class="mt-6">
            <h2 class="text-2xl font-semibold underline mb-2">Descripció</h2>
            <p class="text-white">{{ props.book.description || 'No hi ha descripció disponible.' }}</p>
          </div>

          <p class="text-white mt-6 mb-2">
            <span class="font-semibold text-white">Codi de barres:</span> {{ props.book.barcode || 'No disponible' }}
          </p>

          <p class="text-white mt-6 mb-2">
            <span class="font-semibold text-white">Nom de l'artista:</span> {{ props.book.artist.name || 'No disponible' }}
          </p>

          <p class="text-white mt-6 mb-2">
            <span class="font-semibold text-white">Gènere: {{ props.book.gender[0].name || 'No disponible' }}</span> 
          </p>

          <div class="mt-8 flex gap-4">
            <a href="/books" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition">
              Tornar
            </a>
            <Link :href="`/books/edit/${props.book.id}`" class="mt-4 block text-center bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded-full font-bold transition-colors">Editar el llibre</Link>

          </div>
        </div>

      </div>
    </div>
  </section>
</template>
