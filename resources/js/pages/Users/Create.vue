<template>
    <v-container
        fluid
        class="mt-5"
    >
        <v-card
            elevation="10"
        >
            <v-card-title>
                <span>User Create</span>
                <v-spacer></v-spacer>
                <v-btn
                    fab
                    dark
                    x-small
                    :retain-focus-on-click="false"
                    class="indigo accent-4 mb-2"
                    to="/users"
                >
                    <v-icon>mdi-arrow-left</v-icon>
                </v-btn>
            </v-card-title>
            <v-form
                ref="user_details"
                v-model="valid"
            >
                <v-container>
                    <v-row>
                        <v-col sm="12" md="4" lg="4">
                            <v-text-field
                                v-model="formData.firstName"
                                :counter="10"
                                label="First name"
                                :rules="rules.name"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="12" md="4" lg="4">
                            <v-text-field
                                v-model="formData.lastName"
                                :counter="10"
                                label="Last name"
                                :rules="rules.name"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="12" md="4" lg="4">
                            <v-text-field
                                v-model="formData.username"
                                :counter="10"
                                label="Username"
                                :rules="rules.username"
                                required
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col sm="12" md="4" lg="4">
                            <v-text-field
                                v-model="formData.email"
                                :counter="10"
                                label="Email"
                                :rules="rules.email"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="12" md="4" lg="4">
                            <v-text-field
                                v-model="formData.password"
                                :counter="10"
                                label="Password"
                                :rules="rules.password"
                                required
                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                            ></v-text-field>
                        </v-col>
                        <v-col sm="12" md="4" lg="4">
                            <v-text-field
                                v-model="formData.repeatPassword"
                                :counter="10"
                                label="Confirm Password"
                                :rules="rules.repeatPassword"
                                required
                                :append-icon="showPasswordRepeat ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPasswordRepeat ? 'text' : 'password'"
                                @click:append="showPasswordRepeat = !showPasswordRepeat"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </v-card>
        <v-card
            class="mt-5"
            elevation="10"
        >
            <v-card-title>
                <span>User Permissions</span>
            </v-card-title>
            <v-form
                ref="user_permissions"
                v-model="valid"
            >
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-select
                                v-model="formData.role"
                                :items="roles"
                                :rules="rules.role"
                                color="indigo accent-4"
                                label="Role"
                                item-text="name"
                                item-value="id"
                                required
                            >
                            </v-select>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <v-autocomplete
                                chips
                                deletable-chips
                                v-model="formData.rolePermissions"
                                :items="permissions"
                                :rules="rules.permissions"
                                color="indigo accent-4"
                                label="Permissions"
                                item-text="name"
                                item-value="id"
                                multiple
                                required
                                clearable
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
                    @click="clearForm"
                >
                    Clear
                </v-btn>
                <v-btn
                    text
                    dark
                    rounded
                    class="indigo accent-4 pa-4"
                    @click="saveUser"
                >
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
import UserService from "../../services/userService"
import RoleService from "../../services/roleService"
import PermissionService from "../../services/permissionService"
import spinnerMixin from "../../mixins/spinnerMixin"

export default {
    name: "Create",
    mixins: [spinnerMixin],

    beforeRouteEnter (to, from, next) {
        RoleService.fetchRoles(to.params.userId).then((roleResponse) => {
            PermissionService.fetchPermissions().then((permissionResponse) => {
                next(vm => {
                    vm.roles = roleResponse
                    vm.permissions = permissionResponse
                })
            })
        })
    },

    data() {
        return {
            roles: [],
            permissions: [],
            formData: {
                firstName: '',
                lastName: '',
                username: '',
                email: '',
                password: '',
                repeatPassword: '',
                role: {},
                rolePermissions: []
            },
            valid: false,
            showPassword: false,
            showPasswordRepeat: false,
            rules: {
                name: [
                    v => !!v || 'Name is required',
                    v => v.length <= 10 || 'Name must be less than 10 characters'
                ],
                username: [
                    v => !!v || 'Username is required',
                    v => v.length <= 10 || 'Username must be less than 10 characters'
                ],
                email: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid',
                    v => v.length <= 70 || 'E-mail must be less than 10 characters'
                ],
                password: [
                    v => !!v || 'Password is required',
                    v => v.length <= 10 || 'Password must be less than 10 characters'
                ],
                repeatPassword: [
                    v => !!v || 'Password confirmation is required',
                    v => v.length <= 10 || 'Password confirmation must be less than 10 characters',
                    v => v === this.formData.password || 'Please confirm your password'
                ],
                role: [
                    v => !!v || 'Role is required'
                ],
                permissions: [
                    v => !!v || 'Permissions are required'
                ]
            }
        }
    },

    computed: {
        role() {
            return this.formData.role
        }
    },

    watch: {
        role: function (role) {
            this.formData.rolePermissions = (this.roles.find(individualRole => individualRole.id === role)).permissions
        }
    },

    methods: {
        saveUser() {
            if (this.$refs.user_details.validate()
                && this.$refs.user_permissions.validate()) {
                UserService.createUser(this.formData).then(() => {
                    this.$router.push('/users')
                })
            }
        },

        clearForm() {
            this.formData.firstName = ''
            this.formData.lastName = ''
            this.formData.username = ''
            this.formData.email = ''
            this.formData.password = ''
            this.formData.repeatPassword =''
            this.formData.role = ''
            this.formData.rolePermissions = ''
        }
    }
}
</script>
