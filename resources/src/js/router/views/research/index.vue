<template>
    <div>
        <power-banner/>
        <power-users-modal :showModal=displayModal :university=university  v-on:closeModal="closeModal($event)"></power-users-modal>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="returnToCampusSelection">
                            Select a CSU
                        </h2>
                    </div>
                </div>
                <div class="row justify-content-start justify-content-xl-center">
                    <template v-for="item in this.campuses">
                        <c-s-u-tile @click.native="openModal(item)" :key="item.university" :campusImg="item.card_image" :title="item.university" :optIn="item.opt_in" />
                    </template>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
import PowerUsers from '../../../api/powerUser';
import powerBanner from '../../../components/research/power-banner'
import powerUsersModal from '../../../components/research/power-users-modal'
import CSUTile from '../../../components/research/csu-tile'
import {mapGetters} from 'vuex';
export default {
    data(){
        return{
            displayModal:false,
            universityLink:'',
            selectedUniversity:'',
            id:0, 
            campuses: {},
        }
    },
    mounted() {
        PowerUsers.fetchPowerUserTiles(
            success =>{
                this.campuses = success;
            },
            error =>{
                this.$store.dispatch('setError', error)
            }
        )
    },
    methods:{
        closeModal(){
            this.displayModal = false;
        },
        openModal(item){
            if( item.opt_in ) {
                this.displayModal = true;
                this.id = item.id;
            }
        }
    },
    computed:{
        ...mapGetters(['universityById']),
        university(){
            return this.universityById(this.id)
        },
    },
    components: {
        powerBanner,
        powerUsersModal,
        CSUTile
    }
};
</script>
