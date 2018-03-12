<template>
	<div class="container">
		<div class="row industry-carousel">
			<a href="" class="slide-arrows">
				<span class="fa-angle-left" aria-hidden="true"></span>				
			</a>

			<carousel-card v-for="(industry, index) in industries" :key="index" :percentage="industry.percentage" :title="industry.title"></carousel-card>
			<!-- <carousel-card :percentage="100" :title="'Test'"></carousel-card>
			<carousel-card :percentage="100" :title="'Test'"></carousel-card>
			<carousel-card :percentage="100" :title="'Test'"></carousel-card> -->

			<a href="" class="slide-arrows">
				<span class="fa-angle-right" aria-hidden="true"></span>				
			</a>
		</div>
	</div>
</template>

<script>
import carouselCard from './carousel-card.vue';

export default {
	props: ['industries'],
    components: {
        carouselCard,
    }
}
</script>

<style>
	.industry-carousel {
		max-width: 90%;
	}

	.slide-arrows {
		display: flex;
		align-items: center;
  		justify-content: center;
		width: 50px;
	}
</style>
