<?php

class DailyCommand extends CConsoleCommand
{
    public function run($args)
    {
        // Delete Verbose & Raw HTML entries of Campaigns
        $camps = Yii::app()->db->createCommand()
                                 ->select('cid')
                                 ->from('tbl_campaigns')
                                 ->queryAll();

        // Loop through all campaigns
        for($i=0; $i<count($camps); $i++)
        {
            // Create database columns as variables
            extract($camps[$i]);            

            /* 
                "SET @deleting = (SELECT COUNT(*) FROM tbl WHERE roomid = 1) - 3;
                -- run only if @deleting is > 0
                PREPARE stmt FROM 'DELETE FROM tbl WHERE roomid = 1 ORDER BY entryid LIMIT ?';
                EXECUTE stmt USING @deleting;"
             */

            $sql = "SET @deleting = (SELECT COUNT(*) FROM tbl_verbose WHERE cid = $cid);
                    -- run only if @deleting is > 0
                    PREPARE stmt FROM 'delete from tbl_verbose where vid not in (
                                              select vid
                                              from (
                                                  select vid
                                                  from tbl_verbose
                                                  where DAY(vdate) < DAY(NOW()) AND MONTH(vdate) = MONTH(NOW()) AND YEAR(vdate) = YEAR(NOW()) AND cid = $cid 
                                                  group by day(vdate), keyword
                                                  order by vdate                                                  
                                                  ) t
                                            ) AND cid = $cid LIMIT ?';
                    EXECUTE stmt USING @deleting;";

            // Execute the SQL script
            Yii::app()->db->createCommand($sql)->query();
        }

        exit;
        // Check if already RUN
        $check = Yii::app()->db->createCommand()
                                            ->select('COUNT(*)')
                                            ->from('tbl_daily_cron')
                                            ->where('DATE(stat_date) = DATE(NOW())')
                                            ->queryScalar();

        if(!$check)
        {
            // Fetch all the active campaign records randomly
            $collect = Yii::app()->db->createCommand()
                                                ->select('*')
                                                ->from('tbl_campaigns')
                                                ->where('active = :act', array(':act' => '1'))
                                                ->order('rand()')
                                                ->queryAll();

            // Create SQL insertion query so that all the records will be inserted at once.
            $sql = "INSERT INTO tbl_daily_cron (cid, search_term, country, per_day, per_cron, count, stat_date) VALUES";
            for($i=0; $i<count($collect); $i++)
            {
                // Create database columns as variables
                extract($collect[$i]);

                // Our cron runs 48 times a day, so calculating how many times the search should be triggered in single cron run.
                $single_time = ceil(($per_day/48));

                // Creating insertion for all the 3 search keywords.
                if(!empty($search_term))
                    $sql .= "($cid, '$search_term', '$country', $per_day, $single_time, 0, '".date("Y-m-d H:i:s")."'),";
                if(!empty($refine1))
                    $sql .= "($cid, '$refine1', '$country', $per_day, $single_time, 0, '".date("Y-m-d H:i:s")."'),";
                if(!empty($refine2))
                    $sql .= "($cid, '$refine2', '$country', $per_day, $single_time, 0, '".date("Y-m-d H:i:s")."'),";

            }

            // Execute the SQL script once, no need to insert for each record, this will reduce queries on database.
            Yii::app()->db->createCommand(rtrim($sql, ",").";")->query();
        }        

        //Halting the script as we don't want any viw to be rendered.
        exit;
    }
}
?>