<?php
    // PHP code to extract IP
    function getVisIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
            return $_SERVER['HTTP_X_REAL_IP'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
  
    // Store the IP address
    $vis_ip = getVisIPAddr();
    //$vis_ip = '52.25.109.230';
  
    // Use JSON encoded string and converts, it into a PHP variable
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));
        
    $geoplugin_countryName = $ipdat->geoplugin_countryName;
    $geoplugin_city = $ipdat->geoplugin_city;
        
    if (empty($geoplugin_countryName)) {
        $country = "Null";
    } else {
        $country = $geoplugin_countryName;
    }

    if (empty($geoplugin_city)) {
        $city = "Null";
    } else {
        $city = $geoplugin_city;
    }

    $date = date('Y-m-d');

    $sql_track = "SELECT * FROM visitor WHERE ip_address ='" . $vis_ip . "'";

    try {
        $stmt = $conn->prepare($sql_track);
        $stmt->execute();
        $saved_data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
    } catch (\Throwable $th) {
        var_dump($conn->error);
        throw $th;
    }
    
    if (empty($saved_data)) {

        $sql = "INSERT INTO visitor SET 
            ip_address ='" . $vis_ip . "', 
            visitor_counter = 1, 
            country ='" . $country . "',
            city = '" . $city . "',
            latest_date = $date";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
        } catch (\Throwable $th) {
            var_dump($conn->error);
            throw $th;
        }

        $id = $stmt->insert_id;

    }

    else {

        if ($saved_data[0]['latest_date'] != $date) {
            
            $visitor_counter = $saved_data[0]['visitor_counter'] + 1;

            $id = $saved_data[0]['id'];

            $sql = "UPDATE visitor SET
                visitor_counter = $visitor_counter,
                latest_date = $date WHERE id = $id LIMIT 1";

            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
            } catch (\Throwable $th) {
                var_dump($conn->error);
                throw $th;
            }
            
            $affect_count = $stmt->affected_rows;

        }
    }
   
?>

<?php

    $dbfile = ROOT_PATH . "/app/helpers/visitors.db"; // path to data file
    $expire = 300; // average time in seconds to consider someone online before removing from the list
 
    if (!file_exists($dbfile)) {
        die("Error: Data file " . $dbfile . " NOT FOUND!");
    }
 
    if (!is_writable($dbfile)) {
        die("Error: Data file " . $dbfile . " is NOT writable! Please CHMOD it to 666!");
    }
 
    function CountVisitors()
    {
        global $dbfile, $expire;
        $cur_ip = getVisIpAddr();
        $cur_time = time();
        $dbary_new = array();
 
        $dbary = unserialize(file_get_contents($dbfile));
        if (is_array($dbary)) {
            foreach($dbary as $user_ip => $user_time) {
            //while (list($user_ip, $user_time) = each($dbary)) {
                if (($user_ip != $cur_ip) && (($user_time + $expire) > $cur_time)) {
                    $dbary_new[$user_ip] = $user_time;
                }
            }
        }
        $dbary_new[$cur_ip] = $cur_time; // add record for current user
 
        $fp = fopen($dbfile, "w");
        fputs($fp, serialize($dbary_new));
        fclose($fp);
 
        $out = count($dbary_new);
        return $out;
    }
 
?>
