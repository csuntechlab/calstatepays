<template>
    <div>
        <power-banner/>
        <power-users-modal :showModal=displayModal :university=university  v-on:closeModal="closeModal($event)"></power-users-modal>
        <main>
            <div class="container">
                <div>
                    <div class="col-12">
                        <h2 class="returnToCampusSelection">
                            Select a CSU
                        </h2>
                    </div>
                </div>
                <div class="row justify-content-start justify-content-xl-center">
                    <active-c-s-u-tile :campus="campus.AllCSU.img" :title="campus.AllCSU.title"/>
                    <active-c-s-u-tile :campus="campus.CSUN.img" :title="campus.CSUN.title"/>
                    <opt-out-c-s-u-tile :campus="campus.CSULB.img" :title="campus.CSULB.title"/>
                    <opt-out-c-s-u-tile :campus="campus.CSULA.img" :title="campus.CSULA.title"/>
                    <opt-out-c-s-u-tile :campus="campus.CSUF.img" :title="campus.CSUF.title"/>
                    <opt-out-c-s-u-tile :campus="campus.CSUDH.img" :title="campus.CSUDH.title"/>
                    <opt-out-c-s-u-tile :campus="campus.CSUCI.img" :title="campus.CSUCI.title"/>
                    <opt-out-c-s-u-tile :campus="campus.CSUP.img" :title="campus.CSUP.title"/>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
/*
    @click="displayModal = true; id=0;"
    @click="displayModal = true ; id=70;"
*/
import powerBanner from '../../../components/research/power-banner'
import powerUsersModal from '../../../components/research/power-users-modal'
import ActiveCSUTile from '../../../components/research/active-csu-tile'
import OptOutCSUTile from '../../../components/research/opt-out-csu-tile'
import {mapGetters} from 'vuex';
export default {
    data(){
        return{
            displayModal:false,
            // universityName:'',
            universityLink:'',
            selectedUniversity:'',
            id:0,
            campus:{
                AllCSU: {
                    img: window.baseUrl  + '/img/csucampuses/allcsu.png',
                    title: 'Aggregate Data Across the 7 CSUs'
                },
                CSUN: {
                    img: window.baseUrl + '/img/csucampuses/northridge.png',
                    title: 'California State University Northridge'
                },
                CSULB: {
                    img: window.baseUrl + '/img/csucampuses/longBeach.png',
                    title: 'California State University Long Beach'
                }, 
                CSULA: {
                    img: window.baseUrl + '/img/csucampuses/losAngeles.png',
                    title: 'California State University Los Angeles'
                },
                CSUF: {
                    img: window.baseUrl + '/img/csucampuses/fullerton.png',
                    title: 'California State University Fullerton'
                },
                CSUDH: {
                    img: window.baseUrl + '/img/csucampuses/dominguezHills.png',
                    title: 'California State University Dominguez Hills'
                },
                CSUCI: {
                    img: window.baseUrl + '/img/csucampuses/channelIslands.png',
                    title: 'California State University Channel Islands'
                },
                CSUP: {
                    img: window.baseUrl + '/img/csucampuses/pomona.png',
                    title: 'Cal Poly Pomona'
                } 
            }
        }
    },
    methods:{
        closeModal(){
            this.displayModal = false;
        }
    },
    computed:{
        ...mapGetters(['universityById']),
        university(){
            return this.universityById(this.id)
        }
    },
    components: {
        powerBanner,
        powerUsersModal,
        ActiveCSUTile,
        OptOutCSUTile
    }
};
</script>
