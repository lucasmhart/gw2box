class Route {
    static routes = {
        "user.create": "/user/create",
        "user.logout": "/user/logout",
        "user.login": "/user/login"
    }

    constructor() {

    }

    static baseRoute() {
        return $('meta[name="base-url"]').attr("content");
    }

    static getRoute(route, params) {
        return this.baseRoute() + this.routes[route];
    }
}

export default Route
