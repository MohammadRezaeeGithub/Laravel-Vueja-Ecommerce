<template>
    <Doughnut :data="data" :options="options" />
</template>

<script setup>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'


ChartJS.register(ArcElement, Tooltip, Legend)



const data = orderByCountries

const options = {
    responsive: true,
    maintainAspectRatio: false
}

const {orderByCountries} = defineProps({
    orderByCountries:Object
})
</script>
