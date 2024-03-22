<script setup  >
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm,Link } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import { FwbToast } from 'flowbite-vue'
    
    defineProps({
    services: {
        type: JSON,
        },    
    });    
    const isToast = ref(false)

    // ref    
    const id = ref(0);
    const description = ref(null);
    const price = ref(null);
    const type = ref(null);
    let mostrarToast = ref(false)
    

    const submit = () => {
        
        const form = useForm({
        id: document.getElementById('id').value,
        description: document.getElementById('description').value,
        price: document.getElementById('price').value,
        type: document.getElementById('type').value    
        });
        
        form.patch(route('services.update'), {
            onFinish: () => showToast()            
                
    });

 function showToast () {
  isToast.value = true
}


    
};

</script>
<template>

<AppLayout />


<form class="max-w-xl mx-auto mt-4"  @submit.prevent="submit" v-for="service in services.original" :key="service.id">

    <fwb-toast v-if="isToast" closable  type="success">
        Service Updated!
    </fwb-toast>

    <div> 
        <h1>Update Service</h1>        
    </div>

    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert" v-show="mostrarToast">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Service Save successfully.</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>

        <!-- Description -->
        <div class="relative z-0 w-full mb-5 group mt-5">
                <input type="hidden" id="id" v-model="service.id">

                <InputLabel for="description" value="Description" />
                <TextInput
                    id="description"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="service.description"
                    required
                    autofocus
                    autocomplete="description"   
                        
                />
              
            </div>

            <!-- Price -->
            <div class="relative z-0 w-full mb-5 group">

                <InputLabel for="price" value="Price" />
                <TextInput
                    id="price"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="service.price"
                    required
                    autofocus
                    autocomplete="price"
                />
                
            </div>

            <!-- Type  -->
            <div class="relative z-0 w-full mb-5 group">        
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service Type</label>
                <select id="type" v-model="service.type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a Type</option>
                    <option value="Monthly" >Monthly</option>
                    <option value="perUnit">Per Unit</option>
                    <option value="perMinute">Per Minute</option>
                    <option value="perLetter">Per Letter</option>
                </select>
            </div>
  

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    <Link 
        :href="route('services')"
        class="rounded-md px-3 py-4 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">            
            <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Cancel 
            </button>
        </Link> 
</form>



</template>

<script>


</script>
