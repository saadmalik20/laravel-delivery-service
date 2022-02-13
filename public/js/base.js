const setUserData = (userData) => {
    window.localStorage.setItem('userData', JSON.stringify(userData));
}

const getuserData = () => {
    return window.localStorage.getItem("userData");
}
