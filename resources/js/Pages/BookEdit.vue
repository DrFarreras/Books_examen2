<script setup>
import { onMounted, ref } from 'vue';   //se usa onMounted para rellenar los inputs con los datos, jejejeje
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({ //creamos un props con la variable del controller en este caso 'book' em el return inertia::Render('Book',['book'=>$book]) es el segundo
  book:Object,              //definimos que es un objeto
  allGenders:Array,
});

const form = useForm({      //creamos el useForm para definir los campos del formulario. SIEMPRE EL useForm delante del onMounted ya que se crea primero y asi evitamos problemas de que se rellenen los campos como cuando no me acuerdo y tengo que recargar dos veces
   name: '',
   description: '',
   barcode: '',
   artist_id: '',
   gender: [],
});


onMounted(() => {           //creamos el onMounted para rellenar los inputs con los datos
    form.name = props.book.name || "";              //definimos que form.name es = que el name de props de book y si no encuentra relleno ese campo no pone nada asi deja que se rellenen los demas campos
    form.description=props.book.description || "";  //definimos que form.description es = que el description de props de book y si no encuentra relleno ese campo no pone nada asi deja que se rellenen los demas campos
    form.barcode=props.book.barcode || "";          //definimos que form.barcode es = que el barcode de props de book y si no encuentra relleno ese campo no pone nada asi deja que se rellenen los demas campos
    form.artist_id=props.book.artist_id || "";      //definimos que form.artist_id es = que el artist_id de props de book y si no encuentra relleno ese campo no pone nada asi deja que se rellenen los demas campos
    form.gender=props.book.gender.map(g => g.id) || ""; //definimos que form.gender es = que el gender.map(y le pasamos su id) de props de book y si no encuentra relleno ese campo no pone nada asi deja que se rellenen los demas campos
});

console.log(props.book);

const submit = () => {      //creamos una funcion submit 
    form.post(route('book.update', props.book.id))  //usa método post del formulario, cogiendo la info de los inputs y ejecuta la función update según el id pasado por props.book.id
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
        <!-- en v-model se escribe el form. y la const que hemos definido en const form, por ejemplo form.name -->
        <!-- el label for=' ' sirve para que al pulsar sobre el titulo se seleccione el input, se enlaza en el input por el id=' ', por ejemplo el titulo con label for='name' se enlaza con el input id='name' -->

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
        <!-- el label for=' ' sirve para que al pulsar sobre el titulo se seleccione el input, se enlaza en el input por el id=' ', por ejemplo el titulo con label for='description' se enlaza con el input id='description' -->

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

        <div>
          <label for="gender" class="block text-sm font-semibold text-gray-400 mb-2">Gènere</label>
          <select 
            v-model="form.gender"
            id="gender" 
            multiple
            required
            class="w-full p-3 rounded bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600">
            
            <option v-for="g in props.allGenders" :key="g.id" :value="g.id">
              {{ g.name }}
            </option>
          </select>
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
