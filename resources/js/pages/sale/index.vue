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
import BusForm from '@/components/sale/sale.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'COMPRAS',
        href: '/Productos',
    },
];

defineProps({
    Productos: {
        type: Array,
        required: true
    }
})
</script>


<template>

    <Head title="Productos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <BusForm :form="form" :Productos="Productos" @submit="form.put(route('sale.store'))">

            </BusForm>

        </div>

    </AppLayout>
</template>
