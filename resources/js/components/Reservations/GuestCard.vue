<template>
    <v-container fluid>
        <v-slide-group
            :show-arrows="true"
        >
            <v-slide-item
                v-for="guest in guests"
                :key="guest.id"
            >
                <v-card
                    rounded
                    max-width="280px"
                    :loading="loading"
                    elevation="10"
                    class="ma-5"
                >
                    <v-img
                        src="../../../images/guest-img-1.jpg"
                        max-height="250"
                    ></v-img>

                    <v-card-text class="pb-0 subtitle-2">
                        <v-row no-gutters>
                            <v-col cols="12">
                                <v-icon small class="icon-color-gray">mdi-card-account-details</v-icon>
                                <span class="pl-1">{{ guest.full_name }}</span>
                            </v-col>
                        </v-row>
                        <v-row no-gutters>
                            <v-col cols="12">
                                <v-icon small class="icon-color-gray">mdi-email</v-icon>
                                <span class="pl-1">{{ guest.email }}</span>
                            </v-col>
                        </v-row>
                        <v-row no-gutters>
                            <v-col cols="12">
                                <v-icon small class="icon-color-gray">mdi-flag</v-icon>
                                <span class="pl-1">{{ guest.nationality }}</span>
                            </v-col>
                        </v-row>
                        <v-row no-gutters>
                            <v-col cols="12">
                                <v-icon small class="icon-color-gray">mdi-phone</v-icon>
                                <span class="pl-1">{{ guest.phone }}</span>
                            </v-col>
                        </v-row>
                        <v-row no-gutters>
                            <v-col cols="12">
                                <v-icon small class="icon-color-gray">mdi-google-maps</v-icon>
                                <span class="pl-1">{{ guest.address }}</span>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions>
                        <span class="pl-1" :class="getColor('pending')">Pending Arrival</span>
                    </v-card-actions>
                </v-card>
            </v-slide-item>
        </v-slide-group>
    </v-container>
</template>

<script>
export default {
    name: "GuestCard",
    props: ["guests"],

    data() {
        return {
            loading: true
        }
    },

    watch: {
        guests: function () {
            this.loading = false;
        }
    },

    methods: {
        getColor: function (status) {
            switch (status) {
                case 'arrived': return 'green--text';
                case 'pending': return 'red--text';
            }
        },
    }
}
</script>

