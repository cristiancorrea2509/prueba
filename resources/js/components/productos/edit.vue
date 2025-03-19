
<script setup>
import { ref,watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  Producto_id: {
    type: Object,
    required: true  
  }
});

// Clonar `Producto_id` correctamente en `Producto`
const Producto = ref({
  nombre: props.Producto_id?.nombre || '',  // Accede correctamente
  codigo: props.Producto_id?.codigo || '',
  valor: props.Producto_id?.valor || '',
  cantidad: props.Producto_id?.cantidad || ''
});

// Si `Producto_id` cambia, actualizar `Producto`
watch(() => props.Producto_id, (newProducto) => {
  if (newProducto) {
    Producto.value = { 
      nombre: newProducto.nombre || '', 
      codigo: newProducto.codigo || '',
      valor: newProducto.valor || '',
      cantidad: newProducto.valor || ''
    };
  }
}, { deep: true });


const mensaje = ref('');
const errores = ref({}); // Almacena los errores de validación

const submitForm = async () => {
  mensaje.value = ''; // Limpia mensajes anteriores
  errores.value = {}; // Limpia errores anteriores
  
  try {
    const response = await axios.put(route('productos.update',props.Producto_id.id), Producto.value, {
      headers: { 'Content-Type': 'application/json' }
    });

    console.log('Respuesta del servidor:', response.data);
    mensaje.value = 'Producto creado exitosamente';
    if (response.data.redirect) {
      window.location.href = response.data.redirect; // Redirección manual
    }
    // Limpiar formulario después de crear el producto
    producto.value = { nombre: '', codigo: '', valor: '' };
  } catch (error) {
    console.error('Error en la solicitud:', error.response?.data || error.message);

    // Si hay errores de validación, los guardamos en `errores`
    if (error.response?.status === 422) {
      errores.value = error.response.data.errors;
    } else {
      mensaje.value = 'Error al modificar el producto. Intenta nuevamente.';
    }
  }
};

</script>

<template>
    
      <h2 class="text-2xl font-bold mb-4">Registrar Producto</h2>

      <form @submit.prevent="submitForm">
        <div class="mb-4">
        <label class="block text-gray-700">Nombre:</label>
        <input type="text" v-model="Producto.nombre" class="w-full p-2 border rounded text-black" required />
        <p v-if="errores.nombre" class="text-red-500 text-sm">{{ errores.nombre }}</p>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Código:</label>
        <input type="text" v-model="Producto.codigo" class="w-full p-2 border rounded text-black" required />
        <p v-if="errores.codigo" class="text-red-500 text-sm">{{ errores.codigo }}</p>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Valor:</label>
        <input type="number" v-model="Producto.valor" class="w-full p-2 border rounded text-black" required />
        <p v-if="errores.valor" class="text-red-500 text-sm">{{ errores.valor }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Cantidad:</label>
        <input type="number" v-model="Producto.cantidad" class="w-full p-2 border rounded text-black" required />
        <p v-if="errores.cantidad" class="text-red-500 text-sm">{{ errores.valor }}</p>
      </div>
  
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
          Editar Producto
        </button>
      </form>
  
      <div v-if="mensaje" class="mt-4 p-3 bg-green-100 text-green-800 rounded">
        {{ mensaje }}
      </div>
    
  </template>


  