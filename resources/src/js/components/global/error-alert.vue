<template>
    <div> 
        <v-alert class="errorAlert bg-danger" :value="showAlert" type="error">

   <!-- <i class="fa fa-exclamation-triangle"></i> -->
   {{errorMessage}} 
        <!-- <i role="button"  class = "fa fa-times-circle-o"> </i> -->
    <v-icon @click="closeAlert()" class = "pl-2" medium> fa fa-times-circle fa-lg</v-icon>  
  </v-alert>
    </div>
</template>
<script>
import {mapGetters, mapActions} from 'vuex';
export default {
    name: 'errorAlert',
    data(){
    return {
      //showAlert:false
    }},
    computed:{
        ...mapGetters([
        'errorMessage']),
        showAlert: function(){
           return this.errorMessage != "";
        }
         
    },
    methods:{
        ...mapActions([
            'setError'
        ]),
        closeAlert(){ 
            
            //this.showAlert = false;
            this.$store.dispatch("setError", "");
        }
    }
}
</script>
