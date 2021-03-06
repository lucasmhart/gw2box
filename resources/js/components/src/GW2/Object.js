import Route from '../helpers/Route'
import Token from '../helpers/Token'
import bus from '../../bus.js'

class Object {
    constructor() {}

    static object = null;
    static debug = true;
    static isUpdating = true;

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

        if (!Object.get().account || Object.get().account.is_updatable === true) {
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
        } else if (Object.get().account.home_cats.is_updatable === true) {
            Object.requestUpdate('gwapi.account.home_cats');
        } else if (Object.get().account.inventory.is_updatable === true) {
            Object.requestUpdate('gwapi.account.inventory');
        } else if (Object.get().account.legendaryarmory.is_updatable === true) {
            Object.requestUpdate('gwapi.account.legendaryarmory');
        } else if (Object.get().account.mailcarriers.is_updatable === true) {
            Object.requestUpdate('gwapi.account.mailcarriers');
        } else if (Object.get().account.mapchests.is_updatable === true) {
            Object.requestUpdate('gwapi.account.mapchests');
        } else if (Object.get().account.masteries.is_updatable === true) {
            Object.requestUpdate('gwapi.account.masteries');
        } else if (Object.get().account.masterypoints.is_updatable === true) {
            Object.requestUpdate('gwapi.account.masterypoints');
        } else if (Object.get().account.materials.is_updatable === true) {
            Object.requestUpdate('gwapi.account.materials');
        } else if (Object.get().account.minis.is_updatable === true) {
            Object.requestUpdate('gwapi.account.minis');
        } else if (Object.get().account.mount_skins.is_updatable === true) {
            Object.requestUpdate('gwapi.account.mount_skins');
        } else if (Object.get().account.mount_types.is_updatable === true) {
            Object.requestUpdate('gwapi.account.mount_types');
        } else if (Object.get().account.novelties.is_updatable === true) {
            Object.requestUpdate('gwapi.account.novelties');
        } else if (Object.get().account.outfits.is_updatable === true) {
            Object.requestUpdate('gwapi.account.outfits');
        } else if (Object.get().account.pvp_heroes.is_updatable === true) {
            Object.requestUpdate('gwapi.account.pvp_heroes');
        } else if (Object.get().account.raids.is_updatable === true) {
            Object.requestUpdate('gwapi.account.raids');
        } else {
            bus.setIsObjectUpdating(false);
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

    static checkIsUpdating() {
        return Object.isUpdating
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
