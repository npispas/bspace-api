<template>
    <v-container
        fluid
        class="mt-5"
    >
        <v-card
            elevation="10"
        >
            <v-card-title>
                <span id="nikos">Manage Account Settings</span>
            </v-card-title>
            <v-form v-model="valid" ref="avatar">
                <v-container>
                    <v-row>
                        <v-col>
                            <v-file-input
                                v-model="formData.image"
                                label="Avatar"
                                prepend-icon="mdi-camera"
                                show-size
                                accept="image/png, image/jpeg, image/bmp"
                                :rules="rules.image"
                            ></v-file-input>
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
                    @click="updateSettings"
                >
                    Update
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
import AuthService from "../services/authService"
import spinnerMixin from "../mixins/spinnerMixin"

export default {
    name: "Settings",
    mixins: [spinnerMixin],

    data() {
        return {
            valid: false,
            formData: {
                image: null
            },
            rules: {
                image: [
                    v => !!v || 'Image is required',
                    file => !file || file.size < 2e6 || 'Avatar size should be less than 2 MB!',
                ],
            }
        }
    },

    methods: {
        updateSettings() {
            if (this.$refs.avatar.validate()) {
                AuthService.saveImage(this.formData.image).then(() => {
                    this.$router.push('/overview')
                })
            }
        }
    }
}
</script>
