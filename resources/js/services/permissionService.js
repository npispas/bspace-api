import axios from 'axios'

class PermissionService {
     async fetchAuthUserPermissions() {
        return await axios.get('api/auth/permissions')
            .then(response => {
                return response.data.data
            })
            .catch(error => {
                console.error(error.message)
            });
    }

    async fetchPermissions() {
        return await axios.get('api/permissions')
            .then(response => {
               return response.data.data
            }).catch(error => {
                console.error(error.message)
        })
    }
}

export default new PermissionService()
