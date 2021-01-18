<template>
    <v-app-bar
       app
       clipped-left
       class="indigo accent-4"
       dark
    >
        <v-toolbar-title>B-Space</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-title class="text-subtitle-1">{{ username }}</v-toolbar-title>
        <v-menu
            offset-y
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    icon
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-avatar size="36px">
                        <v-img v-if="avatar" :src="avatar.url"></v-img>
                        <v-icon large v-else>mdi-account-circle</v-icon>
                    </v-avatar>
                </v-btn>
            </template>
            <v-list class="pa-0">
                <v-list-item link to="/overview">
                    <v-list-item-icon>
                        <v-icon :size="iconSize">mdi-view-dashboard-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Overview</v-list-item-title>
                </v-list-item>
                <v-list-item v-if="$can('view', 'Reservation')" link to="/calendar">
                    <v-list-item-icon>
                        <v-icon :size="iconSize">mdi-calendar-month</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Calendar</v-list-item-title>
                </v-list-item>
                <v-list-item v-if="$can('view', 'Reservation')" link to="/reservations">
                    <v-list-item-icon>
                        <v-icon :size="iconSize">mdi-format-list-bulleted</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Reservations</v-list-item-title>
                </v-list-item>
                <v-list-item v-if="$can('view', 'Room')" link to="/rooms">
                    <v-list-item-icon>
                        <v-icon :size="iconSize">mdi-office-building-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Rooms</v-list-item-title>
                </v-list-item>
                <v-list-item v-if="$can('view', 'User')" link to="/users">
                    <v-list-item-icon>
                        <v-icon :size="iconSize">mdi-account-multiple</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Users</v-list-item-title>
                </v-list-item>
                <v-list-item link to="/settings">
                    <v-list-item-icon>
                        <v-icon :size="iconSize">mdi-account-cog-outline</v-icon>
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
        </v-menu>
    </v-app-bar>
</template>

<script>
import logoutMixin from "../../mixins/logoutMixin";

export default {
    name: "ToolBar",
    mixins: [logoutMixin],
    props: ['username', 'avatar'],

    computed: {
        mini() {
            return this.$vuetify.breakpoint.mdAndDown
        },

        iconSize() {
            switch (this.$vuetify.breakpoint.name) {
                case "xl": return 'x-large'
                case "lg": return 'large'
                case "md": return 'medium'
                case "sm": return 'small'
                case "xs": return 'x-small'
            }
        }
    },
}
</script>
