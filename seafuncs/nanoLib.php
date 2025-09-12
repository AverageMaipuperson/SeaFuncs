<?php
class nanoLib {
    public function GET($type, $param1, $param2 = "") {
        require "../incl/lib/connection.php";
        if(!is_numeric($type)) $type = strtolower($type);
        if(!is_numeric($param1)) $param1 = strtolower($param1);
        if(!is_numeric($param2)) $param2 = strtolower($param2);
        
        
        if(empty($type)) {
            $output = "ERROR 1: Parameters are empty.";
            } else {
        
        switch ($type) {
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
                    if(!$query->rowCount() ) {
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
                    $dbh = "SELECT * FROM $param1";
                    $query = $db->prepare($dbh);
                    $query->execute();
                    $output = $query->fetch();
                    }
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
                break;
                $query = $db->prepare("UPDATE levels SET starFeatured = 0, starEpic = 0 WHERE levelID = :levelID");
            $query->execute([':levelID' => $levelID]);
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
    
    public function EXISTS($type, $param1, $param2 = "") {
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
                $output = "$output | <b>Level:</b> $b";
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
        }
    return $output;
    }
    
    public function RAND($type, $onlyDisplayLevelID = 0) {
        require "../incl/lib/connection.php";
        switch($type) {
            case "level":
                $query = $db->prepare("SELECT * FROM levels ORDER BY RAND() LIMIT 1;");
                $query->execute();
                $result = $query->fetch();
if($onlyDisplayLevelID === 1) {
    $output = $result['levelID'];
} else {
$output = 'Level: '.$result['levelName'].' | Level ID: '.$result['levelID'].'';
}
            break;
            default:
            $output = "ERROR 4: Type is invalid";
        }
    return $output;
    }
}
?>