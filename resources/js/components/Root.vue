<template>
    <v-app id="inspire" app>
        <tool-bar v-if="this.$root.$data.authUser"
            :username="this.$root.$data.authUser.username"
            :avatar="this.$root.$data.authUser.image"
        />

        <side-nav/>

        <spinner/>

        <v-main>
            <router-view/>
        </v-main>

        <footer-section/>
    </v-app>
</template>

<script>
import FooterSection from "./Partials/FooterSection"
import SideNav from "./Partials/SideNav"
import ToolBar from "./Partials/ToolBar"
import Spinner from "./Elements/Spinner"

export default {
    name: "Root",
    components: {Spinner, ToolBar, FooterSection, SideNav},
}
</script>
