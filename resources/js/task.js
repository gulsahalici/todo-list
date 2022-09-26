function fetchTasks(payload) {
    return axios({
        method: 'get',
        url: '/api/tasks'
    })
}

function storeTask(data) {
    return axios({
        method: 'post',
        url: '/api/tasks',
        data
    })
}

export {
    fetchTasks, storeTask
}