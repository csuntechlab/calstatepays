<template>
	<header class="site-header">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-6 col-md-3 order-2 order-md-1">
                    <router-link class="" to="/">
                        <img :src="'img/calstatepays.svg'" class="float-md-left nav-logo mx-auto d-block" alt="Cal State Pays logo">
                    </router-link>
                </div>
                <div class="col-3 col-md-6 order-6 order-md-2">

                    <nav class="navbar navbar-expand-md navbar-light">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar" aria-controls="collapsingNavbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-center" id="collapsingNavbar">
                            <ul class="navbar-nav d-flex justify-content-center">
                                <li class="nav-item">
                                    <router-link class="nav-link" exact-active-class="hr-nav" to="/">Home
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" active-class="hr-nav" to="/majors">Majors
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" active-class="hr-nav" to="/pfre">
                                    FRE
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" active-class="hr-nav" to="/about">
                                    About
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-3 col-md-3 order-1 order-md-3">
                    <div class="navbar-text small mt-1 w-100">
                        <router-link to="/research">
                            <img src="img/strada-gray.svg" class="float-right nav-logo-secondary mx-auto d-block" alt="">
                        </router-link>
                    </div>
                    <div>
                        
                    </div>
                </div>
            </div>
        </div>
	</header>
</template>
<script>
export default{

}
</script>