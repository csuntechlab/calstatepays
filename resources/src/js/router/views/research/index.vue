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
                    <template v-for="item in campus">
                        <c-s-u-tile @click.native="openModal(item)" :campusImg="item.img" :title="item.title" :active="item.active" />
                    </template>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
import powerBanner from '../../../components/research/power-banner'
import powerUsersModal from '../../../components/research/power-users-modal'
import CSUTile from '../../../components/research/csu-tile'
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
                    title: 'Aggregate Data Across the 7 CSUs',
                    id: 0,
                    active: true
                },
                CSUN: {
                    img: window.baseUrl + '/img/csucampuses/northridge.png',
                    title: 'California State University Northridge',
                    id: 70,
                    active: true
                },
                CSULB: {
                    img: window.baseUrl + '/img/csucampuses/longBeach.png',
                    title: 'California State University Long Beach',
                    active: false
                }, 
                CSULA: {
                    img: window.baseUrl + '/img/csucampuses/losAngeles.png',
                    title: 'California State University Los Angeles',
                    active: false
                },
                CSUF: {
                    img: window.baseUrl + '/img/csucampuses/fullerton.png',
                    title: 'California State University Fullerton',
                    active: false
                },
                CSUDH: {
                    img: window.baseUrl + '/img/csucampuses/dominguezHills.png',
                    title: 'California State University Dominguez Hills',
                    active: false
                },
                CSUCI: {
                    img: window.baseUrl + '/img/csucampuses/channelIslands.png',
                    title: 'California State University Channel Islands',
                    active: false
                },
                CSUP: {
                    img: window.baseUrl + '/img/csucampuses/pomona.png',
                    title: 'Cal Poly Pomona',
                    active: false
                } 
            }
        }
    },
    methods:{
        closeModal(){
            this.displayModal = false;
        },
        openModal(item){
            if( item.active ) {
                this.displayModal = true;
                this.id = item.id;
            }
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
        CSUTile
    }
};
</script>
