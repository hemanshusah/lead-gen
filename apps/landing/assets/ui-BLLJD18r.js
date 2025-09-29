import {
    a as t
} from "./vendor-BkLVKQpg.js";
import {
    j as e
} from "./reactflow-DsiBQpfB.js";
/**
 * @license lucide-react v0.517.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */
const n = t => {
        const e = (t => t.replace(/^([A-Z])|[\s-_]+(\w)/g, (t, e, n) => n ? n.toUpperCase() : e.toLowerCase()))(t);
        return e.charAt(0).toUpperCase() + e.slice(1)
    },
    i = (...t) => t.filter((t, e, n) => Boolean(t) && "" !== t.trim() && n.indexOf(t) === e).join(" ").trim(),
    s = t => {
        for (const e in t)
            if (e.startsWith("aria-") || "role" === e || "title" === e) return !0
    };
/**
 * @license lucide-react v0.517.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */
var o = {
    xmlns: "http://www.w3.org/2000/svg",
    width: 24,
    height: 24,
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    strokeWidth: 2,
    strokeLinecap: "round",
    strokeLinejoin: "round"
};
/**
 * @license lucide-react v0.517.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */
const r = t.forwardRef(({
        color: e = "currentColor",
        size: n = 24,
        strokeWidth: r = 2,
        absoluteStrokeWidth: a,
        className: l = "",
        children: h,
        iconNode: u,
        ...c
    }, d) => t.createElement("svg", {
        ref: d,
        ...o,
        width: n,
        height: n,
        stroke: e,
        strokeWidth: a ? 24 * Number(r) / Number(n) : r,
        className: i("lucide", l),
        ...!h && !s(c) && {
            "aria-hidden": "true"
        },
        ...c
    }, [...u.map(([e, n]) => t.createElement(e, n)), ...Array.isArray(h) ? h : [h]])),
    a = (e, s) => {
        const o = t.forwardRef(({
            className: o,
            ...a
        }, l) => {
            return t.createElement(r, {
                ref: l,
                iconNode: s,
                className: i(`lucide-${h=n(e),h.replace(/([a-z0-9])([A-Z])/g,"$1-$2").toLowerCase()}`, `lucide-${e}`, o),
                ...a
            });
            var h
        });
        return o.displayName = n(e), o
    },
    l = a("activity", [
        ["path", {
            d: "M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2",
            key: "169zse"
        }]
    ]),
    h = a("apple", [
        ["path", {
            d: "M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z",
            key: "3s7exb"
        }],
        ["path", {
            d: "M10 2c1 .5 2 2 2 5",
            key: "fcco2y"
        }]
    ]),
    u = a("arrow-left", [
        ["path", {
            d: "m12 19-7-7 7-7",
            key: "1l729n"
        }],
        ["path", {
            d: "M19 12H5",
            key: "x3x0zl"
        }]
    ]),
    c = a("arrow-right", [
        ["path", {
            d: "M5 12h14",
            key: "1ays0h"
        }],
        ["path", {
            d: "m12 5 7 7-7 7",
            key: "xquz4c"
        }]
    ]),
    d = a("calendar", [
        ["path", {
            d: "M8 2v4",
            key: "1cmpym"
        }],
        ["path", {
            d: "M16 2v4",
            key: "4m81vk"
        }],
        ["rect", {
            width: "18",
            height: "18",
            x: "3",
            y: "4",
            rx: "2",
            key: "1hopcy"
        }],
        ["path", {
            d: "M3 10h18",
            key: "8toen8"
        }]
    ]),
    p = a("chart-column", [
        ["path", {
            d: "M3 3v16a2 2 0 0 0 2 2h16",
            key: "c24i48"
        }],
        ["path", {
            d: "M18 17V9",
            key: "2bz60n"
        }],
        ["path", {
            d: "M13 17V5",
            key: "1frdt8"
        }],
        ["path", {
            d: "M8 17v-3",
            key: "17ska0"
        }]
    ]),
    m = a("check", [
        ["path", {
            d: "M20 6 9 17l-5-5",
            key: "1gmf2c"
        }]
    ]),
    f = a("chevron-down", [
        ["path", {
            d: "m6 9 6 6 6-6",
            key: "qrunsl"
        }]
    ]),
    y = a("chevron-left", [
        ["path", {
            d: "m15 18-6-6 6-6",
            key: "1wnfg3"
        }]
    ]),
    g = a("chevron-right", [
        ["path", {
            d: "m9 18 6-6-6-6",
            key: "mthhwq"
        }]
    ]),
    v = a("chevron-up", [
        ["path", {
            d: "m18 15-6-6-6 6",
            key: "153udz"
        }]
    ]),
    x = a("circle-alert", [
        ["circle", {
            cx: "12",
            cy: "12",
            r: "10",
            key: "1mglay"
        }],
        ["line", {
            x1: "12",
            x2: "12",
            y1: "8",
            y2: "12",
            key: "1pkeuh"
        }],
        ["line", {
            x1: "12",
            x2: "12.01",
            y1: "16",
            y2: "16",
            key: "4dfq90"
        }]
    ]),
    k = a("circle-check-big", [
        ["path", {
            d: "M21.801 10A10 10 0 1 1 17 3.335",
            key: "yps3ct"
        }],
        ["path", {
            d: "m9 11 3 3L22 4",
            key: "1pflzl"
        }]
    ]),
    w = a("circle-x", [
        ["circle", {
            cx: "12",
            cy: "12",
            r: "10",
            key: "1mglay"
        }],
        ["path", {
            d: "m15 9-6 6",
            key: "1uzhvr"
        }],
        ["path", {
            d: "m9 9 6 6",
            key: "z0biqf"
        }]
    ]),
    M = a("clock", [
        ["circle", {
            cx: "12",
            cy: "12",
            r: "10",
            key: "1mglay"
        }],
        ["polyline", {
            points: "12 6 12 12 16 14",
            key: "68esgv"
        }]
    ]),
    T = a("cloud", [
        ["path", {
            d: "M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z",
            key: "p7xjir"
        }]
    ]),
    b = a("code", [
        ["path", {
            d: "m16 18 6-6-6-6",
            key: "eg8j8"
        }],
        ["path", {
            d: "m8 6-6 6 6 6",
            key: "ppft3o"
        }]
    ]),
    P = a("copy", [
        ["rect", {
            width: "14",
            height: "14",
            x: "8",
            y: "8",
            rx: "2",
            ry: "2",
            key: "17jyea"
        }],
        ["path", {
            d: "M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2",
            key: "zix9uf"
        }]
    ]),
    S = a("database", [
        ["ellipse", {
            cx: "12",
            cy: "5",
            rx: "9",
            ry: "3",
            key: "msslwz"
        }],
        ["path", {
            d: "M3 5V19A9 3 0 0 0 21 19V5",
            key: "1wlel7"
        }],
        ["path", {
            d: "M3 12A9 3 0 0 0 21 12",
            key: "mv7ke4"
        }]
    ]),
    A = a("download", [
        ["path", {
            d: "M12 15V3",
            key: "m9g1x1"
        }],
        ["path", {
            d: "M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4",
            key: "ih7n3h"
        }],
        ["path", {
            d: "m7 10 5 5 5-5",
            key: "brsn70"
        }]
    ]),
    V = a("external-link", [
        ["path", {
            d: "M15 3h6v6",
            key: "1q9fwt"
        }],
        ["path", {
            d: "M10 14 21 3",
            key: "gplh6r"
        }],
        ["path", {
            d: "M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6",
            key: "a6xqqp"
        }]
    ]),
    E = a("eye-off", [
        ["path", {
            d: "M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49",
            key: "ct8e1f"
        }],
        ["path", {
            d: "M14.084 14.158a3 3 0 0 1-4.242-4.242",
            key: "151rxh"
        }],
        ["path", {
            d: "M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143",
            key: "13bj9a"
        }],
        ["path", {
            d: "m2 2 20 20",
            key: "1ooewy"
        }]
    ]),
    C = a("eye", [
        ["path", {
            d: "M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0",
            key: "1nclc0"
        }],
        ["circle", {
            cx: "12",
            cy: "12",
            r: "3",
            key: "1v7zrd"
        }]
    ]),
    D = a("file-image", [
        ["path", {
            d: "M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z",
            key: "1rqfz7"
        }],
        ["path", {
            d: "M14 2v4a2 2 0 0 0 2 2h4",
            key: "tnqrlb"
        }],
        ["circle", {
            cx: "10",
            cy: "12",
            r: "2",
            key: "737tya"
        }],
        ["path", {
            d: "m20 17-1.296-1.296a2.41 2.41 0 0 0-3.408 0L9 22",
            key: "wt3hpn"
        }]
    ]),
    j = a("file-text", [
        ["path", {
            d: "M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z",
            key: "1rqfz7"
        }],
        ["path", {
            d: "M14 2v4a2 2 0 0 0 2 2h4",
            key: "tnqrlb"
        }],
        ["path", {
            d: "M10 9H8",
            key: "b1mrlr"
        }],
        ["path", {
            d: "M16 13H8",
            key: "t4e002"
        }],
        ["path", {
            d: "M16 17H8",
            key: "z1uh3a"
        }]
    ]),
    R = a("folder", [
        ["path", {
            d: "M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z",
            key: "1kt360"
        }]
    ]),
    L = a("gamepad-2", [
        ["line", {
            x1: "6",
            x2: "10",
            y1: "11",
            y2: "11",
            key: "1gktln"
        }],
        ["line", {
            x1: "8",
            x2: "8",
            y1: "9",
            y2: "13",
            key: "qnk9ow"
        }],
        ["line", {
            x1: "15",
            x2: "15.01",
            y1: "12",
            y2: "12",
            key: "krot7o"
        }],
        ["line", {
            x1: "18",
            x2: "18.01",
            y1: "10",
            y2: "10",
            key: "1lcuu1"
        }],
        ["path", {
            d: "M17.32 5H6.68a4 4 0 0 0-3.978 3.59c-.006.052-.01.101-.017.152C2.604 9.416 2 14.456 2 16a3 3 0 0 0 3 3c1 0 1.5-.5 2-1l1.414-1.414A2 2 0 0 1 9.828 16h4.344a2 2 0 0 1 1.414.586L17 18c.5.5 1 1 2 1a3 3 0 0 0 3-3c0-1.545-.604-6.584-.685-7.258-.007-.05-.011-.1-.017-.151A4 4 0 0 0 17.32 5z",
            key: "mfqc10"
        }]
    ]),
    B = a("gift", [
        ["rect", {
            x: "3",
            y: "8",
            width: "18",
            height: "4",
            rx: "1",
            key: "bkv52"
        }],
        ["path", {
            d: "M12 8v13",
            key: "1c76mn"
        }],
        ["path", {
            d: "M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7",
            key: "6wjy6b"
        }],
        ["path", {
            d: "M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5",
            key: "1ihvrl"
        }]
    ]),
    F = a("github", [
        ["path", {
            d: "M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4",
            key: "tonef"
        }],
        ["path", {
            d: "M9 18c-4.51 2-5-2-7-2",
            key: "9comsn"
        }]
    ]),
    O = a("globe", [
        ["circle", {
            cx: "12",
            cy: "12",
            r: "10",
            key: "1mglay"
        }],
        ["path", {
            d: "M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20",
            key: "13o1zl"
        }],
        ["path", {
            d: "M2 12h20",
            key: "9i4pu4"
        }]
    ]),
    I = a("house", [
        ["path", {
            d: "M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8",
            key: "5wwlr5"
        }],
        ["path", {
            d: "M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z",
            key: "1d0kgt"
        }]
    ]),
    z = a("image", [
        ["rect", {
            width: "18",
            height: "18",
            x: "3",
            y: "3",
            rx: "2",
            ry: "2",
            key: "1m3agn"
        }],
        ["circle", {
            cx: "9",
            cy: "9",
            r: "2",
            key: "af1f0g"
        }],
        ["path", {
            d: "m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21",
            key: "1xmnt7"
        }]
    ]),
    U = a("info", [
        ["circle", {
            cx: "12",
            cy: "12",
            r: "10",
            key: "1mglay"
        }],
        ["path", {
            d: "M12 16v-4",
            key: "1dtifu"
        }],
        ["path", {
            d: "M12 8h.01",
            key: "e9boi3"
        }]
    ]),
    N = a("layers", [
        ["path", {
            d: "M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z",
            key: "zw3jo"
        }],
        ["path", {
            d: "M2 12a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 12",
            key: "1wduqc"
        }],
        ["path", {
            d: "M2 17a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 17",
            key: "kqbvx6"
        }]
    ]),
    H = a("lightbulb", [
        ["path", {
            d: "M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5",
            key: "1gvzjb"
        }],
        ["path", {
            d: "M9 18h6",
            key: "x1upvd"
        }],
        ["path", {
            d: "M10 22h4",
            key: "ceow96"
        }]
    ]),
    W = a("link", [
        ["path", {
            d: "M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71",
            key: "1cjeqo"
        }],
        ["path", {
            d: "M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71",
            key: "19qd67"
        }]
    ]),
    $ = a("linkedin", [
        ["path", {
            d: "M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z",
            key: "c2jq9f"
        }],
        ["rect", {
            width: "4",
            height: "12",
            x: "2",
            y: "9",
            key: "mk3on5"
        }],
        ["circle", {
            cx: "4",
            cy: "4",
            r: "2",
            key: "bt5ra8"
        }]
    ]),
    q = a("loader-circle", [
        ["path", {
            d: "M21 12a9 9 0 1 1-6.219-8.56",
            key: "13zald"
        }]
    ]),
    X = a("loader", [
        ["path", {
            d: "M12 2v4",
            key: "3427ic"
        }],
        ["path", {
            d: "m16.2 7.8 2.9-2.9",
            key: "r700ao"
        }],
        ["path", {
            d: "M18 12h4",
            key: "wj9ykh"
        }],
        ["path", {
            d: "m16.2 16.2 2.9 2.9",
            key: "1bxg5t"
        }],
        ["path", {
            d: "M12 18v4",
            key: "jadmvz"
        }],
        ["path", {
            d: "m4.9 19.1 2.9-2.9",
            key: "bwix9q"
        }],
        ["path", {
            d: "M2 12h4",
            key: "j09sii"
        }],
        ["path", {
            d: "m4.9 4.9 2.9 2.9",
            key: "giyufr"
        }]
    ]),
    Y = a("lock", [
        ["rect", {
            width: "18",
            height: "11",
            x: "3",
            y: "11",
            rx: "2",
            ry: "2",
            key: "1w4ew1"
        }],
        ["path", {
            d: "M7 11V7a5 5 0 0 1 10 0v4",
            key: "fwvmzm"
        }]
    ]),
    K = a("log-out", [
        ["path", {
            d: "m16 17 5-5-5-5",
            key: "1bji2h"
        }],
        ["path", {
            d: "M21 12H9",
            key: "dn1m92"
        }],
        ["path", {
            d: "M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4",
            key: "1uf3rs"
        }]
    ]),
    Z = a("mail", [
        ["path", {
            d: "m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7",
            key: "132q7q"
        }],
        ["rect", {
            x: "2",
            y: "4",
            width: "20",
            height: "16",
            rx: "2",
            key: "izxlao"
        }]
    ]),
    G = a("maximize-2", [
        ["path", {
            d: "M15 3h6v6",
            key: "1q9fwt"
        }],
        ["path", {
            d: "m21 3-7 7",
            key: "1l2asr"
        }],
        ["path", {
            d: "m3 21 7-7",
            key: "tjx5ai"
        }],
        ["path", {
            d: "M9 21H3v-6",
            key: "wtvkvv"
        }]
    ]),
    _ = a("message-circle", [
        ["path", {
            d: "M7.9 20A9 9 0 1 0 4 16.1L2 22Z",
            key: "vv11sd"
        }]
    ]),
    J = a("message-square", [
        ["path", {
            d: "M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z",
            key: "1lielz"
        }]
    ]),
    Q = a("minimize-2", [
        ["path", {
            d: "m14 10 7-7",
            key: "oa77jy"
        }],
        ["path", {
            d: "M20 10h-6V4",
            key: "mjg0md"
        }],
        ["path", {
            d: "m3 21 7-7",
            key: "tjx5ai"
        }],
        ["path", {
            d: "M4 14h6v6",
            key: "rmj7iw"
        }]
    ]),
    tt = a("mouse-pointer", [
        ["path", {
            d: "M12.586 12.586 19 19",
            key: "ea5xo7"
        }],
        ["path", {
            d: "M3.688 3.037a.497.497 0 0 0-.651.651l6.5 15.999a.501.501 0 0 0 .947-.062l1.569-6.083a2 2 0 0 1 1.448-1.479l6.124-1.579a.5.5 0 0 0 .063-.947z",
            key: "277e5u"
        }]
    ]),
    et = a("pause", [
        ["rect", {
            x: "14",
            y: "4",
            width: "4",
            height: "16",
            rx: "1",
            key: "zuxfzm"
        }],
        ["rect", {
            x: "6",
            y: "4",
            width: "4",
            height: "16",
            rx: "1",
            key: "1okwgv"
        }]
    ]),
    nt = a("pen-line", [
        ["path", {
            d: "M12 20h9",
            key: "t2du7b"
        }],
        ["path", {
            d: "M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z",
            key: "1ykcvy"
        }]
    ]),
    it = a("pen", [
        ["path", {
            d: "M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z",
            key: "1a8usu"
        }]
    ]),
    st = a("pencil", [
        ["path", {
            d: "M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z",
            key: "1a8usu"
        }],
        ["path", {
            d: "m15 5 4 4",
            key: "1mk7zo"
        }]
    ]),
    ot = a("play", [
        ["polygon", {
            points: "6 3 20 12 6 21 6 3",
            key: "1oa8hb"
        }]
    ]),
    rt = a("plus", [
        ["path", {
            d: "M5 12h14",
            key: "1ays0h"
        }],
        ["path", {
            d: "M12 5v14",
            key: "s699le"
        }]
    ]),
    at = a("qr-code", [
        ["rect", {
            width: "5",
            height: "5",
            x: "3",
            y: "3",
            rx: "1",
            key: "1tu5fj"
        }],
        ["rect", {
            width: "5",
            height: "5",
            x: "16",
            y: "3",
            rx: "1",
            key: "1v8r4q"
        }],
        ["rect", {
            width: "5",
            height: "5",
            x: "3",
            y: "16",
            rx: "1",
            key: "1x03jg"
        }],
        ["path", {
            d: "M21 16h-3a2 2 0 0 0-2 2v3",
            key: "177gqh"
        }],
        ["path", {
            d: "M21 21v.01",
            key: "ents32"
        }],
        ["path", {
            d: "M12 7v3a2 2 0 0 1-2 2H7",
            key: "8crl2c"
        }],
        ["path", {
            d: "M3 12h.01",
            key: "nlz23k"
        }],
        ["path", {
            d: "M12 3h.01",
            key: "n36tog"
        }],
        ["path", {
            d: "M12 16v.01",
            key: "133mhm"
        }],
        ["path", {
            d: "M16 12h1",
            key: "1slzba"
        }],
        ["path", {
            d: "M21 12v.01",
            key: "1lwtk9"
        }],
        ["path", {
            d: "M12 21v-1",
            key: "1880an"
        }]
    ]),
    lt = a("refresh-cw", [
        ["path", {
            d: "M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8",
            key: "v9h5vc"
        }],
        ["path", {
            d: "M21 3v5h-5",
            key: "1q7to0"
        }],
        ["path", {
            d: "M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16",
            key: "3uifl3"
        }],
        ["path", {
            d: "M8 16H3v5",
            key: "1cv678"
        }]
    ]),
    ht = a("rotate-ccw", [
        ["path", {
            d: "M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8",
            key: "1357e3"
        }],
        ["path", {
            d: "M3 3v5h5",
            key: "1xhq8a"
        }]
    ]),
    ut = a("save", [
        ["path", {
            d: "M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z",
            key: "1c8476"
        }],
        ["path", {
            d: "M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7",
            key: "1ydtos"
        }],
        ["path", {
            d: "M7 3v4a1 1 0 0 0 1 1h7",
            key: "t51u73"
        }]
    ]),
    ct = a("search", [
        ["path", {
            d: "m21 21-4.34-4.34",
            key: "14j7rj"
        }],
        ["circle", {
            cx: "11",
            cy: "11",
            r: "8",
            key: "4ej97u"
        }]
    ]),
    dt = a("send", [
        ["path", {
            d: "M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z",
            key: "1ffxy3"
        }],
        ["path", {
            d: "m21.854 2.147-10.94 10.939",
            key: "12cjpa"
        }]
    ]),
    pt = a("settings", [
        ["path", {
            d: "M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z",
            key: "1qme2f"
        }],
        ["circle", {
            cx: "12",
            cy: "12",
            r: "3",
            key: "1v7zrd"
        }]
    ]),
    mt = a("shield", [
        ["path", {
            d: "M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z",
            key: "oel41y"
        }]
    ]),
    ft = a("smartphone", [
        ["rect", {
            width: "14",
            height: "20",
            x: "5",
            y: "2",
            rx: "2",
            ry: "2",
            key: "1yt0o3"
        }],
        ["path", {
            d: "M12 18h.01",
            key: "mhygvu"
        }]
    ]),
    yt = a("sparkles", [
        ["path", {
            d: "M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z",
            key: "4pj2yx"
        }],
        ["path", {
            d: "M20 3v4",
            key: "1olli1"
        }],
        ["path", {
            d: "M22 5h-4",
            key: "1gvqau"
        }],
        ["path", {
            d: "M4 17v2",
            key: "vumght"
        }],
        ["path", {
            d: "M5 18H3",
            key: "zchphs"
        }]
    ]),
    gt = a("sticky-note", [
        ["path", {
            d: "M16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8Z",
            key: "qazsjp"
        }],
        ["path", {
            d: "M15 3v4a2 2 0 0 0 2 2h4",
            key: "40519r"
        }]
    ]),
    vt = a("trash-2", [
        ["path", {
            d: "M3 6h18",
            key: "d0wm0j"
        }],
        ["path", {
            d: "M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6",
            key: "4alrt4"
        }],
        ["path", {
            d: "M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2",
            key: "v07s0e"
        }],
        ["line", {
            x1: "10",
            x2: "10",
            y1: "11",
            y2: "17",
            key: "1uufr5"
        }],
        ["line", {
            x1: "14",
            x2: "14",
            y1: "11",
            y2: "17",
            key: "xtxkd"
        }]
    ]),
    xt = a("triangle-alert", [
        ["path", {
            d: "m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3",
            key: "wmoenq"
        }],
        ["path", {
            d: "M12 9v4",
            key: "juzpu7"
        }],
        ["path", {
            d: "M12 17h.01",
            key: "p32p05"
        }]
    ]),
    kt = a("twitter", [
        ["path", {
            d: "M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z",
            key: "pff0z6"
        }]
    ]),
    wt = a("upload", [
        ["path", {
            d: "M12 3v12",
            key: "1x0j5s"
        }],
        ["path", {
            d: "m17 8-5-5-5 5",
            key: "7q97r8"
        }],
        ["path", {
            d: "M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4",
            key: "ih7n3h"
        }]
    ]),
    Mt = a("user", [
        ["path", {
            d: "M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2",
            key: "975kel"
        }],
        ["circle", {
            cx: "12",
            cy: "7",
            r: "4",
            key: "17ys0d"
        }]
    ]),
    Tt = a("users", [
        ["path", {
            d: "M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2",
            key: "1yyitq"
        }],
        ["path", {
            d: "M16 3.128a4 4 0 0 1 0 7.744",
            key: "16gr8j"
        }],
        ["path", {
            d: "M22 21v-2a4 4 0 0 0-3-3.87",
            key: "kshegd"
        }],
        ["circle", {
            cx: "9",
            cy: "7",
            r: "4",
            key: "nufk8"
        }]
    ]),
    bt = a("wand-sparkles", [
        ["path", {
            d: "m21.64 3.64-1.28-1.28a1.21 1.21 0 0 0-1.72 0L2.36 18.64a1.21 1.21 0 0 0 0 1.72l1.28 1.28a1.2 1.2 0 0 0 1.72 0L21.64 5.36a1.2 1.2 0 0 0 0-1.72",
            key: "ul74o6"
        }],
        ["path", {
            d: "m14 7 3 3",
            key: "1r5n42"
        }],
        ["path", {
            d: "M5 6v4",
            key: "ilb8ba"
        }],
        ["path", {
            d: "M19 14v4",
            key: "blhpug"
        }],
        ["path", {
            d: "M10 2v2",
            key: "7u0qdc"
        }],
        ["path", {
            d: "M7 8H3",
            key: "zfb6yr"
        }],
        ["path", {
            d: "M21 16h-4",
            key: "1cnmox"
        }],
        ["path", {
            d: "M11 3H9",
            key: "1obp7u"
        }]
    ]),
    Pt = a("wifi-off", [
        ["path", {
            d: "M12 20h.01",
            key: "zekei9"
        }],
        ["path", {
            d: "M8.5 16.429a5 5 0 0 1 7 0",
            key: "1bycff"
        }],
        ["path", {
            d: "M5 12.859a10 10 0 0 1 5.17-2.69",
            key: "1dl1wf"
        }],
        ["path", {
            d: "M19 12.859a10 10 0 0 0-2.007-1.523",
            key: "4k23kn"
        }],
        ["path", {
            d: "M2 8.82a15 15 0 0 1 4.177-2.643",
            key: "1grhjp"
        }],
        ["path", {
            d: "M22 8.82a15 15 0 0 0-11.288-3.764",
            key: "z3jwby"
        }],
        ["path", {
            d: "m2 2 20 20",
            key: "1ooewy"
        }]
    ]),
    St = a("wifi", [
        ["path", {
            d: "M12 20h.01",
            key: "zekei9"
        }],
        ["path", {
            d: "M2 8.82a15 15 0 0 1 20 0",
            key: "dnpr2z"
        }],
        ["path", {
            d: "M5 12.859a10 10 0 0 1 14 0",
            key: "1x1e6c"
        }],
        ["path", {
            d: "M8.5 16.429a5 5 0 0 1 7 0",
            key: "1bycff"
        }]
    ]),
    At = a("wrench", [
        ["path", {
            d: "M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z",
            key: "cbrjhi"
        }]
    ]),
    Vt = a("x", [
        ["path", {
            d: "M18 6 6 18",
            key: "1bl5f8"
        }],
        ["path", {
            d: "m6 6 12 12",
            key: "d8bk6v"
        }]
    ]),
    Et = a("zap", [
        ["path", {
            d: "M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z",
            key: "1xq2db"
        }]
    ]),
    Ct = a("zoom-in", [
        ["circle", {
            cx: "11",
            cy: "11",
            r: "8",
            key: "4ej97u"
        }],
        ["line", {
            x1: "21",
            x2: "16.65",
            y1: "21",
            y2: "16.65",
            key: "13gj7c"
        }],
        ["line", {
            x1: "11",
            x2: "11",
            y1: "8",
            y2: "14",
            key: "1vmskp"
        }],
        ["line", {
            x1: "8",
            x2: "14",
            y1: "11",
            y2: "11",
            key: "durymu"
        }]
    ]),
    Dt = a("zoom-out", [
        ["circle", {
            cx: "11",
            cy: "11",
            r: "8",
            key: "4ej97u"
        }],
        ["line", {
            x1: "21",
            x2: "16.65",
            y1: "21",
            y2: "16.65",
            key: "13gj7c"
        }],
        ["line", {
            x1: "8",
            x2: "14",
            y1: "11",
            y2: "11",
            key: "durymu"
        }]
    ]),
    jt = t.createContext({});
/**
 * @license lucide-react v0.517.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */
function Rt(e) {
    const n = t.useRef(null);
    return null === n.current && (n.current = e()), n.current
}
const Lt = "undefined" != typeof window,
    Bt = Lt ? t.useLayoutEffect : t.useEffect,
    Ft = t.createContext(null);

function Ot(t, e) {
    -1 === t.indexOf(e) && t.push(e)
}

function It(t, e) {
    const n = t.indexOf(e);
    n > -1 && t.splice(n, 1)
}
const zt = (t, e, n) => n > e ? e : n < t ? t : n;
const Ut = {},
    Nt = t => /^-?(?:\d+(?:\.\d+)?|\.\d+)$/u.test(t);

function Ht(t) {
    return "object" == typeof t && null !== t
}
const Wt = t => /^0[^.\s]+$/u.test(t);

function $t(t) {
    let e;
    return () => (void 0 === e && (e = t()), e)
}
const qt = t => t,
    Xt = (t, e) => n => e(t(n)),
    Yt = (...t) => t.reduce(Xt),
    Kt = (t, e, n) => {
        const i = e - t;
        return 0 === i ? 1 : (n - t) / i
    };
class Zt {
    constructor() {
        this.subscriptions = []
    }
    add(t) {
        return Ot(this.subscriptions, t), () => It(this.subscriptions, t)
    }
    notify(t, e, n) {
        const i = this.subscriptions.length;
        if (i)
            if (1 === i) this.subscriptions[0](t, e, n);
            else
                for (let s = 0; s < i; s++) {
                    const i = this.subscriptions[s];
                    i && i(t, e, n)
                }
    }
    getSize() {
        return this.subscriptions.length
    }
    clear() {
        this.subscriptions.length = 0
    }
}
const Gt = t => 1e3 * t,
    _t = t => t / 1e3;

function Jt(t, e) {
    return e ? t * (1e3 / e) : 0
}
const Qt = (t, e, n) => (((1 - 3 * n + 3 * e) * t + (3 * n - 6 * e)) * t + 3 * e) * t;

function te(t, e, n, i) {
    if (t === e && n === i) return qt;
    const s = e => function(t, e, n, i, s) {
        let o, r, a = 0;
        do {
            r = e + (n - e) / 2, o = Qt(r, i, s) - t, o > 0 ? n = r : e = r
        } while (Math.abs(o) > 1e-7 && ++a < 12);
        return r
    }(e, 0, 1, t, n);
    return t => 0 === t || 1 === t ? t : Qt(s(t), e, i)
}
const ee = t => e => e <= .5 ? t(2 * e) / 2 : (2 - t(2 * (1 - e))) / 2,
    ne = t => e => 1 - t(1 - e),
    ie = te(.33, 1.53, .69, .99),
    se = ne(ie),
    oe = ee(se),
    re = t => (t *= 2) < 1 ? .5 * se(t) : .5 * (2 - Math.pow(2, -10 * (t - 1))),
    ae = t => 1 - Math.sin(Math.acos(t)),
    le = ne(ae),
    he = ee(ae),
    ue = te(.42, 0, 1, 1),
    ce = te(0, 0, .58, 1),
    de = te(.42, 0, .58, 1),
    pe = t => Array.isArray(t) && "number" == typeof t[0],
    me = {
        linear: qt,
        easeIn: ue,
        easeInOut: de,
        easeOut: ce,
        circIn: ae,
        circInOut: he,
        circOut: le,
        backIn: se,
        backInOut: oe,
        backOut: ie,
        anticipate: re
    },
    fe = t => {
        if (pe(t)) {
            t.length;
            const [e, n, i, s] = t;
            return te(e, n, i, s)
        }
        return "string" == typeof t ? me[t] : t
    },
    ye = ["setup", "read", "resolveKeyframes", "preUpdate", "update", "preRender", "render", "postRender"],
    ge = {
        value: null
    };

function ve(t, e) {
    let n = !1,
        i = !0;
    const s = {
            delta: 0,
            timestamp: 0,
            isProcessing: !1
        },
        o = () => n = !0,
        r = ye.reduce((t, n) => (t[n] = function(t, e) {
            let n = new Set,
                i = new Set,
                s = !1,
                o = !1;
            const r = new WeakSet;
            let a = {
                    delta: 0,
                    timestamp: 0,
                    isProcessing: !1
                },
                l = 0;

            function h(e) {
                r.has(e) && (u.schedule(e), t()), l++, e(a)
            }
            const u = {
                schedule: (t, e = !1, o = !1) => {
                    const a = o && s ? n : i;
                    return e && r.add(t), a.has(t) || a.add(t), t
                },
                cancel: t => {
                    i.delete(t), r.delete(t)
                },
                process: t => {
                    a = t, s ? o = !0 : (s = !0, [n, i] = [i, n], n.forEach(h), e && ge.value && ge.value.frameloop[e].push(l), l = 0, n.clear(), s = !1, o && (o = !1, u.process(t)))
                }
            };
            return u
        }(o, e ? n : void 0), t), {}),
        {
            setup: a,
            read: l,
            resolveKeyframes: h,
            preUpdate: u,
            update: c,
            preRender: d,
            render: p,
            postRender: m
        } = r,
        f = () => {
            const o = Ut.useManualTiming ? s.timestamp : performance.now();
            n = !1, Ut.useManualTiming || (s.delta = i ? 1e3 / 60 : Math.max(Math.min(o - s.timestamp, 40), 1)), s.timestamp = o, s.isProcessing = !0, a.process(s), l.process(s), h.process(s), u.process(s), c.process(s), d.process(s), p.process(s), m.process(s), s.isProcessing = !1, n && e && (i = !1, t(f))
        };
    return {
        schedule: ye.reduce((e, o) => {
            const a = r[o];
            return e[o] = (e, o = !1, r = !1) => (n || (n = !0, i = !0, s.isProcessing || t(f)), a.schedule(e, o, r)), e
        }, {}),
        cancel: t => {
            for (let e = 0; e < ye.length; e++) r[ye[e]].cancel(t)
        },
        state: s,
        steps: r
    }
}
const {
    schedule: xe,
    cancel: ke,
    state: we,
    steps: Me
} = ve("undefined" != typeof requestAnimationFrame ? requestAnimationFrame : qt, !0);
let Te;

function be() {
    Te = void 0
}
const Pe = {
        now: () => (void 0 === Te && Pe.set(we.isProcessing || Ut.useManualTiming ? we.timestamp : performance.now()), Te),
        set: t => {
            Te = t, queueMicrotask(be)
        }
    },
    Se = t => e => "string" == typeof e && e.startsWith(t),
    Ae = Se("--"),
    Ve = Se("var(--"),
    Ee = t => !!Ve(t) && Ce.test(t.split("/*")[0].trim()),
    Ce = /var\(--(?:[\w-]+\s*|[\w-]+\s*,(?:\s*[^)(\s]|\s*\((?:[^)(]|\([^)(]*\))*\))+\s*)\)$/iu,
    De = {
        test: t => "number" == typeof t,
        parse: parseFloat,
        transform: t => t
    },
    je = {
        ...De,
        transform: t => zt(0, 1, t)
    },
    Re = {
        ...De,
        default: 1
    },
    Le = t => Math.round(1e5 * t) / 1e5,
    Be = /-?(?:\d+(?:\.\d+)?|\.\d+)/gu;
const Fe = /^(?:#[\da-f]{3,8}|(?:rgb|hsl)a?\((?:-?[\d.]+%?[,\s]+){2}-?[\d.]+%?\s*(?:[,/]\s*)?(?:\b\d+(?:\.\d+)?|\.\d+)?%?\))$/iu,
    Oe = (t, e) => n => Boolean("string" == typeof n && Fe.test(n) && n.startsWith(t) || e && ! function(t) {
        return null == t
    }(n) && Object.prototype.hasOwnProperty.call(n, e)),
    Ie = (t, e, n) => i => {
        if ("string" != typeof i) return i;
        const [s, o, r, a] = i.match(Be);
        return {
            [t]: parseFloat(s),
            [e]: parseFloat(o),
            [n]: parseFloat(r),
            alpha: void 0 !== a ? parseFloat(a) : 1
        }
    },
    ze = {
        ...De,
        transform: t => Math.round((t => zt(0, 255, t))(t))
    },
    Ue = {
        test: Oe("rgb", "red"),
        parse: Ie("red", "green", "blue"),
        transform: ({
            red: t,
            green: e,
            blue: n,
            alpha: i = 1
        }) => "rgba(" + ze.transform(t) + ", " + ze.transform(e) + ", " + ze.transform(n) + ", " + Le(je.transform(i)) + ")"
    };
const Ne = {
        test: Oe("#"),
        parse: function(t) {
            let e = "",
                n = "",
                i = "",
                s = "";
            return t.length > 5 ? (e = t.substring(1, 3), n = t.substring(3, 5), i = t.substring(5, 7), s = t.substring(7, 9)) : (e = t.substring(1, 2), n = t.substring(2, 3), i = t.substring(3, 4), s = t.substring(4, 5), e += e, n += n, i += i, s += s), {
                red: parseInt(e, 16),
                green: parseInt(n, 16),
                blue: parseInt(i, 16),
                alpha: s ? parseInt(s, 16) / 255 : 1
            }
        },
        transform: Ue.transform
    },
    He = t => ({
        test: e => "string" == typeof e && e.endsWith(t) && 1 === e.split(" ").length,
        parse: parseFloat,
        transform: e => `${e}${t}`
    }),
    We = He("deg"),
    $e = He("%"),
    qe = He("px"),
    Xe = He("vh"),
    Ye = He("vw"),
    Ke = (() => ({
        ...$e,
        parse: t => $e.parse(t) / 100,
        transform: t => $e.transform(100 * t)
    }))(),
    Ze = {
        test: Oe("hsl", "hue"),
        parse: Ie("hue", "saturation", "lightness"),
        transform: ({
            hue: t,
            saturation: e,
            lightness: n,
            alpha: i = 1
        }) => "hsla(" + Math.round(t) + ", " + $e.transform(Le(e)) + ", " + $e.transform(Le(n)) + ", " + Le(je.transform(i)) + ")"
    },
    Ge = {
        test: t => Ue.test(t) || Ne.test(t) || Ze.test(t),
        parse: t => Ue.test(t) ? Ue.parse(t) : Ze.test(t) ? Ze.parse(t) : Ne.parse(t),
        transform: t => "string" == typeof t ? t : t.hasOwnProperty("red") ? Ue.transform(t) : Ze.transform(t),
        getAnimatableNone: t => {
            const e = Ge.parse(t);
            return e.alpha = 0, Ge.transform(e)
        }
    },
    _e = /(?:#[\da-f]{3,8}|(?:rgb|hsl)a?\((?:-?[\d.]+%?[,\s]+){2}-?[\d.]+%?\s*(?:[,/]\s*)?(?:\b\d+(?:\.\d+)?|\.\d+)?%?\))/giu;
const Je = "number",
    Qe = "color",
    tn = /var\s*\(\s*--(?:[\w-]+\s*|[\w-]+\s*,(?:\s*[^)(\s]|\s*\((?:[^)(]|\([^)(]*\))*\))+\s*)\)|#[\da-f]{3,8}|(?:rgb|hsl)a?\((?:-?[\d.]+%?[,\s]+){2}-?[\d.]+%?\s*(?:[,/]\s*)?(?:\b\d+(?:\.\d+)?|\.\d+)?%?\)|-?(?:\d+(?:\.\d+)?|\.\d+)/giu;

function en(t) {
    const e = t.toString(),
        n = [],
        i = {
            color: [],
            number: [],
            var: []
        },
        s = [];
    let o = 0;
    const r = e.replace(tn, t => (Ge.test(t) ? (i.color.push(o), s.push(Qe), n.push(Ge.parse(t))) : t.startsWith("var(") ? (i.var.push(o), s.push("var"), n.push(t)) : (i.number.push(o), s.push(Je), n.push(parseFloat(t))), ++o, "${}")).split("${}");
    return {
        values: n,
        split: r,
        indexes: i,
        types: s
    }
}

function nn(t) {
    return en(t).values
}

function sn(t) {
    const {
        split: e,
        types: n
    } = en(t), i = e.length;
    return t => {
        let s = "";
        for (let o = 0; o < i; o++)
            if (s += e[o], void 0 !== t[o]) {
                const e = n[o];
                s += e === Je ? Le(t[o]) : e === Qe ? Ge.transform(t[o]) : t[o]
            } return s
    }
}
const on = t => "number" == typeof t ? 0 : Ge.test(t) ? Ge.getAnimatableNone(t) : t;
const rn = {
    test: function(t) {
        var e, n;
        return isNaN(t) && "string" == typeof t && ((null == (e = t.match(Be)) ? void 0 : e.length) || 0) + ((null == (n = t.match(_e)) ? void 0 : n.length) || 0) > 0
    },
    parse: nn,
    createTransformer: sn,
    getAnimatableNone: function(t) {
        const e = nn(t);
        return sn(t)(e.map(on))
    }
};

function an(t, e, n) {
    return n < 0 && (n += 1), n > 1 && (n -= 1), n < 1 / 6 ? t + 6 * (e - t) * n : n < .5 ? e : n < 2 / 3 ? t + (e - t) * (2 / 3 - n) * 6 : t
}

function ln(t, e) {
    return n => n > 0 ? e : t
}
const hn = (t, e, n) => t + (e - t) * n,
    un = (t, e, n) => {
        const i = t * t,
            s = n * (e * e - i) + i;
        return s < 0 ? 0 : Math.sqrt(s)
    },
    cn = [Ne, Ue, Ze];

function dn(t) {
    const e = (n = t, cn.find(t => t.test(n)));
    var n;
    if (!Boolean(e)) return !1;
    let i = e.parse(t);
    return e === Ze && (i = function({
        hue: t,
        saturation: e,
        lightness: n,
        alpha: i
    }) {
        t /= 360, n /= 100;
        let s = 0,
            o = 0,
            r = 0;
        if (e /= 100) {
            const i = n < .5 ? n * (1 + e) : n + e - n * e,
                a = 2 * n - i;
            s = an(a, i, t + 1 / 3), o = an(a, i, t), r = an(a, i, t - 1 / 3)
        } else s = o = r = n;
        return {
            red: Math.round(255 * s),
            green: Math.round(255 * o),
            blue: Math.round(255 * r),
            alpha: i
        }
    }(i)), i
}
const pn = (t, e) => {
        const n = dn(t),
            i = dn(e);
        if (!n || !i) return ln(t, e);
        const s = {
            ...n
        };
        return t => (s.red = un(n.red, i.red, t), s.green = un(n.green, i.green, t), s.blue = un(n.blue, i.blue, t), s.alpha = hn(n.alpha, i.alpha, t), Ue.transform(s))
    },
    mn = new Set(["none", "hidden"]);

function fn(t, e) {
    return n => hn(t, e, n)
}

function yn(t) {
    return "number" == typeof t ? fn : "string" == typeof t ? Ee(t) ? ln : Ge.test(t) ? pn : xn : Array.isArray(t) ? gn : "object" == typeof t ? Ge.test(t) ? pn : vn : ln
}

function gn(t, e) {
    const n = [...t],
        i = n.length,
        s = t.map((t, n) => yn(t)(t, e[n]));
    return t => {
        for (let e = 0; e < i; e++) n[e] = s[e](t);
        return n
    }
}

function vn(t, e) {
    const n = {
            ...t,
            ...e
        },
        i = {};
    for (const s in n) void 0 !== t[s] && void 0 !== e[s] && (i[s] = yn(t[s])(t[s], e[s]));
    return t => {
        for (const e in i) n[e] = i[e](t);
        return n
    }
}
const xn = (t, e) => {
    const n = rn.createTransformer(e),
        i = en(t),
        s = en(e);
    return i.indexes.var.length === s.indexes.var.length && i.indexes.color.length === s.indexes.color.length && i.indexes.number.length >= s.indexes.number.length ? mn.has(t) && !s.values.length || mn.has(e) && !i.values.length ? function(t, e) {
        return mn.has(t) ? n => n <= 0 ? t : e : n => n >= 1 ? e : t
    }(t, e) : Yt(gn(function(t, e) {
        const n = [],
            i = {
                color: 0,
                var: 0,
                number: 0
            };
        for (let s = 0; s < e.values.length; s++) {
            const o = e.types[s],
                r = t.indexes[o][i[o]],
                a = t.values[r] ?? 0;
            n[s] = a, i[o]++
        }
        return n
    }(i, s), s.values), n) : ln(t, e)
};

function kn(t, e, n) {
    if ("number" == typeof t && "number" == typeof e && "number" == typeof n) return hn(t, e, n);
    return yn(t)(t, e)
}
const wn = t => {
        const e = ({
            timestamp: e
        }) => t(e);
        return {
            start: (t = !0) => xe.update(e, t),
            stop: () => ke(e),
            now: () => we.isProcessing ? we.timestamp : Pe.now()
        }
    },
    Mn = (t, e, n = 10) => {
        let i = "";
        const s = Math.max(Math.round(e / n), 2);
        for (let o = 0; o < s; o++) i += Math.round(1e4 * t(o / (s - 1))) / 1e4 + ", ";
        return `linear(${i.substring(0,i.length-2)})`
    },
    Tn = 2e4;

function bn(t) {
    let e = 0;
    let n = t.next(e);
    for (; !n.done && e < Tn;) e += 50, n = t.next(e);
    return e >= Tn ? 1 / 0 : e
}

function Pn(t, e, n) {
    const i = Math.max(e - 5, 0);
    return Jt(n - t(i), e - i)
}
const Sn = 100,
    An = 10,
    Vn = 1,
    En = 0,
    Cn = 800,
    Dn = .3,
    jn = .3,
    Rn = {
        granular: .01,
        default: 2
    },
    Ln = {
        granular: .005,
        default: .5
    },
    Bn = .01,
    Fn = 10,
    On = .05,
    In = 1,
    zn = .001;

function Un({
    duration: t = Cn,
    bounce: e = Dn,
    velocity: n = En,
    mass: i = Vn
}) {
    let s, o, r = 1 - e;
    r = zt(On, In, r), t = zt(Bn, Fn, _t(t)), r < 1 ? (s = e => {
        const i = e * r,
            s = i * t,
            o = i - n,
            a = Hn(e, r),
            l = Math.exp(-s);
        return zn - o / a * l
    }, o = e => {
        const i = e * r * t,
            o = i * n + n,
            a = Math.pow(r, 2) * Math.pow(e, 2) * t,
            l = Math.exp(-i),
            h = Hn(Math.pow(e, 2), r);
        return (-s(e) + zn > 0 ? -1 : 1) * ((o - a) * l) / h
    }) : (s = e => Math.exp(-e * t) * ((e - n) * t + 1) - .001, o = e => Math.exp(-e * t) * (t * t * (n - e)));
    const a = function(t, e, n) {
        let i = n;
        for (let s = 1; s < Nn; s++) i -= t(i) / e(i);
        return i
    }(s, o, 5 / t);
    if (t = Gt(t), isNaN(a)) return {
        stiffness: Sn,
        damping: An,
        duration: t
    };
    {
        const e = Math.pow(a, 2) * i;
        return {
            stiffness: e,
            damping: 2 * r * Math.sqrt(i * e),
            duration: t
        }
    }
}
const Nn = 12;

function Hn(t, e) {
    return t * Math.sqrt(1 - e * e)
}
const Wn = ["duration", "bounce"],
    $n = ["stiffness", "damping", "mass"];

function qn(t, e) {
    return e.some(e => void 0 !== t[e])
}

function Xn(t = jn, e = Dn) {
    const n = "object" != typeof t ? {
        visualDuration: t,
        keyframes: [0, 1],
        bounce: e
    } : t;
    let {
        restSpeed: i,
        restDelta: s
    } = n;
    const o = n.keyframes[0],
        r = n.keyframes[n.keyframes.length - 1],
        a = {
            done: !1,
            value: o
        },
        {
            stiffness: l,
            damping: h,
            mass: u,
            duration: c,
            velocity: d,
            isResolvedFromDuration: p
        } = function(t) {
            let e = {
                velocity: En,
                stiffness: Sn,
                damping: An,
                mass: Vn,
                isResolvedFromDuration: !1,
                ...t
            };
            if (!qn(t, $n) && qn(t, Wn))
                if (t.visualDuration) {
                    const n = t.visualDuration,
                        i = 2 * Math.PI / (1.2 * n),
                        s = i * i,
                        o = 2 * zt(.05, 1, 1 - (t.bounce || 0)) * Math.sqrt(s);
                    e = {
                        ...e,
                        mass: Vn,
                        stiffness: s,
                        damping: o
                    }
                } else {
                    const n = Un(t);
                    e = {
                        ...e,
                        ...n,
                        mass: Vn
                    }, e.isResolvedFromDuration = !0
                } return e
        }({
            ...n,
            velocity: -_t(n.velocity || 0)
        }),
        m = d || 0,
        f = h / (2 * Math.sqrt(l * u)),
        y = r - o,
        g = _t(Math.sqrt(l / u)),
        v = Math.abs(y) < 5;
    let x;
    if (i || (i = v ? Rn.granular : Rn.default), s || (s = v ? Ln.granular : Ln.default), f < 1) {
        const t = Hn(g, f);
        x = e => {
            const n = Math.exp(-f * g * e);
            return r - n * ((m + f * g * y) / t * Math.sin(t * e) + y * Math.cos(t * e))
        }
    } else if (1 === f) x = t => r - Math.exp(-g * t) * (y + (m + g * y) * t);
    else {
        const t = g * Math.sqrt(f * f - 1);
        x = e => {
            const n = Math.exp(-f * g * e),
                i = Math.min(t * e, 300);
            return r - n * ((m + f * g * y) * Math.sinh(i) + t * y * Math.cosh(i)) / t
        }
    }
    const k = {
        calculatedDuration: p && c || null,
        next: t => {
            const e = x(t);
            if (p) a.done = t >= c;
            else {
                let n = 0 === t ? m : 0;
                f < 1 && (n = 0 === t ? Gt(m) : Pn(x, t, e));
                const o = Math.abs(n) <= i,
                    l = Math.abs(r - e) <= s;
                a.done = o && l
            }
            return a.value = a.done ? r : e, a
        },
        toString: () => {
            const t = Math.min(bn(k), Tn),
                e = Mn(e => k.next(t * e).value, t, 30);
            return t + "ms " + e
        },
        toTransition: () => {}
    };
    return k
}

function Yn({
    keyframes: t,
    velocity: e = 0,
    power: n = .8,
    timeConstant: i = 325,
    bounceDamping: s = 10,
    bounceStiffness: o = 500,
    modifyTarget: r,
    min: a,
    max: l,
    restDelta: h = .5,
    restSpeed: u
}) {
    const c = t[0],
        d = {
            done: !1,
            value: c
        },
        p = t => void 0 === a ? l : void 0 === l || Math.abs(a - t) < Math.abs(l - t) ? a : l;
    let m = n * e;
    const f = c + m,
        y = void 0 === r ? f : r(f);
    y !== f && (m = y - c);
    const g = t => -m * Math.exp(-t / i),
        v = t => y + g(t),
        x = t => {
            const e = g(t),
                n = v(t);
            d.done = Math.abs(e) <= h, d.value = d.done ? y : n
        };
    let k, w;
    const M = t => {
        var e;
        (e = d.value, void 0 !== a && e < a || void 0 !== l && e > l) && (k = t, w = Xn({
            keyframes: [d.value, p(d.value)],
            velocity: Pn(v, t, d.value),
            damping: s,
            stiffness: o,
            restDelta: h,
            restSpeed: u
        }))
    };
    return M(0), {
        calculatedDuration: null,
        next: t => {
            let e = !1;
            return w || void 0 !== k || (e = !0, x(t), M(t)), void 0 !== k && t >= k ? w.next(t - k) : (!e && x(t), d)
        }
    }
}

function Kn(t, e, {
    clamp: n = !0,
    ease: i,
    mixer: s
} = {}) {
    const o = t.length;
    if (e.length, 1 === o) return () => e[0];
    if (2 === o && e[0] === e[1]) return () => e[1];
    const r = t[0] === t[1];
    t[0] > t[o - 1] && (t = [...t].reverse(), e = [...e].reverse());
    const a = function(t, e, n) {
            const i = [],
                s = n || Ut.mix || kn,
                o = t.length - 1;
            for (let r = 0; r < o; r++) {
                let n = s(t[r], t[r + 1]);
                if (e) {
                    const t = Array.isArray(e) ? e[r] || qt : e;
                    n = Yt(t, n)
                }
                i.push(n)
            }
            return i
        }(e, i, s),
        l = a.length,
        h = n => {
            if (r && n < t[0]) return e[0];
            let i = 0;
            if (l > 1)
                for (; i < t.length - 2 && !(n < t[i + 1]); i++);
            const s = Kt(t[i], t[i + 1], n);
            return a[i](s)
        };
    return n ? e => h(zt(t[0], t[o - 1], e)) : h
}

function Zn(t) {
    const e = [0];
    return function(t, e) {
        const n = t[t.length - 1];
        for (let i = 1; i <= e; i++) {
            const s = Kt(0, e, i);
            t.push(hn(n, 1, s))
        }
    }(e, t.length - 1), e
}

function Gn({
    duration: t = 300,
    keyframes: e,
    times: n,
    ease: i = "easeInOut"
}) {
    const s = (t => Array.isArray(t) && "number" != typeof t[0])(i) ? i.map(fe) : fe(i),
        o = {
            done: !1,
            value: e[0]
        },
        r = function(t, e) {
            return t.map(t => t * e)
        }(n && n.length === e.length ? n : Zn(e), t),
        a = Kn(r, e, {
            ease: Array.isArray(s) ? s : (l = e, h = s, l.map(() => h || de).splice(0, l.length - 1))
        });
    var l, h;
    return {
        calculatedDuration: t,
        next: e => (o.value = a(e), o.done = e >= t, o)
    }
}
Xn.applyToOptions = t => {
    const e = function(t, e = 100, n) {
        const i = n({
                ...t,
                keyframes: [0, e]
            }),
            s = Math.min(bn(i), Tn);
        return {
            type: "keyframes",
            ease: t => i.next(s * t).value / e,
            duration: _t(s)
        }
    }(t, 100, Xn);
    return t.ease = e.ease, t.duration = Gt(e.duration), t.type = "keyframes", t
};
const _n = t => null !== t;

function Jn(t, {
    repeat: e,
    repeatType: n = "loop"
}, i, s = 1) {
    const o = t.filter(_n),
        r = s < 0 || e && "loop" !== n && e % 2 == 1 ? 0 : o.length - 1;
    return r && void 0 !== i ? i : o[r]
}
const Qn = {
    decay: Yn,
    inertia: Yn,
    tween: Gn,
    keyframes: Gn,
    spring: Xn
};

function ti(t) {
    "string" == typeof t.type && (t.type = Qn[t.type])
}
class ei {
    constructor() {
        this.updateFinished()
    }
    get finished() {
        return this._finished
    }
    updateFinished() {
        this._finished = new Promise(t => {
            this.resolve = t
        })
    }
    notifyFinished() {
        this.resolve()
    }
    then(t, e) {
        return this.finished.then(t, e)
    }
}
const ni = t => t / 100;
class ii extends ei {
    constructor(t) {
        super(), this.state = "idle", this.startTime = null, this.isStopped = !1, this.currentTime = 0, this.holdTime = null, this.playbackSpeed = 1, this.stop = () => {
            var t, e;
            const {
                motionValue: n
            } = this.options;
            n && n.updatedAt !== Pe.now() && this.tick(Pe.now()), this.isStopped = !0, "idle" !== this.state && (this.teardown(), null == (e = (t = this.options).onStop) || e.call(t))
        }, this.options = t, this.initAnimation(), this.play(), !1 === t.autoplay && this.pause()
    }
    initAnimation() {
        const {
            options: t
        } = this;
        ti(t);
        const {
            type: e = Gn,
            repeat: n = 0,
            repeatDelay: i = 0,
            repeatType: s,
            velocity: o = 0
        } = t;
        let {
            keyframes: r
        } = t;
        const a = e || Gn;
        a !== Gn && "number" != typeof r[0] && (this.mixKeyframes = Yt(ni, kn(r[0], r[1])), r = [0, 100]);
        const l = a({
            ...t,
            keyframes: r
        });
        "mirror" === s && (this.mirroredGenerator = a({
            ...t,
            keyframes: [...r].reverse(),
            velocity: -o
        })), null === l.calculatedDuration && (l.calculatedDuration = bn(l));
        const {
            calculatedDuration: h
        } = l;
        this.calculatedDuration = h, this.resolvedDuration = h + i, this.totalDuration = this.resolvedDuration * (n + 1) - i, this.generator = l
    }
    updateTime(t) {
        const e = Math.round(t - this.startTime) * this.playbackSpeed;
        null !== this.holdTime ? this.currentTime = this.holdTime : this.currentTime = e
    }
    tick(t, e = !1) {
        const {
            generator: n,
            totalDuration: i,
            mixKeyframes: s,
            mirroredGenerator: o,
            resolvedDuration: r,
            calculatedDuration: a
        } = this;
        if (null === this.startTime) return n.next(0);
        const {
            delay: l = 0,
            keyframes: h,
            repeat: u,
            repeatType: c,
            repeatDelay: d,
            type: p,
            onUpdate: m,
            finalKeyframe: f
        } = this.options;
        this.speed > 0 ? this.startTime = Math.min(this.startTime, t) : this.speed < 0 && (this.startTime = Math.min(t - i / this.speed, this.startTime)), e ? this.currentTime = t : this.updateTime(t);
        const y = this.currentTime - l * (this.playbackSpeed >= 0 ? 1 : -1),
            g = this.playbackSpeed >= 0 ? y < 0 : y > i;
        this.currentTime = Math.max(y, 0), "finished" === this.state && null === this.holdTime && (this.currentTime = i);
        let v = this.currentTime,
            x = n;
        if (u) {
            const t = Math.min(this.currentTime, i) / r;
            let e = Math.floor(t),
                n = t % 1;
            !n && t >= 1 && (n = 1), 1 === n && e--, e = Math.min(e, u + 1);
            Boolean(e % 2) && ("reverse" === c ? (n = 1 - n, d && (n -= d / r)) : "mirror" === c && (x = o)), v = zt(0, 1, n) * r
        }
        const k = g ? {
            done: !1,
            value: h[0]
        } : x.next(v);
        s && (k.value = s(k.value));
        let {
            done: w
        } = k;
        g || null === a || (w = this.playbackSpeed >= 0 ? this.currentTime >= i : this.currentTime <= 0);
        const M = null === this.holdTime && ("finished" === this.state || "running" === this.state && w);
        return M && p !== Yn && (k.value = Jn(h, this.options, f, this.speed)), m && m(k.value), M && this.finish(), k
    }
    then(t, e) {
        return this.finished.then(t, e)
    }
    get duration() {
        return _t(this.calculatedDuration)
    }
    get time() {
        return _t(this.currentTime)
    }
    set time(t) {
        var e;
        t = Gt(t), this.currentTime = t, null === this.startTime || null !== this.holdTime || 0 === this.playbackSpeed ? this.holdTime = t : this.driver && (this.startTime = this.driver.now() - t / this.playbackSpeed), null == (e = this.driver) || e.start(!1)
    }
    get speed() {
        return this.playbackSpeed
    }
    set speed(t) {
        this.updateTime(Pe.now());
        const e = this.playbackSpeed !== t;
        this.playbackSpeed = t, e && (this.time = _t(this.currentTime))
    }
    play() {
        var t, e;
        if (this.isStopped) return;
        const {
            driver: n = wn,
            startTime: i
        } = this.options;
        this.driver || (this.driver = n(t => this.tick(t))), null == (e = (t = this.options).onPlay) || e.call(t);
        const s = this.driver.now();
        "finished" === this.state ? (this.updateFinished(), this.startTime = s) : null !== this.holdTime ? this.startTime = s - this.holdTime : this.startTime || (this.startTime = i ?? s), "finished" === this.state && this.speed < 0 && (this.startTime += this.calculatedDuration), this.holdTime = null, this.state = "running", this.driver.start()
    }
    pause() {
        this.state = "paused", this.updateTime(Pe.now()), this.holdTime = this.currentTime
    }
    complete() {
        "running" !== this.state && this.play(), this.state = "finished", this.holdTime = null
    }
    finish() {
        var t, e;
        this.notifyFinished(), this.teardown(), this.state = "finished", null == (e = (t = this.options).onComplete) || e.call(t)
    }
    cancel() {
        var t, e;
        this.holdTime = null, this.startTime = 0, this.tick(0), this.teardown(), null == (e = (t = this.options).onCancel) || e.call(t)
    }
    teardown() {
        this.state = "idle", this.stopDriver(), this.startTime = this.holdTime = null
    }
    stopDriver() {
        this.driver && (this.driver.stop(), this.driver = void 0)
    }
    sample(t) {
        return this.startTime = 0, this.tick(t, !0)
    }
    attachTimeline(t) {
        var e;
        return this.options.allowFlatten && (this.options.type = "keyframes", this.options.ease = "linear", this.initAnimation()), null == (e = this.driver) || e.stop(), t.observe(this)
    }
}
const si = t => 180 * t / Math.PI,
    oi = t => {
        const e = si(Math.atan2(t[1], t[0]));
        return ai(e)
    },
    ri = {
        x: 4,
        y: 5,
        translateX: 4,
        translateY: 5,
        scaleX: 0,
        scaleY: 3,
        scale: t => (Math.abs(t[0]) + Math.abs(t[3])) / 2,
        rotate: oi,
        rotateZ: oi,
        skewX: t => si(Math.atan(t[1])),
        skewY: t => si(Math.atan(t[2])),
        skew: t => (Math.abs(t[1]) + Math.abs(t[2])) / 2
    },
    ai = t => ((t %= 360) < 0 && (t += 360), t),
    li = t => Math.sqrt(t[0] * t[0] + t[1] * t[1]),
    hi = t => Math.sqrt(t[4] * t[4] + t[5] * t[5]),
    ui = {
        x: 12,
        y: 13,
        z: 14,
        translateX: 12,
        translateY: 13,
        translateZ: 14,
        scaleX: li,
        scaleY: hi,
        scale: t => (li(t) + hi(t)) / 2,
        rotateX: t => ai(si(Math.atan2(t[6], t[5]))),
        rotateY: t => ai(si(Math.atan2(-t[2], t[0]))),
        rotateZ: oi,
        rotate: oi,
        skewX: t => si(Math.atan(t[4])),
        skewY: t => si(Math.atan(t[1])),
        skew: t => (Math.abs(t[1]) + Math.abs(t[4])) / 2
    };

function ci(t) {
    return t.includes("scale") ? 1 : 0
}

function di(t, e) {
    if (!t || "none" === t) return ci(e);
    const n = t.match(/^matrix3d\(([-\d.e\s,]+)\)$/u);
    let i, s;
    if (n) i = ui, s = n;
    else {
        const e = t.match(/^matrix\(([-\d.e\s,]+)\)$/u);
        i = ri, s = e
    }
    if (!s) return ci(e);
    const o = i[e],
        r = s[1].split(",").map(pi);
    return "function" == typeof o ? o(r) : r[o]
}

function pi(t) {
    return parseFloat(t.trim())
}
const mi = ["transformPerspective", "x", "y", "z", "translateX", "translateY", "translateZ", "scale", "scaleX", "scaleY", "rotate", "rotateX", "rotateY", "rotateZ", "skew", "skewX", "skewY"],
    fi = (() => new Set(mi))(),
    yi = t => t === De || t === qe,
    gi = new Set(["x", "y", "z"]),
    vi = mi.filter(t => !gi.has(t));
const xi = {
    width: ({
        x: t
    }, {
        paddingLeft: e = "0",
        paddingRight: n = "0"
    }) => t.max - t.min - parseFloat(e) - parseFloat(n),
    height: ({
        y: t
    }, {
        paddingTop: e = "0",
        paddingBottom: n = "0"
    }) => t.max - t.min - parseFloat(e) - parseFloat(n),
    top: (t, {
        top: e
    }) => parseFloat(e),
    left: (t, {
        left: e
    }) => parseFloat(e),
    bottom: ({
        y: t
    }, {
        top: e
    }) => parseFloat(e) + (t.max - t.min),
    right: ({
        x: t
    }, {
        left: e
    }) => parseFloat(e) + (t.max - t.min),
    x: (t, {
        transform: e
    }) => di(e, "x"),
    y: (t, {
        transform: e
    }) => di(e, "y")
};
xi.translateX = xi.x, xi.translateY = xi.y;
const ki = new Set;
let wi = !1,
    Mi = !1,
    Ti = !1;

function bi() {
    if (Mi) {
        const t = Array.from(ki).filter(t => t.needsMeasurement),
            e = new Set(t.map(t => t.element)),
            n = new Map;
        e.forEach(t => {
            const e = function(t) {
                const e = [];
                return vi.forEach(n => {
                    const i = t.getValue(n);
                    void 0 !== i && (e.push([n, i.get()]), i.set(n.startsWith("scale") ? 1 : 0))
                }), e
            }(t);
            e.length && (n.set(t, e), t.render())
        }), t.forEach(t => t.measureInitialState()), e.forEach(t => {
            t.render();
            const e = n.get(t);
            e && e.forEach(([e, n]) => {
                var i;
                null == (i = t.getValue(e)) || i.set(n)
            })
        }), t.forEach(t => t.measureEndState()), t.forEach(t => {
            void 0 !== t.suspendedScrollY && window.scrollTo(0, t.suspendedScrollY)
        })
    }
    Mi = !1, wi = !1, ki.forEach(t => t.complete(Ti)), ki.clear()
}

function Pi() {
    ki.forEach(t => {
        t.readKeyframes(), t.needsMeasurement && (Mi = !0)
    })
}
class Si {
    constructor(t, e, n, i, s, o = !1) {
        this.state = "pending", this.isAsync = !1, this.needsMeasurement = !1, this.unresolvedKeyframes = [...t], this.onComplete = e, this.name = n, this.motionValue = i, this.element = s, this.isAsync = o
    }
    scheduleResolve() {
        this.state = "scheduled", this.isAsync ? (ki.add(this), wi || (wi = !0, xe.read(Pi), xe.resolveKeyframes(bi))) : (this.readKeyframes(), this.complete())
    }
    readKeyframes() {
        const {
            unresolvedKeyframes: t,
            name: e,
            element: n,
            motionValue: i
        } = this;
        if (null === t[0]) {
            const s = null == i ? void 0 : i.get(),
                o = t[t.length - 1];
            if (void 0 !== s) t[0] = s;
            else if (n && e) {
                const i = n.readValue(e, o);
                null != i && (t[0] = i)
            }
            void 0 === t[0] && (t[0] = o), i && void 0 === s && i.set(t[0])
        }! function(t) {
            for (let e = 1; e < t.length; e++) t[e] ?? (t[e] = t[e - 1])
        }(t)
    }
    setFinalKeyframe() {}
    measureInitialState() {}
    renderEndStyles() {}
    measureEndState() {}
    complete(t = !1) {
        this.state = "complete", this.onComplete(this.unresolvedKeyframes, this.finalKeyframe, t), ki.delete(this)
    }
    cancel() {
        "scheduled" === this.state && (ki.delete(this), this.state = "pending")
    }
    resume() {
        "pending" === this.state && this.scheduleResolve()
    }
}
const Ai = $t(() => void 0 !== window.ScrollTimeline),
    Vi = {};

function Ei(t, e) {
    const n = $t(t);
    return () => Vi[e] ?? n()
}
const Ci = Ei(() => {
        try {
            document.createElement("div").animate({
                opacity: 0
            }, {
                easing: "linear(0, 1)"
            })
        } catch (t) {
            return !1
        }
        return !0
    }, "linearEasing"),
    Di = ([t, e, n, i]) => `cubic-bezier(${t}, ${e}, ${n}, ${i})`,
    ji = {
        linear: "linear",
        ease: "ease",
        easeIn: "ease-in",
        easeOut: "ease-out",
        easeInOut: "ease-in-out",
        circIn: Di([0, .65, .55, 1]),
        circOut: Di([.55, 0, 1, .45]),
        backIn: Di([.31, .01, .66, -.59]),
        backOut: Di([.33, 1.53, .69, .99])
    };

function Ri(t, e) {
    return t ? "function" == typeof t ? Ci() ? Mn(t, e) : "ease-out" : pe(t) ? Di(t) : Array.isArray(t) ? t.map(t => Ri(t, e) || ji.easeOut) : ji[t] : void 0
}

function Li(t, e, n, {
    delay: i = 0,
    duration: s = 300,
    repeat: o = 0,
    repeatType: r = "loop",
    ease: a = "easeOut",
    times: l
} = {}, h = void 0) {
    const u = {
        [e]: n
    };
    l && (u.offset = l);
    const c = Ri(a, s);
    Array.isArray(c) && (u.easing = c);
    const d = {
        delay: i,
        duration: s,
        easing: Array.isArray(c) ? "linear" : c,
        fill: "both",
        iterations: o + 1,
        direction: "reverse" === r ? "alternate" : "normal"
    };
    h && (d.pseudoElement = h);
    return t.animate(u, d)
}

function Bi(t) {
    return "function" == typeof t && "applyToOptions" in t
}
class Fi extends ei {
    constructor(t) {
        if (super(), this.finishedTime = null, this.isStopped = !1, !t) return;
        const {
            element: e,
            name: n,
            keyframes: i,
            pseudoElement: s,
            allowFlatten: o = !1,
            finalKeyframe: r,
            onComplete: a
        } = t;
        this.isPseudoElement = Boolean(s), this.allowFlatten = o, this.options = t, t.type;
        const l = function({
            type: t,
            ...e
        }) {
            return Bi(t) && Ci() ? t.applyToOptions(e) : (e.duration ?? (e.duration = 300), e.ease ?? (e.ease = "easeOut"), e)
        }(t);
        this.animation = Li(e, n, i, l, s), !1 === l.autoplay && this.animation.pause(), this.animation.onfinish = () => {
            if (this.finishedTime = this.time, !s) {
                const t = Jn(i, this.options, r, this.speed);
                this.updateMotionValue ? this.updateMotionValue(t) : function(t, e, n) {
                    (t => t.startsWith("--"))(e) ? t.style.setProperty(e, n): t.style[e] = n
                }(e, n, t), this.animation.cancel()
            }
            null == a || a(), this.notifyFinished()
        }
    }
    play() {
        this.isStopped || (this.animation.play(), "finished" === this.state && this.updateFinished())
    }
    pause() {
        this.animation.pause()
    }
    complete() {
        var t, e;
        null == (e = (t = this.animation).finish) || e.call(t)
    }
    cancel() {
        try {
            this.animation.cancel()
        } catch (t) {}
    }
    stop() {
        if (this.isStopped) return;
        this.isStopped = !0;
        const {
            state: t
        } = this;
        "idle" !== t && "finished" !== t && (this.updateMotionValue ? this.updateMotionValue() : this.commitStyles(), this.isPseudoElement || this.cancel())
    }
    commitStyles() {
        var t, e;
        this.isPseudoElement || null == (e = (t = this.animation).commitStyles) || e.call(t)
    }
    get duration() {
        var t, e;
        const n = (null == (e = null == (t = this.animation.effect) ? void 0 : t.getComputedTiming) ? void 0 : e.call(t).duration) || 0;
        return _t(Number(n))
    }
    get time() {
        return _t(Number(this.animation.currentTime) || 0)
    }
    set time(t) {
        this.finishedTime = null, this.animation.currentTime = Gt(t)
    }
    get speed() {
        return this.animation.playbackRate
    }
    set speed(t) {
        t < 0 && (this.finishedTime = null), this.animation.playbackRate = t
    }
    get state() {
        return null !== this.finishedTime ? "finished" : this.animation.playState
    }
    get startTime() {
        return Number(this.animation.startTime)
    }
    set startTime(t) {
        this.animation.startTime = t
    }
    attachTimeline({
        timeline: t,
        observe: e
    }) {
        var n;
        return this.allowFlatten && (null == (n = this.animation.effect) || n.updateTiming({
            easing: "linear"
        })), this.animation.onfinish = null, t && Ai() ? (this.animation.timeline = t, qt) : e(this)
    }
}
const Oi = {
    anticipate: re,
    backInOut: oe,
    circInOut: he
};

function Ii(t) {
    "string" == typeof t.ease && t.ease in Oi && (t.ease = Oi[t.ease])
}
class zi extends Fi {
    constructor(t) {
        Ii(t), ti(t), super(t), t.startTime && (this.startTime = t.startTime), this.options = t
    }
    updateMotionValue(t) {
        const {
            motionValue: e,
            onUpdate: n,
            onComplete: i,
            element: s,
            ...o
        } = this.options;
        if (!e) return;
        if (void 0 !== t) return void e.set(t);
        const r = new ii({
                ...o,
                autoplay: !1
            }),
            a = Gt(this.finishedTime ?? this.time);
        e.setWithVelocity(r.sample(a - 10).value, r.sample(a).value, 10), r.stop()
    }
}
const Ui = (t, e) => "zIndex" !== e && (!("number" != typeof t && !Array.isArray(t)) || !("string" != typeof t || !rn.test(t) && "0" !== t || t.startsWith("url(")));

function Ni(t) {
    return Ht(t) && "offsetHeight" in t
}
const Hi = new Set(["opacity", "clipPath", "filter", "transform"]),
    Wi = $t(() => Object.hasOwnProperty.call(Element.prototype, "animate"));
class $i extends ei {
    constructor({
        autoplay: t = !0,
        delay: e = 0,
        type: n = "keyframes",
        repeat: i = 0,
        repeatDelay: s = 0,
        repeatType: o = "loop",
        keyframes: r,
        name: a,
        motionValue: l,
        element: h,
        ...u
    }) {
        var c;
        super(), this.stop = () => {
            var t, e;
            this._animation && (this._animation.stop(), null == (t = this.stopTimeline) || t.call(this)), null == (e = this.keyframeResolver) || e.cancel()
        }, this.createdAt = Pe.now();
        const d = {
                autoplay: t,
                delay: e,
                type: n,
                repeat: i,
                repeatDelay: s,
                repeatType: o,
                name: a,
                motionValue: l,
                element: h,
                ...u
            },
            p = (null == h ? void 0 : h.KeyframeResolver) || Si;
        this.keyframeResolver = new p(r, (t, e, n) => this.onKeyframesResolved(t, e, d, !n), a, l, h), null == (c = this.keyframeResolver) || c.scheduleResolve()
    }
    onKeyframesResolved(t, e, n, i) {
        this.keyframeResolver = void 0;
        const {
            name: s,
            type: o,
            velocity: r,
            delay: a,
            isHandoff: l,
            onUpdate: h
        } = n;
        this.resolvedAt = Pe.now(),
            function(t, e, n, i) {
                const s = t[0];
                if (null === s) return !1;
                if ("display" === e || "visibility" === e) return !0;
                const o = t[t.length - 1],
                    r = Ui(s, e),
                    a = Ui(o, e);
                return !(!r || !a) && (function(t) {
                    const e = t[0];
                    if (1 === t.length) return !0;
                    for (let n = 0; n < t.length; n++)
                        if (t[n] !== e) return !0
                }(t) || ("spring" === n || Bi(n)) && i)
            }(t, s, o, r) || (!Ut.instantAnimations && a || null == h || h(Jn(t, n, e)), t[0] = t[t.length - 1], n.duration = 0, n.repeat = 0);
        const u = {
                startTime: i ? this.resolvedAt && this.resolvedAt - this.createdAt > 40 ? this.resolvedAt : this.createdAt : void 0,
                finalKeyframe: e,
                ...n,
                keyframes: t
            },
            c = !l && function(t) {
                var e;
                const {
                    motionValue: n,
                    name: i,
                    repeatDelay: s,
                    repeatType: o,
                    damping: r,
                    type: a
                } = t;
                if (!Ni(null == (e = null == n ? void 0 : n.owner) ? void 0 : e.current)) return !1;
                const {
                    onUpdate: l,
                    transformTemplate: h
                } = n.owner.getProps();
                return Wi() && i && Hi.has(i) && ("transform" !== i || !h) && !l && !s && "mirror" !== o && 0 !== r && "inertia" !== a
            }(u) ? new zi({
                ...u,
                element: u.motionValue.owner.current
            }) : new ii(u);
        c.finished.then(() => this.notifyFinished()).catch(qt), this.pendingTimeline && (this.stopTimeline = c.attachTimeline(this.pendingTimeline), this.pendingTimeline = void 0), this._animation = c
    }
    get finished() {
        return this._animation ? this.animation.finished : this._finished
    }
    then(t, e) {
        return this.finished.finally(t).then(() => {})
    }
    get animation() {
        var t;
        return this._animation || (null == (t = this.keyframeResolver) || t.resume(), Ti = !0, Pi(), bi(), Ti = !1), this._animation
    }
    get duration() {
        return this.animation.duration
    }
    get time() {
        return this.animation.time
    }
    set time(t) {
        this.animation.time = t
    }
    get speed() {
        return this.animation.speed
    }
    get state() {
        return this.animation.state
    }
    set speed(t) {
        this.animation.speed = t
    }
    get startTime() {
        return this.animation.startTime
    }
    attachTimeline(t) {
        return this._animation ? this.stopTimeline = this.animation.attachTimeline(t) : this.pendingTimeline = t, () => this.stop()
    }
    play() {
        this.animation.play()
    }
    pause() {
        this.animation.pause()
    }
    complete() {
        this.animation.complete()
    }
    cancel() {
        var t;
        this._animation && this.animation.cancel(), null == (t = this.keyframeResolver) || t.cancel()
    }
}
const qi = /^var\(--(?:([\w-]+)|([\w-]+), ?([a-zA-Z\d ()%#.,-]+))\)/u;

function Xi(t, e, n = 1) {
    const [i, s] = function(t) {
        const e = qi.exec(t);
        if (!e) return [, ];
        const [, n, i, s] = e;
        return [`--${n??i}`, s]
    }(t);
    if (!i) return;
    const o = window.getComputedStyle(e).getPropertyValue(i);
    if (o) {
        const t = o.trim();
        return Nt(t) ? parseFloat(t) : t
    }
    return Ee(s) ? Xi(s, e, n + 1) : s
}

function Yi(t, e) {
    return (null == t ? void 0 : t[e]) ?? (null == t ? void 0 : t.default) ?? t
}
const Ki = new Set(["width", "height", "top", "left", "right", "bottom", ...mi]),
    Zi = t => e => e.test(t),
    Gi = [De, qe, $e, We, Ye, Xe, {
        test: t => "auto" === t,
        parse: t => t
    }],
    _i = t => Gi.find(Zi(t));

function Ji(t) {
    return "number" == typeof t ? 0 === t : null === t || ("none" === t || "0" === t || Wt(t))
}
const Qi = new Set(["brightness", "contrast", "saturate", "opacity"]);

function ts(t) {
    const [e, n] = t.slice(0, -1).split("(");
    if ("drop-shadow" === e) return t;
    const [i] = n.match(Be) || [];
    if (!i) return t;
    const s = n.replace(i, "");
    let o = Qi.has(e) ? 1 : 0;
    return i !== n && (o *= 100), e + "(" + o + s + ")"
}
const es = /\b([a-z-]*)\(.*?\)/gu,
    ns = {
        ...rn,
        getAnimatableNone: t => {
            const e = t.match(es);
            return e ? e.map(ts).join(" ") : t
        }
    },
    is = {
        ...De,
        transform: Math.round
    },
    ss = {
        borderWidth: qe,
        borderTopWidth: qe,
        borderRightWidth: qe,
        borderBottomWidth: qe,
        borderLeftWidth: qe,
        borderRadius: qe,
        radius: qe,
        borderTopLeftRadius: qe,
        borderTopRightRadius: qe,
        borderBottomRightRadius: qe,
        borderBottomLeftRadius: qe,
        width: qe,
        maxWidth: qe,
        height: qe,
        maxHeight: qe,
        top: qe,
        right: qe,
        bottom: qe,
        left: qe,
        padding: qe,
        paddingTop: qe,
        paddingRight: qe,
        paddingBottom: qe,
        paddingLeft: qe,
        margin: qe,
        marginTop: qe,
        marginRight: qe,
        marginBottom: qe,
        marginLeft: qe,
        backgroundPositionX: qe,
        backgroundPositionY: qe,
        ...{
            rotate: We,
            rotateX: We,
            rotateY: We,
            rotateZ: We,
            scale: Re,
            scaleX: Re,
            scaleY: Re,
            scaleZ: Re,
            skew: We,
            skewX: We,
            skewY: We,
            distance: qe,
            translateX: qe,
            translateY: qe,
            translateZ: qe,
            x: qe,
            y: qe,
            z: qe,
            perspective: qe,
            transformPerspective: qe,
            opacity: je,
            originX: Ke,
            originY: Ke,
            originZ: qe
        },
        zIndex: is,
        fillOpacity: je,
        strokeOpacity: je,
        numOctaves: is
    },
    os = {
        ...ss,
        color: Ge,
        backgroundColor: Ge,
        outlineColor: Ge,
        fill: Ge,
        stroke: Ge,
        borderColor: Ge,
        borderTopColor: Ge,
        borderRightColor: Ge,
        borderBottomColor: Ge,
        borderLeftColor: Ge,
        filter: ns,
        WebkitFilter: ns
    },
    rs = t => os[t];

function as(t, e) {
    let n = rs(t);
    return n !== ns && (n = rn), n.getAnimatableNone ? n.getAnimatableNone(e) : void 0
}
const ls = new Set(["auto", "none", "0"]);
class hs extends Si {
    constructor(t, e, n, i, s) {
        super(t, e, n, i, s, !0)
    }
    readKeyframes() {
        const {
            unresolvedKeyframes: t,
            element: e,
            name: n
        } = this;
        if (!e || !e.current) return;
        super.readKeyframes();
        for (let a = 0; a < t.length; a++) {
            let n = t[a];
            if ("string" == typeof n && (n = n.trim(), Ee(n))) {
                const i = Xi(n, e.current);
                void 0 !== i && (t[a] = i), a === t.length - 1 && (this.finalKeyframe = n)
            }
        }
        if (this.resolveNoneKeyframes(), !Ki.has(n) || 2 !== t.length) return;
        const [i, s] = t, o = _i(i), r = _i(s);
        if (o !== r)
            if (yi(o) && yi(r))
                for (let a = 0; a < t.length; a++) {
                    const e = t[a];
                    "string" == typeof e && (t[a] = parseFloat(e))
                } else xi[n] && (this.needsMeasurement = !0)
    }
    resolveNoneKeyframes() {
        const {
            unresolvedKeyframes: t,
            name: e
        } = this, n = [];
        for (let i = 0; i < t.length; i++)(null === t[i] || Ji(t[i])) && n.push(i);
        n.length && function(t, e, n) {
            let i, s = 0;
            for (; s < t.length && !i;) {
                const e = t[s];
                "string" == typeof e && !ls.has(e) && en(e).values.length && (i = t[s]), s++
            }
            if (i && n)
                for (const o of e) t[o] = as(n, i)
        }(t, n, e)
    }
    measureInitialState() {
        const {
            element: t,
            unresolvedKeyframes: e,
            name: n
        } = this;
        if (!t || !t.current) return;
        "height" === n && (this.suspendedScrollY = window.pageYOffset), this.measuredOrigin = xi[n](t.measureViewportBox(), window.getComputedStyle(t.current)), e[0] = this.measuredOrigin;
        const i = e[e.length - 1];
        void 0 !== i && t.getValue(n, i).jump(i, !1)
    }
    measureEndState() {
        var t;
        const {
            element: e,
            name: n,
            unresolvedKeyframes: i
        } = this;
        if (!e || !e.current) return;
        const s = e.getValue(n);
        s && s.jump(this.measuredOrigin, !1);
        const o = i.length - 1,
            r = i[o];
        i[o] = xi[n](e.measureViewportBox(), window.getComputedStyle(e.current)), null !== r && void 0 === this.finalKeyframe && (this.finalKeyframe = r), (null == (t = this.removedTransforms) ? void 0 : t.length) && this.removedTransforms.forEach(([t, n]) => {
            e.getValue(t).set(n)
        }), this.resolveNoneKeyframes()
    }
}
const us = (t, e) => e && "number" == typeof t ? e.transform(t) : t;
class cs {
    constructor(t, e = {}) {
        this.canTrackVelocity = null, this.events = {}, this.updateAndNotify = (t, e = !0) => {
            var n, i;
            const s = Pe.now();
            if (this.updatedAt !== s && this.setPrevFrameValue(), this.prev = this.current, this.setCurrent(t), this.current !== this.prev && (null == (n = this.events.change) || n.notify(this.current), this.dependents))
                for (const o of this.dependents) o.dirty();
            e && (null == (i = this.events.renderRequest) || i.notify(this.current))
        }, this.hasAnimated = !1, this.setCurrent(t), this.owner = e.owner
    }
    setCurrent(t) {
        var e;
        this.current = t, this.updatedAt = Pe.now(), null === this.canTrackVelocity && void 0 !== t && (this.canTrackVelocity = (e = this.current, !isNaN(parseFloat(e))))
    }
    setPrevFrameValue(t = this.current) {
        this.prevFrameValue = t, this.prevUpdatedAt = this.updatedAt
    }
    onChange(t) {
        return this.on("change", t)
    }
    on(t, e) {
        this.events[t] || (this.events[t] = new Zt);
        const n = this.events[t].add(e);
        return "change" === t ? () => {
            n(), xe.read(() => {
                this.events.change.getSize() || this.stop()
            })
        } : n
    }
    clearListeners() {
        for (const t in this.events) this.events[t].clear()
    }
    attach(t, e) {
        this.passiveEffect = t, this.stopPassiveEffect = e
    }
    set(t, e = !0) {
        e && this.passiveEffect ? this.passiveEffect(t, this.updateAndNotify) : this.updateAndNotify(t, e)
    }
    setWithVelocity(t, e, n) {
        this.set(e), this.prev = void 0, this.prevFrameValue = t, this.prevUpdatedAt = this.updatedAt - n
    }
    jump(t, e = !0) {
        this.updateAndNotify(t), this.prev = t, this.prevUpdatedAt = this.prevFrameValue = void 0, e && this.stop(), this.stopPassiveEffect && this.stopPassiveEffect()
    }
    dirty() {
        var t;
        null == (t = this.events.change) || t.notify(this.current)
    }
    addDependent(t) {
        this.dependents || (this.dependents = new Set), this.dependents.add(t)
    }
    removeDependent(t) {
        this.dependents && this.dependents.delete(t)
    }
    get() {
        return this.current
    }
    getPrevious() {
        return this.prev
    }
    getVelocity() {
        const t = Pe.now();
        if (!this.canTrackVelocity || void 0 === this.prevFrameValue || t - this.updatedAt > 30) return 0;
        const e = Math.min(this.updatedAt - this.prevUpdatedAt, 30);
        return Jt(parseFloat(this.current) - parseFloat(this.prevFrameValue), e)
    }
    start(t) {
        return this.stop(), new Promise(e => {
            this.hasAnimated = !0, this.animation = t(e), this.events.animationStart && this.events.animationStart.notify()
        }).then(() => {
            this.events.animationComplete && this.events.animationComplete.notify(), this.clearAnimation()
        })
    }
    stop() {
        this.animation && (this.animation.stop(), this.events.animationCancel && this.events.animationCancel.notify()), this.clearAnimation()
    }
    isAnimating() {
        return !!this.animation
    }
    clearAnimation() {
        delete this.animation
    }
    destroy() {
        var t, e;
        null == (t = this.dependents) || t.clear(), null == (e = this.events.destroy) || e.notify(), this.clearListeners(), this.stop(), this.stopPassiveEffect && this.stopPassiveEffect()
    }
}

function ds(t, e) {
    return new cs(t, e)
}
const {
    schedule: ps
} = ve(queueMicrotask, !1), ms = {
    x: !1,
    y: !1
};

function fs() {
    return ms.x || ms.y
}

function ys(t, e) {
    const n = function(t, e, n) {
            if (t instanceof EventTarget) return [t];
            if ("string" == typeof t) {
                let e = document;
                const i = (null == n ? void 0 : n[t]) ?? e.querySelectorAll(t);
                return i ? Array.from(i) : []
            }
            return Array.from(t)
        }(t),
        i = new AbortController;
    return [n, {
        passive: !0,
        ...e,
        signal: i.signal
    }, () => i.abort()]
}

function gs(t) {
    return !("touch" === t.pointerType || fs())
}
const vs = (t, e) => !!e && (t === e || vs(t, e.parentElement)),
    xs = t => "mouse" === t.pointerType ? "number" != typeof t.button || t.button <= 0 : !1 !== t.isPrimary,
    ks = new Set(["BUTTON", "INPUT", "SELECT", "TEXTAREA", "A"]);
const ws = new WeakSet;

function Ms(t) {
    return e => {
        "Enter" === e.key && t(e)
    }
}

function Ts(t, e) {
    t.dispatchEvent(new PointerEvent("pointer" + e, {
        isPrimary: !0,
        bubbles: !0
    }))
}

function bs(t) {
    return xs(t) && !fs()
}

function Ps(t, e, n = {}) {
    const [i, s, o] = ys(t, n), r = t => {
        const i = t.currentTarget;
        if (!bs(t)) return;
        ws.add(i);
        const o = e(i, t),
            r = (t, e) => {
                window.removeEventListener("pointerup", a), window.removeEventListener("pointercancel", l), ws.has(i) && ws.delete(i), bs(t) && "function" == typeof o && o(t, {
                    success: e
                })
            },
            a = t => {
                r(t, i === window || i === document || n.useGlobalTarget || vs(i, t.target))
            },
            l = t => {
                r(t, !1)
            };
        window.addEventListener("pointerup", a, s), window.addEventListener("pointercancel", l, s)
    };
    return i.forEach(t => {
        var e;
        (n.useGlobalTarget ? window : t).addEventListener("pointerdown", r, s), Ni(t) && (t.addEventListener("focus", t => ((t, e) => {
            const n = t.currentTarget;
            if (!n) return;
            const i = Ms(() => {
                if (ws.has(n)) return;
                Ts(n, "down");
                const t = Ms(() => {
                    Ts(n, "up")
                });
                n.addEventListener("keyup", t, e), n.addEventListener("blur", () => Ts(n, "cancel"), e)
            });
            n.addEventListener("keydown", i, e), n.addEventListener("blur", () => n.removeEventListener("keydown", i), e)
        })(t, s)), e = t, ks.has(e.tagName) || -1 !== e.tabIndex || t.hasAttribute("tabindex") || (t.tabIndex = 0))
    }), o
}

function Ss(t) {
    return Ht(t) && "ownerSVGElement" in t
}
const As = t => Boolean(t && t.getVelocity),
    Vs = [...Gi, Ge, rn],
    Es = t.createContext({
        transformPagePoint: t => t,
        isStatic: !1,
        reducedMotion: "never"
    });
class Cs extends t.Component {
    getSnapshotBeforeUpdate(t) {
        const e = this.props.childRef.current;
        if (e && t.isPresent && !this.props.isPresent) {
            const t = e.offsetParent,
                n = Ni(t) && t.offsetWidth || 0,
                i = this.props.sizeRef.current;
            i.height = e.offsetHeight || 0, i.width = e.offsetWidth || 0, i.top = e.offsetTop, i.left = e.offsetLeft, i.right = n - i.width - i.left
        }
        return null
    }
    componentDidUpdate() {}
    render() {
        return this.props.children
    }
}

function Ds({
    children: n,
    isPresent: i,
    anchorX: s
}) {
    const o = t.useId(),
        r = t.useRef(null),
        a = t.useRef({
            width: 0,
            height: 0,
            top: 0,
            left: 0,
            right: 0
        }),
        {
            nonce: l
        } = t.useContext(Es);
    return t.useInsertionEffect(() => {
        const {
            width: t,
            height: e,
            top: n,
            left: h,
            right: u
        } = a.current;
        if (i || !r.current || !t || !e) return;
        const c = "left" === s ? `left: ${h}` : `right: ${u}`;
        r.current.dataset.motionPopId = o;
        const d = document.createElement("style");
        return l && (d.nonce = l), document.head.appendChild(d), d.sheet && d.sheet.insertRule(`\n          [data-motion-pop-id="${o}"] {\n            position: absolute !important;\n            width: ${t}px !important;\n            height: ${e}px !important;\n            ${c}px !important;\n            top: ${n}px !important;\n          }\n        `), () => {
            document.head.contains(d) && document.head.removeChild(d)
        }
    }, [i]), e.jsx(Cs, {
        isPresent: i,
        childRef: r,
        sizeRef: a,
        children: t.cloneElement(n, {
            ref: r
        })
    })
}
const js = ({
    children: n,
    initial: i,
    isPresent: s,
    onExitComplete: o,
    custom: r,
    presenceAffectsLayout: a,
    mode: l,
    anchorX: h
}) => {
    const u = Rt(Rs),
        c = t.useId();
    let d = !0,
        p = t.useMemo(() => (d = !1, {
            id: c,
            initial: i,
            isPresent: s,
            custom: r,
            onExitComplete: t => {
                u.set(t, !0);
                for (const e of u.values())
                    if (!e) return;
                o && o()
            },
            register: t => (u.set(t, !1), () => u.delete(t))
        }), [s, u, o]);
    return a && d && (p = {
        ...p
    }), t.useMemo(() => {
        u.forEach((t, e) => u.set(e, !1))
    }, [s]), t.useEffect(() => {
        !s && !u.size && o && o()
    }, [s]), "popLayout" === l && (n = e.jsx(Ds, {
        isPresent: s,
        anchorX: h,
        children: n
    })), e.jsx(Ft.Provider, {
        value: p,
        children: n
    })
};

function Rs() {
    return new Map
}

function Ls(e = !0) {
    const n = t.useContext(Ft);
    if (null === n) return [!0, null];
    const {
        isPresent: i,
        onExitComplete: s,
        register: o
    } = n, r = t.useId();
    t.useEffect(() => {
        if (e) return o(r)
    }, [e]);
    const a = t.useCallback(() => e && s && s(r), [r, s, e]);
    return !i && s ? [!1, a] : [!0]
}
const Bs = t => t.key || "";

function Fs(e) {
    const n = [];
    return t.Children.forEach(e, e => {
        t.isValidElement(e) && n.push(e)
    }), n
}
const Os = ({
        children: n,
        custom: i,
        initial: s = !0,
        onExitComplete: o,
        presenceAffectsLayout: r = !0,
        mode: a = "sync",
        propagate: l = !1,
        anchorX: h = "left"
    }) => {
        const [u, c] = Ls(l), d = t.useMemo(() => Fs(n), [n]), p = l && !u ? [] : d.map(Bs), m = t.useRef(!0), f = t.useRef(d), y = Rt(() => new Map), [g, v] = t.useState(d), [x, k] = t.useState(d);
        Bt(() => {
            m.current = !1, f.current = d;
            for (let t = 0; t < x.length; t++) {
                const e = Bs(x[t]);
                p.includes(e) ? y.delete(e) : !0 !== y.get(e) && y.set(e, !1)
            }
        }, [x, p.length, p.join("-")]);
        const w = [];
        if (d !== g) {
            let t = [...d];
            for (let e = 0; e < x.length; e++) {
                const n = x[e],
                    i = Bs(n);
                p.includes(i) || (t.splice(e, 0, n), w.push(n))
            }
            return "wait" === a && w.length && (t = w), k(Fs(t)), v(d), null
        }
        const {
            forceRender: M
        } = t.useContext(jt);
        return e.jsx(e.Fragment, {
            children: x.map(t => {
                const n = Bs(t),
                    g = !(l && !u) && (d === x || p.includes(n));
                return e.jsx(js, {
                    isPresent: g,
                    initial: !(m.current && !s) && void 0,
                    custom: i,
                    presenceAffectsLayout: r,
                    mode: a,
                    onExitComplete: g ? void 0 : () => {
                        if (!y.has(n)) return;
                        y.set(n, !0);
                        let t = !0;
                        y.forEach(e => {
                            e || (t = !1)
                        }), t && (null == M || M(), k(f.current), l && (null == c || c()), o && o())
                    },
                    anchorX: h,
                    children: t
                }, n)
            })
        })
    },
    Is = t.createContext({
        strict: !1
    }),
    zs = {
        animation: ["animate", "variants", "whileHover", "whileTap", "exit", "whileInView", "whileFocus", "whileDrag"],
        exit: ["exit"],
        drag: ["drag", "dragControls"],
        focus: ["whileFocus"],
        hover: ["whileHover", "onHoverStart", "onHoverEnd"],
        tap: ["whileTap", "onTap", "onTapStart", "onTapCancel"],
        pan: ["onPan", "onPanStart", "onPanSessionStart", "onPanEnd"],
        inView: ["whileInView", "onViewportEnter", "onViewportLeave"],
        layout: ["layout", "layoutId"]
    },
    Us = {};
for (const Il in zs) Us[Il] = {
    isEnabled: t => zs[Il].some(e => !!t[e])
};
const Ns = new Set(["animate", "exit", "variants", "initial", "style", "values", "variants", "transition", "transformTemplate", "custom", "inherit", "onBeforeLayoutMeasure", "onAnimationStart", "onAnimationComplete", "onUpdate", "onDragStart", "onDrag", "onDragEnd", "onMeasureDragConstraints", "onDirectionLock", "onDragTransitionEnd", "_dragX", "_dragY", "onHoverStart", "onHoverEnd", "onViewportEnter", "onViewportLeave", "globalTapTarget", "ignoreStrict", "viewport"]);

function Hs(t) {
    return t.startsWith("while") || t.startsWith("drag") && "draggable" !== t || t.startsWith("layout") || t.startsWith("onTap") || t.startsWith("onPan") || t.startsWith("onLayout") || Ns.has(t)
}
let Ws = t => !Hs(t);
try {
    "function" == typeof($s = require("@emotion/is-prop-valid").default) && (Ws = t => t.startsWith("on") ? !Hs(t) : $s(t))
} catch {}
var $s;

function qs(t) {
    if ("undefined" == typeof Proxy) return t;
    const e = new Map;
    return new Proxy((...e) => t(...e), {
        get: (n, i) => "create" === i ? t : (e.has(i) || e.set(i, t(i)), e.get(i))
    })
}
const Xs = t.createContext({});

function Ys(t) {
    return null !== t && "object" == typeof t && "function" == typeof t.start
}

function Ks(t) {
    return "string" == typeof t || Array.isArray(t)
}
const Zs = ["animate", "whileInView", "whileFocus", "whileHover", "whileTap", "whileDrag", "exit"],
    Gs = ["initial", ...Zs];

function _s(t) {
    return Ys(t.animate) || Gs.some(e => Ks(t[e]))
}

function Js(t) {
    return Boolean(_s(t) || t.variants)
}

function Qs(e) {
    const {
        initial: n,
        animate: i
    } = function(t, e) {
        if (_s(t)) {
            const {
                initial: e,
                animate: n
            } = t;
            return {
                initial: !1 === e || Ks(e) ? e : void 0,
                animate: Ks(n) ? n : void 0
            }
        }
        return !1 !== t.inherit ? e : {}
    }(e, t.useContext(Xs));
    return t.useMemo(() => ({
        initial: n,
        animate: i
    }), [to(n), to(i)])
}

function to(t) {
    return Array.isArray(t) ? t.join(" ") : t
}
const eo = Symbol.for("motionComponentSymbol");

function no(t) {
    return t && "object" == typeof t && Object.prototype.hasOwnProperty.call(t, "current")
}

function io(e, n, i) {
    return t.useCallback(t => {
        t && e.onMount && e.onMount(t), n && (t ? n.mount(t) : n.unmount()), i && ("function" == typeof i ? i(t) : no(i) && (i.current = t))
    }, [n])
}
const so = t => t.replace(/([a-z])([A-Z])/gu, "$1-$2").toLowerCase(),
    oo = "data-" + so("framerAppearId"),
    ro = t.createContext({});

function ao(e, n, i, s, o) {
    var r, a;
    const {
        visualElement: l
    } = t.useContext(Xs), h = t.useContext(Is), u = t.useContext(Ft), c = t.useContext(Es).reducedMotion, d = t.useRef(null);
    s = s || h.renderer, !d.current && s && (d.current = s(e, {
        visualState: n,
        parent: l,
        props: i,
        presenceContext: u,
        blockInitialAnimation: !!u && !1 === u.initial,
        reducedMotionConfig: c
    }));
    const p = d.current,
        m = t.useContext(ro);
    !p || p.projection || !o || "html" !== p.type && "svg" !== p.type || function(t, e, n, i) {
        const {
            layoutId: s,
            layout: o,
            drag: r,
            dragConstraints: a,
            layoutScroll: l,
            layoutRoot: h,
            layoutCrossfade: u
        } = e;
        t.projection = new n(t.latestValues, e["data-framer-portal-id"] ? void 0 : lo(t.parent)), t.projection.setOptions({
            layoutId: s,
            layout: o,
            alwaysMeasureLayout: Boolean(r) || a && no(a),
            visualElement: t,
            animationType: "string" == typeof o ? o : "both",
            initialPromotionConfig: i,
            crossfade: u,
            layoutScroll: l,
            layoutRoot: h
        })
    }(d.current, i, o, m);
    const f = t.useRef(!1);
    t.useInsertionEffect(() => {
        p && f.current && p.update(i, u)
    });
    const y = i[oo],
        g = t.useRef(Boolean(y) && !(null == (r = window.MotionHandoffIsComplete) ? void 0 : r.call(window, y)) && (null == (a = window.MotionHasOptimisedAnimation) ? void 0 : a.call(window, y)));
    return Bt(() => {
        p && (f.current = !0, window.MotionIsMounted = !0, p.updateFeatures(), ps.render(p.render), g.current && p.animationState && p.animationState.animateChanges())
    }), t.useEffect(() => {
        p && (!g.current && p.animationState && p.animationState.animateChanges(), g.current && (queueMicrotask(() => {
            var t;
            null == (t = window.MotionHandoffMarkAsComplete) || t.call(window, y)
        }), g.current = !1))
    }), p
}

function lo(t) {
    if (t) return !1 !== t.options.allowProjection ? t.projection : lo(t.parent)
}

function ho({
    preloadedFeatures: n,
    createVisualElement: i,
    useRender: s,
    useVisualState: o,
    Component: r
}) {
    function a(n, a) {
        let l;
        const h = {
                ...t.useContext(Es),
                ...n,
                layoutId: uo(n)
            },
            {
                isStatic: u
            } = h,
            c = Qs(n),
            d = o(n, u);
        if (!u && Lt) {
            t.useContext(Is).strict;
            const e = function(t) {
                const {
                    drag: e,
                    layout: n
                } = Us;
                if (!e && !n) return {};
                const i = {
                    ...e,
                    ...n
                };
                return {
                    MeasureLayout: (null == e ? void 0 : e.isEnabled(t)) || (null == n ? void 0 : n.isEnabled(t)) ? i.MeasureLayout : void 0,
                    ProjectionNode: i.ProjectionNode
                }
            }(h);
            l = e.MeasureLayout, c.visualElement = ao(r, d, h, i, e.ProjectionNode)
        }
        return e.jsxs(Xs.Provider, {
            value: c,
            children: [l && c.visualElement ? e.jsx(l, {
                visualElement: c.visualElement,
                ...h
            }) : null, s(r, n, io(d, c.visualElement, a), d, u, c.visualElement)]
        })
    }
    n && function(t) {
        for (const e in t) Us[e] = {
            ...Us[e],
            ...t[e]
        }
    }(n), a.displayName = `motion.${"string"==typeof r?r:`create(${r.displayName??r.name??""})`}`;
    const l = t.forwardRef(a);
    return l[eo] = r, l
}

function uo({
    layoutId: e
}) {
    const n = t.useContext(jt).id;
    return n && void 0 !== e ? n + "-" + e : e
}
const co = {};

function po(t, {
    layout: e,
    layoutId: n
}) {
    return fi.has(t) || t.startsWith("origin") || (e || void 0 !== n) && (!!co[t] || "opacity" === t)
}
const mo = {
        x: "translateX",
        y: "translateY",
        z: "translateZ",
        transformPerspective: "perspective"
    },
    fo = mi.length;

function yo(t, e, n) {
    const {
        style: i,
        vars: s,
        transformOrigin: o
    } = t;
    let r = !1,
        a = !1;
    for (const l in e) {
        const t = e[l];
        if (fi.has(l)) r = !0;
        else if (Ae(l)) s[l] = t;
        else {
            const e = us(t, ss[l]);
            l.startsWith("origin") ? (a = !0, o[l] = e) : i[l] = e
        }
    }
    if (e.transform || (r || n ? i.transform = function(t, e, n) {
            let i = "",
                s = !0;
            for (let o = 0; o < fo; o++) {
                const r = mi[o],
                    a = t[r];
                if (void 0 === a) continue;
                let l = !0;
                if (l = "number" == typeof a ? a === (r.startsWith("scale") ? 1 : 0) : 0 === parseFloat(a), !l || n) {
                    const t = us(a, ss[r]);
                    l || (s = !1, i += `${mo[r]||r}(${t}) `), n && (e[r] = t)
                }
            }
            return i = i.trim(), n ? i = n(e, s ? "" : i) : s && (i = "none"), i
        }(e, t.transform, n) : i.transform && (i.transform = "none")), a) {
        const {
            originX: t = "50%",
            originY: e = "50%",
            originZ: n = 0
        } = o;
        i.transformOrigin = `${t} ${e} ${n}`
    }
}
const go = () => ({
    style: {},
    transform: {},
    transformOrigin: {},
    vars: {}
});

function vo(t, e, n) {
    for (const i in e) As(e[i]) || po(i, n) || (t[i] = e[i])
}

function xo(e, n) {
    const i = {};
    return vo(i, e.style || {}, e), Object.assign(i, function({
        transformTemplate: e
    }, n) {
        return t.useMemo(() => {
            const t = {
                style: {},
                transform: {},
                transformOrigin: {},
                vars: {}
            };
            return yo(t, n, e), Object.assign({}, t.vars, t.style)
        }, [n])
    }(e, n)), i
}

function ko(t, e) {
    const n = {},
        i = xo(t, e);
    return t.drag && !1 !== t.dragListener && (n.draggable = !1, i.userSelect = i.WebkitUserSelect = i.WebkitTouchCallout = "none", i.touchAction = !0 === t.drag ? "none" : "pan-" + ("x" === t.drag ? "y" : "x")), void 0 === t.tabIndex && (t.onTap || t.onTapStart || t.whileTap) && (n.tabIndex = 0), n.style = i, n
}
const wo = {
        offset: "stroke-dashoffset",
        array: "stroke-dasharray"
    },
    Mo = {
        offset: "strokeDashoffset",
        array: "strokeDasharray"
    };

function To(t, {
    attrX: e,
    attrY: n,
    attrScale: i,
    pathLength: s,
    pathSpacing: o = 1,
    pathOffset: r = 0,
    ...a
}, l, h, u) {
    if (yo(t, a, h), l) return void(t.style.viewBox && (t.attrs.viewBox = t.style.viewBox));
    t.attrs = t.style, t.style = {};
    const {
        attrs: c,
        style: d
    } = t;
    c.transform && (d.transform = c.transform, delete c.transform), (d.transform || c.transformOrigin) && (d.transformOrigin = c.transformOrigin ?? "50% 50%", delete c.transformOrigin), d.transform && (d.transformBox = (null == u ? void 0 : u.transformBox) ?? "fill-box", delete c.transformBox), void 0 !== e && (c.x = e), void 0 !== n && (c.y = n), void 0 !== i && (c.scale = i), void 0 !== s && function(t, e, n = 1, i = 0, s = !0) {
        t.pathLength = 1;
        const o = s ? wo : Mo;
        t[o.offset] = qe.transform(-i);
        const r = qe.transform(e),
            a = qe.transform(n);
        t[o.array] = `${r} ${a}`
    }(c, s, o, r, !1)
}
const bo = () => ({
        style: {},
        transform: {},
        transformOrigin: {},
        vars: {},
        attrs: {}
    }),
    Po = t => "string" == typeof t && "svg" === t.toLowerCase();

function So(e, n, i, s) {
    const o = t.useMemo(() => {
        const t = {
            style: {},
            transform: {},
            transformOrigin: {},
            vars: {},
            attrs: {}
        };
        return To(t, n, Po(s), e.transformTemplate, e.style), {
            ...t.attrs,
            style: {
                ...t.style
            }
        }
    }, [n]);
    if (e.style) {
        const t = {};
        vo(t, e.style, e), o.style = {
            ...t,
            ...o.style
        }
    }
    return o
}
const Ao = ["animate", "circle", "defs", "desc", "ellipse", "g", "image", "line", "filter", "marker", "mask", "metadata", "path", "pattern", "polygon", "polyline", "rect", "stop", "switch", "symbol", "svg", "text", "tspan", "use", "view"];

function Vo(t) {
    return "string" == typeof t && !t.includes("-") && !!(Ao.indexOf(t) > -1 || /[A-Z]/u.test(t))
}

function Eo(e = !1) {
    return (n, i, s, {
        latestValues: o
    }, r) => {
        const a = (Vo(n) ? So : ko)(i, o, r, n),
            l = function(t, e, n) {
                const i = {};
                for (const s in t) "values" === s && "object" == typeof t.values || (Ws(s) || !0 === n && Hs(s) || !e && !Hs(s) || t.draggable && s.startsWith("onDrag")) && (i[s] = t[s]);
                return i
            }(i, "string" == typeof n, e),
            h = n !== t.Fragment ? {
                ...l,
                ...a,
                ref: s
            } : {},
            {
                children: u
            } = i,
            c = t.useMemo(() => As(u) ? u.get() : u, [u]);
        return t.createElement(n, {
            ...h,
            children: c
        })
    }
}

function Co(t) {
    const e = [{}, {}];
    return null == t || t.values.forEach((t, n) => {
        e[0][n] = t.get(), e[1][n] = t.getVelocity()
    }), e
}

function Do(t, e, n, i) {
    if ("function" == typeof e) {
        const [s, o] = Co(i);
        e = e(void 0 !== n ? n : t.custom, s, o)
    }
    if ("string" == typeof e && (e = t.variants && t.variants[e]), "function" == typeof e) {
        const [s, o] = Co(i);
        e = e(void 0 !== n ? n : t.custom, s, o)
    }
    return e
}

function jo(t) {
    return As(t) ? t.get() : t
}
const Ro = e => (n, i) => {
    const s = t.useContext(Xs),
        o = t.useContext(Ft),
        r = () => function({
            scrapeMotionValuesFromProps: t,
            createRenderState: e
        }, n, i, s) {
            return {
                latestValues: Lo(n, i, s, t),
                renderState: e()
            }
        }(e, n, s, o);
    return i ? r() : Rt(r)
};

function Lo(t, e, n, i) {
    const s = {},
        o = i(t, {});
    for (const d in o) s[d] = jo(o[d]);
    let {
        initial: r,
        animate: a
    } = t;
    const l = _s(t),
        h = Js(t);
    e && h && !l && !1 !== t.inherit && (void 0 === r && (r = e.initial), void 0 === a && (a = e.animate));
    let u = !!n && !1 === n.initial;
    u = u || !1 === r;
    const c = u ? a : r;
    if (c && "boolean" != typeof c && !Ys(c)) {
        const e = Array.isArray(c) ? c : [c];
        for (let n = 0; n < e.length; n++) {
            const i = Do(t, e[n]);
            if (i) {
                const {
                    transitionEnd: t,
                    transition: e,
                    ...n
                } = i;
                for (const i in n) {
                    let t = n[i];
                    if (Array.isArray(t)) {
                        t = t[u ? t.length - 1 : 0]
                    }
                    null !== t && (s[i] = t)
                }
                for (const i in t) s[i] = t[i]
            }
        }
    }
    return s
}

function Bo(t, e, n) {
    var i;
    const {
        style: s
    } = t, o = {};
    for (const r in s)(As(s[r]) || e.style && As(e.style[r]) || po(r, t) || void 0 !== (null == (i = null == n ? void 0 : n.getValue(r)) ? void 0 : i.liveStyle)) && (o[r] = s[r]);
    return o
}
const Fo = {
    useVisualState: Ro({
        scrapeMotionValuesFromProps: Bo,
        createRenderState: go
    })
};

function Oo(t, e, n) {
    const i = Bo(t, e, n);
    for (const s in t)
        if (As(t[s]) || As(e[s])) {
            i[-1 !== mi.indexOf(s) ? "attr" + s.charAt(0).toUpperCase() + s.substring(1) : s] = t[s]
        } return i
}
const Io = {
    useVisualState: Ro({
        scrapeMotionValuesFromProps: Oo,
        createRenderState: bo
    })
};

function zo(t, e) {
    return function(n, {
        forwardMotionProps: i
    } = {
        forwardMotionProps: !1
    }) {
        return ho({
            ...Vo(n) ? Io : Fo,
            preloadedFeatures: t,
            useRender: Eo(i),
            createVisualElement: e,
            Component: n
        })
    }
}

function Uo(t, e, n) {
    const i = t.getProps();
    return Do(i, e, void 0 !== n ? n : i.custom, t)
}
const No = t => Array.isArray(t);

function Ho(t, e, n) {
    t.hasValue(e) ? t.getValue(e).set(n) : t.addValue(e, ds(n))
}

function Wo(t) {
    return No(t) ? t[t.length - 1] || 0 : t
}

function $o(t, e) {
    const n = t.getValue("willChange");
    if (i = n, Boolean(As(i) && i.add)) return n.add(e);
    if (!n && Ut.WillChange) {
        const n = new Ut.WillChange("auto");
        t.addValue("willChange", n), n.add(e)
    }
    var i
}

function qo(t) {
    return t.props[oo]
}
const Xo = t => null !== t;
const Yo = {
        type: "spring",
        stiffness: 500,
        damping: 25,
        restSpeed: 10
    },
    Ko = {
        type: "keyframes",
        duration: .8
    },
    Zo = {
        type: "keyframes",
        ease: [.25, .1, .35, 1],
        duration: .3
    },
    Go = (t, {
        keyframes: e
    }) => e.length > 2 ? Ko : fi.has(t) ? t.startsWith("scale") ? {
        type: "spring",
        stiffness: 550,
        damping: 0 === e[1] ? 2 * Math.sqrt(550) : 30,
        restSpeed: 10
    } : Yo : Zo;
const _o = (t, e, n, i = {}, s, o) => r => {
    const a = Yi(i, t) || {},
        l = a.delay || i.delay || 0;
    let {
        elapsed: h = 0
    } = i;
    h -= Gt(l);
    const u = {
        keyframes: Array.isArray(n) ? n : [null, n],
        ease: "easeOut",
        velocity: e.getVelocity(),
        ...a,
        delay: -h,
        onUpdate: t => {
            e.set(t), a.onUpdate && a.onUpdate(t)
        },
        onComplete: () => {
            r(), a.onComplete && a.onComplete()
        },
        name: t,
        motionValue: e,
        element: o ? void 0 : s
    };
    (function({
        when: t,
        delay: e,
        delayChildren: n,
        staggerChildren: i,
        staggerDirection: s,
        repeat: o,
        repeatType: r,
        repeatDelay: a,
        from: l,
        elapsed: h,
        ...u
    }) {
        return !!Object.keys(u).length
    })(a) || Object.assign(u, Go(t, u)), u.duration && (u.duration = Gt(u.duration)), u.repeatDelay && (u.repeatDelay = Gt(u.repeatDelay)), void 0 !== u.from && (u.keyframes[0] = u.from);
    let c = !1;
    if ((!1 === u.type || 0 === u.duration && !u.repeatDelay) && (u.duration = 0, 0 === u.delay && (c = !0)), (Ut.instantAnimations || Ut.skipAnimations) && (c = !0, u.duration = 0, u.delay = 0), u.allowFlatten = !a.type && !a.ease, c && !o && void 0 !== e.get()) {
        const t = function(t, {
            repeat: e,
            repeatType: n = "loop"
        }) {
            const i = t.filter(Xo);
            return i[e && "loop" !== n && e % 2 == 1 ? 0 : i.length - 1]
        }(u.keyframes, a);
        if (void 0 !== t) return void xe.update(() => {
            u.onUpdate(t), u.onComplete()
        })
    }
    return a.isSync ? new ii(u) : new $i(u)
};

function Jo({
    protectedKeys: t,
    needsAnimating: e
}, n) {
    const i = t.hasOwnProperty(n) && !0 !== e[n];
    return e[n] = !1, i
}

function Qo(t, e, {
    delay: n = 0,
    transitionOverride: i,
    type: s
} = {}) {
    let {
        transition: o = t.getDefaultTransition(),
        transitionEnd: r,
        ...a
    } = e;
    i && (o = i);
    const l = [],
        h = s && t.animationState && t.animationState.getState()[s];
    for (const u in a) {
        const e = t.getValue(u, t.latestValues[u] ?? null),
            i = a[u];
        if (void 0 === i || h && Jo(h, u)) continue;
        const s = {
                delay: n,
                ...Yi(o || {}, u)
            },
            r = e.get();
        if (void 0 !== r && !e.isAnimating && !Array.isArray(i) && i === r && !s.velocity) continue;
        let c = !1;
        if (window.MotionHandoffAnimation) {
            const e = qo(t);
            if (e) {
                const t = window.MotionHandoffAnimation(e, u, xe);
                null !== t && (s.startTime = t, c = !0)
            }
        }
        $o(t, u), e.start(_o(u, e, i, t.shouldReduceMotion && Ki.has(u) ? {
            type: !1
        } : s, t, c));
        const d = e.animation;
        d && l.push(d)
    }
    return r && Promise.all(l).then(() => {
        xe.update(() => {
            r && function(t, e) {
                const n = Uo(t, e);
                let {
                    transitionEnd: i = {},
                    transition: s = {},
                    ...o
                } = n || {};
                o = {
                    ...o,
                    ...i
                };
                for (const r in o) Ho(t, r, Wo(o[r]))
            }(t, r)
        })
    }), l
}

function tr(t, e, n = {}) {
    var i;
    const s = Uo(t, e, "exit" === n.type ? null == (i = t.presenceContext) ? void 0 : i.custom : void 0);
    let {
        transition: o = t.getDefaultTransition() || {}
    } = s || {};
    n.transitionOverride && (o = n.transitionOverride);
    const r = s ? () => Promise.all(Qo(t, s, n)) : () => Promise.resolve(),
        a = t.variantChildren && t.variantChildren.size ? (i = 0) => {
            const {
                delayChildren: s = 0,
                staggerChildren: r,
                staggerDirection: a
            } = o;
            return function(t, e, n = 0, i = 0, s = 1, o) {
                const r = [],
                    a = (t.variantChildren.size - 1) * i,
                    l = 1 === s ? (t = 0) => t * i : (t = 0) => a - t * i;
                return Array.from(t.variantChildren).sort(er).forEach((t, i) => {
                    t.notify("AnimationStart", e), r.push(tr(t, e, {
                        ...o,
                        delay: n + l(i)
                    }).then(() => t.notify("AnimationComplete", e)))
                }), Promise.all(r)
            }(t, e, s + i, r, a, n)
        } : () => Promise.resolve(),
        {
            when: l
        } = o;
    if (l) {
        const [t, e] = "beforeChildren" === l ? [r, a] : [a, r];
        return t().then(() => e())
    }
    return Promise.all([r(), a(n.delay)])
}

function er(t, e) {
    return t.sortNodePosition(e)
}

function nr(t, e) {
    if (!Array.isArray(e)) return !1;
    const n = e.length;
    if (n !== t.length) return !1;
    for (let i = 0; i < n; i++)
        if (e[i] !== t[i]) return !1;
    return !0
}
const ir = Gs.length;

function sr(t) {
    if (!t) return;
    if (!t.isControllingVariants) {
        const e = t.parent && sr(t.parent) || {};
        return void 0 !== t.props.initial && (e.initial = t.props.initial), e
    }
    const e = {};
    for (let n = 0; n < ir; n++) {
        const i = Gs[n],
            s = t.props[i];
        (Ks(s) || !1 === s) && (e[i] = s)
    }
    return e
}
const or = [...Zs].reverse(),
    rr = Zs.length;

function ar(t) {
    return e => Promise.all(e.map(({
        animation: e,
        options: n
    }) => function(t, e, n = {}) {
        let i;
        if (t.notify("AnimationStart", e), Array.isArray(e)) {
            const s = e.map(e => tr(t, e, n));
            i = Promise.all(s)
        } else if ("string" == typeof e) i = tr(t, e, n);
        else {
            const s = "function" == typeof e ? Uo(t, e, n.custom) : e;
            i = Promise.all(Qo(t, s, n))
        }
        return i.then(() => {
            t.notify("AnimationComplete", e)
        })
    }(t, e, n)))
}

function lr(t) {
    let e = ar(t),
        n = cr(),
        i = !0;
    const s = e => (n, i) => {
        var s;
        const o = Uo(t, i, "exit" === e ? null == (s = t.presenceContext) ? void 0 : s.custom : void 0);
        if (o) {
            const {
                transition: t,
                transitionEnd: e,
                ...i
            } = o;
            n = {
                ...n,
                ...i,
                ...e
            }
        }
        return n
    };

    function o(o) {
        const {
            props: r
        } = t, a = sr(t.parent) || {}, l = [], h = new Set;
        let u = {},
            c = 1 / 0;
        for (let e = 0; e < rr; e++) {
            const d = or[e],
                p = n[d],
                m = void 0 !== r[d] ? r[d] : a[d],
                f = Ks(m),
                y = d === o ? p.isActive : null;
            !1 === y && (c = e);
            let g = m === a[d] && m !== r[d] && f;
            if (g && i && t.manuallyAnimateOnMount && (g = !1), p.protectedKeys = {
                    ...u
                }, !p.isActive && null === y || !m && !p.prevProp || Ys(m) || "boolean" == typeof m) continue;
            const v = hr(p.prevProp, m);
            let x = v || d === o && p.isActive && !g && f || e > c && f,
                k = !1;
            const w = Array.isArray(m) ? m : [m];
            let M = w.reduce(s(d), {});
            !1 === y && (M = {});
            const {
                prevResolvedValues: T = {}
            } = p, b = {
                ...T,
                ...M
            }, P = e => {
                x = !0, h.has(e) && (k = !0, h.delete(e)), p.needsAnimating[e] = !0;
                const n = t.getValue(e);
                n && (n.liveStyle = !1)
            };
            for (const t in b) {
                const e = M[t],
                    n = T[t];
                if (u.hasOwnProperty(t)) continue;
                let i = !1;
                i = No(e) && No(n) ? !nr(e, n) : e !== n, i ? null != e ? P(t) : h.add(t) : void 0 !== e && h.has(t) ? P(t) : p.protectedKeys[t] = !0
            }
            p.prevProp = m, p.prevResolvedValues = M, p.isActive && (u = {
                ...u,
                ...M
            }), i && t.blockInitialAnimation && (x = !1);
            x && (!(g && v) || k) && l.push(...w.map(t => ({
                animation: t,
                options: {
                    type: d
                }
            })))
        }
        if (h.size) {
            const e = {};
            if ("boolean" != typeof r.initial) {
                const n = Uo(t, Array.isArray(r.initial) ? r.initial[0] : r.initial);
                n && n.transition && (e.transition = n.transition)
            }
            h.forEach(n => {
                const i = t.getBaseTarget(n),
                    s = t.getValue(n);
                s && (s.liveStyle = !0), e[n] = i ?? null
            }), l.push({
                animation: e
            })
        }
        let d = Boolean(l.length);
        return !i || !1 !== r.initial && r.initial !== r.animate || t.manuallyAnimateOnMount || (d = !1), i = !1, d ? e(l) : Promise.resolve()
    }
    return {
        animateChanges: o,
        setActive: function(e, i) {
            var s;
            if (n[e].isActive === i) return Promise.resolve();
            null == (s = t.variantChildren) || s.forEach(t => {
                var n;
                return null == (n = t.animationState) ? void 0 : n.setActive(e, i)
            }), n[e].isActive = i;
            const r = o(e);
            for (const t in n) n[t].protectedKeys = {};
            return r
        },
        setAnimateFunction: function(n) {
            e = n(t)
        },
        getState: () => n,
        reset: () => {
            n = cr(), i = !0
        }
    }
}

function hr(t, e) {
    return "string" == typeof e ? e !== t : !!Array.isArray(e) && !nr(e, t)
}

function ur(t = !1) {
    return {
        isActive: t,
        protectedKeys: {},
        needsAnimating: {},
        prevResolvedValues: {}
    }
}

function cr() {
    return {
        animate: ur(!0),
        whileInView: ur(),
        whileHover: ur(),
        whileTap: ur(),
        whileDrag: ur(),
        whileFocus: ur(),
        exit: ur()
    }
}
class dr {
    constructor(t) {
        this.isMounted = !1, this.node = t
    }
    update() {}
}
let pr = 0;
const mr = {
    animation: {
        Feature: class extends dr {
            constructor(t) {
                super(t), t.animationState || (t.animationState = lr(t))
            }
            updateAnimationControlsSubscription() {
                const {
                    animate: t
                } = this.node.getProps();
                Ys(t) && (this.unmountControls = t.subscribe(this.node))
            }
            mount() {
                this.updateAnimationControlsSubscription()
            }
            update() {
                const {
                    animate: t
                } = this.node.getProps(), {
                    animate: e
                } = this.node.prevProps || {};
                t !== e && this.updateAnimationControlsSubscription()
            }
            unmount() {
                var t;
                this.node.animationState.reset(), null == (t = this.unmountControls) || t.call(this)
            }
        }
    },
    exit: {
        Feature: class extends dr {
            constructor() {
                super(...arguments), this.id = pr++
            }
            update() {
                if (!this.node.presenceContext) return;
                const {
                    isPresent: t,
                    onExitComplete: e
                } = this.node.presenceContext, {
                    isPresent: n
                } = this.node.prevPresenceContext || {};
                if (!this.node.animationState || t === n) return;
                const i = this.node.animationState.setActive("exit", !t);
                e && !t && i.then(() => {
                    e(this.id)
                })
            }
            mount() {
                const {
                    register: t,
                    onExitComplete: e
                } = this.node.presenceContext || {};
                e && e(this.id), t && (this.unmount = t(this.id))
            }
            unmount() {}
        }
    }
};

function fr(t, e, n, i = {
    passive: !0
}) {
    return t.addEventListener(e, n, i), () => t.removeEventListener(e, n)
}

function yr(t) {
    return {
        point: {
            x: t.pageX,
            y: t.pageY
        }
    }
}

function gr(t, e, n, i) {
    return fr(t, e, (t => e => xs(e) && t(e, yr(e)))(n), i)
}

function vr({
    top: t,
    left: e,
    right: n,
    bottom: i
}) {
    return {
        x: {
            min: e,
            max: n
        },
        y: {
            min: t,
            max: i
        }
    }
}

function xr(t) {
    return t.max - t.min
}

function kr(t, e, n, i = .5) {
    t.origin = i, t.originPoint = hn(e.min, e.max, t.origin), t.scale = xr(n) / xr(e), t.translate = hn(n.min, n.max, t.origin) - t.originPoint, (t.scale >= .9999 && t.scale <= 1.0001 || isNaN(t.scale)) && (t.scale = 1), (t.translate >= -.01 && t.translate <= .01 || isNaN(t.translate)) && (t.translate = 0)
}

function wr(t, e, n, i) {
    kr(t.x, e.x, n.x, i ? i.originX : void 0), kr(t.y, e.y, n.y, i ? i.originY : void 0)
}

function Mr(t, e, n) {
    t.min = n.min + e.min, t.max = t.min + xr(e)
}

function Tr(t, e, n) {
    t.min = e.min - n.min, t.max = t.min + xr(e)
}

function br(t, e, n) {
    Tr(t.x, e.x, n.x), Tr(t.y, e.y, n.y)
}
const Pr = () => ({
    x: {
        min: 0,
        max: 0
    },
    y: {
        min: 0,
        max: 0
    }
});

function Sr(t) {
    return [t("x"), t("y")]
}

function Ar(t) {
    return void 0 === t || 1 === t
}

function Vr({
    scale: t,
    scaleX: e,
    scaleY: n
}) {
    return !Ar(t) || !Ar(e) || !Ar(n)
}

function Er(t) {
    return Vr(t) || Cr(t) || t.z || t.rotate || t.rotateX || t.rotateY || t.skewX || t.skewY
}

function Cr(t) {
    return Dr(t.x) || Dr(t.y)
}

function Dr(t) {
    return t && "0%" !== t
}

function jr(t, e, n) {
    return n + e * (t - n)
}

function Rr(t, e, n, i, s) {
    return void 0 !== s && (t = jr(t, s, i)), jr(t, n, i) + e
}

function Lr(t, e = 0, n = 1, i, s) {
    t.min = Rr(t.min, e, n, i, s), t.max = Rr(t.max, e, n, i, s)
}

function Br(t, {
    x: e,
    y: n
}) {
    Lr(t.x, e.translate, e.scale, e.originPoint), Lr(t.y, n.translate, n.scale, n.originPoint)
}
const Fr = .999999999999,
    Or = 1.0000000000001;

function Ir(t, e) {
    t.min = t.min + e, t.max = t.max + e
}

function zr(t, e, n, i, s = .5) {
    Lr(t, e, n, hn(t.min, t.max, s), i)
}

function Ur(t, e) {
    zr(t.x, e.x, e.scaleX, e.scale, e.originX), zr(t.y, e.y, e.scaleY, e.scale, e.originY)
}

function Nr(t, e) {
    return vr(function(t, e) {
        if (!e) return t;
        const n = e({
                x: t.left,
                y: t.top
            }),
            i = e({
                x: t.right,
                y: t.bottom
            });
        return {
            top: n.y,
            left: n.x,
            bottom: i.y,
            right: i.x
        }
    }(t.getBoundingClientRect(), e))
}
const Hr = ({
        current: t
    }) => t ? t.ownerDocument.defaultView : null,
    Wr = (t, e) => Math.abs(t - e);
class $r {
    constructor(t, e, {
        transformPagePoint: n,
        contextWindow: i,
        dragSnapToOrigin: s = !1
    } = {}) {
        if (this.startEvent = null, this.lastMoveEvent = null, this.lastMoveEventInfo = null, this.handlers = {}, this.contextWindow = window, this.updatePoint = () => {
                if (!this.lastMoveEvent || !this.lastMoveEventInfo) return;
                const t = Yr(this.lastMoveEventInfo, this.history),
                    e = null !== this.startEvent,
                    n = function(t, e) {
                        const n = Wr(t.x, e.x),
                            i = Wr(t.y, e.y);
                        return Math.sqrt(n ** 2 + i ** 2)
                    }(t.offset, {
                        x: 0,
                        y: 0
                    }) >= 3;
                if (!e && !n) return;
                const {
                    point: i
                } = t, {
                    timestamp: s
                } = we;
                this.history.push({
                    ...i,
                    timestamp: s
                });
                const {
                    onStart: o,
                    onMove: r
                } = this.handlers;
                e || (o && o(this.lastMoveEvent, t), this.startEvent = this.lastMoveEvent), r && r(this.lastMoveEvent, t)
            }, this.handlePointerMove = (t, e) => {
                this.lastMoveEvent = t, this.lastMoveEventInfo = qr(e, this.transformPagePoint), xe.update(this.updatePoint, !0)
            }, this.handlePointerUp = (t, e) => {
                this.end();
                const {
                    onEnd: n,
                    onSessionEnd: i,
                    resumeAnimation: s
                } = this.handlers;
                if (this.dragSnapToOrigin && s && s(), !this.lastMoveEvent || !this.lastMoveEventInfo) return;
                const o = Yr("pointercancel" === t.type ? this.lastMoveEventInfo : qr(e, this.transformPagePoint), this.history);
                this.startEvent && n && n(t, o), i && i(t, o)
            }, !xs(t)) return;
        this.dragSnapToOrigin = s, this.handlers = e, this.transformPagePoint = n, this.contextWindow = i || window;
        const o = qr(yr(t), this.transformPagePoint),
            {
                point: r
            } = o,
            {
                timestamp: a
            } = we;
        this.history = [{
            ...r,
            timestamp: a
        }];
        const {
            onSessionStart: l
        } = e;
        l && l(t, Yr(o, this.history)), this.removeListeners = Yt(gr(this.contextWindow, "pointermove", this.handlePointerMove), gr(this.contextWindow, "pointerup", this.handlePointerUp), gr(this.contextWindow, "pointercancel", this.handlePointerUp))
    }
    updateHandlers(t) {
        this.handlers = t
    }
    end() {
        this.removeListeners && this.removeListeners(), ke(this.updatePoint)
    }
}

function qr(t, e) {
    return e ? {
        point: e(t.point)
    } : t
}

function Xr(t, e) {
    return {
        x: t.x - e.x,
        y: t.y - e.y
    }
}

function Yr({
    point: t
}, e) {
    return {
        point: t,
        delta: Xr(t, Zr(e)),
        offset: Xr(t, Kr(e)),
        velocity: Gr(e, .1)
    }
}

function Kr(t) {
    return t[0]
}

function Zr(t) {
    return t[t.length - 1]
}

function Gr(t, e) {
    if (t.length < 2) return {
        x: 0,
        y: 0
    };
    let n = t.length - 1,
        i = null;
    const s = Zr(t);
    for (; n >= 0 && (i = t[n], !(s.timestamp - i.timestamp > Gt(e)));) n--;
    if (!i) return {
        x: 0,
        y: 0
    };
    const o = _t(s.timestamp - i.timestamp);
    if (0 === o) return {
        x: 0,
        y: 0
    };
    const r = {
        x: (s.x - i.x) / o,
        y: (s.y - i.y) / o
    };
    return r.x === 1 / 0 && (r.x = 0), r.y === 1 / 0 && (r.y = 0), r
}

function _r(t, e, n) {
    return {
        min: void 0 !== e ? t.min + e : void 0,
        max: void 0 !== n ? t.max + n - (t.max - t.min) : void 0
    }
}

function Jr(t, e) {
    let n = e.min - t.min,
        i = e.max - t.max;
    return e.max - e.min < t.max - t.min && ([n, i] = [i, n]), {
        min: n,
        max: i
    }
}
const Qr = .35;

function ta(t, e, n) {
    return {
        min: ea(t, e),
        max: ea(t, n)
    }
}

function ea(t, e) {
    return "number" == typeof t ? t : t[e] || 0
}
const na = new WeakMap;
class ia {
    constructor(t) {
        this.openDragLock = null, this.isDragging = !1, this.currentDirection = null, this.originPoint = {
            x: 0,
            y: 0
        }, this.constraints = !1, this.hasMutatedConstraints = !1, this.elastic = {
            x: {
                min: 0,
                max: 0
            },
            y: {
                min: 0,
                max: 0
            }
        }, this.visualElement = t
    }
    start(t, {
        snapToCursor: e = !1
    } = {}) {
        const {
            presenceContext: n
        } = this.visualElement;
        if (n && !1 === n.isPresent) return;
        const {
            dragSnapToOrigin: i
        } = this.getProps();
        this.panSession = new $r(t, {
            onSessionStart: t => {
                const {
                    dragSnapToOrigin: n
                } = this.getProps();
                n ? this.pauseAnimation() : this.stopAnimation(), e && this.snapToCursor(yr(t).point)
            },
            onStart: (t, e) => {
                const {
                    drag: n,
                    dragPropagation: i,
                    onDragStart: s
                } = this.getProps();
                if (n && !i && (this.openDragLock && this.openDragLock(), this.openDragLock = "x" === (o = n) || "y" === o ? ms[o] ? null : (ms[o] = !0, () => {
                        ms[o] = !1
                    }) : ms.x || ms.y ? null : (ms.x = ms.y = !0, () => {
                        ms.x = ms.y = !1
                    }), !this.openDragLock)) return;
                var o;
                this.isDragging = !0, this.currentDirection = null, this.resolveConstraints(), this.visualElement.projection && (this.visualElement.projection.isAnimationBlocked = !0, this.visualElement.projection.target = void 0), Sr(t => {
                    let e = this.getAxisMotionValue(t).get() || 0;
                    if ($e.test(e)) {
                        const {
                            projection: n
                        } = this.visualElement;
                        if (n && n.layout) {
                            const i = n.layout.layoutBox[t];
                            if (i) {
                                e = xr(i) * (parseFloat(e) / 100)
                            }
                        }
                    }
                    this.originPoint[t] = e
                }), s && xe.postRender(() => s(t, e)), $o(this.visualElement, "transform");
                const {
                    animationState: r
                } = this.visualElement;
                r && r.setActive("whileDrag", !0)
            },
            onMove: (t, e) => {
                const {
                    dragPropagation: n,
                    dragDirectionLock: i,
                    onDirectionLock: s,
                    onDrag: o
                } = this.getProps();
                if (!n && !this.openDragLock) return;
                const {
                    offset: r
                } = e;
                if (i && null === this.currentDirection) return this.currentDirection = function(t, e = 10) {
                    let n = null;
                    Math.abs(t.y) > e ? n = "y" : Math.abs(t.x) > e && (n = "x");
                    return n
                }(r), void(null !== this.currentDirection && s && s(this.currentDirection));
                this.updateAxis("x", e.point, r), this.updateAxis("y", e.point, r), this.visualElement.render(), o && o(t, e)
            },
            onSessionEnd: (t, e) => this.stop(t, e),
            resumeAnimation: () => Sr(t => {
                var e;
                return "paused" === this.getAnimationState(t) && (null == (e = this.getAxisMotionValue(t).animation) ? void 0 : e.play())
            })
        }, {
            transformPagePoint: this.visualElement.getTransformPagePoint(),
            dragSnapToOrigin: i,
            contextWindow: Hr(this.visualElement)
        })
    }
    stop(t, e) {
        const n = this.isDragging;
        if (this.cancel(), !n) return;
        const {
            velocity: i
        } = e;
        this.startAnimation(i);
        const {
            onDragEnd: s
        } = this.getProps();
        s && xe.postRender(() => s(t, e))
    }
    cancel() {
        this.isDragging = !1;
        const {
            projection: t,
            animationState: e
        } = this.visualElement;
        t && (t.isAnimationBlocked = !1), this.panSession && this.panSession.end(), this.panSession = void 0;
        const {
            dragPropagation: n
        } = this.getProps();
        !n && this.openDragLock && (this.openDragLock(), this.openDragLock = null), e && e.setActive("whileDrag", !1)
    }
    updateAxis(t, e, n) {
        const {
            drag: i
        } = this.getProps();
        if (!n || !sa(t, i, this.currentDirection)) return;
        const s = this.getAxisMotionValue(t);
        let o = this.originPoint[t] + n[t];
        this.constraints && this.constraints[t] && (o = function(t, {
            min: e,
            max: n
        }, i) {
            return void 0 !== e && t < e ? t = i ? hn(e, t, i.min) : Math.max(t, e) : void 0 !== n && t > n && (t = i ? hn(n, t, i.max) : Math.min(t, n)), t
        }(o, this.constraints[t], this.elastic[t])), s.set(o)
    }
    resolveConstraints() {
        var t;
        const {
            dragConstraints: e,
            dragElastic: n
        } = this.getProps(), i = this.visualElement.projection && !this.visualElement.projection.layout ? this.visualElement.projection.measure(!1) : null == (t = this.visualElement.projection) ? void 0 : t.layout, s = this.constraints;
        e && no(e) ? this.constraints || (this.constraints = this.resolveRefConstraints()) : this.constraints = !(!e || !i) && function(t, {
            top: e,
            left: n,
            bottom: i,
            right: s
        }) {
            return {
                x: _r(t.x, n, s),
                y: _r(t.y, e, i)
            }
        }(i.layoutBox, e), this.elastic = function(t = Qr) {
            return !1 === t ? t = 0 : !0 === t && (t = Qr), {
                x: ta(t, "left", "right"),
                y: ta(t, "top", "bottom")
            }
        }(n), s !== this.constraints && i && this.constraints && !this.hasMutatedConstraints && Sr(t => {
            !1 !== this.constraints && this.getAxisMotionValue(t) && (this.constraints[t] = function(t, e) {
                const n = {};
                return void 0 !== e.min && (n.min = e.min - t.min), void 0 !== e.max && (n.max = e.max - t.min), n
            }(i.layoutBox[t], this.constraints[t]))
        })
    }
    resolveRefConstraints() {
        const {
            dragConstraints: t,
            onMeasureDragConstraints: e
        } = this.getProps();
        if (!t || !no(t)) return !1;
        const n = t.current,
            {
                projection: i
            } = this.visualElement;
        if (!i || !i.layout) return !1;
        const s = function(t, e, n) {
            const i = Nr(t, n),
                {
                    scroll: s
                } = e;
            return s && (Ir(i.x, s.offset.x), Ir(i.y, s.offset.y)), i
        }(n, i.root, this.visualElement.getTransformPagePoint());
        let o = function(t, e) {
            return {
                x: Jr(t.x, e.x),
                y: Jr(t.y, e.y)
            }
        }(i.layout.layoutBox, s);
        if (e) {
            const t = e(function({
                x: t,
                y: e
            }) {
                return {
                    top: e.min,
                    right: t.max,
                    bottom: e.max,
                    left: t.min
                }
            }(o));
            this.hasMutatedConstraints = !!t, t && (o = vr(t))
        }
        return o
    }
    startAnimation(t) {
        const {
            drag: e,
            dragMomentum: n,
            dragElastic: i,
            dragTransition: s,
            dragSnapToOrigin: o,
            onDragTransitionEnd: r
        } = this.getProps(), a = this.constraints || {}, l = Sr(r => {
            if (!sa(r, e, this.currentDirection)) return;
            let l = a && a[r] || {};
            o && (l = {
                min: 0,
                max: 0
            });
            const h = i ? 200 : 1e6,
                u = i ? 40 : 1e7,
                c = {
                    type: "inertia",
                    velocity: n ? t[r] : 0,
                    bounceStiffness: h,
                    bounceDamping: u,
                    timeConstant: 750,
                    restDelta: 1,
                    restSpeed: 10,
                    ...s,
                    ...l
                };
            return this.startAxisValueAnimation(r, c)
        });
        return Promise.all(l).then(r)
    }
    startAxisValueAnimation(t, e) {
        const n = this.getAxisMotionValue(t);
        return $o(this.visualElement, t), n.start(_o(t, n, 0, e, this.visualElement, !1))
    }
    stopAnimation() {
        Sr(t => this.getAxisMotionValue(t).stop())
    }
    pauseAnimation() {
        Sr(t => {
            var e;
            return null == (e = this.getAxisMotionValue(t).animation) ? void 0 : e.pause()
        })
    }
    getAnimationState(t) {
        var e;
        return null == (e = this.getAxisMotionValue(t).animation) ? void 0 : e.state
    }
    getAxisMotionValue(t) {
        const e = `_drag${t.toUpperCase()}`,
            n = this.visualElement.getProps(),
            i = n[e];
        return i || this.visualElement.getValue(t, (n.initial ? n.initial[t] : void 0) || 0)
    }
    snapToCursor(t) {
        Sr(e => {
            const {
                drag: n
            } = this.getProps();
            if (!sa(e, n, this.currentDirection)) return;
            const {
                projection: i
            } = this.visualElement, s = this.getAxisMotionValue(e);
            if (i && i.layout) {
                const {
                    min: n,
                    max: o
                } = i.layout.layoutBox[e];
                s.set(t[e] - hn(n, o, .5))
            }
        })
    }
    scalePositionWithinConstraints() {
        if (!this.visualElement.current) return;
        const {
            drag: t,
            dragConstraints: e
        } = this.getProps(), {
            projection: n
        } = this.visualElement;
        if (!no(e) || !n || !this.constraints) return;
        this.stopAnimation();
        const i = {
            x: 0,
            y: 0
        };
        Sr(t => {
            const e = this.getAxisMotionValue(t);
            if (e && !1 !== this.constraints) {
                const n = e.get();
                i[t] = function(t, e) {
                    let n = .5;
                    const i = xr(t),
                        s = xr(e);
                    return s > i ? n = Kt(e.min, e.max - i, t.min) : i > s && (n = Kt(t.min, t.max - s, e.min)), zt(0, 1, n)
                }({
                    min: n,
                    max: n
                }, this.constraints[t])
            }
        });
        const {
            transformTemplate: s
        } = this.visualElement.getProps();
        this.visualElement.current.style.transform = s ? s({}, "") : "none", n.root && n.root.updateScroll(), n.updateLayout(), this.resolveConstraints(), Sr(e => {
            if (!sa(e, t, null)) return;
            const n = this.getAxisMotionValue(e),
                {
                    min: s,
                    max: o
                } = this.constraints[e];
            n.set(hn(s, o, i[e]))
        })
    }
    addListeners() {
        if (!this.visualElement.current) return;
        na.set(this.visualElement, this);
        const t = gr(this.visualElement.current, "pointerdown", t => {
                const {
                    drag: e,
                    dragListener: n = !0
                } = this.getProps();
                e && n && this.start(t)
            }),
            e = () => {
                const {
                    dragConstraints: t
                } = this.getProps();
                no(t) && t.current && (this.constraints = this.resolveRefConstraints())
            },
            {
                projection: n
            } = this.visualElement,
            i = n.addEventListener("measure", e);
        n && !n.layout && (n.root && n.root.updateScroll(), n.updateLayout()), xe.read(e);
        const s = fr(window, "resize", () => this.scalePositionWithinConstraints()),
            o = n.addEventListener("didUpdate", ({
                delta: t,
                hasLayoutChanged: e
            }) => {
                this.isDragging && e && (Sr(e => {
                    const n = this.getAxisMotionValue(e);
                    n && (this.originPoint[e] += t[e].translate, n.set(n.get() + t[e].translate))
                }), this.visualElement.render())
            });
        return () => {
            s(), t(), i(), o && o()
        }
    }
    getProps() {
        const t = this.visualElement.getProps(),
            {
                drag: e = !1,
                dragDirectionLock: n = !1,
                dragPropagation: i = !1,
                dragConstraints: s = !1,
                dragElastic: o = Qr,
                dragMomentum: r = !0
            } = t;
        return {
            ...t,
            drag: e,
            dragDirectionLock: n,
            dragPropagation: i,
            dragConstraints: s,
            dragElastic: o,
            dragMomentum: r
        }
    }
}

function sa(t, e, n) {
    return !(!0 !== e && e !== t || null !== n && n !== t)
}
const oa = t => (e, n) => {
    t && xe.postRender(() => t(e, n))
};
const ra = {
    hasAnimatedSinceResize: !0,
    hasEverUpdated: !1
};

function aa(t, e) {
    return e.max === e.min ? 0 : t / (e.max - e.min) * 100
}
const la = {
        correct: (t, e) => {
            if (!e.target) return t;
            if ("string" == typeof t) {
                if (!qe.test(t)) return t;
                t = parseFloat(t)
            }
            return `${aa(t,e.target.x)}% ${aa(t,e.target.y)}%`
        }
    },
    ha = {
        correct: (t, {
            treeScale: e,
            projectionDelta: n
        }) => {
            const i = t,
                s = rn.parse(t);
            if (s.length > 5) return i;
            const o = rn.createTransformer(t),
                r = "number" != typeof s[0] ? 1 : 0,
                a = n.x.scale * e.x,
                l = n.y.scale * e.y;
            s[0 + r] /= a, s[1 + r] /= l;
            const h = hn(a, l, .5);
            return "number" == typeof s[2 + r] && (s[2 + r] /= h), "number" == typeof s[3 + r] && (s[3 + r] /= h), o(s)
        }
    };
class ua extends t.Component {
    componentDidMount() {
        const {
            visualElement: t,
            layoutGroup: e,
            switchLayoutGroup: n,
            layoutId: i
        } = this.props, {
            projection: s
        } = t;
        ! function(t) {
            for (const e in t) co[e] = t[e], Ae(e) && (co[e].isCSSVariable = !0)
        }(da), s && (e.group && e.group.add(s), n && n.register && i && n.register(s), s.root.didUpdate(), s.addEventListener("animationComplete", () => {
            this.safeToRemove()
        }), s.setOptions({
            ...s.options,
            onExitComplete: () => this.safeToRemove()
        })), ra.hasEverUpdated = !0
    }
    getSnapshotBeforeUpdate(t) {
        const {
            layoutDependency: e,
            visualElement: n,
            drag: i,
            isPresent: s
        } = this.props, {
            projection: o
        } = n;
        return o ? (o.isPresent = s, i || t.layoutDependency !== e || void 0 === e || t.isPresent !== s ? o.willUpdate() : this.safeToRemove(), t.isPresent !== s && (s ? o.promote() : o.relegate() || xe.postRender(() => {
            const t = o.getStack();
            t && t.members.length || this.safeToRemove()
        })), null) : null
    }
    componentDidUpdate() {
        const {
            projection: t
        } = this.props.visualElement;
        t && (t.root.didUpdate(), ps.postRender(() => {
            !t.currentAnimation && t.isLead() && this.safeToRemove()
        }))
    }
    componentWillUnmount() {
        const {
            visualElement: t,
            layoutGroup: e,
            switchLayoutGroup: n
        } = this.props, {
            projection: i
        } = t;
        i && (i.scheduleCheckAfterUnmount(), e && e.group && e.group.remove(i), n && n.deregister && n.deregister(i))
    }
    safeToRemove() {
        const {
            safeToRemove: t
        } = this.props;
        t && t()
    }
    render() {
        return null
    }
}

function ca(n) {
    const [i, s] = Ls(), o = t.useContext(jt);
    return e.jsx(ua, {
        ...n,
        layoutGroup: o,
        switchLayoutGroup: t.useContext(ro),
        isPresent: i,
        safeToRemove: s
    })
}
const da = {
    borderRadius: {
        ...la,
        applyTo: ["borderTopLeftRadius", "borderTopRightRadius", "borderBottomLeftRadius", "borderBottomRightRadius"]
    },
    borderTopLeftRadius: la,
    borderTopRightRadius: la,
    borderBottomLeftRadius: la,
    borderBottomRightRadius: la,
    boxShadow: ha
};
const pa = (t, e) => t.depth - e.depth;
class ma {
    constructor() {
        this.children = [], this.isDirty = !1
    }
    add(t) {
        Ot(this.children, t), this.isDirty = !0
    }
    remove(t) {
        It(this.children, t), this.isDirty = !0
    }
    forEach(t) {
        this.isDirty && this.children.sort(pa), this.isDirty = !1, this.children.forEach(t)
    }
}
const fa = ["TopLeft", "TopRight", "BottomLeft", "BottomRight"],
    ya = fa.length,
    ga = t => "string" == typeof t ? parseFloat(t) : t,
    va = t => "number" == typeof t || qe.test(t);

function xa(t, e) {
    return void 0 !== t[e] ? t[e] : t.borderRadius
}
const ka = Ma(0, .5, le),
    wa = Ma(.5, .95, qt);

function Ma(t, e, n) {
    return i => i < t ? 0 : i > e ? 1 : n(Kt(t, e, i))
}

function Ta(t, e) {
    t.min = e.min, t.max = e.max
}

function ba(t, e) {
    Ta(t.x, e.x), Ta(t.y, e.y)
}

function Pa(t, e) {
    t.translate = e.translate, t.scale = e.scale, t.originPoint = e.originPoint, t.origin = e.origin
}

function Sa(t, e, n, i, s) {
    return t = jr(t -= e, 1 / n, i), void 0 !== s && (t = jr(t, 1 / s, i)), t
}

function Aa(t, e, [n, i, s], o, r) {
    ! function(t, e = 0, n = 1, i = .5, s, o = t, r = t) {
        $e.test(e) && (e = parseFloat(e), e = hn(r.min, r.max, e / 100) - r.min);
        if ("number" != typeof e) return;
        let a = hn(o.min, o.max, i);
        t === o && (a -= e), t.min = Sa(t.min, e, n, a, s), t.max = Sa(t.max, e, n, a, s)
    }(t, e[n], e[i], e[s], e.scale, o, r)
}
const Va = ["x", "scaleX", "originX"],
    Ea = ["y", "scaleY", "originY"];

function Ca(t, e, n, i) {
    Aa(t.x, e, Va, n ? n.x : void 0, i ? i.x : void 0), Aa(t.y, e, Ea, n ? n.y : void 0, i ? i.y : void 0)
}

function Da(t) {
    return 0 === t.translate && 1 === t.scale
}

function ja(t) {
    return Da(t.x) && Da(t.y)
}

function Ra(t, e) {
    return t.min === e.min && t.max === e.max
}

function La(t, e) {
    return Math.round(t.min) === Math.round(e.min) && Math.round(t.max) === Math.round(e.max)
}

function Ba(t, e) {
    return La(t.x, e.x) && La(t.y, e.y)
}

function Fa(t) {
    return xr(t.x) / xr(t.y)
}

function Oa(t, e) {
    return t.translate === e.translate && t.scale === e.scale && t.originPoint === e.originPoint
}
class Ia {
    constructor() {
        this.members = []
    }
    add(t) {
        Ot(this.members, t), t.scheduleRender()
    }
    remove(t) {
        if (It(this.members, t), t === this.prevLead && (this.prevLead = void 0), t === this.lead) {
            const t = this.members[this.members.length - 1];
            t && this.promote(t)
        }
    }
    relegate(t) {
        const e = this.members.findIndex(e => t === e);
        if (0 === e) return !1;
        let n;
        for (let i = e; i >= 0; i--) {
            const t = this.members[i];
            if (!1 !== t.isPresent) {
                n = t;
                break
            }
        }
        return !!n && (this.promote(n), !0)
    }
    promote(t, e) {
        const n = this.lead;
        if (t !== n && (this.prevLead = n, this.lead = t, t.show(), n)) {
            n.instance && n.scheduleRender(), t.scheduleRender(), t.resumeFrom = n, e && (t.resumeFrom.preserveOpacity = !0), n.snapshot && (t.snapshot = n.snapshot, t.snapshot.latestValues = n.animationValues || n.latestValues), t.root && t.root.isUpdating && (t.isLayoutDirty = !0);
            const {
                crossfade: i
            } = t.options;
            !1 === i && n.hide()
        }
    }
    exitAnimationComplete() {
        this.members.forEach(t => {
            const {
                options: e,
                resumingFrom: n
            } = t;
            e.onExitComplete && e.onExitComplete(), n && n.options.onExitComplete && n.options.onExitComplete()
        })
    }
    scheduleRender() {
        this.members.forEach(t => {
            t.instance && t.scheduleRender(!1)
        })
    }
    removeLeadSnapshot() {
        this.lead && this.lead.snapshot && (this.lead.snapshot = void 0)
    }
}
const za = ["", "X", "Y", "Z"],
    Ua = {
        visibility: "hidden"
    };
let Na = 0;

function Ha(t, e, n, i) {
    const {
        latestValues: s
    } = e;
    s[t] && (n[t] = s[t], e.setStaticValue(t, 0), i && (i[t] = 0))
}

function Wa(t) {
    if (t.hasCheckedOptimisedAppear = !0, t.root === t) return;
    const {
        visualElement: e
    } = t.options;
    if (!e) return;
    const n = qo(e);
    if (window.MotionHasOptimisedAnimation(n, "transform")) {
        const {
            layout: e,
            layoutId: i
        } = t.options;
        window.MotionCancelOptimisedAnimation(n, "transform", xe, !(e || i))
    }
    const {
        parent: i
    } = t;
    i && !i.hasCheckedOptimisedAppear && Wa(i)
}

function $a({
    attachResizeListener: t,
    defaultParent: e,
    measureScroll: n,
    checkIsScrollRoot: i,
    resetTransform: s
}) {
    return class {
        constructor(t = {}, n = (null == e ? void 0 : e())) {
            this.id = Na++, this.animationId = 0, this.children = new Set, this.options = {}, this.isTreeAnimating = !1, this.isAnimationBlocked = !1, this.isLayoutDirty = !1, this.isProjectionDirty = !1, this.isSharedProjectionDirty = !1, this.isTransformDirty = !1, this.updateManuallyBlocked = !1, this.updateBlockedByResize = !1, this.isUpdating = !1, this.isSVG = !1, this.needsReset = !1, this.shouldResetTransform = !1, this.hasCheckedOptimisedAppear = !1, this.treeScale = {
                x: 1,
                y: 1
            }, this.eventHandlers = new Map, this.hasTreeAnimated = !1, this.updateScheduled = !1, this.scheduleUpdate = () => this.update(), this.projectionUpdateScheduled = !1, this.checkUpdateFailed = () => {
                this.isUpdating && (this.isUpdating = !1, this.clearAllSnapshots())
            }, this.updateProjection = () => {
                this.projectionUpdateScheduled = !1, this.nodes.forEach(Ya), this.nodes.forEach(tl), this.nodes.forEach(el), this.nodes.forEach(Ka)
            }, this.resolvedRelativeTargetAt = 0, this.hasProjected = !1, this.isVisible = !0, this.animationProgress = 0, this.sharedNodes = new Map, this.latestValues = t, this.root = n ? n.root || n : this, this.path = n ? [...n.path, n] : [], this.parent = n, this.depth = n ? n.depth + 1 : 0;
            for (let e = 0; e < this.path.length; e++) this.path[e].shouldResetTransform = !0;
            this.root === this && (this.nodes = new ma)
        }
        addEventListener(t, e) {
            return this.eventHandlers.has(t) || this.eventHandlers.set(t, new Zt), this.eventHandlers.get(t).add(e)
        }
        notifyListeners(t, ...e) {
            const n = this.eventHandlers.get(t);
            n && n.notify(...e)
        }
        hasListeners(t) {
            return this.eventHandlers.has(t)
        }
        mount(e) {
            if (this.instance) return;
            var n;
            this.isSVG = Ss(e) && !(Ss(n = e) && "svg" === n.tagName), this.instance = e;
            const {
                layoutId: i,
                layout: s,
                visualElement: o
            } = this.options;
            if (o && !o.current && o.mount(e), this.root.nodes.add(this), this.parent && this.parent.children.add(this), this.root.hasTreeAnimated && (s || i) && (this.isLayoutDirty = !0), t) {
                let n;
                const i = () => this.root.updateBlockedByResize = !1;
                t(e, () => {
                    this.root.updateBlockedByResize = !0, n && n(), n = function(t, e) {
                        const n = Pe.now(),
                            i = ({
                                timestamp: s
                            }) => {
                                const o = s - n;
                                o >= e && (ke(i), t(o - e))
                            };
                        return xe.setup(i, !0), () => ke(i)
                    }(i, 250), ra.hasAnimatedSinceResize && (ra.hasAnimatedSinceResize = !1, this.nodes.forEach(Qa))
                })
            }
            i && this.root.registerSharedNode(i, this), !1 !== this.options.animate && o && (i || s) && this.addEventListener("didUpdate", ({
                delta: t,
                hasLayoutChanged: e,
                hasRelativeLayoutChanged: n,
                layout: i
            }) => {
                if (this.isTreeAnimationBlocked()) return this.target = void 0, void(this.relativeTarget = void 0);
                const s = this.options.transition || o.getDefaultTransition() || al,
                    {
                        onLayoutAnimationStart: r,
                        onLayoutAnimationComplete: a
                    } = o.getProps(),
                    l = !this.targetLayout || !Ba(this.targetLayout, i),
                    h = !e && n;
                if (this.options.layoutRoot || this.resumeFrom || h || e && (l || !this.currentAnimation)) {
                    this.resumeFrom && (this.resumingFrom = this.resumeFrom, this.resumingFrom.resumingFrom = void 0);
                    const e = {
                        ...Yi(s, "layout"),
                        onPlay: r,
                        onComplete: a
                    };
                    (o.shouldReduceMotion || this.options.layoutRoot) && (e.delay = 0, e.type = !1), this.startAnimation(e), this.setAnimationOrigin(t, h)
                } else e || Qa(this), this.isLead() && this.options.onExitComplete && this.options.onExitComplete();
                this.targetLayout = i
            })
        }
        unmount() {
            this.options.layoutId && this.willUpdate(), this.root.nodes.remove(this);
            const t = this.getStack();
            t && t.remove(this), this.parent && this.parent.children.delete(this), this.instance = void 0, this.eventHandlers.clear(), ke(this.updateProjection)
        }
        blockUpdate() {
            this.updateManuallyBlocked = !0
        }
        unblockUpdate() {
            this.updateManuallyBlocked = !1
        }
        isUpdateBlocked() {
            return this.updateManuallyBlocked || this.updateBlockedByResize
        }
        isTreeAnimationBlocked() {
            return this.isAnimationBlocked || this.parent && this.parent.isTreeAnimationBlocked() || !1
        }
        startUpdate() {
            this.isUpdateBlocked() || (this.isUpdating = !0, this.nodes && this.nodes.forEach(nl), this.animationId++)
        }
        getTransformTemplate() {
            const {
                visualElement: t
            } = this.options;
            return t && t.getProps().transformTemplate
        }
        willUpdate(t = !0) {
            if (this.root.hasTreeAnimated = !0, this.root.isUpdateBlocked()) return void(this.options.onExitComplete && this.options.onExitComplete());
            if (window.MotionCancelOptimisedAnimation && !this.hasCheckedOptimisedAppear && Wa(this), !this.root.isUpdating && this.root.startUpdate(), this.isLayoutDirty) return;
            this.isLayoutDirty = !0;
            for (let s = 0; s < this.path.length; s++) {
                const t = this.path[s];
                t.shouldResetTransform = !0, t.updateScroll("snapshot"), t.options.layoutRoot && t.willUpdate(!1)
            }
            const {
                layoutId: e,
                layout: n
            } = this.options;
            if (void 0 === e && !n) return;
            const i = this.getTransformTemplate();
            this.prevTransformTemplateValue = i ? i(this.latestValues, "") : void 0, this.updateSnapshot(), t && this.notifyListeners("willUpdate")
        }
        update() {
            this.updateScheduled = !1;
            if (this.isUpdateBlocked()) return this.unblockUpdate(), this.clearAllSnapshots(), void this.nodes.forEach(Ga);
            this.isUpdating || this.nodes.forEach(_a), this.isUpdating = !1, this.nodes.forEach(Ja), this.nodes.forEach(qa), this.nodes.forEach(Xa), this.clearAllSnapshots();
            const t = Pe.now();
            we.delta = zt(0, 1e3 / 60, t - we.timestamp), we.timestamp = t, we.isProcessing = !0, Me.update.process(we), Me.preRender.process(we), Me.render.process(we), we.isProcessing = !1
        }
        didUpdate() {
            this.updateScheduled || (this.updateScheduled = !0, ps.read(this.scheduleUpdate))
        }
        clearAllSnapshots() {
            this.nodes.forEach(Za), this.sharedNodes.forEach(il)
        }
        scheduleUpdateProjection() {
            this.projectionUpdateScheduled || (this.projectionUpdateScheduled = !0, xe.preRender(this.updateProjection, !1, !0))
        }
        scheduleCheckAfterUnmount() {
            xe.postRender(() => {
                this.isLayoutDirty ? this.root.didUpdate() : this.root.checkUpdateFailed()
            })
        }
        updateSnapshot() {
            !this.snapshot && this.instance && (this.snapshot = this.measure(), !this.snapshot || xr(this.snapshot.measuredBox.x) || xr(this.snapshot.measuredBox.y) || (this.snapshot = void 0))
        }
        updateLayout() {
            if (!this.instance) return;
            if (this.updateScroll(), !(this.options.alwaysMeasureLayout && this.isLead() || this.isLayoutDirty)) return;
            if (this.resumeFrom && !this.resumeFrom.instance)
                for (let n = 0; n < this.path.length; n++) {
                    this.path[n].updateScroll()
                }
            const t = this.layout;
            this.layout = this.measure(!1), this.layoutCorrected = {
                x: {
                    min: 0,
                    max: 0
                },
                y: {
                    min: 0,
                    max: 0
                }
            }, this.isLayoutDirty = !1, this.projectionDelta = void 0, this.notifyListeners("measure", this.layout.layoutBox);
            const {
                visualElement: e
            } = this.options;
            e && e.notify("LayoutMeasure", this.layout.layoutBox, t ? t.layoutBox : void 0)
        }
        updateScroll(t = "measure") {
            let e = Boolean(this.options.layoutScroll && this.instance);
            if (this.scroll && this.scroll.animationId === this.root.animationId && this.scroll.phase === t && (e = !1), e && this.instance) {
                const e = i(this.instance);
                this.scroll = {
                    animationId: this.root.animationId,
                    phase: t,
                    isRoot: e,
                    offset: n(this.instance),
                    wasRoot: this.scroll ? this.scroll.isRoot : e
                }
            }
        }
        resetTransform() {
            if (!s) return;
            const t = this.isLayoutDirty || this.shouldResetTransform || this.options.alwaysMeasureLayout,
                e = this.projectionDelta && !ja(this.projectionDelta),
                n = this.getTransformTemplate(),
                i = n ? n(this.latestValues, "") : void 0,
                o = i !== this.prevTransformTemplateValue;
            t && this.instance && (e || Er(this.latestValues) || o) && (s(this.instance, i), this.shouldResetTransform = !1, this.scheduleRender())
        }
        measure(t = !0) {
            const e = this.measurePageBox();
            let n = this.removeElementScroll(e);
            var i;
            return t && (n = this.removeTransform(n)), ul((i = n).x), ul(i.y), {
                animationId: this.root.animationId,
                measuredBox: e,
                layoutBox: n,
                latestValues: {},
                source: this.id
            }
        }
        measurePageBox() {
            var t;
            const {
                visualElement: e
            } = this.options;
            if (!e) return {
                x: {
                    min: 0,
                    max: 0
                },
                y: {
                    min: 0,
                    max: 0
                }
            };
            const n = e.measureViewportBox();
            if (!((null == (t = this.scroll) ? void 0 : t.wasRoot) || this.path.some(dl))) {
                const {
                    scroll: t
                } = this.root;
                t && (Ir(n.x, t.offset.x), Ir(n.y, t.offset.y))
            }
            return n
        }
        removeElementScroll(t) {
            var e;
            const n = {
                x: {
                    min: 0,
                    max: 0
                },
                y: {
                    min: 0,
                    max: 0
                }
            };
            if (ba(n, t), null == (e = this.scroll) ? void 0 : e.wasRoot) return n;
            for (let i = 0; i < this.path.length; i++) {
                const e = this.path[i],
                    {
                        scroll: s,
                        options: o
                    } = e;
                e !== this.root && s && o.layoutScroll && (s.wasRoot && ba(n, t), Ir(n.x, s.offset.x), Ir(n.y, s.offset.y))
            }
            return n
        }
        applyTransform(t, e = !1) {
            const n = {
                x: {
                    min: 0,
                    max: 0
                },
                y: {
                    min: 0,
                    max: 0
                }
            };
            ba(n, t);
            for (let i = 0; i < this.path.length; i++) {
                const t = this.path[i];
                !e && t.options.layoutScroll && t.scroll && t !== t.root && Ur(n, {
                    x: -t.scroll.offset.x,
                    y: -t.scroll.offset.y
                }), Er(t.latestValues) && Ur(n, t.latestValues)
            }
            return Er(this.latestValues) && Ur(n, this.latestValues), n
        }
        removeTransform(t) {
            const e = {
                x: {
                    min: 0,
                    max: 0
                },
                y: {
                    min: 0,
                    max: 0
                }
            };
            ba(e, t);
            for (let n = 0; n < this.path.length; n++) {
                const t = this.path[n];
                if (!t.instance) continue;
                if (!Er(t.latestValues)) continue;
                Vr(t.latestValues) && t.updateSnapshot();
                const i = Pr();
                ba(i, t.measurePageBox()), Ca(e, t.latestValues, t.snapshot ? t.snapshot.layoutBox : void 0, i)
            }
            return Er(this.latestValues) && Ca(e, this.latestValues), e
        }
        setTargetDelta(t) {
            this.targetDelta = t, this.root.scheduleUpdateProjection(), this.isProjectionDirty = !0
        }
        setOptions(t) {
            this.options = {
                ...this.options,
                ...t,
                crossfade: void 0 === t.crossfade || t.crossfade
            }
        }
        clearMeasurements() {
            this.scroll = void 0, this.layout = void 0, this.snapshot = void 0, this.prevTransformTemplateValue = void 0, this.targetDelta = void 0, this.target = void 0, this.isLayoutDirty = !1
        }
        forceRelativeParentToResolveTarget() {
            this.relativeParent && this.relativeParent.resolvedRelativeTargetAt !== we.timestamp && this.relativeParent.resolveTargetDelta(!0)
        }
        resolveTargetDelta(t = !1) {
            var e;
            const n = this.getLead();
            this.isProjectionDirty || (this.isProjectionDirty = n.isProjectionDirty), this.isTransformDirty || (this.isTransformDirty = n.isTransformDirty), this.isSharedProjectionDirty || (this.isSharedProjectionDirty = n.isSharedProjectionDirty);
            const i = Boolean(this.resumingFrom) || this !== n;
            if (!(t || i && this.isSharedProjectionDirty || this.isProjectionDirty || (null == (e = this.parent) ? void 0 : e.isProjectionDirty) || this.attemptToResolveRelativeTarget || this.root.updateBlockedByResize)) return;
            const {
                layout: s,
                layoutId: o
            } = this.options;
            if (this.layout && (s || o)) {
                if (this.resolvedRelativeTargetAt = we.timestamp, !this.targetDelta && !this.relativeTarget) {
                    const t = this.getClosestProjectingParent();
                    t && t.layout && 1 !== this.animationProgress ? (this.relativeParent = t, this.forceRelativeParentToResolveTarget(), this.relativeTarget = {
                        x: {
                            min: 0,
                            max: 0
                        },
                        y: {
                            min: 0,
                            max: 0
                        }
                    }, this.relativeTargetOrigin = {
                        x: {
                            min: 0,
                            max: 0
                        },
                        y: {
                            min: 0,
                            max: 0
                        }
                    }, br(this.relativeTargetOrigin, this.layout.layoutBox, t.layout.layoutBox), ba(this.relativeTarget, this.relativeTargetOrigin)) : this.relativeParent = this.relativeTarget = void 0
                }
                var r, a, l;
                if (this.relativeTarget || this.targetDelta)
                    if (this.target || (this.target = {
                            x: {
                                min: 0,
                                max: 0
                            },
                            y: {
                                min: 0,
                                max: 0
                            }
                        }, this.targetWithTransforms = {
                            x: {
                                min: 0,
                                max: 0
                            },
                            y: {
                                min: 0,
                                max: 0
                            }
                        }), this.relativeTarget && this.relativeTargetOrigin && this.relativeParent && this.relativeParent.target ? (this.forceRelativeParentToResolveTarget(), r = this.target, a = this.relativeTarget, l = this.relativeParent.target, Mr(r.x, a.x, l.x), Mr(r.y, a.y, l.y)) : this.targetDelta ? (Boolean(this.resumingFrom) ? this.target = this.applyTransform(this.layout.layoutBox) : ba(this.target, this.layout.layoutBox), Br(this.target, this.targetDelta)) : ba(this.target, this.layout.layoutBox), this.attemptToResolveRelativeTarget) {
                        this.attemptToResolveRelativeTarget = !1;
                        const t = this.getClosestProjectingParent();
                        t && Boolean(t.resumingFrom) === Boolean(this.resumingFrom) && !t.options.layoutScroll && t.target && 1 !== this.animationProgress ? (this.relativeParent = t, this.forceRelativeParentToResolveTarget(), this.relativeTarget = {
                            x: {
                                min: 0,
                                max: 0
                            },
                            y: {
                                min: 0,
                                max: 0
                            }
                        }, this.relativeTargetOrigin = {
                            x: {
                                min: 0,
                                max: 0
                            },
                            y: {
                                min: 0,
                                max: 0
                            }
                        }, br(this.relativeTargetOrigin, this.target, t.target), ba(this.relativeTarget, this.relativeTargetOrigin)) : this.relativeParent = this.relativeTarget = void 0
                    }
            }
        }
        getClosestProjectingParent() {
            if (this.parent && !Vr(this.parent.latestValues) && !Cr(this.parent.latestValues)) return this.parent.isProjecting() ? this.parent : this.parent.getClosestProjectingParent()
        }
        isProjecting() {
            return Boolean((this.relativeTarget || this.targetDelta || this.options.layoutRoot) && this.layout)
        }
        calcProjection() {
            var t;
            const e = this.getLead(),
                n = Boolean(this.resumingFrom) || this !== e;
            let i = !0;
            if ((this.isProjectionDirty || (null == (t = this.parent) ? void 0 : t.isProjectionDirty)) && (i = !1), n && (this.isSharedProjectionDirty || this.isTransformDirty) && (i = !1), this.resolvedRelativeTargetAt === we.timestamp && (i = !1), i) return;
            const {
                layout: s,
                layoutId: o
            } = this.options;
            if (this.isTreeAnimating = Boolean(this.parent && this.parent.isTreeAnimating || this.currentAnimation || this.pendingAnimation), this.isTreeAnimating || (this.targetDelta = this.relativeTarget = void 0), !this.layout || !s && !o) return;
            ba(this.layoutCorrected, this.layout.layoutBox);
            const r = this.treeScale.x,
                a = this.treeScale.y;
            ! function(t, e, n, i = !1) {
                const s = n.length;
                if (!s) return;
                let o, r;
                e.x = e.y = 1;
                for (let a = 0; a < s; a++) {
                    o = n[a], r = o.projectionDelta;
                    const {
                        visualElement: s
                    } = o.options;
                    s && s.props.style && "contents" === s.props.style.display || (i && o.options.layoutScroll && o.scroll && o !== o.root && Ur(t, {
                        x: -o.scroll.offset.x,
                        y: -o.scroll.offset.y
                    }), r && (e.x *= r.x.scale, e.y *= r.y.scale, Br(t, r)), i && Er(o.latestValues) && Ur(t, o.latestValues))
                }
                e.x < Or && e.x > Fr && (e.x = 1), e.y < Or && e.y > Fr && (e.y = 1)
            }(this.layoutCorrected, this.treeScale, this.path, n), !e.layout || e.target || 1 === this.treeScale.x && 1 === this.treeScale.y || (e.target = e.layout.layoutBox, e.targetWithTransforms = {
                x: {
                    min: 0,
                    max: 0
                },
                y: {
                    min: 0,
                    max: 0
                }
            });
            const {
                target: l
            } = e;
            l ? (this.projectionDelta && this.prevProjectionDelta ? (Pa(this.prevProjectionDelta.x, this.projectionDelta.x), Pa(this.prevProjectionDelta.y, this.projectionDelta.y)) : this.createProjectionDeltas(), wr(this.projectionDelta, this.layoutCorrected, l, this.latestValues), this.treeScale.x === r && this.treeScale.y === a && Oa(this.projectionDelta.x, this.prevProjectionDelta.x) && Oa(this.projectionDelta.y, this.prevProjectionDelta.y) || (this.hasProjected = !0, this.scheduleRender(), this.notifyListeners("projectionUpdate", l))) : this.prevProjectionDelta && (this.createProjectionDeltas(), this.scheduleRender())
        }
        hide() {
            this.isVisible = !1
        }
        show() {
            this.isVisible = !0
        }
        scheduleRender(t = !0) {
            var e;
            if (null == (e = this.options.visualElement) || e.scheduleRender(), t) {
                const t = this.getStack();
                t && t.scheduleRender()
            }
            this.resumingFrom && !this.resumingFrom.instance && (this.resumingFrom = void 0)
        }
        createProjectionDeltas() {
            this.prevProjectionDelta = {
                x: {
                    translate: 0,
                    scale: 1,
                    origin: 0,
                    originPoint: 0
                },
                y: {
                    translate: 0,
                    scale: 1,
                    origin: 0,
                    originPoint: 0
                }
            }, this.projectionDelta = {
                x: {
                    translate: 0,
                    scale: 1,
                    origin: 0,
                    originPoint: 0
                },
                y: {
                    translate: 0,
                    scale: 1,
                    origin: 0,
                    originPoint: 0
                }
            }, this.projectionDeltaWithTransform = {
                x: {
                    translate: 0,
                    scale: 1,
                    origin: 0,
                    originPoint: 0
                },
                y: {
                    translate: 0,
                    scale: 1,
                    origin: 0,
                    originPoint: 0
                }
            }
        }
        setAnimationOrigin(t, e = !1) {
            const n = this.snapshot,
                i = n ? n.latestValues : {},
                s = {
                    ...this.latestValues
                },
                o = {
                    x: {
                        translate: 0,
                        scale: 1,
                        origin: 0,
                        originPoint: 0
                    },
                    y: {
                        translate: 0,
                        scale: 1,
                        origin: 0,
                        originPoint: 0
                    }
                };
            this.relativeParent && this.relativeParent.options.layoutRoot || (this.relativeTarget = this.relativeTargetOrigin = void 0), this.attemptToResolveRelativeTarget = !e;
            const r = {
                    x: {
                        min: 0,
                        max: 0
                    },
                    y: {
                        min: 0,
                        max: 0
                    }
                },
                a = (n ? n.source : void 0) !== (this.layout ? this.layout.source : void 0),
                l = this.getStack(),
                h = !l || l.members.length <= 1,
                u = Boolean(a && !h && !0 === this.options.crossfade && !this.path.some(rl));
            let c;
            this.animationProgress = 0, this.mixTargetDelta = e => {
                const n = e / 1e3;
                var l, d, p, m, f, y;
                sl(o.x, t.x, n), sl(o.y, t.y, n), this.setTargetDelta(o), this.relativeTarget && this.relativeTargetOrigin && this.layout && this.relativeParent && this.relativeParent.layout && (br(r, this.layout.layoutBox, this.relativeParent.layout.layoutBox), p = this.relativeTarget, m = this.relativeTargetOrigin, f = r, y = n, ol(p.x, m.x, f.x, y), ol(p.y, m.y, f.y, y), c && (l = this.relativeTarget, d = c, Ra(l.x, d.x) && Ra(l.y, d.y)) && (this.isProjectionDirty = !1), c || (c = {
                    x: {
                        min: 0,
                        max: 0
                    },
                    y: {
                        min: 0,
                        max: 0
                    }
                }), ba(c, this.relativeTarget)), a && (this.animationValues = s, function(t, e, n, i, s, o) {
                    s ? (t.opacity = hn(0, n.opacity ?? 1, ka(i)), t.opacityExit = hn(e.opacity ?? 1, 0, wa(i))) : o && (t.opacity = hn(e.opacity ?? 1, n.opacity ?? 1, i));
                    for (let r = 0; r < ya; r++) {
                        const s = `border${fa[r]}Radius`;
                        let o = xa(e, s),
                            a = xa(n, s);
                        void 0 === o && void 0 === a || (o || (o = 0), a || (a = 0), 0 === o || 0 === a || va(o) === va(a) ? (t[s] = Math.max(hn(ga(o), ga(a), i), 0), ($e.test(a) || $e.test(o)) && (t[s] += "%")) : t[s] = a)
                    }(e.rotate || n.rotate) && (t.rotate = hn(e.rotate || 0, n.rotate || 0, i))
                }(s, i, this.latestValues, n, u, h)), this.root.scheduleUpdateProjection(), this.scheduleRender(), this.animationProgress = n
            }, this.mixTargetDelta(this.options.layoutRoot ? 1e3 : 0)
        }
        startAnimation(t) {
            var e, n, i;
            this.notifyListeners("animationStart"), null == (e = this.currentAnimation) || e.stop(), null == (i = null == (n = this.resumingFrom) ? void 0 : n.currentAnimation) || i.stop(), this.pendingAnimation && (ke(this.pendingAnimation), this.pendingAnimation = void 0), this.pendingAnimation = xe.update(() => {
                ra.hasAnimatedSinceResize = !0, this.motionValue || (this.motionValue = ds(0)), this.currentAnimation = function(t, e, n) {
                    const i = As(t) ? t : ds(t);
                    return i.start(_o("", i, e, n)), i.animation
                }(this.motionValue, [0, 1e3], {
                    ...t,
                    velocity: 0,
                    isSync: !0,
                    onUpdate: e => {
                        this.mixTargetDelta(e), t.onUpdate && t.onUpdate(e)
                    },
                    onStop: () => {},
                    onComplete: () => {
                        t.onComplete && t.onComplete(), this.completeAnimation()
                    }
                }), this.resumingFrom && (this.resumingFrom.currentAnimation = this.currentAnimation), this.pendingAnimation = void 0
            })
        }
        completeAnimation() {
            this.resumingFrom && (this.resumingFrom.currentAnimation = void 0, this.resumingFrom.preserveOpacity = void 0);
            const t = this.getStack();
            t && t.exitAnimationComplete(), this.resumingFrom = this.currentAnimation = this.animationValues = void 0, this.notifyListeners("animationComplete")
        }
        finishAnimation() {
            this.currentAnimation && (this.mixTargetDelta && this.mixTargetDelta(1e3), this.currentAnimation.stop()), this.completeAnimation()
        }
        applyTransformsToTarget() {
            const t = this.getLead();
            let {
                targetWithTransforms: e,
                target: n,
                layout: i,
                latestValues: s
            } = t;
            if (e && n && i) {
                if (this !== t && this.layout && i && cl(this.options.animationType, this.layout.layoutBox, i.layoutBox)) {
                    n = this.target || {
                        x: {
                            min: 0,
                            max: 0
                        },
                        y: {
                            min: 0,
                            max: 0
                        }
                    };
                    const e = xr(this.layout.layoutBox.x);
                    n.x.min = t.target.x.min, n.x.max = n.x.min + e;
                    const i = xr(this.layout.layoutBox.y);
                    n.y.min = t.target.y.min, n.y.max = n.y.min + i
                }
                ba(e, n), Ur(e, s), wr(this.projectionDeltaWithTransform, this.layoutCorrected, e, s)
            }
        }
        registerSharedNode(t, e) {
            this.sharedNodes.has(t) || this.sharedNodes.set(t, new Ia);
            this.sharedNodes.get(t).add(e);
            const n = e.options.initialPromotionConfig;
            e.promote({
                transition: n ? n.transition : void 0,
                preserveFollowOpacity: n && n.shouldPreserveFollowOpacity ? n.shouldPreserveFollowOpacity(e) : void 0
            })
        }
        isLead() {
            const t = this.getStack();
            return !t || t.lead === this
        }
        getLead() {
            var t;
            const {
                layoutId: e
            } = this.options;
            return e && (null == (t = this.getStack()) ? void 0 : t.lead) || this
        }
        getPrevLead() {
            var t;
            const {
                layoutId: e
            } = this.options;
            return e ? null == (t = this.getStack()) ? void 0 : t.prevLead : void 0
        }
        getStack() {
            const {
                layoutId: t
            } = this.options;
            if (t) return this.root.sharedNodes.get(t)
        }
        promote({
            needsReset: t,
            transition: e,
            preserveFollowOpacity: n
        } = {}) {
            const i = this.getStack();
            i && i.promote(this, n), t && (this.projectionDelta = void 0, this.needsReset = !0), e && this.setOptions({
                transition: e
            })
        }
        relegate() {
            const t = this.getStack();
            return !!t && t.relegate(this)
        }
        resetSkewAndRotation() {
            const {
                visualElement: t
            } = this.options;
            if (!t) return;
            let e = !1;
            const {
                latestValues: n
            } = t;
            if ((n.z || n.rotate || n.rotateX || n.rotateY || n.rotateZ || n.skewX || n.skewY) && (e = !0), !e) return;
            const i = {};
            n.z && Ha("z", t, i, this.animationValues);
            for (let s = 0; s < za.length; s++) Ha(`rotate${za[s]}`, t, i, this.animationValues), Ha(`skew${za[s]}`, t, i, this.animationValues);
            t.render();
            for (const s in i) t.setStaticValue(s, i[s]), this.animationValues && (this.animationValues[s] = i[s]);
            t.scheduleRender()
        }
        getProjectionStyles(t) {
            if (!this.instance || this.isSVG) return;
            if (!this.isVisible) return Ua;
            const e = {
                    visibility: ""
                },
                n = this.getTransformTemplate();
            if (this.needsReset) return this.needsReset = !1, e.opacity = "", e.pointerEvents = jo(null == t ? void 0 : t.pointerEvents) || "", e.transform = n ? n(this.latestValues, "") : "none", e;
            const i = this.getLead();
            if (!this.projectionDelta || !this.layout || !i.target) {
                const e = {};
                return this.options.layoutId && (e.opacity = void 0 !== this.latestValues.opacity ? this.latestValues.opacity : 1, e.pointerEvents = jo(null == t ? void 0 : t.pointerEvents) || ""), this.hasProjected && !Er(this.latestValues) && (e.transform = n ? n({}, "") : "none", this.hasProjected = !1), e
            }
            const s = i.animationValues || i.latestValues;
            this.applyTransformsToTarget(), e.transform = function(t, e, n) {
                let i = "";
                const s = t.x.translate / e.x,
                    o = t.y.translate / e.y,
                    r = (null == n ? void 0 : n.z) || 0;
                if ((s || o || r) && (i = `translate3d(${s}px, ${o}px, ${r}px) `), 1 === e.x && 1 === e.y || (i += `scale(${1/e.x}, ${1/e.y}) `), n) {
                    const {
                        transformPerspective: t,
                        rotate: e,
                        rotateX: s,
                        rotateY: o,
                        skewX: r,
                        skewY: a
                    } = n;
                    t && (i = `perspective(${t}px) ${i}`), e && (i += `rotate(${e}deg) `), s && (i += `rotateX(${s}deg) `), o && (i += `rotateY(${o}deg) `), r && (i += `skewX(${r}deg) `), a && (i += `skewY(${a}deg) `)
                }
                const a = t.x.scale * e.x,
                    l = t.y.scale * e.y;
                return 1 === a && 1 === l || (i += `scale(${a}, ${l})`), i || "none"
            }(this.projectionDeltaWithTransform, this.treeScale, s), n && (e.transform = n(s, e.transform));
            const {
                x: o,
                y: r
            } = this.projectionDelta;
            e.transformOrigin = `${100*o.origin}% ${100*r.origin}% 0`, i.animationValues ? e.opacity = i === this ? s.opacity ?? this.latestValues.opacity ?? 1 : this.preserveOpacity ? this.latestValues.opacity : s.opacityExit : e.opacity = i === this ? void 0 !== s.opacity ? s.opacity : "" : void 0 !== s.opacityExit ? s.opacityExit : 0;
            for (const a in co) {
                if (void 0 === s[a]) continue;
                const {
                    correct: t,
                    applyTo: n,
                    isCSSVariable: o
                } = co[a], r = "none" === e.transform ? s[a] : t(s[a], i);
                if (n) {
                    const t = n.length;
                    for (let i = 0; i < t; i++) e[n[i]] = r
                } else o ? this.options.visualElement.renderState.vars[a] = r : e[a] = r
            }
            return this.options.layoutId && (e.pointerEvents = i === this ? jo(null == t ? void 0 : t.pointerEvents) || "" : "none"), e
        }
        clearSnapshot() {
            this.resumeFrom = this.snapshot = void 0
        }
        resetTree() {
            this.root.nodes.forEach(t => {
                var e;
                return null == (e = t.currentAnimation) ? void 0 : e.stop()
            }), this.root.nodes.forEach(Ga), this.root.sharedNodes.clear()
        }
    }
}

function qa(t) {
    t.updateLayout()
}

function Xa(t) {
    var e;
    const n = (null == (e = t.resumeFrom) ? void 0 : e.snapshot) || t.snapshot;
    if (t.isLead() && t.layout && n && t.hasListeners("didUpdate")) {
        const {
            layoutBox: e,
            measuredBox: i
        } = t.layout, {
            animationType: s
        } = t.options, o = n.source !== t.layout.source;
        "size" === s ? Sr(t => {
            const i = o ? n.measuredBox[t] : n.layoutBox[t],
                s = xr(i);
            i.min = e[t].min, i.max = i.min + s
        }) : cl(s, n.layoutBox, e) && Sr(i => {
            const s = o ? n.measuredBox[i] : n.layoutBox[i],
                r = xr(e[i]);
            s.max = s.min + r, t.relativeTarget && !t.currentAnimation && (t.isProjectionDirty = !0, t.relativeTarget[i].max = t.relativeTarget[i].min + r)
        });
        const r = {
            x: {
                translate: 0,
                scale: 1,
                origin: 0,
                originPoint: 0
            },
            y: {
                translate: 0,
                scale: 1,
                origin: 0,
                originPoint: 0
            }
        };
        wr(r, e, n.layoutBox);
        const a = {
            x: {
                translate: 0,
                scale: 1,
                origin: 0,
                originPoint: 0
            },
            y: {
                translate: 0,
                scale: 1,
                origin: 0,
                originPoint: 0
            }
        };
        o ? wr(a, t.applyTransform(i, !0), n.measuredBox) : wr(a, e, n.layoutBox);
        const l = !ja(r);
        let h = !1;
        if (!t.resumeFrom) {
            const i = t.getClosestProjectingParent();
            if (i && !i.resumeFrom) {
                const {
                    snapshot: s,
                    layout: o
                } = i;
                if (s && o) {
                    const r = {
                        x: {
                            min: 0,
                            max: 0
                        },
                        y: {
                            min: 0,
                            max: 0
                        }
                    };
                    br(r, n.layoutBox, s.layoutBox);
                    const a = {
                        x: {
                            min: 0,
                            max: 0
                        },
                        y: {
                            min: 0,
                            max: 0
                        }
                    };
                    br(a, e, o.layoutBox), Ba(r, a) || (h = !0), i.options.layoutRoot && (t.relativeTarget = a, t.relativeTargetOrigin = r, t.relativeParent = i)
                }
            }
        }
        t.notifyListeners("didUpdate", {
            layout: e,
            snapshot: n,
            delta: a,
            layoutDelta: r,
            hasLayoutChanged: l,
            hasRelativeLayoutChanged: h
        })
    } else if (t.isLead()) {
        const {
            onExitComplete: e
        } = t.options;
        e && e()
    }
    t.options.transition = void 0
}

function Ya(t) {
    t.parent && (t.isProjecting() || (t.isProjectionDirty = t.parent.isProjectionDirty), t.isSharedProjectionDirty || (t.isSharedProjectionDirty = Boolean(t.isProjectionDirty || t.parent.isProjectionDirty || t.parent.isSharedProjectionDirty)), t.isTransformDirty || (t.isTransformDirty = t.parent.isTransformDirty))
}

function Ka(t) {
    t.isProjectionDirty = t.isSharedProjectionDirty = t.isTransformDirty = !1
}

function Za(t) {
    t.clearSnapshot()
}

function Ga(t) {
    t.clearMeasurements()
}

function _a(t) {
    t.isLayoutDirty = !1
}

function Ja(t) {
    const {
        visualElement: e
    } = t.options;
    e && e.getProps().onBeforeLayoutMeasure && e.notify("BeforeLayoutMeasure"), t.resetTransform()
}

function Qa(t) {
    t.finishAnimation(), t.targetDelta = t.relativeTarget = t.target = void 0, t.isProjectionDirty = !0
}

function tl(t) {
    t.resolveTargetDelta()
}

function el(t) {
    t.calcProjection()
}

function nl(t) {
    t.resetSkewAndRotation()
}

function il(t) {
    t.removeLeadSnapshot()
}

function sl(t, e, n) {
    t.translate = hn(e.translate, 0, n), t.scale = hn(e.scale, 1, n), t.origin = e.origin, t.originPoint = e.originPoint
}

function ol(t, e, n, i) {
    t.min = hn(e.min, n.min, i), t.max = hn(e.max, n.max, i)
}

function rl(t) {
    return t.animationValues && void 0 !== t.animationValues.opacityExit
}
const al = {
        duration: .45,
        ease: [.4, 0, .1, 1]
    },
    ll = t => "undefined" != typeof navigator && navigator.userAgent && navigator.userAgent.toLowerCase().includes(t),
    hl = ll("applewebkit/") && !ll("chrome/") ? Math.round : qt;

function ul(t) {
    t.min = hl(t.min), t.max = hl(t.max)
}

function cl(t, e, n) {
    return "position" === t || "preserve-aspect" === t && (i = Fa(e), s = Fa(n), o = .2, !(Math.abs(i - s) <= o));
    var i, s, o
}

function dl(t) {
    var e;
    return t !== t.root && (null == (e = t.scroll) ? void 0 : e.wasRoot)
}
const pl = $a({
        attachResizeListener: (t, e) => fr(t, "resize", e),
        measureScroll: () => ({
            x: document.documentElement.scrollLeft || document.body.scrollLeft,
            y: document.documentElement.scrollTop || document.body.scrollTop
        }),
        checkIsScrollRoot: () => !0
    }),
    ml = {
        current: void 0
    },
    fl = $a({
        measureScroll: t => ({
            x: t.scrollLeft,
            y: t.scrollTop
        }),
        defaultParent: () => {
            if (!ml.current) {
                const t = new pl({});
                t.mount(window), t.setOptions({
                    layoutScroll: !0
                }), ml.current = t
            }
            return ml.current
        },
        resetTransform: (t, e) => {
            t.style.transform = void 0 !== e ? e : "none"
        },
        checkIsScrollRoot: t => Boolean("fixed" === window.getComputedStyle(t).position)
    }),
    yl = {
        pan: {
            Feature: class extends dr {
                constructor() {
                    super(...arguments), this.removePointerDownListener = qt
                }
                onPointerDown(t) {
                    this.session = new $r(t, this.createPanHandlers(), {
                        transformPagePoint: this.node.getTransformPagePoint(),
                        contextWindow: Hr(this.node)
                    })
                }
                createPanHandlers() {
                    const {
                        onPanSessionStart: t,
                        onPanStart: e,
                        onPan: n,
                        onPanEnd: i
                    } = this.node.getProps();
                    return {
                        onSessionStart: oa(t),
                        onStart: oa(e),
                        onMove: n,
                        onEnd: (t, e) => {
                            delete this.session, i && xe.postRender(() => i(t, e))
                        }
                    }
                }
                mount() {
                    this.removePointerDownListener = gr(this.node.current, "pointerdown", t => this.onPointerDown(t))
                }
                update() {
                    this.session && this.session.updateHandlers(this.createPanHandlers())
                }
                unmount() {
                    this.removePointerDownListener(), this.session && this.session.end()
                }
            }
        },
        drag: {
            Feature: class extends dr {
                constructor(t) {
                    super(t), this.removeGroupControls = qt, this.removeListeners = qt, this.controls = new ia(t)
                }
                mount() {
                    const {
                        dragControls: t
                    } = this.node.getProps();
                    t && (this.removeGroupControls = t.subscribe(this.controls)), this.removeListeners = this.controls.addListeners() || qt
                }
                unmount() {
                    this.removeGroupControls(), this.removeListeners()
                }
            },
            ProjectionNode: fl,
            MeasureLayout: ca
        }
    };

function gl(t, e, n) {
    const {
        props: i
    } = t;
    t.animationState && i.whileHover && t.animationState.setActive("whileHover", "Start" === n);
    const s = i["onHover" + n];
    s && xe.postRender(() => s(e, yr(e)))
}

function vl(t, e, n) {
    const {
        props: i
    } = t;
    if (t.current instanceof HTMLButtonElement && t.current.disabled) return;
    t.animationState && i.whileTap && t.animationState.setActive("whileTap", "Start" === n);
    const s = i["onTap" + ("End" === n ? "" : n)];
    s && xe.postRender(() => s(e, yr(e)))
}
const xl = new WeakMap,
    kl = new WeakMap,
    wl = t => {
        const e = xl.get(t.target);
        e && e(t)
    },
    Ml = t => {
        t.forEach(wl)
    };

function Tl(t, e, n) {
    const i = function({
        root: t,
        ...e
    }) {
        const n = t || document;
        kl.has(n) || kl.set(n, {});
        const i = kl.get(n),
            s = JSON.stringify(e);
        return i[s] || (i[s] = new IntersectionObserver(Ml, {
            root: t,
            ...e
        })), i[s]
    }(e);
    return xl.set(t, n), i.observe(t), () => {
        xl.delete(t), i.unobserve(t)
    }
}
const bl = {
    some: 0,
    all: 1
};
const Pl = {
        inView: {
            Feature: class extends dr {
                constructor() {
                    super(...arguments), this.hasEnteredView = !1, this.isInView = !1
                }
                startObserver() {
                    this.unmount();
                    const {
                        viewport: t = {}
                    } = this.node.getProps(), {
                        root: e,
                        margin: n,
                        amount: i = "some",
                        once: s
                    } = t, o = {
                        root: e ? e.current : void 0,
                        rootMargin: n,
                        threshold: "number" == typeof i ? i : bl[i]
                    };
                    return Tl(this.node.current, o, t => {
                        const {
                            isIntersecting: e
                        } = t;
                        if (this.isInView === e) return;
                        if (this.isInView = e, s && !e && this.hasEnteredView) return;
                        e && (this.hasEnteredView = !0), this.node.animationState && this.node.animationState.setActive("whileInView", e);
                        const {
                            onViewportEnter: n,
                            onViewportLeave: i
                        } = this.node.getProps(), o = e ? n : i;
                        o && o(t)
                    })
                }
                mount() {
                    this.startObserver()
                }
                update() {
                    if ("undefined" == typeof IntersectionObserver) return;
                    const {
                        props: t,
                        prevProps: e
                    } = this.node;
                    ["amount", "margin", "root"].some(function({
                        viewport: t = {}
                    }, {
                        viewport: e = {}
                    } = {}) {
                        return n => t[n] !== e[n]
                    }(t, e)) && this.startObserver()
                }
                unmount() {}
            }
        },
        tap: {
            Feature: class extends dr {
                mount() {
                    const {
                        current: t
                    } = this.node;
                    t && (this.unmount = Ps(t, (t, e) => (vl(this.node, e, "Start"), (t, {
                        success: e
                    }) => vl(this.node, t, e ? "End" : "Cancel")), {
                        useGlobalTarget: this.node.props.globalTapTarget
                    }))
                }
                unmount() {}
            }
        },
        focus: {
            Feature: class extends dr {
                constructor() {
                    super(...arguments), this.isActive = !1
                }
                onFocus() {
                    let t = !1;
                    try {
                        t = this.node.current.matches(":focus-visible")
                    } catch (e) {
                        t = !0
                    }
                    t && this.node.animationState && (this.node.animationState.setActive("whileFocus", !0), this.isActive = !0)
                }
                onBlur() {
                    this.isActive && this.node.animationState && (this.node.animationState.setActive("whileFocus", !1), this.isActive = !1)
                }
                mount() {
                    this.unmount = Yt(fr(this.node.current, "focus", () => this.onFocus()), fr(this.node.current, "blur", () => this.onBlur()))
                }
                unmount() {}
            }
        },
        hover: {
            Feature: class extends dr {
                mount() {
                    const {
                        current: t
                    } = this.node;
                    t && (this.unmount = function(t, e, n = {}) {
                        const [i, s, o] = ys(t, n), r = t => {
                            if (!gs(t)) return;
                            const {
                                target: n
                            } = t, i = e(n, t);
                            if ("function" != typeof i || !n) return;
                            const o = t => {
                                gs(t) && (i(t), n.removeEventListener("pointerleave", o))
                            };
                            n.addEventListener("pointerleave", o, s)
                        };
                        return i.forEach(t => {
                            t.addEventListener("pointerenter", r, s)
                        }), o
                    }(t, (t, e) => (gl(this.node, e, "Start"), t => gl(this.node, t, "End"))))
                }
                unmount() {}
            }
        }
    },
    Sl = {
        layout: {
            ProjectionNode: fl,
            MeasureLayout: ca
        }
    },
    Al = {
        current: null
    },
    Vl = {
        current: !1
    };
const El = new WeakMap;
const Cl = ["AnimationStart", "AnimationComplete", "Update", "BeforeLayoutMeasure", "LayoutMeasure", "LayoutAnimationStart", "LayoutAnimationComplete"];
class Dl {
    scrapeMotionValuesFromProps(t, e, n) {
        return {}
    }
    constructor({
        parent: t,
        props: e,
        presenceContext: n,
        reducedMotionConfig: i,
        blockInitialAnimation: s,
        visualState: o
    }, r = {}) {
        this.current = null, this.children = new Set, this.isVariantNode = !1, this.isControllingVariants = !1, this.shouldReduceMotion = null, this.values = new Map, this.KeyframeResolver = Si, this.features = {}, this.valueSubscriptions = new Map, this.prevMotionValues = {}, this.events = {}, this.propEventSubscriptions = {}, this.notifyUpdate = () => this.notify("Update", this.latestValues), this.render = () => {
            this.current && (this.triggerBuild(), this.renderInstance(this.current, this.renderState, this.props.style, this.projection))
        }, this.renderScheduledAt = 0, this.scheduleRender = () => {
            const t = Pe.now();
            this.renderScheduledAt < t && (this.renderScheduledAt = t, xe.render(this.render, !1, !0))
        };
        const {
            latestValues: a,
            renderState: l
        } = o;
        this.latestValues = a, this.baseTarget = {
            ...a
        }, this.initialValues = e.initial ? {
            ...a
        } : {}, this.renderState = l, this.parent = t, this.props = e, this.presenceContext = n, this.depth = t ? t.depth + 1 : 0, this.reducedMotionConfig = i, this.options = r, this.blockInitialAnimation = Boolean(s), this.isControllingVariants = _s(e), this.isVariantNode = Js(e), this.isVariantNode && (this.variantChildren = new Set), this.manuallyAnimateOnMount = Boolean(t && t.current);
        const {
            willChange: h,
            ...u
        } = this.scrapeMotionValuesFromProps(e, {}, this);
        for (const c in u) {
            const t = u[c];
            void 0 !== a[c] && As(t) && t.set(a[c], !1)
        }
    }
    mount(t) {
        this.current = t, El.set(t, this), this.projection && !this.projection.instance && this.projection.mount(t), this.parent && this.isVariantNode && !this.isControllingVariants && (this.removeFromVariantTree = this.parent.addVariantChild(this)), this.values.forEach((t, e) => this.bindToMotionValue(e, t)), Vl.current || function() {
            if (Vl.current = !0, Lt)
                if (window.matchMedia) {
                    const t = window.matchMedia("(prefers-reduced-motion)"),
                        e = () => Al.current = t.matches;
                    t.addListener(e), e()
                } else Al.current = !1
        }(), this.shouldReduceMotion = "never" !== this.reducedMotionConfig && ("always" === this.reducedMotionConfig || Al.current), this.parent && this.parent.children.add(this), this.update(this.props, this.presenceContext)
    }
    unmount() {
        this.projection && this.projection.unmount(), ke(this.notifyUpdate), ke(this.render), this.valueSubscriptions.forEach(t => t()), this.valueSubscriptions.clear(), this.removeFromVariantTree && this.removeFromVariantTree(), this.parent && this.parent.children.delete(this);
        for (const t in this.events) this.events[t].clear();
        for (const t in this.features) {
            const e = this.features[t];
            e && (e.unmount(), e.isMounted = !1)
        }
        this.current = null
    }
    bindToMotionValue(t, e) {
        this.valueSubscriptions.has(t) && this.valueSubscriptions.get(t)();
        const n = fi.has(t);
        n && this.onBindTransform && this.onBindTransform();
        const i = e.on("change", e => {
                this.latestValues[t] = e, this.props.onUpdate && xe.preRender(this.notifyUpdate), n && this.projection && (this.projection.isTransformDirty = !0)
            }),
            s = e.on("renderRequest", this.scheduleRender);
        let o;
        window.MotionCheckAppearSync && (o = window.MotionCheckAppearSync(this, t, e)), this.valueSubscriptions.set(t, () => {
            i(), s(), o && o(), e.owner && e.stop()
        })
    }
    sortNodePosition(t) {
        return this.current && this.sortInstanceNodePosition && this.type === t.type ? this.sortInstanceNodePosition(this.current, t.current) : 0
    }
    updateFeatures() {
        let t = "animation";
        for (t in Us) {
            const e = Us[t];
            if (!e) continue;
            const {
                isEnabled: n,
                Feature: i
            } = e;
            if (!this.features[t] && i && n(this.props) && (this.features[t] = new i(this)), this.features[t]) {
                const e = this.features[t];
                e.isMounted ? e.update() : (e.mount(), e.isMounted = !0)
            }
        }
    }
    triggerBuild() {
        this.build(this.renderState, this.latestValues, this.props)
    }
    measureViewportBox() {
        return this.current ? this.measureInstanceViewportBox(this.current, this.props) : {
            x: {
                min: 0,
                max: 0
            },
            y: {
                min: 0,
                max: 0
            }
        }
    }
    getStaticValue(t) {
        return this.latestValues[t]
    }
    setStaticValue(t, e) {
        this.latestValues[t] = e
    }
    update(t, e) {
        (t.transformTemplate || this.props.transformTemplate) && this.scheduleRender(), this.prevProps = this.props, this.props = t, this.prevPresenceContext = this.presenceContext, this.presenceContext = e;
        for (let n = 0; n < Cl.length; n++) {
            const e = Cl[n];
            this.propEventSubscriptions[e] && (this.propEventSubscriptions[e](), delete this.propEventSubscriptions[e]);
            const i = t["on" + e];
            i && (this.propEventSubscriptions[e] = this.on(e, i))
        }
        this.prevMotionValues = function(t, e, n) {
            for (const i in e) {
                const s = e[i],
                    o = n[i];
                if (As(s)) t.addValue(i, s);
                else if (As(o)) t.addValue(i, ds(s, {
                    owner: t
                }));
                else if (o !== s)
                    if (t.hasValue(i)) {
                        const e = t.getValue(i);
                        !0 === e.liveStyle ? e.jump(s) : e.hasAnimated || e.set(s)
                    } else {
                        const e = t.getStaticValue(i);
                        t.addValue(i, ds(void 0 !== e ? e : s, {
                            owner: t
                        }))
                    }
            }
            for (const i in n) void 0 === e[i] && t.removeValue(i);
            return e
        }(this, this.scrapeMotionValuesFromProps(t, this.prevProps, this), this.prevMotionValues), this.handleChildMotionValue && this.handleChildMotionValue()
    }
    getProps() {
        return this.props
    }
    getVariant(t) {
        return this.props.variants ? this.props.variants[t] : void 0
    }
    getDefaultTransition() {
        return this.props.transition
    }
    getTransformPagePoint() {
        return this.props.transformPagePoint
    }
    getClosestVariantNode() {
        return this.isVariantNode ? this : this.parent ? this.parent.getClosestVariantNode() : void 0
    }
    addVariantChild(t) {
        const e = this.getClosestVariantNode();
        if (e) return e.variantChildren && e.variantChildren.add(t), () => e.variantChildren.delete(t)
    }
    addValue(t, e) {
        const n = this.values.get(t);
        e !== n && (n && this.removeValue(t), this.bindToMotionValue(t, e), this.values.set(t, e), this.latestValues[t] = e.get())
    }
    removeValue(t) {
        this.values.delete(t);
        const e = this.valueSubscriptions.get(t);
        e && (e(), this.valueSubscriptions.delete(t)), delete this.latestValues[t], this.removeValueFromRenderState(t, this.renderState)
    }
    hasValue(t) {
        return this.values.has(t)
    }
    getValue(t, e) {
        if (this.props.values && this.props.values[t]) return this.props.values[t];
        let n = this.values.get(t);
        return void 0 === n && void 0 !== e && (n = ds(null === e ? void 0 : e, {
            owner: this
        }), this.addValue(t, n)), n
    }
    readValue(t, e) {
        let n = void 0 === this.latestValues[t] && this.current ? this.getBaseTargetFromProps(this.props, t) ?? this.readValueFromInstance(this.current, t, this.options) : this.latestValues[t];
        var i;
        return null != n && ("string" == typeof n && (Nt(n) || Wt(n)) ? n = parseFloat(n) : (i = n, !Vs.find(Zi(i)) && rn.test(e) && (n = as(t, e))), this.setBaseTarget(t, As(n) ? n.get() : n)), As(n) ? n.get() : n
    }
    setBaseTarget(t, e) {
        this.baseTarget[t] = e
    }
    getBaseTarget(t) {
        var e;
        const {
            initial: n
        } = this.props;
        let i;
        if ("string" == typeof n || "object" == typeof n) {
            const s = Do(this.props, n, null == (e = this.presenceContext) ? void 0 : e.custom);
            s && (i = s[t])
        }
        if (n && void 0 !== i) return i;
        const s = this.getBaseTargetFromProps(this.props, t);
        return void 0 === s || As(s) ? void 0 !== this.initialValues[t] && void 0 === i ? void 0 : this.baseTarget[t] : s
    }
    on(t, e) {
        return this.events[t] || (this.events[t] = new Zt), this.events[t].add(e)
    }
    notify(t, ...e) {
        this.events[t] && this.events[t].notify(...e)
    }
}
class jl extends Dl {
    constructor() {
        super(...arguments), this.KeyframeResolver = hs
    }
    sortInstanceNodePosition(t, e) {
        return 2 & t.compareDocumentPosition(e) ? 1 : -1
    }
    getBaseTargetFromProps(t, e) {
        return t.style ? t.style[e] : void 0
    }
    removeValueFromRenderState(t, {
        vars: e,
        style: n
    }) {
        delete e[t], delete n[t]
    }
    handleChildMotionValue() {
        this.childSubscription && (this.childSubscription(), delete this.childSubscription);
        const {
            children: t
        } = this.props;
        As(t) && (this.childSubscription = t.on("change", t => {
            this.current && (this.current.textContent = `${t}`)
        }))
    }
}

function Rl(t, {
    style: e,
    vars: n
}, i, s) {
    Object.assign(t.style, e, s && s.getProjectionStyles(i));
    for (const o in n) t.style.setProperty(o, n[o])
}
class Ll extends jl {
    constructor() {
        super(...arguments), this.type = "html", this.renderInstance = Rl
    }
    readValueFromInstance(t, e) {
        var n, i;
        if (fi.has(e)) return (null == (n = this.projection) ? void 0 : n.isProjecting) ? ci(e) : ((t, e) => {
            const {
                transform: n = "none"
            } = getComputedStyle(t);
            return di(n, e)
        })(t, e);
        {
            const n = (i = t, window.getComputedStyle(i)),
                s = (Ae(e) ? n.getPropertyValue(e) : n[e]) || 0;
            return "string" == typeof s ? s.trim() : s
        }
    }
    measureInstanceViewportBox(t, {
        transformPagePoint: e
    }) {
        return Nr(t, e)
    }
    build(t, e, n) {
        yo(t, e, n.transformTemplate)
    }
    scrapeMotionValuesFromProps(t, e, n) {
        return Bo(t, e, n)
    }
}
const Bl = new Set(["baseFrequency", "diffuseConstant", "kernelMatrix", "kernelUnitLength", "keySplines", "keyTimes", "limitingConeAngle", "markerHeight", "markerWidth", "numOctaves", "targetX", "targetY", "surfaceScale", "specularConstant", "specularExponent", "stdDeviation", "tableValues", "viewBox", "gradientTransform", "pathLength", "startOffset", "textLength", "lengthAdjust"]);
class Fl extends jl {
    constructor() {
        super(...arguments), this.type = "svg", this.isSVGTag = !1, this.measureInstanceViewportBox = Pr
    }
    getBaseTargetFromProps(t, e) {
        return t[e]
    }
    readValueFromInstance(t, e) {
        if (fi.has(e)) {
            const t = rs(e);
            return t && t.default || 0
        }
        return e = Bl.has(e) ? e : so(e), t.getAttribute(e)
    }
    scrapeMotionValuesFromProps(t, e, n) {
        return Oo(t, e, n)
    }
    build(t, e, n) {
        To(t, e, this.isSVGTag, n.transformTemplate, n.style)
    }
    renderInstance(t, e, n, i) {
        ! function(t, e, n, i) {
            Rl(t, e, void 0, i);
            for (const s in e.attrs) t.setAttribute(Bl.has(s) ? s : so(s), e.attrs[s])
        }(t, e, 0, i)
    }
    mount(t) {
        this.isSVGTag = Po(t.tagName), super.mount(t)
    }
}
const Ol = qs(zo({
    ...mr,
    ...Pl,
    ...yl,
    ...Sl
}, (e, n) => Vo(e) ? new Fl(n) : new Ll(n, {
    allowProjection: e !== t.Fragment
})));
export {
    M as $, Os as A, Ct as B, x as C, S as D, Dt as E, j as F, L as G, H, z as I, c as J, B as K, N as L, J as M, kt as N, $ as O, st as P, at as Q, ht as R, pt as S, vt as T, wt as U, Z as V, At as W, Vt as X, ct as Y, Et as Z, A as _, q as a, T as a0, Pt as a1, m as a2, St as a3, U as a4, k as a5, W as a6, l as a7, K as a8, Mt as a9, _ as aa, p as ab, O as ac, Tt as ad, V as ae, mt as af, Y as ag, E as ah, C as ai, h as aj, F as ak, u as al, d as am, X as an, it as ao, I as ap, nt as b, b as c, y as d, g as e, v as f, f as g, Q as h, G as i, dt as j, yt as k, xt as l, Ol as m, lt as n, rt as o, ut as p, w as q, R as r, D as s, et as t, ot as u, P as v, bt as w, tt as x, ft as y, gt as z
};