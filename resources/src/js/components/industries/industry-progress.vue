<template>
    <div class="industry-card(not made yet)">
        <div v-for="(industry,index) in industriesByMajor" :key="index">
            <div class="row industry-card__row">
                <div class="col-3">{{industry.title}}</div>
                <div class="col-9">
                    <div class="row">
                        <span class="col-10">
                            <v-progress-linear class="industry-bar" :value="industry.percentage" height="30" color="industry-bar__percentage"></v-progress-linear>
                        </span>
                        <div class="col-2">{{industry.percentage}}%</div>
                    </div>
                    <div class="row">
                        <span class="col-10">
                            <v-progress-linear class="industry-bar" :value="50" height="30" color="industry-bar__salary"></v-progress-linear>
                        </span>
                        <div class="col-2">$$$</div>
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

