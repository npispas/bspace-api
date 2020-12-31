export default {
    methods: {
        logout: function () {
            axios.post('dashboard/logout')
                .then( () => {
                    window.location.href = 'dashboard/login';
                })
                .catch( error =>{
                    console.error(error.message);
                });
        }
    }
}
