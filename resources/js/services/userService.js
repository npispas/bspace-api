import axios from "axios"

class UserService {
    async fetchUsers() {
        return await axios.get('api/users')
            .then(response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
        })
    }

    async fetchUser(userId) {
        return await axios.get(`api/users/${userId}`)
            .then(response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
        })
    }

    async createUser(data) {
        return await axios.post('api/users', {
            first_name: data.firstName,
            last_name: data.lastName,
            username: data.username,
            email: data.email,
            password: data.password,
            repeat_password: data.repeatPassword,
            role: data.role,
            permissions: data.rolePermissions
        })
            .then(response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
        })
    }

    async updateUser(userId, permissions) {
        return await axios.put(`api/users/${userId}`, {
            permissions: permissions
        })
            .then(response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
        })
    }

    async deleteUser(userId) {
        return await axios.delete(`api/users/${userId}`)
            .then(response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
        })
    }
}

export default new UserService()
