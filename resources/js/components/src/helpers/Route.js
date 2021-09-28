class Route {
    static routes = {
        "user.create": "/user/create",
        "user.logout": "/user/logout",
        "user.login": "/user/login",
        "user.updateApiKey": "/user/updateApiKey",
        "user.updatePassword": "/user/updatePassword",
        "gwapi.account": "/gwapi/account",
        "gwapi.account.achievements": "/gwapi/account/achievements",
        "gwapi.account.bank": "/gwapi/account/bank",
        "gwapi.account.dailycrafting": "/gwapi/account/dailycrafting",
        "gwapi.account.dungeons": "/gwapi/account/dungeons",
        "gwapi.account.dyes": "/gwapi/account/dyes",
        "gwapi.account.emotes": "/gwapi/account/emotes",
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
