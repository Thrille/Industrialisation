import APIAdapter from "./APIAdapter.js";
import State from "./State.js";
import Device from "./Device.js";

// formulaire de création et d'édition de ticket
class TicketForm {

    wrapperNode;
    labels;

    constructor() {
        this.labels = {
            number: "Numéro",
            device: "Materiel impliqué",
            state: "Etat du ticket",
            description: "Description",
            resolver: "Intervenant devant résoudre",
            button: "Créer le ticket"
        };

        this.states = [];
        this.devices = [];

        this.apiAdapter = new APIAdapter();
    }

    // rendu du formulaire
    render() {
        this.wrapperNode = document.createElement("form");

        this.ticketNumberInput = document.createElement("input");
        this.ticketNumberLabel = document.createElement("label");
        this.ticketNumberInput.id = "ticket-number-input";
        this.ticketNumberLabel.for = "ticket-number-input";
        this.ticketNumberLabel.appendChild(document.createTextNode(this.labels.number));

        this.ticketDescriptionTextarea = document.createElement("textarea");
        this.ticketDescriptionLabel = document.createElement("label");
        this.ticketDescriptionTextarea.id = "ticket-description-textarea";
        this.ticketDescriptionLabel.for = "ticket-description-textarea";
        this.ticketDescriptionLabel.appendChild(document.createTextNode(this.labels.description));

        this.ticketStateSelect = document.createElement("select");
        this.ticketStateLabel = document.createElement("label");
        this.ticketStateSelect.id = "ticket-state-select";
        this.ticketStateLabel.for = "ticket-state-select";
        this.ticketStateLabel.appendChild(document.createTextNode(this.labels.state));

        this.ticketDeviceSelect = document.createElement("select");
        this.ticketDeviceLabel = document.createElement("label");
        this.ticketDeviceSelect.id = "ticket-device-select";
        this.ticketDeviceLabel.for = "ticket-device-select";
        this.ticketDeviceLabel.appendChild(document.createTextNode(this.labels.device));

        this.validateButton = document.createElement("button");
        this.validateButtonLabel = document.createTextNode(this.labels.button);
        this.validateButton.appendChild(this.validateButtonLabel);
        this.validateButton.classList.add("clickable");
        this.validateButton.type = "button";


        this.wrapperNode.appendChild(this.ticketNumberLabel);
        this.wrapperNode.appendChild(this.ticketNumberInput);
        this.wrapperNode.appendChild(this.ticketDeviceLabel);
        this.wrapperNode.appendChild(this.ticketDeviceSelect);
        this.wrapperNode.appendChild(this.ticketStateLabel);
        this.wrapperNode.appendChild(this.ticketStateSelect);
        this.wrapperNode.appendChild(this.ticketDescriptionLabel);
        this.wrapperNode.appendChild(this.ticketDescriptionTextarea);
        this.wrapperNode.appendChild(this.validateButton);

        this.bindEvents();

        return this.wrapperNode;
    }

    // charge les données à l'aide de l'APIAdapter
    loadData() {

        Promise.all([this.apiAdapter.ReadStateList(), this.apiAdapter.ReadStateList()]).then(values => {
            values[0].then(response => {

                if (response.ok) {
                    response.json().then(data => {

                        console.log(data);
    
                        data.forEach(element => {
                            
                        });
                    });
                }
            });

            values[1].then(response => {

                if (response.ok) {
                    response.json().then(data => {
    
                        console.log(data)

                        data.forEach(element => {
                            
                        });
                    });
                }
            });
        });
        

        
    }

    // associe les évenements
    bindEvents() {
        if(this.validateButton) {

            //this.validateButton = document.cloneNode(this.validateButton);

            this.validateButton.addEventListener("click", this.onFormValidation.bind(this))
        }
    }

    // evénement lorsqu'on valide le formulaire
    onFormValidation() {

        console.log("click")

        let args = {
            number: "",
            description: "",
            stateCode: "",
            deviceCode: 0
        };

        args.number = this.ticketNumberInput.value;
        args.description = this.ticketDescriptionTextarea.value;
        args.stateCode = this.ticketStateSelect.value;
        args.deviceCode = this.ticketDeviceSelect.value;

        if (
            args.number !== "",
            args.description !== "",
            args.stateCode !== "",
            args.deviceCode !== ""
        ) {
            console.error("Formulaire non valide")
        }
        else {
            this.apiAdapter.CreateNewTicket(args).then(response => {

                if (response.ok) {
                    response.json().then(data => {
    
                        console.log(data);
                    });
                }
            });
        }

        
    }
}

export default TicketForm;