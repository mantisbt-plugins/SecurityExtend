<?php


function securityextend_block_bug($p_bug, $p_config_name) 
{
    $query = 'SELECT value FROM ' . plugin_table('config') . " WHERE name='" . $p_config_name . "'";
    $result = db_query($query);
    $row = db_fetch_array($result);
    if (!$row) {
        return;
    }

    $t_value = $row['value'];
    $t_value = str_replace("\r\n", "", $t_value); # bbcodeplus will add CR
    $t_value = str_replace("\n", "", $t_value);

    $t_keywords = explode(",", $t_value);

    #
    # Convert keyword list to regex and apply to bug subject, notes, etc
    #
    if (count($t_keywords) > 0 && !is_blank($t_keywords[0]))
    {
        $t_regex = "/(";
        foreach ($t_keywords as $t_keyword) {
            $t_regex = $t_regex.$t_keyword.'|';
        }
        $t_regex = rtrim($t_regex, "|").")+/i";

        check_text($t_regex, $p_bug->summary);
        check_text($t_regex, $p_bug->description);
        check_text($t_regex, $p_bug->steps_to_reproduce);
        check_text($t_regex, $p_bug->additional_information);
    }
}

function check_text($p_regex, $p_text)
{
    if (!is_blank($p_text)) {
        preg_match_all( $p_regex, $p_text, $t_matches );
        foreach( $t_matches[0] as $t_substring ) {
            trigger_error(ERROR_SPAM_SUSPECTED, ERROR);
            die();
        }
    }
}