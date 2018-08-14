<template>
    <div class="container-fluid">
        <div class="row sub-nav">
                <router-link class="d-flex col-4 justify-content-center sub-nav__element" exact-active-class="sub-nav__element--active" to="/data/industries" @click.native="setDataPage('industries')">
                    INDUSTRIES
                </router-link>
                <router-link class="d-flex col-4 justify-content-center sub-nav__element" active-class="sub-nav__element--active" to="/data/majors" @click.native="setDataPage('majors')">
                    MAJORS
                </router-link>
                <router-link class="d-flex col-4 justify-content-center sub-nav__element" active-class="sub-nav__element--active" to="/data/pfre" @click.native="setDataPage('pfre')">
                    FRE
                </router-link>
        </div>
    </div>
</template>
<script>
import {mapActions} from 'vuex';
export default{
    methods: {
        ...mapActions(['setDataPage'])
    }
}
</script>