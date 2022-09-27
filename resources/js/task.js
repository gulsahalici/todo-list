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

function updateTask(data) {
    console.log("--", data)
    return axios({
        method: 'put',
        url: '/api/tasks/' + data?.id,
        data
    })
}

function deleteTask(data) {
    return axios({
        method: 'delete',
        url: '/api/tasks/' + data?.id
    })
}

export {
    fetchTasks, storeTask, updateTask, deleteTask
}