<template>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 py-3">
        <div class="CSUTile">
            <template v-if="active">
                <div class="CSUTile__Image"  v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8)), url(' + campusImg + ')' }"></div>
            </template>
            <template v-else>
                <div class="CSUTile__Image CSUTile__Image--Opt"  v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url(' + campusImg + ')' }"></div>
            </template>

            <h3 :class="[{ 'CSUTile__CSUName--Opt': !active }, 'CSUTile__CSUName']">{{ title }}</h3>
            
            <template v-if="!active">
                <p class="CSUTile__DisableMessage">Data Not Available At This Time</p>
            </template>
        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    export default {
        props: ["campusImg","title","active"],
        data(){
            return {
            }
        }
    }
</script>
