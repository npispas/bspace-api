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
                            v-if="$can('create', 'Room')"
                            fab
                            dark
                            x-small
                            :retain-focus-on-click="false"
                            class="indigo accent-4 mb-2"
                            to="rooms/create"
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
                <template v-slot:item.room_type="{ item }">
                    {{ item.room_type.name }}
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
                <template v-slot:item.actions="{ item }">
                    <v-icon
                        v-if="$can('edit', 'Room')"
                        small
                        @click=""
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        v-if="$can('view', 'Room')"
                        :class="{'mx-2': $vuetify.breakpoint.mdAndUp}"
                        small
                        @click="$router.push(`/rooms/${item.id}`)"
                    >
                        mdi-eye
                    </v-icon>
                    <v-icon
                        v-if="$can('delete', 'Room')"
                        small
                        @click="deleteItem(item.id)"
                    >
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import RoomService from "../../services/roomService"
import spinnerMixin from "../../mixins/spinnerMixin"

export default {
    name: "Index",
    mixins: [spinnerMixin],

    beforeRouteEnter(to, from, next) {
        RoomService.fetchRooms().then((response) => {
            next(vm => {
                vm.rooms = response
            })
        })
    },

    data() {
        return {
            rooms: [],
            dialog: false,
            dialogDelete: false,
            headers: [
                { text: 'Name', value: 'name', align: 'start' },
                { text: 'Room Type', value: 'room_type' },
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
            this.loading = false
        },
        dialog (val) {
            val || this.close()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },
    },

    methods: {
        getColor: function (status) {
            switch (status) {
                case 1: return 'green'
                case 0: return 'red'
            }
        },

        closeDelete () {
            this.dialogDelete = false
        },

        deleteItem (item) {
            this.editedIndex = item
            this.dialogDelete = true
        },

        deleteItemConfirm () {
            RoomService.deleteRoom(this.editedIndex).then(() => {
                this.rooms.splice(this.rooms.indexOf(this.editedIndex), 1)
            })
            this.closeDelete()
        },
    }
}
</script>
