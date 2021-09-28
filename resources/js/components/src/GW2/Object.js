import Route from '../helpers/Route'
import Token from '../helpers/Token'

class Object {
    constructor() {}

    static object = null;
    static debug = true;

    static get() {
        try {
            return JSON.parse($("#gwo").val());
        } catch (e) {
            return false;
        }
    }

    static set(object) {
        $("#gwo").val(object);
    }

    static continueUpdating(response) {
        Object.set(response.data.object);
        Object.update();
    }

    static update() {
        if (Object.get() === false) {
            return;
        }

        if (Object.get().account.is_updatable === true) {
            Object.requestUpdate('gwapi.account');
        } else if (Object.get().account.achievs.is_updatable === true) {
            Object.requestUpdate('gwapi.account.achievements');
        } else if (Object.get().account.bank.is_updatable === true) {
            Object.requestUpdate('gwapi.account.bank');
        } else if (Object.get().account.dailycrafting.is_updatable === true) {
            Object.requestUpdate('gwapi.account.dailycrafting');
        } else if (Object.get().account.dungeons.is_updatable === true) {
            Object.requestUpdate('gwapi.account.dungeons');
        } else if (Object.get().account.dyes.is_updatable === true) {
            Object.requestUpdate('gwapi.account.dyes');
        } else if (Object.get().account.emotes.is_updatable === true) {
            Object.requestUpdate('gwapi.account.emotes');
        } else if (Object.get().account.finishers.is_updatable === true) {
            Object.requestUpdate('gwapi.account.finishers');
        } else if (Object.get().account.gliders.is_updatable === true) {
            Object.requestUpdate('gwapi.account.gliders');
        } else if (Object.get().account.home_nodes.is_updatable === true) {
            Object.requestUpdate('gwapi.account.home_nodes');
        } else {
            Object.printDebug("End sync");
        }
    }

    static printDebug(step) {
        const debug = true;

        if (debug) {
            console.log(step)
            console.log(Object.getNow());
            console.log(Object.get());
        }
    }

    static getNow() {
        var currentdate = new Date();
        return "Last Sync: " +
            currentdate.getDate() +
            "/" +
            (currentdate.getMonth() + 1) +
            "/" +
            currentdate.getFullYear() +
            " @ " +
            currentdate.getHours() +
            ":" +
            currentdate.getMinutes() +
            ":" +
            currentdate.getSeconds();
    }

    static requestUpdate(routePath) {
        Object.printDebug(routePath);
        axios.get(Route.getRoute(routePath), {
            _token: Token.get(),
        }).then(response => {
            Object.continueUpdating(response);
        });
    }
}

export default Object;
