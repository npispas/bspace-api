<template>
    <v-app id="inspire" app>

        <tool-bar/>

        <side-nav/>

        <v-main>
            <router-view/>
        </v-main>

        <footer-section/>
    </v-app>
</template>

<script>
import FooterSection from "./Sections/FooterSection";
import SideNav from "./Navigation/SideNav";
import ToolBar from "./Navigation/ToolBar";

export default {
    name: "Root",
    components: {ToolBar, FooterSection, SideNav},
}
</script>
