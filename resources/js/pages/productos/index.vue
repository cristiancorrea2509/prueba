<script setup lang="ts">
import { ref } from 'vue'; // 🔹 Importar `ref`
import { router } from '@inertiajs/vue3'; // 🔹 Importar `router` para hacer peticiones AJAX

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../../components/PlaceholderPattern.vue';
import { Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import DeleteModal from '../../components/DeleteModal.vue';
//import { Inertia } from '@inertiajs/inertia';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'LISTADO DE PRODUCTOS',
        href: '/Productos',
    },
];

defineProps({
    Productos: {
        type: Object,
        required:true  
    }
})
const formatearFecha = (fecha) => {
    return dayjs(fecha).format('DD/MM/YYYY HH:mm:ss'); // Formato: Día/Mes/Año Hora:Minuto:Segundo
};


// Control del modal
const isModalOpen = ref(false);
const busToDelete = ref(null);
// Función para abrir el modal y asignar el ID del bus
const openModal = (id) => {
  console.log("Bus seleccionado para eliminar:", id);
  busToDelete.value = id;
  isModalOpen.value = true;
};

// Función para eliminar el bus
const deleteBus = () => {
  if (busToDelete.value) {
    console.log("Eliminando bus con ID:", busToDelete.value);
    
    router.delete(route('productos.destroy', busToDelete.value), {
      onSuccess: () => {
        isModalOpen.value = false;
        busToDelete.value = null; // Resetear el ID después de eliminar
      }
    });
  }
};
</script>

<template>
    <Head title="Productos"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <div class="flex justify-between" >
                        
                        <a :href="route('productos.create')" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded">
                            CREAR PPRODUCTOS
                        </a>
                        
                    </div>
                    
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <h2 class="text-xl font-bold mb-4">Lista de Productos</h2>
            <table id="miTabla" class="display">
            <thead>
                <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Valor</th>
                <th>Codigo</th>
                <th>Cantidad</th>
                <th>Fecha Creacion</th>
                <th>Editar</th>
                <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="Producto in Productos.data" :key="Producto.id">
                    <td>{{ Producto.id }}</td>
                    <td>{{ Producto.nombre }}</td>
                    <td>{{ Producto.valor }}</td>
                    <td>{{ Producto.codigo }}</td>
                    <td>{{ Producto.cantidad }}</td>
                    <td>{{ formatearFecha(Producto.created_at) }}</td>
                    <td>
                        <a :href="route('productos.edit',Producto.id)" class="text-white bg-yellow-500 hover:bg-yellow-700 py-2 px-4 rounded">
                            EDITAR
                        </a>
                    </td>
                    <td class="">
                        <button @click="openModal(Producto.id)" class="text-white bg-red-500 hover:bg-yellow-700 py-2 px-4 rounded">
                        Eliminar
                        </button>
                    </td>

                </tr>
            </tbody>
            </table>
                
                
            </div>
        </div>
    </AppLayout>
    <DeleteModal :show="isModalOpen" @close="isModalOpen = false" @confirm="deleteBus" />
</template>
