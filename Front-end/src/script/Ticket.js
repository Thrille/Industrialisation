class Ticket {

    id;
    number;
    description;
    stateCode;
    deviceCode;

    constructor({id, number, description, interventions, stateCode, stateName, deviceCode, deviceName}) {
        this.id = id;
        this.number = number;
        this.description = description;
        this.interventions = interventions;
        this.stateCode = stateCode;
        this.stateName = stateName;
        this.deviceCode = deviceCode;
        this.deviceName = deviceName;
    }
}

export default Ticket;