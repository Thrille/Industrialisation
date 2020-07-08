class Ticket {

    id;
    number;
    description;
    stateCode;
    deviceCode;

    constructor({id, number, description, stateCode, deviceCode}) {
        this.id = id;
        this.number = number;
        this.description = description;
        this.stateCode = stateCode;
        this.deviceCode = deviceCode;
    }

    render() {
        let table = document.createElement("table");

        let numberRow = document.createElement("tr");
        let actorEntryRow = document.createElement("tr");
        let actorResolveRow = document.createElement("tr");
        let actorResolvedRow = document.createElement("tr");
        let entryDateRow = document.createElement("tr");
        let resolveDateRow = document.createElement("tr");
        let descriptionRow = document.createElement("tr");
        let stateCodeRow = document.createElement("tr");
        let deviceCodeRow = document.createElement("tr");

        let numberLabelTextNode = document.createTextNode("N° de Ticket");
        let actorEntryLabelTextNode = document.createTextNode("Intervenant qui a saisi");
        let actorResolveLabelTextNode = document.createTextNode("Intervenant qui doit le résoudre");
        let actorResolvedLabelTextNode = document.createTextNode("Intervenant qui l'a résolu");
        let entryDateLabelTextNode = document.createTextNode("Date de saisie");
        let resolveDateLabelTextNode = document.createTextNode("Date de résolution");
        let descriptionLabelTextNode = document.createTextNode("Description du problème");
        let stateCodeLabelTextNode = document.createTextNode("Etat du Ticket");
        let deviceCodeLabelTextNode = document.createTextNode("Type de matériel en cause");

        let numberTextNode = document.createTextNode(this.number);
        let actorEntryTextNode = document.createTextNode("");
        let actorResolveTextNode = document.createTextNode("");
        let actorResolvedTextNode = document.createTextNode("");
        let entryDateTextNode = document.createTextNode("");
        let resolveDateTextNode = document.createTextNode("");
        let descriptionTextNode = document.createTextNode(this.description);
        let stateCodeTextNode = document.createTextNode(this.stateCode);
        let deviceCodeTextNode = document.createTextNode(this.deviceCode);

        let numberLabelDataRow = document.createElement("td");
        let numberDataRow = document.createElement("td");

        let actorEntryLabelDataRow = document.createElement("td");
        let actorEntryDataRow = document.createElement("td");

        let actorResolveLabelDataRow = document.createElement("td");
        let actorResolveDataRow = document.createElement("td");

        let actorResolvedLabelDataRow = document.createElement("td");
        let actorResolvedDataRow = document.createElement("td");

        let entryDateLabelDataRow = document.createElement("td");
        let entryDateDataRow = document.createElement("td");

        let resolveDateLabelDataRow = document.createElement("td");
        let resolveDateDataRow = document.createElement("td");

        let descriptionLabelDataRow = document.createElement("td");
        let descriptionDataRow = document.createElement("td");

        let stateCodeLabelDataRow = document.createElement("td");
        let stateCodeDataRow = document.createElement("td");

        let deviceCodeLableDataRow = document.createElement("td");
        let deviceCodeDataRow = document.createElement("td");

        numberLabelDataRow.appendChild(numberLabelTextNode);
        numberDataRow.appendChild(numberTextNode);

        actorEntryLabelDataRow.appendChild(actorEntryLabelTextNode);
        actorEntryDataRow.appendChild(actorEntryTextNode);

        actorResolveLabelDataRow.appendChild(actorResolveLabelTextNode);
        actorResolveDataRow.appendChild(actorResolveTextNode);

        actorResolvedLabelDataRow.appendChild(actorResolvedLabelTextNode);
        actorResolvedDataRow.appendChild(actorResolvedTextNode);

        entryDateLabelDataRow.appendChild(entryDateLabelTextNode);
        entryDateDataRow.appendChild(entryDateTextNode);

        resolveDateLabelDataRow.appendChild(resolveDateLabelTextNode);
        resolveDateDataRow.appendChild(resolveDateTextNode);

        descriptionLabelDataRow.appendChild(descriptionLabelTextNode);
        descriptionDataRow.appendChild(descriptionTextNode);

        stateCodeLabelDataRow.appendChild(stateCodeLabelTextNode);
        stateCodeDataRow.appendChild(stateCodeTextNode);

        deviceCodeLableDataRow.appendChild(deviceCodeLabelTextNode);
        deviceCodeDataRow.appendChild(deviceCodeTextNode);

        numberRow.appendChild(numberLabelDataRow);
        numberRow.appendChild(numberDataRow);

        actorEntryRow.appendChild(actorEntryLabelDataRow);
        actorEntryRow.appendChild(actorEntryDataRow);

        actorResolveRow.appendChild(actorResolveLabelDataRow);
        actorResolveRow.appendChild(actorResolveDataRow);

        actorResolvedRow.appendChild(actorResolvedLabelDataRow);
        actorResolvedRow.appendChild(actorResolvedDataRow);

        entryDateRow.appendChild(entryDateLabelDataRow);
        entryDateRow.appendChild(entryDateDataRow);

        resolveDateRow.appendChild(resolveDateLabelDataRow);
        resolveDateRow.appendChild(resolveDateDataRow);
        
        descriptionRow.appendChild(descriptionLabelDataRow);
        descriptionRow.appendChild(descriptionDataRow);

        stateCodeRow.appendChild(stateCodeLabelDataRow);
        stateCodeRow.appendChild(stateCodeDataRow);

        deviceCodeRow.appendChild(deviceCodeLableDataRow);
        deviceCodeRow.appendChild(deviceCodeDataRow);

        table.appendChild(numberRow);
        table.appendChild(actorEntryRow);
        table.appendChild(actorResolveRow);
        table.appendChild(actorResolvedRow);
        table.appendChild(entryDateRow);
        table.appendChild(resolveDateRow);
        table.appendChild(descriptionRow);
        table.appendChild(stateCodeRow);
        table.appendChild(deviceCodeRow);

        return table;
    }
}

export default Ticket;