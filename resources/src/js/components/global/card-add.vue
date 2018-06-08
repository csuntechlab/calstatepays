<template>
    <div class="card-add col col-lg-10 d-flex flex-row">
        <div class="col col-1">

            <button class="btn-add">
                <i class="fa fa-plus-circle" @click="onPlus"></i>
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props: ['onPlus']
}
</script>
