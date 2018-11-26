<template>
    <footer class="footer" id="main-footer">
        <div class="footer__links pl-4">
            <router-link class="footer__link text-white" :to="`/research`" >Power Users</router-link>
            <br>
            <router-link class="footer__link text-white" :to="`/faq`" >FAQ</router-link>
        </div>
        <div class="footer__links pr-4 ml-auto">
            <p class="footer__link text-white text-right"><strong>California State University</strong></p>
            <a href="#" class="footer__link text-white pull-right">Contact Us</a>
        </div>
        <div v-if="!routeIsHome" class="footer-mobile-positioning"/>
    </footer>
</template>
<script>
export default {
  computed:{
      routeIsHome(){
          return this.$route.path == '/'
      }
  }
}
</script>

