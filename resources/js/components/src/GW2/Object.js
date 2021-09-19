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

    static update() {
        if (Object.get() === false){
            return;
        }

        console.log(Object.get().account);
        if (Object.get().account.is_updatable === true) {
            Account.updateAccount();
        }
    }
}

export default Object
