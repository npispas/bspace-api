<template>
    <!-- sub content start -->
    <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="db-pageheader d-xl-flex justify-content-between">
                    <div class="">
                        <h2 class="db-pageheader-title">Reservation Management</h2>
                        <p class="db-pageheader-text"> Manage your office space listing in one single dashboard. Its has features Pending, Approved and Removed listing.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="javascript:void(0)" class="btn btn-primary" v-on:click.prevent="reservationsGenerate"> Generate test reservation</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card-lines-tab">
                    <ul class="nav nav-pills card-lines-tab-header" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="" id="all-reservations" role="tab" data-toggle="pill" aria-selected="true" v-on:click="reservationStatus = ''">All Reservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="confirmed" role="tab" data-toggle="pill" aria-selected="false" v-on:click="reservationStatus = 'confirmed'">Confirmed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="unconfirmed" data-toggle="pill" role="tab" aria-selected="false" v-on:click="reservationStatus = 'unconfirmed'">Unconfirmed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="checked-in" data-toggle="pill" role="tab" aria-selected="false" v-on:click="reservationStatus = 'checked-in'">Checked In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="checked-out" data-toggle="pill" role="tab" aria-selected="false" v-on:click="reservationStatus = 'checked-out'">Checked Out</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="canceled" data-toggle="pill" role="tab" aria-selected="false" v-on:click="reservationStatus = 'canceled'">Canceled</a>
                        </li>
                    </ul>
                    <div class="tab-content card-listing-tab-body" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-listing" role="tabpanel" aria-labelledby="pills-listing-tab">
                            <div class="table-responsive listing-table table-hover">
                                <table class="table first">
                                    <thead>
                                        <tr>
                                            <th>Reservation ID</th>
                                            <th>Owner</th>
                                            <th>Created</th>
                                            <th>Comments</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th data-orderable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="reservation in filteredReservations">
                                            <td>
                                                <div class="listing-table-string"><a href="#"></a>
                                                    <p>{{ reservation.unique_id }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="listing-table-string">
                                                    <p>{{ reservation.owner_name }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="listing-table-string">
                                                    <p>{{ reservation.created_at }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="listing-table-string">
                                                    {{ reservation.comments }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="listing-table-string">
                                                    {{ `${reservation.total_amount} ${reservation.currency}` }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="listing-table-status">
                                                    <span class="badge" :class="`badge-${reservation.status}`">{{ reservation.status }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="listing-table-action">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <router-link :to="`/reservations/${reservation.id}`" class="dropdown-item" active-class="">View</router-link>
                                                            <a class="dropdown-item" href="#">Edit Details</a>
                                                            <a class="dropdown-item" href="#" v-on:click.prevent="deleteReservation(reservation.id)">Delete</a>
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
    import reservationMixin from "../../mixins/reservationMixin";

    export default {
        name: "Index",
        mixins: [reservationMixin],

        data() {
            return {
                reservationStatus: ''
            }
        },

        watch: {
            reservationStatus: function() {
                this.filterReservationsByStatus(this.reservationStatus);
            }
        },

        mounted() {
            this.getReservations();
        },
    }
</script>
