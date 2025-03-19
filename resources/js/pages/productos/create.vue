<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

import { ref } from 'vue';
import axios from 'axios';

import BusForm from '@/components/productos/create.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'CREAR PRODUCTOS',
        href: '/bus',
    },
];

/*
const deletebus= id =>{
    if(confirm('Are yuo sure?')){
        //Inertia.delete(route('categories.destroy',id))
    }
}*/


</script>

<template>
    <Head title="CREAR PRODUCTO"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                
                <BusForm :form="form" @submit="form.post(route('bus.store'))">

</BusForm>
                
                
            </div>
        </div>
    </AppLayout>
</template>
