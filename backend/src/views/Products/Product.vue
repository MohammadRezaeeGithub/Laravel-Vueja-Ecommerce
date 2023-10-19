
<template>
  <div class="flex items-center justify-between mb-3 fade-in-down">
    <h1 class="text-3xl font-semibold">Products</h1>
    <button type="submit"
            @click="showProductModal"
            class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500"
    >
      Add new product
    </button>
  </div>
    <ProductModal v-model="showModal" :product="productModel" @close="onModalClose"/>
    <ProductTable @clickEdit="editProduct" />
</template>



<script setup>
import ProductTable from "./ProductTable.vue";
import ProductModal from "./ProductModal.vue";
import {ref} from "vue";
import store from "../../store/index.js";

const showModal = ref(false);

const DEFAULT_PRODUCT = {
    id: '',
    title: '',
    description: '',
    image: '',
    price: ''
}

const productModel = ref({...DEFAULT_PRODUCT})

function showProductModal(){
    showModal.value = true;
}

function editProduct(product){
    store.dispatch('getProduct',product.id)
        .then(({data}) => {
            productModel.value = data
            showProductModal()
        })
}

function onModalClose(){
    productModel.value = {...DEFAULT_PRODUCT};
}
</script>

