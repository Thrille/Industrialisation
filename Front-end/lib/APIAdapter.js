"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _regenerator = _interopRequireDefault(require("@babel/runtime/regenerator"));

var _asyncToGenerator2 = _interopRequireDefault(require("@babel/runtime/helpers/asyncToGenerator"));

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _defineProperty2 = _interopRequireDefault(require("@babel/runtime/helpers/defineProperty"));

var APIAdapter = /*#__PURE__*/function () {
  function APIAdapter() {
    (0, _classCallCheck2["default"])(this, APIAdapter);
    (0, _defineProperty2["default"])(this, "apiURL", void 0);
    (0, _defineProperty2["default"])(this, "authTocken", void 0);
    this.apiURL = (window.location.origin + window.location.pathname).replace('index.html', '') + 'api/';
  }

  (0, _createClass2["default"])(APIAdapter, [{
    key: "Auth",
    value: function () {
      var _Auth = (0, _asyncToGenerator2["default"])( /*#__PURE__*/_regenerator["default"].mark(function _callee(_ref) {
        var login, password;
        return _regenerator["default"].wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                login = _ref.login, password = _ref.password;

              case 1:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }));

      function Auth(_x) {
        return _Auth.apply(this, arguments);
      }

      return Auth;
    }()
  }, {
    key: "ReadTicketList",
    value: function () {
      var _ReadTicketList = (0, _asyncToGenerator2["default"])( /*#__PURE__*/_regenerator["default"].mark(function _callee2() {
        return _regenerator["default"].wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                return _context2.abrupt("return", fetch(this.apiURL + 'tickets.php', {
                  method: 'GET',
                  headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.authTocken
                  }
                }));

              case 1:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, this);
      }));

      function ReadTicketList() {
        return _ReadTicketList.apply(this, arguments);
      }

      return ReadTicketList;
    }()
  }, {
    key: "ReadTicketById",
    value: function () {
      var _ReadTicketById = (0, _asyncToGenerator2["default"])( /*#__PURE__*/_regenerator["default"].mark(function _callee3(id) {
        return _regenerator["default"].wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                return _context3.abrupt("return", fetch(this.apiURL + 'ticket.php?id=' + id, {
                  method: 'GET',
                  headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.authTocken
                  }
                }));

              case 1:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3, this);
      }));

      function ReadTicketById(_x2) {
        return _ReadTicketById.apply(this, arguments);
      }

      return ReadTicketById;
    }()
  }, {
    key: "CreateNewTicket",
    value: function () {
      var _CreateNewTicket = (0, _asyncToGenerator2["default"])( /*#__PURE__*/_regenerator["default"].mark(function _callee4(_ref2) {
        var number, description, stateCode, deviceCode;
        return _regenerator["default"].wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                number = _ref2.number, description = _ref2.description, stateCode = _ref2.stateCode, deviceCode = _ref2.deviceCode;

              case 1:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4);
      }));

      function CreateNewTicket(_x3) {
        return _CreateNewTicket.apply(this, arguments);
      }

      return CreateNewTicket;
    }()
  }, {
    key: "UpdateTicketById",
    value: function () {
      var _UpdateTicketById = (0, _asyncToGenerator2["default"])( /*#__PURE__*/_regenerator["default"].mark(function _callee5(_ref3) {
        var id, number, description, stateCode, deviceCode;
        return _regenerator["default"].wrap(function _callee5$(_context5) {
          while (1) {
            switch (_context5.prev = _context5.next) {
              case 0:
                id = _ref3.id, number = _ref3.number, description = _ref3.description, stateCode = _ref3.stateCode, deviceCode = _ref3.deviceCode;

              case 1:
              case "end":
                return _context5.stop();
            }
          }
        }, _callee5);
      }));

      function UpdateTicketById(_x4) {
        return _UpdateTicketById.apply(this, arguments);
      }

      return UpdateTicketById;
    }()
  }, {
    key: "DeleteTicketById",
    value: function () {
      var _DeleteTicketById = (0, _asyncToGenerator2["default"])( /*#__PURE__*/_regenerator["default"].mark(function _callee6(id) {
        return _regenerator["default"].wrap(function _callee6$(_context6) {
          while (1) {
            switch (_context6.prev = _context6.next) {
              case 0:
              case "end":
                return _context6.stop();
            }
          }
        }, _callee6);
      }));

      function DeleteTicketById(_x5) {
        return _DeleteTicketById.apply(this, arguments);
      }

      return DeleteTicketById;
    }()
  }]);
  return APIAdapter;
}();

;
var _default = APIAdapter;
exports["default"] = _default;