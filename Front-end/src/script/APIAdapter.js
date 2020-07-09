class APIAdapter {

    apiURL;
    authTocken;

    constructor() {
        this.apiURL = (window.location.origin + window.location.pathname).replace('index.html', '') + 'api/';
    }

    async Auth({login, password}) {
        return fetch(this.apiURL + 'auth.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                login: login,
                password: password
            })
        });
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

    async ReadStateList() {

        return fetch(this.apiURL + 'devices.php', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.authTocken
            }
        });
    }

    async ReadStateList() {

        return fetch(this.apiURL + 'states.php', {
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
        return fetch(this.apiURL + 'ticket.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.authTocken
            },
            body: JSON.stringify({
                ticket_number: number,
                ticket_description: description,
                ticket_state_code: stateCode,
                ticket_device_code: deviceCode
            })
        });
    }

    async UpdateTicketById({id, number, description, stateCode, deviceCode}) {
        
    }

    async DeleteTicketById(id) {
        
    }
};

export default APIAdapter;