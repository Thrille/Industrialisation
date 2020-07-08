class APIAdapter {

    apiURL;
    authTocken;

    constructor() {
        console.log(window.location.origin + window.location.pathname + 'api/');
        console.log(window.location.href + 'api/');
        console.log(window.location.protocol + "//" + window.location.host + window.location.pathname + 'api/');
        this.apiURL = window.location.origin + window.location.pathname + 'api/';
    }

    async Auth({login, password}) {
        
    }

    async ReadTicketList() {
        return fetch(this.apiURL + 'tickets.php', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.authTocken
            }
        });
    }

    async ReadTicketById(id) {
        return fetch(this.apiURL + 'ticket.php?id=' + id, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.authTocken
            }
        });
    }

    async CreateNewTicket({number, description, stateCode, deviceCode}) {
        
    }

    async UpdateTicketById({id, number, description, stateCode, deviceCode}) {
        
    }

    async DeleteTicketById(id) {
        
    }
};

export default APIAdapter;