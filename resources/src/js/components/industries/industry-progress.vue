<template>
    <div>
        <div class="row industry-card__legend">
            <div class="col-3">INDUSTRY</div>
            <div class="col-3">
                <div class="industry-card__legend-percentage"/>PERCENTAGE
            </div>
            <div class="col-6">
                <div class="industry-card__legend-salary"/>AVERAGE EARNINGS
            </div>
        </div>
        <div v-for="(industry,index) in industriesByMajor" :key="index">
            <div class="row industry-card__row">
                <div class="col-3">{{industry.title}}</div>
                <div class="col-9">
                    <div class="row industry-bar__padding">
                        <span class="col-10">
                            <v-progress-linear class="industry-bar" :value="industry.percentage" height="25" color="industry-bar__percentage" background-color="industry-bar__background"/>
                        </span>
                        <div class="col-2 industry-bar__percentage-text">{{industry.percentage}}%</div>
                    </div>
                    <div class="row">
                        <span class="col-10">
                            <v-progress-linear class="industry-bar" :value="50" height="25" color="industry-bar__salary" background-color="industry-bar__background"/>
                        </span>
                        <div class="col-2 industry-bar__salary-text">$$$</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters} from "vuex";
export default {
    computed: {
        ...mapGetters([
            'industriesByMajor'
        ]),
    },
}
</script>

