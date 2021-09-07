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
/******/ 	return __webpack_require__(__webpack_require__.s = 117);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/custom/todo/todo.js":
/*!*********************************************************!*\
  !*** ./resources/metronic/js/pages/custom/todo/todo.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval(" // Class definition\n\nvar KTAppTodo = function () {\n  // Private properties\n  var _asideEl;\n\n  var _listEl;\n\n  var _viewEl;\n\n  var _replyEl;\n\n  var _asideOffcanvas; // Private methods\n\n\n  var _initEditor = function _initEditor(form, editor) {\n    // init editor\n    var options = {\n      modules: {\n        toolbar: {}\n      },\n      placeholder: 'Type message...',\n      theme: 'snow'\n    };\n\n    if (!KTUtil.getById(editor)) {\n      return;\n    } // Init editor\n\n\n    var editor = new Quill('#' + editor, options); // Customize editor\n\n    var toolbar = KTUtil.find(form, '.ql-toolbar');\n    var editor = KTUtil.find(form, '.ql-editor');\n\n    if (toolbar) {\n      KTUtil.addClass(toolbar, 'px-5 border-top-0 border-left-0 border-right-0');\n    }\n\n    if (editor) {\n      KTUtil.addClass(editor, 'px-8');\n    }\n  };\n\n  var _initAttachments = function _initAttachments(elemId) {\n    if (!KTUtil.getById(elemId)) {\n      return;\n    }\n\n    var id = \"#\" + elemId;\n    var previewNode = $(id + \" .dropzone-item\");\n    previewNode.id = \"\";\n    var previewTemplate = previewNode.parent('.dropzone-items').html();\n    previewNode.remove();\n    var myDropzone = new Dropzone(id, {\n      // Make the whole body a dropzone\n      url: \"https://keenthemes.com/scripts/void.php\",\n      // Set the url for your upload script location\n      parallelUploads: 20,\n      maxFilesize: 1,\n      // Max filesize in MB\n      previewTemplate: previewTemplate,\n      previewsContainer: id + \" .dropzone-items\",\n      // Define the container to display the previews\n      clickable: id + \"_select\" // Define the element that should be used as click trigger to select files.\n\n    });\n    myDropzone.on(\"addedfile\", function (file) {\n      // Hookup the start button\n      $(document).find(id + ' .dropzone-item').css('display', '');\n    }); // Update the total progress bar\n\n    myDropzone.on(\"totaluploadprogress\", function (progress) {\n      document.querySelector(id + \" .progress-bar\").style.width = progress + \"%\";\n    });\n    myDropzone.on(\"sending\", function (file) {\n      // Show the total progress bar when upload starts\n      document.querySelector(id + \" .progress-bar\").style.opacity = \"1\";\n    }); // Hide the total progress bar when nothing's uploading anymore\n\n    myDropzone.on(\"complete\", function (progress) {\n      var thisProgressBar = id + \" .dz-complete\";\n      setTimeout(function () {\n        $(thisProgressBar + \" .progress-bar, \" + thisProgressBar + \" .progress\").css('opacity', '0');\n      }, 300);\n    });\n  }; // Public methods\n\n\n  return {\n    // Public functions\n    init: function init() {\n      // Init variables\n      _asideEl = KTUtil.getById('kt_todo_aside');\n      _listEl = KTUtil.getById('kt_todo_list');\n      _viewEl = KTUtil.getById('kt_todo_view');\n      _replyEl = KTUtil.getById('kt_todo_reply'); // Init handlers\n\n      KTAppTodo.initAside();\n      KTAppTodo.initList();\n      KTAppTodo.initView();\n      KTAppTodo.initReply();\n    },\n    initAside: function initAside() {\n      // Mobile offcanvas for mobile mode\n      _asideOffcanvas = new KTOffcanvas(_asideEl, {\n        overlay: true,\n        baseClass: 'offcanvas-mobile',\n        //closeBy: 'kt_todo_aside_close',\n        toggleBy: 'kt_subheader_mobile_toggle'\n      }); // View list\n\n      KTUtil.on(_asideEl, '.list-item[data-action=\"list\"]', 'click', function (e) {\n        var type = KTUtil.attr(this, 'data-type');\n        var listItemsEl = KTUtil.find(_listEl, '.kt-inbox__items');\n        var navItemEl = this.closest('.kt-nav__item');\n        var navItemActiveEl = KTUtil.find(_asideEl, '.kt-nav__item.kt-nav__item--active'); // demo loading\n\n        var loading = new KTDialog({\n          'type': 'loader',\n          'placement': 'top center',\n          'message': 'Loading ...'\n        });\n        loading.show();\n        setTimeout(function () {\n          loading.hide();\n          KTUtil.css(_listEl, 'display', 'flex'); // show list\n\n          KTUtil.css(_viewEl, 'display', 'none'); // hide view\n\n          KTUtil.addClass(navItemEl, 'kt-nav__item--active');\n          KTUtil.removeClass(navItemActiveEl, 'kt-nav__item--active');\n          KTUtil.attr(listItemsEl, 'data-type', type);\n        }, 600);\n      });\n    },\n    initList: function initList() {\n      // Group selection\n      KTUtil.on(_listEl, '[data-inbox=\"group-select\"] input', 'click', function () {\n        var messages = KTUtil.findAll(_listEl, '[data-inbox=\"message\"]');\n\n        for (var i = 0, j = messages.length; i < j; i++) {\n          var message = messages[i];\n          var checkbox = KTUtil.find(message, '.checkbox input');\n          checkbox.checked = this.checked;\n\n          if (this.checked) {\n            KTUtil.addClass(message, 'active');\n          } else {\n            KTUtil.removeClass(message, 'active');\n          }\n        }\n      }); // Individual selection\n\n      KTUtil.on(_listEl, '[data-inbox=\"message\"] [data-inbox=\"actions\"] .checkbox input', 'click', function () {\n        var item = this.closest('[data-inbox=\"message\"]');\n\n        if (item && this.checked) {\n          KTUtil.addClass(item, 'active');\n        } else {\n          KTUtil.removeClass(item, 'active');\n        }\n      });\n    },\n    initView: function initView() {\n      // Back to listing\n      KTUtil.on(_viewEl, '[data-inbox=\"back\"]', 'click', function () {\n        // demo loading\n        var loading = new KTDialog({\n          'type': 'loader',\n          'placement': 'top center',\n          'message': 'Loading ...'\n        });\n        loading.show();\n        setTimeout(function () {\n          loading.hide();\n          KTUtil.addClass(_listEl, 'd-block');\n          KTUtil.removeClass(_listEl, 'd-none');\n          KTUtil.addClass(_viewEl, 'd-none');\n          KTUtil.removeClass(_viewEl, 'd-block');\n        }, 700);\n      }); // Expand/Collapse reply\n\n      KTUtil.on(_viewEl, '[data-inbox=\"message\"]', 'click', function (e) {\n        var message = this.closest('[data-inbox=\"message\"]');\n        var dropdownToggleEl = KTUtil.find(this, '[data-toggle=\"dropdown\"]');\n        var toolbarEl = KTUtil.find(this, '[data-inbox=\"toolbar\"]'); // skip dropdown toggle click\n\n        if (e.target === dropdownToggleEl || dropdownToggleEl && dropdownToggleEl.contains(e.target) === true) {\n          return false;\n        } // skip group actions click\n\n\n        if (e.target === toolbarEl || toolbarEl && toolbarEl.contains(e.target) === true) {\n          return false;\n        }\n\n        if (KTUtil.hasClass(message, 'toggle-on')) {\n          KTUtil.addClass(message, 'toggle-off');\n          KTUtil.removeClass(message, 'toggle-on');\n        } else {\n          KTUtil.removeClass(message, 'toggle-off');\n          KTUtil.addClass(message, 'toggle-on');\n        }\n      });\n    },\n    initReply: function initReply() {\n      _initEditor(_replyEl, 'kt_todo_reply_editor');\n\n      _initAttachments('kt_todo_reply_attachments');\n    }\n  };\n}(); // Class Initialization\n\n\njQuery(document).ready(function () {\n  KTAppTodo.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3VzdG9tL3RvZG8vdG9kby5qcz83YTUxIl0sIm5hbWVzIjpbIktUQXBwVG9kbyIsIl9hc2lkZUVsIiwiX2xpc3RFbCIsIl92aWV3RWwiLCJfcmVwbHlFbCIsIl9hc2lkZU9mZmNhbnZhcyIsIl9pbml0RWRpdG9yIiwiZm9ybSIsImVkaXRvciIsIm9wdGlvbnMiLCJtb2R1bGVzIiwidG9vbGJhciIsInBsYWNlaG9sZGVyIiwidGhlbWUiLCJLVFV0aWwiLCJnZXRCeUlkIiwiUXVpbGwiLCJmaW5kIiwiYWRkQ2xhc3MiLCJfaW5pdEF0dGFjaG1lbnRzIiwiZWxlbUlkIiwiaWQiLCJwcmV2aWV3Tm9kZSIsIiQiLCJwcmV2aWV3VGVtcGxhdGUiLCJwYXJlbnQiLCJodG1sIiwicmVtb3ZlIiwibXlEcm9wem9uZSIsIkRyb3B6b25lIiwidXJsIiwicGFyYWxsZWxVcGxvYWRzIiwibWF4RmlsZXNpemUiLCJwcmV2aWV3c0NvbnRhaW5lciIsImNsaWNrYWJsZSIsIm9uIiwiZmlsZSIsImRvY3VtZW50IiwiY3NzIiwicHJvZ3Jlc3MiLCJxdWVyeVNlbGVjdG9yIiwic3R5bGUiLCJ3aWR0aCIsIm9wYWNpdHkiLCJ0aGlzUHJvZ3Jlc3NCYXIiLCJzZXRUaW1lb3V0IiwiaW5pdCIsImluaXRBc2lkZSIsImluaXRMaXN0IiwiaW5pdFZpZXciLCJpbml0UmVwbHkiLCJLVE9mZmNhbnZhcyIsIm92ZXJsYXkiLCJiYXNlQ2xhc3MiLCJ0b2dnbGVCeSIsImUiLCJ0eXBlIiwiYXR0ciIsImxpc3RJdGVtc0VsIiwibmF2SXRlbUVsIiwiY2xvc2VzdCIsIm5hdkl0ZW1BY3RpdmVFbCIsImxvYWRpbmciLCJLVERpYWxvZyIsInNob3ciLCJoaWRlIiwicmVtb3ZlQ2xhc3MiLCJtZXNzYWdlcyIsImZpbmRBbGwiLCJpIiwiaiIsImxlbmd0aCIsIm1lc3NhZ2UiLCJjaGVja2JveCIsImNoZWNrZWQiLCJpdGVtIiwiZHJvcGRvd25Ub2dnbGVFbCIsInRvb2xiYXJFbCIsInRhcmdldCIsImNvbnRhaW5zIiwiaGFzQ2xhc3MiLCJqUXVlcnkiLCJyZWFkeSJdLCJtYXBwaW5ncyI6IkNBRUE7O0FBQ0EsSUFBSUEsU0FBUyxHQUFHLFlBQVc7QUFDdkI7QUFDQSxNQUFJQyxRQUFKOztBQUNBLE1BQUlDLE9BQUo7O0FBQ0EsTUFBSUMsT0FBSjs7QUFDQSxNQUFJQyxRQUFKOztBQUNBLE1BQUlDLGVBQUosQ0FOdUIsQ0FRdkI7OztBQUNBLE1BQUlDLFdBQVcsR0FBRyxTQUFkQSxXQUFjLENBQVNDLElBQVQsRUFBZUMsTUFBZixFQUF1QjtBQUNyQztBQUNBLFFBQUlDLE9BQU8sR0FBRztBQUNWQyxhQUFPLEVBQUU7QUFDTEMsZUFBTyxFQUFFO0FBREosT0FEQztBQUlWQyxpQkFBVyxFQUFFLGlCQUpIO0FBS1ZDLFdBQUssRUFBRTtBQUxHLEtBQWQ7O0FBUUEsUUFBSSxDQUFDQyxNQUFNLENBQUNDLE9BQVAsQ0FBZVAsTUFBZixDQUFMLEVBQTZCO0FBQ3pCO0FBQ0gsS0Fab0MsQ0FjckM7OztBQUNBLFFBQUlBLE1BQU0sR0FBRyxJQUFJUSxLQUFKLENBQVUsTUFBTVIsTUFBaEIsRUFBd0JDLE9BQXhCLENBQWIsQ0FmcUMsQ0FpQnJDOztBQUNBLFFBQUlFLE9BQU8sR0FBR0csTUFBTSxDQUFDRyxJQUFQLENBQVlWLElBQVosRUFBa0IsYUFBbEIsQ0FBZDtBQUNBLFFBQUlDLE1BQU0sR0FBR00sTUFBTSxDQUFDRyxJQUFQLENBQVlWLElBQVosRUFBa0IsWUFBbEIsQ0FBYjs7QUFFQSxRQUFJSSxPQUFKLEVBQWE7QUFDVEcsWUFBTSxDQUFDSSxRQUFQLENBQWdCUCxPQUFoQixFQUF5QixnREFBekI7QUFDSDs7QUFFRCxRQUFJSCxNQUFKLEVBQVk7QUFDUk0sWUFBTSxDQUFDSSxRQUFQLENBQWdCVixNQUFoQixFQUF3QixNQUF4QjtBQUNIO0FBQ0osR0E1QkQ7O0FBOEJBLE1BQUlXLGdCQUFnQixHQUFHLFNBQW5CQSxnQkFBbUIsQ0FB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anMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcblxuLy8gQ2xhc3MgZGVmaW5pdGlvblxudmFyIEtUQXBwVG9kbyA9IGZ1bmN0aW9uKCkge1xuICAgIC8vIFByaXZhdGUgcHJvcGVydGllc1xuICAgIHZhciBfYXNpZGVFbDtcbiAgICB2YXIgX2xpc3RFbDtcbiAgICB2YXIgX3ZpZXdFbDtcbiAgICB2YXIgX3JlcGx5RWw7XG4gICAgdmFyIF9hc2lkZU9mZmNhbnZhcztcblxuICAgIC8vIFByaXZhdGUgbWV0aG9kc1xuICAgIHZhciBfaW5pdEVkaXRvciA9IGZ1bmN0aW9uKGZvcm0sIGVkaXRvcikge1xuICAgICAgICAvLyBpbml0IGVkaXRvclxuICAgICAgICB2YXIgb3B0aW9ucyA9IHtcbiAgICAgICAgICAgIG1vZHVsZXM6IHtcbiAgICAgICAgICAgICAgICB0b29sYmFyOiB7fVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHBsYWNlaG9sZGVyOiAnVHlwZSBtZXNzYWdlLi4uJyxcbiAgICAgICAgICAgIHRoZW1lOiAnc25vdydcbiAgICAgICAgfTtcblxuICAgICAgICBpZiAoIUtUVXRpbC5nZXRCeUlkKGVkaXRvcikpIHtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuXG4gICAgICAgIC8vIEluaXQgZWRpdG9yXG4gICAgICAgIHZhciBlZGl0b3IgPSBuZXcgUXVpbGwoJyMnICsgZWRpdG9yLCBvcHRpb25zKTtcblxuICAgICAgICAvLyBDdXN0b21pemUgZWRpdG9yXG4gICAgICAgIHZhciB0b29sYmFyID0gS1RVdGlsLmZpbmQoZm9ybSwgJy5xbC10b29sYmFyJyk7XG4gICAgICAgIHZhciBlZGl0b3IgPSBLVFV0aWwuZmluZChmb3JtLCAnLnFsLWVkaXRvcicpO1xuXG4gICAgICAgIGlmICh0b29sYmFyKSB7XG4gICAgICAgICAgICBLVFV0aWwuYWRkQ2xhc3ModG9vbGJhciwgJ3B4LTUgYm9yZGVyLXRvcC0wIGJvcmRlci1sZWZ0LTAgYm9yZGVyLXJpZ2h0LTAnKTtcbiAgICAgICAgfVxuXG4gICAgICAgIGlmIChlZGl0b3IpIHtcbiAgICAgICAgICAgIEtUVXRpbC5hZGRDbGFzcyhlZGl0b3IsICdweC04Jyk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICB2YXIgX2luaXRBdHRhY2htZW50cyA9IGZ1bmN0aW9uKGVsZW1JZCkge1xuICAgICAgICBpZiAoIUtUVXRpbC5nZXRCeUlkKGVsZW1JZCkpIHtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuXG4gICAgICAgIHZhciBpZCA9IFwiI1wiICsgZWxlbUlkO1xuICAgICAgICB2YXIgcHJldmlld05vZGUgPSAkKGlkICsgXCIgLmRyb3B6b25lLWl0ZW1cIik7XG4gICAgICAgIHByZXZpZXdOb2RlLmlkID0gXCJcIjtcbiAgICAgICAgdmFyIHByZXZpZXdUZW1wbGF0ZSA9IHByZXZpZXdOb2RlLnBhcmVudCgnLmRyb3B6b25lLWl0ZW1zJykuaHRtbCgpO1xuICAgICAgICBwcmV2aWV3Tm9kZS5yZW1vdmUoKTtcblxuICAgICAgICB2YXIgbXlEcm9wem9uZSA9IG5ldyBEcm9wem9uZShpZCwgeyAvLyBNYWtlIHRoZSB3aG9sZSBib2R5IGEgZHJvcHpvbmVcbiAgICAgICAgICAgIHVybDogXCJodHRwczovL2tlZW50aGVtZXMuY29tL3NjcmlwdHMvdm9pZC5waHBcIiwgLy8gU2V0IHRoZSB1cmwgZm9yIHlvdXIgdXBsb2FkIHNjcmlwdCBsb2NhdGlvblxuICAgICAgICAgICAgcGFyYWxsZWxVcGxvYWRzOiAyMCxcbiAgICAgICAgICAgIG1heEZpbGVzaXplOiAxLCAvLyBNYXggZmlsZXNpemUgaW4gTUJcbiAgICAgICAgICAgIHByZXZpZXdUZW1wbGF0ZTogcHJldmlld1RlbXBsYXRlLFxuICAgICAgICAgICAgcHJldmlld3NDb250YWluZXI6IGlkICsgXCIgLmRyb3B6b25lLWl0ZW1zXCIsIC8vIERlZmluZSB0aGUgY29udGFpbmVyIHRvIGRpc3BsYXkgdGhlIHByZXZpZXdzXG4gICAgICAgICAgICBjbGlja2FibGU6IGlkICsgXCJfc2VsZWN0XCIgLy8gRGVmaW5lIHRoZSBlbGVtZW50IHRoYXQgc2hvdWxkIGJlIHVzZWQgYXMgY2xpY2sgdHJpZ2dlciB0byBzZWxlY3QgZmlsZXMuXG4gICAgICAgIH0pO1xuXG4gICAgICAgIG15RHJvcHpvbmUub24oXCJhZGRlZGZpbGVcIiwgZnVuY3Rpb24oZmlsZSkge1xuICAgICAgICAgICAgLy8gSG9va3VwIHRoZSBzdGFydCBidXR0b25cbiAgICAgICAgICAgICQoZG9jdW1lbnQpLmZpbmQoaWQgKyAnIC5kcm9wem9uZS1pdGVtJykuY3NzKCdkaXNwbGF5JywgJycpO1xuICAgICAgICB9KTtcblxuICAgICAgICAvLyBVcGRhdGUgdGhlIHRvdGFsIHByb2dyZXNzIGJhclxuICAgICAgICBteURyb3B6b25lLm9uKFwidG90YWx1cGxvYWRwcm9ncmVzc1wiLCBmdW5jdGlvbihwcm9ncmVzcykge1xuICAgICAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcihpZCArIFwiIC5wcm9ncmVzcy1iYXJcIikuc3R5bGUud2lkdGggPSBwcm9ncmVzcyArIFwiJVwiO1xuICAgICAgICB9KTtcblxuICAgICAgICBteURyb3B6b25lLm9uKFwic2VuZGluZ1wiLCBmdW5jdGlvbihmaWxlKSB7XG4gICAgICAgICAgICAvLyBTaG93IHRoZSB0b3RhbCBwcm9ncmVzcyBiYXIgd2hlbiB1cGxvYWQgc3RhcnRzXG4gICAgICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKGlkICsgXCIgLnByb2dyZXNzLWJhclwiKS5zdHlsZS5vcGFjaXR5ID0gXCIxXCI7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIEhpZGUgdGhlIHRvdGFsIHByb2dyZXNzIGJhciB3aGVuIG5vdGhpbmcncyB1cGxvYWRpbmcgYW55bW9yZVxuICAgICAgICBteURyb3B6b25lLm9uKFwiY29tcGxldGVcIiwgZnVuY3Rpb24ocHJvZ3Jlc3MpIHtcbiAgICAgICAgICAgIHZhciB0aGlzUHJvZ3Jlc3NCYXIgPSBpZCArIFwiIC5kei1jb21wbGV0ZVwiO1xuICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgICAkKHRoaXNQcm9ncmVzc0JhciArIFwiIC5wcm9ncmVzcy1iYXIsIFwiICsgdGhpc1Byb2dyZXNzQmFyICsgXCIgLnByb2dyZXNzXCIpLmNzcygnb3BhY2l0eScsICcwJyk7XG4gICAgICAgICAgICB9LCAzMDApXG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIC8vIFB1YmxpYyBtZXRob2RzXG4gICAgcmV0dXJuIHtcbiAgICAgICAgLy8gUHVibGljIGZ1bmN0aW9uc1xuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIC8vIEluaXQgdmFyaWFibGVzXG4gICAgICAgICAgICBfYXNpZGVFbCA9IEtUVXRpbC5nZXRCeUlkKCdrdF90b2RvX2FzaWRlJyk7XG4gICAgICAgICAgICBfbGlzdEVsID0gS1RVdGlsLmdldEJ5SWQoJ2t0X3RvZG9fbGlzdCcpO1xuICAgICAgICAgICAgX3ZpZXdFbCA9IEtUVXRpbC5nZXRCeUlkKCdrdF90b2RvX3ZpZXcnKTtcbiAgICAgICAgICAgIF9yZXBseUVsID0gS1RVdGlsLmdldEJ5SWQoJ2t0X3RvZG9fcmVwbHknKTtcblxuICAgICAgICAgICAgLy8gSW5pdCBoYW5kbGVyc1xuICAgICAgICAgICAgS1RBcHBUb2RvLmluaXRBc2lkZSgpO1xuICAgICAgICAgICAgS1RBcHBUb2RvLmluaXRMaXN0KCk7XG4gICAgICAgICAgICBLVEFwcFRvZG8uaW5pdFZpZXcoKTtcbiAgICAgICAgICAgIEtUQXBwVG9kby5pbml0UmVwbHkoKTtcbiAgICAgICAgfSxcblxuICAgICAgICBpbml0QXNpZGU6IGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgLy8gTW9iaWxlIG9mZmNhbnZhcyBmb3IgbW9iaWxlIG1vZGVcbiAgICAgICAgICAgIF9hc2lkZU9mZmNhbnZhcyA9IG5ldyBLVE9mZmNhbnZhcyhfYXNpZGVFbCwge1xuICAgICAgICAgICAgICAgIG92ZXJsYXk6IHRydWUsXG4gICAgICAgICAgICAgICAgYmFzZUNsYXNzOiAnb2ZmY2FudmFzLW1vYmlsZScsXG4gICAgICAgICAgICAgICAgLy9jbG9zZUJ5OiAna3RfdG9kb19hc2lkZV9jbG9zZScsXG4gICAgICAgICAgICAgICAgdG9nZ2xlQnk6ICdrdF9zdWJoZWFkZXJfbW9iaWxlX3RvZ2dsZSdcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAvLyBWaWV3IGxpc3RcbiAgICAgICAgICAgIEtUVXRpbC5vbihfYXNpZGVFbCwgJy5saXN0LWl0ZW1bZGF0YS1hY3Rpb249XCJsaXN0XCJdJywgJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuICAgICAgICAgICAgICAgIHZhciB0eXBlID0gS1RVdGlsLmF0dHIodGhpcywgJ2RhdGEtdHlwZScpO1xuICAgICAgICAgICAgICAgIHZhciBsaXN0SXRlbXNFbCA9IEtUVXRpbC5maW5kKF9saXN0RWwsICcua3QtaW5ib3hfX2l0ZW1zJyk7XG4gICAgICAgICAgICAgICAgdmFyIG5hdkl0ZW1FbCA9IHRoaXMuY2xvc2VzdCgnLmt0LW5hdl9faXRlbScpO1xuICAgICAgICAgICAgICAgIHZhciBuYXZJdGVtQWN0aXZlRWwgPSBLVFV0aWwuZmluZChfYXNpZGVFbCwgJy5rdC1uYXZfX2l0ZW0ua3QtbmF2X19pdGVtLS1hY3RpdmUnKTtcblxuICAgICAgICAgICAgICAgIC8vIGRlbW8gbG9hZGluZ1xuICAgICAgICAgICAgICAgIHZhciBsb2FkaW5nID0gbmV3IEtURGlhbG9nKHtcbiAgICAgICAgICAgICAgICAgICAgJ3R5cGUnOiAnbG9hZGVyJyxcbiAgICAgICAgICAgICAgICAgICAgJ3BsYWNlbWVudCc6ICd0b3AgY2VudGVyJyxcbiAgICAgICAgICAgICAgICAgICAgJ21lc3NhZ2UnOiAnTG9hZGluZyAuLi4nXG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgbG9hZGluZy5zaG93KCk7XG5cbiAgICAgICAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgICAgICBsb2FkaW5nLmhpZGUoKTtcblxuICAgICAgICAgICAgICAgICAgICBLVFV0aWwuY3NzKF9saXN0RWwsICdkaXNwbGF5JywgJ2ZsZXgnKTsgLy8gc2hvdyBsaXN0XG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5jc3MoX3ZpZXdFbCwgJ2Rpc3BsYXknLCAnbm9uZScpOyAvLyBoaWRlIHZpZXdcblxuICAgICAgICAgICAgICAgICAgICBLVFV0aWwuYWRkQ2xhc3MobmF2SXRlbUVsLCAna3QtbmF2X19pdGVtLS1hY3RpdmUnKTtcbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLnJlbW92ZUNsYXNzKG5hdkl0ZW1BY3RpdmVFbCwgJ2t0LW5hdl9faXRlbS0tYWN0aXZlJyk7XG5cbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLmF0dHIobGlzdEl0ZW1zRWwsICdkYXRhLXR5cGUnLCB0eXBlKTtcbiAgICAgICAgICAgICAgICB9LCA2MDApO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgaW5pdExpc3Q6IGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgLy8gR3JvdXAgc2VsZWN0aW9uXG4gICAgICAgICAgICBLVFV0aWwub24oX2xpc3RFbCwgJ1tkYXRhLWluYm94PVwiZ3JvdXAtc2VsZWN0XCJdIGlucHV0JywgJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgdmFyIG1lc3NhZ2VzID0gS1RVdGlsLmZpbmRBbGwoX2xpc3RFbCwgJ1tkYXRhLWluYm94PVwibWVzc2FnZVwiXScpO1xuXG4gICAgICAgICAgICAgICAgZm9yICh2YXIgaSA9IDAsIGogPSBtZXNzYWdlcy5sZW5ndGg7IGkgPCBqOyBpKyspIHtcbiAgICAgICAgICAgICAgICAgICAgdmFyIG1lc3NhZ2UgPSBtZXNzYWdlc1tpXTtcbiAgICAgICAgICAgICAgICAgICAgdmFyIGNoZWNrYm94ID0gS1RVdGlsLmZpbmQobWVzc2FnZSwgJy5jaGVja2JveCBpbnB1dCcpO1xuICAgICAgICAgICAgICAgICAgICBjaGVja2JveC5jaGVja2VkID0gdGhpcy5jaGVja2VkO1xuXG4gICAgICAgICAgICAgICAgICAgIGlmICh0aGlzLmNoZWNrZWQpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIEtUVXRpbC5hZGRDbGFzcyhtZXNzYWdlLCAnYWN0aXZlJyk7XG4gICAgICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBLVFV0aWwucmVtb3ZlQ2xhc3MobWVzc2FnZSwgJ2FjdGl2ZScpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIC8vIEluZGl2aWR1YWwgc2VsZWN0aW9uXG4gICAgICAgICAgICBLVFV0aWwub24oX2xpc3RFbCwgJ1tkYXRhLWluYm94PVwibWVzc2FnZVwiXSBbZGF0YS1pbmJveD1cImFjdGlvbnNcIl0gLmNoZWNrYm94IGlucHV0JywgJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgdmFyIGl0ZW0gPSB0aGlzLmNsb3Nlc3QoJ1tkYXRhLWluYm94PVwibWVzc2FnZVwiXScpO1xuXG4gICAgICAgICAgICAgICAgaWYgKGl0ZW0gJiYgdGhpcy5jaGVja2VkKSB7XG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5hZGRDbGFzcyhpdGVtLCAnYWN0aXZlJyk7XG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLnJlbW92ZUNsYXNzKGl0ZW0sICdhY3RpdmUnKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSxcblxuICAgICAgICBpbml0VmlldzogZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAvLyBCYWNrIHRvIGxpc3RpbmdcbiAgICAgICAgICAgIEtUVXRpbC5vbihfdmlld0VsLCAnW2RhdGEtaW5ib3g9XCJiYWNrXCJdJywgJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgLy8gZGVtbyBsb2FkaW5nXG4gICAgICAgICAgICAgICAgdmFyIGxvYWRpbmcgPSBuZXcgS1REaWFsb2coe1xuICAgICAgICAgICAgICAgICAgICAndHlwZSc6ICdsb2FkZXInLFxuICAgICAgICAgICAgICAgICAgICAncGxhY2VtZW50JzogJ3RvcCBjZW50ZXInLFxuICAgICAgICAgICAgICAgICAgICAnbWVzc2FnZSc6ICdMb2FkaW5nIC4uLidcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgIGxvYWRpbmcuc2hvdygpO1xuXG4gICAgICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICAgICAgICAgbG9hZGluZy5oaWRlKCk7XG5cbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLmFkZENsYXNzKF9saXN0RWwsICdkLWJsb2NrJyk7XG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5yZW1vdmVDbGFzcyhfbGlzdEVsLCAnZC1ub25lJyk7XG5cbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLmFkZENsYXNzKF92aWV3RWwsICdkLW5vbmUnKTtcbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLnJlbW92ZUNsYXNzKF92aWV3RWwsICdkLWJsb2NrJyk7XG4gICAgICAgICAgICAgICAgfSwgNzAwKTtcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAvLyBFeHBhbmQvQ29sbGFwc2UgcmVwbHlcbiAgICAgICAgICAgIEtUVXRpbC5vbihfdmlld0VsLCAnW2RhdGEtaW5ib3g9XCJtZXNzYWdlXCJdJywgJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuICAgICAgICAgICAgICAgIHZhciBtZXNzYWdlID0gdGhpcy5jbG9zZXN0KCdbZGF0YS1pbmJveD1cIm1lc3NhZ2VcIl0nKTtcblxuICAgICAgICAgICAgICAgIHZhciBkcm9wZG93blRvZ2dsZUVsID0gS1RVdGlsLmZpbmQodGhpcywgJ1tkYXRhLXRvZ2dsZT1cImRyb3Bkb3duXCJdJyk7XG4gICAgICAgICAgICAgICAgdmFyIHRvb2xiYXJFbCA9IEtUVXRpbC5maW5kKHRoaXMsICdbZGF0YS1pbmJveD1cInRvb2xiYXJcIl0nKTtcblxuICAgICAgICAgICAgICAgIC8vIHNraXAgZHJvcGRvd24gdG9nZ2xlIGNsaWNrXG4gICAgICAgICAgICAgICAgaWYgKGUudGFyZ2V0ID09PSBkcm9wZG93blRvZ2dsZUVsIHx8IChkcm9wZG93blRvZ2dsZUVsICYmIGRyb3Bkb3duVG9nZ2xlRWwuY29udGFpbnMoZS50YXJnZXQpID09PSB0cnVlKSkge1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgLy8gc2tpcCBncm91cCBhY3Rpb25zIGNsaWNrXG4gICAgICAgICAgICAgICAgaWYgKGUudGFyZ2V0ID09PSB0b29sYmFyRWwgfHwgKHRvb2xiYXJFbCAmJiB0b29sYmFyRWwuY29udGFpbnMoZS50YXJnZXQpID09PSB0cnVlKSkge1xuICAgICAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgaWYgKEtUVXRpbC5oYXNDbGFzcyhtZXNzYWdlLCAndG9nZ2xlLW9uJykpIHtcbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLmFkZENsYXNzKG1lc3NhZ2UsICd0b2dnbGUtb2ZmJyk7XG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5yZW1vdmVDbGFzcyhtZXNzYWdlLCAndG9nZ2xlLW9uJyk7XG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLnJlbW92ZUNsYXNzKG1lc3NhZ2UsICd0b2dnbGUtb2ZmJyk7XG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5hZGRDbGFzcyhtZXNzYWdlLCAndG9nZ2xlLW9uJyk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgaW5pdFJlcGx5OiBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIF9pbml0RWRpdG9yKF9yZXBseUVsLCAna3RfdG9kb19yZXBseV9lZGl0b3InKTtcbiAgICAgICAgICAgIF9pbml0QXR0YWNobWVudHMoJ2t0X3RvZG9fcmVwbHlfYXR0YWNobWVudHMnKTtcbiAgICAgICAgfVxuICAgIH07XG59KCk7XG5cbi8vIENsYXNzIEluaXRpYWxpemF0aW9uXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xuICAgIEtUQXBwVG9kby5pbml0KCk7XG59KTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/custom/todo/todo.js\n");

/***/ }),

/***/ 117:
/*!***************************************************************!*\
  !*** multi ./resources/metronic/js/pages/custom/todo/todo.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/laravel/concursos-publicos/resources/metronic/js/pages/custom/todo/todo.js */"./resources/metronic/js/pages/custom/todo/todo.js");


/***/ })

/******/ });