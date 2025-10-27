<?php session_start();?>
<!DOCTYPE html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cascadia+Code:ital,wght@0,200..700;1,200..700&display=swap" rel="stylesheet">
<link href="./styles/seafuncs.css?t=<?php echo time();?>" rel="stylesheet">
</head>
<body>
  <form action="" method="post">
<div class="message">
  <div class="pre"></div>
  <div class="text" id="text" type="text" contenteditable spellcheck="false"></div>
</div>
<br>
<input id="submit" class="button" type="submit" value="Submit" /><br><br></form>
<script src="./scripts/main.js?t=<?php echo time();?>"></script>
<?php
if($reportErrors) error_reporting(E_ALL); else error_reporting(0);
if(file_exists('./lib/nanoLib.php')) {
    require "./lib/nanoLib.php";
} else {
    die('File <b>nanoLib.php<b> not found. Please reinstall seafuncs.');
}

if($needsAdmin && $_SESSION['isAdmin'] != true && !str_contains($_COOKIE['text'], 'LOGIN') && !str_contains($_COOKIE['text'], 'LOGOFF')) {
  $output = "ERROR 6: Not enough perms. Login typing <b>LOGIN (username) (password)</b>.";
    echo '<div class="output" id="output">

<p><b>Output:</b></p><p class="output2"> '.$output.'</p><br>
</div>
';
exit();
}
require "../incl/lib/connection.php";
$outputs = [];
$text = $_COOKIE['text'] ?? '';

$text = str_replace("<br>", PHP_EOL, $text);
$text = str_replace("&nbsp;", " ", $text);
$text = strip_tags($text);
$text = trim($text);
if(!empty($text)) {
  $nl = new nanoLib();
  $output = null;
    try {
$lines = explode('\\', $text);
foreach($lines as $querycode) {
    
$result = '';
$lastIndex = '';
$output = '';

$result = explode(" ", $querycode);

if(count($result) > 2 && str_contains($querycode, 'GET') && $result[2] !== 'JOIN' && $result[1] !== 'levels') {
$x = 0;
foreach($result as $value) {

  if(count($result) < 3) {
    $output = "Fatal unknown error";
    array_push($outputs, $output);
    continue;
  }
if ($x < 3) {
    $x++;
    } else {
    $result[2] .= $result[$x];
    unset($result[$x]);
    $x++;
        }
    }
}

if($result[2] == 'JOIN' && (str_contains($querycode, 'levelid') OR str_contains($querycode, 'comment'))) {
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



if(str_contains($querycode, 'JOIN')) {
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

$method = array_shift($result);
$output = $nl->$method(...$result);

  array_push($outputs, $output);
}
} catch(Exception $e) {
 array_push($outputs, $e->getMessage());
} finally {
  $x = 0;
  echo '<div class="output" id="output" onload="onLoad();">';
foreach($outputs as $output) {
    if(empty($output) OR !isset($output)) $output = "ERROR 5: Function could not be found or there was no output.";
    $x++;
    if(is_array($output)) {
      $e = $output; $output = null; $z = 0;
      foreach($e as $array) {
        if(is_array($array)) {
          $z++;
          $suboutput = "";
          $d = 0; // i just fucking gave up with variable names bruh
          foreach($array as $name => $value) {
            $d++;
            if(empty($value)) continue;
            if($d < count($array) && $d != 1) {
            $suboutput .= "$name: $value, ";
            } elseif($d == 1) $suboutput .= '<p style="text-align:center">Array<button onclick="
            var array'.$z.' = document.getElementById(\'array'.$z.'\');
            var button'.$z.' = document.getElementById(\'button'.$z.'\');
            
            if(clicktype == 0) {
            array'.$z.'.style.opacity = 1;
            button'.$z.'.innerHTML = \'-\';
            clicktype = 1;
          } else {
            array'.$z.'.style.opacity = 0;
            button'.$z.'.innerHTML = \'+\';
            clicktype = 0;
          }
            console.log(\'type = \' + clicktype);"  id="button'.$z.'">+</button><span id="array'.$z.'" style="opacity:0"> [' .$name.': '.$value.'';
            else $suboutput .= "$name: $value]</span></p>";
          }
          $output .=  "<b>". $z . ".</b> $suboutput <br>";
        } else {
        $z++;
        $output .=  $z . ". $array[0] <br>";
      }
    }
        echo '
<p><b>Output n°'.$x.':</b></p><p>';
        print_r($output);
        echo '</p><br>
';
    } elseif(str_contains($output, 'ERROR') OR str_contains($output, 'PDO')) {
        echo '

<p><b>Output n°'.$x.':</b></p><p class="output2"> '.$output.'</p><br>
';
    } else {
        echo '
<p><b>Output n°'.$x.': </b>'.$output.'</p><br>
';
    }
}

echo '<button id="remove" class="x">X</button>';
echo '</div></body>';
}
};

setcookie('text', '', time() - 3600, '/');
?>
<script>
  const x = document.querySelector('.x');
x.addEventListener('click', function() {
  const outputDiv = document.querySelector('.output');
  outputDiv.remove();
});
document.addEventListener('keydown', function(event) {
if(event.key === "Escape") {
  const outputDiv2 = document.querySelector('.output');
  outputDiv2.remove();
}
});

dragElement(document.getElementById("output"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

 
document.addEventListener('DOMContentLoaded', () => {

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.x');
    if (btn) btn.closest('.output')?.remove();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') document.querySelectorAll('.output').forEach(o => o.remove());
  });

  const makeDraggable = (elm) => {
    if (!elm || !(elm instanceof Element)) return;
    const header = elm.querySelector('.output-header') || elm;
    if (getComputedStyle(elm).position === 'static') elm.style.position = 'absolute';
    header.style.touchAction = 'none';
    header.style.cursor = 'move';

    let startX = 0, startY = 0, origLeft = 0, origTop = 0, dragging = false;

    function startPointer(e) {
      e.preventDefault();
      dragging = true;
      header.setPointerCapture?.(e.pointerId);
      startX = e.clientX; startY = e.clientY;
      origLeft = elm.offsetLeft; origTop = elm.offsetTop;
      document.addEventListener('pointermove', movePointer);
      document.addEventListener('pointerup', endPointer, { once: true });
    }
    function movePointer(e) {
      if (!dragging) return;
      elm.style.left = (origLeft + e.clientX - startX) + 'px';
      elm.style.top  = (origTop  + e.clientY - startY) + 'px';
    }
    function endPointer(e) {
      dragging = false;
      header.releasePointerCapture?.(e.pointerId);
      document.removeEventListener('pointermove', movePointer);
    }

    header.addEventListener('pointerdown', startPointer);

    if (!window.PointerEvent) {
      header.addEventListener('mousedown', (e) => {
        e.preventDefault();
        startX = e.clientX; startY = e.clientY; origLeft = elm.offsetLeft; origTop = elm.offsetTop;
        function mm(ev) { elm.style.left = (origLeft + ev.clientX - startX) + 'px'; elm.style.top  = (origTop + ev.clientY - startY) + 'px'; }
        function mu() { document.removeEventListener('mousemove', mm); document.removeEventListener('mouseup', mu); }
        document.addEventListener('mousemove', mm);
        document.addEventListener('mouseup', mu);
      });
    }
  };

  // initialize
  document.querySelectorAll('.output').forEach(makeDraggable);

  // wtf
  const observer = new MutationObserver((mutations) => {
    for (const m of mutations) {
      for (const n of m.addedNodes) {
        if (n.nodeType === 1 && n.classList.contains('output')) makeDraggable(n);
        // also handle outputs nested inside added nodes
        n.querySelectorAll?.('.output').forEach(makeDraggable);
      }
    }
  });
  observer.observe(document.body, { childList: true, subtree: true });
});
</script>
