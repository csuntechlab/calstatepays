<template>
	<div class="container-fluid">
		<navigation></navigation>
			<router-view></router-view>
	</div>
</template>
<script>
	import navigation from './components/global/navigation.vue';
	import footer from './components/global/footer.vue';
	export default {
		components: { 
			navigation,
			footer,
		}
	}
</script>