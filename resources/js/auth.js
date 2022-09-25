function loginUser(payload) {
    return axios({
        method: 'post',
        url: '/api/auth/login',
        data: payload
    })
}

function registerUser(payload) {
    return axios({
        method: 'post',
        url: '/api/auth/register',
        data: payload
    })
}

export {
    loginUser, registerUser
}