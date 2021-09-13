class Object {
    constructor() {}

    static get() {
        var object = false;
        try {
            object = JSON.parse($('#gwo').val());
        } catch (e) {
            object = false;
        }
        return object;
    }
}

export default Object
