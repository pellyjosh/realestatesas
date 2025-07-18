/**
* Chartist.js plugin to display a data label on top of the points in a line chart.
*
*/
/* global Chartist */
(function (window, document, Chartist) {
    'use strict';

    var defaultOptions = {
        currency: undefined,
        currencyFormatCallback: undefined,
        tooltipOffset: {
            x: 0,
            y: -20
        },
        anchorToPoint: false,
        appendToBody: false,
        class: undefined,
        pointClass: 'ct-point'
    };

    Chartist.plugins = Chartist.plugins || {};
    Chartist.plugins.tooltip = function (options) {
        options = Chartist.extend({}, defaultOptions, options);

        return function     (chart) {
            var tooltipSelector = options.pointClass;
            if (chart.constructor.name == Chartist.Bar.prototype.constructor.name) {
                tooltipSelector = 'ct-bar';
            } else if (chart.constructor.name == Chartist.Pie.prototype.constructor.name) {
                // Added support for donut graph
                if (chart.options.donut) {
                    tooltipSelector = 'ct-slice-donut';
                } else {
                    tooltipSelector = 'ct-slice-pie';
                }
            }

            var $chart = chart.container;
            var $toolTip = $chart.querySelector('.chartist-tooltip');
            if (!$toolTip) {
                $toolTip = document.createElement('div');
                $toolTip.className = (!options.class) ? 'chartist-tooltip' : 'chartist-tooltip ' + options.class;
                if (!options.appendToBody) {
                    $chart.appendChild($toolTip);
                } else {
                    document.body.appendChild($toolTip);
                }
            }
            var height = $toolTip.offsetHeight;
            var width = $toolTip.offsetWidth;

            hide($toolTip);

            function on(event, selector, callback) {
                $chart.addEventListener(event, function (e) {
                    if (!selector || hasClass(e.target, selector))
                        callback(e);
                });
            }

            on('mouseover', null, function () {
                var $point = event.target;
                var tooltipText = '';

                var isPieChart = (chart instanceof Chartist.Pie) ? $point : $point.parentNode;
                var seriesName = (isPieChart) ? $point.parentNode.getAttribute('ct:meta') || $point.parentNode.getAttribute('ct:series-name') : '';
                var meta = $point.getAttribute('ct:meta') || seriesName || '';
                var hasMeta = !!meta;
                var value = $point.getAttribute('ct:value');

                if (options.transformTooltipTextFnc && typeof options.transformTooltipTextFnc === 'function') {
                    value = options.transformTooltipTextFnc(value);
                }

                if (options.tooltipFnc && typeof options.tooltipFnc === 'function') {
                    tooltipText = options.tooltipFnc(meta, value);
                } else {
                    if (options.metaIsHTML) {
                        var txt = document.createElement('textarea');
                        txt.innerHTML = meta;
                        meta = txt.value;
                    }

                    meta = '<span class="chartist-tooltip-meta">' + meta + '</span>';

                    if (hasMeta) {
                        tooltipText += meta + '<br>';
                    } else {
                        // For Pie Charts also take the labels into account
                        // Could add support for more charts here as well!
                        if (chart instanceof Chartist.Pie) {
                            var label = next($point, 'ct-label');
                            if (label.length > 0) {
                                tooltipText += text(label) + '<br>';
                            }
                        }
                    }

                    if (value) {
                        if (options.currency) {
                            if (options.currencyFormatCallback != undefined) {
                                value = options.currencyFormatCallback(value, options);
                            } else {
                                value = options.currency + value.replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, '$1,');
                            }
                        }
                        value = '<span class="chartist-tooltip-value">' + value + '</span>';
                        tooltipText += value;
                    }
                }

                if (tooltipText) {
                    $toolTip.innerHTML = tooltipText;
                    setPosition(event);
                    show($toolTip);

                    // Remember height and width to avoid wrong position in IE
                    height = $toolTip.offsetHeight;
                    width = $toolTip.offsetWidth;
                }
            });

            on('mouseout', null, function () {
                hide($toolTip);
            });

            function setPosition(event) {
                height = height || $toolTip.offsetHeight;
                width = width || $toolTip.offsetWidth;
                var offsetX = - width / 2 + options.tooltipOffset.x
                var offsetY = - height + options.tooltipOffset.y;
                var anchorX, anchorY;

                if (!options.appendToBody) {
                    var box = $chart.getBoundingClientRect();
                    var left = event.pageX - box.left - window.pageXOffset;
                    var top = event.pageY - box.top - window.pageYOffset;

                    if (true === options.anchorToPoint && event.target.x2 && event.target.y2) {
                        anchorX = parseInt(event.target.x2.baseVal.value);
                        anchorY = parseInt(event.target.y2.baseVal.value);
                    }

                    $toolTip.style.top = (anchorY || top) + offsetY + 'px';
                    $toolTip.style.left = (anchorX || left) + offsetX + 'px';
                } else {
                    $toolTip.style.top = event.pageY + offsetY + 'px';
                    $toolTip.style.left = event.pageX + offsetX + 'px';
                }
            }
        }
    };

    function show(element) {
        if (!hasClass(element, 'tooltip-show')) {
            element.className = element.className + ' tooltip-show';
        }
    }

    function hide(element) {
        // var regex = new RegExp('tooltip-show' + '\\s*', 'gi');
        // element.className = element.className.replace(regex, '').trim();
        element.classList.remove('tooltip-show');
    }

    function hasClass(element, className) {
        return (' ' + element.getAttribute('class') + ' ').indexOf(' ' + className + ' ') > -1;
    }

    function next(element, className) {
        do {
            element = element.nextSibling;
        } while (element && !hasClass(element, className));
        return element;
    }

    function text(element) {
        return element.innerText || element.textContent;
    }

}(window, document, Chartist));
  