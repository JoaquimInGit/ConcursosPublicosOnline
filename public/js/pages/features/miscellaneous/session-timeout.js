/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 154);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/session-timeout.js":
/*!*******************************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/session-timeout.js ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar KTSessionTimeoutDemo = function () {\n  var initDemo = function initDemo() {\n    $.sessionTimeout({\n      title: 'Session Timeout Notification',\n      message: 'Your session is about to expire.',\n      keepAliveUrl: HOST_URL + '/api//session-timeout/keepalive.php',\n      redirUrl: '?p=page_user_lock_1',\n      logoutUrl: '?p=page_user_login_1',\n      warnAfter: 5000,\n      //warn after 5 seconds\n      redirAfter: 15000,\n      //redirect after 15 secons,\n      ignoreUserActivity: true,\n      countdownMessage: 'Redirecting in {timer} seconds.',\n      countdownBar: true\n    });\n  };\n\n  return {\n    //main function to initiate the module\n    init: function init() {\n      initDemo();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTSessionTimeoutDemo.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvbWlzY2VsbGFuZW91cy9zZXNzaW9uLXRpbWVvdXQuanM/NjU5YiJdLCJuYW1lcyI6WyJLVFNlc3Npb25UaW1lb3V0RGVtbyIsImluaXREZW1vIiwiJCIsInNlc3Npb25UaW1lb3V0IiwidGl0bGUiLCJtZXNzYWdlIiwia2VlcEFsaXZlVXJsIiwiSE9TVF9VUkwiLCJyZWRpclVybCIsImxvZ291dFVybCIsIndhcm5BZnRlciIsInJlZGlyQWZ0ZXIiLCJpZ25vcmVVc2VyQWN0aXZpdHkiLCJjb3VudGRvd25NZXNzYWdlIiwiY291bnRkb3duQmFyIiwiaW5pdCIsImpRdWVyeSIsImRvY3VtZW50IiwicmVhZHkiXSwibWFwcGluZ3MiOiJBQUFhOztBQUViLElBQUlBLG9CQUFvQixHQUFHLFlBQVk7QUFDbkMsTUFBSUMsUUFBUSxHQUFHLFNBQVhBLFFBQVcsR0FBWTtBQUN2QkMsS0FBQyxDQUFDQyxjQUFGLENBQWlCO0FBQ2JDLFdBQUssRUFBRSw4QkFETTtBQUViQyxhQUFPLEVBQUUsa0NBRkk7QUFHYkMsa0JBQVksRUFBRUMsUUFBUSxHQUFHLHFDQUhaO0FBSWJDLGNBQVEsRUFBRSxxQkFKRztBQUtiQyxlQUFTLEVBQUUsc0JBTEU7QUFNYkMsZUFBUyxFQUFFLElBTkU7QUFNSTtBQUNqQkMsZ0JBQVUsRUFBRSxLQVBDO0FBT007QUFDbkJDLHdCQUFrQixFQUFFLElBUlA7QUFTYkMsc0JBQWdCLEVBQUUsaUNBVEw7QUFVYkMsa0JBQVksRUFBRTtBQVZELEtBQWpCO0FBWUgsR0FiRDs7QUFlQSxTQUFPO0FBQ0g7QUFDQUMsUUFBSSxFQUFFLGdCQUFZO0FBQ2RkLGNBQVE7QUFDWDtBQUpFLEdBQVA7QUFNSCxDQXRCMEIsRUFBM0I7O0FBd0JBZSxNQUFNLENBQUNDLFFBQUQsQ0FBTixDQUFpQkMsS0FBakIsQ0FBdUIsWUFBVztBQUM5QmxCLHNCQUFvQixDQUFDZSxJQUFyQjtBQUNILENBRkQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvbWlzY2VsbGFuZW91cy9zZXNzaW9uLXRpbWVvdXQuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcblxudmFyIEtUU2Vzc2lvblRpbWVvdXREZW1vID0gZnVuY3Rpb24gKCkge1xuICAgIHZhciBpbml0RGVtbyA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJC5zZXNzaW9uVGltZW91dCh7XG4gICAgICAgICAgICB0aXRsZTogJ1Nlc3Npb24gVGltZW91dCBOb3RpZmljYXRpb24nLFxuICAgICAgICAgICAgbWVzc2FnZTogJ1lvdXIgc2Vzc2lvbiBpcyBhYm91dCB0byBleHBpcmUuJyxcbiAgICAgICAgICAgIGtlZXBBbGl2ZVVybDogSE9TVF9VUkwgKyAnL2FwaS8vc2Vzc2lvbi10aW1lb3V0L2tlZXBhbGl2ZS5waHAnLFxuICAgICAgICAgICAgcmVkaXJVcmw6ICc/cD1wYWdlX3VzZXJfbG9ja18xJyxcbiAgICAgICAgICAgIGxvZ291dFVybDogJz9wPXBhZ2VfdXNlcl9sb2dpbl8xJyxcbiAgICAgICAgICAgIHdhcm5BZnRlcjogNTAwMCwgLy93YXJuIGFmdGVyIDUgc2Vjb25kc1xuICAgICAgICAgICAgcmVkaXJBZnRlcjogMTUwMDAsIC8vcmVkaXJlY3QgYWZ0ZXIgMTUgc2Vjb25zLFxuICAgICAgICAgICAgaWdub3JlVXNlckFjdGl2aXR5OiB0cnVlLFxuICAgICAgICAgICAgY291bnRkb3duTWVzc2FnZTogJ1JlZGlyZWN0aW5nIGluIHt0aW1lcn0gc2Vjb25kcy4nLFxuICAgICAgICAgICAgY291bnRkb3duQmFyOiB0cnVlXG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIHJldHVybiB7XG4gICAgICAgIC8vbWFpbiBmdW5jdGlvbiB0byBpbml0aWF0ZSB0aGUgbW9kdWxlXG4gICAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGluaXREZW1vKCk7XG4gICAgICAgIH1cbiAgICB9O1xufSgpO1xuXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xuICAgIEtUU2Vzc2lvblRpbWVvdXREZW1vLmluaXQoKTtcbn0pO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/features/miscellaneous/session-timeout.js\n");

/***/ }),

/***/ 154:
/*!*************************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/session-timeout.js ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/laravel/concursos-publicos/resources/metronic/js/pages/features/miscellaneous/session-timeout.js */"./resources/metronic/js/pages/features/miscellaneous/session-timeout.js");


/***/ })

/******/ });