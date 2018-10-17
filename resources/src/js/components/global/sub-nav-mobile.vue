<template>
    <nav class="sub-nav sub-nav-mobile container-fluid">
        <div class="row">
            <router-link class="col-4 sub-nav-mobile__element" to="/data/majors" active-class="sub-nav-mobile__element--active"  @click.native="setDataPage('majors')">
            <i class="fa fa-cog fa-fw fa-graduation-cap fa-2x" aria-hidden="true"></i>
            <span>Majors</span>
            </router-link>

            <router-link class="col-4 sub-nav-mobile__element" active-class="sub-nav-mobile__element--active"  to="/data/industries" @click.native="setDataPage('industries')">
            <i class="fa fa-cog fa-fw fa-industry fa-2x" aria-hidden="true"></i>
            <span>Industries</span>
            </router-link>
            <router-link class="col-4  sub-nav-mobile__element" active-class="sub-nav-mobile__element--active" to="/data/pfre" @click.native="setDataPage('pfre')">
            <i class="fa fa-cog fa-fw fa-usd fa-2x" aria-hidden="true"></i>
            <span>FRE</span>
            </router-link>
        </div>
    </nav>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    name: "mobile-nav",
    created: function() {
        this.toggleShowNavOnLoad();
    },
    methods: {
        ...mapActions(['setDataPage']),
        toggleShowNavOnLoad() {
            var URL = window.location.href;
            if (URL.includes("industries")) {
                this.setDataPage("industries");
            } else if (URL.includes("pfre")) {
                this.setDataPage("pfre");
            }
        },
    }
}
</script>
