<template>
    <div>
      <h1>Lista de Libros</h1>
      <ul>
        <li v-for="libro in libros" :key="libro.id">
          {{ libro.title }} - {{ libro.artist }}
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  defineProps({
    libro: Array
  })
  </script>
  