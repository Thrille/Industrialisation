import APIAdapter from "./APIAdapter";

class TicketList {

    parentNode;
    wrapperNode;
    tickets;
    apiAdapter;

    constructor() {
        this.parentNode = document.getElementById("ticket-list");
        this.wrapperNode = document.createElement('ul');
        tickets = [];

        this.render();
        this.apiAdapter = new APIAdapter();
    }

    loadData() {
        this.apiAdapter.ReadTicketList().then(response => {
            console.log(response);
        });
    }

    render() {
        let nav = document.createElement('nav');

        this.parentNode.appendChild(nav);
        nav.appendChild(this.wrapperNode);
    }

    TicketElement() {
        this.tickets.forEach(t => {
            
        });
    }
};

export default TicketList;