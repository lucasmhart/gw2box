import Object from './Object'
import Route from '../helpers/Route'
import Token from '../helpers/Token'
import axios from 'axios'

class Account {
    static updateAccount() {

        axios.get(Route.getRoute('gwapi.account'), {
            _token: Token.get(),
        }).then(response => {
            Object.set(response.data.object);
            Object.update();
        });
    }
}

export default Account
