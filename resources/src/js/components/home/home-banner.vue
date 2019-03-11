<template>
    <div class="homeBanner">
        <h1 class="m-0">
            <img class="homeBanner__CSPLogo" :src="this.url + '/img/homeimages/CSP-logo-black.svg'" alt="Cal State Pays"/>
        </h1>
        <p class="m-0">
            <img class="homeBanner__Tagline" :src="this.url + '/img/homeimages/visions-verified.svg'" alt="Visions Verified"/>
        </p>
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
    created() {
        this.url = window.baseUrl
    },
}
</script>
