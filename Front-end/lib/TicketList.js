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

            _this.TicketElement();
          });
        }
      });
    }
  }, {
    key: "render",
    value: function render() {
      var nav = document.createElement("nav");
      this.parentNode.appendChild(nav);
      nav.appendChild(this.wrapperNode);
    }
  }, {
    key: "TicketElement",
    value: function TicketElement() {
      var _this2 = this;

      this.tickets.forEach(function (ticket) {
        var li = document.createElement("li");
        var table = document.createElement("table");
        var numberRow = document.createElement("tr");
        var actorEntryRow = document.createElement("tr");
        var actorResolveRow = document.createElement("tr");
        var actorResolvedRow = document.createElement("tr");
        var entryDateRow = document.createElement("tr");
        var resolveDateRow = document.createElement("tr");
        var descriptionRow = document.createElement("tr");
        var stateCodeRow = document.createElement("tr");
        var deviceCodeRow = document.createElement("tr");
        var numberLabelTextNode = document.createTextNode("N° de Ticket");
        var actorEntryLabelTextNode = document.createTextNode("Intervenant qui a saisi");
        var actorResolveLabelTextNode = document.createTextNode("Intervenant qui doit le résoudre");
        var actorResolvedLabelTextNode = document.createTextNode("Intervenant qui l'a résolu");
        var entryDateLabelTextNode = document.createTextNode("Date de saisie");
        var resolveDateLabelTextNode = document.createTextNode("Date de résolution");
        var descriptionLabelTextNode = document.createTextNode("Description du problème");
        var stateCodeLabelTextNode = document.createTextNode("Etat du Ticket");
        var deviceCodeLabelTextNode = document.createTextNode("Type de matériel en cause");
        var numberTextNode = document.createTextNode(ticket.number);
        var actorEntryTextNode = document.createTextNode("");
        var actorResolveTextNode = document.createTextNode("");
        var actorResolvedTextNode = document.createTextNode("");
        var entryDateTextNode = document.createTextNode("");
        var resolveDateTextNode = document.createTextNode("");
        var descriptionTextNode = document.createTextNode(ticket.description);
        var stateCodeTextNode = document.createTextNode(ticket.stateCode);
        var deviceCodeTextNode = document.createTextNode(ticket.deviceCode);
        var numberLabelDataRow = document.createElement("td");
        var numberDataRow = document.createElement("td");
        var actorEntryLabelDataRow = document.createElement("td");
        var actorEntryDataRow = document.createElement("td");
        var actorResolveLabelDataRow = document.createElement("td");
        var actorResolveDataRow = document.createElement("td");
        var actorResolvedLabelDataRow = document.createElement("td");
        var actorResolvedDataRow = document.createElement("td");
        var entryDateLabelDataRow = document.createElement("td");
        var entryDateDataRow = document.createElement("td");
        var resolveDateLabelDataRow = document.createElement("td");
        var resolveDateDataRow = document.createElement("td");
        var descriptionLabelDataRow = document.createElement("td");
        var descriptionDataRow = document.createElement("td");
        var stateCodeLabelDataRow = document.createElement("td");
        var stateCodeDataRow = document.createElement("td");
        var deviceCodeLableDataRow = document.createElement("td");
        var deviceCodeDataRow = document.createElement("td");
        numberLabelDataRow.appendChild(numberLabelTextNode);
        numberDataRow.appendChild(numberTextNode);
        actorEntryLabelDataRow.appendChild(actorEntryLabelTextNode);
        actorEntryDataRow.appendChild(actorEntryTextNode);
        actorResolveLabelDataRow.appendChild(actorResolveLabelTextNode);
        actorResolveDataRow.appendChild(actorResolveTextNode);
        actorResolvedLabelDataRow.appendChild(actorResolvedLabelTextNode);
        actorResolvedDataRow.appendChild(actorResolvedTextNode);
        entryDateLabelDataRow.appendChild(entryDateLabelTextNode);
        entryDateDataRow.appendChild(entryDateTextNode);
        resolveDateLabelDataRow.appendChild(resolveDateLabelTextNode);
        resolveDateDataRow.appendChild(resolveDateTextNode);
        descriptionLabelDataRow.appendChild(descriptionLabelTextNode);
        descriptionDataRow.appendChild(descriptionTextNode);
        stateCodeLabelDataRow.appendChild(stateCodeLabelTextNode);
        stateCodeDataRow.appendChild(stateCodeTextNode);
        deviceCodeLableDataRow.appendChild(deviceCodeLabelTextNode);
        deviceCodeDataRow.appendChild(deviceCodeTextNode);
        numberRow.appendChild(numberLabelDataRow);
        numberRow.appendChild(numberDataRow);
        actorEntryRow.appendChild(actorEntryLabelDataRow);
        actorEntryRow.appendChild(actorEntryDataRow);
        actorResolveRow.appendChild(actorResolveLabelDataRow);
        actorResolveRow.appendChild(actorResolveDataRow);
        actorResolvedRow.appendChild(actorResolvedLabelDataRow);
        actorResolvedRow.appendChild(actorResolvedDataRow);
        entryDateRow.appendChild(entryDateLabelDataRow);
        entryDateRow.appendChild(entryDateDataRow);
        resolveDateRow.appendChild(resolveDateLabelDataRow);
        resolveDateRow.appendChild(resolveDateDataRow);
        descriptionRow.appendChild(descriptionLabelDataRow);
        descriptionRow.appendChild(descriptionDataRow);
        stateCodeRow.appendChild(stateCodeLabelDataRow);
        stateCodeRow.appendChild(stateCodeDataRow);
        deviceCodeRow.appendChild(deviceCodeLableDataRow);
        deviceCodeRow.appendChild(deviceCodeDataRow);
        table.appendChild(numberRow);
        table.appendChild(actorEntryRow);
        table.appendChild(actorResolveRow);
        table.appendChild(actorResolvedRow);
        table.appendChild(entryDateRow);
        table.appendChild(resolveDateRow);
        table.appendChild(descriptionRow);
        table.appendChild(stateCodeRow);
        table.appendChild(deviceCodeRow);
        li.appendChild(table);

        _this2.wrapperNode.appendChild(li);
      });
    }
  }]);
  return TicketList;
}();

;
var _default = TicketList;
exports["default"] = _default;