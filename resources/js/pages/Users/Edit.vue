<template>
    <v-container
        fluid
        class="mt-5"
    >
        <v-card
            :loading="loading"
            elevation="10"
        >
            <v-card-title>
                <span>Edit User <strong>{{ user.full_name }}</strong></span>
                <v-spacer></v-spacer>
                <v-btn
                    fab
                    dark
                    x-small
                    :retain-focus-on-click="false"
                    class="indigo accent-4"
                    to="/users"
                >
                    <v-icon>mdi-arrow-left</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-row no-gutters>
                    <v-col>
                        <v-icon>mdi-account</v-icon>
                        <span class="text-md-subtitle-1">{{ user.username }}</span>
                    </v-col>
                    <v-col>
                        <v-icon>mdi-email</v-icon>
                        <span class="text-md-subtitle-1">{{ user.email }}</span>
                    </v-col>
                    <v-col>
                        <v-icon>mdi-shield-account-outline</v-icon>
                        <span class="text-md-subtitle-1">{{ userRole.name }}</span>
                    </v-col>
                    <v-col>
                        <v-icon>mdi-account-key</v-icon>
                        <span class="text-md-subtitle-1">{{ user.verified_email_at === '' ? 'Unverified' : 'Verified' }}</span>
                    </v-col>
                </v-row>

            </v-card-text>
        </v-card>
        <v-card
            class="mt-5"
            :loading="loading"
            elevation="10"
        >
            <v-card-title>
                <span>Permission Management</span>
            </v-card-title>
            <v-form>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-autocomplete
                                chips
                                deletable-chips
                                v-model="assignedPermissions"
                                :items="permissions"
                                color="indigo accent-4"
                                label="Assigned Permissions"
                                item-text="name"
                                item-value="id"
                                multiple
                            >
                            </v-autocomplete>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    text
                    dark
                    rounded
                    class="indigo accent-4 pa-4"
                    @click="updateUser"
                >
                    Update Now
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
import UserService from "../../services/userService"
import PermissionService from "../../services/permissionService"
import spinnerMixin from "../../mixins/spinnerMixin"

export default {
    name: "Edit",
    mixins: [spinnerMixin],

    beforeRouteEnter(to, from, next) {
        UserService.fetchUser(to.params.userId).then((userResponse) => {
            PermissionService.fetchPermissions().then((permissionResponse) => {
                next(vm => {
                    vm.user = userResponse
                    vm.userRole = userResponse.roles[0]
                    vm.assignedPermissions = userResponse.permissions
                    vm.permissions = permissionResponse
                })
            })
        })
    },

    data() {
        return {
            user: {},
            userRole: {},
            permissions: [],
            assignedPermissions: [],
            loading: true,
        }
    },

    watch: {
        user() {
            this.loading = false
        }
    },

    methods: {
        updateUser() {
            UserService.updateUser(this.$route.params.userId, this.assignedPermissions).then(() => {
                this.$router.push('/users')
            })
        }
    }
}
</script>
