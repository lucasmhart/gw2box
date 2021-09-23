import Object from './Object'
import Route from '../helpers/Route'
import Token from '../helpers/Token'
import axios from 'axios'

class Account {
    static updateAccount() {

        axios.get(Route.getRoute('gwapi.account'), {
            _token: Token.get(),
        }).then(response => {
            Object.continueUpdating(response);
        });
    }

    static updateAchievements() {
        axios.get(Route.getRoute('gwapi.account.achievements'), {
            _token: Token.get(),
        }).then(response => {
            Object.continueUpdating(response);
        });
    }

    static updateBank() {
        axios.get(Route.getRoute('gwapi.account.bank'), {
            _token: Token.get(),
        }).then(response => {
            Object.continueUpdating(response);
        });
    }
}

export default Account
