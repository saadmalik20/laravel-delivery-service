const setUserData = (userData) => {
    window.localStorage.setItem('userData', JSON.stringify(userData));
}

const getuserData = () => {
    return JSON.parse(window.localStorage.getItem("userData"));
}
