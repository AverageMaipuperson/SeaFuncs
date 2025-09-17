<?php session_start();?>
<!DOCTYPE html>
<header>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cascadia+Code:ital,wght@0,200..700;1,200..700&display=swap" rel="stylesheet">
</header>
<style>
body {
    background-image: url("./assets/background.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    font-family: "Cascadia Code", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
    }
    
* {
  margin: 0;
  box-sizing: border-box;
}

.message {
  display: block;
  position: relative;
  width: 100%;
  background-color: #222222;
  color: white;
}

.message .pre,
.message .text {
  border: 0;
  overflow: scroll;
  overflow-x: hidden;
  font: inherit;
  padding: 10px;
  height: 5rem;
  resize: none;
  width: 100%;
  white-space: break-spaces;
  word-wrap: break-word;
}


/* The overlay contenteditable with transparent text but visible caret */

.message .text {
  position: relative;
  background: transparent;
  outline: none;
  /* transparent color */
  color: transparent;
  /* but visible caret */
  caret-color: white;
}


/* The underlaying element with colors */

.message .pre {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  /* Prevent text selections */
  user-select: none;
}
    
.button {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
    background-color: #222222;
    padding: 10px;
    color: white;
    border-width: 2px;
    border-style: solid;
    border-color: #444444;
    border-radius: 10px;
    font-family: "Cascadia Code", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
    cursor: pointer;
    }

.output {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    background-color: #e0e0e0;
    padding: 50px;
    border-style: double;
    white-space: nowrap;
    text-align: center;
    position: fixed;
    bottom: 0;
    font-family: "Cascadia Code", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
  overflow-wrap: break-word;
  overflow: auto;
    }
    
.output2 {
    color: red;
    overflow-wrap: break-word;
    overflow: auto;
    }
<?php
include "settings/config.php";
if($colorCoding === 1) {
echo '
.get {
font-family: font-family: "Cascadia Code", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
color: #faf68e;
}

.color2 {
font-family: font-family: "Cascadia Code", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
color: #958efaff;
}

.number {
font-family: font-family: "Cascadia Code", sans-serif;
font-optical-sizing: auto;
font-style: normal;
color: #55ddff;
}';
} elseif($colorCoding === 2) {
echo '
.get {
font-family: font-family: "Cascadia Code", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
color: #08fff7;
}

.color2 {
font-family: font-family: "Cascadia Code", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
color: #516ff0;
}

.number {
font-family: font-family: "Cascadia Code", sans-serif;
font-optical-sizing: auto;
font-style: normal;
color: #de09c5;
}';
} else {
echo '
.get {
font-family: font-family: "Cascadia Code", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
}

.color2 {
font-family: font-family: "Cascadia Code", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
}

.number {
font-family: font-family: "Cascadia Code", sans-serif;
font-optical-sizing: auto;
font-style: normal;
}';
}
?>

.getDiv {
    padding: 20px;
    }

.h1Get {
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    margin-left: 10px;
    }



.p2 {
    font-size: 11px; 
    }
    
.img {
    height: 30px;
    float: left;
    }
  
.img2 {
    height: 30px;
    float: left;
    }

.img3 {
    height: 30px;
    float: left;
    }

.options {
    background-color: #222222; 
    height: 50px;
    width: 100px;
    border-width: 1px; 
    border-style: solid;
    border-color: #555555;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  .options2 {
    background-color: #222222; 
    height: 75px;
    width: 100px;
    border-width: 1px; 
    border-style: solid;
    border-color: #555555;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
.option1 {
    background-color: #054499; 
    height: 50%;
    width: 100%;
    text-align: center;
    vertical-align: center;
  }
.option2 {
    background-color: #222;
    height: 50%;
    width: 100%;
    text-align: center;
    vertical-align: center;
  }

.option1b {
    background-color: #054499; 
    height: 33.3%;
    width: 100%;
    text-align: center;
    vertical-align: center;
  }
.option2b {
    background-color: #222;
    height: 33.3%;
    width: 100%;
    text-align: center;
    vertical-align: center;
  }

.option3b {
    background-color: #222;
    height: 33.3%;
    width: 100%;
    text-align: center;
    vertical-align: center;
  }

.colorDiv {
  height: 20px;
  width: 20px;
  border-width: 2px;
  border-style: solid;
  border-color: #ffffff;
}
</style>
<body>
<script>
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
                </script>
</body>
<form action="seafuncs.php" method="post">
<div class="message">
  <div class="pre"></div>
  <div class="text" id="text" type="text" contenteditable spellcheck="false"></div>
</div>
<br>
<input id="submit" class="button" type="submit" value="Submit" /><br><br></form>

<script>

const button = document.getElementById('submit');

button.addEventListener('click', function() {
const e = document.querySelector(".text");

const text = e.innerHTML;
document.cookie = "text=" + text + "; expires=Thu, 18 Dec 2025 12:00:00 UTC; path=/";
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
   GET:"<span class='get'>GET</span>",
   JOIN:"<span class='get'>JOIN</span>",
   UPDATE:"<span class='get'>UPDATE</span>",
   RATE:"<span class='get'>RATE</span>",
   EXISTS:"<span class='get'>EXISTS</span>",
   DELETE:"<span class='get'>DELETE</span>",
   DOWNLOAD:"<span class='get'>DOWNLOAD</span>",
   AS:"<span class='get'>AS</span>",
   RAND:"<span class='get'>RAND</span>",
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

var re = new RegExp(Object.keys(mapObj).join("|"),"gi"); 

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

    console.log(message);
    document.cookie = "text=" + message + "; expires=Thu, 18 Dec 2025 12:00:00 UTC; path=/";
    window.location.href = "seafuncs.php";

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
    'DOWNLOAD',
    'GET level',
    'GET account',
    'GET comment'
  ];

let includeArray = [
  'JOIN',
  'AS'
];

// i suck at javascript dont mind this :3
includes = includeArray.some(element => b.includes(element));
if(element && !myStupidArray.includes(b) && !includes) {
document.body.removeChild(getDiv);
paused = false;
function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
  async function wait() {
  await sleep(500);
  controller.abort();
  }
  wait();
}
if(paused === true) {
    return;
    }
if(myStupidArray.includes(b) || includes) {
getDiv = document.createElement("div");
getDiv.style.width = "100px";
getDiv.style.height = "25px";
getDiv.style.background = "#054499";
getDiv.style.color = "white";
getDiv.style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)";
getDiv.style.textAlign = "center";
getDiv.style.position = "relative";
getDiv.style.top = "-100px";
getDiv.id = "getDiv";

controller = new AbortController();
signal = controller.signal;

console.log(getDiv.id);

if(b.includes("JOIN")) {
getDiv.innerHTML = "<img src=\"./assets/function.png\" class=\"img\"><br><p class=\"p2\" style=\"position:relative;top:-10px;color:#57bcfa\">JOIN</p>";
    }
  if(b.includes("AS")) {
getDiv.innerHTML = "<img src=\"./assets/function.png\" class=\"img\"><br><p class=\"p2\" style=\"position:relative;top:-10px;color:#57bcfa\">AS</p>";
    }
switch (b) {
    case 'GET':
getDiv.innerHTML = "<img src=\"./assets/function.png\" class=\"img\"><br><p class=\"p2\" style=\"position:relative;top:-10px;color:#57bcfa\">GET</p>";
    break;
    case 'UPDATE':
getDiv.innerHTML = "<img src=\"./assets/function.png\" class=\"img\"><br><p class=\"p2\" style=\"position:relative;top:-10px;color:#57bcfa\">UPDATE</p>";
    break;
    case 'RATE':
getDiv.innerHTML = "<img src=\"./assets/function.png\" class=\"img\"><br><p class=\"p2\" style=\"position:relative;top:-10px;color:#57bcfa\">RATE</p>";
    break;
    case 'EXISTS':
getDiv.innerHTML = "<img src=\"./assets/function.png\" class=\"img\"><br><p class=\"p2\" style=\"position:relative;top:-10px;color:#57bcfa\">EXISTS</p>";
    break;
    case 'DELETE':
getDiv.innerHTML = "<img src=\"./assets/function.png\" class=\"img\"><br><p class=\"p2\" style=\"position:relative;top:-10px;color:#57bcfa\">DELETE</p>";
    break;
     case 'DOWNLOAD':
getDiv.innerHTML = "<img src=\"./assets/function.png\" class=\"img\"><br><p class=\"p2\" style=\"position:relative;top:-10px;color:#57bcfa\">DOWNLOAD</p>";
    break;
     case 'GET user':
getDiv.innerHTML = "<div class=\"options\"><div class=\"option1\" id=\"option1\"><img src=\"./assets/object.png\" class=\"img2\"><p class=\"p2\"><span style=\"color:#57bcfa\">user</span>name</p></div><div class=\"option2\" id=\"option2\"><img src=\"./assets/object.png\" class=\"img2\" style=\"position: relative;right: 30px\"><p class=\"p2\"><span style=\"color:#57bcfa\">user</span>id</p></div></div>";
getDiv.style.height = "0px";
getDiv.style.width = "0px";

document.addEventListener('keydown', function(event) {
if (event.key === "Tab" && state === 1) {
t.innerHTML = "GET username";
document.body.querySelector(".pre").innerHTML = "<span class='get'>GET</span> <span class='color2'>username</span>";
document.body.removeChild(getDiv);
paused = false;
state = 1;
}

if (event.key === "Tab" && state === 2) {
t.innerHTML = "GET userid";
document.body.querySelector(".pre").innerHTML = "<span class='get'>GET</span><span class='color2'>userid</span>";
document.body.removeChild(getDiv);
paused = false;
state = 1;
}

if (event.key === "ArrowDown" && state === 1) {
option1 = document.getElementById('option1');
option2 = document.getElementById('option2');

option1.style.backgroundColor = "#222";
option2.style.backgroundColor = "#054499";
state = 2;
}

if (event.key === "ArrowUp" && state === 2) {
option1 = document.getElementById('option1');
option2 = document.getElementById('option2');

option2.style.backgroundColor = "#222";
option1.style.backgroundColor = "#054499";
state = 1;
}
}, { signal });
    break;
    case 'GET comment':
    console.log('comment');
getDiv.innerHTML = "<div class=\"options2\"><div class=\"option1b\" id=\"option1\"><img src=\"./assets/object.png\" class=\"img2\"><p class=\"p2\" ><span style=\"color:#57bcfa\">comment</span></p></div><div class=\"option2b\" id=\"option2\"><img src=\"./assets/object.png\" class=\"img2\" style=\"position: relative;right: 30px\"><p class=\"p2\" style=\"position: relative;top: -25px\"><span style=\"color:#57bcfa\">comment</span>s</p></div><div class=\"option3b\" id=\"option3\"><img src=\"./assets/object.png\" class=\"img3\" style=\"position: relative;right: 60px\"><p class=\"p2\" style=\"position: relative;top: -25px\"><span style=\"color:#57bcfa\">comment</span>id</p></div></div>";
getDiv.style.height = "0px";
getDiv.style.width = "0px";

document.addEventListener('keydown', function(event) {
if (event.key === "Tab" && state === 1) {
t.innerHTML = "GET comment";
document.body.querySelector(".pre").innerHTML = "<span class='get'>GET</span> <span class='color2'>comment</span>";
document.body.removeChild(getDiv);
paused = false;
state = 1;
event.preventDefault();
}

else if (event.key === "Tab" && state === 2) {
t.innerHTML = "GET comments";
document.body.querySelector(".pre").innerHTML = "<span class='get'>GET</span> <span class='color2'>comments</span>";
document.body.removeChild(getDiv);
paused = false;
state = 1;
event.preventDefault();
}

else if (event.key === "Tab" && state === 3) {
t.innerHTML = "GET commentid";
document.body.querySelector(".pre").innerHTML = "<span class='get'>GET</span> <span class='color2'>commentid</span>";
document.body.removeChild(getDiv);
paused = false;
state = 1;
event.preventDefault();
}
else if (event.key === "ArrowUp" && state === 3) {
option2 = document.getElementById('option2');
option3 = document.getElementById('option3');

option3.style.backgroundColor = "#222";
option2.style.backgroundColor = "#054499";
state = 2;
}
else if (event.key === "ArrowUp" && state === 2) {
option1 = document.getElementById('option1');
option2 = document.getElementById('option2');

option2.style.backgroundColor = "#222";
option1.style.backgroundColor = "#054499";
state = 1;
}

else if (event.key === "ArrowDown" && state === 2) {
option2 = document.getElementById('option2');
option3 = document.getElementById('option3');

option2.style.backgroundColor = "#222";
option3.style.backgroundColor = "#054499";
state = 3;
}

else if (event.key === "ArrowDown" && state === 1) {
option1 = document.getElementById('option1');
option2 = document.getElementById('option2');

option1.style.backgroundColor = "#222";
option2.style.backgroundColor = "#054499";
state = 2;
}

}, { signal });
    break;
    case 'GET account':
getDiv.innerHTML = "<div class=\"options\"><div class=\"option1\" id=\"option1\"><img src=\"./assets/object.png\" class=\"img2\"><p class=\"p2\"><span style=\"color:#57bcfa\">account</span>id</p></div><div class=\"option2\" id=\"option2\"><img src=\"./assets/object.png\" class=\"img2\" style=\"position: relative;right: 30px\"><p class=\"p2\" style=\"position:relative;top:-25px;right:-5px\"><span style=\"color:#57bcfa\">account</span>name</p></div></div>";
getDiv.style.height = "0px";
getDiv.style.width = "0px";

document.addEventListener('keydown', function(event) {
if (event.key === "Tab" && state === 1) {
t.innerHTML = "GET accountid";
document.body.querySelector(".pre").innerHTML = "<span class='get'>GET</span> <span class='color2'>accountid</span>";
document.body.removeChild(getDiv);
paused = false;
state = 1;
}

if (event.key === "Tab" && state === 2) {
t.innerHTML = "GET accountname";
document.body.querySelector(".pre").innerHTML = "<span class='get'>GET</span><span class='color2'>accountname</span>";
document.body.removeChild(getDiv);
paused = false;
state = 1;
}

if (event.key === "ArrowDown" && state === 1) {
option1 = document.getElementById('option1');
option2 = document.getElementById('option2');

option1.style.backgroundColor = "#222";
option2.style.backgroundColor = "#054499";
state = 2;
}

if (event.key === "ArrowUp" && state === 2) {
option1 = document.getElementById('option1');
option2 = document.getElementById('option2');

option2.style.backgroundColor = "#222";
option1.style.backgroundColor = "#054499";
state = 1;
}
}, { signal });
    break;
case 'GET level':
getDiv.innerHTML = "<div class=\"options\"><div class=\"option1\" id=\"option1\"><img src=\"./assets/object.png\" class=\"img2\"><p class=\"p2\"><span style=\"color:#57bcfa\">level</span>id</p></div><div class=\"option2\" id=\"option2\"><img src=\"./assets/object.png\" class=\"img2\" style=\"position: relative;right: 30px\"><p class=\"p2\" style=\"position:relative;top:-25px;right:-5px\"><span style=\"color:#57bcfa\">level</span>name</p></div></div>";
getDiv.style.height = "0px";
getDiv.style.width = "0px";

document.addEventListener('keydown', function(event) {
if (event.key === "Tab" && state === 1) {
t.innerHTML = "GET levelid";
document.body.querySelector(".pre").innerHTML = "<span class='get'>GET</span> <span class='color2'>levelid</span>";
document.body.removeChild(getDiv);
paused = false;
state = 1;
}

if (event.key === "Tab" && state === 2) {
t.innerHTML = "GET levelname";
document.body.querySelector(".pre").innerHTML = "<span class='get'>GET</span><span class='color2'>levelname</span>";
document.body.removeChild(getDiv);
paused = false;
state = 1;
}

if (event.key === "ArrowDown" && state === 1) {
option1 = document.getElementById('option1');
option2 = document.getElementById('option2');

option1.style.backgroundColor = "#222";
option2.style.backgroundColor = "#054499";
state = 2;
}

if (event.key === "ArrowUp" && state === 2) {
option1 = document.getElementById('option1');
option2 = document.getElementById('option2');

option2.style.backgroundColor = "#222";
option1.style.backgroundColor = "#054499";
state = 1;
}
}, { signal });
    break;
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

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
  document.addEventListener('keydown', function(event) {
if(event.key === "Tab") {
  async function wait() {
  await sleep(500);
  controller.abort();
  }
  wait();
}
});
    
</script>

<?php
require __DIR__ . "/lib/nanoLib.php";
require "../incl/lib/connection.php";
$nl = new nanoLib();
if(!empty($_COOKIE['text'])) {
    try {
$result = explode(" ", $_COOKIE['text']);

if(count($result) > 2 && str_contains($_COOKIE['text'], 'GET') && $result[2] !== 'JOIN') {
$x = 0;
foreach($result as $value) {
if($result[$x] === "AS") break;
if ($x < 3) {
    $x++;
    } else {
    $result[2] .= $result[$x];
    unset($result[$x]);
    $x++;
        }
    }
}

if($result[2] == 'JOIN' && str_contains($_COOKIE['text'], 'levelid') OR str_contains($_COOKIE['text'], 'comment')) {
    $x = 0;
foreach($result as $value) {
if ($x < 6) {
    $x++;
    } else {
    $result[5] .= $result[$x];
    unset($result[$x]);
    $x++;
        }
    }
    $result[4] = "\"$result[4]\"";
    $result[5] =  "\"$result[5]\"";
    }

$query = $db->prepare("SELECT isAdmin FROM accounts WHERE accountID = :accountID");
$query->execute(['accountID' => $_SESSION['accountID']]);
$isAdmin = $query->fetchColumn();

if(str_contains($_COOKIE['text'], 'UPDATE') OR str_contains($_COOKIE['text'], 'RATE') OR str_contains($_COOKIE['text'], 'DELETE')) {
  if(!$isAdmin) {
    $output = "ERROR 6: Not enough perms <a href=\"login.php\">Login</a>";
   echo '<div class="output">
<p><b>Output:</b></p><p class="output2"> '.$output.'</p>
</div>';
exit();
  }
}
if(str_contains($_COOKIE['text'], 'JOIN')) {
    $result = implode(" ", $result);
    $oldresult = strstr($result, "JOIN");
    $result = strstr($result, "JOIN", true);
    $result = str_replace("JOIN", "", $result);
    $oldresult = str_replace("JOIN", "", $oldresult);
    $oldresult = trim($oldresult);
    $result = trim($result);
    $result = explode(" ", $result);
    $oldresult = explode(" ", $oldresult);
eval('$oldoutput = $nl->'.$oldresult[0].'('.$oldresult[1].', '.$oldresult[2].');');
array_push($result, $oldoutput);
}

$result[1] = "\"$result[1]\"";
if(!is_numeric($result[2]) && !empty($result[2])) $result[2] = "\"$result[2]\"";
$result = array_filter($result);

switch(count($result)) {
    case 2:
eval('$output = $nl->'.$result[0].'('.$result[1].');');
break;
    case 3:
eval('$output = $nl->'.$result[0].'('.$result[1].', '.$result[2].');');
break;
      default:
eval('$output = $nl->'.$result[0].'('.$result[1].', '.$result[2].');');
}

if(str_contains($_COOKIE['text'], "AS")) {
  if(empty($output)) $output = "ERROR 5: Function could not be found or there was no output.";
    else {
    $lastIndex = end(explode(" ", $_COOKIE['text']));
    $query = $db->prepare("REPLACE INTO seafuncvars SET
    varName = :lastIndex, 
    varValue = :output");
    $query->execute([':lastIndex' => $lastIndex, ':output' => $output]);
    $output = "inserted into database, $output";
    }
  }

} catch(Exception $e) {
$output = $e;
} finally {
if(empty($output) OR !isset($output)) $output = "ERROR 5: Function could not be found or there was no output.";
// if(empty($result[0]) OR empty($result[1])) $output = "ERROR 1: No sufficient parameters were given.";
if(is_array($output)) {
  echo '
<div class="output">
<p><b>Output:</b></p><p>';
print_r($output);
echo '</p>
</div>';
} elseif(str_contains($output, 'ERROR') OR str_contains($output, 'PDO')) {
echo '
<div class="output">
<p><b>Output:</b></p><p class="output2"> '.$output.'</p>
</div>';
} else {
echo '<div class="output">
<p><b>Output: </b>'.$output.'</p>
</div>';
}
}
}

unset($_COOKIE['text']);
?>
