<script setup  >
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm ,Link } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import { FwbToast } from 'flowbite-vue'
    
    
    // ref    
    const description = ref(null);
    const price = ref(null);
    const type = ref(null);
    const error = ref('')
    const mostrarToast = ref(false)
    const mostrarToastError = ref(false)

    // useForm
    const form = useForm({
    description: '',
    price: 0,
    type: ''    
    });

    

    const submit = () => {                  
        form.post(route('services'), {
        onSuccess: (data) => {            
            mostrarToast.value = true
            setTimeout(()=>{
                mostrarToast.value = false
            },3000)
            form.reset()
        },
        onError: (data) =>{
            mostrarToastError.value = true
            setTimeout(()=>{
                mostrarToastError.value = false
            },3000)
        }
    })
    

   }

</script>
<template>

<AppLayout />

<form class="max-w-xl mx-auto mt-4"  @submit.prevent="submit">

    <div> 
        <h1>Create Service</h1>
    </div>

    <fwb-toast divide type="success" v-show="mostrarToast">
        Service Save successfully.
    </fwb-toast>

    <fwb-toast divide type="danger" v-show="mostrarToastError">
        Error Saving Service  
    </fwb-toast>

    <!-- Description -->
    <div class="relative z-0 w-full mb-5 group mt-5">

        <InputLabel for="description" value="Description" />
        <TextInput
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="form.description"
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
            v-model="form.price"            
            autofocus
            autocomplete="price"      
            required      
        />
        
    </div>

    <!-- Type  -->
    <div class="relative z-0 w-full mb-5 group">        
        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service Type</label>
        <select 
            id="type"
            v-model="form.type"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"        
            required
            >
            <option selected>Choose a Type</option>
            <option value="Monthly">Monthly</option>
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
