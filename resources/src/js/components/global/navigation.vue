<template>
	<header>
		<nav class="navbar navbar-expand-md navbar-light col col-12">
            <div class="col col-md-5">
                <router-link class="navbar-brand" to="/">
				    <img :src="'/img/calstatepays.svg'" class="nav-logo" alt="Cal State Pays logo">
			    </router-link>
            </div>
            <div class="collapse navbar-collapse col col-md-7" id="collapsingNavbar">
                <div class="justify-content-end col col-md-6" >
                    <ul class="navbar-nav ">
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
                            PFRE
                            </router-link>
                        </li>
                    </ul>
                </div>
                <span class="navbar-text small mt-1 w-100 col col-md-6">
                    <img src="img/strada-gray.svg" class="nav-logo-secondary pull-right" alt="">
                </span>
            </div>
        </nav>
	</header>
</template>
<script>
export default{

}
</script>