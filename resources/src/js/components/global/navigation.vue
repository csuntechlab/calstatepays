<template>
	<header>
		<nav class="navbar navbar-fixed-top navbar-expand-md navbar-light">
    <div class="d-flex w-100">
      <router-link class="navbar-brand" to="/">
				<img :src="'/img/learnearn-logo.png'" class="img__logo" alt="Cal State Pays logo">
			</router-link>
    </div>
    <div class="navbar-collapse collapse justify-content-center" id="collapsingNavbar">
        <ul class="navbar-nav">
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
    <span class="navbar-text small text-truncate mt-1 w-100 text-right">
    	<img :src="'/img/csumetro.png'" class="img__logo--side" alt="Cal State Pays logo">
    </span>
</nav>
	</header>
</template>
<script>
export default{

}
</script>