<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    Productos: {
        type: Array,
        required: true
    }
});

// 🔹 Clonar `Productos` para evitar modificar `props`
const productosSeleccionados = ref(props.Productos.map(producto => ({
    ...producto, 
    seleccion: 0 
})));

// 🔹 Cliente con campos extra
const cliente = ref({
    documento: '',
    nombre: ''
});

const mensaje = ref('');
const errores = ref({});

// 🔹 Enviar datos al backend
const submitForm = async () => {
    mensaje.value = ''; 
    errores.value = {}; 

    try {
        const response = await axios.post(route('sale.store'), {
            comprador: { 
                documento: cliente.value.documento, 
                nombre: cliente.value.nombre 
            }, // ✅ Aseguramos que `comprador` está bien estructurado
            productos: productosSeleccionados.value.map(producto => ({
                codigo: producto.codigo,
                valor: producto.valor,
                cantidad: producto.seleccion // 🔹 Aquí renombramos `seleccion` a `cantidad`
            }))
        }, {
            headers: { 'Content-Type': 'application/json' }
        });

        console.log('Respuesta del servidor:', response.data);
        mensaje.value = 'Venta realizada exitosamente';

        // 🔹 Limpiar formulario después de la venta
        productosSeleccionados.value.forEach(producto => producto.seleccion = 0);
        cliente.value = { documento: '', nombre: '' };

    } catch (error) {
        console.error('Error en la solicitud:', error.response?.data || error.message);

        if (error.response?.status === 422) {
            errores.value = error.response.data.errors;
        } else {
            mensaje.value = 'Error al procesar la venta. Intenta nuevamente.';
        }
    }
};
</script>


<template>
    <form @submit.prevent="submitForm">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div 
                v-for="producto in productosSeleccionados" 
                :key="producto.id"
                class="flex flex-col items-center justify-center text-center relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4"
            >
                <h4>Nombre: {{ producto.nombre }}</h4>
                <h3>Precio: ${{ producto.valor }}</h3>
                <h4>Codigo: {{ producto.codigo }}</h4>
                <h4>Stock: {{ producto.cantidad }}</h4>

                <!-- Inputs -->
                <input type="hidden" v-model="producto.codigo" />
                <input type="hidden" v-model="producto.valor" />
                <input type="number" v-model="producto.seleccion" class="w-full p-2 border rounded text-black" />

                <p v-if="errores[producto.id]?.cantidad" class="text-red-500 text-sm">{{ errores[producto.id].cantidad }}</p>
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700">Documento:</label>
            <input type="text" v-model="cliente.documento" class="w-full p-2 border rounded text-black" placeholder="Ingrese su documento" required />

            <label class="block text-gray-700 mt-2">Nombre:</label>
            <input type="text" v-model="cliente.nombre" class="w-full p-2 border rounded text-black" placeholder="Ingrese su nombre" required />
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            HACER VENTA
        </button>
    </form>

    <div v-if="mensaje" class="mt-4 p-3 bg-green-100 text-green-800 rounded">
        {{ mensaje }}
    </div>
</template>
