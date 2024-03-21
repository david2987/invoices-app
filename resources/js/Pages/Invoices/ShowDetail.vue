<script setup  >
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { FwbButton, FwbModal,FwbInput  } from 'flowbite-vue'
import { ref } from 'vue'


const props = defineProps({
    consumptions: {
        type: JSON,
    }   
});



</script>

<template>

<Head title="Consumptions" />

    <AppLayout />

    <div class="container mx-auto max-w-6xl" >

<div class="p-4">
    <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">Invoice Details</h2>
</div>


<div class="w-full text-right container mx-auto flex ">   
    <div>
        <input type="text" v-model="term" @keyup="search"  placeholder="Search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" size="sm" />                
    </div>    
          
</div>

<div class="container mx-auto mt-2">
    <table class="table-auto w-full">
        <thead>
        <tr class="bg-blue-700 text-white text-left">
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Service</th>
            <th class="px-4 py-2">Unit</th>
            <th class="px-4 py-2">Price</th>            
            <th class="px-4 py-2">Period</th>
            <th class="px-4 py-2">Total</th>                            
        </tr>
        </thead>
        <tbody>
        <tr v-for="consumptions in consumptions.data" :key="consumptions.id" class="border-b border-gray-200 hover:bg-gray-100">
            <td class="px-4 py-2">{{ consumptions.item }}</td>
            <td class="px-4 py-2">{{ consumptions.service }}</td>
            <td class="px-4 py-2">{{ consumptions.unit }}</td>
            <td class="px-4 py-2">{{ consumptions.price }}</td>            
            <td class="px-4 py-2">{{ consumptions.total }}</td>                                                 
        </tr>
        </tbody>
    </table>

    <div class="p-5 flex justify-content gap-4">
        <Link  class="px-2" :href="consumptions.prev_page_url"><< Previous   </Link>
        <Link  class="px-2" :href="consumptions.next_page_url"> Next  >> </Link>
    </div>
</div>
</div>

</template>