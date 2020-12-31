<template>
    <!-- sub content start -->
    <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="db-pageheader d-xl-flex justify-content-between">
                    <div class="">
                        <h2 class="db-pageheader-title">Users Management</h2>
                        <p class="db-pageheader-text"> Manage your office space listing in one single dashboard. Its has features Pending, Approved and Removed listing.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <router-link to="reservations/create" class="btn btn-primary"> Add new user</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card-lines-tab">
                    <ul class="nav nav-pills card-lines-tab-header" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="" id="all-users" role="tab" data-toggle="pill" aria-selected="true" v-on:click="role = ''">All Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="user" role="tab" data-toggle="pill" aria-selected="false" v-on:click="role = 'user'">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="staff" role="tab" data-toggle="pill" aria-selected="false" v-on:click="role = 'staff'">Staff</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" id="admin" data-toggle="pill" role="tab" aria-selected="false" v-on:click="role = 'admin'">Admin</a>
                        </li>
                    </ul>
                    <div class="tab-content card-listing-tab-body" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-listing" role="tabpanel" aria-labelledby="pills-listing-tab">
                            <div class="table-responsive listing-table table-hover">
                                <table class="table first">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Verified</th>
                                        <th data-orderable="false">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="user in filteredUsers">
                                        <td>
                                            <div class="listing-table-img"><a href="#">
                                                <img src="../../../images/avatar-1.jpg"></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string"><a href="#"></a>
                                                <p>{{ user.username }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string">
                                                <p>{{ user.full_name }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string">
                                                <p>{{ user.email }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-status">
                                                <p>{{ user.roles[0].name }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-string">
                                                <p>{{ user.email_verified_at }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="listing-table-action">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">Edit Details</a>
                                                        <a class="dropdown-item" href="#" v-on:click.prevent="deleteUser(user.id)">Delete</a>
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
import userMixin from "../../mixins/userMixin";

export default {
    name: "Index",
    mixins: [userMixin],

    data() {
        return {
            role: ''
        }
    },

    watch: {
        role: function() {
            this.filterUsersByRole(this.role);
        }
    },

    mounted() {
        this.getUsers();
    },
}
</script>
