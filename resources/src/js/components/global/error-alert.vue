<template>
    <div> 
        <v-alert class="errorAlert bg-danger" :value="showAlert" type="error">
            {{errorMessage}}
            <v-icon @click="closeAlert()" class = "pl-2" medium> fa fa-times-circle fa-lg</v-icon>  
        </v-alert>
    </div>
</template>
<script>
import {mapGetters, mapActions} from 'vuex';
export default {
    name: 'errorAlert',
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
            this.$store.dispatch("setError", "");
        }
    }
}
</script>
