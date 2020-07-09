class TicketInfo {

    wrapperNode;
    ticket;

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
        this.ticket = ticket;

        this.ticket.sortInterventionByDate()

        console.log(this.ticket);
    }

    render() {
        this.table = document.createElement("table");

        this.numberRow = document.createElement("tr");
        this.actorEntryRow = document.createElement("tr");
        this.actorResolveRow = document.createElement("tr");
        this.actorResolvedRow = document.createElement("tr");
        this.entryDateRow = document.createElement("tr");
        this.resolveDateRow = document.createElement("tr");
        this.descriptionRow = document.createElement("tr");
        this.stateCodeRow = document.createElement("tr");
        this.deviceCodeRow = document.createElement("tr");

        this.numberLabelTextNode = document.createTextNode("N° de Ticket");
        this.actorEntryLabelTextNode = document.createTextNode("Intervenant qui a saisi");
        this.actorResolveLabelTextNode = document.createTextNode("Intervenant qui doit le résoudre");
        this.actorResolvedLabelTextNode = document.createTextNode("Intervenant qui l'a résolu");
        this.entryDateLabelTextNode = document.createTextNode("Date de saisie");
        this.resolveDateLabelTextNode = document.createTextNode("Date de résolution");
        this.descriptionLabelTextNode = document.createTextNode("Description du problème");
        this.stateCodeLabelTextNode = document.createTextNode("Etat du Ticket");
        this.deviceCodeLabelTextNode = document.createTextNode("Type de matériel en cause");

        this.numberTextNode = document.createTextNode(this.ticket.number);
        this.actorEntryTextNode = document.createTextNode((this.ticket.getEntryIntervention())? this.ticket.getEntryIntervention().user : "");
        this.actorResolveTextNode = document.createTextNode((this.ticket.getResolveIntervention())? this.ticket.getResolveIntervention().user : "");
        this.actorResolvedTextNode = document.createTextNode((this.ticket.getResolvedIntevention())? this.ticket.getResolvedIntevention().user : "");
        this.entryDateTextNode = document.createTextNode((this.ticket.getEntryIntervention())? this.ticket.getEntryIntervention().date.toLocaleString() : "");
        this.resolveDateTextNode = document.createTextNode((this.ticket.getResolveIntervention())? this.ticket.getResolveIntervention().date.toLocaleString() : "");
        this.descriptionTextNode = document.createTextNode(this.ticket.description);
        this.stateCodeTextNode = document.createTextNode(this.ticket.stateName);
        this.deviceCodeTextNode = document.createTextNode(this.ticket.deviceName);

        this.numberLabelDataRow = document.createElement("td");
        this.numberDataRow = document.createElement("td");

        this.actorEntryLabelDataRow = document.createElement("td");
        this.actorEntryDataRow = document.createElement("td");

        this.actorResolveLabelDataRow = document.createElement("td");
        this.actorResolveDataRow = document.createElement("td");

        this.actorResolvedLabelDataRow = document.createElement("td");
        this.actorResolvedDataRow = document.createElement("td");

        this.entryDateLabelDataRow = document.createElement("td");
        this.entryDateDataRow = document.createElement("td");

        this.resolveDateLabelDataRow = document.createElement("td");
        this.resolveDateDataRow = document.createElement("td");

        this.descriptionLabelDataRow = document.createElement("td");
        this.descriptionDataRow = document.createElement("td");

        this.stateCodeLabelDataRow = document.createElement("td");
        this.stateCodeDataRow = document.createElement("td");

        this.deviceCodeLableDataRow = document.createElement("td");
        this.deviceCodeDataRow = document.createElement("td");

        this.numberLabelDataRow.appendChild(this.numberLabelTextNode);
        this.numberDataRow.appendChild(this.numberTextNode);

        this.actorEntryLabelDataRow.appendChild(this.actorEntryLabelTextNode);
        this.actorEntryDataRow.appendChild(this.actorEntryTextNode);

        this.actorResolveLabelDataRow.appendChild(this.actorResolveLabelTextNode);
        this.actorResolveDataRow.appendChild(this.actorResolveTextNode);

        this.actorResolvedLabelDataRow.appendChild(this.actorResolvedLabelTextNode);
        this.actorResolvedDataRow.appendChild(this.actorResolvedTextNode);

        this.entryDateLabelDataRow.appendChild(this.entryDateLabelTextNode);
        this.entryDateDataRow.appendChild(this.entryDateTextNode);

        this.resolveDateLabelDataRow.appendChild(this.resolveDateLabelTextNode);
        this.resolveDateDataRow.appendChild(this.resolveDateTextNode);

        this.descriptionLabelDataRow.appendChild(this.descriptionLabelTextNode);
        this.descriptionDataRow.appendChild(this.descriptionTextNode);

        this.stateCodeLabelDataRow.appendChild(this.stateCodeLabelTextNode);
        this.stateCodeDataRow.appendChild(this.stateCodeTextNode);

        this.deviceCodeLableDataRow.appendChild(this.deviceCodeLabelTextNode);
        this.deviceCodeDataRow.appendChild(this.deviceCodeTextNode);

        this.numberRow.appendChild(this.numberLabelDataRow);
        this.numberRow.appendChild(this.numberDataRow);

        this.actorEntryRow.appendChild(this.actorEntryLabelDataRow);
        this.actorEntryRow.appendChild(this.actorEntryDataRow);

        this.actorResolveRow.appendChild(this.actorResolveLabelDataRow);
        this.actorResolveRow.appendChild(this.actorResolveDataRow);

        this.actorResolvedRow.appendChild(this.actorResolvedLabelDataRow);
        this.actorResolvedRow.appendChild(this.actorResolvedDataRow);

        this.entryDateRow.appendChild(this.entryDateLabelDataRow);
        this.entryDateRow.appendChild(this.entryDateDataRow);

        this.resolveDateRow.appendChild(this.resolveDateLabelDataRow);
        this.resolveDateRow.appendChild(this.resolveDateDataRow);
        
        this.descriptionRow.appendChild(this.descriptionLabelDataRow);
        this.descriptionRow.appendChild(this.descriptionDataRow);

        this.stateCodeRow.appendChild(this.stateCodeLabelDataRow);
        this.stateCodeRow.appendChild(this.stateCodeDataRow);

        this.deviceCodeRow.appendChild(this.deviceCodeLableDataRow);
        this.deviceCodeRow.appendChild(this.deviceCodeDataRow);

        this.table.appendChild(this.numberRow);
        this.table.appendChild(this.actorEntryRow);
        this.table.appendChild(this.actorResolveRow);
        this.table.appendChild(this.actorResolvedRow);
        this.table.appendChild(this.entryDateRow);
        this.table.appendChild(this.resolveDateRow);
        this.table.appendChild(this.descriptionRow);
        this.table.appendChild(this.stateCodeRow);
        this.table.appendChild(this.deviceCodeRow);

        this.wrapperNode = this.table;

        return this.wrapperNode;
    }
}

export default TicketInfo;