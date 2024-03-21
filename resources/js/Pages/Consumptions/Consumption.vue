<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, watchEffect } from 'vue'


defineProps({
  consumptions: {
        type: JSON,
    },
        
})

</script>

<template>
  <Head title="Consumptions" />
  
  <AppLayout />

  <div class="container mx-auto" >
      
      <div class="p-4">
          <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">Consumptions</h2>
      </div>
  
      <div class="container mx-auto mt-2">
          <table class="table-auto w-full">
              <thead>
              <tr class="bg-blue-700 text-white text-left">
                  <th class="px-4 py-2">#</th>
                  <th class="px-4 py-2">Servicie</th>
                  <th class="px-4 py-2">Price</th>
                  <th class="px-4 py-2">Unit</th> 
                  <th class="px-4 py-2">Period</th>                                       
                  <th class="px-4 py-2">Total</th>                                      
              </tr>
              </thead>
              <tbody>
              <tr v-for="consumption in consumptions" :key="consumption.id" class="border-b border-gray-200 hover:bg-gray-100">
                  <td class="px-4 py-2">{{ consumption.id }}</td>
                  <td class="px-4 py-2">{{ consumption.description }}</td>
                  <td class="px-4 py-2">{{  new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(consumption.price)  }}</td>
                  <td class="px-4 py-2">{{ consumption.unit }}</td>                                                     
                  <td class="px-4 py-2">{{ consumption.period }}</td>                                                     
                  <td class="px-4 py-2">{{  new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(consumption.subtotal)  }}</td>  
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