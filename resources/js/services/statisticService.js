import axios from "axios"

class StatisticService {
    async fetchStatistics() {
        return await axios.get('api/statistics')
            .then(response => {
                return response.data.data
            }).catch( error => {
                console.error(error.message)
            })
    }
}

export default new StatisticService()
