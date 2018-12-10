<?php

class CronCommand extends CConsoleCommand
{
    function curl_fetch($cid, $keyword, $settings)
    {
        // Get CURL settings as variables
        extract($settings);

        // User Agents to be sent as part of request.
        $user_agents = array("Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:24.0) Gecko/20100101 Firefox/24.0",
                             "Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0",
                             "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/534.57.7 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.7",
                             "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/4.0; InfoPath.2; SV1; .NET CLR 2.0.50727; WOW64)",
                             "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)",
                             "Mozilla/5.0 (Windows; U; MSIE 9.0; Windows NT 9.0; en-US)",
                             "Mozilla/5.0 (compatible; Konqueror/4.5; FreeBSD) KHTML/4.5.4 (like Gecko)",
                             "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36",
                             "Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 1.0.3705; .NET CLR 1.1.4322)",
                             "Mozilla/5.0 (compatible; MSIE 7.0; Windows NT 5.2; WOW64; .NET CLR 2.0.50727)",
                             "Mozilla/5.0 (X11; Linux) KHTML/4.9.1 (like Gecko) Konqueror/4.9",
                             "Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36"
                            );

        $ua_inx = rand(0, 11);

        // Create google search URL
        $GURL = $setting_1."/search?q=".urlencode($keyword);

        // Log file for verbose
        $curl_log = fopen("curl.txt", 'w+');

        // Delay Search
        $delay = rand(5, 15);
        sleep($delay);

        // Fetching keyword results using CURL.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $GURL);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agents[$ua_inx]);
        curl_setopt($ch, CURLOPT_PROXY, $setting_3);
        curl_setopt($ch, CURLOPT_TIMEOUT, $setting_4);
        curl_setopt($ch, CURLOPT_MAXREDIRS, $setting_5);
        curl_setopt($ch, CURLOPT_VERBOSE, $setting_6);
        curl_setopt($ch, CURLOPT_STDERR, $curl_log); // Write verbose to file
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $setting_7);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $setting_8);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $setting_9);
        curl_setopt($ch, CURLOPT_FAILONERROR, $setting_10);
        $data = curl_exec($ch);

        // Rewind the file pointer so that we read the verbose written
        rewind($curl_log);
        $verbose = fread($curl_log, 6048);
        fclose($curl_log);
        curl_close($ch);

        // If not successful return false
        if($data === false)
            return false;
        else
        {
            // Insert the verbose in to database
            $model = new verbose;
            $model->attributes = array("cid" => $cid, "keyword" => $keyword, "verbose" => $verbose, "html" => $data, "vdate" => date("Y-m-d H:i:s"));
            $model->save();

            return true;
        }
    }

    public function run($args)
    {   
        echo date("Y-m-d H:i:s");
        // Fetch all the active campaign records randomly for Today.
        $collect = Yii::app()->db->createCommand()
                                            ->select('*')
                                            ->from('tbl_daily_cron')
                                            ->where('DATE(stat_date) = DATE(NOW()) AND count < per_day')
                                            ->order('rand()')
                                            ->queryAll();

        // Setup the CURL Settings
        $settings = Yii::app()->db->createCommand()
                                            ->select('*')
                                            ->from('tbl_settings')
                                            ->queryAll();

        // Trimming the white spaces around settings
        $settings = array_map('trim', $settings[0]);

        // Setting the default values if they are empty.
        $settings['setting_1'] = rtrim($settings['setting_1'], "/");

        if(empty($settings['setting_1']))
            $settings['setting_1'] = "http://www.google.com";
        if(empty($settings['setting_2']))
            $settings['setting_2'] = "Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 1.0.3705; .NET CLR 1.1.4322)";
        if(empty($settings['setting_3']))
            $settings['setting_3'] = "switchproxy.proxify.net:7498";
        if(empty($settings['setting_4']))
            $settings['setting_4'] = 25;
        if(empty($settings['setting_5']))
            $settings['setting_5'] = 7;
        if(empty($settings['setting_6']))
            $settings['setting_6'] = 1;
        if(empty($settings['setting_7']))
            $settings['setting_7'] = 1;
        if(empty($settings['setting_8']))
            $settings['setting_8'] = 0;
        if(empty($settings['setting_9']))
            $settings['setting_9'] = 0;
        if(empty($settings['setting_10']))
            $settings['setting_10'] = 0;

        // Important Count, it will be used to loop through the keywords array till the per day count is reached.
        $i = 0;

        // Store Update query for each keyword count
        $update_query = "";
        
        // Main loop for all the active campaign keywords to be sent to google search.
        while(count($collect))
        {
            // Get the keyword for google search
            $keyword = $collect[$i]['search_term'];

            // Hit the google using CURL
            $success = $this->curl_fetch($collect[$i]['cid'], $keyword, $settings);

            if($success)
            {
                // The count for Per Cron value.
                $collect[$i]['tmp']++;

                // The Actual Count of search term at any instant.
                $collect[$i]['count']++;

                // Check if per cron count is reached.
                if($collect[$i]['tmp'] >= $collect[$i]['per_cron'])
                {
                    // Update Query will be added here later
                    $update_query .= "update tbl_daily_cron set count = ".$collect[$i]['count']." where stat_id = ".$collect[$i]['stat_id'].";
                                      update tbl_campaigns set google_count = google_count + ".$collect[$i]['tmp']." where cid = ".$collect[$i]['cid'].";";

                    // Once the per day count is reached the keyword record is removed from the array.
                    array_splice($collect, $i, 1);
                }
                else
                    $i++; // Goto Next Keyword

                // Reset loop if it reachs end of the array. This will continue till the per cron count for each keyword is reached.
                if($i >= count($collect))
                    $i = 0;
            }
        }

        // Execute all Update queries at once
        if(!empty($update_query))
            Yii::app()->db->createCommand($update_query)->query();

        echo "\n".date("Y-m-d H:i:s");

        //Halting the script as we don't want any viw to be rendered.
        exit;
    }
}

?>