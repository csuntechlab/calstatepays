<template>
     <!-- <div v-if="showAlert" class="alert alert-danger error" role="alert">
        {{errorMessage.message}}
        <button type="button" class="close pl-2" aria-label="Close" >
            <span @click="closeAlert()" aria-hidden="true">&times;</span>
        </button>
    </div>  -->
    <div> 
        <v-alert class="error bg-danger"
       dismissible
      :value="showAlert"   
      color="success"
      transition="scale-transition"
    >
   <i class="fa fa-exclamation-triangle">
       </i> {{errorMessage.message}} 
        <!-- <i role="button" @click="closeAlert()" class="fa fa-times-circle-o fa-lg"></i>    -->
       </v-alert>
    </div>
</template>
<script>
import {mapGetters, mapActions} from 'vuex';
export default {
    name: 'errorAlert',
    data(){
    return {
      
    }},
    computed:{
        ...mapGetters([
        'errorMessage']),
         showAlert: function(){
             return  this.errorMessage;
        }
    },
    methods:{
        ...mapActions([
            'setError'
        ]),
        closeAlert(){ 
            
            // this.showAlert = false;
            this.$store.dispatch("setError", "");
        }
    }
}
</script>
