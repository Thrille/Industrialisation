import APIAdapter from "./APIAdapter.js";
import Ticket from "./Ticket.js";

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
                            stateCode: t["ETAT_E_CODE"], 
                            deviceCode: t["MATERIEL_M_ID"]
                        }));
                    });

                    this.renderTickets();
                });
            }
        });
    }

    render() {
        let nav = document.createElement("nav");

        this.parentNode.appendChild(nav);
        nav.appendChild(this.wrapperNode);
    }

    renderTickets() {
        this.tickets.forEach(ticket => {

            let li = document.createElement("li");

            let ticketElement = ticket.render();

            li.appendChild(ticketElement);

            this.wrapperNode.appendChild(li);
        });
    }
};

export default TicketList;