<template>
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-sm-8 col-md-4">
        <a href="https://academics.csun.edu/faculty/richard.moore" target="_blank">
          <img
            class="clients"
            src="https://api.metalab.csun.edu/media/1.1/faculty/media/richard.moore/avatar?source=true"
            alt="Richard Moore"
          />
          <p class="col-xs-6 text-center">Richard Moore <br /> Co-Founder of CalStatePays</p>
        </a>
        <br />
      </div>
      <div class="col-xs-6 col-sm-8 col-md-4">
        <a href="https://academics.csun.edu/faculty/kenneth.chapman" target="_blank">
          <img
            class="clients"
            src="https://api.metalab.csun.edu/media/1.1/faculty/media/kenneth.chapman/avatar?source=true"
          />
          <p class="col-xs-6 text-center client-text">Kenneth Champman <br /> Co-Founder of CalStatePays</p>
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6 col-sm-8 col-md-4">
        <a href="//www.csun.edu/academic-affairs/meta-lab" target="csun">
          <img class="metalogo" :src="metaSvg" :alt="`META+LAB`" />
        </a>
      </div>
      <p class="col-xs-6 col-sm-4 col-md-4 text-center">
        Steve Fitzgerald - Director
        <br />Yazmin Peebles - Assistant Director
        <br />Luis J. G - Project Manager
        <br />Alec N. Marcum - Scrum Master
        <br />Mikkal McNulty - Full Stack Developer
        <br />Jaime Garcia - UI/UX
        <br />Zane Ervin - Front End Developer
        <br />Edge A. Cano - Front End Developer
        <br />Carlos Benavides - Back End Developer
        <br />Michael Chan - Back End Developer
        <br />Jorge A. Ruiz - DevOps
        <br />Ekene Akpati - Marketing
      </p>
    </div>
  </div>
</template>
<script>
export default {
  name: "credits",
  data() {
    return {
      metaSvg: window.baseUrl + "/img/otherLogos/metalab-logo_square.svg"
    };
  },
  created() {
    this.url = window.baseUrl;
  }
};
</script>
