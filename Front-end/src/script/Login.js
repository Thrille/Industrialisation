import Modal from "./Modal.js"
import TicketList from './TicketList.js'
import NewTicket from './NewTicket.js'
import App from './App.js'
import APIAdapter from "./APIAdapter.js";

class Login {

    modal;
    wrapperNode;

    constructor() {
        this.modal = new Modal({
            title: "Connexion",
            element: this.render()
        })

        this.modal.open();

        this.modal.disableCloseAction();

        this.APIAdapter = new APIAdapter();
    }
    render() {
        this.wrapperNode = document.createElement("form");

        this.loginInput = document.createElement("input")
        this.loginInput.id = "login-input"

        this.passwordInput = document.createElement("input")
        this.passwordInput.type = "password"
        this.passwordInput.id = "password-input"

        this.validationButton = document.createElement("button")
        this.validationButton.type = "button"
        this.validationButton.appendChild(document.createTextNode("Connexion"))

        this.loginLabel = document.createElement("label")
        this.loginLabel.for = "login-input"
        this.loginLabel.appendChild(document.createTextNode("Identifiant"))

        this.passwordLabel = document.createElement("label")
        this.passwordLabel.for = "password-input"
        this.passwordLabel.appendChild(document.createTextNode("Mot de passe"))

        this.wrapperNode.appendChild(this.loginLabel)
        this.wrapperNode.appendChild(this.loginInput)
        this.wrapperNode.appendChild(this.passwordLabel)
        this.wrapperNode.appendChild(this.passwordInput)
        this.wrapperNode.appendChild(this.validationButton)

        this.bindEvents()

        return this.wrapperNode;
    }

    bindEvents() {
        if(this.validationButton) {
            this.validationButton.addEventListener("click", this.onSubmit.bind(this))
        }
    }

    onSubmit() {

        console.log({
            login: this.loginInput.value,
            password: this.passwordInput.value
        })

        this.APIAdapter.Auth({
            login: this.loginInput.value,
            password: this.passwordInput.value
        }).then(response => {
            if (response.ok) {
                response.json().then(data => {
                    App.authToken = data.token

                    this.onLoginSuccess();
                });
            }
        })
    }

    onLoginSuccess() {
        this.modal.enableCloseAction();
        this.modal.close();
        App.logged = true;
        console.log(App)

        const ticketList = new TicketList();
        const newTicketButton = new NewTicket();

        ticketList.loadData()
    }
}

export default Login