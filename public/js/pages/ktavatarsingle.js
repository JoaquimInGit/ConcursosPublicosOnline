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
/******/ 	return __webpack_require__(__webpack_require__.s = 160);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/ktavatarsingle.js":
/*!*******************************************************!*\
  !*** ./resources/metronic/js/pages/ktavatarsingle.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval(" // Class definition\n\nvar KTAvatarSingle = function () {\n  // Private functions\n  var _avatar;\n\n  var _init = function init() {\n    _avatar = new KTAvatar('kt_avatar_single'); //var avatar2 = new KTAvatar('kt_user_avatar_2');\n    //var avatar3 = new KTAvatar('kt_user_avatar_3');\n    //var avatar4 = new KTAvatar('kt_user_avatar_4');\n\n    if ($(\"#kt_avatar_single\").attr('data-default-image') !== \"undefined\") {\n      _avatar.on('cancel', function (e) {\n        if (e.src == $(e.holder).css('background-image') && e.src.indexOf($(e.element).data('default-image')) == -1) {\n          e.src = \"url(\" + $(e.element).data('default-image') + \")\";\n          $('#' + $(e.element).data('delete-input-id')).val(1);\n        }\n      });\n\n      _avatar.on('after-cancel', function (e) {\n        if (e.src.indexOf($(e.element).data('default-image')) == -1) {\n          $(e.element).addClass('kt-avatar--changed');\n        }\n      });\n    }\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      _init();\n    },\n    avatar: function avatar() {\n      return _avatar;\n    }\n  };\n}();\n\nKTUtil.ready(function () {\n  KTAvatarSingle.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMva3RhdmF0YXJzaW5nbGUuanM/OGJkNyJdLCJuYW1lcyI6WyJLVEF2YXRhclNpbmdsZSIsImF2YXRhciIsImluaXQiLCJLVEF2YXRhciIsIiQiLCJhdHRyIiwib24iLCJlIiwic3JjIiwiaG9sZGVyIiwiY3NzIiwiaW5kZXhPZiIsImVsZW1lbnQiLCJkYXRhIiwidmFsIiwiYWRkQ2xhc3MiLCJLVFV0aWwiLCJyZWFkeSJdLCJtYXBwaW5ncyI6IkNBRUE7O0FBQ0EsSUFBSUEsY0FBYyxHQUFHLFlBQVk7QUFDN0I7QUFDQSxNQUFJQyxPQUFKOztBQUNBLE1BQUlDLEtBQUksR0FBRyxTQUFQQSxJQUFPLEdBQVk7QUFDbkJELFdBQU0sR0FBRyxJQUFJRSxRQUFKLENBQWEsa0JBQWIsQ0FBVCxDQURtQixDQUVuQjtBQUNBO0FBQ0E7O0FBQ0EsUUFBR0MsQ0FBQyxDQUFDLG1CQUFELENBQUQsQ0FBdUJDLElBQXZCLENBQTRCLG9CQUE1QixNQUFzRCxXQUF6RCxFQUFzRTtBQUNsRUosYUFBTSxDQUFDSyxFQUFQLENBQVUsUUFBVixFQUFvQixVQUFVQyxDQUFWLEVBQWE7QUFDN0IsWUFBSUEsQ0FBQyxDQUFDQyxHQUFGLElBQVNKLENBQUMsQ0FBQ0csQ0FBQyxDQUFDRSxNQUFILENBQUQsQ0FBWUMsR0FBWixDQUFnQixrQkFBaEIsQ0FBVCxJQUFnREgsQ0FBQyxDQUFDQyxHQUFGLENBQU1HLE9BQU4sQ0FBY1AsQ0FBQyxDQUFDRyxDQUFDLENBQUNLLE9BQUgsQ0FBRCxDQUFhQyxJQUFiLENBQWtCLGVBQWxCLENBQWQsS0FBcUQsQ0FBQyxDQUExRyxFQUE2RztBQUN6R04sV0FBQyxDQUFDQyxHQUFGLEdBQVEsU0FBU0osQ0FBQyxDQUFDRyxDQUFDLENBQUNLLE9BQUgsQ0FBRCxDQUFhQyxJQUFiLENBQWtCLGVBQWxCLENBQVQsR0FBOEMsR0FBdEQ7QUFDQVQsV0FBQyxDQUFDLE1BQU1BLENBQUMsQ0FBQ0csQ0FBQyxDQUFDSyxPQUFILENBQUQsQ0FBYUMsSUFBYixDQUFrQixpQkFBbEIsQ0FBUCxDQUFELENBQThDQyxHQUE5QyxDQUFrRCxDQUFsRDtBQUNIO0FBQ0osT0FMRDs7QUFNQWIsYUFBTSxDQUFDSyxFQUFQLENBQVUsY0FBVixFQUEwQixVQUFVQyxDQUFWLEVBQWE7QUFDbkMsWUFBSUEsQ0FBQyxDQUFDQyxHQUFGLENBQU1HLE9BQU4sQ0FBY1AsQ0FBQyxDQUFDRyxDQUFDLENBQUNLLE9BQUgsQ0FBRCxDQUFhQyxJQUFiLENBQWtCLGVBQWxCLENBQWQsS0FBcUQsQ0FBQyxDQUExRCxFQUE2RDtBQUN6RFQsV0FBQyxDQUFDRyxDQUFDLENBQUNLLE9BQUgsQ0FBRCxDQUFhRyxRQUFiLENBQXNCLG9CQUF0QjtBQUNIO0FBQ0osT0FKRDtBQUtIO0FBQ0osR0FsQkQ7O0FBb0JBLFNBQU87QUFDSDtBQUNBYixRQUFJLEVBQUUsZ0JBQVc7QUFDYkEsV0FBSTtBQUNQLEtBSkU7QUFLSEQsVUFBTSxFQUFFLGtCQUFXO0FBQ2YsYUFBT0EsT0FBUDtBQUNIO0FBUEUsR0FBUDtBQVNILENBaENvQixFQUFyQjs7QUFrQ0FlLE1BQU0sQ0FBQ0MsS0FBUCxDQUFhLFlBQVc7QUFDcEJqQixnQkFBYyxDQUFDRSxJQUFmO0FBQ0gsQ0FGRCIsImZpbGUiOiIuL3Jlc291cmNlcy9tZXRyb25pYy9qcy9wYWdlcy9rdGF2YXRhcnNpbmdsZS5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xuXG4vLyBDbGFzcyBkZWZpbml0aW9uXG52YXIgS1RBdmF0YXJTaW5nbGUgPSBmdW5jdGlvbiAoKSB7XG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcbiAgICB2YXIgYXZhdGFyO1xuICAgIHZhciBpbml0ID0gZnVuY3Rpb24gKCkge1xuICAgICAgICBhdmF0YXIgPSBuZXcgS1RBdmF0YXIoJ2t0X2F2YXRhcl9zaW5nbGUnKTtcbiAgICAgICAgLy92YXIgYXZhdGFyMiA9IG5ldyBLVEF2YXRhcigna3RfdXNlcl9hdmF0YXJfMicpO1xuICAgICAgICAvL3ZhciBhdmF0YXIzID0gbmV3IEtUQXZhdGFyKCdrdF91c2VyX2F2YXRhcl8zJyk7XG4gICAgICAgIC8vdmFyIGF2YXRhcjQgPSBuZXcgS1RBdmF0YXIoJ2t0X3VzZXJfYXZhdGFyXzQnKTtcbiAgICAgICAgaWYoJChcIiNrdF9hdmF0YXJfc2luZ2xlXCIpLmF0dHIoJ2RhdGEtZGVmYXVsdC1pbWFnZScpICE9PSBcInVuZGVmaW5lZFwiKSB7XG4gICAgICAgICAgICBhdmF0YXIub24oJ2NhbmNlbCcsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICAgICAgICAgaWYgKGUuc3JjID09ICQoZS5ob2xkZXIpLmNzcygnYmFja2dyb3VuZC1pbWFnZScpICYmIGUuc3JjLmluZGV4T2YoJChlLmVsZW1lbnQpLmRhdGEoJ2RlZmF1bHQtaW1hZ2UnKSkgPT0gLTEpIHtcbiAgICAgICAgICAgICAgICAgICAgZS5zcmMgPSBcInVybChcIiArICQoZS5lbGVtZW50KS5kYXRhKCdkZWZhdWx0LWltYWdlJykgKyBcIilcIjtcbiAgICAgICAgICAgICAgICAgICAgJCgnIycgKyAkKGUuZWxlbWVudCkuZGF0YSgnZGVsZXRlLWlucHV0LWlkJykpLnZhbCgxKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIGF2YXRhci5vbignYWZ0ZXItY2FuY2VsJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAgICAgICBpZiAoZS5zcmMuaW5kZXhPZigkKGUuZWxlbWVudCkuZGF0YSgnZGVmYXVsdC1pbWFnZScpKSA9PSAtMSkge1xuICAgICAgICAgICAgICAgICAgICAkKGUuZWxlbWVudCkuYWRkQ2xhc3MoJ2t0LWF2YXRhci0tY2hhbmdlZCcpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgcmV0dXJuIHtcbiAgICAgICAgLy8gcHVibGljIGZ1bmN0aW9uc1xuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIGluaXQoKTtcbiAgICAgICAgfSxcbiAgICAgICAgYXZhdGFyOiBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIHJldHVybiBhdmF0YXI7XG4gICAgICAgIH1cbiAgICB9O1xufSgpO1xuXG5LVFV0aWwucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgS1RBdmF0YXJTaW5nbGUuaW5pdCgpO1xufSk7XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/ktavatarsingle.js\n");

/***/ }),

/***/ 160:
/*!*************************************************************!*\
  !*** multi ./resources/metronic/js/pages/ktavatarsingle.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/fabioferreira/Dev/Valet Websites/laravel-starter/resources/metronic/js/pages/ktavatarsingle.js */"./resources/metronic/js/pages/ktavatarsingle.js");


/***/ })

/******/ });