<template>
    <div class="row mt-2 csu-wrapper">
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1139" title="Currently Unavailable">
                <img :src="this.url + '/img/csuseals/long_beach_seal.svg'" alt="CSU Long Beach Seal">
                <figcaption>Long Beach</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1144" title="Currently Unavailable">
                <img :src="this.url + '/img/csuseals/poly_seal.svg'" alt="CSU Pomona Seal">
                <figcaption>Pomona</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1141" title="Currently Unavailable">
                <img :src="this.url + '/img/csuseals/dominguez_seal.svg'" alt="CSU Dominguez Hills Seal">
                <figcaption>Dominguez Hills</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="unselected-university" id="70" @click="selectUniversity(70)">
                <img :src="this.url + '/img/csuseals/northridge_seal.svg'" alt="CSU Northridge Seal">
                <figcaption>Northridge</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="39803" title="Currently Unavailable">
                <img :src="this.url + '/img/csuseals/channel_islands_seal.svg'" alt="CSU Channel Islands Seal">
                <figcaption>Channel Islands</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1137" title="Currently Unavailable">
                <img :src="this.url + '/img/csuseals/fulleton_seal.svg'" alt="CSU Fullerton Seal">
                <figcaption>Fullerton</figcaption>
            </button>
        </figure>
        <figure class="col-md col-sm-4 col-4 text-center">
            <button class="disabled-university" id="1140" title="Currently Unavailable">
                <img :src="this.url + '/img/csuseals/los_angeles_seal.svg'" alt="CSU Los Angeles Seal">
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
        console.log("TESTING: Global campus state is set to " + this.selectedUniversity);
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