// classe permettant de gérer un ticket
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

    // fonction de tri des interventions par date
    sortInterventionByDate() {

        this.interventions.sort((a, b) => {
            return a.date.getTime() - b.date.getTime()
        })
    }

    // retourne l'intervention de création si elle existe
    getEntryIntervention() {
        let it = this.interventions.find(i => {
            return (i.type === 1)
        })

        return it
    }

    // retourne l'intervention de la personne qui doit résoudre si elle existe
    getResolveIntervention() {
        return this.interventions.find(i => {
            return (i.type === 3)
        })
    }

    // retourne l'intervention de la résolution si elle existe
    getResolvedIntevention() {
        return this.interventions.find(i => {
            return (i.type === 4)
        })
    }

    // retourne l'intervention de cloture du ticket
    getCloseIntervention() {
        return this.interventions.find(i => {
            return (i.type === 6)
        })
    }
}

export default Ticket;