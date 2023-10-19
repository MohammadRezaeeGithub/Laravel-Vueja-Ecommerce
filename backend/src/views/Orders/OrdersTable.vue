
<template>
    <div class="bg-white p-4 rounded-lg shadow">
    <div class="flex justify-between border-b-2 pb-3">
      <div class="flex items-center">
        <span class="whitespace-nowrap mr-3">Per page</span>
        <select @change="getOrders(null)" v-model="perPage"
                class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
      <div class="w-2/4">
        <input type="text"
               v-model="search"
               @change="getOrders(null)"
               class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
               placeholder="Type to Search orders ...">
      </div>
    </div>

      <table class="table-auto w-full">
        <thead>
        <tr>
            <TableHeaderCell @click="sortOrder" class="border-b-2 p-2 text-left" field="id" :sort-field="sortField" :sort-direction="sortDirection">ID</TableHeaderCell>
            <TableHeaderCell @click="sortOrder" class="border-b-2 p-2 text-left" :sort-field="sortField" :sort-direction="sortDirection">Customer</TableHeaderCell>
            <TableHeaderCell class="border-b-2 p-2 text-left" field="status" :sort-field="sortField" :sort-direction="sortDirection">Status</TableHeaderCell>
            <TableHeaderCell @click="sortOrder" class="border-b-2 p-2 text-left" field="created_at" :sort-field="sortField" :sort-direction="sortDirection">Date</TableHeaderCell>
            <TableHeaderCell @click="sortOrder" class="border-b-2 p-2 text-left" field="total_price" :sort-field="sortField" :sort-direction="sortDirection">Price</TableHeaderCell>

            <TableHeaderCell field="actions">
                Actions
            </TableHeaderCell>
        </tr>
        </thead>
          <tbody v-if="orders.loading">
            <tr>
                <td>
                    <Spinner v-if="orders.loading" />
                </td>
            </tr>
          </tbody>
        <tbody v-else>
        <tr v-for="order of orders.data">
          <td class="border-b p-2">{{ order.id }}</td>
            <td class="border-b p-2">{{ order.customer.first_name }} {{ order.customer.last_name }}</td>
          <td class="border-b p-2">
            <span>{{ order.status}}</span>
          </td>
          <td class="border-b p-2">{{ order.created_at }}</td>
          <td class="border-b p-2">{{ order.total_price }}</td>

            <td class="border-b p-2 ">
                <router-link :to="{name:'app.orders.view',params:{id:order.id}}" class="w-8 h-8 rounded-full border border-indigo-700 flex items-center justify-center text-indigo-700
                                hover:text-white hover:bg-indigo-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                </router-link>
            </td>
        </tr>
        </tbody>
      </table>
      <!--    the pagination part-->
      <div class="flex justify-between items-center mt-5">
        <span>
            Showing from {{ orders.from }} to {{ orders.to }}
        </span>
          <nav
              v-if="orders.total > orders.limit"
              class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
              aria-label="Pagination"
          >
              <a v-for="(link,i) of orders.links"
                 :key="i"
                 :disabled="!link.url"
                 @click="getForPage($event,link)"
                 aria-current="page"
                 class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                 :class="[
                   link.active
                   ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                   : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                   i === 0 ? 'rounded-l-md' : '',
                   i === orders.links.length - 1 ? 'rounded-r-md' : '',
                   !link.url ? 'bg-gray-100 text-gray-700' : ''
               ]"
                 v-html="link.label"
              ></a>
          </nav>
      </div>
  </div>
</template>

<script setup>


import {computed, onMounted, ref} from "vue";
import store from "../../store/index.js";
import Spinner from "../../components/core/spinner.vue";
import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
import {PRODUCTS_PER_PAGE} from "../../constants.js";

const perPage = ref(PRODUCTS_PER_PAGE);
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import {DotsVerticalIcon,PencilIcon,TrashIcon} from '@heroicons/vue/outline';


const emit = defineEmits(['clickEdit'])
const orders = computed(() => store.state.orders);

onMounted(()=>{
  getOrders();
})

function showOrder(order){
    emit('clickShow',order)
}

function getOrders(url = null){
  store.dispatch('getOrders',{
      url,
      sort_field:sortField.value,
      sort_direction: sortDirection.value,
      search:search.value,
      perPage:perPage.value,
  });
}

function getForPage(ev,link){
    if (!link.url || link.active){
        return;
    }
    getOrders(link.url);
}

function sortOrder(field){
    if (sortField.value == field){
        if (sortDirection.value == 'asc'){
            sortDirection.value = 'desc'
        }else {
            sortDirection.value = 'asc'
        }
    }else {
        sortField.value = field;
        sortDirection.value = 'asc';
    }

    getOrders();
}

function deleteOrder(order){
    if (!confirm('Are you sure that you want to delete the order??')){
        return;
    }

    store.dispatch('deleteOrder',order.id)
        .then(res =>{
            store.dispatch('getorders');
        })
}

</script>

