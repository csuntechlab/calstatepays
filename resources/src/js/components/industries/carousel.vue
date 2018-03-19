<template>
  <div class="carousel-view">
	  <transition-group name="carousel-list" class="carousel-list" tag="div">
		  <carousel-card
		  v-for="(carouselCard, index) in carouselCards"
		  class="carouselCard"
		  :data="carouselCard"
		  :key="index"></carousel-card>
		  <!-- <div v-for="(carouselCard,index) in carouselCards" :key="index">
			  {{carouselCard.title}}
		  </div> -->
	  </transition-group>
	<div class='carousel-controls'>
      <button class='carousel-controls__button' @click="previous">prev</button>
      <button class='carousel-controls__button' @click="next">next</button>
    </div>
  </div>
</template>

<script>
import carouselCard from "./carousel-card.vue";

export default {
  data() {
    return {
      carouselCards: [
        {
          title: "Tech",
          percentage: 50,
          rank: 1,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Retail",
          percentage: 25,
          rank: 2,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Med",
          percentage: 20,
          rank: 3,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Chem",
          percentage: 5,
          rank: 4,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Plumbing",
          percentage: 5,
          rank: 4,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Water",
          percentage: 5,
          rank: 4,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        }
      ]
    };
  },
methods: {
    next () {
      const first = this.carouselCards.shift()
      this.carouselCards = this.carouselCards.concat(first)
    },
    previous () {
      const last = this.carouselCards.pop()
      this.carouselCards = [last].concat(this.carouselCards)
    }
  },
  components: {
    carouselCard
  }
};
</script>

<style>
.carousel-view {
  display: flex;
  flex-direction: column;
  height: 15rem;
  justify-content: center;
  align-items: center;
}

.carousel-list {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 45em;
  min-height: 25em;
  /* border: 1em dashed #BACAB9; */
  overflow: hidden;
  /* background-color: #83B4AE; */
}
.carouselCard {
  transform: translateX(5) scale(1.0, 1.0);
  height: 20em;
  /* border: 0.6em dashed #A47565; */
  /* border-radius: 50%; */
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  transition: transform 0.3s ease-in-out;
  opacity: 1;
  margin: 1em;
  flex: 0 0 20em;
}
.carousel-list-enter-active {
	transition: all .3s ease;
}

.carousel-list-move {
	transition: transform 1s;
}

.carousel-list-complete-leave-active {
  position: absolute;
}

.carousel-list-enter {
	transform: translateX(10px);
}
.carouselCard:first-of-type {
  opacity: 0;
}
.carouselCard:last-of-type {
  opacity: 0;
}
/* * {
  border: 1px solid #000000;
} */
</style>
