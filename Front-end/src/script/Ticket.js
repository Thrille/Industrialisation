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

        interventions.forEach(i => {
            if (typeof i.date === "string") {
                i.date = new Date(i.date)
            }
        })

        this.interventions = interventions;
        this.stateCode = stateCode;
        this.stateName = stateName;
        this.deviceCode = deviceCode;
        this.deviceName = deviceName;
    }

    sortInterventionByDate() {

        this.interventions.sort((a, b) => {
            return a.date.getTime() - b.date.getTime()
        })
    }

    getEntryIntervention() {
        let it = this.interventions.find(i => {
            return (i.type === 1)
        })

        return it
    }

    getResolveIntervention() {
        return this.interventions.find(i => {
            return (i.type === 3)
        })
    }

    getResolvedIntevention() {
        return this.interventions.find(i => {
            return (i.type === 4)
        })
    }

    getCloseIntervention() {
        return this.interventions.find(i => {
            return (i.type === 6)
        })
    }
}

export default Ticket;