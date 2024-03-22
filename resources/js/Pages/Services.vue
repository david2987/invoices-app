<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { FwbButton, FwbModal } from 'flowbite-vue'
import { ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'


const props =  defineProps({
    services: {
        type: JSON,
    },   
    searched:{
        type:Number
    } ,
    searchType:{
        type:String
    } 

});

const term = ref(props.searched)
const searchType = ref(props.searchType)

const form = useForm({
    idServiceDelete: '',   
});

const isShowModal = ref(false)
const idServiceDelete = ref(0)

function closeModal () {
  isShowModal.value = false
}
function showModal (id) {
    idServiceDelete.value = id
  isShowModal.value = true
}


function deleteService() {
    form.idServiceDelete = idServiceDelete
    form.delete(route('services.delete'), {
        onFinish: () => isShowModal.value = false
    });    
}

function search() {
    router.get('/services', { term: term.value , type: searchType.value }, { replace: true })
}



</script>

<template>
    <Head title="Services" />
    
    <AppLayout />

  <fwb-modal v-if="isShowModal" @close="closeModal">
    <template #header>
      <div class="flex items-center text-lg">
        Delete a Service 
      </div>
    </template>
    <template #body>
     <div>
        Are you sure you want to delete?
     </div>
    </template>
    <template #footer>
      <div class="flex gap-1 text-right">
          <fwb-button @click="deleteService" color="red">
            Delete
        </fwb-button>
        <fwb-button @click="closeModal" color="alternative">
          Cancel
        </fwb-button>
      </div>
    </template>
  </fwb-modal>

    <div class="container mx-auto" >
        
        <div class="p-4">
            <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">Services</h2>
        </div>

        <div class="w-full text-right container mx-auto flex gap-4">

            <div class="text-left">
                <label>Description</label>
                <input type="text" v-model="term" @keyup="search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" size="sm" />                
            </div>
            <div class="text-left">
                <label>Type</label>                
                <select v-model="searchType" placeholder="Choose a Type" @change="search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" size="sm">
                    <option selected value="" >All type</option>
                    <option value="Monthly" >Monthly</option>
                    <option value="perUnit">Per Unit</option>
                    <option value="perMinute">Per Minute</option>
                    <option value="perLetter">Per Letter</option>
                </select>
            </div>            
            <div class="mt-5">
                <Link 
                 :href="route('services')"
                 class="rounded-md px-3 py-4 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">            
                     <button type="button" class="focus:outline-none text-white bg-gray-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <i class="bi bi-funnel"></i> 
                     </button>
                 </Link>                
            </div>
             <div class="mt-5">
                 <Link 
                 :href="route('servicesCreate')"
                 class="rounded-md px-3 py-4 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">            
                     <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                         <i class="bi bi-plus-circle"></i> Add Service
                     </button>
                 </Link>
             </div>   

        </div>
    
        <div class="container mx-auto mt-2">
            <table class="table-auto w-full">
                <thead>
                <tr class="bg-blue-700 text-white text-left">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Type</th>                    
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="service in services" :key="service.id" class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-4 py-2">{{ service.id }}</td>
                    <td class="px-4 py-2">{{ service.description }}</td>
                    <td class="px-4 py-2">{{  new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(service.price)  }}</td>
                    <td class="px-4 py-2">{{ service.type }}</td>                    
                    <td>
                    <div class="px-4 py-2">  
                    <Link  :href="route('servicesEdit', service.id )">
                        <button  class="hover:text-gray-500" >
                            <i class="bi bi-pencil-square"></i> Edit 
                        </button> 
                    </Link>
                    </div>
                    </td>
                    <td class="px-4 py-2">
                        <button @click="showModal(service.id)" class="hover:text-gray-500">
                            <i class="bi bi-trash"></i> 
                            Delete
                        </button>
                    </td>                    
                </tr>
                </tbody>
            </table>
            <div class="p-5 flex justify-content gap-4">
                <Link  class="px-2" :href="services.prev_page_url"><< Previous   </Link>
                <Link  class="px-2" :href="services.next_page_url"> Next  >> </Link>
            </div>
        </div>
    </div>

</template>

