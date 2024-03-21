<script  setup  >
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import TextInput from '@/Components/TextInput.vue';    
    import InputLabel from '@/Components/InputLabel.vue';
    import { FwbToast } from 'flowbite-vue'

     defineProps({
    services: {
        type: JSON,
        },    
    });
    

    // ref    
    const rows =ref([
        { item: 1, service: '',period : '', unit:'',price:'',total:'' }
      ]);
    const items = ref(1)
    const itemsValue = ref([])
    const mostrarToast = ref(false)
    const mostrarToastError = ref(false)


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
            period:'',
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
         document.getElementById('price' + id ).value = price          
        calcularTotal(id)
    }

    function calcularTotal(id) {
        let unit =  document.getElementById('unit' + id ).value
        let price = document.getElementById('price' + id ).value 
        let period = document.getElementById('period' + id ).value

        if(!period){
            document.getElementById('total' + id ).value = price * unit
        }else{
            document.getElementById('total' + id ).value = price * unit * period
        }
    }
    function calculaTotalInvoice() {
        let total = 0;
        for (let i = 1; i <= items.value; i++) {
            total += document.getElementById('total' + i ).value            
        }
        alert(total)

        return total
    }

    
    const submit = () => {                             
        for (let i = 1; i <= items.value; i++) {
            let serviceValue = document.querySelector('#service' + i).value
            let unitValue =   document.getElementById('unit' + i).value
            let priceValue =  document.getElementById('price' + i).value
            let totalValue = document.getElementById('total' + i).value
            let periodValue = document.getElementById('period' + i).value

            itemsValue.value.push( {
                "service":serviceValue,  
                "unit":unitValue,
                "price":priceValue,
                "total":totalValue,
                "period":periodValue
            })                
        }

        const form =  useForm({
            client: document.getElementById('client').value,
            date: document.getElementById('date').value,
            number :document.getElementById('number').value,
            total: calculaTotalInvoice() ,
            rows : itemsValue.value
        });
        
                
        form.post(route('invoices'), {
        onSuccess: (data) => {            
            mostrarToast.value = true
            setTimeout(()=>{
                mostrarToastError.value = false
                limpiarForm()
            },3000)
            form.reset()
        },
        onError: (data) =>{
            mostrarToastError.value = true
            setTimeout(()=>{
                mostrarToastError.value = false
            },3000)
        }                   
        });

        function limpiarForm() {
            form.number = '';
            form.client = '';
            form.date='';
            rows =  { item: 1, service: '',period : '', unit:'',price:'',total:'' }
        }

        

    };


</script>
<template>

<AppLayout />

<form class="max-w-6xl mx-auto mt-4"  @submit.prevent="submit">
    

    <div> 
        <h1>Create Invoice</h1>
    </div>

    
    <fwb-toast divide type="success" v-show="mostrarToast">
        Service Save successfully.
    </fwb-toast>

    <fwb-toast divide type="danger" v-show="mostrarToastError">
        Error Saving Service  
    </fwb-toast>

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

        
        </div>

        <!-- Detail -->
        <div class="mt-5">
            
            <table  class="table-auto w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
                <thead>
                <tr class="text-xs text-gray-700 uppercase bg-blue-700 dark:bg-gray-700 text-white">
                    <th class="px-4 py-2">#</th>                
                    <th class="px-4 py-2">Service</th>
                    <th class="px-4 py-2">Unit</th>
                    <th class="px-4 py-2">Period</th>
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
                            <input :id="'period' + row.item" type="number" @keydown="calcularTotal(row.item)"   class=" shadow appearance-none border-0 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </td>
                        <td >                            
                            <input :id="'price' + row.item" type="text" readonly class=" shadow appearance-none border-0 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </td>
                        <td>                            
                           $<input :id="'total' + row.item" type="text"  readonly class="border-0">
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
