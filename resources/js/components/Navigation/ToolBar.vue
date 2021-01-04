<template>
    <v-app-bar
       app
       clipped-left
       class="indigo accent-4"
       dark
    >
        <v-toolbar-title>B-Space</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
            <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>
    </v-app-bar>
</template>

<script>
export default {
    name: "ToolBar",

    computed: {
        mini() {
            return this.$vuetify.breakpoint.mdAndDown;
        },
    }
}
</script>
