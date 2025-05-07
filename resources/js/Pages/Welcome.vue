<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue'

const props = defineProps({  //creamos un props con la variable del controller en este caso 'genderBook' en el return Inertia::render('Welcome',['genderBook'=>$book]);
  genderBook: Array,
  allBooks: Array,
  book: String,
}
);
console.log(props.allBooks);
const localPagination = ref({ ...props.allBooks });
const searchBookQuery = ref('');
const filterBook = ref('');

const filteredBookItems = computed(() => {
  return props.allBooks.filter(book => {
    const matchesQuery = book.name.toLowerCase().includes(searchBookQuery.value.toLowerCase());
    const matchesFilter=book.closed==filterBook.value;
    return matchesQuery;
  }

  )
})

console.log(props.genderBook);
// console.log(props.books);

const index = ref(0);

const textos = [
  '/pexels-pixabay-159213.jpg', //cambiar por texto si se quiere, en el caso de las imagenes, subirlas a la carpeta de public
  '/storage/app/public/image/2.png',
  '/storage/app/public/image/3.png',
  '/storage/app/public/image/4.png',
];

const next = () => {
  index.value = index.value + 1;
};

const prev = () => {
  index.value = index.value - 1;
};

function deleteBook(id) {  //creamos una funcion que borre un book pasándole la id
  if (confirm('Estas segur que vols eliminar aquest llibre?')) {    //si aceptamos el alert entonces...
    axios.delete(route('book.delete', id)).then(data => {       //ejecutamos la ruta book.delete pasándole el id
      console.log(data);    //muestra la info del book borrado por consola
      props.genderBook.splice(props.genderBook.findIndex(f => f.id === id), 1); //en los apuntes
    })
  }
}

</script>

<template>

  <Head title="Libros" />
  <section class="relative min-h-screen py-6 px-2 md:px-4 sm:py-10 bg-gray-50">
    <div class="w-full max-w-xl mx-auto p-4">
      <div class="relative">
        <img :src="textos[index]" class="text-center bg-red-200"></img>
        <!-- cambiar por  <p class="text-center">{{ textos[index] }}</p>  si es texto-->

        <div class="absolute top-1/2 left-0 transform -translate-y-1/2">
          <button @click="prev" class="bg-red-400 px-2 py-1 rounded shadow"><</button>
        </div>

        <div class="absolute top-1/2 right-0 transform -translate-y-1/2">
          <button @click="next" class="bg-red-400 px-2 py-1 rounded shadow">></button>
        </div>
      </div>

      <div class="flex justify-center gap-2 mt-2">
        <span v-for="(s, i) in slides" :key="i" class="w-2 h-2 rounded-full"
          :class="i === index ? 'bg-black' : 'bg-gray-400'"></span>
      </div>
    </div>

    <div class="text-center mb-10">
      <h1 class="text-4xl font-extrabold text-red-600 underline">Biblioteca</h1>
      <p class="text-lg text-gray-600 mt-2">Descobreix llibres increïbles 📚</p>
    </div>

    <div>
      <div class="h-full-screen bg-[#ffe4e4] p-6 rounded-lg shadow-lg mb-6">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <input v-model='searchBookQuery' @click="searchBookQuery = ''"
            @keydown.enter="searchBookQuery = ''" type="text" placeholder="Buscar llibres..."
            class="w-full px-4 py-2 border rounded-lg bg-[ff0000] text-black border-[ff0000] focus:outline-none focus:ring-2 focus:ring-[#5DA6C3]"
              aria-label="Buscar Llibres">
          </div>
        </div>
      </div>
    </div>

    <div class="w-full flex justify-center">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-screen-xl px-4">
        <div v-for="libro in (searchBookQuery ? filteredBookItems : props.genderBook.data)" :key="libro.id"
          class="bg-white border border-red-400 shadow-lg rounded-xl overflow-hidden hover:scale-105 transition-transform duration-300">
          <!--por cada libro en la array books (esto para que coja cada libro de la array, sino no sabe cual coger), y en key le decimos que es el id por libro.id-->
          <div class="p-6 flex flex-col justify-between h-full">
            <div>
              <h2 class="text-2xl font-bold mb-2 text-red-600">{{ libro.name }}</h2> <!--buscamos los datos de book-->
              <h2 class="text-2xl font-bold mb-2 text-red-600">Nom Artista: {{ libro.artist.name }}</h2>
              <!--buscamos los datos de artist ya que está relacionado con book-->
              <h3 class="text-md font-semibold text-gray-500 mb-4">Cognom Artista: {{ libro.artist.surname }}</h3>
              <h3 v-if="libro.gender && libro.gender.length > 0" class="text-md font-semibold text-gray-500 mb-4">
                Gènere: {{ libro.gender[0].name }}</h3>
              <!--Comprueba si libro.gender existe, y si es que si, luego mira que el array tenga más de 0 elementos, o sea que no esté vacío-->
              <h3 class="text-md font-semibold text-gray-500 mb-4">Barcode: {{ libro.barcode }}</h3>
              <p class="text-gray-700 text-sm">Descripció: {{ libro.description }}</p>
              <Link :href="`/books/edit/${libro.id}`"
                class="mt-4 block text-center bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded-full font-bold transition-colors">
              Editar el llibre</Link>
            </div>
            <div class="mt-6">
              <Link :href="`/book/${libro.id}`"
                class="block text-center bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded-full font-bold transition-colors">
              Veure més
              </Link>
            </div>
            <div class="mt-6">
              <button @click="deleteBook(libro.id)"
                class="block text-center bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded-full font-bold transition-colors">
                Esborrar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-6 flex justify-center" v-if="genderBook.links && genderBook.links.length > 3">
      <div class="flex-wrap flex -mb-1">
        <template v-for="(link, p) in genderBook.links" :key="p">
          <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label"/>
          <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-red-100 focus:border-indigo-500 focus:text-indigo-500"
          :class="{ 'bg-red-500 text-white': link.active }"
          :href="link.url"
          v-html="link.label"/>
        </template>
      </div>
    </div>

    <div class="mt-6">
      <a href="/booksForm"
        class="block text-center bg-red-500 hover:bg-red-700 w-full text-white py-2 px-4 rounded-full font-bold transition-colors">
        Afegir Llibres
      </a>
    </div>

  </section>
</template>
