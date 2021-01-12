export default {
    methods: {
        logout: function () {
            axios.post('dashboard/logout')
                .then(() => {
                    this.$router.history.teardown()
                    window.location.replace('dashboard/login')
                })
                .catch( error =>{
                    console.error(error.message)
                })
        }
    }
}
