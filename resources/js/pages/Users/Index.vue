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
                :items="users"
                :loading="loading"
                loading-text="Fetching users... Please wait"
            >
                <template v-slot:top>
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Manage Users</v-toolbar-title>

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
                        @click="$router.push(`/reservations/${item.id}`)"
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

                <template v-slot:item.role="{ item }">
                    <v-chip dark :color="getColor(item.roles[0].name)">
                        {{ item.roles[0].name }}
                    </v-chip>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import userMixin from "../../mixins/userMixin";

export default {
    name: "Index",
    mixins: [userMixin],

    data() {
        return {
            dialog: false,
            dialogDelete: false,
            headers: [
                { text: 'Username', align: 'start', value: 'username' },
                { text: 'Name', value: 'full_name' },
                { text: 'Email', value: 'email' },
                { text: 'Role', value: 'role' },
                { text: 'Verified', value: 'email_verified_at'},
                { text: 'Actions', value: 'actions'},
            ],
            loading: true
        }
    },

    watch: {
        users: function() {
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
        this.getUsers();
    },

    methods: {
        getColor: function (status) {
            switch (status) {
                case 'admin': return 'blue';
                case 'staff': return 'blue';
                case 'user': return 'gray';
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
            this.deleteReservation(this.editedIndex);
            this.closeDelete();
        },
    }
}
</script>
