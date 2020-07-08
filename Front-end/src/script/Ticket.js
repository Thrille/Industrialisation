class Ticket {

    id;
    number;
    description;
    stateCode;
    deviceCode;

    constructor({id, number, description, stateCode, deviceCode}) {
        this.id = id;
        this.number = number;
        this.description = description;
        this.stateCode = stateCode;
        this.deviceCode = deviceCode;
    }
}

export default Ticket;