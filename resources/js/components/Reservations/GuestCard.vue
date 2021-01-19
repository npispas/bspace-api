<template>
   <v-container fluid>
        <v-card
            elevation="10"
        >
            <v-tabs
                v-model="tab"
            >
                <v-tabs-slider color="indigo accent-4"></v-tabs-slider>
                <v-tab
                    class="ma-0"
                    v-for="guest in guests"
                    :key="guest.id"
                >
                    {{ guest.full_name }}
                </v-tab>
            </v-tabs>
        </v-card>
        <v-card
            class="mt-5"
            elevation="10"
        >
            <v-tabs-items v-model="tab">
                <v-tab-item
                    v-for="guest in guests"
                    :key="guest.id"
                >
                    <v-card flat>
                        <v-img
                            v-if="guest.image"
                            :src="guest.image.url"
                            max-height="250"
                        ></v-img>
                        <v-img
                            v-else
                            src="/images/guest-img.jpg"
                            max-height="250"
                        >
                        </v-img>

                        <v-card-title>Guest Details</v-card-title>

                        <v-card-text>
                            <v-row>
                                <v-col cols="12" sm="12" md="6" lg="6">
                                    <span><strong>{{ guest.first_name }}</strong></span>
                                    <br>
                                    <span class="text-subtitle-2 text-muted">First Name</span>
                                </v-col>
                                <v-col cols="12" sm="12" md="6" lg="6">
                                    <span><strong>{{ guest.last_name }}</strong></span>
                                    <br>
                                    <span class="text-subtitle-2 text-muted">Last Name</span>
                                </v-col>
                                <v-col cols="12" sm="12" md="6" lg="6">
                                    <span><strong>{{ guest.email }}</strong></span>
                                    <br>
                                    <span class="text-subtitle-2">Email</span>
                                </v-col>
                                <v-col cols="12" sm="12" md="6" lg="6">
                                    <span><strong>{{ guest.nationality }}</strong></span>
                                    <br>
                                    <span class="text-subtitle-2 text-muted">Nationality</span>
                                </v-col>
                                <v-col cols="12" sm="12" md="6" lg="6">
                                    <span><strong>{{ guest.phone }}</strong></span>
                                    <br>
                                    <span class="text-subtitle-2 text-muted">Phone</span>
                                </v-col>
                                <v-col cols="12" sm="12" md="6" lg="6">
                                    <span><strong>{{ guest.status }}</strong></span>
                                    <br>
                                    <span class="text-subtitle-2 text-muted">Status</span>
                                </v-col>
                                <v-col cols="12" sm="12" md="12" lg="12">
                                    <span><strong>{{ guest.address }}</strong></span>
                                    <br>
                                    <span class="text-subtitle-2 text-muted">Address</span>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs-items>
        </v-card>
   </v-container>
</template>

<script>
export default {
    name: "GuestCard",
    props: ["guests"],

    data() {
        return {
            tab: null,
            loading: true
        }
    },

    watch: {
        guests: function () {
            this.loading = false
        }
    },

    methods: {
        getColor: function (status) {
            switch (status) {
                case 'arrived': return 'green--text'
                case 'pending': return 'red--text'
            }
        },
    }
}
</script>

