<template>
    <div class="card-add col col-lg-10 d-flex flex-row container row align-items-center">
        <div class="col col-1">

            <button class="btn-add" @click="onPlus()">
                <i class="fa fa-plus-circle"></i>
            </button>
        </div>
    </div>
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
