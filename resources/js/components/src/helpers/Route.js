class Route {
    constructor() {}

    static baseRoute() {
        return $('meta[name="base-url"]').attr("content");
    }
}

export default Route
