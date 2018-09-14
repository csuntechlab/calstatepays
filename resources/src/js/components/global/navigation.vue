<template>
    <header class="site-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 col-md-3 order-2 order-md-1 align-self-center">
                    <router-link class="" to="/">
                        <img :src="this.url + '/img/calstatepays.svg'" class="float-md-left nav-logo mx-auto d-block" alt="Cal State Pays logo">
                    </router-link>
                </div>
                <div class="col-3 d-md-none order-3 align-self-center hamburger-btn-position">
                    <button @click="toggleShowNav()" type="button">
                        <i id="nav-icon" class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="col-12 col-md-6 order-6 order-md-2 align-self-md-end p-0">
                    <nav class="navbar navbar-expand-md navbar-light p-0">
                        <div class="collapse navbar-collapse justify-content-center" id="nav-list">
                            <ul class="navbar-nav d-flex justify-content-center text-center">
                                <li @click="toggleShowNav()" class="nav-item">
                                    <router-link class="nav-link" exact-active-class="hr-nav" to="/">
                                        Home
                                    </router-link>
                                </li>
                                <li @click="toggleShowNav()" class="nav-item">
                                    <router-link class="nav-link" :class="dataTabHighlight()" :to="{ path: '/data/' + selectedDataPage }">
                                        Data
                                    </router-link>
                                </li>
                                <li @click="toggleShowNav()" class="nav-item">
                                    <router-link class="nav-link" active-class="hr-nav" to="/faq">
                                        FAQ
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-3 col-md-3 order-1 order-md-3 align-self-center">
                    <div class="navbar-text small w-100">
                        <router-link to="/research">
                            <img :src="this.url + '/img/strada-gray.svg'" class="float-right nav-logo-secondary mx-auto d-block" alt="Strada Logo">
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div id="nav-overlay"></div>
    </header>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
	data() {
		return {
			url: "",
			isShowing: false,
		};
	},
	methods: {
		toggleShowNav() {
			var showCheck = document.getElementById("nav-list");
			if (showCheck.classList.contains("show")) {
				var navItem = document.getElementById("nav-list");
				navItem.classList.remove("show");
				var navIcon = document.getElementById("nav-icon");
				navIcon.classList.remove("fa-times");
				navIcon.classList.add("fa-bars");
				document.getElementById("nav-overlay").style.display = "none";
			} else {
				var navItem = document.getElementById("nav-list");
				navItem.classList.add("show");
				var navIcon = document.getElementById("nav-icon");
				navIcon.classList.remove("fa-bars");
				navIcon.classList.add("fa-times");
				document.getElementById("nav-overlay").style.display = "block";
			}
        },
        dataTabHighlight() {
            if(this.$route.path == '/data/majors' || this.$route.path == '/data/industries' || this.$route.path == '/data/pfre')
                return 'hr-nav'
        }
    },
    computed: {
        ...mapGetters(['selectedDataPage']),
    },
	created() {
		this.url = window.baseUrl;
	}
};
</script>
