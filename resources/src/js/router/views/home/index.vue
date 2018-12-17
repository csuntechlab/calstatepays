<template>
	<div> 
		<home-banner/>
		<home-card/>
		<campus-seals/>
		<home-video/>
		<faq-card/>
	</div>
</template>
<script>
import homeCard from "../../../components/home/home-card.vue"
import homeBanner from "../../../components/home/home-banner.vue";
import campusSeals from "../../../components/home/campus-seals.vue";
import homeVideo from "../../../components/home/home-video.vue";
import faqCard from "../../../components/home/faq-card.vue";
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
		homeCard,
		homeBanner,
		homeVideo,
		faqCard,
		campusSeals,
		homeVideo,
	}, 
	methods: {
		...mapActions(['setDataPage'])
	} 
};
</script>