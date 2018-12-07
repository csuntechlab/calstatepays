<template>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 py-3">
        <div class="CSUTile">
            <div class="CSUTile__Image--Opt" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url(' + campusImg + ')' }"></div>
            <h3 class="CSUTile__CSUName--Opt">{{ title }}</h3>
            <p class="CSUTile__DisableMessage">Data Not Available At This Time</p>
        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    export default {
        props: ["campusImg","title"],
    }
</script>
