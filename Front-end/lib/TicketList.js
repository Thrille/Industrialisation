"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _APIAdapter = _interopRequireDefault(require("./APIAdapter"));

var _parentNode = new WeakMap();

var _wrapperNode = new WeakMap();

var _tickets = new WeakMap();

var _apiAdapter = new WeakMap();

var TicketList = /*#__PURE__*/function () {
  function TicketList() {
    (0, _classCallCheck2["default"])(this, TicketList);

    _parentNode.set(this, {
      writable: true,
      value: void 0
    });

    _wrapperNode.set(this, {
      writable: true,
      value: void 0
    });

    _tickets.set(this, {
      writable: true,
      value: void 0
    });

    _apiAdapter.set(this, {
      writable: true,
      value: void 0
    });

    this.parentNode = document.getElementById("ticket-list");
    this.wrapperNode = document.createElement('ul');
    this.tickets = [];
    this.render();
    this.apiAdapter = new _APIAdapter["default"]();
  }

  (0, _createClass2["default"])(TicketList, [{
    key: "loadData",
    value: function loadData() {
      var _this = this;

      document.getElementById("debug").value += "loadData";
      this.apiAdapter.ReadTicketList().then(function (response) {
        _this.tickets = response;
        document.getElementById("debug").value += response;
      });
    }
  }, {
    key: "render",
    value: function render() {
      var nav = document.createElement('nav');
      this.parentNode.appendChild(nav);
      nav.appendChild(this.wrapperNode);
    }
  }, {
    key: "TicketElement",
    value: function TicketElement() {
      this.tickets.forEach(function (t) {});
    }
  }]);
  return TicketList;
}();

;
var _default = TicketList;
exports["default"] = _default;