
<template>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <!--ACTIVE CUSTOMER-->
        <div class="bg-white py-6 px-5 text-5xl rounded-lg shadow flex flex-col items-center justify-center">
            <template v-if="!loading.customerCount">
                <label class="text-lg font-bold">Active Customers</label>
                <span class="text-3xl">{{customersCount}}</span>
            </template>
            <template v-else>
                <Spinner />
            </template>
        </div>
        <!--ACTIVE PRODUCTS-->
        <div class="bg-white py-6 px-5 text-5xl rounded-lg shadow flex flex-col items-center justify-center">
            <template v-if="!loading.productsCount">
                <label class="text-lg font-bold">Active Products</label>
                <span class="text-3xl">{{productsCount}}</span>
            </template>
            <template v-else>
                <Spinner/>
            </template>
        </div>
        <!--PAID ORDERS-->
        <div class="bg-white py-6 px-5 text-5xl rounded-lg shadow flex flex-col items-center justify-center">
            <template v-if="!loading.paidOrders">
                <label class="text-lg font-bold">Paid Orders</label>
                <span class="text-3xl">{{paidOrders}}</span>
            </template>
            <template v-else>
                <Spinner/>
            </template>

        </div>
        <!--TOTAL INCOME-->
        <div class="bg-white py-6 px-5 text-5xl rounded-lg shadow flex flex-col items-center justify-center">
            <template v-if="!loading.totalIncome">
                <label class="text-lg font-bold">Total Income</label>
                <span class="text-3xl">{{totalIncome}}</span>
            </template>
            <template v-else>
                <Spinner/>
            </template>

        </div>
    </div>


    <div class="grid grid-rows-2 grid-flow-col grid-cols-1 md:grid-cols-3 gap-3 mt-4">
        <div class="col-span-2 row-span-2 bg-white py-6 px-5 text-5xl rounded-lg shadow ">
            <label class="text-3xl font-semibold mb-6">Latest Orders</label>
            <template v-if="!loading.latestOrders">
                <div class="w-full text-base mt-8">
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="table-fixed w-full text-left">
                            <thead class="text-gray-200 uppercase bg-gray-500">
                            <tr>
                                <td class="py-1 border text-center  p-4" contenteditable="true">Order ID</td>
                                <td class="py-1 border text-center  p-4" contenteditable="true">Total Price</td>
                                <td class="py-1 border text-center  p-4" contenteditable="true">Items</td>
                                <td class="py-1 border text-center  p-4" contenteditable="true">Date of creation</td>
                                <td class="py-1 border text-center  p-4" contenteditable="true">User ID</td>
                                <td class="py-1 border text-center  p-4" contenteditable="true">User</td>
                                <td class="py-1 border text-center  p-4" contenteditable="true">Action</td>
                            </tr>
                            </thead>
                            <tbody class="bg-white text-gray-500">
                                <tr class="py-2" v-for="order of latestOrders">
                                    <td class="py-2 border text-center  p-4" contenteditable="true">{{order.order_id}}</td>
                                    <td class="py-2 border text-center  p-4" contenteditable="true">{{order.total_price}}</td>
                                    <td class="py-2 border text-center  p-4" contenteditable="true">{{order.items}}</td>
                                    <td class="py-2 border text-center  p-4" contenteditable="true">{{moment(order.created_at, "YYYYMMDD").fromNow()}}</td>
                                    <td class="py-2 border text-center  p-4" contenteditable="true">{{order.user_id}}</td>
                                    <td class="py-2 border text-center  p-4" contenteditable="true">{{order.first_name}}  {{order.last_name}}</td>
                                    <td class="py-2 border text-center  p-4" contenteditable="true">
                                        <router-link  :to="{name:'app.orders.view',params:{id:order.order_id}}"
                                                      class="flex items-center justify-center cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </template>
            <template v-else>
                <Spinner/>
            </template>
        </div>
        <div class=" bg-white py-6 px-5 text-5xl rounded-lg shadow flex flex-col items-center justify-center">
            <label class="text-lg font-semibold mb-3">Orders By Country</label>
            <template v-if="!loading.orderByCountries">
                <Doughnut :orderByCountries="orderByCountries" style=" max-height: 250px;"/>
            </template>
            <template v-else>
                <Spinner/>
            </template>
        </div>
        <div class=" bg-white py-6 px-5 rounded-lg shadow">
            <label class="text-lg font-semibold mb-3">Latest customers</label>
            <template v-if="!loading.latestCustomers">
                <div v-for="c of latestCustomers" :key="c.id" class="flex">
                    <div class="flex items-center hover:bg-gray-100 w-full p-2 py-4 rounded-md cursor-pointer">
                        <div class="w-12 h-12 bg-gray-300 flex items-center justify-center rounded-full mr-2 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div>
                            <h3>{{c.first_name}} {{c.last_name}}</h3>
                            <p>Email: {{c.email}}</p>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <Spinner/>
            </template>

        </div>
    </div>
</template>

<script setup>
import Doughnut from "../components/core/charts/Doughnut.vue";
import {ref} from "vue";
import moment from 'moment';
import axiosClient from "../axios.js";
import Spinner from "../components/core/spinner.vue";

const loading = ref({
    customerCount:true,
    productsCount:true,
    paidOrders:true,
    totalIncome:true,
    orderByCountries:true,
    latestCustomers:true,
    latestOrders:true
})



const customersCount = ref(0);
const productsCount = ref(0);
const paidOrders = ref(0);
const totalIncome = ref(0);
const orderByCountries = ref({});
const latestCustomers = ref({})
const latestOrders = ref({})

axiosClient.get('/dashboard/customers-count').then(({data})=> {
    customersCount.value = data;
    loading.value.customerCount = false
})
axiosClient.get('/dashboard/products-count').then(({data})=> {
    productsCount.value = data
    loading.value.productsCount = false
})
axiosClient.get('/dashboard/orders-count').then(({data})=> {
    paidOrders.value = data
    loading.value.paidOrders = false;
})
axiosClient.get('/dashboard/income-amount').then(({data})=> {
    totalIncome.value = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD',}).format(data);
    loading.value.totalIncome = false
})

axiosClient.get('/dashboard/orders-by-country').then(({data})=>{
   const chartData = {
    labels:[],
    datasets:[
    {
      backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
      data:[]
    }
    ]
  }

    data.forEach(c=>{
    chartData.labels.push(c.name);
    chartData.datasets[0].data.push(c.count);
  })
    orderByCountries.value = chartData;
   loading.value.orderByCountries = false
})
axiosClient.get('/dashboard/latest-customers').then(({data})=> {
    latestCustomers.value = data
    loading.value.latestCustomers = false;
})

axiosClient.get('/dashboard/latest-orders').then(({data})=> {
    latestOrders.value = data
    loading.value.latestOrders = false;
})
</script>

<style scoped>

</style>
