<template>
	<div class="graphContent">
		<div class="container">
			<feed-back-form/>
		</div>
	</div>
</template>

<script>
import feedBackForm from "../../../components/feedback/feedback-form";
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
		feedBackForm
	},
	methods: {}
};
</script>