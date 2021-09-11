class Token {
    constructor() {}

    static user() {
        return JSON.parse($('meta[name="auth-user"]').attr("content"));
    }
}

export default Token
