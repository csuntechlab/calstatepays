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
          <Tableau :url="url" :height="1000" :width="1000" ref="tableau"></Tableau>
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
  mounted() {
    let uri =
      "https://counts.csun.edu/t/IR/views/CSU7byMajor/CSU7AggregareEarningsData?:isGuestRedirectFromVizportal=y&:embed=y";

    console.log(uri);
    this.url = uri;

    console.log(this.url);
  },
  computed: {
    ...mapGetters(["tableauValue", "tableauServer"])
  }
};
</script>