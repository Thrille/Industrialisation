import App from "./App.js"

/**
 * La class APIAdapter regroupe toute les intéractions avec l'API
 */
class APIAdapter {

    apiURL

    constructor() {
        // on définit l'url de l'api
        this.apiURL = (window.location.origin + window.location.pathname).replace('index.html', '') + 'api/'
    }

    // retourne le token de connexion
    getToken() {
        this.authToken = App.authToken || ""

        return this.authToken
    }

    // fonction d'autentification, permet de récupérer le token de connexion
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
        })
    }

    
    // Permet d'obtenir la liste des tickets
    async ReadTicketList() {

        return fetch(this.apiURL + 'tickets.php', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.getToken()
            }
        })
    }

    // Permet de lire la liste des materiels
    async ReadDeviceList() {

        return fetch(this.apiURL + 'devices.php', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.getToken()
            }
        })
    }

    // retourne la liste des techniciens
    async ReadTechnicianList() {

        return fetch(this.apiURL + 'technicians.php', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.getToken()
            }
        })
    }

    // Permet de lire la liste des états d'un ticket
    async ReadStateList() {

        return fetch(this.apiURL + 'states.php', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.getToken()
            }
        });
    }

    // On obtient les informations d'un ticket
    async ReadTicketById(id) {
        return fetch(this.apiURL + 'ticket.php?id=' + id, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.getToken()
            }
        });
    }

    // Création d'un nouveau ticket
    async CreateNewTicket({number, description, stateCode, deviceCode, technicianId}) {
        return fetch(this.apiURL + 'ticket.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + this.getToken()
            },
            body: JSON.stringify({
                ticket_number: number,
                ticket_description: description,
                ticket_state_code: stateCode,
                ticket_device_code: deviceCode,
                ticket_technician: technicianId
            })
        });
    }

    // Mise à jour d'un ticket
    async UpdateTicketById({id, number, description, stateCode, deviceCode}) {
        
    }

    // Suppression d'un ticket
    async DeleteTicketById(id) {
        
    }
};

export default APIAdapter;