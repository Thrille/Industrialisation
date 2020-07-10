import Modal from "./Modal.js";
import TicketForm from "./TicketForm.js";

// class de création d'un nouveau ticket
class NewTicket {

    parentNode;
    modal;
    form;

    constructor() {
        this.parentNode = document.getElementById("new-ticket");

        // on associe les évenemnts
        this.bindEvent();
    }

    bindEvent() {
        this.parentNode.addEventListener("click", this.onClickEvent.bind(this));
    }

    // lorsque on clique sur le bouton "Créer un ticket"
    onClickEvent() {

        // on génère le formulaire de création de ticket
        this.form = new TicketForm();

        // on lance la modale de création avec le formulaire passé en paramètre
        this.modal = new Modal({
            title: "Création d'un ticket",
            element: this.form.render()
        });

        this.modal.open();
    }
}

export default NewTicket;