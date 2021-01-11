import axios from "axios"

class RoleService {
    async fetchRoles() {
        return await axios.get('api/roles')
            .then(response => {
                return response.data.data
            })
            .catch(error => {
                console.error(error)
            })
    }
}

export default new RoleService()
