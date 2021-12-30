/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/login.js ***!
  \*******************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

$(function () {
  request("POST", "v1", "auth/check").then(function (response) {
    window.location.href = "/";
  })["catch"](function (error) {});
  $(".login").click(function () {
    $(".login-box-msg").html(null);
    request("POST", "v1", "auth/login", {
      email: $("#email").val(),
      password: $("#password").val()
    }).then(function (response) {
      $(".login-box-msg").html('<span class="mb-2 badge bg-success">Giriş başarılı yönlendiriliyorsunuz !</span>');
      localStorage.setItem('x-refresh-token', response.headers["x-refresh-token"]);
      setTimeout(function () {
        window.location.href = "/";
      }, 2000);
    })["catch"](function (error) {
      console.log(error);

      if (error.response.status == 405) {
        Object.entries(error.response.data).forEach(function (_ref) {
          var _ref2 = _slicedToArray(_ref, 2),
              key = _ref2[0],
              value = _ref2[1];

          $(".login-box-msg").append('<span class="mb-2 badge bg-danger">' + value[0] + '</span>');
        });
      } else {
        $(".login-box-msg").append('<span class="mb-2 badge bg-danger">' + error.response.data + '</span>');
      }

      setTimeout(function () {
        $(".login-box-msg").html('<span class="mb-2 badge bg-success">Tekrar Deneyiniz !</span>');
      }, 2000);
    });
  });
});
/******/ })()
;