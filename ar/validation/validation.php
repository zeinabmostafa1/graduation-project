<?php 

function minLength($input,$length) {
    if(strlen($input) < $length){
        return false;
    }
    else{
        return true;
    }

}

function maxLength($input,$length) {
    if(strlen($input) > $length){
        return false;
    }
    else{
        return true;
    }

}

?>