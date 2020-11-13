<?php

	function chngIP($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;

        }//this removes trailing spaces and makes it an html element so you can't rip it off, stripslashes removes any special characters if the user adds any.

?>