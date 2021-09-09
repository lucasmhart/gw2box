class Token {
    constructor() {}

    static user() {
        return $('meta[name="auth-user"]').attr("content");
    }
}

export default Token
