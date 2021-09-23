import Account from './Account'
class Object {
    constructor() {
    }

    static object = null;

    static get() {
        try {
            return JSON.parse($('#gwo').val());
        } catch (e) {
            return false;
        }
    }

    static set(object) {
        $('#gwo').val(object)
    }

    static continueUpdating(response) {
        Object.set(response.data.object);
        Object.update();
    }

    static update() {
        if (Object.get() === false){
            return;
        }

        console.log(Object.get());
        if (Object.get().account.is_updatable === true) {
            console.log('account')
            Account.updateAccount();
        } else if (Object.get().account.achievs.is_updatable === true) {
            console.log('achievments')
            Account.updateAchievements();
        } else if (Object.get().account.bank.is_updatable === true) {
            console.log('bank')
            Account.updateBank();
        } else {
            console.log('END')
        }
    }
}

export default Object
