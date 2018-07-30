<template>
    <div class="container-fluid">
        <div class="row d-md-flex">
            <div class="col-12 col-md-6 order-6 order-md-2 align-self-md-end p-0">
                <nav class="navbar navbar-expand-md navbar-light p-0">
                    <div class="collapse navbar-collapse justify-content-center" id="nav-list">
                        <ul class="navbar-nav d-flex justify-content-center text-center">
                            <li @click="toggleShowNav()" class="nav-item">
                                <router-link class="nav-link" exact-active-class="hr-nav" to="/industries">
                                    Industries
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
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                url: "",
                isShowing: false
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
        created() {
            this.url = window.baseUrl;
        }
    };
</script>