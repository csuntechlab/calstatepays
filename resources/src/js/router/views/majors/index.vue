<template>
	<div>
		<csu-data-img-banner>
			<h2 class="CSUDataImgBanner__dataTitle" slot="title">
				<span>Major Earnings Over Time</span>
			</h2>
			<p class="CSUDataImgBanner__dataCopy" slot="copy">
				Integer enim est, accumsan eget lobortis eget, pulvinar nec mauris. Nunc nec neque laoreet, consectetur odio et, fringilla
				metus. Etiam eu massa nec lacus hendrerit hendrerit sit amet quis quam.
			</p>
		</csu-data-img-banner>
		<sub-nav/>
		<div class="graphContent" id="majorCardWrapper" @scroll="handleScroll">
			<div class="container">
				<major-card  v-if="isDesktop" v-for="(majorCard, index) in desktopCards" :key="index" :index=index :windowWidth=windowWidth />
				<major-card-mobile v-if="isMobile" v-for="(majorCard, index) in mobileCards" :key="index" :index=index :windowWidth=windowWidth />
				<card-add id="plus" v-on:cardPlusError="scrollToNextCard($event)" />		
			</div>		
		</div>
	</div>
</template>
<script>
	import csuDataImgBanner from "../../../components/global/csu-data-img-banner";
	import cardAdd from "../../../components/global/card-add";
	import majorCard from "../../../components/majors/major-card.vue";
	import majorCardMobile from "../../../components/majors/major-card-mobile.vue";
	import subNav from "../../../components/global/sub-nav.vue";
	import { mapGetters } from "vuex";

	export default {
		data() {
			return {
				windowWidth: 0,
				isDesktop: true,
				isMobile: false,
			};
		},
		computed: {
			...mapGetters(["majorCards"]),
			desktopCards() {
				return this.isDesktop ? this.majorCards : null;
			},
			mobileCards() {
				return this.isDesktop ? null : this.majorCards;
			}
		},
		updated: function () {
			//Only run if more than one card exists
			let lastCardIndex = this.majorCards.length - 1;
			if (lastCardIndex > 0) {
				this.scrollToNextCard(lastCardIndex);
			}
		},
		methods: {
			getWindowWidth(event) {
				this.windowWidth = document.documentElement.clientWidth;
				this.windowWidth < 992
					? ((this.isDesktop = false), (this.isMobile = true))
					: ((this.isDesktop = true), (this.isMobile = false));
			},
			scrollToNextCard(lastCardIndex) {
				let progressBar = document.getElementById(
					"majorCardHasIndex-" + lastCardIndex
				);
				progressBar.scrollIntoView({
					behavior: "smooth",
					block: "end",
					inline: "nearest"
				});
			},
			handleScroll(event) {
				var footer = document.querySelector("footer");
				var bounding = footer.getBoundingClientRect();
				if (
					window.scrollY + window.innerHeight <
					document.body.clientHeight -
					document.getElementById("main-footer").clientHeight
				) {
					var addBtn = document.getElementById("compare-major-button");
					addBtn.style.position = "fixed";
					addBtn.style.bottom = "5rem";
				}
				if (
					window.scrollY + window.innerHeight >
					document.body.clientHeight -
					document.getElementById("main-footer").clientHeight
				) {
					var addBtn = document.getElementById("compare-major-button");
					addBtn.style.position = "fixed";
					addBtn.style.bottom = "11rem";
				}
			}
		},
		mounted() {
			this.$nextTick(function () {
				window.addEventListener("resize", this.getWindowWidth);
				this.getWindowWidth();
			});
		},
		beforeDestroy() {
			window.removeEventListener("resize", this.getWindowWidth);
		},
		created() {
			window.addEventListener("scroll", this.handleScroll);
		},
		destroyed() {
			window.removeEventListener("scroll", this.handleScroll);
		},
		components: {
			majorCard,
			majorCardMobile,
			cardAdd,
			subNav,
			csuDataImgBanner
		}
	};
</script>