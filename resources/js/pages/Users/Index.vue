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
                        <v-spacer></v-spacer>
                        <v-btn
                            v-if="$can('create', 'User')"
                            fab
                            dark
                            x-small
                            :retain-focus-on-click="false"
                            class="indigo accent-4 mb-2"
                            to="users/create"
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
                        v-if="$can('edit', 'User')"
                        small
                        @click="$router.push(`/users/${item.id}/edit`)"
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        v-if="$can('delete', 'User')"
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
                <template v-slot:item.username="{ item }">
                    <v-avatar size="36px">
                        <v-img src="../../../images/avatar-1.jpg" />
                    </v-avatar>
                        {{ item.username }}
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import spinnerMixin from "../../mixins/spinnerMixin"
import UserService from "../../services/userService"

export default {
    name: "Index",
    mixins: [spinnerMixin],

    beforeRouteEnter(to, from, next) {
        UserService.fetchUsers().then((response) => {
            next(vm => {
                vm.users = response
            })
        })
    },

    data() {
        return {
            users: [],
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
        users() {
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
                case 'admin': return 'blue'
                case 'staff': return 'blue'
                case 'user': return 'gray'
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
            UserService.deleteUser(this.editedIndex).then(() => {
                this.users.splice(this.users.indexOf(this.editedIndex), 1)
            })
            this.closeDelete()
        },
    }
}
</script>
