export default {
    data() {
        return {
            users: [],
            filteredUsers: [],
            user: {},
            permissions: []
        }
    },

    methods: {
        getUsers: function () {
            axios.get('api/users')
                .then( response => {
                    console.log("Users Index Page Axios");
                    console.log(response.data.data);
                    this.users = response.data.data;
                    this.filteredUsers = response.data.data;
                }).catch( error => {
                console.error(error.message);
            })
        },

        getUser: function (userId) {
            axios.get(`api/users/${userId}`)
                .then( response => {
                    console.log("Users Show Page Axios");
                    console.log(response.data.data);
                    this.user = response.data.data;
                }).catch( error => {
                console.error(error.message);
            })
        },

        deleteUser: function (userId) {
            axios.delete(`api/users/${userId}`)
                .then( response => {
                    console.log("Deleted user");
                    console.log(response.data.data);
                    this.users = _.remove(this.users, (user => user.id !== userId));
                    this.filteredUsers = this.users;
                }).catch( error => {
                console.error(error.message);
            })
        },

        filterUsersByRole: function (role) {
            if (role === '') {
                this.filteredUsers = this.users;

                return;
            }

            this.filteredUsers = this.users.filter( user => {
                return user.roles[0].name === role;
            });
        }
    }
}
