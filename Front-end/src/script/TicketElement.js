import Modal from './Modal.js';
import TicketInfo from './TicketInfo.js';

class TicketElement {

    ticket;
    modal;
    wrapperNode;
    ticketInfo;

    table;
    numberRow;
    actorEntryRow;
    actorResolveRow;
    entryDateRow;
    resolveDateRow;
    descriptionRow;
    stateCodeRow;
    deviceCodeRow;
    numberLabelTextNode;
    actorEntryLabelTextNode;
    actorResolveLabelTextNode;
    actorResolvedLabelTextNode;
    entryDateLabelTextNode;
    resolveDateLabelTextNode;
    descriptionLabelTextNode;
    stateCodeLabelTextNode;
    deviceCodeLabelTextNode;
    numberLabelDataRow;
    numberDataRow;
    actorEntryLabelDataRow;
    actorEntryDataRow;
    actorResolveLabelDataRow;
    actorResolveDataRow;
    actorResolvedLabelDataRow;
    actorResolvedDataRow;
    entryDateLabelDataRow;
    entryDateDataRow;
    resolveDateLabelDataRow;
    resolveDateDataRow;
    descriptionLabelDataRow;
    descriptionDataRow;
    stateCodeLabelDataRow;
    stateCodeDataRow;
    deviceCodeLableDataRow;
    deviceCodeDataRow;

    constructor({ticket}) {
        this.ticket = ticket

        console.log(this.ticket);

        this.ticket.sortInterventionByDate()
    }

    render() {
        this.table = document.createElement("table");

        this.numberRow = document.createElement("tr");
        this.actorEntryRow = document.createElement("tr");
        this.entryDateRow = document.createElement("tr");
        this.resolveDateRow = document.createElement("tr");
        this.stateCodeRow = document.createElement("tr");
        this.deviceCodeRow = document.createElement("tr");

        this.numberLabelTextNode = document.createTextNode("N° de Ticket");
        this.actorEntryLabelTextNode = document.createTextNode("Intervenant qui a saisi");
        this.entryDateLabelTextNode = document.createTextNode("Date de saisie");
        this.resolveDateLabelTextNode = document.createTextNode("Date de résolution");
        this.stateCodeLabelTextNode = document.createTextNode("Etat du Ticket");
        this.deviceCodeLabelTextNode = document.createTextNode("Type de matériel en cause");

        this.numberTextNode = document.createTextNode(this.ticket.number);
        this.actorEntryTextNode = document.createTextNode(this.ticket.getEntryIntervention().user || "");
        this.entryDateTextNode = document.createTextNode(this.ticket.getEntryIntervention().date.toLocaleString() || "");
        this.resolveDateTextNode = document.createTextNode(this.ticket.getResolvedIntevention().date.toLocaleString() || "");
        this.stateCodeTextNode = document.createTextNode(this.ticket.stateName);
        this.deviceCodeTextNode = document.createTextNode(this.ticket.deviceName);

        this.numberLabelDataRow = document.createElement("td");
        this.numberDataRow = document.createElement("td");

        this.actorEntryLabelDataRow = document.createElement("td");
        this.actorEntryDataRow = document.createElement("td");

        this.entryDateLabelDataRow = document.createElement("td");
        this.entryDateDataRow = document.createElement("td");

        this.resolveDateLabelDataRow = document.createElement("td");
        this.resolveDateDataRow = document.createElement("td");

        this.stateCodeLabelDataRow = document.createElement("td");
        this.stateCodeDataRow = document.createElement("td");

        this.deviceCodeLableDataRow = document.createElement("td");
        this.deviceCodeDataRow = document.createElement("td");

        this.numberLabelDataRow.appendChild(this.numberLabelTextNode);
        this.numberDataRow.appendChild(this.numberTextNode);

        this.actorEntryLabelDataRow.appendChild(this.actorEntryLabelTextNode);
        this.actorEntryDataRow.appendChild(this.actorEntryTextNode)

        this.entryDateLabelDataRow.appendChild(this.entryDateLabelTextNode);
        this.entryDateDataRow.appendChild(this.entryDateTextNode);

        this.resolveDateLabelDataRow.appendChild(this.resolveDateLabelTextNode);
        this.resolveDateDataRow.appendChild(this.resolveDateTextNode);

        this.stateCodeLabelDataRow.appendChild(this.stateCodeLabelTextNode);
        this.stateCodeDataRow.appendChild(this.stateCodeTextNode);

        this.deviceCodeLableDataRow.appendChild(this.deviceCodeLabelTextNode);
        this.deviceCodeDataRow.appendChild(this.deviceCodeTextNode);

        this.numberRow.appendChild(this.numberLabelDataRow);
        this.numberRow.appendChild(this.numberDataRow);

        this.actorEntryRow.appendChild(this.actorEntryLabelDataRow);
        this.actorEntryRow.appendChild(this.actorEntryDataRow);

        this.entryDateRow.appendChild(this.entryDateLabelDataRow);
        this.entryDateRow.appendChild(this.entryDateDataRow);

        this.resolveDateRow.appendChild(this.resolveDateLabelDataRow);
        this.resolveDateRow.appendChild(this.resolveDateDataRow);

        this.stateCodeRow.appendChild(this.stateCodeLabelDataRow);
        this.stateCodeRow.appendChild(this.stateCodeDataRow);

        this.deviceCodeRow.appendChild(this.deviceCodeLableDataRow);
        this.deviceCodeRow.appendChild(this.deviceCodeDataRow);

        this.table.appendChild(this.numberRow);
        this.table.appendChild(this.actorEntryRow);
        this.table.appendChild(this.entryDateRow);
        this.table.appendChild(this.resolveDateRow);
        this.table.appendChild(this.stateCodeRow);
        this.table.appendChild(this.deviceCodeRow);

        this.wrapperNode = this.table;

        this.bindEvents();

        return this.wrapperNode;
    }

    renderInListContext() {

        if(!this.wrapperNode) {
            this.render();
        }

        this.li = document.createElement("li");

        this.li.classList.add("hoverable");
        this.li.classList.add("clickable");

        this.li.appendChild(this.wrapperNode);

        this.wrapperNode = this.li;

        this.bindEvents();

        return this.wrapperNode;
    }

    bindEvents() {
        if(this.wrapperNode) {

            this.wrapperNode = this.wrapperNode.cloneNode(true);
            
            this.wrapperNode.addEventListener("click", this.clickEvent.bind(this));
        }
    }

    clickEvent(event) {

        this.ticketInfo = new TicketInfo({ticket: this.ticket});

        this.modal = new Modal({
            title: "Détail du ticket",
            element: this.ticketInfo.render()
        });

        this.modal.open();
    }
}

export default TicketElement;