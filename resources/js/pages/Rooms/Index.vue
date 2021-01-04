<template>
    <v-container
        fluid
        class="mt-5"
    >
        <v-card
            elevation="10"
        >
            <v-data-table
                :headers="headers"
                dense
                :items="rooms"
                :loading="loading"
                loading-text="Fetching rooms... Please wait"
            >
                <template v-slot:top>
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Manage Rooms</v-toolbar-title>

                        <v-spacer></v-spacer>

                        <v-btn
                            fab
                            dark
                            x-small
                            :retain-focus-on-click="false"
                            class="indigo accent-4 mb-2"
                            v-on:click.native="$router.push('create')"
                        >
                            <v-icon>mdi-plus</v-icon>
                        </v-btn>

                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>

                <template v-slot:item.actions="{ item }">
                    <v-icon
                        small
                        @click=""
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        :class="{'mx-2': $vuetify.breakpoint.mdAndUp}"
                        small
                        @click="$router.push(`/rooms/${item.id}`)"
                    >
                        mdi-eye
                    </v-icon>
                    <v-icon
                        small
                        @click="deleteItem(item.id)"
                    >
                        mdi-delete
                    </v-icon>
                </template>

                <template v-slot:item.occupancy="{ item }">
                    {{ `${item.min_occupancy} - ${item.max_occupancy}` }}
                </template>

                <template v-slot:item.is_published="{ item }">
                    <v-chip
                        :color="getColor(item.is_published)"
                        dark
                    >
                        {{ item.is_published ? 'Yes' : 'No' }}
                    </v-chip>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>

import roomMixin from "../../mixins/roomMixin";

export default {
    name: "Index",
    mixins: [roomMixin],

    data() {
        return {
            dialog: false,
            dialogDelete: false,
            headers: [
                { text: 'Room ID', align: 'start', value: 'unique_id' },
                { text: 'Name', value: 'name' },
                { text: 'Interior (Sq.M)', value: 'interior_size' },
                { text: 'Occupancy', value: 'occupancy', sortable: false },
                { text: 'Available From', value: 'available_from', sortable: false },
                { text: 'Available To', value: 'available_to', sortable: false },
                { text: 'Location', value: 'location' },
                { text: 'Published', value: 'is_published' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            loading: true
        }
    },

    watch: {
        rooms: function() {
            this.loading = false;
        },
        dialog (val) {
            val || this.close()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },
    },

    mounted() {
        this.getRooms();
    },

    methods: {
        getColor: function (status) {
            switch (status) {
                case 1: return 'green';
                case 0: return 'red';
            }
        },

        closeDelete () {
            this.dialogDelete = false;
        },

        deleteItem (item) {
            this.editedIndex = item;
            this.dialogDelete = true;
        },

        deleteItemConfirm () {
            this.deleteRoom(this.editedIndex);
            this.closeDelete();
        },
    }
}
</script>
