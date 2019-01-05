<template>
	<div>
		<button class="btn-change-campus" @click.prevent="showModal = true" role="button">
			<slot name="change button"></slot>
		</button>

		<v-dialog v-model="showModal" persistent scrollable aria-modal="true">
			<v-card class="text-xs-center black--text campus-modal" v-if="universities[0]">
				<v-card-title class="headline grey lighten-2">Choose a Campus</v-card-title>
				<v-card-text>
					<div class="row">
						<div
							class="col-12 col-sm-6 col-md-3 col-lg"
							v-for="(item, index) in orderedUniversities"
							:key="index"
							@dblclick="onSubmit()"
						>
							<template v-for="(universitySeal, index2) in universitySeals">
								<template v-if="universitySeal.short_name == item.short_name">
									<template v-if="item.opt_in === 1">
										<!-- if a campus is selected, make the corresponding radio button checked -->
										<template v-if="aCampusIsSelected && selectedUniversity == item.short_name">
											<input
												class="campus-modal-item__radio"
												type="radio"
												name="campuses"
												:id="item.short_name"
												checked
											>
										</template>
										<template v-else>
											<input
												class="campus-modal-item__radio"
												type="radio"
												name="campuses"
												:id="item.short_name"
											>
										</template>

										<div class="campus-modal-item clearfix">
											<label :for="item.short_name">
												<figure class="campus-modal-item__figure">
													<div class="campus-modal-item__imgWrapper">
														<img :src="universitySeal.url">
													</div>
													<figcaption class="campus-modal-item__name">{{universitySeal.name}}</figcaption>
												</figure>
											</label>
										</div>
									</template>
									<template v-else>
										<div class="campus-modal-item campus-modal-item--opted-out clearfix">
											<input
												class="campus-modal-item__radio"
												disabled
												type="radio"
												name="campuses"
												:id="item.short_name"
											>
											<label :for="item.short_name">
												<figure class="campus-modal-item__figure">
													<div class="campus-modal-item__imgWrapper">
														<img :src="universitySeal.url">
													</div>
													<figcaption class="campus-modal-item__name">
														{{universitySeal.name}}
														<div class="campus-modal-item__coming-soon">Coming Soon</div>
													</figcaption>
												</figure>
											</label>
										</div>
									</template>
								</template>
							</template>
						</div>
					</div>
				</v-card-text>
				<v-card-actions class="justify-content-center flex-wrap">
					<div
						v-if="showValidationMsg"
						class="campus-modal__error"
						id="campus-modal__error"
					>* Select a campus to proceed</div>
					<div>
						<span
							v-if="aCampusIsSelected"
							class="btn btn-secondary campus-modal__btn"
							@click.prevent="showModal = false"
						>Cancel</span>
						<button
							type="submit"
							class="btn btn-success campus-modal__btn"
							@click.prevent="onSubmit()"
						>Select Campus</button>
					</div>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
	name: "campus-modal",
	data() {
		return {
			aCampusIsSelected: false,
			showModal: false,
			showValidationMsg: false,
			universitySeals: [
				{
					url: window.baseUrl + "/img/csuseals/all.svg",
					name: "All 7 Campuses",
					short_name: "all"
				},
				{
					url:
						window.baseUrl +
						"/img/csuseals/channel_islands_seal.svg",
					name: "Channel Island",
					short_name: "channel_islands"
				},
				{
					url: window.baseUrl + "/img/csuseals/dominguez_seal.svg",
					name: "Dominguez Hills",
					short_name: "dominguez_hills"
				},
				{
					url: window.baseUrl + "/img/csuseals/fullerton_seal.svg",
					name: "Fullerton",
					short_name: "fullerton"
				},
				{
					url: window.baseUrl + "/img/csuseals/long_beach_seal.svg",
					name: "Long Beach",
					short_name: "long_beach"
				},
				{
					url: window.baseUrl + "/img/csuseals/los_angeles_seal.svg",
					name: "Los Angeles",
					short_name: "los_angeles"
				},
				{
					url: window.baseUrl + "/img/csuseals/northridge_seal.svg",
					name: "Northridge",
					short_name: "northridge"
				},
				{
					url: window.baseUrl + "/img/csuseals/poly_seal.svg",
					name: "Pomona",
					short_name: "pomona"
				}
			]
		};
	},
	created() {
		document.addEventListener("keyup", this.onEscKey);
	},
	mounted() {
		this.$nextTick(function() {
			this.checkSessionData();
			this.onClickOutsideModal();
		});
	},
	computed: {
		...mapGetters([
			"universities",
			"selectedUniversity",
			"selectedDataPage"
		]),
		orderedUniversities: function() {
			return _.orderBy(this.universities, ["short_name"], ["asc"]);
		}
	},
	methods: {
		...mapActions(["setUniversity"]),
		onClickOutsideModal: function() {
			var self = this;
			document.addEventListener(
				"click",
				function(event) {
					if (event.target.classList.contains("v-overlay")) {
						if (self.aCampusIsSelected == true) {
							self.showModal = false;
						} else {
							self.showValidationMsg = true;
						}
					}
				},
				false
			);
		},
		onEscKey(event) {
			if (event.keyCode === 27) {
				if (this.aCampusIsSelected == true) {
					this.showModal = false;
				} else {
					this.showValidationMsg = true;
				}
			}
		},
		onSubmit: function() {
			var radioBtns = document.querySelectorAll("[name='campuses']");

			for (var i = 0; i < radioBtns.length; i++) {
				if (radioBtns[i].checked) {
					this.changeCampus(radioBtns[i].id);
					this.showValidationMsg = false;
					return;
				} else {
					this.showValidationMsg = true;
				}
			}
		},
		changeCampus: function(university) {
			if (this.selectedUniversity != university) {
				sessionStorage.setItem("selectedUniversity", university);
				this.$store.dispatch("setUniversity", university);
				this.$store.dispatch("resetMajorState");
				this.$store.dispatch("resetIndustryState");
				this.$store.dispatch("resetFreState");
				this.$store.dispatch("fetchMajors", university);
				this.$store.dispatch("fetchFieldOfStudies", university);
			}
			this.showModal = false;
			this.aCampusIsSelected = true;
		},
		checkSessionData() {
			var sessionData = sessionStorage.getItem("selectedUniversity");
			if (sessionData === null) {
				this.showModal = true;
				this.aCampusIsSelected = false;
			} else {
				this.$store.dispatch("setUniversity", sessionData);
				this.aCampusIsSelected = true;
			}
		}
	}
};
</script>
