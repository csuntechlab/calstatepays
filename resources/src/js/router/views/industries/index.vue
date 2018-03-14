<template>
    <div>
	    <carousel :industries="industries"></carousel>				
    </div>
</template>

<script>
import carousel from "../../../components/industries/carousel.vue";

export default {
  data() {
    return {
      industries: [
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

  components: {
    carousel
  }
};
</script>
