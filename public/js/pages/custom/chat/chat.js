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
/******/ 	return __webpack_require__(__webpack_require__.s = 97);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/custom/chat/chat.js":
/*!*********************************************************!*\
  !*** ./resources/metronic/js/pages/custom/chat/chat.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval(" // Class definition\n\nvar KTAppChat = function () {\n  var _chatAsideEl;\n\n  var _chatAsideOffcanvasObj;\n\n  var _chatContentEl; // Private functions\n\n\n  var _initAside = function _initAside() {\n    // Mobile offcanvas for mobile mode\n    _chatAsideOffcanvasObj = new KTOffcanvas(_chatAsideEl, {\n      overlay: true,\n      baseClass: 'offcanvas-mobile',\n      //closeBy: 'kt_chat_aside_close',\n      toggleBy: 'kt_app_chat_toggle'\n    }); // User listing\n\n    var cardScrollEl = KTUtil.find(_chatAsideEl, '.scroll');\n    var cardBodyEl = KTUtil.find(_chatAsideEl, '.card-body');\n    var searchEl = KTUtil.find(_chatAsideEl, '.input-group');\n\n    if (cardScrollEl) {\n      // Initialize perfect scrollbar(see:  https://github.com/utatti/perfect-scrollbar)\n      KTUtil.scrollInit(cardScrollEl, {\n        mobileNativeScroll: true,\n        // Enable native scroll for mobile\n        desktopNativeScroll: false,\n        // Disable native scroll and use custom scroll for desktop\n        resetHeightOnDestroy: true,\n        // Reset css height on scroll feature destroyed\n        handleWindowResize: true,\n        // Recalculate hight on window resize\n        rememberPosition: true,\n        // Remember scroll position in cookie\n        height: function height() {\n          // Calculate height\n          var height;\n\n          if (KTUtil.isBreakpointUp('lg')) {\n            height = KTLayoutContent.getHeight();\n          } else {\n            height = KTUtil.getViewPort().height;\n          }\n\n          if (_chatAsideEl) {\n            height = height - parseInt(KTUtil.css(_chatAsideEl, 'margin-top')) - parseInt(KTUtil.css(_chatAsideEl, 'margin-bottom'));\n            height = height - parseInt(KTUtil.css(_chatAsideEl, 'padding-top')) - parseInt(KTUtil.css(_chatAsideEl, 'padding-bottom'));\n          }\n\n          if (cardScrollEl) {\n            height = height - parseInt(KTUtil.css(cardScrollEl, 'margin-top')) - parseInt(KTUtil.css(cardScrollEl, 'margin-bottom'));\n          }\n\n          if (cardBodyEl) {\n            height = height - parseInt(KTUtil.css(cardBodyEl, 'padding-top')) - parseInt(KTUtil.css(cardBodyEl, 'padding-bottom'));\n          }\n\n          if (searchEl) {\n            height = height - parseInt(KTUtil.css(searchEl, 'height'));\n            height = height - parseInt(KTUtil.css(searchEl, 'margin-top')) - parseInt(KTUtil.css(searchEl, 'margin-bottom'));\n          } // Remove additional space\n\n\n          height = height - 2;\n          return height;\n        }\n      });\n    }\n  };\n\n  return {\n    // Public functions\n    init: function init() {\n      // Elements\n      _chatAsideEl = KTUtil.getById('kt_chat_aside');\n      _chatContentEl = KTUtil.getById('kt_chat_content'); // Init aside and user list\n\n      _initAside(); // Init inline chat example\n\n\n      KTLayoutChat.setup(KTUtil.getById('kt_chat_content')); // Trigger click to show popup modal chat on page load\n\n      if (KTUtil.getById('kt_app_chat_toggle')) {\n        setTimeout(function () {\n          KTUtil.getById('kt_app_chat_toggle').click();\n        }, 1000);\n      }\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTAppChat.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3VzdG9tL2NoYXQvY2hhdC5qcz8xY2IyIl0sIm5hbWVzIjpbIktUQXBwQ2hhdCIsIl9jaGF0QXNpZGVFbCIsIl9jaGF0QXNpZGVPZmZjYW52YXNPYmoiLCJfY2hhdENvbnRlbnRFbCIsIl9pbml0QXNpZGUiLCJLVE9mZmNhbnZhcyIsIm92ZXJsYXkiLCJiYXNlQ2xhc3MiLCJ0b2dnbGVCeSIsImNhcmRTY3JvbGxFbCIsIktUVXRpbCIsImZpbmQiLCJjYXJkQm9keUVsIiwic2VhcmNoRWwiLCJzY3JvbGxJbml0IiwibW9iaWxlTmF0aXZlU2Nyb2xsIiwiZGVza3RvcE5hdGl2ZVNjcm9sbCIsInJlc2V0SGVpZ2h0T25EZXN0cm95IiwiaGFuZGxlV2luZG93UmVzaXplIiwicmVtZW1iZXJQb3NpdGlvbiIsImhlaWdodCIsImlzQnJlYWtwb2ludFVwIiwiS1RMYXlvdXRDb250ZW50IiwiZ2V0SGVpZ2h0IiwiZ2V0Vmlld1BvcnQiLCJwYXJzZUludCIsImNzcyIsImluaXQiLCJnZXRCeUlkIiwiS1RMYXlvdXRDaGF0Iiwic2V0dXAiLCJzZXRUaW1lb3V0IiwiY2xpY2siLCJqUXVlcnkiLCJkb2N1bWVudCIsInJlYWR5Il0sIm1hcHBpbmdzIjoiQ0FFQTs7QUFDQSxJQUFJQSxTQUFTLEdBQUcsWUFBWTtBQUMzQixNQUFJQyxZQUFKOztBQUNBLE1BQUlDLHNCQUFKOztBQUNBLE1BQUlDLGNBQUosQ0FIMkIsQ0FLM0I7OztBQUNBLE1BQUlDLFVBQVUsR0FBRyxTQUFiQSxVQUFhLEdBQVk7QUFDNUI7QUFDQUYsMEJBQXNCLEdBQUcsSUFBSUcsV0FBSixDQUFnQkosWUFBaEIsRUFBOEI7QUFDdERLLGFBQU8sRUFBRSxJQUQ2QztBQUU3Q0MsZUFBUyxFQUFFLGtCQUZrQztBQUc3QztBQUNBQyxjQUFRLEVBQUU7QUFKbUMsS0FBOUIsQ0FBekIsQ0FGNEIsQ0FTNUI7O0FBQ0EsUUFBSUMsWUFBWSxH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QVAsQ0FBZSxlQUFmLENBQWY7QUFDQXpCLG9CQUFjLEdBQUdPLE1BQU0sQ0FBQ2tCLE9BQVAsQ0FBZSxpQkFBZixDQUFqQixDQUhnQixDQUtoQjs7QUFDQXhCLGdCQUFVLEdBTk0sQ0FRaEI7OztBQUNBeUIsa0JBQVksQ0FBQ0MsS0FBYixDQUFtQnBCLE1BQU0sQ0FBQ2tCLE9BQVAsQ0FBZSxpQkFBZixDQUFuQixFQVRnQixDQVdoQjs7QUFDQSxVQUFJbEIsTUFBTSxDQUFDa0IsT0FBUCxDQUFlLG9CQUFmLENBQUosRUFBMEM7QUFDekNHLGtCQUFVLENBQUMsWUFBVztBQUNyQnJCLGdCQUFNLENBQUNrQixPQUFQLENBQWUsb0JBQWYsRUFBcUNJLEtBQXJDO0FBQ0EsU0FGUyxFQUVQLElBRk8sQ0FBVjtBQUdBO0FBQ0Q7QUFuQkssR0FBUDtBQXFCQSxDQXJGZSxFQUFoQjs7QUF1RkFDLE1BQU0sQ0FBQ0MsUUFBRCxDQUFOLENBQWlCQyxLQUFqQixDQUF1QixZQUFXO0FBQ2pDbkMsV0FBUyxDQUFDMkIsSUFBVjtBQUNBLENBRkQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3VzdG9tL2NoYXQvY2hhdC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xuXG4vLyBDbGFzcyBkZWZpbml0aW9uXG52YXIgS1RBcHBDaGF0ID0gZnVuY3Rpb24gKCkge1xuXHR2YXIgX2NoYXRBc2lkZUVsO1xuXHR2YXIgX2NoYXRBc2lkZU9mZmNhbnZhc09iajtcblx0dmFyIF9jaGF0Q29udGVudEVsO1xuXG5cdC8vIFByaXZhdGUgZnVuY3Rpb25zXG5cdHZhciBfaW5pdEFzaWRlID0gZnVuY3Rpb24gKCkge1xuXHRcdC8vIE1vYmlsZSBvZmZjYW52YXMgZm9yIG1vYmlsZSBtb2RlXG5cdFx0X2NoYXRBc2lkZU9mZmNhbnZhc09iaiA9IG5ldyBLVE9mZmNhbnZhcyhfY2hhdEFzaWRlRWwsIHtcblx0XHRcdG92ZXJsYXk6IHRydWUsXG4gICAgICAgICAgICBiYXNlQ2xhc3M6ICdvZmZjYW52YXMtbW9iaWxlJyxcbiAgICAgICAgICAgIC8vY2xvc2VCeTogJ2t0X2NoYXRfYXNpZGVfY2xvc2UnLFxuICAgICAgICAgICAgdG9nZ2xlQnk6ICdrdF9hcHBfY2hhdF90b2dnbGUnXG4gICAgICAgIH0pO1xuXG5cdFx0Ly8gVXNlciBsaXN0aW5nXG5cdFx0dmFyIGNhcmRTY3JvbGxFbCA9IEtUVXRpbC5maW5kKF9jaGF0QXNpZGVFbCwgJy5zY3JvbGwnKTtcblx0XHR2YXIgY2FyZEJvZHlFbCA9IEtUVXRpbC5maW5kKF9jaGF0QXNpZGVFbCwgJy5jYXJkLWJvZHknKTtcblx0XHR2YXIgc2VhcmNoRWwgPSBLVFV0aWwuZmluZChfY2hhdEFzaWRlRWwsICcuaW5wdXQtZ3JvdXAnKTtcblxuXHRcdGlmIChjYXJkU2Nyb2xsRWwpIHtcblx0XHRcdC8vIEluaXRpYWxpemUgcGVyZmVjdCBzY3JvbGxiYXIoc2VlOiAgaHR0cHM6Ly9naXRodWIuY29tL3V0YXR0aS9wZXJmZWN0LXNjcm9sbGJhcilcblx0XHRcdEtUVXRpbC5zY3JvbGxJbml0KGNhcmRTY3JvbGxFbCwge1xuXHRcdFx0XHRtb2JpbGVOYXRpdmVTY3JvbGw6IHRydWUsICAvLyBFbmFibGUgbmF0aXZlIHNjcm9sbCBmb3IgbW9iaWxlXG5cdFx0XHRcdGRlc2t0b3BOYXRpdmVTY3JvbGw6IGZhbHNlLCAvLyBEaXNhYmxlIG5hdGl2ZSBzY3JvbGwgYW5kIHVzZSBjdXN0b20gc2Nyb2xsIGZvciBkZXNrdG9wXG5cdFx0XHRcdHJlc2V0SGVpZ2h0T25EZXN0cm95OiB0cnVlLCAgLy8gUmVzZXQgY3NzIGhlaWdodCBvbiBzY3JvbGwgZmVhdHVyZSBkZXN0cm95ZWRcblx0XHRcdFx0aGFuZGxlV2luZG93UmVzaXplOiB0cnVlLCAvLyBSZWNhbGN1bGF0ZSBoaWdodCBvbiB3aW5kb3cgcmVzaXplXG5cdFx0XHRcdHJlbWVtYmVyUG9zaXRpb246IHRydWUsIC8vIFJlbWVtYmVyIHNjcm9sbCBwb3NpdGlvbiBpbiBjb29raWVcblx0XHRcdFx0aGVpZ2h0OiBmdW5jdGlvbigpIHsgIC8vIENhbGN1bGF0ZSBoZWlnaHRcblx0XHRcdFx0XHR2YXIgaGVpZ2h0O1xuXG5cdFx0XHRcdFx0aWYgKEtUVXRpbC5pc0JyZWFrcG9pbnRVcCgnbGcnKSkge1xuXHRcdFx0XHRcdFx0aGVpZ2h0ID0gS1RMYXlvdXRDb250ZW50LmdldEhlaWdodCgpO1xuXHRcdFx0XHRcdH0gZWxzZSB7XG5cdFx0XHRcdFx0XHRoZWlnaHQgPSBLVFV0aWwuZ2V0Vmlld1BvcnQoKS5oZWlnaHQ7XG5cdFx0XHRcdFx0fVxuXG5cdFx0XHRcdFx0aWYgKF9jaGF0QXNpZGVFbCkge1xuXHRcdFx0XHRcdFx0aGVpZ2h0ID0gaGVpZ2h0IC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhfY2hhdEFzaWRlRWwsICdtYXJnaW4tdG9wJykpIC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhfY2hhdEFzaWRlRWwsICdtYXJnaW4tYm90dG9tJykpO1xuXHRcdFx0XHRcdFx0aGVpZ2h0ID0gaGVpZ2h0IC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhfY2hhdEFzaWRlRWwsICdwYWRkaW5nLXRvcCcpKSAtIHBhcnNlSW50KEtUVXRpbC5jc3MoX2NoYXRBc2lkZUVsLCAncGFkZGluZy1ib3R0b20nKSk7XG5cdFx0XHRcdFx0fVxuXG5cdFx0XHRcdFx0aWYgKGNhcmRTY3JvbGxFbCkge1xuXHRcdFx0XHRcdFx0aGVpZ2h0ID0gaGVpZ2h0IC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhjYXJkU2Nyb2xsRWwsICdtYXJnaW4tdG9wJykpIC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhjYXJkU2Nyb2xsRWwsICdtYXJnaW4tYm90dG9tJykpO1xuXHRcdFx0XHRcdH1cblxuXHRcdFx0XHRcdGlmIChjYXJkQm9keUVsKSB7XG5cdFx0XHRcdFx0XHRoZWlnaHQgPSBoZWlnaHQgLSBwYXJzZUludChLVFV0aWwuY3NzKGNhcmRCb2R5RWwsICdwYWRkaW5nLXRvcCcpKSAtIHBhcnNlSW50KEtUVXRpbC5jc3MoY2FyZEJvZHlFbCwgJ3BhZGRpbmctYm90dG9tJykpO1xuXHRcdFx0XHRcdH1cblxuXHRcdFx0XHRcdGlmIChzZWFyY2hFbCkge1xuXHRcdFx0XHRcdFx0aGVpZ2h0ID0gaGVpZ2h0IC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhzZWFyY2hFbCwgJ2hlaWdodCcpKTtcblx0XHRcdFx0XHRcdGhlaWdodCA9IGhlaWdodCAtIHBhcnNlSW50KEtUVXRpbC5jc3Moc2VhcmNoRWwsICdtYXJnaW4tdG9wJykpIC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhzZWFyY2hFbCwgJ21hcmdpbi1ib3R0b20nKSk7XG5cdFx0XHRcdFx0fVxuXG5cdFx0XHRcdFx0Ly8gUmVtb3ZlIGFkZGl0aW9uYWwgc3BhY2Vcblx0XHRcdFx0XHRoZWlnaHQgPSBoZWlnaHQgLSAyO1xuXG5cdFx0XHRcdFx0cmV0dXJuIGhlaWdodDtcblx0XHRcdFx0fVxuXHRcdFx0fSk7XG5cdFx0fVxuXHR9XG5cblx0cmV0dXJuIHtcblx0XHQvLyBQdWJsaWMgZnVuY3Rpb25zXG5cdFx0aW5pdDogZnVuY3Rpb24oKSB7XG5cdFx0XHQvLyBFbGVtZW50c1xuXHRcdFx0X2NoYXRBc2lkZUVsID0gS1RVdGlsLmdldEJ5SWQoJ2t0X2NoYXRfYXNpZGUnKTtcblx0XHRcdF9jaGF0Q29udGVudEVsID0gS1RVdGlsLmdldEJ5SWQoJ2t0X2NoYXRfY29udGVudCcpO1xuXG5cdFx0XHQvLyBJbml0IGFzaWRlIGFuZCB1c2VyIGxpc3Rcblx0XHRcdF9pbml0QXNpZGUoKTtcblxuXHRcdFx0Ly8gSW5pdCBpbmxpbmUgY2hhdCBleGFtcGxlXG5cdFx0XHRLVExheW91dENoYXQuc2V0dXAoS1RVdGlsLmdldEJ5SWQoJ2t0X2NoYXRfY29udGVudCcpKTtcblxuXHRcdFx0Ly8gVHJpZ2dlciBjbGljayB0byBzaG93IHBvcHVwIG1vZGFsIGNoYXQgb24gcGFnZSBsb2FkXG5cdFx0XHRpZiAoS1RVdGlsLmdldEJ5SWQoJ2t0X2FwcF9jaGF0X3RvZ2dsZScpKSB7XG5cdFx0XHRcdHNldFRpbWVvdXQoZnVuY3Rpb24oKSB7XG5cdFx0XHRcdFx0S1RVdGlsLmdldEJ5SWQoJ2t0X2FwcF9jaGF0X3RvZ2dsZScpLmNsaWNrKCk7XG5cdFx0XHRcdH0sIDEwMDApO1xuXHRcdFx0fVxuXHRcdH1cblx0fTtcbn0oKTtcblxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcblx0S1RBcHBDaGF0LmluaXQoKTtcbn0pO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/custom/chat/chat.js\n");

/***/ }),

/***/ 97:
/*!***************************************************************!*\
  !*** multi ./resources/metronic/js/pages/custom/chat/chat.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/laravel/concursos-publicos/resources/metronic/js/pages/custom/chat/chat.js */"./resources/metronic/js/pages/custom/chat/chat.js");


/***/ })

/******/ });