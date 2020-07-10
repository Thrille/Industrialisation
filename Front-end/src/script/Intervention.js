// classe permettant de gérer les intervention des tickets
class Intervention {
    constructor({user, type, date}) {
        this.user = user;
        this.type = type;
        this.date = date;
    }
}

export default Intervention;