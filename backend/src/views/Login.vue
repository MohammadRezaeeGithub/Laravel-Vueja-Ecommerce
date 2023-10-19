<template>
<GuestLayout title="Sign in to your account">
    <form  class="space-y-6" method="POST" @submit.prevent="login">
        <div v-if="errorMsg" class="flex items-center justify-between py-3 px-5 bg-red-600 text-white rounded-md">
            {{ errorMsg }}
            <span @click="errorMsg = ''"
                  class="flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-black/20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
</svg>
            </span>
        </div>
        <div>
            <label class="block text-sm font-medium leading-6 text-gray-900" for="email">Email address</label>
            <div class="mt-2">
                <input id="email"
                       autocomplete="email"
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                       name="email"
                       required=""
                       v-model="user.email"
                       type="email"/>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label class="block text-sm font-medium leading-6 text-gray-900" for="password">Password</label>
                <div class="text-sm">
                    <router-link :to="{name:'resetPassword'}" class="font-semibold text-indigo-600 hover:text-indigo-500" href="#">Forgot password?</router-link>
                </div>
            </div>
            <div class="mt-2">
                <input id="password"
                       autocomplete="current-password"
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                       name="password"
                       required=""
                       v-model="user.password"
                       type="password"/>
            </div>
            <div class="flex items-center mt-2">
                <input id="remember"
                       v-model="user.remember"
                       class=" rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                       type="checkbox"/>
                <label class="ml-4 text-sm font-medium leading-6 text-gray-900" for="remember">remember me</label>
            </div>
        </div>

        <div>
            <button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    type="submit"
                    :disabled="loading"
                    :class="{
                        'cursor-not-allowed':loading,
                        'hover:bg-indigo-400':loading
                    }"
            >
                <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Sign in
            </button>
        </div>
    </form>
</GuestLayout>
</template>

<script setup>
import GuestLayout from "../components/GuestLayout.vue";
import {ref} from "vue";
import store from "../store/index.js";
import {useRouter} from "vue-router";

const router = useRouter();

let loading = ref(false);
let errorMsg = ref('');

const user = {
    'email':'',
    'password':'',
    'remember':false
}

function login(){
    loading.value = true;
    store.dispatch('login',user)
        .then(()=>{
            loading.value = false;
            router.push({name:'app.dashboard'});
        })
        .catch(({response})=>{
          console.log(response);
            loading.value = false;
            errorMsg.value = response.data.message;
        })
}
</script>
