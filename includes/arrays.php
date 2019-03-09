<?php
    $JUDGE = "data/judge/";
    $CODES = "data/codes/";
    $SUBMISSIONS = "data/submissions/";
    
    $pages = array(
        array(
            "title" => "Problem",
            "slug" => "home",
            "js" => "validate"
        ),
        array(
            "title" => "Submissions",
            "slug" => "submissions",
            "js" => "validate"
        ),
        array(
            "title" => "Teacher",
            "slug" => "teacher",
            "js" => "comparecodes",
            "onload" => "initBoxes"
        ),
        array(
            "title" => "View Code",
            "slug" => "viewcode"
        ),
        array(
            "title" => "Compare Codes",
            "slug" => "comparecodes"
        )
    );
?>