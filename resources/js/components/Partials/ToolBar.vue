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
        <v-btn icon>
            <v-avatar size="36px">
                <v-img v-if="image" :src="image.url"></v-img>
                <v-icon large v-else>mdi-account-circle</v-icon>
            </v-avatar>
        </v-btn>
    </v-app-bar>
</template>

<script>
import AuthService from "../../services/authService";

export default {
    name: "ToolBar",

    beforeCreate() {
        AuthService.fetchAuthUser().then(response => {
            this.username = response.username
            this.image = response.image
        })
    },

    data() {
        return {
            username: '',
            image: null
        }
    },

    computed: {
        mini() {
            return this.$vuetify.breakpoint.mdAndDown;
        }
    }
}
</script>
