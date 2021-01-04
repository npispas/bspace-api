<template>
    <v-container fluid>
        <v-card
            :loading="loading"
            rounded
            elevation="10"
        >
            <v-card-title>
                <span>Description</span>
            </v-card-title>
            <v-card-text>
                <span class="text-md-subtitle-2">{{ room.description }}</span>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "RoomDescriptionCard",
    props: ['room'],

    data() {
        return {
            loading: true
        }
    },

    watch: {
        room: function () {
            this.loading = false;
        }
    },
}
</script>
