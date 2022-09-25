function fetchTasks(payload) {
    return axios({
        method: 'get',
        url: '/api/tasks'
    })
}


export {
    fetchTasks
}