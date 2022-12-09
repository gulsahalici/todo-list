function storeTask(data) {
    return axios({
        method: 'post',
        url: '/api/tasks',
        data
    })
}

function updateTask(data) {
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
    storeTask, updateTask, deleteTask
}