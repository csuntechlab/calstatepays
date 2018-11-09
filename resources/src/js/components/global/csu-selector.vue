<template>
    <div class="row mt-2 csu-wrapper">
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1139">
                <img :src="this.url + '/img/csuseals/long_beach_seal.svg'" alt="California State University, Long Beach Seal">
                <figcaption>Long Beach</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1144">
                <img :src="this.url + '/img/csuseals/poly_seal.svg'" alt="California State University, Pomona Seal">
                <figcaption>Pomona</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1141">
                <img :src="this.url + '/img/csuseals/dominguez_seal.svg'" alt="California State University, Dominguez Hills Seal">
                <figcaption>Dominguez Hills</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="unselected-university" id="70" @click="selectUniversity(70)">
                <img :src="this.url + '/img/csuseals/northridge_seal.svg'" alt="California State University, Northridge Seal">
                <figcaption>Northridge</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="39803">
                <img :src="this.url + '/img/csuseals/channel_islands_seal.svg'" alt="California State University, Channel Islands Seal">
                <figcaption>Channel Islands</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1137">
                <img :src="this.url + '/img/csuseals/fulleton_seal.svg'" alt="California State University, Fullerton Seal">
                <figcaption>Fullerton</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1140">
                <img :src="this.url + '/img/csuseals/los_angeles_seal.svg'" alt="California State University, Los Angeles Seal">
                <figcaption>Los Angeles</figcaption>
            </button>
        </figure>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
	name: "csu-selector",

	props: ["url"],

	computed: {
		...mapGetters(["selectedUniversity"])
	},

	mounted() {
        if(this.selectedUniversity!=null)
            document.getElementById(this.selectedUniversity).className = "";
	},

	methods: {
		selectUniversity(id) {
			let previousSelect = (document.getElementsByClassName = "");
			if (previousSelect)
				previousSelect[0].className = "unselected-university";
			document.getElementById(id).className = "";
			this.$store.dispatch("setUniversity", id);
		}
	}
};
</script>