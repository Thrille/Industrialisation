import APIAdapter from "./APIAdapter.js";
import Ticket from "./Ticket.js";
import TicketElement from './TicketElement.js';
import Intervention from "./Intervention.js";

class TicketList {

    parentNode;
    wrapperNode;
    tickets;
    apiAdapter;

    constructor() {
        this.parentNode = document.getElementById("ticket-list");
        this.wrapperNode = document.createElement('ul');
        this.tickets = [];

        this.render();
        this.apiAdapter = new APIAdapter();
    }

    loadData() {

        this.tickets = [];
        this.apiAdapter.ReadTicketList().then(response => {

            if (response.ok) {
                response.json().then(data => {

                    data.forEach(t => {

                        let interventions = [];

                        t["INTERVENTION"].forEach(i => {
                            interventions.push(new Intervention({
                                user: i["UTILISATEUR_U_IDENTIFIANT"], 
                                type: Number.parseInt(i["TYPE_INTERVENTION_TI_CODE"]), 
                                typeName: i["TYPE_INTERVENTION_TI_LIBELLE"], 
                                date: i["I_DATE"]
                            }))
                        })

                        this.tickets.push(new Ticket({
                            id: Number.parseInt(t["T_ID"]), 
                            number: t["T_NUMERO"], 
                            description: t["T_DESCRIPTION"],
                            interventions: interventions, 
                            stateCode: t["ETAT_E_CODE"], 
                            stateName: t["ETAT_E_LIBELLE"],
                            deviceCode: t["MATERIEL_M_ID"],
                            deviceName: t["MATERIEL_M_LIBELLE"]
                        }));
                    });

                    this.renderTickets();
                });
            }
        });
    }

    render() {
        this.parentNode.appendChild(this.wrapperNode);
    }

    renderTickets() {
        this.tickets.forEach(ticket => {

            let oTicketElement = new TicketElement({ticket: ticket});

            this.wrapperNode.appendChild(oTicketElement.renderInListContext());
        });
    }
};

export default TicketList;