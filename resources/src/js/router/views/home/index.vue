<template>
	<div>
		<home-banner/>
		<div class="container">
			<home-card/>
		</div>		
		<home-video/>
	</div>
</template>
<script>
import landingPageCarousel from "../../../components/global/landing-page-carousel";
import csuSelector from "../../../components/global/csu-selector.vue";
import homeCard from "../../../components/home/home-card.vue"
import homeBanner from "../../../components/home/home-banner.vue";
import homeVideo from "../../../components/home/home-video.vue";
import {mapActions} from 'vuex';
export default {
	data() {
		return {
			url: ""
		};
	},
	created() {
		this.url = window.baseUrl;
	},
	components: {
		csuSelector,
		landingPageCarousel,
		homeCard,
		homeBanner,
		homeVideo
	}, 
	methods: {
		...mapActions(['setDataPage'])
	} 
};
</script>