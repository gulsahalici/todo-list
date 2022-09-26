function fetchUsers(payload) {
    return axios({
        method: 'get',
        url: '/api/users'
    })
}


export {
    fetchUsers
}