<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

import { ref } from 'vue';
import axios from 'axios';

import BusForm from '@/components/productos/edit.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'EDITAR PRODUCTO',
        href: '/EDITAR PRODUCTO',
    },
];
defineProps({
    Producto_id: {
        type: Object,
        required:true  
    }
})


</script>

<template>
    <Head title="EDITAR PRODUCTO"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                
                
                <BusForm :form="form" :Producto_id="Producto_id"  @submit="form.put(route('produtos.store'))">

</BusForm>
                
                
            </div>
        </div>
    </AppLayout>
</template>
