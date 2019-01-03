<template>
    <div class="homeVideo" ref="homeVideo">
        <div class="homeVideo__btn" @click="playVideo">
            <img :src="this.url + '/img/homeimages/icon-play.png'">
        </div>
        <div class="homeVideo__container">
            <div class="embed-responsive embed-responsive-16by9 homeVideo__wrapper">
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
            videoId: 'JUUR4Hc3qmg',
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
            this.$refs.homeVideo.classList.add("active");
            this.$refs.youtube.player.playVideo()
        },
        ended() {
            this.$refs.homeVideo.classList.add("finished");
            this.$refs.homeVideo.classList.remove("active");

            setTimeout(()=>{
                this.$refs.homeVideo.classList.remove("finished");
            },1200);
        }
    }
}
</script>
