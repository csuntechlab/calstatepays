<template>
    <header class="site-header">
        <div class="container-fluid">
            <div class="row">
                <div  class="col-8 col-sm-3 order-2 order-sm-1 align-self-center">
                    <router-link class="" to="/">
                        <img :src="this.url + '/img/calstatepays.svg'" class="float-md-left nav-logo mx-auto d-inline-block" alt="Cal State Pays logo">
                    </router-link>
                    <router-link to="/research">
                        <img :src="this.url + '/img/strada-gray.svg'" class=" nav-logo-secondary mx-auto d-inline-block d-sm-none" alt="Strada Logo">
                    </router-link>
                </div>
                <div class="col-4 d-sm-none order-3 align-self-center hamburger-btn-position">
                    <button @click="toggleShowNav()" type="button">
                        <i id="nav-icon" class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="col-12 col-sm-6 order-6 order-sm-2 align-self-md-end p-0">
                    <nav class="navbar navbar-expand-sm navbar-light p-0">
                        <div class="collapse navbar-collapse justify-content-center" id="nav-list">
                            <ul class="navbar-nav d-flex flex-column flex-sm-row justify-content-center text-center">
                                <li @click="toggleShowNav()" class="nav-item">
                                    <router-link class="nav-link" exact-active-class="hr-nav" to="/">
                                        Home
                                    </router-link>
                                </li>
                                <li @click="toggleShowNav()" class="nav-item">
                                    <router-link class="nav-link" active-class="hr-nav" :to="{ path: '/data/' + selectedDataPage }">
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
                <div class=" d-none d-sm-block col-3 col-md-3  order-3 align-self-center">
                    <div class="navbar-text small w-100">
                        <router-link to="/research">
                            <img :src="this.url + '/img/strada-gray.svg'" class="float-right nav-logo-secondary mx-auto d-sm-block" alt="Strada Logo">
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
