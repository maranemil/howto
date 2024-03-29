
######
### [Violation] Forced reflow while executing JavaScript took 320ms
### [Violation] 'DOMContentLoaded' handler took 179ms
######
```
https://github.com/scrollreveal/scrollreveal/issues/335
https://gist.github.com/paulirish/5d52fb081b3570c81e3a
https://rbyers.github.io/scroll-latency.html
https://bugs.chromium.org/p/chromium/issues/detail?id=662497
https://benchmarkjs.com/

https://stackoverflow.com/questions/41218507/violation-long-running-javascript-task-took-xx-ms

https://www.chromestatus.com/feature/5745543795965952
https://developers.google.com/web/tools/chrome-devtools/evaluate-performance/
https://developers.google.com/web/tools/chrome-devtools/rendering-tools/
https://developers.google.com/speed/docs/insights/browser-reflow
```

```
// test
;(function ($) {
  var options = {};
  window.sr = ScrollReveal(options);
  sr.reveal('.sr-item', { viewFactor: 0.6, duration: 500 });
  sr.reveal('.sr-item--seq', { viewFactor: 0.6, duration: 500 }, 50);
})(jQuery);
```

```
// test
function someMethodIThinkMightBeSlow() {
    const startTime = performance.now();
    // Do the normal stuff for this function
    const duration = performance.now() - startTime;
    console.log(`someMethodIThinkMightBeSlow took ${duration}ms`);
}
```

```
search.addEventListener('keyup', function() {
    for (const node of nodes)
        if (node.innerText.toLowerCase().includes(this.value.toLowerCase()))
            node.classList.remove('hidden');
        else
            node.classList.add('hidden');
});
```
```
search.addEventListener('keyup', function() {
    const nodesToHide = [];
    const nodesToShow = [];
    for (const node of nodes)
        if (node.innerText.toLowerCase().includes(this.value.toLowerCase()))
            nodesToShow.push(node);
        else
            nodesToHide.push(node);

    nodesToHide.forEach(node => node.classList.add('hidden'));
    nodesToShow.forEach(node => node.classList.remove('hidden'));
});
```

```
var resolvedPromise = typeof Promise == 'undefined' ? null : Promise.resolve();
var nextTick = resolvedPromise ? function(fn) { resolvedPromise.then(fn); } : function(fn) { setTimeout(fn); };

http://jsbin.com/?html,output
https://next.plnkr.co/
https://jsfiddle.net/
https://gitter.im/angular/angular

// https://api.jquery.com/jQuery.noConflict/
// https://javascript.info/onload-ondomcontentloaded
// https://eager.io/blog/how-to-decide-when-your-code-should-run/
document.addEventListener("DOMContentLoaded", ready);
// not "document.onDOMContentLoaded = ..."

jQuery.noConflict( true );
jQuery(document).ready(function($){
	// All your code using $
});
```

######
### debug tools packages
######
```
const start = Date.now()
while (Date.now() - start < 5000) {}

https://nolanlawson.com/2021/02/23/javascript-performance-beyond-bundle-size/
https://bundlephobia.com/
https://bundlephobia.com/result?p=react-dom@17.0.1
https://preactjs.com/guide/v10/differences-to-react/
https://bundlephobia.com/result?p=preact@10.5.12
https://github.com/webpack-contrib/webpack-bundle-analyzer
https://github.com/doesdev/rollup-plugin-analyzer
https://github.com/siddharthkp/bundlesize
https://www.bundle-buddy.com/webpack
https://github.com/danvk/source-map-explorer
http://webpack.github.io/analyse/
https://developer.mozilla.org/en-US/docs/Web/API/CacheStorage
https://web.dev/storage-for-the-web/
https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage
https://developer.mozilla.org/en-US/docs/Web/API/StorageManager/estimate
```

### cypress
```
https://docs.cypress.io/guides/getting-started/installing-cypress#Switching-browsers
```




### catch mouse event in console
```
#############################################################
How do I view events fired on an element in Chrome DevTools?
#############################################################

https://stackoverflow.com/questions/10213703/how-do-i-view-events-fired-on-an-element-in-chrome-devtools
https://developer.chrome.com/blog/quickly-monitor-events-from-the-console-panel-2/
https://developer.chrome.com/docs/devtools/console/log/
https://sites.google.com/a/chromium.org/dev/developers/how-tos/trace-event-profiling-tool/recording-tracing-runs
https://support.google.com/a/answer/11478284?hl=en
https://developers.google.com/admin-sdk/reports/v1/appendix/activity/chrome?hl=de
https://superuser.com/questions/1156956/does-windows-10-log-events-such-as-visiting-a-web-page-opening-a-new-browser-ta
https://sites.google.com/a/chromium.org/dev/developers/how-tos/trace-event-profiling-tool/frame-viewer
https://doc.qt.io/qtcreator/creator-ctf-visualizer.html
https://docs.google.com/document/d/1CvAClvFfyA5R-PhYUmn5OOQtYMH4h6I0nSsKchNAySU/preview#heading=h.yr4qxyxotyw
https://google.github.io/trace-viewer/
https://github.com/catapult-project/catapult
https://www.chromium.org/developers/how-tos/trace-event-profiling-tool/

$0
monitorEvents($0)
unmonitorEvents($0)
monitorEvents(document.body, 'mouse')
console.clear()

chrome://tracing/
```
