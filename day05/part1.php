<?php
    require_once 'reader.php';
    require_once 'runmaps.php';

    function work(int $grp) {
        $file_content = file_get_contents(__DIR__ . '/inputgrp' . $grp);
        $data = read_input($file_content);
        run_maps($data);
    }
