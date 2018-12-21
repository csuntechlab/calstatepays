<template>
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 py-3">
            <div class="CSUTile">
                <div v-if="optIn === 1" class="CSUTile__Image CSUTile__Image--Active"  v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8)), url(' + campusImg + ')' }"></div>
                <div v-else class="CSUTile__Image CSUTile__Image--Opt"  v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url(' + campusImg + ')' }"></div>
                <h3 :class="[{ 'CSUTile__CSUName CSUTile__CSUName--Opt': optIn === 0 }, 'CSUTile__CSUName']">{{ title }}</h3>
                <div v-if="optIn === 0">
                    <p class="CSUTile__DisableMessage">Data Not Available At This Time</p>
                </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    export default {
        props: ["campusImg","title","optIn"],
    }
</script>
