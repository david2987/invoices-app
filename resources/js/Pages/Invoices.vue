<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
    invoices: {
        type: JSON,
    },
    searched:{
        type:Number
    },    
    from:{
        type:Date
    },
    to:{
        type:Date
    }
});


const form = useForm({
    idInvoiceDelete: '',   
});

const isShowModal = ref(false)
const idInvoiceDelete = ref(0)
const term = ref(props.searched)
const from = ref(props.from)
const to = ref(props.to)

function closeModal () {
  isShowModal.value = false
}
function showModal (id) {
    idInvoiceDelete.value = id
  isShowModal.value = true
}

function deleteInvoice() {
    form.idInvoiceDelete = idInvoiceDelete
    form.delete(route('invoices.delete'), {
        onFinish: () => isShowModal.value = false
    });
    
}
function search() {    
    router.get('/invoices', { term: term.value,from: from.value,to:to.value }, { replace: true })
}


</script>

<template>
    <Head title="Invoices" />


    <AppLayout />

    <div class="container mx-auto max-w-6xl" >

        <div class="p-4">
            <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">Invoices Panel</h2>
        </div>


        <div class="w-full text-right container mx-auto flex gap-4 ">   
            <div class="text-left">
                <label>Invoice Number</label>
                <input type="text" v-model="term" @keyup="search"  placeholder="#" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" size="sm" />                
            </div>            
            <div class="text-left">
                <label>Date From</label>
                <input type="date" v-model="from" @focusout="search"  placeholder="Date From" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" size="sm" />                
            </div>
            <div class="text-left">
                <label>Date to</label>
                <input type="date" v-model="to" @focusout="search"  placeholder="Date to" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" size="sm" />                
            </div>
            <div class="mt-5">
                <Link 
                 :href="route('invoices')"
                 class="rounded-md px-3 py-4 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">            
                     <button type="button" class="focus:outline-none text-white bg-gray-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <i class="bi bi-funnel"></i> 
                     </button>
                 </Link>                
            </div>
            <div>
                <Link
                    :href="route('invoicesCreate')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    <button type="button"class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <i class="bi bi-plus-circle"></i>   
                        Add Invoice
                    </button>
                </Link>
            </div>

                            
        </div>
    
        <div class="container mx-auto mt-2">
            <table class="table-auto w-full">
                <thead>
                <tr class="bg-blue-700 text-white text-left">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Number</th>
                    <th class="px-4 py-2">Client</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">State</th>
                    <th class="px-4 py-2">Total</th>                    
                    <th class="px-4 py-2"></th>
                    
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="invoice in invoices" :key="invoice.id" class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-4 py-2">{{ invoice.id }}</td>
                    <td class="px-4 py-2">{{ invoice.number }}</td>
                    <td class="px-4 py-2">{{ invoice.client }}</td>
                    <td class="px-4 py-2">{{ invoice.date }}</td>
                    <td class="px-4 py-2 text-green-500" v-if="invoice.state == 'paid' " >{{ invoice.state }}</td>
                    <td class="px-4 py-2 text-red-500" v-if="invoice.state == 'pending' " >{{ invoice.state }}</td>
                    <td class="px-4 py-2"> {{  new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(invoice.total)   }}</td>                    
                    <td class="px-4 py-2">  
                        <Link  :href="route('invoicesEdit', invoice.id )">
                        <button  class="hover:text-gray-500" >
                            <i class="bi bi-pencil-square"></i> 
                            Edit 
                        </button> 
                    </Link>
                    </td>
                    <td class="px-4 py-2">
                        <button  @click="showModal(invoice.id)" class="hover:text-gray-500" >
                            <i class="bi bi-trash"></i> 
                            Delete
                        </button>
                    </td>                             
                    <td class="px-4 py-2">
                        <Link 
                        :href="route('consumptions', invoice.id)"
                        >
                        <button class="hover:text-gray-500" >
                            <i class="bi bi-eye"></i>
                            Details
                        </button>
                        </Link>
                    </td>                   
                </tr>
                </tbody>
            </table>

            <div class="p-5 flex justify-content gap-4">
                <Link  class="px-2" :href="invoices.prev_page_url"><< Previous   </Link>
                <Link  class="px-2" :href="invoices.next_page_url"> Next  >> </Link>
            </div>
        </div>
    </div>

</template>


