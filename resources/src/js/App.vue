<template>
	<div class="container-fluid">
		<navigation></navigation>
		<router-view></router-view>
		<!-- <csu-footer class="footer"></csu-footer> -->
	</div>
</template>
<script>
	import navigation from './components/global/navigation.vue';
	import csuFooter from './components/global/csu-footer.vue';
	export default {
		components: { 
			navigation,
			csuFooter,
		}
	}
</script>