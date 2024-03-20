<script setup>

// require('dotenv').config({ path: '@/.env' })

defineProps({
    items: {
        type: JSON,
    },
        
})
import { ref, watchEffect } from 'vue'

const API_URL = `http://localhost:8000/consumptionstype`
const consumptionstype = ref(null)

watchEffect(async () => {

  consumptionstype.value = await (await fetch(API_URL)).json()
})

</script>

<template>
<div class="item">
    {{ consumptionstype }}
    <table  >
        <th>Item</th>
        <th>Description</th>
        <th>Unit</th>
        <th>Type</th>
        <th>Sub-Total</th>
    
        <tr v-for="item in items" :key="item.itemNr">
            <td>{{ item.itemNr }}</td>
            <td>{{ item.description }}</td>
            <td>{{ item.unit }}</td>
            <td>{{ item.typeConsumption }}</td>
            <td class="text-center" >$ {{ item.subtotal }}</td>
        </tr>
    
    
    </table>
    
  </div>
</template>

<style scoped>
#app {
  font-family: sans-serif;
}

.item {
  border: 1px solid #ccc;
  padding: 10px;
  margin: 10px;
}
table{
    width: 100%;
}

table th{
    background-color: brown;
    color: #ccc;
    height: 40px;
}
</style>