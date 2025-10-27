
// remove this code if you're arent using 5v.pl
                        (function() {
                            'use strict';
                            

                            const adDomains = [
                                'doubleclick.net',
                                'googleadservices.com',
                                'googlesyndication.com',
                                'google-analytics.com',
                                'ads.pubmatic.com',
                                'ads.youtube.com',
                                'adservice.google.com',
                                'adservice.google.*',
                                'amazon-adsystem.com',
                                'adbrite.com',
                                'adtech.de',
                                'adtechus.com',
                                'advertising.com',
                                'atdmt.com',
                                'bluekai.com',
                                'casalemedia.com',
                                'fastclick.com',
                                'gemini.yahoo.com',
                                'googlesyndication.com',
                                'invitemedia.com',
                                'outbrain.com',
                                'quantserve.com',
                                'rubiconproject.com',
                                'scorecardresearch.com',
                                'serving-sys.com',
                                'zedo.com',
                                'taboola.com',
                                'ads.*',
                                'ad.*',
                                '*.ad.*',
                                'telemetry.*',
                                'analytics.*',
                                'tracking.*'
                            ];
                            
                            const originalSend = XMLHttpRequest.prototype.send;
                            XMLHttpRequest.prototype.send = function() {
                                if (adDomains.some(domain => this._url && this._url.includes(domain))) {
                                    console.log('Blocked XHR request to:', this._url);
                                    return;
                                }
                                return originalSend.apply(this, arguments);
                            };
                            
                            const originalOpen = XMLHttpRequest.prototype.open;
                            XMLHttpRequest.prototype.open = function(method, url) {
                                this._url = url;
                                return originalOpen.apply(this, arguments);
                            };
                            
                            // Block fetch requests to ad domains
                            const originalFetch = window.fetch;
                            window.fetch = function() {
                                const url = arguments[0];
                                if (typeof url === 'string' && adDomains.some(domain => url.includes(domain))) {
                                    console.log('Blocked fetch request to:', url);
                                    return Promise.reject(new Error('Ad request blocked'));
                                }
                                return originalFetch.apply(this, arguments);
                            };
                            
                            function removeAds() {
                                const adSelectors = [
                                    '[class*="ad"]',
                                    '[id*="ad"]',
                                    '[class*="Ad"]',
                                    '[id*="Ad"]',
                                    '[class*="banner"]',
                                    '[id*="banner"]',
                                    '[class*="sponsor"]',
                                    '[id*="sponsor"]'
                                ];
                                
                                adSelectors.forEach(selector => {
                                    document.querySelectorAll(selector).forEach(element => {
                                        const className = element.className.toLowerCase();
                                        const id = element.id.toLowerCase();
                                        
                                        if (className.includes('ad') || id.includes('ad') || 
                                            className.includes('banner') || id.includes('banner') ||
                                            className.includes('sponsor') || id.includes('sponsor')) {
                                            element.remove();
                                            console.log('Removed ad element:', element);
                                        }
                                    });
                                });
                                
                                document.querySelectorAll('iframe').forEach(iframe => {
                                    const src = iframe.src || '';
                                    if (adDomains.some(domain => src.includes(domain))) {
                                        iframe.remove();
                                        console.log('Removed ad iframe:', src);
                                    }
                                });
                            }
                            
                            document.addEventListener('DOMContentLoaded', removeAds);
                            new MutationObserver(removeAds).observe(document.body, {
                                childList: true,
                                subtree: true
                            });
                            
                            const originalAppend = Element.prototype.appendChild;
                            Element.prototype.appendChild = function() {
                                if (arguments[0].src && adDomains.some(domain => arguments[0].src.includes(domain))) {
                                    console.log('Blocked resource load:', arguments[0].src);
                                    return arguments[0];
                                }
                                return originalAppend.apply(this, arguments);
                            };
                            
                        })();

class AnimationHandler {

    runAnimation(elementVar, animationName) {
        elementVar.style.animation = animationName + '0.5s ease';
        return;
    }

    runAnimationForwards(elementVar, animationName) {
        elementVar.style.animationFillMode = 'forwards';
        elementVar.style.animation = animationName + '0.5s ease';
        return;
    }
}
const animation = new AnimationHandler();
const button = document.getElementById('submit');

button.addEventListener('click', function() {
const e = document.querySelector(".text");

const text = e.innerHTML;
let newmessage = message.split('\n').join('\\');
document.cookie = "text=" + newmessage + "; expires=Thu, 18 Dec 2025 12:00:00 UTC; path=/";
console.log(text);
});

var mapObj = {
   1:"<span class='number'>1</span>",
   2:"<span class='number'>2</span>",
   3:"<span class='number'>3</span>",
   4:"<span class='number'>4</span>",
   5:"<span class='number'>5</span>",
   6:"<span class='number'>6</span>",
   7:"<span class='number'>7</span>",
   8:"<span class='number'>8</span>",
   9:"<span class='number'>9</span>",
   0:"<span class='number'>0</span>",
   GET:"<div class='hover-div'><cct>GET</cct></div>",
   JOIN:"<span class='join'>JOIN</span>",
   UPDATE:"<div class='hover-div'><cct>UPDATE</cct></div>",
   RATE:"<div class='hover-div'><cct>RATE</cct></div>",
   EXISTS:"<div class='hover-div'><cct>EXISTS</cct></div>",
   DELETE:"<div class='hover-div'><cct>DELETE</cct></div>",
   LOGIN:"<div class='hover-div'><cct>LOGIN</cct></div>",
   LOGOFF:"<div class='hover-div'><cct>LOGOFF</cct></div>",
   RAND:"<div class='hover-div'><cct>RAND</cct></div>",
   levelid:"<span class='color2'>levelid</span>",
   levelname:"<span class='color2'>levelname</span>",
   accountid:"<span class='color2'>accountid</span>",
   accid:"<span class='color2'>accid</span>",
   userid:"<span class='color2'>userid</span>",
   uid:"<span class='color2'>uid</span>",
   comments:"<span class='color2'>comments</span>",
   admin:"<span class='color2'>admin</span>",
   accountid:"<span class='color2'>accountid</span>",
   unrate:"<span class='color2'>unrate</span>",
   level:"<span class='color2'>level</span>",
   levels:"<span class='color2'>levels</span>",
   commentid:"<span class='color2'>commentid</span>",
   comment:"<span class='color2'>comment</span>",
   stats:"<span class='color2'>stats</span>",
   coins:"<span class='color2'>coins</span>",
   username:"<span class='color2'>username</span>",
   accountname:"<span class='color2'>accountname</span>",
   variable:"<span class='color2'>variable</span>",
   data:"<span class='color2'>data</span>"
};

var re = new RegExp(Object.keys(mapObj).join("|")); 

const colorMention = (elText, elPre) => {
  elPre.innerHTML = elText.innerHTML.replace(re, function(matched){
    return mapObj[matched];
  });
};

const scrollMirror = (elText, elPre) => {
  elPre.scrollTo(elText.scrollLeft, elText.scrollTop);
};

const handleKey = (ev, elText, elPre) => {
  if (ev.key === "Enter" && !ev.shiftKey) {
    ev.preventDefault();

    const message = elText.innerHTML;
    if (!message.trim()) {
      return; 
    }

    // console.log(message);
    let newmessage = message.split('\n').join('\\');
    // console.log(newmessage);
    document.cookie = "text=" + newmessage + "; expires=Thu, 18 Dec 2025 12:00:00 UTC; path=/";
    window.location.href = "";

    elText.innerHTML = "";
    elPre.innerHTML = "";
  } else {
    scrollMirror(elText, elPre);
  }
};

document.querySelectorAll(".message").forEach(el => {

  let elText = el.querySelector(".text");
  let elPre = el.querySelector(".pre");

  elText.addEventListener("scroll", () => scrollMirror(elText, elPre));
  elText.addEventListener("keyup", () => scrollMirror(elText, elPre));
  elText.addEventListener("input", () => colorMention(elText, elPre));
  elText.addEventListener("keydown", (ev) => handleKey(ev, elText, elPre));

  // Init:
  colorMention(elText, elPre);
  scrollMirror(elText, elPre);
});
let interval;
let paused = false;
let getDiv;
let state = 1;
let option1;
let option2;
let option3;
let element;
let controller;
let signal;
let colorDiv;
let hex;
let xposition;
let yposition;
let includes;
const isOnMobile = navigator.userAgentData && navigator.userAgentData.mobile;


function isValidHexColor(colorString) {
  const hexColorRegex = /^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/;
  return hexColorRegex.test(colorString);
}

interval = setInterval(function() {
let t = document.querySelector(".text");

let b = t.innerHTML;
b = b.trim();

element = document.getElementById('getDiv');

let myStupidArray = 
  ['GET',
    'UPDATE',
    'RATE',
    'EXISTS',
    'DELETE',
    'LOGIN',
    'GET level',
    'GET account',
    'GET comment',
    'RAND',
    'LOGOFF',
    'JOIN',
  ];

// i suck at javascript dont mind this :3
if(element && !myStupidArray.includes(b) && !isOnMobile) {
document.body.removeChild(getDiv);
paused = false;
}
if(paused === true) {
    return;
    }
if((myStupidArray.includes(b)) && !isOnMobile) {
getDiv = document.createElement("div");
getDiv.style.width = "200px";
getDiv.style.height = "auto";
getDiv.style.background = "#222";
getDiv.style.borderStyle = "solid";
getDiv.style.borderWidth = "2px";
getDiv.style.borderColor = "#444";
getDiv.style.color = "white";
getDiv.style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)";
getDiv.style.textAlign = "center";
getDiv.style.position = "relative";
getDiv.style.top = "-100px";
getDiv.style.opacity = "0";
getDiv.id = "getDiv";

var subString = myStupidArray.find(sub => b.includes(sub));
var subStringIndex = b.indexOf(subString);

if(myStupidArray.includes(b)) {
    var firstIndex = b.split(" ")[0];
    var textVar = document.querySelector('.hover-div');
if(textVar != null) {
textVar.addEventListener('mouseenter',  function() {
document.getElementById('getDiv').style.opacity = '1';
});

textVar.addEventListener('mouseleave',  function() {
document.getElementById('getDiv').style.opacity = '0';
});
} else {
    alert('textVar not found, functionality might be limited.');
}
    function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}

readTextFile("../seafuncs/extra/documentation.json", function(value){
    var data = JSON.parse(value);
    var structure = data[firstIndex][0]['structure'];
    getDiv.innerHTML = `<img src="./assets/function.png" class="img"><br><p class="p2" style="position:relative;top:-10px"><cc>${firstIndex}()</cc> <br> ${structure}</p>`;
});
} 
document.body.appendChild(getDiv);
paused = true;
}

hex = b.substring(b.indexOf('#'));

if(b.includes('#') && !document.getElementById('colorDiv') && isValidHexColor(hex)) {
colorDiv = document.createElement("div");
colorDiv.id = "colorDiv";
colorDiv.classList.add('colorDiv');

colorDiv.style.position = "fixed";

document.body.appendChild(colorDiv);
} else if (document.getElementById('colorDiv') && (!b.includes('#') || !isValidHexColor(hex))) {
document.body.removeChild(colorDiv);
}

if(document.getElementById('colorDiv')) {
colorDiv.style.backgroundColor = hex;
colorDiv.style.left = b.length * 10 + 10 + "px";
colorDiv.style.top = "0px";
}
    }, 100);

let clicktype = 0;
