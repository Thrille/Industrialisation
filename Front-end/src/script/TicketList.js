import APIAdapter from "./APIAdapter.js";
import Ticket from "./Ticket.js";
import TicketElement from './TicketElement.js';

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
        this.loadData();
    }

    loadData() {
        this.apiAdapter.ReadTicketList().then(response => {

            if (response.ok) {
                response.json().then(data => {

                    data.forEach(t => {
                        this.tickets.push(new Ticket({
                            id: t["T_ID"], 
                            number: t["T_NUMERO"], 
                            description: t["T_DESCRIPTION"],
                            interventions: [], 
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