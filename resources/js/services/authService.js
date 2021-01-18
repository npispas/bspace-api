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

    async saveImage(image) {
        let formData = new FormData
        formData.append('image', image)

        let conf = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }

        return await axios.post('api/auth/user/image', formData, conf)
            .then(response => {
                return response.data
            })
            .catch(error => {
                console.error(error.message)
            });
    }
}

export default new AuthService()
