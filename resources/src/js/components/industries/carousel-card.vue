<template>
    <div class="card w-25 h-100 mx-3" v-bind:style="{ backgroundImage: 'url(' + image + ')' }">  
        <div class="info">
            <h3>{{percentage}}%</h3>
            <h4>{{title}}</h4>
        </div>
    </div>
</template>

<script>
export default {
    props: ['percentage', 'title', 'image'],
    data() {
        return {
            // title: this.title,
        }
    }
}
</script>

<style>
    .card {
        background-position: center;
        background-size: contain;
        flex-direction: row;
    }
    .info {
        color: white;
        align-self: flex-end;
    }
</style>
