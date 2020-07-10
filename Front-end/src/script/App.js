import Login from './Login.js'

// classe principale de l'application, stocke les variables globales
export default { logged, authToken }

var logged = false
var authToken = ""

// initialisation de l'application avec le portail de connection
const login = new Login()

