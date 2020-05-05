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
    
    if (empty($geoplugin_countryName)) {
        $country = "Null";
    } else {
        $country = $ipdat->geoplugin_countryName;
    }

    if (empty($geoplugin_city)) {
        $city = "Null";
    } else {
        $city = $ipdat->geoplugin_city;
    }

    $date = date('Y-m-d');

    $saved_data = selectOne('visitor', ['ip_address' => $vis_ip]);
    
    if ($saved_data == 0) {
        $ip_data = array();
        $ip_data["ip_address"] = $vis_ip;
        $ip_data["visitor_counter"] = 1;
        $ip_data["country"] = $country;
        $ip_data["city"] = $city;
        $ip_data["latest_date"] = $date;
        
        create('visitor', $ip_data);
    } else {
        if ($saved_data['latest_date'] != $date) {
            $ip_Modify_data = array();
            $ip_Modify_data["visitor_counter"] = $saved_data['visitor_counter'] + 1;
            $ip_Modify_data["latest_date"] = $date;

            $id = $saved_data['id'];
            $topic_id = update('visitor', $id, $ip_Modify_data);
        }
    }
   
?>

<?php

    $dbfile = "visitors.db"; // path to data file
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
        $cur_ip = getIP();
        $cur_time = time();
        $dbary_new = array();
 
        $dbary = unserialize(file_get_contents($dbfile));
        if (is_array($dbary)) {
            while (list($user_ip, $user_time) = each($dbary)) {
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
 
    function getIP()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = "0";
        }
        return $ip;
    }
 
?>
