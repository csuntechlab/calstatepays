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
                            <a class="nav-link" href="#">Home</a>
                            <hr class="hr-nav">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Majors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">PFRE</a>
                        </li>
                    </ul>
                </div>
                <span class="navbar-text small mt-1 w-100 col col-md-6">
                    <router-link to="/research">
                        <img src="img/strada-gray.svg" class="nav-logo-secondary pull-right" alt="">
                    </router-link>
                </span>
            </div>
        </nav>
	</header>
</template>
<script>
export default{

}
</script>