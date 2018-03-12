<template>
    <div class="card mx-3">  
        <div class="info">
            <h3>{{percentage}}%</h3>
            <h4>{{title}}</h4>
        </div>
    </div>
</template>

<script>
export default {
    props: ['percentage', 'title'],
    data() {
        return {
            // title: this.title,
        }
    }
}
</script>

<style>
    .card {
        width: 200px;
        height: 150px;
    }
</style>
