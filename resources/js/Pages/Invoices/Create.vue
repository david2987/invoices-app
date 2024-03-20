<script  setup  >
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';

     defineProps({
    services: {
        type: JSON,
        },    
    });
    

    // ref    
    const number = ref(null);
    const unit = ref(null);
    const client = ref(null);
    const total = ref(null);
    const rows =ref([
        { item: 1, service: '', unit:'',price:'',total:'' }
      ]);
    const items = ref(1)
    const itemsValue = ref([])
    let mostrarToast = ref(false)
    

    // useForm
    const form = useForm({
        number: '',
        unit: '',
        client: '',    
        total:0
    }); 

    function addRow () {   
        items.value = items.value + 1;     
        let index = items.value
        const newRow = {
            item: items.value, 
            description: '',
            service: '',
            unit:'',
            price:'',
            total:''
      };
        rows.value.push(newRow)
    }

    function removeRow (item) {           
        let rowsFiltered = rows.value
        rows.value = rowsFiltered.filter((rowsFiltered)=> rowsFiltered.item != item )        
    }

    function onChange(event,id) {
         let price =  event.target.options[event.target.selectedIndex].getAttribute('data')
         let unit =  document.getElementById('unit' + id ).value
         document.getElementById('price' + id ).value = price          
        calcularTotal(id)
    }

    function calcularTotal(id) {
        let unit =  document.getElementById('unit' + id ).value
        let price = document.getElementById('price' + id ).value 
        document.getElementById('total' + id ).value = price * unit
    }

    
    const submit = () => {                             
        for (let i = 1; i <= items.value; i++) {
                let serviceValue = document.querySelector('#service' + i).value
                let unitValue =   document.getElementById('unit' + i).value
                let priceValue =  document.getElementById('price' + i).value
                let totalValue = document.getElementById('total' + i).value

                itemsValue.value.push( {
                    "service":serviceValue,  
                    "unit":unitValue,
                    "price":priceValue,
                    "total":totalValue
                })                
        }

        const form =  useForm({
            client: document.getElementById('client').value,
            date: document.getElementById('date').value,
            number :document.getElementById('number').value,
            total: 100,
            rows : itemsValue.value
        });
        
                
        form.post(route('invoices'), {
            onSuccess: (res) => console.log(res),
            onError: (err) => console.log(err)                         
        });
    };


</script>
<template>

<AppLayout />

<form class="max-w-6xl mx-auto mt-4"  @submit.prevent="submit">
    

    <div> 
        <h1>Create Invoice</h1>
    </div>

    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert" v-show="mostrarToast">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Invoice Save successfully.</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>

    <div class="grid gap-3">

        <!-- Header -->
        <div >
        
            <!-- Number -->
            <div class="relative z-0 w-full mb-5 group mt-5">
                <InputLabel for="number" value="Number" />
                <TextInput
                    id="number"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.number"
                    required
                    autofocus
                    autocomplete="number"            
                />
            </div>

            <!-- Client -->
            <div class="relative z-0 w-full mb-5 group">
                <InputLabel for="client" value="Client" />
                <TextInput
                    id="client"
                    type="text"
                    class=" block w-full"
                    v-model="form.client"
                    required
                    autofocus
                    autocomplete="client"
                />
                
            </div>

            <!-- date -->
            <div class="relative z-0 w-full mb-5 group">
                <InputLabel for="date" value="Date" />
                <TextInput
                    id="date"
                    type="date"
                    class=" block w-full"
                    v-model="form.date"
                    required
                    autofocus
                    autocomplete="date"
                />
                
            </div>

            <!-- Total -->
            <!-- <div class="relative z-0 w-full mb-5 group">
                <InputLabel for="total" value="total" />
                <TextInput
                    id="total"
                    type="number"
                    class=" block w-full"
                    v-model="form.total"
                    required
                    autofocus
                    autocomplete="total"
                />
                
            </div> -->
        </div>

        <!-- Detail -->
        <div class="mt-5">
            
            <table  class="table-auto w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
                <thead>
                <tr class="text-xs text-gray-700 uppercase bg-blue-700 dark:bg-gray-700 text-white">
                    <th class="px-4 py-2">#</th>
                    <!-- <th class="px-4 py-2">Description</th> -->
                    <th class="px-4 py-2">Service</th>
                    <th class="px-4 py-2">Unit</th>
                    <th class="px-4 py-2">Pirce</th>                    
                    <th class="px-4 py-2">Total</th>                                                          
                    <th class="px-4 py-2"></th>
                </tr>
                </thead>
                <tbody class="py-8">                    
                    <tr v-for="row in rows" :key="row.item"  class="bg-gray-100" >                                                                
                        <td  class="text-center">{{row.item}}</td>                   
                        <td>                             
                            <select @change="onChange($event,row.item)" :id="'service' + row.item"  >
                                <option selected>Seleccionar un Servicio</option>
                                <option v-if="services"  v-for="service in services.original" :data="service.price"  :value="service.id" >{{service.description}}</option>
                            </select>                          
                        </td>
                        <td> 
                            <input   :id="'unit' + row.item" type="number" @keydown="calcularTotal(row.item)"   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </td>
                        <td >                            
                            <input :id="'price' + row.item" type="text" readonly class=" shadow appearance-none border-0 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </td>
                        <td>                            
                           $<input type="text" :id="'total' + row.item "  class="border-0">
                        </td>
                        <td >
                            <button @click.prevent="removeRow(row.item)" class="bg-transparent" >
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>                        
                    </tr>
                </tbody>  
            </table>
            <div class="text-center">

                <button  @click.prevent="addRow" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mt-5">
                    <i class="bi bi-plus-circle"> Agregar Fila</i>
                </button>
            </div>
            
        </div>
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>



</template>
