class Token {
    constructor() {}

    static get() {
        return $('meta[name="csrf-token"]').attr("content");
    }
}

export default Token
