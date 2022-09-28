function fetchTasks(payload) {
    var params = {
        page: payload?.page
    }

    if (payload?.filter?.description) {
        params.description = payload.filter.description
    }

    if (payload?.filter?.user_id) {
        params.user_id = payload.filter.user_id
    }

    if (payload?.filter?.done != undefined) {
        params.done = payload.filter.done
    }

    return axios({
        method: 'get',
        url: '/api/tasks',
        params
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