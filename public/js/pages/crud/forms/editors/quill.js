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
/******/ 	return __webpack_require__(__webpack_require__.s = 55);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/editors/quill.js":
/*!*****************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/editors/quill.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// Class definition\nvar KTQuilDemos = function () {\n  // Private functions\n  var demo1 = function demo1() {\n    var quill = new Quill('#kt_quil_1', {\n      modules: {\n        toolbar: [[{\n          header: [1, 2, false]\n        }], ['bold', 'italic', 'underline'], ['image', 'code-block']]\n      },\n      placeholder: 'Type your text here...',\n      theme: 'snow' // or 'bubble'\n\n    });\n  };\n\n  var demo2 = function demo2() {\n    var Delta = Quill[\"import\"]('delta');\n    var quill = new Quill('#kt_quil_2', {\n      modules: {\n        toolbar: true\n      },\n      placeholder: 'Type your text here...',\n      theme: 'snow'\n    }); // Store accumulated changes\n\n    var change = new Delta();\n    quill.on('text-change', function (delta) {\n      change = change.compose(delta);\n    }); // Save periodically\n\n    setInterval(function () {\n      if (change.length() > 0) {\n        console.log('Saving changes', change);\n        /*\n        Send partial changes\n        $.post('/your-endpoint', {\n          partial: JSON.stringify(change)\n        });\n         Send entire document\n        $.post('/your-endpoint', {\n          doc: JSON.stringify(quill.getContents())\n        });\n        */\n\n        change = new Delta();\n      }\n    }, 5 * 1000); // Check for unsaved data\n\n    window.onbeforeunload = function () {\n      if (change.length() > 0) {\n        return 'There are unsaved changes. Are you sure you want to leave?';\n      }\n    };\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      demo1();\n      demo2();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTQuilDemos.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9mb3Jtcy9lZGl0b3JzL3F1aWxsLmpzPzE5NTEiXSwibmFtZXMiOlsiS1RRdWlsRGVtb3MiLCJkZW1vMSIsInF1aWxsIiwiUXVpbGwiLCJtb2R1bGVzIiwidG9vbGJhciIsImhlYWRlciIsInBsYWNlaG9sZGVyIiwidGhlbWUiLCJkZW1vMiIsIkRlbHRhIiwiY2hhbmdlIiwib24iLCJkZWx0YSIsImNvbXBvc2UiLCJzZXRJbnRlcnZhbCIsImxlbmd0aCIsImNvbnNvbGUiLCJsb2ciLCJ3aW5kb3ciLCJvbmJlZm9yZXVubG9hZCIsImluaXQiLCJqUXVlcnkiLCJkb2N1bWVudCIsInJlYWR5Il0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBLElBQUlBLFdBQVcsR0FBRyxZQUFXO0FBRXpCO0FBQ0EsTUFBSUMsS0FBSyxHQUFHLFNBQVJBLEtBQVEsR0FBVztBQUNuQixRQUFJQyxLQUFLLEdBQUcsSUFBSUMsS0FBSixDQUFVLFlBQVYsRUFBd0I7QUFDaENDLGFBQU8sRUFBRTtBQUNMQyxlQUFPLEVBQUUsQ0FDTCxDQUFDO0FBQ0dDLGdCQUFNLEVBQUUsQ0FBQyxDQUFELEVBQUksQ0FBSixFQUFPLEtBQVA7QUFEWCxTQUFELENBREssRUFJTCxDQUFDLE1BQUQsRUFBUyxRQUFULEVBQW1CLFdBQW5CLENBSkssRUFLTCxDQUFDLE9BQUQsRUFBVSxZQUFWLENBTEs7QUFESixPQUR1QjtBQVVoQ0MsaUJBQVcsRUFBRSx3QkFWbUI7QUFXaENDLFdBQUssRUFBRSxNQVh5QixDQVdsQjs7QUFYa0IsS0FBeEIsQ0FBWjtBQWFILEdBZEQ7O0FBZ0JBLE1BQUlDLEtBQUssR0FBRyxTQUFSQSxLQUFRLEdBQVc7QUFDbkIsUUFBSUMsS0FBSyxHQUFHUCxLQUFLLFVBQUwsQ0FBYSxPQUFiLENBQVo7QUFDQSxRQUFJRCxLQUFLLEdBQUcsSUFBSUMsS0FBSixDQUFVLFlBQVYsRUFBd0I7QUFDaENDLGFBQU8sRUFBRTtBQUNMQyxlQUFPLEVBQUU7QUFESixPQUR1QjtBQUloQ0UsaUJBQVcsRUFBRSx3QkFKbUI7QUFLaENDLFdBQUssRUFBRTtBQUx5QixLQUF4QixDQUFaLENBRm1CLENBVW5COztBQUNBLFFBQUlHLE1BQU0sR0FBRyxJQUFJRCxLQUFKLEVBQWI7QUFDQVIsU0FBSyxDQUFDVSxFQUFOLENBQVMsYUFBVCxFQUF3QixVQUFTQyxLQUFULEVBQWdCO0FBQ3BDRixZQUFNLEdBQUdBLE1BQU0sQ0FBQ0csT0FBUCxDQUFlRCxLQUFmLENBQVQ7QUFDSCxLQUZELEVBWm1CLENBZ0JuQjs7QUFDQUUsZUFBVyxDQUFDLFlBQVc7QUFDbkIsVUFBSUosTUFBTSxDQUFDSyxNQUFQLEtBQWtCLENBQXRCLEVBQXlCO0FBQ3JCQyxlQUFPLENBQUNDLEdBQVIsQ0FBWSxnQkFBWixFQUE4QlAsTUFBOUI7QUFDQTtBQUNoQjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRWdCQSxjQUFNLEdBQUcsSUFBSUQsS0FBSixFQUFUO0FBQ0g7QUFDSixLQWhCVSxFQWdCUixJQUFJLElBaEJJLENBQVgsQ0FqQm1CLENBbUNuQjs7QUFDQVMsVUFBTSxDQUFDQyxjQUFQLEdBQXdCLFlBQVc7QUFDL0IsVUFBSVQsTUFBTSxDQUFDSyxNQUFQLEtBQWtCLENBQXRCLEVBQXlCO0FBQ3JCLGVBQU8sNERBQVA7QUFDSDtBQUNKLEtBSkQ7QUFLSCxHQXpDRDs7QUEyQ0EsU0FBTztBQUNIO0FBQ0FLLFFBQUksRUFBRSxnQkFBVztBQUNicEIsV0FBSztBQUNMUSxXQUFLO0FBQ1I7QUFMRSxHQUFQO0FBT0gsQ0FyRWlCLEVBQWxCOztBQXVFQWEsTUFBTSxDQUFDQyxRQUFELENBQU4sQ0FBaUJDLEtBQWpCLENBQXVCLFlBQVc7QUFDOUJ4QixhQUFXLENBQUNxQixJQUFaO0FBQ0gsQ0FGRCIsImZpbGUiOiIuL3Jlc291cmNlcy9tZXRyb25pYy9qcy9wYWdlcy9jcnVkL2Zvcm1zL2VkaXRvcnMvcXVpbGwuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBDbGFzcyBkZWZpbml0aW9uXG52YXIgS1RRdWlsRGVtb3MgPSBmdW5jdGlvbigpIHtcblxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXG4gICAgdmFyIGRlbW8xID0gZnVuY3Rpb24oKSB7XG4gICAgICAgIHZhciBxdWlsbCA9IG5ldyBRdWlsbCgnI2t0X3F1aWxfMScsIHtcbiAgICAgICAgICAgIG1vZHVsZXM6IHtcbiAgICAgICAgICAgICAgICB0b29sYmFyOiBbXG4gICAgICAgICAgICAgICAgICAgIFt7XG4gICAgICAgICAgICAgICAgICAgICAgICBoZWFkZXI6IFsxLCAyLCBmYWxzZV1cbiAgICAgICAgICAgICAgICAgICAgfV0sXG4gICAgICAgICAgICAgICAgICAgIFsnYm9sZCcsICdpdGFsaWMnLCAndW5kZXJsaW5lJ10sXG4gICAgICAgICAgICAgICAgICAgIFsnaW1hZ2UnLCAnY29kZS1ibG9jayddXG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHBsYWNlaG9sZGVyOiAnVHlwZSB5b3VyIHRleHQgaGVyZS4uLicsXG4gICAgICAgICAgICB0aGVtZTogJ3Nub3cnIC8vIG9yICdidWJibGUnXG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIHZhciBkZW1vMiA9IGZ1bmN0aW9uKCkge1xuICAgICAgICB2YXIgRGVsdGEgPSBRdWlsbC5pbXBvcnQoJ2RlbHRhJyk7XG4gICAgICAgIHZhciBxdWlsbCA9IG5ldyBRdWlsbCgnI2t0X3F1aWxfMicsIHtcbiAgICAgICAgICAgIG1vZHVsZXM6IHtcbiAgICAgICAgICAgICAgICB0b29sYmFyOiB0cnVlXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgcGxhY2Vob2xkZXI6ICdUeXBlIHlvdXIgdGV4dCBoZXJlLi4uJyxcbiAgICAgICAgICAgIHRoZW1lOiAnc25vdydcbiAgICAgICAgfSk7XG5cbiAgICAgICAgLy8gU3RvcmUgYWNjdW11bGF0ZWQgY2hhbmdlc1xuICAgICAgICB2YXIgY2hhbmdlID0gbmV3IERlbHRhKCk7XG4gICAgICAgIHF1aWxsLm9uKCd0ZXh0LWNoYW5nZScsIGZ1bmN0aW9uKGRlbHRhKSB7XG4gICAgICAgICAgICBjaGFuZ2UgPSBjaGFuZ2UuY29tcG9zZShkZWx0YSk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIFNhdmUgcGVyaW9kaWNhbGx5XG4gICAgICAgIHNldEludGVydmFsKGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgaWYgKGNoYW5nZS5sZW5ndGgoKSA+IDApIHtcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygnU2F2aW5nIGNoYW5nZXMnLCBjaGFuZ2UpO1xuICAgICAgICAgICAgICAgIC8qXG4gICAgICAgICAgICAgICAgU2VuZCBwYXJ0aWFsIGNoYW5nZXNcbiAgICAgICAgICAgICAgICAkLnBvc3QoJy95b3VyLWVuZHBvaW50Jywge1xuICAgICAgICAgICAgICAgICAgcGFydGlhbDogSlNPTi5zdHJpbmdpZnkoY2hhbmdlKVxuICAgICAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAgICAgU2VuZCBlbnRpcmUgZG9jdW1lbnRcbiAgICAgICAgICAgICAgICAkLnBvc3QoJy95b3VyLWVuZHBvaW50Jywge1xuICAgICAgICAgICAgICAgICAgZG9jOiBKU09OLnN0cmluZ2lmeShxdWlsbC5nZXRDb250ZW50cygpKVxuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICovXG4gICAgICAgICAgICAgICAgY2hhbmdlID0gbmV3IERlbHRhKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0sIDUgKiAxMDAwKTtcblxuICAgICAgICAvLyBDaGVjayBmb3IgdW5zYXZlZCBkYXRhXG4gICAgICAgIHdpbmRvdy5vbmJlZm9yZXVubG9hZCA9IGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgaWYgKGNoYW5nZS5sZW5ndGgoKSA+IDApIHtcbiAgICAgICAgICAgICAgICByZXR1cm4gJ1RoZXJlIGFyZSB1bnNhdmVkIGNoYW5nZXMuIEFyZSB5b3Ugc3VyZSB5b3Ugd2FudCB0byBsZWF2ZT8nO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG4gICAgfVxuXG4gICAgcmV0dXJuIHtcbiAgICAgICAgLy8gcHVibGljIGZ1bmN0aW9uc1xuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIGRlbW8xKCk7XG4gICAgICAgICAgICBkZW1vMigpO1xuICAgICAgICB9XG4gICAgfTtcbn0oKTtcblxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcbiAgICBLVFF1aWxEZW1vcy5pbml0KCk7XG59KTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/crud/forms/editors/quill.js\n");

/***/ }),

/***/ 55:
/*!***********************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/editors/quill.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/laravel/concursos-publicos/resources/metronic/js/pages/crud/forms/editors/quill.js */"./resources/metronic/js/pages/crud/forms/editors/quill.js");


/***/ })

/******/ });