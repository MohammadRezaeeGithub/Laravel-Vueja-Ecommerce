
<template>

    <!--the order detail-->
    <div class="flex items-center justify-between border-b border-gray-400 ">
        <h2 class="text-2xl font-bold mt-6 pb-2 ">Order Details</h2>
        <span class="rounded-lg p-1 text-white px-2 w-20 flex items-center justify-center"
              :class="{
                    'bg-green-500' : order.status == 'paid',
                    'bg-red-500' : order.status == 'unpaid',
                    'bg-orange-400' : order.status == 'pending',
                }"
        >{{ order.status}}</span>
    </div>

    <table class="table-auto w-full">
        <tbody>
        <tr>
            <td class="font-semibold py-1 px-2">Order #</td>
            <td>{{ order.id }}</td>
        </tr>
        <tr>
            <td class="font-semibold py-1 px-2">Order Date</td>
            <td>{{ order.created_at }}</td>
        </tr>
        <tr>
            <td class="font-semibold py-1 px-2">Order Status</td>
            <td class="p-2">
                <span class="rounded-lg p-1 text-white px-2"
                    :class="{
                    'bg-green-500' : order.status == 'paid',
                    'bg-red-500' : order.status == 'unpaid',
                    'bg-orange-400' : order.status == 'pending',
                }"
                >{{ order.status}}</span>
            </td>
        </tr>
        <tr>
            <td class="font-semibold py-1 px-2">Subtotal</td>
            <td>${{ order.total_price }}</td>
        </tr>
        </tbody>
    </table>
    <hr class="my-3">

    <!--the customer detail-->
    <h2 class="text-2xl font-bold mt-6 pb-2 border-b border-gray-400">Customer Details</h2>
    <table class="table-auto w-full">
        <tbody>
        <tr>

            <td class="font-semibold py-1 px-2">Full Name</td>
            <td v-if="order.customer">{{ order.customer.first_name }} {{ order.customer.last_name }}</td>
        </tr>
        <tr>
            <td class="font-semibold py-1 px-2">Email</td>
            <td v-if="order.customer">{{ order.customer.email }}</td>
        </tr>
        <tr>
            <td class="font-semibold py-1 px-2">Phone</td>
            <td v-if="order.customer">{{ order.customer.phone }}</td>
        </tr>
        </tbody>
    </table>

    <h2 class="text-2xl font-bold mt-6 pb-2 border-b border-gray-400">Order Items</h2>
    <!--the product item-->
    <article v-for="item of order.items" class="flex flex-col sm:flex-row items-center gap-4 p-2">
        <a href="#" class="w-32 h-32 flex items-center justify-center overflow-hidden">
            <img :src="item.product.image" class="object-cover" alt="">
        </a>
        <div class="flex flex-col w-full justify-between">
            <div class="flex justify-between items-center">
                <h3 class="m-0">{{ item.product.title }}</h3>
                <span class="text-lg font-bold">${{ item.unit_price }}</span>
            </div>
            <div class="flex justify-between items-center mt-6">
                <div>
                    Qty: {{ item.quantity }}
                </div>
            </div>
        </div>
    </article>
    <hr class="my-3">
    <!--the end of the  product item-->
</template>



<script setup>

import store from "../../store/index.js";
import {useRoute} from "vue-router";
import {onMounted, ref} from "vue";


const route = useRoute();
const order = ref({});

onMounted(() => {
    store.dispatch('getOrder',route.params.id)
        .then(({data}) => {
            order.value = data;
        })
})



</script>

