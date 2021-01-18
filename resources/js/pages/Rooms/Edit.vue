<template>
    <v-container
        fluid
        class="mt-5"
    >
        <v-card
            elevation="10"
        >
            <v-card-title>
                <span>Edit Room <strong>{{ room.name }}</strong></span>
                <v-spacer></v-spacer>
                <v-btn
                    fab
                    dark
                    x-small
                    :retain-focus-on-click="false"
                    class="indigo accent-4 mb-2"
                    to="/rooms"
                >
                    <v-icon>mdi-arrow-left</v-icon>
                </v-btn>
            </v-card-title>
            <v-form v-model="valid" ref="room_type">
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-select
                                v-model="formData.roomType"
                                :items="roomTypes"
                                :rules="rules.roomType"
                                color="indigo accent-4"
                                label="Room Type"
                                item-text="name"
                                item-value="id"
                                required
                            >
                            </v-select>
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
                <span>Room Details</span>
            </v-card-title>
            <v-form v-model="valid" ref="room_details">
                <v-container>
                    <v-row>
                        <v-col>
                            <v-text-field
                                v-model="formData.name"
                                :counter="20"
                                label="Room name"
                                :rules="rules.name"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col>
                            <v-text-field
                                v-model="formData.location"
                                :counter="20"
                                label="Location"
                                :rules="rules.location"
                                required
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-text-field
                                v-model="formData.interiorSize"
                                :counter="10"
                                label="Interior Size"
                                :rules="rules.interiorSize"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col>
                            <v-text-field
                                v-model="formData.minOccupancy"
                                :counter="10"
                                label="Min Occupancy"
                                :rules="rules.minOccupancy"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col>
                            <v-text-field
                                v-model="formData.maxOccupancy"
                                :counter="10"
                                label="Max Occupancy"
                                :rules="rules.maxOccupancy"
                                required
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
                <span>Room Description</span>
            </v-card-title>
            <v-form v-model="valid" ref="room_description">
                <v-container>
                    <v-row>
                        <v-col>
                            <v-textarea
                                v-model="formData.description"
                                :counter="150"
                                outlined
                                label="Room Description"
                                :rules="rules.description"
                                required
                            ></v-textarea>
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
                <span>Room Availability</span>
            </v-card-title>
            <v-form v-model="valid" ref="room_availability">
                <v-container>
                    <v-row>
                        <v-col>
                            <v-text-field
                                type="date"
                                v-model="formData.availableFrom"
                                label="Available From"
                                :rules="rules.availableFrom"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col>
                            <v-text-field
                                type="date"
                                v-model="formData.availableTo"
                                label="Available To"
                                :rules="rules.availableTo"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col>
                            <v-switch
                                :false-value="0"
                                :true-value="1"
                                v-model="formData.isPublished"
                                label="Room published"
                                required
                            ></v-switch>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </v-card>
        <v-container
            v-if="roomImages.length"
            class="mt-5"
            fluid
        >
            <v-slide-group
                :show-arrows="true"
                >
                <v-slide-item
                    v-for="image in roomImages"
                    :key="image.id"
                >
                    <v-hover v-slot="{ hover }">
                        <v-card
                            id="images"
                            :elevation="hover ? 12 : 2"
                            :class="{ 'on-hover': hover }"
                            rounded
                            max-width="280px"
                            elevation="10"
                            class="ma-3"
                        >
                            <v-img
                                :src="image.url"
                                height="225px"
                            >
                                <v-card-title class="title white--text">
                                    <v-row
                                        class="fill-height flex-column"
                                        justify="space-between"
                                    >
                                        <div class="align-self-center">
                                            <v-btn
                                                x-large
                                                :class="{ 'show-btns': hover }"
                                                :color="'rgba(255, 255, 255, 0)'"
                                                icon
                                                @click="deleteImage(room.id, image.id)"
                                            >
                                                <v-icon
                                                    x-large
                                                    :class="{ 'show-btns': hover }"
                                                    :color="'rgba(255, 255, 255, 0)'"
                                                >mdi-delete-forever</v-icon>
                                            </v-btn>
                                        </div>
                                    </v-row>
                                </v-card-title>
                            </v-img>
                        </v-card>
                    </v-hover>
                </v-slide-item>
            </v-slide-group>
        </v-container>
        <v-card
            class="mt-5"
            elevation="10"
        >
            <v-card-title>
                <span>Room Images</span>
            </v-card-title>
            <v-form v-model="valid" ref="room_images">
                <v-container>
                    <v-row>
                        <v-col>
                            <v-file-input
                                v-model="formData.images"
                                label="Room Images"
                                prepend-icon="mdi-camera"
                                show-size
                                multiple
                                accept="image/png, image/jpeg, image/bmp"
                                :rules="rules.images"
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
                    @click="updateRoom"
                >
                    Update
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
import RoomService from "../../services/roomService"
import RoomTypeService from "../../services/roomTypeService"
import spinnerMixin from "../../mixins/spinnerMixin"

export default {
    name: "Edit",
    mixins: [spinnerMixin],

    beforeRouteEnter(to, from, next) {
        RoomTypeService.fetchRoomTypes().then((roomTypeResponse) => {
            RoomService.fetchRoom(to.params.roomId).then((roomResponse) => {
                next(vm => {
                    vm.roomTypes = roomTypeResponse
                    vm.room = roomResponse
                    vm.roomImages = vm.room.images
                    vm.formData.roomType = vm.room.room_type.id
                    vm.formData.name = vm.room.name
                    vm.formData.location = vm.room.location
                    vm.formData.interiorSize = vm.room.interior_size
                    vm.formData.minOccupancy = vm.room.min_occupancy
                    vm.formData.maxOccupancy = vm.room.max_occupancy
                    vm.formData.availableFrom = vm.room.available_from
                    vm.formData.availableTo = vm.room.available_to
                    vm.formData.isPublished = vm.room.is_published
                    vm.formData.description = vm.room.description
                })
            })
        })
    },

    data() {
        return {
            room: {},
            roomImages: [],
            roomTypes: [],
            formData: {
                roomType: {},
                name: '',
                location: '',
                interiorSize: null,
                minOccupancy: null,
                maxOccupancy: null,
                availableFrom: '',
                availableTo: '',
                isPublished: 0,
                description: '',
                images: null,
            },
            valid: false,
            rules: {
                roomType: [
                    v => !!v || 'Room Type is required',
                ],
                name: [
                    v => !!v || 'Room Name is required',
                    v => v.length < 20 || 'Room Name must be less than 10 characters'
                ],
                location: [
                    v => !!v || 'Location is required',
                    v => v.length < 20 || 'Room Name must be less than 10 characters'
                ],
                interiorSize: [
                    v => !!v || 'Interior Size is required',
                    v => Number.isInteger(Number(v)) || 'Interior Size must be a positive integer',
                    v => v > 10 || 'Interior Size may not be less than 10 Sq.M'
                ],
                minOccupancy: [
                    v => !!v || 'Min Occupancy is required',
                    v => Number.isInteger(Number(v)) || 'Min Occupancy must be a positive integer',
                    v => v > 0 || 'Min Occupancy must be at least one person'
                ],
                maxOccupancy: [
                    v => !!v || 'Max Occupancy is required',
                    v => Number.isInteger(Number(v)) || 'Max Occupancy must be a positive integer',
                    v => v > 0 || 'Max Occupancy must be at least one person'
                ],
                description: [
                    v => !!v || 'Description is required',
                    v => v.length > 10 || 'Description must be at least than 10 characters'
                ],
                images: [
                    v => !!v || 'Image is required',
                    files => !files || !files.some(file => file.size > 2e6) || 'Image size should be less than 2 MB!',
                ],
                availableFrom: [
                    v => !!v || 'Available From is required',
                ],
                availableTo: [
                    v => !!v || 'Available To is required',
                ]
            }
        }
    },

    methods: {
        updateRoom() {
            if (this.$refs.room_type.validate()
                && this.$refs.room_details.validate()
                && this.$refs.room_description.validate()
                && this.$refs.room_availability.validate()
                && this.$refs.room_images.validate()) {
                RoomService.updateRoom(this.$route.params.roomId, this.formData).then(() => {
                    for (let i = 0; i < this.formData.images.length; i++) {
                        RoomService.saveImage(this.$route.params.roomId, this.formData.images[i])
                    }
                    this.$router.push('/rooms')
                })
            }
        },

        deleteImage(roomId, imageId) {
            RoomService.deleteImage(roomId, imageId).then(() => {
                this.roomImages.splice(this.roomImages.indexOf(imageId), 1)
            })
        }
    }
}
</script>

<style scoped>
.v-card#images {
    transition: opacity .4s ease-in-out;
}

.v-card#images:not(.on-hover) {
    opacity: 0.4;
}

.show-btns {
    color: rgba(255, 255, 255, 1) !important;
}
</style>
