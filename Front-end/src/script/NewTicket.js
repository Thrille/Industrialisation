import Modal from "./Modal.js";
import TicketForm from "./TicketForm.js";

class NewTicket {

    parentNode;
    modal;
    form;

    constructor() {
        this.parentNode = document.getElementById("new-ticket");

        this.bindEvent();
    }

    bindEvent() {
        this.parentNode.addEventListener("click", this.onClickEvent.bind(this));
    }

    onClickEvent() {

        this.form = new TicketForm();

        this.modal = new Modal({
            title: "Crétion d'un ticket",
            element: this.form.render()
        });

        this.modal.open();
    }
}

export default NewTicket;