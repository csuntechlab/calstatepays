<template>
	<div >
		<navigation/>
		
		<main class="contentWrapper">
			<error-alert>	
		</error-alert>
			<router-view></router-view>
		</main>
		<csu-footer/>
	</div>
</template>
<script>
	import navigation from './components/global/navigation.vue';
	import csuFooter from './components/global/csu-footer.vue';
	import errorAlert from "./components/global/error-alert.vue";
	export default {
		components: { 
			navigation,
			csuFooter,
			errorAlert
		}
	}
</script>