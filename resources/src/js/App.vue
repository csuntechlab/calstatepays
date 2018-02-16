<template>
	<div>
		<navigation></navigation>
		<div class="container-fluid">
			<router-view></router-view>
		</div>
	</div>
</template>
<script>
	import navigation from './components/global/navigation.vue'
	export default {
		components: { navigation }
	}
</script>