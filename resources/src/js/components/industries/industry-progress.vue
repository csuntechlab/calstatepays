<template>
    <div class="industry-card(not made yet)">
        <div v-for="industry in industries">
            <v-progress-linear class="industry-bar" :value="industry.percentage" height="30" color="industry-bar__percentage"></v-progress-linear>
            <v-progress-linear class="industry-bar" :value="70" height="30" color="industry-bar__salary"></v-progress-linear>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>

