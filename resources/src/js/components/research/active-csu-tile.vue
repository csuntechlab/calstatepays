<template>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 py-3">
        <div class="CSUTile">
            <div class="CSUTile__Image" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.65)), url(' + campus + ')' }"></div>
            <h3 class="CSUTile__CSUName">{{ title }}</h3>
        </div>
    </div>
</template>

<script>
/*
@click="displayModal = true; id=0;"
*/
    import {mapGetters,mapActions} from 'vuex';
    export default {
        props: ["campus","title"],
        data(){
            return {
            }
        }
        
    }
</script>
