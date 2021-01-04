<template>
    <div class="col-xl-8 col-lg-7 col-md-10 col-sm-10 col-10">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- pageheader start  -->
                <div class="db-pageheader d-flex justify-content-between">
                    <div class="">
                        <h2 class="db-pageheader-title">Add New Room</h2>
                        <p class="db-pageheader-text"> Add your new listing for office space.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <router-link to="/rooms" class="btn btn-primary">Back to rooms</router-link>
                    </div>
                </div>
                <!-- pageheader close  -->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- card header  -->
                <div class="db-card listing-category">
                    <div class="db-card-header">
                        <h3 class="db-card-header-title">Select Room Type</h3>
                    </div>
                    <div class="db-card-body">



                    </div>
                </div>
                <!-- card header  -->
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="db-card listing-details">
                    <div class="db-card-header">
                        <h3 class="db-card-header-title">Room Details</h3>
                    </div>
                    <div class="db-card-body">
                        <!-- listing form start -->
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" v-model="name" placeholder="Your Room title" required="">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" v-model="location" placeholder="Room Location" required="">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="interior_size">Interior Size</label>
                                    <input type="number" class="form-control" id="interior_size" v-model="interiorSize" placeholder="Interior size in Sq.M">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="min_occupancy">Minimum Occupancy</label>
                                    <input type="number" class="form-control" id="min_occupancy" v-model="minOccupancy" placeholder="Guest Minimum Occupancy">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="min_occupancy">Maximum Occupancy</label>
                                    <input type="number" class="form-control" id="max_occupancy" v-model="maxOccupancy" placeholder="Guest Maximum Occupancy">
                                </div>
                            </div>
                        </form>
                        <!-- listing form close  -->
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- listing form price start  -->
                <div class="db-card listing-price">
                    <div class="db-card-header">
                        <h3 class="db-card-header-title">Room Availability</h3>
                        <div class="db-card-body">
                            <!-- listing form start -->
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="available_from">Available from</label>
                                        <input type="date" class="form-control" id="available_from" v-model="availableFrom" placeholder="Interior size in Sq.M">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="available_to">Available to</label>
                                        <input type="date" class="form-control" id="available_to" v-model="availableTo" placeholder="Guest Minimum Occupancy">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="is_published">Publish immediately</label>
                                        <input type="checkbox" class="custom-checkbox" id="is_published" v-model="isPublished">
                                    </div>
                                </div>
                            </form>
                            <!-- listing form close  -->
                        </div>
                    </div>
                    <!-- listing form price close  -->
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- listing form desc start  -->
                <div class="db-card listing-description">
                    <div class="db-card-header">
                        <h3 class="db-card-header-title">Room Description</h3>
                    </div>
                    <div class="db-card-body">
                        <textarea class="form-control" id="description" v-model="description">Next, use our Get Started docs to setup Tiny!</textarea>
                    </div>
                </div>
                <!-- listing form desc close  -->
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="db-card listing-photo">
                    <div class="db-card-header">
                        <h3 class="db-card-header-title">Photos</h3>
                    </div>
                    <div class="db-card-body">
                        <!-- listing dropzone start  -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                            </div>
                        </div>
                        <!-- listing dropzone close  -->
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <button type="submit" class="btn btn-primary" v-on:click.prevent="createRoom">Submit Listing</button>
            </div>
        </div>
    </div>
</template>

<script>
import roomTypeMixin from "../../mixins/roomTypeMixin";
import roomMixin from "../../mixins/roomMixin";

export default {
    name: "Create",
    mixins: [roomTypeMixin, roomMixin],

    data() {
        return {
            dropzoneOptions: {
                url: 'https://httpbin.org/post',
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                autoProcessQueue: false,
                addRemoveLinks: true,
                headers: { "My-Awesome-Header": "header value" }
            }
        }
    },

    mounted() {
        this.getRoomTypes();
    }
}
</script>
