<template>
    <carousel
		:perPage='1' 
		:loop='true'
		:autoplay='true' 
		:autoplayTimeout='8000'
		:autoplayHoverPause='true'>
			<slide>
				<landing-page-banner class="landing-page-carousel__slide--top"
				v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(' + url + '/images/graduates-banner.jpg)',}">
					<h1 slot='header' class="landing-page-carousel__header">Do college graduates earn more?</h1>
					<span class="landing-page-carousel__text">It pays to go to college. Earnings for graduates are significanly higher than non-graduates</span>
				</landing-page-banner>
			</slide>
			<slide>
				<landing-page-banner class="landing-page-carousel__slide--centered"
				v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(' + url + '/images/dollars-banner.jpg)',}">
					<h1 slot='header' class="landing-page-carousel__header">What is your financial return?</h1>
					<span class="landing-page-carousel__text">Education costs money but in the long term you will earn more. Find your return on education.</span>
				</landing-page-banner>
			</slide>
			<slide>
				<landing-page-banner class="landing-page-carousel__slide--bottom"
				v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(' + url + '/images/class-banner.jpg)',}">
					<h1 slot='header' class="landing-page-carousel__header">Which majors earn the most?</h1>
					<span class="landing-page-carousel__text">Find out which majors have the highest earnings.</span>
				</landing-page-banner>
			</slide>
		</carousel>
</template>

<script>
import { Carousel, Slide } from "vue-carousel";
import landingPageBanner from "./landing-page-banner";

export default {
    props: ['url'],
    components: {
        landingPageBanner,
        Carousel,
        Slide
    }
}
</script>
