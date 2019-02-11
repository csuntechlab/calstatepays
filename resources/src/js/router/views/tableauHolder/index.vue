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
      if (this.tableauValue === "" || this.tableauValue === null) {
      } else {
        this.url = this.tableauValue;
      }
      let viz = new tableau.Viz(this.$refs.tableau, this.url);
    }
  },
  mounted: function() {
    this.initViz();
  },
  computed: {
    ...mapGetters(["tableauValue"])
  }
};
</script>