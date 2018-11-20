<template>
    <div class="homepageVideo" ref="homepageVideo">
        <div class="homepageVideo__btn" @click="playVideo">
            <img :src="this.url + '/img/icon-play.png'">
        </div>
        <div class="homepageVideo__container">
            <div class="embed-responsive embed-responsive-16by9 homepageVideo__wrapper">
                <youtube class="embed-responsive-item" :video-id="videoId" :player-vars="playerVars" @ended="ended" ref="youtube"></youtube>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "homeVideo",
    data() {
        return {
            url: '',
            videoId: 'ScMzIvxBSi4',
            playerVars: {
                modestbranding: 1,
                iv_load_policy: 3,
                cc_load_policy: 1
            }
        }
    },
    created() {
        this.url = window.baseUrl;
    },
    methods: {
        playVideo() {
            this.$refs.homepageVideo.classList.add("active");
            this.$refs.youtube.player.playVideo()
        },
        ended() {
            this.$refs.homepageVideo.classList.add("finished");
            this.$refs.homepageVideo.classList.remove("active");

            setTimeout(()=>{
                this.$refs.homepageVideo.classList.remove("finished");
            },1200);
        }
    }
}
</script>
