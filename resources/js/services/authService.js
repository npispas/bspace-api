import axios from "axios"

class AuthService {
    async fetchAuthUser() {
        return await axios.get('api/auth/user')
            .then(response => {
                return response.data
            })
            .catch(error => {
                console.error(error.message)
            });
    }
}

export default new AuthService()
