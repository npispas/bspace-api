<template>
    <v-navigation-drawer
        app
        floating
        clipped
        :mini-variant="mini"
        permanent
    >
        <v-list
            :class="{'ma-5': !mini}"
            rounded
            dense
        >
            <v-list-item link to="/overview">
                <v-list-item-icon>
                    <v-icon :size="iconSize">mdi-view-dashboard</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Overview</v-list-item-title>
            </v-list-item>
            <v-list-item link to="/reservations">
                <v-list-item-icon>
                    <v-icon :size="iconSize">mdi-format-list-bulleted</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Reservations</v-list-item-title>
            </v-list-item>
            <v-list-item link to="/rooms">
                <v-list-item-icon>
                    <v-icon :size="iconSize">mdi-office-building</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Rooms</v-list-item-title>
            </v-list-item>
            <v-list-item link to="/users">
                <v-list-item-icon>
                    <v-icon :size="iconSize">mdi-account-multiple</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Users</v-list-item-title>
            </v-list-item>
            <v-list-item link to="/settings">
                <v-list-item-icon>
                    <v-icon :size="iconSize">mdi-cog</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Settings</v-list-item-title>
            </v-list-item>

            <v-divider></v-divider>

            <v-list-item @click.prevent="logout">
                <v-list-item-icon>
                    <v-icon :size="iconSize">mdi-logout</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Logout</v-list-item-title>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    import logoutMixin from "../../mixins/logoutMixin";
    import FooterSection from "../Sections/FooterSection";

    export default {
        name: "SideNav",
        components: {FooterSection},
        mixins: [logoutMixin],

        data () {
            return {
                drawer: null,
            }
        },

        computed: {
            mini() {
                return this.$vuetify.breakpoint.mdAndDown;
            },

            iconSize() {
                switch (this.$vuetify.breakpoint.name) {
                    case "xl": return 'x-large';
                    case "lg": return 'large';
                    case "md": return 'medium';
                    case "sm": return 'small';
                    case "xs": return 'x-small';
                }
            }
        }
    }
</script>

