<template>
	<div class="container">
		<div class="row industry-carousel">
			<a href="" class="slide-arrows" @click.prevent="previousIndustries()">
				<span class="fa-angle-left" aria-hidden="true"></span>				
			</a>

			<carousel-card v-for="(industry, index) in industries.slice(industryRange.min, industryRange.max)"
			class="animated slideInLeft" 
			:key="index" 
			:percentage="industry.percentage"
			:image="industry.image"
			:title="industry.title"></carousel-card>
			<!-- <carousel-card :percentage="100" :title="'Test'"></carousel-card>
			<carousel-card :percentage="100" :title="'Test'"></carousel-card>
			<carousel-card :percentage="100" :title="'Test'"></carousel-card> -->

			<a href="" class="slide-arrows" @click.prevent="nextIndustries()">
				<span class="fa-angle-right" aria-hidden="true"></span>				
			</a>
		</div>
	</div>
</template>

<script>
import carouselCard from './carousel-card.vue';

export default {
	props: ['industries'],
	data() {
		return {
			industryRange: {
				min: 0,
				max: 3
			}
		}
	},
    components: {
        carouselCard,
    },
	methods: {
		previousIndustries() {
			if (this.industryRange.min != 0) {
				this.industryRange.min -= 1
				this.industryRange.max -= 1
			}
		},
		nextIndustries() {
			if (this.industryRange.max === this.industries.length) {
				this.industryRange.min = 0;
				this.industryRange.max = 3;
			} 
			else {
				this.industryRange.min += 1
				this.industryRange.max += 1
			}
		}
	}
}
</script>

<style>
	.industry-carousel {
		height: 200px;
	}

	.slide-arrows {
		display: flex;
		align-items: center;
  		justify-content: center;
		width: 50px;
	}
</style>
