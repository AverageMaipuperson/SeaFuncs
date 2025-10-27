<?php session_start();
class nanoLib {

    private function rgb_valid(int $red, int $green, int $blue): bool
{
    if ($red < 0 || $red > 255) {
        return false;
    }

    if ($green < 0 || $green > 255) {
        return false;
    }

    if ($blue < 0 || $blue > 255) {
        return false;
    }

    return true;
}
    private function checkthenlower($var) {
            if(!is_numeric($var)) $e = strtolower($var);
            return $e;
            }
    public function GET($type, $param1, $param2 = "") {
        require "../incl/lib/connection.php";
        $array = [$type, $param1, $param2];
        foreach($array as $v) {
        $v = $this->checkthenlower($v);
        }
        
        if(empty($type)) {
            $output = "ERROR 1: Parameters are empty.";
            } else {   
        
        switch ($type) {
            case 'levels': 
             if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } else {

                    $data = match($param1) {
                        'levelid' => 'levelID',
                        'levelname' => 'levelName',
                        'username' => 'userName',
                        default => 'levelID',

                    };

                switch($param2) {
                    case 'unrated':
                    $condition = "starDifficulty = 0 OR starStars = 0";
                    break;
                    case 'rated':
                    $condition = " starStars > 0";
                    break;
                    case 'feature':
                    case 'featured':
                    $condition = " starFeatured > 0";
                    break;
                    case 'epic':
                    $condition = "starEpic > 0 OR starHall > 0";
                    break;
                    case 'auto':
                    $condition = " starStars = 1 OR starAuto = 1";
                    break;
                    case 'easy':
                    $condition = " starDifficulty = 10";
                    break;
                    case 'normal':
                    $condition = " starDifficulty = 20";
                    break;
                    case 'hard':
                    $condition = " starDifficulty = 30";
                    break;
                    case 'harder':
                    $condition = " starDifficulty = 40";
                    break;
                    case 'insane':
                    $condition = " starDifficulty = 50 AND starDemon = 0";
                    break;
                    case 'demon':
                    $condition = " starDemon > 0";
                    break;
                    case 'tiny':
                    $condition = "levelLength = 0";
                    break;
                     case 'short':
                    $condition = "levelLength = 1";
                    break;
                     case 'medium':
                    $condition = "levelLength = 2";
                    break;
                     case 'long':
                    $condition = "levelLength = 3";
                    break;
                     case 'xl':
                    $condition = "levelLength > 3";
                    break;
                     case '2p':
                    case 'twoplayer':
                    case '2player':
                    $condition = "twoPlayer > 0";
                    break;
                     case 'coins':
                    case 'withcoins':
                    $condition = "coins > 0";
                    break;
                     case 'verifiedcoins':
                    case 'starcoins':
                    $condition = "starCoins > 0";
                    break;
                    default:
                    $condition = "1";
                }
                
                $f = "SELECT $data FROM levels WHERE $condition";
                    $query = $db->prepare($f);
                    $query->execute();
                    if($query->rowCount() == 0) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $output = $query->fetchAll();
                    }
                }
                break;
            case 'levelid':
                if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } else {
                    $param1 = str_replace(' ', '', $param1);
                    $param1 = strtolower($param1);
                    $query = $db->prepare("SELECT levelID FROM levels WHERE REPLACE(LOWER(levelName), ' ', '') = :param1");
                    $query->execute([':param1' => $param1]);
                    if(!$query->rowCount() ) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $output = $query->fetchColumn();
                    }
                }
                break;
                case 'levelname':
                if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } elseif(!is_numeric($param1)) {
                    $output = "ERROR 3: Invalid user input: not numeric";
                    } else {
                    $query = $db->prepare("SELECT levelName FROM levels WHERE levelID = $param1");
                    $query->execute();
                    if (!$query->rowCount() ) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $output = $query->fetchColumn();
                    }
                }
                break;
                case 'username':
                if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } elseif(!is_numeric($param1)) {
                    $output = "ERROR 3: Invalid user input: not numeric";
                    } else {
                    $query = $db->prepare("SELECT userName FROM users WHERE userID = $param1");
                    $query->execute();
                    if(!$query->rowCount() ) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $output = $query->fetchColumn();
                    }
                }
                break;
                case 'accountname':
                if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } elseif(!is_numeric($param1)) {
                    $output = "ERROR 3: Invalid user input: not numeric";
                    } else {
                    $query = $db->prepare("SELECT userName FROM accounts WHERE accountID = $param1");
                    $query->execute();
                    if(!$query->rowCount() ) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $output = $query->fetchColumn();
                    }
                }
                break;
                case 'userid':
                case 'uid':
                    if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } elseif(!is_string($param1)) {
                    $param1 = "'$param1'";
                    } else {
                    $query = $db->prepare("SELECT userID FROM users WHERE LOWER(userName) = :param1");
                    $query->execute([':param1' => $param1]);
                    if(!$query->rowCount() ) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $output = $query->fetchColumn();
                    }
                }
                break;
                case 'accountid':
                case 'accid':
                    if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } else {
                    $query = $db->prepare("SELECT accountID FROM accounts WHERE LOWER(userName) = :userName");
                    $query->execute([':userName' => $param1]);
                    if(!$query->rowCount() ) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $output = $query->fetchColumn();
                    }
                } 
                break;
                case 'commentid':
                    if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } else {
                    $query = $db->prepare("SELECT commentID FROM comments WHERE LOWER(comment) = :comment");
                    $query->execute([':comment' => base64_encode($param1)]);
                    if(!$query->rowCount() ) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $output = $query->fetchColumn();
                    }
                } 
                break;
                case 'comment':
                if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } elseif(!is_numeric($param1)) {
                    $output = "ERROR 3: Invalid user input: not numeric";
                    } else {
                    $query = $db->prepare("SELECT comment FROM comments WHERE commentID = :param1");
                    $query->execute([':param1' => $param1]);
                    if(!$query->rowCount() ) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $output = $query->fetchColumn();
                    $output = base64_decode($output);
                    }
                }
                break;
                case 'comments':
                if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } elseif(!is_numeric($param1)) {
                    $output = "ERROR 3: Invalid user input: not numeric";
                    } else {
                    $query = $db->prepare("SELECT * FROM levels WHERE levelID = :param1");
                    $query->execute([':param1' => $param1]);
                    if(!$query->rowCount() ) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $query = $db->prepare("SELECT COUNT(*) FROM comments WHERE levelID = :param1");
                    $query->execute([':param1' => $param1]);
                    $output = $query->fetchColumn();
                    }
                }
                break;
                case 'stats':
                    if(!is_numeric($param1)) {
                    $output = "ERROR 3: Invalid user input: not numeric";
                    } else {
                $query = $db->prepare("SELECT likes, downloads FROM levels WHERE levelID = :levelID");
                $query->execute([':levelID' => $param1]);
                if($query->rowCount() === 0) {
                    $output = "ERROR 2: Not found";
                    } else {
                    $result = $query->fetch();
                    $likes = $result['likes'];
                    $downloads = $result['downloads'];
                    $output = "<b>Likes: $likes</b> | <b>Downloads: $downloads";
                    }
                }
                break;
                case 'data':
                    if(empty($param1)) {
                    $output = "ERROR 1: Parameters are empty";
                } else {
                    $query = $db->prepare("SELECT * FROM :param1");
                    $query->execute([':param1' => $param1]);
                    $output = $query->fetchAll();
                    }
                break;
                case 'variable':
                    $query = $db->prepare("SELECT varValue FROM seafuncvars WHERE varName = :varName");
                    $query->execute([':varName' => $param1]);
                    $output = $query->fetchColumn();
                    if($query->rowCount() === 0) $output = "ERROR 4: Not found"; 
                break;
                default:
                $output = "ERROR 4: Type is invalid";
            }
        }
    return $output;
    }
    
    public function UPDATE($type, $param1, $param2 = "") {
        require "../incl/lib/connection.php";
        require "../incl/lib/mainLib.php";
        $gs = new mainLib();
        
        $type = strtolower($type);
        $param1 = strtolower($param1);
        $param2 = strtolower($param2);
        
        if(empty($type)) {
            $output = "ERROR 1: Parameters are empty.";
            } else {
        switch($type) {
            case 'levelname':
               $oldname = $gs->getLevelName($param1);
               if(!is_numeric($param1) OR strlen($param2) > 30) {
                   $output = "ERROR 3: Invalid user input (might be caused from wrong syntax)";
                   } elseif(empty($param2)) {
                    $output = "ERROR 1: Parameters are empty";
                    } elseif(!$oldname) {
                        $output = "ERROR 2: Not found";
                        } else {
                    $query = $db->prepare("UPDATE levels SET levelName = :newname WHERE levelID = :levelID");
                    $query->execute([':newname' => $param2, ':levelID' => $param1]);
                    $output = 'Operation done';
                
                }
            break;
            case 'admin':
                if(!is_numeric($param2)) {
                    $output = "ERROR 3: Invalid user input, has to be account id";
                    }
                if($param1 === 'on') {
                    $query = $db->prepare("UPDATE accounts SET isAdmin = 1 WHERE accountID = $param2");
                    $query->execute();
                    $output = 'Operation done';
                    } elseif($param1 === 'off') {
                    $query = $db->prepare("UPDATE accounts SET isAdmin = 0 WHERE accountID = $param2");
                    $query->execute();
                    $output = 'Operation done';
                    } else {
                    $output = "ERROR 3: Invalid user input";
                }
            break;
            case 'coins':
                    if($param1 == 'verify') {
                    $query = $db->prepare("UPDATE levels SET starCoins = 1 WHERE levelID = :param2");
                    $query->execute([':param2' => $param2]);
                    $output = 'Operation done';
                    } elseif($param1 == 'unverify') {
                   $query = $db->prepare("UPDATE levels SET starCoins = 0 WHERE levelID = :param2");
                    $query->execute([':param2' => $param2]);
                    $output = 'Operation done';
                    } else {
                    $output = "ERROR 3: Invalid user input";
                }
                break;
            }
        }
    return $output;
    }
    
    public function RATE($levelID, $amount, $type = "star") {
        require "../incl/lib/connection.php";
        require "../incl/lib/mainLib.php";
        $gs = new mainLib();


        
        $type = strtolower($type);

            if(!is_numeric($levelID) OR $amount > 10 OR $amount < 0) {
            $output = "ERROR 3: Invalid user input";
            } else {
            
            $starDifficulty = $gs->getDiffFromStars($amount)['diff'];
            
            if($type != 'unrate') {
            $query = $db->prepare("UPDATE levels SET starStars = :starStars, starDifficulty = :starDifficulty, rateDate = :date WHERE levelID = :levelID");
            $query->execute([':starStars' => $amount, ':starDifficulty' => $starDifficulty, ':date' => time(), ':levelID' => $levelID]);
            }
            
            if($amount === 1 && $type != 'unrate') {
                $query = $db->prepare("UPDATE levels SET starAuto = 1 WHERE levelID = :levelID");
                $query->execute([':levelID' => $levelID]);
                } elseif($amount === 10 && $type != 'unrate') {
            $query = $db->prepare("UPDATE levels SET starDemon = 1 WHERE levelID = :levelID");
            $query->execute([':levelID' => $levelID]);
            } elseif($amount === 0) {
                $query = $db->prepare("UPDATE levels SET starStars = 0, starDifficulty = 0, starAuto = 0, starDemon = 0, rateDate = 0 WHERE levelID = :levelID");
                $query->execute([':levelID' => $levelID]);
            }

        
            
            switch($type) {
                case 'star':
                case 'starrate':
                $query = $db->prepare("UPDATE levels SET starFeatured = 0, starEpic = 0 WHERE levelID = :levelID");
            $query->execute([':levelID' => $levelID]);
                break;
                case 'featured':
                case 'feature':
                $query = $db->prepare("UPDATE levels SET starFeatured = 1 WHERE levelID = :levelID");
            $query->execute([':levelID' => $levelID]);
                break;
                case 'epic':
                $query = $db->prepare("UPDATE levels SET starEpic = 1 WHERE levelID = :levelID");
            $query->execute([':levelID' => $levelID]);
                break;
                case 'unrate':
                $query = $db->prepare("UPDATE levels SET starStars = 0, starDifficulty = 0, starAuto = 0, starDemon = 0, rateDate = 0 WHERE levelID = :levelID");
                $query->execute([':levelID' => $levelID]);
                break;
            }   
        $output = 'Operation done';
        }
    return $output;
    }
    
    public function EXISTS($type, $param1, $param2 = "true") {
        require "../incl/lib/connection.php";
        require "../incl/lib/mainLib.php";
        $gs = new mainLib();


        
        $type = strtolower($type);
        
        switch($type) {
            case 'level':
            if(!is_numeric($param1)) {
                $output = "ERROR 3: Invalid user input";
            } else {
            $query = $db->prepare("SELECT levelName FROM levels WHERE levelID = :levelID");
            $query->execute([':levelID' => $param1]);
            if($query->rowCount() > 0) {
                $output = "true";
                $b = $query->fetchColumn();
                if($param2) $output = "$output | <b>Level:</b> $b";
                } else {
                $output = "false";
                }
            }
            break;
            case 'comment':
            if(!is_numeric($param1)) {
            $output = "ERROR 3: Invalid user input";
            } else {
            $query = $db->prepare("SELECT comment FROM comments WHERE commentID = :commentID");
            $query->execute([':commentID' => $param1]);
            if($query->rowCount() > 0) {
                $output = "true";
                $b = base64_decode($query->fetchColumn());
                $output = "$output | <b>Comment:</b> $b";
                } else {
                $output = "false";
                }
            }
             case 'account':
            if(!is_numeric($param1)) {
            $output = "ERROR 3: Invalid user input";
            } else {
            $query = $db->prepare("SELECT userName FROM accounts WHERE accountID = :accountID");
            $query->execute([':accountID' => $param1]);
            if($query->rowCount() > 0) {
                $output = "true";
                $b = $query->fetchColumn();
                $output = "$output | <b>Account:</b> $b";
                } else {
                $output = "false";
                }
            }
        }
        return $output;
    }

    public function DELETE($type, $param) {
        require "../incl/lib/connection.php";
        require "../incl/lib/mainLib.php";
        $gs = new mainLib();


        
        $type = strtolower($type);
        switch ($type) {
            case 'level':
                if(!is_numeric($param)) {
                    $output = "ERROR 3: Invalid user input";
                } else {
                    $query = $db->prepare("DELETE FROM levels WHERE levelID = :levelID");
                    $query->execute([':levelID' => $param]);
                    $output = "Operation done";
                }
            case 'comment':
                if(!is_numeric($param)) {
                    $output = "ERROR 3: Invalid user input";
                } else {
                    $query = $db->prepare("DELETE FROM comments WHERE commentID = :commentID");
                    $query->execute([':commentID' => $param]);
                    $output = "Operation done";
                }

             case 'account':
                if(!is_numeric($param)) {
                    $output = "ERROR 3: Invalid user input";
                } else {
                    $query = $db->prepare("DELETE FROM accounts WHERE accountID = :accountID");
                    $query->execute([':accountID' => $param]);
                    $output = "Operation done";
                }
        }
    return $output;
    }
    
    public function RAND($type, $onlyDisplayLevelID = 0) {
        require "../incl/lib/connection.php";
        switch($type) {
            case "level":
                $query = $db->prepare("SELECT * FROM levels ORDER BY RAND() LIMIT 1");
                $query->execute();
                $result = $query->fetch();
if($onlyDisplayLevelID === 1) {
    $output = $result['levelID'];
} else {
$output = 'Level: '.$result['levelName'].' | Level ID: '.$result['levelID'].'';
}
            break;
            case "comment":
                $query = $db->prepare("SELECT * FROM comments ORDER BY RAND() LIMIT 1");
                $query->execute();
                $result = $query->fetch();
if($onlyDisplayLevelID === 1) {
    $output = $result['commentID'];
} else {
$comment = base64_decode($result['comment']);
$output = 'Comment: '.$comment.' | Commented By: '.$result["userName"].' | Comment ID: '.$result['commentID'].'';
}
            break;
             case "user":
                $query = $db->prepare("SELECT * FROM users ORDER BY RAND() LIMIT 1");
                $query->execute();
                $result = $query->fetch();
if($onlyDisplayLevelID === 1) {
    $output = $result['userID'];
} else {
$userID = $result['userID'];
$output = 'UserID: '.$userID.' | User Name: '.$result["userName"].'';
}
            break;
            default:
            $output = "ERROR 4: Type is invalid";
        }
    return $output;
    }
    public function LOGIN($username, $password) {
        require "../incl/lib/connection.php";
        require "../incl/lib/mainLib.php";
        $gs = new mainLib();
        $username = strtolower($username);

        $queryc = $db->prepare("SELECT * FROM accounts WHERE LOWER(userName) = :username");
        $queryc->execute([':username' => $username]);
        if($queryc->rowCount() === 0) {
            $output = "ERROR 2: Account not found.";
            } elseif(empty($username) || empty($password)) {
            $output = "ERROR 1: Parameters are empty";
            } else {
        $querys = $db->prepare("SELECT accountID, isAdmin FROM accounts WHERE LOWER(userName) = :username");
        $querys->execute([':username' => $username]);   
        $result = $querys->fetch();
        $accountID = $result['accountID'];
        $isAdmin = $result['isAdmin'];
         $querys = $db->prepare("SELECT password FROM accounts WHERE accountID = :id");
         $querys->execute([':id' => $accountID]);
        $verifypassword = $querys->fetchColumn();
        if(empty($verifypassword)) $output = "ERROR: Unknown error";
        else {
            
        $verified = password_verify($password, $verifypassword);

            if($verified) {
                switch($isAdmin) {
                    case 1:
                        $output = "Logged in as admin! | Account ID: $accountID | Username: $username";
                        $_SESSION['isAdmin'] = true;
                    break;
                    default:
                        $output = "ERROR 8: Not an admin account.";
                    }
                } else {
                $output = "ERROR 7: Wrong password.";
                }
            }
        }
            return $output;
    }

    public function LOGOFF() {
        if(!empty($_SESSION['isAdmin'])) { 
            $_SESSION['logoffQuestion'] = true;
        return "Are you sure you want to logoff? y/n"; }
        else return "ERROR 9: Not logged in";
        
    }

    public function y() {
        if($_SESSION['logoffQuestion']) {
            $_SESSION['isAdmin'] = null; 
            $_SESSION['logoffQuestion'] = null;
            return "Logged off!";
        } 
        else {
            $_SESSION['logoffQuestion'] = null;
            return;
        } 
    }

    public function n() {

        if($_SESSION['logoffQuestion']) {$_SESSION['logoffQuestion'] = false;return "Cancelled";}
        else {$_SESSION['logoffQuestion'] = false;return;}
    }

    public function NEW($what, $param1, $param2, $param3, $param4, $param5, $param6 = null) {
    require "../incl/lib/connection.php";
    require "../incl/lib/mainLib.php";
    $gs = new mainLib();
        switch($what) {
            case 'mappack':
            case 'mapack':
                $levelarray = explode(',', $param1);
                foreach($levelarray as $level) {
                    $level = trim($level);
                    $query = $db->prepare("SELECT * FROM levels WHERE levelID = :levelID");
                    $query->execute([':levelID' => $level]);

                    if(!$query->rowCount()) {
                        $output = "ERROR 2: Not found";
                        return $output;
                    }
                }
                $levelarray = implode(",", $levelarray);

                $rgb = explode(",", $param2);

                foreach($rgb as $color) {
                    $color = trim($color);
                }

                if(!$this->rgb_valid($rgb[0], $rbg[1], $rgb[2])) {
                    $output = "ERROR 3: Invalid user input";
                    return $output;
                }

                 $rgb = implode(",", $rgb);

                 $query = $db->prepare("INSERT INTO mappacks(name, levels, stars, coins, difficulty, rgbcolors, colors2, timestamp) VALUES (:name, :levels, :stars, :coins, :difficulty, :rgb, :rgb2, :timestamp)");
                 $query->execute([':name' => $param5 . $param6, ':levels' => $levelarray, ':stars' => $param3, ':coins' => $param4, ':difficulty' => $gs->getDiffFromStars($param3), ':rgb' => $rgb, ':rgb2' => $rgb, ':timestamp' => time()]);
                
                 $output = "Inserted into mappacks";
            break;
            default:
            $output = "ERROR 3: Invalid user input";
        }
        return $output;
    }

}
?>
