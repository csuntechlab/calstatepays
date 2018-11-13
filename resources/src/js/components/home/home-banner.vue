<template>
    <div class="homeBanner">
        <img class="homeBanner__CSPLogo" :src="this.url + '/img/homeimages/CSP-logo-black.svg'" alt="Cal State Pays"/>
        <img class="homeBanner__Tagling" :src="this.url + 'img/homeimages/visions-verified.svg'" alt="Visions Verified"/>
    </div>
</template>

<script>
export default {
    data() {
		return {
			url: "",
			isShowing: false,
		};
	},
}
</script>
