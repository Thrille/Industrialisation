import APIAdapter from "./APIAdapter";

class TicketList {

    #parentNode;
    #wrapperNode;
    #tickets;
    #apiAdapter;

    constructor() {
        this.parentNode = document.getElementById("ticket-list");
        this.wrapperNode = document.createElement('ul');
        this.tickets = [];

        this.render();
        this.apiAdapter = new APIAdapter();
    }

    loadData() {
        document.getElementById("debug").value += "loadData";
        this.apiAdapter.ReadTicketList().then(response => {
            this.tickets = response;
            document.getElementById("debug").value += response;
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