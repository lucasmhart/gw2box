import Account from "./Account";
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
            Object.printDebug("account");
            Account.updateAccount();
        } else if (Object.get().account.achievs.is_updatable === true) {
            Object.printDebug("achievments");
            Account.updateAchievements();
        } else if (Object.get().account.bank.is_updatable === true) {
            Object.printDebug("bank");
            Account.updateBank();
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
}

export default Object;
