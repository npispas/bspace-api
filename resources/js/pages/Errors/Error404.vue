<template>
    <v-container fluid>
        <v-card
            flat
        >
            <v-img
                src="/images/error-img.png"
                class="white--text align-end"
            >
            </v-img>

            <v-card-title>Sorry. The page you are looking for does not exist</v-card-title>

            <v-card-text>
                <span class="text-subtitle-1">We may have removed a page to which you found a link, or you may have the wrong address for the page you are looking for. Recommended actions</span>
            </v-card-text>

            <v-card-actions>
                <v-btn dark to="/overview" text class="indigo accent-4">
                    <span>Back to homepage</span>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        name: "Error404"
    }
</script>
