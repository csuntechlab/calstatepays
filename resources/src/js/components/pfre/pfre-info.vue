<template>
  <div>
    <button class="btn-info" type="button">
      <i class="fa fa-question"></i>
    </button>
    <div class="info-bubble">
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
      Consequatur nisi repellat ad! Vel dolorum cum eaque, 
      id voluptatibus non ratione in libero nam officia nulla dolore rem odit corporis quod.
    </div>
  </div>
</template>
<script>
export default {
  data(){
      return {
          showInfo: false,
      }
  },
  methods: {
      toggleInfo(){
          this.showInfo = !this.showInfo;
      }
  },
}
</script>
