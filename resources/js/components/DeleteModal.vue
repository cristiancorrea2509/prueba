<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
      <div class="bg-white p-6 rounded shadow-lg">
        <h2 class="text-lg font-bold mb-4 text-black">¿Estás seguro?</h2>
        <p  class="text-black">Esta acción no se puede deshacer.</p>
  
        <div class="mt-4 flex justify-end">
          <button @click="closeModal" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded">Cancelar</button>
          <button @click="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded">Eliminar</button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    show: Boolean, // Controla si el modal está visible
  });
  
  const emit = defineEmits(['close', 'confirm']);
  
  const closeModal = () => {
    emit('close');
  };
  
  const confirmDelete = () => {
    emit('confirm'); // Emitir evento para confirmar eliminación
  };
  </script>
  