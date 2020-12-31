<template>
    <div>
        <spinner/>

        <div class="db-wrapper">
            <header-section/>

            <!-- content start -->
            <div class="db-content">
                <div class="container-fluid">
                    <div class="row">

                        <side-nav/>

                        <router-view/>

                    </div>
                </div>
            </div>
            <!-- content close -->

            <footer-section/>
        </div>
    </div>
</template>

<script>

import HeaderSection from "./Sections/HeaderSection";
import FooterSection from "./Sections/FooterSection";
import SideNav from "./Navigation/SideNav";

export default {
    name: "Root",
    components: {FooterSection, HeaderSection, SideNav},
}
</script>
