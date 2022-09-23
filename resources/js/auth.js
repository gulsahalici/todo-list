function loginUser(payload) {
    return axios({
        method: 'post',
        url: '/api/auth/login',
        data: payload
    })
}


export {
    loginUser
}