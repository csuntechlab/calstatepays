<template>
    <div>
        <footer class="footer" id="main-footer">
            <div class="footer__links pl-4">
                <router-link class="footer__link text-white" :to="`/research`" >Power Users</router-link>
                <br>
                <router-link class="footer__link text-white" :to="`/faq`" >FAQ</router-link>
            </div>
            <div class="footer__links pr-4 ml-auto">
                <p class="footer__link text-white text-right"><strong>California State University</strong></p>
                <router-link class="footer__link text-white pull-right" :to="`/feedback`">Feedback</router-link>
            </div>
        </footer>
        <div class="footer-meta" id="footer-meta" :class="{ 'footer-meta--data': this.onData }">
            <div class="row">
                <div class="col-md-3 col-12">
                    <a href="//www.csun.edu/academic-affairs/meta-lab" target="csun">
                        <img class="footer-meta__logo mb-2 mb-md-0" :src="this.url + '/img/otherLogos/metalab-logo.svg'" alt="META+LAB Logo">
                    </a>
                </div>
                <div class="col-md-9 col-12 text-md-right">
                    <a href="//www.csun.edu/academic-affairs/meta-lab" target="csun">
                        Built by students at California State University Northridge META+LAB 
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            url: "",
        };
    },
    created() {
        this.url = window.baseUrl
    },
    computed: {
        onData(){
            return (this.$route.name === 'majors' || this.$route.name === 'pfre' || this.$route.name === 'industries')
        }
    }
}
</script>

