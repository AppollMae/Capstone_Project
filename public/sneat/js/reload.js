function isUserLoggedOut() {
    return document.cookie.indexOf("judging_system_session") === -1;
}

setInterval(() => {
    if (isUserLoggedOut()) {
        console.log("Session expired or user logged out. Refreshing...");
        window.location.reload();
    }
}, 120000);