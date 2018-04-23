<template>
	<div >
		<navigation></navigation>
		<div class="container-fluid no-gutters">
			<router-view></router-view>
		</div>
		<csu-footer></csu-footer>
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