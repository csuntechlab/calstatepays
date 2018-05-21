<template>
	<div >
		<navigation></navigation>
		<main class="container-fluid no-gutters content-wrapper">
			<router-view></router-view>
		</main>
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