<template>
    <button class="btn-add" @click="onPlus()">
        <i class="fa add-icon">+ <span class="tooltiptext">Compare Major</span> </i>
    </button>
</template>
<script>
export default {
    methods: {
        onPlus(){
            this.$store.dispatch('addMajorCard');
        }
    }
}
</script>
