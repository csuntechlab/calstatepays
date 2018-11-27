<template>
    <nav class="sub-nav container-fluid" v-if="(innerHeight) > (deviceHeight/2)">
        <div class="row">
            <router-link class="col-4 sub-nav__element" active-class="sub-nav__element--active" to="/data/majors" @click.native="setDataPage('majors')">
            <i class="mobile-icon fa fa-cog fa-fw fa-graduation-cap fa-2x" aria-hidden="true"></i>
            <span>Majors</span>
            </router-link>
            <router-link class="col-4 sub-nav__element" exact-active-class="sub-nav__element--active" to="/data/industries" @click.native="setDataPage('industries')">
            <i class="mobile-icon fa fa-cog fa-fw fa-industry fa-2x" aria-hidden="true"></i>
            <span>Industries</span>
            </router-link>
            <router-link class="col-4 sub-nav__element" active-class="sub-nav__element--active" to="/data/pfre" @click.native="setDataPage('pfre')">
            <i class="mobile-icon fa fa-cog fa-fw fa-usd fa-2x" aria-hidden="true"></i>
            <span>FRE</span>
            </router-link>
        </div>
    </nav>
</template>
<script>
import {mapActions} from 'vuex';
export default{
    data() {
        return {
            deviceHeight: 0,
            innerHeight: 0
        }
    },
    created: function() {
        this.toggleShowNavOnLoad()
    },
    methods: {
        ...mapActions(['setDataPage']),
        getDeviceHeight(){
            console.log("getting device");
            this.deviceHeight = window.innerHeight;
        },
        getWindowHeight(event) {
            console.log(window.innerHeight)
            this.innerHeight = window.innerHeight
        },
        toggleShowNavOnLoad() {
            var URL = window.location.href;
            if (URL.includes("industries")) {
                this.setDataPage("industries");
            } else if (URL.includes("pfre")) {
                this.setDataPage("pfre");
            }
        },
        inputIsFocused() {}
    },
    mounted() {
        this.getDeviceHeight();
        this.$nextTick(function(){
            window.addEventListener("resize", this.getWindowHeight);
            this.getWindowHeight();
        })
    },
    beforeDestroy() {
        window.removeEventListener("resize", this.getWindowHeight);
    }
}
</script>