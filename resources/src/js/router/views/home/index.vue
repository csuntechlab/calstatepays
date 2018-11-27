<template>
	<div class="container">
		<!-- <landing-page-carousel class="landing-page-carousel" :url='this.url'/> -->
		<!-- <home-banner/> -->
		<home-card/>
		<!-- <div class="bg mh-90 pt-5">
			<div class="p-0 text-center pt-9">
				<h1 class="m-4 home__heading">Discover Your Earnings After College</h1>
				<div class="row py-2 fa-wrapper">
					<div class="col-md-4 text-center my-3 home__col">
						<div class="home__icon">
							<i class="fa fa-graduation-cap landing-page__icon--cap fa-5x"></i>
						</div>
						<div class="home__subheading">
							<h3>Will you earn more if you graduate?</h3>
						</div>
						<div class="home__copy">
							<p>It pays to go to college. Earnings for graduates are significantly higher than non-graduates.</p>
						</div>
						<router-link class="button-link" to="/data/majors" @click.native="setDataPage('majors')">
							<button class="home-btn home-btn__degrees">
								Explore by Major
							</button>
						</router-link>
					</div>
					<div class="col-md-4 text-center my-3 home__col">
						<div class="home__icon">
							<i class="fa fa-line-chart landing-page__icon--chart fa-5x"></i>
						</div>
						<div class="home__subheading">
							<h3>Where will you work?</h3>
						</div>
						<div class="home__copy">
							<p>Explore industries of employment by major.</p>
						</div>
						<router-link class="button-link" to="/data/industries" @click.native="setDataPage('industries')">
							<button class="home-btn home-btn__majors">
								Explore Industries
							</button>
						</router-link>
					</div>
					<div class="col-md-4 text-center my-3 home__col">
						<div class="home__icon">
							<i class="fa fa-usd landing-page__icon--usd fa-5x"></i>
						</div>
						<div class="home__subheading">
							<h3>What is your financial return on education?</h3>
						</div>
						<div class="home__copy">
							<p>Education costs money, but in the long-term, you will earn more. Find your return on education.</p>
						</div>
						<router-link class="button-link" to="/data/pfre" @click.native="setDataPage('pfre')">
							<button class="home-btn home-btn__pfre">
								Financial Return on Education
							</button>
						</router-link>
					</div>
				</div>
				<div class="row mt-2 csu-wrapper">
					<figure class="col-md col-sm-4 col-4 text-center">
						<img :src="this.url + '/img/csuseals/long_beach_seal.svg'" alt="CSU Long Beach Seal">
						<figcaption>Long Beach</figcaption>
					</figure>
					<figure class="col-md col-sm-4 col-4 text-center">
						<img :src="this.url + '/img/csuseals/poly_seal.svg'" alt="CSU Pomona Seal">
						<figcaption>Pomona</figcaption>
					</figure>
					<figure class="col-md col-sm-4 col-4 text-center">
						<img :src="this.url + '/img/csuseals/dominguez_seal.svg'" alt="CSU Dominguez Hills Seal">
						<figcaption>Dominguez Hills</figcaption>
					</figure>
					<figure class="col-md col-sm-4 col-4 text-center">
						<img :src="this.url + '/img/csuseals/northridge_seal.svg'" alt="CSU Northridge Seal">
						<figcaption>Northridge</figcaption>
					</figure>
					<figure class="col-md col-sm-4 col-4 text-center">
						<img :src="this.url + '/img/csuseals/channel_islands_seal.svg'" alt="CSU Channel Islands Seal">
						<figcaption>Channel Islands</figcaption>
					</figure>

					<figure class="col-md col-sm-4 col-4 text-center">
						<img :src="this.url + '/img/csuseals/fulleton_seal.svg'" alt="CSU Fullerton Seal">
						<figcaption>Fullerton</figcaption>
					</figure>
					<figure class="col-md col-sm-4 col-4 text-center">
						<img :src="this.url + '/img/csuseals/los_angeles_seal.svg'" alt="CSU Los Angeles Seal">
						<figcaption>Los Angeles</figcaption>
					</figure>
				</div>
			</div>
		</div>
		<div class="learn-how row">
			<div class="text-center">
				<h1>Learn How</h1>
				<a href="#video-section">
					<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 5rem; line-height: 1rem;"></i>
				</a>
			</div>
		</div>
		<div id="video-section" class="row">
			<div class="video-placeholder"></div>
		</div> -->
	</div>
</template>
<script>
import landingPageCarousel from "../../../components/global/landing-page-carousel";
import csuSelector from "../../../components/global/csu-selector.vue";
import homeCard from "../../../components/home/home-card.vue"
import homeBanner from "../../../components/home/home-banner.vue";
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
		homeBanner
	}, 
	methods: {
		...mapActions(['setDataPage'])
	} 
};
</script>