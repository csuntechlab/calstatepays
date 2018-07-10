<template>
	<header class="site-header">
        <div class="container-fluid"> 
            <div class="row d-md-flex">
                <div class="col-6 col-md-3 order-2 order-md-1 align-self-center">
                    <router-link class="" to="/">
                        <img :src="this.url + '/img/calstatepays.svg'" class="float-md-left nav-logo mx-auto d-block my-2" alt="Cal State Pays logo">
                    </router-link>
                </div>
                <div class="col-3 d-md-none order-3 align-self-center">
                    <button @click="toggleShowNav()" type="button">
                            <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="col-12 col-md-6 order-6 order-md-2 align-self-md-end p-0">
                    <nav class="navbar navbar-expand-md navbar-light p-0">
                        <div class="collapse navbar-collapse justify-content-center" id="nav-list">
                            <ul class="navbar-nav d-flex justify-content-center text-center">
                                <li @click="toggleShowNav()" class="nav-item">
                                    <router-link  class="nav-link" exact-active-class="hr-nav" to="/">
                                        Home
                                    </router-link>
                                </li>
                                <li @click="toggleShowNav()" class="nav-item">
                                    <router-link class="nav-link" active-class="hr-nav" to="/majors">
                                        Majors
                                    </router-link>
                                </li>
                                <li @click="toggleShowNav()" class="nav-item">
                                    <router-link class="nav-link" active-class="hr-nav" to="/pfre">
                                        <abbr title="Financial Return on Education">FRE</abbr>
                                    </router-link>
                                </li>
                                <li @click="toggleShowNav()" class="nav-item">
                                    <router-link class="nav-link" active-class="hr-nav" to="/faq">
                                        About
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-3 col-md-3 order-1 order-md-3 align-self-center">
                    <div class="navbar-text small mt-1 w-100">
                        <router-link to="/research">
                            <img :src="this.url + '/img/strada-gray.svg'" class="float-right nav-logo-secondary mx-auto d-block" alt="Strada Logo">
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
	</header>
</template>
<script>
export default {
    data () {
        return {
            url: '',
            isShowing: false,
        }
    },
    methods: {
        toggleShowNav() {
            if(window.innerHeight < 768) {
                var element = document.getElementById("nav-list");
                element.classList.toggle("show");
            }
        }
    },
    created () {
        this.url = window.baseUrl;
    }
}
</script>