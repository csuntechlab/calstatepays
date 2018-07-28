<template>
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
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'csu-selector',

    props: ['url'],

    computed: {
        ...mapGetters(['selectedUniversity']),
    }
}
</script>