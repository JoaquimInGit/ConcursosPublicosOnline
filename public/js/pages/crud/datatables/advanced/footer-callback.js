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
/******/ 	return __webpack_require__(__webpack_require__.s = 22);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js":
/*!*********************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar KTDatatablesAdvancedFooterCalllback = function () {\n  var _init = function init() {\n    var table = $('#kt_datatable'); // begin first table\n\n    table.DataTable({\n      responsive: true,\n      pageLength: 5,\n      lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],\n      footerCallback: function footerCallback(row, data, start, end, display) {\n        var column = 6;\n        var api = this.api(),\n            data; // Remove the formatting to get integer data for summation\n\n        var intVal = function intVal(i) {\n          return typeof i === 'string' ? i.replace(/[\\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;\n        }; // Total over all pages\n\n\n        var total = api.column(column).data().reduce(function (a, b) {\n          return intVal(a) + intVal(b);\n        }, 0); // Total over this page\n\n        var pageTotal = api.column(column, {\n          page: 'current'\n        }).data().reduce(function (a, b) {\n          return intVal(a) + intVal(b);\n        }, 0); // Update footer\n\n        $(api.column(column).footer()).html('$' + KTUtil.numberString(pageTotal.toFixed(2)) + '<br/> ( $' + KTUtil.numberString(total.toFixed(2)) + ' total)');\n      }\n    });\n  };\n\n  return {\n    //main function to initiate the module\n    init: function init() {\n      _init();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTDatatablesAdvancedFooterCalllback.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9kYXRhdGFibGVzL2FkdmFuY2VkL2Zvb3Rlci1jYWxsYmFjay5qcz9kNDcyIl0sIm5hbWVzIjpbIktURGF0YXRhYmxlc0FkdmFuY2VkRm9vdGVyQ2FsbGxiYWNrIiwiaW5pdCIsInRhYmxlIiwiJCIsIkRhdGFUYWJsZSIsInJlc3BvbnNpdmUiLCJwYWdlTGVuZ3RoIiwibGVuZ3RoTWVudSIsImZvb3RlckNhbGxiYWNrIiwicm93IiwiZGF0YSIsInN0YXJ0IiwiZW5kIiwiZGlzcGxheSIsImNvbHVtbiIsImFwaSIsImludFZhbCIsImkiLCJyZXBsYWNlIiwidG90YWwiLCJyZWR1Y2UiLCJhIiwiYiIsInBhZ2VUb3RhbCIsInBhZ2UiLCJmb290ZXIiLCJodG1sIiwiS1RVdGlsIiwibnVtYmVyU3RyaW5nIiwidG9GaXhlZCIsImpRdWVyeSIsImRvY3VtZW50IiwicmVhZHkiXSwibWFwcGluZ3MiOiJBQUFhOztBQUNiLElBQUlBLG1DQUFtQyxHQUFHLFlBQVc7QUFFcEQsTUFBSUMsS0FBSSxHQUFHLFNBQVBBLElBQU8sR0FBVztBQUNyQixRQUFJQyxLQUFLLEdBQUdDLENBQUMsQ0FBQyxlQUFELENBQWIsQ0FEcUIsQ0FHckI7O0FBQ0FELFNBQUssQ0FBQ0UsU0FBTixDQUFnQjtBQUNmQyxnQkFBVSxFQUFFLElBREc7QUFFZkMsZ0JBQVUsRUFBRSxDQUZHO0FBR2ZDLGdCQUFVLEVBQUUsQ0FBQyxDQUFDLENBQUQsRUFBSSxDQUFKLEVBQU8sRUFBUCxFQUFXLEVBQVgsRUFBZSxDQUFDLENBQWhCLENBQUQsRUFBcUIsQ0FBQyxDQUFELEVBQUksQ0FBSixFQUFPLEVBQVAsRUFBVyxFQUFYLEVBQWUsS0FBZixDQUFyQixDQUhHO0FBSWZDLG9CQUFjLEVBQUUsd0JBQVNDLEdBQVQsRUFBY0MsSUFBZCxFQUFvQkMsS0FBcEIsRUFBMkJDLEdBQTNCLEVBQWdDQyxPQUFoQyxFQUF5QztBQUV4RCxZQUFJQyxNQUFNLEdBQUcsQ0FBYjtBQUNBLFlBQUlDLEdBQUcsR0FBRyxLQUFLQSxHQUFMLEVBQVY7QUFBQSxZQUFzQkwsSUFBdEIsQ0FId0QsQ0FLeEQ7O0FBQ0EsWUFBSU0sTUFBTSxHQUFHLFNBQVRBLE1BQVMsQ0FBU0MsQ0FBVCxFQUFZO0FBQ3hCLGlCQUFPLE9BQU9BLENBQVAsS0FBYSxRQUFiLEdBQXdCQSxDQUFDLENBQUNDLE9BQUYsQ0FBVSxRQUFWLEVBQW9CLEVBQXBCLElBQTBCLENBQWxELEdBQXNELE9BQU9ELENBQVAsS0FBYSxRQUFiLEdBQXdCQSxDQUF4QixHQUE0QixDQUF6RjtBQUNBLFNBRkQsQ0FOd0QsQ0FVeEQ7OztBQUNBLFlBQUlFLEtBQUssR0FBR0osR0FBRyxDQUFDRCxNQUFKLENBQVdBLE1BQVgsRUFBbUJKLElBQW5CLEdBQTBCVSxNQUExQixDQUFpQyxVQUFTQyxDQUFULEVBQVlDLENBQVosRUFBZTtBQUMzRCxpQkFBT04sTUFBTSxDQUFDSyxDQUFELENBQU4sR0FBWUwsTUFBTSxDQUFDTSxDQUFELENBQXpCO0FBQ0EsU0FGVyxFQUVULENBRlMsQ0FBWixDQVh3RCxDQWV4RDs7QUFDQSxZQUFJQyxTQUFTLEdBQUdSLEdBQUcsQ0FBQ0QsTUFBSixDQUFXQSxNQUFYLEVBQW1CO0FBQUNVLGNBQUksRUFBRTtBQUFQLFNBQW5CLEVBQXNDZCxJQUF0QyxHQUE2Q1UsTUFBN0MsQ0FBb0QsVUFBU0MsQ0FBVCxFQUFZQyxDQUFaLEVBQWU7QUFDbEYsaUJBQU9OLE1BQU0sQ0FBQ0ssQ0FBRCxDQUFOLEdBQVlMLE1BQU0sQ0FBQ00sQ0FBRCxDQUF6QjtBQUNBLFNBRmUsRUFFYixDQUZhLENBQWhCLENBaEJ3RCxDQW9CeEQ7O0FBQ0FuQixTQUFDLENBQUNZLEdBQUcsQ0FBQ0QsTUFBSixDQUFXQSxNQUFYLEVBQW1CVyxNQUFuQixFQUFELENBQUQsQ0FBK0JDLElBQS9CLENBQ0MsTUFBTUMsTUFBTSxDQUFDQyxZQUFQLENBQW9CTCxTQUFTLENBQUNNLE9BQVYsQ0FBa0IsQ0FBbEIsQ0FBcEIsQ0FBTixHQUFrRCxXQUFsRCxHQUFnRUYsTUFBTSxDQUFDQyxZQUFQLENBQW9CVCxLQUFLLENBQUNVLE9BQU4sQ0FBYyxDQUFkLENBQXBCLENBQWhFLEdBQXdHLFNBRHpHO0FBR0E7QUE1QmMsS0FBaEI7QUE4QkEsR0FsQ0Q7O0FBb0NBLFNBQU87QUFFTjtBQUNBNUIsUUFBSSxFQUFFLGdCQUFXO0FBQ2hCQSxXQUFJO0FBQ0o7QUFMSyxHQUFQO0FBU0EsQ0EvQ3lDLEVBQTFDOztBQWlEQTZCLE1BQU0sQ0FBQ0MsUUFBRCxDQUFOLENBQWlCQyxLQUFqQixDQUF1QixZQUFXO0FBQ2pDaEMscUNBQW1DLENBQUNDLElBQXBDO0FBQ0EsQ0FGRCIsImZpbGUiOiIuL3Jlc291cmNlcy9tZXRyb25pYy9qcy9wYWdlcy9jcnVkL2RhdGF0YWJsZXMvYWR2YW5jZWQvZm9vdGVyLWNhbGxiYWNrLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XG52YXIgS1REYXRhdGFibGVzQWR2YW5jZWRGb290ZXJDYWxsbGJhY2sgPSBmdW5jdGlvbigpIHtcblxuXHR2YXIgaW5pdCA9IGZ1bmN0aW9uKCkge1xuXHRcdHZhciB0YWJsZSA9ICQoJyNrdF9kYXRhdGFibGUnKTtcblxuXHRcdC8vIGJlZ2luIGZpcnN0IHRhYmxlXG5cdFx0dGFibGUuRGF0YVRhYmxlKHtcblx0XHRcdHJlc3BvbnNpdmU6IHRydWUsXG5cdFx0XHRwYWdlTGVuZ3RoOiA1LFxuXHRcdFx0bGVuZ3RoTWVudTogW1syLCA1LCAxMCwgMTUsIC0xXSwgWzIsIDUsIDEwLCAxNSwgJ0FsbCddXSxcblx0XHRcdGZvb3RlckNhbGxiYWNrOiBmdW5jdGlvbihyb3csIGRhdGEsIHN0YXJ0LCBlbmQsIGRpc3BsYXkpIHtcblxuXHRcdFx0XHR2YXIgY29sdW1uID0gNjtcblx0XHRcdFx0dmFyIGFwaSA9IHRoaXMuYXBpKCksIGRhdGE7XG5cblx0XHRcdFx0Ly8gUmVtb3ZlIHRoZSBmb3JtYXR0aW5nIHRvIGdldCBpbnRlZ2VyIGRhdGEgZm9yIHN1bW1hdGlvblxuXHRcdFx0XHR2YXIgaW50VmFsID0gZnVuY3Rpb24oaSkge1xuXHRcdFx0XHRcdHJldHVybiB0eXBlb2YgaSA9PT0gJ3N0cmluZycgPyBpLnJlcGxhY2UoL1tcXCQsXS9nLCAnJykgKiAxIDogdHlwZW9mIGkgPT09ICdudW1iZXInID8gaSA6IDA7XG5cdFx0XHRcdH07XG5cblx0XHRcdFx0Ly8gVG90YWwgb3ZlciBhbGwgcGFnZXNcblx0XHRcdFx0dmFyIHRvdGFsID0gYXBpLmNvbHVtbihjb2x1bW4pLmRhdGEoKS5yZWR1Y2UoZnVuY3Rpb24oYSwgYikge1xuXHRcdFx0XHRcdHJldHVybiBpbnRWYWwoYSkgKyBpbnRWYWwoYik7XG5cdFx0XHRcdH0sIDApO1xuXG5cdFx0XHRcdC8vIFRvdGFsIG92ZXIgdGhpcyBwYWdlXG5cdFx0XHRcdHZhciBwYWdlVG90YWwgPSBhcGkuY29sdW1uKGNvbHVtbiwge3BhZ2U6ICdjdXJyZW50J30pLmRhdGEoKS5yZWR1Y2UoZnVuY3Rpb24oYSwgYikge1xuXHRcdFx0XHRcdHJldHVybiBpbnRWYWwoYSkgKyBpbnRWYWwoYik7XG5cdFx0XHRcdH0sIDApO1xuXG5cdFx0XHRcdC8vIFVwZGF0ZSBmb290ZXJcblx0XHRcdFx0JChhcGkuY29sdW1uKGNvbHVtbikuZm9vdGVyKCkpLmh0bWwoXG5cdFx0XHRcdFx0JyQnICsgS1RVdGlsLm51bWJlclN0cmluZyhwYWdlVG90YWwudG9GaXhlZCgyKSkgKyAnPGJyLz4gKCAkJyArIEtUVXRpbC5udW1iZXJTdHJpbmcodG90YWwudG9GaXhlZCgyKSkgKyAnIHRvdGFsKScsXG5cdFx0XHRcdCk7XG5cdFx0XHR9LFxuXHRcdH0pO1xuXHR9O1xuXG5cdHJldHVybiB7XG5cblx0XHQvL21haW4gZnVuY3Rpb24gdG8gaW5pdGlhdGUgdGhlIG1vZHVsZVxuXHRcdGluaXQ6IGZ1bmN0aW9uKCkge1xuXHRcdFx0aW5pdCgpO1xuXHRcdH0sXG5cblx0fTtcblxufSgpO1xuXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xuXHRLVERhdGF0YWJsZXNBZHZhbmNlZEZvb3RlckNhbGxsYmFjay5pbml0KCk7XG59KTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js\n");

/***/ }),

/***/ 22:
/*!***************************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js ***!
  \***************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/laravel/concursos-publicos/resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js */"./resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js");


/***/ })

/******/ });