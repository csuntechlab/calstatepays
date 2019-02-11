<template>
  <div>
    <power-banner/>
    <main class="row">
      <div class="container" style="min-height:100vh">
        <div class="row">
          <div class="col-12">
            <router-link to="research" class="returnToCampusSelection">
              <h2>
                <i class="fa fa-arrow-left"></i> Return to CSU Campus Selection
              </h2>
            </router-link>
          </div>
        </div>
        <div class="row">
          <div ref="tableau"></div>
        </div>
      </div>
    </main>
  </div>
</template>
<script>
import powerBanner from "../../../components/research/power-banner";
import { mapGetters } from "vuex";
export default {
  components: {
    powerBanner
  },
  data() {
    return {
      url: ""
    };
  },
  beforeRouteEnter(to, from, next) {
    next(vm => {
      if (vm.tableauValue === "") {
        vm.$router.push("research");
      } else next();
    });
  },
  methods: {
    initViz: function() {
      // this.url = uri;
      console.log(typeof this.tableauValue);
      console.log(this.tableauValue);

      if (this.tableauValue === "" || this.tableauValue === null) {
        // divElement.style.width = "1000px";
        // divElement.style.height = "5rem";
        // divElement.style.backgroundColor = "lightgray";
        // var heading = document.createElement("h1");
        // heading.innerText = "Tableau visual is not available";
        // divElement.appendChild(heading);
      } else {
        this.url = this.tableauValue;
      }
      let viz = new tableau.Viz(this.$refs.tableau, this.url, this.options);
    }
  },
  mounted: function() {
    this.initViz();
  },

  // mounted() {
  //   // let uri =
  //   // "https://counts.csun.edu/t/IR/views/CSU7byMajor/CSU7AggregareEarningsData?:isGuestRedirectFromVizportal=y&:embed=y";

  //   // console.log(uri);
  // },
  computed: {
    ...mapGetters(["tableauValue"])
  }
};
</script>