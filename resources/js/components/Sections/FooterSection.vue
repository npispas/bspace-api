<template>
    <v-footer
        app
        fixed
        padless
        class="z-index-5"
    >
        <v-card
            width="100%"
            elevation="5"
            class="text-center"
            tile
        >
            <v-card-text>
                {{ new Date().getFullYear() }} &copy; <span class="text--blue"><strong>B-Space</strong></span>
            </v-card-text>
        </v-card>
    </v-footer>
</template>

<script>
    export default {
        name: "Footer"
    }
</script>

<style scoped>
 .z-index-5 {
     z-index: 5;
 }
</style>
