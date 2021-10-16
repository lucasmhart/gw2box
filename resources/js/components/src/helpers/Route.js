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
        "gwapi.account.finishers": "/gwapi/account/finishers",
        "gwapi.account.gliders": "/gwapi/account/gliders",
        "gwapi.account.home_nodes": "/gwapi/account/home_nodes",
        "gwapi.account.home_cats": "/gwapi/account/home_cats",
        "gwapi.account.inventory": "/gwapi/account/inventory",
        "gwapi.account.legendaryarmory": "/gwapi/account/legendaryarmory",
        "gwapi.account.mailcarriers": "/gwapi/account/mailcarriers",
        "gwapi.account.mapchests": "/gwapi/account/mapchests",
        "gwapi.account.masteries": "/gwapi/account/masteries",
        "gwapi.account.masterypoints": "/gwapi/account/masterypoints",
        "gwapi.account.materials": "/gwapi/account/materials",
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
