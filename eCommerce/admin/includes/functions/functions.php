<?php

    function getAll ($select, $table, $where = NULL, $and = NULL, $orderby, $ordering = 'DESC') {
        
        global $conn;
        
        $stmt = $conn->prepare("SELECT $select FROM $table $where $and ORDER BY $orderby $ordering");
        
        $stmt->execute();
        
        $All = $stmt->fetchAll();
        
        return $All;
        
    }    


    function getTitle () {
        
        global $pageTitle;
        
        if(isset($pageTitle)) {
            
            echo $pageTitle;
        
        } else {
            
            echo 'Default';
            
        }
        
    }

    function redirectHome ($msg, $url, $sec = 2) {
        
        echo "<div class='container' style='margin-top:50px'>";
            echo "<div class='row'>";
                echo $msg;
                header("refresh:$sec; url=$url");
                exit();
            echo "</div>";
        echo "</div>";
        
    }

    function checkItem ($select, $from, $where, $value) {
        
        global $conn;
        
        $stmt = $conn->prepare("SELECT $select FROM $from WHERE $where = ? ");
        $stmt->execute(array($value));
        $count = $stmt->rowCount();
        
        return $count;
        
    }

    function countMembers ($col, $table) {
        
        global $conn;
        
        $stmt = $conn->prepare("SELECT COUNT($col) FROM $table");
        $stmt->execute();
        $row = $stmt->fetch();
        return $row["COUNT($col)"];    
        
    }

    function latestCount ($select, $table, $order, $limit = 3) {

        global $conn;
        
        $stmt = $conn->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }