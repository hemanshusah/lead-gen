import {
    r as t,
    g as n
} from "./vendor-BkLVKQpg.js";
var e, r, i = {
        exports: {}
    },
    o = {};
var u = (r || (r = 1, i.exports = function() {
    if (e) return o;
    e = 1;
    var t = Symbol.for("react.transitional.element"),
        n = Symbol.for("react.fragment");

    function r(n, e, r) {
        var i = null;
        if (void 0 !== r && (i = "" + r), void 0 !== e.key && (i = "" + e.key), "key" in e)
            for (var o in r = {}, e) "key" !== o && (r[o] = e[o]);
        else r = e;
        return e = r.ref, {
            $$typeof: t,
            type: n,
            key: i,
            ref: void 0 !== e ? e : null,
            props: r
        }
    }
    return o.Fragment = n, o.jsx = r, o.jsxs = r, o
}()), i.exports);

function a(t) {
    if ("string" == typeof t || "number" == typeof t) return "" + t;
    let n = "";
    if (Array.isArray(t))
        for (let e, r = 0; r < t.length; r++) "" !== (e = a(t[r])) && (n += (n && " ") + e);
    else
        for (let e in t) t[e] && (n += (n && " ") + e);
    return n
}
var s, l, c, h, f = {
        exports: {}
    },
    p = {},
    v = {
        exports: {}
    },
    d = {};

function m() {
    return l || (l = 1, v.exports = function() {
        if (s) return d;
        s = 1;
        var n = t(),
            e = "function" == typeof Object.is ? Object.is : function(t, n) {
                return t === n && (0 !== t || 1 / t == 1 / n) || t != t && n != n
            },
            r = n.useState,
            i = n.useEffect,
            o = n.useLayoutEffect,
            u = n.useDebugValue;

        function a(t) {
            var n = t.getSnapshot;
            t = t.value;
            try {
                var r = n();
                return !e(t, r)
            } catch (i) {
                return !0
            }
        }
        var l = "undefined" == typeof window || void 0 === window.document || void 0 === window.document.createElement ? function(t, n) {
            return n()
        } : function(t, n) {
            var e = n(),
                s = r({
                    inst: {
                        value: e,
                        getSnapshot: n
                    }
                }),
                l = s[0].inst,
                c = s[1];
            return o(function() {
                l.value = e, l.getSnapshot = n, a(l) && c({
                    inst: l
                })
            }, [t, e, n]), i(function() {
                return a(l) && c({
                    inst: l
                }), t(function() {
                    a(l) && c({
                        inst: l
                    })
                })
            }, [t]), u(e), e
        };
        return d.useSyncExternalStore = void 0 !== n.useSyncExternalStore ? n.useSyncExternalStore : l, d
    }()), v.exports
}
/**
 * @license React
 * use-sync-external-store-shim/with-selector.production.js
 *
 * Copyright (c) Meta Platforms, Inc. and affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */
const y = n((h || (h = 1, f.exports = function() {
    if (c) return p;
    c = 1;
    var n = t(),
        e = m(),
        r = "function" == typeof Object.is ? Object.is : function(t, n) {
            return t === n && (0 !== t || 1 / t == 1 / n) || t != t && n != n
        },
        i = e.useSyncExternalStore,
        o = n.useRef,
        u = n.useEffect,
        a = n.useMemo,
        s = n.useDebugValue;
    return p.useSyncExternalStoreWithSelector = function(t, n, e, l, c) {
        var h = o(null);
        if (null === h.current) {
            var f = {
                hasValue: !1,
                value: null
            };
            h.current = f
        } else f = h.current;
        h = a(function() {
            function t(t) {
                if (!u) {
                    if (u = !0, i = t, t = l(t), void 0 !== c && f.hasValue) {
                        var n = f.value;
                        if (c(n, t)) return o = n
                    }
                    return o = t
                }
                if (n = o, r(i, t)) return n;
                var e = l(t);
                return void 0 !== c && c(n, e) ? (i = t, n) : (i = t, o = e)
            }
            var i, o, u = !1,
                a = void 0 === e ? null : e;
            return [function() {
                return t(n())
            }, null === a ? void 0 : function() {
                return t(a())
            }]
        }, [n, e, l, c]);
        var p = i(t, h[0], h[1]);
        return u(function() {
            f.hasValue = !0, f.value = p
        }, [p]), s(p), p
    }, p
}()), f.exports));
var g = {
    value: () => {}
};

function _() {
    for (var t, n = 0, e = arguments.length, r = {}; n < e; ++n) {
        if (!(t = arguments[n] + "") || t in r || /[\s.]/.test(t)) throw new Error("illegal type: " + t);
        r[t] = []
    }
    return new w(r)
}

function w(t) {
    this._ = t
}

function b(t, n) {
    for (var e, r = 0, i = t.length; r < i; ++r)
        if ((e = t[r]).name === n) return e.value
}

function x(t, n, e) {
    for (var r = 0, i = t.length; r < i; ++r)
        if (t[r].name === n) {
            t[r] = g, t = t.slice(0, r).concat(t.slice(r + 1));
            break
        } return null != e && t.push({
        name: n,
        value: e
    }), t
}
w.prototype = _.prototype = {
    constructor: w,
    on: function(t, n) {
        var e, r, i = this._,
            o = (r = i, (t + "").trim().split(/^|\s+/).map(function(t) {
                var n = "",
                    e = t.indexOf(".");
                if (e >= 0 && (n = t.slice(e + 1), t = t.slice(0, e)), t && !r.hasOwnProperty(t)) throw new Error("unknown type: " + t);
                return {
                    type: t,
                    name: n
                }
            })),
            u = -1,
            a = o.length;
        if (!(arguments.length < 2)) {
            if (null != n && "function" != typeof n) throw new Error("invalid callback: " + n);
            for (; ++u < a;)
                if (e = (t = o[u]).type) i[e] = x(i[e], t.name, n);
                else if (null == n)
                for (e in i) i[e] = x(i[e], t.name, null);
            return this
        }
        for (; ++u < a;)
            if ((e = (t = o[u]).type) && (e = b(i[e], t.name))) return e
    },
    copy: function() {
        var t = {},
            n = this._;
        for (var e in n) t[e] = n[e].slice();
        return new w(t)
    },
    call: function(t, n) {
        if ((e = arguments.length - 2) > 0)
            for (var e, r, i = new Array(e), o = 0; o < e; ++o) i[o] = arguments[o + 2];
        if (!this._.hasOwnProperty(t)) throw new Error("unknown type: " + t);
        for (o = 0, e = (r = this._[t]).length; o < e; ++o) r[o].value.apply(n, i)
    },
    apply: function(t, n, e) {
        if (!this._.hasOwnProperty(t)) throw new Error("unknown type: " + t);
        for (var r = this._[t], i = 0, o = r.length; i < o; ++i) r[i].value.apply(n, e)
    }
};
var k = "http://www.w3.org/1999/xhtml";
const E = {
    svg: "http://www.w3.org/2000/svg",
    xhtml: k,
    xlink: "http://www.w3.org/1999/xlink",
    xml: "http://www.w3.org/XML/1998/namespace",
    xmlns: "http://www.w3.org/2000/xmlns/"
};

function M(t) {
    var n = t += "",
        e = n.indexOf(":");
    return e >= 0 && "xmlns" !== (n = t.slice(0, e)) && (t = t.slice(e + 1)), E.hasOwnProperty(n) ? {
        space: E[n],
        local: t
    } : t
}

function A(t) {
    return function() {
        var n = this.ownerDocument,
            e = this.namespaceURI;
        return e === k && n.documentElement.namespaceURI === k ? n.createElement(t) : n.createElementNS(e, t)
    }
}

function S(t) {
    return function() {
        return this.ownerDocument.createElementNS(t.space, t.local)
    }
}

function N(t) {
    var n = M(t);
    return (n.local ? S : A)(n)
}

function z() {}

function $(t) {
    return null == t ? z : function() {
        return this.querySelector(t)
    }
}

function T() {
    return []
}

function P(t) {
    return null == t ? T : function() {
        return this.querySelectorAll(t)
    }
}

function X(t) {
    return function() {
        return null == (n = t.apply(this, arguments)) ? [] : Array.isArray(n) ? n : Array.from(n);
        var n
    }
}

function C(t) {
    return function() {
        return this.matches(t)
    }
}

function q(t) {
    return function(n) {
        return n.matches(t)
    }
}
var j = Array.prototype.find;

function O() {
    return this.firstElementChild
}
var Y = Array.prototype.filter;

function R() {
    return Array.from(this.children)
}

function V(t) {
    return new Array(t.length)
}

function D(t, n) {
    this.ownerDocument = t.ownerDocument, this.namespaceURI = t.namespaceURI, this._next = null, this._parent = t, this.__data__ = n
}

function I(t, n, e, r, i, o) {
    for (var u, a = 0, s = n.length, l = o.length; a < l; ++a)(u = n[a]) ? (u.__data__ = o[a], r[a] = u) : e[a] = new D(t, o[a]);
    for (; a < s; ++a)(u = n[a]) && (i[a] = u)
}

function B(t, n, e, r, i, o, u) {
    var a, s, l, c = new Map,
        h = n.length,
        f = o.length,
        p = new Array(h);
    for (a = 0; a < h; ++a)(s = n[a]) && (p[a] = l = u.call(s, s.__data__, a, n) + "", c.has(l) ? i[a] = s : c.set(l, s));
    for (a = 0; a < f; ++a) l = u.call(t, o[a], a, o) + "", (s = c.get(l)) ? (r[a] = s, s.__data__ = o[a], c.delete(l)) : e[a] = new D(t, o[a]);
    for (a = 0; a < h; ++a)(s = n[a]) && c.get(p[a]) === s && (i[a] = s)
}

function H(t) {
    return t.__data__
}

function L(t) {
    return "object" == typeof t && "length" in t ? t : Array.from(t)
}

function U(t, n) {
    return t < n ? -1 : t > n ? 1 : t >= n ? 0 : NaN
}

function G(t) {
    return function() {
        this.removeAttribute(t)
    }
}

function K(t) {
    return function() {
        this.removeAttributeNS(t.space, t.local)
    }
}

function F(t, n) {
    return function() {
        this.setAttribute(t, n)
    }
}

function W(t, n) {
    return function() {
        this.setAttributeNS(t.space, t.local, n)
    }
}

function Q(t, n) {
    return function() {
        var e = n.apply(this, arguments);
        null == e ? this.removeAttribute(t) : this.setAttribute(t, e)
    }
}

function J(t, n) {
    return function() {
        var e = n.apply(this, arguments);
        null == e ? this.removeAttributeNS(t.space, t.local) : this.setAttributeNS(t.space, t.local, e)
    }
}

function Z(t) {
    return t.ownerDocument && t.ownerDocument.defaultView || t.document && t || t.defaultView
}

function tt(t) {
    return function() {
        this.style.removeProperty(t)
    }
}

function nt(t, n, e) {
    return function() {
        this.style.setProperty(t, n, e)
    }
}

function et(t, n, e) {
    return function() {
        var r = n.apply(this, arguments);
        null == r ? this.style.removeProperty(t) : this.style.setProperty(t, r, e)
    }
}

function rt(t, n) {
    return t.style.getPropertyValue(n) || Z(t).getComputedStyle(t, null).getPropertyValue(n)
}

function it(t) {
    return function() {
        delete this[t]
    }
}

function ot(t, n) {
    return function() {
        this[t] = n
    }
}

function ut(t, n) {
    return function() {
        var e = n.apply(this, arguments);
        null == e ? delete this[t] : this[t] = e
    }
}

function at(t) {
    return t.trim().split(/^|\s+/)
}

function st(t) {
    return t.classList || new lt(t)
}

function lt(t) {
    this._node = t, this._names = at(t.getAttribute("class") || "")
}

function ct(t, n) {
    for (var e = st(t), r = -1, i = n.length; ++r < i;) e.add(n[r])
}

function ht(t, n) {
    for (var e = st(t), r = -1, i = n.length; ++r < i;) e.remove(n[r])
}

function ft(t) {
    return function() {
        ct(this, t)
    }
}

function pt(t) {
    return function() {
        ht(this, t)
    }
}

function vt(t, n) {
    return function() {
        (n.apply(this, arguments) ? ct : ht)(this, t)
    }
}

function dt() {
    this.textContent = ""
}

function mt(t) {
    return function() {
        this.textContent = t
    }
}

function yt(t) {
    return function() {
        var n = t.apply(this, arguments);
        this.textContent = null == n ? "" : n
    }
}

function gt() {
    this.innerHTML = ""
}

function _t(t) {
    return function() {
        this.innerHTML = t
    }
}

function wt(t) {
    return function() {
        var n = t.apply(this, arguments);
        this.innerHTML = null == n ? "" : n
    }
}

function bt() {
    this.nextSibling && this.parentNode.appendChild(this)
}

function xt() {
    this.previousSibling && this.parentNode.insertBefore(this, this.parentNode.firstChild)
}

function kt() {
    return null
}

function Et() {
    var t = this.parentNode;
    t && t.removeChild(this)
}

function Mt() {
    var t = this.cloneNode(!1),
        n = this.parentNode;
    return n ? n.insertBefore(t, this.nextSibling) : t
}

function At() {
    var t = this.cloneNode(!0),
        n = this.parentNode;
    return n ? n.insertBefore(t, this.nextSibling) : t
}

function St(t) {
    return function() {
        var n = this.__on;
        if (n) {
            for (var e, r = 0, i = -1, o = n.length; r < o; ++r) e = n[r], t.type && e.type !== t.type || e.name !== t.name ? n[++i] = e : this.removeEventListener(e.type, e.listener, e.options);
            ++i ? n.length = i : delete this.__on
        }
    }
}

function Nt(t, n, e) {
    return function() {
        var r, i = this.__on,
            o = function(t) {
                return function(n) {
                    t.call(this, n, this.__data__)
                }
            }(n);
        if (i)
            for (var u = 0, a = i.length; u < a; ++u)
                if ((r = i[u]).type === t.type && r.name === t.name) return this.removeEventListener(r.type, r.listener, r.options), this.addEventListener(r.type, r.listener = o, r.options = e), void(r.value = n);
        this.addEventListener(t.type, o, e), r = {
            type: t.type,
            name: t.name,
            value: n,
            listener: o,
            options: e
        }, i ? i.push(r) : this.__on = [r]
    }
}

function zt(t, n, e) {
    var r = Z(t),
        i = r.CustomEvent;
    "function" == typeof i ? i = new i(n, e) : (i = r.document.createEvent("Event"), e ? (i.initEvent(n, e.bubbles, e.cancelable), i.detail = e.detail) : i.initEvent(n, !1, !1)), t.dispatchEvent(i)
}

function $t(t, n) {
    return function() {
        return zt(this, t, n)
    }
}

function Tt(t, n) {
    return function() {
        return zt(this, t, n.apply(this, arguments))
    }
}
D.prototype = {
    constructor: D,
    appendChild: function(t) {
        return this._parent.insertBefore(t, this._next)
    },
    insertBefore: function(t, n) {
        return this._parent.insertBefore(t, n)
    },
    querySelector: function(t) {
        return this._parent.querySelector(t)
    },
    querySelectorAll: function(t) {
        return this._parent.querySelectorAll(t)
    }
}, lt.prototype = {
    add: function(t) {
        this._names.indexOf(t) < 0 && (this._names.push(t), this._node.setAttribute("class", this._names.join(" ")))
    },
    remove: function(t) {
        var n = this._names.indexOf(t);
        n >= 0 && (this._names.splice(n, 1), this._node.setAttribute("class", this._names.join(" ")))
    },
    contains: function(t) {
        return this._names.indexOf(t) >= 0
    }
};
var Pt = [null];

function Xt(t, n) {
    this._groups = t, this._parents = n
}

function Ct() {
    return new Xt([
        [document.documentElement]
    ], Pt)
}

function qt(t) {
    return "string" == typeof t ? new Xt([
        [document.querySelector(t)]
    ], [document.documentElement]) : new Xt([
        [t]
    ], Pt)
}

function jt(t, n) {
    if (t = function(t) {
            let n;
            for (; n = t.sourceEvent;) t = n;
            return t
        }(t), void 0 === n && (n = t.currentTarget), n) {
        var e = n.ownerSVGElement || n;
        if (e.createSVGPoint) {
            var r = e.createSVGPoint();
            return r.x = t.clientX, r.y = t.clientY, [(r = r.matrixTransform(n.getScreenCTM().inverse())).x, r.y]
        }
        if (n.getBoundingClientRect) {
            var i = n.getBoundingClientRect();
            return [t.clientX - i.left - n.clientLeft, t.clientY - i.top - n.clientTop]
        }
    }
    return [t.pageX, t.pageY]
}
Xt.prototype = Ct.prototype = {
    constructor: Xt,
    select: function(t) {
        "function" != typeof t && (t = $(t));
        for (var n = this._groups, e = n.length, r = new Array(e), i = 0; i < e; ++i)
            for (var o, u, a = n[i], s = a.length, l = r[i] = new Array(s), c = 0; c < s; ++c)(o = a[c]) && (u = t.call(o, o.__data__, c, a)) && ("__data__" in o && (u.__data__ = o.__data__), l[c] = u);
        return new Xt(r, this._parents)
    },
    selectAll: function(t) {
        t = "function" == typeof t ? X(t) : P(t);
        for (var n = this._groups, e = n.length, r = [], i = [], o = 0; o < e; ++o)
            for (var u, a = n[o], s = a.length, l = 0; l < s; ++l)(u = a[l]) && (r.push(t.call(u, u.__data__, l, a)), i.push(u));
        return new Xt(r, i)
    },
    selectChild: function(t) {
        return this.select(null == t ? O : function(t) {
            return function() {
                return j.call(this.children, t)
            }
        }("function" == typeof t ? t : q(t)))
    },
    selectChildren: function(t) {
        return this.selectAll(null == t ? R : function(t) {
            return function() {
                return Y.call(this.children, t)
            }
        }("function" == typeof t ? t : q(t)))
    },
    filter: function(t) {
        "function" != typeof t && (t = C(t));
        for (var n = this._groups, e = n.length, r = new Array(e), i = 0; i < e; ++i)
            for (var o, u = n[i], a = u.length, s = r[i] = [], l = 0; l < a; ++l)(o = u[l]) && t.call(o, o.__data__, l, u) && s.push(o);
        return new Xt(r, this._parents)
    },
    data: function(t, n) {
        if (!arguments.length) return Array.from(this, H);
        var e, r = n ? B : I,
            i = this._parents,
            o = this._groups;
        "function" != typeof t && (e = t, t = function() {
            return e
        });
        for (var u = o.length, a = new Array(u), s = new Array(u), l = new Array(u), c = 0; c < u; ++c) {
            var h = i[c],
                f = o[c],
                p = f.length,
                v = L(t.call(h, h && h.__data__, c, i)),
                d = v.length,
                m = s[c] = new Array(d),
                y = a[c] = new Array(d);
            r(h, f, m, y, l[c] = new Array(p), v, n);
            for (var g, _, w = 0, b = 0; w < d; ++w)
                if (g = m[w]) {
                    for (w >= b && (b = w + 1); !(_ = y[b]) && ++b < d;);
                    g._next = _ || null
                }
        }
        return (a = new Xt(a, i))._enter = s, a._exit = l, a
    },
    enter: function() {
        return new Xt(this._enter || this._groups.map(V), this._parents)
    },
    exit: function() {
        return new Xt(this._exit || this._groups.map(V), this._parents)
    },
    join: function(t, n, e) {
        var r = this.enter(),
            i = this,
            o = this.exit();
        return "function" == typeof t ? (r = t(r)) && (r = r.selection()) : r = r.append(t + ""), null != n && (i = n(i)) && (i = i.selection()), null == e ? o.remove() : e(o), r && i ? r.merge(i).order() : i
    },
    merge: function(t) {
        for (var n = t.selection ? t.selection() : t, e = this._groups, r = n._groups, i = e.length, o = r.length, u = Math.min(i, o), a = new Array(i), s = 0; s < u; ++s)
            for (var l, c = e[s], h = r[s], f = c.length, p = a[s] = new Array(f), v = 0; v < f; ++v)(l = c[v] || h[v]) && (p[v] = l);
        for (; s < i; ++s) a[s] = e[s];
        return new Xt(a, this._parents)
    },
    selection: function() {
        return this
    },
    order: function() {
        for (var t = this._groups, n = -1, e = t.length; ++n < e;)
            for (var r, i = t[n], o = i.length - 1, u = i[o]; --o >= 0;)(r = i[o]) && (u && 4 ^ r.compareDocumentPosition(u) && u.parentNode.insertBefore(r, u), u = r);
        return this
    },
    sort: function(t) {
        function n(n, e) {
            return n && e ? t(n.__data__, e.__data__) : !n - !e
        }
        t || (t = U);
        for (var e = this._groups, r = e.length, i = new Array(r), o = 0; o < r; ++o) {
            for (var u, a = e[o], s = a.length, l = i[o] = new Array(s), c = 0; c < s; ++c)(u = a[c]) && (l[c] = u);
            l.sort(n)
        }
        return new Xt(i, this._parents).order()
    },
    call: function() {
        var t = arguments[0];
        return arguments[0] = this, t.apply(null, arguments), this
    },
    nodes: function() {
        return Array.from(this)
    },
    node: function() {
        for (var t = this._groups, n = 0, e = t.length; n < e; ++n)
            for (var r = t[n], i = 0, o = r.length; i < o; ++i) {
                var u = r[i];
                if (u) return u
            }
        return null
    },
    size: function() {
        let t = 0;
        for (const n of this) ++t;
        return t
    },
    empty: function() {
        return !this.node()
    },
    each: function(t) {
        for (var n = this._groups, e = 0, r = n.length; e < r; ++e)
            for (var i, o = n[e], u = 0, a = o.length; u < a; ++u)(i = o[u]) && t.call(i, i.__data__, u, o);
        return this
    },
    attr: function(t, n) {
        var e = M(t);
        if (arguments.length < 2) {
            var r = this.node();
            return e.local ? r.getAttributeNS(e.space, e.local) : r.getAttribute(e)
        }
        return this.each((null == n ? e.local ? K : G : "function" == typeof n ? e.local ? J : Q : e.local ? W : F)(e, n))
    },
    style: function(t, n, e) {
        return arguments.length > 1 ? this.each((null == n ? tt : "function" == typeof n ? et : nt)(t, n, null == e ? "" : e)) : rt(this.node(), t)
    },
    property: function(t, n) {
        return arguments.length > 1 ? this.each((null == n ? it : "function" == typeof n ? ut : ot)(t, n)) : this.node()[t]
    },
    classed: function(t, n) {
        var e = at(t + "");
        if (arguments.length < 2) {
            for (var r = st(this.node()), i = -1, o = e.length; ++i < o;)
                if (!r.contains(e[i])) return !1;
            return !0
        }
        return this.each(("function" == typeof n ? vt : n ? ft : pt)(e, n))
    },
    text: function(t) {
        return arguments.length ? this.each(null == t ? dt : ("function" == typeof t ? yt : mt)(t)) : this.node().textContent
    },
    html: function(t) {
        return arguments.length ? this.each(null == t ? gt : ("function" == typeof t ? wt : _t)(t)) : this.node().innerHTML
    },
    raise: function() {
        return this.each(bt)
    },
    lower: function() {
        return this.each(xt)
    },
    append: function(t) {
        var n = "function" == typeof t ? t : N(t);
        return this.select(function() {
            return this.appendChild(n.apply(this, arguments))
        })
    },
    insert: function(t, n) {
        var e = "function" == typeof t ? t : N(t),
            r = null == n ? kt : "function" == typeof n ? n : $(n);
        return this.select(function() {
            return this.insertBefore(e.apply(this, arguments), r.apply(this, arguments) || null)
        })
    },
    remove: function() {
        return this.each(Et)
    },
    clone: function(t) {
        return this.select(t ? At : Mt)
    },
    datum: function(t) {
        return arguments.length ? this.property("__data__", t) : this.node().__data__
    },
    on: function(t, n, e) {
        var r, i, o = function(t) {
                return t.trim().split(/^|\s+/).map(function(t) {
                    var n = "",
                        e = t.indexOf(".");
                    return e >= 0 && (n = t.slice(e + 1), t = t.slice(0, e)), {
                        type: t,
                        name: n
                    }
                })
            }(t + ""),
            u = o.length;
        if (!(arguments.length < 2)) {
            for (a = n ? Nt : St, r = 0; r < u; ++r) this.each(a(o[r], n, e));
            return this
        }
        var a = this.node().__on;
        if (a)
            for (var s, l = 0, c = a.length; l < c; ++l)
                for (r = 0, s = a[l]; r < u; ++r)
                    if ((i = o[r]).type === s.type && i.name === s.name) return s.value
    },
    dispatch: function(t, n) {
        return this.each(("function" == typeof n ? Tt : $t)(t, n))
    },
    [Symbol.iterator]: function*() {
        for (var t = this._groups, n = 0, e = t.length; n < e; ++n)
            for (var r, i = t[n], o = 0, u = i.length; o < u; ++o)(r = i[o]) && (yield r)
    }
};
const Ot = {
        passive: !1
    },
    Yt = {
        capture: !0,
        passive: !1
    };

function Rt(t) {
    t.stopImmediatePropagation()
}

function Vt(t) {
    t.preventDefault(), t.stopImmediatePropagation()
}

function Dt(t) {
    var n = t.document.documentElement,
        e = qt(t).on("dragstart.drag", Vt, Yt);
    "onselectstart" in n ? e.on("selectstart.drag", Vt, Yt) : (n.__noselect = n.style.MozUserSelect, n.style.MozUserSelect = "none")
}

function It(t, n) {
    var e = t.document.documentElement,
        r = qt(t).on("dragstart.drag", null);
    n && (r.on("click.drag", Vt, Yt), setTimeout(function() {
        r.on("click.drag", null)
    }, 0)), "onselectstart" in e ? r.on("selectstart.drag", null) : (e.style.MozUserSelect = e.__noselect, delete e.__noselect)
}
const Bt = t => () => t;

function Ht(t, {
    sourceEvent: n,
    subject: e,
    target: r,
    identifier: i,
    active: o,
    x: u,
    y: a,
    dx: s,
    dy: l,
    dispatch: c
}) {
    Object.defineProperties(this, {
        type: {
            value: t,
            enumerable: !0,
            configurable: !0
        },
        sourceEvent: {
            value: n,
            enumerable: !0,
            configurable: !0
        },
        subject: {
            value: e,
            enumerable: !0,
            configurable: !0
        },
        target: {
            value: r,
            enumerable: !0,
            configurable: !0
        },
        identifier: {
            value: i,
            enumerable: !0,
            configurable: !0
        },
        active: {
            value: o,
            enumerable: !0,
            configurable: !0
        },
        x: {
            value: u,
            enumerable: !0,
            configurable: !0
        },
        y: {
            value: a,
            enumerable: !0,
            configurable: !0
        },
        dx: {
            value: s,
            enumerable: !0,
            configurable: !0
        },
        dy: {
            value: l,
            enumerable: !0,
            configurable: !0
        },
        _: {
            value: c
        }
    })
}

function Lt(t) {
    return !t.ctrlKey && !t.button
}

function Ut() {
    return this.parentNode
}

function Gt(t, n) {
    return null == n ? {
        x: t.x,
        y: t.y
    } : n
}

function Kt() {
    return navigator.maxTouchPoints || "ontouchstart" in this
}

function Ft() {
    var t, n, e, r, i = Lt,
        o = Ut,
        u = Gt,
        a = Kt,
        s = {},
        l = _("start", "drag", "end"),
        c = 0,
        h = 0;

    function f(t) {
        t.on("mousedown.drag", p).filter(a).on("touchstart.drag", m).on("touchmove.drag", y, Ot).on("touchend.drag touchcancel.drag", g).style("touch-action", "none").style("-webkit-tap-highlight-color", "rgba(0,0,0,0)")
    }

    function p(u, a) {
        if (!r && i.call(this, u, a)) {
            var s = w(this, o.call(this, u, a), u, a, "mouse");
            s && (qt(u.view).on("mousemove.drag", v, Yt).on("mouseup.drag", d, Yt), Dt(u.view), Rt(u), e = !1, t = u.clientX, n = u.clientY, s("start", u))
        }
    }

    function v(r) {
        if (Vt(r), !e) {
            var i = r.clientX - t,
                o = r.clientY - n;
            e = i * i + o * o > h
        }
        s.mouse("drag", r)
    }

    function d(t) {
        qt(t.view).on("mousemove.drag mouseup.drag", null), It(t.view, e), Vt(t), s.mouse("end", t)
    }

    function m(t, n) {
        if (i.call(this, t, n)) {
            var e, r, u = t.changedTouches,
                a = o.call(this, t, n),
                s = u.length;
            for (e = 0; e < s; ++e)(r = w(this, a, t, n, u[e].identifier, u[e])) && (Rt(t), r("start", t, u[e]))
        }
    }

    function y(t) {
        var n, e, r = t.changedTouches,
            i = r.length;
        for (n = 0; n < i; ++n)(e = s[r[n].identifier]) && (Vt(t), e("drag", t, r[n]))
    }

    function g(t) {
        var n, e, i = t.changedTouches,
            o = i.length;
        for (r && clearTimeout(r), r = setTimeout(function() {
                r = null
            }, 500), n = 0; n < o; ++n)(e = s[i[n].identifier]) && (Rt(t), e("end", t, i[n]))
    }

    function w(t, n, e, r, i, o) {
        var a, h, p, v = l.copy(),
            d = jt(o || e, n);
        if (null != (p = u.call(t, new Ht("beforestart", {
                sourceEvent: e,
                target: f,
                identifier: i,
                active: c,
                x: d[0],
                y: d[1],
                dx: 0,
                dy: 0,
                dispatch: v
            }), r))) return a = p.x - d[0] || 0, h = p.y - d[1] || 0,
            function e(o, u, l) {
                var m, y = d;
                switch (o) {
                    case "start":
                        s[i] = e, m = c++;
                        break;
                    case "end":
                        delete s[i], --c;
                    case "drag":
                        d = jt(l || u, n), m = c
                }
                v.call(o, t, new Ht(o, {
                    sourceEvent: u,
                    subject: p,
                    target: f,
                    identifier: i,
                    active: m,
                    x: d[0] + a,
                    y: d[1] + h,
                    dx: d[0] - y[0],
                    dy: d[1] - y[1],
                    dispatch: v
                }), r)
            }
    }
    return f.filter = function(t) {
        return arguments.length ? (i = "function" == typeof t ? t : Bt(!!t), f) : i
    }, f.container = function(t) {
        return arguments.length ? (o = "function" == typeof t ? t : Bt(t), f) : o
    }, f.subject = function(t) {
        return arguments.length ? (u = "function" == typeof t ? t : Bt(t), f) : u
    }, f.touchable = function(t) {
        return arguments.length ? (a = "function" == typeof t ? t : Bt(!!t), f) : a
    }, f.on = function() {
        var t = l.on.apply(l, arguments);
        return t === l ? f : t
    }, f.clickDistance = function(t) {
        return arguments.length ? (h = (t = +t) * t, f) : Math.sqrt(h)
    }, f
}

function Wt(t, n, e) {
    t.prototype = n.prototype = e, e.constructor = t
}

function Qt(t, n) {
    var e = Object.create(t.prototype);
    for (var r in n) e[r] = n[r];
    return e
}

function Jt() {}
Ht.prototype.on = function() {
    var t = this._.on.apply(this._, arguments);
    return t === this._ ? this : t
};
var Zt = .7,
    tn = 1 / Zt,
    nn = "\\s*([+-]?\\d+)\\s*",
    en = "\\s*([+-]?(?:\\d*\\.)?\\d+(?:[eE][+-]?\\d+)?)\\s*",
    rn = "\\s*([+-]?(?:\\d*\\.)?\\d+(?:[eE][+-]?\\d+)?)%\\s*",
    on = /^#([0-9a-f]{3,8})$/,
    un = new RegExp(`^rgb\\(${nn},${nn},${nn}\\)$`),
    an = new RegExp(`^rgb\\(${rn},${rn},${rn}\\)$`),
    sn = new RegExp(`^rgba\\(${nn},${nn},${nn},${en}\\)$`),
    ln = new RegExp(`^rgba\\(${rn},${rn},${rn},${en}\\)$`),
    cn = new RegExp(`^hsl\\(${en},${rn},${rn}\\)$`),
    hn = new RegExp(`^hsla\\(${en},${rn},${rn},${en}\\)$`),
    fn = {
        aliceblue: 15792383,
        antiquewhite: 16444375,
        aqua: 65535,
        aquamarine: 8388564,
        azure: 15794175,
        beige: 16119260,
        bisque: 16770244,
        black: 0,
        blanchedalmond: 16772045,
        blue: 255,
        blueviolet: 9055202,
        brown: 10824234,
        burlywood: 14596231,
        cadetblue: 6266528,
        chartreuse: 8388352,
        chocolate: 13789470,
        coral: 16744272,
        cornflowerblue: 6591981,
        cornsilk: 16775388,
        crimson: 14423100,
        cyan: 65535,
        darkblue: 139,
        darkcyan: 35723,
        darkgoldenrod: 12092939,
        darkgray: 11119017,
        darkgreen: 25600,
        darkgrey: 11119017,
        darkkhaki: 12433259,
        darkmagenta: 9109643,
        darkolivegreen: 5597999,
        darkorange: 16747520,
        darkorchid: 10040012,
        darkred: 9109504,
        darksalmon: 15308410,
        darkseagreen: 9419919,
        darkslateblue: 4734347,
        darkslategray: 3100495,
        darkslategrey: 3100495,
        darkturquoise: 52945,
        darkviolet: 9699539,
        deeppink: 16716947,
        deepskyblue: 49151,
        dimgray: 6908265,
        dimgrey: 6908265,
        dodgerblue: 2003199,
        firebrick: 11674146,
        floralwhite: 16775920,
        forestgreen: 2263842,
        fuchsia: 16711935,
        gainsboro: 14474460,
        ghostwhite: 16316671,
        gold: 16766720,
        goldenrod: 14329120,
        gray: 8421504,
        green: 32768,
        greenyellow: 11403055,
        grey: 8421504,
        honeydew: 15794160,
        hotpink: 16738740,
        indianred: 13458524,
        indigo: 4915330,
        ivory: 16777200,
        khaki: 15787660,
        lavender: 15132410,
        lavenderblush: 16773365,
        lawngreen: 8190976,
        lemonchiffon: 16775885,
        lightblue: 11393254,
        lightcoral: 15761536,
        lightcyan: 14745599,
        lightgoldenrodyellow: 16448210,
        lightgray: 13882323,
        lightgreen: 9498256,
        lightgrey: 13882323,
        lightpink: 16758465,
        lightsalmon: 16752762,
        lightseagreen: 2142890,
        lightskyblue: 8900346,
        lightslategray: 7833753,
        lightslategrey: 7833753,
        lightsteelblue: 11584734,
        lightyellow: 16777184,
        lime: 65280,
        limegreen: 3329330,
        linen: 16445670,
        magenta: 16711935,
        maroon: 8388608,
        mediumaquamarine: 6737322,
        mediumblue: 205,
        mediumorchid: 12211667,
        mediumpurple: 9662683,
        mediumseagreen: 3978097,
        mediumslateblue: 8087790,
        mediumspringgreen: 64154,
        mediumturquoise: 4772300,
        mediumvioletred: 13047173,
        midnightblue: 1644912,
        mintcream: 16121850,
        mistyrose: 16770273,
        moccasin: 16770229,
        navajowhite: 16768685,
        navy: 128,
        oldlace: 16643558,
        olive: 8421376,
        olivedrab: 7048739,
        orange: 16753920,
        orangered: 16729344,
        orchid: 14315734,
        palegoldenrod: 15657130,
        palegreen: 10025880,
        paleturquoise: 11529966,
        palevioletred: 14381203,
        papayawhip: 16773077,
        peachpuff: 16767673,
        peru: 13468991,
        pink: 16761035,
        plum: 14524637,
        powderblue: 11591910,
        purple: 8388736,
        rebeccapurple: 6697881,
        red: 16711680,
        rosybrown: 12357519,
        royalblue: 4286945,
        saddlebrown: 9127187,
        salmon: 16416882,
        sandybrown: 16032864,
        seagreen: 3050327,
        seashell: 16774638,
        sienna: 10506797,
        silver: 12632256,
        skyblue: 8900331,
        slateblue: 6970061,
        slategray: 7372944,
        slategrey: 7372944,
        snow: 16775930,
        springgreen: 65407,
        steelblue: 4620980,
        tan: 13808780,
        teal: 32896,
        thistle: 14204888,
        tomato: 16737095,
        turquoise: 4251856,
        violet: 15631086,
        wheat: 16113331,
        white: 16777215,
        whitesmoke: 16119285,
        yellow: 16776960,
        yellowgreen: 10145074
    };

function pn() {
    return this.rgb().formatHex()
}

function vn() {
    return this.rgb().formatRgb()
}

function dn(t) {
    var n, e;
    return t = (t + "").trim().toLowerCase(), (n = on.exec(t)) ? (e = n[1].length, n = parseInt(n[1], 16), 6 === e ? mn(n) : 3 === e ? new _n(n >> 8 & 15 | n >> 4 & 240, n >> 4 & 15 | 240 & n, (15 & n) << 4 | 15 & n, 1) : 8 === e ? yn(n >> 24 & 255, n >> 16 & 255, n >> 8 & 255, (255 & n) / 255) : 4 === e ? yn(n >> 12 & 15 | n >> 8 & 240, n >> 8 & 15 | n >> 4 & 240, n >> 4 & 15 | 240 & n, ((15 & n) << 4 | 15 & n) / 255) : null) : (n = un.exec(t)) ? new _n(n[1], n[2], n[3], 1) : (n = an.exec(t)) ? new _n(255 * n[1] / 100, 255 * n[2] / 100, 255 * n[3] / 100, 1) : (n = sn.exec(t)) ? yn(n[1], n[2], n[3], n[4]) : (n = ln.exec(t)) ? yn(255 * n[1] / 100, 255 * n[2] / 100, 255 * n[3] / 100, n[4]) : (n = cn.exec(t)) ? Mn(n[1], n[2] / 100, n[3] / 100, 1) : (n = hn.exec(t)) ? Mn(n[1], n[2] / 100, n[3] / 100, n[4]) : fn.hasOwnProperty(t) ? mn(fn[t]) : "transparent" === t ? new _n(NaN, NaN, NaN, 0) : null
}

function mn(t) {
    return new _n(t >> 16 & 255, t >> 8 & 255, 255 & t, 1)
}

function yn(t, n, e, r) {
    return r <= 0 && (t = n = e = NaN), new _n(t, n, e, r)
}

function gn(t, n, e, r) {
    return 1 === arguments.length ? ((i = t) instanceof Jt || (i = dn(i)), i ? new _n((i = i.rgb()).r, i.g, i.b, i.opacity) : new _n) : new _n(t, n, e, null == r ? 1 : r);
    var i
}

function _n(t, n, e, r) {
    this.r = +t, this.g = +n, this.b = +e, this.opacity = +r
}

function wn() {
    return `#${En(this.r)}${En(this.g)}${En(this.b)}`
}

function bn() {
    const t = xn(this.opacity);
    return `${1===t?"rgb(":"rgba("}${kn(this.r)}, ${kn(this.g)}, ${kn(this.b)}${1===t?")":`, ${t})`}`
}

function xn(t) {
    return isNaN(t) ? 1 : Math.max(0, Math.min(1, t))
}

function kn(t) {
    return Math.max(0, Math.min(255, Math.round(t) || 0))
}

function En(t) {
    return ((t = kn(t)) < 16 ? "0" : "") + t.toString(16)
}

function Mn(t, n, e, r) {
    return r <= 0 ? t = n = e = NaN : e <= 0 || e >= 1 ? t = n = NaN : n <= 0 && (t = NaN), new Sn(t, n, e, r)
}

function An(t) {
    if (t instanceof Sn) return new Sn(t.h, t.s, t.l, t.opacity);
    if (t instanceof Jt || (t = dn(t)), !t) return new Sn;
    if (t instanceof Sn) return t;
    var n = (t = t.rgb()).r / 255,
        e = t.g / 255,
        r = t.b / 255,
        i = Math.min(n, e, r),
        o = Math.max(n, e, r),
        u = NaN,
        a = o - i,
        s = (o + i) / 2;
    return a ? (u = n === o ? (e - r) / a + 6 * (e < r) : e === o ? (r - n) / a + 2 : (n - e) / a + 4, a /= s < .5 ? o + i : 2 - o - i, u *= 60) : a = s > 0 && s < 1 ? 0 : u, new Sn(u, a, s, t.opacity)
}

function Sn(t, n, e, r) {
    this.h = +t, this.s = +n, this.l = +e, this.opacity = +r
}

function Nn(t) {
    return (t = (t || 0) % 360) < 0 ? t + 360 : t
}

function zn(t) {
    return Math.max(0, Math.min(1, t || 0))
}

function $n(t, n, e) {
    return 255 * (t < 60 ? n + (e - n) * t / 60 : t < 180 ? e : t < 240 ? n + (e - n) * (240 - t) / 60 : n)
}
Wt(Jt, dn, {
    copy(t) {
        return Object.assign(new this.constructor, this, t)
    },
    displayable() {
        return this.rgb().displayable()
    },
    hex: pn,
    formatHex: pn,
    formatHex8: function() {
        return this.rgb().formatHex8()
    },
    formatHsl: function() {
        return An(this).formatHsl()
    },
    formatRgb: vn,
    toString: vn
}), Wt(_n, gn, Qt(Jt, {
    brighter(t) {
        return t = null == t ? tn : Math.pow(tn, t), new _n(this.r * t, this.g * t, this.b * t, this.opacity)
    },
    darker(t) {
        return t = null == t ? Zt : Math.pow(Zt, t), new _n(this.r * t, this.g * t, this.b * t, this.opacity)
    },
    rgb() {
        return this
    },
    clamp() {
        return new _n(kn(this.r), kn(this.g), kn(this.b), xn(this.opacity))
    },
    displayable() {
        return -.5 <= this.r && this.r < 255.5 && -.5 <= this.g && this.g < 255.5 && -.5 <= this.b && this.b < 255.5 && 0 <= this.opacity && this.opacity <= 1
    },
    hex: wn,
    formatHex: wn,
    formatHex8: function() {
        return `#${En(this.r)}${En(this.g)}${En(this.b)}${En(255*(isNaN(this.opacity)?1:this.opacity))}`
    },
    formatRgb: bn,
    toString: bn
})), Wt(Sn, function(t, n, e, r) {
    return 1 === arguments.length ? An(t) : new Sn(t, n, e, null == r ? 1 : r)
}, Qt(Jt, {
    brighter(t) {
        return t = null == t ? tn : Math.pow(tn, t), new Sn(this.h, this.s, this.l * t, this.opacity)
    },
    darker(t) {
        return t = null == t ? Zt : Math.pow(Zt, t), new Sn(this.h, this.s, this.l * t, this.opacity)
    },
    rgb() {
        var t = this.h % 360 + 360 * (this.h < 0),
            n = isNaN(t) || isNaN(this.s) ? 0 : this.s,
            e = this.l,
            r = e + (e < .5 ? e : 1 - e) * n,
            i = 2 * e - r;
        return new _n($n(t >= 240 ? t - 240 : t + 120, i, r), $n(t, i, r), $n(t < 120 ? t + 240 : t - 120, i, r), this.opacity)
    },
    clamp() {
        return new Sn(Nn(this.h), zn(this.s), zn(this.l), xn(this.opacity))
    },
    displayable() {
        return (0 <= this.s && this.s <= 1 || isNaN(this.s)) && 0 <= this.l && this.l <= 1 && 0 <= this.opacity && this.opacity <= 1
    },
    formatHsl() {
        const t = xn(this.opacity);
        return `${1===t?"hsl(":"hsla("}${Nn(this.h)}, ${100*zn(this.s)}%, ${100*zn(this.l)}%${1===t?")":`, ${t})`}`
    }
}));
const Tn = t => () => t;

function Pn(t) {
    return 1 === (t = +t) ? Xn : function(n, e) {
        return e - n ? function(t, n, e) {
            return t = Math.pow(t, e), n = Math.pow(n, e) - t, e = 1 / e,
                function(r) {
                    return Math.pow(t + r * n, e)
                }
        }(n, e, t) : Tn(isNaN(n) ? e : n)
    }
}

function Xn(t, n) {
    var e = n - t;
    return e ? function(t, n) {
        return function(e) {
            return t + e * n
        }
    }(t, e) : Tn(isNaN(t) ? n : t)
}
const Cn = function t(n) {
    var e = Pn(n);

    function r(t, n) {
        var r = e((t = gn(t)).r, (n = gn(n)).r),
            i = e(t.g, n.g),
            o = e(t.b, n.b),
            u = Xn(t.opacity, n.opacity);
        return function(n) {
            return t.r = r(n), t.g = i(n), t.b = o(n), t.opacity = u(n), t + ""
        }
    }
    return r.gamma = t, r
}(1);

function qn(t, n) {
    return t = +t, n = +n,
        function(e) {
            return t * (1 - e) + n * e
        }
}
var jn = /[-+]?(?:\d+\.?\d*|\.?\d+)(?:[eE][-+]?\d+)?/g,
    On = new RegExp(jn.source, "g");

function Yn(t, n) {
    var e, r, i, o = jn.lastIndex = On.lastIndex = 0,
        u = -1,
        a = [],
        s = [];
    for (t += "", n += "";
        (e = jn.exec(t)) && (r = On.exec(n));)(i = r.index) > o && (i = n.slice(o, i), a[u] ? a[u] += i : a[++u] = i), (e = e[0]) === (r = r[0]) ? a[u] ? a[u] += r : a[++u] = r : (a[++u] = null, s.push({
        i: u,
        x: qn(e, r)
    })), o = On.lastIndex;
    return o < n.length && (i = n.slice(o), a[u] ? a[u] += i : a[++u] = i), a.length < 2 ? s[0] ? function(t) {
        return function(n) {
            return t(n) + ""
        }
    }(s[0].x) : function(t) {
        return function() {
            return t
        }
    }(n) : (n = s.length, function(t) {
        for (var e, r = 0; r < n; ++r) a[(e = s[r]).i] = e.x(t);
        return a.join("")
    })
}
var Rn, Vn = 180 / Math.PI,
    Dn = {
        translateX: 0,
        translateY: 0,
        rotate: 0,
        skewX: 0,
        scaleX: 1,
        scaleY: 1
    };

function In(t, n, e, r, i, o) {
    var u, a, s;
    return (u = Math.sqrt(t * t + n * n)) && (t /= u, n /= u), (s = t * e + n * r) && (e -= t * s, r -= n * s), (a = Math.sqrt(e * e + r * r)) && (e /= a, r /= a, s /= a), t * r < n * e && (t = -t, n = -n, s = -s, u = -u), {
        translateX: i,
        translateY: o,
        rotate: Math.atan2(n, t) * Vn,
        skewX: Math.atan(s) * Vn,
        scaleX: u,
        scaleY: a
    }
}

function Bn(t, n, e, r) {
    function i(t) {
        return t.length ? t.pop() + " " : ""
    }
    return function(o, u) {
        var a = [],
            s = [];
        return o = t(o), u = t(u),
            function(t, r, i, o, u, a) {
                if (t !== i || r !== o) {
                    var s = u.push("translate(", null, n, null, e);
                    a.push({
                        i: s - 4,
                        x: qn(t, i)
                    }, {
                        i: s - 2,
                        x: qn(r, o)
                    })
                } else(i || o) && u.push("translate(" + i + n + o + e)
            }(o.translateX, o.translateY, u.translateX, u.translateY, a, s),
            function(t, n, e, o) {
                t !== n ? (t - n > 180 ? n += 360 : n - t > 180 && (t += 360), o.push({
                    i: e.push(i(e) + "rotate(", null, r) - 2,
                    x: qn(t, n)
                })) : n && e.push(i(e) + "rotate(" + n + r)
            }(o.rotate, u.rotate, a, s),
            function(t, n, e, o) {
                t !== n ? o.push({
                    i: e.push(i(e) + "skewX(", null, r) - 2,
                    x: qn(t, n)
                }) : n && e.push(i(e) + "skewX(" + n + r)
            }(o.skewX, u.skewX, a, s),
            function(t, n, e, r, o, u) {
                if (t !== e || n !== r) {
                    var a = o.push(i(o) + "scale(", null, ",", null, ")");
                    u.push({
                        i: a - 4,
                        x: qn(t, e)
                    }, {
                        i: a - 2,
                        x: qn(n, r)
                    })
                } else 1 === e && 1 === r || o.push(i(o) + "scale(" + e + "," + r + ")")
            }(o.scaleX, o.scaleY, u.scaleX, u.scaleY, a, s), o = u = null,
            function(t) {
                for (var n, e = -1, r = s.length; ++e < r;) a[(n = s[e]).i] = n.x(t);
                return a.join("")
            }
    }
}
var Hn = Bn(function(t) {
        const n = new("function" == typeof DOMMatrix ? DOMMatrix : WebKitCSSMatrix)(t + "");
        return n.isIdentity ? Dn : In(n.a, n.b, n.c, n.d, n.e, n.f)
    }, "px, ", "px)", "deg)"),
    Ln = Bn(function(t) {
        return null == t ? Dn : (Rn || (Rn = document.createElementNS("http://www.w3.org/2000/svg", "g")), Rn.setAttribute("transform", t), (t = Rn.transform.baseVal.consolidate()) ? In((t = t.matrix).a, t.b, t.c, t.d, t.e, t.f) : Dn)
    }, ", ", ")", ")");

function Un(t) {
    return ((t = Math.exp(t)) + 1 / t) / 2
}
const Gn = function t(n, e, r) {
    function i(t, i) {
        var o, u, a = t[0],
            s = t[1],
            l = t[2],
            c = i[0],
            h = i[1],
            f = i[2],
            p = c - a,
            v = h - s,
            d = p * p + v * v;
        if (d < 1e-12) u = Math.log(f / l) / n, o = function(t) {
            return [a + t * p, s + t * v, l * Math.exp(n * t * u)]
        };
        else {
            var m = Math.sqrt(d),
                y = (f * f - l * l + r * d) / (2 * l * e * m),
                g = (f * f - l * l - r * d) / (2 * f * e * m),
                _ = Math.log(Math.sqrt(y * y + 1) - y),
                w = Math.log(Math.sqrt(g * g + 1) - g);
            u = (w - _) / n, o = function(t) {
                var r, i = t * u,
                    o = Un(_),
                    c = l / (e * m) * (o * (r = n * i + _, ((r = Math.exp(2 * r)) - 1) / (r + 1)) - function(t) {
                        return ((t = Math.exp(t)) - 1 / t) / 2
                    }(_));
                return [a + c * p, s + c * v, l * o / Un(n * i + _)]
            }
        }
        return o.duration = 1e3 * u * n / Math.SQRT2, o
    }
    return i.rho = function(n) {
        var e = Math.max(.001, +n),
            r = e * e;
        return t(e, r, r * r)
    }, i
}(Math.SQRT2, 2, 4);
var Kn, Fn, Wn = 0,
    Qn = 0,
    Jn = 0,
    Zn = 0,
    te = 0,
    ne = 0,
    ee = "object" == typeof performance && performance.now ? performance : Date,
    re = "object" == typeof window && window.requestAnimationFrame ? window.requestAnimationFrame.bind(window) : function(t) {
        setTimeout(t, 17)
    };

function ie() {
    return te || (re(oe), te = ee.now() + ne)
}

function oe() {
    te = 0
}

function ue() {
    this._call = this._time = this._next = null
}

function ae(t, n, e) {
    var r = new ue;
    return r.restart(t, n, e), r
}

function se() {
    te = (Zn = ee.now()) + ne, Wn = Qn = 0;
    try {
        ! function() {
            ie(), ++Wn;
            for (var t, n = Kn; n;)(t = te - n._time) >= 0 && n._call.call(void 0, t), n = n._next;
            --Wn
        }()
    } finally {
        Wn = 0,
            function() {
                var t, n, e = Kn,
                    r = 1 / 0;
                for (; e;) e._call ? (r > e._time && (r = e._time), t = e, e = e._next) : (n = e._next, e._next = null, e = t ? t._next = n : Kn = n);
                Fn = t, ce(r)
            }(), te = 0
    }
}

function le() {
    var t = ee.now(),
        n = t - Zn;
    n > 1e3 && (ne -= n, Zn = t)
}

function ce(t) {
    Wn || (Qn && (Qn = clearTimeout(Qn)), t - te > 24 ? (t < 1 / 0 && (Qn = setTimeout(se, t - ee.now() - ne)), Jn && (Jn = clearInterval(Jn))) : (Jn || (Zn = ee.now(), Jn = setInterval(le, 1e3)), Wn = 1, re(se)))
}

function he(t, n, e) {
    var r = new ue;
    return n = null == n ? 0 : +n, r.restart(e => {
        r.stop(), t(e + n)
    }, n, e), r
}
ue.prototype = ae.prototype = {
    constructor: ue,
    restart: function(t, n, e) {
        if ("function" != typeof t) throw new TypeError("callback is not a function");
        e = (null == e ? ie() : +e) + (null == n ? 0 : +n), this._next || Fn === this || (Fn ? Fn._next = this : Kn = this, Fn = this), this._call = t, this._time = e, ce()
    },
    stop: function() {
        this._call && (this._call = null, this._time = 1 / 0, ce())
    }
};
var fe = _("start", "end", "cancel", "interrupt"),
    pe = [];

function ve(t, n, e, r, i, o) {
    var u = t.__transition;
    if (u) {
        if (e in u) return
    } else t.__transition = {};
    ! function(t, n, e) {
        var r, i = t.__transition;

        function o(t) {
            e.state = 1, e.timer.restart(u, e.delay, e.time), e.delay <= t && u(t - e.delay)
        }

        function u(o) {
            var l, c, h, f;
            if (1 !== e.state) return s();
            for (l in i)
                if ((f = i[l]).name === e.name) {
                    if (3 === f.state) return he(u);
                    4 === f.state ? (f.state = 6, f.timer.stop(), f.on.call("interrupt", t, t.__data__, f.index, f.group), delete i[l]) : +l < n && (f.state = 6, f.timer.stop(), f.on.call("cancel", t, t.__data__, f.index, f.group), delete i[l])
                } if (he(function() {
                    3 === e.state && (e.state = 4, e.timer.restart(a, e.delay, e.time), a(o))
                }), e.state = 2, e.on.call("start", t, t.__data__, e.index, e.group), 2 === e.state) {
                for (e.state = 3, r = new Array(h = e.tween.length), l = 0, c = -1; l < h; ++l)(f = e.tween[l].value.call(t, t.__data__, e.index, e.group)) && (r[++c] = f);
                r.length = c + 1
            }
        }

        function a(n) {
            for (var i = n < e.duration ? e.ease.call(null, n / e.duration) : (e.timer.restart(s), e.state = 5, 1), o = -1, u = r.length; ++o < u;) r[o].call(t, i);
            5 === e.state && (e.on.call("end", t, t.__data__, e.index, e.group), s())
        }

        function s() {
            for (var r in e.state = 6, e.timer.stop(), delete i[n], i) return;
            delete t.__transition
        }
        i[n] = e, e.timer = ae(o, 0, e.time)
    }(t, e, {
        name: n,
        index: r,
        group: i,
        on: fe,
        tween: pe,
        time: o.time,
        delay: o.delay,
        duration: o.duration,
        ease: o.ease,
        timer: null,
        state: 0
    })
}

function de(t, n) {
    var e = ye(t, n);
    if (e.state > 0) throw new Error("too late; already scheduled");
    return e
}

function me(t, n) {
    var e = ye(t, n);
    if (e.state > 3) throw new Error("too late; already running");
    return e
}

function ye(t, n) {
    var e = t.__transition;
    if (!e || !(e = e[n])) throw new Error("transition not found");
    return e
}

function ge(t, n) {
    var e, r, i, o = t.__transition,
        u = !0;
    if (o) {
        for (i in n = null == n ? null : n + "", o)(e = o[i]).name === n ? (r = e.state > 2 && e.state < 5, e.state = 6, e.timer.stop(), e.on.call(r ? "interrupt" : "cancel", t, t.__data__, e.index, e.group), delete o[i]) : u = !1;
        u && delete t.__transition
    }
}

function _e(t, n) {
    var e, r;
    return function() {
        var i = me(this, t),
            o = i.tween;
        if (o !== e)
            for (var u = 0, a = (r = e = o).length; u < a; ++u)
                if (r[u].name === n) {
                    (r = r.slice()).splice(u, 1);
                    break
                } i.tween = r
    }
}

function we(t, n, e) {
    var r, i;
    if ("function" != typeof e) throw new Error;
    return function() {
        var o = me(this, t),
            u = o.tween;
        if (u !== r) {
            i = (r = u).slice();
            for (var a = {
                    name: n,
                    value: e
                }, s = 0, l = i.length; s < l; ++s)
                if (i[s].name === n) {
                    i[s] = a;
                    break
                } s === l && i.push(a)
        }
        o.tween = i
    }
}

function be(t, n, e) {
    var r = t._id;
    return t.each(function() {
            var t = me(this, r);
            (t.value || (t.value = {}))[n] = e.apply(this, arguments)
        }),
        function(t) {
            return ye(t, r).value[n]
        }
}

function xe(t, n) {
    var e;
    return ("number" == typeof n ? qn : n instanceof dn ? Cn : (e = dn(n)) ? (n = e, Cn) : Yn)(t, n)
}

function ke(t) {
    return function() {
        this.removeAttribute(t)
    }
}

function Ee(t) {
    return function() {
        this.removeAttributeNS(t.space, t.local)
    }
}

function Me(t, n, e) {
    var r, i, o = e + "";
    return function() {
        var u = this.getAttribute(t);
        return u === o ? null : u === r ? i : i = n(r = u, e)
    }
}

function Ae(t, n, e) {
    var r, i, o = e + "";
    return function() {
        var u = this.getAttributeNS(t.space, t.local);
        return u === o ? null : u === r ? i : i = n(r = u, e)
    }
}

function Se(t, n, e) {
    var r, i, o;
    return function() {
        var u, a, s = e(this);
        if (null != s) return (u = this.getAttribute(t)) === (a = s + "") ? null : u === r && a === i ? o : (i = a, o = n(r = u, s));
        this.removeAttribute(t)
    }
}

function Ne(t, n, e) {
    var r, i, o;
    return function() {
        var u, a, s = e(this);
        if (null != s) return (u = this.getAttributeNS(t.space, t.local)) === (a = s + "") ? null : u === r && a === i ? o : (i = a, o = n(r = u, s));
        this.removeAttributeNS(t.space, t.local)
    }
}

function ze(t, n) {
    var e, r;

    function i() {
        var i = n.apply(this, arguments);
        return i !== r && (e = (r = i) && function(t, n) {
            return function(e) {
                this.setAttributeNS(t.space, t.local, n.call(this, e))
            }
        }(t, i)), e
    }
    return i._value = n, i
}

function $e(t, n) {
    var e, r;

    function i() {
        var i = n.apply(this, arguments);
        return i !== r && (e = (r = i) && function(t, n) {
            return function(e) {
                this.setAttribute(t, n.call(this, e))
            }
        }(t, i)), e
    }
    return i._value = n, i
}

function Te(t, n) {
    return function() {
        de(this, t).delay = +n.apply(this, arguments)
    }
}

function Pe(t, n) {
    return n = +n,
        function() {
            de(this, t).delay = n
        }
}

function Xe(t, n) {
    return function() {
        me(this, t).duration = +n.apply(this, arguments)
    }
}

function Ce(t, n) {
    return n = +n,
        function() {
            me(this, t).duration = n
        }
}
var qe = Ct.prototype.constructor;

function je(t) {
    return function() {
        this.style.removeProperty(t)
    }
}
var Oe = 0;

function Ye(t, n, e, r) {
    this._groups = t, this._parents = n, this._name = e, this._id = r
}

function Re() {
    return ++Oe
}
var Ve = Ct.prototype;
Ye.prototype = {
    constructor: Ye,
    select: function(t) {
        var n = this._name,
            e = this._id;
        "function" != typeof t && (t = $(t));
        for (var r = this._groups, i = r.length, o = new Array(i), u = 0; u < i; ++u)
            for (var a, s, l = r[u], c = l.length, h = o[u] = new Array(c), f = 0; f < c; ++f)(a = l[f]) && (s = t.call(a, a.__data__, f, l)) && ("__data__" in a && (s.__data__ = a.__data__), h[f] = s, ve(h[f], n, e, f, h, ye(a, e)));
        return new Ye(o, this._parents, n, e)
    },
    selectAll: function(t) {
        var n = this._name,
            e = this._id;
        "function" != typeof t && (t = P(t));
        for (var r = this._groups, i = r.length, o = [], u = [], a = 0; a < i; ++a)
            for (var s, l = r[a], c = l.length, h = 0; h < c; ++h)
                if (s = l[h]) {
                    for (var f, p = t.call(s, s.__data__, h, l), v = ye(s, e), d = 0, m = p.length; d < m; ++d)(f = p[d]) && ve(f, n, e, d, p, v);
                    o.push(p), u.push(s)
                } return new Ye(o, u, n, e)
    },
    selectChild: Ve.selectChild,
    selectChildren: Ve.selectChildren,
    filter: function(t) {
        "function" != typeof t && (t = C(t));
        for (var n = this._groups, e = n.length, r = new Array(e), i = 0; i < e; ++i)
            for (var o, u = n[i], a = u.length, s = r[i] = [], l = 0; l < a; ++l)(o = u[l]) && t.call(o, o.__data__, l, u) && s.push(o);
        return new Ye(r, this._parents, this._name, this._id)
    },
    merge: function(t) {
        if (t._id !== this._id) throw new Error;
        for (var n = this._groups, e = t._groups, r = n.length, i = e.length, o = Math.min(r, i), u = new Array(r), a = 0; a < o; ++a)
            for (var s, l = n[a], c = e[a], h = l.length, f = u[a] = new Array(h), p = 0; p < h; ++p)(s = l[p] || c[p]) && (f[p] = s);
        for (; a < r; ++a) u[a] = n[a];
        return new Ye(u, this._parents, this._name, this._id)
    },
    selection: function() {
        return new qe(this._groups, this._parents)
    },
    transition: function() {
        for (var t = this._name, n = this._id, e = Re(), r = this._groups, i = r.length, o = 0; o < i; ++o)
            for (var u, a = r[o], s = a.length, l = 0; l < s; ++l)
                if (u = a[l]) {
                    var c = ye(u, n);
                    ve(u, t, e, l, a, {
                        time: c.time + c.delay + c.duration,
                        delay: 0,
                        duration: c.duration,
                        ease: c.ease
                    })
                } return new Ye(r, this._parents, t, e)
    },
    call: Ve.call,
    nodes: Ve.nodes,
    node: Ve.node,
    size: Ve.size,
    empty: Ve.empty,
    each: Ve.each,
    on: function(t, n) {
        var e = this._id;
        return arguments.length < 2 ? ye(this.node(), e).on.on(t) : this.each(function(t, n, e) {
            var r, i, o = function(t) {
                return (t + "").trim().split(/^|\s+/).every(function(t) {
                    var n = t.indexOf(".");
                    return n >= 0 && (t = t.slice(0, n)), !t || "start" === t
                })
            }(n) ? de : me;
            return function() {
                var u = o(this, t),
                    a = u.on;
                a !== r && (i = (r = a).copy()).on(n, e), u.on = i
            }
        }(e, t, n))
    },
    attr: function(t, n) {
        var e = M(t),
            r = "transform" === e ? Ln : xe;
        return this.attrTween(t, "function" == typeof n ? (e.local ? Ne : Se)(e, r, be(this, "attr." + t, n)) : null == n ? (e.local ? Ee : ke)(e) : (e.local ? Ae : Me)(e, r, n))
    },
    attrTween: function(t, n) {
        var e = "attr." + t;
        if (arguments.length < 2) return (e = this.tween(e)) && e._value;
        if (null == n) return this.tween(e, null);
        if ("function" != typeof n) throw new Error;
        var r = M(t);
        return this.tween(e, (r.local ? ze : $e)(r, n))
    },
    style: function(t, n, e) {
        var r = "transform" == (t += "") ? Hn : xe;
        return null == n ? this.styleTween(t, function(t, n) {
            var e, r, i;
            return function() {
                var o = rt(this, t),
                    u = (this.style.removeProperty(t), rt(this, t));
                return o === u ? null : o === e && u === r ? i : i = n(e = o, r = u)
            }
        }(t, r)).on("end.style." + t, je(t)) : "function" == typeof n ? this.styleTween(t, function(t, n, e) {
            var r, i, o;
            return function() {
                var u = rt(this, t),
                    a = e(this),
                    s = a + "";
                return null == a && (this.style.removeProperty(t), s = a = rt(this, t)), u === s ? null : u === r && s === i ? o : (i = s, o = n(r = u, a))
            }
        }(t, r, be(this, "style." + t, n))).each(function(t, n) {
            var e, r, i, o, u = "style." + n,
                a = "end." + u;
            return function() {
                var s = me(this, t),
                    l = s.on,
                    c = null == s.value[u] ? o || (o = je(n)) : void 0;
                l === e && i === c || (r = (e = l).copy()).on(a, i = c), s.on = r
            }
        }(this._id, t)) : this.styleTween(t, function(t, n, e) {
            var r, i, o = e + "";
            return function() {
                var u = rt(this, t);
                return u === o ? null : u === r ? i : i = n(r = u, e)
            }
        }(t, r, n), e).on("end.style." + t, null)
    },
    styleTween: function(t, n, e) {
        var r = "style." + (t += "");
        if (arguments.length < 2) return (r = this.tween(r)) && r._value;
        if (null == n) return this.tween(r, null);
        if ("function" != typeof n) throw new Error;
        return this.tween(r, function(t, n, e) {
            var r, i;

            function o() {
                var o = n.apply(this, arguments);
                return o !== i && (r = (i = o) && function(t, n, e) {
                    return function(r) {
                        this.style.setProperty(t, n.call(this, r), e)
                    }
                }(t, o, e)), r
            }
            return o._value = n, o
        }(t, n, null == e ? "" : e))
    },
    text: function(t) {
        return this.tween("text", "function" == typeof t ? function(t) {
            return function() {
                var n = t(this);
                this.textContent = null == n ? "" : n
            }
        }(be(this, "text", t)) : function(t) {
            return function() {
                this.textContent = t
            }
        }(null == t ? "" : t + ""))
    },
    textTween: function(t) {
        var n = "text";
        if (arguments.length < 1) return (n = this.tween(n)) && n._value;
        if (null == t) return this.tween(n, null);
        if ("function" != typeof t) throw new Error;
        return this.tween(n, function(t) {
            var n, e;

            function r() {
                var r = t.apply(this, arguments);
                return r !== e && (n = (e = r) && function(t) {
                    return function(n) {
                        this.textContent = t.call(this, n)
                    }
                }(r)), n
            }
            return r._value = t, r
        }(t))
    },
    remove: function() {
        return this.on("end.remove", (t = this._id, function() {
            var n = this.parentNode;
            for (var e in this.__transition)
                if (+e !== t) return;
            n && n.removeChild(this)
        }));
        var t
    },
    tween: function(t, n) {
        var e = this._id;
        if (t += "", arguments.length < 2) {
            for (var r, i = ye(this.node(), e).tween, o = 0, u = i.length; o < u; ++o)
                if ((r = i[o]).name === t) return r.value;
            return null
        }
        return this.each((null == n ? _e : we)(e, t, n))
    },
    delay: function(t) {
        var n = this._id;
        return arguments.length ? this.each(("function" == typeof t ? Te : Pe)(n, t)) : ye(this.node(), n).delay
    },
    duration: function(t) {
        var n = this._id;
        return arguments.length ? this.each(("function" == typeof t ? Xe : Ce)(n, t)) : ye(this.node(), n).duration
    },
    ease: function(t) {
        var n = this._id;
        return arguments.length ? this.each(function(t, n) {
            if ("function" != typeof n) throw new Error;
            return function() {
                me(this, t).ease = n
            }
        }(n, t)) : ye(this.node(), n).ease
    },
    easeVarying: function(t) {
        if ("function" != typeof t) throw new Error;
        return this.each(function(t, n) {
            return function() {
                var e = n.apply(this, arguments);
                if ("function" != typeof e) throw new Error;
                me(this, t).ease = e
            }
        }(this._id, t))
    },
    end: function() {
        var t, n, e = this,
            r = e._id,
            i = e.size();
        return new Promise(function(o, u) {
            var a = {
                    value: u
                },
                s = {
                    value: function() {
                        0 === --i && o()
                    }
                };
            e.each(function() {
                var e = me(this, r),
                    i = e.on;
                i !== t && ((n = (t = i).copy())._.cancel.push(a), n._.interrupt.push(a), n._.end.push(s)), e.on = n
            }), 0 === i && o()
        })
    },
    [Symbol.iterator]: Ve[Symbol.iterator]
};
var De = {
    time: null,
    delay: 0,
    duration: 250,
    ease: function(t) {
        return ((t *= 2) <= 1 ? t * t * t : (t -= 2) * t * t + 2) / 2
    }
};

function Ie(t, n) {
    for (var e; !(e = t.__transition) || !(e = e[n]);)
        if (!(t = t.parentNode)) throw new Error(`transition ${n} not found`);
    return e
}
Ct.prototype.interrupt = function(t) {
    return this.each(function() {
        ge(this, t)
    })
}, Ct.prototype.transition = function(t) {
    var n, e;
    t instanceof Ye ? (n = t._id, t = t._name) : (n = Re(), (e = De).time = ie(), t = null == t ? null : t + "");
    for (var r = this._groups, i = r.length, o = 0; o < i; ++o)
        for (var u, a = r[o], s = a.length, l = 0; l < s; ++l)(u = a[l]) && ve(u, t, n, l, a, e || Ie(u, n));
    return new Ye(r, this._parents, t, n)
};
const Be = t => () => t;

function He(t, {
    sourceEvent: n,
    target: e,
    transform: r,
    dispatch: i
}) {
    Object.defineProperties(this, {
        type: {
            value: t,
            enumerable: !0,
            configurable: !0
        },
        sourceEvent: {
            value: n,
            enumerable: !0,
            configurable: !0
        },
        target: {
            value: e,
            enumerable: !0,
            configurable: !0
        },
        transform: {
            value: r,
            enumerable: !0,
            configurable: !0
        },
        _: {
            value: i
        }
    })
}

function Le(t, n, e) {
    this.k = t, this.x = n, this.y = e
}
Le.prototype = {
    constructor: Le,
    scale: function(t) {
        return 1 === t ? this : new Le(this.k * t, this.x, this.y)
    },
    translate: function(t, n) {
        return 0 === t & 0 === n ? this : new Le(this.k, this.x + this.k * t, this.y + this.k * n)
    },
    apply: function(t) {
        return [t[0] * this.k + this.x, t[1] * this.k + this.y]
    },
    applyX: function(t) {
        return t * this.k + this.x
    },
    applyY: function(t) {
        return t * this.k + this.y
    },
    invert: function(t) {
        return [(t[0] - this.x) / this.k, (t[1] - this.y) / this.k]
    },
    invertX: function(t) {
        return (t - this.x) / this.k
    },
    invertY: function(t) {
        return (t - this.y) / this.k
    },
    rescaleX: function(t) {
        return t.copy().domain(t.range().map(this.invertX, this).map(t.invert, t))
    },
    rescaleY: function(t) {
        return t.copy().domain(t.range().map(this.invertY, this).map(t.invert, t))
    },
    toString: function() {
        return "translate(" + this.x + "," + this.y + ") scale(" + this.k + ")"
    }
};
var Ue = new Le(1, 0, 0);

function Ge(t) {
    t.stopImmediatePropagation()
}

function Ke(t) {
    t.preventDefault(), t.stopImmediatePropagation()
}

function Fe(t) {
    return !(t.ctrlKey && "wheel" !== t.type || t.button)
}

function We() {
    var t = this;
    return t instanceof SVGElement ? (t = t.ownerSVGElement || t).hasAttribute("viewBox") ? [
        [(t = t.viewBox.baseVal).x, t.y],
        [t.x + t.width, t.y + t.height]
    ] : [
        [0, 0],
        [t.width.baseVal.value, t.height.baseVal.value]
    ] : [
        [0, 0],
        [t.clientWidth, t.clientHeight]
    ]
}

function Qe() {
    return this.__zoom || Ue
}

function Je(t) {
    return -t.deltaY * (1 === t.deltaMode ? .05 : t.deltaMode ? 1 : .002) * (t.ctrlKey ? 10 : 1)
}

function Ze() {
    return navigator.maxTouchPoints || "ontouchstart" in this
}

function tr(t, n, e) {
    var r = t.invertX(n[0][0]) - e[0][0],
        i = t.invertX(n[1][0]) - e[1][0],
        o = t.invertY(n[0][1]) - e[0][1],
        u = t.invertY(n[1][1]) - e[1][1];
    return t.translate(i > r ? (r + i) / 2 : Math.min(0, r) || Math.max(0, i), u > o ? (o + u) / 2 : Math.min(0, o) || Math.max(0, u))
}

function nr() {
    var t, n, e, r = Fe,
        i = We,
        o = tr,
        u = Je,
        a = Ze,
        s = [0, 1 / 0],
        l = [
            [-1 / 0, -1 / 0],
            [1 / 0, 1 / 0]
        ],
        c = 250,
        h = Gn,
        f = _("start", "zoom", "end"),
        p = 0,
        v = 10;

    function d(t) {
        t.property("__zoom", Qe).on("wheel.zoom", k, {
            passive: !1
        }).on("mousedown.zoom", E).on("dblclick.zoom", M).filter(a).on("touchstart.zoom", A).on("touchmove.zoom", S).on("touchend.zoom touchcancel.zoom", N).style("-webkit-tap-highlight-color", "rgba(0,0,0,0)")
    }

    function m(t, n) {
        return (n = Math.max(s[0], Math.min(s[1], n))) === t.k ? t : new Le(n, t.x, t.y)
    }

    function y(t, n, e) {
        var r = n[0] - e[0] * t.k,
            i = n[1] - e[1] * t.k;
        return r === t.x && i === t.y ? t : new Le(t.k, r, i)
    }

    function g(t) {
        return [(+t[0][0] + +t[1][0]) / 2, (+t[0][1] + +t[1][1]) / 2]
    }

    function w(t, n, e, r) {
        t.on("start.zoom", function() {
            b(this, arguments).event(r).start()
        }).on("interrupt.zoom end.zoom", function() {
            b(this, arguments).event(r).end()
        }).tween("zoom", function() {
            var t = this,
                o = arguments,
                u = b(t, o).event(r),
                a = i.apply(t, o),
                s = null == e ? g(a) : "function" == typeof e ? e.apply(t, o) : e,
                l = Math.max(a[1][0] - a[0][0], a[1][1] - a[0][1]),
                c = t.__zoom,
                f = "function" == typeof n ? n.apply(t, o) : n,
                p = h(c.invert(s).concat(l / c.k), f.invert(s).concat(l / f.k));
            return function(t) {
                if (1 === t) t = f;
                else {
                    var n = p(t),
                        e = l / n[2];
                    t = new Le(e, s[0] - n[0] * e, s[1] - n[1] * e)
                }
                u.zoom(null, t)
            }
        })
    }

    function b(t, n, e) {
        return !e && t.__zooming || new x(t, n)
    }

    function x(t, n) {
        this.that = t, this.args = n, this.active = 0, this.sourceEvent = null, this.extent = i.apply(t, n), this.taps = 0
    }

    function k(t, ...n) {
        if (r.apply(this, arguments)) {
            var e = b(this, n).event(t),
                i = this.__zoom,
                a = Math.max(s[0], Math.min(s[1], i.k * Math.pow(2, u.apply(this, arguments)))),
                c = jt(t);
            if (e.wheel) e.mouse[0][0] === c[0] && e.mouse[0][1] === c[1] || (e.mouse[1] = i.invert(e.mouse[0] = c)), clearTimeout(e.wheel);
            else {
                if (i.k === a) return;
                e.mouse = [c, i.invert(c)], ge(this), e.start()
            }
            Ke(t), e.wheel = setTimeout(function() {
                e.wheel = null, e.end()
            }, 150), e.zoom("mouse", o(y(m(i, a), e.mouse[0], e.mouse[1]), e.extent, l))
        }
    }

    function E(t, ...n) {
        if (!e && r.apply(this, arguments)) {
            var i = t.currentTarget,
                u = b(this, n, !0).event(t),
                a = qt(t.view).on("mousemove.zoom", function(t) {
                    if (Ke(t), !u.moved) {
                        var n = t.clientX - c,
                            e = t.clientY - h;
                        u.moved = n * n + e * e > p
                    }
                    u.event(t).zoom("mouse", o(y(u.that.__zoom, u.mouse[0] = jt(t, i), u.mouse[1]), u.extent, l))
                }, !0).on("mouseup.zoom", function(t) {
                    a.on("mousemove.zoom mouseup.zoom", null), It(t.view, u.moved), Ke(t), u.event(t).end()
                }, !0),
                s = jt(t, i),
                c = t.clientX,
                h = t.clientY;
            Dt(t.view), Ge(t), u.mouse = [s, this.__zoom.invert(s)], ge(this), u.start()
        }
    }

    function M(t, ...n) {
        if (r.apply(this, arguments)) {
            var e = this.__zoom,
                u = jt(t.changedTouches ? t.changedTouches[0] : t, this),
                a = e.invert(u),
                s = e.k * (t.shiftKey ? .5 : 2),
                h = o(y(m(e, s), u, a), i.apply(this, n), l);
            Ke(t), c > 0 ? qt(this).transition().duration(c).call(w, h, u, t) : qt(this).call(d.transform, h, u, t)
        }
    }

    function A(e, ...i) {
        if (r.apply(this, arguments)) {
            var o, u, a, s, l = e.touches,
                c = l.length,
                h = b(this, i, e.changedTouches.length === c).event(e);
            for (Ge(e), u = 0; u < c; ++u) s = [s = jt(a = l[u], this), this.__zoom.invert(s), a.identifier], h.touch0 ? h.touch1 || h.touch0[2] === s[2] || (h.touch1 = s, h.taps = 0) : (h.touch0 = s, o = !0, h.taps = 1 + !!t);
            t && (t = clearTimeout(t)), o && (h.taps < 2 && (n = s[0], t = setTimeout(function() {
                t = null
            }, 500)), ge(this), h.start())
        }
    }

    function S(t, ...n) {
        if (this.__zooming) {
            var e, r, i, u, a = b(this, n).event(t),
                s = t.changedTouches,
                c = s.length;
            for (Ke(t), e = 0; e < c; ++e) i = jt(r = s[e], this), a.touch0 && a.touch0[2] === r.identifier ? a.touch0[0] = i : a.touch1 && a.touch1[2] === r.identifier && (a.touch1[0] = i);
            if (r = a.that.__zoom, a.touch1) {
                var h = a.touch0[0],
                    f = a.touch0[1],
                    p = a.touch1[0],
                    v = a.touch1[1],
                    d = (d = p[0] - h[0]) * d + (d = p[1] - h[1]) * d,
                    g = (g = v[0] - f[0]) * g + (g = v[1] - f[1]) * g;
                r = m(r, Math.sqrt(d / g)), i = [(h[0] + p[0]) / 2, (h[1] + p[1]) / 2], u = [(f[0] + v[0]) / 2, (f[1] + v[1]) / 2]
            } else {
                if (!a.touch0) return;
                i = a.touch0[0], u = a.touch0[1]
            }
            a.zoom("touch", o(y(r, i, u), a.extent, l))
        }
    }

    function N(t, ...r) {
        if (this.__zooming) {
            var i, o, u = b(this, r).event(t),
                a = t.changedTouches,
                s = a.length;
            for (Ge(t), e && clearTimeout(e), e = setTimeout(function() {
                    e = null
                }, 500), i = 0; i < s; ++i) o = a[i], u.touch0 && u.touch0[2] === o.identifier ? delete u.touch0 : u.touch1 && u.touch1[2] === o.identifier && delete u.touch1;
            if (u.touch1 && !u.touch0 && (u.touch0 = u.touch1, delete u.touch1), u.touch0) u.touch0[1] = this.__zoom.invert(u.touch0[0]);
            else if (u.end(), 2 === u.taps && (o = jt(o, this), Math.hypot(n[0] - o[0], n[1] - o[1]) < v)) {
                var l = qt(this).on("dblclick.zoom");
                l && l.apply(this, arguments)
            }
        }
    }
    return d.transform = function(t, n, e, r) {
        var i = t.selection ? t.selection() : t;
        i.property("__zoom", Qe), t !== i ? w(t, n, e, r) : i.interrupt().each(function() {
            b(this, arguments).event(r).start().zoom(null, "function" == typeof n ? n.apply(this, arguments) : n).end()
        })
    }, d.scaleBy = function(t, n, e, r) {
        d.scaleTo(t, function() {
            return this.__zoom.k * ("function" == typeof n ? n.apply(this, arguments) : n)
        }, e, r)
    }, d.scaleTo = function(t, n, e, r) {
        d.transform(t, function() {
            var t = i.apply(this, arguments),
                r = this.__zoom,
                u = null == e ? g(t) : "function" == typeof e ? e.apply(this, arguments) : e,
                a = r.invert(u),
                s = "function" == typeof n ? n.apply(this, arguments) : n;
            return o(y(m(r, s), u, a), t, l)
        }, e, r)
    }, d.translateBy = function(t, n, e, r) {
        d.transform(t, function() {
            return o(this.__zoom.translate("function" == typeof n ? n.apply(this, arguments) : n, "function" == typeof e ? e.apply(this, arguments) : e), i.apply(this, arguments), l)
        }, null, r)
    }, d.translateTo = function(t, n, e, r, u) {
        d.transform(t, function() {
            var t = i.apply(this, arguments),
                u = this.__zoom,
                a = null == r ? g(t) : "function" == typeof r ? r.apply(this, arguments) : r;
            return o(Ue.translate(a[0], a[1]).scale(u.k).translate("function" == typeof n ? -n.apply(this, arguments) : -n, "function" == typeof e ? -e.apply(this, arguments) : -e), t, l)
        }, r, u)
    }, x.prototype = {
        event: function(t) {
            return t && (this.sourceEvent = t), this
        },
        start: function() {
            return 1 === ++this.active && (this.that.__zooming = this, this.emit("start")), this
        },
        zoom: function(t, n) {
            return this.mouse && "mouse" !== t && (this.mouse[1] = n.invert(this.mouse[0])), this.touch0 && "touch" !== t && (this.touch0[1] = n.invert(this.touch0[0])), this.touch1 && "touch" !== t && (this.touch1[1] = n.invert(this.touch1[0])), this.that.__zoom = n, this.emit("zoom"), this
        },
        end: function() {
            return 0 === --this.active && (delete this.that.__zooming, this.emit("end")), this
        },
        emit: function(t) {
            var n = qt(this.that).datum();
            f.call(t, this.that, new He(t, {
                sourceEvent: this.sourceEvent,
                target: d,
                transform: this.that.__zoom,
                dispatch: f
            }), n)
        }
    }, d.wheelDelta = function(t) {
        return arguments.length ? (u = "function" == typeof t ? t : Be(+t), d) : u
    }, d.filter = function(t) {
        return arguments.length ? (r = "function" == typeof t ? t : Be(!!t), d) : r
    }, d.touchable = function(t) {
        return arguments.length ? (a = "function" == typeof t ? t : Be(!!t), d) : a
    }, d.extent = function(t) {
        return arguments.length ? (i = "function" == typeof t ? t : Be([
            [+t[0][0], +t[0][1]],
            [+t[1][0], +t[1][1]]
        ]), d) : i
    }, d.scaleExtent = function(t) {
        return arguments.length ? (s[0] = +t[0], s[1] = +t[1], d) : [s[0], s[1]]
    }, d.translateExtent = function(t) {
        return arguments.length ? (l[0][0] = +t[0][0], l[1][0] = +t[1][0], l[0][1] = +t[0][1], l[1][1] = +t[1][1], d) : [
            [l[0][0], l[0][1]],
            [l[1][0], l[1][1]]
        ]
    }, d.constrain = function(t) {
        return arguments.length ? (o = t, d) : o
    }, d.duration = function(t) {
        return arguments.length ? (c = +t, d) : c
    }, d.interpolate = function(t) {
        return arguments.length ? (h = t, d) : h
    }, d.on = function() {
        var t = f.on.apply(f, arguments);
        return t === f ? d : t
    }, d.clickDistance = function(t) {
        return arguments.length ? (p = (t = +t) * t, d) : Math.sqrt(p)
    }, d.tapDistance = function(t) {
        return arguments.length ? (v = +t, d) : v
    }, d
}
Le.prototype;
export {
    a as c, Ft as d, Ue as i, u as j, jt as p, qt as s, y as u, nr as z
};