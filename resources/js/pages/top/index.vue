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
        title: 'TOP',
        href: '/TOP',
    },
];


defineProps({
    topCompradores: {
        type: Array,
        required: true
    },
    articuloMasVendido: {
        type: Array,
        required: true
    }
})
</script>

<template>

    <Head title="TOP" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <h2 class="text-xl font-bold mb-4">TOP CLIENTES</h2>
                    <table id="miTabla" class="display">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="Compradores in topCompradores" :key="Compradores.id">
                                <td>{{ Compradores.documento_comprador }}</td>
                                <td>{{ Compradores.total_compras }}</td>
                            </tr>
                        </tbody>
                    </table>
                <h2 class="text-xl font-bold mb-4">TOP PRODUCTOS</h2>
                    <table id="miTabla" class="display">
                        <thead>
                            <tr>
                                <th>Articulo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="articulo in articuloMasVendido" :key="articulo.id">
                                <td>{{ articulo.codigo_producto }}</td>
                                <td>{{ articulo.total_vendido }}</td>
                            </tr>
                        </tbody>
                    </table>


            </div>
        </div>
    </AppLayout>
</template>
