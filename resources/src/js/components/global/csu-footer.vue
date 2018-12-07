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
                <a href="#" class="footer__link text-white pull-right">Contact Us</a>
            </div>
            <div v-if="routeIsHome" class="footer-mobile-positioning"/>
        </footer>
        <div class="footer-metaphor">
            <!-- <div class="container">
                <div class="row">
                <div class="col-12 col-md-5">
                    <div class="row mb-3 mb-md-0">
                    <div class="col-12 col-md-3">
                        <img class="d-block mx-auto mx-md-0 img-fluid footer-metaphor__emblem mb-3 mb-md-0" src="//s3-us-west-2.amazonaws.com/csun-metalab/metaphor/dist/img/csun-emblem.svg" alt="CSUN Emblem">
                    </div>
                    <div class="col-12 col-md-9">
                        <h6>META+LAB </h6>
                        <div>
                        &copy; California State University, Northridge <br> 
                        18111 Nordhoff Street, Northridge, CA 91330 <br>
                        Phone: <a href="#">(818) 677-1200</a> / <a href="//www.csun.edu/contact" target="csun">Contact Us</a>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="mb-2 mb-lg-1">
                        <a href="//www.csun.edu/emergency/" target="csun">Emergency Information</a>
                        </div>
                        <div  class="mb-2 mb-lg-1">
                        <a href="//www.csun.edu/afvp/university-policies-procedures/"  target="csun">University Policies & Procedures</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 pl-0">
                        <div class="mb-2 mb-lg-1">
                        <a href="//www.csun.edu/sites/default/files/900-12.pdf" target="csun">Terms and Conditions for Use</a>
                        </div>
                        <div class="mb-2 mb-lg-1">
                        <a href="//www.csun.edu/sites/default/files/500-8025.pdf" target="csun">Privacy Policy</a>  
                        </div>
                        <div class="mb-2 mb-lg-1">
                        <a href="//www.csun.edu/it/document-viewers" target="csun">Document Reader</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 px-0">
                        <div>
                        <a href="//www2.calstate.edu" target="csun">California State University</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div> -->
            <div class="footer-metaphor__subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="footer-metaphor__logo mb-3" src="//s3-us-west-2.amazonaws.com/csun-metalab/metaphor/dist/img/metalab-logo.svg" alt="META+LAB Logo">
                            <div class="mb-2 mb-md-0">
                                <a href="//www.metalab.csun.edu" target="csun">metalab.csun.edu</a>
                            </div>
                        </div>
                        <div class="offset-md-6 col-md-4 align-self-center">
                            <div class="text-center text-md-right">
                                Explore. Learn. Go Beyond.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  computed:{
      routeIsHome(){
          return this.$route.path.includes("data")
      }
  }
}
</script>

