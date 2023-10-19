
<template>
  <div class="flex items-center justify-between mb-3 fade-in-down">
    <h1 class="text-3xl font-semibold">Users</h1>
    <button type="submit"
            @click="showUserModal"
            class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500"
    >
      Add new user
    </button>
  </div>
    <UserModal v-model="showModal" :user="userModel" @close="onModalClose"/>
    <UserTable @clickEdit="editUser" />
</template>



<script setup>
import UserTable from "./UserTable.vue";
import UserModal from "./UserModal.vue";
import {ref} from "vue";
import store from "../../store/index.js";

const showModal = ref(false);

const DEFAULT_USER = {
    id: '',
    title: '',
    description: '',
    image: '',
    price: ''
}

const userModel = ref({...DEFAULT_USER})

function showUserModal(){
    showModal.value = true;
}

function editUser(user){
    userModel.value = user
    showUserModal()
}

function onModalClose(){
    userModel.value = {...DEFAULT_USER};
}
</script>

