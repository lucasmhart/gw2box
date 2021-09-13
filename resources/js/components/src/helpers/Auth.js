class Auth {
    constructor() {}

    static user() {
        var user = false;
        try {
            user = JSON.parse($('meta[name="auth-user"]').attr("content"));
        } catch (e) {
            user = false;
        }
        return user;
    }
}

export default Auth
