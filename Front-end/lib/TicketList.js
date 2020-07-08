"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _defineProperty2 = _interopRequireDefault(require("@babel/runtime/helpers/defineProperty"));

var _APIAdapter = _interopRequireDefault(require("./APIAdapter.js"));

var _Ticket = _interopRequireDefault(require("./Ticket.js"));

var TicketList = /*#__PURE__*/function () {
  function TicketList() {
    (0, _classCallCheck2["default"])(this, TicketList);
    (0, _defineProperty2["default"])(this, "parentNode", void 0);
    (0, _defineProperty2["default"])(this, "wrapperNode", void 0);
    (0, _defineProperty2["default"])(this, "tickets", void 0);
    (0, _defineProperty2["default"])(this, "apiAdapter", void 0);
    this.parentNode = document.getElementById("ticket-list");
    this.wrapperNode = document.createElement('ul');
    this.tickets = [];
    this.render();
    this.apiAdapter = new _APIAdapter["default"]();
    this.loadData();
  }

  (0, _createClass2["default"])(TicketList, [{
    key: "loadData",
    value: function loadData() {
      var _this = this;

      this.apiAdapter.ReadTicketList().then(function (response) {
        if (response.ok) {
          response.json().then(function (data) {
            data.forEach(function (t) {
              _this.tickets.push(new _Ticket["default"]({
                id: t["T_ID"],
                number: t["T_NUMERO"],
                description: t["T_DESCRIPTION"],
                stateCode: t["ETAT_E_CODE"],
                deviceCode: t["MATERIEL_M_ID"]
              }));
            });

            _this.renderTickets();
          });
        }
      });
    }
  }, {
    key: "render",
    value: function render() {
      this.parentNode.appendChild(this.wrapperNode);
    }
  }, {
    key: "renderTickets",
    value: function renderTickets() {
      var _this2 = this;

      this.tickets.forEach(function (ticket) {
        var li = document.createElement("li");
        var ticketElement = ticket.render();
        li.appendChild(ticketElement);

        _this2.wrapperNode.appendChild(li);
      });
    }
  }]);
  return TicketList;
}();

;
var _default = TicketList;
exports["default"] = _default;