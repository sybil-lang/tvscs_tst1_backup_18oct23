(function (d) {
    function n(c, a, b) {
        var e, f, g = a.options.chart.options3d, i = !1; b ? (i = a.inverted, b = a.plotWidth / 2, a = a.plotHeight / 2, e = g.depth / 2, f = y(g.depth, 1) * y(g.viewDistance, 0)) : (b = a.plotLeft + a.plotWidth / 2, a = a.plotTop + a.plotHeight / 2, e = g.depth / 2, f = y(g.depth, 1) * y(g.viewDistance, 0)); var j = [], h = b, k = a, v = e, p = f, b = x * (i ? g.beta : -g.beta), g = x * (i ? -g.alpha : g.alpha), q = l(b), s = m(b), t = l(g), u = m(g), w, B, r, n, o, z; d.each(c, function (a) {
            w = (i ? a.y : a.x) - h; B = (i ? a.x : a.y) - k; r = (a.z || 0) - v; n = s * w - q * r; o = -q * t * w - s * t * r + u * B; z = q * u * w + s * u * r + t * B; p > 0 &&
            p < Number.POSITIVE_INFINITY && (n *= p / (z + v + p), o *= p / (z + v + p)); n += h; o += k; z += v; j.push({ x: i ? o : n, y: i ? n : o, z: z })
        }); return j
    } function o(c) { return c !== void 0 && c !== null } function E(c) { var a = 0, b, e; for (b = 0; b < c.length; b++) e = (b + 1) % c.length, a += c[b].x * c[e].y - c[e].x * c[b].y; return a / 2 } function C(c) { var a = 0, b; for (b = 0; b < c.length; b++) a += c[b].z; return c.length ? a / c.length : 0 } function r(c, a, b, e, f, g, d, j) {
        var h = []; return g > f && g - f > q / 2 + 1.0E-4 ? (h = h.concat(r(c, a, b, e, f, f + q / 2, d, j)), h = h.concat(r(c, a, b, e, f + q / 2, g, d, j))) : g < f && f - g > q / 2 + 1.0E-4 ?
        (h = h.concat(r(c, a, b, e, f, f - q / 2, d, j)), h = h.concat(r(c, a, b, e, f - q / 2, g, d, j))) : (h = g - f, ["C", c + b * m(f) - b * A * h * l(f) + d, a + e * l(f) + e * A * h * m(f) + j, c + b * m(g) + b * A * h * l(g) + d, a + e * l(g) - e * A * h * m(g) + j, c + b * m(g) + d, a + e * l(g) + j])
    } function F(c) {
        if (this.chart.is3d()) {
            var a = this.chart.options.plotOptions.column.grouping; if (a !== void 0 && !a && this.group.zIndex !== void 0 && !this.zIndexSet) this.group.attr({ zIndex: this.group.zIndex * 10 }), this.zIndexSet = !0; var b = this.options, e = this.options.states; this.borderWidth = b.borderWidth = o(b.edgeWidth) ? b.edgeWidth :
            1; d.each(this.data, function (a) { if (a.y !== null) a = a.pointAttr, this.borderColor = d.pick(b.edgeColor, a[""].fill), a[""].stroke = this.borderColor, a.hover.stroke = d.pick(e.hover.edgeColor, this.borderColor), a.select.stroke = d.pick(e.select.edgeColor, this.borderColor) })
        } c.apply(this, [].slice.call(arguments, 1))
    } var q = Math.PI, x = q / 180, l = Math.sin, m = Math.cos, y = d.pick, G = Math.round; d.perspective = n; var A = 4 * (Math.sqrt(2) - 1) / 3 / (q / 2); d.SVGRenderer.prototype.toLinePath = function (c, a) {
        var b = []; d.each(c, function (a) {
            b.push("L",
            a.x, a.y)
        }); c.length && (b[0] = "M", a && b.push("Z")); return b
    }; d.SVGRenderer.prototype.cuboid = function (c) {
        var a = this.g(), c = this.cuboidPath(c); a.front = this.path(c[0]).attr({ zIndex: c[3], "stroke-linejoin": "round" }).add(a); a.top = this.path(c[1]).attr({ zIndex: c[4], "stroke-linejoin": "round" }).add(a); a.side = this.path(c[2]).attr({ zIndex: c[5], "stroke-linejoin": "round" }).add(a); a.fillSetter = function (a) {
            var c = d.Color(a).brighten(0.1).get(), f = d.Color(a).brighten(-0.1).get(); this.front.attr({ fill: a }); this.top.attr({ fill: c });
            this.side.attr({ fill: f }); this.color = a; return this
        }; a.opacitySetter = function (a) { this.front.attr({ opacity: a }); this.top.attr({ opacity: a }); this.side.attr({ opacity: a }); return this }; a.attr = function (a) { a.shapeArgs || o(a.x) ? (a = this.renderer.cuboidPath(a.shapeArgs || a), this.front.attr({ d: a[0], zIndex: a[3] }), this.top.attr({ d: a[1], zIndex: a[4] }), this.side.attr({ d: a[2], zIndex: a[5] })) : d.SVGElement.prototype.attr.call(this, a); return this }; a.animate = function (a, c, f) {
            o(a.x) && o(a.y) ? (a = this.renderer.cuboidPath(a), this.front.attr({ zIndex: a[3] }).animate({ d: a[0] },
            c, f), this.top.attr({ zIndex: a[4] }).animate({ d: a[1] }, c, f), this.side.attr({ zIndex: a[5] }).animate({ d: a[2] }, c, f)) : a.opacity ? (this.front.animate(a, c, f), this.top.animate(a, c, f), this.side.animate(a, c, f)) : d.SVGElement.prototype.animate.call(this, a, c, f); return this
        }; a.destroy = function () { this.front.destroy(); this.top.destroy(); this.side.destroy(); return null }; a.attr({ zIndex: -c[3] }); return a
    }; d.SVGRenderer.prototype.cuboidPath = function (c) {
        var a = c.x, b = c.y, e = c.z, f = c.height, g = c.width, i = c.depth, j = d.map, h = [{
            x: a, y: b,
            z: e
        }, { x: a + g, y: b, z: e }, { x: a + g, y: b + f, z: e }, { x: a, y: b + f, z: e }, { x: a, y: b + f, z: e + i }, { x: a + g, y: b + f, z: e + i }, { x: a + g, y: b, z: e + i }, { x: a, y: b, z: e + i }], h = n(h, d.charts[this.chartIndex], c.insidePlotArea), b = function (a, b) { a = j(a, function (a) { return h[a] }); b = j(b, function (a) { return h[a] }); return E(a) < 0 ? a : E(b) < 0 ? b : [] }, c = b([3, 2, 1, 0], [7, 6, 5, 4]), a = b([1, 6, 7, 0], [4, 5, 2, 3]), b = b([1, 2, 5, 6], [0, 7, 4, 3]); return [this.toLinePath(c, !0), this.toLinePath(a, !0), this.toLinePath(b, !0), C(c), C(a), C(b)]
    }; d.SVGRenderer.prototype.arc3d = function (c) {
        c.alpha *=
        x; c.beta *= x; var a = this.g(), b = this.arc3dPath(c), e = a.renderer, f = b.zTop * 100; a.shapeArgs = c; a.top = e.path(b.top).setRadialReference(c.center).attr({ zIndex: b.zTop }).add(a); a.side1 = e.path(b.side2).attr({ zIndex: b.zSide1 }); a.side2 = e.path(b.side1).attr({ zIndex: b.zSide2 }); a.inn = e.path(b.inn).attr({ zIndex: b.zInn }); a.out = e.path(b.out).attr({ zIndex: b.zOut }); a.fillSetter = function (a) {
            this.color = a; var b = d.Color(a).brighten(-0.1).get(); this.side1.attr({ fill: b }); this.side2.attr({ fill: b }); this.inn.attr({ fill: b }); this.out.attr({ fill: b });
            this.top.attr({ fill: a }); return this
        }; a.translateXSetter = function (a) { this.out.attr({ translateX: a }); this.inn.attr({ translateX: a }); this.side1.attr({ translateX: a }); this.side2.attr({ translateX: a }); this.top.attr({ translateX: a }) }; a.translateYSetter = function (a) { this.out.attr({ translateY: a }); this.inn.attr({ translateY: a }); this.side1.attr({ translateY: a }); this.side2.attr({ translateY: a }); this.top.attr({ translateY: a }) }; a.animate = function (a, b, c) {
            o(a.end) || o(a.start) ? (this._shapeArgs = this.shapeArgs, d.SVGElement.prototype.animate.call(this,
            { _args: a }, {
                duration: b, start: function () { var a = arguments[0].elem, b = a._shapeArgs; b.fill !== a.color && a.attr({ fill: b.fill }) }, step: function () {
                    var a = arguments[1], b = a.elem, c = b._shapeArgs, e = a.end, a = a.pos, c = d.merge(c, { x: c.x + (e.x - c.x) * a, y: c.y + (e.y - c.y) * a, r: c.r + (e.r - c.r) * a, innerR: c.innerR + (e.innerR - c.innerR) * a, start: c.start + (e.start - c.start) * a, end: c.end + (e.end - c.end) * a }), e = b.renderer.arc3dPath(c); b.shapeArgs = c; b.top.attr({ d: e.top, zIndex: e.zTop }); b.inn.attr({ d: e.inn, zIndex: e.zInn }); b.out.attr({ d: e.out, zIndex: e.zOut });
                    b.side1.attr({ d: e.side1, zIndex: e.zSide1 }); b.side2.attr({ d: e.side2, zIndex: e.zSide2 })
                }
            }, c)) : d.SVGElement.prototype.animate.call(this, a, b, c); return this
        }; a.destroy = function () { this.top.destroy(); this.out.destroy(); this.inn.destroy(); this.side1.destroy(); this.side2.destroy(); d.SVGElement.prototype.destroy.call(this) }; a.hide = function () { this.top.hide(); this.out.hide(); this.inn.hide(); this.side1.hide(); this.side2.hide() }; a.show = function () {
            this.top.show(); this.out.show(); this.inn.show(); this.side1.show();
            this.side2.show()
        }; a.zIndex = f; a.attr({ zIndex: f }); return a
    }; d.SVGRenderer.prototype.arc3dPath = function (c) {
        var a = c.x, b = c.y, e = c.start, d = c.end - 1.0E-5, g = c.r, i = c.innerR, j = c.depth, h = c.alpha, k = c.beta, v = m(e), p = l(e), c = m(d), n = l(d), s = g * m(k), t = g * m(h), u = i * m(k); i *= m(h); var w = j * l(k), o = j * l(h), j = ["M", a + s * v, b + t * p], j = j.concat(r(a, b, s, t, e, d, 0, 0)), j = j.concat(["L", a + u * c, b + i * n]), j = j.concat(r(a, b, u, i, d, e, 0, 0)), j = j.concat(["Z"]), k = k > 0 ? q / 2 : 0, h = h > 0 ? 0 : q / 2, k = e > -k ? e : d > -k ? -k : e, x = d < q - h ? d : e < q - h ? q - h : d, h = ["M", a + s * m(k), b + t * l(k)], h = h.concat(r(a,
        b, s, t, k, x, 0, 0)), h = h.concat(["L", a + s * m(x) + w, b + t * l(x) + o]), h = h.concat(r(a, b, s, t, x, k, w, o)), h = h.concat(["Z"]), k = ["M", a + u * v, b + i * p], k = k.concat(r(a, b, u, i, e, d, 0, 0)), k = k.concat(["L", a + u * m(d) + w, b + i * l(d) + o]), k = k.concat(r(a, b, u, i, d, e, w, o)), k = k.concat(["Z"]), v = ["M", a + s * v, b + t * p, "L", a + s * v + w, b + t * p + o, "L", a + u * v + w, b + i * p + o, "L", a + u * v, b + i * p, "Z"], a = ["M", a + s * c, b + t * n, "L", a + s * c + w, b + t * n + o, "L", a + u * c + w, b + i * n + o, "L", a + u * c, b + i * n, "Z"], b = l((e + d) / 2), e = l(e), d = l(d); return {
            top: j, zTop: g, out: h, zOut: Math.max(b, e, d) * g, inn: k, zInn: Math.max(b,
            e, d) * g, side1: v, zSide1: e * g * 0.99, side2: a, zSide2: d * g * 0.99
        }
    }; d.Chart.prototype.is3d = function () { return this.options.chart.options3d && this.options.chart.options3d.enabled }; d.wrap(d.Chart.prototype, "isInsidePlot", function (c) { return this.is3d() ? !0 : c.apply(this, [].slice.call(arguments, 1)) }); d.getOptions().chart.options3d = { enabled: !1, alpha: 0, beta: 0, depth: 100, viewDistance: 25, frame: { bottom: { size: 1, color: "rgba(255,255,255,0)" }, side: { size: 1, color: "rgba(255,255,255,0)" }, back: { size: 1, color: "rgba(255,255,255,0)" } } };
    d.wrap(d.Chart.prototype, "init", function (c) { var a = [].slice.call(arguments, 1), b; if (a[0].chart.options3d && a[0].chart.options3d.enabled) b = a[0].plotOptions || {}, b = b.pie || {}, b.borderColor = d.pick(b.borderColor, void 0); c.apply(this, a) }); d.wrap(d.Chart.prototype, "setChartSize", function (c) {
        c.apply(this, [].slice.call(arguments, 1)); if (this.is3d()) {
            var a = this.inverted, b = this.clipBox, d = this.margin; b[a ? "y" : "x"] = -(d[3] || 0); b[a ? "x" : "y"] = -(d[0] || 0); b[a ? "height" : "width"] = this.chartWidth + (d[3] || 0) + (d[1] || 0); b[a ? "width" :
            "height"] = this.chartHeight + (d[0] || 0) + (d[2] || 0)
        }
    }); d.wrap(d.Chart.prototype, "redraw", function (c) { if (this.is3d()) this.isDirtyBox = !0; c.apply(this, [].slice.call(arguments, 1)) }); d.wrap(d.Chart.prototype, "renderSeries", function (c) { var a = this.series.length; if (this.is3d()) for (; a--;) c = this.series[a], c.translate(), c.render(); else c.call(this) }); d.Chart.prototype.retrieveStacks = function (c) {
        var a = this.series, b = {}, e, f = 1; d.each(this.series, function (d) {
            e = c ? d.options.stack || 0 : a.length - 1 - d.index; b[e] ? b[e].series.push(d) :
            (b[e] = { series: [d], position: f }, f++)
        }); b.totalStacks = f + 1; return b
    }; d.wrap(d.Axis.prototype, "setOptions", function (c, a) { var b; c.call(this, a); if (this.chart.is3d()) b = this.options, b.tickWidth = d.pick(b.tickWidth, 0), b.gridLineWidth = d.pick(b.gridLineWidth, 1) }); d.wrap(d.Axis.prototype, "render", function (c) {
        c.apply(this, [].slice.call(arguments, 1)); if (this.chart.is3d()) {
            var a = this.chart, b = a.renderer, d = a.options.chart.options3d, f = d.frame, g = f.bottom, i = f.back, f = f.side, j = d.depth, h = this.height, k = this.width, l = this.left,
            p = this.top; if (!this.isZAxis) this.horiz ? (i = { x: l, y: p + (a.xAxis[0].opposite ? -g.size : h), z: 0, width: k, height: g.size, depth: j, insidePlotArea: !1 }, this.bottomFrame ? this.bottomFrame.animate(i) : this.bottomFrame = b.cuboid(i).attr({ fill: g.color, zIndex: a.yAxis[0].reversed && d.alpha > 0 ? 4 : -1 }).css({ stroke: g.color }).add()) : (d = { x: l + (a.yAxis[0].opposite ? 0 : -f.size), y: p + (a.xAxis[0].opposite ? -g.size : 0), z: j, width: k + f.size, height: h + g.size, depth: i.size, insidePlotArea: !1 }, this.backFrame ? this.backFrame.animate(d) : this.backFrame =
            b.cuboid(d).attr({ fill: i.color, zIndex: -3 }).css({ stroke: i.color }).add(), a = { x: l + (a.yAxis[0].opposite ? k : -f.size), y: p + (a.xAxis[0].opposite ? -g.size : 0), z: 0, width: f.size, height: h + g.size, depth: j, insidePlotArea: !1 }, this.sideFrame ? this.sideFrame.animate(a) : this.sideFrame = b.cuboid(a).attr({ fill: f.color, zIndex: -2 }).css({ stroke: f.color }).add())
        }
    }); d.wrap(d.Axis.prototype, "getPlotLinePath", function (c) {
        var a = c.apply(this, [].slice.call(arguments, 1)); if (!this.chart.is3d()) return a; if (a === null) return a; var b = this.chart.options.chart.options3d,
        b = this.isZAxis ? this.chart.plotWidth : b.depth, d = this.opposite; this.horiz && (d = !d); a = [this.swapZ({ x: a[1], y: a[2], z: d ? b : 0 }), this.swapZ({ x: a[1], y: a[2], z: b }), this.swapZ({ x: a[4], y: a[5], z: b }), this.swapZ({ x: a[4], y: a[5], z: d ? 0 : b })]; a = n(a, this.chart, !1); return a = this.chart.renderer.toLinePath(a, !1)
    }); d.wrap(d.Axis.prototype, "getLinePath", function (c) { return this.chart.is3d() ? [] : c.apply(this, [].slice.call(arguments, 1)) }); d.wrap(d.Axis.prototype, "getPlotBandPath", function (c) {
        if (this.chart.is3d()) {
            var a = arguments,
            b = a[1], a = this.getPlotLinePath(a[2]); (b = this.getPlotLinePath(b)) && a ? b.push("L", a[10], a[11], "L", a[7], a[8], "L", a[4], a[5], "L", a[1], a[2]) : b = null; return b
        } else return c.apply(this, [].slice.call(arguments, 1))
    }); d.wrap(d.Tick.prototype, "getMarkPath", function (c) { var a = c.apply(this, [].slice.call(arguments, 1)); if (!this.axis.chart.is3d()) return a; a = [this.axis.swapZ({ x: a[1], y: a[2], z: 0 }), this.axis.swapZ({ x: a[4], y: a[5], z: 0 })]; a = n(a, this.axis.chart, !1); return a = ["M", a[0].x, a[0].y, "L", a[1].x, a[1].y] }); d.wrap(d.Tick.prototype,
    "getLabelPosition", function (c) { var a = c.apply(this, [].slice.call(arguments, 1)); if (!this.axis.chart.is3d()) return a; var b = n([this.axis.swapZ({ x: a.x, y: a.y, z: 0 })], this.axis.chart, !1)[0]; b.x -= !this.axis.horiz && this.axis.opposite ? this.axis.transA : 0; b.old = a; return b }); d.wrap(d.Tick.prototype, "handleOverflow", function (c, a) { if (this.axis.chart.is3d()) a = a.old; return c.call(this, a) }); d.wrap(d.Axis.prototype, "getTitlePosition", function (c) {
        var a = c.apply(this, [].slice.call(arguments, 1)); return !this.chart.is3d() ?
            a : a = n([this.swapZ({ x: a.x, y: a.y, z: 0 })], this.chart, !1)[0]
    }); d.wrap(d.Axis.prototype, "drawCrosshair", function (c) { var a = arguments; this.chart.is3d() && a[2] && (a[2] = { plotX: a[2].plotXold || a[2].plotX, plotY: a[2].plotYold || a[2].plotY }); c.apply(this, [].slice.call(a, 1)) }); d.Axis.prototype.swapZ = function (c, a) { if (this.isZAxis) { var b = a ? 0 : this.chart.plotLeft, d = this.chart; return { x: b + (d.yAxis[0].opposite ? c.z : d.xAxis[0].width - c.z), y: c.y, z: c.x - b } } else return c }; var D = d.ZAxis = function () {
        this.isZAxis = !0; this.init.apply(this,
        arguments)
    }; d.extend(D.prototype, d.Axis.prototype); d.extend(D.prototype, {
        setOptions: function (c) { c = d.merge({ offset: 0, lineWidth: 0 }, c); d.Axis.prototype.setOptions.call(this, c); this.coll = "zAxis" }, setAxisSize: function () { d.Axis.prototype.setAxisSize.call(this); this.width = this.len = this.chart.options.chart.options3d.depth; this.right = this.chart.chartWidth - this.width - this.left }, getSeriesExtremes: function () {
            var c = this, a = c.chart; c.hasVisibleSeries = !1; c.dataMin = c.dataMax = c.ignoreMinPadding = c.ignoreMaxPadding =
            null; c.buildStacks && c.buildStacks(); d.each(c.series, function (b) { if (b.visible || !a.options.chart.ignoreHiddenSeries) if (c.hasVisibleSeries = !0, b = b.zData, b.length) c.dataMin = Math.min(y(c.dataMin, b[0]), Math.min.apply(null, b)), c.dataMax = Math.max(y(c.dataMax, b[0]), Math.max.apply(null, b)) })
        }
    }); d.wrap(d.Chart.prototype, "getAxes", function (c) { var a = this, b = this.options, b = b.zAxis = d.splat(b.zAxis || {}); c.call(this); if (a.is3d()) this.zAxis = [], d.each(b, function (b, c) { b.index = c; b.isX = !0; (new D(a, b)).setScale() }) }); d.wrap(d.seriesTypes.column.prototype,
    "translate", function (c) { c.apply(this, [].slice.call(arguments, 1)); if (this.chart.is3d()) { var a = this.chart, b = this.options, e = b.depth || 25, f = (b.stacking ? b.stack || 0 : this._i) * (e + (b.groupZPadding || 1)); b.grouping !== !1 && (f = 0); f += b.groupZPadding || 1; d.each(this.data, function (b) { if (b.y !== null) { var c = b.shapeArgs, d = b.tooltipPos; b.shapeType = "cuboid"; c.z = f; c.depth = e; c.insidePlotArea = !0; d = n([{ x: d[0], y: d[1], z: f }], a, !1)[0]; b.tooltipPos = [d.x, d.y] } }); this.z = f } }); d.wrap(d.seriesTypes.column.prototype, "animate", function (c) {
        if (this.chart.is3d()) {
            var a =
            arguments[1], b = this.yAxis, e = this, f = this.yAxis.reversed; if (d.svg) a ? d.each(e.data, function (a) { if (a.y !== null && (a.height = a.shapeArgs.height, a.shapey = a.shapeArgs.y, a.shapeArgs.height = 1, !f)) a.shapeArgs.y = a.stackY ? a.plotY + b.translate(a.stackY) : a.plotY + (a.negative ? -a.height : a.height) }) : (d.each(e.data, function (a) { if (a.y !== null) a.shapeArgs.height = a.height, a.shapeArgs.y = a.shapey, a.graphic && a.graphic.animate(a.shapeArgs, e.options.animation) }), this.drawDataLabels(), e.animate = null)
        } else c.apply(this, [].slice.call(arguments,
        1))
    }); d.wrap(d.seriesTypes.column.prototype, "init", function (c) { c.apply(this, [].slice.call(arguments, 1)); if (this.chart.is3d()) { var a = this.options, b = a.grouping, d = a.stacking, f = 0; if (b === void 0 || b) { b = this.chart.retrieveStacks(d); d = a.stack || 0; for (f = 0; f < b[d].series.length; f++) if (b[d].series[f] === this) break; f = b.totalStacks * 10 - 10 * (b.totalStacks - b[d].position) - f } a.zIndex = f } }); d.wrap(d.Series.prototype, "alignDataLabel", function (c) {
        if (this.chart.is3d() && (this.type === "column" || this.type === "columnrange")) {
            var a =
            arguments[4], b = { x: a.x, y: a.y, z: this.z }, b = n([b], this.chart, !0)[0]; a.x = b.x; a.y = b.y
        } c.apply(this, [].slice.call(arguments, 1))
    }); d.seriesTypes.columnrange && d.wrap(d.seriesTypes.columnrange.prototype, "drawPoints", F); d.wrap(d.seriesTypes.column.prototype, "drawPoints", F); d.wrap(d.seriesTypes.pie.prototype, "translate", function (c) {
        c.apply(this, [].slice.call(arguments, 1)); if (this.chart.is3d()) {
            var a = this, b = a.chart, e = a.options, f = e.depth || 0, g = b.options.chart.options3d, i = { x: b.plotWidth / 2, y: b.plotHeight / 2, z: g.depth },
            j = g.alpha, h = g.beta, k = e.stacking ? (e.stack || 0) * f : a._i * f; k += f / 2; e.grouping !== !1 && (k = 0); d.each(a.data, function (b) { var c = b.shapeArgs; b.shapeType = "arc3d"; c.z = k; c.depth = f * 0.75; c.origin = i; c.alpha = j; c.beta = h; c.center = a.center; c = (c.end + c.start) / 2; b.slicedTranslation = { translateX: G(m(c) * e.slicedOffset * m(j * x)), translateY: G(l(c) * e.slicedOffset * m(j * x)) } })
        }
    }); d.wrap(d.seriesTypes.pie.prototype.pointClass.prototype, "haloPath", function (c) { var a = arguments; return this.series.chart.is3d() ? [] : c.call(this, a[1]) }); d.wrap(d.seriesTypes.pie.prototype,
    "drawPoints", function (c) {
        var a = this.group, b = this.options, e = b.states; if (this.chart.is3d()) this.borderWidth = b.borderWidth = b.edgeWidth || 1, this.borderColor = b.edgeColor = d.pick(b.edgeColor, b.borderColor, void 0), e.hover.borderColor = d.pick(e.hover.edgeColor, this.borderColor), e.hover.borderWidth = d.pick(e.hover.edgeWidth, this.borderWidth), e.select.borderColor = d.pick(e.select.edgeColor, this.borderColor), e.select.borderWidth = d.pick(e.select.edgeWidth, this.borderWidth), d.each(this.data, function (a) {
            var b = a.pointAttr;
            b[""].stroke = a.series.borderColor || a.color; b[""]["stroke-width"] = a.series.borderWidth; b.hover.stroke = e.hover.borderColor; b.hover["stroke-width"] = e.hover.borderWidth; b.select.stroke = e.select.borderColor; b.select["stroke-width"] = e.select.borderWidth
        }); c.apply(this, [].slice.call(arguments, 1)); this.chart.is3d() && d.each(this.points, function (b) { var c = b.graphic; c.out.add(a); c.inn.add(a); c.side1.add(a); c.side2.add(a); c[b.y ? "show" : "hide"]() })
    }); d.wrap(d.seriesTypes.pie.prototype, "drawDataLabels", function (c) {
        if (this.chart.is3d()) {
            var a =
            this; d.each(a.data, function (b) { var c = b.shapeArgs, d = c.r, g = c.depth, i = (c.alpha || a.chart.options.chart.options3d.alpha) * x, c = (c.start + c.end) / 2, b = b.labelPos; b[1] += -d * (1 - m(i)) * l(c) + (l(c) > 0 ? l(i) * g : 0); b[3] += -d * (1 - m(i)) * l(c) + (l(c) > 0 ? l(i) * g : 0); b[5] += -d * (1 - m(i)) * l(c) + (l(c) > 0 ? l(i) * g : 0) })
        } c.apply(this, [].slice.call(arguments, 1))
    }); d.wrap(d.seriesTypes.pie.prototype, "addPoint", function (c) { c.apply(this, [].slice.call(arguments, 1)); this.chart.is3d() && this.update(this.userOptions, !0) }); d.wrap(d.seriesTypes.pie.prototype,
    "animate", function (c) {
        if (this.chart.is3d()) { var a = arguments[1], b = this.options.animation, e = this.center, f = this.group, g = this.markerGroup; if (d.svg) if (b === !0 && (b = {}), a) { if (f.oldtranslateX = f.translateX, f.oldtranslateY = f.translateY, a = { translateX: e[0], translateY: e[1], scaleX: 0.001, scaleY: 0.001 }, f.attr(a), g) g.attrSetters = f.attrSetters, g.attr(a) } else a = { translateX: f.oldtranslateX, translateY: f.oldtranslateY, scaleX: 1, scaleY: 1 }, f.animate(a, b), g && g.animate(a, b), this.animate = null } else c.apply(this, [].slice.call(arguments,
        1))
    }); d.wrap(d.seriesTypes.scatter.prototype, "translate", function (c) { c.apply(this, [].slice.call(arguments, 1)); if (this.chart.is3d()) { var a = this.chart, b = d.pick(this.zAxis, a.options.zAxis[0]), e = [], f, g; for (g = 0; g < this.data.length; g++) f = this.data[g], f.isInside = f.isInside ? f.z >= b.min && f.z <= b.max : !1, e.push({ x: f.plotX, y: f.plotY, z: b.translate(f.z) }); a = n(e, a, !0); for (g = 0; g < this.data.length; g++) f = this.data[g], b = a[g], f.plotXold = f.plotX, f.plotYold = f.plotY, f.plotX = b.x, f.plotY = b.y, f.plotZ = b.z } }); d.wrap(d.seriesTypes.scatter.prototype,
    "init", function (c, a, b) { if (a.is3d()) this.axisTypes = ["xAxis", "yAxis", "zAxis"], this.pointArrayMap = ["x", "y", "z"], this.parallelArrays = ["x", "y", "z"]; c = c.apply(this, [a, b]); if (this.chart.is3d()) this.tooltipOptions.pointFormat = this.userOptions.tooltip ? this.userOptions.tooltip.pointFormat || "x: <b>{point.x}</b><br/>y: <b>{point.y}</b><br/>z: <b>{point.z}</b><br/>" : "x: <b>{point.x}</b><br/>y: <b>{point.y}</b><br/>z: <b>{point.z}</b><br/>"; return c }); if (d.VMLRenderer) d.setOptions({ animate: !1 }), d.VMLRenderer.prototype.cuboid =
    d.SVGRenderer.prototype.cuboid, d.VMLRenderer.prototype.cuboidPath = d.SVGRenderer.prototype.cuboidPath, d.VMLRenderer.prototype.toLinePath = d.SVGRenderer.prototype.toLinePath, d.VMLRenderer.prototype.createElement3D = d.SVGRenderer.prototype.createElement3D, d.VMLRenderer.prototype.arc3d = function (c) { c = d.SVGRenderer.prototype.arc3d.call(this, c); c.css({ zIndex: c.zIndex }); return c }, d.VMLRenderer.prototype.arc3dPath = d.SVGRenderer.prototype.arc3dPath, d.wrap(d.Axis.prototype, "render", function (c) {
        c.apply(this, [].slice.call(arguments,
        1)); this.sideFrame && (this.sideFrame.css({ zIndex: 0 }), this.sideFrame.front.attr({ fill: this.sideFrame.color })); this.bottomFrame && (this.bottomFrame.css({ zIndex: 1 }), this.bottomFrame.front.attr({ fill: this.bottomFrame.color })); this.backFrame && (this.backFrame.css({ zIndex: 0 }), this.backFrame.front.attr({ fill: this.backFrame.color }))
    })
})(Highcharts);
