import APIAdapter from "./APIAdapter.js";
import State from "./State.js";
import Device from "./Device.js";
import App from "./App.js";

// formulaire de création et d'édition de ticket
class TicketForm {

    wrapperNode;
    labels;

    constructor({modal}) {
        this.labels = {
            number: "Numéro",
            device: "Materiel impliqué",
            state: "Etat du ticket",
            description: "Description",
            resolver: "Intervenant devant résoudre",
            button: "Créer le ticket",
            actoreResolve: "Technicien devant résoudre le ticket"
        };

        this.states = []
        this.devices = []
        this.technicians = []

        this.modal = modal

        this.apiAdapter = new APIAdapter()

        this.loadData()
    }

    // rendu du formulaire
    render() {
        this.wrapperNode = document.createElement("form")

        this.ticketNumberInput = document.createElement("input")
        this.ticketNumberLabel = document.createElement("label")
        this.ticketNumberInput.id = "ticket-number-input"
        this.ticketNumberLabel.for = "ticket-number-input"
        this.ticketNumberLabel.appendChild(document.createTextNode(this.labels.number))

        this.ticketDescriptionTextarea = document.createElement("textarea")
        this.ticketDescriptionLabel = document.createElement("label")
        this.ticketDescriptionTextarea.id = "ticket-description-textarea"
        this.ticketDescriptionLabel.for = "ticket-description-textarea"
        this.ticketDescriptionLabel.appendChild(document.createTextNode(this.labels.description))

        this.ticketStateSelect = document.createElement("select")
        this.ticketStateLabel = document.createElement("label")
        this.ticketStateSelect.id = "ticket-state-select"
        this.ticketStateLabel.for = "ticket-state-select"
        this.ticketStateLabel.appendChild(document.createTextNode(this.labels.state))

        this.ticketDeviceSelect = document.createElement("select")
        this.ticketDeviceLabel = document.createElement("label")
        this.ticketDeviceSelect.id = "ticket-device-select"
        this.ticketDeviceLabel.for = "ticket-device-select"
        this.ticketDeviceLabel.appendChild(document.createTextNode(this.labels.device))

        this.ticketActorResolveSelect = document.createElement("select")
        this.ticketActorResolveLabel = document.createElement("label")
        this.ticketActorResolveSelect.id = "ticket-device-select"
        this.ticketActorResolveLabel.for = "ticket-device-select"
        this.ticketActorResolveLabel.appendChild(document.createTextNode(this.labels.actoreResolve))


        this.validateButton = document.createElement("button")
        this.validateButtonLabel = document.createTextNode(this.labels.button)
        this.validateButton.appendChild(this.validateButtonLabel)
        this.validateButton.classList.add("clickable")
        this.validateButton.type = "button"


        this.wrapperNode.appendChild(this.ticketNumberLabel)
        this.wrapperNode.appendChild(this.ticketNumberInput)
        this.wrapperNode.appendChild(this.ticketDeviceLabel)
        this.wrapperNode.appendChild(this.ticketDeviceSelect)
        this.wrapperNode.appendChild(this.ticketStateLabel)
        this.wrapperNode.appendChild(this.ticketStateSelect)
        this.wrapperNode.appendChild(this.ticketActorResolveLabel)
        this.wrapperNode.appendChild(this.ticketActorResolveSelect)
        this.wrapperNode.appendChild(this.ticketDescriptionLabel)
        this.wrapperNode.appendChild(this.ticketDescriptionTextarea)
        this.wrapperNode.appendChild(this.validateButton)

        this.bindEvents()

        return this.wrapperNode
    }

    renderDeviceSelectElement() {
        if (this.ticketDeviceSelect) {

            this.ticketDeviceSelect.innerHTML = ""

            this.devices.forEach(device => {

                let deviceOption = document.createElement("option")

                deviceOption.value = device.id

                deviceOption.appendChild(document.createTextNode(device.name))

                this.ticketDeviceSelect.appendChild(deviceOption)
            })
        }
    }

    renderStateSelectElement() {
        if (this.ticketStateSelect) {
            
            this.ticketStateSelect.innerHTML = ""

            this.states.forEach(state => {

                let stateOption = document.createElement("option")

                stateOption.value = state.code

                stateOption.appendChild(document.createTextNode(state.name))

                this.ticketStateSelect.appendChild(stateOption)
            })

        }
    }
    renderActorResolveSelectElement() {
        if (this.ticketActorResolveSelect) {

            this.ticketActorResolveSelect.innerHTML = ""

            this.technicians.forEach(actoreResolve => {

                let actoreResolveOption = document.createElement("option")

                actoreResolveOption.value = actoreResolve.id

                actoreResolveOption.appendChild(document.createTextNode(actoreResolve.name))

                this.ticketActorResolveSelect.appendChild(actoreResolveOption)
            })

        }
    }

    // charge les données à l'aide de l'APIAdapter
    loadData() {

        Promise.all([this.apiAdapter.ReadDeviceList(), this.apiAdapter.ReadStateList(), this.apiAdapter.ReadTechnicianList()]).then(responses => {

            if (responses[0].ok && responses[1].ok && responses[2]) {

                responses[0].json().then(data => {

                    console.log(data);

                    data.forEach(d => {
                        
                        this.devices.push(new Device({
                            id: d["M_ID"],
                            name: d["M_LIBELLE"]
                        }))

                    })

                    this.renderDeviceSelectElement()
                })

                responses[1].json().then(data => {

                    data.forEach(s => {
                        
                        this.states.push(new State({
                            code: s["E_CODE"],
                            name: s["E_LIBELLE"]
                        }))

                    })

                    this.renderStateSelectElement()
                })

                responses[2].json().then(data => {

                    console.log(data)

                    data.forEach(t => {
                        
                        this.technicians.push({
                            id: t["U_ID"],
                            name: t["U_IDENTIFIANT"],
                            roleCode: t["ROLE_R_CODE"]
                        })

                    })

                    this.renderActorResolveSelectElement()
                })
            }
        })
        

        
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
            technicianId: 0,
            deviceCode: 0
        };

        args.number = this.ticketNumberInput.value
        args.description = this.ticketDescriptionTextarea.value
        args.stateCode = this.ticketStateSelect.value
        args.technicianId = Number.parseInt(this.ticketActorResolveSelect.value)
        args.deviceCode = Number.parseInt(this.ticketDeviceSelect.value)

        if (
            args.number.length > 0 &&
            args.description.length > 0 &&
            args.stateCode.length > 0 &&
            args.technicianId > 0 &&
            args.deviceCode > 0
        ) {
            this.apiAdapter.CreateNewTicket(args).then(response => {

                if (response.ok) {

                    App.ticketList.loadData()

                    console.log(this)

                    this.modal.close()
                }
            });
        }
        else {
            console.error("Formulaire non valide")
        }

        
    }
}

export default TicketForm;