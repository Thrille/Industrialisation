import Modal from "./Modal.js"
import TicketList from './TicketList.js'
import NewTicket from './NewTicket.js'
import App from './App.js'
import APIAdapter from "./APIAdapter.js";

// classe de connection
class Login {

    modal;
    wrapperNode;

    constructor() {
        // oncontruit une modal
        this.modal = new Modal({
            title: "Connexion",
            element: this.render()
        })

        this.modal.open();

        // cette modal ne pourra pas être fermée
        this.modal.disableCloseAction();

        // on instancie la classe de gestion de l'API
        this.APIAdapter = new APIAdapter();
    }

    // on génère le rendu du formulaire
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

    // associe les évenements
    bindEvents() {
        if(this.validationButton) {
            this.validationButton.addEventListener("click", this.onSubmit.bind(this))
        }
    }

    // évenement lancé par la validation du formulaire
    onSubmit() {

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

    // si la connection est un succes
    onLoginSuccess() {
        this.modal.enableCloseAction();
        this.modal.close();
        App.logged = true;
        console.log(App)

        // on génère la liste des tickets
        const ticketList = new TicketList();

        // et le bouton de création d'un ticket
        const newTicketButton = new NewTicket();

        // on charge les données de la liste des tickets
        ticketList.loadData()
    }
}

export default Login