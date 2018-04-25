<template>
    <footer class="footer">
        <div class="footer__links pl-4">
            <p class="footer__link text-white" ><strong>CSU Student Success Dashboard</strong></p>
            <router-link class="footer__link text-gray" :to="`/research`" >Power Users</router-link>
            <br>
            <router-link class="footer__link text-gray" :to="`/faq`" >FAQ</router-link>
        </div>
        <div class="footer__links pr-4 ml-auto">
            <p class="footer__link text-white text-right"><strong>California State University</strong></p>
            <p class="footer__link text-white text-right"><strong> Office Of The Chancellor</strong></p>
            <a href="#" class="footer__link text-gray pull-right">Contact Us</a>
        </div>
    </footer>
</template>
<script>
export default {
  
}
</script>

