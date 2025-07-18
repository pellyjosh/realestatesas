/*
Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or http://ckeditor.com/license
*/
(function () {
    window.CKEDITOR && window.CKEDITOR.dom || (window.CKEDITOR || (window.CKEDITOR = function () {
        var a = /(^|.*[\\\/])ckeditor\.js(?:\?.*|;.*)?$/i, e = {
            timestamp: "G6DD", version: "4.5.10 (Standard)", revision: "b47abaf", rnd: Math.floor(900 * Math.random()) + 100, _: { pending: [], basePathSrcPattern: a }, status: "unloaded", basePath: function () {
                var b = window.CKEDITOR_BASEPATH || ""; if (!b) for (var c = document.getElementsByTagName("script"), e = 0; e < c.length; e++) { var f = c[e].src.match(a); if (f) { b = f[1]; break } } -1 == b.indexOf(":/") && "//" !=
                    b.slice(0, 2) && (b = 0 === b.indexOf("/") ? location.href.match(/^.*?:\/\/[^\/]*/)[0] + b : location.href.match(/^[^\?]*\/(?:)/)[0] + b); if (!b) throw 'The CKEditor installation path could not be automatically detected. Please set the global variable "CKEDITOR_BASEPATH" before creating editor instances.'; return b
            }(), getUrl: function (a) {
                -1 == a.indexOf(":/") && 0 !== a.indexOf("/") && (a = this.basePath + a); this.timestamp && "/" != a.charAt(a.length - 1) && !/[&?]t=/.test(a) && (a += (0 <= a.indexOf("?") ? "\x26" : "?") + "t\x3d" + this.timestamp);
                return a
            }, domReady: function () {
                function a() { try { document.addEventListener ? (document.removeEventListener("DOMContentLoaded", a, !1), b()) : document.attachEvent && "complete" === document.readyState && (document.detachEvent("onreadystatechange", a), b()) } catch (f) { } } function b() { for (var a; a = c.shift();)a() } var c = []; return function (f) {
                    function b() { try { document.documentElement.doScroll("left") } catch (g) { setTimeout(b, 1); return } a() } c.push(f); "complete" === document.readyState && setTimeout(a, 1); if (1 == c.length) if (document.addEventListener) document.addEventListener("DOMContentLoaded",
                        a, !1), window.addEventListener("load", a, !1); else if (document.attachEvent) { document.attachEvent("onreadystatechange", a); window.attachEvent("onload", a); f = !1; try { f = !window.frameElement } catch (l) { } document.documentElement.doScroll && f && b() }
                }
            }()
        }, b = window.CKEDITOR_GETURL; if (b) { var c = e.getUrl; e.getUrl = function (a) { return b.call(e, a) || c.call(e, a) } } return e
    }()), CKEDITOR.event || (CKEDITOR.event = function () { }, CKEDITOR.event.implementOn = function (a) { var e = CKEDITOR.event.prototype, b; for (b in e) null == a[b] && (a[b] = e[b]) },
        CKEDITOR.event.prototype = function () {
            function a(a) { var d = e(this); return d[a] || (d[a] = new b(a)) } var e = function (a) { a = a.getPrivate && a.getPrivate() || a._ || (a._ = {}); return a.events || (a.events = {}) }, b = function (a) { this.name = a; this.listeners = [] }; b.prototype = { getListenerIndex: function (a) { for (var b = 0, e = this.listeners; b < e.length; b++)if (e[b].fn == a) return b; return -1 } }; return {
                define: function (b, d) { var e = a.call(this, b); CKEDITOR.tools.extend(e, d, !0) }, on: function (b, d, e, m, f) {
                    function h(a, g, f, h) {
                        a = {
                            name: b, sender: this, editor: a,
                            data: g, listenerData: m, stop: f, cancel: h, removeListener: l
                        }; return !1 === d.call(e, a) ? !1 : a.data
                    } function l() { n.removeListener(b, d) } var g = a.call(this, b); if (0 > g.getListenerIndex(d)) { g = g.listeners; e || (e = this); isNaN(f) && (f = 10); var n = this; h.fn = d; h.priority = f; for (var v = g.length - 1; 0 <= v; v--)if (g[v].priority <= f) return g.splice(v + 1, 0, h), { removeListener: l }; g.unshift(h) } return { removeListener: l }
                }, once: function () {
                    var a = Array.prototype.slice.call(arguments), b = a[1]; a[1] = function (a) {
                        a.removeListener(); return b.apply(this,
                            arguments)
                    }; return this.on.apply(this, a)
                }, capture: function () { CKEDITOR.event.useCapture = 1; var a = this.on.apply(this, arguments); CKEDITOR.event.useCapture = 0; return a }, fire: function () {
                    var a = 0, b = function () { a = 1 }, k = 0, m = function () { k = 1 }; return function (f, h, l) {
                        var g = e(this)[f]; f = a; var n = k; a = k = 0; if (g) { var v = g.listeners; if (v.length) for (var v = v.slice(0), u, q = 0; q < v.length; q++) { if (g.errorProof) try { u = v[q].call(this, l, h, b, m) } catch (t) { } else u = v[q].call(this, l, h, b, m); !1 === u ? k = 1 : "undefined" != typeof u && (h = u); if (a || k) break } } h =
                            k ? !1 : "undefined" == typeof h ? !0 : h; a = f; k = n; return h
                    }
                }(), fireOnce: function (a, b, k) { b = this.fire(a, b, k); delete e(this)[a]; return b }, removeListener: function (a, b) { var k = e(this)[a]; if (k) { var m = k.getListenerIndex(b); 0 <= m && k.listeners.splice(m, 1) } }, removeAllListeners: function () { var a = e(this), b; for (b in a) delete a[b] }, hasListeners: function (a) { return (a = e(this)[a]) && 0 < a.listeners.length }
            }
        }()), CKEDITOR.editor || (CKEDITOR.editor = function () { CKEDITOR._.pending.push([this, arguments]); CKEDITOR.event.call(this) }, CKEDITOR.editor.prototype.fire =
            function (a, e) { a in { instanceReady: 1, loaded: 1 } && (this[a] = !0); return CKEDITOR.event.prototype.fire.call(this, a, e, this) }, CKEDITOR.editor.prototype.fireOnce = function (a, e) { a in { instanceReady: 1, loaded: 1 } && (this[a] = !0); return CKEDITOR.event.prototype.fireOnce.call(this, a, e, this) }, CKEDITOR.event.implementOn(CKEDITOR.editor.prototype)), CKEDITOR.env || (CKEDITOR.env = function () {
                var a = navigator.userAgent.toLowerCase(), e = a.match(/edge[ \/](\d+.?\d*)/), b = -1 < a.indexOf("trident/"), b = !(!e && !b), b = {
                    ie: b, edge: !!e, webkit: !b &&
                        -1 < a.indexOf(" applewebkit/"), air: -1 < a.indexOf(" adobeair/"), mac: -1 < a.indexOf("macintosh"), quirks: "BackCompat" == document.compatMode && (!document.documentMode || 10 > document.documentMode), mobile: -1 < a.indexOf("mobile"), iOS: /(ipad|iphone|ipod)/.test(a), isCustomDomain: function () { if (!this.ie) return !1; var a = document.domain, b = window.location.hostname; return a != b && a != "[" + b + "]" }, secure: "https:" == location.protocol
                }; b.gecko = "Gecko" == navigator.product && !b.webkit && !b.ie; b.webkit && (-1 < a.indexOf("chrome") ? b.chrome =
                    !0 : b.safari = !0); var c = 0; b.ie && (c = e ? parseFloat(e[1]) : b.quirks || !document.documentMode ? parseFloat(a.match(/msie (\d+)/)[1]) : document.documentMode, b.ie9Compat = 9 == c, b.ie8Compat = 8 == c, b.ie7Compat = 7 == c, b.ie6Compat = 7 > c || b.quirks); b.gecko && (e = a.match(/rv:([\d\.]+)/)) && (e = e[1].split("."), c = 1E4 * e[0] + 100 * (e[1] || 0) + 1 * (e[2] || 0)); b.air && (c = parseFloat(a.match(/ adobeair\/(\d+)/)[1])); b.webkit && (c = parseFloat(a.match(/ applewebkit\/(\d+)/)[1])); b.version = c; b.isCompatible = !(b.ie && 7 > c) && !(b.gecko && 4E4 > c) && !(b.webkit &&
                        534 > c); b.hidpi = 2 <= window.devicePixelRatio; b.needsBrFiller = b.gecko || b.webkit || b.ie && 10 < c; b.needsNbspFiller = b.ie && 11 > c; b.cssClass = "cke_browser_" + (b.ie ? "ie" : b.gecko ? "gecko" : b.webkit ? "webkit" : "unknown"); b.quirks && (b.cssClass += " cke_browser_quirks"); b.ie && (b.cssClass += " cke_browser_ie" + (b.quirks ? "6 cke_browser_iequirks" : b.version)); b.air && (b.cssClass += " cke_browser_air"); b.iOS && (b.cssClass += " cke_browser_ios"); b.hidpi && (b.cssClass += " cke_hidpi"); return b
            }()), "unloaded" == CKEDITOR.status && function () {
                CKEDITOR.event.implementOn(CKEDITOR);
                CKEDITOR.loadFullCore = function () { if ("basic_ready" != CKEDITOR.status) CKEDITOR.loadFullCore._load = 1; else { delete CKEDITOR.loadFullCore; var a = document.createElement("script"); a.type = "text/javascript"; a.src = CKEDITOR.basePath + "ckeditor.js"; document.getElementsByTagName("head")[0].appendChild(a) } }; CKEDITOR.loadFullCoreTimeout = 0; CKEDITOR.add = function (a) { (this._.pending || (this._.pending = [])).push(a) }; (function () {
                    CKEDITOR.domReady(function () {
                        var a = CKEDITOR.loadFullCore, e = CKEDITOR.loadFullCoreTimeout; a && (CKEDITOR.status =
                            "basic_ready", a && a._load ? a() : e && setTimeout(function () { CKEDITOR.loadFullCore && CKEDITOR.loadFullCore() }, 1E3 * e))
                    })
                })(); CKEDITOR.status = "basic_loaded"
            }(), "use strict", CKEDITOR.VERBOSITY_WARN = 1, CKEDITOR.VERBOSITY_ERROR = 2, CKEDITOR.verbosity = CKEDITOR.VERBOSITY_WARN | CKEDITOR.VERBOSITY_ERROR, CKEDITOR.warn = function (a, e) { CKEDITOR.verbosity & CKEDITOR.VERBOSITY_WARN && CKEDITOR.fire("log", { type: "warn", errorCode: a, additionalData: e }) }, CKEDITOR.error = function (a, e) {
                CKEDITOR.verbosity & CKEDITOR.VERBOSITY_ERROR && CKEDITOR.fire("log",
                    { type: "error", errorCode: a, additionalData: e })
            }, CKEDITOR.on("log", function (a) { if (window.console && window.console.log) { var e = console[a.data.type] ? a.data.type : "log", b = a.data.errorCode; if (a = a.data.additionalData) console[e]("[CKEDITOR] Error code: " + b + ".", a); else console[e]("[CKEDITOR] Error code: " + b + "."); console[e]("[CKEDITOR] For more information about this error go to http://docs.ckeditor.com/#!/guide/dev_errors-section-" + b) } }, null, null, 999), CKEDITOR.dom = {}, function () {
                var a = [], e = CKEDITOR.env.gecko ? "-moz-" :
                    CKEDITOR.env.webkit ? "-webkit-" : CKEDITOR.env.ie ? "-ms-" : "", b = /&/g, c = />/g, d = /</g, k = /"/g, m = /&(lt|gt|amp|quot|nbsp|shy|#\d{1,5});/g, f = { lt: "\x3c", gt: "\x3e", amp: "\x26", quot: '"', nbsp: "Â ", shy: "Â­" }, h = function (a, g) { return "#" == g[0] ? String.fromCharCode(parseInt(g.slice(1), 10)) : f[g] }; CKEDITOR.on("reset", function () { a = [] }); CKEDITOR.tools = {
                        arrayCompare: function (a, g) { if (!a && !g) return !0; if (!a || !g || a.length != g.length) return !1; for (var f = 0; f < a.length; f++)if (a[f] != g[f]) return !1; return !0 }, getIndex: function (a, g) {
                            for (var f =
                                0; f < a.length; ++f)if (g(a[f])) return f; return -1
                        }, clone: function (a) { var g; if (a && a instanceof Array) { g = []; for (var f = 0; f < a.length; f++)g[f] = CKEDITOR.tools.clone(a[f]); return g } if (null === a || "object" != typeof a || a instanceof String || a instanceof Number || a instanceof Boolean || a instanceof Date || a instanceof RegExp || a.nodeType || a.window === a) return a; g = new a.constructor; for (f in a) g[f] = CKEDITOR.tools.clone(a[f]); return g }, capitalize: function (a, g) { return a.charAt(0).toUpperCase() + (g ? a.slice(1) : a.slice(1).toLowerCase()) },
                        extend: function (a) { var g = arguments.length, f, b; "boolean" == typeof (f = arguments[g - 1]) ? g-- : "boolean" == typeof (f = arguments[g - 2]) && (b = arguments[g - 1], g -= 2); for (var h = 1; h < g; h++) { var c = arguments[h], d; for (d in c) if (!0 === f || null == a[d]) if (!b || d in b) a[d] = c[d] } return a }, prototypedCopy: function (a) { var g = function () { }; g.prototype = a; return new g }, copy: function (a) { var g = {}, f; for (f in a) g[f] = a[f]; return g }, isArray: function (a) { return "[object Array]" == Object.prototype.toString.call(a) }, isEmpty: function (a) {
                            for (var g in a) if (a.hasOwnProperty(g)) return !1;
                            return !0
                        }, cssVendorPrefix: function (a, g, f) { if (f) return e + a + ":" + g + ";" + a + ":" + g; f = {}; f[a] = g; f[e + a] = g; return f }, cssStyleToDomStyle: function () { var a = document.createElement("div").style, g = "undefined" != typeof a.cssFloat ? "cssFloat" : "undefined" != typeof a.styleFloat ? "styleFloat" : "float"; return function (a) { return "float" == a ? g : a.replace(/-./g, function (a) { return a.substr(1).toUpperCase() }) } }(), buildStyleHtml: function (a) {
                            a = [].concat(a); for (var g, f = [], b = 0; b < a.length; b++)if (g = a[b]) /@import|[{}]/.test(g) ? f.push("\x3cstyle\x3e" +
                                g + "\x3c/style\x3e") : f.push('\x3clink type\x3d"text/css" rel\x3dstylesheet href\x3d"' + g + '"\x3e'); return f.join("")
                        }, htmlEncode: function (a) { return void 0 === a || null === a ? "" : String(a).replace(b, "\x26amp;").replace(c, "\x26gt;").replace(d, "\x26lt;") }, htmlDecode: function (a) { return a.replace(m, h) }, htmlEncodeAttr: function (a) { return CKEDITOR.tools.htmlEncode(a).replace(k, "\x26quot;") }, htmlDecodeAttr: function (a) { return CKEDITOR.tools.htmlDecode(a) }, transformPlainTextToHtml: function (a, g) {
                            var f = g == CKEDITOR.ENTER_BR,
                            b = this.htmlEncode(a.replace(/\r\n/g, "\n")), b = b.replace(/\t/g, "\x26nbsp;\x26nbsp; \x26nbsp;"), h = g == CKEDITOR.ENTER_P ? "p" : "div"; if (!f) { var c = /\n{2}/g; if (c.test(b)) var d = "\x3c" + h + "\x3e", e = "\x3c/" + h + "\x3e", b = d + b.replace(c, function () { return e + d }) + e } b = b.replace(/\n/g, "\x3cbr\x3e"); f || (b = b.replace(new RegExp("\x3cbr\x3e(?\x3d\x3c/" + h + "\x3e)"), function (a) { return CKEDITOR.tools.repeat(a, 2) })); b = b.replace(/^ | $/g, "\x26nbsp;"); return b = b.replace(/(>|\s) /g, function (a, g) { return g + "\x26nbsp;" }).replace(/ (?=<)/g,
                                "\x26nbsp;")
                        }, getNextNumber: function () { var a = 0; return function () { return ++a } }(), getNextId: function () { return "cke_" + this.getNextNumber() }, getUniqueId: function () { for (var a = "e", g = 0; 8 > g; g++)a += Math.floor(65536 * (1 + Math.random())).toString(16).substring(1); return a }, override: function (a, g) { var f = g(a); f.prototype = a.prototype; return f }, setTimeout: function (a, g, f, b, h) { h || (h = window); f || (f = h); return h.setTimeout(function () { b ? a.apply(f, [].concat(b)) : a.apply(f) }, g || 0) }, trim: function () {
                            var a = /(?:^[ \t\n\r]+)|(?:[ \t\n\r]+$)/g;
                            return function (g) { return g.replace(a, "") }
                        }(), ltrim: function () { var a = /^[ \t\n\r]+/g; return function (g) { return g.replace(a, "") } }(), rtrim: function () { var a = /[ \t\n\r]+$/g; return function (g) { return g.replace(a, "") } }(), indexOf: function (a, g) { if ("function" == typeof g) for (var f = 0, b = a.length; f < b; f++) { if (g(a[f])) return f } else { if (a.indexOf) return a.indexOf(g); f = 0; for (b = a.length; f < b; f++)if (a[f] === g) return f } return -1 }, search: function (a, g) { var f = CKEDITOR.tools.indexOf(a, g); return 0 <= f ? a[f] : null }, bind: function (a,
                            g) { return function () { return a.apply(g, arguments) } }, createClass: function (a) {
                                var g = a.$, f = a.base, b = a.privates || a._, h = a.proto; a = a.statics; !g && (g = function () { f && this.base.apply(this, arguments) }); if (b) var c = g, g = function () { var a = this._ || (this._ = {}), g; for (g in b) { var f = b[g]; a[g] = "function" == typeof f ? CKEDITOR.tools.bind(f, this) : f } c.apply(this, arguments) }; f && (g.prototype = this.prototypedCopy(f.prototype), g.prototype.constructor = g, g.base = f, g.baseProto = f.prototype, g.prototype.base = function () {
                                    this.base = f.prototype.base;
                                    f.apply(this, arguments); this.base = arguments.callee
                                }); h && this.extend(g.prototype, h, !0); a && this.extend(g, a, !0); return g
                            }, addFunction: function (f, g) { return a.push(function () { return f.apply(g || this, arguments) }) - 1 }, removeFunction: function (f) { a[f] = null }, callFunction: function (f) { var g = a[f]; return g && g.apply(window, Array.prototype.slice.call(arguments, 1)) }, cssLength: function () { var a = /^-?\d+\.?\d*px$/, g; return function (f) { g = CKEDITOR.tools.trim(f + "") + "px"; return a.test(g) ? g : f || "" } }(), convertToPx: function () {
                                var a;
                                return function (g) { a || (a = CKEDITOR.dom.element.createFromHtml('\x3cdiv style\x3d"position:absolute;left:-9999px;top:-9999px;margin:0px;padding:0px;border:0px;"\x3e\x3c/div\x3e', CKEDITOR.document), CKEDITOR.document.getBody().append(a)); return /%$/.test(g) ? g : (a.setStyle("width", g), a.$.clientWidth) }
                            }(), repeat: function (a, g) { return Array(g + 1).join(a) }, tryThese: function () { for (var a, g = 0, f = arguments.length; g < f; g++) { var b = arguments[g]; try { a = b(); break } catch (h) { } } return a }, genKey: function () { return Array.prototype.slice.call(arguments).join("-") },
                        defer: function (a) { return function () { var g = arguments, f = this; window.setTimeout(function () { a.apply(f, g) }, 0) } }, normalizeCssText: function (a, g) { var f = [], b, h = CKEDITOR.tools.parseCssText(a, !0, g); for (b in h) f.push(b + ":" + h[b]); f.sort(); return f.length ? f.join(";") + ";" : "" }, convertRgbToHex: function (a) { return a.replace(/(?:rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\))/gi, function (a, f, b, h) { a = [f, b, h]; for (f = 0; 3 > f; f++)a[f] = ("0" + parseInt(a[f], 10).toString(16)).slice(-2); return "#" + a.join("") }) }, normalizeHex: function (a) {
                            return a.replace(/#(([0-9a-f]{3}){1,2})($|;|\s+)/gi,
                                function (a, f, b, h) { a = f.toLowerCase(); 3 == a.length && (a = a.split(""), a = [a[0], a[0], a[1], a[1], a[2], a[2]].join("")); return "#" + a + h })
                        }, parseCssText: function (a, g, f) {
                            var b = {}; f && (a = (new CKEDITOR.dom.element("span")).setAttribute("style", a).getAttribute("style") || ""); a && (a = CKEDITOR.tools.normalizeHex(CKEDITOR.tools.convertRgbToHex(a))); if (!a || ";" == a) return b; a.replace(/&quot;/g, '"').replace(/\s*([^:;\s]+)\s*:\s*([^;]+)\s*(?=;|$)/g, function (a, f, h) {
                                g && (f = f.toLowerCase(), "font-family" == f && (h = h.replace(/\s*,\s*/g,
                                    ",")), h = CKEDITOR.tools.trim(h)); b[f] = h
                            }); return b
                        }, writeCssText: function (a, g) { var f, b = []; for (f in a) b.push(f + ":" + a[f]); g && b.sort(); return b.join("; ") }, objectCompare: function (a, g, f) { var b; if (!a && !g) return !0; if (!a || !g) return !1; for (b in a) if (a[b] != g[b]) return !1; if (!f) for (b in g) if (a[b] != g[b]) return !1; return !0 }, objectKeys: function (a) { var g = [], f; for (f in a) g.push(f); return g }, convertArrayToObject: function (a, g) { var f = {}; 1 == arguments.length && (g = !0); for (var b = 0, h = a.length; b < h; ++b)f[a[b]] = g; return f }, fixDomain: function () {
                            for (var a; ;)try {
                                a =
                                window.parent.document.domain; break
                            } catch (g) { a = a ? a.replace(/.+?(?:\.|$)/, "") : document.domain; if (!a) break; document.domain = a } return !!a
                        }, eventsBuffer: function (a, g, f) { function b() { c = (new Date).getTime(); h = !1; f ? g.call(f) : g() } var h, c = 0; return { input: function () { if (!h) { var g = (new Date).getTime() - c; g < a ? h = setTimeout(b, a - g) : b() } }, reset: function () { h && clearTimeout(h); h = c = 0 } } }, enableHtml5Elements: function (a, g) {
                            for (var f = "abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup main mark meter nav output progress section summary time video".split(" "),
                                b = f.length, h; b--;)h = a.createElement(f[b]), g && a.appendChild(h)
                        }, checkIfAnyArrayItemMatches: function (a, g) { for (var f = 0, b = a.length; f < b; ++f)if (a[f].match(g)) return !0; return !1 }, checkIfAnyObjectPropertyMatches: function (a, g) { for (var f in a) if (f.match(g)) return !0; return !1 }, transparentImageData: "data:image/gif;base64,R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw\x3d\x3d", getCookie: function (a) {
                            a = a.toLowerCase(); for (var g = document.cookie.split(";"), f, b, h = 0; h < g.length; h++)if (f = g[h].split("\x3d"),
                                b = decodeURIComponent(CKEDITOR.tools.trim(f[0]).toLowerCase()), b === a) return decodeURIComponent(1 < f.length ? f[1] : ""); return null
                        }, setCookie: function (a, g) { document.cookie = encodeURIComponent(a) + "\x3d" + encodeURIComponent(g) + ";path\x3d/" }, getCsrfToken: function () {
                            var a = CKEDITOR.tools.getCookie("ckCsrfToken"); if (!a || 40 != a.length) {
                                var a = [], g = ""; if (window.crypto && window.crypto.getRandomValues) a = new Uint8Array(40), window.crypto.getRandomValues(a); else for (var f = 0; 40 > f; f++)a.push(Math.floor(256 * Math.random()));
                                for (f = 0; f < a.length; f++)var b = "abcdefghijklmnopqrstuvwxyz0123456789".charAt(a[f] % 36), g = g + (.5 < Math.random() ? b.toUpperCase() : b); a = g; CKEDITOR.tools.setCookie("ckCsrfToken", a)
                            } return a
                        }, escapeCss: function (a) { return a ? window.CSS && CSS.escape ? CSS.escape(a) : isNaN(parseInt(a.charAt(0), 10)) ? a : "\\3" + a.charAt(0) + " " + a.substring(1, a.length) : "" }
                    }
            }(), CKEDITOR.dtd = function () {
                var a = CKEDITOR.tools.extend, e = function (a, g) { for (var f = CKEDITOR.tools.clone(a), b = 1; b < arguments.length; b++) { g = arguments[b]; for (var h in g) delete f[h] } return f },
                b = {}, c = {}, d = { address: 1, article: 1, aside: 1, blockquote: 1, details: 1, div: 1, dl: 1, fieldset: 1, figure: 1, footer: 1, form: 1, h1: 1, h2: 1, h3: 1, h4: 1, h5: 1, h6: 1, header: 1, hgroup: 1, hr: 1, main: 1, menu: 1, nav: 1, ol: 1, p: 1, pre: 1, section: 1, table: 1, ul: 1 }, k = { command: 1, link: 1, meta: 1, noscript: 1, script: 1, style: 1 }, m = {}, f = { "#": 1 }, h = { center: 1, dir: 1, noframes: 1 }; a(b, {
                    a: 1, abbr: 1, area: 1, audio: 1, b: 1, bdi: 1, bdo: 1, br: 1, button: 1, canvas: 1, cite: 1, code: 1, command: 1, datalist: 1, del: 1, dfn: 1, em: 1, embed: 1, i: 1, iframe: 1, img: 1, input: 1, ins: 1, kbd: 1, keygen: 1,
                    label: 1, map: 1, mark: 1, meter: 1, noscript: 1, object: 1, output: 1, progress: 1, q: 1, ruby: 1, s: 1, samp: 1, script: 1, select: 1, small: 1, span: 1, strong: 1, sub: 1, sup: 1, textarea: 1, time: 1, u: 1, "var": 1, video: 1, wbr: 1
                }, f, { acronym: 1, applet: 1, basefont: 1, big: 1, font: 1, isindex: 1, strike: 1, style: 1, tt: 1 }); a(c, d, b, h); e = {
                    a: e(b, { a: 1, button: 1 }), abbr: b, address: c, area: m, article: c, aside: c, audio: a({ source: 1, track: 1 }, c), b: b, base: m, bdi: b, bdo: b, blockquote: c, body: c, br: m, button: e(b, { a: 1, button: 1 }), canvas: b, caption: c, cite: b, code: b, col: m, colgroup: { col: 1 },
                    command: m, datalist: a({ option: 1 }, b), dd: c, del: b, details: a({ summary: 1 }, c), dfn: b, div: c, dl: { dt: 1, dd: 1 }, dt: c, em: b, embed: m, fieldset: a({ legend: 1 }, c), figcaption: c, figure: a({ figcaption: 1 }, c), footer: c, form: c, h1: b, h2: b, h3: b, h4: b, h5: b, h6: b, head: a({ title: 1, base: 1 }, k), header: c, hgroup: { h1: 1, h2: 1, h3: 1, h4: 1, h5: 1, h6: 1 }, hr: m, html: a({ head: 1, body: 1 }, c, k), i: b, iframe: f, img: m, input: m, ins: b, kbd: b, keygen: m, label: b, legend: b, li: c, link: m, main: c, map: c, mark: b, menu: a({ li: 1 }, c), meta: m, meter: e(b, { meter: 1 }), nav: c, noscript: a({
                        link: 1,
                        meta: 1, style: 1
                    }, b), object: a({ param: 1 }, b), ol: { li: 1 }, optgroup: { option: 1 }, option: f, output: b, p: b, param: m, pre: b, progress: e(b, { progress: 1 }), q: b, rp: b, rt: b, ruby: a({ rp: 1, rt: 1 }, b), s: b, samp: b, script: f, section: c, select: { optgroup: 1, option: 1 }, small: b, source: m, span: b, strong: b, style: f, sub: b, summary: a({ h1: 1, h2: 1, h3: 1, h4: 1, h5: 1, h6: 1 }, b), sup: b, table: { caption: 1, colgroup: 1, thead: 1, tfoot: 1, tbody: 1, tr: 1 }, tbody: { tr: 1 }, td: c, textarea: f, tfoot: { tr: 1 }, th: c, thead: { tr: 1 }, time: e(b, { time: 1 }), title: f, tr: { th: 1, td: 1 }, track: m, u: b, ul: { li: 1 },
                    "var": b, video: a({ source: 1, track: 1 }, c), wbr: m, acronym: b, applet: a({ param: 1 }, c), basefont: m, big: b, center: c, dialog: m, dir: { li: 1 }, font: b, isindex: m, noframes: c, strike: b, tt: b
                }; a(e, {
                    $block: a({ audio: 1, dd: 1, dt: 1, figcaption: 1, li: 1, video: 1 }, d, h), $blockLimit: { article: 1, aside: 1, audio: 1, body: 1, caption: 1, details: 1, dir: 1, div: 1, dl: 1, fieldset: 1, figcaption: 1, figure: 1, footer: 1, form: 1, header: 1, hgroup: 1, main: 1, menu: 1, nav: 1, ol: 1, section: 1, table: 1, td: 1, th: 1, tr: 1, ul: 1, video: 1 }, $cdata: { script: 1, style: 1 }, $editable: {
                        address: 1, article: 1,
                        aside: 1, blockquote: 1, body: 1, details: 1, div: 1, fieldset: 1, figcaption: 1, footer: 1, form: 1, h1: 1, h2: 1, h3: 1, h4: 1, h5: 1, h6: 1, header: 1, hgroup: 1, main: 1, nav: 1, p: 1, pre: 1, section: 1
                    }, $empty: { area: 1, base: 1, basefont: 1, br: 1, col: 1, command: 1, dialog: 1, embed: 1, hr: 1, img: 1, input: 1, isindex: 1, keygen: 1, link: 1, meta: 1, param: 1, source: 1, track: 1, wbr: 1 }, $inline: b, $list: { dl: 1, ol: 1, ul: 1 }, $listItem: { dd: 1, dt: 1, li: 1 }, $nonBodyContent: a({ body: 1, head: 1, html: 1 }, e.head), $nonEditable: {
                        applet: 1, audio: 1, button: 1, embed: 1, iframe: 1, map: 1, object: 1,
                        option: 1, param: 1, script: 1, textarea: 1, video: 1
                    }, $object: { applet: 1, audio: 1, button: 1, hr: 1, iframe: 1, img: 1, input: 1, object: 1, select: 1, table: 1, textarea: 1, video: 1 }, $removeEmpty: { abbr: 1, acronym: 1, b: 1, bdi: 1, bdo: 1, big: 1, cite: 1, code: 1, del: 1, dfn: 1, em: 1, font: 1, i: 1, ins: 1, label: 1, kbd: 1, mark: 1, meter: 1, output: 1, q: 1, ruby: 1, s: 1, samp: 1, small: 1, span: 1, strike: 1, strong: 1, sub: 1, sup: 1, time: 1, tt: 1, u: 1, "var": 1 }, $tabIndex: { a: 1, area: 1, button: 1, input: 1, object: 1, select: 1, textarea: 1 }, $tableContent: {
                        caption: 1, col: 1, colgroup: 1, tbody: 1,
                        td: 1, tfoot: 1, th: 1, thead: 1, tr: 1
                    }, $transparent: { a: 1, audio: 1, canvas: 1, del: 1, ins: 1, map: 1, noscript: 1, object: 1, video: 1 }, $intermediate: { caption: 1, colgroup: 1, dd: 1, dt: 1, figcaption: 1, legend: 1, li: 1, optgroup: 1, option: 1, rp: 1, rt: 1, summary: 1, tbody: 1, td: 1, tfoot: 1, th: 1, thead: 1, tr: 1 }
                }); return e
            }(), CKEDITOR.dom.event = function (a) { this.$ = a }, CKEDITOR.dom.event.prototype = {
                getKey: function () { return this.$.keyCode || this.$.which }, getKeystroke: function () {
                    var a = this.getKey(); if (this.$.ctrlKey || this.$.metaKey) a += CKEDITOR.CTRL;
                    this.$.shiftKey && (a += CKEDITOR.SHIFT); this.$.altKey && (a += CKEDITOR.ALT); return a
                }, preventDefault: function (a) { var e = this.$; e.preventDefault ? e.preventDefault() : e.returnValue = !1; a && this.stopPropagation() }, stopPropagation: function () { var a = this.$; a.stopPropagation ? a.stopPropagation() : a.cancelBubble = !0 }, getTarget: function () { var a = this.$.target || this.$.srcElement; return a ? new CKEDITOR.dom.node(a) : null }, getPhase: function () { return this.$.eventPhase || 2 }, getPageOffset: function () {
                    var a = this.getTarget().getDocument().$;
                    return { x: this.$.pageX || this.$.clientX + (a.documentElement.scrollLeft || a.body.scrollLeft), y: this.$.pageY || this.$.clientY + (a.documentElement.scrollTop || a.body.scrollTop) }
                }
            }, CKEDITOR.CTRL = 1114112, CKEDITOR.SHIFT = 2228224, CKEDITOR.ALT = 4456448, CKEDITOR.EVENT_PHASE_CAPTURING = 1, CKEDITOR.EVENT_PHASE_AT_TARGET = 2, CKEDITOR.EVENT_PHASE_BUBBLING = 3, CKEDITOR.dom.domObject = function (a) { a && (this.$ = a) }, CKEDITOR.dom.domObject.prototype = function () {
                var a = function (a, b) {
                    return function (c) {
                        "undefined" != typeof CKEDITOR && a.fire(b,
                            new CKEDITOR.dom.event(c))
                    }
                }; return {
                    getPrivate: function () { var a; (a = this.getCustomData("_")) || this.setCustomData("_", a = {}); return a }, on: function (e) { var b = this.getCustomData("_cke_nativeListeners"); b || (b = {}, this.setCustomData("_cke_nativeListeners", b)); b[e] || (b = b[e] = a(this, e), this.$.addEventListener ? this.$.addEventListener(e, b, !!CKEDITOR.event.useCapture) : this.$.attachEvent && this.$.attachEvent("on" + e, b)); return CKEDITOR.event.prototype.on.apply(this, arguments) }, removeListener: function (a) {
                        CKEDITOR.event.prototype.removeListener.apply(this,
                            arguments); if (!this.hasListeners(a)) { var b = this.getCustomData("_cke_nativeListeners"), c = b && b[a]; c && (this.$.removeEventListener ? this.$.removeEventListener(a, c, !1) : this.$.detachEvent && this.$.detachEvent("on" + a, c), delete b[a]) }
                    }, removeAllListeners: function () { var a = this.getCustomData("_cke_nativeListeners"), b; for (b in a) { var c = a[b]; this.$.detachEvent ? this.$.detachEvent("on" + b, c) : this.$.removeEventListener && this.$.removeEventListener(b, c, !1); delete a[b] } CKEDITOR.event.prototype.removeAllListeners.call(this) }
                }
            }(),
        function (a) {
            var e = {}; CKEDITOR.on("reset", function () { e = {} }); a.equals = function (a) { try { return a && a.$ === this.$ } catch (c) { return !1 } }; a.setCustomData = function (a, c) { var d = this.getUniqueId(); (e[d] || (e[d] = {}))[a] = c; return this }; a.getCustomData = function (a) { var c = this.$["data-cke-expando"]; return (c = c && e[c]) && a in c ? c[a] : null }; a.removeCustomData = function (a) { var c = this.$["data-cke-expando"], c = c && e[c], d, k; c && (d = c[a], k = a in c, delete c[a]); return k ? d : null }; a.clearCustomData = function () {
                this.removeAllListeners(); var a =
                    this.$["data-cke-expando"]; a && delete e[a]
            }; a.getUniqueId = function () { return this.$["data-cke-expando"] || (this.$["data-cke-expando"] = CKEDITOR.tools.getNextNumber()) }; CKEDITOR.event.implementOn(a)
        }(CKEDITOR.dom.domObject.prototype), CKEDITOR.dom.node = function (a) {
            return a ? new CKEDITOR.dom[a.nodeType == CKEDITOR.NODE_DOCUMENT ? "document" : a.nodeType == CKEDITOR.NODE_ELEMENT ? "element" : a.nodeType == CKEDITOR.NODE_TEXT ? "text" : a.nodeType == CKEDITOR.NODE_COMMENT ? "comment" : a.nodeType == CKEDITOR.NODE_DOCUMENT_FRAGMENT ?
                "documentFragment" : "domObject"](a) : this
        }, CKEDITOR.dom.node.prototype = new CKEDITOR.dom.domObject, CKEDITOR.NODE_ELEMENT = 1, CKEDITOR.NODE_DOCUMENT = 9, CKEDITOR.NODE_TEXT = 3, CKEDITOR.NODE_COMMENT = 8, CKEDITOR.NODE_DOCUMENT_FRAGMENT = 11, CKEDITOR.POSITION_IDENTICAL = 0, CKEDITOR.POSITION_DISCONNECTED = 1, CKEDITOR.POSITION_FOLLOWING = 2, CKEDITOR.POSITION_PRECEDING = 4, CKEDITOR.POSITION_IS_CONTAINED = 8, CKEDITOR.POSITION_CONTAINS = 16, CKEDITOR.tools.extend(CKEDITOR.dom.node.prototype, {
            appendTo: function (a, e) {
                a.append(this, e);
                return a
            }, clone: function (a, e) {
                function b(c) { c["data-cke-expando"] && (c["data-cke-expando"] = !1); if (c.nodeType == CKEDITOR.NODE_ELEMENT || c.nodeType == CKEDITOR.NODE_DOCUMENT_FRAGMENT) if (e || c.nodeType != CKEDITOR.NODE_ELEMENT || c.removeAttribute("id", !1), a) { c = c.childNodes; for (var d = 0; d < c.length; d++)b(c[d]) } } function c(b) {
                    if (b.type == CKEDITOR.NODE_ELEMENT || b.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT) {
                        if (b.type != CKEDITOR.NODE_DOCUMENT_FRAGMENT) { var d = b.getName(); ":" == d[0] && b.renameNode(d.substring(1)) } if (a) for (d = 0; d <
                            b.getChildCount(); d++)c(b.getChild(d))
                    }
                } var d = this.$.cloneNode(a); b(d); d = new CKEDITOR.dom.node(d); CKEDITOR.env.ie && 9 > CKEDITOR.env.version && (this.type == CKEDITOR.NODE_ELEMENT || this.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT) && c(d); return d
            }, hasPrevious: function () { return !!this.$.previousSibling }, hasNext: function () { return !!this.$.nextSibling }, insertAfter: function (a) { a.$.parentNode.insertBefore(this.$, a.$.nextSibling); return a }, insertBefore: function (a) { a.$.parentNode.insertBefore(this.$, a.$); return a }, insertBeforeMe: function (a) {
                this.$.parentNode.insertBefore(a.$,
                    this.$); return a
            }, getAddress: function (a) { for (var e = [], b = this.getDocument().$.documentElement, c = this.$; c && c != b;) { var d = c.parentNode; d && e.unshift(this.getIndex.call({ $: c }, a)); c = d } return e }, getDocument: function () { return new CKEDITOR.dom.document(this.$.ownerDocument || this.$.parentNode.ownerDocument) }, getIndex: function (a) {
                function e(a, f) { var h = f ? a.nextSibling : a.previousSibling; return h && h.nodeType == CKEDITOR.NODE_TEXT ? b(h) ? e(h, f) : h : null } function b(a) { return !a.nodeValue || a.nodeValue == CKEDITOR.dom.selection.FILLING_CHAR_SEQUENCE }
                var c = this.$, d = -1, k; if (!this.$.parentNode || a && c.nodeType == CKEDITOR.NODE_TEXT && b(c) && !e(c) && !e(c, !0)) return -1; do a && c != this.$ && c.nodeType == CKEDITOR.NODE_TEXT && (k || b(c)) || (d++, k = c.nodeType == CKEDITOR.NODE_TEXT); while (c = c.previousSibling); return d
            }, getNextSourceNode: function (a, e, b) {
                if (b && !b.call) { var c = b; b = function (a) { return !a.equals(c) } } a = !a && this.getFirst && this.getFirst(); var d; if (!a) { if (this.type == CKEDITOR.NODE_ELEMENT && b && !1 === b(this, !0)) return null; a = this.getNext() } for (; !a && (d = (d || this).getParent());) {
                    if (b &&
                        !1 === b(d, !0)) return null; a = d.getNext()
                } return !a || b && !1 === b(a) ? null : e && e != a.type ? a.getNextSourceNode(!1, e, b) : a
            }, getPreviousSourceNode: function (a, e, b) {
                if (b && !b.call) { var c = b; b = function (a) { return !a.equals(c) } } a = !a && this.getLast && this.getLast(); var d; if (!a) { if (this.type == CKEDITOR.NODE_ELEMENT && b && !1 === b(this, !0)) return null; a = this.getPrevious() } for (; !a && (d = (d || this).getParent());) { if (b && !1 === b(d, !0)) return null; a = d.getPrevious() } return !a || b && !1 === b(a) ? null : e && a.type != e ? a.getPreviousSourceNode(!1, e, b) :
                    a
            }, getPrevious: function (a) { var e = this.$, b; do b = (e = e.previousSibling) && 10 != e.nodeType && new CKEDITOR.dom.node(e); while (b && a && !a(b)); return b }, getNext: function (a) { var e = this.$, b; do b = (e = e.nextSibling) && new CKEDITOR.dom.node(e); while (b && a && !a(b)); return b }, getParent: function (a) { var e = this.$.parentNode; return e && (e.nodeType == CKEDITOR.NODE_ELEMENT || a && e.nodeType == CKEDITOR.NODE_DOCUMENT_FRAGMENT) ? new CKEDITOR.dom.node(e) : null }, getParents: function (a) {
                var e = this, b = []; do b[a ? "push" : "unshift"](e); while (e = e.getParent());
                return b
            }, getCommonAncestor: function (a) { if (a.equals(this)) return this; if (a.contains && a.contains(this)) return a; var e = this.contains ? this : this.getParent(); do if (e.contains(a)) return e; while (e = e.getParent()); return null }, getPosition: function (a) {
                var e = this.$, b = a.$; if (e.compareDocumentPosition) return e.compareDocumentPosition(b); if (e == b) return CKEDITOR.POSITION_IDENTICAL; if (this.type == CKEDITOR.NODE_ELEMENT && a.type == CKEDITOR.NODE_ELEMENT) {
                    if (e.contains) {
                        if (e.contains(b)) return CKEDITOR.POSITION_CONTAINS +
                            CKEDITOR.POSITION_PRECEDING; if (b.contains(e)) return CKEDITOR.POSITION_IS_CONTAINED + CKEDITOR.POSITION_FOLLOWING
                    } if ("sourceIndex" in e) return 0 > e.sourceIndex || 0 > b.sourceIndex ? CKEDITOR.POSITION_DISCONNECTED : e.sourceIndex < b.sourceIndex ? CKEDITOR.POSITION_PRECEDING : CKEDITOR.POSITION_FOLLOWING
                } e = this.getAddress(); a = a.getAddress(); for (var b = Math.min(e.length, a.length), c = 0; c < b; c++)if (e[c] != a[c]) return e[c] < a[c] ? CKEDITOR.POSITION_PRECEDING : CKEDITOR.POSITION_FOLLOWING; return e.length < a.length ? CKEDITOR.POSITION_CONTAINS +
                    CKEDITOR.POSITION_PRECEDING : CKEDITOR.POSITION_IS_CONTAINED + CKEDITOR.POSITION_FOLLOWING
            }, getAscendant: function (a, e) { var b = this.$, c, d; e || (b = b.parentNode); "function" == typeof a ? (d = !0, c = a) : (d = !1, c = function (b) { b = "string" == typeof b.nodeName ? b.nodeName.toLowerCase() : ""; return "string" == typeof a ? b == a : b in a }); for (; b;) { if (c(d ? new CKEDITOR.dom.node(b) : b)) return new CKEDITOR.dom.node(b); try { b = b.parentNode } catch (k) { b = null } } return null }, hasAscendant: function (a, e) {
                var b = this.$; e || (b = b.parentNode); for (; b;) {
                    if (b.nodeName &&
                        b.nodeName.toLowerCase() == a) return !0; b = b.parentNode
                } return !1
            }, move: function (a, e) { a.append(this.remove(), e) }, remove: function (a) { var e = this.$, b = e.parentNode; if (b) { if (a) for (; a = e.firstChild;)b.insertBefore(e.removeChild(a), e); b.removeChild(e) } return this }, replace: function (a) { this.insertBefore(a); a.remove() }, trim: function () { this.ltrim(); this.rtrim() }, ltrim: function () {
                for (var a; this.getFirst && (a = this.getFirst());) {
                    if (a.type == CKEDITOR.NODE_TEXT) {
                        var e = CKEDITOR.tools.ltrim(a.getText()), b = a.getLength(); if (e) e.length <
                            b && (a.split(b - e.length), this.$.removeChild(this.$.firstChild)); else { a.remove(); continue }
                    } break
                }
            }, rtrim: function () { for (var a; this.getLast && (a = this.getLast());) { if (a.type == CKEDITOR.NODE_TEXT) { var e = CKEDITOR.tools.rtrim(a.getText()), b = a.getLength(); if (e) e.length < b && (a.split(e.length), this.$.lastChild.parentNode.removeChild(this.$.lastChild)); else { a.remove(); continue } } break } CKEDITOR.env.needsBrFiller && (a = this.$.lastChild) && 1 == a.type && "br" == a.nodeName.toLowerCase() && a.parentNode.removeChild(a) }, isReadOnly: function (a) {
                var e =
                    this; this.type != CKEDITOR.NODE_ELEMENT && (e = this.getParent()); CKEDITOR.env.edge && e && e.is("textarea", "input") && (a = !0); if (!a && e && "undefined" != typeof e.$.isContentEditable) return !(e.$.isContentEditable || e.data("cke-editable")); for (; e;) { if (e.data("cke-editable")) return !1; if (e.hasAttribute("contenteditable")) return "false" == e.getAttribute("contenteditable"); e = e.getParent() } return !0
            }
        }), CKEDITOR.dom.window = function (a) { CKEDITOR.dom.domObject.call(this, a) }, CKEDITOR.dom.window.prototype = new CKEDITOR.dom.domObject,
        CKEDITOR.tools.extend(CKEDITOR.dom.window.prototype, {
            focus: function () { this.$.focus() }, getViewPaneSize: function () { var a = this.$.document, e = "CSS1Compat" == a.compatMode; return { width: (e ? a.documentElement.clientWidth : a.body.clientWidth) || 0, height: (e ? a.documentElement.clientHeight : a.body.clientHeight) || 0 } }, getScrollPosition: function () {
                var a = this.$; if ("pageXOffset" in a) return { x: a.pageXOffset || 0, y: a.pageYOffset || 0 }; a = a.document; return {
                    x: a.documentElement.scrollLeft || a.body.scrollLeft || 0, y: a.documentElement.scrollTop ||
                        a.body.scrollTop || 0
                }
            }, getFrame: function () { var a = this.$.frameElement; return a ? new CKEDITOR.dom.element.get(a) : null }
        }), CKEDITOR.dom.document = function (a) { CKEDITOR.dom.domObject.call(this, a) }, CKEDITOR.dom.document.prototype = new CKEDITOR.dom.domObject, CKEDITOR.tools.extend(CKEDITOR.dom.document.prototype, {
            type: CKEDITOR.NODE_DOCUMENT, appendStyleSheet: function (a) {
                if (this.$.createStyleSheet) this.$.createStyleSheet(a); else {
                    var e = new CKEDITOR.dom.element("link"); e.setAttributes({
                        rel: "stylesheet", type: "text/css",
                        href: a
                    }); this.getHead().append(e)
                }
            }, appendStyleText: function (a) { if (this.$.createStyleSheet) { var e = this.$.createStyleSheet(""); e.cssText = a } else { var b = new CKEDITOR.dom.element("style", this); b.append(new CKEDITOR.dom.text(a, this)); this.getHead().append(b) } return e || b.$.sheet }, createElement: function (a, e) { var b = new CKEDITOR.dom.element(a, this); e && (e.attributes && b.setAttributes(e.attributes), e.styles && b.setStyles(e.styles)); return b }, createText: function (a) { return new CKEDITOR.dom.text(a, this) }, focus: function () { this.getWindow().focus() },
            getActive: function () { var a; try { a = this.$.activeElement } catch (e) { return null } return new CKEDITOR.dom.element(a) }, getById: function (a) { return (a = this.$.getElementById(a)) ? new CKEDITOR.dom.element(a) : null }, getByAddress: function (a, e) {
                for (var b = this.$.documentElement, c = 0; b && c < a.length; c++) { var d = a[c]; if (e) for (var k = -1, m = 0; m < b.childNodes.length; m++) { var f = b.childNodes[m]; if (!0 !== e || 3 != f.nodeType || !f.previousSibling || 3 != f.previousSibling.nodeType) if (k++, k == d) { b = f; break } } else b = b.childNodes[d] } return b ? new CKEDITOR.dom.node(b) :
                    null
            }, getElementsByTag: function (a, e) { CKEDITOR.env.ie && 8 >= document.documentMode || !e || (a = e + ":" + a); return new CKEDITOR.dom.nodeList(this.$.getElementsByTagName(a)) }, getHead: function () { var a = this.$.getElementsByTagName("head")[0]; return a = a ? new CKEDITOR.dom.element(a) : this.getDocumentElement().append(new CKEDITOR.dom.element("head"), !0) }, getBody: function () { return new CKEDITOR.dom.element(this.$.body) }, getDocumentElement: function () { return new CKEDITOR.dom.element(this.$.documentElement) }, getWindow: function () {
                return new CKEDITOR.dom.window(this.$.parentWindow ||
                    this.$.defaultView)
            }, write: function (a) { this.$.open("text/html", "replace"); CKEDITOR.env.ie && (a = a.replace(/(?:^\s*<!DOCTYPE[^>]*?>)|^/i, '$\x26\n\x3cscript data-cke-temp\x3d"1"\x3e(' + CKEDITOR.tools.fixDomain + ")();\x3c/script\x3e")); this.$.write(a); this.$.close() }, find: function (a) { return new CKEDITOR.dom.nodeList(this.$.querySelectorAll(a)) }, findOne: function (a) { return (a = this.$.querySelector(a)) ? new CKEDITOR.dom.element(a) : null }, _getHtml5ShivFrag: function () {
                var a = this.getCustomData("html5ShivFrag"); a ||
                    (a = this.$.createDocumentFragment(), CKEDITOR.tools.enableHtml5Elements(a, !0), this.setCustomData("html5ShivFrag", a)); return a
            }
        }), CKEDITOR.dom.nodeList = function (a) { this.$ = a }, CKEDITOR.dom.nodeList.prototype = { count: function () { return this.$.length }, getItem: function (a) { return 0 > a || a >= this.$.length ? null : (a = this.$[a]) ? new CKEDITOR.dom.node(a) : null } }, CKEDITOR.dom.element = function (a, e) { "string" == typeof a && (a = (e ? e.$ : document).createElement(a)); CKEDITOR.dom.domObject.call(this, a) }, CKEDITOR.dom.element.get = function (a) {
            return (a =
                "string" == typeof a ? document.getElementById(a) || document.getElementsByName(a)[0] : a) && (a.$ ? a : new CKEDITOR.dom.element(a))
        }, CKEDITOR.dom.element.prototype = new CKEDITOR.dom.node, CKEDITOR.dom.element.createFromHtml = function (a, e) { var b = new CKEDITOR.dom.element("div", e); b.setHtml(a); return b.getFirst().remove() }, CKEDITOR.dom.element.setMarker = function (a, e, b, c) {
            var d = e.getCustomData("list_marker_id") || e.setCustomData("list_marker_id", CKEDITOR.tools.getNextNumber()).getCustomData("list_marker_id"), k = e.getCustomData("list_marker_names") ||
                e.setCustomData("list_marker_names", {}).getCustomData("list_marker_names"); a[d] = e; k[b] = 1; return e.setCustomData(b, c)
        }, CKEDITOR.dom.element.clearAllMarkers = function (a) { for (var e in a) CKEDITOR.dom.element.clearMarkers(a, a[e], 1) }, CKEDITOR.dom.element.clearMarkers = function (a, e, b) { var c = e.getCustomData("list_marker_names"), d = e.getCustomData("list_marker_id"), k; for (k in c) e.removeCustomData(k); e.removeCustomData("list_marker_names"); b && (e.removeCustomData("list_marker_id"), delete a[d]) }, function () {
            function a(a,
                b) { return -1 < (" " + a + " ").replace(k, " ").indexOf(" " + b + " ") } function e(a) { var b = !0; a.$.id || (a.$.id = "cke_tmp_" + CKEDITOR.tools.getNextNumber(), b = !1); return function () { b || a.removeAttribute("id") } } function b(a, b) { var c = CKEDITOR.tools.escapeCss(a.$.id); return "#" + c + " " + b.split(/,\s*/).join(", #" + c + " ") } function c(a) { for (var b = 0, c = 0, g = m[a].length; c < g; c++)b += parseInt(this.getComputedStyle(m[a][c]) || 0, 10) || 0; return b } var d = document.createElement("_").classList, d = "undefined" !== typeof d && null !== String(d.add).match(/\[Native code\]/gi),
                    k = /[\n\t\r]/g; CKEDITOR.tools.extend(CKEDITOR.dom.element.prototype, {
                        type: CKEDITOR.NODE_ELEMENT, addClass: d ? function (a) { this.$.classList.add(a); return this } : function (f) { var b = this.$.className; b && (a(b, f) || (b += " " + f)); this.$.className = b || f; return this }, removeClass: d ? function (a) { var b = this.$; b.classList.remove(a); b.className || b.removeAttribute("class"); return this } : function (f) {
                            var b = this.getAttribute("class"); b && a(b, f) && ((b = b.replace(new RegExp("(?:^|\\s+)" + f + "(?\x3d\\s|$)"), "").replace(/^\s+/, "")) ? this.setAttribute("class",
                                b) : this.removeAttribute("class")); return this
                        }, hasClass: function (f) { return a(this.$.className, f) }, append: function (a, b) { "string" == typeof a && (a = this.getDocument().createElement(a)); b ? this.$.insertBefore(a.$, this.$.firstChild) : this.$.appendChild(a.$); return a }, appendHtml: function (a) { if (this.$.childNodes.length) { var b = new CKEDITOR.dom.element("div", this.getDocument()); b.setHtml(a); b.moveChildren(this) } else this.setHtml(a) }, appendText: function (a) {
                            null != this.$.text && CKEDITOR.env.ie && 9 > CKEDITOR.env.version ?
                            this.$.text += a : this.append(new CKEDITOR.dom.text(a))
                        }, appendBogus: function (a) { if (a || CKEDITOR.env.needsBrFiller) { for (a = this.getLast(); a && a.type == CKEDITOR.NODE_TEXT && !CKEDITOR.tools.rtrim(a.getText());)a = a.getPrevious(); a && a.is && a.is("br") || (a = this.getDocument().createElement("br"), CKEDITOR.env.gecko && a.setAttribute("type", "_moz"), this.append(a)) } }, breakParent: function (a, b) {
                            var c = new CKEDITOR.dom.range(this.getDocument()); c.setStartAfter(this); c.setEndAfter(a); var g = c.extractContents(!1, b || !1), d; c.insertNode(this.remove());
                            if (CKEDITOR.env.ie && !CKEDITOR.env.edge) { for (c = new CKEDITOR.dom.element("div"); d = g.getFirst();)d.$.style.backgroundColor && (d.$.style.backgroundColor = d.$.style.backgroundColor), c.append(d); c.insertAfter(this); c.remove(!0) } else g.insertAfterNode(this)
                        }, contains: document.compareDocumentPosition ? function (a) { return !!(this.$.compareDocumentPosition(a.$) & 16) } : function (a) { var b = this.$; return a.type != CKEDITOR.NODE_ELEMENT ? b.contains(a.getParent().$) : b != a.$ && b.contains(a.$) }, focus: function () {
                            function a() { try { this.$.focus() } catch (b) { } }
                            return function (b) { b ? CKEDITOR.tools.setTimeout(a, 100, this) : a.call(this) }
                        }(), getHtml: function () { var a = this.$.innerHTML; return CKEDITOR.env.ie ? a.replace(/<\?[^>]*>/g, "") : a }, getOuterHtml: function () { if (this.$.outerHTML) return this.$.outerHTML.replace(/<\?[^>]*>/, ""); var a = this.$.ownerDocument.createElement("div"); a.appendChild(this.$.cloneNode(!0)); return a.innerHTML }, getClientRect: function () {
                            var a = CKEDITOR.tools.extend({}, this.$.getBoundingClientRect()); !a.width && (a.width = a.right - a.left); !a.height &&
                                (a.height = a.bottom - a.top); return a
                        }, setHtml: CKEDITOR.env.ie && 9 > CKEDITOR.env.version ? function (a) { try { var b = this.$; if (this.getParent()) return b.innerHTML = a; var c = this.getDocument()._getHtml5ShivFrag(); c.appendChild(b); b.innerHTML = a; c.removeChild(b); return a } catch (g) { this.$.innerHTML = ""; b = new CKEDITOR.dom.element("body", this.getDocument()); b.$.innerHTML = a; for (b = b.getChildren(); b.count();)this.append(b.getItem(0)); return a } } : function (a) { return this.$.innerHTML = a }, setText: function () {
                            var a = document.createElement("p");
                            a.innerHTML = "x"; a = a.textContent; return function (b) { this.$[a ? "textContent" : "innerText"] = b }
                        }(), getAttribute: function () {
                            var a = function (a) { return this.$.getAttribute(a, 2) }; return CKEDITOR.env.ie && (CKEDITOR.env.ie7Compat || CKEDITOR.env.quirks) ? function (a) {
                                switch (a) {
                                    case "class": a = "className"; break; case "http-equiv": a = "httpEquiv"; break; case "name": return this.$.name; case "tabindex": return a = this.$.getAttribute(a, 2), 0 !== a && 0 === this.$.tabIndex && (a = null), a; case "checked": return a = this.$.attributes.getNamedItem(a),
                                        (a.specified ? a.nodeValue : this.$.checked) ? "checked" : null; case "hspace": case "value": return this.$[a]; case "style": return this.$.style.cssText; case "contenteditable": case "contentEditable": return this.$.attributes.getNamedItem("contentEditable").specified ? this.$.getAttribute("contentEditable") : null
                                }return this.$.getAttribute(a, 2)
                            } : a
                        }(), getAttributes: function (a) {
                            var b = {}, c = this.$.attributes, g; a = CKEDITOR.tools.isArray(a) ? a : []; for (g = 0; g < c.length; g++)-1 === CKEDITOR.tools.indexOf(a, c[g].name) && (b[c[g].name] =
                                c[g].value); return b
                        }, getChildren: function () { return new CKEDITOR.dom.nodeList(this.$.childNodes) }, getComputedStyle: document.defaultView && document.defaultView.getComputedStyle ? function (a) { var b = this.getWindow().$.getComputedStyle(this.$, null); return b ? b.getPropertyValue(a) : "" } : function (a) { return this.$.currentStyle[CKEDITOR.tools.cssStyleToDomStyle(a)] }, getDtd: function () { var a = CKEDITOR.dtd[this.getName()]; this.getDtd = function () { return a }; return a }, getElementsByTag: CKEDITOR.dom.document.prototype.getElementsByTag,
                        getTabIndex: function () { var a = this.$.tabIndex; return 0 !== a || CKEDITOR.dtd.$tabIndex[this.getName()] || 0 === parseInt(this.getAttribute("tabindex"), 10) ? a : -1 }, getText: function () { return this.$.textContent || this.$.innerText || "" }, getWindow: function () { return this.getDocument().getWindow() }, getId: function () { return this.$.id || null }, getNameAtt: function () { return this.$.name || null }, getName: function () {
                            var a = this.$.nodeName.toLowerCase(); if (CKEDITOR.env.ie && 8 >= document.documentMode) {
                                var b = this.$.scopeName; "HTML" !=
                                    b && (a = b.toLowerCase() + ":" + a)
                            } this.getName = function () { return a }; return this.getName()
                        }, getValue: function () { return this.$.value }, getFirst: function (a) { var b = this.$.firstChild; (b = b && new CKEDITOR.dom.node(b)) && a && !a(b) && (b = b.getNext(a)); return b }, getLast: function (a) { var b = this.$.lastChild; (b = b && new CKEDITOR.dom.node(b)) && a && !a(b) && (b = b.getPrevious(a)); return b }, getStyle: function (a) { return this.$.style[CKEDITOR.tools.cssStyleToDomStyle(a)] }, is: function () {
                            var a = this.getName(); if ("object" == typeof arguments[0]) return !!arguments[0][a];
                            for (var b = 0; b < arguments.length; b++)if (arguments[b] == a) return !0; return !1
                        }, isEditable: function (a) { var b = this.getName(); return this.isReadOnly() || "none" == this.getComputedStyle("display") || "hidden" == this.getComputedStyle("visibility") || CKEDITOR.dtd.$nonEditable[b] || CKEDITOR.dtd.$empty[b] || this.is("a") && (this.data("cke-saved-name") || this.hasAttribute("name")) && !this.getChildCount() ? !1 : !1 !== a ? (a = CKEDITOR.dtd[b] || CKEDITOR.dtd.span, !(!a || !a["#"])) : !0 }, isIdentical: function (a) {
                            var b = this.clone(0, 1); a = a.clone(0,
                                1); b.removeAttributes(["_moz_dirty", "data-cke-expando", "data-cke-saved-href", "data-cke-saved-name"]); a.removeAttributes(["_moz_dirty", "data-cke-expando", "data-cke-saved-href", "data-cke-saved-name"]); if (b.$.isEqualNode) return b.$.style.cssText = CKEDITOR.tools.normalizeCssText(b.$.style.cssText), a.$.style.cssText = CKEDITOR.tools.normalizeCssText(a.$.style.cssText), b.$.isEqualNode(a.$); b = b.getOuterHtml(); a = a.getOuterHtml(); if (CKEDITOR.env.ie && 9 > CKEDITOR.env.version && this.is("a")) {
                                    var c = this.getParent();
                                    c.type == CKEDITOR.NODE_ELEMENT && (c = c.clone(), c.setHtml(b), b = c.getHtml(), c.setHtml(a), a = c.getHtml())
                                } return b == a
                        }, isVisible: function () { var a = (this.$.offsetHeight || this.$.offsetWidth) && "hidden" != this.getComputedStyle("visibility"), b, c; a && CKEDITOR.env.webkit && (b = this.getWindow(), !b.equals(CKEDITOR.document.getWindow()) && (c = b.$.frameElement) && (a = (new CKEDITOR.dom.element(c)).isVisible())); return !!a }, isEmptyInlineRemoveable: function () {
                            if (!CKEDITOR.dtd.$removeEmpty[this.getName()]) return !1; for (var a = this.getChildren(),
                                b = 0, c = a.count(); b < c; b++) { var g = a.getItem(b); if (g.type != CKEDITOR.NODE_ELEMENT || !g.data("cke-bookmark")) if (g.type == CKEDITOR.NODE_ELEMENT && !g.isEmptyInlineRemoveable() || g.type == CKEDITOR.NODE_TEXT && CKEDITOR.tools.trim(g.getText())) return !1 } return !0
                        }, hasAttributes: CKEDITOR.env.ie && (CKEDITOR.env.ie7Compat || CKEDITOR.env.quirks) ? function () { for (var a = this.$.attributes, b = 0; b < a.length; b++) { var c = a[b]; switch (c.nodeName) { case "class": if (this.getAttribute("class")) return !0; case "data-cke-expando": continue; default: if (c.specified) return !0 } } return !1 } :
                            function () { var a = this.$.attributes, b = a.length, c = { "data-cke-expando": 1, _moz_dirty: 1 }; return 0 < b && (2 < b || !c[a[0].nodeName] || 2 == b && !c[a[1].nodeName]) }, hasAttribute: function () {
                                function a(b) { var f = this.$.attributes.getNamedItem(b); if ("input" == this.getName()) switch (b) { case "class": return 0 < this.$.className.length; case "checked": return !!this.$.checked; case "value": return b = this.getAttribute("type"), "checkbox" == b || "radio" == b ? "on" != this.$.value : !!this.$.value }return f ? f.specified : !1 } return CKEDITOR.env.ie ?
                                    8 > CKEDITOR.env.version ? function (b) { return "name" == b ? !!this.$.name : a.call(this, b) } : a : function (a) { return !!this.$.attributes.getNamedItem(a) }
                            }(), hide: function () { this.setStyle("display", "none") }, moveChildren: function (a, b) { var c = this.$; a = a.$; if (c != a) { var g; if (b) for (; g = c.lastChild;)a.insertBefore(c.removeChild(g), a.firstChild); else for (; g = c.firstChild;)a.appendChild(c.removeChild(g)) } }, mergeSiblings: function () {
                                function a(b, f, g) {
                                    if (f && f.type == CKEDITOR.NODE_ELEMENT) {
                                        for (var c = []; f.data("cke-bookmark") || f.isEmptyInlineRemoveable();)if (c.push(f),
                                            f = g ? f.getNext() : f.getPrevious(), !f || f.type != CKEDITOR.NODE_ELEMENT) return; if (b.isIdentical(f)) { for (var d = g ? b.getLast() : b.getFirst(); c.length;)c.shift().move(b, !g); f.moveChildren(b, !g); f.remove(); d && d.type == CKEDITOR.NODE_ELEMENT && d.mergeSiblings() }
                                    }
                                } return function (b) { if (!1 === b || CKEDITOR.dtd.$removeEmpty[this.getName()] || this.is("a")) a(this, this.getNext(), !0), a(this, this.getPrevious()) }
                            }(), show: function () { this.setStyles({ display: "", visibility: "" }) }, setAttribute: function () {
                                var a = function (a, b) {
                                    this.$.setAttribute(a,
                                        b); return this
                                }; return CKEDITOR.env.ie && (CKEDITOR.env.ie7Compat || CKEDITOR.env.quirks) ? function (b, c) { "class" == b ? this.$.className = c : "style" == b ? this.$.style.cssText = c : "tabindex" == b ? this.$.tabIndex = c : "checked" == b ? this.$.checked = c : "contenteditable" == b ? a.call(this, "contentEditable", c) : a.apply(this, arguments); return this } : CKEDITOR.env.ie8Compat && CKEDITOR.env.secure ? function (b, c) { if ("src" == b && c.match(/^http:\/\//)) try { a.apply(this, arguments) } catch (g) { } else a.apply(this, arguments); return this } : a
                            }(), setAttributes: function (a) {
                                for (var b in a) this.setAttribute(b,
                                    a[b]); return this
                            }, setValue: function (a) { this.$.value = a; return this }, removeAttribute: function () { var a = function (a) { this.$.removeAttribute(a) }; return CKEDITOR.env.ie && (CKEDITOR.env.ie7Compat || CKEDITOR.env.quirks) ? function (a) { "class" == a ? a = "className" : "tabindex" == a ? a = "tabIndex" : "contenteditable" == a && (a = "contentEditable"); this.$.removeAttribute(a) } : a }(), removeAttributes: function (a) {
                                if (CKEDITOR.tools.isArray(a)) for (var b = 0; b < a.length; b++)this.removeAttribute(a[b]); else for (b in a = a || this.getAttributes(),
                                    a) a.hasOwnProperty(b) && this.removeAttribute(b)
                            }, removeStyle: function (a) {
                                var b = this.$.style; if (b.removeProperty || "border" != a && "margin" != a && "padding" != a) b.removeProperty ? b.removeProperty(a) : b.removeAttribute(CKEDITOR.tools.cssStyleToDomStyle(a)), this.$.style.cssText || this.removeAttribute("style"); else {
                                    var c = ["top", "left", "right", "bottom"], g; "border" == a && (g = ["color", "style", "width"]); for (var b = [], d = 0; d < c.length; d++)if (g) for (var e = 0; e < g.length; e++)b.push([a, c[d], g[e]].join("-")); else b.push([a, c[d]].join("-"));
                                    for (a = 0; a < b.length; a++)this.removeStyle(b[a])
                                }
                            }, setStyle: function (a, b) { this.$.style[CKEDITOR.tools.cssStyleToDomStyle(a)] = b; return this }, setStyles: function (a) { for (var b in a) this.setStyle(b, a[b]); return this }, setOpacity: function (a) { CKEDITOR.env.ie && 9 > CKEDITOR.env.version ? (a = Math.round(100 * a), this.setStyle("filter", 100 <= a ? "" : "progid:DXImageTransform.Microsoft.Alpha(opacity\x3d" + a + ")")) : this.setStyle("opacity", a) }, unselectable: function () {
                                this.setStyles(CKEDITOR.tools.cssVendorPrefix("user-select", "none"));
                                if (CKEDITOR.env.ie) { this.setAttribute("unselectable", "on"); for (var a, b = this.getElementsByTag("*"), c = 0, g = b.count(); c < g; c++)a = b.getItem(c), a.setAttribute("unselectable", "on") }
                            }, getPositionedAncestor: function () { for (var a = this; "html" != a.getName();) { if ("static" != a.getComputedStyle("position")) return a; a = a.getParent() } return null }, getDocumentPosition: function (a) {
                                var b = 0, c = 0, g = this.getDocument(), d = g.getBody(), e = "BackCompat" == g.$.compatMode; if (document.documentElement.getBoundingClientRect && (CKEDITOR.env.ie ?
                                    8 !== CKEDITOR.env.version : 1)) { var k = this.$.getBoundingClientRect(), m = g.$.documentElement, t = m.clientTop || d.$.clientTop || 0, p = m.clientLeft || d.$.clientLeft || 0, y = !0; CKEDITOR.env.ie && (y = g.getDocumentElement().contains(this), g = g.getBody().contains(this), y = e && g || !e && y); y && (CKEDITOR.env.webkit || CKEDITOR.env.ie && 12 <= CKEDITOR.env.version ? (b = d.$.scrollLeft || m.scrollLeft, c = d.$.scrollTop || m.scrollTop) : (c = e ? d.$ : m, b = c.scrollLeft, c = c.scrollTop), b = k.left + b - p, c = k.top + c - t) } else for (t = this, p = null; t && "body" != t.getName() &&
                                        "html" != t.getName();) { b += t.$.offsetLeft - t.$.scrollLeft; c += t.$.offsetTop - t.$.scrollTop; t.equals(this) || (b += t.$.clientLeft || 0, c += t.$.clientTop || 0); for (; p && !p.equals(t);)b -= p.$.scrollLeft, c -= p.$.scrollTop, p = p.getParent(); p = t; t = (k = t.$.offsetParent) ? new CKEDITOR.dom.element(k) : null } a && (k = this.getWindow(), t = a.getWindow(), !k.equals(t) && k.$.frameElement && (a = (new CKEDITOR.dom.element(k.$.frameElement)).getDocumentPosition(a), b += a.x, c += a.y)); document.documentElement.getBoundingClientRect || !CKEDITOR.env.gecko ||
                                            e || (b += this.$.clientLeft ? 1 : 0, c += this.$.clientTop ? 1 : 0); return { x: b, y: c }
                            }, scrollIntoView: function (a) { var b = this.getParent(); if (b) { do if ((b.$.clientWidth && b.$.clientWidth < b.$.scrollWidth || b.$.clientHeight && b.$.clientHeight < b.$.scrollHeight) && !b.is("body") && this.scrollIntoParent(b, a, 1), b.is("html")) { var c = b.getWindow(); try { var g = c.$.frameElement; g && (b = new CKEDITOR.dom.element(g)) } catch (d) { } } while (b = b.getParent()) } }, scrollIntoParent: function (a, b, c) {
                                var g, d, e, k; function m(b, g) {
                                    /body|html/.test(a.getName()) ?
                                    a.getWindow().$.scrollBy(b, g) : (a.$.scrollLeft += b, a.$.scrollTop += g)
                                } function t(a, b) { var g = { x: 0, y: 0 }; if (!a.is(y ? "body" : "html")) { var c = a.$.getBoundingClientRect(); g.x = c.left; g.y = c.top } c = a.getWindow(); c.equals(b) || (c = t(CKEDITOR.dom.element.get(c.$.frameElement), b), g.x += c.x, g.y += c.y); return g } function p(a, b) { return parseInt(a.getComputedStyle("margin-" + b) || 0, 10) || 0 } !a && (a = this.getWindow()); e = a.getDocument(); var y = "BackCompat" == e.$.compatMode; a instanceof CKEDITOR.dom.window && (a = y ? e.getBody() : e.getDocumentElement());
                                e = a.getWindow(); d = t(this, e); var A = t(a, e), z = this.$.offsetHeight; g = this.$.offsetWidth; var r = a.$.clientHeight, w = a.$.clientWidth; e = d.x - p(this, "left") - A.x || 0; k = d.y - p(this, "top") - A.y || 0; g = d.x + g + p(this, "right") - (A.x + w) || 0; d = d.y + z + p(this, "bottom") - (A.y + r) || 0; (0 > k || 0 < d) && m(0, !0 === b ? k : !1 === b ? d : 0 > k ? k : d); c && (0 > e || 0 < g) && m(0 > e ? e : g, 0)
                            }, setState: function (a, b, c) {
                                b = b || "cke"; switch (a) {
                                    case CKEDITOR.TRISTATE_ON: this.addClass(b + "_on"); this.removeClass(b + "_off"); this.removeClass(b + "_disabled"); c && this.setAttribute("aria-pressed",
                                        !0); c && this.removeAttribute("aria-disabled"); break; case CKEDITOR.TRISTATE_DISABLED: this.addClass(b + "_disabled"); this.removeClass(b + "_off"); this.removeClass(b + "_on"); c && this.setAttribute("aria-disabled", !0); c && this.removeAttribute("aria-pressed"); break; default: this.addClass(b + "_off"), this.removeClass(b + "_on"), this.removeClass(b + "_disabled"), c && this.removeAttribute("aria-pressed"), c && this.removeAttribute("aria-disabled")
                                }
                            }, getFrameDocument: function () {
                                var a = this.$; try { a.contentWindow.document } catch (b) {
                                    a.src =
                                    a.src
                                } return a && new CKEDITOR.dom.document(a.contentWindow.document)
                            }, copyAttributes: function (a, b) { var c = this.$.attributes; b = b || {}; for (var g = 0; g < c.length; g++) { var d = c[g], e = d.nodeName.toLowerCase(), k; if (!(e in b)) if ("checked" == e && (k = this.getAttribute(e))) a.setAttribute(e, k); else if (!CKEDITOR.env.ie || this.hasAttribute(e)) k = this.getAttribute(e), null === k && (k = d.nodeValue), a.setAttribute(e, k) } "" !== this.$.style.cssText && (a.$.style.cssText = this.$.style.cssText) }, renameNode: function (a) {
                                if (this.getName() != a) {
                                    var b =
                                        this.getDocument(); a = new CKEDITOR.dom.element(a, b); this.copyAttributes(a); this.moveChildren(a); this.getParent(!0) && this.$.parentNode.replaceChild(a.$, this.$); a.$["data-cke-expando"] = this.$["data-cke-expando"]; this.$ = a.$; delete this.getName
                                }
                            }, getChild: function () { function a(b, c) { var g = b.childNodes; if (0 <= c && c < g.length) return g[c] } return function (b) { var c = this.$; if (b.slice) for (b = b.slice(); 0 < b.length && c;)c = a(c, b.shift()); else c = a(c, b); return c ? new CKEDITOR.dom.node(c) : null } }(), getChildCount: function () { return this.$.childNodes.length },
                        disableContextMenu: function () { function a(b) { return b.type == CKEDITOR.NODE_ELEMENT && b.hasClass("cke_enable_context_menu") } this.on("contextmenu", function (b) { b.data.getTarget().getAscendant(a, !0) || b.data.preventDefault() }) }, getDirection: function (a) { return a ? this.getComputedStyle("direction") || this.getDirection() || this.getParent() && this.getParent().getDirection(1) || this.getDocument().$.dir || "ltr" : this.getStyle("direction") || this.getAttribute("dir") }, data: function (a, b) {
                            a = "data-" + a; if (void 0 === b) return this.getAttribute(a);
                            !1 === b ? this.removeAttribute(a) : this.setAttribute(a, b); return null
                        }, getEditor: function () { var a = CKEDITOR.instances, b, c; for (b in a) if (c = a[b], c.element.equals(this) && c.elementMode != CKEDITOR.ELEMENT_MODE_APPENDTO) return c; return null }, find: function (a) { var c = e(this); a = new CKEDITOR.dom.nodeList(this.$.querySelectorAll(b(this, a))); c(); return a }, findOne: function (a) { var c = e(this); a = this.$.querySelector(b(this, a)); c(); return a ? new CKEDITOR.dom.element(a) : null }, forEach: function (a, b, c) {
                            if (!(c || b && this.type != b)) var g =
                                a(this); if (!1 !== g) { c = this.getChildren(); for (var d = 0; d < c.count(); d++)g = c.getItem(d), g.type == CKEDITOR.NODE_ELEMENT ? g.forEach(a, b) : b && g.type != b || a(g) }
                        }
                    }); var m = { width: ["border-left-width", "border-right-width", "padding-left", "padding-right"], height: ["border-top-width", "border-bottom-width", "padding-top", "padding-bottom"] }; CKEDITOR.dom.element.prototype.setSize = function (a, b, d) { "number" == typeof b && (!d || CKEDITOR.env.ie && CKEDITOR.env.quirks || (b -= c.call(this, a)), this.setStyle(a, b + "px")) }; CKEDITOR.dom.element.prototype.getSize =
                        function (a, b) { var d = Math.max(this.$["offset" + CKEDITOR.tools.capitalize(a)], this.$["client" + CKEDITOR.tools.capitalize(a)]) || 0; b && (d -= c.call(this, a)); return d }
        }(), CKEDITOR.dom.documentFragment = function (a) { a = a || CKEDITOR.document; this.$ = a.type == CKEDITOR.NODE_DOCUMENT ? a.$.createDocumentFragment() : a }, CKEDITOR.tools.extend(CKEDITOR.dom.documentFragment.prototype, CKEDITOR.dom.element.prototype, {
            type: CKEDITOR.NODE_DOCUMENT_FRAGMENT, insertAfterNode: function (a) { a = a.$; a.parentNode.insertBefore(this.$, a.nextSibling) },
            getHtml: function () { var a = new CKEDITOR.dom.element("div"); this.clone(1, 1).appendTo(a); return a.getHtml().replace(/\s*data-cke-expando=".*?"/g, "") }
        }, !0, { append: 1, appendBogus: 1, clone: 1, getFirst: 1, getHtml: 1, getLast: 1, getParent: 1, getNext: 1, getPrevious: 1, appendTo: 1, moveChildren: 1, insertBefore: 1, insertAfterNode: 1, replace: 1, trim: 1, type: 1, ltrim: 1, rtrim: 1, getDocument: 1, getChildCount: 1, getChild: 1, getChildren: 1 }), function () {
            function a(a, b) {
                var g = this.range; if (this._.end) return null; if (!this._.start) {
                    this._.start =
                    1; if (g.collapsed) return this.end(), null; g.optimize()
                } var c, d = g.startContainer; c = g.endContainer; var f = g.startOffset, l = g.endOffset, h, e = this.guard, n = this.type, k = a ? "getPreviousSourceNode" : "getNextSourceNode"; if (!a && !this._.guardLTR) { var m = c.type == CKEDITOR.NODE_ELEMENT ? c : c.getParent(), B = c.type == CKEDITOR.NODE_ELEMENT ? c.getChild(l) : c.getNext(); this._.guardLTR = function (a, b) { return (!b || !m.equals(a)) && (!B || !a.equals(B)) && (a.type != CKEDITOR.NODE_ELEMENT || !b || !a.equals(g.root)) } } if (a && !this._.guardRTL) {
                    var D =
                        d.type == CKEDITOR.NODE_ELEMENT ? d : d.getParent(), F = d.type == CKEDITOR.NODE_ELEMENT ? f ? d.getChild(f - 1) : null : d.getPrevious(); this._.guardRTL = function (a, b) { return (!b || !D.equals(a)) && (!F || !a.equals(F)) && (a.type != CKEDITOR.NODE_ELEMENT || !b || !a.equals(g.root)) }
                } var E = a ? this._.guardRTL : this._.guardLTR; h = e ? function (a, b) { return !1 === E(a, b) ? !1 : e(a, b) } : E; this.current ? c = this.current[k](!1, n, h) : (a ? c.type == CKEDITOR.NODE_ELEMENT && (c = 0 < l ? c.getChild(l - 1) : !1 === h(c, !0) ? null : c.getPreviousSourceNode(!0, n, h)) : (c = d, c.type == CKEDITOR.NODE_ELEMENT &&
                    ((c = c.getChild(f)) || (c = !1 === h(d, !0) ? null : d.getNextSourceNode(!0, n, h)))), c && !1 === h(c) && (c = null)); for (; c && !this._.end;) { this.current = c; if (!this.evaluator || !1 !== this.evaluator(c)) { if (!b) return c } else if (b && this.evaluator) return !1; c = c[k](!1, n, h) } this.end(); return this.current = null
            } function e(b) { for (var g, c = null; g = a.call(this, b);)c = g; return c } CKEDITOR.dom.walker = CKEDITOR.tools.createClass({
                $: function (a) { this.range = a; this._ = {} }, proto: {
                    end: function () { this._.end = 1 }, next: function () { return a.call(this) }, previous: function () {
                        return a.call(this,
                            1)
                    }, checkForward: function () { return !1 !== a.call(this, 0, 1) }, checkBackward: function () { return !1 !== a.call(this, 1, 1) }, lastForward: function () { return e.call(this) }, lastBackward: function () { return e.call(this, 1) }, reset: function () { delete this.current; this._ = {} }
                }
            }); var b = { block: 1, "list-item": 1, table: 1, "table-row-group": 1, "table-header-group": 1, "table-footer-group": 1, "table-row": 1, "table-column-group": 1, "table-column": 1, "table-cell": 1, "table-caption": 1 }, c = { absolute: 1, fixed: 1 }; CKEDITOR.dom.element.prototype.isBlockBoundary =
                function (a) { return "none" != this.getComputedStyle("float") || this.getComputedStyle("position") in c || !b[this.getComputedStyle("display")] ? !!(this.is(CKEDITOR.dtd.$block) || a && this.is(a)) : !0 }; CKEDITOR.dom.walker.blockBoundary = function (a) { return function (b) { return !(b.type == CKEDITOR.NODE_ELEMENT && b.isBlockBoundary(a)) } }; CKEDITOR.dom.walker.listItemBoundary = function () { return this.blockBoundary({ br: 1 }) }; CKEDITOR.dom.walker.bookmark = function (a, b) {
                    function g(a) { return a && a.getName && "span" == a.getName() && a.data("cke-bookmark") }
                    return function (c) { var d, f; d = c && c.type != CKEDITOR.NODE_ELEMENT && (f = c.getParent()) && g(f); d = a ? d : d || g(c); return !!(b ^ d) }
                }; CKEDITOR.dom.walker.whitespaces = function (a) { return function (b) { var g; b && b.type == CKEDITOR.NODE_TEXT && (g = !CKEDITOR.tools.trim(b.getText()) || CKEDITOR.env.webkit && b.getText() == CKEDITOR.dom.selection.FILLING_CHAR_SEQUENCE); return !!(a ^ g) } }; CKEDITOR.dom.walker.invisible = function (a) {
                    var b = CKEDITOR.dom.walker.whitespaces(), g = CKEDITOR.env.webkit ? 1 : 0; return function (c) {
                        b(c) ? c = 1 : (c.type == CKEDITOR.NODE_TEXT &&
                            (c = c.getParent()), c = c.$.offsetWidth <= g); return !!(a ^ c)
                    }
                }; CKEDITOR.dom.walker.nodeType = function (a, b) { return function (g) { return !!(b ^ g.type == a) } }; CKEDITOR.dom.walker.bogus = function (a) { function b(a) { return !k(a) && !m(a) } return function (g) { var c = CKEDITOR.env.needsBrFiller ? g.is && g.is("br") : g.getText && d.test(g.getText()); c && (c = g.getParent(), g = g.getNext(b), c = c.isBlockBoundary() && (!g || g.type == CKEDITOR.NODE_ELEMENT && g.isBlockBoundary())); return !!(a ^ c) } }; CKEDITOR.dom.walker.temp = function (a) {
                    return function (b) {
                        b.type !=
                        CKEDITOR.NODE_ELEMENT && (b = b.getParent()); b = b && b.hasAttribute("data-cke-temp"); return !!(a ^ b)
                    }
                }; var d = /^[\t\r\n ]*(?:&nbsp;|\xa0)$/, k = CKEDITOR.dom.walker.whitespaces(), m = CKEDITOR.dom.walker.bookmark(), f = CKEDITOR.dom.walker.temp(), h = function (a) { return m(a) || k(a) || a.type == CKEDITOR.NODE_ELEMENT && a.is(CKEDITOR.dtd.$inline) && !a.is(CKEDITOR.dtd.$empty) }; CKEDITOR.dom.walker.ignored = function (a) { return function (b) { b = k(b) || m(b) || f(b); return !!(a ^ b) } }; var l = CKEDITOR.dom.walker.ignored(); CKEDITOR.dom.walker.empty =
                    function (a) { return function (b) { for (var g = 0, c = b.getChildCount(); g < c; ++g)if (!l(b.getChild(g))) return !!a; return !a } }; var g = CKEDITOR.dom.walker.empty(), n = CKEDITOR.dom.walker.validEmptyBlockContainers = CKEDITOR.tools.extend(function (a) { var b = {}, g; for (g in a) CKEDITOR.dtd[g]["#"] && (b[g] = 1); return b }(CKEDITOR.dtd.$block), { caption: 1, td: 1, th: 1 }); CKEDITOR.dom.walker.editable = function (a) {
                        return function (b) {
                            b = l(b) ? !1 : b.type == CKEDITOR.NODE_TEXT || b.type == CKEDITOR.NODE_ELEMENT && (b.is(CKEDITOR.dtd.$inline) || b.is("hr") ||
                                "false" == b.getAttribute("contenteditable") || !CKEDITOR.env.needsBrFiller && b.is(n) && g(b)) ? !0 : !1; return !!(a ^ b)
                        }
                    }; CKEDITOR.dom.element.prototype.getBogus = function () { var a = this; do a = a.getPreviousSourceNode(); while (h(a)); return a && (CKEDITOR.env.needsBrFiller ? a.is && a.is("br") : a.getText && d.test(a.getText())) ? a : !1 }
        }(), CKEDITOR.dom.range = function (a) {
            this.endOffset = this.endContainer = this.startOffset = this.startContainer = null; this.collapsed = !0; var e = a instanceof CKEDITOR.dom.document; this.document = e ? a : a.getDocument();
            this.root = e ? a.getBody() : a
        }, function () {
            function a(a) { a.collapsed = a.startContainer && a.endContainer && a.startContainer.equals(a.endContainer) && a.startOffset == a.endOffset } function e(a, b, c, d, f) {
                function l(a, b, g, c) { var d = g ? a.getPrevious() : a.getNext(); if (c && k) return d; r || c ? b.append(a.clone(!0, f), g) : (a.remove(), m && b.append(a)); return d } function h() { var a, b, g, c = Math.min(N.length, H.length); for (a = 0; a < c; a++)if (b = N[a], g = H[a], !b.equals(g)) return a; return a - 1 } function e() {
                    var b = R - 1, c = E && I && !w.equals(C); b < P - 1 || b <
                        T - 1 || c ? (c ? a.moveToPosition(C, CKEDITOR.POSITION_BEFORE_START) : T == b + 1 && F ? a.moveToPosition(H[b], CKEDITOR.POSITION_BEFORE_END) : a.moveToPosition(H[b + 1], CKEDITOR.POSITION_BEFORE_START), d && (b = N[b + 1]) && b.type == CKEDITOR.NODE_ELEMENT && (c = CKEDITOR.dom.element.createFromHtml('\x3cspan data-cke-bookmark\x3d"1" style\x3d"display:none"\x3e\x26nbsp;\x3c/span\x3e', a.document), c.insertAfter(b), b.mergeSiblings(!1), a.moveToBookmark({ startNode: c }))) : a.collapse(!0)
                } a.optimizeBookmark(); var k = 0 === b, m = 1 == b, r = 2 == b; b = r || m;
                var w = a.startContainer, C = a.endContainer, x = a.startOffset, B = a.endOffset, D, F, E, I, G, L; if (r && C.type == CKEDITOR.NODE_TEXT && w.equals(C)) w = a.document.createText(w.substring(x, B)), c.append(w); else {
                    C.type == CKEDITOR.NODE_TEXT ? r ? L = !0 : C = C.split(B) : 0 < C.getChildCount() ? B >= C.getChildCount() ? (C = C.getChild(B - 1), F = !0) : C = C.getChild(B) : I = F = !0; w.type == CKEDITOR.NODE_TEXT ? r ? G = !0 : w.split(x) : 0 < w.getChildCount() ? 0 === x ? (w = w.getChild(x), D = !0) : w = w.getChild(x - 1) : E = D = !0; for (var N = w.getParents(), H = C.getParents(), R = h(), P = N.length -
                        1, T = H.length - 1, O = c, J, ca, W, U = -1, K = R; K <= P; K++) { ca = N[K]; W = ca.getNext(); for (K != P || ca.equals(H[K]) && P < T ? b && (J = O.append(ca.clone(0, f))) : D ? l(ca, O, !1, E) : G && O.append(a.document.createText(ca.substring(x))); W;) { if (W.equals(H[K])) { U = K; break } W = l(W, O) } O = J } O = c; for (K = R; K <= T; K++)if (c = H[K], W = c.getPrevious(), c.equals(N[K])) b && (O = O.getChild(0)); else { K != T || c.equals(N[K]) && T < P ? b && (J = O.append(c.clone(0, f))) : F ? l(c, O, !1, I) : L && O.append(a.document.createText(c.substring(0, B))); if (K > U) for (; W;)W = l(W, O, !0); O = J } r || e()
                }
            } function b() {
                var a =
                    !1, b = CKEDITOR.dom.walker.whitespaces(), c = CKEDITOR.dom.walker.bookmark(!0), d = CKEDITOR.dom.walker.bogus(); return function (f) { return c(f) || b(f) ? !0 : d(f) && !a ? a = !0 : f.type == CKEDITOR.NODE_TEXT && (f.hasAscendant("pre") || CKEDITOR.tools.trim(f.getText()).length) || f.type == CKEDITOR.NODE_ELEMENT && !f.is(k) ? !1 : !0 }
            } function c(a) { var b = CKEDITOR.dom.walker.whitespaces(), c = CKEDITOR.dom.walker.bookmark(1); return function (d) { return c(d) || b(d) ? !0 : !a && m(d) || d.type == CKEDITOR.NODE_ELEMENT && d.is(CKEDITOR.dtd.$removeEmpty) } }
            function d(a) { return function () { var b; return this[a ? "getPreviousNode" : "getNextNode"](function (a) { !b && l(a) && (b = a); return h(a) && !(m(a) && a.equals(b)) }) } } var k = { abbr: 1, acronym: 1, b: 1, bdo: 1, big: 1, cite: 1, code: 1, del: 1, dfn: 1, em: 1, font: 1, i: 1, ins: 1, label: 1, kbd: 1, q: 1, samp: 1, small: 1, span: 1, strike: 1, strong: 1, sub: 1, sup: 1, tt: 1, u: 1, "var": 1 }, m = CKEDITOR.dom.walker.bogus(), f = /^[\t\r\n ]*(?:&nbsp;|\xa0)$/, h = CKEDITOR.dom.walker.editable(), l = CKEDITOR.dom.walker.ignored(!0); CKEDITOR.dom.range.prototype = {
                clone: function () {
                    var a =
                        new CKEDITOR.dom.range(this.root); a._setStartContainer(this.startContainer); a.startOffset = this.startOffset; a._setEndContainer(this.endContainer); a.endOffset = this.endOffset; a.collapsed = this.collapsed; return a
                }, collapse: function (a) { a ? (this._setEndContainer(this.startContainer), this.endOffset = this.startOffset) : (this._setStartContainer(this.endContainer), this.startOffset = this.endOffset); this.collapsed = !0 }, cloneContents: function (a) {
                    var b = new CKEDITOR.dom.documentFragment(this.document); this.collapsed ||
                        e(this, 2, b, !1, "undefined" == typeof a ? !0 : a); return b
                }, deleteContents: function (a) { this.collapsed || e(this, 0, null, a) }, extractContents: function (a, b) { var c = new CKEDITOR.dom.documentFragment(this.document); this.collapsed || e(this, 1, c, a, "undefined" == typeof b ? !0 : b); return c }, createBookmark: function (a) {
                    var b, c, d, f, l = this.collapsed; b = this.document.createElement("span"); b.data("cke-bookmark", 1); b.setStyle("display", "none"); b.setHtml("\x26nbsp;"); a && (d = "cke_bm_" + CKEDITOR.tools.getNextNumber(), b.setAttribute("id",
                        d + (l ? "C" : "S"))); l || (c = b.clone(), c.setHtml("\x26nbsp;"), a && c.setAttribute("id", d + "E"), f = this.clone(), f.collapse(), f.insertNode(c)); f = this.clone(); f.collapse(!0); f.insertNode(b); c ? (this.setStartAfter(b), this.setEndBefore(c)) : this.moveToPosition(b, CKEDITOR.POSITION_AFTER_END); return { startNode: a ? d + (l ? "C" : "S") : b, endNode: a ? d + "E" : c, serializable: a, collapsed: l }
                }, createBookmark2: function () {
                    function a(b) {
                        var g = b.container, d = b.offset, f; f = g; var l = d; f = f.type != CKEDITOR.NODE_ELEMENT || 0 === l || l == f.getChildCount() ?
                            0 : f.getChild(l - 1).type == CKEDITOR.NODE_TEXT && f.getChild(l).type == CKEDITOR.NODE_TEXT; f && (g = g.getChild(d - 1), d = g.getLength()); if (g.type == CKEDITOR.NODE_ELEMENT && 0 < d) { a: { for (f = g; d--;)if (l = f.getChild(d).getIndex(!0), 0 <= l) { d = l; break a } d = -1 } d += 1 } if (g.type == CKEDITOR.NODE_TEXT) {
                                f = g; for (l = 0; (f = f.getPrevious()) && f.type == CKEDITOR.NODE_TEXT;)l += f.getText().replace(CKEDITOR.dom.selection.FILLING_CHAR_SEQUENCE, "").length; f = l; g.getText() ? d += f : (l = g.getPrevious(c), f ? (d = f, g = l ? l.getNext() : g.getParent().getFirst()) : (g =
                                    g.getParent(), d = l ? l.getIndex(!0) + 1 : 0))
                            } b.container = g; b.offset = d
                    } function b(a, g) { var c = g.getCustomData("cke-fillingChar"); if (c) { var d = a.container; c.equals(d) && (a.offset -= CKEDITOR.dom.selection.FILLING_CHAR_SEQUENCE.length, 0 >= a.offset && (a.offset = d.getIndex(), a.container = d.getParent())) } } var c = CKEDITOR.dom.walker.nodeType(CKEDITOR.NODE_TEXT, !0); return function (c) {
                        var d = this.collapsed, f = { container: this.startContainer, offset: this.startOffset }, l = { container: this.endContainer, offset: this.endOffset }; c && (a(f),
                            b(f, this.root), d || (a(l), b(l, this.root))); return { start: f.container.getAddress(c), end: d ? null : l.container.getAddress(c), startOffset: f.offset, endOffset: l.offset, normalized: c, collapsed: d, is2: !0 }
                    }
                }(), moveToBookmark: function (a) {
                    if (a.is2) { var b = this.document.getByAddress(a.start, a.normalized), c = a.startOffset, d = a.end && this.document.getByAddress(a.end, a.normalized); a = a.endOffset; this.setStart(b, c); d ? this.setEnd(d, a) : this.collapse(!0) } else b = (c = a.serializable) ? this.document.getById(a.startNode) : a.startNode,
                        a = c ? this.document.getById(a.endNode) : a.endNode, this.setStartBefore(b), b.remove(), a ? (this.setEndBefore(a), a.remove()) : this.collapse(!0)
                }, getBoundaryNodes: function () {
                    var a = this.startContainer, b = this.endContainer, c = this.startOffset, d = this.endOffset, f; if (a.type == CKEDITOR.NODE_ELEMENT) if (f = a.getChildCount(), f > c) a = a.getChild(c); else if (1 > f) a = a.getPreviousSourceNode(); else { for (a = a.$; a.lastChild;)a = a.lastChild; a = new CKEDITOR.dom.node(a); a = a.getNextSourceNode() || a } if (b.type == CKEDITOR.NODE_ELEMENT) if (f = b.getChildCount(),
                        f > d) b = b.getChild(d).getPreviousSourceNode(!0); else if (1 > f) b = b.getPreviousSourceNode(); else { for (b = b.$; b.lastChild;)b = b.lastChild; b = new CKEDITOR.dom.node(b) } a.getPosition(b) & CKEDITOR.POSITION_FOLLOWING && (a = b); return { startNode: a, endNode: b }
                }, getCommonAncestor: function (a, b) { var c = this.startContainer, d = this.endContainer, c = c.equals(d) ? a && c.type == CKEDITOR.NODE_ELEMENT && this.startOffset == this.endOffset - 1 ? c.getChild(this.startOffset) : c : c.getCommonAncestor(d); return b && !c.is ? c.getParent() : c }, optimize: function () {
                    var a =
                        this.startContainer, b = this.startOffset; a.type != CKEDITOR.NODE_ELEMENT && (b ? b >= a.getLength() && this.setStartAfter(a) : this.setStartBefore(a)); a = this.endContainer; b = this.endOffset; a.type != CKEDITOR.NODE_ELEMENT && (b ? b >= a.getLength() && this.setEndAfter(a) : this.setEndBefore(a))
                }, optimizeBookmark: function () { var a = this.startContainer, b = this.endContainer; a.is && a.is("span") && a.data("cke-bookmark") && this.setStartAt(a, CKEDITOR.POSITION_BEFORE_START); b && b.is && b.is("span") && b.data("cke-bookmark") && this.setEndAt(b, CKEDITOR.POSITION_AFTER_END) },
                trim: function (a, b) {
                    var c = this.startContainer, d = this.startOffset, f = this.collapsed; if ((!a || f) && c && c.type == CKEDITOR.NODE_TEXT) { if (d) if (d >= c.getLength()) d = c.getIndex() + 1, c = c.getParent(); else { var l = c.split(d), d = c.getIndex() + 1, c = c.getParent(); this.startContainer.equals(this.endContainer) ? this.setEnd(l, this.endOffset - this.startOffset) : c.equals(this.endContainer) && (this.endOffset += 1) } else d = c.getIndex(), c = c.getParent(); this.setStart(c, d); if (f) { this.collapse(!0); return } } c = this.endContainer; d = this.endOffset;
                    b || f || !c || c.type != CKEDITOR.NODE_TEXT || (d ? (d >= c.getLength() || c.split(d), d = c.getIndex() + 1) : d = c.getIndex(), c = c.getParent(), this.setEnd(c, d))
                }, enlarge: function (a, b) {
                    function c(a) { return a && a.type == CKEDITOR.NODE_ELEMENT && a.hasAttribute("contenteditable") ? null : a } var d = new RegExp(/[^\s\ufeff]/); switch (a) {
                        case CKEDITOR.ENLARGE_INLINE: var f = 1; case CKEDITOR.ENLARGE_ELEMENT: var l = function (a, b) {
                            var c = new CKEDITOR.dom.range(e); c.setStart(a, b); c.setEndAt(e, CKEDITOR.POSITION_BEFORE_END); var c = new CKEDITOR.dom.walker(c),
                                g; for (c.guard = function (a) { return !(a.type == CKEDITOR.NODE_ELEMENT && a.isBlockBoundary()) }; g = c.next();) { if (g.type != CKEDITOR.NODE_TEXT) return !1; D = g != a ? g.getText() : g.substring(b); if (d.test(D)) return !1 } return !0
                        }; if (this.collapsed) break; var h = this.getCommonAncestor(), e = this.root, k, m, r, w, C, x = !1, B, D; B = this.startContainer; var F = this.startOffset; B.type == CKEDITOR.NODE_TEXT ? (F && (B = !CKEDITOR.tools.trim(B.substring(0, F)).length && B, x = !!B), B && ((w = B.getPrevious()) || (r = B.getParent()))) : (F && (w = B.getChild(F - 1) || B.getLast()),
                            w || (r = B)); for (r = c(r); r || w;) {
                                if (r && !w) { !C && r.equals(h) && (C = !0); if (f ? r.isBlockBoundary() : !e.contains(r)) break; x && "inline" == r.getComputedStyle("display") || (x = !1, C ? k = r : this.setStartBefore(r)); w = r.getPrevious() } for (; w;)if (B = !1, w.type == CKEDITOR.NODE_COMMENT) w = w.getPrevious(); else {
                                    if (w.type == CKEDITOR.NODE_TEXT) D = w.getText(), d.test(D) && (w = null), B = /[\s\ufeff]$/.test(D); else if ((w.$.offsetWidth > (CKEDITOR.env.webkit ? 1 : 0) || b && w.is("br")) && !w.data("cke-bookmark")) if (x && CKEDITOR.dtd.$removeEmpty[w.getName()]) {
                                        D =
                                        w.getText(); if (d.test(D)) w = null; else for (var F = w.$.getElementsByTagName("*"), E = 0, I; I = F[E++];)if (!CKEDITOR.dtd.$removeEmpty[I.nodeName.toLowerCase()]) { w = null; break } w && (B = !!D.length)
                                    } else w = null; B && (x ? C ? k = r : r && this.setStartBefore(r) : x = !0); if (w) { B = w.getPrevious(); if (!r && !B) { r = w; w = null; break } w = B } else r = null
                                } r && (r = c(r.getParent()))
                            } B = this.endContainer; F = this.endOffset; r = w = null; C = x = !1; B.type == CKEDITOR.NODE_TEXT ? CKEDITOR.tools.trim(B.substring(F)).length ? x = !0 : (x = !B.getLength(), F == B.getLength() ? (w = B.getNext()) ||
                                (r = B.getParent()) : l(B, F) && (r = B.getParent())) : (w = B.getChild(F)) || (r = B); for (; r || w;) {
                                    if (r && !w) { !C && r.equals(h) && (C = !0); if (f ? r.isBlockBoundary() : !e.contains(r)) break; x && "inline" == r.getComputedStyle("display") || (x = !1, C ? m = r : r && this.setEndAfter(r)); w = r.getNext() } for (; w;) {
                                        B = !1; if (w.type == CKEDITOR.NODE_TEXT) D = w.getText(), l(w, 0) || (w = null), B = /^[\s\ufeff]/.test(D); else if (w.type == CKEDITOR.NODE_ELEMENT) {
                                            if ((0 < w.$.offsetWidth || b && w.is("br")) && !w.data("cke-bookmark")) if (x && CKEDITOR.dtd.$removeEmpty[w.getName()]) {
                                                D =
                                                w.getText(); if (d.test(D)) w = null; else for (F = w.$.getElementsByTagName("*"), E = 0; I = F[E++];)if (!CKEDITOR.dtd.$removeEmpty[I.nodeName.toLowerCase()]) { w = null; break } w && (B = !!D.length)
                                            } else w = null
                                        } else B = 1; B && x && (C ? m = r : this.setEndAfter(r)); if (w) { B = w.getNext(); if (!r && !B) { r = w; w = null; break } w = B } else r = null
                                    } r && (r = c(r.getParent()))
                                } k && m && (h = k.contains(m) ? m : k, this.setStartBefore(h), this.setEndAfter(h)); break; case CKEDITOR.ENLARGE_BLOCK_CONTENTS: case CKEDITOR.ENLARGE_LIST_ITEM_CONTENTS: r = new CKEDITOR.dom.range(this.root);
                            e = this.root; r.setStartAt(e, CKEDITOR.POSITION_AFTER_START); r.setEnd(this.startContainer, this.startOffset); r = new CKEDITOR.dom.walker(r); var G, L, N = CKEDITOR.dom.walker.blockBoundary(a == CKEDITOR.ENLARGE_LIST_ITEM_CONTENTS ? { br: 1 } : null), H = null, R = function (a) { if (a.type == CKEDITOR.NODE_ELEMENT && "false" == a.getAttribute("contenteditable")) if (H) { if (H.equals(a)) { H = null; return } } else H = a; else if (H) return; var b = N(a); b || (G = a); return b }, f = function (a) { var b = R(a); !b && a.is && a.is("br") && (L = a); return b }; r.guard = R; r = r.lastBackward();
                            G = G || e; this.setStartAt(G, !G.is("br") && (!r && this.checkStartOfBlock() || r && G.contains(r)) ? CKEDITOR.POSITION_AFTER_START : CKEDITOR.POSITION_AFTER_END); if (a == CKEDITOR.ENLARGE_LIST_ITEM_CONTENTS) { r = this.clone(); r = new CKEDITOR.dom.walker(r); var P = CKEDITOR.dom.walker.whitespaces(), T = CKEDITOR.dom.walker.bookmark(); r.evaluator = function (a) { return !P(a) && !T(a) }; if ((r = r.previous()) && r.type == CKEDITOR.NODE_ELEMENT && r.is("br")) break } r = this.clone(); r.collapse(); r.setEndAt(e, CKEDITOR.POSITION_BEFORE_END); r = new CKEDITOR.dom.walker(r);
                            r.guard = a == CKEDITOR.ENLARGE_LIST_ITEM_CONTENTS ? f : R; G = H = L = null; r = r.lastForward(); G = G || e; this.setEndAt(G, !r && this.checkEndOfBlock() || r && G.contains(r) ? CKEDITOR.POSITION_BEFORE_END : CKEDITOR.POSITION_BEFORE_START); L && this.setEndAfter(L)
                    }
                }, shrink: function (a, b, c) {
                    if (!this.collapsed) {
                        a = a || CKEDITOR.SHRINK_TEXT; var d = this.clone(), f = this.startContainer, l = this.endContainer, h = this.startOffset, e = this.endOffset, k = 1, m = 1; f && f.type == CKEDITOR.NODE_TEXT && (h ? h >= f.getLength() ? d.setStartAfter(f) : (d.setStartBefore(f), k =
                            0) : d.setStartBefore(f)); l && l.type == CKEDITOR.NODE_TEXT && (e ? e >= l.getLength() ? d.setEndAfter(l) : (d.setEndAfter(l), m = 0) : d.setEndBefore(l)); var d = new CKEDITOR.dom.walker(d), r = CKEDITOR.dom.walker.bookmark(); d.evaluator = function (b) { return b.type == (a == CKEDITOR.SHRINK_ELEMENT ? CKEDITOR.NODE_ELEMENT : CKEDITOR.NODE_TEXT) }; var w; d.guard = function (b, d) {
                                if (r(b)) return !0; if (a == CKEDITOR.SHRINK_ELEMENT && b.type == CKEDITOR.NODE_TEXT || d && b.equals(w) || !1 === c && b.type == CKEDITOR.NODE_ELEMENT && b.isBlockBoundary() || b.type == CKEDITOR.NODE_ELEMENT &&
                                    b.hasAttribute("contenteditable")) return !1; d || b.type != CKEDITOR.NODE_ELEMENT || (w = b); return !0
                            }; k && (f = d[a == CKEDITOR.SHRINK_ELEMENT ? "lastForward" : "next"]()) && this.setStartAt(f, b ? CKEDITOR.POSITION_AFTER_START : CKEDITOR.POSITION_BEFORE_START); m && (d.reset(), (d = d[a == CKEDITOR.SHRINK_ELEMENT ? "lastBackward" : "previous"]()) && this.setEndAt(d, b ? CKEDITOR.POSITION_BEFORE_END : CKEDITOR.POSITION_AFTER_END)); return !(!k && !m)
                    }
                }, insertNode: function (a) {
                    this.optimizeBookmark(); this.trim(!1, !0); var b = this.startContainer, c = b.getChild(this.startOffset);
                    c ? a.insertBefore(c) : b.append(a); a.getParent() && a.getParent().equals(this.endContainer) && this.endOffset++; this.setStartBefore(a)
                }, moveToPosition: function (a, b) { this.setStartAt(a, b); this.collapse(!0) }, moveToRange: function (a) { this.setStart(a.startContainer, a.startOffset); this.setEnd(a.endContainer, a.endOffset) }, selectNodeContents: function (a) { this.setStart(a, 0); this.setEnd(a, a.type == CKEDITOR.NODE_TEXT ? a.getLength() : a.getChildCount()) }, setStart: function (b, c) {
                    b.type == CKEDITOR.NODE_ELEMENT && CKEDITOR.dtd.$empty[b.getName()] &&
                    (c = b.getIndex(), b = b.getParent()); this._setStartContainer(b); this.startOffset = c; this.endContainer || (this._setEndContainer(b), this.endOffset = c); a(this)
                }, setEnd: function (b, c) { b.type == CKEDITOR.NODE_ELEMENT && CKEDITOR.dtd.$empty[b.getName()] && (c = b.getIndex() + 1, b = b.getParent()); this._setEndContainer(b); this.endOffset = c; this.startContainer || (this._setStartContainer(b), this.startOffset = c); a(this) }, setStartAfter: function (a) { this.setStart(a.getParent(), a.getIndex() + 1) }, setStartBefore: function (a) {
                    this.setStart(a.getParent(),
                        a.getIndex())
                }, setEndAfter: function (a) { this.setEnd(a.getParent(), a.getIndex() + 1) }, setEndBefore: function (a) { this.setEnd(a.getParent(), a.getIndex()) }, setStartAt: function (b, c) { switch (c) { case CKEDITOR.POSITION_AFTER_START: this.setStart(b, 0); break; case CKEDITOR.POSITION_BEFORE_END: b.type == CKEDITOR.NODE_TEXT ? this.setStart(b, b.getLength()) : this.setStart(b, b.getChildCount()); break; case CKEDITOR.POSITION_BEFORE_START: this.setStartBefore(b); break; case CKEDITOR.POSITION_AFTER_END: this.setStartAfter(b) }a(this) },
                setEndAt: function (b, c) { switch (c) { case CKEDITOR.POSITION_AFTER_START: this.setEnd(b, 0); break; case CKEDITOR.POSITION_BEFORE_END: b.type == CKEDITOR.NODE_TEXT ? this.setEnd(b, b.getLength()) : this.setEnd(b, b.getChildCount()); break; case CKEDITOR.POSITION_BEFORE_START: this.setEndBefore(b); break; case CKEDITOR.POSITION_AFTER_END: this.setEndAfter(b) }a(this) }, fixBlock: function (a, b) {
                    var c = this.createBookmark(), d = this.document.createElement(b); this.collapse(a); this.enlarge(CKEDITOR.ENLARGE_BLOCK_CONTENTS); this.extractContents().appendTo(d);
                    d.trim(); this.insertNode(d); var f = d.getBogus(); f && f.remove(); d.appendBogus(); this.moveToBookmark(c); return d
                }, splitBlock: function (a, b) {
                    var c = new CKEDITOR.dom.elementPath(this.startContainer, this.root), d = new CKEDITOR.dom.elementPath(this.endContainer, this.root), f = c.block, l = d.block, h = null; if (!c.blockLimit.equals(d.blockLimit)) return null; "br" != a && (f || (f = this.fixBlock(!0, a), l = (new CKEDITOR.dom.elementPath(this.endContainer, this.root)).block), l || (l = this.fixBlock(!1, a))); c = f && this.checkStartOfBlock();
                    d = l && this.checkEndOfBlock(); this.deleteContents(); f && f.equals(l) && (d ? (h = new CKEDITOR.dom.elementPath(this.startContainer, this.root), this.moveToPosition(l, CKEDITOR.POSITION_AFTER_END), l = null) : c ? (h = new CKEDITOR.dom.elementPath(this.startContainer, this.root), this.moveToPosition(f, CKEDITOR.POSITION_BEFORE_START), f = null) : (l = this.splitElement(f, b || !1), f.is("ul", "ol") || f.appendBogus())); return { previousBlock: f, nextBlock: l, wasStartOfBlock: c, wasEndOfBlock: d, elementPath: h }
                }, splitElement: function (a, b) {
                    if (!this.collapsed) return null;
                    this.setEndAt(a, CKEDITOR.POSITION_BEFORE_END); var c = this.extractContents(!1, b || !1), d = a.clone(!1, b || !1); c.appendTo(d); d.insertAfter(a); this.moveToPosition(a, CKEDITOR.POSITION_AFTER_END); return d
                }, removeEmptyBlocksAtEnd: function () {
                    function a(g) { return function (a) { return b(a) || c(a) || a.type == CKEDITOR.NODE_ELEMENT && a.isEmptyInlineRemoveable() || g.is("table") && a.is("caption") ? !1 : !0 } } var b = CKEDITOR.dom.walker.whitespaces(), c = CKEDITOR.dom.walker.bookmark(!1); return function (b) {
                        for (var c = this.createBookmark(),
                            d = this[b ? "endPath" : "startPath"](), f = d.block || d.blockLimit, l; f && !f.equals(d.root) && !f.getFirst(a(f));)l = f.getParent(), this[b ? "setEndAt" : "setStartAt"](f, CKEDITOR.POSITION_AFTER_END), f.remove(1), f = l; this.moveToBookmark(c)
                    }
                }(), startPath: function () { return new CKEDITOR.dom.elementPath(this.startContainer, this.root) }, endPath: function () { return new CKEDITOR.dom.elementPath(this.endContainer, this.root) }, checkBoundaryOfElement: function (a, b) {
                    var d = b == CKEDITOR.START, f = this.clone(); f.collapse(d); f[d ? "setStartAt" :
                        "setEndAt"](a, d ? CKEDITOR.POSITION_AFTER_START : CKEDITOR.POSITION_BEFORE_END); f = new CKEDITOR.dom.walker(f); f.evaluator = c(d); return f[d ? "checkBackward" : "checkForward"]()
                }, checkStartOfBlock: function () {
                    var a = this.startContainer, c = this.startOffset; CKEDITOR.env.ie && c && a.type == CKEDITOR.NODE_TEXT && (a = CKEDITOR.tools.ltrim(a.substring(0, c)), f.test(a) && this.trim(0, 1)); this.trim(); a = new CKEDITOR.dom.elementPath(this.startContainer, this.root); c = this.clone(); c.collapse(!0); c.setStartAt(a.block || a.blockLimit, CKEDITOR.POSITION_AFTER_START);
                    a = new CKEDITOR.dom.walker(c); a.evaluator = b(); return a.checkBackward()
                }, checkEndOfBlock: function () { var a = this.endContainer, c = this.endOffset; CKEDITOR.env.ie && a.type == CKEDITOR.NODE_TEXT && (a = CKEDITOR.tools.rtrim(a.substring(c)), f.test(a) && this.trim(1, 0)); this.trim(); a = new CKEDITOR.dom.elementPath(this.endContainer, this.root); c = this.clone(); c.collapse(!1); c.setEndAt(a.block || a.blockLimit, CKEDITOR.POSITION_BEFORE_END); a = new CKEDITOR.dom.walker(c); a.evaluator = b(); return a.checkForward() }, getPreviousNode: function (a,
                    b, c) { var d = this.clone(); d.collapse(1); d.setStartAt(c || this.root, CKEDITOR.POSITION_AFTER_START); c = new CKEDITOR.dom.walker(d); c.evaluator = a; c.guard = b; return c.previous() }, getNextNode: function (a, b, c) { var d = this.clone(); d.collapse(); d.setEndAt(c || this.root, CKEDITOR.POSITION_BEFORE_END); c = new CKEDITOR.dom.walker(d); c.evaluator = a; c.guard = b; return c.next() }, checkReadOnly: function () {
                        function a(b, c) {
                            for (; b;) {
                                if (b.type == CKEDITOR.NODE_ELEMENT) {
                                    if ("false" == b.getAttribute("contentEditable") && !b.data("cke-editable")) return 0;
                                    if (b.is("html") || "true" == b.getAttribute("contentEditable") && (b.contains(c) || b.equals(c))) break
                                } b = b.getParent()
                            } return 1
                        } return function () { var b = this.startContainer, c = this.endContainer; return !(a(b, c) && a(c, b)) }
                    }(), moveToElementEditablePosition: function (a, b) {
                        if (a.type == CKEDITOR.NODE_ELEMENT && !a.isEditable(!1)) return this.moveToPosition(a, b ? CKEDITOR.POSITION_AFTER_END : CKEDITOR.POSITION_BEFORE_START), !0; for (var c = 0; a;) {
                            if (a.type == CKEDITOR.NODE_TEXT) {
                                b && this.endContainer && this.checkEndOfBlock() && f.test(a.getText()) ?
                                this.moveToPosition(a, CKEDITOR.POSITION_BEFORE_START) : this.moveToPosition(a, b ? CKEDITOR.POSITION_AFTER_END : CKEDITOR.POSITION_BEFORE_START); c = 1; break
                            } if (a.type == CKEDITOR.NODE_ELEMENT) if (a.isEditable()) this.moveToPosition(a, b ? CKEDITOR.POSITION_BEFORE_END : CKEDITOR.POSITION_AFTER_START), c = 1; else if (b && a.is("br") && this.endContainer && this.checkEndOfBlock()) this.moveToPosition(a, CKEDITOR.POSITION_BEFORE_START); else if ("false" == a.getAttribute("contenteditable") && a.is(CKEDITOR.dtd.$block)) return this.setStartBefore(a),
                                this.setEndAfter(a), !0; var d = a, h = c, e = void 0; d.type == CKEDITOR.NODE_ELEMENT && d.isEditable(!1) && (e = d[b ? "getLast" : "getFirst"](l)); h || e || (e = d[b ? "getPrevious" : "getNext"](l)); a = e
                        } return !!c
                    }, moveToClosestEditablePosition: function (a, b) {
                        var c, d = 0, f, l, h = [CKEDITOR.POSITION_AFTER_END, CKEDITOR.POSITION_BEFORE_START]; a ? (c = new CKEDITOR.dom.range(this.root), c.moveToPosition(a, h[b ? 0 : 1])) : c = this.clone(); if (a && !a.is(CKEDITOR.dtd.$block)) d = 1; else if (f = c[b ? "getNextEditableNode" : "getPreviousEditableNode"]()) d = 1, (l = f.type ==
                            CKEDITOR.NODE_ELEMENT) && f.is(CKEDITOR.dtd.$block) && "false" == f.getAttribute("contenteditable") ? (c.setStartAt(f, CKEDITOR.POSITION_BEFORE_START), c.setEndAt(f, CKEDITOR.POSITION_AFTER_END)) : !CKEDITOR.env.needsBrFiller && l && f.is(CKEDITOR.dom.walker.validEmptyBlockContainers) ? (c.setEnd(f, 0), c.collapse()) : c.moveToPosition(f, h[b ? 1 : 0]); d && this.moveToRange(c); return !!d
                    }, moveToElementEditStart: function (a) { return this.moveToElementEditablePosition(a) }, moveToElementEditEnd: function (a) {
                        return this.moveToElementEditablePosition(a,
                            !0)
                    }, getEnclosedNode: function () { var a = this.clone(); a.optimize(); if (a.startContainer.type != CKEDITOR.NODE_ELEMENT || a.endContainer.type != CKEDITOR.NODE_ELEMENT) return null; var a = new CKEDITOR.dom.walker(a), b = CKEDITOR.dom.walker.bookmark(!1, !0), c = CKEDITOR.dom.walker.whitespaces(!0); a.evaluator = function (a) { return c(a) && b(a) }; var d = a.next(); a.reset(); return d && d.equals(a.previous()) ? d : null }, getTouchedStartNode: function () {
                        var a = this.startContainer; return this.collapsed || a.type != CKEDITOR.NODE_ELEMENT ? a : a.getChild(this.startOffset) ||
                            a
                    }, getTouchedEndNode: function () { var a = this.endContainer; return this.collapsed || a.type != CKEDITOR.NODE_ELEMENT ? a : a.getChild(this.endOffset - 1) || a }, getNextEditableNode: d(), getPreviousEditableNode: d(1), scrollIntoView: function () {
                        var a = new CKEDITOR.dom.element.createFromHtml("\x3cspan\x3e\x26nbsp;\x3c/span\x3e", this.document), b, c, d, f = this.clone(); f.optimize(); (d = f.startContainer.type == CKEDITOR.NODE_TEXT) ? (c = f.startContainer.getText(), b = f.startContainer.split(f.startOffset), a.insertAfter(f.startContainer)) :
                            f.insertNode(a); a.scrollIntoView(); d && (f.startContainer.setText(c), b.remove()); a.remove()
                    }, _setStartContainer: function (a) { this.startContainer = a }, _setEndContainer: function (a) { this.endContainer = a }
            }
        }(), CKEDITOR.POSITION_AFTER_START = 1, CKEDITOR.POSITION_BEFORE_END = 2, CKEDITOR.POSITION_BEFORE_START = 3, CKEDITOR.POSITION_AFTER_END = 4, CKEDITOR.ENLARGE_ELEMENT = 1, CKEDITOR.ENLARGE_BLOCK_CONTENTS = 2, CKEDITOR.ENLARGE_LIST_ITEM_CONTENTS = 3, CKEDITOR.ENLARGE_INLINE = 4, CKEDITOR.START = 1, CKEDITOR.END = 2, CKEDITOR.SHRINK_ELEMENT =
        1, CKEDITOR.SHRINK_TEXT = 2, "use strict", function () {
            function a(a) { 1 > arguments.length || (this.range = a, this.forceBrBreak = 0, this.enlargeBr = 1, this.enforceRealBlocks = 0, this._ || (this._ = {})) } function e(a) { var b = []; a.forEach(function (a) { if ("true" == a.getAttribute("contenteditable")) return b.push(a), !1 }, CKEDITOR.NODE_ELEMENT, !0); return b } function b(a, c, d, f) {
                a: { null == f && (f = e(d)); for (var h; h = f.shift();)if (h.getDtd().p) { f = { element: h, remaining: f }; break a } f = null } if (!f) return 0; if ((h = CKEDITOR.filter.instances[f.element.data("cke-filter")]) &&
                    !h.check(c)) return b(a, c, d, f.remaining); c = new CKEDITOR.dom.range(f.element); c.selectNodeContents(f.element); c = c.createIterator(); c.enlargeBr = a.enlargeBr; c.enforceRealBlocks = a.enforceRealBlocks; c.activeFilter = c.filter = h; a._.nestedEditable = { element: f.element, container: d, remaining: f.remaining, iterator: c }; return 1
            } function c(a, b, c) { if (!b) return !1; a = a.clone(); a.collapse(!c); return a.checkBoundaryOfElement(b, c ? CKEDITOR.START : CKEDITOR.END) } var d = /^[\r\n\t ]+$/, k = CKEDITOR.dom.walker.bookmark(!1, !0), m = CKEDITOR.dom.walker.whitespaces(!0),
                f = function (a) { return k(a) && m(a) }, h = { dd: 1, dt: 1, li: 1 }; a.prototype = {
                    getNextParagraph: function (a) {
                        var g, e, m, u, q; a = a || "p"; if (this._.nestedEditable) {
                            if (g = this._.nestedEditable.iterator.getNextParagraph(a)) return this.activeFilter = this._.nestedEditable.iterator.activeFilter, g; this.activeFilter = this.filter; if (b(this, a, this._.nestedEditable.container, this._.nestedEditable.remaining)) return this.activeFilter = this._.nestedEditable.iterator.activeFilter, this._.nestedEditable.iterator.getNextParagraph(a); this._.nestedEditable =
                                null
                        } if (!this.range.root.getDtd()[a]) return null; if (!this._.started) {
                            var t = this.range.clone(); e = t.startPath(); var p = t.endPath(), y = !t.collapsed && c(t, e.block), A = !t.collapsed && c(t, p.block, 1); t.shrink(CKEDITOR.SHRINK_ELEMENT, !0); y && t.setStartAt(e.block, CKEDITOR.POSITION_BEFORE_END); A && t.setEndAt(p.block, CKEDITOR.POSITION_AFTER_START); e = t.endContainer.hasAscendant("pre", !0) || t.startContainer.hasAscendant("pre", !0); t.enlarge(this.forceBrBreak && !e || !this.enlargeBr ? CKEDITOR.ENLARGE_LIST_ITEM_CONTENTS : CKEDITOR.ENLARGE_BLOCK_CONTENTS);
                            t.collapsed || (e = new CKEDITOR.dom.walker(t.clone()), p = CKEDITOR.dom.walker.bookmark(!0, !0), e.evaluator = p, this._.nextNode = e.next(), e = new CKEDITOR.dom.walker(t.clone()), e.evaluator = p, e = e.previous(), this._.lastNode = e.getNextSourceNode(!0, null, t.root), this._.lastNode && this._.lastNode.type == CKEDITOR.NODE_TEXT && !CKEDITOR.tools.trim(this._.lastNode.getText()) && this._.lastNode.getParent().isBlockBoundary() && (p = this.range.clone(), p.moveToPosition(this._.lastNode, CKEDITOR.POSITION_AFTER_END), p.checkEndOfBlock() &&
                                (p = new CKEDITOR.dom.elementPath(p.endContainer, p.root), this._.lastNode = (p.block || p.blockLimit).getNextSourceNode(!0))), this._.lastNode && t.root.contains(this._.lastNode) || (this._.lastNode = this._.docEndMarker = t.document.createText(""), this._.lastNode.insertAfter(e)), t = null); this._.started = 1; e = t
                        } p = this._.nextNode; t = this._.lastNode; for (this._.nextNode = null; p;) {
                            var y = 0, A = p.hasAscendant("pre"), z = p.type != CKEDITOR.NODE_ELEMENT, r = 0; if (z) p.type == CKEDITOR.NODE_TEXT && d.test(p.getText()) && (z = 0); else {
                                var w = p.getName();
                                if (CKEDITOR.dtd.$block[w] && "false" == p.getAttribute("contenteditable")) { g = p; b(this, a, g); break } else if (p.isBlockBoundary(this.forceBrBreak && !A && { br: 1 })) { if ("br" == w) z = 1; else if (!e && !p.getChildCount() && "hr" != w) { g = p; m = p.equals(t); break } e && (e.setEndAt(p, CKEDITOR.POSITION_BEFORE_START), "br" != w && (this._.nextNode = p)); y = 1 } else { if (p.getFirst()) { e || (e = this.range.clone(), e.setStartAt(p, CKEDITOR.POSITION_BEFORE_START)); p = p.getFirst(); continue } z = 1 }
                            } z && !e && (e = this.range.clone(), e.setStartAt(p, CKEDITOR.POSITION_BEFORE_START));
                            m = (!y || z) && p.equals(t); if (e && !y) for (; !p.getNext(f) && !m;) { w = p.getParent(); if (w.isBlockBoundary(this.forceBrBreak && !A && { br: 1 })) { y = 1; z = 0; m || w.equals(t); e.setEndAt(w, CKEDITOR.POSITION_BEFORE_END); break } p = w; z = 1; m = p.equals(t); r = 1 } z && e.setEndAt(p, CKEDITOR.POSITION_AFTER_END); p = this._getNextSourceNode(p, r, t); if ((m = !p) || y && e) break
                        } if (!g) {
                            if (!e) return this._.docEndMarker && this._.docEndMarker.remove(), this._.nextNode = null; g = new CKEDITOR.dom.elementPath(e.startContainer, e.root); p = g.blockLimit; y = { div: 1, th: 1, td: 1 };
                            g = g.block; !g && p && !this.enforceRealBlocks && y[p.getName()] && e.checkStartOfBlock() && e.checkEndOfBlock() && !p.equals(e.root) ? g = p : !g || this.enforceRealBlocks && g.is(h) ? (g = this.range.document.createElement(a), e.extractContents().appendTo(g), g.trim(), e.insertNode(g), u = q = !0) : "li" != g.getName() ? e.checkStartOfBlock() && e.checkEndOfBlock() || (g = g.clone(!1), e.extractContents().appendTo(g), g.trim(), q = e.splitBlock(), u = !q.wasStartOfBlock, q = !q.wasEndOfBlock, e.insertNode(g)) : m || (this._.nextNode = g.equals(t) ? null : this._getNextSourceNode(e.getBoundaryNodes().endNode,
                                1, t))
                        } u && (u = g.getPrevious()) && u.type == CKEDITOR.NODE_ELEMENT && ("br" == u.getName() ? u.remove() : u.getLast() && "br" == u.getLast().$.nodeName.toLowerCase() && u.getLast().remove()); q && (u = g.getLast()) && u.type == CKEDITOR.NODE_ELEMENT && "br" == u.getName() && (!CKEDITOR.env.needsBrFiller || u.getPrevious(k) || u.getNext(k)) && u.remove(); this._.nextNode || (this._.nextNode = m || g.equals(t) || !t ? null : this._getNextSourceNode(g, 1, t)); return g
                    }, _getNextSourceNode: function (a, b, c) {
                        function d(a) { return !(a.equals(c) || a.equals(f)) } var f =
                            this.range.root; for (a = a.getNextSourceNode(b, null, d); !k(a);)a = a.getNextSourceNode(b, null, d); return a
                    }
                }; CKEDITOR.dom.range.prototype.createIterator = function () { return new a(this) }
        }(), CKEDITOR.command = function (a, e) {
            this.uiItems = []; this.exec = function (b) { if (this.state == CKEDITOR.TRISTATE_DISABLED || !this.checkAllowed()) return !1; this.editorFocus && a.focus(); return !1 === this.fire("exec") ? !0 : !1 !== e.exec.call(this, a, b) }; this.refresh = function (a, b) {
                if (!this.readOnly && a.readOnly) return !0; if (this.context && !b.isContextFor(this.context) ||
                    !this.checkAllowed(!0)) return this.disable(), !0; this.startDisabled || this.enable(); this.modes && !this.modes[a.mode] && this.disable(); return !1 === this.fire("refresh", { editor: a, path: b }) ? !0 : e.refresh && !1 !== e.refresh.apply(this, arguments)
            }; var b; this.checkAllowed = function (c) { return c || "boolean" != typeof b ? b = a.activeFilter.checkFeature(this) : b }; CKEDITOR.tools.extend(this, e, { modes: { wysiwyg: 1 }, editorFocus: 1, contextSensitive: !!e.context, state: CKEDITOR.TRISTATE_DISABLED }); CKEDITOR.event.call(this)
        }, CKEDITOR.command.prototype =
        {
            enable: function () { this.state == CKEDITOR.TRISTATE_DISABLED && this.checkAllowed() && this.setState(this.preserveState && "undefined" != typeof this.previousState ? this.previousState : CKEDITOR.TRISTATE_OFF) }, disable: function () { this.setState(CKEDITOR.TRISTATE_DISABLED) }, setState: function (a) { if (this.state == a || a != CKEDITOR.TRISTATE_DISABLED && !this.checkAllowed()) return !1; this.previousState = this.state; this.state = a; this.fire("state"); return !0 }, toggleState: function () {
                this.state == CKEDITOR.TRISTATE_OFF ? this.setState(CKEDITOR.TRISTATE_ON) :
                this.state == CKEDITOR.TRISTATE_ON && this.setState(CKEDITOR.TRISTATE_OFF)
            }
        }, CKEDITOR.event.implementOn(CKEDITOR.command.prototype), CKEDITOR.ENTER_P = 1, CKEDITOR.ENTER_BR = 2, CKEDITOR.ENTER_DIV = 3, CKEDITOR.config = {
            customConfig: "config.js", autoUpdateElement: !0, language: "", defaultLanguage: "en", contentsLangDirection: "", enterMode: CKEDITOR.ENTER_P, forceEnterMode: !1, shiftEnterMode: CKEDITOR.ENTER_BR, docType: "\x3c!DOCTYPE html\x3e", bodyId: "", bodyClass: "", fullPage: !1, height: 200, contentsCss: CKEDITOR.getUrl("contents.css"),
            extraPlugins: "", removePlugins: "", protectedSource: [], tabIndex: 0, width: "", baseFloatZIndex: 1E4, blockedKeystrokes: [CKEDITOR.CTRL + 66, CKEDITOR.CTRL + 73, CKEDITOR.CTRL + 85]
        }, function () {
            function a(a, b, c, d, f) {
                var g, e; a = []; for (g in b) {
                    e = b[g]; e = "boolean" == typeof e ? {} : "function" == typeof e ? { match: e } : E(e); "$" != g.charAt(0) && (e.elements = g); c && (e.featureName = c.toLowerCase()); var l = e; l.elements = m(l.elements, /\s+/) || null; l.propertiesOnly = l.propertiesOnly || !0 === l.elements; var h = /\s*,\s*/, k = void 0; for (k in L) {
                        l[k] = m(l[k],
                            h) || null; var r = l, w = N[k], t = m(l[N[k]], h), z = l[k], p = [], C = !0, n = void 0; t ? C = !1 : t = {}; for (n in z) "!" == n.charAt(0) && (n = n.slice(1), p.push(n), t[n] = !0, C = !1); for (; n = p.pop();)z[n] = z["!" + n], delete z["!" + n]; r[w] = (C ? !1 : t) || null
                    } l.match = l.match || null; d.push(e); a.push(e)
                } b = f.elements; f = f.generic; var H; c = 0; for (d = a.length; c < d; ++c) {
                    g = E(a[c]); e = !0 === g.classes || !0 === g.styles || !0 === g.attributes; l = g; k = w = h = void 0; for (h in L) l[h] = y(l[h]); r = !0; for (k in N) {
                        h = N[k]; w = l[h]; t = []; z = void 0; for (z in w) -1 < z.indexOf("*") ? t.push(new RegExp("^" +
                            z.replace(/\*/g, ".*") + "$")) : t.push(z); w = t; w.length && (l[h] = w, r = !1)
                    } l.nothingRequired = r; l.noProperties = !(l.attributes || l.classes || l.styles); if (!0 === g.elements || null === g.elements) f[e ? "unshift" : "push"](g); else for (H in l = g.elements, delete g.elements, l) if (b[H]) b[H][e ? "unshift" : "push"](g); else b[H] = [g]
                }
            } function e(a, c, d, g) {
                if (!a.match || a.match(c)) if (g || f(a, c)) if (a.propertiesOnly || (d.valid = !0), d.allAttributes || (d.allAttributes = b(a.attributes, c.attributes, d.validAttributes)), d.allStyles || (d.allStyles = b(a.styles,
                    c.styles, d.validStyles)), !d.allClasses) { a = a.classes; c = c.classes; g = d.validClasses; if (a) if (!0 === a) a = !0; else { for (var e = 0, l = c.length, h; e < l; ++e)h = c[e], g[h] || (g[h] = a(h)); a = !1 } else a = !1; d.allClasses = a }
            } function b(a, b, c) { if (!a) return !1; if (!0 === a) return !0; for (var d in b) c[d] || (c[d] = a(d)); return !1 } function c(a, b, c) {
                if (!a.match || a.match(b)) {
                    if (a.noProperties) return !1; c.hadInvalidAttribute = d(a.attributes, b.attributes) || c.hadInvalidAttribute; c.hadInvalidStyle = d(a.styles, b.styles) || c.hadInvalidStyle; a = a.classes;
                    b = b.classes; if (a) { for (var f = !1, g = !0 === a, e = b.length; e--;)if (g || a(b[e])) b.splice(e, 1), f = !0; a = f } else a = !1; c.hadInvalidClass = a || c.hadInvalidClass
                }
            } function d(a, b) { if (!a) return !1; var c = !1, d = !0 === a, f; for (f in b) if (d || a(f)) delete b[f], c = !0; return c } function k(a, b, c) { if (a.disabled || a.customConfig && !c || !b) return !1; a._.cachedChecks = {}; return !0 } function m(a, b) {
                if (!a) return !1; if (!0 === a) return a; if ("string" == typeof a) return a = I(a), "*" == a ? !0 : CKEDITOR.tools.convertArrayToObject(a.split(b)); if (CKEDITOR.tools.isArray(a)) return a.length ?
                    CKEDITOR.tools.convertArrayToObject(a) : !1; var c = {}, d = 0, f; for (f in a) c[f] = a[f], d++; return d ? c : !1
            } function f(a, b) { if (a.nothingRequired) return !0; var c, d, f, g; if (f = a.requiredClasses) for (g = b.classes, c = 0; c < f.length; ++c)if (d = f[c], "string" == typeof d) { if (-1 == CKEDITOR.tools.indexOf(g, d)) return !1 } else if (!CKEDITOR.tools.checkIfAnyArrayItemMatches(g, d)) return !1; return h(b.styles, a.requiredStyles) && h(b.attributes, a.requiredAttributes) } function h(a, b) {
                if (!b) return !0; for (var c = 0, d; c < b.length; ++c)if (d = b[c], "string" ==
                    typeof d) { if (!(d in a)) return !1 } else if (!CKEDITOR.tools.checkIfAnyObjectPropertyMatches(a, d)) return !1; return !0
            } function l(a) { if (!a) return {}; a = a.split(/\s*,\s*/).sort(); for (var b = {}; a.length;)b[a.shift()] = "cke-test"; return b } function g(a) { var b, c, d, f, g = {}, e = 1; for (a = I(a); b = a.match(H);)(c = b[2]) ? (d = n(c, "styles"), f = n(c, "attrs"), c = n(c, "classes")) : d = f = c = null, g["$" + e++] = { elements: b[1], classes: c, styles: d, attributes: f }, a = a.slice(b[0].length); return g } function n(a, b) { var c = a.match(R[b]); return c ? I(c[1]) : null }
            function v(a) { var b = a.styleBackup = a.attributes.style, c = a.classBackup = a.attributes["class"]; a.styles || (a.styles = CKEDITOR.tools.parseCssText(b || "", 1)); a.classes || (a.classes = c ? c.split(/\s+/) : []) } function u(a, b, d, f) {
                var g = 0, l; f.toHtml && (b.name = b.name.replace(P, "$1")); if (f.doCallbacks && a.elementCallbacks) { a: { l = a.elementCallbacks; for (var h = 0, k = l.length, r; h < k; ++h)if (r = l[h](b)) { l = r; break a } l = void 0 } if (l) return l } if (f.doTransform && (l = a._.transformations[b.name])) { v(b); for (h = 0; h < l.length; ++h)w(a, b, l[h]); t(b) } if (f.doFilter) {
                    a: {
                        h =
                        b.name; k = a._; a = k.allowedRules.elements[h]; l = k.allowedRules.generic; h = k.disallowedRules.elements[h]; k = k.disallowedRules.generic; r = f.skipRequired; var m = { valid: !1, validAttributes: {}, validClasses: {}, validStyles: {}, allAttributes: !1, allClasses: !1, allStyles: !1, hadInvalidAttribute: !1, hadInvalidClass: !1, hadInvalidStyle: !1 }, z, C; if (a || l) {
                            v(b); if (h) for (z = 0, C = h.length; z < C; ++z)if (!1 === c(h[z], b, m)) { a = null; break a } if (k) for (z = 0, C = k.length; z < C; ++z)c(k[z], b, m); if (a) for (z = 0, C = a.length; z < C; ++z)e(a[z], b, m, r); if (l) for (z =
                                0, C = l.length; z < C; ++z)e(l[z], b, m, r); a = m
                        } else a = null
                    } if (!a || !a.valid) return d.push(b), 1; C = a.validAttributes; var n = a.validStyles; l = a.validClasses; var h = b.attributes, y = b.styles, k = b.classes; r = b.classBackup; var H = b.styleBackup, q, x, N = [], m = [], A = /^data-cke-/; z = !1; delete h.style; delete h["class"]; delete b.classBackup; delete b.styleBackup; if (!a.allAttributes) for (q in h) C[q] || (A.test(q) ? q == (x = q.replace(/^data-cke-saved-/, "")) || C[x] || (delete h[q], z = !0) : (delete h[q], z = !0)); if (!a.allStyles || a.hadInvalidStyle) {
                        for (q in y) a.allStyles ||
                            n[q] ? N.push(q + ":" + y[q]) : z = !0; N.length && (h.style = N.sort().join("; "))
                    } else H && (h.style = H); if (!a.allClasses || a.hadInvalidClass) { for (q = 0; q < k.length; ++q)(a.allClasses || l[k[q]]) && m.push(k[q]); m.length && (h["class"] = m.sort().join(" ")); r && m.length < r.split(/\s+/).length && (z = !0) } else r && (h["class"] = r); z && (g = 1); if (!f.skipFinalValidation && !p(b)) return d.push(b), 1
                } f.toHtml && (b.name = b.name.replace(T, "cke:$1")); return g
            } function q(a) {
                var b = [], c; for (c in a) -1 < c.indexOf("*") && b.push(c.replace(/\*/g, ".*")); return b.length ?
                    new RegExp("^(?:" + b.join("|") + ")$") : null
            } function t(a) { var b = a.attributes, c; delete b.style; delete b["class"]; if (c = CKEDITOR.tools.writeCssText(a.styles, !0)) b.style = c; a.classes.length && (b["class"] = a.classes.sort().join(" ")) } function p(a) { switch (a.name) { case "a": if (!(a.children.length || a.attributes.name || a.attributes.id)) return !1; break; case "img": if (!a.attributes.src) return !1 }return !0 } function y(a) { if (!a) return !1; if (!0 === a) return !0; var b = q(a); return function (c) { return c in a || b && c.match(b) } } function A() { return new CKEDITOR.htmlParser.element("br") }
            function z(a) { return a.type == CKEDITOR.NODE_ELEMENT && ("br" == a.name || F.$block[a.name]) } function r(a, b, c) {
                var d = a.name; if (F.$empty[d] || !a.children.length) "hr" == d && "br" == b ? a.replaceWith(A()) : (a.parent && c.push({ check: "it", el: a.parent }), a.remove()); else if (F.$block[d] || "tr" == d) if ("br" == b) a.previous && !z(a.previous) && (b = A(), b.insertBefore(a)), a.next && !z(a.next) && (b = A(), b.insertAfter(a)), a.replaceWithChildren(); else {
                    var d = a.children, f; b: {
                        f = F[b]; for (var g = 0, l = d.length, e; g < l; ++g)if (e = d[g], e.type == CKEDITOR.NODE_ELEMENT &&
                            !f[e.name]) { f = !1; break b } f = !0
                    } if (f) a.name = b, a.attributes = {}, c.push({ check: "parent-down", el: a }); else {
                        f = a.parent; for (var g = f.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT || "body" == f.name, h, k, l = d.length; 0 < l;)e = d[--l], g && (e.type == CKEDITOR.NODE_TEXT || e.type == CKEDITOR.NODE_ELEMENT && F.$inline[e.name]) ? (h || (h = new CKEDITOR.htmlParser.element(b), h.insertAfter(a), c.push({ check: "parent-down", el: h })), h.add(e, 0)) : (h = null, k = F[f.name] || F.span, e.insertAfter(a), f.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT || e.type != CKEDITOR.NODE_ELEMENT ||
                            k[e.name] || c.push({ check: "el-up", el: e })); a.remove()
                    }
                } else d in { style: 1, script: 1 } ? a.remove() : (a.parent && c.push({ check: "it", el: a.parent }), a.replaceWithChildren())
            } function w(a, b, c) { var d, f; for (d = 0; d < c.length; ++d)if (f = c[d], !(f.check && !a.check(f.check, !1) || f.left && !f.left(b))) { f.right(b, O); break } } function C(a, b) {
                var c = b.getDefinition(), d = c.attributes, f = c.styles, g, e, l, h; if (a.name != c.element) return !1; for (g in d) if ("class" == g) for (c = d[g].split(/\s+/), l = a.classes.join("|"); h = c.pop();) { if (-1 == l.indexOf(h)) return !1 } else if (a.attributes[g] !=
                    d[g]) return !1; for (e in f) if (a.styles[e] != f[e]) return !1; return !0
            } function x(a, b) { var c, d; "string" == typeof a ? c = a : a instanceof CKEDITOR.style ? d = a : (c = a[0], d = a[1]); return [{ element: c, left: d, right: function (a, c) { c.transform(a, b) } }] } function B(a) { return function (b) { return C(b, a) } } function D(a) { return function (b, c) { c[a](b) } } var F = CKEDITOR.dtd, E = CKEDITOR.tools.copy, I = CKEDITOR.tools.trim, G = ["", "p", "br", "div"]; CKEDITOR.FILTER_SKIP_TREE = 2; CKEDITOR.filter = function (a) {
                this.allowedContent = []; this.disallowedContent =
                    []; this.elementCallbacks = null; this.disabled = !1; this.editor = null; this.id = CKEDITOR.tools.getNextNumber(); this._ = { allowedRules: { elements: {}, generic: [] }, disallowedRules: { elements: {}, generic: [] }, transformations: {}, cachedTests: {} }; CKEDITOR.filter.instances[this.id] = this; if (a instanceof CKEDITOR.editor) {
                        a = this.editor = a; this.customConfig = !0; var b = a.config.allowedContent; !0 === b ? this.disabled = !0 : (b || (this.customConfig = !1), this.allow(b, "config", 1), this.allow(a.config.extraAllowedContent, "extra", 1), this.allow(G[a.enterMode] +
                            " " + G[a.shiftEnterMode], "default", 1), this.disallow(a.config.disallowedContent))
                    } else this.customConfig = !1, this.allow(a, "default", 1)
            }; CKEDITOR.filter.instances = {}; CKEDITOR.filter.prototype = {
                allow: function (b, c, d) {
                    if (!k(this, b, d)) return !1; var f, e; if ("string" == typeof b) b = g(b); else if (b instanceof CKEDITOR.style) {
                        if (b.toAllowedContentRules) return this.allow(b.toAllowedContentRules(this.editor), c, d); f = b.getDefinition(); b = {}; d = f.attributes; b[f.element] = f = { styles: f.styles, requiredStyles: f.styles && CKEDITOR.tools.objectKeys(f.styles) };
                        d && (d = E(d), f.classes = d["class"] ? d["class"].split(/\s+/) : null, f.requiredClasses = f.classes, delete d["class"], f.attributes = d, f.requiredAttributes = d && CKEDITOR.tools.objectKeys(d))
                    } else if (CKEDITOR.tools.isArray(b)) { for (f = 0; f < b.length; ++f)e = this.allow(b[f], c, d); return e } a(this, b, c, this.allowedContent, this._.allowedRules); return !0
                }, applyTo: function (a, b, c, d) {
                    if (this.disabled) return !1; var f = this, g = [], e = this.editor && this.editor.config.protectedSource, l, h = !1, k = { doFilter: !c, doTransform: !0, doCallbacks: !0, toHtml: b };
                    a.forEach(function (a) {
                        if (a.type == CKEDITOR.NODE_ELEMENT) { if ("off" == a.attributes["data-cke-filter"]) return !1; if (!b || "span" != a.name || !~CKEDITOR.tools.objectKeys(a.attributes).join("|").indexOf("data-cke-")) if (l = u(f, a, g, k), l & 1) h = !0; else if (l & 2) return !1 } else if (a.type == CKEDITOR.NODE_COMMENT && a.value.match(/^\{cke_protected\}(?!\{C\})/)) {
                            var c; a: {
                                var d = decodeURIComponent(a.value.replace(/^\{cke_protected\}/, "")); c = []; var r, m, w; if (e) for (m = 0; m < e.length; ++m)if ((w = d.match(e[m])) && w[0].length == d.length) {
                                    c = !0;
                                    break a
                                } d = CKEDITOR.htmlParser.fragment.fromHtml(d); 1 == d.children.length && (r = d.children[0]).type == CKEDITOR.NODE_ELEMENT && u(f, r, c, k); c = !c.length
                            } c || g.push(a)
                        }
                    }, null, !0); g.length && (h = !0); var m; a = []; d = G[d || (this.editor ? this.editor.enterMode : CKEDITOR.ENTER_P)]; for (var w; c = g.pop();)c.type == CKEDITOR.NODE_ELEMENT ? r(c, d, a) : c.remove(); for (; m = a.pop();)if (c = m.el, c.parent) switch (w = F[c.parent.name] || F.span, m.check) {
                        case "it": F.$removeEmpty[c.name] && !c.children.length ? r(c, d, a) : p(c) || r(c, d, a); break; case "el-up": c.parent.type ==
                            CKEDITOR.NODE_DOCUMENT_FRAGMENT || w[c.name] || r(c, d, a); break; case "parent-down": c.parent.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT || w[c.name] || r(c.parent, d, a)
                    }return h
                }, checkFeature: function (a) { if (this.disabled || !a) return !0; a.toFeature && (a = a.toFeature(this.editor)); return !a.requiredContent || this.check(a.requiredContent) }, disable: function () { this.disabled = !0 }, disallow: function (b) { if (!k(this, b, !0)) return !1; "string" == typeof b && (b = g(b)); a(this, b, null, this.disallowedContent, this._.disallowedRules); return !0 },
                addContentForms: function (a) { if (!this.disabled && a) { var b, c, d = [], f; for (b = 0; b < a.length && !f; ++b)c = a[b], ("string" == typeof c || c instanceof CKEDITOR.style) && this.check(c) && (f = c); if (f) { for (b = 0; b < a.length; ++b)d.push(x(a[b], f)); this.addTransformations(d) } } }, addElementCallback: function (a) { this.elementCallbacks || (this.elementCallbacks = []); this.elementCallbacks.push(a) }, addFeature: function (a) {
                    if (this.disabled || !a) return !0; a.toFeature && (a = a.toFeature(this.editor)); this.allow(a.allowedContent, a.name); this.addTransformations(a.contentTransformations);
                    this.addContentForms(a.contentForms); return a.requiredContent && (this.customConfig || this.disallowedContent.length) ? this.check(a.requiredContent) : !0
                }, addTransformations: function (a) {
                    var b, c; if (!this.disabled && a) {
                        var d = this._.transformations, f; for (f = 0; f < a.length; ++f) {
                            b = a[f]; var g = void 0, e = void 0, l = void 0, h = void 0, k = void 0, r = void 0; c = []; for (e = 0; e < b.length; ++e)l = b[e], "string" == typeof l ? (l = l.split(/\s*:\s*/), h = l[0], k = null, r = l[1]) : (h = l.check, k = l.left, r = l.right), g || (g = l, g = g.element ? g.element : h ? h.match(/^([a-z0-9]+)/i)[0] :
                                g.left.getDefinition().element), k instanceof CKEDITOR.style && (k = B(k)), c.push({ check: h == g ? null : h, left: k, right: "string" == typeof r ? D(r) : r }); b = g; d[b] || (d[b] = []); d[b].push(c)
                        }
                    }
                }, check: function (a, b, c) {
                    if (this.disabled) return !0; if (CKEDITOR.tools.isArray(a)) { for (var d = a.length; d--;)if (this.check(a[d], b, c)) return !0; return !1 } var f, e; if ("string" == typeof a) {
                        e = a + "\x3c" + (!1 === b ? "0" : "1") + (c ? "1" : "0") + "\x3e"; if (e in this._.cachedChecks) return this._.cachedChecks[e]; d = g(a).$1; f = d.styles; var h = d.classes; d.name = d.elements;
                        d.classes = h = h ? h.split(/\s*,\s*/) : []; d.styles = l(f); d.attributes = l(d.attributes); d.children = []; h.length && (d.attributes["class"] = h.join(" ")); f && (d.attributes.style = CKEDITOR.tools.writeCssText(d.styles)); f = d
                    } else d = a.getDefinition(), f = d.styles, h = d.attributes || {}, f && !CKEDITOR.tools.isEmpty(f) ? (f = E(f), h.style = CKEDITOR.tools.writeCssText(f, !0)) : f = {}, f = { name: d.element, attributes: h, classes: h["class"] ? h["class"].split(/\s+/) : [], styles: f, children: [] }; var h = CKEDITOR.tools.clone(f), k = [], r; if (!1 !== b && (r = this._.transformations[f.name])) {
                        for (d =
                            0; d < r.length; ++d)w(this, f, r[d]); t(f)
                    } u(this, h, k, { doFilter: !0, doTransform: !1 !== b, skipRequired: !c, skipFinalValidation: !c }); b = 0 < k.length ? !1 : CKEDITOR.tools.objectCompare(f.attributes, h.attributes, !0) ? !0 : !1; "string" == typeof a && (this._.cachedChecks[e] = b); return b
                }, getAllowedEnterMode: function () {
                    var a = ["p", "div", "br"], b = { p: CKEDITOR.ENTER_P, div: CKEDITOR.ENTER_DIV, br: CKEDITOR.ENTER_BR }; return function (c, d) {
                        var f = a.slice(), g; if (this.check(G[c])) return c; for (d || (f = f.reverse()); g = f.pop();)if (this.check(g)) return b[g];
                        return CKEDITOR.ENTER_BR
                    }
                }(), destroy: function () { delete CKEDITOR.filter.instances[this.id]; delete this._; delete this.allowedContent; delete this.disallowedContent }
            }; var L = { styles: 1, attributes: 1, classes: 1 }, N = { styles: "requiredStyles", attributes: "requiredAttributes", classes: "requiredClasses" }, H = /^([a-z0-9\-*\s]+)((?:\s*\{[!\w\-,\s\*]+\}\s*|\s*\[[!\w\-,\s\*]+\]\s*|\s*\([!\w\-,\s\*]+\)\s*){0,3})(?:;\s*|$)/i, R = { styles: /{([^}]+)}/, attrs: /\[([^\]]+)\]/, classes: /\(([^\)]+)\)/ }, P = /^cke:(object|embed|param)$/,
                T = /^(object|embed|param)$/, O; O = CKEDITOR.filter.transformationsTools = {
                    sizeToStyle: function (a) { this.lengthToStyle(a, "width"); this.lengthToStyle(a, "height") }, sizeToAttribute: function (a) { this.lengthToAttribute(a, "width"); this.lengthToAttribute(a, "height") }, lengthToStyle: function (a, b, c) { c = c || b; if (!(c in a.styles)) { var d = a.attributes[b]; d && (/^\d+$/.test(d) && (d += "px"), a.styles[c] = d) } delete a.attributes[b] }, lengthToAttribute: function (a, b, c) {
                        c = c || b; if (!(c in a.attributes)) {
                            var d = a.styles[b], f = d && d.match(/^(\d+)(?:\.\d*)?px$/);
                            f ? a.attributes[c] = f[1] : "cke-test" == d && (a.attributes[c] = "cke-test")
                        } delete a.styles[b]
                    }, alignmentToStyle: function (a) { if (!("float" in a.styles)) { var b = a.attributes.align; if ("left" == b || "right" == b) a.styles["float"] = b } delete a.attributes.align }, alignmentToAttribute: function (a) { if (!("align" in a.attributes)) { var b = a.styles["float"]; if ("left" == b || "right" == b) a.attributes.align = b } delete a.styles["float"] }, matchesStyle: C, transform: function (a, b) {
                        if ("string" == typeof b) a.name = b; else {
                            var c = b.getDefinition(), d = c.styles,
                            f = c.attributes, g, e, l, h; a.name = c.element; for (g in f) if ("class" == g) for (c = a.classes.join("|"), l = f[g].split(/\s+/); h = l.pop();)-1 == c.indexOf(h) && a.classes.push(h); else a.attributes[g] = f[g]; for (e in d) a.styles[e] = d[e]
                        }
                    }
                }
        }(), function () {
            CKEDITOR.focusManager = function (a) { if (a.focusManager) return a.focusManager; this.hasFocus = !1; this.currentActive = null; this._ = { editor: a }; return this }; CKEDITOR.focusManager._ = { blurDelay: 200 }; CKEDITOR.focusManager.prototype = {
                focus: function (a) {
                    this._.timer && clearTimeout(this._.timer);
                    a && (this.currentActive = a); this.hasFocus || this._.locked || ((a = CKEDITOR.currentInstance) && a.focusManager.blur(1), this.hasFocus = !0, (a = this._.editor.container) && a.addClass("cke_focus"), this._.editor.fire("focus"))
                }, lock: function () { this._.locked = 1 }, unlock: function () { delete this._.locked }, blur: function (a) {
                    function e() { if (this.hasFocus) { this.hasFocus = !1; var a = this._.editor.container; a && a.removeClass("cke_focus"); this._.editor.fire("blur") } } if (!this._.locked) {
                        this._.timer && clearTimeout(this._.timer); var b =
                            CKEDITOR.focusManager._.blurDelay; a || !b ? e.call(this) : this._.timer = CKEDITOR.tools.setTimeout(function () { delete this._.timer; e.call(this) }, b, this)
                    }
                }, add: function (a, e) {
                    var b = a.getCustomData("focusmanager"); if (!b || b != this) {
                        b && b.remove(a); var b = "focus", c = "blur"; e && (CKEDITOR.env.ie ? (b = "focusin", c = "focusout") : CKEDITOR.event.useCapture = 1); var d = { blur: function () { a.equals(this.currentActive) && this.blur() }, focus: function () { this.focus(a) } }; a.on(b, d.focus, this); a.on(c, d.blur, this); e && (CKEDITOR.event.useCapture =
                            0); a.setCustomData("focusmanager", this); a.setCustomData("focusmanager_handlers", d)
                    }
                }, remove: function (a) { a.removeCustomData("focusmanager"); var e = a.removeCustomData("focusmanager_handlers"); a.removeListener("blur", e.blur); a.removeListener("focus", e.focus) }
            }
        }(), CKEDITOR.keystrokeHandler = function (a) { if (a.keystrokeHandler) return a.keystrokeHandler; this.keystrokes = {}; this.blockedKeystrokes = {}; this._ = { editor: a }; return this }, function () {
            var a, e = function (b) {
                b = b.data; var d = b.getKeystroke(), e = this.keystrokes[d],
                    m = this._.editor; a = !1 === m.fire("key", { keyCode: d, domEvent: b }); a || (e && (a = !1 !== m.execCommand(e, { from: "keystrokeHandler" })), a || (a = !!this.blockedKeystrokes[d])); a && b.preventDefault(!0); return !a
            }, b = function (b) { a && (a = !1, b.data.preventDefault(!0)) }; CKEDITOR.keystrokeHandler.prototype = { attach: function (a) { a.on("keydown", e, this); if (CKEDITOR.env.gecko && CKEDITOR.env.mac) a.on("keypress", b, this) } }
        }(), function () {
            CKEDITOR.lang = {
                languages: {
                    af: 1, ar: 1, bg: 1, bn: 1, bs: 1, ca: 1, cs: 1, cy: 1, da: 1, de: 1, "de-ch": 1, el: 1, "en-au": 1, "en-ca": 1,
                    "en-gb": 1, en: 1, eo: 1, es: 1, et: 1, eu: 1, fa: 1, fi: 1, fo: 1, "fr-ca": 1, fr: 1, gl: 1, gu: 1, he: 1, hi: 1, hr: 1, hu: 1, id: 1, is: 1, it: 1, ja: 1, ka: 1, km: 1, ko: 1, ku: 1, lt: 1, lv: 1, mk: 1, mn: 1, ms: 1, nb: 1, nl: 1, no: 1, pl: 1, "pt-br": 1, pt: 1, ro: 1, ru: 1, si: 1, sk: 1, sl: 1, sq: 1, "sr-latn": 1, sr: 1, sv: 1, th: 1, tr: 1, tt: 1, ug: 1, uk: 1, vi: 1, "zh-cn": 1, zh: 1
                }, rtl: { ar: 1, fa: 1, he: 1, ku: 1, ug: 1 }, load: function (a, e, b) {
                    a && CKEDITOR.lang.languages[a] || (a = this.detect(e, a)); var c = this; e = function () { c[a].dir = c.rtl[a] ? "rtl" : "ltr"; b(a, c[a]) }; this[a] ? e() : CKEDITOR.scriptLoader.load(CKEDITOR.getUrl("lang/" +
                        a + ".js"), e, this)
                }, detect: function (a, e) { var b = this.languages; e = e || navigator.userLanguage || navigator.language || a; var c = e.toLowerCase().match(/([a-z]+)(?:-([a-z]+))?/), d = c[1], c = c[2]; b[d + "-" + c] ? d = d + "-" + c : b[d] || (d = null); CKEDITOR.lang.detect = d ? function () { return d } : function (a) { return a }; return d || a }
            }
        }(), CKEDITOR.scriptLoader = function () {
            var a = {}, e = {}; return {
                load: function (b, c, d, k) {
                    var m = "string" == typeof b; m && (b = [b]); d || (d = CKEDITOR); var f = b.length, h = [], l = [], g = function (a) { c && (m ? c.call(d, a) : c.call(d, h, l)) }; if (0 ===
                        f) g(!0); else {
                            var n = function (a, b) { (b ? h : l).push(a); 0 >= --f && (k && CKEDITOR.document.getDocumentElement().removeStyle("cursor"), g(b)) }, v = function (b, c) { a[b] = 1; var d = e[b]; delete e[b]; for (var f = 0; f < d.length; f++)d[f](b, c) }, u = function (b) {
                                if (a[b]) n(b, !0); else {
                                    var d = e[b] || (e[b] = []); d.push(n); if (!(1 < d.length)) {
                                        var f = new CKEDITOR.dom.element("script"); f.setAttributes({ type: "text/javascript", src: b }); c && (CKEDITOR.env.ie && 8 >= CKEDITOR.env.version ? f.$.onreadystatechange = function () {
                                            if ("loaded" == f.$.readyState || "complete" ==
                                                f.$.readyState) f.$.onreadystatechange = null, v(b, !0)
                                        } : (f.$.onload = function () { setTimeout(function () { v(b, !0) }, 0) }, f.$.onerror = function () { v(b, !1) })); f.appendTo(CKEDITOR.document.getHead())
                                    }
                                }
                            }; k && CKEDITOR.document.getDocumentElement().setStyle("cursor", "wait"); for (var q = 0; q < f; q++)u(b[q])
                    }
                }, queue: function () {
                    function a() { var b; (b = c[0]) && this.load(b.scriptUrl, b.callback, CKEDITOR, 0) } var c = []; return function (d, e) {
                        var m = this; c.push({ scriptUrl: d, callback: function () { e && e.apply(this, arguments); c.shift(); a.call(m) } });
                        1 == c.length && a.call(this)
                    }
                }()
            }
        }(), CKEDITOR.resourceManager = function (a, e) { this.basePath = a; this.fileName = e; this.registered = {}; this.loaded = {}; this.externals = {}; this._ = { waitingList: {} } }, CKEDITOR.resourceManager.prototype = {
            add: function (a, e) { if (this.registered[a]) throw Error('[CKEDITOR.resourceManager.add] The resource name "' + a + '" is already registered.'); var b = this.registered[a] = e || {}; b.name = a; b.path = this.getPath(a); CKEDITOR.fire(a + CKEDITOR.tools.capitalize(this.fileName) + "Ready", b); return this.get(a) },
            get: function (a) { return this.registered[a] || null }, getPath: function (a) { var e = this.externals[a]; return CKEDITOR.getUrl(e && e.dir || this.basePath + a + "/") }, getFilePath: function (a) { var e = this.externals[a]; return CKEDITOR.getUrl(this.getPath(a) + (e ? e.file : this.fileName + ".js")) }, addExternal: function (a, e, b) { a = a.split(","); for (var c = 0; c < a.length; c++) { var d = a[c]; b || (e = e.replace(/[^\/]+$/, function (a) { b = a; return "" })); this.externals[d] = { dir: e, file: b || this.fileName + ".js" } } }, load: function (a, e, b) {
                CKEDITOR.tools.isArray(a) ||
                (a = a ? [a] : []); for (var c = this.loaded, d = this.registered, k = [], m = {}, f = {}, h = 0; h < a.length; h++) { var l = a[h]; if (l) if (c[l] || d[l]) f[l] = this.get(l); else { var g = this.getFilePath(l); k.push(g); g in m || (m[g] = []); m[g].push(l) } } CKEDITOR.scriptLoader.load(k, function (a, d) { if (d.length) throw Error('[CKEDITOR.resourceManager.load] Resource name "' + m[d[0]].join(",") + '" was not found at "' + d[0] + '".'); for (var g = 0; g < a.length; g++)for (var l = m[a[g]], h = 0; h < l.length; h++) { var k = l[h]; f[k] = this.get(k); c[k] = 1 } e.call(b, f) }, this)
            }
        }, CKEDITOR.plugins =
        new CKEDITOR.resourceManager("plugins/", "plugin"), CKEDITOR.plugins.load = CKEDITOR.tools.override(CKEDITOR.plugins.load, function (a) {
            var e = {}; return function (b, c, d) {
                var k = {}, m = function (b) {
                    a.call(this, b, function (a) {
                        CKEDITOR.tools.extend(k, a); var b = [], f; for (f in a) {
                            var n = a[f], v = n && n.requires; if (!e[f]) { if (n.icons) for (var u = n.icons.split(","), q = u.length; q--;)CKEDITOR.skin.addIcon(u[q], n.path + "icons/" + (CKEDITOR.env.hidpi && n.hidpi ? "hidpi/" : "") + u[q] + ".png"); e[f] = 1 } if (v) for (v.split && (v = v.split(",")), n = 0; n < v.length; n++)k[v[n]] ||
                                b.push(v[n])
                        } if (b.length) m.call(this, b); else { for (f in k) n = k[f], n.onLoad && !n.onLoad._called && (!1 === n.onLoad() && delete k[f], n.onLoad._called = 1); c && c.call(d || window, k) }
                    }, this)
                }; m.call(this, b)
            }
        }), CKEDITOR.plugins.setLang = function (a, e, b) { var c = this.get(a); a = c.langEntries || (c.langEntries = {}); c = c.lang || (c.lang = []); c.split && (c = c.split(",")); -1 == CKEDITOR.tools.indexOf(c, e) && c.push(e); a[e] = b }, CKEDITOR.ui = function (a) { if (a.ui) return a.ui; this.items = {}; this.instances = {}; this.editor = a; this._ = { handlers: {} }; return this },
        CKEDITOR.ui.prototype = {
            add: function (a, e, b) { b.name = a.toLowerCase(); var c = this.items[a] = { type: e, command: b.command || null, args: Array.prototype.slice.call(arguments, 2) }; CKEDITOR.tools.extend(c, b) }, get: function (a) { return this.instances[a] }, create: function (a) { var e = this.items[a], b = e && this._.handlers[e.type], c = e && e.command && this.editor.getCommand(e.command), b = b && b.create.apply(this, e.args); this.instances[a] = b; c && c.uiItems.push(b); b && !b.type && (b.type = e.type); return b }, addHandler: function (a, e) {
                this._.handlers[a] =
                e
            }, space: function (a) { return CKEDITOR.document.getById(this.spaceId(a)) }, spaceId: function (a) { return this.editor.id + "_" + a }
        }, CKEDITOR.event.implementOn(CKEDITOR.ui), function () {
            function a(a, d, g) {
                CKEDITOR.event.call(this); a = a && CKEDITOR.tools.clone(a); if (void 0 !== d) {
                    if (!(d instanceof CKEDITOR.dom.element)) throw Error("Expect element of type CKEDITOR.dom.element."); if (!g) throw Error("One of the element modes must be specified."); if (CKEDITOR.env.ie && CKEDITOR.env.quirks && g == CKEDITOR.ELEMENT_MODE_INLINE) throw Error("Inline element mode is not supported on IE quirks.");
                    if (!b(d, g)) throw Error('The specified element mode is not supported on element: "' + d.getName() + '".'); this.element = d; this.elementMode = g; this.name = this.elementMode != CKEDITOR.ELEMENT_MODE_APPENDTO && (d.getId() || d.getNameAtt())
                } else this.elementMode = CKEDITOR.ELEMENT_MODE_NONE; this._ = {}; this.commands = {}; this.templates = {}; this.name = this.name || e(); this.id = CKEDITOR.tools.getNextId(); this.status = "unloaded"; this.config = CKEDITOR.tools.prototypedCopy(CKEDITOR.config); this.ui = new CKEDITOR.ui(this); this.focusManager =
                    new CKEDITOR.focusManager(this); this.keystrokeHandler = new CKEDITOR.keystrokeHandler(this); this.on("readOnly", c); this.on("selectionChange", function (a) { k(this, a.data.path) }); this.on("activeFilterChange", function () { k(this, this.elementPath(), !0) }); this.on("mode", c); this.on("instanceReady", function () { this.config.startupFocus && this.focus() }); CKEDITOR.fire("instanceCreated", null, this); CKEDITOR.add(this); CKEDITOR.tools.setTimeout(function () { "destroyed" !== this.status ? f(this, a) : CKEDITOR.warn("editor-incorrect-destroy") },
                        0, this)
            } function e() { do var a = "editor" + ++u; while (CKEDITOR.instances[a]); return a } function b(a, b) { return b == CKEDITOR.ELEMENT_MODE_INLINE ? a.is(CKEDITOR.dtd.$editable) || a.is("textarea") : b == CKEDITOR.ELEMENT_MODE_REPLACE ? !a.is(CKEDITOR.dtd.$nonBodyContent) : 1 } function c() { var a = this.commands, b; for (b in a) d(this, a[b]) } function d(a, b) { b[b.startDisabled ? "disable" : a.readOnly && !b.readOnly ? "disable" : b.modes[a.mode] ? "enable" : "disable"]() } function k(a, b, c) {
                if (b) {
                    var d, f, g = a.commands; for (f in g) d = g[f], (c || d.contextSensitive) &&
                        d.refresh(a, b)
                }
            } function m(a) { var b = a.config.customConfig; if (!b) return !1; var b = CKEDITOR.getUrl(b), c = q[b] || (q[b] = {}); c.fn ? (c.fn.call(a, a.config), CKEDITOR.getUrl(a.config.customConfig) != b && m(a) || a.fireOnce("customConfigLoaded")) : CKEDITOR.scriptLoader.queue(b, function () { c.fn = CKEDITOR.editorConfig ? CKEDITOR.editorConfig : function () { }; m(a) }); return !0 } function f(a, b) {
                a.on("customConfigLoaded", function () {
                    if (b) { if (b.on) for (var c in b.on) a.on(c, b.on[c]); CKEDITOR.tools.extend(a.config, b, !0); delete a.config.on } c =
                        a.config; a.readOnly = c.readOnly ? !0 : a.elementMode == CKEDITOR.ELEMENT_MODE_INLINE ? a.element.is("textarea") ? a.element.hasAttribute("disabled") || a.element.hasAttribute("readonly") : a.element.isReadOnly() : a.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE ? a.element.hasAttribute("disabled") || a.element.hasAttribute("readonly") : !1; a.blockless = a.elementMode == CKEDITOR.ELEMENT_MODE_INLINE ? !(a.element.is("textarea") || CKEDITOR.dtd[a.element.getName()].p) : !1; a.tabIndex = c.tabIndex || a.element && a.element.getAttribute("tabindex") ||
                            0; a.activeEnterMode = a.enterMode = a.blockless ? CKEDITOR.ENTER_BR : c.enterMode; a.activeShiftEnterMode = a.shiftEnterMode = a.blockless ? CKEDITOR.ENTER_BR : c.shiftEnterMode; c.skin && (CKEDITOR.skinName = c.skin); a.fireOnce("configLoaded"); a.dataProcessor = new CKEDITOR.htmlDataProcessor(a); a.filter = a.activeFilter = new CKEDITOR.filter(a); h(a)
                }); b && null != b.customConfig && (a.config.customConfig = b.customConfig); m(a) || a.fireOnce("customConfigLoaded")
            } function h(a) { CKEDITOR.skin.loadPart("editor", function () { l(a) }) } function l(a) {
                CKEDITOR.lang.load(a.config.language,
                    a.config.defaultLanguage, function (b, c) { var d = a.config.title; a.langCode = b; a.lang = CKEDITOR.tools.prototypedCopy(c); a.title = "string" == typeof d || !1 === d ? d : [a.lang.editor, a.name].join(", "); a.config.contentsLangDirection || (a.config.contentsLangDirection = a.elementMode == CKEDITOR.ELEMENT_MODE_INLINE ? a.element.getDirection(1) : a.lang.dir); a.fire("langLoaded"); g(a) })
            } function g(a) { a.getStylesSet(function (b) { a.once("loaded", function () { a.fire("stylesSet", { styles: b }) }, null, null, 1); n(a) }) } function n(a) {
                var b = a.config,
                c = b.plugins, d = b.extraPlugins, f = b.removePlugins; if (d) var g = new RegExp("(?:^|,)(?:" + d.replace(/\s*,\s*/g, "|") + ")(?\x3d,|$)", "g"), c = c.replace(g, ""), c = c + ("," + d); if (f) var e = new RegExp("(?:^|,)(?:" + f.replace(/\s*,\s*/g, "|") + ")(?\x3d,|$)", "g"), c = c.replace(e, ""); CKEDITOR.env.air && (c += ",adobeair"); CKEDITOR.plugins.load(c.split(","), function (c) {
                    var d = [], f = [], g = []; a.plugins = c; for (var l in c) {
                        var h = c[l], k = h.lang, r = null, m = h.requires, z; CKEDITOR.tools.isArray(m) && (m = m.join(",")); if (m && (z = m.match(e))) for (; m = z.pop();)CKEDITOR.error("editor-plugin-required",
                            { plugin: m.replace(",", ""), requiredBy: l }); k && !a.lang[l] && (k.split && (k = k.split(",")), 0 <= CKEDITOR.tools.indexOf(k, a.langCode) ? r = a.langCode : (r = a.langCode.replace(/-.*/, ""), r = r != a.langCode && 0 <= CKEDITOR.tools.indexOf(k, r) ? r : 0 <= CKEDITOR.tools.indexOf(k, "en") ? "en" : k[0]), h.langEntries && h.langEntries[r] ? (a.lang[l] = h.langEntries[r], r = null) : g.push(CKEDITOR.getUrl(h.path + "lang/" + r + ".js"))); f.push(r); d.push(h)
                    } CKEDITOR.scriptLoader.load(g, function () {
                        for (var c = ["beforeInit", "init", "afterInit"], g = 0; g < c.length; g++)for (var e =
                            0; e < d.length; e++) { var l = d[e]; 0 === g && f[e] && l.lang && l.langEntries && (a.lang[l.name] = l.langEntries[f[e]]); if (l[c[g]]) l[c[g]](a) } a.fireOnce("pluginsLoaded"); b.keystrokes && a.setKeystroke(a.config.keystrokes); for (e = 0; e < a.config.blockedKeystrokes.length; e++)a.keystrokeHandler.blockedKeystrokes[a.config.blockedKeystrokes[e]] = 1; a.status = "loaded"; a.fireOnce("loaded"); CKEDITOR.fire("instanceLoaded", null, a)
                    })
                })
            } function v() {
                var a = this.element; if (a && this.elementMode != CKEDITOR.ELEMENT_MODE_APPENDTO) {
                    var b = this.getData();
                    this.config.htmlEncodeOutput && (b = CKEDITOR.tools.htmlEncode(b)); a.is("textarea") ? a.setValue(b) : a.setHtml(b); return !0
                } return !1
            } a.prototype = CKEDITOR.editor.prototype; CKEDITOR.editor = a; var u = 0, q = {}; CKEDITOR.tools.extend(CKEDITOR.editor.prototype, {
                addCommand: function (a, b) { b.name = a.toLowerCase(); var c = new CKEDITOR.command(this, b); this.mode && d(this, c); return this.commands[a] = c }, _attachToForm: function () {
                    function a(b) { c.updateElement(); c._.required && !d.getValue() && !1 === c.fire("required") && b.data.preventDefault() }
                    function b(a) { return !!(a && a.call && a.apply) } var c = this, d = c.element, f = new CKEDITOR.dom.element(d.$.form); d.is("textarea") && f && (f.on("submit", a), b(f.$.submit) && (f.$.submit = CKEDITOR.tools.override(f.$.submit, function (b) { return function () { a(); b.apply ? b.apply(this) : b() } })), c.on("destroy", function () { f.removeListener("submit", a) }))
                }, destroy: function (a) {
                    this.fire("beforeDestroy"); !a && v.call(this); this.editable(null); this.filter && (this.filter.destroy(), delete this.filter); delete this.activeFilter; this.status =
                        "destroyed"; this.fire("destroy"); this.removeAllListeners(); CKEDITOR.remove(this); CKEDITOR.fire("instanceDestroyed", null, this)
                }, elementPath: function (a) { if (!a) { a = this.getSelection(); if (!a) return null; a = a.getStartElement() } return a ? new CKEDITOR.dom.elementPath(a, this.editable()) : null }, createRange: function () { var a = this.editable(); return a ? new CKEDITOR.dom.range(a) : null }, execCommand: function (a, b) {
                    var c = this.getCommand(a), d = { name: a, commandData: b, command: c }; return c && c.state != CKEDITOR.TRISTATE_DISABLED &&
                        !1 !== this.fire("beforeCommandExec", d) && (d.returnValue = c.exec(d.commandData), !c.async && !1 !== this.fire("afterCommandExec", d)) ? d.returnValue : !1
                }, getCommand: function (a) { return this.commands[a] }, getData: function (a) { !a && this.fire("beforeGetData"); var b = this._.data; "string" != typeof b && (b = (b = this.element) && this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE ? b.is("textarea") ? b.getValue() : b.getHtml() : ""); b = { dataValue: b }; !a && this.fire("getData", b); return b.dataValue }, getSnapshot: function () {
                    var a = this.fire("getSnapshot");
                    "string" != typeof a && (a = (a = this.element) && this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE ? a.is("textarea") ? a.getValue() : a.getHtml() : ""); return a
                }, loadSnapshot: function (a) { this.fire("loadSnapshot", a) }, setData: function (a, b, c) {
                    var d = !0, f = b; b && "object" == typeof b && (c = b.internal, f = b.callback, d = !b.noSnapshot); !c && d && this.fire("saveSnapshot"); if (f || !c) this.once("dataReady", function (a) { !c && d && this.fire("saveSnapshot"); f && f.call(a.editor) }); a = { dataValue: a }; !c && this.fire("setData", a); this._.data = a.dataValue;
                    !c && this.fire("afterSetData", a)
                }, setReadOnly: function (a) { a = null == a || a; this.readOnly != a && (this.readOnly = a, this.keystrokeHandler.blockedKeystrokes[8] = +a, this.editable().setReadOnly(a), this.fire("readOnly")) }, insertHtml: function (a, b, c) { this.fire("insertHtml", { dataValue: a, mode: b, range: c }) }, insertText: function (a) { this.fire("insertText", a) }, insertElement: function (a) { this.fire("insertElement", a) }, getSelectedHtml: function (a) {
                    var b = this.editable(), c = this.getSelection(), c = c && c.getRanges(); if (!b || !c || 0 === c.length) return null;
                    for (var d = new CKEDITOR.dom.documentFragment, f, g, e, l = 0; l < c.length; l++) { var h = c[l], k = h.startContainer; k.getName && "tr" == k.getName() ? (f || (f = k.getAscendant("table").clone(), f.append(k.getAscendant("tbody").clone()), d.append(f), f = f.findOne("tbody")), g && g.equals(k) || (g = k, e = k.clone(), f.append(e)), e.append(h.cloneContents())) : d.append(h.cloneContents()) } b = f ? d : b.getHtmlFromRange(c[0]); return a ? b.getHtml() : b
                }, extractSelectedHtml: function (a, b) {
                    var c = this.editable(), d = this.getSelection().getRanges(); if (!c || 0 ===
                        d.length) return null; d = d[0]; c = c.extractHtmlFromRange(d, b); b || this.getSelection().selectRanges([d]); return a ? c.getHtml() : c
                }, focus: function () { this.fire("beforeFocus") }, checkDirty: function () { return "ready" == this.status && this._.previousValue !== this.getSnapshot() }, resetDirty: function () { this._.previousValue = this.getSnapshot() }, updateElement: function () { return v.call(this) }, setKeystroke: function () {
                    for (var a = this.keystrokeHandler.keystrokes, b = CKEDITOR.tools.isArray(arguments[0]) ? arguments[0] : [[].slice.call(arguments,
                        0)], c, d, f = b.length; f--;)c = b[f], d = 0, CKEDITOR.tools.isArray(c) && (d = c[1], c = c[0]), d ? a[c] = d : delete a[c]
                }, addFeature: function (a) { return this.filter.addFeature(a) }, setActiveFilter: function (a) { a || (a = this.filter); this.activeFilter !== a && (this.activeFilter = a, this.fire("activeFilterChange"), a === this.filter ? this.setActiveEnterMode(null, null) : this.setActiveEnterMode(a.getAllowedEnterMode(this.enterMode), a.getAllowedEnterMode(this.shiftEnterMode, !0))) }, setActiveEnterMode: function (a, b) {
                    a = a ? this.blockless ? CKEDITOR.ENTER_BR :
                        a : this.enterMode; b = b ? this.blockless ? CKEDITOR.ENTER_BR : b : this.shiftEnterMode; if (this.activeEnterMode != a || this.activeShiftEnterMode != b) this.activeEnterMode = a, this.activeShiftEnterMode = b, this.fire("activeEnterModeChange")
                }, showNotification: function (a) { alert(a) }
            })
        }(), CKEDITOR.ELEMENT_MODE_NONE = 0, CKEDITOR.ELEMENT_MODE_REPLACE = 1, CKEDITOR.ELEMENT_MODE_APPENDTO = 2, CKEDITOR.ELEMENT_MODE_INLINE = 3, CKEDITOR.htmlParser = function () { this._ = { htmlPartsRegex: /<(?:(?:\/([^>]+)>)|(?:!--([\S|\s]*?)--\x3e)|(?:([^\/\s>]+)((?:\s+[\w\-:.]+(?:\s*=\s*?(?:(?:"[^"]*")|(?:'[^']*')|[^\s"'\/>]+))?)*)[\S\s]*?(\/?)>))/g } },
        function () {
            var a = /([\w\-:.]+)(?:(?:\s*=\s*(?:(?:"([^"]*)")|(?:'([^']*)')|([^\s>]+)))|(?=\s|$))/g, e = { checked: 1, compact: 1, declare: 1, defer: 1, disabled: 1, ismap: 1, multiple: 1, nohref: 1, noresize: 1, noshade: 1, nowrap: 1, readonly: 1, selected: 1 }; CKEDITOR.htmlParser.prototype = {
                onTagOpen: function () { }, onTagClose: function () { }, onText: function () { }, onCDATA: function () { }, onComment: function () { }, parse: function (b) {
                    for (var c, d, k = 0, m; c = this._.htmlPartsRegex.exec(b);) {
                        d = c.index; if (d > k) if (k = b.substring(k, d), m) m.push(k); else this.onText(k);
                        k = this._.htmlPartsRegex.lastIndex; if (d = c[1]) if (d = d.toLowerCase(), m && CKEDITOR.dtd.$cdata[d] && (this.onCDATA(m.join("")), m = null), !m) { this.onTagClose(d); continue } if (m) m.push(c[0]); else if (d = c[3]) { if (d = d.toLowerCase(), !/="/.test(d)) { var f = {}, h, l = c[4]; c = !!c[5]; if (l) for (; h = a.exec(l);) { var g = h[1].toLowerCase(); h = h[2] || h[3] || h[4] || ""; f[g] = !h && e[g] ? g : CKEDITOR.tools.htmlDecodeAttr(h) } this.onTagOpen(d, f, c); !m && CKEDITOR.dtd.$cdata[d] && (m = []) } } else if (d = c[2]) this.onComment(d)
                    } if (b.length > k) this.onText(b.substring(k,
                        b.length))
                }
            }
        }(), CKEDITOR.htmlParser.basicWriter = CKEDITOR.tools.createClass({
            $: function () { this._ = { output: [] } }, proto: {
                openTag: function (a) { this._.output.push("\x3c", a) }, openTagClose: function (a, e) { e ? this._.output.push(" /\x3e") : this._.output.push("\x3e") }, attribute: function (a, e) { "string" == typeof e && (e = CKEDITOR.tools.htmlEncodeAttr(e)); this._.output.push(" ", a, '\x3d"', e, '"') }, closeTag: function (a) { this._.output.push("\x3c/", a, "\x3e") }, text: function (a) { this._.output.push(a) }, comment: function (a) {
                    this._.output.push("\x3c!--",
                        a, "--\x3e")
                }, write: function (a) { this._.output.push(a) }, reset: function () { this._.output = []; this._.indent = !1 }, getHtml: function (a) { var e = this._.output.join(""); a && this.reset(); return e }
            }
        }), "use strict", function () {
            CKEDITOR.htmlParser.node = function () { }; CKEDITOR.htmlParser.node.prototype = {
                remove: function () { var a = this.parent.children, e = CKEDITOR.tools.indexOf(a, this), b = this.previous, c = this.next; b && (b.next = c); c && (c.previous = b); a.splice(e, 1); this.parent = null }, replaceWith: function (a) {
                    var e = this.parent.children,
                    b = CKEDITOR.tools.indexOf(e, this), c = a.previous = this.previous, d = a.next = this.next; c && (c.next = a); d && (d.previous = a); e[b] = a; a.parent = this.parent; this.parent = null
                }, insertAfter: function (a) { var e = a.parent.children, b = CKEDITOR.tools.indexOf(e, a), c = a.next; e.splice(b + 1, 0, this); this.next = a.next; this.previous = a; a.next = this; c && (c.previous = this); this.parent = a.parent }, insertBefore: function (a) {
                    var e = a.parent.children, b = CKEDITOR.tools.indexOf(e, a); e.splice(b, 0, this); this.next = a; (this.previous = a.previous) && (a.previous.next =
                        this); a.previous = this; this.parent = a.parent
                }, getAscendant: function (a) { var e = "function" == typeof a ? a : "string" == typeof a ? function (b) { return b.name == a } : function (b) { return b.name in a }, b = this.parent; for (; b && b.type == CKEDITOR.NODE_ELEMENT;) { if (e(b)) return b; b = b.parent } return null }, wrapWith: function (a) { this.replaceWith(a); a.add(this); return a }, getIndex: function () { return CKEDITOR.tools.indexOf(this.parent.children, this) }, getFilterContext: function (a) { return a || {} }
            }
        }(), "use strict", CKEDITOR.htmlParser.comment =
        function (a) { this.value = a; this._ = { isBlockLike: !1 } }, CKEDITOR.htmlParser.comment.prototype = CKEDITOR.tools.extend(new CKEDITOR.htmlParser.node, { type: CKEDITOR.NODE_COMMENT, filter: function (a, e) { var b = this.value; if (!(b = a.onComment(e, b, this))) return this.remove(), !1; if ("string" != typeof b) return this.replaceWith(b), !1; this.value = b; return !0 }, writeHtml: function (a, e) { e && this.filter(e); a.comment(this.value) } }), "use strict", function () {
            CKEDITOR.htmlParser.text = function (a) { this.value = a; this._ = { isBlockLike: !1 } }; CKEDITOR.htmlParser.text.prototype =
                CKEDITOR.tools.extend(new CKEDITOR.htmlParser.node, { type: CKEDITOR.NODE_TEXT, filter: function (a, e) { if (!(this.value = a.onText(e, this.value, this))) return this.remove(), !1 }, writeHtml: function (a, e) { e && this.filter(e); a.text(this.value) } })
        }(), "use strict", function () { CKEDITOR.htmlParser.cdata = function (a) { this.value = a }; CKEDITOR.htmlParser.cdata.prototype = CKEDITOR.tools.extend(new CKEDITOR.htmlParser.node, { type: CKEDITOR.NODE_TEXT, filter: function () { }, writeHtml: function (a) { a.write(this.value) } }) }(), "use strict",
        CKEDITOR.htmlParser.fragment = function () { this.children = []; this.parent = null; this._ = { isBlockLike: !0, hasInlineStarted: !1 } }, function () {
            function a(a) { return a.attributes["data-cke-survive"] ? !1 : "a" == a.name && a.attributes.href || CKEDITOR.dtd.$removeEmpty[a.name] } var e = CKEDITOR.tools.extend({ table: 1, ul: 1, ol: 1, dl: 1 }, CKEDITOR.dtd.table, CKEDITOR.dtd.ul, CKEDITOR.dtd.ol, CKEDITOR.dtd.dl), b = { ol: 1, ul: 1 }, c = CKEDITOR.tools.extend({}, { html: 1 }, CKEDITOR.dtd.html, CKEDITOR.dtd.body, CKEDITOR.dtd.head, { style: 1, script: 1 }), d = {
                ul: "li",
                ol: "li", dl: "dd", table: "tbody", tbody: "tr", thead: "tr", tfoot: "tr", tr: "td"
            }; CKEDITOR.htmlParser.fragment.fromHtml = function (k, m, f) {
                function h(a) { var b; if (0 < p.length) for (var c = 0; c < p.length; c++) { var d = p[c], f = d.name, g = CKEDITOR.dtd[f], e = A.name && CKEDITOR.dtd[A.name]; e && !e[f] || a && g && !g[a] && CKEDITOR.dtd[a] ? f == A.name && (n(A, A.parent, 1), c--) : (b || (l(), b = 1), d = d.clone(), d.parent = A, A = d, p.splice(c, 1), c--) } } function l() { for (; y.length;)n(y.shift(), A) } function g(a) {
                    if (a._.isBlockLike && "pre" != a.name && "textarea" != a.name) {
                        var b =
                            a.children.length, c = a.children[b - 1], d; c && c.type == CKEDITOR.NODE_TEXT && ((d = CKEDITOR.tools.rtrim(c.value)) ? c.value = d : a.children.length = b - 1)
                    }
                } function n(b, c, d) { c = c || A || t; var e = A; void 0 === b.previous && (v(c, b) && (A = c, q.onTagOpen(f, {}), b.returnPoint = c = A), g(b), a(b) && !b.children.length || c.add(b), "pre" == b.name && (r = !1), "textarea" == b.name && (z = !1)); b.returnPoint ? (A = b.returnPoint, delete b.returnPoint) : A = d ? c : e } function v(a, b) {
                    if ((a == t || "body" == a.name) && f && (!a.name || CKEDITOR.dtd[a.name][f])) {
                        var c, d; return (c = b.attributes &&
                            (d = b.attributes["data-cke-real-element-type"]) ? d : b.name) && c in CKEDITOR.dtd.$inline && !(c in CKEDITOR.dtd.head) && !b.isOrphan || b.type == CKEDITOR.NODE_TEXT
                    }
                } function u(a, b) { return a in CKEDITOR.dtd.$listItem || a in CKEDITOR.dtd.$tableContent ? a == b || "dt" == a && "dd" == b || "dd" == a && "dt" == b : !1 } var q = new CKEDITOR.htmlParser, t = m instanceof CKEDITOR.htmlParser.element ? m : "string" == typeof m ? new CKEDITOR.htmlParser.element(m) : new CKEDITOR.htmlParser.fragment, p = [], y = [], A = t, z = "textarea" == t.name, r = "pre" == t.name; q.onTagOpen =
                    function (d, f, g, k) {
                        f = new CKEDITOR.htmlParser.element(d, f); f.isUnknown && g && (f.isEmpty = !0); f.isOptionalClose = k; if (a(f)) p.push(f); else {
                            if ("pre" == d) r = !0; else { if ("br" == d && r) { A.add(new CKEDITOR.htmlParser.text("\n")); return } "textarea" == d && (z = !0) } if ("br" == d) y.push(f); else {
                                for (; !(k = (g = A.name) ? CKEDITOR.dtd[g] || (A._.isBlockLike ? CKEDITOR.dtd.div : CKEDITOR.dtd.span) : c, f.isUnknown || A.isUnknown || k[d]);)if (A.isOptionalClose) q.onTagClose(g); else if (d in b && g in b) g = A.children, (g = g[g.length - 1]) && "li" == g.name || n(g = new CKEDITOR.htmlParser.element("li"),
                                    A), !f.returnPoint && (f.returnPoint = A), A = g; else if (d in CKEDITOR.dtd.$listItem && !u(d, g)) q.onTagOpen("li" == d ? "ul" : "dl", {}, 0, 1); else if (g in e && !u(d, g)) !f.returnPoint && (f.returnPoint = A), A = A.parent; else if (g in CKEDITOR.dtd.$inline && p.unshift(A), A.parent) n(A, A.parent, 1); else { f.isOrphan = 1; break } h(d); l(); f.parent = A; f.isEmpty ? n(f) : A = f
                            }
                        }
                    }; q.onTagClose = function (a) {
                        for (var b = p.length - 1; 0 <= b; b--)if (a == p[b].name) { p.splice(b, 1); return } for (var c = [], d = [], g = A; g != t && g.name != a;)g._.isBlockLike || d.unshift(g), c.push(g),
                            g = g.returnPoint || g.parent; if (g != t) { for (b = 0; b < c.length; b++) { var e = c[b]; n(e, e.parent) } A = g; g._.isBlockLike && l(); n(g, g.parent); g == A && (A = A.parent); p = p.concat(d) } "body" == a && (f = !1)
                    }; q.onText = function (a) {
                        if (!(A._.hasInlineStarted && !y.length || r || z) && (a = CKEDITOR.tools.ltrim(a), 0 === a.length)) return; var b = A.name, g = b ? CKEDITOR.dtd[b] || (A._.isBlockLike ? CKEDITOR.dtd.div : CKEDITOR.dtd.span) : c; if (!z && !g["#"] && b in e) q.onTagOpen(d[b] || ""), q.onText(a); else {
                            l(); h(); r || z || (a = a.replace(/[\t\r\n ]{2,}|[\t\r\n]/g, " ")); a =
                                new CKEDITOR.htmlParser.text(a); if (v(A, a)) this.onTagOpen(f, {}, 0, 1); A.add(a)
                        }
                    }; q.onCDATA = function (a) { A.add(new CKEDITOR.htmlParser.cdata(a)) }; q.onComment = function (a) { l(); h(); A.add(new CKEDITOR.htmlParser.comment(a)) }; q.parse(k); for (l(); A != t;)n(A, A.parent, 1); g(t); return t
            }; CKEDITOR.htmlParser.fragment.prototype = {
                type: CKEDITOR.NODE_DOCUMENT_FRAGMENT, add: function (a, b) {
                    isNaN(b) && (b = this.children.length); var c = 0 < b ? this.children[b - 1] : null; if (c) {
                        if (a._.isBlockLike && c.type == CKEDITOR.NODE_TEXT && (c.value = CKEDITOR.tools.rtrim(c.value),
                            0 === c.value.length)) { this.children.pop(); this.add(a); return } c.next = a
                    } a.previous = c; a.parent = this; this.children.splice(b, 0, a); this._.hasInlineStarted || (this._.hasInlineStarted = a.type == CKEDITOR.NODE_TEXT || a.type == CKEDITOR.NODE_ELEMENT && !a._.isBlockLike)
                }, filter: function (a, b) { b = this.getFilterContext(b); a.onRoot(b, this); this.filterChildren(a, !1, b) }, filterChildren: function (a, b, c) {
                    if (this.childrenFilteredBy != a.id) {
                        c = this.getFilterContext(c); if (b && !this.parent) a.onRoot(c, this); this.childrenFilteredBy = a.id;
                        for (b = 0; b < this.children.length; b++)!1 === this.children[b].filter(a, c) && b--
                    }
                }, writeHtml: function (a, b) { b && this.filter(b); this.writeChildrenHtml(a) }, writeChildrenHtml: function (a, b, c) { var d = this.getFilterContext(); if (c && !this.parent && b) b.onRoot(d, this); b && this.filterChildren(b, !1, d); b = 0; c = this.children; for (d = c.length; b < d; b++)c[b].writeHtml(a) }, forEach: function (a, b, c) {
                    if (!(c || b && this.type != b)) var d = a(this); if (!1 !== d) {
                        c = this.children; for (var e = 0; e < c.length; e++)d = c[e], d.type == CKEDITOR.NODE_ELEMENT ? d.forEach(a,
                            b) : b && d.type != b || a(d)
                    }
                }, getFilterContext: function (a) { return a || {} }
            }
        }(), "use strict", function () {
            function a() { this.rules = [] } function e(b, c, d, e) { var m, f; for (m in c) (f = b[m]) || (f = b[m] = new a), f.add(c[m], d, e) } CKEDITOR.htmlParser.filter = CKEDITOR.tools.createClass({
                $: function (b) { this.id = CKEDITOR.tools.getNextNumber(); this.elementNameRules = new a; this.attributeNameRules = new a; this.elementsRules = {}; this.attributesRules = {}; this.textRules = new a; this.commentRules = new a; this.rootRules = new a; b && this.addRules(b, 10) },
                proto: {
                    addRules: function (a, c) {
                        var d; "number" == typeof c ? d = c : c && "priority" in c && (d = c.priority); "number" != typeof d && (d = 10); "object" != typeof c && (c = {}); a.elementNames && this.elementNameRules.addMany(a.elementNames, d, c); a.attributeNames && this.attributeNameRules.addMany(a.attributeNames, d, c); a.elements && e(this.elementsRules, a.elements, d, c); a.attributes && e(this.attributesRules, a.attributes, d, c); a.text && this.textRules.add(a.text, d, c); a.comment && this.commentRules.add(a.comment, d, c); a.root && this.rootRules.add(a.root,
                            d, c)
                    }, applyTo: function (a) { a.filter(this) }, onElementName: function (a, c) { return this.elementNameRules.execOnName(a, c) }, onAttributeName: function (a, c) { return this.attributeNameRules.execOnName(a, c) }, onText: function (a, c, d) { return this.textRules.exec(a, c, d) }, onComment: function (a, c, d) { return this.commentRules.exec(a, c, d) }, onRoot: function (a, c) { return this.rootRules.exec(a, c) }, onElement: function (a, c) {
                        for (var d = [this.elementsRules["^"], this.elementsRules[c.name], this.elementsRules.$], e, m = 0; 3 > m; m++)if (e = d[m]) {
                            e =
                            e.exec(a, c, this); if (!1 === e) return null; if (e && e != c) return this.onNode(a, e); if (c.parent && !c.name) break
                        } return c
                    }, onNode: function (a, c) { var d = c.type; return d == CKEDITOR.NODE_ELEMENT ? this.onElement(a, c) : d == CKEDITOR.NODE_TEXT ? new CKEDITOR.htmlParser.text(this.onText(a, c.value)) : d == CKEDITOR.NODE_COMMENT ? new CKEDITOR.htmlParser.comment(this.onComment(a, c.value)) : null }, onAttribute: function (a, c, d, e) { return (d = this.attributesRules[d]) ? d.exec(a, e, c, this) : e }
                }
            }); CKEDITOR.htmlParser.filterRulesGroup = a; a.prototype =
            {
                add: function (a, c, d) { this.rules.splice(this.findIndex(c), 0, { value: a, priority: c, options: d }) }, addMany: function (a, c, d) { for (var e = [this.findIndex(c), 0], m = 0, f = a.length; m < f; m++)e.push({ value: a[m], priority: c, options: d }); this.rules.splice.apply(this.rules, e) }, findIndex: function (a) { for (var c = this.rules, d = c.length - 1; 0 <= d && a < c[d].priority;)d--; return d + 1 }, exec: function (a, c) {
                    var d = c instanceof CKEDITOR.htmlParser.node || c instanceof CKEDITOR.htmlParser.fragment, e = Array.prototype.slice.call(arguments, 1), m = this.rules,
                    f = m.length, h, l, g, n; for (n = 0; n < f; n++)if (d && (h = c.type, l = c.name), g = m[n], !(a.nonEditable && !g.options.applyToAll || a.nestedEditable && g.options.excludeNestedEditable)) { g = g.value.apply(null, e); if (!1 === g || d && g && (g.name != l || g.type != h)) return g; null != g && (e[0] = c = g) } return c
                }, execOnName: function (a, c) { for (var d = 0, e = this.rules, m = e.length, f; c && d < m; d++)f = e[d], a.nonEditable && !f.options.applyToAll || a.nestedEditable && f.options.excludeNestedEditable || (c = c.replace(f.value[0], f.value[1])); return c }
            }
        }(), function () {
            function a(a,
                f) {
                    function g(a) { return a || CKEDITOR.env.needsNbspFiller ? new CKEDITOR.htmlParser.text("Â ") : new CKEDITOR.htmlParser.element("br", { "data-cke-bogus": 1 }) } function e(a, d) {
                        return function (f) {
                            if (f.type != CKEDITOR.NODE_DOCUMENT_FRAGMENT) {
                                var e = [], h = b(f), r, m; if (h) for (l(h, 1) && e.push(h); h;)k(h) && (r = c(h)) && l(r) && ((m = c(r)) && !k(m) ? e.push(r) : (g(z).insertAfter(r), r.remove())), h = h.previous; for (h = 0; h < e.length; h++)e[h].remove(); if (e = !a || !1 !== ("function" == typeof d ? d(f) : d)) z || CKEDITOR.env.needsBrFiller || f.type != CKEDITOR.NODE_DOCUMENT_FRAGMENT ?
                                    z || CKEDITOR.env.needsBrFiller || !(7 < document.documentMode || f.name in CKEDITOR.dtd.tr || f.name in CKEDITOR.dtd.$listItem) ? (e = b(f), e = !e || "form" == f.name && "input" == e.name) : e = !1 : e = !1; e && f.add(g(a))
                            }
                        }
                    } function l(a, b) {
                        if ((!z || CKEDITOR.env.needsBrFiller) && a.type == CKEDITOR.NODE_ELEMENT && "br" == a.name && !a.attributes["data-cke-eol"]) return !0; var c; return a.type == CKEDITOR.NODE_TEXT && (c = a.value.match(p)) && (c.index && ((new CKEDITOR.htmlParser.text(a.value.substring(0, c.index))).insertBefore(a), a.value = c[0]), !CKEDITOR.env.needsBrFiller &&
                            z && (!b || a.parent.name in w) || !z && ((c = a.previous) && "br" == c.name || !c || k(c))) ? !0 : !1
                    } var h = { elements: {} }, z = "html" == f, w = CKEDITOR.tools.extend({}, r), n; for (n in w) "#" in A[n] || delete w[n]; for (n in w) h.elements[n] = e(z, a.config.fillEmptyBlocks); h.root = e(z, !1); h.elements.br = function (a) {
                        return function (b) {
                            if (b.parent.type != CKEDITOR.NODE_DOCUMENT_FRAGMENT) {
                                var f = b.attributes; if ("data-cke-bogus" in f || "data-cke-eol" in f) delete f["data-cke-bogus"]; else {
                                    for (f = b.next; f && d(f);)f = f.next; var e = c(b); !f && k(b.parent) ? m(b.parent,
                                        g(a)) : k(f) && e && !k(e) && g(a).insertBefore(f)
                                }
                            }
                        }
                    }(z); return h
            } function e(a, b) { return a != CKEDITOR.ENTER_BR && !1 !== b ? a == CKEDITOR.ENTER_DIV ? "div" : "p" : !1 } function b(a) { for (a = a.children[a.children.length - 1]; a && d(a);)a = a.previous; return a } function c(a) { for (a = a.previous; a && d(a);)a = a.previous; return a } function d(a) { return a.type == CKEDITOR.NODE_TEXT && !CKEDITOR.tools.trim(a.value) || a.type == CKEDITOR.NODE_ELEMENT && a.attributes["data-cke-bookmark"] } function k(a) {
                return a && (a.type == CKEDITOR.NODE_ELEMENT && a.name in
                    r || a.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT)
            } function m(a, b) { var c = a.children[a.children.length - 1]; a.children.push(b); b.parent = a; c && (c.next = b, b.previous = c) } function f(a) { a = a.attributes; "false" != a.contenteditable && (a["data-cke-editable"] = a.contenteditable ? "true" : 1); a.contenteditable = "false" } function h(a) { a = a.attributes; switch (a["data-cke-editable"]) { case "true": a.contenteditable = "true"; break; case "1": delete a.contenteditable } } function l(a) {
                return a.replace(D, function (a, b, c) {
                    return "\x3c" + b + c.replace(F,
                        function (a, b) { return E.test(b) && -1 == c.indexOf("data-cke-saved-" + b) ? " data-cke-saved-" + a + " data-cke-" + CKEDITOR.rnd + "-" + a : a }) + "\x3e"
                })
            } function g(a, b) { return a.replace(b, function (a, b, c) { 0 === a.indexOf("\x3ctextarea") && (a = b + u(c).replace(/</g, "\x26lt;").replace(/>/g, "\x26gt;") + "\x3c/textarea\x3e"); return "\x3ccke:encoded\x3e" + encodeURIComponent(a) + "\x3c/cke:encoded\x3e" }) } function n(a) { return a.replace(L, function (a, b) { return decodeURIComponent(b) }) } function v(a) {
                return a.replace(/\x3c!--(?!{cke_protected})[\s\S]+?--\x3e/g,
                    function (a) { return "\x3c!--" + y + "{C}" + encodeURIComponent(a).replace(/--/g, "%2D%2D") + "--\x3e" })
            } function u(a) { return a.replace(/\x3c!--\{cke_protected\}\{C\}([\s\S]+?)--\x3e/g, function (a, b) { return decodeURIComponent(b) }) } function q(a, b) { var c = b._.dataStore; return a.replace(/\x3c!--\{cke_protected\}([\s\S]+?)--\x3e/g, function (a, b) { return decodeURIComponent(b) }).replace(/\{cke_protected_(\d+)\}/g, function (a, b) { return c && c[b] || "" }) } function t(a, b) {
                var c = [], d = b.config.protectedSource, f = b._.dataStore || (b._.dataStore =
                    { id: 1 }), g = /<\!--\{cke_temp(comment)?\}(\d*?)--\x3e/g, d = [/<script[\s\S]*?(<\/script>|$)/gi, /<noscript[\s\S]*?<\/noscript>/gi, /<meta[\s\S]*?\/?>/gi].concat(d); a = a.replace(/\x3c!--[\s\S]*?--\x3e/g, function (a) { return "\x3c!--{cke_tempcomment}" + (c.push(a) - 1) + "--\x3e" }); for (var e = 0; e < d.length; e++)a = a.replace(d[e], function (a) { a = a.replace(g, function (a, b, d) { return c[d] }); return /cke_temp(comment)?/.test(a) ? a : "\x3c!--{cke_temp}" + (c.push(a) - 1) + "--\x3e" }); a = a.replace(g, function (a, b, d) {
                        return "\x3c!--" + y + (b ? "{C}" :
                            "") + encodeURIComponent(c[d]).replace(/--/g, "%2D%2D") + "--\x3e"
                    }); a = a.replace(/<\w+(?:\s+(?:(?:[^\s=>]+\s*=\s*(?:[^'"\s>]+|'[^']*'|"[^"]*"))|[^\s=\/>]+))+\s*\/?>/g, function (a) { return a.replace(/\x3c!--\{cke_protected\}([^>]*)--\x3e/g, function (a, b) { f[f.id] = decodeURIComponent(b); return "{cke_protected_" + f.id++ + "}" }) }); return a = a.replace(/<(title|iframe|textarea)([^>]*)>([\s\S]*?)<\/\1>/g, function (a, c, d, f) { return "\x3c" + c + d + "\x3e" + q(u(f), b) + "\x3c/" + c + "\x3e" })
            } CKEDITOR.htmlDataProcessor = function (b) {
                var c,
                d, f = this; this.editor = b; this.dataFilter = c = new CKEDITOR.htmlParser.filter; this.htmlFilter = d = new CKEDITOR.htmlParser.filter; this.writer = new CKEDITOR.htmlParser.basicWriter; c.addRules(w); c.addRules(C, { applyToAll: !0 }); c.addRules(a(b, "data"), { applyToAll: !0 }); d.addRules(x); d.addRules(B, { applyToAll: !0 }); d.addRules(a(b, "html"), { applyToAll: !0 }); b.on("toHtml", function (a) {
                    a = a.data; var c = a.dataValue, d, c = t(c, b), c = g(c, G), c = l(c), c = g(c, I), c = c.replace(N, "$1cke:$2"), c = c.replace(R, "\x3ccke:$1$2\x3e\x3c/cke:$1\x3e"),
                        c = c.replace(/(<pre\b[^>]*>)(\r\n|\n)/g, "$1$2$2"), c = c.replace(/([^a-z0-9<\-])(on\w{3,})(?!>)/gi, "$1data-cke-" + CKEDITOR.rnd + "-$2"); d = a.context || b.editable().getName(); var f; CKEDITOR.env.ie && 9 > CKEDITOR.env.version && "pre" == d && (d = "div", c = "\x3cpre\x3e" + c + "\x3c/pre\x3e", f = 1); d = b.document.createElement(d); d.setHtml("a" + c); c = d.getHtml().substr(1); c = c.replace(new RegExp("data-cke-" + CKEDITOR.rnd + "-", "ig"), ""); f && (c = c.replace(/^<pre>|<\/pre>$/gi, "")); c = c.replace(H, "$1$2"); c = n(c); c = u(c); d = !1 === a.fixForBody ? !1 :
                            e(a.enterMode, b.config.autoParagraph); c = CKEDITOR.htmlParser.fragment.fromHtml(c, a.context, d); d && (f = c, !f.children.length && CKEDITOR.dtd[f.name][d] && (d = new CKEDITOR.htmlParser.element(d), f.add(d))); a.dataValue = c
                }, null, null, 5); b.on("toHtml", function (a) { a.data.filter.applyTo(a.data.dataValue, !0, a.data.dontFilter, a.data.enterMode) && b.fire("dataFiltered") }, null, null, 6); b.on("toHtml", function (a) { a.data.dataValue.filterChildren(f.dataFilter, !0) }, null, null, 10); b.on("toHtml", function (a) {
                    a = a.data; var b = a.dataValue,
                        c = new CKEDITOR.htmlParser.basicWriter; b.writeChildrenHtml(c); b = c.getHtml(!0); a.dataValue = v(b)
                }, null, null, 15); b.on("toDataFormat", function (a) { var c = a.data.dataValue; a.data.enterMode != CKEDITOR.ENTER_BR && (c = c.replace(/^<br *\/?>/i, "")); a.data.dataValue = CKEDITOR.htmlParser.fragment.fromHtml(c, a.data.context, e(a.data.enterMode, b.config.autoParagraph)) }, null, null, 5); b.on("toDataFormat", function (a) { a.data.dataValue.filterChildren(f.htmlFilter, !0) }, null, null, 10); b.on("toDataFormat", function (a) {
                    a.data.filter.applyTo(a.data.dataValue,
                        !1, !0)
                }, null, null, 11); b.on("toDataFormat", function (a) { var c = a.data.dataValue, d = f.writer; d.reset(); c.writeChildrenHtml(d); c = d.getHtml(!0); c = u(c); c = q(c, b); a.data.dataValue = c }, null, null, 15)
            }; CKEDITOR.htmlDataProcessor.prototype = {
                toHtml: function (a, b, c, d) {
                    var f = this.editor, g, e, l, h; b && "object" == typeof b ? (g = b.context, c = b.fixForBody, d = b.dontFilter, e = b.filter, l = b.enterMode, h = b.protectedWhitespaces) : g = b; g || null === g || (g = f.editable().getName()); return f.fire("toHtml", {
                        dataValue: a, context: g, fixForBody: c, dontFilter: d,
                        filter: e || f.filter, enterMode: l || f.enterMode, protectedWhitespaces: h
                    }).dataValue
                }, toDataFormat: function (a, b) { var c, d, f; b && (c = b.context, d = b.filter, f = b.enterMode); c || null === c || (c = this.editor.editable().getName()); return this.editor.fire("toDataFormat", { dataValue: a, filter: d || this.editor.filter, context: c, enterMode: f || this.editor.enterMode }).dataValue }
            }; var p = /(?:&nbsp;|\xa0)$/, y = "{cke_protected}", A = CKEDITOR.dtd, z = "caption colgroup col thead tfoot tbody".split(" "), r = CKEDITOR.tools.extend({}, A.$blockLimit,
                A.$block), w = { elements: { input: f, textarea: f } }, C = { attributeNames: [[/^on/, "data-cke-pa-on"], [/^data-cke-expando$/, ""]] }, x = { elements: { embed: function (a) { var b = a.parent; if (b && "object" == b.name) { var c = b.attributes.width, b = b.attributes.height; c && (a.attributes.width = c); b && (a.attributes.height = b) } }, a: function (a) { var b = a.attributes; if (!(a.children.length || b.name || b.id || a.attributes["data-cke-saved-name"])) return !1 } } }, B = {
                    elementNames: [[/^cke:/, ""], [/^\?xml:namespace$/, ""]], attributeNames: [[/^data-cke-(saved|pa)-/,
                        ""], [/^data-cke-.*/, ""], ["hidefocus", ""]], elements: {
                            $: function (a) { var b = a.attributes; if (b) { if (b["data-cke-temp"]) return !1; for (var c = ["name", "href", "src"], d, f = 0; f < c.length; f++)d = "data-cke-saved-" + c[f], d in b && delete b[c[f]] } return a }, table: function (a) {
                                a.children.slice(0).sort(function (a, b) {
                                    var c, d; a.type == CKEDITOR.NODE_ELEMENT && b.type == a.type && (c = CKEDITOR.tools.indexOf(z, a.name), d = CKEDITOR.tools.indexOf(z, b.name)); -1 < c && -1 < d && c != d || (c = a.parent ? a.getIndex() : -1, d = b.parent ? b.getIndex() : -1); return c > d ?
                                        1 : -1
                                })
                            }, param: function (a) { a.children = []; a.isEmpty = !0; return a }, span: function (a) { "Apple-style-span" == a.attributes["class"] && delete a.name }, html: function (a) { delete a.attributes.contenteditable; delete a.attributes["class"] }, body: function (a) { delete a.attributes.spellcheck; delete a.attributes.contenteditable }, style: function (a) { var b = a.children[0]; b && b.value && (b.value = CKEDITOR.tools.trim(b.value)); a.attributes.type || (a.attributes.type = "text/css") }, title: function (a) {
                                var b = a.children[0]; !b && m(a, b = new CKEDITOR.htmlParser.text);
                                b.value = a.attributes["data-cke-title"] || ""
                            }, input: h, textarea: h
                        }, attributes: { "class": function (a) { return CKEDITOR.tools.ltrim(a.replace(/(?:^|\s+)cke_[^\s]*/g, "")) || !1 } }
                }; CKEDITOR.env.ie && (B.attributes.style = function (a) { return a.replace(/(^|;)([^\:]+)/g, function (a) { return a.toLowerCase() }) }); var D = /<(a|area|img|input|source)\b([^>]*)>/gi, F = /([\w-:]+)\s*=\s*(?:(?:"[^"]*")|(?:'[^']*')|(?:[^ "'>]+))/gi, E = /^(href|src|name)$/i, I = /(?:<style(?=[ >])[^>]*>[\s\S]*?<\/style>)|(?:<(:?link|meta|base)[^>]*>)/gi,
                    G = /(<textarea(?=[ >])[^>]*>)([\s\S]*?)(?:<\/textarea>)/gi, L = /<cke:encoded>([^<]*)<\/cke:encoded>/gi, N = /(<\/?)((?:object|embed|param|html|body|head|title)[^>]*>)/gi, H = /(<\/?)cke:((?:html|body|head|title)[^>]*>)/gi, R = /<cke:(param|embed)([^>]*?)\/?>(?!\s*<\/cke:\1)/gi
        }(), "use strict", CKEDITOR.htmlParser.element = function (a, e) {
            this.name = a; this.attributes = e || {}; this.children = []; var b = a || "", c = b.match(/^cke:(.*)/); c && (b = c[1]); b = !!(CKEDITOR.dtd.$nonBodyContent[b] || CKEDITOR.dtd.$block[b] || CKEDITOR.dtd.$listItem[b] ||
                CKEDITOR.dtd.$tableContent[b] || CKEDITOR.dtd.$nonEditable[b] || "br" == b); this.isEmpty = !!CKEDITOR.dtd.$empty[a]; this.isUnknown = !CKEDITOR.dtd[a]; this._ = { isBlockLike: b, hasInlineStarted: this.isEmpty || !b }
        }, CKEDITOR.htmlParser.cssStyle = function (a) {
            var e = {}; ((a instanceof CKEDITOR.htmlParser.element ? a.attributes.style : a) || "").replace(/&quot;/g, '"').replace(/\s*([^ :;]+)\s*:\s*([^;]+)\s*(?=;|$)/g, function (a, c, d) { "font-family" == c && (d = d.replace(/["']/g, "")); e[c.toLowerCase()] = d }); return {
                rules: e, populate: function (a) {
                    var c =
                        this.toString(); c && (a instanceof CKEDITOR.dom.element ? a.setAttribute("style", c) : a instanceof CKEDITOR.htmlParser.element ? a.attributes.style = c : a.style = c)
                }, toString: function () { var a = [], c; for (c in e) e[c] && a.push(c, ":", e[c], ";"); return a.join("") }
            }
        }, function () {
            function a(a) { return function (b) { return b.type == CKEDITOR.NODE_ELEMENT && ("string" == typeof a ? b.name == a : b.name in a) } } var e = function (a, b) { a = a[0]; b = b[0]; return a < b ? -1 : a > b ? 1 : 0 }, b = CKEDITOR.htmlParser.fragment.prototype; CKEDITOR.htmlParser.element.prototype =
                CKEDITOR.tools.extend(new CKEDITOR.htmlParser.node, {
                    type: CKEDITOR.NODE_ELEMENT, add: b.add, clone: function () { return new CKEDITOR.htmlParser.element(this.name, this.attributes) }, filter: function (a, b) {
                        var e = this, m, f; b = e.getFilterContext(b); if (b.off) return !0; if (!e.parent) a.onRoot(b, e); for (; ;) {
                            m = e.name; if (!(f = a.onElementName(b, m))) return this.remove(), !1; e.name = f; if (!(e = a.onElement(b, e))) return this.remove(), !1; if (e !== this) return this.replaceWith(e), !1; if (e.name == m) break; if (e.type != CKEDITOR.NODE_ELEMENT) return this.replaceWith(e),
                                !1; if (!e.name) return this.replaceWithChildren(), !1
                        } m = e.attributes; var h, l; for (h in m) { for (f = m[h]; ;)if (l = a.onAttributeName(b, h)) if (l != h) delete m[h], h = l; else break; else { delete m[h]; break } l && (!1 === (f = a.onAttribute(b, e, l, f)) ? delete m[l] : m[l] = f) } e.isEmpty || this.filterChildren(a, !1, b); return !0
                    }, filterChildren: b.filterChildren, writeHtml: function (a, b) {
                        b && this.filter(b); var k = this.name, m = [], f = this.attributes, h, l; a.openTag(k, f); for (h in f) m.push([h, f[h]]); a.sortAttributes && m.sort(e); h = 0; for (l = m.length; h < l; h++)f =
                            m[h], a.attribute(f[0], f[1]); a.openTagClose(k, this.isEmpty); this.writeChildrenHtml(a); this.isEmpty || a.closeTag(k)
                    }, writeChildrenHtml: b.writeChildrenHtml, replaceWithChildren: function () { for (var a = this.children, b = a.length; b;)a[--b].insertAfter(this); this.remove() }, forEach: b.forEach, getFirst: function (b) { if (!b) return this.children.length ? this.children[0] : null; "function" != typeof b && (b = a(b)); for (var d = 0, e = this.children.length; d < e; ++d)if (b(this.children[d])) return this.children[d]; return null }, getHtml: function () {
                        var a =
                            new CKEDITOR.htmlParser.basicWriter; this.writeChildrenHtml(a); return a.getHtml()
                    }, setHtml: function (a) { a = this.children = CKEDITOR.htmlParser.fragment.fromHtml(a).children; for (var b = 0, e = a.length; b < e; ++b)a[b].parent = this }, getOuterHtml: function () { var a = new CKEDITOR.htmlParser.basicWriter; this.writeHtml(a); return a.getHtml() }, split: function (a) {
                        for (var b = this.children.splice(a, this.children.length - a), e = this.clone(), m = 0; m < b.length; ++m)b[m].parent = e; e.children = b; b[0] && (b[0].previous = null); 0 < a && (this.children[a -
                            1].next = null); this.parent.add(e, this.getIndex() + 1); return e
                    }, addClass: function (a) { if (!this.hasClass(a)) { var b = this.attributes["class"] || ""; this.attributes["class"] = b + (b ? " " : "") + a } }, removeClass: function (a) { var b = this.attributes["class"]; b && ((b = CKEDITOR.tools.trim(b.replace(new RegExp("(?:\\s+|^)" + a + "(?:\\s+|$)"), " "))) ? this.attributes["class"] = b : delete this.attributes["class"]) }, hasClass: function (a) { var b = this.attributes["class"]; return b ? (new RegExp("(?:^|\\s)" + a + "(?\x3d\\s|$)")).test(b) : !1 }, getFilterContext: function (a) {
                        var b =
                            []; a || (a = { off: !1, nonEditable: !1, nestedEditable: !1 }); a.off || "off" != this.attributes["data-cke-processor"] || b.push("off", !0); a.nonEditable || "false" != this.attributes.contenteditable ? a.nonEditable && !a.nestedEditable && "true" == this.attributes.contenteditable && b.push("nestedEditable", !0) : b.push("nonEditable", !0); if (b.length) { a = CKEDITOR.tools.copy(a); for (var e = 0; e < b.length; e += 2)a[b[e]] = b[e + 1] } return a
                    }
                }, !0)
        }(), function () {
            var a = {}, e = /{([^}]+)}/g, b = /([\\'])/g, c = /\n/g, d = /\r/g; CKEDITOR.template = function (k) {
                if (a[k]) this.output =
                    a[k]; else { var m = k.replace(b, "\\$1").replace(c, "\\n").replace(d, "\\r").replace(e, function (a, b) { return "',data['" + b + "']\x3d\x3dundefined?'{" + b + "}':data['" + b + "'],'" }); this.output = a[k] = Function("data", "buffer", "return buffer?buffer.push('" + m + "'):['" + m + "'].join('');") }
            }
        }(), delete CKEDITOR.loadFullCore, CKEDITOR.instances = {}, CKEDITOR.document = new CKEDITOR.dom.document(document), CKEDITOR.add = function (a) {
            CKEDITOR.instances[a.name] = a; a.on("focus", function () {
                CKEDITOR.currentInstance != a && (CKEDITOR.currentInstance =
                    a, CKEDITOR.fire("currentInstance"))
            }); a.on("blur", function () { CKEDITOR.currentInstance == a && (CKEDITOR.currentInstance = null, CKEDITOR.fire("currentInstance")) }); CKEDITOR.fire("instance", null, a)
        }, CKEDITOR.remove = function (a) { delete CKEDITOR.instances[a.name] }, function () { var a = {}; CKEDITOR.addTemplate = function (e, b) { var c = a[e]; if (c) return c; c = { name: e, source: b }; CKEDITOR.fire("template", c); return a[e] = new CKEDITOR.template(c.source) }; CKEDITOR.getTemplate = function (e) { return a[e] } }(), function () {
            var a = []; CKEDITOR.addCss =
                function (e) { a.push(e) }; CKEDITOR.getCss = function () { return a.join("\n") }
        }(), CKEDITOR.on("instanceDestroyed", function () { CKEDITOR.tools.isEmpty(this.instances) && CKEDITOR.fire("reset") }), CKEDITOR.TRISTATE_ON = 1, CKEDITOR.TRISTATE_OFF = 2, CKEDITOR.TRISTATE_DISABLED = 0, function () {
            CKEDITOR.inline = function (a, e) {
                if (!CKEDITOR.env.isCompatible) return null; a = CKEDITOR.dom.element.get(a); if (a.getEditor()) throw 'The editor instance "' + a.getEditor().name + '" is already attached to the provided element.'; var b = new CKEDITOR.editor(e,
                    a, CKEDITOR.ELEMENT_MODE_INLINE), c = a.is("textarea") ? a : null; c ? (b.setData(c.getValue(), null, !0), a = CKEDITOR.dom.element.createFromHtml('\x3cdiv contenteditable\x3d"' + !!b.readOnly + '" class\x3d"cke_textarea_inline"\x3e' + c.getValue() + "\x3c/div\x3e", CKEDITOR.document), a.insertAfter(c), c.hide(), c.$.form && b._attachToForm()) : b.setData(a.getHtml(), null, !0); b.on("loaded", function () {
                        b.fire("uiReady"); b.editable(a); b.container = a; b.ui.contentsElement = a; b.setData(b.getData(1)); b.resetDirty(); b.fire("contentDom");
                        b.mode = "wysiwyg"; b.fire("mode"); b.status = "ready"; b.fireOnce("instanceReady"); CKEDITOR.fire("instanceReady", null, b)
                    }, null, null, 1E4); b.on("destroy", function () { c && (b.container.clearCustomData(), b.container.remove(), c.show()); b.element.clearCustomData(); delete b.element }); return b
            }; CKEDITOR.inlineAll = function () {
                var a, e, b; for (b in CKEDITOR.dtd.$editable) for (var c = CKEDITOR.document.getElementsByTag(b), d = 0, k = c.count(); d < k; d++)a = c.getItem(d), "true" == a.getAttribute("contenteditable") && (e = { element: a, config: {} },
                    !1 !== CKEDITOR.fire("inline", e) && CKEDITOR.inline(a, e.config))
            }; CKEDITOR.domReady(function () { !CKEDITOR.disableAutoInline && CKEDITOR.inlineAll() })
        }(), CKEDITOR.replaceClass = "ckeditor", function () {
            function a(a, d, k, m) {
                if (!CKEDITOR.env.isCompatible) return null; a = CKEDITOR.dom.element.get(a); if (a.getEditor()) throw 'The editor instance "' + a.getEditor().name + '" is already attached to the provided element.'; var f = new CKEDITOR.editor(d, a, m); m == CKEDITOR.ELEMENT_MODE_REPLACE && (a.setStyle("visibility", "hidden"), f._.required =
                    a.hasAttribute("required"), a.removeAttribute("required")); k && f.setData(k, null, !0); f.on("loaded", function () { b(f); m == CKEDITOR.ELEMENT_MODE_REPLACE && f.config.autoUpdateElement && a.$.form && f._attachToForm(); f.setMode(f.config.startupMode, function () { f.resetDirty(); f.status = "ready"; f.fireOnce("instanceReady"); CKEDITOR.fire("instanceReady", null, f) }) }); f.on("destroy", e); return f
            } function e() {
                var a = this.container, b = this.element; a && (a.clearCustomData(), a.remove()); b && (b.clearCustomData(), this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE &&
                    (b.show(), this._.required && b.setAttribute("required", "required")), delete this.element)
            } function b(a) {
                var b = a.name, e = a.element, m = a.elementMode, f = a.fire("uiSpace", { space: "top", html: "" }).html, h = a.fire("uiSpace", { space: "bottom", html: "" }).html, l = new CKEDITOR.template('\x3c{outerEl} id\x3d"cke_{name}" class\x3d"{id} cke cke_reset cke_chrome cke_editor_{name} cke_{langDir} ' + CKEDITOR.env.cssClass + '"  dir\x3d"{langDir}" lang\x3d"{langCode}" role\x3d"application"' + (a.title ? ' aria-labelledby\x3d"cke_{name}_arialbl"' :
                    "") + "\x3e" + (a.title ? '\x3cspan id\x3d"cke_{name}_arialbl" class\x3d"cke_voice_label"\x3e{voiceLabel}\x3c/span\x3e' : "") + '\x3c{outerEl} class\x3d"cke_inner cke_reset" role\x3d"presentation"\x3e{topHtml}\x3c{outerEl} id\x3d"{contentId}" class\x3d"cke_contents cke_reset" role\x3d"presentation"\x3e\x3c/{outerEl}\x3e{bottomHtml}\x3c/{outerEl}\x3e\x3c/{outerEl}\x3e'), b = CKEDITOR.dom.element.createFromHtml(l.output({
                        id: a.id, name: b, langDir: a.lang.dir, langCode: a.langCode, voiceLabel: a.title, topHtml: f ? '\x3cspan id\x3d"' +
                            a.ui.spaceId("top") + '" class\x3d"cke_top cke_reset_all" role\x3d"presentation" style\x3d"height:auto"\x3e' + f + "\x3c/span\x3e" : "", contentId: a.ui.spaceId("contents"), bottomHtml: h ? '\x3cspan id\x3d"' + a.ui.spaceId("bottom") + '" class\x3d"cke_bottom cke_reset_all" role\x3d"presentation"\x3e' + h + "\x3c/span\x3e" : "", outerEl: CKEDITOR.env.ie ? "span" : "div"
                    })); m == CKEDITOR.ELEMENT_MODE_REPLACE ? (e.hide(), b.insertAfter(e)) : e.append(b); a.container = b; a.ui.contentsElement = a.ui.space("contents"); f && a.ui.space("top").unselectable();
                h && a.ui.space("bottom").unselectable(); e = a.config.width; m = a.config.height; e && b.setStyle("width", CKEDITOR.tools.cssLength(e)); m && a.ui.space("contents").setStyle("height", CKEDITOR.tools.cssLength(m)); b.disableContextMenu(); CKEDITOR.env.webkit && b.on("focus", function () { a.focus() }); a.fireOnce("uiReady")
            } CKEDITOR.replace = function (b, d) { return a(b, d, null, CKEDITOR.ELEMENT_MODE_REPLACE) }; CKEDITOR.appendTo = function (b, d, e) { return a(b, d, e, CKEDITOR.ELEMENT_MODE_APPENDTO) }; CKEDITOR.replaceAll = function () {
                for (var a =
                    document.getElementsByTagName("textarea"), b = 0; b < a.length; b++) { var e = null, m = a[b]; if (m.name || m.id) { if ("string" == typeof arguments[0]) { if (!(new RegExp("(?:^|\\s)" + arguments[0] + "(?:$|\\s)")).test(m.className)) continue } else if ("function" == typeof arguments[0] && (e = {}, !1 === arguments[0](m, e))) continue; this.replace(m, e) } }
            }; CKEDITOR.editor.prototype.addMode = function (a, b) { (this._.modes || (this._.modes = {}))[a] = b }; CKEDITOR.editor.prototype.setMode = function (a, b) {
                var e = this, m = this._.modes; if (a != e.mode && m && m[a]) {
                    e.fire("beforeSetMode",
                        a); if (e.mode) { var f = e.checkDirty(), m = e._.previousModeData, h, l = 0; e.fire("beforeModeUnload"); e.editable(0); e._.previousMode = e.mode; e._.previousModeData = h = e.getData(1); "source" == e.mode && m == h && (e.fire("lockSnapshot", { forceUpdate: !0 }), l = 1); e.ui.space("contents").setHtml(""); e.mode = "" } else e._.previousModeData = e.getData(1); this._.modes[a](function () {
                            e.mode = a; void 0 !== f && !f && e.resetDirty(); l ? e.fire("unlockSnapshot") : "wysiwyg" == a && e.fire("saveSnapshot"); setTimeout(function () { e.fire("mode"); b && b.call(e) },
                                0)
                        })
                }
            }; CKEDITOR.editor.prototype.resize = function (a, b, e, m) {
                var f = this.container, h = this.ui.space("contents"), l = CKEDITOR.env.webkit && this.document && this.document.getWindow().$.frameElement; m = m ? this.container.getFirst(function (a) { return a.type == CKEDITOR.NODE_ELEMENT && a.hasClass("cke_inner") }) : f; m.setSize("width", a, !0); l && (l.style.width = "1%"); var g = (m.$.offsetHeight || 0) - (h.$.clientHeight || 0), f = Math.max(b - (e ? 0 : g), 0); b = e ? b + g : b; h.setStyle("height", f + "px"); l && (l.style.width = "100%"); this.fire("resize", {
                    outerHeight: b,
                    contentsHeight: f, outerWidth: a || m.getSize("width")
                })
            }; CKEDITOR.editor.prototype.getResizable = function (a) { return a ? this.ui.space("contents") : this.container }; CKEDITOR.domReady(function () { CKEDITOR.replaceClass && CKEDITOR.replaceAll(CKEDITOR.replaceClass) })
        }(), CKEDITOR.config.startupMode = "wysiwyg", function () {
            function a(a) {
                var b = a.editor, d = a.data.path, f = d.blockLimit, g = a.data.selection, l = g.getRanges()[0], h; if (CKEDITOR.env.gecko || CKEDITOR.env.ie && CKEDITOR.env.needsBrFiller) if (g = e(g, d)) g.appendBogus(), h = CKEDITOR.env.ie;
                m(b, d.block, f) && l.collapsed && !l.getCommonAncestor().isReadOnly() && (d = l.clone(), d.enlarge(CKEDITOR.ENLARGE_BLOCK_CONTENTS), f = new CKEDITOR.dom.walker(d), f.guard = function (a) { return !c(a) || a.type == CKEDITOR.NODE_COMMENT || a.isReadOnly() }, !f.checkForward() || d.checkStartOfBlock() && d.checkEndOfBlock()) && (b = l.fixBlock(!0, b.activeEnterMode == CKEDITOR.ENTER_DIV ? "div" : "p"), CKEDITOR.env.needsBrFiller || (b = b.getFirst(c)) && b.type == CKEDITOR.NODE_TEXT && CKEDITOR.tools.trim(b.getText()).match(/^(?:&nbsp;|\xa0)$/) && b.remove(),
                    h = 1, a.cancel()); h && l.select()
            } function e(a, b) { if (a.isFake) return 0; var d = b.block || b.blockLimit, f = d && d.getLast(c); if (!(!d || !d.isBlockBoundary() || f && f.type == CKEDITOR.NODE_ELEMENT && f.isBlockBoundary() || d.is("pre") || d.getBogus())) return d } function b(a) { var b = a.data.getTarget(); b.is("input") && (b = b.getAttribute("type"), "submit" != b && "reset" != b || a.data.preventDefault()) } function c(a) { return g(a) && n(a) } function d(a, b) {
                return function (c) {
                    var d = c.data.$.toElement || c.data.$.fromElement || c.data.$.relatedTarget;
                    (d = d && d.nodeType == CKEDITOR.NODE_ELEMENT ? new CKEDITOR.dom.element(d) : null) && (b.equals(d) || b.contains(d)) || a.call(this, c)
                }
            } function k(a) {
                function b(a) { return function (b, f) { f && b.type == CKEDITOR.NODE_ELEMENT && b.is(g) && (d = b); if (!(f || !c(b) || a && u(b))) return !1 } } var d, f = a.getRanges()[0]; a = a.root; var g = { table: 1, ul: 1, ol: 1, dl: 1 }; if (f.startPath().contains(g)) {
                    var e = f.clone(); e.collapse(1); e.setStartAt(a, CKEDITOR.POSITION_AFTER_START); a = new CKEDITOR.dom.walker(e); a.guard = b(); a.checkBackward(); if (d) return e = f.clone(),
                        e.collapse(), e.setEndAt(d, CKEDITOR.POSITION_AFTER_END), a = new CKEDITOR.dom.walker(e), a.guard = b(!0), d = !1, a.checkForward(), d
                } return null
            } function m(a, b, c) { return !1 !== a.config.autoParagraph && a.activeEnterMode != CKEDITOR.ENTER_BR && (a.editable().equals(c) && !b || b && "true" == b.getAttribute("contenteditable")) } function f(a) { return a.activeEnterMode != CKEDITOR.ENTER_BR && !1 !== a.config.autoParagraph ? a.activeEnterMode == CKEDITOR.ENTER_DIV ? "div" : "p" : !1 } function h(a) {
                var b = a.editor; b.getSelection().scrollIntoView();
                setTimeout(function () { b.fire("saveSnapshot") }, 0)
            } function l(a, b, c) { var d = a.getCommonAncestor(b); for (b = a = c ? b : a; (a = a.getParent()) && !d.equals(a) && 1 == a.getChildCount();)b = a; b.remove() } var g, n, v, u, q, t, p, y, A; CKEDITOR.editable = CKEDITOR.tools.createClass({
                base: CKEDITOR.dom.element, $: function (a, b) { this.base(b.$ || b); this.editor = a; this.status = "unloaded"; this.hasFocus = !1; this.setup() }, proto: {
                    focus: function () {
                        var a; if (CKEDITOR.env.webkit && !this.hasFocus && (a = this.editor._.previousActive || this.getDocument().getActive(),
                            this.contains(a))) { a.focus(); return } try { this.$[CKEDITOR.env.ie && this.getDocument().equals(CKEDITOR.document) ? "setActive" : "focus"]() } catch (b) { if (!CKEDITOR.env.ie) throw b; } CKEDITOR.env.safari && !this.isInline() && (a = CKEDITOR.document.getActive(), a.equals(this.getWindow().getFrame()) || this.getWindow().focus())
                    }, on: function (a, b) {
                        var c = Array.prototype.slice.call(arguments, 0); CKEDITOR.env.ie && /^focus|blur$/.exec(a) && (a = "focus" == a ? "focusin" : "focusout", b = d(b, this), c[0] = a, c[1] = b); return CKEDITOR.dom.element.prototype.on.apply(this,
                            c)
                    }, attachListener: function (a) { !this._.listeners && (this._.listeners = []); var b = Array.prototype.slice.call(arguments, 1), b = a.on.apply(a, b); this._.listeners.push(b); return b }, clearListeners: function () { var a = this._.listeners; try { for (; a.length;)a.pop().removeListener() } catch (b) { } }, restoreAttrs: function () { var a = this._.attrChanges, b, c; for (c in a) a.hasOwnProperty(c) && (b = a[c], null !== b ? this.setAttribute(c, b) : this.removeAttribute(c)) }, attachClass: function (a) {
                        var b = this.getCustomData("classes"); this.hasClass(a) ||
                            (!b && (b = []), b.push(a), this.setCustomData("classes", b), this.addClass(a))
                    }, changeAttr: function (a, b) { var c = this.getAttribute(a); b !== c && (!this._.attrChanges && (this._.attrChanges = {}), a in this._.attrChanges || (this._.attrChanges[a] = c), this.setAttribute(a, b)) }, insertText: function (a) { this.editor.focus(); this.insertHtml(this.transformPlainTextToHtml(a), "text") }, transformPlainTextToHtml: function (a) {
                        var b = this.editor.getSelection().getStartElement().hasAscendant("pre", !0) ? CKEDITOR.ENTER_BR : this.editor.activeEnterMode;
                        return CKEDITOR.tools.transformPlainTextToHtml(a, b)
                    }, insertHtml: function (a, b, c) { var d = this.editor; d.focus(); d.fire("saveSnapshot"); c || (c = d.getSelection().getRanges()[0]); t(this, b || "html", a, c); c.select(); h(this); this.editor.fire("afterInsertHtml", {}) }, insertHtmlIntoRange: function (a, b, c) { t(this, c || "html", a, b); this.editor.fire("afterInsertHtml", { intoRange: b }) }, insertElement: function (a, b) {
                        var d = this.editor; d.focus(); d.fire("saveSnapshot"); var f = d.activeEnterMode, d = d.getSelection(), g = a.getName(), g = CKEDITOR.dtd.$block[g];
                        b || (b = d.getRanges()[0]); this.insertElementIntoRange(a, b) && (b.moveToPosition(a, CKEDITOR.POSITION_AFTER_END), g && ((g = a.getNext(function (a) { return c(a) && !u(a) })) && g.type == CKEDITOR.NODE_ELEMENT && g.is(CKEDITOR.dtd.$block) ? g.getDtd()["#"] ? b.moveToElementEditStart(g) : b.moveToElementEditEnd(a) : g || f == CKEDITOR.ENTER_BR || (g = b.fixBlock(!0, f == CKEDITOR.ENTER_DIV ? "div" : "p"), b.moveToElementEditStart(g)))); d.selectRanges([b]); h(this)
                    }, insertElementIntoSelection: function (a) { this.insertElement(a) }, insertElementIntoRange: function (a,
                        b) {
                            var c = this.editor, d = c.config.enterMode, f = a.getName(), g = CKEDITOR.dtd.$block[f]; if (b.checkReadOnly()) return !1; b.deleteContents(1); b.startContainer.type == CKEDITOR.NODE_ELEMENT && b.startContainer.is({ tr: 1, table: 1, tbody: 1, thead: 1, tfoot: 1 }) && p(b); var e, l; if (g) for (; (e = b.getCommonAncestor(0, 1)) && (l = CKEDITOR.dtd[e.getName()]) && (!l || !l[f]);)e.getName() in CKEDITOR.dtd.span ? b.splitElement(e) : b.checkStartOfBlock() && b.checkEndOfBlock() ? (b.setStartBefore(e), b.collapse(!0), e.remove()) : b.splitBlock(d == CKEDITOR.ENTER_DIV ?
                                "div" : "p", c.editable()); b.insertNode(a); return !0
                    }, setData: function (a, b) { b || (a = this.editor.dataProcessor.toHtml(a)); this.setHtml(a); this.fixInitialSelection(); "unloaded" == this.status && (this.status = "ready"); this.editor.fire("dataReady") }, getData: function (a) { var b = this.getHtml(); a || (b = this.editor.dataProcessor.toDataFormat(b)); return b }, setReadOnly: function (a) { this.setAttribute("contenteditable", !a) }, detach: function () {
                        this.removeClass("cke_editable"); this.status = "detached"; var a = this.editor; this._.detach();
                        delete a.document; delete a.window
                    }, isInline: function () { return this.getDocument().equals(CKEDITOR.document) }, fixInitialSelection: function () {
                        function a() {
                            var b = c.getDocument().$, d = b.getSelection(), f; a: if (d.anchorNode && d.anchorNode == c.$) f = !0; else { if (CKEDITOR.env.webkit && (f = c.getDocument().getActive()) && f.equals(c) && !d.anchorNode) { f = !0; break a } f = void 0 } f && (f = new CKEDITOR.dom.range(c), f.moveToElementEditStart(c), b = b.createRange(), b.setStart(f.startContainer.$, f.startOffset), b.collapse(!0), d.removeAllRanges(),
                                d.addRange(b))
                        } function b() { var a = c.getDocument().$, d = a.selection, f = c.getDocument().getActive(); "None" == d.type && f.equals(c) && (d = new CKEDITOR.dom.range(c), a = a.body.createTextRange(), d.moveToElementEditStart(c), d = d.startContainer, d.type != CKEDITOR.NODE_ELEMENT && (d = d.getParent()), a.moveToElementText(d.$), a.collapse(!0), a.select()) } var c = this; if (CKEDITOR.env.ie && (9 > CKEDITOR.env.version || CKEDITOR.env.quirks)) this.hasFocus && (this.focus(), b()); else if (this.hasFocus) this.focus(), a(); else this.once("focus",
                            function () { a() }, null, null, -999)
                    }, getHtmlFromRange: function (a) { if (a.collapsed) return new CKEDITOR.dom.documentFragment(a.document); a = { doc: this.getDocument(), range: a.clone() }; y.eol.detect(a, this); y.bogus.exclude(a); y.cell.shrink(a); a.fragment = a.range.cloneContents(); y.tree.rebuild(a, this); y.eol.fix(a, this); return new CKEDITOR.dom.documentFragment(a.fragment.$) }, extractHtmlFromRange: function (a, b) {
                        var c = A, d = { range: a, doc: a.document }, f = this.getHtmlFromRange(a); if (a.collapsed) return a.optimize(), f; a.enlarge(CKEDITOR.ENLARGE_INLINE,
                            1); c.table.detectPurge(d); d.bookmark = a.createBookmark(); delete d.range; var g = this.editor.createRange(); g.moveToPosition(d.bookmark.startNode, CKEDITOR.POSITION_BEFORE_START); d.targetBookmark = g.createBookmark(); c.list.detectMerge(d, this); c.table.detectRanges(d, this); c.block.detectMerge(d, this); d.tableContentsRanges ? (c.table.deleteRanges(d), a.moveToBookmark(d.bookmark), d.range = a) : (a.moveToBookmark(d.bookmark), d.range = a, a.extractContents(c.detectExtractMerge(d))); a.moveToBookmark(d.targetBookmark); a.optimize();
                        c.fixUneditableRangePosition(a); c.list.merge(d, this); c.table.purge(d, this); c.block.merge(d, this); if (b) { c = a.startPath(); if (d = a.checkStartOfBlock() && a.checkEndOfBlock() && c.block && !a.root.equals(c.block)) { a: { var d = c.block.getElementsByTag("span"), g = 0, e; if (d) for (; e = d.getItem(g++);)if (!n(e)) { d = !0; break a } d = !1 } d = !d } d && (a.moveToPosition(c.block, CKEDITOR.POSITION_BEFORE_START), c.block.remove()) } else c.autoParagraph(this.editor, a), v(a.startContainer) && a.startContainer.appendBogus(); a.startContainer.mergeSiblings();
                        return f
                    }, setup: function () {
                        var a = this.editor; this.attachListener(a, "beforeGetData", function () { var b = this.getData(); this.is("textarea") || !1 !== a.config.ignoreEmptyParagraph && (b = b.replace(q, function (a, b) { return b })); a.setData(b, null, 1) }, this); this.attachListener(a, "getSnapshot", function (a) { a.data = this.getData(1) }, this); this.attachListener(a, "afterSetData", function () { this.setData(a.getData(1)) }, this); this.attachListener(a, "loadSnapshot", function (a) { this.setData(a.data, 1) }, this); this.attachListener(a,
                            "beforeFocus", function () { var b = a.getSelection(); (b = b && b.getNative()) && "Control" == b.type || this.focus() }, this); this.attachListener(a, "insertHtml", function (a) { this.insertHtml(a.data.dataValue, a.data.mode, a.data.range) }, this); this.attachListener(a, "insertElement", function (a) { this.insertElement(a.data) }, this); this.attachListener(a, "insertText", function (a) { this.insertText(a.data) }, this); this.setReadOnly(a.readOnly); this.attachClass("cke_editable"); a.elementMode == CKEDITOR.ELEMENT_MODE_INLINE ? this.attachClass("cke_editable_inline") :
                                a.elementMode != CKEDITOR.ELEMENT_MODE_REPLACE && a.elementMode != CKEDITOR.ELEMENT_MODE_APPENDTO || this.attachClass("cke_editable_themed"); this.attachClass("cke_contents_" + a.config.contentsLangDirection); a.keystrokeHandler.blockedKeystrokes[8] = +a.readOnly; a.keystrokeHandler.attach(this); this.on("blur", function () { this.hasFocus = !1 }, null, null, -1); this.on("focus", function () { this.hasFocus = !0 }, null, null, -1); a.focusManager.add(this); this.equals(CKEDITOR.document.getActive()) && (this.hasFocus = !0, a.once("contentDom",
                                    function () { a.focusManager.focus(this) }, this)); this.isInline() && this.changeAttr("tabindex", a.tabIndex); if (!this.is("textarea")) {
                                        a.document = this.getDocument(); a.window = this.getWindow(); var d = a.document; this.changeAttr("spellcheck", !a.config.disableNativeSpellChecker); var f = a.config.contentsLangDirection; this.getDirection(1) != f && this.changeAttr("dir", f); var e = CKEDITOR.getCss(); if (e) {
                                            var f = d.getHead(), h = f.getCustomData("stylesheet"); h ? e != h.getText() && (CKEDITOR.env.ie && 9 > CKEDITOR.env.version ? h.$.styleSheet.cssText =
                                                e : h.setText(e)) : (e = d.appendStyleText(e), e = new CKEDITOR.dom.element(e.ownerNode || e.owningElement), f.setCustomData("stylesheet", e), e.data("cke-temp", 1))
                                        } f = d.getCustomData("stylesheet_ref") || 0; d.setCustomData("stylesheet_ref", f + 1); this.setCustomData("cke_includeReadonly", !a.config.disableReadonlyStyling); this.attachListener(this, "click", function (a) { a = a.data; var b = (new CKEDITOR.dom.elementPath(a.getTarget(), this)).contains("a"); b && 2 != a.$.button && b.isReadOnly() && a.preventDefault() }); var m = { 8: 1, 46: 1 }; this.attachListener(a,
                                            "key", function (b) {
                                                if (a.readOnly) return !0; var c = b.data.domEvent.getKey(), d; if (c in m) {
                                                    b = a.getSelection(); var f, e = b.getRanges()[0], l = e.startPath(), h, r, n, c = 8 == c; CKEDITOR.env.ie && 11 > CKEDITOR.env.version && (f = b.getSelectedElement()) || (f = k(b)) ? (a.fire("saveSnapshot"), e.moveToPosition(f, CKEDITOR.POSITION_BEFORE_START), f.remove(), e.select(), a.fire("saveSnapshot"), d = 1) : e.collapsed && ((h = l.block) && (n = h[c ? "getPrevious" : "getNext"](g)) && n.type == CKEDITOR.NODE_ELEMENT && n.is("table") && e[c ? "checkStartOfBlock" : "checkEndOfBlock"]() ?
                                                        (a.fire("saveSnapshot"), e[c ? "checkEndOfBlock" : "checkStartOfBlock"]() && h.remove(), e["moveToElementEdit" + (c ? "End" : "Start")](n), e.select(), a.fire("saveSnapshot"), d = 1) : l.blockLimit && l.blockLimit.is("td") && (r = l.blockLimit.getAscendant("table")) && e.checkBoundaryOfElement(r, c ? CKEDITOR.START : CKEDITOR.END) && (n = r[c ? "getPrevious" : "getNext"](g)) ? (a.fire("saveSnapshot"), e["moveToElementEdit" + (c ? "End" : "Start")](n), e.checkStartOfBlock() && e.checkEndOfBlock() ? n.remove() : e.select(), a.fire("saveSnapshot"), d = 1) : (r = l.contains(["td",
                                                            "th", "caption"])) && e.checkBoundaryOfElement(r, c ? CKEDITOR.START : CKEDITOR.END) && (d = 1))
                                                } return !d
                                            }); a.blockless && CKEDITOR.env.ie && CKEDITOR.env.needsBrFiller && this.attachListener(this, "keyup", function (b) { b.data.getKeystroke() in m && !this.getFirst(c) && (this.appendBogus(), b = a.createRange(), b.moveToPosition(this, CKEDITOR.POSITION_AFTER_START), b.select()) }); this.attachListener(this, "dblclick", function (b) { if (a.readOnly) return !1; b = { element: b.data.getTarget() }; a.fire("doubleclick", b) }); CKEDITOR.env.ie && this.attachListener(this,
                                                "click", b); CKEDITOR.env.ie && !CKEDITOR.env.edge || this.attachListener(this, "mousedown", function (b) { var c = b.data.getTarget(); c.is("img", "hr", "input", "textarea", "select") && !c.isReadOnly() && (a.getSelection().selectElement(c), c.is("input", "textarea", "select") && b.data.preventDefault()) }); CKEDITOR.env.edge && this.attachListener(this, "mouseup", function (b) { (b = b.data.getTarget()) && b.is("img") && a.getSelection().selectElement(b) }); CKEDITOR.env.gecko && this.attachListener(this, "mouseup", function (b) {
                                                    if (2 == b.data.$.button &&
                                                        (b = b.data.getTarget(), !b.getOuterHtml().replace(q, ""))) { var c = a.createRange(); c.moveToElementEditStart(b); c.select(!0) }
                                                }); CKEDITOR.env.webkit && (this.attachListener(this, "click", function (a) { a.data.getTarget().is("input", "select") && a.data.preventDefault() }), this.attachListener(this, "mouseup", function (a) { a.data.getTarget().is("input", "textarea") && a.data.preventDefault() })); CKEDITOR.env.webkit && this.attachListener(a, "key", function (b) {
                                                    if (a.readOnly) return !0; b = b.data.domEvent.getKey(); if (b in m) {
                                                        var c =
                                                            8 == b, d = a.getSelection().getRanges()[0]; b = d.startPath(); if (d.collapsed) a: {
                                                                var f = b.block; if (f && d[c ? "checkStartOfBlock" : "checkEndOfBlock"]() && d.moveToClosestEditablePosition(f, !c) && d.collapsed) {
                                                                    if (d.startContainer.type == CKEDITOR.NODE_ELEMENT) { var g = d.startContainer.getChild(d.startOffset - (c ? 1 : 0)); if (g && g.type == CKEDITOR.NODE_ELEMENT && g.is("hr")) { a.fire("saveSnapshot"); g.remove(); b = !0; break a } } d = d.startPath().block; if (!d || d && d.contains(f)) b = void 0; else {
                                                                        a.fire("saveSnapshot"); var e; (e = (c ? d : f).getBogus()) &&
                                                                            e.remove(); e = a.getSelection(); g = e.createBookmarks(); (c ? f : d).moveChildren(c ? d : f, !1); b.lastElement.mergeSiblings(); l(f, d, !c); e.selectBookmarks(g); b = !0
                                                                    }
                                                                } else b = !1
                                                            } else c = d, e = b.block, d = c.endPath().block, e && d && !e.equals(d) ? (a.fire("saveSnapshot"), (f = e.getBogus()) && f.remove(), c.enlarge(CKEDITOR.ENLARGE_INLINE), c.deleteContents(), d.getParent() && (d.moveChildren(e, !1), b.lastElement.mergeSiblings(), l(e, d, !0)), c = a.getSelection().getRanges()[0], c.collapse(1), c.optimize(), "" === c.startContainer.getHtml() && c.startContainer.appendBogus(),
                                                                c.select(), b = !0) : b = !1; if (!b) return; a.getSelection().scrollIntoView(); a.fire("saveSnapshot"); return !1
                                                    }
                                                }, this, null, 100)
                                    }
                    }
                }, _: {
                    detach: function () {
                        this.editor.setData(this.editor.getData(), 0, 1); this.clearListeners(); this.restoreAttrs(); var a; if (a = this.removeCustomData("classes")) for (; a.length;)this.removeClass(a.pop()); if (!this.is("textarea")) {
                            a = this.getDocument(); var b = a.getHead(); if (b.getCustomData("stylesheet")) {
                                var c = a.getCustomData("stylesheet_ref"); --c ? a.setCustomData("stylesheet_ref", c) : (a.removeCustomData("stylesheet_ref"),
                                    b.removeCustomData("stylesheet").remove())
                            }
                        } this.editor.fire("contentDomUnload"); delete this.editor
                    }
                }
            }); CKEDITOR.editor.prototype.editable = function (a) { var b = this._.editable; if (b && a) return 0; arguments.length && (b = this._.editable = a ? a instanceof CKEDITOR.editable ? a : new CKEDITOR.editable(this, a) : (b && b.detach(), null)); return b }; CKEDITOR.on("instanceLoaded", function (b) {
                var c = b.editor; c.on("insertElement", function (a) {
                    a = a.data; a.type == CKEDITOR.NODE_ELEMENT && (a.is("input") || a.is("textarea")) && ("false" != a.getAttribute("contentEditable") &&
                        a.data("cke-editable", a.hasAttribute("contenteditable") ? "true" : "1"), a.setAttribute("contentEditable", !1))
                }); c.on("selectionChange", function (b) { if (!c.readOnly) { var d = c.getSelection(); d && !d.isLocked && (d = c.checkDirty(), c.fire("lockSnapshot"), a(b), c.fire("unlockSnapshot"), !d && c.resetDirty()) } })
            }); CKEDITOR.on("instanceCreated", function (a) {
                var b = a.editor; b.on("mode", function () {
                    var a = b.editable(); if (a && a.isInline()) {
                        var c = b.title; a.changeAttr("role", "textbox"); a.changeAttr("aria-label", c); c && a.changeAttr("title",
                            c); var d = b.fire("ariaEditorHelpLabel", {}).label; if (d && (c = this.ui.space(this.elementMode == CKEDITOR.ELEMENT_MODE_INLINE ? "top" : "contents"))) { var f = CKEDITOR.tools.getNextId(), d = CKEDITOR.dom.element.createFromHtml('\x3cspan id\x3d"' + f + '" class\x3d"cke_voice_label"\x3e' + d + "\x3c/span\x3e"); c.append(d); a.changeAttr("aria-describedby", f) }
                    }
                })
            }); CKEDITOR.addCss(".cke_editable{cursor:text}.cke_editable img,.cke_editable input,.cke_editable textarea{cursor:default}"); g = CKEDITOR.dom.walker.whitespaces(!0); n = CKEDITOR.dom.walker.bookmark(!1,
                !0); v = CKEDITOR.dom.walker.empty(); u = CKEDITOR.dom.walker.bogus(); q = /(^|<body\b[^>]*>)\s*<(p|div|address|h\d|center|pre)[^>]*>\s*(?:<br[^>]*>|&nbsp;|\u00A0|&#160;)?\s*(:?<\/\2>)?\s*(?=$|<\/body>)/gi; t = function () {
                    function a(b) { return b.type == CKEDITOR.NODE_ELEMENT } function b(c, d) {
                        var f, g, e, l, h = [], m = d.range.startContainer; f = d.range.startPath(); for (var m = k[m.getName()], n = 0, y = c.getChildren(), p = y.count(), q = -1, w = -1, t = 0, C = f.contains(k.$list); n < p; ++n)f = y.getItem(n), a(f) ? (e = f.getName(), C && e in CKEDITOR.dtd.$list ?
                            h = h.concat(b(f, d)) : (l = !!m[e], "br" != e || !f.data("cke-eol") || n && n != p - 1 || (t = (g = n ? h[n - 1].node : y.getItem(n + 1)) && (!a(g) || !g.is("br")), g = g && a(g) && k.$block[g.getName()]), -1 != q || l || (q = n), l || (w = n), h.push({ isElement: 1, isLineBreak: t, isBlock: f.isBlockBoundary(), hasBlockSibling: g, node: f, name: e, allowed: l }), g = t = 0)) : h.push({ isElement: 0, node: f, allowed: 1 }); -1 < q && (h[q].firstNotAllowed = 1); -1 < w && (h[w].lastNotAllowed = 1); return h
                    } function d(b, c) {
                        var f = [], g = b.getChildren(), e = g.count(), l, h = 0, m = k[c], r = !b.is(k.$inline) || b.is("br");
                        for (r && f.push(" "); h < e; h++)l = g.getItem(h), a(l) && !l.is(m) ? f = f.concat(d(l, c)) : f.push(l); r && f.push(" "); return f
                    } function g(b) { return a(b.startContainer) && b.startContainer.getChild(b.startOffset - 1) } function e(b) { return b && a(b) && (b.is(k.$removeEmpty) || b.is("a") && !b.isBlockBoundary()) } function l(b, c, d, f) {
                        var g = b.clone(), e, h; g.setEndAt(c, CKEDITOR.POSITION_BEFORE_END); (e = (new CKEDITOR.dom.walker(g)).next()) && a(e) && n[e.getName()] && (h = e.getPrevious()) && a(h) && !h.getParent().equals(b.startContainer) && d.contains(h) &&
                            f.contains(e) && e.isIdentical(h) && (e.moveChildren(h), e.remove(), l(b, c, d, f))
                    } function h(b, c) { function d(b, c) { if (c.isBlock && c.isElement && !c.node.is("br") && a(b) && b.is("br")) return b.remove(), 1 } var f = c.endContainer.getChild(c.endOffset), g = c.endContainer.getChild(c.endOffset - 1); f && d(f, b[b.length - 1]); g && d(g, b[0]) && (c.setEnd(c.endContainer, c.endOffset - 1), c.collapse()) } var k = CKEDITOR.dtd, n = { p: 1, div: 1, h1: 1, h2: 1, h3: 1, h4: 1, h5: 1, h6: 1, ul: 1, ol: 1, li: 1, pre: 1, dl: 1, blockquote: 1 }, y = {
                        p: 1, div: 1, h1: 1, h2: 1, h3: 1, h4: 1, h5: 1,
                        h6: 1
                    }, p = CKEDITOR.tools.extend({}, k.$inline); delete p.br; return function (n, q, H, t) {
                        var u = n.editor, A = !1; "unfiltered_html" == q && (q = "html", A = !0); if (!t.checkReadOnly()) {
                            var v = (new CKEDITOR.dom.elementPath(t.startContainer, t.root)).blockLimit || t.root; n = { type: q, dontFilter: A, editable: n, editor: u, range: t, blockLimit: v, mergeCandidates: [], zombies: [] }; q = n.range; t = n.mergeCandidates; var J, E; "text" == n.type && q.shrink(CKEDITOR.SHRINK_ELEMENT, !0, !1) && (J = CKEDITOR.dom.element.createFromHtml("\x3cspan\x3e\x26nbsp;\x3c/span\x3e",
                                q.document), q.insertNode(J), q.setStartAfter(J)); A = new CKEDITOR.dom.elementPath(q.startContainer); n.endPath = v = new CKEDITOR.dom.elementPath(q.endContainer); if (!q.collapsed) { var u = v.block || v.blockLimit, W = q.getCommonAncestor(); u && !u.equals(W) && !u.contains(W) && q.checkEndOfBlock() && n.zombies.push(u); q.deleteContents() } for (; (E = g(q)) && a(E) && E.isBlockBoundary() && A.contains(E);)q.moveToPosition(E, CKEDITOR.POSITION_BEFORE_END); l(q, n.blockLimit, A, v); J && (q.setEndBefore(J), q.collapse(), J.remove()); J = q.startPath();
                            if (u = J.contains(e, !1, 1)) q.splitElement(u), n.inlineStylesRoot = u, n.inlineStylesPeak = J.lastElement; J = q.createBookmark(); (u = J.startNode.getPrevious(c)) && a(u) && e(u) && t.push(u); (u = J.startNode.getNext(c)) && a(u) && e(u) && t.push(u); for (u = J.startNode; (u = u.getParent()) && e(u);)t.push(u); q.moveToBookmark(J); if (J = H) {
                                J = n.range; if ("text" == n.type && n.inlineStylesRoot) {
                                    E = n.inlineStylesPeak; q = E.getDocument().createText("{cke-peak}"); for (t = n.inlineStylesRoot.getParent(); !E.equals(t);)q = q.appendTo(E.clone()), E = E.getParent();
                                    H = q.getOuterHtml().split("{cke-peak}").join(H)
                                } E = n.blockLimit.getName(); if (/^\s+|\s+$/.test(H) && "span" in CKEDITOR.dtd[E]) { var U = '\x3cspan data-cke-marker\x3d"1"\x3e\x26nbsp;\x3c/span\x3e'; H = U + H + U } H = n.editor.dataProcessor.toHtml(H, { context: null, fixForBody: !1, protectedWhitespaces: !!U, dontFilter: n.dontFilter, filter: n.editor.activeFilter, enterMode: n.editor.activeEnterMode }); E = J.document.createElement("body"); E.setHtml(H); U && (E.getFirst().remove(), E.getLast().remove()); if ((U = J.startPath().block) && (1 !=
                                    U.getChildCount() || !U.getBogus())) a: { var K; if (1 == E.getChildCount() && a(K = E.getFirst()) && K.is(y) && !K.hasAttribute("contenteditable")) { U = K.getElementsByTag("*"); J = 0; for (t = U.count(); J < t; J++)if (q = U.getItem(J), !q.is(p)) break a; K.moveChildren(K.getParent(1)); K.remove() } } n.dataWrapper = E; J = H
                            } if (J) {
                                K = n.range; J = K.document; var M; E = n.blockLimit; t = 0; var S, U = [], Q, Y; H = u = 0; var V, da; q = K.startContainer; var A = n.endPath.elements[0], Z, v = A.getPosition(q), W = !!A.getCommonAncestor(q) && v != CKEDITOR.POSITION_IDENTICAL && !(v & CKEDITOR.POSITION_CONTAINS +
                                    CKEDITOR.POSITION_IS_CONTAINED); q = b(n.dataWrapper, n); for (h(q, K); t < q.length; t++) {
                                        v = q[t]; if (M = v.isLineBreak) { M = K; V = E; var X = void 0, ga = void 0; v.hasBlockSibling ? M = 1 : (X = M.startContainer.getAscendant(k.$block, 1)) && X.is({ div: 1, p: 1 }) ? (ga = X.getPosition(V), ga == CKEDITOR.POSITION_IDENTICAL || ga == CKEDITOR.POSITION_CONTAINS ? M = 0 : (V = M.splitElement(X), M.moveToPosition(V, CKEDITOR.POSITION_AFTER_START), M = 1)) : M = 0 } if (M) H = 0 < t; else {
                                            M = K.startPath(); !v.isBlock && m(n.editor, M.block, M.blockLimit) && (Y = f(n.editor)) && (Y = J.createElement(Y),
                                                Y.appendBogus(), K.insertNode(Y), CKEDITOR.env.needsBrFiller && (S = Y.getBogus()) && S.remove(), K.moveToPosition(Y, CKEDITOR.POSITION_BEFORE_END)); if ((M = K.startPath().block) && !M.equals(Q)) { if (S = M.getBogus()) S.remove(), U.push(M); Q = M } v.firstNotAllowed && (u = 1); if (u && v.isElement) {
                                                    M = K.startContainer; for (V = null; M && !k[M.getName()][v.name];) { if (M.equals(E)) { M = null; break } V = M; M = M.getParent() } if (M) V && (da = K.splitElement(V), n.zombies.push(da), n.zombies.push(V)); else {
                                                        V = E.getName(); Z = !t; M = t == q.length - 1; V = d(v.node, V); for (var X =
                                                            [], ga = V.length, ba = 0, ea = void 0, ha = 0, ia = -1; ba < ga; ba++)ea = V[ba], " " == ea ? (ha || Z && !ba || (X.push(new CKEDITOR.dom.text(" ")), ia = X.length), ha = 1) : (X.push(ea), ha = 0); M && ia == X.length && X.pop(); Z = X
                                                    }
                                                } if (Z) { for (; M = Z.pop();)K.insertNode(M); Z = 0 } else K.insertNode(v.node); v.lastNotAllowed && t < q.length - 1 && ((da = W ? A : da) && K.setEndAt(da, CKEDITOR.POSITION_AFTER_START), u = 0); K.collapse()
                                        }
                                    } 1 != q.length ? S = !1 : (S = q[0], S = S.isElement && "false" == S.node.getAttribute("contenteditable")); S && (H = !0, M = q[0].node, K.setStartAt(M, CKEDITOR.POSITION_BEFORE_START),
                                        K.setEndAt(M, CKEDITOR.POSITION_AFTER_END)); n.dontMoveCaret = H; n.bogusNeededBlocks = U
                            } S = n.range; var aa; da = n.bogusNeededBlocks; for (Z = S.createBookmark(); Q = n.zombies.pop();)Q.getParent() && (Y = S.clone(), Y.moveToElementEditStart(Q), Y.removeEmptyBlocksAtEnd()); if (da) for (; Q = da.pop();)CKEDITOR.env.needsBrFiller ? Q.appendBogus() : Q.append(S.document.createText("Â ")); for (; Q = n.mergeCandidates.pop();)Q.mergeSiblings(); S.moveToBookmark(Z); if (!n.dontMoveCaret) {
                                for (Q = g(S); Q && a(Q) && !Q.is(k.$empty);) {
                                    if (Q.isBlockBoundary()) S.moveToPosition(Q,
                                        CKEDITOR.POSITION_BEFORE_END); else { if (e(Q) && Q.getHtml().match(/(\s|&nbsp;)$/g)) { aa = null; break } aa = S.clone(); aa.moveToPosition(Q, CKEDITOR.POSITION_BEFORE_END) } Q = Q.getLast(c)
                                } aa && S.moveToRange(aa)
                            }
                        }
                    }
                }(); p = function () {
                    function a(b) { b = new CKEDITOR.dom.walker(b); b.guard = function (a, b) { if (b) return !1; if (a.type == CKEDITOR.NODE_ELEMENT) return a.is(CKEDITOR.dtd.$tableContent) }; b.evaluator = function (a) { return a.type == CKEDITOR.NODE_ELEMENT }; return b } function b(a, c, d) {
                        c = a.getDocument().createElement(c); a.append(c,
                            d); return c
                    } function c(a) { var b = a.count(), d; for (b; 0 < b--;)d = a.getItem(b), CKEDITOR.tools.trim(d.getHtml()) || (d.appendBogus(), CKEDITOR.env.ie && 9 > CKEDITOR.env.version && d.getChildCount() && d.getFirst().remove()) } return function (d) {
                        var f = d.startContainer, g = f.getAscendant("table", 1), e = !1; c(g.getElementsByTag("td")); c(g.getElementsByTag("th")); g = d.clone(); g.setStart(f, 0); g = a(g).lastBackward(); g || (g = d.clone(), g.setEndAt(f, CKEDITOR.POSITION_BEFORE_END), g = a(g).lastForward(), e = !0); g || (g = f); g.is("table") ? (d.setStartAt(g,
                            CKEDITOR.POSITION_BEFORE_START), d.collapse(!0), g.remove()) : (g.is({ tbody: 1, thead: 1, tfoot: 1 }) && (g = b(g, "tr", e)), g.is("tr") && (g = b(g, g.getParent().is("thead") ? "th" : "td", e)), (f = g.getBogus()) && f.remove(), d.moveToPosition(g, e ? CKEDITOR.POSITION_AFTER_START : CKEDITOR.POSITION_BEFORE_END))
                    }
                }(); y = {
                    eol: {
                        detect: function (a, b) {
                            var c = a.range, d = c.clone(), f = c.clone(), g = new CKEDITOR.dom.elementPath(c.startContainer, b), e = new CKEDITOR.dom.elementPath(c.endContainer, b); d.collapse(1); f.collapse(); g.block && d.checkBoundaryOfElement(g.block,
                                CKEDITOR.END) && (c.setStartAfter(g.block), a.prependEolBr = 1); e.block && f.checkBoundaryOfElement(e.block, CKEDITOR.START) && (c.setEndBefore(e.block), a.appendEolBr = 1)
                        }, fix: function (a, b) { var c = b.getDocument(), d; a.appendEolBr && (d = this.createEolBr(c), a.fragment.append(d)); !a.prependEolBr || d && !d.getPrevious() || a.fragment.append(this.createEolBr(c), 1) }, createEolBr: function (a) { return a.createElement("br", { attributes: { "data-cke-eol": 1 } }) }
                    }, bogus: {
                        exclude: function (a) {
                            var b = a.range.getBoundaryNodes(), c = b.startNode,
                            b = b.endNode; !b || !u(b) || c && c.equals(b) || a.range.setEndBefore(b)
                        }
                    }, tree: {
                        rebuild: function (a, b) {
                            var c = a.range, d = c.getCommonAncestor(), f = new CKEDITOR.dom.elementPath(d, b), g = new CKEDITOR.dom.elementPath(c.startContainer, b), c = new CKEDITOR.dom.elementPath(c.endContainer, b), e; d.type == CKEDITOR.NODE_TEXT && (d = d.getParent()); if (f.blockLimit.is({ tr: 1, table: 1 })) { var h = f.contains("table").getParent(); e = function (a) { return !a.equals(h) } } else if (f.block && f.block.is(CKEDITOR.dtd.$listItem) && (g = g.contains(CKEDITOR.dtd.$list),
                                c = c.contains(CKEDITOR.dtd.$list), !g.equals(c))) { var l = f.contains(CKEDITOR.dtd.$list).getParent(); e = function (a) { return !a.equals(l) } } e || (e = function (a) { return !a.equals(f.block) && !a.equals(f.blockLimit) }); this.rebuildFragment(a, b, d, e)
                        }, rebuildFragment: function (a, b, c, d) { for (var f; c && !c.equals(b) && d(c);)f = c.clone(0, 1), a.fragment.appendTo(f), a.fragment = f, c = c.getParent() }
                    }, cell: {
                        shrink: function (a) {
                            a = a.range; var b = a.startContainer, c = a.endContainer, d = a.startOffset, f = a.endOffset; b.type == CKEDITOR.NODE_ELEMENT &&
                                b.equals(c) && b.is("tr") && ++d == f && a.shrink(CKEDITOR.SHRINK_TEXT)
                        }
                    }
                }; A = function () {
                    function a(b, c) { var d = b.getParent(); if (d.is(CKEDITOR.dtd.$inline)) b[c ? "insertBefore" : "insertAfter"](d) } function b(c, d, f) { a(d); a(f, 1); for (var g; g = f.getNext();)g.insertAfter(d), d = g; v(c) && c.remove() } function c(a, b) { var d = new CKEDITOR.dom.range(a); d.setStartAfter(b.startNode); d.setEndBefore(b.endNode); return d } return {
                        list: {
                            detectMerge: function (a, b) {
                                var d = c(b, a.bookmark), f = d.startPath(), g = d.endPath(), e = f.contains(CKEDITOR.dtd.$list),
                                h = g.contains(CKEDITOR.dtd.$list); a.mergeList = e && h && e.getParent().equals(h.getParent()) && !e.equals(h); a.mergeListItems = f.block && g.block && f.block.is(CKEDITOR.dtd.$listItem) && g.block.is(CKEDITOR.dtd.$listItem); if (a.mergeList || a.mergeListItems) d = d.clone(), d.setStartBefore(a.bookmark.startNode), d.setEndAfter(a.bookmark.endNode), a.mergeListBookmark = d.createBookmark()
                            }, merge: function (a, c) {
                                if (a.mergeListBookmark) {
                                    var d = a.mergeListBookmark.startNode, f = a.mergeListBookmark.endNode, g = new CKEDITOR.dom.elementPath(d,
                                        c), e = new CKEDITOR.dom.elementPath(f, c); if (a.mergeList) { var h = g.contains(CKEDITOR.dtd.$list), l = e.contains(CKEDITOR.dtd.$list); h.equals(l) || (l.moveChildren(h), l.remove()) } a.mergeListItems && (g = g.contains(CKEDITOR.dtd.$listItem), e = e.contains(CKEDITOR.dtd.$listItem), g.equals(e) || b(e, d, f)); d.remove(); f.remove()
                                }
                            }
                        }, block: {
                            detectMerge: function (a, b) {
                                if (!a.tableContentsRanges && !a.mergeListBookmark) {
                                    var c = new CKEDITOR.dom.range(b); c.setStartBefore(a.bookmark.startNode); c.setEndAfter(a.bookmark.endNode); a.mergeBlockBookmark =
                                        c.createBookmark()
                                }
                            }, merge: function (a, c) { if (a.mergeBlockBookmark && !a.purgeTableBookmark) { var d = a.mergeBlockBookmark.startNode, f = a.mergeBlockBookmark.endNode, g = new CKEDITOR.dom.elementPath(d, c), e = new CKEDITOR.dom.elementPath(f, c), g = g.block, e = e.block; g && e && !g.equals(e) && b(e, d, f); d.remove(); f.remove() } }
                        }, table: function () {
                            function a(c) {
                                var f = [], g, e = new CKEDITOR.dom.walker(c), h = c.startPath().contains(d), l = c.endPath().contains(d), k = {}; e.guard = function (a, e) {
                                    if (a.type == CKEDITOR.NODE_ELEMENT) {
                                        var m = "visited_" +
                                            (e ? "out" : "in"); if (a.getCustomData(m)) return; CKEDITOR.dom.element.setMarker(k, a, m, 1)
                                    } if (e && h && a.equals(h)) g = c.clone(), g.setEndAt(h, CKEDITOR.POSITION_BEFORE_END), f.push(g); else if (!e && l && a.equals(l)) g = c.clone(), g.setStartAt(l, CKEDITOR.POSITION_AFTER_START), f.push(g); else { if (m = !e) m = a.type == CKEDITOR.NODE_ELEMENT && a.is(d) && (!h || b(a, h)) && (!l || b(a, l)); m && (g = c.clone(), g.selectNodeContents(a), f.push(g)) }
                                }; e.lastForward(); CKEDITOR.dom.element.clearAllMarkers(k); return f
                            } function b(a, c) {
                                var d = CKEDITOR.POSITION_CONTAINS +
                                    CKEDITOR.POSITION_IS_CONTAINED, f = a.getPosition(c); return f === CKEDITOR.POSITION_IDENTICAL ? !1 : 0 === (f & d)
                            } var d = { td: 1, th: 1, caption: 1 }; return {
                                detectPurge: function (a) {
                                    var b = a.range, c = b.clone(); c.enlarge(CKEDITOR.ENLARGE_ELEMENT); var c = new CKEDITOR.dom.walker(c), f = 0; c.evaluator = function (a) { a.type == CKEDITOR.NODE_ELEMENT && a.is(d) && ++f }; c.checkForward(); if (1 < f) {
                                        var c = b.startPath().contains("table"), g = b.endPath().contains("table"); c && g && b.checkBoundaryOfElement(c, CKEDITOR.START) && b.checkBoundaryOfElement(g,
                                            CKEDITOR.END) && (b = a.range.clone(), b.setStartBefore(c), b.setEndAfter(g), a.purgeTableBookmark = b.createBookmark())
                                    }
                                }, detectRanges: function (f, g) {
                                    var e = c(g, f.bookmark), h = e.clone(), l, k, m = e.getCommonAncestor(); m.is(CKEDITOR.dtd.$tableContent) && !m.is(d) && (m = m.getAscendant("table", !0)); k = m; m = new CKEDITOR.dom.elementPath(e.startContainer, k); k = new CKEDITOR.dom.elementPath(e.endContainer, k); m = m.contains("table"); k = k.contains("table"); if (m || k) m && k && b(m, k) ? (f.tableSurroundingRange = h, h.setStartAt(m, CKEDITOR.POSITION_AFTER_END),
                                        h.setEndAt(k, CKEDITOR.POSITION_BEFORE_START), h = e.clone(), h.setEndAt(m, CKEDITOR.POSITION_AFTER_END), l = e.clone(), l.setStartAt(k, CKEDITOR.POSITION_BEFORE_START), l = a(h).concat(a(l))) : m ? k || (f.tableSurroundingRange = h, h.setStartAt(m, CKEDITOR.POSITION_AFTER_END), e.setEndAt(m, CKEDITOR.POSITION_AFTER_END)) : (f.tableSurroundingRange = h, h.setEndAt(k, CKEDITOR.POSITION_BEFORE_START), e.setStartAt(k, CKEDITOR.POSITION_AFTER_START)), f.tableContentsRanges = l ? l : a(e)
                                }, deleteRanges: function (a) {
                                    for (var b; b = a.tableContentsRanges.pop();)b.extractContents(),
                                        v(b.startContainer) && b.startContainer.appendBogus(); a.tableSurroundingRange && a.tableSurroundingRange.extractContents()
                                }, purge: function (a) { if (a.purgeTableBookmark) { var b = a.doc, c = a.range.clone(), b = b.createElement("p"); b.insertBefore(a.purgeTableBookmark.startNode); c.moveToBookmark(a.purgeTableBookmark); c.deleteContents(); a.range.moveToPosition(b, CKEDITOR.POSITION_AFTER_START) } }
                            }
                        }(), detectExtractMerge: function (a) { return !(a.range.startPath().contains(CKEDITOR.dtd.$listItem) && a.range.endPath().contains(CKEDITOR.dtd.$listItem)) },
                        fixUneditableRangePosition: function (a) { a.startContainer.getDtd()["#"] || a.moveToClosestEditablePosition(null, !0) }, autoParagraph: function (a, b) { var c = b.startPath(), d; m(a, c.block, c.blockLimit) && (d = f(a)) && (d = b.document.createElement(d), d.appendBogus(), b.insertNode(d), b.moveToPosition(d, CKEDITOR.POSITION_AFTER_START)) }
                    }
                }()
        }(), function () {
            function a() {
                var a = this._.fakeSelection, b; a && (b = this.getSelection(1), b && b.isHidden() || (a.reset(), a = 0)); if (!a && (a = b || this.getSelection(1), !a || a.getType() == CKEDITOR.SELECTION_NONE)) return;
                this.fire("selectionCheck", a); b = this.elementPath(); b.compare(this._.selectionPreviousPath) || (CKEDITOR.env.webkit && (this._.previousActive = this.document.getActive()), this._.selectionPreviousPath = b, this.fire("selectionChange", { selection: a, path: b }))
            } function e() { v = !0; n || (b.call(this), n = CKEDITOR.tools.setTimeout(b, 200, this)) } function b() { n = null; v && (CKEDITOR.tools.setTimeout(a, 0, this), v = !1) } function c(a) { return u(a) || a.type == CKEDITOR.NODE_ELEMENT && !a.is(CKEDITOR.dtd.$empty) ? !0 : !1 } function d(a) {
                function b(c,
                    d) { return c && c.type != CKEDITOR.NODE_TEXT ? a.clone()["moveToElementEdit" + (d ? "End" : "Start")](c) : !1 } if (!(a.root instanceof CKEDITOR.editable)) return !1; var d = a.startContainer, f = a.getPreviousNode(c, null, d), g = a.getNextNode(c, null, d); return b(f) || b(g, 1) || !(f || g || d.type == CKEDITOR.NODE_ELEMENT && d.isBlockBoundary() && d.getBogus()) ? !0 : !1
            } function k(a) { m(a, !1); var b = a.getDocument().createText(A); a.setCustomData("cke-fillingChar", b); return b } function m(a, b) {
                var c = a && a.removeCustomData("cke-fillingChar"); if (c) {
                    if (!1 !==
                        b) { var d = a.getDocument().getSelection().getNative(), g = d && "None" != d.type && d.getRangeAt(0), e = A.length; if (c.getLength() > e && g && g.intersectsNode(c.$)) { var h = [{ node: d.anchorNode, offset: d.anchorOffset }, { node: d.focusNode, offset: d.focusOffset }]; d.anchorNode == c.$ && d.anchorOffset > e && (h[0].offset -= e); d.focusNode == c.$ && d.focusOffset > e && (h[1].offset -= e) } } c.setText(f(c.getText(), 1)); h && (c = a.getDocument().$, d = c.getSelection(), c = c.createRange(), c.setStart(h[0].node, h[0].offset), c.collapse(!0), d.removeAllRanges(),
                            d.addRange(c), d.extend(h[1].node, h[1].offset))
                }
            } function f(a, b) { return b ? a.replace(z, function (a, b) { return b ? "Â " : "" }) : a.replace(A, "") } function h(a, b) {
                var c = CKEDITOR.dom.element.createFromHtml('\x3cdiv data-cke-hidden-sel\x3d"1" data-cke-temp\x3d"1" style\x3d"' + (CKEDITOR.env.ie ? "display:none" : "position:fixed;top:0;left:-1000px") + '"\x3e' + (b || "\x26nbsp;") + "\x3c/div\x3e", a.document); a.fire("lockSnapshot"); a.editable().append(c); var d = a.getSelection(1), f = a.createRange(), g = d.root.on("selectionchange", function (a) { a.cancel() },
                    null, null, 0); f.setStartAt(c, CKEDITOR.POSITION_AFTER_START); f.setEndAt(c, CKEDITOR.POSITION_BEFORE_END); d.selectRanges([f]); g.removeListener(); a.fire("unlockSnapshot"); a._.hiddenSelectionContainer = c
            } function l(a) {
                var b = { 37: 1, 39: 1, 8: 1, 46: 1 }; return function (c) {
                    var d = c.data.getKeystroke(); if (b[d]) {
                        var f = a.getSelection().getRanges(), g = f[0]; 1 == f.length && g.collapsed && (d = g[38 > d ? "getPreviousEditableNode" : "getNextEditableNode"]()) && d.type == CKEDITOR.NODE_ELEMENT && "false" == d.getAttribute("contenteditable") && (a.getSelection().fake(d),
                            c.data.preventDefault(), c.cancel())
                    }
                }
            } function g(a) {
                for (var b = 0; b < a.length; b++) {
                    var c = a[b]; c.getCommonAncestor().isReadOnly() && a.splice(b, 1); if (!c.collapsed) {
                        if (c.startContainer.isReadOnly()) for (var d = c.startContainer, f; d && !((f = d.type == CKEDITOR.NODE_ELEMENT) && d.is("body") || !d.isReadOnly());)f && "false" == d.getAttribute("contentEditable") && c.setStartAfter(d), d = d.getParent(); d = c.startContainer; f = c.endContainer; var g = c.startOffset, e = c.endOffset, h = c.clone(); d && d.type == CKEDITOR.NODE_TEXT && (g >= d.getLength() ?
                            h.setStartAfter(d) : h.setStartBefore(d)); f && f.type == CKEDITOR.NODE_TEXT && (e ? h.setEndAfter(f) : h.setEndBefore(f)); d = new CKEDITOR.dom.walker(h); d.evaluator = function (d) { if (d.type == CKEDITOR.NODE_ELEMENT && d.isReadOnly()) { var f = c.clone(); c.setEndBefore(d); c.collapsed && a.splice(b--, 1); d.getPosition(h.endContainer) & CKEDITOR.POSITION_CONTAINS || (f.setStartAfter(d), f.collapsed || a.splice(b + 1, 0, f)); return !0 } return !1 }; d.next()
                    }
                } return a
            } var n, v, u = CKEDITOR.dom.walker.invisible(1), q = function () {
                function a(b) {
                    return function (a) {
                        var c =
                            a.editor.createRange(); c.moveToClosestEditablePosition(a.selected, b) && a.editor.getSelection().selectRanges([c]); return !1
                    }
                } function b(a) { return function (b) { var c = b.editor, d = c.createRange(), f; (f = d.moveToClosestEditablePosition(b.selected, a)) || (f = d.moveToClosestEditablePosition(b.selected, !a)); f && c.getSelection().selectRanges([d]); c.fire("saveSnapshot"); b.selected.remove(); f || (d.moveToElementEditablePosition(c.editable()), c.getSelection().selectRanges([d])); c.fire("saveSnapshot"); return !1 } } var c = a(),
                    d = a(1); return { 37: c, 38: c, 39: d, 40: d, 8: b(), 46: b(1) }
            }(); CKEDITOR.on("instanceCreated", function (b) {
                function c() { var a = d.getSelection(); a && a.removeAllRanges() } var d = b.editor; d.on("contentDom", function () {
                    function b() { y = new CKEDITOR.dom.selection(d.getSelection()); y.lock() } function c() { g.removeListener("mouseup", c); n.removeListener("mouseup", c); var a = CKEDITOR.document.$.selection, b = a.createRange(); "None" != a.type && b.parentElement().ownerDocument == f.$ && b.select() } var f = d.document, g = CKEDITOR.document, h = d.editable(),
                        k = f.getBody(), n = f.getDocumentElement(), r = h.isInline(), q, y; CKEDITOR.env.gecko && h.attachListener(h, "focus", function (a) { a.removeListener(); 0 !== q && (a = d.getSelection().getNative()) && a.isCollapsed && a.anchorNode == h.$ && (a = d.createRange(), a.moveToElementEditStart(h), a.select()) }, null, null, -2); h.attachListener(h, CKEDITOR.env.webkit ? "DOMFocusIn" : "focus", function () { q && CKEDITOR.env.webkit && (q = d._.previousActive && d._.previousActive.equals(f.getActive())); d.unlockSelection(q); q = 0 }, null, null, -1); h.attachListener(h,
                            "mousedown", function () { q = 0 }); if (CKEDITOR.env.ie || r) t ? h.attachListener(h, "beforedeactivate", b, null, null, -1) : h.attachListener(d, "selectionCheck", b, null, null, -1), h.attachListener(h, CKEDITOR.env.webkit ? "DOMFocusOut" : "blur", function () { d.lockSelection(y); q = 1 }, null, null, -1), h.attachListener(h, "mousedown", function () { q = 0 }); if (CKEDITOR.env.ie && !r) {
                                var p; h.attachListener(h, "mousedown", function (a) { 2 == a.data.$.button && ((a = d.document.getSelection()) && a.getType() != CKEDITOR.SELECTION_NONE || (p = d.window.getScrollPosition())) });
                                h.attachListener(h, "mouseup", function (a) { 2 == a.data.$.button && p && (d.document.$.documentElement.scrollLeft = p.x, d.document.$.documentElement.scrollTop = p.y); p = null }); if ("BackCompat" != f.$.compatMode) {
                                    if (CKEDITOR.env.ie7Compat || CKEDITOR.env.ie6Compat) n.on("mousedown", function (a) {
                                        function b(a) { a = a.data.$; if (d) { var c = k.$.createTextRange(); try { c.moveToPoint(a.clientX, a.clientY) } catch (f) { } d.setEndPoint(0 > e.compareEndPoints("StartToStart", c) ? "EndToEnd" : "StartToStart", c); d.select() } } function c() {
                                            n.removeListener("mousemove",
                                                b); g.removeListener("mouseup", c); n.removeListener("mouseup", c); d.select()
                                        } a = a.data; if (a.getTarget().is("html") && a.$.y < n.$.clientHeight && a.$.x < n.$.clientWidth) { var d = k.$.createTextRange(); try { d.moveToPoint(a.$.clientX, a.$.clientY) } catch (f) { } var e = d.duplicate(); n.on("mousemove", b); g.on("mouseup", c); n.on("mouseup", c) }
                                    }); if (7 < CKEDITOR.env.version && 11 > CKEDITOR.env.version) n.on("mousedown", function (a) { a.data.getTarget().is("html") && (g.on("mouseup", c), n.on("mouseup", c)) })
                                }
                            } h.attachListener(h, "selectionchange",
                                a, d); h.attachListener(h, "keyup", e, d); h.attachListener(h, CKEDITOR.env.webkit ? "DOMFocusIn" : "focus", function () { d.forceNextSelectionCheck(); d.selectionChange(1) }); if (r && (CKEDITOR.env.webkit || CKEDITOR.env.gecko)) { var u; h.attachListener(h, "mousedown", function () { u = 1 }); h.attachListener(f.getDocumentElement(), "mouseup", function () { u && e.call(d); u = 0 }) } else h.attachListener(CKEDITOR.env.ie ? h : f.getDocumentElement(), "mouseup", e, d); CKEDITOR.env.webkit && h.attachListener(f, "keydown", function (a) { switch (a.data.getKey()) { case 13: case 33: case 34: case 35: case 36: case 37: case 39: case 8: case 45: case 46: m(h) } },
                                    null, null, -1); h.attachListener(h, "keydown", l(d), null, null, -1)
                }); d.on("setData", function () { d.unlockSelection(); CKEDITOR.env.webkit && c() }); d.on("contentDomUnload", function () { d.unlockSelection() }); if (CKEDITOR.env.ie9Compat) d.on("beforeDestroy", c, null, null, 9); d.on("dataReady", function () { delete d._.fakeSelection; delete d._.hiddenSelectionContainer; d.selectionChange(1) }); d.on("loadSnapshot", function () {
                    var a = CKEDITOR.dom.walker.nodeType(CKEDITOR.NODE_ELEMENT), b = d.editable().getLast(a); b && b.hasAttribute("data-cke-hidden-sel") &&
                        (b.remove(), CKEDITOR.env.gecko && (a = d.editable().getFirst(a)) && a.is("br") && a.getAttribute("_moz_editor_bogus_node") && a.remove())
                }, null, null, 100); d.on("key", function (a) { if ("wysiwyg" == d.mode) { var b = d.getSelection(); if (b.isFake) { var c = q[a.data.keyCode]; if (c) return c({ editor: d, selected: b.getSelectedElement(), selection: b, keyEvent: a }) } } })
            }); if (CKEDITOR.env.webkit) CKEDITOR.on("instanceReady", function (a) {
                var b = a.editor; b.on("selectionChange", function () {
                    var a = b.editable(), c = a.getCustomData("cke-fillingChar");
                    c && (c.getCustomData("ready") ? m(a) : c.setCustomData("ready", 1))
                }, null, null, -1); b.on("beforeSetMode", function () { m(b.editable()) }, null, null, -1); b.on("getSnapshot", function (a) { a.data && (a.data = f(a.data)) }, b, null, 20); b.on("toDataFormat", function (a) { a.data.dataValue = f(a.data.dataValue) }, null, null, 0)
            }); CKEDITOR.editor.prototype.selectionChange = function (b) { (b ? a : e).call(this) }; CKEDITOR.editor.prototype.getSelection = function (a) {
                return !this._.savedSelection && !this._.fakeSelection || a ? (a = this.editable()) && "wysiwyg" ==
                    this.mode ? new CKEDITOR.dom.selection(a) : null : this._.savedSelection || this._.fakeSelection
            }; CKEDITOR.editor.prototype.lockSelection = function (a) { a = a || this.getSelection(1); return a.getType() != CKEDITOR.SELECTION_NONE ? (!a.isLocked && a.lock(), this._.savedSelection = a, !0) : !1 }; CKEDITOR.editor.prototype.unlockSelection = function (a) { var b = this._.savedSelection; return b ? (b.unlock(a), delete this._.savedSelection, !0) : !1 }; CKEDITOR.editor.prototype.forceNextSelectionCheck = function () { delete this._.selectionPreviousPath };
            CKEDITOR.dom.document.prototype.getSelection = function () { return new CKEDITOR.dom.selection(this) }; CKEDITOR.dom.range.prototype.select = function () { var a = this.root instanceof CKEDITOR.editable ? this.root.editor.getSelection() : new CKEDITOR.dom.selection(this.root); a.selectRanges([this]); return a }; CKEDITOR.SELECTION_NONE = 1; CKEDITOR.SELECTION_TEXT = 2; CKEDITOR.SELECTION_ELEMENT = 3; var t = "function" != typeof window.getSelection, p = 1; CKEDITOR.dom.selection = function (a) {
                if (a instanceof CKEDITOR.dom.selection) {
                    var b =
                        a; a = a.root
                } var c = a instanceof CKEDITOR.dom.element; this.rev = b ? b.rev : p++; this.document = a instanceof CKEDITOR.dom.document ? a : a.getDocument(); this.root = c ? a : this.document.getBody(); this.isLocked = 0; this._ = { cache: {} }; if (b) return CKEDITOR.tools.extend(this._.cache, b._.cache), this.isFake = b.isFake, this.isLocked = b.isLocked, this; a = this.getNative(); var d, f; if (a) if (a.getRangeAt) d = (f = a.rangeCount && a.getRangeAt(0)) && new CKEDITOR.dom.node(f.commonAncestorContainer); else {
                    try { f = a.createRange() } catch (g) { } d = f && CKEDITOR.dom.element.get(f.item &&
                        f.item(0) || f.parentElement())
                } if (!d || d.type != CKEDITOR.NODE_ELEMENT && d.type != CKEDITOR.NODE_TEXT || !this.root.equals(d) && !this.root.contains(d)) this._.cache.type = CKEDITOR.SELECTION_NONE, this._.cache.startElement = null, this._.cache.selectedElement = null, this._.cache.selectedText = "", this._.cache.ranges = new CKEDITOR.dom.rangeList; return this
            }; var y = { img: 1, hr: 1, li: 1, table: 1, tr: 1, td: 1, th: 1, embed: 1, object: 1, ol: 1, ul: 1, a: 1, input: 1, form: 1, select: 1, textarea: 1, button: 1, fieldset: 1, thead: 1, tfoot: 1 }, A = CKEDITOR.tools.repeat("â€‹",
                7), z = new RegExp(A + "( )?", "g"); CKEDITOR.tools.extend(CKEDITOR.dom.selection, { _removeFillingCharSequenceString: f, _createFillingCharSequenceNode: k, FILLING_CHAR_SEQUENCE: A }); CKEDITOR.dom.selection.prototype = {
                    getNative: function () { return void 0 !== this._.cache.nativeSel ? this._.cache.nativeSel : this._.cache.nativeSel = t ? this.document.$.selection : this.document.getWindow().$.getSelection() }, getType: t ? function () {
                        var a = this._.cache; if (a.type) return a.type; var b = CKEDITOR.SELECTION_NONE; try {
                            var c = this.getNative(),
                            d = c.type; "Text" == d && (b = CKEDITOR.SELECTION_TEXT); "Control" == d && (b = CKEDITOR.SELECTION_ELEMENT); c.createRange().parentElement() && (b = CKEDITOR.SELECTION_TEXT)
                        } catch (f) { } return a.type = b
                    } : function () {
                        var a = this._.cache; if (a.type) return a.type; var b = CKEDITOR.SELECTION_TEXT, c = this.getNative(); if (!c || !c.rangeCount) b = CKEDITOR.SELECTION_NONE; else if (1 == c.rangeCount) {
                            var c = c.getRangeAt(0), d = c.startContainer; d == c.endContainer && 1 == d.nodeType && 1 == c.endOffset - c.startOffset && y[d.childNodes[c.startOffset].nodeName.toLowerCase()] &&
                                (b = CKEDITOR.SELECTION_ELEMENT)
                        } return a.type = b
                    }, getRanges: function () {
                        var a = t ? function () {
                            function a(b) { return (new CKEDITOR.dom.node(b)).getIndex() } var b = function (b, c) {
                                b = b.duplicate(); b.collapse(c); var d = b.parentElement(); if (!d.hasChildNodes()) return { container: d, offset: 0 }; for (var f = d.children, g, e, h = b.duplicate(), l = 0, k = f.length - 1, m = -1, n, q; l <= k;)if (m = Math.floor((l + k) / 2), g = f[m], h.moveToElementText(g), n = h.compareEndPoints("StartToStart", b), 0 < n) k = m - 1; else if (0 > n) l = m + 1; else return { container: d, offset: a(g) };
                                if (-1 == m || m == f.length - 1 && 0 > n) { h.moveToElementText(d); h.setEndPoint("StartToStart", b); h = h.text.replace(/(\r\n|\r)/g, "\n").length; f = d.childNodes; if (!h) return g = f[f.length - 1], g.nodeType != CKEDITOR.NODE_TEXT ? { container: d, offset: f.length } : { container: g, offset: g.nodeValue.length }; for (d = f.length; 0 < h && 0 < d;)e = f[--d], e.nodeType == CKEDITOR.NODE_TEXT && (q = e, h -= e.nodeValue.length); return { container: q, offset: -h } } h.collapse(0 < n ? !0 : !1); h.setEndPoint(0 < n ? "StartToStart" : "EndToStart", b); h = h.text.replace(/(\r\n|\r)/g, "\n").length;
                                if (!h) return { container: d, offset: a(g) + (0 < n ? 0 : 1) }; for (; 0 < h;)try { e = g[0 < n ? "previousSibling" : "nextSibling"], e.nodeType == CKEDITOR.NODE_TEXT && (h -= e.nodeValue.length, q = e), g = e } catch (y) { return { container: d, offset: a(g) } } return { container: q, offset: 0 < n ? -h : q.nodeValue.length + h }
                            }; return function () {
                                var a = this.getNative(), c = a && a.createRange(), d = this.getType(); if (!a) return []; if (d == CKEDITOR.SELECTION_TEXT) return a = new CKEDITOR.dom.range(this.root), d = b(c, !0), a.setStart(new CKEDITOR.dom.node(d.container), d.offset), d = b(c),
                                    a.setEnd(new CKEDITOR.dom.node(d.container), d.offset), a.endContainer.getPosition(a.startContainer) & CKEDITOR.POSITION_PRECEDING && a.endOffset <= a.startContainer.getIndex() && a.collapse(), [a]; if (d == CKEDITOR.SELECTION_ELEMENT) { for (var d = [], f = 0; f < c.length; f++) { for (var g = c.item(f), e = g.parentNode, h = 0, a = new CKEDITOR.dom.range(this.root); h < e.childNodes.length && e.childNodes[h] != g; h++); a.setStart(new CKEDITOR.dom.node(e), h); a.setEnd(new CKEDITOR.dom.node(e), h + 1); d.push(a) } return d } return []
                            }
                        }() : function () {
                            var a =
                                [], b, c = this.getNative(); if (!c) return a; for (var d = 0; d < c.rangeCount; d++) { var f = c.getRangeAt(d); b = new CKEDITOR.dom.range(this.root); b.setStart(new CKEDITOR.dom.node(f.startContainer), f.startOffset); b.setEnd(new CKEDITOR.dom.node(f.endContainer), f.endOffset); a.push(b) } return a
                        }; return function (b) { var c = this._.cache, d = c.ranges; d || (c.ranges = d = new CKEDITOR.dom.rangeList(a.call(this))); return b ? g(new CKEDITOR.dom.rangeList(d.slice())) : d }
                    }(), getStartElement: function () {
                        var a = this._.cache; if (void 0 !== a.startElement) return a.startElement;
                        var b; switch (this.getType()) {
                            case CKEDITOR.SELECTION_ELEMENT: return this.getSelectedElement(); case CKEDITOR.SELECTION_TEXT: var c = this.getRanges()[0]; if (c) {
                                if (c.collapsed) b = c.startContainer, b.type != CKEDITOR.NODE_ELEMENT && (b = b.getParent()); else {
                                    for (c.optimize(); b = c.startContainer, c.startOffset == (b.getChildCount ? b.getChildCount() : b.getLength()) && !b.isBlockBoundary();)c.setStartAfter(b); b = c.startContainer; if (b.type != CKEDITOR.NODE_ELEMENT) return b.getParent(); if ((b = b.getChild(c.startOffset)) && b.type ==
                                        CKEDITOR.NODE_ELEMENT) for (c = b.getFirst(); c && c.type == CKEDITOR.NODE_ELEMENT;)b = c, c = c.getFirst(); else b = c.startContainer
                                } b = b.$
                            }
                        }return a.startElement = b ? new CKEDITOR.dom.element(b) : null
                    }, getSelectedElement: function () {
                        var a = this._.cache; if (void 0 !== a.selectedElement) return a.selectedElement; var b = this, c = CKEDITOR.tools.tryThese(function () { return b.getNative().createRange().item(0) }, function () {
                            for (var a = b.getRanges()[0].clone(), c, d, f = 2; f && !((c = a.getEnclosedNode()) && c.type == CKEDITOR.NODE_ELEMENT && y[c.getName()] &&
                                (d = c)); f--)a.shrink(CKEDITOR.SHRINK_ELEMENT); return d && d.$
                        }); return a.selectedElement = c ? new CKEDITOR.dom.element(c) : null
                    }, getSelectedText: function () { var a = this._.cache; if (void 0 !== a.selectedText) return a.selectedText; var b = this.getNative(), b = t ? "Control" == b.type ? "" : b.createRange().text : b.toString(); return a.selectedText = b }, lock: function () { this.getRanges(); this.getStartElement(); this.getSelectedElement(); this.getSelectedText(); this._.cache.nativeSel = null; this.isLocked = 1 }, unlock: function (a) {
                        if (this.isLocked) {
                            if (a) var b =
                                this.getSelectedElement(), c = !b && this.getRanges(), d = this.isFake; this.isLocked = 0; this.reset(); a && (a = b || c[0] && c[0].getCommonAncestor()) && a.getAscendant("body", 1) && (d ? this.fake(b) : b ? this.selectElement(b) : this.selectRanges(c))
                        }
                    }, reset: function () {
                        this._.cache = {}; this.isFake = 0; var a = this.root.editor; if (a && a._.fakeSelection) if (this.rev == a._.fakeSelection.rev) {
                            delete a._.fakeSelection; var b = a._.hiddenSelectionContainer; if (b) {
                                var c = a.checkDirty(); a.fire("lockSnapshot"); b.remove(); a.fire("unlockSnapshot"); !c &&
                                    a.resetDirty()
                            } delete a._.hiddenSelectionContainer
                        } else CKEDITOR.warn("selection-fake-reset"); this.rev = p++
                    }, selectElement: function (a) { var b = new CKEDITOR.dom.range(this.root); b.setStartBefore(a); b.setEndAfter(a); this.selectRanges([b]) }, selectRanges: function (a) {
                        var b = this.root.editor, b = b && b._.hiddenSelectionContainer; this.reset(); if (b) for (var b = this.root, c, f = 0; f < a.length; ++f)c = a[f], c.endContainer.equals(b) && (c.endOffset = Math.min(c.endOffset, b.getChildCount())); if (a.length) if (this.isLocked) {
                            var g = CKEDITOR.document.getActive();
                            this.unlock(); this.selectRanges(a); this.lock(); g && !g.equals(this.root) && g.focus()
                        } else {
                            var e; a: { var h, l; if (1 == a.length && !(l = a[0]).collapsed && (e = l.getEnclosedNode()) && e.type == CKEDITOR.NODE_ELEMENT && (l = l.clone(), l.shrink(CKEDITOR.SHRINK_ELEMENT, !0), (h = l.getEnclosedNode()) && h.type == CKEDITOR.NODE_ELEMENT && (e = h), "false" == e.getAttribute("contenteditable"))) break a; e = void 0 } if (e) this.fake(e); else {
                                if (t) {
                                    l = CKEDITOR.dom.walker.whitespaces(!0); h = /\ufeff|\u00a0/; b = { table: 1, tbody: 1, tr: 1 }; 1 < a.length && (e = a[a.length -
                                        1], a[0].setEnd(e.endContainer, e.endOffset)); e = a[0]; a = e.collapsed; var n, q, p; if ((c = e.getEnclosedNode()) && c.type == CKEDITOR.NODE_ELEMENT && c.getName() in y && (!c.is("a") || !c.getText())) try { p = c.$.createControlRange(); p.addElement(c.$); p.select(); return } catch (u) { } if (e.startContainer.type == CKEDITOR.NODE_ELEMENT && e.startContainer.getName() in b || e.endContainer.type == CKEDITOR.NODE_ELEMENT && e.endContainer.getName() in b) e.shrink(CKEDITOR.NODE_ELEMENT, !0), a = e.collapsed; p = e.createBookmark(); b = p.startNode; a || (g = p.endNode);
                                    p = e.document.$.body.createTextRange(); p.moveToElementText(b.$); p.moveStart("character", 1); g ? (h = e.document.$.body.createTextRange(), h.moveToElementText(g.$), p.setEndPoint("EndToEnd", h), p.moveEnd("character", -1)) : (n = b.getNext(l), q = b.hasAscendant("pre"), n = !(n && n.getText && n.getText().match(h)) && (q || !b.hasPrevious() || b.getPrevious().is && b.getPrevious().is("br")), q = e.document.createElement("span"), q.setHtml("\x26#65279;"), q.insertBefore(b), n && e.document.createText("ï»¿").insertBefore(b)); e.setStartBefore(b);
                                    b.remove(); a ? (n ? (p.moveStart("character", -1), p.select(), e.document.$.selection.clear()) : p.select(), e.moveToPosition(q, CKEDITOR.POSITION_BEFORE_START), q.remove()) : (e.setEndBefore(g), g.remove(), p.select())
                                } else {
                                    g = this.getNative(); if (!g) return; this.removeAllRanges(); for (p = 0; p < a.length; p++) {
                                        if (p < a.length - 1 && (n = a[p], q = a[p + 1], h = n.clone(), h.setStart(n.endContainer, n.endOffset), h.setEnd(q.startContainer, q.startOffset), !h.collapsed && (h.shrink(CKEDITOR.NODE_ELEMENT, !0), e = h.getCommonAncestor(), h = h.getEnclosedNode(),
                                            e.isReadOnly() || h && h.isReadOnly()))) { q.setStart(n.startContainer, n.startOffset); a.splice(p--, 1); continue } e = a[p]; q = this.document.$.createRange(); e.collapsed && CKEDITOR.env.webkit && d(e) && (h = k(this.root), e.insertNode(h), (n = h.getNext()) && !h.getPrevious() && n.type == CKEDITOR.NODE_ELEMENT && "br" == n.getName() ? (m(this.root), e.moveToPosition(n, CKEDITOR.POSITION_BEFORE_START)) : e.moveToPosition(h, CKEDITOR.POSITION_AFTER_END)); q.setStart(e.startContainer.$, e.startOffset); try { q.setEnd(e.endContainer.$, e.endOffset) } catch (H) {
                                                if (0 <=
                                                    H.toString().indexOf("NS_ERROR_ILLEGAL_VALUE")) e.collapse(1), q.setEnd(e.endContainer.$, e.endOffset); else throw H;
                                            } g.addRange(q)
                                    }
                                } this.reset(); this.root.fire("selectionchange")
                            }
                        }
                    }, fake: function (a, b) {
                        var c = this.root.editor; void 0 === b && a.hasAttribute("aria-label") && (b = a.getAttribute("aria-label")); this.reset(); h(c, b); var d = this._.cache, f = new CKEDITOR.dom.range(this.root); f.setStartBefore(a); f.setEndAfter(a); d.ranges = new CKEDITOR.dom.rangeList(f); d.selectedElement = d.startElement = a; d.type = CKEDITOR.SELECTION_ELEMENT;
                        d.selectedText = d.nativeSel = null; this.isFake = 1; this.rev = p++; c._.fakeSelection = this; this.root.fire("selectionchange")
                    }, isHidden: function () { var a = this.getCommonAncestor(); a && a.type == CKEDITOR.NODE_TEXT && (a = a.getParent()); return !(!a || !a.data("cke-hidden-sel")) }, createBookmarks: function (a) { a = this.getRanges().createBookmarks(a); this.isFake && (a.isFake = 1); return a }, createBookmarks2: function (a) { a = this.getRanges().createBookmarks2(a); this.isFake && (a.isFake = 1); return a }, selectBookmarks: function (a) {
                        for (var b =
                            [], c, d = 0; d < a.length; d++) { var f = new CKEDITOR.dom.range(this.root); f.moveToBookmark(a[d]); b.push(f) } a.isFake && (c = b[0].getEnclosedNode(), c && c.type == CKEDITOR.NODE_ELEMENT || (CKEDITOR.warn("selection-not-fake"), a.isFake = 0)); a.isFake ? this.fake(c) : this.selectRanges(b); return this
                    }, getCommonAncestor: function () { var a = this.getRanges(); return a.length ? a[0].startContainer.getCommonAncestor(a[a.length - 1].endContainer) : null }, scrollIntoView: function () { this.type != CKEDITOR.SELECTION_NONE && this.getRanges()[0].scrollIntoView() },
                    removeAllRanges: function () { if (this.getType() != CKEDITOR.SELECTION_NONE) { var a = this.getNative(); try { a && a[t ? "empty" : "removeAllRanges"]() } catch (b) { } this.reset() } }
                }
        }(), "use strict", CKEDITOR.STYLE_BLOCK = 1, CKEDITOR.STYLE_INLINE = 2, CKEDITOR.STYLE_OBJECT = 3, function () {
            function a(a, b) { for (var c, d; (a = a.getParent()) && !a.equals(b);)if (a.getAttribute("data-nostyle")) c = a; else if (!d) { var f = a.getAttribute("contentEditable"); "false" == f ? c = a : "true" == f && (d = 1) } return c } function e(a, b, c, d) {
                return (a.getPosition(b) | d) == d &&
                    (!c.childRule || c.childRule(a))
            } function b(c) {
                var f = c.document; if (c.collapsed) f = y(this, f), c.insertNode(f), c.moveToPosition(f, CKEDITOR.POSITION_BEFORE_END); else {
                    var g = this.element, h = this._.definition, l, k = h.ignoreReadonly, m = k || h.includeReadonly; null == m && (m = c.root.getCustomData("cke_includeReadonly")); var n = CKEDITOR.dtd[g]; n || (l = !0, n = CKEDITOR.dtd.span); c.enlarge(CKEDITOR.ENLARGE_INLINE, 1); c.trim(); var p = c.createBookmark(), t = p.startNode, u = p.endNode, A = t, r; if (!k) {
                        var v = c.getCommonAncestor(), k = a(t, v), v = a(u,
                            v); k && (A = k.getNextSourceNode(!0)); v && (u = v)
                    } for (A.getPosition(u) == CKEDITOR.POSITION_FOLLOWING && (A = 0); A;) {
                        k = !1; if (A.equals(u)) A = null, k = !0; else {
                            var z = A.type == CKEDITOR.NODE_ELEMENT ? A.getName() : null, v = z && "false" == A.getAttribute("contentEditable"), w = z && A.getAttribute("data-nostyle"); if (z && A.data("cke-bookmark")) { A = A.getNextSourceNode(!0); continue } if (v && m && CKEDITOR.dtd.$block[z]) for (var C = A, x = d(C), B = void 0, D = x.length, ea = 0, C = D && new CKEDITOR.dom.range(C.getDocument()); ea < D; ++ea) {
                                var B = x[ea], ha = CKEDITOR.filter.instances[B.data("cke-filter")];
                                if (ha ? ha.check(this) : 1) C.selectNodeContents(B), b.call(this, C)
                            } x = z ? !n[z] || w ? 0 : v && !m ? 0 : e(A, u, h, L) : 1; if (x) if (B = A.getParent(), x = h, D = g, ea = l, !B || !(B.getDtd() || CKEDITOR.dtd.span)[D] && !ea || x.parentRule && !x.parentRule(B)) k = !0; else { if (r || z && CKEDITOR.dtd.$removeEmpty[z] && (A.getPosition(u) | L) != L || (r = c.clone(), r.setStartBefore(A)), z = A.type, z == CKEDITOR.NODE_TEXT || v || z == CKEDITOR.NODE_ELEMENT && !A.getChildCount()) { for (var z = A, E; (k = !z.getNext(I)) && (E = z.getParent(), n[E.getName()]) && e(E, t, h, N);)z = E; r.setEndAfter(z) } } else k =
                                !0; A = A.getNextSourceNode(w || v)
                        } if (k && r && !r.collapsed) {
                            for (var k = y(this, f), v = k.hasAttributes(), w = r.getCommonAncestor(), z = {}, x = {}, B = {}, D = {}, aa, fa, F; k && w;) { if (w.getName() == g) { for (aa in h.attributes) !D[aa] && (F = w.getAttribute(fa)) && (k.getAttribute(aa) == F ? x[aa] = 1 : D[aa] = 1); for (fa in h.styles) !B[fa] && (F = w.getStyle(fa)) && (k.getStyle(fa) == F ? z[fa] = 1 : B[fa] = 1) } w = w.getParent() } for (aa in x) k.removeAttribute(aa); for (fa in z) k.removeStyle(fa); v && !k.hasAttributes() && (k = null); k ? (r.extractContents().appendTo(k), r.insertNode(k),
                                q.call(this, k), k.mergeSiblings(), CKEDITOR.env.ie || k.$.normalize()) : (k = new CKEDITOR.dom.element("span"), r.extractContents().appendTo(k), r.insertNode(k), q.call(this, k), k.remove(!0)); r = null
                        }
                    } c.moveToBookmark(p); c.shrink(CKEDITOR.SHRINK_TEXT); c.shrink(CKEDITOR.NODE_ELEMENT, !0)
                }
            } function c(a) {
                function b() {
                    for (var a = new CKEDITOR.dom.elementPath(d.getParent()), c = new CKEDITOR.dom.elementPath(k.getParent()), f = null, g = null, e = 0; e < a.elements.length; e++) {
                        var h = a.elements[e]; if (h == a.block || h == a.blockLimit) break;
                        m.checkElementRemovable(h, !0) && (f = h)
                    } for (e = 0; e < c.elements.length; e++) { h = c.elements[e]; if (h == c.block || h == c.blockLimit) break; m.checkElementRemovable(h, !0) && (g = h) } g && k.breakParent(g); f && d.breakParent(f)
                } a.enlarge(CKEDITOR.ENLARGE_INLINE, 1); var c = a.createBookmark(), d = c.startNode; if (a.collapsed) {
                    for (var f = new CKEDITOR.dom.elementPath(d.getParent(), a.root), g, e = 0, h; e < f.elements.length && (h = f.elements[e]) && h != f.block && h != f.blockLimit; e++)if (this.checkElementRemovable(h)) {
                        var l; a.collapsed && (a.checkBoundaryOfElement(h,
                            CKEDITOR.END) || (l = a.checkBoundaryOfElement(h, CKEDITOR.START))) ? (g = h, g.match = l ? "start" : "end") : (h.mergeSiblings(), h.is(this.element) ? u.call(this, h) : t(h, r(this)[h.getName()]))
                    } if (g) { h = d; for (e = 0; ; e++) { l = f.elements[e]; if (l.equals(g)) break; else if (l.match) continue; else l = l.clone(); l.append(h); h = l } h["start" == g.match ? "insertBefore" : "insertAfter"](g) }
                } else {
                    var k = c.endNode, m = this; b(); for (f = d; !f.equals(k);)g = f.getNextSourceNode(), f.type == CKEDITOR.NODE_ELEMENT && this.checkElementRemovable(f) && (f.getName() == this.element ?
                        u.call(this, f) : t(f, r(this)[f.getName()]), g.type == CKEDITOR.NODE_ELEMENT && g.contains(d) && (b(), g = d.getNext())), f = g
                } a.moveToBookmark(c); a.shrink(CKEDITOR.NODE_ELEMENT, !0)
            } function d(a) { var b = []; a.forEach(function (a) { if ("true" == a.getAttribute("contenteditable")) return b.push(a), !1 }, CKEDITOR.NODE_ELEMENT, !0); return b } function k(a) { var b = a.getEnclosedNode() || a.getCommonAncestor(!1, !0); (a = (new CKEDITOR.dom.elementPath(b, a.root)).contains(this.element, 1)) && !a.isReadOnly() && A(a, this) } function m(a) {
                var b = a.getCommonAncestor(!0,
                    !0); if (a = (new CKEDITOR.dom.elementPath(b, a.root)).contains(this.element, 1)) { var b = this._.definition, c = b.attributes; if (c) for (var d in c) a.removeAttribute(d, c[d]); if (b.styles) for (var f in b.styles) b.styles.hasOwnProperty(f) && a.removeStyle(f) }
            } function f(a) {
                var b = a.createBookmark(!0), c = a.createIterator(); c.enforceRealBlocks = !0; this._.enterMode && (c.enlargeBr = this._.enterMode != CKEDITOR.ENTER_BR); for (var d, f = a.document, g; d = c.getNextParagraph();)!d.isReadOnly() && (c.activeFilter ? c.activeFilter.check(this) :
                    1) && (g = y(this, f, d), l(d, g)); a.moveToBookmark(b)
            } function h(a) { var b = a.createBookmark(1), c = a.createIterator(); c.enforceRealBlocks = !0; c.enlargeBr = this._.enterMode != CKEDITOR.ENTER_BR; for (var d, f; d = c.getNextParagraph();)this.checkElementRemovable(d) && (d.is("pre") ? ((f = this._.enterMode == CKEDITOR.ENTER_BR ? null : a.document.createElement(this._.enterMode == CKEDITOR.ENTER_P ? "p" : "div")) && d.copyAttributes(f), l(d, f)) : u.call(this, d)); a.moveToBookmark(b) } function l(a, b) {
                var c = !b; c && (b = a.getDocument().createElement("div"),
                    a.copyAttributes(b)); var d = b && b.is("pre"), f = a.is("pre"), e = !d && f; if (d && !f) { f = b; (e = a.getBogus()) && e.remove(); e = a.getHtml(); e = n(e, /(?:^[ \t\n\r]+)|(?:[ \t\n\r]+$)/g, ""); e = e.replace(/[ \t\r\n]*(<br[^>]*>)[ \t\r\n]*/gi, "$1"); e = e.replace(/([ \t\n\r]+|&nbsp;)/g, " "); e = e.replace(/<br\b[^>]*>/gi, "\n"); if (CKEDITOR.env.ie) { var h = a.getDocument().createElement("div"); h.append(f); f.$.outerHTML = "\x3cpre\x3e" + e + "\x3c/pre\x3e"; f.copyAttributes(h.getFirst()); f = h.getFirst().remove() } else f.setHtml(e); b = f } else e ? b = v(c ?
                        [a.getHtml()] : g(a), b) : a.moveChildren(b); b.replace(a); if (d) { var c = b, l; (l = c.getPrevious(G)) && l.type == CKEDITOR.NODE_ELEMENT && l.is("pre") && (d = n(l.getHtml(), /\n$/, "") + "\n\n" + n(c.getHtml(), /^\n/, ""), CKEDITOR.env.ie ? c.$.outerHTML = "\x3cpre\x3e" + d + "\x3c/pre\x3e" : c.setHtml(d), l.remove()) } else c && p(b)
            } function g(a) {
                var b = []; n(a.getOuterHtml(), /(\S\s*)\n(?:\s|(<span[^>]+data-cke-bookmark.*?\/span>))*\n(?!$)/gi, function (a, b, c) { return b + "\x3c/pre\x3e" + c + "\x3cpre\x3e" }).replace(/<pre\b.*?>([\s\S]*?)<\/pre>/gi, function (a,
                    c) { b.push(c) }); return b
            } function n(a, b, c) { var d = "", f = ""; a = a.replace(/(^<span[^>]+data-cke-bookmark.*?\/span>)|(<span[^>]+data-cke-bookmark.*?\/span>$)/gi, function (a, b, c) { b && (d = b); c && (f = c); return "" }); return d + a.replace(b, c) + f } function v(a, b) {
                var c; 1 < a.length && (c = new CKEDITOR.dom.documentFragment(b.getDocument())); for (var d = 0; d < a.length; d++) {
                    var f = a[d], f = f.replace(/(\r\n|\r)/g, "\n"), f = n(f, /^[ \t]*\n/, ""), f = n(f, /\n$/, ""), f = n(f, /^[ \t]+|[ \t]+$/g, function (a, b) {
                        return 1 == a.length ? "\x26nbsp;" : b ? " " + CKEDITOR.tools.repeat("\x26nbsp;",
                            a.length - 1) : CKEDITOR.tools.repeat("\x26nbsp;", a.length - 1) + " "
                    }), f = f.replace(/\n/g, "\x3cbr\x3e"), f = f.replace(/[ \t]{2,}/g, function (a) { return CKEDITOR.tools.repeat("\x26nbsp;", a.length - 1) + " " }); if (c) { var g = b.clone(); g.setHtml(f); c.append(g) } else b.setHtml(f)
                } return c || b
            } function u(a, b) {
                var c = this._.definition, d = c.attributes, c = c.styles, f = r(this)[a.getName()], g = CKEDITOR.tools.isEmpty(d) && CKEDITOR.tools.isEmpty(c), e; for (e in d) if ("class" != e && !this._.definition.fullMatch || a.getAttribute(e) == w(e, d[e])) b &&
                    "data-" == e.slice(0, 5) || (g = a.hasAttribute(e), a.removeAttribute(e)); for (var h in c) this._.definition.fullMatch && a.getStyle(h) != w(h, c[h], !0) || (g = g || !!a.getStyle(h), a.removeStyle(h)); t(a, f, B[a.getName()]); g && (this._.definition.alwaysRemoveElement ? p(a, 1) : !CKEDITOR.dtd.$block[a.getName()] || this._.enterMode == CKEDITOR.ENTER_BR && !a.hasAttributes() ? p(a) : a.renameNode(this._.enterMode == CKEDITOR.ENTER_P ? "p" : "div"))
            } function q(a) {
                for (var b = r(this), c = a.getElementsByTag(this.element), d, f = c.count(); 0 <= --f;)d = c.getItem(f),
                    d.isReadOnly() || u.call(this, d, !0); for (var g in b) if (g != this.element) for (c = a.getElementsByTag(g), f = c.count() - 1; 0 <= f; f--)d = c.getItem(f), d.isReadOnly() || t(d, b[g])
            } function t(a, b, c) { if (b = b && b.attributes) for (var d = 0; d < b.length; d++) { var f = b[d][0], g; if (g = a.getAttribute(f)) { var e = b[d][1]; (null === e || e.test && e.test(g) || "string" == typeof e && g == e) && a.removeAttribute(f) } } c || p(a) } function p(a, b) {
                if (!a.hasAttributes() || b) if (CKEDITOR.dtd.$block[a.getName()]) {
                    var c = a.getPrevious(G), d = a.getNext(G); !c || c.type != CKEDITOR.NODE_TEXT &&
                        c.isBlockBoundary({ br: 1 }) || a.append("br", 1); !d || d.type != CKEDITOR.NODE_TEXT && d.isBlockBoundary({ br: 1 }) || a.append("br"); a.remove(!0)
                } else c = a.getFirst(), d = a.getLast(), a.remove(!0), c && (c.type == CKEDITOR.NODE_ELEMENT && c.mergeSiblings(), d && !c.equals(d) && d.type == CKEDITOR.NODE_ELEMENT && d.mergeSiblings())
            } function y(a, b, c) {
                var d; d = a.element; "*" == d && (d = "span"); d = new CKEDITOR.dom.element(d, b); c && c.copyAttributes(d); d = A(d, a); b.getCustomData("doc_processing_style") && d.hasAttribute("id") ? d.removeAttribute("id") :
                    b.setCustomData("doc_processing_style", 1); return d
            } function A(a, b) { var c = b._.definition, d = c.attributes, c = CKEDITOR.style.getStyleText(c); if (d) for (var f in d) a.setAttribute(f, d[f]); c && a.setAttribute("style", c); return a } function z(a, b) { for (var c in a) a[c] = a[c].replace(E, function (a, c) { return b[c] }) } function r(a) {
                if (a._.overrides) return a._.overrides; var b = a._.overrides = {}, c = a._.definition.overrides; if (c) {
                    CKEDITOR.tools.isArray(c) || (c = [c]); for (var d = 0; d < c.length; d++) {
                        var f = c[d], g, e; "string" == typeof f ?
                            g = f.toLowerCase() : (g = f.element ? f.element.toLowerCase() : a.element, e = f.attributes); f = b[g] || (b[g] = {}); if (e) { var f = f.attributes = f.attributes || [], h; for (h in e) f.push([h.toLowerCase(), e[h]]) }
                    }
                } return b
            } function w(a, b, c) { var d = new CKEDITOR.dom.element("span"); d[c ? "setStyle" : "setAttribute"](a, b); return d[c ? "getStyle" : "getAttribute"](a) } function C(a, b) {
                function c(a, b) { return "font-family" == b.toLowerCase() ? a.replace(/["']/g, "") : a } "string" == typeof a && (a = CKEDITOR.tools.parseCssText(a)); "string" == typeof b && (b =
                    CKEDITOR.tools.parseCssText(b, !0)); for (var d in a) if (!(d in b) || c(b[d], d) != c(a[d], d) && "inherit" != a[d] && "inherit" != b[d]) return !1; return !0
            } function x(a, b, c) { var d = a.document, f = a.getRanges(); b = b ? this.removeFromRange : this.applyToRange; for (var g, e = f.createIterator(); g = e.getNextRange();)b.call(this, g, c); a.selectRanges(f); d.removeCustomData("doc_processing_style") } var B = {
                address: 1, div: 1, h1: 1, h2: 1, h3: 1, h4: 1, h5: 1, h6: 1, p: 1, pre: 1, section: 1, header: 1, footer: 1, nav: 1, article: 1, aside: 1, figure: 1, dialog: 1, hgroup: 1,
                time: 1, meter: 1, menu: 1, command: 1, keygen: 1, output: 1, progress: 1, details: 1, datagrid: 1, datalist: 1
            }, D = { a: 1, blockquote: 1, embed: 1, hr: 1, img: 1, li: 1, object: 1, ol: 1, table: 1, td: 1, tr: 1, th: 1, ul: 1, dl: 1, dt: 1, dd: 1, form: 1, audio: 1, video: 1 }, F = /\s*(?:;\s*|$)/, E = /#\((.+?)\)/g, I = CKEDITOR.dom.walker.bookmark(0, 1), G = CKEDITOR.dom.walker.whitespaces(1); CKEDITOR.style = function (a, b) {
                if ("string" == typeof a.type) return new CKEDITOR.style.customHandlers[a.type](a); var c = a.attributes; c && c.style && (a.styles = CKEDITOR.tools.extend({}, a.styles,
                    CKEDITOR.tools.parseCssText(c.style)), delete c.style); b && (a = CKEDITOR.tools.clone(a), z(a.attributes, b), z(a.styles, b)); c = this.element = a.element ? "string" == typeof a.element ? a.element.toLowerCase() : a.element : "*"; this.type = a.type || (B[c] ? CKEDITOR.STYLE_BLOCK : D[c] ? CKEDITOR.STYLE_OBJECT : CKEDITOR.STYLE_INLINE); "object" == typeof this.element && (this.type = CKEDITOR.STYLE_OBJECT); this._ = { definition: a }
            }; CKEDITOR.style.prototype = {
                apply: function (a) {
                    if (a instanceof CKEDITOR.dom.document) return x.call(this, a.getSelection());
                    if (this.checkApplicable(a.elementPath(), a)) { var b = this._.enterMode; b || (this._.enterMode = a.activeEnterMode); x.call(this, a.getSelection(), 0, a); this._.enterMode = b }
                }, remove: function (a) { if (a instanceof CKEDITOR.dom.document) return x.call(this, a.getSelection(), 1); if (this.checkApplicable(a.elementPath(), a)) { var b = this._.enterMode; b || (this._.enterMode = a.activeEnterMode); x.call(this, a.getSelection(), 1, a); this._.enterMode = b } }, applyToRange: function (a) {
                    this.applyToRange = this.type == CKEDITOR.STYLE_INLINE ? b : this.type ==
                        CKEDITOR.STYLE_BLOCK ? f : this.type == CKEDITOR.STYLE_OBJECT ? k : null; return this.applyToRange(a)
                }, removeFromRange: function (a) { this.removeFromRange = this.type == CKEDITOR.STYLE_INLINE ? c : this.type == CKEDITOR.STYLE_BLOCK ? h : this.type == CKEDITOR.STYLE_OBJECT ? m : null; return this.removeFromRange(a) }, applyToObject: function (a) { A(a, this) }, checkActive: function (a, b) {
                    switch (this.type) {
                        case CKEDITOR.STYLE_BLOCK: return this.checkElementRemovable(a.block || a.blockLimit, !0, b); case CKEDITOR.STYLE_OBJECT: case CKEDITOR.STYLE_INLINE: for (var c =
                            a.elements, d = 0, f; d < c.length; d++)if (f = c[d], this.type != CKEDITOR.STYLE_INLINE || f != a.block && f != a.blockLimit) { if (this.type == CKEDITOR.STYLE_OBJECT) { var g = f.getName(); if (!("string" == typeof this.element ? g == this.element : g in this.element)) continue } if (this.checkElementRemovable(f, !0, b)) return !0 }
                    }return !1
                }, checkApplicable: function (a, b, c) { b && b instanceof CKEDITOR.filter && (c = b); if (c && !c.check(this)) return !1; switch (this.type) { case CKEDITOR.STYLE_OBJECT: return !!a.contains(this.element); case CKEDITOR.STYLE_BLOCK: return !!a.blockLimit.getDtd()[this.element] }return !0 },
                checkElementMatch: function (a, b) {
                    var c = this._.definition; if (!a || !c.ignoreReadonly && a.isReadOnly()) return !1; var d = a.getName(); if ("string" == typeof this.element ? d == this.element : d in this.element) {
                        if (!b && !a.hasAttributes()) return !0; if (d = c._AC) c = d; else { var d = {}, f = 0, g = c.attributes; if (g) for (var e in g) f++, d[e] = g[e]; if (e = CKEDITOR.style.getStyleText(c)) d.style || f++, d.style = e; d._length = f; c = c._AC = d } if (c._length) {
                            for (var h in c) if ("_length" != h) if (d = a.getAttribute(h) || "", "style" == h ? C(c[h], d) : c[h] == d) { if (!b) return !0 } else if (b) return !1;
                            if (b) return !0
                        } else return !0
                    } return !1
                }, checkElementRemovable: function (a, b, c) { if (this.checkElementMatch(a, b, c)) return !0; if (b = r(this)[a.getName()]) { var d; if (!(b = b.attributes)) return !0; for (c = 0; c < b.length; c++)if (d = b[c][0], d = a.getAttribute(d)) { var f = b[c][1]; if (null === f) return !0; if ("string" == typeof f) { if (d == f) return !0 } else if (f.test(d)) return !0 } } return !1 }, buildPreview: function (a) {
                    var b = this._.definition, c = [], d = b.element; "bdo" == d && (d = "span"); var c = ["\x3c", d], f = b.attributes; if (f) for (var g in f) c.push(" ",
                        g, '\x3d"', f[g], '"'); (f = CKEDITOR.style.getStyleText(b)) && c.push(' style\x3d"', f, '"'); c.push("\x3e", a || b.name, "\x3c/", d, "\x3e"); return c.join("")
                }, getDefinition: function () { return this._.definition }
            }; CKEDITOR.style.getStyleText = function (a) { var b = a._ST; if (b) return b; var b = a.styles, c = a.attributes && a.attributes.style || "", d = ""; c.length && (c = c.replace(F, ";")); for (var f in b) { var g = b[f], e = (f + ":" + g).replace(F, ";"); "inherit" == g ? d += e : c += e } c.length && (c = CKEDITOR.tools.normalizeCssText(c, !0)); return a._ST = c + d }; CKEDITOR.style.customHandlers =
                {}; CKEDITOR.style.addCustomHandler = function (a) { var b = function (a) { this._ = { definition: a }; this.setup && this.setup(a) }; b.prototype = CKEDITOR.tools.extend(CKEDITOR.tools.prototypedCopy(CKEDITOR.style.prototype), { assignedTo: CKEDITOR.STYLE_OBJECT }, a, !0); return this.customHandlers[a.type] = b }; var L = CKEDITOR.POSITION_PRECEDING | CKEDITOR.POSITION_IDENTICAL | CKEDITOR.POSITION_IS_CONTAINED, N = CKEDITOR.POSITION_FOLLOWING | CKEDITOR.POSITION_IDENTICAL | CKEDITOR.POSITION_IS_CONTAINED
        }(), CKEDITOR.styleCommand = function (a,
            e) { this.requiredContent = this.allowedContent = this.style = a; CKEDITOR.tools.extend(this, e, !0) }, CKEDITOR.styleCommand.prototype.exec = function (a) { a.focus(); this.state == CKEDITOR.TRISTATE_OFF ? a.applyStyle(this.style) : this.state == CKEDITOR.TRISTATE_ON && a.removeStyle(this.style) }, CKEDITOR.stylesSet = new CKEDITOR.resourceManager("", "stylesSet"), CKEDITOR.addStylesSet = CKEDITOR.tools.bind(CKEDITOR.stylesSet.add, CKEDITOR.stylesSet), CKEDITOR.loadStylesSet = function (a, e, b) {
                CKEDITOR.stylesSet.addExternal(a, e, ""); CKEDITOR.stylesSet.load(a,
                    b)
            }, CKEDITOR.tools.extend(CKEDITOR.editor.prototype, {
                attachStyleStateChange: function (a, e) { var b = this._.styleStateChangeCallbacks; b || (b = this._.styleStateChangeCallbacks = [], this.on("selectionChange", function (a) { for (var d = 0; d < b.length; d++) { var e = b[d], m = e.style.checkActive(a.data.path, this) ? CKEDITOR.TRISTATE_ON : CKEDITOR.TRISTATE_OFF; e.fn.call(this, m) } })); b.push({ style: a, fn: e }) }, applyStyle: function (a) { a.apply(this) }, removeStyle: function (a) { a.remove(this) }, getStylesSet: function (a) {
                    if (this._.stylesDefinitions) a(this._.stylesDefinitions);
                    else { var e = this, b = e.config.stylesCombo_stylesSet || e.config.stylesSet; if (!1 === b) a(null); else if (b instanceof Array) e._.stylesDefinitions = b, a(b); else { b || (b = "default"); var b = b.split(":"), c = b[0]; CKEDITOR.stylesSet.addExternal(c, b[1] ? b.slice(1).join(":") : CKEDITOR.getUrl("styles.js"), ""); CKEDITOR.stylesSet.load(c, function (b) { e._.stylesDefinitions = b[c]; a(e._.stylesDefinitions) }) } }
                }
            }), CKEDITOR.dom.comment = function (a, e) {
                "string" == typeof a && (a = (e ? e.$ : document).createComment(a)); CKEDITOR.dom.domObject.call(this,
                    a)
            }, CKEDITOR.dom.comment.prototype = new CKEDITOR.dom.node, CKEDITOR.tools.extend(CKEDITOR.dom.comment.prototype, { type: CKEDITOR.NODE_COMMENT, getOuterHtml: function () { return "\x3c!--" + this.$.nodeValue + "--\x3e" } }), "use strict", function () {
                var a = {}, e = {}, b; for (b in CKEDITOR.dtd.$blockLimit) b in CKEDITOR.dtd.$list || (a[b] = 1); for (b in CKEDITOR.dtd.$block) b in CKEDITOR.dtd.$blockLimit || b in CKEDITOR.dtd.$empty || (e[b] = 1); CKEDITOR.dom.elementPath = function (b, d) {
                    var k = null, m = null, f = [], h = b, l; d = d || b.getDocument().getBody();
                    do if (h.type == CKEDITOR.NODE_ELEMENT) { f.push(h); if (!this.lastElement && (this.lastElement = h, h.is(CKEDITOR.dtd.$object) || "false" == h.getAttribute("contenteditable"))) continue; if (h.equals(d)) break; if (!m && (l = h.getName(), "true" == h.getAttribute("contenteditable") ? m = h : !k && e[l] && (k = h), a[l])) { if (l = !k && "div" == l) { a: { l = h.getChildren(); for (var g = 0, n = l.count(); g < n; g++) { var v = l.getItem(g); if (v.type == CKEDITOR.NODE_ELEMENT && CKEDITOR.dtd.$block[v.getName()]) { l = !0; break a } } l = !1 } l = !l } l ? k = h : m = h } } while (h = h.getParent()); m ||
                        (m = d); this.block = k; this.blockLimit = m; this.root = d; this.elements = f
                }
            }(), CKEDITOR.dom.elementPath.prototype = {
                compare: function (a) { var e = this.elements; a = a && a.elements; if (!a || e.length != a.length) return !1; for (var b = 0; b < e.length; b++)if (!e[b].equals(a[b])) return !1; return !0 }, contains: function (a, e, b) {
                    var c; "string" == typeof a && (c = function (b) { return b.getName() == a }); a instanceof CKEDITOR.dom.element ? c = function (b) { return b.equals(a) } : CKEDITOR.tools.isArray(a) ? c = function (b) { return -1 < CKEDITOR.tools.indexOf(a, b.getName()) } :
                        "function" == typeof a ? c = a : "object" == typeof a && (c = function (b) { return b.getName() in a }); var d = this.elements, k = d.length; e && k--; b && (d = Array.prototype.slice.call(d, 0), d.reverse()); for (e = 0; e < k; e++)if (c(d[e])) return d[e]; return null
                }, isContextFor: function (a) { var e; return a in CKEDITOR.dtd.$block ? (e = this.contains(CKEDITOR.dtd.$intermediate) || this.root.equals(this.block) && this.block || this.blockLimit, !!e.getDtd()[a]) : !0 }, direction: function () { return (this.block || this.blockLimit || this.root).getDirection(1) }
            }, CKEDITOR.dom.text =
        function (a, e) { "string" == typeof a && (a = (e ? e.$ : document).createTextNode(a)); this.$ = a }, CKEDITOR.dom.text.prototype = new CKEDITOR.dom.node, CKEDITOR.tools.extend(CKEDITOR.dom.text.prototype, {
            type: CKEDITOR.NODE_TEXT, getLength: function () { return this.$.nodeValue.length }, getText: function () { return this.$.nodeValue }, setText: function (a) { this.$.nodeValue = a }, split: function (a) {
                var e = this.$.parentNode, b = e.childNodes.length, c = this.getLength(), d = this.getDocument(), k = new CKEDITOR.dom.text(this.$.splitText(a), d); e.childNodes.length ==
                    b && (a >= c ? (k = d.createText(""), k.insertAfter(this)) : (a = d.createText(""), a.insertAfter(k), a.remove())); return k
            }, substring: function (a, e) { return "number" != typeof e ? this.$.nodeValue.substr(a) : this.$.nodeValue.substring(a, e) }
        }), function () {
            function a(a, c, d) {
                var e = a.serializable, m = c[d ? "endContainer" : "startContainer"], f = d ? "endOffset" : "startOffset", h = e ? c.document.getById(a.startNode) : a.startNode; a = e ? c.document.getById(a.endNode) : a.endNode; m.equals(h.getPrevious()) ? (c.startOffset = c.startOffset - m.getLength() -
                    a.getPrevious().getLength(), m = a.getNext()) : m.equals(a.getPrevious()) && (c.startOffset -= m.getLength(), m = a.getNext()); m.equals(h.getParent()) && c[f]++; m.equals(a.getParent()) && c[f]++; c[d ? "endContainer" : "startContainer"] = m; return c
            } CKEDITOR.dom.rangeList = function (a) { if (a instanceof CKEDITOR.dom.rangeList) return a; a ? a instanceof CKEDITOR.dom.range && (a = [a]) : a = []; return CKEDITOR.tools.extend(a, e) }; var e = {
                createIterator: function () {
                    var a = this, c = CKEDITOR.dom.walker.bookmark(), d = [], e; return {
                        getNextRange: function (m) {
                            e =
                            void 0 === e ? 0 : e + 1; var f = a[e]; if (f && 1 < a.length) { if (!e) for (var h = a.length - 1; 0 <= h; h--)d.unshift(a[h].createBookmark(!0)); if (m) for (var l = 0; a[e + l + 1];) { var g = f.document; m = 0; h = g.getById(d[l].endNode); for (g = g.getById(d[l + 1].startNode); ;) { h = h.getNextSourceNode(!1); if (g.equals(h)) m = 1; else if (c(h) || h.type == CKEDITOR.NODE_ELEMENT && h.isBlockBoundary()) continue; break } if (!m) break; l++ } for (f.moveToBookmark(d.shift()); l--;)h = a[++e], h.moveToBookmark(d.shift()), f.setEnd(h.endContainer, h.endOffset) } return f
                        }
                    }
                }, createBookmarks: function (b) {
                    for (var c =
                        [], d, e = 0; e < this.length; e++) { c.push(d = this[e].createBookmark(b, !0)); for (var m = e + 1; m < this.length; m++)this[m] = a(d, this[m]), this[m] = a(d, this[m], !0) } return c
                }, createBookmarks2: function (a) { for (var c = [], d = 0; d < this.length; d++)c.push(this[d].createBookmark2(a)); return c }, moveToBookmarks: function (a) { for (var c = 0; c < this.length; c++)this[c].moveToBookmark(a[c]) }
            }
        }(), function () {
            function a() { return CKEDITOR.getUrl(CKEDITOR.skinName.split(",")[1] || "skins/" + CKEDITOR.skinName.split(",")[0] + "/") } function e(b) {
                var c =
                    CKEDITOR.skin["ua_" + b], d = CKEDITOR.env; if (c) for (var c = c.split(",").sort(function (a, b) { return a > b ? -1 : 1 }), f = 0, e; f < c.length; f++)if (e = c[f], d.ie && (e.replace(/^ie/, "") == d.version || d.quirks && "iequirks" == e) && (e = "ie"), d[e]) { b += "_" + c[f]; break } return CKEDITOR.getUrl(a() + b + ".css")
            } function b(a, b) { k[a] || (CKEDITOR.document.appendStyleSheet(e(a)), k[a] = 1); b && b() } function c(a) { var b = a.getById(m); b || (b = a.getHead().append("style"), b.setAttribute("id", m), b.setAttribute("type", "text/css")); return b } function d(a, b, c) {
                var d,
                f, e; if (CKEDITOR.env.webkit) for (b = b.split("}").slice(0, -1), f = 0; f < b.length; f++)b[f] = b[f].split("{"); for (var h = 0; h < a.length; h++)if (CKEDITOR.env.webkit) for (f = 0; f < b.length; f++) { e = b[f][1]; for (d = 0; d < c.length; d++)e = e.replace(c[d][0], c[d][1]); a[h].$.sheet.addRule(b[f][0], e) } else { e = b; for (d = 0; d < c.length; d++)e = e.replace(c[d][0], c[d][1]); CKEDITOR.env.ie && 11 > CKEDITOR.env.version ? a[h].$.styleSheet.cssText += e : a[h].$.innerHTML += e }
            } var k = {}; CKEDITOR.skin = {
                path: a, loadPart: function (c, d) {
                    CKEDITOR.skin.name != CKEDITOR.skinName.split(",")[0] ?
                    CKEDITOR.scriptLoader.load(CKEDITOR.getUrl(a() + "skin.js"), function () { b(c, d) }) : b(c, d)
                }, getPath: function (a) { return CKEDITOR.getUrl(e(a)) }, icons: {}, addIcon: function (a, b, c, d) { a = a.toLowerCase(); this.icons[a] || (this.icons[a] = { path: b, offset: c || 0, bgsize: d || "16px" }) }, getIconStyle: function (a, b, c, d, f) {
                    var e; a && (a = a.toLowerCase(), b && (e = this.icons[a + "-rtl"]), e || (e = this.icons[a])); a = c || e && e.path || ""; d = d || e && e.offset; f = f || e && e.bgsize || "16px"; a && (a = a.replace(/'/g, "\\'")); return a && "background-image:url('" + CKEDITOR.getUrl(a) +
                        "');background-position:0 " + d + "px;background-size:" + f + ";"
                }
            }; CKEDITOR.tools.extend(CKEDITOR.editor.prototype, { getUiColor: function () { return this.uiColor }, setUiColor: function (a) { var b = c(CKEDITOR.document); return (this.setUiColor = function (a) { this.uiColor = a; var c = CKEDITOR.skin.chameleon, e = "", l = ""; "function" == typeof c && (e = c(this, "editor"), l = c(this, "panel")); a = [[h, a]]; d([b], e, a); d(f, l, a) }).call(this, a) } }); var m = "cke_ui_color", f = [], h = /\$color/g; CKEDITOR.on("instanceLoaded", function (a) {
                if (!CKEDITOR.env.ie ||
                    !CKEDITOR.env.quirks) { var b = a.editor; a = function (a) { a = (a.data[0] || a.data).element.getElementsByTag("iframe").getItem(0).getFrameDocument(); if (!a.getById("cke_ui_color")) { a = c(a); f.push(a); var e = b.getUiColor(); e && d([a], CKEDITOR.skin.chameleon(b, "panel"), [[h, e]]) } }; b.on("panelShow", a); b.on("menuShow", a); b.config.uiColor && b.setUiColor(b.config.uiColor) }
            })
        }(), function () {
            if (CKEDITOR.env.webkit) CKEDITOR.env.hc = !1; else {
                var a = CKEDITOR.dom.element.createFromHtml('\x3cdiv style\x3d"width:0;height:0;position:absolute;left:-10000px;border:1px solid;border-color:red blue"\x3e\x3c/div\x3e',
                    CKEDITOR.document); a.appendTo(CKEDITOR.document.getHead()); try { var e = a.getComputedStyle("border-top-color"), b = a.getComputedStyle("border-right-color"); CKEDITOR.env.hc = !(!e || e != b) } catch (c) { CKEDITOR.env.hc = !1 } a.remove()
            } CKEDITOR.env.hc && (CKEDITOR.env.cssClass += " cke_hc"); CKEDITOR.document.appendStyleText(".cke{visibility:hidden;}"); CKEDITOR.status = "loaded"; CKEDITOR.fireOnce("loaded"); if (a = CKEDITOR._.pending) for (delete CKEDITOR._.pending, e = 0; e < a.length; e++)CKEDITOR.editor.prototype.constructor.apply(a[e][0],
                a[e][1]), CKEDITOR.add(a[e][0])
        }(), CKEDITOR.skin.name = "moono", CKEDITOR.skin.ua_editor = "ie,iequirks,ie7,ie8,gecko", CKEDITOR.skin.ua_dialog = "ie,iequirks,ie7,ie8", CKEDITOR.skin.chameleon = function () {
            var a = function () { return function (a, b) { for (var e = a.match(/[^#]./g), m = 0; 3 > m; m++) { var f = m, h; h = parseInt(e[m], 16); h = ("0" + (0 > b ? 0 | h * (1 + b) : 0 | h + (255 - h) * b).toString(16)).slice(-2); e[f] = h } return "#" + e.join("") } }(), e = function () {
                var a = new CKEDITOR.template("background:#{to};background-image:linear-gradient(to bottom,{from},{to});filter:progid:DXImageTransform.Microsoft.gradient(gradientType\x3d0,startColorstr\x3d'{from}',endColorstr\x3d'{to}');");
                return function (b, e) { return a.output({ from: b, to: e }) }
            }(), b = {
                editor: new CKEDITOR.template("{id}.cke_chrome [border-color:{defaultBorder};] {id} .cke_top [ {defaultGradient}border-bottom-color:{defaultBorder};] {id} .cke_bottom [{defaultGradient}border-top-color:{defaultBorder};] {id} .cke_resizer [border-right-color:{ckeResizer}] {id} .cke_dialog_title [{defaultGradient}border-bottom-color:{defaultBorder};] {id} .cke_dialog_footer [{defaultGradient}outline-color:{defaultBorder};border-top-color:{defaultBorder};] {id} .cke_dialog_tab [{lightGradient}border-color:{defaultBorder};] {id} .cke_dialog_tab:hover [{mediumGradient}] {id} .cke_dialog_contents [border-top-color:{defaultBorder};] {id} .cke_dialog_tab_selected, {id} .cke_dialog_tab_selected:hover [background:{dialogTabSelected};border-bottom-color:{dialogTabSelectedBorder};] {id} .cke_dialog_body [background:{dialogBody};border-color:{defaultBorder};] {id} .cke_toolgroup [{lightGradient}border-color:{defaultBorder};] {id} a.cke_button_off:hover, {id} a.cke_button_off:focus, {id} a.cke_button_off:active [{mediumGradient}] {id} .cke_button_on [{ckeButtonOn}] {id} .cke_toolbar_separator [background-color: {ckeToolbarSeparator};] {id} .cke_combo_button [border-color:{defaultBorder};{lightGradient}] {id} a.cke_combo_button:hover, {id} a.cke_combo_button:focus, {id} .cke_combo_on a.cke_combo_button [border-color:{defaultBorder};{mediumGradient}] {id} .cke_path_item [color:{elementsPathColor};] {id} a.cke_path_item:hover, {id} a.cke_path_item:focus, {id} a.cke_path_item:active [background-color:{elementsPathBg};] {id}.cke_panel [border-color:{defaultBorder};] "),
                panel: new CKEDITOR.template(".cke_panel_grouptitle [{lightGradient}border-color:{defaultBorder};] .cke_menubutton_icon [background-color:{menubuttonIcon};] .cke_menubutton:hover .cke_menubutton_icon, .cke_menubutton:focus .cke_menubutton_icon, .cke_menubutton:active .cke_menubutton_icon [background-color:{menubuttonIconHover};] .cke_menuseparator [background-color:{menubuttonIcon};] a:hover.cke_colorbox, a:focus.cke_colorbox, a:active.cke_colorbox [border-color:{defaultBorder};] a:hover.cke_colorauto, a:hover.cke_colormore, a:focus.cke_colorauto, a:focus.cke_colormore, a:active.cke_colorauto, a:active.cke_colormore [background-color:{ckeColorauto};border-color:{defaultBorder};] ")
            };
            return function (c, d) {
                var k = c.uiColor, k = { id: "." + c.id, defaultBorder: a(k, -.1), defaultGradient: e(a(k, .9), k), lightGradient: e(a(k, 1), a(k, .7)), mediumGradient: e(a(k, .8), a(k, .5)), ckeButtonOn: e(a(k, .6), a(k, .7)), ckeResizer: a(k, -.4), ckeToolbarSeparator: a(k, .5), ckeColorauto: a(k, .8), dialogBody: a(k, .7), dialogTabSelected: e("#FFFFFF", "#FFFFFF"), dialogTabSelectedBorder: "#FFF", elementsPathColor: a(k, -.6), elementsPathBg: k, menubuttonIcon: a(k, .5), menubuttonIconHover: a(k, .3) }; return b[d].output(k).replace(/\[/g, "{").replace(/\]/g,
                    "}")
            }
        }(), CKEDITOR.plugins.add("dialogui", {
            onLoad: function () {
                var a = function (a) { this._ || (this._ = {}); this._["default"] = this._.initValue = a["default"] || ""; this._.required = a.required || !1; for (var b = [this._], c = 1; c < arguments.length; c++)b.push(arguments[c]); b.push(!0); CKEDITOR.tools.extend.apply(CKEDITOR.tools, b); return this._ }, e = { build: function (a, b, c) { return new CKEDITOR.ui.dialog.textInput(a, b, c) } }, b = { build: function (a, b, c) { return new CKEDITOR.ui.dialog[b.type](a, b, c) } }, c = {
                    isChanged: function () {
                        return this.getValue() !=
                            this.getInitValue()
                    }, reset: function (a) { this.setValue(this.getInitValue(), a) }, setInitValue: function () { this._.initValue = this.getValue() }, resetInitValue: function () { this._.initValue = this._["default"] }, getInitValue: function () { return this._.initValue }
                }, d = CKEDITOR.tools.extend({}, CKEDITOR.ui.dialog.uiElement.prototype.eventProcessors, {
                    onChange: function (a, b) {
                        this._.domOnChangeRegistered || (a.on("load", function () {
                            this.getInputElement().on("change", function () { a.parts.dialog.isVisible() && this.fire("change", { value: this.getValue() }) },
                                this)
                        }, this), this._.domOnChangeRegistered = !0); this.on("change", b)
                    }
                }, !0), k = /^on([A-Z]\w+)/, m = function (a) { for (var b in a) (k.test(b) || "title" == b || "type" == b) && delete a[b]; return a }, f = function (a) { a = a.data.getKeystroke(); a == CKEDITOR.SHIFT + CKEDITOR.ALT + 36 ? this.setDirectionMarker("ltr") : a == CKEDITOR.SHIFT + CKEDITOR.ALT + 35 && this.setDirectionMarker("rtl") }; CKEDITOR.tools.extend(CKEDITOR.ui.dialog, {
                    labeledElement: function (b, c, d, f) {
                        if (!(4 > arguments.length)) {
                            var e = a.call(this, c); e.labelId = CKEDITOR.tools.getNextId() +
                                "_label"; this._.children = []; var k = { role: c.role || "presentation" }; c.includeLabel && (k["aria-labelledby"] = e.labelId); CKEDITOR.ui.dialog.uiElement.call(this, b, c, d, "div", null, k, function () {
                                    var a = [], d = c.required ? " cke_required" : ""; "horizontal" != c.labelLayout ? a.push('\x3clabel class\x3d"cke_dialog_ui_labeled_label' + d + '" ', ' id\x3d"' + e.labelId + '"', e.inputId ? ' for\x3d"' + e.inputId + '"' : "", (c.labelStyle ? ' style\x3d"' + c.labelStyle + '"' : "") + "\x3e", c.label, "\x3c/label\x3e", '\x3cdiv class\x3d"cke_dialog_ui_labeled_content"',
                                        c.controlStyle ? ' style\x3d"' + c.controlStyle + '"' : "", ' role\x3d"presentation"\x3e', f.call(this, b, c), "\x3c/div\x3e") : (d = {
                                            type: "hbox", widths: c.widths, padding: 0, children: [{ type: "html", html: '\x3clabel class\x3d"cke_dialog_ui_labeled_label' + d + '" id\x3d"' + e.labelId + '" for\x3d"' + e.inputId + '"' + (c.labelStyle ? ' style\x3d"' + c.labelStyle + '"' : "") + "\x3e" + CKEDITOR.tools.htmlEncode(c.label) + "\x3c/label\x3e" }, {
                                                type: "html", html: '\x3cspan class\x3d"cke_dialog_ui_labeled_content"' + (c.controlStyle ? ' style\x3d"' + c.controlStyle +
                                                    '"' : "") + "\x3e" + f.call(this, b, c) + "\x3c/span\x3e"
                                            }]
                                        }, CKEDITOR.dialog._.uiElementBuilders.hbox.build(b, d, a)); return a.join("")
                                })
                        }
                    }, textInput: function (b, c, d) {
                        if (!(3 > arguments.length)) {
                            a.call(this, c); var e = this._.inputId = CKEDITOR.tools.getNextId() + "_textInput", k = { "class": "cke_dialog_ui_input_" + c.type, id: e, type: c.type }; c.validate && (this.validate = c.validate); c.maxLength && (k.maxlength = c.maxLength); c.size && (k.size = c.size); c.inputStyle && (k.style = c.inputStyle); var m = this, q = !1; b.on("load", function () {
                                m.getInputElement().on("keydown",
                                    function (a) { 13 == a.data.getKeystroke() && (q = !0) }); m.getInputElement().on("keyup", function (a) { 13 == a.data.getKeystroke() && q && (b.getButton("ok") && setTimeout(function () { b.getButton("ok").click() }, 0), q = !1); m.bidi && f.call(m, a) }, null, null, 1E3)
                            }); CKEDITOR.ui.dialog.labeledElement.call(this, b, c, d, function () {
                                var a = ['\x3cdiv class\x3d"cke_dialog_ui_input_', c.type, '" role\x3d"presentation"']; c.width && a.push('style\x3d"width:' + c.width + '" '); a.push("\x3e\x3cinput "); k["aria-labelledby"] = this._.labelId; this._.required &&
                                    (k["aria-required"] = this._.required); for (var b in k) a.push(b + '\x3d"' + k[b] + '" '); a.push(" /\x3e\x3c/div\x3e"); return a.join("")
                            })
                        }
                    }, textarea: function (b, c, d) {
                        if (!(3 > arguments.length)) {
                            a.call(this, c); var e = this, k = this._.inputId = CKEDITOR.tools.getNextId() + "_textarea", m = {}; c.validate && (this.validate = c.validate); m.rows = c.rows || 5; m.cols = c.cols || 20; m["class"] = "cke_dialog_ui_input_textarea " + (c["class"] || ""); "undefined" != typeof c.inputStyle && (m.style = c.inputStyle); c.dir && (m.dir = c.dir); if (e.bidi) b.on("load",
                                function () { e.getInputElement().on("keyup", f) }, e); CKEDITOR.ui.dialog.labeledElement.call(this, b, c, d, function () { m["aria-labelledby"] = this._.labelId; this._.required && (m["aria-required"] = this._.required); var a = ['\x3cdiv class\x3d"cke_dialog_ui_input_textarea" role\x3d"presentation"\x3e\x3ctextarea id\x3d"', k, '" '], b; for (b in m) a.push(b + '\x3d"' + CKEDITOR.tools.htmlEncode(m[b]) + '" '); a.push("\x3e", CKEDITOR.tools.htmlEncode(e._["default"]), "\x3c/textarea\x3e\x3c/div\x3e"); return a.join("") })
                        }
                    }, checkbox: function (b,
                        c, d) {
                            if (!(3 > arguments.length)) {
                                var f = a.call(this, c, { "default": !!c["default"] }); c.validate && (this.validate = c.validate); CKEDITOR.ui.dialog.uiElement.call(this, b, c, d, "span", null, null, function () {
                                    var a = CKEDITOR.tools.extend({}, c, { id: c.id ? c.id + "_checkbox" : CKEDITOR.tools.getNextId() + "_checkbox" }, !0), d = [], e = CKEDITOR.tools.getNextId() + "_label", g = { "class": "cke_dialog_ui_checkbox_input", type: "checkbox", "aria-labelledby": e }; m(a); c["default"] && (g.checked = "checked"); "undefined" != typeof a.inputStyle && (a.style = a.inputStyle);
                                    f.checkbox = new CKEDITOR.ui.dialog.uiElement(b, a, d, "input", null, g); d.push(' \x3clabel id\x3d"', e, '" for\x3d"', g.id, '"' + (c.labelStyle ? ' style\x3d"' + c.labelStyle + '"' : "") + "\x3e", CKEDITOR.tools.htmlEncode(c.label), "\x3c/label\x3e"); return d.join("")
                                })
                            }
                    }, radio: function (b, c, d) {
                        if (!(3 > arguments.length)) {
                            a.call(this, c); this._["default"] || (this._["default"] = this._.initValue = c.items[0][1]); c.validate && (this.validate = c.validate); var f = [], e = this; c.role = "radiogroup"; c.includeLabel = !0; CKEDITOR.ui.dialog.labeledElement.call(this,
                                b, c, d, function () {
                                    for (var a = [], d = [], g = (c.id ? c.id : CKEDITOR.tools.getNextId()) + "_radio", k = 0; k < c.items.length; k++) {
                                        var y = c.items[k], A = void 0 !== y[2] ? y[2] : y[0], z = void 0 !== y[1] ? y[1] : y[0], r = CKEDITOR.tools.getNextId() + "_radio_input", w = r + "_label", r = CKEDITOR.tools.extend({}, c, { id: r, title: null, type: null }, !0), A = CKEDITOR.tools.extend({}, r, { title: A }, !0), C = { type: "radio", "class": "cke_dialog_ui_radio_input", name: g, value: z, "aria-labelledby": w }, x = []; e._["default"] == z && (C.checked = "checked"); m(r); m(A); "undefined" != typeof r.inputStyle &&
                                            (r.style = r.inputStyle); r.keyboardFocusable = !0; f.push(new CKEDITOR.ui.dialog.uiElement(b, r, x, "input", null, C)); x.push(" "); new CKEDITOR.ui.dialog.uiElement(b, A, x, "label", null, { id: w, "for": C.id }, y[0]); a.push(x.join(""))
                                    } new CKEDITOR.ui.dialog.hbox(b, f, a, d); return d.join("")
                                }); this._.children = f
                        }
                    }, button: function (b, c, d) {
                        if (arguments.length) {
                            "function" == typeof c && (c = c(b.getParentEditor())); a.call(this, c, { disabled: c.disabled || !1 }); CKEDITOR.event.implementOn(this); var f = this; b.on("load", function () {
                                var a = this.getElement();
                                (function () { a.on("click", function (a) { f.click(); a.data.preventDefault() }); a.on("keydown", function (a) { a.data.getKeystroke() in { 32: 1 } && (f.click(), a.data.preventDefault()) }) })(); a.unselectable()
                            }, this); var e = CKEDITOR.tools.extend({}, c); delete e.style; var k = CKEDITOR.tools.getNextId() + "_label"; CKEDITOR.ui.dialog.uiElement.call(this, b, e, d, "a", null, { style: c.style, href: "javascript:void(0)", title: c.label, hidefocus: "true", "class": c["class"], role: "button", "aria-labelledby": k }, '\x3cspan id\x3d"' + k + '" class\x3d"cke_dialog_ui_button"\x3e' +
                                CKEDITOR.tools.htmlEncode(c.label) + "\x3c/span\x3e")
                        }
                    }, select: function (b, c, d) {
                        if (!(3 > arguments.length)) {
                            var f = a.call(this, c); c.validate && (this.validate = c.validate); f.inputId = CKEDITOR.tools.getNextId() + "_select"; CKEDITOR.ui.dialog.labeledElement.call(this, b, c, d, function () {
                                var a = CKEDITOR.tools.extend({}, c, { id: c.id ? c.id + "_select" : CKEDITOR.tools.getNextId() + "_select" }, !0), d = [], e = [], g = { id: f.inputId, "class": "cke_dialog_ui_input_select", "aria-labelledby": this._.labelId }; d.push('\x3cdiv class\x3d"cke_dialog_ui_input_',
                                    c.type, '" role\x3d"presentation"'); c.width && d.push('style\x3d"width:' + c.width + '" '); d.push("\x3e"); void 0 !== c.size && (g.size = c.size); void 0 !== c.multiple && (g.multiple = c.multiple); m(a); for (var k = 0, y; k < c.items.length && (y = c.items[k]); k++)e.push('\x3coption value\x3d"', CKEDITOR.tools.htmlEncode(void 0 !== y[1] ? y[1] : y[0]).replace(/"/g, "\x26quot;"), '" /\x3e ', CKEDITOR.tools.htmlEncode(y[0])); "undefined" != typeof a.inputStyle && (a.style = a.inputStyle); f.select = new CKEDITOR.ui.dialog.uiElement(b, a, d, "select", null,
                                        g, e.join("")); d.push("\x3c/div\x3e"); return d.join("")
                            })
                        }
                    }, file: function (b, c, d) {
                        if (!(3 > arguments.length)) {
                            void 0 === c["default"] && (c["default"] = ""); var f = CKEDITOR.tools.extend(a.call(this, c), { definition: c, buttons: [] }); c.validate && (this.validate = c.validate); b.on("load", function () { CKEDITOR.document.getById(f.frameId).getParent().addClass("cke_dialog_ui_input_file") }); CKEDITOR.ui.dialog.labeledElement.call(this, b, c, d, function () {
                                f.frameId = CKEDITOR.tools.getNextId() + "_fileInput"; var a = ['\x3ciframe frameborder\x3d"0" allowtransparency\x3d"0" class\x3d"cke_dialog_ui_input_file" role\x3d"presentation" id\x3d"',
                                    f.frameId, '" title\x3d"', c.label, '" src\x3d"javascript:void(']; a.push(CKEDITOR.env.ie ? "(function(){" + encodeURIComponent("document.open();(" + CKEDITOR.tools.fixDomain + ")();document.close();") + "})()" : "0"); a.push(')"\x3e\x3c/iframe\x3e'); return a.join("")
                            })
                        }
                    }, fileButton: function (b, c, d) {
                        var f = this; if (!(3 > arguments.length)) {
                            a.call(this, c); c.validate && (this.validate = c.validate); var e = CKEDITOR.tools.extend({}, c), k = e.onClick; e.className = (e.className ? e.className + " " : "") + "cke_dialog_ui_button"; e.onClick = function (a) {
                                var d =
                                    c["for"]; k && !1 === k.call(this, a) || (b.getContentElement(d[0], d[1]).submit(), this.disable())
                            }; b.on("load", function () { b.getContentElement(c["for"][0], c["for"][1])._.buttons.push(f) }); CKEDITOR.ui.dialog.button.call(this, b, e, d)
                        }
                    }, html: function () {
                        var a = /^\s*<[\w:]+\s+([^>]*)?>/, b = /^(\s*<[\w:]+(?:\s+[^>]*)?)((?:.|\r|\n)+)$/, c = /\/$/; return function (d, f, e) {
                            if (!(3 > arguments.length)) {
                                var k = [], m = f.html; "\x3c" != m.charAt(0) && (m = "\x3cspan\x3e" + m + "\x3c/span\x3e"); var p = f.focus; if (p) {
                                    var y = this.focus; this.focus = function () {
                                        ("function" ==
                                            typeof p ? p : y).call(this); this.fire("focus")
                                    }; f.isFocusable && (this.isFocusable = this.isFocusable); this.keyboardFocusable = !0
                                } CKEDITOR.ui.dialog.uiElement.call(this, d, f, k, "span", null, null, ""); k = k.join("").match(a); m = m.match(b) || ["", "", ""]; c.test(m[1]) && (m[1] = m[1].slice(0, -1), m[2] = "/" + m[2]); e.push([m[1], " ", k[1] || "", m[2]].join(""))
                            }
                        }
                    }(), fieldset: function (a, b, c, d, f) {
                        var e = f.label; this._ = { children: b }; CKEDITOR.ui.dialog.uiElement.call(this, a, f, d, "fieldset", null, null, function () {
                            var a = []; e && a.push("\x3clegend" +
                                (f.labelStyle ? ' style\x3d"' + f.labelStyle + '"' : "") + "\x3e" + e + "\x3c/legend\x3e"); for (var b = 0; b < c.length; b++)a.push(c[b]); return a.join("")
                        })
                    }
                }, !0); CKEDITOR.ui.dialog.html.prototype = new CKEDITOR.ui.dialog.uiElement; CKEDITOR.ui.dialog.labeledElement.prototype = CKEDITOR.tools.extend(new CKEDITOR.ui.dialog.uiElement, {
                    setLabel: function (a) { var b = CKEDITOR.document.getById(this._.labelId); 1 > b.getChildCount() ? (new CKEDITOR.dom.text(a, CKEDITOR.document)).appendTo(b) : b.getChild(0).$.nodeValue = a; return this }, getLabel: function () {
                        var a =
                            CKEDITOR.document.getById(this._.labelId); return !a || 1 > a.getChildCount() ? "" : a.getChild(0).getText()
                    }, eventProcessors: d
                }, !0); CKEDITOR.ui.dialog.button.prototype = CKEDITOR.tools.extend(new CKEDITOR.ui.dialog.uiElement, {
                    click: function () { return this._.disabled ? !1 : this.fire("click", { dialog: this._.dialog }) }, enable: function () { this._.disabled = !1; var a = this.getElement(); a && a.removeClass("cke_disabled") }, disable: function () { this._.disabled = !0; this.getElement().addClass("cke_disabled") }, isVisible: function () { return this.getElement().getFirst().isVisible() },
                    isEnabled: function () { return !this._.disabled }, eventProcessors: CKEDITOR.tools.extend({}, CKEDITOR.ui.dialog.uiElement.prototype.eventProcessors, { onClick: function (a, b) { this.on("click", function () { b.apply(this, arguments) }) } }, !0), accessKeyUp: function () { this.click() }, accessKeyDown: function () { this.focus() }, keyboardFocusable: !0
                }, !0); CKEDITOR.ui.dialog.textInput.prototype = CKEDITOR.tools.extend(new CKEDITOR.ui.dialog.labeledElement, {
                    getInputElement: function () { return CKEDITOR.document.getById(this._.inputId) },
                    focus: function () { var a = this.selectParentTab(); setTimeout(function () { var b = a.getInputElement(); b && b.$.focus() }, 0) }, select: function () { var a = this.selectParentTab(); setTimeout(function () { var b = a.getInputElement(); b && (b.$.focus(), b.$.select()) }, 0) }, accessKeyUp: function () { this.select() }, setValue: function (a) { if (this.bidi) { var b = a && a.charAt(0); (b = "â€ª" == b ? "ltr" : "â€«" == b ? "rtl" : null) && (a = a.slice(1)); this.setDirectionMarker(b) } a || (a = ""); return CKEDITOR.ui.dialog.uiElement.prototype.setValue.apply(this, arguments) },
                    getValue: function () { var a = CKEDITOR.ui.dialog.uiElement.prototype.getValue.call(this); if (this.bidi && a) { var b = this.getDirectionMarker(); b && (a = ("ltr" == b ? "â€ª" : "â€«") + a) } return a }, setDirectionMarker: function (a) { var b = this.getInputElement(); a ? b.setAttributes({ dir: a, "data-cke-dir-marker": a }) : this.getDirectionMarker() && b.removeAttributes(["dir", "data-cke-dir-marker"]) }, getDirectionMarker: function () { return this.getInputElement().data("cke-dir-marker") }, keyboardFocusable: !0
                }, c, !0); CKEDITOR.ui.dialog.textarea.prototype =
                    new CKEDITOR.ui.dialog.textInput; CKEDITOR.ui.dialog.select.prototype = CKEDITOR.tools.extend(new CKEDITOR.ui.dialog.labeledElement, {
                        getInputElement: function () { return this._.select.getElement() }, add: function (a, b, c) { var d = new CKEDITOR.dom.element("option", this.getDialog().getParentEditor().document), f = this.getInputElement().$; d.$.text = a; d.$.value = void 0 === b || null === b ? a : b; void 0 === c || null === c ? CKEDITOR.env.ie ? f.add(d.$) : f.add(d.$, null) : f.add(d.$, c); return this }, remove: function (a) {
                            this.getInputElement().$.remove(a);
                            return this
                        }, clear: function () { for (var a = this.getInputElement().$; 0 < a.length;)a.remove(0); return this }, keyboardFocusable: !0
                    }, c, !0); CKEDITOR.ui.dialog.checkbox.prototype = CKEDITOR.tools.extend(new CKEDITOR.ui.dialog.uiElement, {
                        getInputElement: function () { return this._.checkbox.getElement() }, setValue: function (a, b) { this.getInputElement().$.checked = a; !b && this.fire("change", { value: a }) }, getValue: function () { return this.getInputElement().$.checked }, accessKeyUp: function () { this.setValue(!this.getValue()) }, eventProcessors: {
                            onChange: function (a,
                                b) { if (!CKEDITOR.env.ie || 8 < CKEDITOR.env.version) return d.onChange.apply(this, arguments); a.on("load", function () { var a = this._.checkbox.getElement(); a.on("propertychange", function (b) { b = b.data.$; "checked" == b.propertyName && this.fire("change", { value: a.$.checked }) }, this) }, this); this.on("change", b); return null }
                        }, keyboardFocusable: !0
                    }, c, !0); CKEDITOR.ui.dialog.radio.prototype = CKEDITOR.tools.extend(new CKEDITOR.ui.dialog.uiElement, {
                        setValue: function (a, b) {
                            for (var c = this._.children, d, f = 0; f < c.length && (d = c[f]); f++)d.getElement().$.checked =
                                d.getValue() == a; !b && this.fire("change", { value: a })
                        }, getValue: function () { for (var a = this._.children, b = 0; b < a.length; b++)if (a[b].getElement().$.checked) return a[b].getValue(); return null }, accessKeyUp: function () { var a = this._.children, b; for (b = 0; b < a.length; b++)if (a[b].getElement().$.checked) { a[b].getElement().focus(); return } a[0].getElement().focus() }, eventProcessors: {
                            onChange: function (a, b) {
                                if (!CKEDITOR.env.ie || 8 < CKEDITOR.env.version) return d.onChange.apply(this, arguments); a.on("load", function () {
                                    for (var a =
                                        this._.children, b = this, c = 0; c < a.length; c++)a[c].getElement().on("propertychange", function (a) { a = a.data.$; "checked" == a.propertyName && this.$.checked && b.fire("change", { value: this.getAttribute("value") }) })
                                }, this); this.on("change", b); return null
                            }
                        }
                    }, c, !0); CKEDITOR.ui.dialog.file.prototype = CKEDITOR.tools.extend(new CKEDITOR.ui.dialog.labeledElement, c, {
                        getInputElement: function () {
                            var a = CKEDITOR.document.getById(this._.frameId).getFrameDocument(); return 0 < a.$.forms.length ? new CKEDITOR.dom.element(a.$.forms[0].elements[0]) :
                                this.getElement()
                        }, submit: function () { this.getInputElement().getParent().$.submit(); return this }, getAction: function () { return this.getInputElement().getParent().$.action }, registerEvents: function (a) { var b = /^on([A-Z]\w+)/, c, d = function (a, b, c, d) { a.on("formLoaded", function () { a.getInputElement().on(c, d, a) }) }, f; for (f in a) if (c = f.match(b)) this.eventProcessors[f] ? this.eventProcessors[f].call(this, this._.dialog, a[f]) : d(this, this._.dialog, c[1].toLowerCase(), a[f]); return this }, reset: function () {
                            function a() {
                                c.$.open();
                                var h = ""; d.size && (h = d.size - (CKEDITOR.env.ie ? 7 : 0)); var A = b.frameId + "_input"; c.$.write(['\x3chtml dir\x3d"' + m + '" lang\x3d"' + p + '"\x3e\x3chead\x3e\x3ctitle\x3e\x3c/title\x3e\x3c/head\x3e\x3cbody style\x3d"margin: 0; overflow: hidden; background: transparent;"\x3e', '\x3cform enctype\x3d"multipart/form-data" method\x3d"POST" dir\x3d"' + m + '" lang\x3d"' + p + '" action\x3d"', CKEDITOR.tools.htmlEncode(d.action), '"\x3e\x3clabel id\x3d"', b.labelId, '" for\x3d"', A, '" style\x3d"display:none"\x3e', CKEDITOR.tools.htmlEncode(d.label),
                                    '\x3c/label\x3e\x3cinput style\x3d"width:100%" id\x3d"', A, '" aria-labelledby\x3d"', b.labelId, '" type\x3d"file" name\x3d"', CKEDITOR.tools.htmlEncode(d.id || "cke_upload"), '" size\x3d"', CKEDITOR.tools.htmlEncode(0 < h ? h : ""), '" /\x3e\x3c/form\x3e\x3c/body\x3e\x3c/html\x3e\x3cscript\x3e', CKEDITOR.env.ie ? "(" + CKEDITOR.tools.fixDomain + ")();" : "", "window.parent.CKEDITOR.tools.callFunction(" + e + ");", "window.onbeforeunload \x3d function() {window.parent.CKEDITOR.tools.callFunction(" + k + ")}", "\x3c/script\x3e"].join(""));
                                c.$.close(); for (h = 0; h < f.length; h++)f[h].enable()
                            } var b = this._, c = CKEDITOR.document.getById(b.frameId).getFrameDocument(), d = b.definition, f = b.buttons, e = this.formLoadedNumber, k = this.formUnloadNumber, m = b.dialog._.editor.lang.dir, p = b.dialog._.editor.langCode; e || (e = this.formLoadedNumber = CKEDITOR.tools.addFunction(function () { this.fire("formLoaded") }, this), k = this.formUnloadNumber = CKEDITOR.tools.addFunction(function () { this.getInputElement().clearCustomData() }, this), this.getDialog()._.editor.on("destroy", function () {
                                CKEDITOR.tools.removeFunction(e);
                                CKEDITOR.tools.removeFunction(k)
                            })); CKEDITOR.env.gecko ? setTimeout(a, 500) : a()
                        }, getValue: function () { return this.getInputElement().$.value || "" }, setInitValue: function () { this._.initValue = "" }, eventProcessors: { onChange: function (a, b) { this._.domOnChangeRegistered || (this.on("formLoaded", function () { this.getInputElement().on("change", function () { this.fire("change", { value: this.getValue() }) }, this) }, this), this._.domOnChangeRegistered = !0); this.on("change", b) } }, keyboardFocusable: !0
                    }, !0); CKEDITOR.ui.dialog.fileButton.prototype =
                        new CKEDITOR.ui.dialog.button; CKEDITOR.ui.dialog.fieldset.prototype = CKEDITOR.tools.clone(CKEDITOR.ui.dialog.hbox.prototype); CKEDITOR.dialog.addUIElement("text", e); CKEDITOR.dialog.addUIElement("password", e); CKEDITOR.dialog.addUIElement("textarea", b); CKEDITOR.dialog.addUIElement("checkbox", b); CKEDITOR.dialog.addUIElement("radio", b); CKEDITOR.dialog.addUIElement("button", b); CKEDITOR.dialog.addUIElement("select", b); CKEDITOR.dialog.addUIElement("file", b); CKEDITOR.dialog.addUIElement("fileButton", b); CKEDITOR.dialog.addUIElement("html",
                            b); CKEDITOR.dialog.addUIElement("fieldset", { build: function (a, b, c) { for (var d = b.children, f, e = [], k = [], m = 0; m < d.length && (f = d[m]); m++) { var p = []; e.push(p); k.push(CKEDITOR.dialog._.uiElementBuilders[f.type].build(a, f, p)) } return new CKEDITOR.ui.dialog[b.type](a, k, e, c, b) } })
            }
        }), CKEDITOR.DIALOG_RESIZE_NONE = 0, CKEDITOR.DIALOG_RESIZE_WIDTH = 1, CKEDITOR.DIALOG_RESIZE_HEIGHT = 2, CKEDITOR.DIALOG_RESIZE_BOTH = 3, CKEDITOR.DIALOG_STATE_IDLE = 1, CKEDITOR.DIALOG_STATE_BUSY = 2, function () {
            function a() {
                for (var a = this._.tabIdList.length,
                    b = CKEDITOR.tools.indexOf(this._.tabIdList, this._.currentTabId) + a, c = b - 1; c > b - a; c--)if (this._.tabs[this._.tabIdList[c % a]][0].$.offsetHeight) return this._.tabIdList[c % a]; return null
            } function e() { for (var a = this._.tabIdList.length, b = CKEDITOR.tools.indexOf(this._.tabIdList, this._.currentTabId), c = b + 1; c < b + a; c++)if (this._.tabs[this._.tabIdList[c % a]][0].$.offsetHeight) return this._.tabIdList[c % a]; return null } function b(a, b) {
                for (var c = a.$.getElementsByTagName("input"), d = 0, f = c.length; d < f; d++) {
                    var e = new CKEDITOR.dom.element(c[d]);
                    "text" == e.getAttribute("type").toLowerCase() && (b ? (e.setAttribute("value", e.getCustomData("fake_value") || ""), e.removeCustomData("fake_value")) : (e.setCustomData("fake_value", e.getAttribute("value")), e.setAttribute("value", "")))
                }
            } function c(a, b) { var c = this.getInputElement(); c && (a ? c.removeAttribute("aria-invalid") : c.setAttribute("aria-invalid", !0)); a || (this.select ? this.select() : this.focus()); b && alert(b); this.fire("validated", { valid: a, msg: b }) } function d() { var a = this.getInputElement(); a && a.removeAttribute("aria-invalid") }
            function k(a) {
                var b = CKEDITOR.dom.element.createFromHtml(CKEDITOR.addTemplate("dialog", t).output({ id: CKEDITOR.tools.getNextNumber(), editorId: a.id, langDir: a.lang.dir, langCode: a.langCode, editorDialogClass: "cke_editor_" + a.name.replace(/\./g, "\\.") + "_dialog", closeTitle: a.lang.common.close, hidpi: CKEDITOR.env.hidpi ? "cke_hidpi" : "" })), c = b.getChild([0, 0, 0, 0, 0]), d = c.getChild(0), f = c.getChild(1); a.plugins.clipboard && CKEDITOR.plugins.clipboard.preventDefaultDropOnElement(c); !CKEDITOR.env.ie || CKEDITOR.env.quirks ||
                    CKEDITOR.env.edge || (a = "javascript:void(function(){" + encodeURIComponent("document.open();(" + CKEDITOR.tools.fixDomain + ")();document.close();") + "}())", CKEDITOR.dom.element.createFromHtml('\x3ciframe frameBorder\x3d"0" class\x3d"cke_iframe_shim" src\x3d"' + a + '" tabIndex\x3d"-1"\x3e\x3c/iframe\x3e').appendTo(c.getParent())); d.unselectable(); f.unselectable(); return { element: b, parts: { dialog: b.getChild(0), title: d, close: f, tabs: c.getChild(2), contents: c.getChild([3, 0, 0, 0]), footer: c.getChild([3, 0, 1, 0]) } }
            } function m(a,
                b, c) { this.element = b; this.focusIndex = c; this.tabIndex = 0; this.isFocusable = function () { return !b.getAttribute("disabled") && b.isVisible() }; this.focus = function () { a._.currentFocusIndex = this.focusIndex; this.element.focus() }; b.on("keydown", function (a) { a.data.getKeystroke() in { 32: 1, 13: 1 } && this.fire("click") }); b.on("focus", function () { this.fire("mouseover") }); b.on("blur", function () { this.fire("mouseout") }) } function f(a) {
                    function b() { a.layout() } var c = CKEDITOR.document.getWindow(); c.on("resize", b); a.on("hide", function () {
                        c.removeListener("resize",
                            b)
                    })
                } function h(a, b) { this._ = { dialog: a }; CKEDITOR.tools.extend(this, b) } function l(a) {
                    function b(c) { var k = a.getSize(), l = CKEDITOR.document.getWindow().getViewPaneSize(), m = c.data.$.screenX, n = c.data.$.screenY, p = m - d.x, y = n - d.y; d = { x: m, y: n }; f.x += p; f.y += y; a.move(f.x + h[3] < g ? -h[3] : f.x - h[1] > l.width - k.width - g ? l.width - k.width + ("rtl" == e.lang.dir ? 0 : h[1]) : f.x, f.y + h[0] < g ? -h[0] : f.y - h[2] > l.height - k.height - g ? l.height - k.height + h[2] : f.y, 1); c.data.preventDefault() } function c() {
                        CKEDITOR.document.removeListener("mousemove",
                            b); CKEDITOR.document.removeListener("mouseup", c); if (CKEDITOR.env.ie6Compat) { var a = x.getChild(0).getFrameDocument(); a.removeListener("mousemove", b); a.removeListener("mouseup", c) }
                    } var d = null, f = null, e = a.getParentEditor(), g = e.config.dialog_magnetDistance, h = CKEDITOR.skin.margins || [0, 0, 0, 0]; "undefined" == typeof g && (g = 20); a.parts.title.on("mousedown", function (e) {
                        d = { x: e.data.$.screenX, y: e.data.$.screenY }; CKEDITOR.document.on("mousemove", b); CKEDITOR.document.on("mouseup", c); f = a.getPosition(); if (CKEDITOR.env.ie6Compat) {
                            var g =
                                x.getChild(0).getFrameDocument(); g.on("mousemove", b); g.on("mouseup", c)
                        } e.data.preventDefault()
                    }, a)
                } function g(a) {
                    function b(c) {
                        var n = "rtl" == e.lang.dir, p = m.width, y = m.height, q = p + (c.data.$.screenX - l.x) * (n ? -1 : 1) * (a._.moved ? 1 : 2), A = y + (c.data.$.screenY - l.y) * (a._.moved ? 1 : 2), r = a._.element.getFirst(), r = n && r.getComputedStyle("right"), t = a.getPosition(); t.y + A > k.height && (A = k.height - t.y); (n ? r : t.x) + q > k.width && (q = k.width - (n ? r : t.x)); if (f == CKEDITOR.DIALOG_RESIZE_WIDTH || f == CKEDITOR.DIALOG_RESIZE_BOTH) p = Math.max(d.minWidth ||
                            0, q - g); if (f == CKEDITOR.DIALOG_RESIZE_HEIGHT || f == CKEDITOR.DIALOG_RESIZE_BOTH) y = Math.max(d.minHeight || 0, A - h); a.resize(p, y); a._.moved || a.layout(); c.data.preventDefault()
                    } function c() { CKEDITOR.document.removeListener("mouseup", c); CKEDITOR.document.removeListener("mousemove", b); n && (n.remove(), n = null); if (CKEDITOR.env.ie6Compat) { var a = x.getChild(0).getFrameDocument(); a.removeListener("mouseup", c); a.removeListener("mousemove", b) } } var d = a.definition, f = d.resizable; if (f != CKEDITOR.DIALOG_RESIZE_NONE) {
                        var e = a.getParentEditor(),
                        g, h, k, l, m, n, p = CKEDITOR.tools.addFunction(function (d) {
                            m = a.getSize(); var f = a.parts.contents; f.$.getElementsByTagName("iframe").length && (n = CKEDITOR.dom.element.createFromHtml('\x3cdiv class\x3d"cke_dialog_resize_cover" style\x3d"height: 100%; position: absolute; width: 100%;"\x3e\x3c/div\x3e'), f.append(n)); h = m.height - a.parts.contents.getSize("height", !(CKEDITOR.env.gecko || CKEDITOR.env.ie && CKEDITOR.env.quirks)); g = m.width - a.parts.contents.getSize("width", 1); l = { x: d.screenX, y: d.screenY }; k = CKEDITOR.document.getWindow().getViewPaneSize();
                            CKEDITOR.document.on("mousemove", b); CKEDITOR.document.on("mouseup", c); CKEDITOR.env.ie6Compat && (f = x.getChild(0).getFrameDocument(), f.on("mousemove", b), f.on("mouseup", c)); d.preventDefault && d.preventDefault()
                        }); a.on("load", function () {
                            var b = ""; f == CKEDITOR.DIALOG_RESIZE_WIDTH ? b = " cke_resizer_horizontal" : f == CKEDITOR.DIALOG_RESIZE_HEIGHT && (b = " cke_resizer_vertical"); b = CKEDITOR.dom.element.createFromHtml('\x3cdiv class\x3d"cke_resizer' + b + " cke_resizer_" + e.lang.dir + '" title\x3d"' + CKEDITOR.tools.htmlEncode(e.lang.common.resize) +
                                '" onmousedown\x3d"CKEDITOR.tools.callFunction(' + p + ', event )"\x3e' + ("ltr" == e.lang.dir ? "â—¢" : "â—£") + "\x3c/div\x3e"); a.parts.footer.append(b, 1)
                        }); e.on("destroy", function () { CKEDITOR.tools.removeFunction(p) })
                    }
                } function n(a) { a.data.preventDefault(1) } function v(a) {
                    var b = CKEDITOR.document.getWindow(), c = a.config, d = c.dialog_backgroundCoverColor || "white", f = c.dialog_backgroundCoverOpacity, e = c.baseFloatZIndex, c = CKEDITOR.tools.genKey(d, f, e), g = C[c]; g ? g.show() : (e = ['\x3cdiv tabIndex\x3d"-1" style\x3d"position: ', CKEDITOR.env.ie6Compat ?
                        "absolute" : "fixed", "; z-index: ", e, "; top: 0px; left: 0px; ", CKEDITOR.env.ie6Compat ? "" : "background-color: " + d, '" class\x3d"cke_dialog_background_cover"\x3e'], CKEDITOR.env.ie6Compat && (d = "\x3chtml\x3e\x3cbody style\x3d\\'background-color:" + d + ";\\'\x3e\x3c/body\x3e\x3c/html\x3e", e.push('\x3ciframe hidefocus\x3d"true" frameborder\x3d"0" id\x3d"cke_dialog_background_iframe" src\x3d"javascript:'), e.push("void((function(){" + encodeURIComponent("document.open();(" + CKEDITOR.tools.fixDomain + ")();document.write( '" +
                            d + "' );document.close();") + "})())"), e.push('" style\x3d"position:absolute;left:0;top:0;width:100%;height: 100%;filter: progid:DXImageTransform.Microsoft.Alpha(opacity\x3d0)"\x3e\x3c/iframe\x3e')), e.push("\x3c/div\x3e"), g = CKEDITOR.dom.element.createFromHtml(e.join("")), g.setOpacity(void 0 !== f ? f : .5), g.on("keydown", n), g.on("keypress", n), g.on("keyup", n), g.appendTo(CKEDITOR.document.getBody()), C[c] = g); a.focusManager.add(g); x = g; a = function () {
                                var a = b.getViewPaneSize(); g.setStyles({
                                    width: a.width + "px", height: a.height +
                                        "px"
                                })
                            }; var h = function () { var a = b.getScrollPosition(), c = CKEDITOR.dialog._.currentTop; g.setStyles({ left: a.x + "px", top: a.y + "px" }); if (c) { do a = c.getPosition(), c.move(a.x, a.y); while (c = c._.parentDialog) } }; w = a; b.on("resize", a); a(); CKEDITOR.env.mac && CKEDITOR.env.webkit || g.focus(); if (CKEDITOR.env.ie6Compat) { var k = function () { h(); arguments.callee.prevScrollHandler.apply(this, arguments) }; b.$.setTimeout(function () { k.prevScrollHandler = window.onscroll || function () { }; window.onscroll = k }, 0); h() }
                } function u(a) {
                    x && (a.focusManager.remove(x),
                        a = CKEDITOR.document.getWindow(), x.hide(), a.removeListener("resize", w), CKEDITOR.env.ie6Compat && a.$.setTimeout(function () { window.onscroll = window.onscroll && window.onscroll.prevScrollHandler || null }, 0), w = null)
                } var q = CKEDITOR.tools.cssLength, t = '\x3cdiv class\x3d"cke_reset_all {editorId} {editorDialogClass} {hidpi}" dir\x3d"{langDir}" lang\x3d"{langCode}" role\x3d"dialog" aria-labelledby\x3d"cke_dialog_title_{id}"\x3e\x3ctable class\x3d"cke_dialog ' + CKEDITOR.env.cssClass + ' cke_{langDir}" style\x3d"position:absolute" role\x3d"presentation"\x3e\x3ctr\x3e\x3ctd role\x3d"presentation"\x3e\x3cdiv class\x3d"cke_dialog_body" role\x3d"presentation"\x3e\x3cdiv id\x3d"cke_dialog_title_{id}" class\x3d"cke_dialog_title" role\x3d"presentation"\x3e\x3c/div\x3e\x3ca id\x3d"cke_dialog_close_button_{id}" class\x3d"cke_dialog_close_button" href\x3d"javascript:void(0)" title\x3d"{closeTitle}" role\x3d"button"\x3e\x3cspan class\x3d"cke_label"\x3eX\x3c/span\x3e\x3c/a\x3e\x3cdiv id\x3d"cke_dialog_tabs_{id}" class\x3d"cke_dialog_tabs" role\x3d"tablist"\x3e\x3c/div\x3e\x3ctable class\x3d"cke_dialog_contents" role\x3d"presentation"\x3e\x3ctr\x3e\x3ctd id\x3d"cke_dialog_contents_{id}" class\x3d"cke_dialog_contents_body" role\x3d"presentation"\x3e\x3c/td\x3e\x3c/tr\x3e\x3ctr\x3e\x3ctd id\x3d"cke_dialog_footer_{id}" class\x3d"cke_dialog_footer" role\x3d"presentation"\x3e\x3c/td\x3e\x3c/tr\x3e\x3c/table\x3e\x3c/div\x3e\x3c/td\x3e\x3c/tr\x3e\x3c/table\x3e\x3c/div\x3e';
            CKEDITOR.dialog = function (b, f) {
                function h() { var a = x._.focusList; a.sort(function (a, b) { return a.tabIndex != b.tabIndex ? b.tabIndex - a.tabIndex : a.focusIndex - b.focusIndex }); for (var b = a.length, c = 0; c < b; c++)a[c].focusIndex = c } function m(a) {
                    var b = x._.focusList; a = a || 0; if (!(1 > b.length)) {
                        var c = x._.currentFocusIndex; x._.tabBarMode && 0 > a && (c = 0); try { b[c].getInputElement().$.blur() } catch (d) { } var f = c, e = 1 < x._.pageCount; do {
                            f += a; if (e && !x._.tabBarMode && (f == b.length || -1 == f)) {
                                x._.tabBarMode = !0; x._.tabs[x._.currentTabId][0].focus();
                                x._.currentFocusIndex = -1; return
                            } f = (f + b.length) % b.length; if (f == c) break
                        } while (a && !b[f].isFocusable()); b[f].focus(); "text" == b[f].type && b[f].select()
                    }
                } function n(c) {
                    if (x == CKEDITOR.dialog._.currentTop) {
                        var d = c.data.getKeystroke(), f = "rtl" == b.lang.dir, g = [37, 38, 39, 40]; w = v = 0; if (9 == d || d == CKEDITOR.SHIFT + 9) m(d == CKEDITOR.SHIFT + 9 ? -1 : 1), w = 1; else if (d == CKEDITOR.ALT + 121 && !x._.tabBarMode && 1 < x.getPageCount()) x._.tabBarMode = !0, x._.tabs[x._.currentTabId][0].focus(), x._.currentFocusIndex = -1, w = 1; else if (-1 != CKEDITOR.tools.indexOf(g,
                            d) && x._.tabBarMode) d = -1 != CKEDITOR.tools.indexOf([f ? 39 : 37, 38], d) ? a.call(x) : e.call(x), x.selectPage(d), x._.tabs[d][0].focus(), w = 1; else if (13 != d && 32 != d || !x._.tabBarMode) if (13 == d) d = c.data.getTarget(), d.is("a", "button", "select", "textarea") || d.is("input") && "button" == d.$.type || ((d = this.getButton("ok")) && CKEDITOR.tools.setTimeout(d.click, 0, d), w = 1), v = 1; else if (27 == d) (d = this.getButton("cancel")) ? CKEDITOR.tools.setTimeout(d.click, 0, d) : !1 !== this.fire("cancel", { hide: !0 }).hide && this.hide(), v = 1; else return; else this.selectPage(this._.currentTabId),
                                this._.tabBarMode = !1, this._.currentFocusIndex = -1, m(1), w = 1; y(c)
                    }
                } function y(a) { w ? a.data.preventDefault(1) : v && a.data.stopPropagation() } var q = CKEDITOR.dialog._.dialogDefinitions[f], A = CKEDITOR.tools.clone(p), t = b.config.dialog_buttonsOrder || "OS", z = b.lang.dir, u = {}, w, v; ("OS" == t && CKEDITOR.env.mac || "rtl" == t && "ltr" == z || "ltr" == t && "rtl" == z) && A.buttons.reverse(); q = CKEDITOR.tools.extend(q(b), A); q = CKEDITOR.tools.clone(q); q = new r(this, q); A = k(b); this._ = {
                    editor: b, element: A.element, name: f, contentSize: { width: 0, height: 0 },
                    size: { width: 0, height: 0 }, contents: {}, buttons: {}, accessKeyMap: {}, tabs: {}, tabIdList: [], currentTabId: null, currentTabIndex: null, pageCount: 0, lastTab: null, tabBarMode: !1, focusList: [], currentFocusIndex: 0, hasFocus: !1
                }; this.parts = A.parts; CKEDITOR.tools.setTimeout(function () { b.fire("ariaWidget", this.parts.contents) }, 0, this); A = { position: CKEDITOR.env.ie6Compat ? "absolute" : "fixed", top: 0, visibility: "hidden" }; A["rtl" == z ? "right" : "left"] = 0; this.parts.dialog.setStyles(A); CKEDITOR.event.call(this); this.definition = q = CKEDITOR.fire("dialogDefinition",
                    { name: f, definition: q }, b).definition; if (!("removeDialogTabs" in b._) && b.config.removeDialogTabs) { A = b.config.removeDialogTabs.split(";"); for (z = 0; z < A.length; z++)if (t = A[z].split(":"), 2 == t.length) { var C = t[0]; u[C] || (u[C] = []); u[C].push(t[1]) } b._.removeDialogTabs = u } if (b._.removeDialogTabs && (u = b._.removeDialogTabs[f])) for (z = 0; z < u.length; z++)q.removeContents(u[z]); if (q.onLoad) this.on("load", q.onLoad); if (q.onShow) this.on("show", q.onShow); if (q.onHide) this.on("hide", q.onHide); if (q.onOk) this.on("ok", function (a) {
                        b.fire("saveSnapshot");
                        setTimeout(function () { b.fire("saveSnapshot") }, 0); !1 === q.onOk.call(this, a) && (a.data.hide = !1)
                    }); this.state = CKEDITOR.DIALOG_STATE_IDLE; if (q.onCancel) this.on("cancel", function (a) { !1 === q.onCancel.call(this, a) && (a.data.hide = !1) }); var x = this, B = function (a) { var b = x._.contents, c = !1, d; for (d in b) for (var f in b[d]) if (c = a.call(this, b[d][f])) return }; this.on("ok", function (a) {
                        B(function (b) {
                            if (b.validate) {
                                var d = b.validate(this), f = "string" == typeof d || !1 === d; f && (a.data.hide = !1, a.stop()); c.call(b, !f, "string" == typeof d ?
                                    d : void 0); return f
                            }
                        })
                    }, this, null, 0); this.on("cancel", function (a) { B(function (c) { if (c.isChanged()) return b.config.dialog_noConfirmCancel || confirm(b.lang.common.confirmCancel) || (a.data.hide = !1), !0 }) }, this, null, 0); this.parts.close.on("click", function (a) { !1 !== this.fire("cancel", { hide: !0 }).hide && this.hide(); a.data.preventDefault() }, this); this.changeFocus = m; var D = this._.element; b.focusManager.add(D, 1); this.on("show", function () { D.on("keydown", n, this); if (CKEDITOR.env.gecko) D.on("keypress", y, this) }); this.on("hide",
                        function () { D.removeListener("keydown", n); CKEDITOR.env.gecko && D.removeListener("keypress", y); B(function (a) { d.apply(a) }) }); this.on("iframeAdded", function (a) { (new CKEDITOR.dom.document(a.data.iframe.$.contentWindow.document)).on("keydown", n, this, null, 0) }); this.on("show", function () {
                            h(); var a = 1 < x._.pageCount; b.config.dialog_startupFocusTab && a ? (x._.tabBarMode = !0, x._.tabs[x._.currentTabId][0].focus(), x._.currentFocusIndex = -1) : this._.hasFocus || (this._.currentFocusIndex = a ? -1 : this._.focusList.length - 1, q.onFocus ?
                                (a = q.onFocus.call(this)) && a.focus() : m(1))
                        }, this, null, 4294967295); if (CKEDITOR.env.ie6Compat) this.on("load", function () { var a = this.getElement(), b = a.getFirst(); b.remove(); b.appendTo(a) }, this); l(this); g(this); (new CKEDITOR.dom.text(q.title, CKEDITOR.document)).appendTo(this.parts.title); for (z = 0; z < q.contents.length; z++)(u = q.contents[z]) && this.addPage(u); this.parts.tabs.on("click", function (a) {
                            var b = a.data.getTarget(); b.hasClass("cke_dialog_tab") && (b = b.$.id, this.selectPage(b.substring(4, b.lastIndexOf("_"))),
                                this._.tabBarMode && (this._.tabBarMode = !1, this._.currentFocusIndex = -1, m(1)), a.data.preventDefault())
                        }, this); z = []; u = CKEDITOR.dialog._.uiElementBuilders.hbox.build(this, { type: "hbox", className: "cke_dialog_footer_buttons", widths: [], children: q.buttons }, z).getChild(); this.parts.footer.setHtml(z.join("")); for (z = 0; z < u.length; z++)this._.buttons[u[z].id] = u[z]
            }; CKEDITOR.dialog.prototype = {
                destroy: function () { this.hide(); this._.element.remove() }, resize: function () {
                    return function (a, b) {
                        this._.contentSize && this._.contentSize.width ==
                            a && this._.contentSize.height == b || (CKEDITOR.dialog.fire("resize", { dialog: this, width: a, height: b }, this._.editor), this.fire("resize", { width: a, height: b }, this._.editor), this.parts.contents.setStyles({ width: a + "px", height: b + "px" }), "rtl" == this._.editor.lang.dir && this._.position && (this._.position.x = CKEDITOR.document.getWindow().getViewPaneSize().width - this._.contentSize.width - parseInt(this._.element.getFirst().getStyle("right"), 10)), this._.contentSize = { width: a, height: b })
                    }
                }(), getSize: function () {
                    var a = this._.element.getFirst();
                    return { width: a.$.offsetWidth || 0, height: a.$.offsetHeight || 0 }
                }, move: function (a, b, c) {
                    var d = this._.element.getFirst(), f = "rtl" == this._.editor.lang.dir, e = "fixed" == d.getComputedStyle("position"); CKEDITOR.env.ie && d.setStyle("zoom", "100%"); e && this._.position && this._.position.x == a && this._.position.y == b || (this._.position = { x: a, y: b }, e || (e = CKEDITOR.document.getWindow().getScrollPosition(), a += e.x, b += e.y), f && (e = this.getSize(), a = CKEDITOR.document.getWindow().getViewPaneSize().width - e.width - a), b = { top: (0 < b ? b : 0) + "px" },
                        b[f ? "right" : "left"] = (0 < a ? a : 0) + "px", d.setStyles(b), c && (this._.moved = 1))
                }, getPosition: function () { return CKEDITOR.tools.extend({}, this._.position) }, show: function () {
                    var a = this._.element, b = this.definition; a.getParent() && a.getParent().equals(CKEDITOR.document.getBody()) ? a.setStyle("display", "block") : a.appendTo(CKEDITOR.document.getBody()); this.resize(this._.contentSize && this._.contentSize.width || b.width || b.minWidth, this._.contentSize && this._.contentSize.height || b.height || b.minHeight); this.reset(); this.selectPage(this.definition.contents[0].id);
                    null === CKEDITOR.dialog._.currentZIndex && (CKEDITOR.dialog._.currentZIndex = this._.editor.config.baseFloatZIndex); this._.element.getFirst().setStyle("z-index", CKEDITOR.dialog._.currentZIndex += 10); null === CKEDITOR.dialog._.currentTop ? (CKEDITOR.dialog._.currentTop = this, this._.parentDialog = null, v(this._.editor)) : (this._.parentDialog = CKEDITOR.dialog._.currentTop, this._.parentDialog.getElement().getFirst().$.style.zIndex -= Math.floor(this._.editor.config.baseFloatZIndex / 2), CKEDITOR.dialog._.currentTop = this);
                    a.on("keydown", D); a.on("keyup", F); this._.hasFocus = !1; for (var c in b.contents) if (b.contents[c]) { var a = b.contents[c], d = this._.tabs[a.id], e = a.requiredContent, g = 0; if (d) { for (var h in this._.contents[a.id]) { var k = this._.contents[a.id][h]; "hbox" != k.type && "vbox" != k.type && k.getInputElement() && (k.requiredContent && !this._.editor.activeFilter.check(k.requiredContent) ? k.disable() : (k.enable(), g++)) } !g || e && !this._.editor.activeFilter.check(e) ? d[0].addClass("cke_dialog_tab_disabled") : d[0].removeClass("cke_dialog_tab_disabled") } } CKEDITOR.tools.setTimeout(function () {
                        this.layout();
                        f(this); this.parts.dialog.setStyle("visibility", ""); this.fireOnce("load", {}); CKEDITOR.ui.fire("ready", this); this.fire("show", {}); this._.editor.fire("dialogShow", this); this._.parentDialog || this._.editor.focusManager.lock(); this.foreach(function (a) { a.setInitValue && a.setInitValue() })
                    }, 100, this)
                }, layout: function () {
                    var a = this.parts.dialog, b = this.getSize(), c = CKEDITOR.document.getWindow().getViewPaneSize(), d = (c.width - b.width) / 2, f = (c.height - b.height) / 2; CKEDITOR.env.ie6Compat || (b.height + (0 < f ? f : 0) > c.height ||
                        b.width + (0 < d ? d : 0) > c.width ? a.setStyle("position", "absolute") : a.setStyle("position", "fixed")); this.move(this._.moved ? this._.position.x : d, this._.moved ? this._.position.y : f)
                }, foreach: function (a) { for (var b in this._.contents) for (var c in this._.contents[b]) a.call(this, this._.contents[b][c]); return this }, reset: function () { var a = function (a) { a.reset && a.reset(1) }; return function () { this.foreach(a); return this } }(), setupContent: function () { var a = arguments; this.foreach(function (b) { b.setup && b.setup.apply(b, a) }) },
                commitContent: function () { var a = arguments; this.foreach(function (b) { CKEDITOR.env.ie && this._.currentFocusIndex == b.focusIndex && b.getInputElement().$.blur(); b.commit && b.commit.apply(b, a) }) }, hide: function () {
                    if (this.parts.dialog.isVisible()) {
                        this.fire("hide", {}); this._.editor.fire("dialogHide", this); this.selectPage(this._.tabIdList[0]); var a = this._.element; a.setStyle("display", "none"); this.parts.dialog.setStyle("visibility", "hidden"); for (I(this); CKEDITOR.dialog._.currentTop != this;)CKEDITOR.dialog._.currentTop.hide();
                        if (this._.parentDialog) { var b = this._.parentDialog.getElement().getFirst(); b.setStyle("z-index", parseInt(b.$.style.zIndex, 10) + Math.floor(this._.editor.config.baseFloatZIndex / 2)) } else u(this._.editor); if (CKEDITOR.dialog._.currentTop = this._.parentDialog) CKEDITOR.dialog._.currentZIndex -= 10; else { CKEDITOR.dialog._.currentZIndex = null; a.removeListener("keydown", D); a.removeListener("keyup", F); var c = this._.editor; c.focus(); setTimeout(function () { c.focusManager.unlock(); CKEDITOR.env.iOS && c.window.focus() }, 0) } delete this._.parentDialog;
                        this.foreach(function (a) { a.resetInitValue && a.resetInitValue() }); this.setState(CKEDITOR.DIALOG_STATE_IDLE)
                    }
                }, addPage: function (a) {
                    if (!a.requiredContent || this._.editor.filter.check(a.requiredContent)) {
                        for (var b = [], c = a.label ? ' title\x3d"' + CKEDITOR.tools.htmlEncode(a.label) + '"' : "", d = CKEDITOR.dialog._.uiElementBuilders.vbox.build(this, { type: "vbox", className: "cke_dialog_page_contents", children: a.elements, expand: !!a.expand, padding: a.padding, style: a.style || "width: 100%;" }, b), f = this._.contents[a.id] = {}, e = d.getChild(),
                            g = 0; d = e.shift();)d.notAllowed || "hbox" == d.type || "vbox" == d.type || g++, f[d.id] = d, "function" == typeof d.getChild && e.push.apply(e, d.getChild()); g || (a.hidden = !0); b = CKEDITOR.dom.element.createFromHtml(b.join("")); b.setAttribute("role", "tabpanel"); d = CKEDITOR.env; f = "cke_" + a.id + "_" + CKEDITOR.tools.getNextNumber(); c = CKEDITOR.dom.element.createFromHtml(['\x3ca class\x3d"cke_dialog_tab"', 0 < this._.pageCount ? " cke_last" : "cke_first", c, a.hidden ? ' style\x3d"display:none"' : "", ' id\x3d"', f, '"', d.gecko && !d.hc ? "" : ' href\x3d"javascript:void(0)"',
                                ' tabIndex\x3d"-1" hidefocus\x3d"true" role\x3d"tab"\x3e', a.label, "\x3c/a\x3e"].join("")); b.setAttribute("aria-labelledby", f); this._.tabs[a.id] = [c, b]; this._.tabIdList.push(a.id); !a.hidden && this._.pageCount++; this._.lastTab = c; this.updateStyle(); b.setAttribute("name", a.id); b.appendTo(this.parts.contents); c.unselectable(); this.parts.tabs.append(c); a.accessKey && (E(this, this, "CTRL+" + a.accessKey, L, G), this._.accessKeyMap["CTRL+" + a.accessKey] = a.id)
                    }
                }, selectPage: function (a) {
                    if (this._.currentTabId != a && !this._.tabs[a][0].hasClass("cke_dialog_tab_disabled") &&
                        !1 !== this.fire("selectPage", { page: a, currentPage: this._.currentTabId })) { for (var c in this._.tabs) { var d = this._.tabs[c][0], f = this._.tabs[c][1]; c != a && (d.removeClass("cke_dialog_tab_selected"), f.hide()); f.setAttribute("aria-hidden", c != a) } var e = this._.tabs[a]; e[0].addClass("cke_dialog_tab_selected"); CKEDITOR.env.ie6Compat || CKEDITOR.env.ie7Compat ? (b(e[1]), e[1].show(), setTimeout(function () { b(e[1], 1) }, 0)) : e[1].show(); this._.currentTabId = a; this._.currentTabIndex = CKEDITOR.tools.indexOf(this._.tabIdList, a) }
                },
                updateStyle: function () { this.parts.dialog[(1 === this._.pageCount ? "add" : "remove") + "Class"]("cke_single_page") }, hidePage: function (b) { var c = this._.tabs[b] && this._.tabs[b][0]; c && 1 != this._.pageCount && c.isVisible() && (b == this._.currentTabId && this.selectPage(a.call(this)), c.hide(), this._.pageCount--, this.updateStyle()) }, showPage: function (a) { if (a = this._.tabs[a] && this._.tabs[a][0]) a.show(), this._.pageCount++, this.updateStyle() }, getElement: function () { return this._.element }, getName: function () { return this._.name },
                getContentElement: function (a, b) { var c = this._.contents[a]; return c && c[b] }, getValueOf: function (a, b) { return this.getContentElement(a, b).getValue() }, setValueOf: function (a, b, c) { return this.getContentElement(a, b).setValue(c) }, getButton: function (a) { return this._.buttons[a] }, click: function (a) { return this._.buttons[a].click() }, disableButton: function (a) { return this._.buttons[a].disable() }, enableButton: function (a) { return this._.buttons[a].enable() }, getPageCount: function () { return this._.pageCount }, getParentEditor: function () { return this._.editor },
                getSelectedElement: function () { return this.getParentEditor().getSelection().getSelectedElement() }, addFocusable: function (a, b) { if ("undefined" == typeof b) b = this._.focusList.length, this._.focusList.push(new m(this, a, b)); else { this._.focusList.splice(b, 0, new m(this, a, b)); for (var c = b + 1; c < this._.focusList.length; c++)this._.focusList[c].focusIndex++ } }, setState: function (a) {
                    if (this.state != a) {
                        this.state = a; if (a == CKEDITOR.DIALOG_STATE_BUSY) {
                            if (!this.parts.spinner) {
                                var b = this.getParentEditor().lang.dir, c = {
                                    attributes: { "class": "cke_dialog_spinner" },
                                    styles: { "float": "rtl" == b ? "right" : "left" }
                                }; c.styles["margin-" + ("rtl" == b ? "left" : "right")] = "8px"; this.parts.spinner = CKEDITOR.document.createElement("div", c); this.parts.spinner.setHtml("\x26#8987;"); this.parts.spinner.appendTo(this.parts.title, 1)
                            } this.parts.spinner.show(); this.getButton("ok").disable()
                        } else a == CKEDITOR.DIALOG_STATE_IDLE && (this.parts.spinner && this.parts.spinner.hide(), this.getButton("ok").enable()); this.fire("state", a)
                    }
                }
            }; CKEDITOR.tools.extend(CKEDITOR.dialog, {
                add: function (a, b) {
                    this._.dialogDefinitions[a] &&
                    "function" != typeof b || (this._.dialogDefinitions[a] = b)
                }, exists: function (a) { return !!this._.dialogDefinitions[a] }, getCurrent: function () { return CKEDITOR.dialog._.currentTop }, isTabEnabled: function (a, b, c) { a = a.config.removeDialogTabs; return !(a && a.match(new RegExp("(?:^|;)" + b + ":" + c + "(?:$|;)", "i"))) }, okButton: function () {
                    var a = function (a, b) {
                        b = b || {}; return CKEDITOR.tools.extend({
                            id: "ok", type: "button", label: a.lang.common.ok, "class": "cke_dialog_ui_button_ok", onClick: function (a) {
                                a = a.data.dialog; !1 !== a.fire("ok",
                                    { hide: !0 }).hide && a.hide()
                            }
                        }, b, !0)
                    }; a.type = "button"; a.override = function (b) { return CKEDITOR.tools.extend(function (c) { return a(c, b) }, { type: "button" }, !0) }; return a
                }(), cancelButton: function () {
                    var a = function (a, b) { b = b || {}; return CKEDITOR.tools.extend({ id: "cancel", type: "button", label: a.lang.common.cancel, "class": "cke_dialog_ui_button_cancel", onClick: function (a) { a = a.data.dialog; !1 !== a.fire("cancel", { hide: !0 }).hide && a.hide() } }, b, !0) }; a.type = "button"; a.override = function (b) {
                        return CKEDITOR.tools.extend(function (c) {
                            return a(c,
                                b)
                        }, { type: "button" }, !0)
                    }; return a
                }(), addUIElement: function (a, b) { this._.uiElementBuilders[a] = b }
            }); CKEDITOR.dialog._ = { uiElementBuilders: {}, dialogDefinitions: {}, currentTop: null, currentZIndex: null }; CKEDITOR.event.implementOn(CKEDITOR.dialog); CKEDITOR.event.implementOn(CKEDITOR.dialog.prototype); var p = { resizable: CKEDITOR.DIALOG_RESIZE_BOTH, minWidth: 600, minHeight: 400, buttons: [CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton] }, y = function (a, b, c) {
                for (var d = 0, f; f = a[d]; d++)if (f.id == b || c && f[c] && (f = y(f[c],
                    b, c))) return f; return null
            }, A = function (a, b, c, d, f) { if (c) { for (var e = 0, g; g = a[e]; e++) { if (g.id == c) return a.splice(e, 0, b), b; if (d && g[d] && (g = A(g[d], b, c, d, !0))) return g } if (f) return null } a.push(b); return b }, z = function (a, b, c) { for (var d = 0, f; f = a[d]; d++) { if (f.id == b) return a.splice(d, 1); if (c && f[c] && (f = z(f[c], b, c))) return f } return null }, r = function (a, b) { this.dialog = a; for (var c = b.contents, d = 0, f; f = c[d]; d++)c[d] = f && new h(a, f); CKEDITOR.tools.extend(this, b) }; r.prototype = {
                getContents: function (a) {
                    return y(this.contents,
                        a)
                }, getButton: function (a) { return y(this.buttons, a) }, addContents: function (a, b) { return A(this.contents, a, b) }, addButton: function (a, b) { return A(this.buttons, a, b) }, removeContents: function (a) { z(this.contents, a) }, removeButton: function (a) { z(this.buttons, a) }
            }; h.prototype = { get: function (a) { return y(this.elements, a, "children") }, add: function (a, b) { return A(this.elements, a, b, "children") }, remove: function (a) { z(this.elements, a, "children") } }; var w, C = {}, x, B = {}, D = function (a) {
                var b = a.data.$.ctrlKey || a.data.$.metaKey, c =
                    a.data.$.altKey, d = a.data.$.shiftKey, f = String.fromCharCode(a.data.$.keyCode); (b = B[(b ? "CTRL+" : "") + (c ? "ALT+" : "") + (d ? "SHIFT+" : "") + f]) && b.length && (b = b[b.length - 1], b.keydown && b.keydown.call(b.uiElement, b.dialog, b.key), a.data.preventDefault())
            }, F = function (a) {
                var b = a.data.$.ctrlKey || a.data.$.metaKey, c = a.data.$.altKey, d = a.data.$.shiftKey, f = String.fromCharCode(a.data.$.keyCode); (b = B[(b ? "CTRL+" : "") + (c ? "ALT+" : "") + (d ? "SHIFT+" : "") + f]) && b.length && (b = b[b.length - 1], b.keyup && (b.keyup.call(b.uiElement, b.dialog, b.key),
                    a.data.preventDefault()))
            }, E = function (a, b, c, d, f) { (B[c] || (B[c] = [])).push({ uiElement: a, dialog: b, key: c, keyup: f || a.accessKeyUp, keydown: d || a.accessKeyDown }) }, I = function (a) { for (var b in B) { for (var c = B[b], d = c.length - 1; 0 <= d; d--)c[d].dialog != a && c[d].uiElement != a || c.splice(d, 1); 0 === c.length && delete B[b] } }, G = function (a, b) { a._.accessKeyMap[b] && a.selectPage(a._.accessKeyMap[b]) }, L = function () { }; (function () {
                CKEDITOR.ui.dialog = {
                    uiElement: function (a, b, c, d, f, e, g) {
                        if (!(4 > arguments.length)) {
                            var h = (d.call ? d(b) : d) || "div",
                            k = ["\x3c", h, " "], l = (f && f.call ? f(b) : f) || {}, m = (e && e.call ? e(b) : e) || {}, n = (g && g.call ? g.call(this, a, b) : g) || "", p = this.domId = m.id || CKEDITOR.tools.getNextId() + "_uiElement"; b.requiredContent && !a.getParentEditor().filter.check(b.requiredContent) && (l.display = "none", this.notAllowed = !0); m.id = p; var q = {}; b.type && (q["cke_dialog_ui_" + b.type] = 1); b.className && (q[b.className] = 1); b.disabled && (q.cke_disabled = 1); for (var y = m["class"] && m["class"].split ? m["class"].split(" ") : [], p = 0; p < y.length; p++)y[p] && (q[y[p]] = 1); y = []; for (p in q) y.push(p);
                            m["class"] = y.join(" "); b.title && (m.title = b.title); q = (b.style || "").split(";"); b.align && (y = b.align, l["margin-left"] = "left" == y ? 0 : "auto", l["margin-right"] = "right" == y ? 0 : "auto"); for (p in l) q.push(p + ":" + l[p]); b.hidden && q.push("display:none"); for (p = q.length - 1; 0 <= p; p--)"" === q[p] && q.splice(p, 1); 0 < q.length && (m.style = (m.style ? m.style + "; " : "") + q.join("; ")); for (p in m) k.push(p + '\x3d"' + CKEDITOR.tools.htmlEncode(m[p]) + '" '); k.push("\x3e", n, "\x3c/", h, "\x3e"); c.push(k.join("")); (this._ || (this._ = {})).dialog = a; "boolean" ==
                                typeof b.isChanged && (this.isChanged = function () { return b.isChanged }); "function" == typeof b.isChanged && (this.isChanged = b.isChanged); "function" == typeof b.setValue && (this.setValue = CKEDITOR.tools.override(this.setValue, function (a) { return function (c) { a.call(this, b.setValue.call(this, c)) } })); "function" == typeof b.getValue && (this.getValue = CKEDITOR.tools.override(this.getValue, function (a) { return function () { return b.getValue.call(this, a.call(this)) } })); CKEDITOR.event.implementOn(this); this.registerEvents(b);
                            this.accessKeyUp && this.accessKeyDown && b.accessKey && E(this, a, "CTRL+" + b.accessKey); var A = this; a.on("load", function () { var b = A.getInputElement(); if (b) { var c = A.type in { checkbox: 1, ratio: 1 } && CKEDITOR.env.ie && 8 > CKEDITOR.env.version ? "cke_dialog_ui_focused" : ""; b.on("focus", function () { a._.tabBarMode = !1; a._.hasFocus = !0; A.fire("focus"); c && this.addClass(c) }); b.on("blur", function () { A.fire("blur"); c && this.removeClass(c) }) } }); CKEDITOR.tools.extend(this, b); this.keyboardFocusable && (this.tabIndex = b.tabIndex || 0, this.focusIndex =
                                a._.focusList.push(this) - 1, this.on("focus", function () { a._.currentFocusIndex = A.focusIndex }))
                        }
                    }, hbox: function (a, b, c, d, f) {
                        if (!(4 > arguments.length)) {
                            this._ || (this._ = {}); var e = this._.children = b, g = f && f.widths || null, h = f && f.height || null, k, l = { role: "presentation" }; f && f.align && (l.align = f.align); CKEDITOR.ui.dialog.uiElement.call(this, a, f || { type: "hbox" }, d, "table", {}, l, function () {
                                var a = ['\x3ctbody\x3e\x3ctr class\x3d"cke_dialog_ui_hbox"\x3e']; for (k = 0; k < c.length; k++) {
                                    var b = "cke_dialog_ui_hbox_child", d = []; 0 === k &&
                                        (b = "cke_dialog_ui_hbox_first"); k == c.length - 1 && (b = "cke_dialog_ui_hbox_last"); a.push('\x3ctd class\x3d"', b, '" role\x3d"presentation" '); g ? g[k] && d.push("width:" + q(g[k])) : d.push("width:" + Math.floor(100 / c.length) + "%"); h && d.push("height:" + q(h)); f && void 0 !== f.padding && d.push("padding:" + q(f.padding)); CKEDITOR.env.ie && CKEDITOR.env.quirks && e[k].align && d.push("text-align:" + e[k].align); 0 < d.length && a.push('style\x3d"' + d.join("; ") + '" '); a.push("\x3e", c[k], "\x3c/td\x3e")
                                } a.push("\x3c/tr\x3e\x3c/tbody\x3e"); return a.join("")
                            })
                        }
                    },
                    vbox: function (a, b, c, d, f) {
                        if (!(3 > arguments.length)) {
                            this._ || (this._ = {}); var e = this._.children = b, g = f && f.width || null, h = f && f.heights || null; CKEDITOR.ui.dialog.uiElement.call(this, a, f || { type: "vbox" }, d, "div", null, { role: "presentation" }, function () {
                                var b = ['\x3ctable role\x3d"presentation" cellspacing\x3d"0" border\x3d"0" ']; b.push('style\x3d"'); f && f.expand && b.push("height:100%;"); b.push("width:" + q(g || "100%"), ";"); CKEDITOR.env.webkit && b.push("float:none;"); b.push('"'); b.push('align\x3d"', CKEDITOR.tools.htmlEncode(f &&
                                    f.align || ("ltr" == a.getParentEditor().lang.dir ? "left" : "right")), '" '); b.push("\x3e\x3ctbody\x3e"); for (var d = 0; d < c.length; d++) {
                                        var k = []; b.push('\x3ctr\x3e\x3ctd role\x3d"presentation" '); g && k.push("width:" + q(g || "100%")); h ? k.push("height:" + q(h[d])) : f && f.expand && k.push("height:" + Math.floor(100 / c.length) + "%"); f && void 0 !== f.padding && k.push("padding:" + q(f.padding)); CKEDITOR.env.ie && CKEDITOR.env.quirks && e[d].align && k.push("text-align:" + e[d].align); 0 < k.length && b.push('style\x3d"', k.join("; "), '" '); b.push(' class\x3d"cke_dialog_ui_vbox_child"\x3e',
                                            c[d], "\x3c/td\x3e\x3c/tr\x3e")
                                    } b.push("\x3c/tbody\x3e\x3c/table\x3e"); return b.join("")
                            })
                        }
                    }
                }
            })(); CKEDITOR.ui.dialog.uiElement.prototype = {
                getElement: function () { return CKEDITOR.document.getById(this.domId) }, getInputElement: function () { return this.getElement() }, getDialog: function () { return this._.dialog }, setValue: function (a, b) { this.getInputElement().setValue(a); !b && this.fire("change", { value: a }); return this }, getValue: function () { return this.getInputElement().getValue() }, isChanged: function () { return !1 }, selectParentTab: function () {
                    for (var a =
                        this.getInputElement(); (a = a.getParent()) && -1 == a.$.className.search("cke_dialog_page_contents");); if (!a) return this; a = a.getAttribute("name"); this._.dialog._.currentTabId != a && this._.dialog.selectPage(a); return this
                }, focus: function () { this.selectParentTab().getInputElement().focus(); return this }, registerEvents: function (a) {
                    var b = /^on([A-Z]\w+)/, c, d = function (a, b, c, d) { b.on("load", function () { a.getInputElement().on(c, d, a) }) }, f; for (f in a) if (c = f.match(b)) this.eventProcessors[f] ? this.eventProcessors[f].call(this,
                        this._.dialog, a[f]) : d(this, this._.dialog, c[1].toLowerCase(), a[f]); return this
                }, eventProcessors: { onLoad: function (a, b) { a.on("load", b, this) }, onShow: function (a, b) { a.on("show", b, this) }, onHide: function (a, b) { a.on("hide", b, this) } }, accessKeyDown: function () { this.focus() }, accessKeyUp: function () { }, disable: function () { var a = this.getElement(); this.getInputElement().setAttribute("disabled", "true"); a.addClass("cke_disabled") }, enable: function () {
                    var a = this.getElement(); this.getInputElement().removeAttribute("disabled");
                    a.removeClass("cke_disabled")
                }, isEnabled: function () { return !this.getElement().hasClass("cke_disabled") }, isVisible: function () { return this.getInputElement().isVisible() }, isFocusable: function () { return this.isEnabled() && this.isVisible() ? !0 : !1 }
            }; CKEDITOR.ui.dialog.hbox.prototype = CKEDITOR.tools.extend(new CKEDITOR.ui.dialog.uiElement, {
                getChild: function (a) {
                    if (1 > arguments.length) return this._.children.concat(); a.splice || (a = [a]); return 2 > a.length ? this._.children[a[0]] : this._.children[a[0]] && this._.children[a[0]].getChild ?
                        this._.children[a[0]].getChild(a.slice(1, a.length)) : null
                }
            }, !0); CKEDITOR.ui.dialog.vbox.prototype = new CKEDITOR.ui.dialog.hbox; (function () { var a = { build: function (a, b, c) { for (var d = b.children, f, e = [], g = [], h = 0; h < d.length && (f = d[h]); h++) { var k = []; e.push(k); g.push(CKEDITOR.dialog._.uiElementBuilders[f.type].build(a, f, k)) } return new CKEDITOR.ui.dialog[b.type](a, g, e, c, b) } }; CKEDITOR.dialog.addUIElement("hbox", a); CKEDITOR.dialog.addUIElement("vbox", a) })(); CKEDITOR.dialogCommand = function (a, b) {
                this.dialogName = a;
                CKEDITOR.tools.extend(this, b, !0)
            }; CKEDITOR.dialogCommand.prototype = { exec: function (a) { a.openDialog(this.dialogName) }, canUndo: !1, editorFocus: 1 }; (function () {
                var a = /^([a]|[^a])+$/, b = /^\d*$/, c = /^\d*(?:\.\d+)?$/, d = /^(((\d*(\.\d+))|(\d*))(px|\%)?)?$/, f = /^(((\d*(\.\d+))|(\d*))(px|em|ex|in|cm|mm|pt|pc|\%)?)?$/i, e = /^(\s*[\w-]+\s*:\s*[^:;]+(?:;|$))*$/; CKEDITOR.VALIDATE_OR = 1; CKEDITOR.VALIDATE_AND = 2; CKEDITOR.dialog.validate = {
                    functions: function () {
                        var a = arguments; return function () {
                            var b = this && this.getValue ? this.getValue() :
                                a[0], c, d = CKEDITOR.VALIDATE_AND, f = [], e; for (e = 0; e < a.length; e++)if ("function" == typeof a[e]) f.push(a[e]); else break; e < a.length && "string" == typeof a[e] && (c = a[e], e++); e < a.length && "number" == typeof a[e] && (d = a[e]); var g = d == CKEDITOR.VALIDATE_AND ? !0 : !1; for (e = 0; e < f.length; e++)g = d == CKEDITOR.VALIDATE_AND ? g && f[e](b) : g || f[e](b); return g ? !0 : c
                        }
                    }, regex: function (a, b) { return function (c) { c = this && this.getValue ? this.getValue() : c; return a.test(c) ? !0 : b } }, notEmpty: function (b) { return this.regex(a, b) }, integer: function (a) {
                        return this.regex(b,
                            a)
                    }, number: function (a) { return this.regex(c, a) }, cssLength: function (a) { return this.functions(function (a) { return f.test(CKEDITOR.tools.trim(a)) }, a) }, htmlLength: function (a) { return this.functions(function (a) { return d.test(CKEDITOR.tools.trim(a)) }, a) }, inlineStyle: function (a) { return this.functions(function (a) { return e.test(CKEDITOR.tools.trim(a)) }, a) }, equals: function (a, b) { return this.functions(function (b) { return b == a }, b) }, notEqual: function (a, b) { return this.functions(function (b) { return b != a }, b) }
                }; CKEDITOR.on("instanceDestroyed",
                    function (a) { if (CKEDITOR.tools.isEmpty(CKEDITOR.instances)) { for (var b; b = CKEDITOR.dialog._.currentTop;)b.hide(); for (var c in C) C[c].remove(); C = {} } a = a.editor._.storedDialogs; for (var d in a) a[d].destroy() })
            })(); CKEDITOR.tools.extend(CKEDITOR.editor.prototype, {
                openDialog: function (a, b) {
                    var c = null, d = CKEDITOR.dialog._.dialogDefinitions[a]; null === CKEDITOR.dialog._.currentTop && v(this); if ("function" == typeof d) c = this._.storedDialogs || (this._.storedDialogs = {}), c = c[a] || (c[a] = new CKEDITOR.dialog(this, a)), b && b.call(c,
                        c), c.show(); else { if ("failed" == d) throw u(this), Error('[CKEDITOR.dialog.openDialog] Dialog "' + a + '" failed when loading definition.'); "string" == typeof d && CKEDITOR.scriptLoader.load(CKEDITOR.getUrl(d), function () { "function" != typeof CKEDITOR.dialog._.dialogDefinitions[a] && (CKEDITOR.dialog._.dialogDefinitions[a] = "failed"); this.openDialog(a, b) }, this, 0, 1) } CKEDITOR.skin.loadPart("dialog"); return c
                }
            })
        }(), CKEDITOR.plugins.add("dialog", {
            requires: "dialogui", init: function (a) {
                a.on("doubleclick", function (e) {
                    e.data.dialog &&
                    a.openDialog(e.data.dialog)
                }, null, null, 999)
            }
        }), function () {
            CKEDITOR.plugins.add("a11yhelp", {
                requires: "dialog", availableLangs: { af: 1, ar: 1, bg: 1, ca: 1, cs: 1, cy: 1, da: 1, de: 1, "de-ch": 1, el: 1, en: 1, "en-gb": 1, eo: 1, es: 1, et: 1, eu: 1, fa: 1, fi: 1, fo: 1, fr: 1, "fr-ca": 1, gl: 1, gu: 1, he: 1, hi: 1, hr: 1, hu: 1, id: 1, it: 1, ja: 1, km: 1, ko: 1, ku: 1, lt: 1, lv: 1, mk: 1, mn: 1, nb: 1, nl: 1, no: 1, pl: 1, pt: 1, "pt-br": 1, ro: 1, ru: 1, si: 1, sk: 1, sl: 1, sq: 1, sr: 1, "sr-latn": 1, sv: 1, th: 1, tr: 1, tt: 1, ug: 1, uk: 1, vi: 1, zh: 1, "zh-cn": 1 }, init: function (a) {
                    var e = this; a.addCommand("a11yHelp",
                        { exec: function () { var b = a.langCode, b = e.availableLangs[b] ? b : e.availableLangs[b.replace(/-.*/, "")] ? b.replace(/-.*/, "") : "en"; CKEDITOR.scriptLoader.load(CKEDITOR.getUrl(e.path + "dialogs/lang/" + b + ".js"), function () { a.lang.a11yhelp = e.langEntries[b]; a.openDialog("a11yHelp") }) }, modes: { wysiwyg: 1, source: 1 }, readOnly: 1, canUndo: !1 }); a.setKeystroke(CKEDITOR.ALT + 48, "a11yHelp"); CKEDITOR.dialog.add("a11yHelp", this.path + "dialogs/a11yhelp.js"); a.on("ariaEditorHelpLabel", function (b) { b.data.label = a.lang.common.editorHelp })
                }
            })
        }(),
        CKEDITOR.plugins.add("about", { requires: "dialog", init: function (a) { var e = a.addCommand("about", new CKEDITOR.dialogCommand("about")); e.modes = { wysiwyg: 1, source: 1 }; e.canUndo = !1; e.readOnly = 1; a.ui.addButton && a.ui.addButton("About", { label: a.lang.about.title, command: "about", toolbar: "about" }); CKEDITOR.dialog.add("about", this.path + "dialogs/about.js") } }), CKEDITOR.plugins.add("basicstyles", {
            init: function (a) {
                var e = 0, b = function (b, d, h, k) {
                    if (k) {
                        k = new CKEDITOR.style(k); var g = c[h]; g.unshift(k); a.attachStyleStateChange(k,
                            function (b) { !a.readOnly && a.getCommand(h).setState(b) }); a.addCommand(h, new CKEDITOR.styleCommand(k, { contentForms: g })); a.ui.addButton && a.ui.addButton(b, { label: d, command: h, toolbar: "basicstyles," + (e += 10) })
                    }
                }, c = {
                    bold: ["strong", "b", ["span", function (a) { a = a.styles["font-weight"]; return "bold" == a || 700 <= +a }]], italic: ["em", "i", ["span", function (a) { return "italic" == a.styles["font-style"] }]], underline: ["u", ["span", function (a) { return "underline" == a.styles["text-decoration"] }]], strike: ["s", "strike", ["span", function (a) {
                        return "line-through" ==
                            a.styles["text-decoration"]
                    }]], subscript: ["sub"], superscript: ["sup"]
                }, d = a.config, k = a.lang.basicstyles; b("Bold", k.bold, "bold", d.coreStyles_bold); b("Italic", k.italic, "italic", d.coreStyles_italic); b("Underline", k.underline, "underline", d.coreStyles_underline); b("Strike", k.strike, "strike", d.coreStyles_strike); b("Subscript", k.subscript, "subscript", d.coreStyles_subscript); b("Superscript", k.superscript, "superscript", d.coreStyles_superscript); a.setKeystroke([[CKEDITOR.CTRL + 66, "bold"], [CKEDITOR.CTRL + 73, "italic"],
                [CKEDITOR.CTRL + 85, "underline"]])
            }
        }), CKEDITOR.config.coreStyles_bold = { element: "strong", overrides: "b" }, CKEDITOR.config.coreStyles_italic = { element: "em", overrides: "i" }, CKEDITOR.config.coreStyles_underline = { element: "u" }, CKEDITOR.config.coreStyles_strike = { element: "s", overrides: "strike" }, CKEDITOR.config.coreStyles_subscript = { element: "sub" }, CKEDITOR.config.coreStyles_superscript = { element: "sup" }, function () {
            var a = {
                exec: function (a) {
                    var b = a.getCommand("blockquote").state, c = a.getSelection(), d = c && c.getRanges()[0];
                    if (d) {
                        var k = c.createBookmarks(); if (CKEDITOR.env.ie) { var m = k[0].startNode, f = k[0].endNode, h; if (m && "blockquote" == m.getParent().getName()) for (h = m; h = h.getNext();)if (h.type == CKEDITOR.NODE_ELEMENT && h.isBlockBoundary()) { m.move(h, !0); break } if (f && "blockquote" == f.getParent().getName()) for (h = f; h = h.getPrevious();)if (h.type == CKEDITOR.NODE_ELEMENT && h.isBlockBoundary()) { f.move(h); break } } var l = d.createIterator(); l.enlargeBr = a.config.enterMode != CKEDITOR.ENTER_BR; if (b == CKEDITOR.TRISTATE_OFF) {
                            for (m = []; b = l.getNextParagraph();)m.push(b);
                            1 > m.length && (b = a.document.createElement(a.config.enterMode == CKEDITOR.ENTER_P ? "p" : "div"), f = k.shift(), d.insertNode(b), b.append(new CKEDITOR.dom.text("ï»¿", a.document)), d.moveToBookmark(f), d.selectNodeContents(b), d.collapse(!0), f = d.createBookmark(), m.push(b), k.unshift(f)); h = m[0].getParent(); d = []; for (f = 0; f < m.length; f++)b = m[f], h = h.getCommonAncestor(b.getParent()); for (b = { table: 1, tbody: 1, tr: 1, ol: 1, ul: 1 }; b[h.getName()];)h = h.getParent(); for (f = null; 0 < m.length;) {
                                for (b = m.shift(); !b.getParent().equals(h);)b = b.getParent();
                                b.equals(f) || d.push(b); f = b
                            } for (; 0 < d.length;)if (b = d.shift(), "blockquote" == b.getName()) { for (f = new CKEDITOR.dom.documentFragment(a.document); b.getFirst();)f.append(b.getFirst().remove()), m.push(f.getLast()); f.replace(b) } else m.push(b); d = a.document.createElement("blockquote"); for (d.insertBefore(m[0]); 0 < m.length;)b = m.shift(), d.append(b)
                        } else if (b == CKEDITOR.TRISTATE_ON) {
                            f = []; for (h = {}; b = l.getNextParagraph();) {
                                for (m = d = null; b.getParent();) {
                                    if ("blockquote" == b.getParent().getName()) { d = b.getParent(); m = b; break } b =
                                        b.getParent()
                                } d && m && !m.getCustomData("blockquote_moveout") && (f.push(m), CKEDITOR.dom.element.setMarker(h, m, "blockquote_moveout", !0))
                            } CKEDITOR.dom.element.clearAllMarkers(h); b = []; m = []; for (h = {}; 0 < f.length;)l = f.shift(), d = l.getParent(), l.getPrevious() ? l.getNext() ? (l.breakParent(l.getParent()), m.push(l.getNext())) : l.remove().insertAfter(d) : l.remove().insertBefore(d), d.getCustomData("blockquote_processed") || (m.push(d), CKEDITOR.dom.element.setMarker(h, d, "blockquote_processed", !0)), b.push(l); CKEDITOR.dom.element.clearAllMarkers(h);
                            for (f = m.length - 1; 0 <= f; f--) { d = m[f]; a: { h = d; for (var l = 0, g = h.getChildCount(), n = void 0; l < g && (n = h.getChild(l)); l++)if (n.type == CKEDITOR.NODE_ELEMENT && n.isBlockBoundary()) { h = !1; break a } h = !0 } h && d.remove() } if (a.config.enterMode == CKEDITOR.ENTER_BR) for (d = !0; b.length;)if (l = b.shift(), "div" == l.getName()) {
                                f = new CKEDITOR.dom.documentFragment(a.document); !d || !l.getPrevious() || l.getPrevious().type == CKEDITOR.NODE_ELEMENT && l.getPrevious().isBlockBoundary() || f.append(a.document.createElement("br")); for (d = l.getNext() &&
                                    !(l.getNext().type == CKEDITOR.NODE_ELEMENT && l.getNext().isBlockBoundary()); l.getFirst();)l.getFirst().remove().appendTo(f); d && f.append(a.document.createElement("br")); f.replace(l); d = !1
                            }
                        } c.selectBookmarks(k); a.focus()
                    }
                }, refresh: function (a, b) { this.setState(a.elementPath(b.block || b.blockLimit).contains("blockquote", 1) ? CKEDITOR.TRISTATE_ON : CKEDITOR.TRISTATE_OFF) }, context: "blockquote", allowedContent: "blockquote", requiredContent: "blockquote"
            }; CKEDITOR.plugins.add("blockquote", {
                init: function (e) {
                    e.blockless ||
                    (e.addCommand("blockquote", a), e.ui.addButton && e.ui.addButton("Blockquote", { label: e.lang.blockquote.toolbar, command: "blockquote", toolbar: "blocks,10" }))
                }
            })
        }(), "use strict", function () {
            function a(a, b, c) { b.type || (b.type = "auto"); if (c && !1 === a.fire("beforePaste", b) || !b.dataValue && b.dataTransfer.isEmpty()) return !1; b.dataValue || (b.dataValue = ""); if (CKEDITOR.env.gecko && "drop" == b.method && a.toolbox) a.once("afterPaste", function () { a.toolbox.focus() }); return a.fire("paste", b) } function e(b) {
                function c() {
                    var a = b.editable();
                    if (CKEDITOR.plugins.clipboard.isCustomCopyCutSupported) { var d = function (a) { b.readOnly && "cut" == a.name || B.initPasteDataTransfer(a, b); a.data.preventDefault() }; a.on("copy", d); a.on("cut", d); a.on("cut", function () { b.readOnly || b.extractSelectedHtml() }, null, null, 999) } a.on(B.mainPasteEvent, function (a) { "beforepaste" == B.mainPasteEvent && D || w(a) }); "beforepaste" == B.mainPasteEvent && (a.on("paste", function (a) { F || (e(), a.data.preventDefault(), w(a), k("paste") || b.openDialog("paste")) }), a.on("contextmenu", h, null, null, 0),
                        a.on("beforepaste", function (a) { !a.data || a.data.$.ctrlKey || a.data.$.shiftKey || h() }, null, null, 0)); a.on("beforecut", function () { !D && l(b) }); var f; a.attachListener(CKEDITOR.env.ie ? a : b.document.getDocumentElement(), "mouseup", function () { f = setTimeout(function () { C() }, 0) }); b.on("destroy", function () { clearTimeout(f) }); a.on("keyup", C)
                } function d(a) {
                    return {
                        type: a, canUndo: "cut" == a, startDisabled: !0, exec: function () {
                            "cut" == this.type && l(); var a; var c = this.type; if (CKEDITOR.env.ie) a = k(c); else try {
                                a = b.document.$.execCommand(c,
                                    !1, null)
                            } catch (d) { a = !1 } a || b.showNotification(b.lang.clipboard[this.type + "Error"]); return a
                        }
                    }
                } function f() { return { canUndo: !1, async: !0, exec: function (b, c) { var d = this, f = function (c, f) { c && a(b, c, !!f); b.fire("afterCommandExec", { name: "paste", command: d, returnValue: !!c }) }; "string" == typeof c ? f({ dataValue: c, method: "paste", dataTransfer: B.initPasteDataTransfer() }, 1) : b.getClipboardData(f) } } } function e() { F = 1; setTimeout(function () { F = 0 }, 100) } function h() { D = 1; setTimeout(function () { D = 0 }, 10) } function k(a) {
                    var c = b.document,
                    d = c.getBody(), f = !1, e = function () { f = !0 }; d.on(a, e); 7 < CKEDITOR.env.version ? c.$.execCommand(a) : c.$.selection.createRange().execCommand(a); d.removeListener(a, e); return f
                } function l() {
                    if (CKEDITOR.env.ie && !CKEDITOR.env.quirks) {
                        var a = b.getSelection(), c, d, f; a.getType() == CKEDITOR.SELECTION_ELEMENT && (c = a.getSelectedElement()) && (d = a.getRanges()[0], f = b.document.createText(""), f.insertBefore(c), d.setStartBefore(f), d.setEndAfter(c), a.selectRanges([d]), setTimeout(function () { c.getParent() && (f.remove(), a.selectElement(c)) },
                            0))
                    }
                } function m(a, c) {
                    var d = b.document, f = b.editable(), e = function (a) { a.cancel() }, h; if (!d.getById("cke_pastebin")) {
                        var k = b.getSelection(), l = k.createBookmarks(); CKEDITOR.env.ie && k.root.fire("selectionchange"); var n = new CKEDITOR.dom.element(!CKEDITOR.env.webkit && !f.is("body") || CKEDITOR.env.ie ? "div" : "body", d); n.setAttributes({ id: "cke_pastebin", "data-cke-temp": "1" }); var p = 0, d = d.getWindow(); CKEDITOR.env.webkit ? (f.append(n), n.addClass("cke_editable"), f.is("body") || (p = "static" != f.getComputedStyle("position") ?
                            f : CKEDITOR.dom.element.get(f.$.offsetParent), p = p.getDocumentPosition().y)) : f.getAscendant(CKEDITOR.env.ie ? "body" : "html", 1).append(n); n.setStyles({ position: "absolute", top: d.getScrollPosition().y - p + 10 + "px", width: "1px", height: Math.max(1, d.getViewPaneSize().height - 20) + "px", overflow: "hidden", margin: 0, padding: 0 }); CKEDITOR.env.safari && n.setStyles(CKEDITOR.tools.cssVendorPrefix("user-select", "text")); (p = n.getParent().isReadOnly()) ? (n.setOpacity(0), n.setAttribute("contenteditable", !0)) : n.setStyle("ltr" == b.config.contentsLangDirection ?
                                "left" : "right", "-10000px"); b.on("selectionChange", e, null, null, 0); if (CKEDITOR.env.webkit || CKEDITOR.env.gecko) h = f.once("blur", e, null, null, -100); p && n.focus(); p = new CKEDITOR.dom.range(n); p.selectNodeContents(n); var q = p.select(); CKEDITOR.env.ie && (h = f.once("blur", function () { b.lockSelection(q) })); var y = CKEDITOR.document.getWindow().getScrollPosition().y; setTimeout(function () {
                                    CKEDITOR.env.webkit && (CKEDITOR.document.getBody().$.scrollTop = y); h && h.removeListener(); CKEDITOR.env.ie && f.focus(); k.selectBookmarks(l);
                                    n.remove(); var a; CKEDITOR.env.webkit && (a = n.getFirst()) && a.is && a.hasClass("Apple-style-span") && (n = a); b.removeListener("selectionChange", e); c(n.getHtml())
                                }, 0)
                    }
                } function z() { if ("paste" == B.mainPasteEvent) return b.fire("beforePaste", { type: "auto", method: "paste" }), !1; b.focus(); e(); var a = b.focusManager; a.lock(); if (b.editable().fire(B.mainPasteEvent) && !k("paste")) return a.unlock(), !1; a.unlock(); return !0 } function r(a) {
                    if ("wysiwyg" == b.mode) switch (a.data.keyCode) {
                        case CKEDITOR.CTRL + 86: case CKEDITOR.SHIFT + 45: a =
                            b.editable(); e(); "paste" == B.mainPasteEvent && a.fire("beforepaste"); break; case CKEDITOR.CTRL + 88: case CKEDITOR.SHIFT + 46: b.fire("saveSnapshot"), setTimeout(function () { b.fire("saveSnapshot") }, 50)
                    }
                } function w(c) {
                    var d = { type: "auto", method: "paste", dataTransfer: B.initPasteDataTransfer(c) }; d.dataTransfer.cacheData(); var f = !1 !== b.fire("beforePaste", d); f && B.canClipboardApiBeTrusted(d.dataTransfer, b) ? (c.data.preventDefault(), setTimeout(function () { a(b, d) }, 0)) : m(c, function (c) {
                        d.dataValue = c.replace(/<span[^>]+data-cke-bookmark[^<]*?<\/span>/ig,
                            ""); f && a(b, d)
                    })
                } function C() { if ("wysiwyg" == b.mode) { var a = x("paste"); b.getCommand("cut").setState(x("cut")); b.getCommand("copy").setState(x("copy")); b.getCommand("paste").setState(a); b.fire("pasteState", a) } } function x(a) { if (E && a in { paste: 1, cut: 1 }) return CKEDITOR.TRISTATE_DISABLED; if ("paste" == a) return CKEDITOR.TRISTATE_OFF; a = b.getSelection(); var c = a.getRanges(); return a.getType() == CKEDITOR.SELECTION_NONE || 1 == c.length && c[0].collapsed ? CKEDITOR.TRISTATE_DISABLED : CKEDITOR.TRISTATE_OFF } var B = CKEDITOR.plugins.clipboard,
                    D = 0, F = 0, E = 0; (function () { b.on("key", r); b.on("contentDom", c); b.on("selectionChange", function (a) { E = a.data.selection.getRanges()[0].checkReadOnly(); C() }); b.contextMenu && b.contextMenu.addListener(function (a, b) { E = b.getRanges()[0].checkReadOnly(); return { cut: x("cut"), copy: x("copy"), paste: x("paste") } }) })(); (function () {
                        function a(c, d, f, e, h) {
                            var k = b.lang.clipboard[d]; b.addCommand(d, f); b.ui.addButton && b.ui.addButton(c, { label: k, command: d, toolbar: "clipboard," + e }); b.addMenuItems && b.addMenuItem(d, {
                                label: k, command: d,
                                group: "clipboard", order: h
                            })
                        } a("Cut", "cut", d("cut"), 10, 1); a("Copy", "copy", d("copy"), 20, 4); a("Paste", "paste", f(), 30, 8)
                    })(); b.getClipboardData = function (a, c) {
                        function d(a) { a.removeListener(); a.cancel(); c(a.data) } function f(a) { a.removeListener(); a.cancel(); l = !0; c({ type: k, dataValue: a.data.dataValue, dataTransfer: a.data.dataTransfer, method: "paste" }) } function e() { this.customTitle = a && a.title } var h = !1, k = "auto", l = !1; c || (c = a, a = null); b.on("paste", d, null, null, 0); b.on("beforePaste", function (a) {
                            a.removeListener();
                            h = !0; k = a.data.type
                        }, null, null, 1E3); !1 === z() && (b.removeListener("paste", d), h && b.fire("pasteDialog", e) ? (b.on("pasteDialogCommit", f), b.on("dialogHide", function (a) { a.removeListener(); a.data.removeListener("pasteDialogCommit", f); setTimeout(function () { l || c(null) }, 10) })) : c(null))
                    }
            } function b(a) {
                if (CKEDITOR.env.webkit) { if (!a.match(/^[^<]*$/g) && !a.match(/^(<div><br( ?\/)?><\/div>|<div>[^<]*<\/div>)*$/gi)) return "html" } else if (CKEDITOR.env.ie) { if (!a.match(/^([^<]|<br( ?\/)?>)*$/gi) && !a.match(/^(<p>([^<]|<br( ?\/)?>)*<\/p>|(\r\n))*$/gi)) return "html" } else if (CKEDITOR.env.gecko) { if (!a.match(/^([^<]|<br( ?\/)?>)*$/gi)) return "html" } else return "html";
                return "htmlifiedtext"
            } function c(a, b) {
                function c(a) { return CKEDITOR.tools.repeat("\x3c/p\x3e\x3cp\x3e", ~~(a / 2)) + (1 == a % 2 ? "\x3cbr\x3e" : "") } b = b.replace(/\s+/g, " ").replace(/> +</g, "\x3e\x3c").replace(/<br ?\/>/gi, "\x3cbr\x3e"); b = b.replace(/<\/?[A-Z]+>/g, function (a) { return a.toLowerCase() }); if (b.match(/^[^<]$/)) return b; CKEDITOR.env.webkit && -1 < b.indexOf("\x3cdiv\x3e") && (b = b.replace(/^(<div>(<br>|)<\/div>)(?!$|(<div>(<br>|)<\/div>))/g, "\x3cbr\x3e").replace(/^(<div>(<br>|)<\/div>){2}(?!$)/g, "\x3cdiv\x3e\x3c/div\x3e"),
                    b.match(/<div>(<br>|)<\/div>/) && (b = "\x3cp\x3e" + b.replace(/(<div>(<br>|)<\/div>)+/g, function (a) { return c(a.split("\x3c/div\x3e\x3cdiv\x3e").length + 1) }) + "\x3c/p\x3e"), b = b.replace(/<\/div><div>/g, "\x3cbr\x3e"), b = b.replace(/<\/?div>/g, "")); CKEDITOR.env.gecko && a.enterMode != CKEDITOR.ENTER_BR && (CKEDITOR.env.gecko && (b = b.replace(/^<br><br>$/, "\x3cbr\x3e")), -1 < b.indexOf("\x3cbr\x3e\x3cbr\x3e") && (b = "\x3cp\x3e" + b.replace(/(<br>){2,}/g, function (a) { return c(a.length / 4) }) + "\x3c/p\x3e")); return m(a, b)
            } function d() {
                function a() {
                    var b =
                        {}, c; for (c in CKEDITOR.dtd) "$" != c.charAt(0) && "div" != c && "span" != c && (b[c] = 1); return b
                } var b = {}; return { get: function (c) { return "plain-text" == c ? b.plainText || (b.plainText = new CKEDITOR.filter("br")) : "semantic-content" == c ? ((c = b.semanticContent) || (c = new CKEDITOR.filter, c.allow({ $1: { elements: a(), attributes: !0, styles: !1, classes: !1 } }), c = b.semanticContent = c), c) : c ? new CKEDITOR.filter(c) : null } }
            } function k(a, b, c) {
                b = CKEDITOR.htmlParser.fragment.fromHtml(b); var d = new CKEDITOR.htmlParser.basicWriter; c.applyTo(b, !0, !1,
                    a.activeEnterMode); b.writeHtml(d); return d.getHtml()
            } function m(a, b) { a.enterMode == CKEDITOR.ENTER_BR ? b = b.replace(/(<\/p><p>)+/g, function (a) { return CKEDITOR.tools.repeat("\x3cbr\x3e", a.length / 7 * 2) }).replace(/<\/?p>/g, "") : a.enterMode == CKEDITOR.ENTER_DIV && (b = b.replace(/<(\/)?p>/g, "\x3c$1div\x3e")); return b } function f(a) { a.data.preventDefault(); a.data.$.dataTransfer.dropEffect = "none" } function h(b) {
                var c = CKEDITOR.plugins.clipboard; b.on("contentDom", function () {
                    function d(c, f, e) {
                        f.select(); a(b, {
                            dataTransfer: e,
                            method: "drop"
                        }, 1); e.sourceEditor.fire("saveSnapshot"); e.sourceEditor.editable().extractHtmlFromRange(c); e.sourceEditor.getSelection().selectRanges([c]); e.sourceEditor.fire("saveSnapshot")
                    } function f(d, e) { d.select(); a(b, { dataTransfer: e, method: "drop" }, 1); c.resetDragDataTransfer() } function e(a, c, d) { var f = { $: a.data.$, target: a.data.getTarget() }; c && (f.dragRange = c); d && (f.dropRange = d); !1 === b.fire(a.name, f) && a.data.preventDefault() } function h(a) { a.type != CKEDITOR.NODE_ELEMENT && (a = a.getParent()); return a.getChildCount() }
                    var k = b.editable(), l = CKEDITOR.plugins.clipboard.getDropTarget(b), m = b.ui.space("top"), z = b.ui.space("bottom"); c.preventDefaultDropOnElement(m); c.preventDefaultDropOnElement(z); k.attachListener(l, "dragstart", e); k.attachListener(b, "dragstart", c.resetDragDataTransfer, c, null, 1); k.attachListener(b, "dragstart", function (a) { c.initDragDataTransfer(a, b) }, null, null, 2); k.attachListener(b, "dragstart", function () {
                        var a = c.dragRange = b.getSelection().getRanges()[0]; CKEDITOR.env.ie && 10 > CKEDITOR.env.version && (c.dragStartContainerChildCount =
                            a ? h(a.startContainer) : null, c.dragEndContainerChildCount = a ? h(a.endContainer) : null)
                    }, null, null, 100); k.attachListener(l, "dragend", e); k.attachListener(b, "dragend", c.initDragDataTransfer, c, null, 1); k.attachListener(b, "dragend", c.resetDragDataTransfer, c, null, 100); k.attachListener(l, "dragover", function (a) { var b = a.data.getTarget(); b && b.is && b.is("html") ? a.data.preventDefault() : CKEDITOR.env.ie && CKEDITOR.plugins.clipboard.isFileApiSupported && a.data.$.dataTransfer.types.contains("Files") && a.data.preventDefault() });
                    k.attachListener(l, "drop", function (a) { if (!a.data.$.defaultPrevented) { a.data.preventDefault(); var d = a.data.getTarget(); if (!d.isReadOnly() || d.type == CKEDITOR.NODE_ELEMENT && d.is("html")) { var d = c.getRangeAtDropPosition(a, b), f = c.dragRange; d && e(a, f, d) } } }, null, null, 9999); k.attachListener(b, "drop", c.initDragDataTransfer, c, null, 1); k.attachListener(b, "drop", function (a) {
                        if (a = a.data) {
                            var e = a.dropRange, h = a.dragRange, k = a.dataTransfer; k.getTransferType(b) == CKEDITOR.DATA_TRANSFER_INTERNAL ? setTimeout(function () {
                                c.internalDrop(h,
                                    e, k, b)
                            }, 0) : k.getTransferType(b) == CKEDITOR.DATA_TRANSFER_CROSS_EDITORS ? d(h, e, k) : f(e, k)
                        }
                    }, null, null, 9999)
                })
            } CKEDITOR.plugins.add("clipboard", {
                requires: "dialog", init: function (a) {
                    var f, l = d(); a.config.forcePasteAsPlainText ? f = "plain-text" : a.config.pasteFilter ? f = a.config.pasteFilter : !CKEDITOR.env.webkit || "pasteFilter" in a.config || (f = "semantic-content"); a.pasteFilter = l.get(f); e(a); h(a); CKEDITOR.dialog.add("paste", CKEDITOR.getUrl(this.path + "dialogs/paste.js")); a.on("paste", function (b) {
                        b.data.dataTransfer ||
                        (b.data.dataTransfer = new CKEDITOR.plugins.clipboard.dataTransfer); if (!b.data.dataValue) { var c = b.data.dataTransfer, d = c.getData("text/html"); if (d) b.data.dataValue = d, b.data.type = "html"; else if (d = c.getData("text/plain")) b.data.dataValue = a.editable().transformPlainTextToHtml(d), b.data.type = "text" }
                    }, null, null, 1); a.on("paste", function (a) {
                        var b = a.data.dataValue, c = CKEDITOR.dtd.$block; -1 < b.indexOf("Apple-") && (b = b.replace(/<span class="Apple-converted-space">&nbsp;<\/span>/gi, " "), "html" != a.data.type && (b = b.replace(/<span class="Apple-tab-span"[^>]*>([^<]*)<\/span>/gi,
                            function (a, b) { return b.replace(/\t/g, "\x26nbsp;\x26nbsp; \x26nbsp;") })), -1 < b.indexOf('\x3cbr class\x3d"Apple-interchange-newline"\x3e') && (a.data.startsWithEOL = 1, a.data.preSniffing = "html", b = b.replace(/<br class="Apple-interchange-newline">/, "")), b = b.replace(/(<[^>]+) class="Apple-[^"]*"/gi, "$1")); if (b.match(/^<[^<]+cke_(editable|contents)/i)) {
                                var d, f, e = new CKEDITOR.dom.element("div"); for (e.setHtml(b); 1 == e.getChildCount() && (d = e.getFirst()) && d.type == CKEDITOR.NODE_ELEMENT && (d.hasClass("cke_editable") ||
                                    d.hasClass("cke_contents"));)e = f = d; f && (b = f.getHtml().replace(/<br>$/i, ""))
                            } CKEDITOR.env.ie ? b = b.replace(/^&nbsp;(?: |\r\n)?<(\w+)/g, function (b, d) { return d.toLowerCase() in c ? (a.data.preSniffing = "html", "\x3c" + d) : b }) : CKEDITOR.env.webkit ? b = b.replace(/<\/(\w+)><div><br><\/div>$/, function (b, d) { return d in c ? (a.data.endsWithEOL = 1, "\x3c/" + d + "\x3e") : b }) : CKEDITOR.env.gecko && (b = b.replace(/(\s)<br>$/, "$1")); a.data.dataValue = b
                    }, null, null, 3); a.on("paste", function (d) {
                        d = d.data; var f = d.type, e = d.dataValue, h, m = a.config.clipboard_defaultContentType ||
                            "html", n = d.dataTransfer.getTransferType(a); h = "html" == f || "html" == d.preSniffing ? "html" : b(e); "htmlifiedtext" == h && (e = c(a.config, e)); "text" == f && "html" == h ? e = k(a, e, l.get("plain-text")) : n == CKEDITOR.DATA_TRANSFER_EXTERNAL && a.pasteFilter && !d.dontFilter && (e = k(a, e, a.pasteFilter)); d.startsWithEOL && (e = '\x3cbr data-cke-eol\x3d"1"\x3e' + e); d.endsWithEOL && (e += '\x3cbr data-cke-eol\x3d"1"\x3e'); "auto" == f && (f = "html" == h || "html" == m ? "html" : "text"); d.type = f; d.dataValue = e; delete d.preSniffing; delete d.startsWithEOL; delete d.endsWithEOL
                    },
                        null, null, 6); a.on("paste", function (b) { b = b.data; b.dataValue && (a.insertHtml(b.dataValue, b.type, b.range), setTimeout(function () { a.fire("afterPaste") }, 0)) }, null, null, 1E3); a.on("pasteDialog", function (b) { setTimeout(function () { a.openDialog("paste", b.data) }, 0) })
                }
            }); CKEDITOR.plugins.clipboard = {
                isCustomCopyCutSupported: !CKEDITOR.env.ie && !CKEDITOR.env.iOS, isCustomDataTypesSupported: !CKEDITOR.env.ie, isFileApiSupported: !CKEDITOR.env.ie || 9 < CKEDITOR.env.version, mainPasteEvent: CKEDITOR.env.ie && !CKEDITOR.env.edge ?
                    "beforepaste" : "paste", canClipboardApiBeTrusted: function (a, b) { return a.getTransferType(b) != CKEDITOR.DATA_TRANSFER_EXTERNAL || CKEDITOR.env.chrome && !a.isEmpty() || CKEDITOR.env.gecko && (a.getData("text/html") || a.getFilesCount()) ? !0 : !1 }, getDropTarget: function (a) { var b = a.editable(); return CKEDITOR.env.ie && 9 > CKEDITOR.env.version || b.isInline() ? b : a.document }, fixSplitNodesAfterDrop: function (a, b, c, d) {
                        function f(a, c, d) {
                            var e = a; e.type == CKEDITOR.NODE_TEXT && (e = a.getParent()); if (e.equals(c) && d != c.getChildCount()) return a =
                                b.startContainer.getChild(b.startOffset - 1), c = b.startContainer.getChild(b.startOffset), a && a.type == CKEDITOR.NODE_TEXT && c && c.type == CKEDITOR.NODE_TEXT && (d = a.getLength(), a.setText(a.getText() + c.getText()), c.remove(), b.setStart(a, d), b.collapse(!0)), !0
                        } var e = b.startContainer; "number" == typeof d && "number" == typeof c && e.type == CKEDITOR.NODE_ELEMENT && (f(a.startContainer, e, c) || f(a.endContainer, e, d))
                    }, isDropRangeAffectedByDragRange: function (a, b) {
                        var c = b.startContainer, d = b.endOffset; return a.endContainer.equals(c) &&
                            a.endOffset <= d || a.startContainer.getParent().equals(c) && a.startContainer.getIndex() < d || a.endContainer.getParent().equals(c) && a.endContainer.getIndex() < d ? !0 : !1
                    }, internalDrop: function (b, c, d, f) {
                        var e = CKEDITOR.plugins.clipboard, h = f.editable(), k, l; f.fire("saveSnapshot"); f.fire("lockSnapshot", { dontUpdate: 1 }); CKEDITOR.env.ie && 10 > CKEDITOR.env.version && this.fixSplitNodesAfterDrop(b, c, e.dragStartContainerChildCount, e.dragEndContainerChildCount); (l = this.isDropRangeAffectedByDragRange(b, c)) || (k = b.createBookmark(!1));
                        e = c.clone().createBookmark(!1); l && (k = b.createBookmark(!1)); b = k.startNode; c = k.endNode; l = e.startNode; c && b.getPosition(l) & CKEDITOR.POSITION_PRECEDING && c.getPosition(l) & CKEDITOR.POSITION_FOLLOWING && l.insertBefore(b); b = f.createRange(); b.moveToBookmark(k); h.extractHtmlFromRange(b, 1); c = f.createRange(); c.moveToBookmark(e); a(f, { dataTransfer: d, method: "drop", range: c }, 1); f.fire("unlockSnapshot")
                    }, getRangeAtDropPosition: function (a, b) {
                        var c = a.data.$, d = c.clientX, f = c.clientY, e = b.getSelection(!0).getRanges()[0], h =
                            b.createRange(); if (a.data.testRange) return a.data.testRange; if (document.caretRangeFromPoint) c = b.document.$.caretRangeFromPoint(d, f), h.setStart(CKEDITOR.dom.node(c.startContainer), c.startOffset), h.collapse(!0); else if (c.rangeParent) h.setStart(CKEDITOR.dom.node(c.rangeParent), c.rangeOffset), h.collapse(!0); else {
                                if (CKEDITOR.env.ie && 8 < CKEDITOR.env.version && e && b.editable().hasFocus) return e; if (document.body.createTextRange) {
                                    b.focus(); c = b.document.getBody().$.createTextRange(); try {
                                        for (var k = !1, l = 0; 20 > l &&
                                            !k; l++) { if (!k) try { c.moveToPoint(d, f - l), k = !0 } catch (m) { } if (!k) try { c.moveToPoint(d, f + l), k = !0 } catch (r) { } } if (k) { var w = "cke-temp-" + (new Date).getTime(); c.pasteHTML('\x3cspan id\x3d"' + w + '"\x3eâ€‹\x3c/span\x3e'); var C = b.document.getById(w); h.moveToPosition(C, CKEDITOR.POSITION_BEFORE_START); C.remove() } else {
                                                var x = b.document.$.elementFromPoint(d, f), B = new CKEDITOR.dom.element(x), D; if (B.equals(b.editable()) || "html" == B.getName()) return e && e.startContainer && !e.startContainer.equals(b.editable()) ? e : null; D = B.getClientRect();
                                                d < D.left ? h.setStartAt(B, CKEDITOR.POSITION_AFTER_START) : h.setStartAt(B, CKEDITOR.POSITION_BEFORE_END); h.collapse(!0)
                                            }
                                    } catch (F) { return null }
                                } else return null
                            } return h
                    }, initDragDataTransfer: function (a, b) { var c = a.data.$ ? a.data.$.dataTransfer : null, d = new this.dataTransfer(c, b); c ? this.dragData && d.id == this.dragData.id ? d = this.dragData : this.dragData = d : this.dragData ? d = this.dragData : this.dragData = d; a.data.dataTransfer = d }, resetDragDataTransfer: function () { this.dragData = null }, initPasteDataTransfer: function (a, b) {
                        if (this.isCustomCopyCutSupported &&
                            a && a.data && a.data.$) { var c = new this.dataTransfer(a.data.$.clipboardData, b); this.copyCutData && c.id == this.copyCutData.id ? (c = this.copyCutData, c.$ = a.data.$.clipboardData) : this.copyCutData = c; return c } return new this.dataTransfer(null, b)
                    }, preventDefaultDropOnElement: function (a) { a && a.on("dragover", f) }
            }; var l = CKEDITOR.plugins.clipboard.isCustomDataTypesSupported ? "cke/id" : "Text"; CKEDITOR.plugins.clipboard.dataTransfer = function (a, b) {
                a && (this.$ = a); this._ = {
                    metaRegExp: /^<meta.*?>/i, bodyRegExp: /<body(?:[\s\S]*?)>([\s\S]*)<\/body>/i,
                    fragmentRegExp: /\x3c!--(?:Start|End)Fragment--\x3e/g, data: {}, files: [], normalizeType: function (a) { a = a.toLowerCase(); return "text" == a || "text/plain" == a ? "Text" : "url" == a ? "URL" : a }
                }; this.id = this.getData(l); this.id || (this.id = "Text" == l ? "" : "cke-" + CKEDITOR.tools.getUniqueId()); if ("Text" != l) try { this.$.setData(l, this.id) } catch (c) { } b && (this.sourceEditor = b, this.setData("text/html", b.getSelectedHtml(1)), "Text" == l || this.getData("text/plain") || this.setData("text/plain", b.getSelection().getSelectedText()))
            }; CKEDITOR.DATA_TRANSFER_INTERNAL =
                1; CKEDITOR.DATA_TRANSFER_CROSS_EDITORS = 2; CKEDITOR.DATA_TRANSFER_EXTERNAL = 3; CKEDITOR.plugins.clipboard.dataTransfer.prototype = {
                    getData: function (a) {
                        a = this._.normalizeType(a); var b = this._.data[a]; if (void 0 === b || null === b || "" === b) try { b = this.$.getData(a) } catch (c) { } if (void 0 === b || null === b || "" === b) b = ""; "text/html" == a ? (b = b.replace(this._.metaRegExp, ""), (a = this._.bodyRegExp.exec(b)) && a.length && (b = a[1], b = b.replace(this._.fragmentRegExp, ""))) : "Text" == a && CKEDITOR.env.gecko && this.getFilesCount() && "file://" == b.substring(0,
                            7) && (b = ""); return b
                    }, setData: function (a, b) { a = this._.normalizeType(a); this._.data[a] = b; if (CKEDITOR.plugins.clipboard.isCustomDataTypesSupported || "URL" == a || "Text" == a) { "Text" == l && "Text" == a && (this.id = b); try { this.$.setData(a, b) } catch (c) { } } }, getTransferType: function (a) { return this.sourceEditor ? this.sourceEditor == a ? CKEDITOR.DATA_TRANSFER_INTERNAL : CKEDITOR.DATA_TRANSFER_CROSS_EDITORS : CKEDITOR.DATA_TRANSFER_EXTERNAL }, cacheData: function () {
                        function a(c) {
                            c = b._.normalizeType(c); var d = b.getData(c); d && (b._.data[c] =
                                d)
                        } if (this.$) { var b = this, c, d; if (CKEDITOR.plugins.clipboard.isCustomDataTypesSupported) { if (this.$.types) for (c = 0; c < this.$.types.length; c++)a(this.$.types[c]) } else a("Text"), a("URL"); d = this._getImageFromClipboard(); if (this.$ && this.$.files || d) { this._.files = []; for (c = 0; c < this.$.files.length; c++)this._.files.push(this.$.files[c]); 0 === this._.files.length && d && this._.files.push(d) } }
                    }, getFilesCount: function () {
                        return this._.files.length ? this._.files.length : this.$ && this.$.files && this.$.files.length ? this.$.files.length :
                            this._getImageFromClipboard() ? 1 : 0
                    }, getFile: function (a) { return this._.files.length ? this._.files[a] : this.$ && this.$.files && this.$.files.length ? this.$.files[a] : 0 === a ? this._getImageFromClipboard() : void 0 }, isEmpty: function () {
                        var a = {}, b; if (this.getFilesCount()) return !1; for (b in this._.data) a[b] = 1; if (this.$) if (CKEDITOR.plugins.clipboard.isCustomDataTypesSupported) { if (this.$.types) for (var c = 0; c < this.$.types.length; c++)a[this.$.types[c]] = 1 } else a.Text = 1, a.URL = 1; "Text" != l && (a[l] = 0); for (b in a) if (a[b] && "" !==
                            this.getData(b)) return !1; return !0
                    }, _getImageFromClipboard: function () { var a; if (this.$ && this.$.items && this.$.items[0]) try { if ((a = this.$.items[0].getAsFile()) && a.type) return a } catch (b) { } }
                }
        }(), function () {
            CKEDITOR.plugins.add("panel", { beforeInit: function (a) { a.ui.addHandler(CKEDITOR.UI_PANEL, CKEDITOR.ui.panel.handler) } }); CKEDITOR.UI_PANEL = "panel"; CKEDITOR.ui.panel = function (a, b) {
                b && CKEDITOR.tools.extend(this, b); CKEDITOR.tools.extend(this, { className: "", css: [] }); this.id = CKEDITOR.tools.getNextId(); this.document =
                    a; this.isFramed = this.forceIFrame || this.css.length; this._ = { blocks: {} }
            }; CKEDITOR.ui.panel.handler = { create: function (a) { return new CKEDITOR.ui.panel(a) } }; var a = CKEDITOR.addTemplate("panel", '\x3cdiv lang\x3d"{langCode}" id\x3d"{id}" dir\x3d{dir} class\x3d"cke cke_reset_all {editorId} cke_panel cke_panel {cls} cke_{dir}" style\x3d"z-index:{z-index}" role\x3d"presentation"\x3e{frame}\x3c/div\x3e'), e = CKEDITOR.addTemplate("panel-frame", '\x3ciframe id\x3d"{id}" class\x3d"cke_panel_frame" role\x3d"presentation" frameborder\x3d"0" src\x3d"{src}"\x3e\x3c/iframe\x3e'),
                b = CKEDITOR.addTemplate("panel-frame-inner", '\x3c!DOCTYPE html\x3e\x3chtml class\x3d"cke_panel_container {env}" dir\x3d"{dir}" lang\x3d"{langCode}"\x3e\x3chead\x3e{css}\x3c/head\x3e\x3cbody class\x3d"cke_{dir}" style\x3d"margin:0;padding:0" onload\x3d"{onload}"\x3e\x3c/body\x3e\x3c/html\x3e'); CKEDITOR.ui.panel.prototype = {
                    render: function (c, d) {
                        this.getHolderElement = function () {
                            var a = this._.holder; if (!a) {
                                if (this.isFramed) {
                                    var a = this.document.getById(this.id + "_frame"), c = a.getParent(), a = a.getFrameDocument();
                                    CKEDITOR.env.iOS && c.setStyles({ overflow: "scroll", "-webkit-overflow-scrolling": "touch" }); c = CKEDITOR.tools.addFunction(CKEDITOR.tools.bind(function () { this.isLoaded = !0; if (this.onLoad) this.onLoad() }, this)); a.write(b.output(CKEDITOR.tools.extend({ css: CKEDITOR.tools.buildStyleHtml(this.css), onload: "window.parent.CKEDITOR.tools.callFunction(" + c + ");" }, k))); a.getWindow().$.CKEDITOR = CKEDITOR; a.on("keydown", function (a) {
                                        var b = a.data.getKeystroke(), c = this.document.getById(this.id).getAttribute("dir"); this._.onKeyDown &&
                                            !1 === this._.onKeyDown(b) ? a.data.preventDefault() : (27 == b || b == ("rtl" == c ? 39 : 37)) && this.onEscape && !1 === this.onEscape(b) && a.data.preventDefault()
                                    }, this); a = a.getBody(); a.unselectable(); CKEDITOR.env.air && CKEDITOR.tools.callFunction(c)
                                } else a = this.document.getById(this.id); this._.holder = a
                            } return a
                        }; var k = { editorId: c.id, id: this.id, langCode: c.langCode, dir: c.lang.dir, cls: this.className, frame: "", env: CKEDITOR.env.cssClass, "z-index": c.config.baseFloatZIndex + 1 }; if (this.isFramed) {
                            var m = CKEDITOR.env.air ? "javascript:void(0)" :
                                CKEDITOR.env.ie ? "javascript:void(function(){" + encodeURIComponent("document.open();(" + CKEDITOR.tools.fixDomain + ")();document.close();") + "}())" : ""; k.frame = e.output({ id: this.id + "_frame", src: m })
                        } m = a.output(k); d && d.push(m); return m
                    }, addBlock: function (a, b) { b = this._.blocks[a] = b instanceof CKEDITOR.ui.panel.block ? b : new CKEDITOR.ui.panel.block(this.getHolderElement(), b); this._.currentBlock || this.showBlock(a); return b }, getBlock: function (a) { return this._.blocks[a] }, showBlock: function (a) {
                        a = this._.blocks[a]; var b =
                            this._.currentBlock, e = !this.forceIFrame || CKEDITOR.env.ie ? this._.holder : this.document.getById(this.id + "_frame"); b && b.hide(); this._.currentBlock = a; CKEDITOR.fire("ariaWidget", e); a._.focusIndex = -1; this._.onKeyDown = a.onKeyDown && CKEDITOR.tools.bind(a.onKeyDown, a); a.show(); return a
                    }, destroy: function () { this.element && this.element.remove() }
                }; CKEDITOR.ui.panel.block = CKEDITOR.tools.createClass({
                    $: function (a, b) {
                        this.element = a.append(a.getDocument().createElement("div", {
                            attributes: { tabindex: -1, "class": "cke_panel_block" },
                            styles: { display: "none" }
                        })); b && CKEDITOR.tools.extend(this, b); this.element.setAttributes({ role: this.attributes.role || "presentation", "aria-label": this.attributes["aria-label"], title: this.attributes.title || this.attributes["aria-label"] }); this.keys = {}; this._.focusIndex = -1; this.element.disableContextMenu()
                    }, _: { markItem: function (a) { -1 != a && (a = this.element.getElementsByTag("a").getItem(this._.focusIndex = a), CKEDITOR.env.webkit && a.getDocument().getWindow().focus(), a.focus(), this.onMark && this.onMark(a)) } }, proto: {
                        show: function () {
                            this.element.setStyle("display",
                                "")
                        }, hide: function () { this.onHide && !0 === this.onHide.call(this) || this.element.setStyle("display", "none") }, onKeyDown: function (a, b) {
                            var e = this.keys[a]; switch (e) {
                                case "next": for (var m = this._.focusIndex, e = this.element.getElementsByTag("a"), f; f = e.getItem(++m);)if (f.getAttribute("_cke_focus") && f.$.offsetWidth) { this._.focusIndex = m; f.focus(); break } return f || b ? !1 : (this._.focusIndex = -1, this.onKeyDown(a, 1)); case "prev": m = this._.focusIndex; for (e = this.element.getElementsByTag("a"); 0 < m && (f = e.getItem(--m));) {
                                    if (f.getAttribute("_cke_focus") &&
                                        f.$.offsetWidth) { this._.focusIndex = m; f.focus(); break } f = null
                                } return f || b ? !1 : (this._.focusIndex = e.count(), this.onKeyDown(a, 1)); case "click": case "mouseup": return m = this._.focusIndex, (f = 0 <= m && this.element.getElementsByTag("a").getItem(m)) && (f.$[e] ? f.$[e]() : f.$["on" + e]()), !1
                            }return !0
                        }
                    }
                })
        }(), CKEDITOR.plugins.add("floatpanel", { requires: "panel" }), function () {
            function a(a, c, d, k, m) {
                m = CKEDITOR.tools.genKey(c.getUniqueId(), d.getUniqueId(), a.lang.dir, a.uiColor || "", k.css || "", m || ""); var f = e[m]; f || (f = e[m] = new CKEDITOR.ui.panel(c,
                    k), f.element = d.append(CKEDITOR.dom.element.createFromHtml(f.render(a), c)), f.element.setStyles({ display: "none", position: "absolute" })); return f
            } var e = {}; CKEDITOR.ui.floatPanel = CKEDITOR.tools.createClass({
                $: function (b, c, d, e) {
                    function m() { g.hide() } d.forceIFrame = 1; d.toolbarRelated && b.elementMode == CKEDITOR.ELEMENT_MODE_INLINE && (c = CKEDITOR.document.getById("cke_" + b.name)); var f = c.getDocument(); e = a(b, f, c, d, e || 0); var h = e.element, l = h.getFirst(), g = this; h.disableContextMenu(); this.element = h; this._ = {
                        editor: b,
                        panel: e, parentElement: c, definition: d, document: f, iframe: l, children: [], dir: b.lang.dir, showBlockParams: null
                    }; b.on("mode", m); b.on("resize", m); f.getWindow().on("resize", function () { this.reposition() }, this)
                }, proto: {
                    addBlock: function (a, c) { return this._.panel.addBlock(a, c) }, addListBlock: function (a, c) { return this._.panel.addListBlock(a, c) }, getBlock: function (a) { return this._.panel.getBlock(a) }, showBlock: function (a, c, d, e, m, f) {
                        var h = this._.panel, l = h.showBlock(a); this._.showBlockParams = [].slice.call(arguments);
                        this.allowBlur(!1); var g = this._.editor.editable(); this._.returnFocus = g.hasFocus ? g : new CKEDITOR.dom.element(CKEDITOR.document.$.activeElement); this._.hideTimeout = 0; var n = this.element, g = this._.iframe, g = CKEDITOR.env.ie && !CKEDITOR.env.edge ? g : new CKEDITOR.dom.window(g.$.contentWindow), v = n.getDocument(), u = this._.parentElement.getPositionedAncestor(), q = c.getDocumentPosition(v), v = u ? u.getDocumentPosition(v) : { x: 0, y: 0 }, t = "rtl" == this._.dir, p = q.x + (e || 0) - v.x, y = q.y + (m || 0) - v.y; !t || 1 != d && 4 != d ? t || 2 != d && 3 != d || (p += c.$.offsetWidth -
                            1) : p += c.$.offsetWidth; if (3 == d || 4 == d) y += c.$.offsetHeight - 1; this._.panel._.offsetParentId = c.getId(); n.setStyles({ top: y + "px", left: 0, display: "" }); n.setOpacity(0); n.getFirst().removeStyle("width"); this._.editor.focusManager.add(g); this._.blurSet || (CKEDITOR.event.useCapture = !0, g.on("blur", function (a) {
                                function b() { delete this._.returnFocus; this.hide() } this.allowBlur() && a.data.getPhase() == CKEDITOR.EVENT_PHASE_AT_TARGET && this.visible && !this._.activeChild && (CKEDITOR.env.iOS ? this._.hideTimeout || (this._.hideTimeout =
                                    CKEDITOR.tools.setTimeout(b, 0, this)) : b.call(this))
                            }, this), g.on("focus", function () { this._.focused = !0; this.hideChild(); this.allowBlur(!0) }, this), CKEDITOR.env.iOS && (g.on("touchstart", function () { clearTimeout(this._.hideTimeout) }, this), g.on("touchend", function () { this._.hideTimeout = 0; this.focus() }, this)), CKEDITOR.event.useCapture = !1, this._.blurSet = 1); h.onEscape = CKEDITOR.tools.bind(function (a) { if (this.onEscape && !1 === this.onEscape(a)) return !1 }, this); CKEDITOR.tools.setTimeout(function () {
                                var a = CKEDITOR.tools.bind(function () {
                                    var a =
                                        n; a.removeStyle("width"); if (l.autoSize) { var b = l.element.getDocument(), b = (CKEDITOR.env.webkit || CKEDITOR.env.edge ? l.element : b.getBody()).$.scrollWidth; CKEDITOR.env.ie && CKEDITOR.env.quirks && 0 < b && (b += (a.$.offsetWidth || 0) - (a.$.clientWidth || 0) + 3); a.setStyle("width", b + 10 + "px"); b = l.element.$.scrollHeight; CKEDITOR.env.ie && CKEDITOR.env.quirks && 0 < b && (b += (a.$.offsetHeight || 0) - (a.$.clientHeight || 0) + 3); a.setStyle("height", b + "px"); h._.currentBlock.element.setStyle("display", "none").removeStyle("display") } else a.removeStyle("height");
                                    t && (p -= n.$.offsetWidth); n.setStyle("left", p + "px"); var b = h.element.getWindow(), a = n.$.getBoundingClientRect(), b = b.getViewPaneSize(), c = a.width || a.right - a.left, d = a.height || a.bottom - a.top, e = t ? a.right : b.width - a.left, g = t ? b.width - a.right : a.left; t ? e < c && (p = g > c ? p + c : b.width > c ? p - a.left : p - a.right + b.width) : e < c && (p = g > c ? p - c : b.width > c ? p - a.right + b.width : p - a.left); c = a.top; b.height - a.top < d && (y = c > d ? y - d : b.height > d ? y - a.bottom + b.height : y - a.top); CKEDITOR.env.ie && (b = a = new CKEDITOR.dom.element(n.$.offsetParent), "html" == b.getName() &&
                                        (b = b.getDocument().getBody()), "rtl" == b.getComputedStyle("direction") && (p = CKEDITOR.env.ie8Compat ? p - 2 * n.getDocument().getDocumentElement().$.scrollLeft : p - (a.$.scrollWidth - a.$.clientWidth))); var a = n.getFirst(), k; (k = a.getCustomData("activePanel")) && k.onHide && k.onHide.call(this, 1); a.setCustomData("activePanel", this); n.setStyles({ top: y + "px", left: p + "px" }); n.setOpacity(1); f && f()
                                }, this); h.isLoaded ? a() : h.onLoad = a; CKEDITOR.tools.setTimeout(function () {
                                    var a = CKEDITOR.env.webkit && CKEDITOR.document.getWindow().getScrollPosition().y;
                                    this.focus(); l.element.focus(); CKEDITOR.env.webkit && (CKEDITOR.document.getBody().$.scrollTop = a); this.allowBlur(!0); this._.editor.fire("panelShow", this)
                                }, 0, this)
                            }, CKEDITOR.env.air ? 200 : 0, this); this.visible = 1; this.onShow && this.onShow.call(this)
                    }, reposition: function () { var a = this._.showBlockParams; this.visible && this._.showBlockParams && (this.hide(), this.showBlock.apply(this, a)) }, focus: function () {
                        if (CKEDITOR.env.webkit) { var a = CKEDITOR.document.getActive(); a && !a.equals(this._.iframe) && a.$.blur() } (this._.lastFocused ||
                            this._.iframe.getFrameDocument().getWindow()).focus()
                    }, blur: function () { var a = this._.iframe.getFrameDocument().getActive(); a && a.is("a") && (this._.lastFocused = a) }, hide: function (a) {
                        if (this.visible && (!this.onHide || !0 !== this.onHide.call(this))) {
                            this.hideChild(); CKEDITOR.env.gecko && this._.iframe.getFrameDocument().$.activeElement.blur(); this.element.setStyle("display", "none"); this.visible = 0; this.element.getFirst().removeCustomData("activePanel"); if (a = a && this._.returnFocus) CKEDITOR.env.webkit && a.type && a.getWindow().$.focus(),
                                a.focus(); delete this._.lastFocused; this._.showBlockParams = null; this._.editor.fire("panelHide", this)
                        }
                    }, allowBlur: function (a) { var c = this._.panel; void 0 !== a && (c.allowBlur = a); return c.allowBlur }, showAsChild: function (a, c, d, e, m, f) {
                        if (this._.activeChild != a || a._.panel._.offsetParentId != d.getId()) this.hideChild(), a.onHide = CKEDITOR.tools.bind(function () { CKEDITOR.tools.setTimeout(function () { this._.focused || this.hide() }, 0, this) }, this), this._.activeChild = a, this._.focused = !1, a.showBlock(c, d, e, m, f), this.blur(),
                            (CKEDITOR.env.ie7Compat || CKEDITOR.env.ie6Compat) && setTimeout(function () { a.element.getChild(0).$.style.cssText += "" }, 100)
                    }, hideChild: function (a) { var c = this._.activeChild; c && (delete c.onHide, delete this._.activeChild, c.hide(), a && this.focus()) }
                }
            }); CKEDITOR.on("instanceDestroyed", function () { var a = CKEDITOR.tools.isEmpty(CKEDITOR.instances), c; for (c in e) { var d = e[c]; a ? d.destroy() : d.element.hide() } a && (e = {}) })
        }(), CKEDITOR.plugins.add("menu", {
            requires: "floatpanel", beforeInit: function (a) {
                for (var e = a.config.menu_groups.split(","),
                    b = a._.menuGroups = {}, c = a._.menuItems = {}, d = 0; d < e.length; d++)b[e[d]] = d + 1; a.addMenuGroup = function (a, c) { b[a] = c || 100 }; a.addMenuItem = function (a, d) { b[d.group] && (c[a] = new CKEDITOR.menuItem(this, a, d)) }; a.addMenuItems = function (a) { for (var b in a) this.addMenuItem(b, a[b]) }; a.getMenuItem = function (a) { return c[a] }; a.removeMenuItem = function (a) { delete c[a] }
            }
        }), function () {
            function a(a) { a.sort(function (a, b) { return a.group < b.group ? -1 : a.group > b.group ? 1 : a.order < b.order ? -1 : a.order > b.order ? 1 : 0 }) } var e = '\x3cspan class\x3d"cke_menuitem"\x3e\x3ca id\x3d"{id}" class\x3d"cke_menubutton cke_menubutton__{name} cke_menubutton_{state} {cls}" href\x3d"{href}" title\x3d"{title}" tabindex\x3d"-1"_cke_focus\x3d1 hidefocus\x3d"true" role\x3d"{role}" aria-haspopup\x3d"{hasPopup}" aria-disabled\x3d"{disabled}" {ariaChecked}';
            CKEDITOR.env.gecko && CKEDITOR.env.mac && (e += ' onkeypress\x3d"return false;"'); CKEDITOR.env.gecko && (e += ' onblur\x3d"this.style.cssText \x3d this.style.cssText;"'); var e = e + (' onmouseover\x3d"CKEDITOR.tools.callFunction({hoverFn},{index});" onmouseout\x3d"CKEDITOR.tools.callFunction({moveOutFn},{index});" ' + (CKEDITOR.env.ie ? 'onclick\x3d"return false;" onmouseup' : "onclick") + '\x3d"CKEDITOR.tools.callFunction({clickFn},{index}); return false;"\x3e'), b = CKEDITOR.addTemplate("menuItem", e + '\x3cspan class\x3d"cke_menubutton_inner"\x3e\x3cspan class\x3d"cke_menubutton_icon"\x3e\x3cspan class\x3d"cke_button_icon cke_button__{iconName}_icon" style\x3d"{iconStyle}"\x3e\x3c/span\x3e\x3c/span\x3e\x3cspan class\x3d"cke_menubutton_label"\x3e{label}\x3c/span\x3e{arrowHtml}\x3c/span\x3e\x3c/a\x3e\x3c/span\x3e'),
                c = CKEDITOR.addTemplate("menuArrow", '\x3cspan class\x3d"cke_menuarrow"\x3e\x3cspan\x3e{label}\x3c/span\x3e\x3c/span\x3e'); CKEDITOR.menu = CKEDITOR.tools.createClass({
                    $: function (a, b) {
                        b = this._.definition = b || {}; this.id = CKEDITOR.tools.getNextId(); this.editor = a; this.items = []; this._.listeners = []; this._.level = b.level || 1; var c = CKEDITOR.tools.extend({}, b.panel, { css: [CKEDITOR.skin.getPath("editor")], level: this._.level - 1, block: {} }), f = c.block.attributes = c.attributes || {}; !f.role && (f.role = "menu"); this._.panelDefinition =
                            c
                    }, _: {
                        onShow: function () { var a = this.editor.getSelection(), b = a && a.getStartElement(), c = this.editor.elementPath(), f = this._.listeners; this.removeAll(); for (var e = 0; e < f.length; e++) { var l = f[e](b, a, c); if (l) for (var g in l) { var n = this.editor.getMenuItem(g); !n || n.command && !this.editor.getCommand(n.command).state || (n.state = l[g], this.add(n)) } } }, onClick: function (a) { this.hide(); if (a.onClick) a.onClick(); else a.command && this.editor.execCommand(a.command) }, onEscape: function (a) {
                            var b = this.parent; b ? b._.panel.hideChild(1) :
                                27 == a && this.hide(1); return !1
                        }, onHide: function () { this.onHide && this.onHide() }, showSubMenu: function (a) {
                            var b = this._.subMenu, c = this.items[a]; if (c = c.getItems && c.getItems()) {
                                b ? b.removeAll() : (b = this._.subMenu = new CKEDITOR.menu(this.editor, CKEDITOR.tools.extend({}, this._.definition, { level: this._.level + 1 }, !0)), b.parent = this, b._.onClick = CKEDITOR.tools.bind(this._.onClick, this)); for (var f in c) { var e = this.editor.getMenuItem(f); e && (e.state = c[f], b.add(e)) } var l = this._.panel.getBlock(this.id).element.getDocument().getById(this.id +
                                    String(a)); setTimeout(function () { b.show(l, 2) }, 0)
                            } else this._.panel.hideChild(1)
                        }
                    }, proto: {
                        add: function (a) { a.order || (a.order = this.items.length); this.items.push(a) }, removeAll: function () { this.items = [] }, show: function (b, c, e, f) {
                            if (!this.parent && (this._.onShow(), !this.items.length)) return; c = c || ("rtl" == this.editor.lang.dir ? 2 : 1); var h = this.items, l = this.editor, g = this._.panel, n = this._.element; if (!g) {
                                g = this._.panel = new CKEDITOR.ui.floatPanel(this.editor, CKEDITOR.document.getBody(), this._.panelDefinition, this._.level);
                                g.onEscape = CKEDITOR.tools.bind(function (a) { if (!1 === this._.onEscape(a)) return !1 }, this); g.onShow = function () { g._.panel.getHolderElement().getParent().addClass("cke").addClass("cke_reset_all") }; g.onHide = CKEDITOR.tools.bind(function () { this._.onHide && this._.onHide() }, this); n = g.addBlock(this.id, this._.panelDefinition.block); n.autoSize = !0; var v = n.keys; v[40] = "next"; v[9] = "next"; v[38] = "prev"; v[CKEDITOR.SHIFT + 9] = "prev"; v["rtl" == l.lang.dir ? 37 : 39] = CKEDITOR.env.ie ? "mouseup" : "click"; v[32] = CKEDITOR.env.ie ? "mouseup" :
                                    "click"; CKEDITOR.env.ie && (v[13] = "mouseup"); n = this._.element = n.element; v = n.getDocument(); v.getBody().setStyle("overflow", "hidden"); v.getElementsByTag("html").getItem(0).setStyle("overflow", "hidden"); this._.itemOverFn = CKEDITOR.tools.addFunction(function (a) { clearTimeout(this._.showSubTimeout); this._.showSubTimeout = CKEDITOR.tools.setTimeout(this._.showSubMenu, l.config.menu_subMenuDelay || 400, this, [a]) }, this); this._.itemOutFn = CKEDITOR.tools.addFunction(function () { clearTimeout(this._.showSubTimeout) }, this);
                                this._.itemClickFn = CKEDITOR.tools.addFunction(function (a) { var b = this.items[a]; if (b.state == CKEDITOR.TRISTATE_DISABLED) this.hide(1); else if (b.getItems) this._.showSubMenu(a); else this._.onClick(b) }, this)
                            } a(h); for (var v = l.elementPath(), v = ['\x3cdiv class\x3d"cke_menu' + (v && v.direction() != l.lang.dir ? " cke_mixed_dir_content" : "") + '" role\x3d"presentation"\x3e'], u = h.length, q = u && h[0].group, t = 0; t < u; t++) {
                                var p = h[t]; q != p.group && (v.push('\x3cdiv class\x3d"cke_menuseparator" role\x3d"separator"\x3e\x3c/div\x3e'),
                                    q = p.group); p.render(this, t, v)
                            } v.push("\x3c/div\x3e"); n.setHtml(v.join("")); CKEDITOR.ui.fire("ready", this); this.parent ? this.parent._.panel.showAsChild(g, this.id, b, c, e, f) : g.showBlock(this.id, b, c, e, f); l.fire("menuShow", [g])
                        }, addListener: function (a) { this._.listeners.push(a) }, hide: function (a) { this._.onHide && this._.onHide(); this._.panel && this._.panel.hide(a) }
                    }
                }); CKEDITOR.menuItem = CKEDITOR.tools.createClass({
                    $: function (a, b, c) {
                        CKEDITOR.tools.extend(this, c, { order: 0, className: "cke_menubutton__" + b }); this.group =
                            a._.menuGroups[this.group]; this.editor = a; this.name = b
                    }, proto: {
                        render: function (a, e, m) {
                            var f = a.id + String(e), h = "undefined" == typeof this.state ? CKEDITOR.TRISTATE_OFF : this.state, l = "", g = h == CKEDITOR.TRISTATE_ON ? "on" : h == CKEDITOR.TRISTATE_DISABLED ? "disabled" : "off"; this.role in { menuitemcheckbox: 1, menuitemradio: 1 } && (l = ' aria-checked\x3d"' + (h == CKEDITOR.TRISTATE_ON ? "true" : "false") + '"'); var n = this.getItems, v = "\x26#" + ("rtl" == this.editor.lang.dir ? "9668" : "9658") + ";", u = this.name; this.icon && !/\./.test(this.icon) && (u =
                                this.icon); a = { id: f, name: this.name, iconName: u, label: this.label, cls: this.className || "", state: g, hasPopup: n ? "true" : "false", disabled: h == CKEDITOR.TRISTATE_DISABLED, title: this.label, href: "javascript:void('" + (this.label || "").replace("'") + "')", hoverFn: a._.itemOverFn, moveOutFn: a._.itemOutFn, clickFn: a._.itemClickFn, index: e, iconStyle: CKEDITOR.skin.getIconStyle(u, "rtl" == this.editor.lang.dir, u == this.icon ? null : this.icon, this.iconOffset), arrowHtml: n ? c.output({ label: v }) : "", role: this.role ? this.role : "menuitem", ariaChecked: l };
                            b.output(a, m)
                        }
                    }
                })
        }(), CKEDITOR.config.menu_groups = "clipboard,form,tablecell,tablecellproperties,tablerow,tablecolumn,table,anchor,link,image,flash,checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea,div", CKEDITOR.plugins.add("contextmenu", {
            requires: "menu", onLoad: function () {
                CKEDITOR.plugins.contextMenu = CKEDITOR.tools.createClass({
                    base: CKEDITOR.menu, $: function (a) { this.base.call(this, a, { panel: { className: "cke_menu_panel", attributes: { "aria-label": a.lang.contextmenu.options } } }) }, proto: {
                        addTarget: function (a,
                            e) {
                                a.on("contextmenu", function (a) {
                                    a = a.data; var c = CKEDITOR.env.webkit ? b : CKEDITOR.env.mac ? a.$.metaKey : a.$.ctrlKey; if (!e || !c) {
                                        a.preventDefault(); if (CKEDITOR.env.mac && CKEDITOR.env.webkit) { var c = this.editor, m = (new CKEDITOR.dom.elementPath(a.getTarget(), c.editable())).contains(function (a) { return a.hasAttribute("contenteditable") }, !0); m && "false" == m.getAttribute("contenteditable") && c.getSelection().fake(m) } var m = a.getTarget().getDocument(), f = a.getTarget().getDocument().getDocumentElement(), c = !m.equals(CKEDITOR.document),
                                            m = m.getWindow().getScrollPosition(), h = c ? a.$.clientX : a.$.pageX || m.x + a.$.clientX, l = c ? a.$.clientY : a.$.pageY || m.y + a.$.clientY; CKEDITOR.tools.setTimeout(function () { this.open(f, null, h, l) }, CKEDITOR.env.ie ? 200 : 0, this)
                                    }
                                }, this); if (CKEDITOR.env.webkit) { var b, c = function () { b = 0 }; a.on("keydown", function (a) { b = CKEDITOR.env.mac ? a.data.$.metaKey : a.data.$.ctrlKey }); a.on("keyup", c); a.on("contextmenu", c) }
                        }, open: function (a, e, b, c) {
                            this.editor.focus(); a = a || CKEDITOR.document.getDocumentElement(); this.editor.selectionChange(1);
                            this.show(a, e, b, c)
                        }
                    }
                })
            }, beforeInit: function (a) { var e = a.contextMenu = new CKEDITOR.plugins.contextMenu(a); a.on("contentDom", function () { e.addTarget(a.editable(), !1 !== a.config.browserContextMenuOnCtrl) }); a.addCommand("contextMenu", { exec: function () { a.contextMenu.open(a.document.getBody()) } }); a.setKeystroke(CKEDITOR.SHIFT + 121, "contextMenu"); a.setKeystroke(CKEDITOR.CTRL + CKEDITOR.SHIFT + 121, "contextMenu") }
        }), function () {
            function a(a, b) {
                function m(b) {
                    b = g.list[b]; if (b.equals(a.editable()) || "true" == b.getAttribute("contenteditable")) {
                        var c =
                            a.createRange(); c.selectNodeContents(b); c.select()
                    } else a.getSelection().selectElement(b); a.focus()
                } function f() { l && l.setHtml('\x3cspan class\x3d"cke_path_empty"\x3e\x26nbsp;\x3c/span\x3e'); delete g.list } var h = a.ui.spaceId("path"), l, g = a._.elementsPath, n = g.idBase; b.html += '\x3cspan id\x3d"' + h + '_label" class\x3d"cke_voice_label"\x3e' + a.lang.elementspath.eleLabel + '\x3c/span\x3e\x3cspan id\x3d"' + h + '" class\x3d"cke_path" role\x3d"group" aria-labelledby\x3d"' + h + '_label"\x3e\x3cspan class\x3d"cke_path_empty"\x3e\x26nbsp;\x3c/span\x3e\x3c/span\x3e';
                a.on("uiReady", function () { var b = a.ui.space("path"); b && a.focusManager.add(b, 1) }); g.onClick = m; var v = CKEDITOR.tools.addFunction(m), u = CKEDITOR.tools.addFunction(function (b, c) {
                    var f = g.idBase, e; c = new CKEDITOR.dom.event(c); e = "rtl" == a.lang.dir; switch (c.getKeystroke()) {
                        case e ? 39 : 37: case 9: return (e = CKEDITOR.document.getById(f + (b + 1))) || (e = CKEDITOR.document.getById(f + "0")), e.focus(), !1; case e ? 37 : 39: case CKEDITOR.SHIFT + 9: return (e = CKEDITOR.document.getById(f + (b - 1))) || (e = CKEDITOR.document.getById(f + (g.list.length -
                            1))), e.focus(), !1; case 27: return a.focus(), !1; case 13: case 32: return m(b), !1
                    }return !0
                }); a.on("selectionChange", function () {
                    for (var b = [], f = g.list = [], e = [], k = g.filters, m = !0, z = a.elementPath().elements, r, w = z.length; w--;) {
                        var C = z[w], x = 0; r = C.data("cke-display-name") ? C.data("cke-display-name") : C.data("cke-real-element-type") ? C.data("cke-real-element-type") : C.getName(); (m = C.hasAttribute("contenteditable") ? "true" == C.getAttribute("contenteditable") : m) || C.hasAttribute("contenteditable") || (x = 1); for (var B = 0; B < k.length; B++) {
                            var D =
                                k[B](C, r); if (!1 === D) { x = 1; break } r = D || r
                        } x || (f.unshift(C), e.unshift(r))
                    } f = f.length; for (k = 0; k < f; k++)r = e[k], m = a.lang.elementspath.eleTitle.replace(/%1/, r), r = c.output({ id: n + k, label: m, text: r, jsTitle: "javascript:void('" + r + "')", index: k, keyDownFn: u, clickFn: v }), b.unshift(r); l || (l = CKEDITOR.document.getById(h)); e = l; e.setHtml(b.join("") + '\x3cspan class\x3d"cke_path_empty"\x3e\x26nbsp;\x3c/span\x3e'); a.fire("elementsPathUpdate", { space: e })
                }); a.on("readOnly", f); a.on("contentDomUnload", f); a.addCommand("elementsPathFocus",
                    e.toolbarFocus); a.setKeystroke(CKEDITOR.ALT + 122, "elementsPathFocus")
            } var e = { toolbarFocus: { editorFocus: !1, readOnly: 1, exec: function (a) { (a = CKEDITOR.document.getById(a._.elementsPath.idBase + "0")) && a.focus(CKEDITOR.env.ie || CKEDITOR.env.air) } } }, b = ""; CKEDITOR.env.gecko && CKEDITOR.env.mac && (b += ' onkeypress\x3d"return false;"'); CKEDITOR.env.gecko && (b += ' onblur\x3d"this.style.cssText \x3d this.style.cssText;"'); var c = CKEDITOR.addTemplate("pathItem", '\x3ca id\x3d"{id}" href\x3d"{jsTitle}" tabindex\x3d"-1" class\x3d"cke_path_item" title\x3d"{label}"' +
                b + ' hidefocus\x3d"true"  onkeydown\x3d"return CKEDITOR.tools.callFunction({keyDownFn},{index}, event );" onclick\x3d"CKEDITOR.tools.callFunction({clickFn},{index}); return false;" role\x3d"button" aria-label\x3d"{label}"\x3e{text}\x3c/a\x3e'); CKEDITOR.plugins.add("elementspath", { init: function (b) { b._.elementsPath = { idBase: "cke_elementspath_" + CKEDITOR.tools.getNextNumber() + "_", filters: [] }; b.on("uiSpace", function (c) { "bottom" == c.data.space && a(b, c.data) }) } })
        }(), function () {
            function a(a, d) {
                var k, m; d.on("refresh",
                    function (a) { var c = [e], d; for (d in a.data.states) c.push(a.data.states[d]); this.setState(CKEDITOR.tools.search(c, b) ? b : e) }, d, null, 100); d.on("exec", function (b) { k = a.getSelection(); m = k.createBookmarks(1); b.data || (b.data = {}); b.data.done = !1 }, d, null, 0); d.on("exec", function () { a.forceNextSelectionCheck(); k.selectBookmarks(m) }, d, null, 100)
            } var e = CKEDITOR.TRISTATE_DISABLED, b = CKEDITOR.TRISTATE_OFF; CKEDITOR.plugins.add("indent", {
                init: function (b) {
                    var d = CKEDITOR.plugins.indent.genericDefinition; a(b, b.addCommand("indent",
                        new d(!0))); a(b, b.addCommand("outdent", new d)); b.ui.addButton && (b.ui.addButton("Indent", { label: b.lang.indent.indent, command: "indent", directional: !0, toolbar: "indent,20" }), b.ui.addButton("Outdent", { label: b.lang.indent.outdent, command: "outdent", directional: !0, toolbar: "indent,10" })); b.on("dirChanged", function (a) {
                            var d = b.createRange(), f = a.data.node; d.setStartBefore(f); d.setEndAfter(f); for (var e = new CKEDITOR.dom.walker(d), l; l = e.next();)if (l.type == CKEDITOR.NODE_ELEMENT) if (!l.equals(f) && l.getDirection()) d.setStartAfter(l),
                                e = new CKEDITOR.dom.walker(d); else { var g = b.config.indentClasses; if (g) for (var n = "ltr" == a.data.dir ? ["_rtl", ""] : ["", "_rtl"], v = 0; v < g.length; v++)l.hasClass(g[v] + n[0]) && (l.removeClass(g[v] + n[0]), l.addClass(g[v] + n[1])); g = l.getStyle("margin-right"); n = l.getStyle("margin-left"); g ? l.setStyle("margin-left", g) : l.removeStyle("margin-left"); n ? l.setStyle("margin-right", n) : l.removeStyle("margin-right") }
                        })
                }
            }); CKEDITOR.plugins.indent = {
                genericDefinition: function (a) { this.isIndent = !!a; this.startDisabled = !this.isIndent },
                specificDefinition: function (a, b, e) { this.name = b; this.editor = a; this.jobs = {}; this.enterBr = a.config.enterMode == CKEDITOR.ENTER_BR; this.isIndent = !!e; this.relatedGlobal = e ? "indent" : "outdent"; this.indentKey = e ? 9 : CKEDITOR.SHIFT + 9; this.database = {} }, registerCommands: function (a, b) {
                    a.on("pluginsLoaded", function () {
                        for (var a in b) (function (a, b) {
                            var c = a.getCommand(b.relatedGlobal), d; for (d in b.jobs) c.on("exec", function (c) {
                                c.data.done || (a.fire("lockSnapshot"), b.execJob(a, d) && (c.data.done = !0), a.fire("unlockSnapshot"),
                                    CKEDITOR.dom.element.clearAllMarkers(b.database))
                            }, this, null, d), c.on("refresh", function (c) { c.data.states || (c.data.states = {}); c.data.states[b.name + "@" + d] = b.refreshJob(a, d, c.data.path) }, this, null, d); a.addFeature(b)
                        })(this, b[a])
                    })
                }
            }; CKEDITOR.plugins.indent.genericDefinition.prototype = { context: "p", exec: function () { } }; CKEDITOR.plugins.indent.specificDefinition.prototype = {
                execJob: function (a, b) { var k = this.jobs[b]; if (k.state != e) return k.exec.call(this, a) }, refreshJob: function (a, b, k) {
                    b = this.jobs[b]; a.activeFilter.checkFeature(this) ?
                        b.state = b.refresh.call(this, a, k) : b.state = e; return b.state
                }, getContext: function (a) { return a.contains(this.context) }
            }
        }(), function () {
            function a(a) {
                function c(e) {
                    for (var h = u.startContainer, m = u.endContainer; h && !h.getParent().equals(e);)h = h.getParent(); for (; m && !m.getParent().equals(e);)m = m.getParent(); if (!h || !m) return !1; for (var q = h, h = [], t = !1; !t;)q.equals(m) && (t = !0), h.push(q), q = q.getNext(); if (1 > h.length) return !1; q = e.getParents(!0); for (m = 0; m < q.length; m++)if (q[m].getName && k[q[m].getName()]) { e = q[m]; break } for (var q =
                        d.isIndent ? 1 : -1, m = h[0], h = h[h.length - 1], t = CKEDITOR.plugins.list.listToArray(e, g), w = t[h.getCustomData("listarray_index")].indent, m = m.getCustomData("listarray_index"); m <= h.getCustomData("listarray_index"); m++)if (t[m].indent += q, 0 < q) { var v = t[m].parent; t[m].parent = new CKEDITOR.dom.element(v.getName(), v.getDocument()) } for (m = h.getCustomData("listarray_index") + 1; m < t.length && t[m].indent > w; m++)t[m].indent += q; h = CKEDITOR.plugins.list.arrayToList(t, g, null, a.config.enterMode, e.getDirection()); if (!d.isIndent) {
                            var x;
                            if ((x = e.getParent()) && x.is("li")) for (var q = h.listNode.getChildren(), B = [], D, m = q.count() - 1; 0 <= m; m--)(D = q.getItem(m)) && D.is && D.is("li") && B.push(D)
                        } h && h.listNode.replace(e); if (B && B.length) for (m = 0; m < B.length; m++) { for (D = e = B[m]; (D = D.getNext()) && D.is && D.getName() in k;)CKEDITOR.env.needsNbspFiller && !e.getFirst(b) && e.append(u.document.createText("Â ")), e.append(D); e.insertAfter(x) } h && a.fire("contentDomInvalidated"); return !0
                } for (var d = this, g = this.database, k = this.context, m = a.getSelection(), m = (m && m.getRanges()).createIterator(),
                    u; u = m.getNextRange();) {
                        for (var q = u.getCommonAncestor(); q && (q.type != CKEDITOR.NODE_ELEMENT || !k[q.getName()]);) { if (a.editable().equals(q)) { q = !1; break } q = q.getParent() } q || (q = u.startPath().contains(k)) && u.setEndAt(q, CKEDITOR.POSITION_BEFORE_END); if (!q) { var t = u.getEnclosedNode(); t && t.type == CKEDITOR.NODE_ELEMENT && t.getName() in k && (u.setStartAt(t, CKEDITOR.POSITION_AFTER_START), u.setEndAt(t, CKEDITOR.POSITION_BEFORE_END), q = t) } q && u.startContainer.type == CKEDITOR.NODE_ELEMENT && u.startContainer.getName() in k && (t =
                            new CKEDITOR.dom.walker(u), t.evaluator = e, u.startContainer = t.next()); q && u.endContainer.type == CKEDITOR.NODE_ELEMENT && u.endContainer.getName() in k && (t = new CKEDITOR.dom.walker(u), t.evaluator = e, u.endContainer = t.previous()); if (q) return c(q)
                } return 0
            } function e(a) { return a.type == CKEDITOR.NODE_ELEMENT && a.is("li") } function b(a) { return c(a) && d(a) } var c = CKEDITOR.dom.walker.whitespaces(!0), d = CKEDITOR.dom.walker.bookmark(!1, !0), k = CKEDITOR.TRISTATE_DISABLED, m = CKEDITOR.TRISTATE_OFF; CKEDITOR.plugins.add("indentlist",
                {
                    requires: "indent", init: function (b) {
                        function c(b) {
                            d.specificDefinition.apply(this, arguments); this.requiredContent = ["ul", "ol"]; b.on("key", function (a) { if ("wysiwyg" == b.mode && a.data.keyCode == this.indentKey) { var c = this.getContext(b.elementPath()); !c || this.isIndent && CKEDITOR.plugins.indentList.firstItemInPath(this.context, b.elementPath(), c) || (b.execCommand(this.relatedGlobal), a.cancel()) } }, this); this.jobs[this.isIndent ? 10 : 30] = {
                                refresh: this.isIndent ? function (a, b) {
                                    var c = this.getContext(b), d = CKEDITOR.plugins.indentList.firstItemInPath(this.context,
                                        b, c); return c && this.isIndent && !d ? m : k
                                } : function (a, b) { return !this.getContext(b) || this.isIndent ? k : m }, exec: CKEDITOR.tools.bind(a, this)
                            }
                        } var d = CKEDITOR.plugins.indent; d.registerCommands(b, { indentlist: new c(b, "indentlist", !0), outdentlist: new c(b, "outdentlist") }); CKEDITOR.tools.extend(c.prototype, d.specificDefinition.prototype, { context: { ol: 1, ul: 1 } })
                    }
                }); CKEDITOR.plugins.indentList = {}; CKEDITOR.plugins.indentList.firstItemInPath = function (a, b, c) { var d = b.contains(e); c || (c = b.contains(a)); return c && d && d.equals(c.getFirst(e)) }
        }(),
        function () {
            function a(a, b, c) {
                function d(c) { if (!(!(l = k[c ? "getFirst" : "getLast"]()) || l.is && l.isBlockBoundary() || !(m = b.root[c ? "getPrevious" : "getNext"](CKEDITOR.dom.walker.invisible(!0))) || m.is && m.isBlockBoundary({ br: 1 }))) a.document.createElement("br")[c ? "insertBefore" : "insertAfter"](l) } for (var f = CKEDITOR.plugins.list.listToArray(b.root, c), e = [], g = 0; g < b.contents.length; g++) {
                    var h = b.contents[g]; (h = h.getAscendant("li", !0)) && !h.getCustomData("list_item_processed") && (e.push(h), CKEDITOR.dom.element.setMarker(c,
                        h, "list_item_processed", !0))
                } h = null; for (g = 0; g < e.length; g++)h = e[g].getCustomData("listarray_index"), f[h].indent = -1; for (g = h + 1; g < f.length; g++)if (f[g].indent > f[g - 1].indent + 1) { e = f[g - 1].indent + 1 - f[g].indent; for (h = f[g].indent; f[g] && f[g].indent >= h;)f[g].indent += e, g++; g-- } var k = CKEDITOR.plugins.list.arrayToList(f, c, null, a.config.enterMode, b.root.getAttribute("dir")).listNode, l, m; d(!0); d(); k.replace(b.root); a.fire("contentDomInvalidated")
            } function e(a, b) {
                this.name = a; this.context = this.type = b; this.allowedContent =
                    b + " li"; this.requiredContent = b
            } function b(a, b, c, d) { for (var f, e; f = a[d ? "getLast" : "getFirst"](u);)(e = f.getDirection(1)) !== b.getDirection(1) && f.setAttribute("dir", e), f.remove(), c ? f[d ? "insertBefore" : "insertAfter"](c) : b.append(f, d) } function c(a) { function c(d) { var f = a[d ? "getPrevious" : "getNext"](g); f && f.type == CKEDITOR.NODE_ELEMENT && f.is(a.getName()) && (b(a, f, null, !d), a.remove(), a = f) } c(); c(1) } function d(a) {
                return a.type == CKEDITOR.NODE_ELEMENT && (a.getName() in CKEDITOR.dtd.$block || a.getName() in CKEDITOR.dtd.$listItem) &&
                    CKEDITOR.dtd[a.getName()]["#"]
            } function k(a, d, f) {
                a.fire("saveSnapshot"); f.enlarge(CKEDITOR.ENLARGE_LIST_ITEM_CONTENTS); var e = f.extractContents(); d.trim(!1, !0); var h = d.createBookmark(), k = new CKEDITOR.dom.elementPath(d.startContainer), l = k.block, k = k.lastElement.getAscendant("li", 1) || l, u = new CKEDITOR.dom.elementPath(f.startContainer), v = u.contains(CKEDITOR.dtd.$listItem), u = u.contains(CKEDITOR.dtd.$list); l ? (l = l.getBogus()) && l.remove() : u && (l = u.getPrevious(g)) && n(l) && l.remove(); (l = e.getLast()) && l.type == CKEDITOR.NODE_ELEMENT &&
                    l.is("br") && l.remove(); (l = d.startContainer.getChild(d.startOffset)) ? e.insertBefore(l) : d.startContainer.append(e); v && (e = m(v)) && (k.contains(v) ? (b(e, v.getParent(), v), e.remove()) : k.append(e)); for (; f.checkStartOfBlock() && f.checkEndOfBlock();) { u = f.startPath(); e = u.block; if (!e) break; e.is("li") && (k = e.getParent(), e.equals(k.getLast(g)) && e.equals(k.getFirst(g)) && (e = k)); f.moveToPosition(e, CKEDITOR.POSITION_BEFORE_START); e.remove() } f = f.clone(); e = a.editable(); f.setEndAt(e, CKEDITOR.POSITION_BEFORE_END); f = new CKEDITOR.dom.walker(f);
                f.evaluator = function (a) { return g(a) && !n(a) }; (f = f.next()) && f.type == CKEDITOR.NODE_ELEMENT && f.getName() in CKEDITOR.dtd.$list && c(f); d.moveToBookmark(h); d.select(); a.fire("saveSnapshot")
            } function m(a) { return (a = a.getLast(g)) && a.type == CKEDITOR.NODE_ELEMENT && a.getName() in f ? a : null } var f = { ol: 1, ul: 1 }, h = CKEDITOR.dom.walker.whitespaces(), l = CKEDITOR.dom.walker.bookmark(), g = function (a) { return !(h(a) || l(a)) }, n = CKEDITOR.dom.walker.bogus(); CKEDITOR.plugins.list = {
                listToArray: function (a, b, c, d, e) {
                    if (!f[a.getName()]) return [];
                    d || (d = 0); c || (c = []); for (var g = 0, h = a.getChildCount(); g < h; g++) {
                        var k = a.getChild(g); k.type == CKEDITOR.NODE_ELEMENT && k.getName() in CKEDITOR.dtd.$list && CKEDITOR.plugins.list.listToArray(k, b, c, d + 1); if ("li" == k.$.nodeName.toLowerCase()) {
                            var l = { parent: a, indent: d, element: k, contents: [] }; e ? l.grandparent = e : (l.grandparent = a.getParent(), l.grandparent && "li" == l.grandparent.$.nodeName.toLowerCase() && (l.grandparent = l.grandparent.getParent())); b && CKEDITOR.dom.element.setMarker(b, k, "listarray_index", c.length); c.push(l);
                            for (var m = 0, n = k.getChildCount(), u; m < n; m++)u = k.getChild(m), u.type == CKEDITOR.NODE_ELEMENT && f[u.getName()] ? CKEDITOR.plugins.list.listToArray(u, b, c, d + 1, l.grandparent) : l.contents.push(u)
                        }
                    } return c
                }, arrayToList: function (a, b, c, d, e) {
                    c || (c = 0); if (!a || a.length < c + 1) return null; for (var h, k = a[c].parent.getDocument(), m = new CKEDITOR.dom.documentFragment(k), n = null, u = c, v = Math.max(a[c].indent, 0), D = null, F, E, I = d == CKEDITOR.ENTER_P ? "p" : "div"; ;) {
                        var G = a[u]; h = G.grandparent; F = G.element.getDirection(1); if (G.indent == v) {
                            n && a[u].parent.getName() ==
                            n.getName() || (n = a[u].parent.clone(!1, 1), e && n.setAttribute("dir", e), m.append(n)); D = n.append(G.element.clone(0, 1)); F != n.getDirection(1) && D.setAttribute("dir", F); for (h = 0; h < G.contents.length; h++)D.append(G.contents[h].clone(1, 1)); u++
                        } else if (G.indent == Math.max(v, 0) + 1) G = a[u - 1].element.getDirection(1), u = CKEDITOR.plugins.list.arrayToList(a, null, u, d, G != F ? F : null), !D.getChildCount() && CKEDITOR.env.needsNbspFiller && 7 >= k.$.documentMode && D.append(k.createText("Â ")), D.append(u.listNode), u = u.nextIndex; else if (-1 ==
                            G.indent && !c && h) {
                                f[h.getName()] ? (D = G.element.clone(!1, !0), F != h.getDirection(1) && D.setAttribute("dir", F)) : D = new CKEDITOR.dom.documentFragment(k); var n = h.getDirection(1) != F, L = G.element, N = L.getAttribute("class"), H = L.getAttribute("style"), R = D.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT && (d != CKEDITOR.ENTER_BR || n || H || N), P, T = G.contents.length, O; for (h = 0; h < T; h++)if (P = G.contents[h], l(P) && 1 < T) R ? O = P.clone(1, 1) : D.append(P.clone(1, 1)); else if (P.type == CKEDITOR.NODE_ELEMENT && P.isBlockBoundary()) {
                                    n && !P.getDirection() &&
                                    P.setAttribute("dir", F); E = P; var J = L.getAttribute("style"); J && E.setAttribute("style", J.replace(/([^;])$/, "$1;") + (E.getAttribute("style") || "")); N && P.addClass(N); E = null; O && (D.append(O), O = null); D.append(P.clone(1, 1))
                                } else R ? (E || (E = k.createElement(I), D.append(E), n && E.setAttribute("dir", F)), H && E.setAttribute("style", H), N && E.setAttribute("class", N), O && (E.append(O), O = null), E.append(P.clone(1, 1))) : D.append(P.clone(1, 1)); O && ((E || D).append(O), O = null); D.type == CKEDITOR.NODE_DOCUMENT_FRAGMENT && u != a.length - 1 && (CKEDITOR.env.needsBrFiller &&
                                    (F = D.getLast()) && F.type == CKEDITOR.NODE_ELEMENT && F.is("br") && F.remove(), (F = D.getLast(g)) && F.type == CKEDITOR.NODE_ELEMENT && F.is(CKEDITOR.dtd.$block) || D.append(k.createElement("br"))); F = D.$.nodeName.toLowerCase(); "div" != F && "p" != F || D.appendBogus(); m.append(D); n = null; u++
                        } else return null; E = null; if (a.length <= u || Math.max(a[u].indent, 0) < v) break
                    } if (b) for (a = m.getFirst(); a;) {
                        if (a.type == CKEDITOR.NODE_ELEMENT && (CKEDITOR.dom.element.clearMarkers(b, a), a.getName() in CKEDITOR.dtd.$listItem && (c = a, k = e = d = void 0, d = c.getDirection()))) {
                            for (e =
                                c.getParent(); e && !(k = e.getDirection());)e = e.getParent(); d == k && c.removeAttribute("dir")
                        } a = a.getNextSourceNode()
                    } return { listNode: m, nextIndex: u }
                }
            }; var v = /^h[1-6]$/, u = CKEDITOR.dom.walker.nodeType(CKEDITOR.NODE_ELEMENT); e.prototype = {
                exec: function (b) {
                    this.refresh(b, b.elementPath()); var d = b.config, e = b.getSelection(), h = e && e.getRanges(); if (this.state == CKEDITOR.TRISTATE_OFF) {
                        var k = b.editable(); if (k.getFirst(g)) { var l = 1 == h.length && h[0]; (d = l && l.getEnclosedNode()) && d.is && this.type == d.getName() && this.setState(CKEDITOR.TRISTATE_ON) } else d.enterMode ==
                            CKEDITOR.ENTER_BR ? k.appendBogus() : h[0].fixBlock(1, d.enterMode == CKEDITOR.ENTER_P ? "p" : "div"), e.selectRanges(h)
                    } for (var d = e.createBookmarks(!0), k = [], m = {}, h = h.createIterator(), n = 0; (l = h.getNextRange()) && ++n;) {
                        var u = l.getBoundaryNodes(), x = u.startNode, B = u.endNode; x.type == CKEDITOR.NODE_ELEMENT && "td" == x.getName() && l.setStartAt(u.startNode, CKEDITOR.POSITION_AFTER_START); B.type == CKEDITOR.NODE_ELEMENT && "td" == B.getName() && l.setEndAt(u.endNode, CKEDITOR.POSITION_BEFORE_END); l = l.createIterator(); for (l.forceBrBreak =
                            this.state == CKEDITOR.TRISTATE_OFF; u = l.getNextParagraph();)if (!u.getCustomData("list_block")) {
                                CKEDITOR.dom.element.setMarker(m, u, "list_block", 1); for (var D = b.elementPath(u), x = D.elements, B = 0, D = D.blockLimit, F, E = x.length - 1; 0 <= E && (F = x[E]); E--)if (f[F.getName()] && D.contains(F)) { D.removeCustomData("list_group_object_" + n); (x = F.getCustomData("list_group_object")) ? x.contents.push(u) : (x = { root: F, contents: [u] }, k.push(x), CKEDITOR.dom.element.setMarker(m, F, "list_group_object", x)); B = 1; break } B || (B = D, B.getCustomData("list_group_object_" +
                                    n) ? B.getCustomData("list_group_object_" + n).contents.push(u) : (x = { root: B, contents: [u] }, CKEDITOR.dom.element.setMarker(m, B, "list_group_object_" + n, x), k.push(x)))
                            }
                    } for (F = []; 0 < k.length;)if (x = k.shift(), this.state == CKEDITOR.TRISTATE_OFF) if (f[x.root.getName()]) {
                        h = b; n = x; x = m; l = F; B = CKEDITOR.plugins.list.listToArray(n.root, x); D = []; for (u = 0; u < n.contents.length; u++)E = n.contents[u], (E = E.getAscendant("li", !0)) && !E.getCustomData("list_item_processed") && (D.push(E), CKEDITOR.dom.element.setMarker(x, E, "list_item_processed",
                            !0)); for (var E = n.root.getDocument(), I = void 0, G = void 0, u = 0; u < D.length; u++) { var L = D[u].getCustomData("listarray_index"), I = B[L].parent; I.is(this.type) || (G = E.createElement(this.type), I.copyAttributes(G, { start: 1, type: 1 }), G.removeStyle("list-style-type"), B[L].parent = G) } x = CKEDITOR.plugins.list.arrayToList(B, x, null, h.config.enterMode); B = void 0; D = x.listNode.getChildCount(); for (u = 0; u < D && (B = x.listNode.getChild(u)); u++)B.getName() == this.type && l.push(B); x.listNode.replace(n.root); h.fire("contentDomInvalidated")
                    } else {
                        B =
                        b; l = x; u = F; D = l.contents; h = l.root.getDocument(); n = []; 1 == D.length && D[0].equals(l.root) && (x = h.createElement("div"), D[0].moveChildren && D[0].moveChildren(x), D[0].append(x), D[0] = x); l = l.contents[0].getParent(); for (E = 0; E < D.length; E++)l = l.getCommonAncestor(D[E].getParent()); I = B.config.useComputedState; B = x = void 0; I = void 0 === I || I; for (E = 0; E < D.length; E++)for (G = D[E]; L = G.getParent();) { if (L.equals(l)) { n.push(G); !B && G.getDirection() && (B = 1); G = G.getDirection(I); null !== x && (x = x && x != G ? null : G); break } G = L } if (!(1 > n.length)) {
                            D =
                            n[n.length - 1].getNext(); E = h.createElement(this.type); u.push(E); for (I = u = void 0; n.length;)u = n.shift(), I = h.createElement("li"), G = u, G.is("pre") || v.test(G.getName()) || "false" == G.getAttribute("contenteditable") ? u.appendTo(I) : (u.copyAttributes(I), x && u.getDirection() && (I.removeStyle("direction"), I.removeAttribute("dir")), u.moveChildren(I), u.remove()), I.appendTo(E); x && B && E.setAttribute("dir", x); D ? E.insertBefore(D) : E.appendTo(l)
                        }
                    } else this.state == CKEDITOR.TRISTATE_ON && f[x.root.getName()] && a.call(this, b, x, m);
                    for (E = 0; E < F.length; E++)c(F[E]); CKEDITOR.dom.element.clearAllMarkers(m); e.selectBookmarks(d); b.focus()
                }, refresh: function (a, b) { var c = b.contains(f, 1), d = b.blockLimit || b.root; c && d.contains(c) ? this.setState(c.is(this.type) ? CKEDITOR.TRISTATE_ON : CKEDITOR.TRISTATE_OFF) : this.setState(CKEDITOR.TRISTATE_OFF) }
            }; CKEDITOR.plugins.add("list", {
                requires: "indentlist", init: function (a) {
                    a.blockless || (a.addCommand("numberedlist", new e("numberedlist", "ol")), a.addCommand("bulletedlist", new e("bulletedlist", "ul")), a.ui.addButton &&
                        (a.ui.addButton("NumberedList", { label: a.lang.list.numberedlist, command: "numberedlist", directional: !0, toolbar: "list,10" }), a.ui.addButton("BulletedList", { label: a.lang.list.bulletedlist, command: "bulletedlist", directional: !0, toolbar: "list,20" })), a.on("key", function (b) {
                            var c = b.data.domEvent.getKey(), e; if ("wysiwyg" == a.mode && c in { 8: 1, 46: 1 }) {
                                var h = a.getSelection().getRanges()[0], l = h && h.startPath(); if (h && h.collapsed) {
                                    var u = 8 == c, v = a.editable(), C = new CKEDITOR.dom.walker(h.clone()); C.evaluator = function (a) {
                                        return g(a) &&
                                            !n(a)
                                    }; C.guard = function (a, b) { return !(b && a.type == CKEDITOR.NODE_ELEMENT && a.is("table")) }; c = h.clone(); if (u) {
                                        var x; (x = l.contains(f)) && h.checkBoundaryOfElement(x, CKEDITOR.START) && (x = x.getParent()) && x.is("li") && (x = m(x)) ? (e = x, x = x.getPrevious(g), c.moveToPosition(x && n(x) ? x : e, CKEDITOR.POSITION_BEFORE_START)) : (C.range.setStartAt(v, CKEDITOR.POSITION_AFTER_START), C.range.setEnd(h.startContainer, h.startOffset), (x = C.previous()) && x.type == CKEDITOR.NODE_ELEMENT && (x.getName() in f || x.is("li")) && (x.is("li") || (C.range.selectNodeContents(x),
                                            C.reset(), C.evaluator = d, x = C.previous()), e = x, c.moveToElementEditEnd(e), c.moveToPosition(c.endPath().block, CKEDITOR.POSITION_BEFORE_END))); if (e) k(a, c, h), b.cancel(); else { var B = l.contains(f); B && h.checkBoundaryOfElement(B, CKEDITOR.START) && (e = B.getFirst(g), h.checkBoundaryOfElement(e, CKEDITOR.START) && (x = B.getPrevious(g), m(e) ? x && (h.moveToElementEditEnd(x), h.select()) : a.execCommand("outdent"), b.cancel())) }
                                    } else if (e = l.contains("li")) {
                                        if (C.range.setEndAt(v, CKEDITOR.POSITION_BEFORE_END), u = (v = e.getLast(g)) &&
                                            d(v) ? v : e, l = 0, (x = C.next()) && x.type == CKEDITOR.NODE_ELEMENT && x.getName() in f && x.equals(v) ? (l = 1, x = C.next()) : h.checkBoundaryOfElement(u, CKEDITOR.END) && (l = 2), l && x) {
                                                h = h.clone(); h.moveToElementEditStart(x); if (1 == l && (c.optimize(), !c.startContainer.equals(e))) { for (e = c.startContainer; e.is(CKEDITOR.dtd.$inline);)B = e, e = e.getParent(); B && c.moveToPosition(B, CKEDITOR.POSITION_AFTER_END) } 2 == l && (c.moveToPosition(c.endPath().block, CKEDITOR.POSITION_BEFORE_END), h.endPath().block && h.moveToPosition(h.endPath().block, CKEDITOR.POSITION_AFTER_START));
                                            k(a, c, h); b.cancel()
                                        }
                                    } else C.range.setEndAt(v, CKEDITOR.POSITION_BEFORE_END), (x = C.next()) && x.type == CKEDITOR.NODE_ELEMENT && x.is(f) && (x = x.getFirst(g), l.block && h.checkStartOfBlock() && h.checkEndOfBlock() ? (l.block.remove(), h.moveToElementEditStart(x), h.select()) : m(x) ? (h.moveToElementEditStart(x), h.select()) : (h = h.clone(), h.moveToElementEditStart(x), k(a, c, h)), b.cancel()); setTimeout(function () { a.selectionChange(1) })
                                }
                            }
                        }))
                }
            })
        }(), function () {
            function a(a, b, c) {
                c = a.config.forceEnterMode || c; "wysiwyg" == a.mode && (b ||
                    (b = a.activeEnterMode), a.elementPath().isContextFor("p") || (b = CKEDITOR.ENTER_BR, c = 1), a.fire("saveSnapshot"), b == CKEDITOR.ENTER_BR ? m(a, b, null, c) : f(a, b, null, c), a.fire("saveSnapshot"))
            } function e(a) { a = a.getSelection().getRanges(!0); for (var b = a.length - 1; 0 < b; b--)a[b].deleteContents(); return a[0] } function b(a) {
                var b = a.startContainer.getAscendant(function (a) { return a.type == CKEDITOR.NODE_ELEMENT && "true" == a.getAttribute("contenteditable") }, !0); if (a.root.equals(b)) return a; b = new CKEDITOR.dom.range(b); b.moveToRange(a);
                return b
            } CKEDITOR.plugins.add("enterkey", { init: function (b) { b.addCommand("enter", { modes: { wysiwyg: 1 }, editorFocus: !1, exec: function (b) { a(b) } }); b.addCommand("shiftEnter", { modes: { wysiwyg: 1 }, editorFocus: !1, exec: function (b) { a(b, b.activeShiftEnterMode, 1) } }); b.setKeystroke([[13, "enter"], [CKEDITOR.SHIFT + 13, "shiftEnter"]]) } }); var c = CKEDITOR.dom.walker.whitespaces(), d = CKEDITOR.dom.walker.bookmark(); CKEDITOR.plugins.enterkey = {
                enterBlock: function (a, f, k, v) {
                    if (k = k || e(a)) {
                        k = b(k); var u = k.document, q = k.checkStartOfBlock(),
                            t = k.checkEndOfBlock(), p = a.elementPath(k.startContainer), y = p.block, A = f == CKEDITOR.ENTER_DIV ? "div" : "p", z; if (q && t) {
                                if (y && (y.is("li") || y.getParent().is("li"))) {
                                    y.is("li") || (y = y.getParent()); k = y.getParent(); z = k.getParent(); v = !y.hasPrevious(); var r = !y.hasNext(), A = a.getSelection(), w = A.createBookmarks(), q = y.getDirection(1), t = y.getAttribute("class"), C = y.getAttribute("style"), x = z.getDirection(1) != q; a = a.enterMode != CKEDITOR.ENTER_BR || x || C || t; if (z.is("li")) v || r ? (v && r && k.remove(), y[r ? "insertAfter" : "insertBefore"](z)) :
                                        y.breakParent(z); else { if (a) if (p.block.is("li") ? (z = u.createElement(f == CKEDITOR.ENTER_P ? "p" : "div"), x && z.setAttribute("dir", q), C && z.setAttribute("style", C), t && z.setAttribute("class", t), y.moveChildren(z)) : z = p.block, v || r) z[v ? "insertBefore" : "insertAfter"](k); else y.breakParent(k), z.insertAfter(k); else if (y.appendBogus(!0), v || r) for (; u = y[v ? "getFirst" : "getLast"]();)u[v ? "insertBefore" : "insertAfter"](k); else for (y.breakParent(k); u = y.getLast();)u.insertAfter(k); y.remove() } A.selectBookmarks(w); return
                                } if (y && y.getParent().is("blockquote")) {
                                    y.breakParent(y.getParent());
                                    y.getPrevious().getFirst(CKEDITOR.dom.walker.invisible(1)) || y.getPrevious().remove(); y.getNext().getFirst(CKEDITOR.dom.walker.invisible(1)) || y.getNext().remove(); k.moveToElementEditStart(y); k.select(); return
                                }
                            } else if (y && y.is("pre") && !t) { m(a, f, k, v); return } if (q = k.splitBlock(A)) {
                                f = q.previousBlock; y = q.nextBlock; p = q.wasStartOfBlock; a = q.wasEndOfBlock; y ? (w = y.getParent(), w.is("li") && (y.breakParent(w), y.move(y.getNext(), 1))) : f && (w = f.getParent()) && w.is("li") && (f.breakParent(w), w = f.getNext(), k.moveToElementEditStart(w),
                                    f.move(f.getPrevious())); if (p || a) {
                                        if (f) { if (f.is("li") || !h.test(f.getName()) && !f.is("pre")) z = f.clone() } else y && (z = y.clone()); z ? v && !z.is("li") && z.renameNode(A) : w && w.is("li") ? z = w : (z = u.createElement(A), f && (r = f.getDirection()) && z.setAttribute("dir", r)); if (u = q.elementPath) for (v = 0, A = u.elements.length; v < A; v++) { w = u.elements[v]; if (w.equals(u.block) || w.equals(u.blockLimit)) break; CKEDITOR.dtd.$removeEmpty[w.getName()] && (w = w.clone(), z.moveChildren(w), z.append(w)) } z.appendBogus(); z.getParent() || k.insertNode(z);
                                        z.is("li") && z.removeAttribute("value"); !CKEDITOR.env.ie || !p || a && f.getChildCount() || (k.moveToElementEditStart(a ? f : z), k.select()); k.moveToElementEditStart(p && !a ? y : z)
                                    } else y.is("li") && (z = k.clone(), z.selectNodeContents(y), z = new CKEDITOR.dom.walker(z), z.evaluator = function (a) { return !(d(a) || c(a) || a.type == CKEDITOR.NODE_ELEMENT && a.getName() in CKEDITOR.dtd.$inline && !(a.getName() in CKEDITOR.dtd.$empty)) }, (w = z.next()) && w.type == CKEDITOR.NODE_ELEMENT && w.is("ul", "ol") && (CKEDITOR.env.needsBrFiller ? u.createElement("br") :
                                        u.createText("Â ")).insertBefore(w)), y && k.moveToElementEditStart(y); k.select(); k.scrollIntoView()
                            }
                    }
                }, enterBr: function (a, b, c, d) {
                    if (c = c || e(a)) {
                        var k = c.document, m = c.checkEndOfBlock(), t = new CKEDITOR.dom.elementPath(a.getSelection().getStartElement()), p = t.block, y = p && t.block.getName(); d || "li" != y ? (!d && m && h.test(y) ? (m = p.getDirection()) ? (k = k.createElement("div"), k.setAttribute("dir", m), k.insertAfter(p), c.setStart(k, 0)) : (k.createElement("br").insertAfter(p), CKEDITOR.env.gecko && k.createText("").insertAfter(p),
                            c.setStartAt(p.getNext(), CKEDITOR.env.ie ? CKEDITOR.POSITION_BEFORE_START : CKEDITOR.POSITION_AFTER_START)) : (a = "pre" == y && CKEDITOR.env.ie && 8 > CKEDITOR.env.version ? k.createText("\r") : k.createElement("br"), c.deleteContents(), c.insertNode(a), CKEDITOR.env.needsBrFiller ? (k.createText("ï»¿").insertAfter(a), m && (p || t.blockLimit).appendBogus(), a.getNext().$.nodeValue = "", c.setStartAt(a.getNext(), CKEDITOR.POSITION_AFTER_START)) : c.setStartAt(a, CKEDITOR.POSITION_AFTER_END)), c.collapse(!0), c.select(), c.scrollIntoView()) :
                            f(a, b, c, d)
                    }
                }
            }; var k = CKEDITOR.plugins.enterkey, m = k.enterBr, f = k.enterBlock, h = /^h[1-6]$/
        }(), function () {
            function a(a, b) {
                var c = {}, d = [], k = { nbsp: "Â ", shy: "Â­", gt: "\x3e", lt: "\x3c", amp: "\x26", apos: "'", quot: '"' }; a = a.replace(/\b(nbsp|shy|gt|lt|amp|apos|quot)(?:,|$)/g, function (a, f) { var e = b ? "\x26" + f + ";" : k[f]; c[e] = b ? k[f] : "\x26" + f + ";"; d.push(e); return "" }); if (!b && a) {
                    a = a.split(","); var m = document.createElement("div"), f; m.innerHTML = "\x26" + a.join(";\x26") + ";"; f = m.innerHTML; m = null; for (m = 0; m < f.length; m++) {
                        var h = f.charAt(m);
                        c[h] = "\x26" + a[m] + ";"; d.push(h)
                    }
                } c.regex = d.join(b ? "|" : ""); return c
            } CKEDITOR.plugins.add("entities", {
                afterInit: function (e) {
                    function b(a) { return h[a] } function c(a) { return "force" != d.entities_processNumerical && m[a] ? m[a] : "\x26#" + a.charCodeAt(0) + ";" } var d = e.config; if (e = (e = e.dataProcessor) && e.htmlFilter) {
                        var k = []; !1 !== d.basicEntities && k.push("nbsp,gt,lt,amp"); d.entities && (k.length && k.push("quot,iexcl,cent,pound,curren,yen,brvbar,sect,uml,copy,ordf,laquo,not,shy,reg,macr,deg,plusmn,sup2,sup3,acute,micro,para,middot,cedil,sup1,ordm,raquo,frac14,frac12,frac34,iquest,times,divide,fnof,bull,hellip,prime,Prime,oline,frasl,weierp,image,real,trade,alefsym,larr,uarr,rarr,darr,harr,crarr,lArr,uArr,rArr,dArr,hArr,forall,part,exist,empty,nabla,isin,notin,ni,prod,sum,minus,lowast,radic,prop,infin,ang,and,or,cap,cup,int,there4,sim,cong,asymp,ne,equiv,le,ge,sub,sup,nsub,sube,supe,oplus,otimes,perp,sdot,lceil,rceil,lfloor,rfloor,lang,rang,loz,spades,clubs,hearts,diams,circ,tilde,ensp,emsp,thinsp,zwnj,zwj,lrm,rlm,ndash,mdash,lsquo,rsquo,sbquo,ldquo,rdquo,bdquo,dagger,Dagger,permil,lsaquo,rsaquo,euro"),
                            d.entities_latin && k.push("Agrave,Aacute,Acirc,Atilde,Auml,Aring,AElig,Ccedil,Egrave,Eacute,Ecirc,Euml,Igrave,Iacute,Icirc,Iuml,ETH,Ntilde,Ograve,Oacute,Ocirc,Otilde,Ouml,Oslash,Ugrave,Uacute,Ucirc,Uuml,Yacute,THORN,szlig,agrave,aacute,acirc,atilde,auml,aring,aelig,ccedil,egrave,eacute,ecirc,euml,igrave,iacute,icirc,iuml,eth,ntilde,ograve,oacute,ocirc,otilde,ouml,oslash,ugrave,uacute,ucirc,uuml,yacute,thorn,yuml,OElig,oelig,Scaron,scaron,Yuml"), d.entities_greek && k.push("Alpha,Beta,Gamma,Delta,Epsilon,Zeta,Eta,Theta,Iota,Kappa,Lambda,Mu,Nu,Xi,Omicron,Pi,Rho,Sigma,Tau,Upsilon,Phi,Chi,Psi,Omega,alpha,beta,gamma,delta,epsilon,zeta,eta,theta,iota,kappa,lambda,mu,nu,xi,omicron,pi,rho,sigmaf,sigma,tau,upsilon,phi,chi,psi,omega,thetasym,upsih,piv"),
                            d.entities_additional && k.push(d.entities_additional)); var m = a(k.join(",")), f = m.regex ? "[" + m.regex + "]" : "a^"; delete m.regex; d.entities && d.entities_processNumerical && (f = "[^ -~]|" + f); var f = new RegExp(f, "g"), h = a("nbsp,gt,lt,amp,shy", !0), l = new RegExp(h.regex, "g"); e.addRules({ text: function (a) { return a.replace(l, b).replace(f, c) } }, { applyToAll: !0, excludeNestedEditable: !0 })
                    }
                }
            })
        }(), CKEDITOR.config.basicEntities = !0, CKEDITOR.config.entities = !0, CKEDITOR.config.entities_latin = !0, CKEDITOR.config.entities_greek = !0,
        CKEDITOR.config.entities_additional = "#39", CKEDITOR.plugins.add("popup"), CKEDITOR.tools.extend(CKEDITOR.editor.prototype, {
            popup: function (a, e, b, c) {
                e = e || "80%"; b = b || "70%"; "string" == typeof e && 1 < e.length && "%" == e.substr(e.length - 1, 1) && (e = parseInt(window.screen.width * parseInt(e, 10) / 100, 10)); "string" == typeof b && 1 < b.length && "%" == b.substr(b.length - 1, 1) && (b = parseInt(window.screen.height * parseInt(b, 10) / 100, 10)); 640 > e && (e = 640); 420 > b && (b = 420); var d = parseInt((window.screen.height - b) / 2, 10), k = parseInt((window.screen.width -
                    e) / 2, 10); c = (c || "location\x3dno,menubar\x3dno,toolbar\x3dno,dependent\x3dyes,minimizable\x3dno,modal\x3dyes,alwaysRaised\x3dyes,resizable\x3dyes,scrollbars\x3dyes") + ",width\x3d" + e + ",height\x3d" + b + ",top\x3d" + d + ",left\x3d" + k; var m = window.open("", null, c, !0); if (!m) return !1; try { -1 == navigator.userAgent.toLowerCase().indexOf(" chrome/") && (m.moveTo(k, d), m.resizeTo(e, b)), m.focus(), m.location.href = a } catch (f) { window.open(a, null, c, !0) } return !0
            }
        }), function () {
            function a(a, b) {
                var c = []; if (b) for (var d in b) c.push(d +
                    "\x3d" + encodeURIComponent(b[d])); else return a; return a + (-1 != a.indexOf("?") ? "\x26" : "?") + c.join("\x26")
            } function e(a) { a += ""; return a.charAt(0).toUpperCase() + a.substr(1) } function b() {
                var b = this.getDialog(), c = b.getParentEditor(); c._.filebrowserSe = this; var d = c.config["filebrowser" + e(b.getName()) + "WindowWidth"] || c.config.filebrowserWindowWidth || "80%", b = c.config["filebrowser" + e(b.getName()) + "WindowHeight"] || c.config.filebrowserWindowHeight || "70%", f = this.filebrowser.params || {}; f.CKEditor = c.name; f.CKEditorFuncNum =
                    c._.filebrowserFn; f.langCode || (f.langCode = c.langCode); f = a(this.filebrowser.url, f); c.popup(f, d, b, c.config.filebrowserWindowFeatures || c.config.fileBrowserWindowFeatures)
            } function c() { var a = this.getDialog(); a.getParentEditor()._.filebrowserSe = this; return a.getContentElement(this["for"][0], this["for"][1]).getInputElement().$.value && a.getContentElement(this["for"][0], this["for"][1]).getAction() ? !0 : !1 } function d(b, c, d) {
                var f = d.params || {}; f.CKEditor = b.name; f.CKEditorFuncNum = b._.filebrowserFn; f.langCode ||
                    (f.langCode = b.langCode); c.action = a(d.url, f); c.filebrowser = d
            } function k(a, f, g, m) {
                if (m && m.length) for (var v, u = m.length; u--;)if (v = m[u], "hbox" != v.type && "vbox" != v.type && "fieldset" != v.type || k(a, f, g, v.children), v.filebrowser) if ("string" == typeof v.filebrowser && (v.filebrowser = { action: "fileButton" == v.type ? "QuickUpload" : "Browse", target: v.filebrowser }), "Browse" == v.filebrowser.action) {
                    var q = v.filebrowser.url; void 0 === q && (q = a.config["filebrowser" + e(f) + "BrowseUrl"], void 0 === q && (q = a.config.filebrowserBrowseUrl));
                    q && (v.onClick = b, v.filebrowser.url = q, v.hidden = !1)
                } else if ("QuickUpload" == v.filebrowser.action && v["for"] && (q = v.filebrowser.url, void 0 === q && (q = a.config["filebrowser" + e(f) + "UploadUrl"], void 0 === q && (q = a.config.filebrowserUploadUrl)), q)) {
                    var t = v.onClick; v.onClick = function (a) {
                        var b = a.sender; if (t && !1 === t.call(b, a)) return !1; if (c.call(b, a)) {
                            a = b.getDialog().getContentElement(this["for"][0], this["for"][1]).getInputElement(); if (b = new CKEDITOR.dom.element(a.$.form)) (a = b.$.elements.ckCsrfToken) ? a = new CKEDITOR.dom.element(a) :
                                (a = new CKEDITOR.dom.element("input"), a.setAttributes({ name: "ckCsrfToken", type: "hidden" }), b.append(a)), a.setAttribute("value", CKEDITOR.tools.getCsrfToken()); return !0
                        } return !1
                    }; v.filebrowser.url = q; v.hidden = !1; d(a, g.getContents(v["for"][0]).get(v["for"][1]), v.filebrowser)
                }
            } function m(a, b, c) { if (-1 !== c.indexOf(";")) { c = c.split(";"); for (var d = 0; d < c.length; d++)if (m(a, b, c[d])) return !0; return !1 } return (a = a.getContents(b).get(c).filebrowser) && a.url } function f(a, b) {
                var c = this._.filebrowserSe.getDialog(), d = this._.filebrowserSe["for"],
                f = this._.filebrowserSe.filebrowser.onSelect; d && c.getContentElement(d[0], d[1]).reset(); if ("function" != typeof b || !1 !== b.call(this._.filebrowserSe)) if (!f || !1 !== f.call(this._.filebrowserSe, a, b)) if ("string" == typeof b && b && alert(b), a && (d = this._.filebrowserSe, c = d.getDialog(), d = d.filebrowser.target || null)) if (d = d.split(":"), f = c.getContentElement(d[0], d[1])) f.setValue(a), c.selectPage(d[0])
            } CKEDITOR.plugins.add("filebrowser", {
                requires: "popup", init: function (a) {
                    a._.filebrowserFn = CKEDITOR.tools.addFunction(f, a);
                    a.on("destroy", function () { CKEDITOR.tools.removeFunction(this._.filebrowserFn) })
                }
            }); CKEDITOR.on("dialogDefinition", function (a) { if (a.editor.plugins.filebrowser) for (var b = a.data.definition, c, d = 0; d < b.contents.length; ++d)if (c = b.contents[d]) k(a.editor, a.data.name, b, c.elements), c.hidden && c.filebrowser && (c.hidden = !m(b, c.id, c.filebrowser)) })
        }(), function () {
            function a(a) {
                var d = a.config, k = a.fire("uiSpace", { space: "top", html: "" }).html, m = function () {
                    function f(a, c, d) { h.setStyle(c, b(d)); h.setStyle("position", a) } function g(a) {
                        var b =
                            l.getDocumentPosition(); switch (a) { case "top": f("absolute", "top", b.y - A - w); break; case "pin": f("fixed", "top", x); break; case "bottom": f("absolute", "top", b.y + (p.height || p.bottom - p.top) + w) }k = a
                    } var k, l, t, p, y, A, z, r = d.floatSpaceDockedOffsetX || 0, w = d.floatSpaceDockedOffsetY || 0, C = d.floatSpacePinnedOffsetX || 0, x = d.floatSpacePinnedOffsetY || 0; return function (f) {
                        if (l = a.editable()) {
                            var n = f && "focus" == f.name; n && h.show(); a.fire("floatingSpaceLayout", { show: n }); h.removeStyle("left"); h.removeStyle("right"); t = h.getClientRect();
                            p = l.getClientRect(); y = e.getViewPaneSize(); A = t.height; z = "pageXOffset" in e.$ ? e.$.pageXOffset : CKEDITOR.document.$.documentElement.scrollLeft; k ? (A + w <= p.top ? g("top") : A + w > y.height - p.bottom ? g("pin") : g("bottom"), f = y.width / 2, f = d.floatSpacePreferRight ? "right" : 0 < p.left && p.right < y.width && p.width > t.width ? "rtl" == d.contentsLangDirection ? "right" : "left" : f - p.left > p.right - f ? "left" : "right", t.width > y.width ? (f = "left", n = 0) : (n = "left" == f ? 0 < p.left ? p.left : 0 : p.right < y.width ? y.width - p.right : 0, n + t.width > y.width && (f = "left" == f ?
                                "right" : "left", n = 0)), h.setStyle(f, b(("pin" == k ? C : r) + n + ("pin" == k ? 0 : "left" == f ? z : -z)))) : (k = "pin", g("pin"), m(f))
                        }
                    }
                }(); if (k) {
                    var f = new CKEDITOR.template('\x3cdiv id\x3d"cke_{name}" class\x3d"cke {id} cke_reset_all cke_chrome cke_editor_{name} cke_float cke_{langDir} ' + CKEDITOR.env.cssClass + '" dir\x3d"{langDir}" title\x3d"' + (CKEDITOR.env.gecko ? " " : "") + '" lang\x3d"{langCode}" role\x3d"application" style\x3d"{style}"' + (a.title ? ' aria-labelledby\x3d"cke_{name}_arialbl"' : " ") + "\x3e" + (a.title ? '\x3cspan id\x3d"cke_{name}_arialbl" class\x3d"cke_voice_label"\x3e{voiceLabel}\x3c/span\x3e' :
                        " ") + '\x3cdiv class\x3d"cke_inner"\x3e\x3cdiv id\x3d"{topId}" class\x3d"cke_top" role\x3d"presentation"\x3e{content}\x3c/div\x3e\x3c/div\x3e\x3c/div\x3e'), h = CKEDITOR.document.getBody().append(CKEDITOR.dom.element.createFromHtml(f.output({ content: k, id: a.id, langDir: a.lang.dir, langCode: a.langCode, name: a.name, style: "display:none;z-index:" + (d.baseFloatZIndex - 1), topId: a.ui.spaceId("top"), voiceLabel: a.title }))), l = CKEDITOR.tools.eventsBuffer(500, m), g = CKEDITOR.tools.eventsBuffer(100, m); h.unselectable(); h.on("mousedown",
                            function (a) { a = a.data; a.getTarget().hasAscendant("a", 1) || a.preventDefault() }); a.on("focus", function (b) { m(b); a.on("change", l.input); e.on("scroll", g.input); e.on("resize", g.input) }); a.on("blur", function () { h.hide(); a.removeListener("change", l.input); e.removeListener("scroll", g.input); e.removeListener("resize", g.input) }); a.on("destroy", function () { e.removeListener("scroll", g.input); e.removeListener("resize", g.input); h.clearCustomData(); h.remove() }); a.focusManager.hasFocus && h.show(); a.focusManager.add(h,
                                1)
                }
            } var e = CKEDITOR.document.getWindow(), b = CKEDITOR.tools.cssLength; CKEDITOR.plugins.add("floatingspace", { init: function (b) { b.on("loaded", function () { a(this) }, null, null, 20) } })
        }(), CKEDITOR.plugins.add("listblock", {
            requires: "panel", onLoad: function () {
                var a = CKEDITOR.addTemplate("panel-list", '\x3cul role\x3d"presentation" class\x3d"cke_panel_list"\x3e{items}\x3c/ul\x3e'), e = CKEDITOR.addTemplate("panel-list-item", '\x3cli id\x3d"{id}" class\x3d"cke_panel_listItem" role\x3dpresentation\x3e\x3ca id\x3d"{id}_option" _cke_focus\x3d1 hidefocus\x3dtrue title\x3d"{title}" href\x3d"javascript:void(\'{val}\')"  {onclick}\x3d"CKEDITOR.tools.callFunction({clickFn},\'{val}\'); return false;" role\x3d"option"\x3e{text}\x3c/a\x3e\x3c/li\x3e'),
                b = CKEDITOR.addTemplate("panel-list-group", '\x3ch1 id\x3d"{id}" class\x3d"cke_panel_grouptitle" role\x3d"presentation" \x3e{label}\x3c/h1\x3e'), c = /\'/g; CKEDITOR.ui.panel.prototype.addListBlock = function (a, b) { return this.addBlock(a, new CKEDITOR.ui.listBlock(this.getHolderElement(), b)) }; CKEDITOR.ui.listBlock = CKEDITOR.tools.createClass({
                    base: CKEDITOR.ui.panel.block, $: function (a, b) {
                        b = b || {}; var c = b.attributes || (b.attributes = {}); (this.multiSelect = !!b.multiSelect) && (c["aria-multiselectable"] = !0); !c.role &&
                            (c.role = "listbox"); this.base.apply(this, arguments); this.element.setAttribute("role", c.role); c = this.keys; c[40] = "next"; c[9] = "next"; c[38] = "prev"; c[CKEDITOR.SHIFT + 9] = "prev"; c[32] = CKEDITOR.env.ie ? "mouseup" : "click"; CKEDITOR.env.ie && (c[13] = "mouseup"); this._.pendingHtml = []; this._.pendingList = []; this._.items = {}; this._.groups = {}
                    }, _: {
                        close: function () { if (this._.started) { var b = a.output({ items: this._.pendingList.join("") }); this._.pendingList = []; this._.pendingHtml.push(b); delete this._.started } }, getClick: function () {
                            this._.click ||
                            (this._.click = CKEDITOR.tools.addFunction(function (a) { var b = this.toggle(a); if (this.onClick) this.onClick(a, b) }, this)); return this._.click
                        }
                    }, proto: {
                        add: function (a, b, m) {
                            var f = CKEDITOR.tools.getNextId(); this._.started || (this._.started = 1, this._.size = this._.size || 0); this._.items[a] = f; var h; h = CKEDITOR.tools.htmlEncodeAttr(a).replace(c, "\\'"); a = { id: f, val: h, onclick: CKEDITOR.env.ie ? 'onclick\x3d"return false;" onmouseup' : "onclick", clickFn: this._.getClick(), title: CKEDITOR.tools.htmlEncodeAttr(m || a), text: b || a };
                            this._.pendingList.push(e.output(a))
                        }, startGroup: function (a) { this._.close(); var c = CKEDITOR.tools.getNextId(); this._.groups[a] = c; this._.pendingHtml.push(b.output({ id: c, label: a })) }, commit: function () { this._.close(); this.element.appendHtml(this._.pendingHtml.join("")); delete this._.size; this._.pendingHtml = [] }, toggle: function (a) { var b = this.isMarked(a); b ? this.unmark(a) : this.mark(a); return !b }, hideGroup: function (a) {
                            var b = (a = this.element.getDocument().getById(this._.groups[a])) && a.getNext(); a && (a.setStyle("display",
                                "none"), b && "ul" == b.getName() && b.setStyle("display", "none"))
                        }, hideItem: function (a) { this.element.getDocument().getById(this._.items[a]).setStyle("display", "none") }, showAll: function () { var a = this._.items, b = this._.groups, c = this.element.getDocument(), f; for (f in a) c.getById(a[f]).setStyle("display", ""); for (var e in b) a = c.getById(b[e]), f = a.getNext(), a.setStyle("display", ""), f && "ul" == f.getName() && f.setStyle("display", "") }, mark: function (a) {
                            this.multiSelect || this.unmarkAll(); a = this._.items[a]; var b = this.element.getDocument().getById(a);
                            b.addClass("cke_selected"); this.element.getDocument().getById(a + "_option").setAttribute("aria-selected", !0); this.onMark && this.onMark(b)
                        }, unmark: function (a) { var b = this.element.getDocument(); a = this._.items[a]; var c = b.getById(a); c.removeClass("cke_selected"); b.getById(a + "_option").removeAttribute("aria-selected"); this.onUnmark && this.onUnmark(c) }, unmarkAll: function () {
                            var a = this._.items, b = this.element.getDocument(), c; for (c in a) { var f = a[c]; b.getById(f).removeClass("cke_selected"); b.getById(f + "_option").removeAttribute("aria-selected") } this.onUnmark &&
                                this.onUnmark()
                        }, isMarked: function (a) { return this.element.getDocument().getById(this._.items[a]).hasClass("cke_selected") }, focus: function (a) { this._.focusIndex = -1; var b = this.element.getElementsByTag("a"), c, f = -1; if (a) for (c = this.element.getDocument().getById(this._.items[a]).getFirst(); a = b.getItem(++f);) { if (a.equals(c)) { this._.focusIndex = f; break } } else this.element.focus(); c && setTimeout(function () { c.focus() }, 0) }
                    }
                })
            }
        }), function () {
            var a = '\x3ca id\x3d"{id}" class\x3d"cke_button cke_button__{name} cke_button_{state} {cls}"' +
                (CKEDITOR.env.gecko && !CKEDITOR.env.hc ? "" : " href\x3d\"javascript:void('{titleJs}')\"") + ' title\x3d"{title}" tabindex\x3d"-1" hidefocus\x3d"true" role\x3d"button" aria-labelledby\x3d"{id}_label" aria-haspopup\x3d"{hasArrow}" aria-disabled\x3d"{ariaDisabled}"'; CKEDITOR.env.gecko && CKEDITOR.env.mac && (a += ' onkeypress\x3d"return false;"'); CKEDITOR.env.gecko && (a += ' onblur\x3d"this.style.cssText \x3d this.style.cssText;"'); var a = a + (' onkeydown\x3d"return CKEDITOR.tools.callFunction({keydownFn},event);" onfocus\x3d"return CKEDITOR.tools.callFunction({focusFn},event);" ' +
                    (CKEDITOR.env.ie ? 'onclick\x3d"return false;" onmouseup' : "onclick") + '\x3d"CKEDITOR.tools.callFunction({clickFn},this);return false;"\x3e\x3cspan class\x3d"cke_button_icon cke_button__{iconName}_icon" style\x3d"{style}"'), a = a + '\x3e\x26nbsp;\x3c/span\x3e\x3cspan id\x3d"{id}_label" class\x3d"cke_button_label cke_button__{name}_label" aria-hidden\x3d"false"\x3e{label}\x3c/span\x3e{arrowHtml}\x3c/a\x3e', e = CKEDITOR.addTemplate("buttonArrow", '\x3cspan class\x3d"cke_button_arrow"\x3e' + (CKEDITOR.env.hc ? "\x26#9660;" :
                        "") + "\x3c/span\x3e"), b = CKEDITOR.addTemplate("button", a); CKEDITOR.plugins.add("button", { beforeInit: function (a) { a.ui.addHandler(CKEDITOR.UI_BUTTON, CKEDITOR.ui.button.handler) } }); CKEDITOR.UI_BUTTON = "button"; CKEDITOR.ui.button = function (a) { CKEDITOR.tools.extend(this, a, { title: a.label, click: a.click || function (b) { b.execCommand(a.command) } }); this._ = {} }; CKEDITOR.ui.button.handler = { create: function (a) { return new CKEDITOR.ui.button(a) } }; CKEDITOR.ui.button.prototype = {
                            render: function (a, d) {
                                function k() {
                                    var b = a.mode;
                                    b && (b = this.modes[b] ? void 0 !== t[b] ? t[b] : CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED, b = a.readOnly && !this.readOnly ? CKEDITOR.TRISTATE_DISABLED : b, this.setState(b), this.refresh && this.refresh())
                                } var m = CKEDITOR.env, f = this._.id = CKEDITOR.tools.getNextId(), h = "", l = this.command, g; this._.editor = a; var n = { id: f, button: this, editor: a, focus: function () { CKEDITOR.document.getById(f).focus() }, execute: function () { this.button.click(a) }, attach: function (a) { this.button.attach(a) } }, v = CKEDITOR.tools.addFunction(function (a) {
                                    if (n.onkey) return a =
                                        new CKEDITOR.dom.event(a), !1 !== n.onkey(n, a.getKeystroke())
                                }), u = CKEDITOR.tools.addFunction(function (a) { var b; n.onfocus && (b = !1 !== n.onfocus(n, new CKEDITOR.dom.event(a))); return b }), q = 0; n.clickFn = g = CKEDITOR.tools.addFunction(function () { q && (a.unlockSelection(1), q = 0); n.execute(); m.iOS && a.focus() }); if (this.modes) {
                                    var t = {}; a.on("beforeModeUnload", function () { a.mode && this._.state != CKEDITOR.TRISTATE_DISABLED && (t[a.mode] = this._.state) }, this); a.on("activeFilterChange", k, this); a.on("mode", k, this); !this.readOnly &&
                                        a.on("readOnly", k, this)
                                } else l && (l = a.getCommand(l)) && (l.on("state", function () { this.setState(l.state) }, this), h += l.state == CKEDITOR.TRISTATE_ON ? "on" : l.state == CKEDITOR.TRISTATE_DISABLED ? "disabled" : "off"); if (this.directional) a.on("contentDirChanged", function (b) { var d = CKEDITOR.document.getById(this._.id), f = d.getFirst(); b = b.data; b != a.lang.dir ? d.addClass("cke_" + b) : d.removeClass("cke_ltr").removeClass("cke_rtl"); f.setAttribute("style", CKEDITOR.skin.getIconStyle(y, "rtl" == b, this.icon, this.iconOffset)) }, this);
                                l || (h += "off"); var p = this.name || this.command, y = p; this.icon && !/\./.test(this.icon) && (y = this.icon, this.icon = null); h = { id: f, name: p, iconName: y, label: this.label, cls: this.className || "", state: h, ariaDisabled: "disabled" == h ? "true" : "false", title: this.title, titleJs: m.gecko && !m.hc ? "" : (this.title || "").replace("'", ""), hasArrow: this.hasArrow ? "true" : "false", keydownFn: v, focusFn: u, clickFn: g, style: CKEDITOR.skin.getIconStyle(y, "rtl" == a.lang.dir, this.icon, this.iconOffset), arrowHtml: this.hasArrow ? e.output() : "" }; b.output(h,
                                    d); if (this.onRender) this.onRender(); return n
                            }, setState: function (a) {
                                if (this._.state == a) return !1; this._.state = a; var b = CKEDITOR.document.getById(this._.id); return b ? (b.setState(a, "cke_button"), a == CKEDITOR.TRISTATE_DISABLED ? b.setAttribute("aria-disabled", !0) : b.removeAttribute("aria-disabled"), this.hasArrow ? (a = a == CKEDITOR.TRISTATE_ON ? this._.editor.lang.button.selectedLabel.replace(/%1/g, this.label) : this.label, CKEDITOR.document.getById(this._.id + "_label").setText(a)) : a == CKEDITOR.TRISTATE_ON ? b.setAttribute("aria-pressed",
                                    !0) : b.removeAttribute("aria-pressed"), !0) : !1
                            }, getState: function () { return this._.state }, toFeature: function (a) { if (this._.feature) return this._.feature; var b = this; this.allowedContent || this.requiredContent || !this.command || (b = a.getCommand(this.command) || b); return this._.feature = b }
                        }; CKEDITOR.ui.prototype.addButton = function (a, b) { this.add(a, CKEDITOR.UI_BUTTON, b) }
        }(), CKEDITOR.plugins.add("richcombo", { requires: "floatpanel,listblock,button", beforeInit: function (a) { a.ui.addHandler(CKEDITOR.UI_RICHCOMBO, CKEDITOR.ui.richCombo.handler) } }),
        function () {
            var a = '\x3cspan id\x3d"{id}" class\x3d"cke_combo cke_combo__{name} {cls}" role\x3d"presentation"\x3e\x3cspan id\x3d"{id}_label" class\x3d"cke_combo_label"\x3e{label}\x3c/span\x3e\x3ca class\x3d"cke_combo_button" title\x3d"{title}" tabindex\x3d"-1"' + (CKEDITOR.env.gecko && !CKEDITOR.env.hc ? "" : " href\x3d\"javascript:void('{titleJs}')\"") + ' hidefocus\x3d"true" role\x3d"button" aria-labelledby\x3d"{id}_label" aria-haspopup\x3d"true"'; CKEDITOR.env.gecko && CKEDITOR.env.mac && (a += ' onkeypress\x3d"return false;"');
            CKEDITOR.env.gecko && (a += ' onblur\x3d"this.style.cssText \x3d this.style.cssText;"'); var a = a + (' onkeydown\x3d"return CKEDITOR.tools.callFunction({keydownFn},event,this);" onfocus\x3d"return CKEDITOR.tools.callFunction({focusFn},event);" ' + (CKEDITOR.env.ie ? 'onclick\x3d"return false;" onmouseup' : "onclick") + '\x3d"CKEDITOR.tools.callFunction({clickFn},this);return false;"\x3e\x3cspan id\x3d"{id}_text" class\x3d"cke_combo_text cke_combo_inlinelabel"\x3e{label}\x3c/span\x3e\x3cspan class\x3d"cke_combo_open"\x3e\x3cspan class\x3d"cke_combo_arrow"\x3e' +
                (CKEDITOR.env.hc ? "\x26#9660;" : CKEDITOR.env.air ? "\x26nbsp;" : "") + "\x3c/span\x3e\x3c/span\x3e\x3c/a\x3e\x3c/span\x3e"), e = CKEDITOR.addTemplate("combo", a); CKEDITOR.UI_RICHCOMBO = "richcombo"; CKEDITOR.ui.richCombo = CKEDITOR.tools.createClass({
                    $: function (a) {
                        CKEDITOR.tools.extend(this, a, { canGroup: !1, title: a.label, modes: { wysiwyg: 1 }, editorFocus: 1 }); a = this.panel || {}; delete this.panel; this.id = CKEDITOR.tools.getNextNumber(); this.document = a.parent && a.parent.getDocument() || CKEDITOR.document; a.className = "cke_combopanel";
                        a.block = { multiSelect: a.multiSelect, attributes: a.attributes }; a.toolbarRelated = !0; this._ = { panelDefinition: a, items: {} }
                    }, proto: {
                        renderHtml: function (a) { var c = []; this.render(a, c); return c.join("") }, render: function (a, c) {
                            function d() { if (this.getState() != CKEDITOR.TRISTATE_ON) { var c = this.modes[a.mode] ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED; a.readOnly && !this.readOnly && (c = CKEDITOR.TRISTATE_DISABLED); this.setState(c); this.setValue(""); c != CKEDITOR.TRISTATE_DISABLED && this.refresh && this.refresh() } } var k =
                                CKEDITOR.env, m = "cke_" + this.id, f = CKEDITOR.tools.addFunction(function (c) { v && (a.unlockSelection(1), v = 0); l.execute(c) }, this), h = this, l = { id: m, combo: this, focus: function () { CKEDITOR.document.getById(m).getChild(1).focus() }, execute: function (c) { var d = h._; if (d.state != CKEDITOR.TRISTATE_DISABLED) if (h.createPanel(a), d.on) d.panel.hide(); else { h.commit(); var f = h.getValue(); f ? d.list.mark(f) : d.list.unmarkAll(); d.panel.showBlock(h.id, new CKEDITOR.dom.element(c), 4) } }, clickFn: f }; a.on("activeFilterChange", d, this); a.on("mode",
                                    d, this); a.on("selectionChange", d, this); !this.readOnly && a.on("readOnly", d, this); var g = CKEDITOR.tools.addFunction(function (c, d) { c = new CKEDITOR.dom.event(c); var e = c.getKeystroke(); if (40 == e) a.once("panelShow", function (a) { a.data._.panel._.currentBlock.onKeyDown(40) }); switch (e) { case 13: case 32: case 40: CKEDITOR.tools.callFunction(f, d); break; default: l.onkey(l, e) }c.preventDefault() }), n = CKEDITOR.tools.addFunction(function () { l.onfocus && l.onfocus() }), v = 0; l.keyDownFn = g; k = {
                                        id: m, name: this.name || this.command, label: this.label,
                                        title: this.title, cls: this.className || "", titleJs: k.gecko && !k.hc ? "" : (this.title || "").replace("'", ""), keydownFn: g, focusFn: n, clickFn: f
                                    }; e.output(k, c); if (this.onRender) this.onRender(); return l
                        }, createPanel: function (a) {
                            if (!this._.panel) {
                                var c = this._.panelDefinition, d = this._.panelDefinition.block, e = c.parent || CKEDITOR.document.getBody(), m = "cke_combopanel__" + this.name, f = new CKEDITOR.ui.floatPanel(a, e, c), h = f.addListBlock(this.id, d), l = this; f.onShow = function () {
                                    this.element.addClass(m); l.setState(CKEDITOR.TRISTATE_ON);
                                    l._.on = 1; l.editorFocus && !a.focusManager.hasFocus && a.focus(); if (l.onOpen) l.onOpen(); a.once("panelShow", function () { h.focus(!h.multiSelect && l.getValue()) })
                                }; f.onHide = function (c) { this.element.removeClass(m); l.setState(l.modes && l.modes[a.mode] ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED); l._.on = 0; if (!c && l.onClose) l.onClose() }; f.onEscape = function () { f.hide(1) }; h.onClick = function (a, b) { l.onClick && l.onClick.call(l, a, b); f.hide() }; this._.panel = f; this._.list = h; f.getBlock(this.id).onHide = function () {
                                    l._.on =
                                    0; l.setState(CKEDITOR.TRISTATE_OFF)
                                }; this.init && this.init()
                            }
                        }, setValue: function (a, c) { this._.value = a; var d = this.document.getById("cke_" + this.id + "_text"); d && (a || c ? d.removeClass("cke_combo_inlinelabel") : (c = this.label, d.addClass("cke_combo_inlinelabel")), d.setText("undefined" != typeof c ? c : a)) }, getValue: function () { return this._.value || "" }, unmarkAll: function () { this._.list.unmarkAll() }, mark: function (a) { this._.list.mark(a) }, hideItem: function (a) { this._.list.hideItem(a) }, hideGroup: function (a) { this._.list.hideGroup(a) },
                        showAll: function () { this._.list.showAll() }, add: function (a, c, d) { this._.items[a] = d || a; this._.list.add(a, c, d) }, startGroup: function (a) { this._.list.startGroup(a) }, commit: function () { this._.committed || (this._.list.commit(), this._.committed = 1, CKEDITOR.ui.fire("ready", this)); this._.committed = 1 }, setState: function (a) {
                            if (this._.state != a) {
                                var c = this.document.getById("cke_" + this.id); c.setState(a, "cke_combo"); a == CKEDITOR.TRISTATE_DISABLED ? c.setAttribute("aria-disabled", !0) : c.removeAttribute("aria-disabled"); this._.state =
                                    a
                            }
                        }, getState: function () { return this._.state }, enable: function () { this._.state == CKEDITOR.TRISTATE_DISABLED && this.setState(this._.lastState) }, disable: function () { this._.state != CKEDITOR.TRISTATE_DISABLED && (this._.lastState = this._.state, this.setState(CKEDITOR.TRISTATE_DISABLED)) }
                    }, statics: { handler: { create: function (a) { return new CKEDITOR.ui.richCombo(a) } } }
                }); CKEDITOR.ui.prototype.addRichCombo = function (a, c) { this.add(a, CKEDITOR.UI_RICHCOMBO, c) }
        }(), CKEDITOR.plugins.add("format", {
            requires: "richcombo", init: function (a) {
                if (!a.blockless) {
                    for (var e =
                        a.config, b = a.lang.format, c = e.format_tags.split(";"), d = {}, k = 0, m = [], f = 0; f < c.length; f++) { var h = c[f], l = new CKEDITOR.style(e["format_" + h]); if (!a.filter.customConfig || a.filter.check(l)) k++, d[h] = l, d[h]._.enterMode = a.config.enterMode, m.push(l) } 0 !== k && a.ui.addRichCombo("Format", {
                            label: b.label, title: b.panelTitle, toolbar: "styles,20", allowedContent: m, panel: { css: [CKEDITOR.skin.getPath("editor")].concat(e.contentsCss), multiSelect: !1, attributes: { "aria-label": b.panelTitle } }, init: function () {
                                this.startGroup(b.panelTitle);
                                for (var a in d) { var c = b["tag_" + a]; this.add(a, d[a].buildPreview(c), c) }
                            }, onClick: function (b) { a.focus(); a.fire("saveSnapshot"); b = d[b]; var c = a.elementPath(); a[b.checkActive(c, a) ? "removeStyle" : "applyStyle"](b); setTimeout(function () { a.fire("saveSnapshot") }, 0) }, onRender: function () { a.on("selectionChange", function (b) { var c = this.getValue(); b = b.data.path; this.refresh(); for (var f in d) if (d[f].checkActive(b, a)) { f != c && this.setValue(f, a.lang.format["tag_" + f]); return } this.setValue("") }, this) }, onOpen: function () {
                                this.showAll();
                                for (var b in d) a.activeFilter.check(d[b]) || this.hideItem(b)
                            }, refresh: function () { var b = a.elementPath(); if (b) { if (b.isContextFor("p")) for (var c in d) if (a.activeFilter.check(d[c])) return; this.setState(CKEDITOR.TRISTATE_DISABLED) } }
                        })
                }
            }
        }), CKEDITOR.config.format_tags = "p;h1;h2;h3;h4;h5;h6;pre;address;div", CKEDITOR.config.format_p = { element: "p" }, CKEDITOR.config.format_div = { element: "div" }, CKEDITOR.config.format_pre = { element: "pre" }, CKEDITOR.config.format_address = { element: "address" }, CKEDITOR.config.format_h1 =
        { element: "h1" }, CKEDITOR.config.format_h2 = { element: "h2" }, CKEDITOR.config.format_h3 = { element: "h3" }, CKEDITOR.config.format_h4 = { element: "h4" }, CKEDITOR.config.format_h5 = { element: "h5" }, CKEDITOR.config.format_h6 = { element: "h6" }, function () {
            var a = { canUndo: !1, exec: function (a) { var b = a.document.createElement("hr"); a.insertElement(b) }, allowedContent: "hr", requiredContent: "hr" }; CKEDITOR.plugins.add("horizontalrule", {
                init: function (e) {
                    e.blockless || (e.addCommand("horizontalrule", a), e.ui.addButton && e.ui.addButton("HorizontalRule",
                        { label: e.lang.horizontalrule.toolbar, command: "horizontalrule", toolbar: "insert,40" }))
                }
            })
        }(), CKEDITOR.plugins.add("htmlwriter", { init: function (a) { var e = new CKEDITOR.htmlWriter; e.forceSimpleAmpersand = a.config.forceSimpleAmpersand; e.indentationChars = a.config.dataIndentationChars || "\t"; a.dataProcessor.writer = e } }), CKEDITOR.htmlWriter = CKEDITOR.tools.createClass({
            base: CKEDITOR.htmlParser.basicWriter, $: function () {
                this.base(); this.indentationChars = "\t"; this.selfClosingEnd = " /\x3e"; this.lineBreakChars = "\n"; this.sortAttributes =
                    1; this._.indent = 0; this._.indentation = ""; this._.inPre = 0; this._.rules = {}; var a = CKEDITOR.dtd, e; for (e in CKEDITOR.tools.extend({}, a.$nonBodyContent, a.$block, a.$listItem, a.$tableContent)) this.setRules(e, { indent: !a[e]["#"], breakBeforeOpen: 1, breakBeforeClose: !a[e]["#"], breakAfterClose: 1, needsSpace: e in a.$block && !(e in { li: 1, dt: 1, dd: 1 }) }); this.setRules("br", { breakAfterOpen: 1 }); this.setRules("title", { indent: 0, breakAfterOpen: 0 }); this.setRules("style", { indent: 0, breakBeforeClose: 1 }); this.setRules("pre", {
                        breakAfterOpen: 1,
                        indent: 0
                    })
            }, proto: {
                openTag: function (a) { var e = this._.rules[a]; this._.afterCloser && e && e.needsSpace && this._.needsSpace && this._.output.push("\n"); this._.indent ? this.indentation() : e && e.breakBeforeOpen && (this.lineBreak(), this.indentation()); this._.output.push("\x3c", a); this._.afterCloser = 0 }, openTagClose: function (a, e) {
                    var b = this._.rules[a]; e ? (this._.output.push(this.selfClosingEnd), b && b.breakAfterClose && (this._.needsSpace = b.needsSpace)) : (this._.output.push("\x3e"), b && b.indent && (this._.indentation += this.indentationChars));
                    b && b.breakAfterOpen && this.lineBreak(); "pre" == a && (this._.inPre = 1)
                }, attribute: function (a, e) { "string" == typeof e && (this.forceSimpleAmpersand && (e = e.replace(/&amp;/g, "\x26")), e = CKEDITOR.tools.htmlEncodeAttr(e)); this._.output.push(" ", a, '\x3d"', e, '"') }, closeTag: function (a) {
                    var e = this._.rules[a]; e && e.indent && (this._.indentation = this._.indentation.substr(this.indentationChars.length)); this._.indent ? this.indentation() : e && e.breakBeforeClose && (this.lineBreak(), this.indentation()); this._.output.push("\x3c/", a,
                        "\x3e"); "pre" == a && (this._.inPre = 0); e && e.breakAfterClose && (this.lineBreak(), this._.needsSpace = e.needsSpace); this._.afterCloser = 1
                }, text: function (a) { this._.indent && (this.indentation(), !this._.inPre && (a = CKEDITOR.tools.ltrim(a))); this._.output.push(a) }, comment: function (a) { this._.indent && this.indentation(); this._.output.push("\x3c!--", a, "--\x3e") }, lineBreak: function () { !this._.inPre && 0 < this._.output.length && this._.output.push(this.lineBreakChars); this._.indent = 1 }, indentation: function () {
                    !this._.inPre && this._.indentation &&
                    this._.output.push(this._.indentation); this._.indent = 0
                }, reset: function () { this._.output = []; this._.indent = 0; this._.indentation = ""; this._.afterCloser = 0; this._.inPre = 0; this._.needsSpace = 0 }, setRules: function (a, e) { var b = this._.rules[a]; b ? CKEDITOR.tools.extend(b, e, !0) : this._.rules[a] = e }
            }
        }), function () {
            function a(a, c) { c || (c = a.getSelection().getSelectedElement()); if (c && c.is("img") && !c.data("cke-realelement") && !c.isReadOnly()) return c } function e(a) {
                var c = a.getStyle("float"); if ("inherit" == c || "none" == c) c = 0; c ||
                    (c = a.getAttribute("align")); return c
            } CKEDITOR.plugins.add("image", {
                requires: "dialog", init: function (b) {
                    if (!b.plugins.image2) {
                        CKEDITOR.dialog.add("image", this.path + "dialogs/image.js"); var c = "img[alt,!src]{border-style,border-width,float,height,margin,margin-bottom,margin-left,margin-right,margin-top,width}"; CKEDITOR.dialog.isTabEnabled(b, "image", "advanced") && (c = "img[alt,dir,id,lang,longdesc,!src,title]{*}(*)"); b.addCommand("image", new CKEDITOR.dialogCommand("image", {
                            allowedContent: c, requiredContent: "img[alt,src]",
                            contentTransformations: [["img{width}: sizeToStyle", "img[width]: sizeToAttribute"], ["img{float}: alignmentToStyle", "img[align]: alignmentToAttribute"]]
                        })); b.ui.addButton && b.ui.addButton("Image", { label: b.lang.common.image, command: "image", toolbar: "insert,10" }); b.on("doubleclick", function (a) { var b = a.data.element; !b.is("img") || b.data("cke-realelement") || b.isReadOnly() || (a.data.dialog = "image") }); b.addMenuItems && b.addMenuItems({ image: { label: b.lang.image.menu, command: "image", group: "image" } }); b.contextMenu &&
                            b.contextMenu.addListener(function (c) { if (a(b, c)) return { image: CKEDITOR.TRISTATE_OFF } })
                    }
                }, afterInit: function (b) {
                    function c(c) { var k = b.getCommand("justify" + c); if (k) { if ("left" == c || "right" == c) k.on("exec", function (k) { var f = a(b), h; f && (h = e(f), h == c ? (f.removeStyle("float"), c == e(f) && f.removeAttribute("align")) : f.setStyle("float", c), k.cancel()) }); k.on("refresh", function (k) { var f = a(b); f && (f = e(f), this.setState(f == c ? CKEDITOR.TRISTATE_ON : "right" == c || "left" == c ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED), k.cancel()) }) } }
                    b.plugins.image2 || (c("left"), c("right"), c("center"), c("block"))
                }
            })
        }(), CKEDITOR.config.image_removeLinkByEmptyURL = !0, function () {
            function a(a, b) { var d = c.exec(a), e = c.exec(b); if (d) { if (!d[2] && "px" == e[2]) return e[1]; if ("px" == d[2] && !e[2]) return e[1] + "px" } return b } var e = CKEDITOR.htmlParser.cssStyle, b = CKEDITOR.tools.cssLength, c = /^((?:\d*(?:\.\d+))|(?:\d+))(.*)?$/i, d = {
                elements: {
                    $: function (b) {
                        var c = b.attributes; if ((c = (c = (c = c && c["data-cke-realelement"]) && new CKEDITOR.htmlParser.fragment.fromHtml(decodeURIComponent(c))) &&
                            c.children[0]) && b.attributes["data-cke-resizable"]) { var d = (new e(b)).rules; b = c.attributes; var h = d.width, d = d.height; h && (b.width = a(b.width, h)); d && (b.height = a(b.height, d)) } return c
                    }
                }
            }; CKEDITOR.plugins.add("fakeobjects", { init: function (a) { a.filter.allow("img[!data-cke-realelement,src,alt,title](*){*}", "fakeobjects") }, afterInit: function (a) { (a = (a = a.dataProcessor) && a.htmlFilter) && a.addRules(d, { applyToAll: !0 }) } }); CKEDITOR.editor.prototype.createFakeElement = function (a, c, d, h) {
                var l = this.lang.fakeobjects, l = l[d] ||
                    l.unknown; c = { "class": c, "data-cke-realelement": encodeURIComponent(a.getOuterHtml()), "data-cke-real-node-type": a.type, alt: l, title: l, align: a.getAttribute("align") || "" }; CKEDITOR.env.hc || (c.src = CKEDITOR.tools.transparentImageData); d && (c["data-cke-real-element-type"] = d); h && (c["data-cke-resizable"] = h, d = new e, h = a.getAttribute("width"), a = a.getAttribute("height"), h && (d.rules.width = b(h)), a && (d.rules.height = b(a)), d.populate(c)); return this.document.createElement("img", { attributes: c })
            }; CKEDITOR.editor.prototype.createFakeParserElement =
                function (a, c, d, h) {
                    var l = this.lang.fakeobjects, l = l[d] || l.unknown, g; g = new CKEDITOR.htmlParser.basicWriter; a.writeHtml(g); g = g.getHtml(); c = { "class": c, "data-cke-realelement": encodeURIComponent(g), "data-cke-real-node-type": a.type, alt: l, title: l, align: a.attributes.align || "" }; CKEDITOR.env.hc || (c.src = CKEDITOR.tools.transparentImageData); d && (c["data-cke-real-element-type"] = d); h && (c["data-cke-resizable"] = h, h = a.attributes, a = new e, d = h.width, h = h.height, void 0 !== d && (a.rules.width = b(d)), void 0 !== h && (a.rules.height =
                        b(h)), a.populate(c)); return new CKEDITOR.htmlParser.element("img", c)
                }; CKEDITOR.editor.prototype.restoreRealElement = function (b) { if (b.data("cke-real-node-type") != CKEDITOR.NODE_ELEMENT) return null; var c = CKEDITOR.dom.element.createFromHtml(decodeURIComponent(b.data("cke-realelement")), this.document); if (b.data("cke-resizable")) { var d = b.getStyle("width"); b = b.getStyle("height"); d && c.setAttribute("width", a(c.getAttribute("width"), d)); b && c.setAttribute("height", a(c.getAttribute("height"), b)) } return c }
        }(),
        "use strict", function () {
            function a(a) { return a.replace(/'/g, "\\$\x26") } function e(a) { for (var b, c = a.length, d = [], f = 0; f < c; f++)b = a.charCodeAt(f), d.push(b); return "String.fromCharCode(" + d.join(",") + ")" } function b(b, c) { var d = b.plugins.link, f = d.compiledProtectionFunction.params, e, h; h = [d.compiledProtectionFunction.name, "("]; for (var g = 0; g < f.length; g++)d = f[g].toLowerCase(), e = c[d], 0 < g && h.push(","), h.push("'", e ? a(encodeURIComponent(c[d])) : "", "'"); h.push(")"); return h.join("") } function c(a) {
                a = a.config.emailProtection ||
                ""; var b; a && "encode" != a && (b = {}, a.replace(/^([^(]+)\(([^)]+)\)$/, function (a, c, d) { b.name = c; b.params = []; d.replace(/[^,\s]+/g, function (a) { b.params.push(a) }) })); return b
            } CKEDITOR.plugins.add("link", {
                requires: "dialog,fakeobjects", onLoad: function () {
                    function a(b) { return c.replace(/%1/g, "rtl" == b ? "right" : "left").replace(/%2/g, "cke_contents_" + b) } var b = "background:url(" + CKEDITOR.getUrl(this.path + "images" + (CKEDITOR.env.hidpi ? "/hidpi" : "") + "/anchor.png") + ") no-repeat %1 center;border:1px dotted #00f;background-size:16px;",
                        c = ".%2 a.cke_anchor,.%2 a.cke_anchor_empty,.cke_editable.%2 a[name],.cke_editable.%2 a[data-cke-saved-name]{" + b + "padding-%1:18px;cursor:auto;}.%2 img.cke_anchor{" + b + "width:16px;min-height:15px;height:1.15em;vertical-align:text-bottom;}"; CKEDITOR.addCss(a("ltr") + a("rtl"))
                }, init: function (a) {
                    var b = "a[!href]"; CKEDITOR.dialog.isTabEnabled(a, "link", "advanced") && (b = b.replace("]", ",accesskey,charset,dir,id,lang,name,rel,tabindex,title,type]{*}(*)")); CKEDITOR.dialog.isTabEnabled(a, "link", "target") && (b = b.replace("]",
                        ",target,onclick]")); a.addCommand("link", new CKEDITOR.dialogCommand("link", { allowedContent: b, requiredContent: "a[href]" })); a.addCommand("anchor", new CKEDITOR.dialogCommand("anchor", { allowedContent: "a[!name,id]", requiredContent: "a[name]" })); a.addCommand("unlink", new CKEDITOR.unlinkCommand); a.addCommand("removeAnchor", new CKEDITOR.removeAnchorCommand); a.setKeystroke(CKEDITOR.CTRL + 76, "link"); a.ui.addButton && (a.ui.addButton("Link", { label: a.lang.link.toolbar, command: "link", toolbar: "links,10" }), a.ui.addButton("Unlink",
                            { label: a.lang.link.unlink, command: "unlink", toolbar: "links,20" }), a.ui.addButton("Anchor", { label: a.lang.link.anchor.toolbar, command: "anchor", toolbar: "links,30" })); CKEDITOR.dialog.add("link", this.path + "dialogs/link.js"); CKEDITOR.dialog.add("anchor", this.path + "dialogs/anchor.js"); a.on("doubleclick", function (b) {
                                var c = CKEDITOR.plugins.link.getSelectedLink(a) || b.data.element; c.isReadOnly() || (c.is("a") ? (b.data.dialog = !c.getAttribute("name") || c.getAttribute("href") && c.getChildCount() ? "link" : "anchor", b.data.link =
                                    c) : CKEDITOR.plugins.link.tryRestoreFakeAnchor(a, c) && (b.data.dialog = "anchor"))
                            }, null, null, 0); a.on("doubleclick", function (b) { b.data.dialog in { link: 1, anchor: 1 } && b.data.link && a.getSelection().selectElement(b.data.link) }, null, null, 20); a.addMenuItems && a.addMenuItems({
                                anchor: { label: a.lang.link.anchor.menu, command: "anchor", group: "anchor", order: 1 }, removeAnchor: { label: a.lang.link.anchor.remove, command: "removeAnchor", group: "anchor", order: 5 }, link: { label: a.lang.link.menu, command: "link", group: "link", order: 1 }, unlink: {
                                    label: a.lang.link.unlink,
                                    command: "unlink", group: "link", order: 5
                                }
                            }); a.contextMenu && a.contextMenu.addListener(function (b) { if (!b || b.isReadOnly()) return null; b = CKEDITOR.plugins.link.tryRestoreFakeAnchor(a, b); if (!b && !(b = CKEDITOR.plugins.link.getSelectedLink(a))) return null; var c = {}; b.getAttribute("href") && b.getChildCount() && (c = { link: CKEDITOR.TRISTATE_OFF, unlink: CKEDITOR.TRISTATE_OFF }); b && b.hasAttribute("name") && (c.anchor = c.removeAnchor = CKEDITOR.TRISTATE_OFF); return c }); this.compiledProtectionFunction = c(a)
                }, afterInit: function (a) {
                    a.dataProcessor.dataFilter.addRules({
                        elements: {
                            a: function (b) {
                                return b.attributes.name ?
                                    b.children.length ? null : a.createFakeParserElement(b, "cke_anchor", "anchor") : null
                            }
                        }
                    }); var b = a._.elementsPath && a._.elementsPath.filters; b && b.push(function (b, c) { if ("a" == c && (CKEDITOR.plugins.link.tryRestoreFakeAnchor(a, b) || b.getAttribute("name") && (!b.getAttribute("href") || !b.getChildCount()))) return "anchor" })
                }
            }); var d = /^javascript:/, k = /^mailto:([^?]+)(?:\?(.+))?$/, m = /subject=([^;?:@&=$,\/]*)/i, f = /body=([^;?:@&=$,\/]*)/i, h = /^#(.*)$/, l = /^((?:http|https|ftp|news):\/\/)?(.*)$/, g = /^(_(?:self|top|parent|blank))$/,
                n = /^javascript:void\(location\.href='mailto:'\+String\.fromCharCode\(([^)]+)\)(?:\+'(.*)')?\)$/, v = /^javascript:([^(]+)\(([^)]+)\)$/, u = /\s*window.open\(\s*this\.href\s*,\s*(?:'([^']*)'|null)\s*,\s*'([^']*)'\s*\)\s*;\s*return\s*false;*\s*/, q = /(?:^|,)([^=]+)=(\d+|yes|no)/gi, t = { id: "advId", dir: "advLangDir", accessKey: "advAccessKey", name: "advName", lang: "advLangCode", tabindex: "advTabIndex", title: "advTitle", type: "advContentType", "class": "advCSSClasses", charset: "advCharset", style: "advStyles", rel: "advRel" };
            CKEDITOR.plugins.link = {
                getSelectedLink: function (a) { var b = a.getSelection(), c = b.getSelectedElement(); return c && c.is("a") ? c : (b = b.getRanges()[0]) ? (b.shrink(CKEDITOR.SHRINK_TEXT), a.elementPath(b.getCommonAncestor()).contains("a", 1)) : null }, getEditorAnchors: function (a) {
                    for (var b = a.editable(), c = b.isInline() && !a.plugins.divarea ? a.document : b, b = c.getElementsByTag("a"), c = c.getElementsByTag("img"), d = [], f = 0, e; e = b.getItem(f++);)(e.data("cke-saved-name") || e.hasAttribute("name")) && d.push({
                        name: e.data("cke-saved-name") ||
                            e.getAttribute("name"), id: e.getAttribute("id")
                    }); for (f = 0; e = c.getItem(f++);)(e = this.tryRestoreFakeAnchor(a, e)) && d.push({ name: e.getAttribute("name"), id: e.getAttribute("id") }); return d
                }, fakeAnchor: !0, tryRestoreFakeAnchor: function (a, b) { if (b && b.data("cke-real-element-type") && "anchor" == b.data("cke-real-element-type")) { var c = a.restoreRealElement(b); if (c.data("cke-saved-name")) return c } }, parseLinkAttributes: function (a, b) {
                    var c = b && (b.data("cke-saved-href") || b.getAttribute("href")) || "", e = a.plugins.link.compiledProtectionFunction,
                    r = a.config.emailProtection, w, C = {}; c.match(d) && ("encode" == r ? c = c.replace(n, function (a, b, c) { c = c || ""; return "mailto:" + String.fromCharCode.apply(String, b.split(",")) + c.replace(/\\'/g, "'") }) : r && c.replace(v, function (a, b, c) { if (b == e.name) { C.type = "email"; a = C.email = {}; b = /(^')|('$)/g; c = c.match(/[^,\s]+/g); for (var d = c.length, f, h, g = 0; g < d; g++)f = decodeURIComponent, h = c[g].replace(b, "").replace(/\\'/g, "'"), h = f(h), f = e.params[g].toLowerCase(), a[f] = h; a.address = [a.name, a.domain].join("@") } })); if (!C.type) if (r = c.match(h)) C.type =
                        "anchor", C.anchor = {}, C.anchor.name = C.anchor.id = r[1]; else if (r = c.match(k)) { w = c.match(m); c = c.match(f); C.type = "email"; var x = C.email = {}; x.address = r[1]; w && (x.subject = decodeURIComponent(w[1])); c && (x.body = decodeURIComponent(c[1])) } else c && (w = c.match(l)) && (C.type = "url", C.url = {}, C.url.protocol = w[1], C.url.url = w[2]); if (b) {
                            if (c = b.getAttribute("target")) C.target = { type: c.match(g) ? c : "frame", name: c }; else if (c = (c = b.data("cke-pa-onclick") || b.getAttribute("onclick")) && c.match(u)) for (C.target = { type: "popup", name: c[1] }; r =
                                q.exec(c[2]);)"yes" != r[2] && "1" != r[2] || r[1] in { height: 1, width: 1, top: 1, left: 1 } ? isFinite(r[2]) && (C.target[r[1]] = r[2]) : C.target[r[1]] = !0; var c = {}, B; for (B in t) (r = b.getAttribute(B)) && (c[t[B]] = r); if (B = b.data("cke-saved-name") || c.advName) c.advName = B; CKEDITOR.tools.isEmpty(c) || (C.advanced = c)
                        } return C
                }, getLinkAttributes: function (c, d) {
                    var f = c.config.emailProtection || "", h = {}; switch (d.type) {
                        case "url": var f = d.url && void 0 !== d.url.protocol ? d.url.protocol : "http://", g = d.url && CKEDITOR.tools.trim(d.url.url) || ""; h["data-cke-saved-href"] =
                            0 === g.indexOf("/") ? g : f + g; break; case "anchor": f = d.anchor && d.anchor.id; h["data-cke-saved-href"] = "#" + (d.anchor && d.anchor.name || f || ""); break; case "email": var k = d.email, g = k.address; switch (f) {
                                case "": case "encode": var l = encodeURIComponent(k.subject || ""), m = encodeURIComponent(k.body || ""), k = []; l && k.push("subject\x3d" + l); m && k.push("body\x3d" + m); k = k.length ? "?" + k.join("\x26") : ""; "encode" == f ? (f = ["javascript:void(location.href\x3d'mailto:'+", e(g)], k && f.push("+'", a(k), "'"), f.push(")")) : f = ["mailto:", g, k]; break; default: f =
                                    g.split("@", 2), k.name = f[0], k.domain = f[1], f = ["javascript:", b(c, k)]
                            }h["data-cke-saved-href"] = f.join("")
                    }if (d.target) if ("popup" == d.target.type) {
                        for (var f = ["window.open(this.href, '", d.target.name || "", "', '"], n = "resizable status location toolbar menubar fullscreen scrollbars dependent".split(" "), g = n.length, l = function (a) { d.target[a] && n.push(a + "\x3d" + d.target[a]) }, k = 0; k < g; k++)n[k] += d.target[n[k]] ? "\x3dyes" : "\x3dno"; l("width"); l("left"); l("height"); l("top"); f.push(n.join(","), "'); return false;"); h["data-cke-pa-onclick"] =
                            f.join("")
                    } else "notSet" != d.target.type && d.target.name && (h.target = d.target.name); if (d.advanced) { for (var q in t) (f = d.advanced[t[q]]) && (h[q] = f); h.name && (h["data-cke-saved-name"] = h.name) } h["data-cke-saved-href"] && (h.href = h["data-cke-saved-href"]); q = { target: 1, onclick: 1, "data-cke-pa-onclick": 1, "data-cke-saved-name": 1 }; d.advanced && CKEDITOR.tools.extend(q, t); for (var u in h) delete q[u]; return { set: h, removed: CKEDITOR.tools.objectKeys(q) }
                }
            }; CKEDITOR.unlinkCommand = function () { }; CKEDITOR.unlinkCommand.prototype =
                { exec: function (a) { var b = new CKEDITOR.style({ element: "a", type: CKEDITOR.STYLE_INLINE, alwaysRemoveElement: 1 }); a.removeStyle(b) }, refresh: function (a, b) { var c = b.lastElement && b.lastElement.getAscendant("a", !0); c && "a" == c.getName() && c.getAttribute("href") && c.getChildCount() ? this.setState(CKEDITOR.TRISTATE_OFF) : this.setState(CKEDITOR.TRISTATE_DISABLED) }, contextSensitive: 1, startDisabled: 1, requiredContent: "a[href]" }; CKEDITOR.removeAnchorCommand = function () { }; CKEDITOR.removeAnchorCommand.prototype = {
                    exec: function (a) {
                        var b =
                            a.getSelection(), c = b.createBookmarks(), d; if (b && (d = b.getSelectedElement()) && (d.getChildCount() ? d.is("a") : CKEDITOR.plugins.link.tryRestoreFakeAnchor(a, d))) d.remove(1); else if (d = CKEDITOR.plugins.link.getSelectedLink(a)) d.hasAttribute("href") ? (d.removeAttributes({ name: 1, "data-cke-saved-name": 1 }), d.removeClass("cke_anchor")) : d.remove(1); b.selectBookmarks(c)
                    }, requiredContent: "a[name]"
                }; CKEDITOR.tools.extend(CKEDITOR.config, { linkShowAdvancedTab: !0, linkShowTargetTab: !0 })
        }(), "use strict", function () {
            function a(a,
                b, c) { return n(b) && n(c) && c.equals(b.getNext(function (a) { return !(Z(a) || X(a) || v(a)) })) } function e(a) { this.upper = a[0]; this.lower = a[1]; this.set.apply(this, a.slice(2)) } function b(a) { var b = a.element; if (b && n(b) && (b = b.getAscendant(a.triggers, !0)) && a.editable.contains(b)) { var c = m(b); if ("true" == c.getAttribute("contenteditable")) return b; if (c.is(a.triggers)) return c } return null } function c(a, b, c) { r(a, b); r(a, c); a = b.size.bottom; c = c.size.top; return a && c ? 0 | (a + c) / 2 : a || c } function d(a, b, c) {
                    return b = b[c ? "getPrevious" :
                        "getNext"](function (b) { return b && b.type == CKEDITOR.NODE_TEXT && !Z(b) || n(b) && !v(b) && !g(a, b) })
                } function k(a, b, c) { return a > b && a < c } function m(a, b) { if (a.data("cke-editable")) return null; for (b || (a = a.getParent()); a && !a.data("cke-editable");) { if (a.hasAttribute("contenteditable")) return a; a = a.getParent() } return null } function f(a) {
                    var b = a.doc, c = F('\x3cspan contenteditable\x3d"false" style\x3d"' + Q + "position:absolute;border-top:1px dashed " + a.boxColor + '"\x3e\x3c/span\x3e', b), d = CKEDITOR.getUrl(this.path + "images/" +
                        (E.hidpi ? "hidpi/" : "") + "icon" + (a.rtl ? "-rtl" : "") + ".png"); B(c, {
                            attach: function () { this.wrap.getParent() || this.wrap.appendTo(a.editable, !0); return this }, lineChildren: [B(F('\x3cspan title\x3d"' + a.editor.lang.magicline.title + '" contenteditable\x3d"false"\x3e\x26#8629;\x3c/span\x3e', b), {
                                base: Q + "height:17px;width:17px;" + (a.rtl ? "left" : "right") + ":17px;background:url(" + d + ") center no-repeat " + a.boxColor + ";cursor:pointer;" + (E.hc ? "font-size: 15px;line-height:14px;border:1px solid #fff;text-align:center;" : "") + (E.hidpi ?
                                    "background-size: 9px 10px;" : ""), looks: ["top:-8px; border-radius: 2px;", "top:-17px; border-radius: 2px 2px 0px 0px;", "top:-1px; border-radius: 0px 0px 2px 2px;"]
                            }), B(F(V, b), { base: Y + "left:0px;border-left-color:" + a.boxColor + ";", looks: ["border-width:8px 0 8px 8px;top:-8px", "border-width:8px 0 0 8px;top:-8px", "border-width:0 0 8px 8px;top:0px"] }), B(F(V, b), { base: Y + "right:0px;border-right-color:" + a.boxColor + ";", looks: ["border-width:8px 8px 8px 0;top:-8px", "border-width:8px 8px 0 0;top:-8px", "border-width:0 8px 8px 0;top:0px"] })],
                            detach: function () { this.wrap.getParent() && this.wrap.remove(); return this }, mouseNear: function () { r(a, this); var b = a.holdDistance, c = this.size; return c && k(a.mouse.y, c.top - b, c.bottom + b) && k(a.mouse.x, c.left - b, c.right + b) ? !0 : !1 }, place: function () {
                                var b = a.view, c = a.editable, d = a.trigger, f = d.upper, e = d.lower, h = f || e, g = h.getParent(), l = {}; this.trigger = d; f && r(a, f, !0); e && r(a, e, !0); r(a, g, !0); a.inInlineMode && w(a, !0); g.equals(c) ? (l.left = b.scroll.x, l.right = -b.scroll.x, l.width = "") : (l.left = h.size.left - h.size.margin.left + b.scroll.x -
                                    (a.inInlineMode ? b.editable.left + b.editable.border.left : 0), l.width = h.size.outerWidth + h.size.margin.left + h.size.margin.right + b.scroll.x, l.right = ""); f && e ? l.top = f.size.margin.bottom === e.size.margin.top ? 0 | f.size.bottom + f.size.margin.bottom / 2 : f.size.margin.bottom < e.size.margin.top ? f.size.bottom + f.size.margin.bottom : f.size.bottom + f.size.margin.bottom - e.size.margin.top : f ? e || (l.top = f.size.bottom + f.size.margin.bottom) : l.top = e.size.top - e.size.margin.top; d.is(T) || k(l.top, b.scroll.y - 15, b.scroll.y + 5) ? (l.top = a.inInlineMode ?
                                        0 : b.scroll.y, this.look(T)) : d.is(O) || k(l.top, b.pane.bottom - 5, b.pane.bottom + 15) ? (l.top = a.inInlineMode ? b.editable.height + b.editable.padding.top + b.editable.padding.bottom : b.pane.bottom - 1, this.look(O)) : (a.inInlineMode && (l.top -= b.editable.top + b.editable.border.top), this.look(J)); a.inInlineMode && (l.top--, l.top += b.editable.scroll.top, l.left += b.editable.scroll.left); for (var m in l) l[m] = CKEDITOR.tools.cssLength(l[m]); this.setStyles(l)
                            }, look: function (a) {
                                if (this.oldLook != a) {
                                    for (var b = this.lineChildren.length,
                                        c; b--;)(c = this.lineChildren[b]).setAttribute("style", c.base + c.looks[0 | a / 2]); this.oldLook = a
                                }
                            }, wrap: new D("span", a.doc)
                        }); for (b = c.lineChildren.length; b--;)c.lineChildren[b].appendTo(c); c.look(J); c.appendTo(c.wrap); c.unselectable(); c.lineChildren[0].on("mouseup", function (b) { c.detach(); h(a, function (b) { var c = a.line.trigger; b[c.is(N) ? "insertBefore" : "insertAfter"](c.is(N) ? c.lower : c.upper) }, !0); a.editor.focus(); E.ie || a.enterMode == CKEDITOR.ENTER_BR || a.hotNode.scrollIntoView(); b.data.preventDefault(!0) }); c.on("mousedown",
                            function (a) { a.data.preventDefault(!0) }); a.line = c
                } function h(a, b, c) { var d = new CKEDITOR.dom.range(a.doc), f = a.editor, e; E.ie && a.enterMode == CKEDITOR.ENTER_BR ? e = a.doc.createText(ca) : (e = (e = m(a.element, !0)) && e.data("cke-enter-mode") || a.enterMode, e = new D(L[e], a.doc), e.is("br") || a.doc.createText(ca).appendTo(e)); c && f.fire("saveSnapshot"); b(e); d.moveToPosition(e, CKEDITOR.POSITION_AFTER_START); f.getSelection().selectRanges([d]); a.hotNode = e; c && f.fire("saveSnapshot") } function l(a, c) {
                    return {
                        canUndo: !0, modes: { wysiwyg: 1 },
                        exec: function () {
                            function f(b) { var d = E.ie && 9 > E.version ? " " : ca, e = a.hotNode && a.hotNode.getText() == d && a.element.equals(a.hotNode) && a.lastCmdDirection === !!c; h(a, function (d) { e && a.hotNode && a.hotNode.remove(); d[c ? "insertAfter" : "insertBefore"](b); d.setAttributes({ "data-cke-magicline-hot": 1, "data-cke-magicline-dir": !!c }); a.lastCmdDirection = !!c }); E.ie || a.enterMode == CKEDITOR.ENTER_BR || a.hotNode.scrollIntoView(); a.line.detach() } return function (e) {
                                e = e.getSelection().getStartElement(); var h; e = e.getAscendant(M, 1);
                                if (!t(a, e) && e && !e.equals(a.editable) && !e.contains(a.editable)) { (h = m(e)) && "false" == h.getAttribute("contenteditable") && (e = h); a.element = e; h = d(a, e, !c); var g; n(h) && h.is(a.triggers) && h.is(K) && (!d(a, h, !c) || (g = d(a, h, !c)) && n(g) && g.is(a.triggers)) ? f(h) : (g = b(a, e), n(g) && (d(a, g, !c) ? (e = d(a, g, !c)) && n(e) && e.is(a.triggers) && f(g) : f(g))) }
                            }
                        }()
                    }
                } function g(a, b) { if (!b || b.type != CKEDITOR.NODE_ELEMENT || !b.$) return !1; var c = a.line; return c.wrap.equals(b) || c.wrap.contains(b) } function n(a) {
                    return a && a.type == CKEDITOR.NODE_ELEMENT &&
                        a.$
                } function v(a) { if (!n(a)) return !1; var b; (b = u(a)) || (n(a) ? (b = { left: 1, right: 1, center: 1 }, b = !(!b[a.getComputedStyle("float")] && !b[a.getAttribute("align")])) : b = !1); return b } function u(a) { return !!{ absolute: 1, fixed: 1 }[a.getComputedStyle("position")] } function q(a, b) { return n(b) ? b.is(a.triggers) : null } function t(a, b) { if (!b) return !1; for (var c = b.getParents(1), d = c.length; d--;)for (var f = a.tabuList.length; f--;)if (c[d].hasAttribute(a.tabuList[f])) return !0; return !1 } function p(a, b, c) {
                    b = b[c ? "getLast" : "getFirst"](function (b) {
                        return a.isRelevant(b) &&
                            !b.is(U)
                    }); if (!b) return !1; r(a, b); return c ? b.size.top > a.mouse.y : b.size.bottom < a.mouse.y
                } function y(a) {
                    var b = a.editable, c = a.mouse, d = a.view, f = a.triggerOffset; w(a); var h = c.y > (a.inInlineMode ? d.editable.top + d.editable.height / 2 : Math.min(d.editable.height, d.pane.height) / 2), b = b[h ? "getLast" : "getFirst"](function (a) { return !(Z(a) || X(a)) }); if (!b) return null; g(a, b) && (b = a.line.wrap[h ? "getPrevious" : "getNext"](function (a) { return !(Z(a) || X(a)) })); if (!n(b) || v(b) || !q(a, b)) return null; r(a, b); return !h && 0 <= b.size.top && k(c.y,
                        0, b.size.top + f) ? (a = a.inInlineMode || 0 === d.scroll.y ? T : J, new e([null, b, N, P, a])) : h && b.size.bottom <= d.pane.height && k(c.y, b.size.bottom - f, d.pane.height) ? (a = a.inInlineMode || k(b.size.bottom, d.pane.height - f, d.pane.height) ? O : J, new e([b, null, H, P, a])) : null
                } function A(a) {
                    var c = a.mouse, f = a.view, h = a.triggerOffset, g = b(a); if (!g) return null; r(a, g); var h = Math.min(h, 0 | g.size.outerHeight / 2), l = [], m, u; if (k(c.y, g.size.top - 1, g.size.top + h)) u = !1; else if (k(c.y, g.size.bottom - h, g.size.bottom + 1)) u = !0; else return null; if (v(g) ||
                        p(a, g, u) || g.getParent().is(W)) return null; var t = d(a, g, !u); if (t) { if (t && t.type == CKEDITOR.NODE_TEXT) return null; if (n(t)) { if (v(t) || !q(a, t) || t.getParent().is(W)) return null; l = [t, g][u ? "reverse" : "concat"]().concat([R, P]) } } else g.equals(a.editable[u ? "getLast" : "getFirst"](a.isRelevant)) ? (w(a), u && k(c.y, g.size.bottom - h, f.pane.height) && k(g.size.bottom, f.pane.height - h, f.pane.height) ? m = O : k(c.y, 0, g.size.top + h) && (m = T)) : m = J, l = [null, g][u ? "reverse" : "concat"]().concat([u ? H : N, P, m, g.equals(a.editable[u ? "getLast" : "getFirst"](a.isRelevant)) ?
                            u ? O : T : J]); return 0 in l ? new e(l) : null
                } function z(a, b, c, d) {
                    for (var f = b.getDocumentPosition(), e = {}, h = {}, g = {}, k = {}, l = ba.length; l--;)e[ba[l]] = parseInt(b.getComputedStyle.call(b, "border-" + ba[l] + "-width"), 10) || 0, g[ba[l]] = parseInt(b.getComputedStyle.call(b, "padding-" + ba[l]), 10) || 0, h[ba[l]] = parseInt(b.getComputedStyle.call(b, "margin-" + ba[l]), 10) || 0; c && !d || C(a, d); k.top = f.y - (c ? 0 : a.view.scroll.y); k.left = f.x - (c ? 0 : a.view.scroll.x); k.outerWidth = b.$.offsetWidth; k.outerHeight = b.$.offsetHeight; k.height = k.outerHeight -
                        (g.top + g.bottom + e.top + e.bottom); k.width = k.outerWidth - (g.left + g.right + e.left + e.right); k.bottom = k.top + k.outerHeight; k.right = k.left + k.outerWidth; a.inInlineMode && (k.scroll = { top: b.$.scrollTop, left: b.$.scrollLeft }); return B({ border: e, padding: g, margin: h, ignoreScroll: c }, k, !0)
                } function r(a, b, c) { if (!n(b)) return b.size = null; if (!b.size) b.size = {}; else if (b.size.ignoreScroll == c && b.size.date > new Date - S) return null; return B(b.size, z(a, b, c), { date: +new Date }, !0) } function w(a, b) { a.view.editable = z(a, a.editable, b, !0) }
            function C(a, b) { a.view || (a.view = {}); var c = a.view; if (!(!b && c && c.date > new Date - S)) { var d = a.win, c = d.getScrollPosition(), d = d.getViewPaneSize(); B(a.view, { scroll: { x: c.x, y: c.y, width: a.doc.$.documentElement.scrollWidth - d.width, height: a.doc.$.documentElement.scrollHeight - d.height }, pane: { width: d.width, height: d.height, bottom: d.height + c.y }, date: +new Date }, !0) } } function x(a, b, c, d) {
                for (var f = d, h = d, g = 0, k = !1, l = !1, m = a.view.pane.height, n = a.mouse; n.y + g < m && 0 < n.y - g;) {
                    k || (k = b(f, d)); l || (l = b(h, d)); !k && 0 < n.y - g && (f = c(a, {
                        x: n.x,
                        y: n.y - g
                    })); !l && n.y + g < m && (h = c(a, { x: n.x, y: n.y + g })); if (k && l) break; g += 2
                } return new e([f, h, null, null])
            } CKEDITOR.plugins.add("magicline", {
                init: function (a) {
                    var c = a.config, k = c.magicline_triggerOffset || 30, m = {
                        editor: a, enterMode: c.enterMode, triggerOffset: k, holdDistance: 0 | k * (c.magicline_holdDistance || .5), boxColor: c.magicline_color || "#ff0000", rtl: "rtl" == c.contentsLangDirection, tabuList: ["data-cke-hidden-sel"].concat(c.magicline_tabuList || []), triggers: c.magicline_everywhere ? M : {
                            table: 1, hr: 1, div: 1, ul: 1, ol: 1, dl: 1,
                            form: 1, blockquote: 1
                        }
                    }, q, p, r; m.isRelevant = function (a) { return n(a) && !g(m, a) && !v(a) }; a.on("contentDom", function () {
                        var k = a.editable(), n = a.document, v = a.window; B(m, { editable: k, inInlineMode: k.isInline(), doc: n, win: v, hotNode: null }, !0); m.boundary = m.inInlineMode ? m.editable : m.doc.getDocumentElement(); k.is(G.$inline) || (m.inInlineMode && !u(k) && k.setStyles({ position: "relative", top: null, left: null }), f.call(this, m), C(m), k.attachListener(a, "beforeUndoImage", function () { m.line.detach() }), k.attachListener(a, "beforeGetData",
                            function () { m.line.wrap.getParent() && (m.line.detach(), a.once("getData", function () { m.line.attach() }, null, null, 1E3)) }, null, null, 0), k.attachListener(m.inInlineMode ? n : n.getWindow().getFrame(), "mouseout", function (b) { if ("wysiwyg" == a.mode) if (m.inInlineMode) { var c = b.data.$.clientX; b = b.data.$.clientY; C(m); w(m, !0); var d = m.view.editable, f = m.view.scroll; c > d.left - f.x && c < d.right - f.x && b > d.top - f.y && b < d.bottom - f.y || (clearTimeout(r), r = null, m.line.detach()) } else clearTimeout(r), r = null, m.line.detach() }), k.attachListener(k,
                                "keyup", function () { m.hiddenMode = 0 }), k.attachListener(k, "keydown", function (b) { if ("wysiwyg" == a.mode) switch (b.data.getKeystroke()) { case 2228240: case 16: m.hiddenMode = 1, m.line.detach() } }), k.attachListener(m.inInlineMode ? k : n, "mousemove", function (b) {
                                    p = !0; if ("wysiwyg" == a.mode && !a.readOnly && !r) {
                                        var c = { x: b.data.$.clientX, y: b.data.$.clientY }; r = setTimeout(function () {
                                            m.mouse = c; r = m.trigger = null; C(m); p && !m.hiddenMode && a.focusManager.hasFocus && !m.line.mouseNear() && (m.element = da(m, !0)) && ((m.trigger = y(m) || A(m) || ga(m)) &&
                                                !t(m, m.trigger.upper || m.trigger.lower) ? m.line.attach().place() : (m.trigger = null, m.line.detach()), p = !1)
                                        }, 30)
                                    }
                                }), k.attachListener(v, "scroll", function () { "wysiwyg" == a.mode && (m.line.detach(), E.webkit && (m.hiddenMode = 1, clearTimeout(q), q = setTimeout(function () { m.mouseDown || (m.hiddenMode = 0) }, 50))) }), k.attachListener(I ? n : v, "mousedown", function () { "wysiwyg" == a.mode && (m.line.detach(), m.hiddenMode = 1, m.mouseDown = 1) }), k.attachListener(I ? n : v, "mouseup", function () { m.hiddenMode = 0; m.mouseDown = 0 }), a.addCommand("accessPreviousSpace",
                                    l(m)), a.addCommand("accessNextSpace", l(m, !0)), a.setKeystroke([[c.magicline_keystrokePrevious, "accessPreviousSpace"], [c.magicline_keystrokeNext, "accessNextSpace"]]), a.on("loadSnapshot", function () { var b, c, d, f; for (f in { p: 1, br: 1, div: 1 }) for (b = a.document.getElementsByTag(f), d = b.count(); d--;)if ((c = b.getItem(d)).data("cke-magicline-hot")) { m.hotNode = c; m.lastCmdDirection = "true" === c.data("cke-magicline-dir") ? !0 : !1; return } }), this.backdoor = {
                                        accessFocusSpace: h, boxTrigger: e, isLine: g, getAscendantTrigger: b, getNonEmptyNeighbour: d,
                                        getSize: z, that: m, triggerEdge: A, triggerEditable: y, triggerExpand: ga
                                    })
                    }, this)
                }
            }); var B = CKEDITOR.tools.extend, D = CKEDITOR.dom.element, F = D.createFromHtml, E = CKEDITOR.env, I = CKEDITOR.env.ie && 9 > CKEDITOR.env.version, G = CKEDITOR.dtd, L = {}, N = 128, H = 64, R = 32, P = 16, T = 4, O = 2, J = 1, ca = "Â ", W = G.$listItem, U = G.$tableContent, K = B({}, G.$nonEditable, G.$empty), M = G.$block, S = 100, Q = "width:0px;height:0px;padding:0px;margin:0px;display:block;z-index:9999;color:#fff;position:absolute;font-size: 0px;line-height:0px;", Y = Q + "border-color:transparent;display:block;border-style:solid;",
                V = "\x3cspan\x3e" + ca + "\x3c/span\x3e"; L[CKEDITOR.ENTER_BR] = "br"; L[CKEDITOR.ENTER_P] = "p"; L[CKEDITOR.ENTER_DIV] = "div"; e.prototype = { set: function (a, b, c) { this.properties = a + b + (c || J); return this }, is: function (a) { return (this.properties & a) == a } }; var da = function () {
                    function a(b, c) { var d = b.$.elementFromPoint(c.x, c.y); return d && d.nodeType ? new CKEDITOR.dom.element(d) : null } return function (b, c, d) {
                        if (!b.mouse) return null; var f = b.doc, e = b.line.wrap; d = d || b.mouse; var h = a(f, d); c && g(b, h) && (e.hide(), h = a(f, d), e.show()); return !h ||
                            h.type != CKEDITOR.NODE_ELEMENT || !h.$ || E.ie && 9 > E.version && !b.boundary.equals(h) && !b.boundary.contains(h) ? null : h
                    }
                }(), Z = CKEDITOR.dom.walker.whitespaces(), X = CKEDITOR.dom.walker.nodeType(CKEDITOR.NODE_COMMENT), ga = function () {
                    function b(f) {
                        var e = f.element, h, g, l; if (!n(e) || e.contains(f.editable) || e.isReadOnly()) return null; l = x(f, function (a, b) { return !b.equals(a) }, function (a, b) { return da(a, !0, b) }, e); h = l.upper; g = l.lower; if (a(f, h, g)) return l.set(R, 8); if (h && e.contains(h)) for (; !h.getParent().equals(e);)h = h.getParent();
                        else h = e.getFirst(function (a) { return d(f, a) }); if (g && e.contains(g)) for (; !g.getParent().equals(e);)g = g.getParent(); else g = e.getLast(function (a) { return d(f, a) }); if (!h || !g) return null; r(f, h); r(f, g); if (!k(f.mouse.y, h.size.top, g.size.bottom)) return null; for (var e = Number.MAX_VALUE, m, q, u, p; g && !g.equals(h) && (q = h.getNext(f.isRelevant));)m = Math.abs(c(f, h, q) - f.mouse.y), m < e && (e = m, u = h, p = q), h = q, r(f, h); if (!u || !p || !k(f.mouse.y, u.size.top, p.size.bottom)) return null; l.upper = u; l.lower = p; return l.set(R, 8)
                    } function d(a,
                        b) { return !(b && b.type == CKEDITOR.NODE_TEXT || X(b) || v(b) || g(a, b) || b.type == CKEDITOR.NODE_ELEMENT && b.$ && b.is("br")) } return function (c) { var d = b(c), f; if (f = d) { f = d.upper; var e = d.lower; f = !f || !e || v(e) || v(f) || e.equals(f) || f.equals(e) || e.contains(f) || f.contains(e) ? !1 : q(c, f) && q(c, e) && a(c, f, e) ? !0 : !1 } return f ? d : null }
                }(), ba = ["top", "left", "right", "bottom"]
        }(), CKEDITOR.config.magicline_keystrokePrevious = CKEDITOR.CTRL + CKEDITOR.SHIFT + 51, CKEDITOR.config.magicline_keystrokeNext = CKEDITOR.CTRL + CKEDITOR.SHIFT + 52, function () {
            function a(a) {
                if (!a ||
                    a.type != CKEDITOR.NODE_ELEMENT || "form" != a.getName()) return []; for (var b = [], c = ["style", "className"], d = 0; d < c.length; d++) { var e = a.$.elements.namedItem(c[d]); e && (e = new CKEDITOR.dom.element(e), b.push([e, e.nextSibling]), e.remove()) } return b
            } function e(a, b) { if (a && a.type == CKEDITOR.NODE_ELEMENT && "form" == a.getName() && 0 < b.length) for (var c = b.length - 1; 0 <= c; c--) { var d = b[c][0], e = b[c][1]; e ? d.insertBefore(e) : d.appendTo(a) } } function b(b, c) {
                var d = a(b), h = {}, l = b.$; c || (h["class"] = l.className || "", l.className = ""); h.inline =
                    l.style.cssText || ""; c || (l.style.cssText = "position: static; overflow: visible"); e(d); return h
            } function c(b, c) { var d = a(b), h = b.$; "class" in c && (h.className = c["class"]); "inline" in c && (h.style.cssText = c.inline); e(d) } function d(a) { if (!a.editable().isInline()) { var b = CKEDITOR.instances, c; for (c in b) { var d = b[c]; "wysiwyg" != d.mode || d.readOnly || (d = d.document.getBody(), d.setAttribute("contentEditable", !1), d.setAttribute("contentEditable", !0)) } a.editable().hasFocus && (a.toolbox.focus(), a.focus()) } } CKEDITOR.plugins.add("maximize",
                {
                    init: function (a) {
                        function e() { var b = l.getViewPaneSize(); a.resize(b.width, b.height, null, !0) } if (a.elementMode != CKEDITOR.ELEMENT_MODE_INLINE) {
                            var f = a.lang, h = CKEDITOR.document, l = h.getWindow(), g, n, v, u = CKEDITOR.TRISTATE_OFF; a.addCommand("maximize", {
                                modes: { wysiwyg: !CKEDITOR.env.iOS, source: !CKEDITOR.env.iOS }, readOnly: 1, editorFocus: !1, exec: function () {
                                    var q = a.container.getFirst(function (a) { return a.type == CKEDITOR.NODE_ELEMENT && a.hasClass("cke_inner") }), t = a.ui.space("contents"); if ("wysiwyg" == a.mode) {
                                        var p =
                                            a.getSelection(); g = p && p.getRanges(); n = l.getScrollPosition()
                                    } else { var y = a.editable().$; g = !CKEDITOR.env.ie && [y.selectionStart, y.selectionEnd]; n = [y.scrollLeft, y.scrollTop] } if (this.state == CKEDITOR.TRISTATE_OFF) {
                                        l.on("resize", e); v = l.getScrollPosition(); for (p = a.container; p = p.getParent();)p.setCustomData("maximize_saved_styles", b(p)), p.setStyle("z-index", a.config.baseFloatZIndex - 5); t.setCustomData("maximize_saved_styles", b(t, !0)); q.setCustomData("maximize_saved_styles", b(q, !0)); t = {
                                            overflow: CKEDITOR.env.webkit ?
                                                "" : "hidden", width: 0, height: 0
                                        }; h.getDocumentElement().setStyles(t); !CKEDITOR.env.gecko && h.getDocumentElement().setStyle("position", "fixed"); CKEDITOR.env.gecko && CKEDITOR.env.quirks || h.getBody().setStyles(t); CKEDITOR.env.ie ? setTimeout(function () { l.$.scrollTo(0, 0) }, 0) : l.$.scrollTo(0, 0); q.setStyle("position", CKEDITOR.env.gecko && CKEDITOR.env.quirks ? "fixed" : "absolute"); q.$.offsetLeft; q.setStyles({ "z-index": a.config.baseFloatZIndex - 5, left: "0px", top: "0px" }); q.addClass("cke_maximized"); e(); t = q.getDocumentPosition();
                                        q.setStyles({ left: -1 * t.x + "px", top: -1 * t.y + "px" }); CKEDITOR.env.gecko && d(a)
                                    } else if (this.state == CKEDITOR.TRISTATE_ON) {
                                        l.removeListener("resize", e); for (var p = [t, q], A = 0; A < p.length; A++)c(p[A], p[A].getCustomData("maximize_saved_styles")), p[A].removeCustomData("maximize_saved_styles"); for (p = a.container; p = p.getParent();)c(p, p.getCustomData("maximize_saved_styles")), p.removeCustomData("maximize_saved_styles"); CKEDITOR.env.ie ? setTimeout(function () { l.$.scrollTo(v.x, v.y) }, 0) : l.$.scrollTo(v.x, v.y); q.removeClass("cke_maximized");
                                        CKEDITOR.env.webkit && (q.setStyle("display", "inline"), setTimeout(function () { q.setStyle("display", "block") }, 0)); a.fire("resize", { outerHeight: a.container.$.offsetHeight, contentsHeight: t.$.offsetHeight, outerWidth: a.container.$.offsetWidth })
                                    } this.toggleState(); if (p = this.uiItems[0]) t = this.state == CKEDITOR.TRISTATE_OFF ? f.maximize.maximize : f.maximize.minimize, p = CKEDITOR.document.getById(p._.id), p.getChild(1).setHtml(t), p.setAttribute("title", t), p.setAttribute("href", 'javascript:void("' + t + '");'); "wysiwyg" ==
                                        a.mode ? g ? (CKEDITOR.env.gecko && d(a), a.getSelection().selectRanges(g), (y = a.getSelection().getStartElement()) && y.scrollIntoView(!0)) : l.$.scrollTo(n.x, n.y) : (g && (y.selectionStart = g[0], y.selectionEnd = g[1]), y.scrollLeft = n[0], y.scrollTop = n[1]); g = n = null; u = this.state; a.fire("maximize", this.state)
                                }, canUndo: !1
                            }); a.ui.addButton && a.ui.addButton("Maximize", { label: f.maximize.maximize, command: "maximize", toolbar: "tools,10" }); a.on("mode", function () {
                                var b = a.getCommand("maximize"); b.setState(b.state == CKEDITOR.TRISTATE_DISABLED ?
                                    CKEDITOR.TRISTATE_DISABLED : u)
                            }, null, null, 100)
                        }
                    }
                })
        }(), function () {
            function a(a, c, d) { var e = CKEDITOR.cleanWord; e ? d() : (a = CKEDITOR.getUrl(a.config.pasteFromWordCleanupFile || c + "filter/default.js"), CKEDITOR.scriptLoader.load(a, d, null, !0)); return !e } function e(a) { a.data.type = "html" } CKEDITOR.plugins.add("pastefromword", {
                requires: "clipboard", init: function (b) {
                    var c = 0, d = this.path; b.addCommand("pastefromword", {
                        canUndo: !1, async: !0, exec: function (a) {
                            var b = this; c = 1; a.once("beforePaste", e); a.getClipboardData({ title: a.lang.pastefromword.title },
                                function (c) { c && a.fire("paste", { type: "html", dataValue: c.dataValue, method: "paste", dataTransfer: CKEDITOR.plugins.clipboard.initPasteDataTransfer() }); a.fire("afterCommandExec", { name: "pastefromword", command: b, returnValue: !!c }) })
                        }
                    }); b.ui.addButton && b.ui.addButton("PasteFromWord", { label: b.lang.pastefromword.toolbar, command: "pastefromword", toolbar: "clipboard,50" }); b.on("pasteState", function (a) { b.getCommand("pastefromword").setState(a.data) }); b.on("paste", function (e) {
                        var m = e.data, f = m.dataValue; if (f && (c || /(class=\"?Mso|style=\"[^\"]*\bmso\-|w:WordDocument)/.test(f))) {
                            m.dontFilter =
                            !0; var h = a(b, d, function () { if (h) b.fire("paste", m); else if (!b.config.pasteFromWordPromptCleanup || c || confirm(b.lang.pastefromword.confirmCleanup)) m.dataValue = CKEDITOR.cleanWord(f, b); c = 0 }); h && e.cancel()
                        }
                    }, null, null, 3)
                }
            })
        }(), function () {
            var a = {
                canUndo: !1, async: !0, exec: function (e) {
                    e.getClipboardData({ title: e.lang.pastetext.title }, function (b) {
                        b && e.fire("paste", { type: "text", dataValue: b.dataValue, method: "paste", dataTransfer: CKEDITOR.plugins.clipboard.initPasteDataTransfer() }); e.fire("afterCommandExec", {
                            name: "pastetext",
                            command: a, returnValue: !!b
                        })
                    })
                }
            }; CKEDITOR.plugins.add("pastetext", { requires: "clipboard", init: function (e) { e.addCommand("pastetext", a); e.ui.addButton && e.ui.addButton("PasteText", { label: e.lang.pastetext.button, command: "pastetext", toolbar: "clipboard,40" }); if (e.config.forcePasteAsPlainText) e.on("beforePaste", function (a) { "html" != a.data.type && (a.data.type = "text") }); e.on("pasteState", function (a) { e.getCommand("pastetext").setState(a.data) }) } })
        }(), CKEDITOR.plugins.add("removeformat", {
            init: function (a) {
                a.addCommand("removeFormat",
                    CKEDITOR.plugins.removeformat.commands.removeformat); a.ui.addButton && a.ui.addButton("RemoveFormat", { label: a.lang.removeformat.toolbar, command: "removeFormat", toolbar: "cleanup,10" })
            }
        }), CKEDITOR.plugins.removeformat = {
            commands: {
                removeformat: {
                    exec: function (a) {
                        for (var e = a._.removeFormatRegex || (a._.removeFormatRegex = new RegExp("^(?:" + a.config.removeFormatTags.replace(/,/g, "|") + ")$", "i")), b = a._.removeAttributes || (a._.removeAttributes = a.config.removeFormatAttributes.split(",")), c = CKEDITOR.plugins.removeformat.filter,
                            d = a.getSelection().getRanges(), k = d.createIterator(), m = function (a) { return a.type == CKEDITOR.NODE_ELEMENT }, f; f = k.getNextRange();) {
                                f.collapsed || f.enlarge(CKEDITOR.ENLARGE_ELEMENT); var h = f.createBookmark(), l = h.startNode, g = h.endNode, n = function (b) { for (var d = a.elementPath(b), f = d.elements, h = 1, g; (g = f[h]) && !g.equals(d.block) && !g.equals(d.blockLimit); h++)e.test(g.getName()) && c(a, g) && b.breakParent(g) }; n(l); if (g) for (n(g), l = l.getNextSourceNode(!0, CKEDITOR.NODE_ELEMENT); l && !l.equals(g);)if (l.isReadOnly()) {
                                    if (l.getPosition(g) &
                                        CKEDITOR.POSITION_CONTAINS) break; l = l.getNext(m)
                                } else n = l.getNextSourceNode(!1, CKEDITOR.NODE_ELEMENT), "img" == l.getName() && l.data("cke-realelement") || !c(a, l) || (e.test(l.getName()) ? l.remove(1) : (l.removeAttributes(b), a.fire("removeFormatCleanup", l))), l = n; f.moveToBookmark(h)
                        } a.forceNextSelectionCheck(); a.getSelection().selectRanges(d)
                    }
                }
            }, filter: function (a, e) { for (var b = a._.removeFormatFilters || [], c = 0; c < b.length; c++)if (!1 === b[c](e)) return !1; return !0 }
        }, CKEDITOR.editor.prototype.addRemoveFormatFilter = function (a) {
            this._.removeFormatFilters ||
            (this._.removeFormatFilters = []); this._.removeFormatFilters.push(a)
        }, CKEDITOR.config.removeFormatTags = "b,big,cite,code,del,dfn,em,font,i,ins,kbd,q,s,samp,small,span,strike,strong,sub,sup,tt,u,var", CKEDITOR.config.removeFormatAttributes = "class,style,lang,width,height,align,hspace,valign", CKEDITOR.plugins.add("resize", {
            init: function (a) {
                function e(b) {
                    var d = h.width, e = h.height, m = d + (b.data.$.screenX - f.x) * ("rtl" == k ? -1 : 1); b = e + (b.data.$.screenY - f.y); l && (d = Math.max(c.resize_minWidth, Math.min(m, c.resize_maxWidth)));
                    g && (e = Math.max(c.resize_minHeight, Math.min(b, c.resize_maxHeight))); a.resize(l ? d : null, e)
                } function b() { CKEDITOR.document.removeListener("mousemove", e); CKEDITOR.document.removeListener("mouseup", b); a.document && (a.document.removeListener("mousemove", e), a.document.removeListener("mouseup", b)) } var c = a.config, d = a.ui.spaceId("resizer"), k = a.element ? a.element.getDirection(1) : "ltr"; !c.resize_dir && (c.resize_dir = "vertical"); void 0 === c.resize_maxWidth && (c.resize_maxWidth = 3E3); void 0 === c.resize_maxHeight && (c.resize_maxHeight =
                    3E3); void 0 === c.resize_minWidth && (c.resize_minWidth = 750); void 0 === c.resize_minHeight && (c.resize_minHeight = 250); if (!1 !== c.resize_enabled) {
                        var m = null, f, h, l = ("both" == c.resize_dir || "horizontal" == c.resize_dir) && c.resize_minWidth != c.resize_maxWidth, g = ("both" == c.resize_dir || "vertical" == c.resize_dir) && c.resize_minHeight != c.resize_maxHeight, n = CKEDITOR.tools.addFunction(function (d) {
                            m || (m = a.getResizable()); h = { width: m.$.offsetWidth || 0, height: m.$.offsetHeight || 0 }; f = { x: d.screenX, y: d.screenY }; c.resize_minWidth >
                                h.width && (c.resize_minWidth = h.width); c.resize_minHeight > h.height && (c.resize_minHeight = h.height); CKEDITOR.document.on("mousemove", e); CKEDITOR.document.on("mouseup", b); a.document && (a.document.on("mousemove", e), a.document.on("mouseup", b)); d.preventDefault && d.preventDefault()
                        }); a.on("destroy", function () { CKEDITOR.tools.removeFunction(n) }); a.on("uiSpace", function (b) {
                            if ("bottom" == b.data.space) {
                                var c = ""; l && !g && (c = " cke_resizer_horizontal"); !l && g && (c = " cke_resizer_vertical"); var f = '\x3cspan id\x3d"' + d + '" class\x3d"cke_resizer' +
                                    c + " cke_resizer_" + k + '" title\x3d"' + CKEDITOR.tools.htmlEncode(a.lang.common.resize) + '" onmousedown\x3d"CKEDITOR.tools.callFunction(' + n + ', event)"\x3e' + ("ltr" == k ? "â—¢" : "â—£") + "\x3c/span\x3e"; "ltr" == k && "ltr" == c ? b.data.html += f : b.data.html = f + b.data.html
                            }
                        }, a, null, 100); a.on("maximize", function (b) { a.ui.space("resizer")[b.data == CKEDITOR.TRISTATE_ON ? "hide" : "show"]() })
                    }
            }
        }), CKEDITOR.plugins.add("menubutton", {
            requires: "button,menu", onLoad: function () {
                var a = function (a) {
                    var b = this._, c = b.menu; b.state !== CKEDITOR.TRISTATE_DISABLED &&
                        (b.on && c ? c.hide() : (b.previousState = b.state, c || (c = b.menu = new CKEDITOR.menu(a, { panel: { className: "cke_menu_panel", attributes: { "aria-label": a.lang.common.options } } }), c.onHide = CKEDITOR.tools.bind(function () { var c = this.command ? a.getCommand(this.command).modes : this.modes; this.setState(!c || c[a.mode] ? b.previousState : CKEDITOR.TRISTATE_DISABLED); b.on = 0 }, this), this.onMenu && c.addListener(this.onMenu)), this.setState(CKEDITOR.TRISTATE_ON), b.on = 1, setTimeout(function () { c.show(CKEDITOR.document.getById(b.id), 4) }, 0)))
                };
                CKEDITOR.ui.menuButton = CKEDITOR.tools.createClass({ base: CKEDITOR.ui.button, $: function (e) { delete e.panel; this.base(e); this.hasArrow = !0; this.click = a }, statics: { handler: { create: function (a) { return new CKEDITOR.ui.menuButton(a) } } } })
            }, beforeInit: function (a) { a.ui.addHandler(CKEDITOR.UI_MENUBUTTON, CKEDITOR.ui.menuButton.handler) }
        }), CKEDITOR.UI_MENUBUTTON = "menubutton", "use strict", CKEDITOR.plugins.add("scayt", {
            requires: "menubutton,dialog", tabToOpen: null, dialogName: "scaytDialog", init: function (a) {
                var e = this,
                b = CKEDITOR.plugins.scayt; this.bindEvents(a); this.parseConfig(a); this.addRule(a); CKEDITOR.dialog.add(this.dialogName, CKEDITOR.getUrl(this.path + "dialogs/options.js")); this.addMenuItems(a); var c = a.lang.scayt, d = CKEDITOR.env; a.ui.add("Scayt", CKEDITOR.UI_MENUBUTTON, {
                    label: c.text_title, title: a.plugins.wsc ? a.lang.wsc.title : c.text_title, modes: { wysiwyg: !(d.ie && (8 > d.version || d.quirks)) }, toolbar: "spellchecker,20", refresh: function () {
                        var c = a.ui.instances.Scayt.getState(); a.scayt && (c = b.state.scayt[a.name] ? CKEDITOR.TRISTATE_ON :
                            CKEDITOR.TRISTATE_OFF); a.fire("scaytButtonState", c)
                    }, onRender: function () { var b = this; a.on("scaytButtonState", function (a) { void 0 !== typeof a.data && b.setState(a.data) }) }, onMenu: function () {
                        var c = a.scayt; a.getMenuItem("scaytToggle").label = a.lang.scayt[c && b.state.scayt[a.name] ? "btn_disable" : "btn_enable"]; c = {
                            scaytToggle: CKEDITOR.TRISTATE_OFF, scaytOptions: c ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED, scaytLangs: c ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED, scaytDict: c ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED,
                            scaytAbout: c ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED, WSC: a.plugins.wsc ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED
                        }; a.config.scayt_uiTabs[0] || delete c.scaytOptions; a.config.scayt_uiTabs[1] || delete c.scaytLangs; a.config.scayt_uiTabs[2] || delete c.scaytDict; return c
                    }
                }); a.contextMenu && a.addMenuItems && (a.contextMenu.addListener(function (b, c) {
                    var d = a.scayt, h, l; d && (l = d.getSelectionNode()) && (h = e.menuGenerator(a, l), d.showBanner("." + a.contextMenu._.definition.panel.className.split(" ").join(" .")));
                    return h
                }), a.contextMenu._.onHide = CKEDITOR.tools.override(a.contextMenu._.onHide, function (b) { return function () { var c = a.scayt; c && c.hideBanner(); return b.apply(this) } }))
            }, addMenuItems: function (a) {
                var e = this, b = CKEDITOR.plugins.scayt; a.addMenuGroup("scaytButton"); for (var c = a.config.scayt_contextMenuItemsOrder.split("|"), d = 0; d < c.length; d++)c[d] = "scayt_" + c[d]; if ((c = ["grayt_description", "grayt_suggest", "grayt_control"].concat(c)) && c.length) for (d = 0; d < c.length; d++)a.addMenuGroup(c[d], d - 10); a.addCommand("scaytToggle",
                    { exec: function (a) { var c = a.scayt; b.state.scayt[a.name] = !b.state.scayt[a.name]; !0 === b.state.scayt[a.name] ? c || b.createScayt(a) : c && b.destroy(a) } }); a.addCommand("scaytAbout", { exec: function (a) { a.scayt.tabToOpen = "about"; a.lockSelection(); a.openDialog(e.dialogName) } }); a.addCommand("scaytOptions", { exec: function (a) { a.scayt.tabToOpen = "options"; a.lockSelection(); a.openDialog(e.dialogName) } }); a.addCommand("scaytLangs", { exec: function (a) { a.scayt.tabToOpen = "langs"; a.lockSelection(); a.openDialog(e.dialogName) } });
                a.addCommand("scaytDict", { exec: function (a) { a.scayt.tabToOpen = "dictionaries"; a.lockSelection(); a.openDialog(e.dialogName) } }); c = {
                    scaytToggle: { label: a.lang.scayt.btn_enable, group: "scaytButton", command: "scaytToggle" }, scaytAbout: { label: a.lang.scayt.btn_about, group: "scaytButton", command: "scaytAbout" }, scaytOptions: { label: a.lang.scayt.btn_options, group: "scaytButton", command: "scaytOptions" }, scaytLangs: { label: a.lang.scayt.btn_langs, group: "scaytButton", command: "scaytLangs" }, scaytDict: {
                        label: a.lang.scayt.btn_dictionaries,
                        group: "scaytButton", command: "scaytDict"
                    }
                }; a.plugins.wsc && (c.WSC = { label: a.lang.wsc.toolbar, group: "scaytButton", onClick: function () { var b = CKEDITOR.plugins.scayt, c = a.scayt, d = a.elementMode == CKEDITOR.ELEMENT_MODE_INLINE ? a.container.getText() : a.document.getBody().getText(); (d = d.replace(/\s/g, "")) ? (c && b.state.scayt[a.name] && c.setMarkupPaused && c.setMarkupPaused(!0), a.lockSelection(), a.execCommand("checkspell")) : alert("Nothing to check!") } }); a.addMenuItems(c)
            }, bindEvents: function (a) {
                var e = CKEDITOR.plugins.scayt,
                b = a.elementMode == CKEDITOR.ELEMENT_MODE_INLINE, c = function () { e.destroy(a) }, d = function () { !e.state.scayt[a.name] || a.readOnly || a.scayt || e.createScayt(a) }, k = function () {
                    var c = a.editable(); c.attachListener(c, "focus", function (c) {
                        CKEDITOR.plugins.scayt && !a.scayt && setTimeout(d, 0); c = CKEDITOR.plugins.scayt && CKEDITOR.plugins.scayt.state.scayt[a.name] && a.scayt; var f, e; if ((b || c) && a._.savedSelection) {
                            c = a._.savedSelection.getSelectedElement(); c = !c && a._.savedSelection.getRanges(); for (var m = 0; m < c.length; m++)e = c[m], "string" ===
                                typeof e.startContainer.$.nodeValue && (f = e.startContainer.getText().length, (f < e.startOffset || f < e.endOffset) && a.unlockSelection(!1))
                        }
                    }, this, null, -10)
                }, m = function () {
                    b ? a.config.scayt_inlineModeImmediateMarkup ? d() : (a.on("blur", function () { setTimeout(c, 0) }), a.on("focus", d), a.focusManager.hasFocus && d()) : d(); k(); var f = a.editable(); f.attachListener(f, "mousedown", function (b) {
                        b = b.data.getTarget(); var c = a.widgets && a.widgets.getByElement(b); c && (c.wrapper = b.getAscendant(function (a) { return a.hasAttribute("data-cke-widget-wrapper") },
                            !0))
                    }, this, null, -10)
                }; a.on("contentDom", m); a.on("beforeCommandExec", function (b) {
                    var c = a.scayt, d = null, g = !1, m = !0; b.data.name in e.options.disablingCommandExec && "wysiwyg" == a.mode ? c && (e.destroy(a), a.fire("scaytButtonState", CKEDITOR.TRISTATE_DISABLED)) : "bold" !== b.data.name && "italic" !== b.data.name && "underline" !== b.data.name && "strike" !== b.data.name && "subscript" !== b.data.name && "superscript" !== b.data.name && "enter" !== b.data.name && "cut" !== b.data.name && "language" !== b.data.name || !c || ("cut" === b.data.name && (m = !1,
                        g = !0), "language" === b.data.name && (d = (d = a.plugins.language.getCurrentLangElement(a)) && d.$, g = !0), a.fire("reloadMarkupScayt", { removeOptions: { removeInside: m, forceBookmark: g, selectionNode: d }, timeout: 0 }))
                }); a.on("beforeSetMode", function (b) { if ("source" == b.data) { if (b = a.scayt) e.destroy(a), a.fire("scaytButtonState", CKEDITOR.TRISTATE_DISABLED); a.document && a.document.getBody().removeAttribute("_jquid") } }); a.on("afterCommandExec", function (b) {
                    "wysiwyg" != a.mode || "undo" != b.data.name && "redo" != b.data.name || setTimeout(function () {
                        var b =
                            a.scayt, c = b && b.getScaytLangList(); c && c.ltr && c.rtl && b.fire("startSpellCheck, startGrammarCheck")
                    }, 250)
                }); a.on("readOnly", function (b) { var c; b && (c = a.scayt, !0 === b.editor.readOnly ? c && c.fire("removeMarkupInDocument", {}) : c ? c.fire("startSpellCheck, startGrammarCheck") : "wysiwyg" == b.editor.mode && !0 === e.state.scayt[b.editor.name] && (e.createScayt(a), b.editor.fire("scaytButtonState", CKEDITOR.TRISTATE_ON))) }); a.on("beforeDestroy", c); a.on("setData", function () {
                    c(); (a.elementMode == CKEDITOR.ELEMENT_MODE_INLINE || a.plugins.divarea) &&
                        m()
                }, this, null, 50); a.on("reloadMarkupScayt", function (b) { var c = b.data && b.data.removeOptions; setTimeout(function () { var b = a.scayt, d = b && b.getScaytLangList(); d && d.ltr && d.rtl && (a.document.fire("keydown", new CKEDITOR.dom.event({ keyCode: 37 })), b.removeMarkupInSelectionNode(c), b.fire("startSpellCheck, startGrammarCheck")) }, b.data && b.data.timeout || 0) }); a.on("insertElement", function () { a.fire("reloadMarkupScayt", { removeOptions: { forceBookmark: !0 } }) }, this, null, 50); a.on("insertHtml", function () { a.fire("reloadMarkupScayt") },
                    this, null, 50); a.on("insertText", function () { a.fire("reloadMarkupScayt") }, this, null, 50); a.on("scaytDialogShown", function (b) { b.data.selectPage(a.scayt.tabToOpen) })
            }, parseConfig: function (a) {
                var e = CKEDITOR.plugins.scayt; e.replaceOldOptionsNames(a.config); "boolean" !== typeof a.config.scayt_autoStartup && (a.config.scayt_autoStartup = !1); e.state.scayt[a.name] = a.config.scayt_autoStartup; "boolean" !== typeof a.config.grayt_autoStartup && (a.config.grayt_autoStartup = !1); "boolean" !== typeof a.config.scayt_inlineModeImmediateMarkup &&
                    (a.config.scayt_inlineModeImmediateMarkup = !1); e.state.grayt[a.name] = a.config.grayt_autoStartup; a.config.scayt_contextCommands || (a.config.scayt_contextCommands = "ignore|ignoreall|add"); a.config.scayt_contextMenuItemsOrder || (a.config.scayt_contextMenuItemsOrder = "suggest|moresuggest|control"); a.config.scayt_sLang || (a.config.scayt_sLang = "en_US"); if (void 0 === a.config.scayt_maxSuggestions || "number" != typeof a.config.scayt_maxSuggestions || 0 > a.config.scayt_maxSuggestions) a.config.scayt_maxSuggestions = 5; if (void 0 ===
                        a.config.scayt_minWordLength || "number" != typeof a.config.scayt_minWordLength || 1 > a.config.scayt_minWordLength) a.config.scayt_minWordLength = 4; if (void 0 === a.config.scayt_customDictionaryIds || "string" !== typeof a.config.scayt_customDictionaryIds) a.config.scayt_customDictionaryIds = ""; if (void 0 === a.config.scayt_userDictionaryName || "string" !== typeof a.config.scayt_userDictionaryName) a.config.scayt_userDictionaryName = null; if ("string" === typeof a.config.scayt_uiTabs && 3 === a.config.scayt_uiTabs.split(",").length) {
                            var b =
                                [], c = []; a.config.scayt_uiTabs = a.config.scayt_uiTabs.split(","); CKEDITOR.tools.search(a.config.scayt_uiTabs, function (a) { 1 === Number(a) || 0 === Number(a) ? (c.push(!0), b.push(Number(a))) : c.push(!1) }); null === CKEDITOR.tools.search(c, !1) ? a.config.scayt_uiTabs = b : a.config.scayt_uiTabs = [1, 1, 1]
                        } else a.config.scayt_uiTabs = [1, 1, 1]; "string" != typeof a.config.scayt_serviceProtocol && (a.config.scayt_serviceProtocol = null); "string" != typeof a.config.scayt_serviceHost && (a.config.scayt_serviceHost = null); "string" != typeof a.config.scayt_servicePort &&
                            (a.config.scayt_servicePort = null); "string" != typeof a.config.scayt_servicePath && (a.config.scayt_servicePath = null); a.config.scayt_moreSuggestions || (a.config.scayt_moreSuggestions = "on"); "string" !== typeof a.config.scayt_customerId && (a.config.scayt_customerId = "1:WvF0D4-UtPqN1-43nkD4-NKvUm2-daQqk3-LmNiI-z7Ysb4-mwry24-T8YrS3-Q2tpq2"); "string" !== typeof a.config.scayt_srcUrl && (e = document.location.protocol, e = -1 != e.search(/https?:/) ? e : "http:", a.config.scayt_srcUrl = e + "//svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/ckscayt.js");
                "boolean" !== typeof CKEDITOR.config.scayt_handleCheckDirty && (CKEDITOR.config.scayt_handleCheckDirty = !0); "boolean" !== typeof CKEDITOR.config.scayt_handleUndoRedo && (CKEDITOR.config.scayt_handleUndoRedo = !0); CKEDITOR.config.scayt_handleUndoRedo = CKEDITOR.plugins.undo ? CKEDITOR.config.scayt_handleUndoRedo : !1; "boolean" !== typeof a.config.scayt_multiLanguageMode && (a.config.scayt_multiLanguageMode = !1); "object" !== typeof a.config.scayt_multiLanguageStyles && (a.config.scayt_multiLanguageStyles = {}); a.config.scayt_ignoreAllCapsWords &&
                    "boolean" !== typeof a.config.scayt_ignoreAllCapsWords && (a.config.scayt_ignoreAllCapsWords = !1); a.config.scayt_ignoreDomainNames && "boolean" !== typeof a.config.scayt_ignoreDomainNames && (a.config.scayt_ignoreDomainNames = !1); a.config.scayt_ignoreWordsWithMixedCases && "boolean" !== typeof a.config.scayt_ignoreWordsWithMixedCases && (a.config.scayt_ignoreWordsWithMixedCases = !1); a.config.scayt_ignoreWordsWithNumbers && "boolean" !== typeof a.config.scayt_ignoreWordsWithNumbers && (a.config.scayt_ignoreWordsWithNumbers =
                        !1); if (a.config.scayt_disableOptionsStorage) {
                            var e = CKEDITOR.tools.isArray(a.config.scayt_disableOptionsStorage) ? a.config.scayt_disableOptionsStorage : "string" === typeof a.config.scayt_disableOptionsStorage ? [a.config.scayt_disableOptionsStorage] : void 0, d = "all options lang ignore-all-caps-words ignore-domain-names ignore-words-with-mixed-cases ignore-words-with-numbers".split(" "), k = ["lang", "ignore-all-caps-words", "ignore-domain-names", "ignore-words-with-mixed-cases", "ignore-words-with-numbers"], m = CKEDITOR.tools.search,
                            f = CKEDITOR.tools.indexOf; a.config.scayt_disableOptionsStorage = function (a) { for (var b = [], c = 0; c < a.length; c++) { var e = a[c], v = !!m(a, "options"); if (!m(d, e) || v && m(k, function (a) { if ("lang" === a) return !1 })) return; m(k, e) && k.splice(f(k, e), 1); if ("all" === e || v && m(a, "lang")) return []; "options" === e && (k = ["lang"]) } return b = b.concat(k) }(e)
                        }
            }, addRule: function (a) {
                var e = CKEDITOR.plugins.scayt, b = a.dataProcessor, c = b && b.htmlFilter, d = a._.elementsPath && a._.elementsPath.filters, b = b && b.dataFilter, k = a.addRemoveFormatFilter, m = function (b) {
                    if (a.scayt &&
                        (b.hasAttribute(e.options.data_attribute_name) || b.hasAttribute(e.options.problem_grammar_data_attribute))) return !1
                }, f = function (b) { var c = !0; a.scayt && (b.hasAttribute(e.options.data_attribute_name) || b.hasAttribute(e.options.problem_grammar_data_attribute)) && (c = !1); return c }; d && d.push(m); b && b.addRules({
                    elements: {
                        span: function (a) {
                            var b = a.hasClass(e.options.misspelled_word_class) && a.attributes[e.options.data_attribute_name], c = a.hasClass(e.options.problem_grammar_class) && a.attributes[e.options.problem_grammar_data_attribute];
                            e && (b || c) && delete a.name; return a
                        }
                    }
                }); c && c.addRules({ elements: { span: function (a) { var b = a.hasClass(e.options.misspelled_word_class) && a.attributes[e.options.data_attribute_name], c = a.hasClass(e.options.problem_grammar_class) && a.attributes[e.options.problem_grammar_data_attribute]; e && (b || c) && delete a.name; return a } } }); k && k.call(a, f)
            }, scaytMenuDefinition: function (a) {
                var e = this; a = a.scayt; return {
                    scayt: {
                        scayt_ignore: { label: a.getLocal("btn_ignore"), group: "scayt_control", order: 1, exec: function (a) { a.scayt.ignoreWord() } },
                        scayt_ignoreall: { label: a.getLocal("btn_ignoreAll"), group: "scayt_control", order: 2, exec: function (a) { a.scayt.ignoreAllWords() } }, scayt_add: { label: a.getLocal("btn_addWord"), group: "scayt_control", order: 3, exec: function (a) { var c = a.scayt; setTimeout(function () { c.addWordToUserDictionary() }, 10) } }, scayt_option: {
                            label: a.getLocal("btn_options"), group: "scayt_control", order: 4, exec: function (a) { a.scayt.tabToOpen = "options"; a.lockSelection(); a.openDialog(e.dialogName) }, verification: function (a) {
                                return 1 == a.config.scayt_uiTabs[0] ?
                                    !0 : !1
                            }
                        }, scayt_language: { label: a.getLocal("btn_langs"), group: "scayt_control", order: 5, exec: function (a) { a.scayt.tabToOpen = "langs"; a.lockSelection(); a.openDialog(e.dialogName) }, verification: function (a) { return 1 == a.config.scayt_uiTabs[1] ? !0 : !1 } }, scayt_dictionary: { label: a.getLocal("btn_dictionaries"), group: "scayt_control", order: 6, exec: function (a) { a.scayt.tabToOpen = "dictionaries"; a.lockSelection(); a.openDialog(e.dialogName) }, verification: function (a) { return 1 == a.config.scayt_uiTabs[2] ? !0 : !1 } }, scayt_about: {
                            label: a.getLocal("btn_about"),
                            group: "scayt_control", order: 7, exec: function (a) { a.scayt.tabToOpen = "about"; a.lockSelection(); a.openDialog(e.dialogName) }
                        }
                    }, grayt: { grayt_problemdescription: { label: "Grammar problem description", group: "grayt_description", order: 1, state: CKEDITOR.TRISTATE_DISABLED, exec: function (a) { } }, grayt_ignore: { label: a.getLocal("btn_ignore"), group: "grayt_control", order: 2, exec: function (a) { a.scayt.ignorePhrase() } } }
                }
            }, buildSuggestionMenuItems: function (a, e, b) {
                var c = {}, d = {}, k = b ? "word" : "phrase", m = b ? "startGrammarCheck" : "startSpellCheck",
                f = a.scayt; if (0 < e.length && "no_any_suggestions" !== e[0]) if (b) for (b = 0; b < e.length; b++) {
                    var h = "scayt_suggest_" + CKEDITOR.plugins.scayt.suggestions[b].replace(" ", "_"); a.addCommand(h, this.createCommand(CKEDITOR.plugins.scayt.suggestions[b], k, m)); b < a.config.scayt_maxSuggestions ? (a.addMenuItem(h, { label: e[b], command: h, group: "scayt_suggest", order: b + 1 }), c[h] = CKEDITOR.TRISTATE_OFF) : (a.addMenuItem(h, { label: e[b], command: h, group: "scayt_moresuggest", order: b + 1 }), d[h] = CKEDITOR.TRISTATE_OFF, "on" === a.config.scayt_moreSuggestions &&
                        (a.addMenuItem("scayt_moresuggest", { label: f.getLocal("btn_moreSuggestions"), group: "scayt_moresuggest", order: 10, getItems: function () { return d } }), c.scayt_moresuggest = CKEDITOR.TRISTATE_OFF))
                } else for (b = 0; b < e.length; b++)h = "grayt_suggest_" + CKEDITOR.plugins.scayt.suggestions[b].replace(" ", "_"), a.addCommand(h, this.createCommand(CKEDITOR.plugins.scayt.suggestions[b], k, m)), a.addMenuItem(h, { label: e[b], command: h, group: "grayt_suggest", order: b + 1 }), c[h] = CKEDITOR.TRISTATE_OFF; else c.no_scayt_suggest = CKEDITOR.TRISTATE_DISABLED,
                    a.addCommand("no_scayt_suggest", { exec: function () { } }), a.addMenuItem("no_scayt_suggest", { label: f.getLocal("btn_noSuggestions") || "no_scayt_suggest", command: "no_scayt_suggest", group: "scayt_suggest", order: 0 }); return c
            }, menuGenerator: function (a, e) {
                var b = a.scayt, c = this.scaytMenuDefinition(a), d = {}, k = a.config.scayt_contextCommands.split("|"), m = e.getAttribute(b.getLangAttribute()) || b.getLang(), f, h; f = b.isScaytNode(e); h = b.isGraytNode(e); f ? (c = c.scayt, d = e.getAttribute(b.getScaytNodeAttributeName()), b.fire("getSuggestionsList",
                    { lang: m, word: d }), d = this.buildSuggestionMenuItems(a, CKEDITOR.plugins.scayt.suggestions, f)) : h && (c = c.grayt, d = e.getAttribute(b.getGraytNodeAttributeName()), h = b.getProblemDescriptionText(d, m), c.grayt_problemdescription && h && (c.grayt_problemdescription.label = h), b.fire("getGrammarSuggestionsList", { lang: m, phrase: d }), d = this.buildSuggestionMenuItems(a, CKEDITOR.plugins.scayt.suggestions, f)); if (f && "off" == a.config.scayt_contextCommands) return d; for (var l in c) f && -1 == CKEDITOR.tools.indexOf(k, l.replace("scayt_",
                        "")) && "all" != a.config.scayt_contextCommands || (d[l] = "undefined" != typeof c[l].state ? c[l].state : CKEDITOR.TRISTATE_OFF, "function" !== typeof c[l].verification || c[l].verification(a) || delete d[l], a.addCommand(l, { exec: c[l].exec }), a.addMenuItem(l, { label: a.lang.scayt[c[l].label] || c[l].label, command: l, group: c[l].group, order: c[l].order })); return d
            }, createCommand: function (a, e, b) {
                return {
                    exec: function (c) {
                        c = c.scayt; var d = {}; d[e] = a; c.replaceSelectionNode(d); "startGrammarCheck" === b && c.removeMarkupInSelectionNode({ grammarOnly: !0 });
                        c.fire(b)
                    }
                }
            }
        }), CKEDITOR.plugins.scayt = {
            state: { scayt: {}, grayt: {} }, suggestions: [], loadingHelper: { loadOrder: [] }, isLoading: !1, options: { disablingCommandExec: { source: !0, newpage: !0, templates: !0 }, data_attribute_name: "data-scayt-word", misspelled_word_class: "scayt-misspell-word", problem_grammar_data_attribute: "data-grayt-phrase", problem_grammar_class: "gramm-problem" }, backCompatibilityMap: {
                scayt_service_protocol: "scayt_serviceProtocol", scayt_service_host: "scayt_serviceHost", scayt_service_port: "scayt_servicePort",
                scayt_service_path: "scayt_servicePath", scayt_customerid: "scayt_customerId"
            }, replaceOldOptionsNames: function (a) { for (var e in a) e in this.backCompatibilityMap && (a[this.backCompatibilityMap[e]] = a[e], delete a[e]) }, createScayt: function (a) {
                var e = this, b = CKEDITOR.plugins.scayt; this.loadScaytLibrary(a, function (a) {
                    var d = a.window && a.window.getFrame() || a.editable(); d ? (d = {
                        lang: a.config.scayt_sLang, container: d.$, customDictionary: a.config.scayt_customDictionaryIds, userDictionaryName: a.config.scayt_userDictionaryName,
                        localization: a.langCode, customer_id: a.config.scayt_customerId, debug: a.config.scayt_debug, data_attribute_name: e.options.data_attribute_name, misspelled_word_class: e.options.misspelled_word_class, problem_grammar_data_attribute: e.options.problem_grammar_data_attribute, problem_grammar_class: e.options.problem_grammar_class, "options-to-restore": a.config.scayt_disableOptionsStorage, focused: a.editable().hasFocus, ignoreElementsRegex: a.config.scayt_elementsToIgnore, minWordLength: a.config.scayt_minWordLength,
                        multiLanguageMode: a.config.scayt_multiLanguageMode, multiLanguageStyles: a.config.scayt_multiLanguageStyles, graytAutoStartup: b.state.grayt[a.name]
                    }, a.config.scayt_serviceProtocol && (d.service_protocol = a.config.scayt_serviceProtocol), a.config.scayt_serviceHost && (d.service_host = a.config.scayt_serviceHost), a.config.scayt_servicePort && (d.service_port = a.config.scayt_servicePort), a.config.scayt_servicePath && (d.service_path = a.config.scayt_servicePath), "boolean" === typeof a.config.scayt_ignoreAllCapsWords && (d["ignore-all-caps-words"] =
                        a.config.scayt_ignoreAllCapsWords), "boolean" === typeof a.config.scayt_ignoreDomainNames && (d["ignore-domain-names"] = a.config.scayt_ignoreDomainNames), "boolean" === typeof a.config.scayt_ignoreWordsWithMixedCases && (d["ignore-words-with-mixed-cases"] = a.config.scayt_ignoreWordsWithMixedCases), "boolean" === typeof a.config.scayt_ignoreWordsWithNumbers && (d["ignore-words-with-numbers"] = a.config.scayt_ignoreWordsWithNumbers), d = new SCAYT.CKSCAYT(d, function () { }, function () { }), d.subscribe("suggestionListSend", function (a) {
                            for (var b =
                                {}, c = [], d = 0; d < a.suggestionList.length; d++)b["word_" + a.suggestionList[d]] || (b["word_" + a.suggestionList[d]] = a.suggestionList[d], c.push(a.suggestionList[d])); CKEDITOR.plugins.scayt.suggestions = c
                        }), d.subscribe("selectionIsChanged", function (b) { a.getSelection().isLocked && a.lockSelection() }), d.subscribe("graytStateChanged", function (d) { b.state.grayt[a.name] = d.state }), a.scayt = d, a.fire("scaytButtonState", a.readOnly ? CKEDITOR.TRISTATE_DISABLED : CKEDITOR.TRISTATE_ON)) : b.state.scayt[a.name] = !1
                })
            }, destroy: function (a) {
                a.scayt &&
                a.scayt.destroy(); delete a.scayt; a.fire("scaytButtonState", CKEDITOR.TRISTATE_OFF)
            }, loadScaytLibrary: function (a, e) {
                var b = this, c, d; this.loadingHelper[a.name] || ("undefined" === typeof window.SCAYT || "function" !== typeof window.SCAYT.CKSCAYT ? (this.loadingHelper[a.name] = e, this.loadingHelper.loadOrder.push(a.name), c = new Date, c = c.getTime(), d = a.config.scayt_srcUrl, d += 0 <= d.indexOf("?") ? "" : "?" + c, this.loadingHelper.ckscaytLoading || (CKEDITOR.scriptLoader.load(d, function (a) {
                    if (a) {
                        CKEDITOR.fireOnce("scaytReady"); for (var c =
                            0; c < b.loadingHelper.loadOrder.length; c++) { a = b.loadingHelper.loadOrder[c]; if ("function" === typeof b.loadingHelper[a]) b.loadingHelper[a](CKEDITOR.instances[a]); delete b.loadingHelper[a] } b.loadingHelper.loadOrder = []
                    }
                }), this.loadingHelper.ckscaytLoading = !0)) : window.SCAYT && "function" === typeof window.SCAYT.CKSCAYT && (CKEDITOR.fireOnce("scaytReady"), a.scayt || "function" === typeof e && e(a)))
            }
        }, CKEDITOR.on("dialogDefinition", function (a) {
            var e = a.data.name; a = a.data.definition.dialog; if ("scaytDialog" === e) a.on("cancel",
                function (a) { return !1 }, this, null, -1); if ("checkspell" === e) a.on("cancel", function (a) { a = a.sender && a.sender.getParentEditor(); var c = CKEDITOR.plugins.scayt, d = a.scayt; d && c.state.scayt[a.name] && d.setMarkupPaused && d.setMarkupPaused(!1); a.unlockSelection() }, this, null, -2); if ("link" === e) a.on("ok", function (a) { var c = a.sender && a.sender.getParentEditor(); c && setTimeout(function () { c.fire("reloadMarkupScayt", { removeOptions: { removeInside: !0, forceBookmark: !0 }, timeout: 0 }) }, 0) })
        }), CKEDITOR.on("scaytReady", function () {
            if (!0 ===
                CKEDITOR.config.scayt_handleCheckDirty) {
                    var a = CKEDITOR.editor.prototype; a.checkDirty = CKEDITOR.tools.override(a.checkDirty, function (a) { return function () { var c = null, d = this.scayt; if (CKEDITOR.plugins.scayt && CKEDITOR.plugins.scayt.state.scayt[this.name] && this.scayt) { if (c = "ready" == this.status) var e = d.removeMarkupFromString(this.getSnapshot()), d = d.removeMarkupFromString(this._.previousValue), c = c && d !== e } else c = a.call(this); return c } }); a.resetDirty = CKEDITOR.tools.override(a.resetDirty, function (a) {
                        return function () {
                            var c =
                                this.scayt; CKEDITOR.plugins.scayt && CKEDITOR.plugins.scayt.state.scayt[this.name] && this.scayt ? this._.previousValue = c.removeMarkupFromString(this.getSnapshot()) : a.call(this)
                        }
                    })
            } if (!0 === CKEDITOR.config.scayt_handleUndoRedo) {
                var a = CKEDITOR.plugins.undo.Image.prototype, e = "function" == typeof a.equalsContent ? "equalsContent" : "equals"; a[e] = CKEDITOR.tools.override(a[e], function (a) {
                    return function (c) {
                        var d = c.editor.scayt, e = this.contents, m = c.contents, f = null; CKEDITOR.plugins.scayt && CKEDITOR.plugins.scayt.state.scayt[c.editor.name] &&
                            c.editor.scayt && (this.contents = d.removeMarkupFromString(e) || "", c.contents = d.removeMarkupFromString(m) || ""); f = a.apply(this, arguments); this.contents = e; c.contents = m; return f
                    }
                })
            }
        }), function () {
            var a = { preserveState: !0, editorFocus: !1, readOnly: 1, exec: function (a) { this.toggleState(); this.refresh(a) }, refresh: function (a) { if (a.document) { var b = this.state == CKEDITOR.TRISTATE_ON ? "attachClass" : "removeClass"; a.editable()[b]("cke_show_borders") } } }; CKEDITOR.plugins.add("showborders", {
                modes: { wysiwyg: 1 }, onLoad: function () {
                    var a;
                    a = (CKEDITOR.env.ie6Compat ? [".%1 table.%2,", ".%1 table.%2 td, .%1 table.%2 th", "{", "border : #d3d3d3 1px dotted", "}"] : ".%1 table.%2,;.%1 table.%2 \x3e tr \x3e td, .%1 table.%2 \x3e tr \x3e th,;.%1 table.%2 \x3e tbody \x3e tr \x3e td, .%1 table.%2 \x3e tbody \x3e tr \x3e th,;.%1 table.%2 \x3e thead \x3e tr \x3e td, .%1 table.%2 \x3e thead \x3e tr \x3e th,;.%1 table.%2 \x3e tfoot \x3e tr \x3e td, .%1 table.%2 \x3e tfoot \x3e tr \x3e th;{;border : #d3d3d3 1px dotted;}".split(";")).join("").replace(/%2/g,
                        "cke_show_border").replace(/%1/g, "cke_show_borders "); CKEDITOR.addCss(a)
                }, init: function (e) {
                    var b = e.addCommand("showborders", a); b.canUndo = !1; !1 !== e.config.startupShowBorders && b.setState(CKEDITOR.TRISTATE_ON); e.on("mode", function () { b.state != CKEDITOR.TRISTATE_DISABLED && b.refresh(e) }, null, null, 100); e.on("contentDom", function () { b.state != CKEDITOR.TRISTATE_DISABLED && b.refresh(e) }); e.on("removeFormatCleanup", function (a) {
                        a = a.data; e.getCommand("showborders").state == CKEDITOR.TRISTATE_ON && a.is("table") && (!a.hasAttribute("border") ||
                            0 >= parseInt(a.getAttribute("border"), 10)) && a.addClass("cke_show_border")
                    })
                }, afterInit: function (a) {
                    var b = a.dataProcessor; a = b && b.dataFilter; b = b && b.htmlFilter; a && a.addRules({ elements: { table: function (a) { a = a.attributes; var b = a["class"], e = parseInt(a.border, 10); e && !(0 >= e) || b && -1 != b.indexOf("cke_show_border") || (a["class"] = (b || "") + " cke_show_border") } } }); b && b.addRules({
                        elements: {
                            table: function (a) {
                                a = a.attributes; var b = a["class"]; b && (a["class"] = b.replace("cke_show_border", "").replace(/\s{2}/, " ").replace(/^\s+|\s+$/,
                                    ""))
                            }
                        }
                    })
                }
            }); CKEDITOR.on("dialogDefinition", function (a) {
                var b = a.data.name; if ("table" == b || "tableProperties" == b) if (a = a.data.definition, b = a.getContents("info").get("txtBorder"), b.commit = CKEDITOR.tools.override(b.commit, function (a) { return function (b, e) { a.apply(this, arguments); var m = parseInt(this.getValue(), 10); e[!m || 0 >= m ? "addClass" : "removeClass"]("cke_show_border") } }), a = (a = a.getContents("advanced")) && a.get("advCSSClasses")) a.setup = CKEDITOR.tools.override(a.setup, function (a) {
                    return function () {
                        a.apply(this,
                            arguments); this.setValue(this.getValue().replace(/cke_show_border/, ""))
                    }
                }), a.commit = CKEDITOR.tools.override(a.commit, function (a) { return function (b, e) { a.apply(this, arguments); parseInt(e.getAttribute("border"), 10) || e.addClass("cke_show_border") } })
            })
        }(), function () {
            CKEDITOR.plugins.add("sourcearea", {
                init: function (e) {
                    function b() {
                        var a = d && this.equals(CKEDITOR.document.getActive()); this.hide(); this.setStyle("height", this.getParent().$.clientHeight + "px"); this.setStyle("width", this.getParent().$.clientWidth +
                            "px"); this.show(); a && this.focus()
                    } if (e.elementMode != CKEDITOR.ELEMENT_MODE_INLINE) {
                        var c = CKEDITOR.plugins.sourcearea; e.addMode("source", function (c) {
                            var d = e.ui.space("contents").getDocument().createElement("textarea"); d.setStyles(CKEDITOR.tools.extend({ width: CKEDITOR.env.ie7Compat ? "99%" : "100%", height: "100%", resize: "none", outline: "none", "text-align": "left" }, CKEDITOR.tools.cssVendorPrefix("tab-size", e.config.sourceAreaTabSize || 4))); d.setAttribute("dir", "ltr"); d.addClass("cke_source").addClass("cke_reset").addClass("cke_enable_context_menu");
                            e.ui.space("contents").append(d); d = e.editable(new a(e, d)); d.setData(e.getData(1)); CKEDITOR.env.ie && (d.attachListener(e, "resize", b, d), d.attachListener(CKEDITOR.document.getWindow(), "resize", b, d), CKEDITOR.tools.setTimeout(b, 0, d)); e.fire("ariaWidget", this); c()
                        }); e.addCommand("source", c.commands.source); e.ui.addButton && e.ui.addButton("Source", { label: e.lang.sourcearea.toolbar, command: "source", toolbar: "mode,10" }); e.on("mode", function () {
                            e.getCommand("source").setState("source" == e.mode ? CKEDITOR.TRISTATE_ON :
                                CKEDITOR.TRISTATE_OFF)
                        }); var d = CKEDITOR.env.ie && 9 == CKEDITOR.env.version
                    }
                }
            }); var a = CKEDITOR.tools.createClass({
                base: CKEDITOR.editable, proto: {
                    setData: function (a) { this.setValue(a); this.status = "ready"; this.editor.fire("dataReady") }, getData: function () { return this.getValue() }, insertHtml: function () { }, insertElement: function () { }, insertText: function () { }, setReadOnly: function (a) { this[(a ? "set" : "remove") + "Attribute"]("readOnly", "readonly") }, detach: function () {
                        a.baseProto.detach.call(this); this.clearCustomData();
                        this.remove()
                    }
                }
            })
        }(), CKEDITOR.plugins.sourcearea = { commands: { source: { modes: { wysiwyg: 1, source: 1 }, editorFocus: !1, readOnly: 1, exec: function (a) { "wysiwyg" == a.mode && a.fire("saveSnapshot"); a.getCommand("source").setState(CKEDITOR.TRISTATE_DISABLED); a.setMode("source" == a.mode ? "wysiwyg" : "source") }, canUndo: !1 } } }, CKEDITOR.plugins.add("specialchar", {
            availableLangs: {
                af: 1, ar: 1, bg: 1, ca: 1, cs: 1, cy: 1, da: 1, de: 1, "de-ch": 1, el: 1, en: 1, "en-gb": 1, eo: 1, es: 1, et: 1, eu: 1, fa: 1, fi: 1, fr: 1, "fr-ca": 1, gl: 1, he: 1, hr: 1, hu: 1, id: 1, it: 1, ja: 1,
                km: 1, ko: 1, ku: 1, lt: 1, lv: 1, nb: 1, nl: 1, no: 1, pl: 1, pt: 1, "pt-br": 1, ru: 1, si: 1, sk: 1, sl: 1, sq: 1, sv: 1, th: 1, tr: 1, tt: 1, ug: 1, uk: 1, vi: 1, zh: 1, "zh-cn": 1
            }, requires: "dialog", init: function (a) {
                var e = this; CKEDITOR.dialog.add("specialchar", this.path + "dialogs/specialchar.js"); a.addCommand("specialchar", {
                    exec: function () {
                        var b = a.langCode, b = e.availableLangs[b] ? b : e.availableLangs[b.replace(/-.*/, "")] ? b.replace(/-.*/, "") : "en"; CKEDITOR.scriptLoader.load(CKEDITOR.getUrl(e.path + "dialogs/lang/" + b + ".js"), function () {
                            CKEDITOR.tools.extend(a.lang.specialchar,
                                e.langEntries[b]); a.openDialog("specialchar")
                        })
                    }, modes: { wysiwyg: 1 }, canUndo: !1
                }); a.ui.addButton && a.ui.addButton("SpecialChar", { label: a.lang.specialchar.toolbar, command: "specialchar", toolbar: "insert,50" })
            }
        }), CKEDITOR.config.specialChars = "! \x26quot; # $ % \x26amp; ' ( ) * + - . / 0 1 2 3 4 5 6 7 8 9 : ; \x26lt; \x3d \x26gt; ? @ A B C D E F G H I J K L M N O P Q R S T U V W X Y Z [ ] ^ _ ` a b c d e f g h i j k l m n o p q r s t u v w x y z { | } ~ \x26euro; \x26lsquo; \x26rsquo; \x26ldquo; \x26rdquo; \x26ndash; \x26mdash; \x26iexcl; \x26cent; \x26pound; \x26curren; \x26yen; \x26brvbar; \x26sect; \x26uml; \x26copy; \x26ordf; \x26laquo; \x26not; \x26reg; \x26macr; \x26deg; \x26sup2; \x26sup3; \x26acute; \x26micro; \x26para; \x26middot; \x26cedil; \x26sup1; \x26ordm; \x26raquo; \x26frac14; \x26frac12; \x26frac34; \x26iquest; \x26Agrave; \x26Aacute; \x26Acirc; \x26Atilde; \x26Auml; \x26Aring; \x26AElig; \x26Ccedil; \x26Egrave; \x26Eacute; \x26Ecirc; \x26Euml; \x26Igrave; \x26Iacute; \x26Icirc; \x26Iuml; \x26ETH; \x26Ntilde; \x26Ograve; \x26Oacute; \x26Ocirc; \x26Otilde; \x26Ouml; \x26times; \x26Oslash; \x26Ugrave; \x26Uacute; \x26Ucirc; \x26Uuml; \x26Yacute; \x26THORN; \x26szlig; \x26agrave; \x26aacute; \x26acirc; \x26atilde; \x26auml; \x26aring; \x26aelig; \x26ccedil; \x26egrave; \x26eacute; \x26ecirc; \x26euml; \x26igrave; \x26iacute; \x26icirc; \x26iuml; \x26eth; \x26ntilde; \x26ograve; \x26oacute; \x26ocirc; \x26otilde; \x26ouml; \x26divide; \x26oslash; \x26ugrave; \x26uacute; \x26ucirc; \x26uuml; \x26yacute; \x26thorn; \x26yuml; \x26OElig; \x26oelig; \x26#372; \x26#374 \x26#373 \x26#375; \x26sbquo; \x26#8219; \x26bdquo; \x26hellip; \x26trade; \x26#9658; \x26bull; \x26rarr; \x26rArr; \x26hArr; \x26diams; \x26asymp;".split(" "),
        function () {
            CKEDITOR.plugins.add("stylescombo", {
                requires: "richcombo", init: function (a) {
                    var e = a.config, b = a.lang.stylescombo, c = {}, d = [], k = []; a.on("stylesSet", function (b) {
                        if (b = b.data.styles) {
                            for (var f, h, l, g = 0, n = b.length; g < n; g++)(f = b[g], a.blockless && f.element in CKEDITOR.dtd.$block || (h = f.name, f = new CKEDITOR.style(f), a.filter.customConfig && !a.filter.check(f))) || (f._name = h, f._.enterMode = e.enterMode, f._.type = l = f.assignedTo || f.type, f._.weight = g + 1E3 * (l == CKEDITOR.STYLE_OBJECT ? 1 : l == CKEDITOR.STYLE_BLOCK ? 2 : 3), c[h] =
                                f, d.push(f), k.push(f)); d.sort(function (a, b) { return a._.weight - b._.weight })
                        }
                    }); a.ui.addRichCombo("Styles", {
                        label: b.label, title: b.panelTitle, toolbar: "styles,10", allowedContent: k, panel: { css: [CKEDITOR.skin.getPath("editor")].concat(e.contentsCss), multiSelect: !0, attributes: { "aria-label": b.panelTitle } }, init: function () {
                            var a, c, e, l, g, k; g = 0; for (k = d.length; g < k; g++)a = d[g], c = a._name, l = a._.type, l != e && (this.startGroup(b["panelTitle" + String(l)]), e = l), this.add(c, a.type == CKEDITOR.STYLE_OBJECT ? c : a.buildPreview(), c);
                            this.commit()
                        }, onClick: function (b) { a.focus(); a.fire("saveSnapshot"); b = c[b]; var d = a.elementPath(); a[b.checkActive(d, a) ? "removeStyle" : "applyStyle"](b); a.fire("saveSnapshot") }, onRender: function () { a.on("selectionChange", function (b) { var d = this.getValue(); b = b.data.path.elements; for (var e = 0, l = b.length, g; e < l; e++) { g = b[e]; for (var k in c) if (c[k].checkElementRemovable(g, !0, a)) { k != d && this.setValue(k); return } } this.setValue("") }, this) }, onOpen: function () {
                            var d = a.getSelection().getSelectedElement(), d = a.elementPath(d),
                            f = [0, 0, 0, 0]; this.showAll(); this.unmarkAll(); for (var e in c) { var l = c[e], g = l._.type; l.checkApplicable(d, a, a.activeFilter) ? f[g]++ : this.hideItem(e); l.checkActive(d, a) && this.mark(e) } f[CKEDITOR.STYLE_BLOCK] || this.hideGroup(b["panelTitle" + String(CKEDITOR.STYLE_BLOCK)]); f[CKEDITOR.STYLE_INLINE] || this.hideGroup(b["panelTitle" + String(CKEDITOR.STYLE_INLINE)]); f[CKEDITOR.STYLE_OBJECT] || this.hideGroup(b["panelTitle" + String(CKEDITOR.STYLE_OBJECT)])
                        }, refresh: function () {
                            var b = a.elementPath(); if (b) {
                                for (var d in c) if (c[d].checkApplicable(b,
                                    a, a.activeFilter)) return; this.setState(CKEDITOR.TRISTATE_DISABLED)
                            }
                        }, reset: function () { c = {}; d = [] }
                    })
                }
            })
        }(), function () {
            function a(a) {
                return {
                    editorFocus: !1, canUndo: !1, modes: { wysiwyg: 1 }, exec: function (b) {
                        if (b.editable().hasFocus) {
                            var c = b.getSelection(), f; if (f = (new CKEDITOR.dom.elementPath(c.getCommonAncestor(), c.root)).contains({ td: 1, th: 1 }, 1)) {
                                var c = b.createRange(), e = CKEDITOR.tools.tryThese(function () { var b = f.getParent().$.cells[f.$.cellIndex + (a ? -1 : 1)]; b.parentNode.parentNode; return b }, function () {
                                    var b =
                                        f.getParent(), b = b.getAscendant("table").$.rows[b.$.rowIndex + (a ? -1 : 1)]; return b.cells[a ? b.cells.length - 1 : 0]
                                }); if (e || a) if (e) e = new CKEDITOR.dom.element(e), c.moveToElementEditStart(e), c.checkStartOfBlock() && c.checkEndOfBlock() || c.selectNodeContents(e); else return !0; else { for (var l = f.getAscendant("table").$, e = f.getParent().$.cells, l = new CKEDITOR.dom.element(l.insertRow(-1), b.document), g = 0, n = e.length; g < n; g++)l.append((new CKEDITOR.dom.element(e[g], b.document)).clone(!1, !1)).appendBogus(); c.moveToElementEditStart(l) } c.select(!0);
                                return !0
                            }
                        } return !1
                    }
                }
            } var e = { editorFocus: !1, modes: { wysiwyg: 1, source: 1 } }, b = { exec: function (a) { a.container.focusNext(!0, a.tabIndex) } }, c = { exec: function (a) { a.container.focusPrevious(!0, a.tabIndex) } }; CKEDITOR.plugins.add("tab", {
                init: function (d) {
                    for (var k = !1 !== d.config.enableTabKeyTools, m = d.config.tabSpaces || 0, f = ""; m--;)f += "Â "; if (f) d.on("key", function (a) { 9 == a.data.keyCode && (d.insertText(f), a.cancel()) }); if (k) d.on("key", function (a) {
                        (9 == a.data.keyCode && d.execCommand("selectNextCell") || a.data.keyCode == CKEDITOR.SHIFT +
                            9 && d.execCommand("selectPreviousCell")) && a.cancel()
                    }); d.addCommand("blur", CKEDITOR.tools.extend(b, e)); d.addCommand("blurBack", CKEDITOR.tools.extend(c, e)); d.addCommand("selectNextCell", a()); d.addCommand("selectPreviousCell", a(!0))
                }
            })
        }(), CKEDITOR.dom.element.prototype.focusNext = function (a, e) {
            var b = void 0 === e ? this.getTabIndex() : e, c, d, k, m, f, h; if (0 >= b) for (f = this.getNextSourceNode(a, CKEDITOR.NODE_ELEMENT); f;) { if (f.isVisible() && 0 === f.getTabIndex()) { k = f; break } f = f.getNextSourceNode(!1, CKEDITOR.NODE_ELEMENT) } else for (f =
                this.getDocument().getBody().getFirst(); f = f.getNextSourceNode(!1, CKEDITOR.NODE_ELEMENT);) { if (!c) if (!d && f.equals(this)) { if (d = !0, a) { if (!(f = f.getNextSourceNode(!0, CKEDITOR.NODE_ELEMENT))) break; c = 1 } } else d && !this.contains(f) && (c = 1); if (f.isVisible() && !(0 > (h = f.getTabIndex()))) { if (c && h == b) { k = f; break } h > b && (!k || !m || h < m) ? (k = f, m = h) : k || 0 !== h || (k = f, m = h) } } k && k.focus()
        }, CKEDITOR.dom.element.prototype.focusPrevious = function (a, e) {
            for (var b = void 0 === e ? this.getTabIndex() : e, c, d, k, m = 0, f, h = this.getDocument().getBody().getLast(); h =
                h.getPreviousSourceNode(!1, CKEDITOR.NODE_ELEMENT);) { if (!c) if (!d && h.equals(this)) { if (d = !0, a) { if (!(h = h.getPreviousSourceNode(!0, CKEDITOR.NODE_ELEMENT))) break; c = 1 } } else d && !this.contains(h) && (c = 1); if (h.isVisible() && !(0 > (f = h.getTabIndex()))) if (0 >= b) { if (c && 0 === f) { k = h; break } f > m && (k = h, m = f) } else { if (c && f == b) { k = h; break } f < b && (!k || f > m) && (k = h, m = f) } } k && k.focus()
        }, CKEDITOR.plugins.add("table", {
            requires: "dialog", init: function (a) {
                function e(a) {
                    return CKEDITOR.tools.extend(a || {}, {
                        contextSensitive: 1, refresh: function (a,
                            b) { this.setState(b.contains("table", 1) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED) }
                    })
                } if (!a.blockless) {
                    var b = a.lang.table; a.addCommand("table", new CKEDITOR.dialogCommand("table", { context: "table", allowedContent: "table{width,height}[align,border,cellpadding,cellspacing,summary];caption tbody thead tfoot;th td tr[scope];" + (a.plugins.dialogadvtab ? "table" + a.plugins.dialogadvtab.allowedContent() : ""), requiredContent: "table", contentTransformations: [["table{width}: sizeToStyle", "table[width]: sizeToAttribute"]] }));
                    a.addCommand("tableProperties", new CKEDITOR.dialogCommand("tableProperties", e())); a.addCommand("tableDelete", e({ exec: function (a) { var b = a.elementPath().contains("table", 1); if (b) { var e = b.getParent(), m = a.editable(); 1 != e.getChildCount() || e.is("td", "th") || e.equals(m) || (b = e); a = a.createRange(); a.moveToPosition(b, CKEDITOR.POSITION_BEFORE_START); b.remove(); a.select() } } })); a.ui.addButton && a.ui.addButton("Table", { label: b.toolbar, command: "table", toolbar: "insert,30" }); CKEDITOR.dialog.add("table", this.path + "dialogs/table.js");
                    CKEDITOR.dialog.add("tableProperties", this.path + "dialogs/table.js"); a.addMenuItems && a.addMenuItems({ table: { label: b.menu, command: "tableProperties", group: "table", order: 5 }, tabledelete: { label: b.deleteTable, command: "tableDelete", group: "table", order: 1 } }); a.on("doubleclick", function (a) { a.data.element.is("table") && (a.data.dialog = "tableProperties") }); a.contextMenu && a.contextMenu.addListener(function () { return { tabledelete: CKEDITOR.TRISTATE_OFF, table: CKEDITOR.TRISTATE_OFF } })
                }
            }
        }), function () {
            function a(a) {
                function b(a) {
                    0 <
                    c.length || a.type != CKEDITOR.NODE_ELEMENT || !v.test(a.getName()) || a.getCustomData("selected_cell") || (CKEDITOR.dom.element.setMarker(d, a, "selected_cell", !0), c.push(a))
                } a = a.getRanges(); for (var c = [], d = {}, f = 0; f < a.length; f++) {
                    var e = a[f]; if (e.collapsed) e = e.getCommonAncestor(), (e = e.getAscendant("td", !0) || e.getAscendant("th", !0)) && c.push(e); else {
                        var e = new CKEDITOR.dom.walker(e), g; for (e.guard = b; g = e.next();)g.type == CKEDITOR.NODE_ELEMENT && g.is(CKEDITOR.dtd.table) || (g = g.getAscendant("td", !0) || g.getAscendant("th",
                            !0)) && !g.getCustomData("selected_cell") && (CKEDITOR.dom.element.setMarker(d, g, "selected_cell", !0), c.push(g))
                    }
                } CKEDITOR.dom.element.clearAllMarkers(d); return c
            } function e(b, c) {
                for (var d = a(b), f = d[0], e = f.getAscendant("table"), f = f.getDocument(), g = d[0].getParent(), h = g.$.rowIndex, d = d[d.length - 1], l = d.getParent().$.rowIndex + d.$.rowSpan - 1, d = new CKEDITOR.dom.element(e.$.rows[l]), h = c ? h : l, g = c ? g : d, d = CKEDITOR.tools.buildTableMap(e), e = d[h], h = c ? d[h - 1] : d[h + 1], d = d[0].length, f = f.createElement("tr"), l = 0; e[l] && l < d; l++) {
                    var k;
                    1 < e[l].rowSpan && h && e[l] == h[l] ? (k = e[l], k.rowSpan += 1) : (k = (new CKEDITOR.dom.element(e[l])).clone(), k.removeAttribute("rowSpan"), k.appendBogus(), f.append(k), k = k.$); l += k.colSpan - 1
                } c ? f.insertBefore(g) : f.insertAfter(g)
            } function b(c) {
                if (c instanceof CKEDITOR.dom.selection) {
                    var d = a(c), f = d[0].getAscendant("table"), e = CKEDITOR.tools.buildTableMap(f); c = d[0].getParent().$.rowIndex; for (var d = d[d.length - 1], g = d.getParent().$.rowIndex + d.$.rowSpan - 1, d = [], h = c; h <= g; h++) {
                        for (var l = e[h], k = new CKEDITOR.dom.element(f.$.rows[h]),
                            m = 0; m < l.length; m++) { var n = new CKEDITOR.dom.element(l[m]), v = n.getParent().$.rowIndex; 1 == n.$.rowSpan ? n.remove() : (--n.$.rowSpan, v == h && (v = e[h + 1], v[m - 1] ? n.insertAfter(new CKEDITOR.dom.element(v[m - 1])) : (new CKEDITOR.dom.element(f.$.rows[h + 1])).append(n, 1))); m += n.$.colSpan - 1 } d.push(k)
                    } e = f.$.rows; f = new CKEDITOR.dom.element(e[g + 1] || (0 < c ? e[c - 1] : null) || f.$.parentNode); for (h = d.length; 0 <= h; h--)b(d[h]); return f
                } c instanceof CKEDITOR.dom.element && (f = c.getAscendant("table"), 1 == f.$.rows.length ? f.remove() : c.remove());
                return null
            } function c(a, b) { for (var c = b ? Infinity : 0, d = 0; d < a.length; d++) { var f; f = a[d]; for (var e = b, g = f.getParent().$.cells, h = 0, l = 0; l < g.length; l++) { var k = g[l], h = h + (e ? 1 : k.colSpan); if (k == f.$) break } f = h - 1; if (b ? f < c : f > c) c = f } return c } function d(b, d) {
                for (var f = a(b), e = f[0].getAscendant("table"), g = c(f, 1), f = c(f), g = d ? g : f, h = CKEDITOR.tools.buildTableMap(e), e = [], f = [], l = h.length, k = 0; k < l; k++)e.push(h[k][g]), f.push(d ? h[k][g - 1] : h[k][g + 1]); for (k = 0; k < l; k++)e[k] && (1 < e[k].colSpan && f[k] == e[k] ? (g = e[k], g.colSpan += 1) : (g = (new CKEDITOR.dom.element(e[k])).clone(),
                    g.removeAttribute("colSpan"), g.appendBogus(), g[d ? "insertBefore" : "insertAfter"].call(g, new CKEDITOR.dom.element(e[k])), g = g.$), k += g.rowSpan - 1)
            } function k(a, b) { var c = a.getStartElement(); if (c = c.getAscendant("td", 1) || c.getAscendant("th", 1)) { var d = c.clone(); d.appendBogus(); b ? d.insertBefore(c) : d.insertAfter(c) } } function m(b) {
                if (b instanceof CKEDITOR.dom.selection) {
                    b = a(b); var c = b[0] && b[0].getAscendant("table"), d; a: {
                        var e = 0; d = b.length - 1; for (var g = {}, h, l; h = b[e++];)CKEDITOR.dom.element.setMarker(g, h, "delete_cell",
                            !0); for (e = 0; h = b[e++];)if ((l = h.getPrevious()) && !l.getCustomData("delete_cell") || (l = h.getNext()) && !l.getCustomData("delete_cell")) { CKEDITOR.dom.element.clearAllMarkers(g); d = l; break a } CKEDITOR.dom.element.clearAllMarkers(g); l = b[0].getParent(); (l = l.getPrevious()) ? d = l.getLast() : (l = b[d].getParent(), d = (l = l.getNext()) ? l.getChild(0) : null)
                    } for (l = b.length - 1; 0 <= l; l--)m(b[l]); d ? f(d, !0) : c && c.remove()
                } else b instanceof CKEDITOR.dom.element && (c = b.getParent(), 1 == c.getChildCount() ? c.remove() : b.remove())
            } function f(a,
                b) { var c = a.getDocument(), d = CKEDITOR.document; CKEDITOR.env.ie && 10 == CKEDITOR.env.version && (d.focus(), c.focus()); c = new CKEDITOR.dom.range(c); c["moveToElementEdit" + (b ? "End" : "Start")](a) || (c.selectNodeContents(a), c.collapse(b ? !1 : !0)); c.select(!0) } function h(a, b, c) { a = a[b]; if ("undefined" == typeof c) return a; for (b = 0; a && b < a.length; b++) { if (c.is && a[b] == c.$) return b; if (b == c) return new CKEDITOR.dom.element(a[b]) } return c.is ? -1 : null } function l(b, c, d) {
                    var f = a(b), e; if ((c ? 1 != f.length : 2 > f.length) || (e = b.getCommonAncestor()) &&
                        e.type == CKEDITOR.NODE_ELEMENT && e.is("table")) return !1; var g; b = f[0]; e = b.getAscendant("table"); var l = CKEDITOR.tools.buildTableMap(e), k = l.length, m = l[0].length, n = b.getParent().$.rowIndex, v = h(l, n, b); if (c) { var B; try { var D = parseInt(b.getAttribute("rowspan"), 10) || 1; g = parseInt(b.getAttribute("colspan"), 10) || 1; B = l["up" == c ? n - D : "down" == c ? n + D : n]["left" == c ? v - g : "right" == c ? v + g : v] } catch (F) { return !1 } if (!B || b.$ == B) return !1; f["up" == c || "left" == c ? "unshift" : "push"](new CKEDITOR.dom.element(B)) } c = b.getDocument(); var E = n,
                            D = B = 0, I = !d && new CKEDITOR.dom.documentFragment(c), G = 0; for (c = 0; c < f.length; c++) { g = f[c]; var L = g.getParent(), N = g.getFirst(), H = g.$.colSpan, R = g.$.rowSpan, L = L.$.rowIndex, P = h(l, L, g), G = G + H * R, D = Math.max(D, P - v + H); B = Math.max(B, L - n + R); d || (H = g, (R = H.getBogus()) && R.remove(), H.trim(), g.getChildren().count() && (L == E || !N || N.isBlockBoundary && N.isBlockBoundary({ br: 1 }) || (E = I.getLast(CKEDITOR.dom.walker.whitespaces(!0)), !E || E.is && E.is("br") || I.append("br")), g.moveChildren(I)), c ? g.remove() : g.setHtml("")); E = L } if (d) return B *
                                D == G; I.moveChildren(b); b.appendBogus(); D >= m ? b.removeAttribute("rowSpan") : b.$.rowSpan = B; B >= k ? b.removeAttribute("colSpan") : b.$.colSpan = D; d = new CKEDITOR.dom.nodeList(e.$.rows); f = d.count(); for (c = f - 1; 0 <= c; c--)e = d.getItem(c), e.$.cells.length || (e.remove(), f++); return b
                } function g(b, c) {
                    var d = a(b); if (1 < d.length) return !1; if (c) return !0; var d = d[0], f = d.getParent(), e = f.getAscendant("table"), g = CKEDITOR.tools.buildTableMap(e), l = f.$.rowIndex, k = h(g, l, d), m = d.$.rowSpan, n; if (1 < m) {
                        n = Math.ceil(m / 2); for (var m = Math.floor(m /
                            2), f = l + n, e = new CKEDITOR.dom.element(e.$.rows[f]), g = h(g, f), v, f = d.clone(), l = 0; l < g.length; l++)if (v = g[l], v.parentNode == e.$ && l > k) { f.insertBefore(new CKEDITOR.dom.element(v)); break } else v = null; v || e.append(f)
                    } else for (m = n = 1, e = f.clone(), e.insertAfter(f), e.append(f = d.clone()), v = h(g, l), k = 0; k < v.length; k++)v[k].rowSpan++; f.appendBogus(); d.$.rowSpan = n; f.$.rowSpan = m; 1 == n && d.removeAttribute("rowSpan"); 1 == m && f.removeAttribute("rowSpan"); return f
                } function n(b, c) {
                    var d = a(b); if (1 < d.length) return !1; if (c) return !0; var d =
                        d[0], f = d.getParent(), e = f.getAscendant("table"), e = CKEDITOR.tools.buildTableMap(e), g = h(e, f.$.rowIndex, d), l = d.$.colSpan; if (1 < l) f = Math.ceil(l / 2), l = Math.floor(l / 2); else { for (var l = f = 1, k = [], m = 0; m < e.length; m++) { var n = e[m]; k.push(n[g]); 1 < n[g].rowSpan && (m += n[g].rowSpan - 1) } for (e = 0; e < k.length; e++)k[e].colSpan++ } e = d.clone(); e.insertAfter(d); e.appendBogus(); d.$.colSpan = f; e.$.colSpan = l; 1 == f && d.removeAttribute("colSpan"); 1 == l && e.removeAttribute("colSpan"); return e
                } var v = /^(?:td|th)$/; CKEDITOR.plugins.tabletools =
                {
                    requires: "table,dialog,contextmenu", init: function (c) {
                        function h(a) { return CKEDITOR.tools.extend(a || {}, { contextSensitive: 1, refresh: function (a, b) { this.setState(b.contains({ td: 1, th: 1 }, 1) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED) } }) } function t(a, b) { var d = c.addCommand(a, b); c.addFeature(d) } var p = c.lang.table; t("cellProperties", new CKEDITOR.dialogCommand("cellProperties", h({
                            allowedContent: "td th{width,height,border-color,background-color,white-space,vertical-align,text-align}[colspan,rowspan]",
                            requiredContent: "table"
                        }))); CKEDITOR.dialog.add("cellProperties", this.path + "dialogs/tableCell.js"); t("rowDelete", h({ requiredContent: "table", exec: function (a) { a = a.getSelection(); f(b(a)) } })); t("rowInsertBefore", h({ requiredContent: "table", exec: function (a) { a = a.getSelection(); e(a, !0) } })); t("rowInsertAfter", h({ requiredContent: "table", exec: function (a) { a = a.getSelection(); e(a) } })); t("columnDelete", h({
                            requiredContent: "table", exec: function (b) {
                                b = b.getSelection(); b = a(b); var c = b[0], d = b[b.length - 1]; b = c.getAscendant("table");
                                for (var e = CKEDITOR.tools.buildTableMap(b), g, h, l = [], k = 0, m = e.length; k < m; k++)for (var n = 0, q = e[k].length; n < q; n++)e[k][n] == c.$ && (g = n), e[k][n] == d.$ && (h = n); for (k = g; k <= h; k++)for (n = 0; n < e.length; n++)d = e[n], c = new CKEDITOR.dom.element(b.$.rows[n]), d = new CKEDITOR.dom.element(d[k]), d.$ && (1 == d.$.colSpan ? d.remove() : --d.$.colSpan, n += d.$.rowSpan - 1, c.$.cells.length || l.push(c)); h = b.$.rows[0] && b.$.rows[0].cells; g = new CKEDITOR.dom.element(h[g] || (g ? h[g - 1] : b.$.parentNode)); l.length == m && b.remove(); g && f(g, !0)
                            }
                        })); t("columnInsertBefore",
                            h({ requiredContent: "table", exec: function (a) { a = a.getSelection(); d(a, !0) } })); t("columnInsertAfter", h({ requiredContent: "table", exec: function (a) { a = a.getSelection(); d(a) } })); t("cellDelete", h({ requiredContent: "table", exec: function (a) { a = a.getSelection(); m(a) } })); t("cellMerge", h({ allowedContent: "td[colspan,rowspan]", requiredContent: "td[colspan,rowspan]", exec: function (a) { f(l(a.getSelection()), !0) } })); t("cellMergeRight", h({
                                allowedContent: "td[colspan]", requiredContent: "td[colspan]", exec: function (a) {
                                    f(l(a.getSelection(),
                                        "right"), !0)
                                }
                            })); t("cellMergeDown", h({ allowedContent: "td[rowspan]", requiredContent: "td[rowspan]", exec: function (a) { f(l(a.getSelection(), "down"), !0) } })); t("cellVerticalSplit", h({ allowedContent: "td[rowspan]", requiredContent: "td[rowspan]", exec: function (a) { f(n(a.getSelection())) } })); t("cellHorizontalSplit", h({ allowedContent: "td[colspan]", requiredContent: "td[colspan]", exec: function (a) { f(g(a.getSelection())) } })); t("cellInsertBefore", h({ requiredContent: "table", exec: function (a) { a = a.getSelection(); k(a, !0) } }));
                        t("cellInsertAfter", h({ requiredContent: "table", exec: function (a) { a = a.getSelection(); k(a) } })); c.addMenuItems && c.addMenuItems({
                            tablecell: {
                                label: p.cell.menu, group: "tablecell", order: 1, getItems: function () {
                                    var b = c.getSelection(), d = a(b); return {
                                        tablecell_insertBefore: CKEDITOR.TRISTATE_OFF, tablecell_insertAfter: CKEDITOR.TRISTATE_OFF, tablecell_delete: CKEDITOR.TRISTATE_OFF, tablecell_merge: l(b, null, !0) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED, tablecell_merge_right: l(b, "right", !0) ? CKEDITOR.TRISTATE_OFF :
                                            CKEDITOR.TRISTATE_DISABLED, tablecell_merge_down: l(b, "down", !0) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED, tablecell_split_vertical: n(b, !0) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED, tablecell_split_horizontal: g(b, !0) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED, tablecell_properties: 0 < d.length ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED
                                    }
                                }
                            }, tablecell_insertBefore: { label: p.cell.insertBefore, group: "tablecell", command: "cellInsertBefore", order: 5 }, tablecell_insertAfter: {
                                label: p.cell.insertAfter,
                                group: "tablecell", command: "cellInsertAfter", order: 10
                            }, tablecell_delete: { label: p.cell.deleteCell, group: "tablecell", command: "cellDelete", order: 15 }, tablecell_merge: { label: p.cell.merge, group: "tablecell", command: "cellMerge", order: 16 }, tablecell_merge_right: { label: p.cell.mergeRight, group: "tablecell", command: "cellMergeRight", order: 17 }, tablecell_merge_down: { label: p.cell.mergeDown, group: "tablecell", command: "cellMergeDown", order: 18 }, tablecell_split_horizontal: {
                                label: p.cell.splitHorizontal, group: "tablecell",
                                command: "cellHorizontalSplit", order: 19
                            }, tablecell_split_vertical: { label: p.cell.splitVertical, group: "tablecell", command: "cellVerticalSplit", order: 20 }, tablecell_properties: { label: p.cell.title, group: "tablecellproperties", command: "cellProperties", order: 21 }, tablerow: { label: p.row.menu, group: "tablerow", order: 1, getItems: function () { return { tablerow_insertBefore: CKEDITOR.TRISTATE_OFF, tablerow_insertAfter: CKEDITOR.TRISTATE_OFF, tablerow_delete: CKEDITOR.TRISTATE_OFF } } }, tablerow_insertBefore: {
                                label: p.row.insertBefore,
                                group: "tablerow", command: "rowInsertBefore", order: 5
                            }, tablerow_insertAfter: { label: p.row.insertAfter, group: "tablerow", command: "rowInsertAfter", order: 10 }, tablerow_delete: { label: p.row.deleteRow, group: "tablerow", command: "rowDelete", order: 15 }, tablecolumn: { label: p.column.menu, group: "tablecolumn", order: 1, getItems: function () { return { tablecolumn_insertBefore: CKEDITOR.TRISTATE_OFF, tablecolumn_insertAfter: CKEDITOR.TRISTATE_OFF, tablecolumn_delete: CKEDITOR.TRISTATE_OFF } } }, tablecolumn_insertBefore: {
                                label: p.column.insertBefore,
                                group: "tablecolumn", command: "columnInsertBefore", order: 5
                            }, tablecolumn_insertAfter: { label: p.column.insertAfter, group: "tablecolumn", command: "columnInsertAfter", order: 10 }, tablecolumn_delete: { label: p.column.deleteColumn, group: "tablecolumn", command: "columnDelete", order: 15 }
                        }); c.contextMenu && c.contextMenu.addListener(function (a, b, c) { return (a = c.contains({ td: 1, th: 1 }, 1)) && !a.isReadOnly() ? { tablecell: CKEDITOR.TRISTATE_OFF, tablerow: CKEDITOR.TRISTATE_OFF, tablecolumn: CKEDITOR.TRISTATE_OFF } : null })
                    }, getSelectedCells: a
                };
            CKEDITOR.plugins.add("tabletools", CKEDITOR.plugins.tabletools)
        }(), CKEDITOR.tools.buildTableMap = function (a) { a = a.$.rows; for (var e = -1, b = [], c = 0; c < a.length; c++) { e++; !b[e] && (b[e] = []); for (var d = -1, k = 0; k < a[c].cells.length; k++) { var m = a[c].cells[k]; for (d++; b[e][d];)d++; for (var f = isNaN(m.colSpan) ? 1 : m.colSpan, m = isNaN(m.rowSpan) ? 1 : m.rowSpan, h = 0; h < m; h++) { b[e + h] || (b[e + h] = []); for (var l = 0; l < f; l++)b[e + h][d + l] = a[c].cells[k] } d += f - 1 } } return b }, function () {
            function a(a) {
                function b() {
                    for (var g = c(), h = CKEDITOR.tools.clone(a.config.toolbarGroups) ||
                        e(a), l = 0; l < h.length; l++) { var k = h[l]; if ("/" != k) { "string" == typeof k && (k = h[l] = { name: k }); var t, p = k.groups; if (p) for (var y = 0; y < p.length; y++)t = p[y], (t = g[t]) && f(k, t); (t = g[k.name]) && f(k, t) } } return h
                } function c() { var b = {}, f, e, g; for (f in a.ui.items) e = a.ui.items[f], g = e.toolbar || "others", g = g.split(","), e = g[0], g = parseInt(g[1] || -1, 10), b[e] || (b[e] = []), b[e].push({ name: f, order: g }); for (e in b) b[e] = b[e].sort(function (a, b) { return a.order == b.order ? 0 : 0 > b.order ? -1 : 0 > a.order ? 1 : a.order < b.order ? -1 : 1 }); return b } function f(b,
                    c) { if (c.length) { b.items ? b.items.push(a.ui.create("-")) : b.items = []; for (var f; f = c.shift();)f = "string" == typeof f ? f : f.name, l && -1 != CKEDITOR.tools.indexOf(l, f) || (f = a.ui.create(f)) && a.addFeature(f) && b.items.push(f) } } function h(a) { var b = [], c, d, e; for (c = 0; c < a.length; ++c)d = a[c], e = {}, "/" == d ? b.push(d) : CKEDITOR.tools.isArray(d) ? (f(e, CKEDITOR.tools.clone(d)), b.push(e)) : d.items && (f(e, CKEDITOR.tools.clone(d.items)), e.name = d.name, b.push(e)); return b } var l = a.config.removeButtons, l = l && l.split(","), g = a.config.toolbar;
                "string" == typeof g && (g = a.config["toolbar_" + g]); return a.toolbar = g ? h(g) : b()
            } function e(a) {
                return a._.toolbarGroups || (a._.toolbarGroups = [{ name: "document", groups: ["mode", "document", "doctools"] }, { name: "clipboard", groups: ["clipboard", "undo"] }, { name: "editing", groups: ["find", "selection", "spellchecker"] }, { name: "forms" }, "/", { name: "basicstyles", groups: ["basicstyles", "cleanup"] }, { name: "paragraph", groups: ["list", "indent", "blocks", "align", "bidi"] }, { name: "links" }, { name: "insert" }, "/", { name: "styles" }, { name: "colors" },
                { name: "tools" }, { name: "others" }, { name: "about" }])
            } var b = function () { this.toolbars = []; this.focusCommandExecuted = !1 }; b.prototype.focus = function () { for (var a = 0, b; b = this.toolbars[a++];)for (var c = 0, f; f = b.items[c++];)if (f.focus) { f.focus(); return } }; var c = { modes: { wysiwyg: 1, source: 1 }, readOnly: 1, exec: function (a) { a.toolbox && (a.toolbox.focusCommandExecuted = !0, CKEDITOR.env.ie || CKEDITOR.env.air ? setTimeout(function () { a.toolbox.focus() }, 100) : a.toolbox.focus()) } }; CKEDITOR.plugins.add("toolbar", {
                requires: "button", init: function (d) {
                    var e,
                    m = function (a, b) {
                        var c, g = "rtl" == d.lang.dir, n = d.config.toolbarGroupCycling, v = g ? 37 : 39, g = g ? 39 : 37, n = void 0 === n || n; switch (b) {
                            case 9: case CKEDITOR.SHIFT + 9: for (; !c || !c.items.length;)if (c = 9 == b ? (c ? c.next : a.toolbar.next) || d.toolbox.toolbars[0] : (c ? c.previous : a.toolbar.previous) || d.toolbox.toolbars[d.toolbox.toolbars.length - 1], c.items.length) for (a = c.items[e ? c.items.length - 1 : 0]; a && !a.focus;)(a = e ? a.previous : a.next) || (c = 0); a && a.focus(); return !1; case v: c = a; do c = c.next, !c && n && (c = a.toolbar.items[0]); while (c && !c.focus);
                                c ? c.focus() : m(a, 9); return !1; case 40: return a.button && a.button.hasArrow ? (d.once("panelShow", function (a) { a.data._.panel._.currentBlock.onKeyDown(40) }), a.execute()) : m(a, 40 == b ? v : g), !1; case g: case 38: c = a; do c = c.previous, !c && n && (c = a.toolbar.items[a.toolbar.items.length - 1]); while (c && !c.focus); c ? c.focus() : (e = 1, m(a, CKEDITOR.SHIFT + 9), e = 0); return !1; case 27: return d.focus(), !1; case 13: case 32: return a.execute(), !1
                        }return !0
                    }; d.on("uiSpace", function (c) {
                        if (c.data.space == d.config.toolbarLocation) {
                            c.removeListener();
                            d.toolbox = new b; var e = CKEDITOR.tools.getNextId(), l = ['\x3cspan id\x3d"', e, '" class\x3d"cke_voice_label"\x3e', d.lang.toolbar.toolbars, "\x3c/span\x3e", '\x3cspan id\x3d"' + d.ui.spaceId("toolbox") + '" class\x3d"cke_toolbox" role\x3d"group" aria-labelledby\x3d"', e, '" onmousedown\x3d"return false;"\x3e'], e = !1 !== d.config.toolbarStartupExpanded, g, k; d.config.toolbarCanCollapse && d.elementMode != CKEDITOR.ELEMENT_MODE_INLINE && l.push('\x3cspan class\x3d"cke_toolbox_main"' + (e ? "\x3e" : ' style\x3d"display:none"\x3e'));
                            for (var v = d.toolbox.toolbars, u = a(d), q = 0; q < u.length; q++) {
                                var t, p = 0, y, A = u[q], z; if (A) if (g && (l.push("\x3c/span\x3e"), k = g = 0), "/" === A) l.push('\x3cspan class\x3d"cke_toolbar_break"\x3e\x3c/span\x3e'); else {
                                    z = A.items || A; for (var r = 0; r < z.length; r++) {
                                        var w = z[r], C; if (w) {
                                            var x = function (a) { a = a.render(d, l); B = p.items.push(a) - 1; 0 < B && (a.previous = p.items[B - 1], a.previous.next = a); a.toolbar = p; a.onkey = m; a.onfocus = function () { d.toolbox.focusCommandExecuted || d.focus() } }; if (w.type == CKEDITOR.UI_SEPARATOR) k = g && w; else {
                                                C = !1 !== w.canGroup;
                                                if (!p) { t = CKEDITOR.tools.getNextId(); p = { id: t, items: [] }; y = A.name && (d.lang.toolbar.toolbarGroups[A.name] || A.name); l.push('\x3cspan id\x3d"', t, '" class\x3d"cke_toolbar"', y ? ' aria-labelledby\x3d"' + t + '_label"' : "", ' role\x3d"toolbar"\x3e'); y && l.push('\x3cspan id\x3d"', t, '_label" class\x3d"cke_voice_label"\x3e', y, "\x3c/span\x3e"); l.push('\x3cspan class\x3d"cke_toolbar_start"\x3e\x3c/span\x3e'); var B = v.push(p) - 1; 0 < B && (p.previous = v[B - 1], p.previous.next = p) } C ? g || (l.push('\x3cspan class\x3d"cke_toolgroup" role\x3d"presentation"\x3e'),
                                                    g = 1) : g && (l.push("\x3c/span\x3e"), g = 0); k && (x(k), k = 0); x(w)
                                            }
                                        }
                                    } g && (l.push("\x3c/span\x3e"), k = g = 0); p && l.push('\x3cspan class\x3d"cke_toolbar_end"\x3e\x3c/span\x3e\x3c/span\x3e')
                                }
                            } d.config.toolbarCanCollapse && l.push("\x3c/span\x3e"); if (d.config.toolbarCanCollapse && d.elementMode != CKEDITOR.ELEMENT_MODE_INLINE) {
                                var D = CKEDITOR.tools.addFunction(function () { d.execCommand("toolbarCollapse") }); d.on("destroy", function () { CKEDITOR.tools.removeFunction(D) }); d.addCommand("toolbarCollapse", {
                                    readOnly: 1, exec: function (a) {
                                        var b =
                                            a.ui.space("toolbar_collapser"), c = b.getPrevious(), d = a.ui.space("contents"), f = c.getParent(), e = parseInt(d.$.style.height, 10), g = f.$.offsetHeight, h = b.hasClass("cke_toolbox_collapser_min"); h ? (c.show(), b.removeClass("cke_toolbox_collapser_min"), b.setAttribute("title", a.lang.toolbar.toolbarCollapse)) : (c.hide(), b.addClass("cke_toolbox_collapser_min"), b.setAttribute("title", a.lang.toolbar.toolbarExpand)); b.getFirst().setText(h ? "â–²" : "â—€"); d.setStyle("height", e - (f.$.offsetHeight - g) + "px"); a.fire("resize", {
                                                outerHeight: a.container.$.offsetHeight,
                                                contentsHeight: d.$.offsetHeight, outerWidth: a.container.$.offsetWidth
                                            })
                                    }, modes: { wysiwyg: 1, source: 1 }
                                }); d.setKeystroke(CKEDITOR.ALT + (CKEDITOR.env.ie || CKEDITOR.env.webkit ? 189 : 109), "toolbarCollapse"); l.push('\x3ca title\x3d"' + (e ? d.lang.toolbar.toolbarCollapse : d.lang.toolbar.toolbarExpand) + '" id\x3d"' + d.ui.spaceId("toolbar_collapser") + '" tabIndex\x3d"-1" class\x3d"cke_toolbox_collapser'); e || l.push(" cke_toolbox_collapser_min"); l.push('" onclick\x3d"CKEDITOR.tools.callFunction(' + D + ')"\x3e', '\x3cspan class\x3d"cke_arrow"\x3e\x26#9650;\x3c/span\x3e',
                                    "\x3c/a\x3e")
                            } l.push("\x3c/span\x3e"); c.data.html += l.join("")
                        }
                    }); d.on("destroy", function () { if (this.toolbox) { var a, b = 0, c, d, e; for (a = this.toolbox.toolbars; b < a.length; b++)for (d = a[b].items, c = 0; c < d.length; c++)e = d[c], e.clickFn && CKEDITOR.tools.removeFunction(e.clickFn), e.keyDownFn && CKEDITOR.tools.removeFunction(e.keyDownFn) } }); d.on("uiReady", function () { var a = d.ui.space("toolbox"); a && d.focusManager.add(a, 1) }); d.addCommand("toolbarFocus", c); d.setKeystroke(CKEDITOR.ALT + 121, "toolbarFocus"); d.ui.add("-", CKEDITOR.UI_SEPARATOR,
                        {}); d.ui.addHandler(CKEDITOR.UI_SEPARATOR, { create: function () { return { render: function (a, b) { b.push('\x3cspan class\x3d"cke_toolbar_separator" role\x3d"separator"\x3e\x3c/span\x3e'); return {} } } } })
                }
            }); CKEDITOR.ui.prototype.addToolbarGroup = function (a, b, c) {
                var f = e(this.editor), h = 0 === b, l = { name: a }; if (c) {
                    if (c = CKEDITOR.tools.search(f, function (a) { return a.name == c })) {
                        !c.groups && (c.groups = []); if (b && (b = CKEDITOR.tools.indexOf(c.groups, b), 0 <= b)) { c.groups.splice(b + 1, 0, a); return } h ? c.groups.splice(0, 0, a) : c.groups.push(a);
                        return
                    } b = null
                } b && (b = CKEDITOR.tools.indexOf(f, function (a) { return a.name == b })); h ? f.splice(0, 0, a) : "number" == typeof b ? f.splice(b + 1, 0, l) : f.push(a)
            }
        }(), CKEDITOR.UI_SEPARATOR = "separator", CKEDITOR.config.toolbarLocation = "top", "use strict", function () {
            var a = [CKEDITOR.CTRL + 90, CKEDITOR.CTRL + 89, CKEDITOR.CTRL + CKEDITOR.SHIFT + 90], e = { 8: 1, 46: 1 }; CKEDITOR.plugins.add("undo", {
                init: function (c) {
                    function d(a) { g.enabled && !1 !== a.data.command.canUndo && g.save() } function e() { g.enabled = c.readOnly ? !1 : "wysiwyg" == c.mode; g.onChange() }
                    var g = c.undoManager = new b(c), m = g.editingHandler = new k(g), v = c.addCommand("undo", { exec: function () { g.undo() && (c.selectionChange(), this.fire("afterUndo")) }, startDisabled: !0, canUndo: !1 }), u = c.addCommand("redo", { exec: function () { g.redo() && (c.selectionChange(), this.fire("afterRedo")) }, startDisabled: !0, canUndo: !1 }); c.setKeystroke([[a[0], "undo"], [a[1], "redo"], [a[2], "redo"]]); g.onChange = function () {
                        v.setState(g.undoable() ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED); u.setState(g.redoable() ? CKEDITOR.TRISTATE_OFF :
                            CKEDITOR.TRISTATE_DISABLED)
                    }; c.on("beforeCommandExec", d); c.on("afterCommandExec", d); c.on("saveSnapshot", function (a) { g.save(a.data && a.data.contentOnly) }); c.on("contentDom", m.attachListeners, m); c.on("instanceReady", function () { c.fire("saveSnapshot") }); c.on("beforeModeUnload", function () { "wysiwyg" == c.mode && g.save(!0) }); c.on("mode", e); c.on("readOnly", e); c.ui.addButton && (c.ui.addButton("Undo", { label: c.lang.undo.undo, command: "undo", toolbar: "undo,10" }), c.ui.addButton("Redo", {
                        label: c.lang.undo.redo, command: "redo",
                        toolbar: "undo,20"
                    })); c.resetUndo = function () { g.reset(); c.fire("saveSnapshot") }; c.on("updateSnapshot", function () { g.currentImage && g.update() }); c.on("lockSnapshot", function (a) { a = a.data; g.lock(a && a.dontUpdate, a && a.forceUpdate) }); c.on("unlockSnapshot", g.unlock, g)
                }
            }); CKEDITOR.plugins.undo = {}; var b = CKEDITOR.plugins.undo.UndoManager = function (a) { this.strokesRecorded = [0, 0]; this.locked = null; this.previousKeyGroup = -1; this.limit = a.config.undoStackSize || 20; this.strokesLimit = 25; this.editor = a; this.reset() }; b.prototype =
            {
                type: function (a, c) { var d = b.getKeyGroup(a), e = this.strokesRecorded[d] + 1; c = c || e >= this.strokesLimit; this.typing || (this.hasUndo = this.typing = !0, this.hasRedo = !1, this.onChange()); c ? (e = 0, this.editor.fire("saveSnapshot")) : this.editor.fire("change"); this.strokesRecorded[d] = e; this.previousKeyGroup = d }, keyGroupChanged: function (a) { return b.getKeyGroup(a) != this.previousKeyGroup }, reset: function () { this.snapshots = []; this.index = -1; this.currentImage = null; this.hasRedo = this.hasUndo = !1; this.locked = null; this.resetType() },
                resetType: function () { this.strokesRecorded = [0, 0]; this.typing = !1; this.previousKeyGroup = -1 }, refreshState: function () { this.hasUndo = !!this.getNextImage(!0); this.hasRedo = !!this.getNextImage(!1); this.resetType(); this.onChange() }, save: function (a, b, d) {
                    var e = this.editor; if (this.locked || "ready" != e.status || "wysiwyg" != e.mode) return !1; var k = e.editable(); if (!k || "ready" != k.status) return !1; k = this.snapshots; b || (b = new c(e)); if (!1 === b.contents) return !1; if (this.currentImage) if (b.equalsContent(this.currentImage)) {
                        if (a ||
                            b.equalsSelection(this.currentImage)) return !1
                    } else !1 !== d && e.fire("change"); k.splice(this.index + 1, k.length - this.index - 1); k.length == this.limit && k.shift(); this.index = k.push(b) - 1; this.currentImage = b; !1 !== d && this.refreshState(); return !0
                }, restoreImage: function (a) {
                    var b = this.editor, c; a.bookmarks && (b.focus(), c = b.getSelection()); this.locked = { level: 999 }; this.editor.loadSnapshot(a.contents); a.bookmarks ? c.selectBookmarks(a.bookmarks) : CKEDITOR.env.ie && (c = this.editor.document.getBody().$.createTextRange(), c.collapse(!0),
                        c.select()); this.locked = null; this.index = a.index; this.currentImage = this.snapshots[this.index]; this.update(); this.refreshState(); b.fire("change")
                }, getNextImage: function (a) { var b = this.snapshots, c = this.currentImage, d; if (c) if (a) for (d = this.index - 1; 0 <= d; d--) { if (a = b[d], !c.equalsContent(a)) return a.index = d, a } else for (d = this.index + 1; d < b.length; d++)if (a = b[d], !c.equalsContent(a)) return a.index = d, a; return null }, redoable: function () { return this.enabled && this.hasRedo }, undoable: function () { return this.enabled && this.hasUndo },
                undo: function () { if (this.undoable()) { this.save(!0); var a = this.getNextImage(!0); if (a) return this.restoreImage(a), !0 } return !1 }, redo: function () { if (this.redoable() && (this.save(!0), this.redoable())) { var a = this.getNextImage(!1); if (a) return this.restoreImage(a), !0 } return !1 }, update: function (a) { if (!this.locked) { a || (a = new c(this.editor)); for (var b = this.index, d = this.snapshots; 0 < b && this.currentImage.equalsContent(d[b - 1]);)--b; d.splice(b, this.index - b + 1, a); this.index = b; this.currentImage = a } }, updateSelection: function (a) {
                    if (!this.snapshots.length) return !1;
                    var b = this.snapshots, c = b[b.length - 1]; return c.equalsContent(a) && !c.equalsSelection(a) ? (this.currentImage = b[b.length - 1] = a, !0) : !1
                }, lock: function (a, b) { if (this.locked) this.locked.level++; else if (a) this.locked = { level: 1 }; else { var d = null; if (b) d = !0; else { var e = new c(this.editor, !0); this.currentImage && this.currentImage.equalsContent(e) && (d = e) } this.locked = { update: d, level: 1 } } }, unlock: function () {
                    if (this.locked && !--this.locked.level) {
                        var a = this.locked.update; this.locked = null; if (!0 === a) this.update(); else if (a) {
                            var b =
                                new c(this.editor, !0); a.equalsContent(b) || this.update()
                        }
                    }
                }
            }; b.navigationKeyCodes = { 37: 1, 38: 1, 39: 1, 40: 1, 36: 1, 35: 1, 33: 1, 34: 1 }; b.keyGroups = { PRINTABLE: 0, FUNCTIONAL: 1 }; b.isNavigationKey = function (a) { return !!b.navigationKeyCodes[a] }; b.getKeyGroup = function (a) { var c = b.keyGroups; return e[a] ? c.FUNCTIONAL : c.PRINTABLE }; b.getOppositeKeyGroup = function (a) { var c = b.keyGroups; return a == c.FUNCTIONAL ? c.PRINTABLE : c.FUNCTIONAL }; b.ieFunctionalKeysBug = function (a) { return CKEDITOR.env.ie && b.getKeyGroup(a) == b.keyGroups.FUNCTIONAL };
            var c = CKEDITOR.plugins.undo.Image = function (a, b) { this.editor = a; a.fire("beforeUndoImage"); var c = a.getSnapshot(); CKEDITOR.env.ie && c && (c = c.replace(/\s+data-cke-expando=".*?"/g, "")); this.contents = c; b || (this.bookmarks = (c = c && a.getSelection()) && c.createBookmarks2(!0)); a.fire("afterUndoImage") }, d = /\b(?:href|src|name)="[^"]*?"/gi; c.prototype = {
                equalsContent: function (a) {
                    var b = this.contents; a = a.contents; CKEDITOR.env.ie && (CKEDITOR.env.ie7Compat || CKEDITOR.env.quirks) && (b = b.replace(d, ""), a = a.replace(d, "")); return b !=
                        a ? !1 : !0
                }, equalsSelection: function (a) { var b = this.bookmarks; a = a.bookmarks; if (b || a) { if (!b || !a || b.length != a.length) return !1; for (var c = 0; c < b.length; c++) { var d = b[c], e = a[c]; if (d.startOffset != e.startOffset || d.endOffset != e.endOffset || !CKEDITOR.tools.arrayCompare(d.start, e.start) || !CKEDITOR.tools.arrayCompare(d.end, e.end)) return !1 } } return !0 }
            }; var k = CKEDITOR.plugins.undo.NativeEditingHandler = function (a) { this.undoManager = a; this.ignoreInputEvent = !1; this.keyEventsStack = new m; this.lastKeydownImage = null }; k.prototype =
            {
                onKeydown: function (d) { var e = d.data.getKey(); if (229 !== e) if (-1 < CKEDITOR.tools.indexOf(a, d.data.getKeystroke())) d.data.preventDefault(); else if (this.keyEventsStack.cleanUp(d), d = this.undoManager, this.keyEventsStack.getLast(e) || this.keyEventsStack.push(e), this.lastKeydownImage = new c(d.editor), b.isNavigationKey(e) || this.undoManager.keyGroupChanged(e)) if (d.strokesRecorded[0] || d.strokesRecorded[1]) d.save(!1, this.lastKeydownImage, !1), d.resetType() }, onInput: function () {
                    if (this.ignoreInputEvent) this.ignoreInputEvent =
                        !1; else { var a = this.keyEventsStack.getLast(); a || (a = this.keyEventsStack.push(0)); this.keyEventsStack.increment(a.keyCode); this.keyEventsStack.getTotalInputs() >= this.undoManager.strokesLimit && (this.undoManager.type(a.keyCode, !0), this.keyEventsStack.resetInputs()) }
                }, onKeyup: function (a) {
                    var d = this.undoManager; a = a.data.getKey(); var e = this.keyEventsStack.getTotalInputs(); this.keyEventsStack.remove(a); if (!(b.ieFunctionalKeysBug(a) && this.lastKeydownImage && this.lastKeydownImage.equalsContent(new c(d.editor,
                        !0)))) if (0 < e) d.type(a); else if (b.isNavigationKey(a)) this.onNavigationKey(!0)
                }, onNavigationKey: function (a) { var b = this.undoManager; !a && b.save(!0, null, !1) || b.updateSelection(new c(b.editor)); b.resetType() }, ignoreInputEventListener: function () { this.ignoreInputEvent = !0 }, attachListeners: function () {
                    var a = this.undoManager.editor, c = a.editable(), d = this; c.attachListener(c, "keydown", function (a) { d.onKeydown(a); if (b.ieFunctionalKeysBug(a.data.getKey())) d.onInput() }, null, null, 999); c.attachListener(c, CKEDITOR.env.ie ?
                        "keypress" : "input", d.onInput, d, null, 999); c.attachListener(c, "keyup", d.onKeyup, d, null, 999); c.attachListener(c, "paste", d.ignoreInputEventListener, d, null, 999); c.attachListener(c, "drop", d.ignoreInputEventListener, d, null, 999); c.attachListener(c.isInline() ? c : a.document.getDocumentElement(), "click", function () { d.onNavigationKey() }, null, null, 999); c.attachListener(this.undoManager.editor, "blur", function () { d.keyEventsStack.remove(9) }, null, null, 999)
                }
            }; var m = CKEDITOR.plugins.undo.KeyEventsStack = function () {
                this.stack =
                []
            }; m.prototype = {
                push: function (a) { a = this.stack.push({ keyCode: a, inputs: 0 }); return this.stack[a - 1] }, getLastIndex: function (a) { if ("number" != typeof a) return this.stack.length - 1; for (var b = this.stack.length; b--;)if (this.stack[b].keyCode == a) return b; return -1 }, getLast: function (a) { a = this.getLastIndex(a); return -1 != a ? this.stack[a] : null }, increment: function (a) { this.getLast(a).inputs++ }, remove: function (a) { a = this.getLastIndex(a); -1 != a && this.stack.splice(a, 1) }, resetInputs: function (a) {
                    if ("number" == typeof a) this.getLast(a).inputs =
                        0; else for (a = this.stack.length; a--;)this.stack[a].inputs = 0
                }, getTotalInputs: function () { for (var a = this.stack.length, b = 0; a--;)b += this.stack[a].inputs; return b }, cleanUp: function (a) { a = a.data.$; a.ctrlKey || a.metaKey || this.remove(17); a.shiftKey || this.remove(16); a.altKey || this.remove(18) }
            }
        }(), CKEDITOR.plugins.add("wsc", {
            requires: "dialog", parseApi: function (a) {
                a.config.wsc_onFinish = "function" === typeof a.config.wsc_onFinish ? a.config.wsc_onFinish : function () { }; a.config.wsc_onClose = "function" === typeof a.config.wsc_onClose ?
                    a.config.wsc_onClose : function () { }
            }, parseConfig: function (a) {
                a.config.wsc_customerId = a.config.wsc_customerId || CKEDITOR.config.wsc_customerId || "1:ua3xw1-2XyGJ3-GWruD3-6OFNT1-oXcuB1-nR6Bp4-hgQHc-EcYng3-sdRXG3-NOfFk"; a.config.wsc_customDictionaryIds = a.config.wsc_customDictionaryIds || CKEDITOR.config.wsc_customDictionaryIds || ""; a.config.wsc_userDictionaryName = a.config.wsc_userDictionaryName || CKEDITOR.config.wsc_userDictionaryName || ""; a.config.wsc_customLoaderScript = a.config.wsc_customLoaderScript || CKEDITOR.config.wsc_customLoaderScript;
                CKEDITOR.config.wsc_cmd = a.config.wsc_cmd || CKEDITOR.config.wsc_cmd || "spell"; CKEDITOR.config.wsc_version = "v4.3.0-master-d769233"; CKEDITOR.config.wsc_removeGlobalVariable = !0
            }, init: function (a) {
                var e = CKEDITOR.env; this.parseConfig(a); this.parseApi(a); a.addCommand("checkspell", new CKEDITOR.dialogCommand("checkspell")).modes = { wysiwyg: !CKEDITOR.env.opera && !CKEDITOR.env.air && document.domain == window.location.hostname && !(e.ie && (8 > e.version || e.quirks)) }; "undefined" == typeof a.plugins.scayt && a.ui.addButton && a.ui.addButton("SpellChecker",
                    { label: a.lang.wsc.toolbar, click: function (a) { var c = a.elementMode == CKEDITOR.ELEMENT_MODE_INLINE ? a.container.getText() : a.document.getBody().getText(); (c = c.replace(/\s/g, "")) ? a.execCommand("checkspell") : alert("Nothing to check!") }, toolbar: "spellchecker,10" }); CKEDITOR.dialog.add("checkspell", this.path + (CKEDITOR.env.ie && 7 >= CKEDITOR.env.version ? "dialogs/wsc_ie.js" : window.postMessage ? "dialogs/wsc.js" : "dialogs/wsc_ie.js"))
            }
        }), function () {
            function a(a) {
                function b(a) {
                    var c = !1; g.attachListener(g, "keydown", function () {
                        var b =
                            f.getBody().getElementsByTag(a); if (!c) { for (var d = 0; d < b.count(); d++)b.getItem(d).setCustomData("retain", !0); c = !0 }
                    }, null, null, 1); g.attachListener(g, "keyup", function () { var b = f.getElementsByTag(a); c && (1 != b.count() || b.getItem(0).getCustomData("retain") || b.getItem(0).remove(1), c = !1) })
                } var c = this.editor, f = a.document, h = f.body, l = f.getElementById("cke_actscrpt"); l && l.parentNode.removeChild(l); (l = f.getElementById("cke_shimscrpt")) && l.parentNode.removeChild(l); (l = f.getElementById("cke_basetagscrpt")) && l.parentNode.removeChild(l);
                h.contentEditable = !0; CKEDITOR.env.ie && (h.hideFocus = !0, h.disabled = !0, h.removeAttribute("disabled")); delete this._.isLoadingData; this.$ = h; f = new CKEDITOR.dom.document(f); this.setup(); this.fixInitialSelection(); var g = this; CKEDITOR.env.ie && !CKEDITOR.env.edge && f.getDocumentElement().addClass(f.$.compatMode); CKEDITOR.env.ie && !CKEDITOR.env.edge && c.enterMode != CKEDITOR.ENTER_P ? b("p") : CKEDITOR.env.edge && c.enterMode != CKEDITOR.ENTER_DIV && b("div"); if (CKEDITOR.env.webkit || CKEDITOR.env.ie && 10 < CKEDITOR.env.version) f.getDocumentElement().on("mousedown",
                    function (a) { a.data.getTarget().is("html") && setTimeout(function () { c.editable().focus() }) }); e(c); try { c.document.$.execCommand("2D-position", !1, !0) } catch (n) { } (CKEDITOR.env.gecko || CKEDITOR.env.ie && "CSS1Compat" == c.document.$.compatMode) && this.attachListener(this, "keydown", function (a) {
                        var b = a.data.getKeystroke(); if (33 == b || 34 == b) if (CKEDITOR.env.ie) setTimeout(function () { c.getSelection().scrollIntoView() }, 0); else if (c.window.$.innerHeight > this.$.offsetHeight) {
                            var d = c.createRange(); d[33 == b ? "moveToElementEditStart" :
                                "moveToElementEditEnd"](this); d.select(); a.data.preventDefault()
                        }
                    }); CKEDITOR.env.ie && this.attachListener(f, "blur", function () { try { f.$.selection.empty() } catch (a) { } }); CKEDITOR.env.iOS && this.attachListener(f, "touchend", function () { a.focus() }); h = c.document.getElementsByTag("title").getItem(0); h.data("cke-title", h.getText()); CKEDITOR.env.ie && (c.document.$.title = this._.docTitle); CKEDITOR.tools.setTimeout(function () {
                        "unloaded" == this.status && (this.status = "ready"); c.fire("contentDom"); this._.isPendingFocus &&
                            (c.focus(), this._.isPendingFocus = !1); setTimeout(function () { c.fire("dataReady") }, 0)
                    }, 0, this)
            } function e(a) {
                function b() { var e; a.editable().attachListener(a, "selectionChange", function () { var b = a.getSelection().getSelectedElement(); b && (e && (e.detachEvent("onresizestart", c), e = null), b.$.attachEvent("onresizestart", c), e = b.$) }) } function c(a) { a.returnValue = !1 } if (CKEDITOR.env.gecko) try {
                    var e = a.document.$; e.execCommand("enableObjectResizing", !1, !a.config.disableObjectResizing); e.execCommand("enableInlineTableEditing",
                        !1, !a.config.disableNativeTableHandles)
                } catch (h) { } else CKEDITOR.env.ie && 11 > CKEDITOR.env.version && a.config.disableObjectResizing && b(a)
            } function b() {
                var a = []; if (8 <= CKEDITOR.document.$.documentMode) { a.push("html.CSS1Compat [contenteditable\x3dfalse]{min-height:0 !important}"); var b = [], c; for (c in CKEDITOR.dtd.$removeEmpty) b.push("html.CSS1Compat " + c + "[contenteditable\x3dfalse]"); a.push(b.join(",") + "{display:inline-block}") } else CKEDITOR.env.gecko && (a.push("html{height:100% !important}"), a.push("img:-moz-broken{-moz-force-broken-image-icon:1;min-width:24px;min-height:24px}"));
                a.push("html{cursor:text;*cursor:auto}"); a.push("img,input,textarea{cursor:default}"); return a.join("\n")
            } CKEDITOR.plugins.add("wysiwygarea", {
                init: function (a) {
                    a.config.fullPage && a.addFeature({ allowedContent: "html head title; style [media,type]; body (*)[id]; meta link [*]", requiredContent: "body" }); a.addMode("wysiwyg", function (b) {
                        function e(f) { f && f.removeListener(); a.editable(new c(a, h.$.contentWindow.document.body)); a.setData(a.getData(1), b) } var f = "document.open();" + (CKEDITOR.env.ie ? "(" + CKEDITOR.tools.fixDomain +
                            ")();" : "") + "document.close();", f = CKEDITOR.env.air ? "javascript:void(0)" : CKEDITOR.env.ie && !CKEDITOR.env.edge ? "javascript:void(function(){" + encodeURIComponent(f) + "}())" : "", h = CKEDITOR.dom.element.createFromHtml('\x3ciframe src\x3d"' + f + '" frameBorder\x3d"0"\x3e\x3c/iframe\x3e'); h.setStyles({ width: "100%", height: "100%" }); h.addClass("cke_wysiwyg_frame").addClass("cke_reset"); f = a.ui.space("contents"); f.append(h); var l = CKEDITOR.env.ie && !CKEDITOR.env.edge || CKEDITOR.env.gecko; if (l) h.on("load", e); var g = a.title,
                                n = a.fire("ariaEditorHelpLabel", {}).label; g && (CKEDITOR.env.ie && n && (g += ", " + n), h.setAttribute("title", g)); if (n) { var g = CKEDITOR.tools.getNextId(), v = CKEDITOR.dom.element.createFromHtml('\x3cspan id\x3d"' + g + '" class\x3d"cke_voice_label"\x3e' + n + "\x3c/span\x3e"); f.append(v, 1); h.setAttribute("aria-describedby", g) } a.on("beforeModeUnload", function (a) { a.removeListener(); v && v.remove() }); h.setAttributes({ tabIndex: a.tabIndex, allowTransparency: "true" }); !l && e(); a.fire("ariaWidget", h)
                    })
                }
            }); CKEDITOR.editor.prototype.addContentsCss =
                function (a) { var b = this.config, c = b.contentsCss; CKEDITOR.tools.isArray(c) || (b.contentsCss = c ? [c] : []); b.contentsCss.push(a) }; var c = CKEDITOR.tools.createClass({
                    $: function () { this.base.apply(this, arguments); this._.frameLoadedHandler = CKEDITOR.tools.addFunction(function (b) { CKEDITOR.tools.setTimeout(a, 0, this, b) }, this); this._.docTitle = this.getWindow().getFrame().getAttribute("title") }, base: CKEDITOR.editable, proto: {
                        setData: function (a, c) {
                            var e = this.editor; if (c) this.setHtml(a), this.fixInitialSelection(), e.fire("dataReady");
                            else {
                                this._.isLoadingData = !0; e._.dataStore = { id: 1 }; var f = e.config, h = f.fullPage, l = f.docType, g = CKEDITOR.tools.buildStyleHtml(b()).replace(/<style>/, '\x3cstyle data-cke-temp\x3d"1"\x3e'); h || (g += CKEDITOR.tools.buildStyleHtml(e.config.contentsCss)); var n = f.baseHref ? '\x3cbase href\x3d"' + f.baseHref + '" data-cke-temp\x3d"1" /\x3e' : ""; h && (a = a.replace(/<!DOCTYPE[^>]*>/i, function (a) { e.docType = l = a; return "" }).replace(/<\?xml\s[^\?]*\?>/i, function (a) { e.xmlDeclaration = a; return "" })); a = e.dataProcessor.toHtml(a); h ? (/<body[\s|>]/.test(a) ||
                                    (a = "\x3cbody\x3e" + a), /<html[\s|>]/.test(a) || (a = "\x3chtml\x3e" + a + "\x3c/html\x3e"), /<head[\s|>]/.test(a) ? /<title[\s|>]/.test(a) || (a = a.replace(/<head[^>]*>/, "$\x26\x3ctitle\x3e\x3c/title\x3e")) : a = a.replace(/<html[^>]*>/, "$\x26\x3chead\x3e\x3ctitle\x3e\x3c/title\x3e\x3c/head\x3e"), n && (a = a.replace(/<head[^>]*?>/, "$\x26" + n)), a = a.replace(/<\/head\s*>/, g + "$\x26"), a = l + a) : a = f.docType + '\x3chtml dir\x3d"' + f.contentsLangDirection + '" lang\x3d"' + (f.contentsLanguage || e.langCode) + '"\x3e\x3chead\x3e\x3ctitle\x3e' +
                                    this._.docTitle + "\x3c/title\x3e" + n + g + "\x3c/head\x3e\x3cbody" + (f.bodyId ? ' id\x3d"' + f.bodyId + '"' : "") + (f.bodyClass ? ' class\x3d"' + f.bodyClass + '"' : "") + "\x3e" + a + "\x3c/body\x3e\x3c/html\x3e"; CKEDITOR.env.gecko && (a = a.replace(/<body/, '\x3cbody contenteditable\x3d"true" '), 2E4 > CKEDITOR.env.version && (a = a.replace(/<body[^>]*>/, "$\x26\x3c!-- cke-content-start --\x3e"))); f = '\x3cscript id\x3d"cke_actscrpt" type\x3d"text/javascript"' + (CKEDITOR.env.ie ? ' defer\x3d"defer" ' : "") + "\x3evar wasLoaded\x3d0;function onload(){if(!wasLoaded)window.parent.CKEDITOR.tools.callFunction(" +
                                        this._.frameLoadedHandler + ",window);wasLoaded\x3d1;}" + (CKEDITOR.env.ie ? "onload();" : 'document.addEventListener("DOMContentLoaded", onload, false );') + "\x3c/script\x3e"; CKEDITOR.env.ie && 9 > CKEDITOR.env.version && (f += '\x3cscript id\x3d"cke_shimscrpt"\x3ewindow.parent.CKEDITOR.tools.enableHtml5Elements(document)\x3c/script\x3e'); n && CKEDITOR.env.ie && 10 > CKEDITOR.env.version && (f += '\x3cscript id\x3d"cke_basetagscrpt"\x3evar baseTag \x3d document.querySelector( "base" );baseTag.href \x3d baseTag.href;\x3c/script\x3e');
                                a = a.replace(/(?=\s*<\/(:?head)>)/, f); this.clearCustomData(); this.clearListeners(); e.fire("contentDomUnload"); var v = this.getDocument(); try { v.write(a) } catch (u) { setTimeout(function () { v.write(a) }, 0) }
                            }
                        }, getData: function (a) {
                            if (a) return this.getHtml(); a = this.editor; var b = a.config, c = b.fullPage, e = c && a.docType, h = c && a.xmlDeclaration, l = this.getDocument(), c = c ? l.getDocumentElement().getOuterHtml() : l.getBody().getHtml(); CKEDITOR.env.gecko && b.enterMode != CKEDITOR.ENTER_BR && (c = c.replace(/<br>(?=\s*(:?$|<\/body>))/,
                                "")); c = a.dataProcessor.toDataFormat(c); h && (c = h + "\n" + c); e && (c = e + "\n" + c); return c
                        }, focus: function () { this._.isLoadingData ? this._.isPendingFocus = !0 : c.baseProto.focus.call(this) }, detach: function () {
                            var a = this.editor, b = a.document, e; try { e = a.window.getFrame() } catch (f) { } c.baseProto.detach.call(this); this.clearCustomData(); b.getDocumentElement().clearCustomData(); CKEDITOR.tools.removeFunction(this._.frameLoadedHandler); e && e.getParent() ? (e.clearCustomData(), (a = e.removeCustomData("onResize")) && a.removeListener(),
                                e.remove()) : CKEDITOR.warn("editor-destroy-iframe")
                        }
                    }
                })
        }(), CKEDITOR.config.disableObjectResizing = !1, CKEDITOR.config.disableNativeTableHandles = !0, CKEDITOR.config.disableNativeSpellChecker = !0, CKEDITOR.config.plugins = "dialogui,dialog,a11yhelp,about,basicstyles,blockquote,clipboard,panel,floatpanel,menu,contextmenu,elementspath,indent,indentlist,list,enterkey,entities,popup,filebrowser,floatingspace,listblock,button,richcombo,format,horizontalrule,htmlwriter,image,fakeobjects,link,magicline,maximize,pastefromword,pastetext,removeformat,resize,menubutton,scayt,showborders,sourcearea,specialchar,stylescombo,tab,table,tabletools,toolbar,undo,wsc,wysiwygarea",
        CKEDITOR.config.skin = "moono", function () {
            var a = function (a, b) { var c = CKEDITOR.getUrl("plugins/" + b); a = a.split(","); for (var d = 0; d < a.length; d++)CKEDITOR.skin.icons[a[d]] = { path: c, offset: -a[++d], bgsize: a[++d] } }; CKEDITOR.env.hidpi ? a("about,0,,bold,24,,italic,48,,strike,72,,subscript,96,,superscript,120,,underline,144,,bidiltr,168,,bidirtl,192,,blockquote,216,,copy-rtl,240,,copy,264,,cut-rtl,288,,cut,312,,paste-rtl,336,,paste,360,,codesnippet,384,,bgcolor,408,,textcolor,432,,creatediv,456,,docprops-rtl,480,,docprops,504,,embed,528,,embedsemantic,552,,find-rtl,576,,find,600,,replace,624,,flash,648,,button,672,,checkbox,696,,form,720,,hiddenfield,744,,imagebutton,768,,radio,792,,select-rtl,816,,select,840,,textarea-rtl,864,,textarea,888,,textfield-rtl,912,,textfield,936,,horizontalrule,960,,iframe,984,,image,1008,,indent-rtl,1032,,indent,1056,,outdent-rtl,1080,,outdent,1104,,justifyblock,1128,,justifycenter,1152,,justifyleft,1176,,justifyright,1200,,language,1224,,anchor-rtl,1248,,anchor,1272,,link,1296,,unlink,1320,,bulletedlist-rtl,1344,,bulletedlist,1368,,numberedlist-rtl,1392,,numberedlist,1416,,mathjax,1440,,maximize,1464,,newpage-rtl,1488,,newpage,1512,,pagebreak-rtl,1536,,pagebreak,1560,,pastefromword-rtl,1584,,pastefromword,1608,,pastetext-rtl,1632,,pastetext,1656,,placeholder,1680,,preview-rtl,1704,,preview,1728,,print,1752,,removeformat,1776,,save,1800,,scayt,1824,,selectall,1848,,showblocks-rtl,1872,,showblocks,1896,,smiley,1920,,source-rtl,1944,,source,1968,,sourcedialog-rtl,1992,,sourcedialog,2016,,specialchar,2040,,table,2064,,templates-rtl,2088,,templates,2112,,uicolor,2136,,redo-rtl,2160,,redo,2184,,undo-rtl,2208,,undo,2232,,simplebox,4512,auto,spellchecker,2280,",
                "icons_hidpi.png") : a("about,0,auto,bold,24,auto,italic,48,auto,strike,72,auto,subscript,96,auto,superscript,120,auto,underline,144,auto,bidiltr,168,auto,bidirtl,192,auto,blockquote,216,auto,copy-rtl,240,auto,copy,264,auto,cut-rtl,288,auto,cut,312,auto,paste-rtl,336,auto,paste,360,auto,codesnippet,384,auto,bgcolor,408,auto,textcolor,432,auto,creatediv,456,auto,docprops-rtl,480,auto,docprops,504,auto,embed,528,auto,embedsemantic,552,auto,find-rtl,576,auto,find,600,auto,replace,624,auto,flash,648,auto,button,672,auto,checkbox,696,auto,form,720,auto,hiddenfield,744,auto,imagebutton,768,auto,radio,792,auto,select-rtl,816,auto,select,840,auto,textarea-rtl,864,auto,textarea,888,auto,textfield-rtl,912,auto,textfield,936,auto,horizontalrule,960,auto,iframe,984,auto,image,1008,auto,indent-rtl,1032,auto,indent,1056,auto,outdent-rtl,1080,auto,outdent,1104,auto,justifyblock,1128,auto,justifycenter,1152,auto,justifyleft,1176,auto,justifyright,1200,auto,language,1224,auto,anchor-rtl,1248,auto,anchor,1272,auto,link,1296,auto,unlink,1320,auto,bulletedlist-rtl,1344,auto,bulletedlist,1368,auto,numberedlist-rtl,1392,auto,numberedlist,1416,auto,mathjax,1440,auto,maximize,1464,auto,newpage-rtl,1488,auto,newpage,1512,auto,pagebreak-rtl,1536,auto,pagebreak,1560,auto,pastefromword-rtl,1584,auto,pastefromword,1608,auto,pastetext-rtl,1632,auto,pastetext,1656,auto,placeholder,1680,auto,preview-rtl,1704,auto,preview,1728,auto,print,1752,auto,removeformat,1776,auto,save,1800,auto,scayt,1824,auto,selectall,1848,auto,showblocks-rtl,1872,auto,showblocks,1896,auto,smiley,1920,auto,source-rtl,1944,auto,source,1968,auto,sourcedialog-rtl,1992,auto,sourcedialog,2016,auto,specialchar,2040,auto,table,2064,auto,templates-rtl,2088,auto,templates,2112,auto,uicolor,2136,auto,redo-rtl,2160,auto,redo,2184,auto,undo-rtl,2208,auto,undo,2232,auto,simplebox,2256,auto,spellchecker,2280,auto",
                    "icons.png")
        }())
})();