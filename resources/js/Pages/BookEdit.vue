<script setup>
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    book:Object
});

onMounted(() => {
    form.name = props.book.name;
    form.description=props.book.description;
    form.barcode=props.book.barcode;
    form.artist_id=props.book.artist_id;
});

const form = useForm({
   name: '',
   description: '',
   barcode: '',
   artist_id: '',
});

const submit = () => {
    form.post(route('book.update', props.book.id))
}

</script>

<template>
  <section class="min-h-screen flex items-center justify-center bg-black">
    <div class="bg-opacity-80 bg-gray-900 p-8 rounded-lg shadow-2xl w-full max-w-md">
      <h1 class="text-3xl font-bold text-white text-center mb-6">Modificar dades del llibre</h1>

      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label for="name" class="block text-sm font-semibold text-gray-400 mb-2">Títol</label>
          <input 
            v-model="form.name"
            id="name" 
            type="text" 
            required
            class="w-full p-3 rounded bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600"
            placeholder="Escriu el títol del llibre"
          />
        </div>

        <div>
          <label for="description" class="block text-sm font-semibold text-gray-400 mb-2">Descripció</label>
          <textarea 
            v-model="form.description"
            id="description" 
            rows="4"
            required
            class="w-full p-3 rounded bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600"
            placeholder="Escriu una descripció del llibre"
          ></textarea>
        </div>

        <div>
          <label for="barcode" class="block text-sm font-semibold text-gray-400 mb-2">Codi de barres</label>
          <textarea 
            v-model="form.barcode"
            id="barcode" 
            rows="1"
            required
            class="w-full p-3 rounded bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600"
            placeholder="Escriu el codi de barres del llibre"
          ></textarea>
        </div>

        <button
          type="submit"
          class="w-full bg-red-600 hover:bg-red-700 transition-colors text-white font-bold py-3 rounded text-lg"
        >
          Afegir llibre
        </button>
      </form>

      <p class="text-gray-400 text-center text-sm mt-6">
        Tornar a <a href="/books" class="text-red-500 hover:underline ml-1">llista de llibres</a>
      </p>
    </div>
  </section>
</template>
