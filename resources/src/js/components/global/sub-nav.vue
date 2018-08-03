<template>
    <div class="container-fluid">
        <div class="row sub-nav">
                <router-link class="d-flex col-4 justify-content-center sub-nav__element" exact-active-class="sub-nav__element--active" to="/industries">
                    INDUSTRIES
                </router-link>
                <router-link class="d-flex col-4 justify-content-center sub-nav__element" active-class="sub-nav__element--active" to="/majors">
                    MAJORS
                </router-link>
                <router-link class="d-flex col-4 justify-content-center sub-nav__element" active-class="sub-nav__element--active" to="/pfre">
                    FRE
                </router-link>
        </div>
    </div>
</template>