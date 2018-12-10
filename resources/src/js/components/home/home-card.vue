<template>
    <div class="homeCards">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 px-3 px-lg-5 pb-4 pb-md-0">
                    <router-link class="homeCard__link--major" to="/data/majors" @click.native="setDataPage('majors')">
                        <div class="homeCard__titleAndIconWrapper--major">
                            <div class="row">
                                <div class="col-4 col-sm-3 col-md-12 pr-0 pr-md-3 align-self-center homeCard__iconWrapper--major">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 294.8 152.2" style="enable-background:new 0 0 294.8 152.2;" xml:space="preserve">
                                        <path class="homeCard__icon--major" d="M289.9,5.1C289.5,5,289.1,5,288.8,5c-0.1,0-0.1,0-0.2,0h-12.3V2.5c0-3.3-7.7-3.3-7.7,0V5h-254
                                            C11.4,5,7.4,4.3,4.3,5.3C0.3,6.5,0,10.4,0,13.9V24c0,3.7,0.8,7.4,5.1,8.3c0.5,0.1,1.1,0.2,1.7,0.2c13,0.5,26.2,0,39.3,0H212v74.8
                                            c-6-2.5-12.6-4.2-18.9-5c-16.7-2.2-32.7,2.6-45.6,13.2c-5.1-4.6-11.5-8.1-17.7-10.6c-15-6-31.1-4.6-45.7,1.3V46c0-5.6-8.7-5.6-8.7,0
                                            v66.8c0,3.4,3.6,5.2,6.5,3.7c14.3-7.3,30.7-9.5,45.8-3.2c6.5,2.7,12,6.1,16.4,11c1.6,1.8,4.5,1.6,6.1,0c11.6-11,27-15.9,42.8-13.4
                                            c5.3,0.9,10.6,2.3,15.6,4.4c0.2,0.1,1,0.4,1.9,0.8c0.6,0.3,1.2,0.6,1.9,0.9c0.5,0.3,1.1,0.5,1.6,0.8c0.6,0.4,1.4,0.6,2.1,0.6
                                            c2.4,0,4.4-1.9,4.4-4.3V32.5h48.1v32.9c-2.5,1.3-4.2,3.8-4.5,6.8c-0.1,0.2-0.1,0.5-0.1,0.8c0,0.3,0,0.5,0.1,0.7c0.2,1.9,1,3.6,2.3,5
                                            c-2,1.3-3.6,3-4.7,5.2c-1.4,2.6-1.5,5.3-1.5,8.1c0.1,19.1,0,38.3,0,57.4c0,3.3,5.1,3.3,5.1,0c0-2.9,0-5.8,0-8.7
                                            c0-11.7,0-23.5,0-35.2c0-4.5,0-8.9,0-13.4c0-1.9-0.1-3.8,0.7-5.5c0.8-1.6,2.2-3,3.8-3.9v6.8l0.1,60.4c0,3.2,5.1,3.2,5.1,0v-8.5
                                            l-0.1-58.6c0,0,0.1,0,0.1,0.1c2.2,1.1,3.8,3.1,4.5,5.4c0.5,1.7,0.2,3.8,0.2,5.6c-0.1,18.6,0,37.3,0,55.9c0,3.3,5.1,3.3,5.1,0
                                            c0-3,0-6,0-9c0-12.2,0-24.4,0-36.6c0-4.2,0-8.5,0-12.7c0.2-5-2-9.8-6.4-12.5c1.5-1.5,2.5-3.6,2.5-6c0-3.3-1.8-6-4.5-7.4v-33
                                            c4,0,8,0.2,12,0c0.8,0,1.6-0.1,2.4-0.3c4-1.3,4.3-5.1,4.3-8.6V13.4C295,9.7,294.2,6,289.9,5.1z M8.8,11.4c0-0.1,0-0.2-0.1-0.2
                                            C8.8,11.3,8.8,11.3,8.8,11.4z M6.3,23.7c0.1-0.1,0.2-0.1,0.3,0C6.4,23.7,6.3,23.6,6.3,23.7z M11.2,23.7c-0.7,0-1.6-0.1-2.5-0.1V14
                                            c0-0.1,0-0.2,0-0.4c0.8-0.1,1.5-0.1,2.1-0.1h257.8v10.2H11.2z M269.1,72.9c0.2-4.3,6.7-4.3,6.7,0S269.3,77.2,269.1,72.9z
                                            M276.3,23.7V13.5h10V23c0,0.2,0,0.4,0,0.7H276.3z"/>
                                    </svg>
                                </div>
                                <div class="col-6 col-sm-7 col-md-12 align-self-center p-0">
                                    <h2 class="homeCard__title--major">Verify <br> Majors Pay</h2>
                                </div>
                                <div class="col-2 d-md-none align-self-center">
                                    <i class="homeCard__title--major fa fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="homeCard__Copy--major">Find out earnings for different majors after CSU graduation.</p>
                            </div>
                        </div>
                    </router-link>
                </div>
                <div class="col-12 col-md-4 px-3 px-lg-5 pb-4 pb-md-0">
                    <router-link class="homeCard__link--industries" to="/data/industries" @click.native="setDataPage('industries')">
                        <div class="homeCard__titleAndIconWrapper--industries">    
                            <div class="row">
                                    <div class="col-4 col-sm-3 col-md-12 pr-0 pr-md-3 align-self-center homeCard__iconWrapper--industries">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 251.8 138.5" style="enable-background:new 0 0 251.8 138.5;" xml:space="preserve">
                                            <path class="homeCard__icon--industries0" d="M219,133.5l2.9-61.3c0-0.7-0.2-1.4-0.7-1.9s-1.2-0.8-1.9-0.7l-60.4,3.2V2.5c0-1.4-1.1-2.5-2.5-2.5H91.7 c-1.4,0-2.5,1.1-2.5,2.5v48.2L36.3,45c-0.7-0.1-1.4,0.2-2,0.7c-0.5,0.5-0.8,1.2-0.8,1.9l2.8,86H0v5h251.8v-5H219z M216.7,74.8 l-2.7,58.4h-55.2V77.9L216.7,74.8z M94.2,5h59.6v70.4c0,0,0,0.1,0,0.1v57.7H94.2V53.5V5z M89.2,55.8v77.5H41.3l-2.7-83L89.2,55.8z"/>
                                            <g>
                                                <path class="homeCard__icon--industries0" d="M53.4,121.9h-5v-12h5V121.9z M53.4,98.9h-5v-12h5V98.9z M53.4,75.9h-5v-12h5V75.9z"/>
                                            </g>
                                            <g>
                                                <path class="homeCard__icon--industries0" d="M67.6,121.9h-5v-12h5V121.9z M67.6,98.9h-5v-12h5V98.9z M67.6,75.9h-5v-12h5V75.9z"/>
                                            </g>
                                            <g>
                                                <path class="homeCard__icon--industries0" d="M81.7,121.9h-5v-12h5V121.9z M81.7,98.9h-5v-12h5V98.9z M81.7,75.9h-5v-12h5V75.9z"/>
                                            </g>
                                            <line class="homeCard__icon--industries1" x1="106.1" y1="20.9" x2="141.9" y2="20.9"/>
                                            <line class="homeCard__icon--industries1" x1="106.1" y1="38.9" x2="141.9" y2="38.9"/>
                                            <line class="homeCard__icon--industries1" x1="106.1" y1="56.9" x2="141.9" y2="56.9"/>
                                            <line class="homeCard__icon--industries1" x1="106.1" y1="74.9" x2="141.9" y2="74.9"/>
                                            <line class="homeCard__icon--industries1" x1="106.1" y1="92.9" x2="141.9" y2="92.9"/>
                                            <line class="homeCard__icon--industries1" x1="106.1" y1="110.9" x2="141.9" y2="110.9"/>
                                            <circle class="homeCard__icon--industries2" cx="170.5" cy="97.1" r="4.5"/>
                                            <circle class="homeCard__icon--industries2" cx="187.8" cy="97.1" r="4.5"/>
                                            <circle class="homeCard__icon--industries2" cx="205.2" cy="97.1" r="4.5"/>
                                            <circle class="homeCard__icon--industries2" cx="179.1" cy="115.3" r="4.5"/>
                                            <ellipse transform="matrix(0.1602 -0.9871 0.9871 0.1602 51.1577 290.7485)" class="homeCard__icon--industries2" cx="196.4" cy="115.3" rx="4.5" ry="4.5"/>
                                        </svg>
                                    </div>
                                    <div class="col-6 col-sm-7 col-md-12 align-self-center p-0">
                                        <h2 class="homeCard__title--industries">Verify <br> Industries Pay</h2>
                                    </div>
                                    <div class="col-2 d-md-none align-self-center">
                                        <i class="homeCard__title--industries fa fa-chevron-right"></i>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="homeCard__Copy--industries">Explore where CSU graduates work and what they earn.</p>
                            </div>
                        </div>
                    </router-link>
                </div>
                <div class="col-12 col-md-4 px-3 px-lg-5">
                    <router-link class="homeCard__link--PFRE" to="/data/PFRE" @click.native="setDataPage('PFRE')">
                        <div class="homeCard__titleAndIconWrapper--PFRE">
                            <div class="row">
                                <div class="col-4 col-sm-3 col-md-12 pr-0 pr-md-3 align-self-center homeCard__iconWrapper--PFRE">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 242.8 101.5">
                                        <path class="homeCard__icon--PFRE" d="M37.2 46.2c-0.2-8.7-15.3-7.4-15.4-12.6 0-2.4 1.9-4 5.1-4 3.2-0.1 4.9 0.9 7.1 2.6L36 29.7c-2-1.8-4.2-3.2-7.7-3.4L28.2 20l-2.9 0.1 0.1 6.3c-4.6 0.6-7.7 3.4-7.6 7.4 0.2 8.3 15.3 6.9 15.4 12.8 0.1 2.4-1.9 4.2-5.6 4.2 -3.6 0.1-6.5-1.3-8.9-3l-1.8 2.8c2.7 2.1 5.9 3.3 9.2 3.5L26.2 61l2.9-0.1 -0.1-7C34 53.3 37.3 50.3 37.2 46.2z"/>
                                        <path class="homeCard__icon--PFRE" d="M226.8 46.5c-0.2-8.7-15.3-7.4-15.4-12.6 0-2.4 1.9-4 5.1-4 3.2-0.1 4.9 0.9 7.1 2.6l2.1-2.4c-2-1.8-4.2-3.2-7.7-3.4l-0.1-6.3 -2.9 0.1 0.1 6.3c-4.6 0.6-7.7 3.4-7.6 7.4 0.2 8.3 15.3 6.9 15.4 12.8 0.1 2.4-1.9 4.2-5.6 4.2 -3.6 0.1-6.5-1.3-8.9-3l-1.8 2.8c2.7 2.1 5.9 3.3 9.2 3.5l0.2 6.9 2.9-0.1 -0.1-7C223.6 53.7 226.9 50.7 226.8 46.5z"/>
                                        <path class="homeCard__icon--PFRE" d="M239.3 2.1c-2.2-1.8-5.1-2.5-7.9-1.9 -33 7.2-66.3 11.1-99.6 11.7 -0.6-1-1.6-1.6-2.8-1.6h-15.1c-1.2 0-2.2 0.7-2.8 1.6C77.8 11.3 44.5 7.4 11.4 0.2 8.6-0.4 5.7 0.3 3.5 2.1 1.3 3.9 0 6.6 0 9.4V72.4c0 3 1.4 5.8 3.8 7.7 1.6 1.2 3.5 1.9 5.3 1.9 0.1 0 0.1 0 0.2 0l3.6 12c0.7 2.4 2.3 4.4 4.6 5.6 1.3 0.7 2.8 1.1 4.3 1.1 1 0 2-0.2 3-0.5l84.3-32.2c0.6 0 1.1 0 1.6 0v2.1c0 1.3 0.8 2.4 1.9 2.9v27.8c0 0.7 0.5 1 0.9 0.7l2.8-3 2.8 3c0.4 0.4 0.9 0 0.9-0.6V73.2h3.3v27.5c0 0.6 0.5 1 0.8 0.6l2.9-3.3 2.9 3.3c0.3 0.4 0.8 0 0.8-0.6v-27.9c1-0.6 1.7-1.6 1.7-2.8V67.9c0.9 0 1.8 0.1 2.6 0.1l84.1 32.1c0.9 0.3 1.9 0.5 2.9 0.5 1.5 0 2.9-0.4 4.3-1.1 2.2-1.2 3.9-3.1 4.6-5.5l3.6-12c1.7-0.1 3.4-0.7 4.8-1.9 2.3-1.8 3.7-4.7 3.7-7.6V9.4C242.8 6.6 241.5 3.9 239.3 2.1zM121.5 57.2c-8.5 0-15.4-6.9-15.4-15.4s6.9-15.4 15.4-15.4 15.4 6.9 15.4 15.4S130 57.2 121.5 57.2zM23.4 96.3c-1.4 0.4-2.8 0.3-4.1-0.3 -1.3-0.7-2.2-1.8-2.6-3.1l-3.5-11.6c0 0 0.1 0 0.1 0 13.9-3.5 27.7-6.3 41.2-8.4 1.1-0.2 2.1-0.3 3.2-0.5 0.3 0 0.6-0.1 0.9-0.1 12.5-1.8 25.1-3 37.7-3.7L23.4 96.3zM108.7 63.8c-16.4 0.3-33.2 1.8-50.4 4.3 -0.8 0.1-1.6 0.2-2.4 0.4 -0.7 0.1-1.5 0.2-2.3 0.4 -14.6 2.3-29 5.2-43.4 9 0 0 0 0-0.1 0l0 0c-1.4 0.4-2.8 0-4-0.9C4.8 75.8 4 74.2 4 72.4V9.4c0-1.6 0.7-3.2 2-4.2C7 4.4 8.2 4 9.4 4c0.4 0 0.8 0 1.2 0.1 33.2 7.2 66.6 11.1 100 11.8v9.8c-5.1 3.5-8.5 9.4-8.5 16.1s3.4 12.6 8.5 16.1v5.9L108.7 63.8zM226.8 92.8c-0.4 1.4-1.3 2.5-2.6 3.2 -1.3 0.7-2.7 0.8-4 0.4l-72.6-27.7c27.4 1.7 54.9 6 82.6 12.8L226.8 92.8zM238.8 72.4c0 1.7-0.8 3.4-2.2 4.5 -0.9 0.7-1.8 1-2.8 1.1l-0.5-0.1c-33.9-8.6-67-13.3-98.5-14l-2.6 0v-5.8c5.3-3.5 8.8-9.4 8.8-16.2s-3.5-12.7-8.7-16.2v-9.6c33.4-0.7 66.8-4.6 100-11.8 1.6-0.3 3.3 0 4.6 1.1 1.3 1 2 2.6 2 4.2V72.4z"/>
                                    </svg>
                                </div>
                                <div class="col-6 col-sm-7 col-md-12 align-self-center p-0">
                                    <h2 class="homeCard__title--PFRE">Verify CSU Degrees Pay</h2>
                                </div>
                                <div class="col-2 d-md-none align-self-center">
                                    <i class="homeCard__title--PFRE fa fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="homeCard__Copy--PFRE">What’s the return on a CSU education. Find out the costs and benefits.</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    data() {
		return {
			url: "",
			isShowing: false,
		};
    },
    methods: {
		...mapActions(['setDataPage'])
	} 
}
</script>
