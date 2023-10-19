<template>
    <div v-if="currentUser.id" class="min-h-full flex bg-gray-200">
        <!--SIDEBAR-->
        <SideBar :class="{'-ml-[200px]' : !sidebarOpened}"/>
        <!--/SIDEBAR-->
        <div class="flex-1">
            <!--HEADER-->
            <Navbar @toggle-sidebar="toggleSidebar" />
            <!-- END OF THE HEADER-->
            <!-- MAIN CONTENT-->
            <main class="p-8">
                <router-view></router-view>
            </main>
            <!--/ MAIN CONTENT-->
        </div>
    </div>
    <div v-else class="min-h-full flex items-center justify-center bg-gray-200">
        <spinner />
    </div>
</template>


<script setup>
import SideBar from "./SideBar.vue";
import {computed, onMounted, onUnmounted, ref} from "vue";
import Navbar from "./Navbar.vue";
import store from "../store/index.js";
import Spinner from "./core/spinner.vue";

const sidebarOpened = ref(true);
const currentUser = computed(() => store.state.user.data);

const props = defineProps({
    title : String
})

onMounted(()=>{
    store.dispatch('getCurrentUser');
    window.addEventListener('resize',handleSidebarOpened);
});

onUnmounted(()=>{
    window.removeEventListener('resize',handleSidebarOpened);
})

function handleSidebarOpened() {
    if (window.outerWidth <= 768){
        sidebarOpened.value = false;
    }else {
        sidebarOpened.value = true;
    }
}

function toggleSidebar(){
    sidebarOpened.value = !sidebarOpened.value;
}
</script>

