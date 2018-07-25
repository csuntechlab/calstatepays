<template>
    <div class="CSUImgBanner">
        <h2 class="CSUImgBanner__campusTitle"> {{ campusName }}</h2>
        <div class="CSUImgBanner__dataInfoWrapper">
            <h3 class="CSUImgBanner__dataTitle"> <span> {{ freTitle }} </span>  </h3>
            <p class="CSUImgBanner__dataCopy"> {{ dummyCopy }} </p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'csu-img-banner',  
    data() {
        return {
            dummyCopy: ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus architecto necessitatibus id quis aliquam laboriosam dignissimos aut veritatis numquam amet, mollitia voluptates laborum magnam ea vero eaque nemo ipsum. Facere.',
            industryTitle: 'Top Industries By Major',
            freTitle: 'Financial Return on Investment',
            campusName: 'California State University Northridge'
        }
    }
  
}
</script>