import Login from './Login.js'
import TicketList from './TicketList.js'
import NewTicket from './NewTicket.js'



var logged = false
var authToken = ""

// initialisation de l'application avec le portail de connection
const login = new Login()
const ticketList = new TicketList()
const ticketButton = new NewTicket()

// classe principale de l'application, stocke les variables globales
export default { logged, authToken, login, ticketList, ticketButton }