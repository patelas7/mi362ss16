<?php
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(TodoList\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');
    $site->setEmail('patelas7@cse.msu.edu');
    $site->setRoot('');
    //mysql://b3f6dadb19e2e4:908cd24f@us-cdbr-iron-east-03.cleardb.net/heroku_bad3aff56374fb0?reconnect=true
    $site->dbConfigure('mysql:host=us-cdbr-iron-east-03.cleardb.net;dbname=heroku_bad3aff56374fb0',
        'b3f6dadb19e2e4',       // Database user
        '908cd24f',     // Database password
        'mi362_');            // Table prefix

};