<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'


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

        <div class="mt-5">
            <Link 
                :href="route('invoices')"
                class="rounded-md px-3 py-4 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">            
                    <button type="button" class="focus:outline-none text-white bg-gray-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    < Back 
                    </button>
                </Link>                
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