
<template>
  <div class="flex items-center justify-between mb-3 fade-in-down">
    <h1 class="text-3xl font-semibold">Customers</h1>
  </div>
    <CustomerModal v-model="showModal" :customer="customerModel" @close="onModalClose"/>
    <CustomerTable @clickEdit="editCustomer" />
</template>



<script setup>
import CustomerTable from "./CustomerTable.vue";
import CustomerModal from "./CustomerModal.vue";
import {ref} from "vue";
import store from "../../store/index.js";

const showModal = ref(false);

const DEFAULT_CUSTOMER = {

}

const customerModel = ref({...DEFAULT_CUSTOMER})

function showCustomerModal(){
    showModal.value = true;
}

function editCustomer(customer){
    store.dispatch('getCustomer',customer.id)
        .then(({data}) => {
            customerModel.value = data
            showCustomerModal()
        })
}

function onModalClose(){
    customerModel.value = {...DEFAULT_CUSTOMER};
}
</script>

