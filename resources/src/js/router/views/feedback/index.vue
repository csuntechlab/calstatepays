<template>
  <div>
    <feed-back-form/>
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
	methods: {
	} 
};
</script>