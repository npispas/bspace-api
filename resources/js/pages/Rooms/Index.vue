<template>
    <!-- sub content start -->
    <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="db-pageheader d-xl-flex justify-content-between">
                    <div class="">
                        <h2 class="db-pageheader-title">Rooms Management</h2>
                        <p class="db-pageheader-text"> Manage your office space listing in one single dashboard. Its has features Pending, Approved and Removed listing.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <router-link to="/rooms/create" class="btn btn-primary"> Add new room</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card-lines-tab">
                    <ul class="nav nav-pills card-lines-tab-header" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="" id="all-reservations" role="tab" data-toggle="pill" aria-selected="true" v-on:click="published = null">All Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="published" role="tab" data-toggle="pill" aria-selected="false" v-on:click="published = 1">Published</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="unpublished" data-toggle="pill" role="tab" aria-selected="false" v-on:click="published = 0">Unpublished</a>
                        </li>
                    </ul>
                    <div class="tab-content card-listing-tab-body" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-listing" role="tabpanel" aria-labelledby="pills-listing-tab">
                            <div class="table-responsive listing-table table-hover">
                                <table class="table first">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Interior size</th>
                                        <th>Location</th>
                                        <th>Max Occupancy</th>
                                        <th>Min Occupancy</th>
                                        <th>Published</th>
                                        <th data-orderable="false">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="room in filteredRooms">
                                        <td>
                                            <div class="listing-table-img"><a href="#">
                                                <img src="../../../images/db-listing-img-2.jpg"></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string"><a href="#"></a>
                                                <p>{{ room.name }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string">
                                                <p>{{ room.description }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string">
                                                <p>{{ room.interior_size }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string">
                                                {{ room.location }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string">
                                                {{ room.max_occupancy }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string">
                                                {{ room.min_occupancy }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-status">
                                                <span class="badge" :class="`badge-${room.is_published ? 'published' : 'unpublished'}`">{{ room.is_published ? 'Published' : 'Unpublished' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-action">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <router-link :to="`/rooms/${room.id}`" class="dropdown-item" active-class="">View</router-link>
                                                        <a class="dropdown-item" href="#">Edit Details</a>
                                                        <a class="dropdown-item" href="#" v-on:click.prevent="deleteRoom(room.id)">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sub content close -->
</template>

<script>

import roomMixin from "../../mixins/roomMixin";

export default {
    name: "Index",
    mixins: [roomMixin],

    data() {
        return {
            published: null
        }
    },

    watch: {
        published: function() {
            this.filterReservationsByPublicity(this.published);
        }
    },

    mounted() {
        this.getRooms();
    },
}
</script>
