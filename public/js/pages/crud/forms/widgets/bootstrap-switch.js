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
/******/ 	return __webpack_require__(__webpack_require__.s = 67);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/widgets/bootstrap-switch.js":
/*!****************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/widgets/bootstrap-switch.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// Class definition\nvar KTBootstrapSwitch = function () {\n  // Private functions\n  var demos = function demos() {\n    // minimum setup\n    $('[data-switch=true]').bootstrapSwitch();\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      demos();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTBootstrapSwitch.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9mb3Jtcy93aWRnZXRzL2Jvb3RzdHJhcC1zd2l0Y2guanM/MjFmYSJdLCJuYW1lcyI6WyJLVEJvb3RzdHJhcFN3aXRjaCIsImRlbW9zIiwiJCIsImJvb3RzdHJhcFN3aXRjaCIsImluaXQiLCJqUXVlcnkiLCJkb2N1bWVudCIsInJlYWR5Il0sIm1hcHBpbmdzIjoiQUFBQTtBQUVBLElBQUlBLGlCQUFpQixHQUFHLFlBQVc7QUFFakM7QUFDQSxNQUFJQyxLQUFLLEdBQUcsU0FBUkEsS0FBUSxHQUFXO0FBQ3JCO0FBQ0FDLEtBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCQyxlQUF4QjtBQUNELEdBSEQ7O0FBS0EsU0FBTztBQUNMO0FBQ0FDLFFBQUksRUFBRSxnQkFBVztBQUNmSCxXQUFLO0FBQ047QUFKSSxHQUFQO0FBTUQsQ0FkdUIsRUFBeEI7O0FBZ0JBSSxNQUFNLENBQUNDLFFBQUQsQ0FBTixDQUFpQkMsS0FBakIsQ0FBdUIsWUFBVztBQUNoQ1AsbUJBQWlCLENBQUNJLElBQWxCO0FBQ0QsQ0FGRCIsImZpbGUiOiIuL3Jlc291cmNlcy9tZXRyb25pYy9qcy9wYWdlcy9jcnVkL2Zvcm1zL3dpZGdldHMvYm9vdHN0cmFwLXN3aXRjaC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIENsYXNzIGRlZmluaXRpb25cblxudmFyIEtUQm9vdHN0cmFwU3dpdGNoID0gZnVuY3Rpb24oKSB7XG5cbiAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcbiAgdmFyIGRlbW9zID0gZnVuY3Rpb24oKSB7XG4gICAgLy8gbWluaW11bSBzZXR1cFxuICAgICQoJ1tkYXRhLXN3aXRjaD10cnVlXScpLmJvb3RzdHJhcFN3aXRjaCgpO1xuICB9O1xuXG4gIHJldHVybiB7XG4gICAgLy8gcHVibGljIGZ1bmN0aW9uc1xuICAgIGluaXQ6IGZ1bmN0aW9uKCkge1xuICAgICAgZGVtb3MoKTtcbiAgICB9LFxuICB9O1xufSgpO1xuXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xuICBLVEJvb3RzdHJhcFN3aXRjaC5pbml0KCk7XG59KTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/crud/forms/widgets/bootstrap-switch.js\n");

/***/ }),

/***/ 67:
/*!**********************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/widgets/bootstrap-switch.js ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/laravel/concursos-publicos/resources/metronic/js/pages/crud/forms/widgets/bootstrap-switch.js */"./resources/metronic/js/pages/crud/forms/widgets/bootstrap-switch.js");


/***/ })

/******/ });