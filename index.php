<?php

session_start();
require_once 'StackUtil.php';
require_once 'SeachResultModel.php';

$search_result = new SeachResultModel();

$showPOP = false;
$popMessage = "do something :) all of your's";

$stack_size = 0;

$util = new StackUtil();

if (isset($_POST['reset_datas'])){

    session_destroy();

}else {

    if (isset($_SESSION['util'])) {

        $util = unserialize($_SESSION['util']);

    }

    if (isset($_POST['push'])) {

        if (strlen($_POST['push']) > 0) {

            if (is_numeric($_POST['push'])) {

                if(!$push_state = $util->Push($_POST['push'])){
                    echo "<script> alert('Entered value is duplicated\\nPlease enter another value :)') </script>";
                }

            } else {

                echo "<script> alert('You can just input numbers :)') </script>";
            }

        } else {

            echo "<script> alert('Please Enter a Value :)') </script>";

        }
    }

    if (isset($_POST['pop'])) {

        if ($util->canPop()) {

            $popMessage = $util->Pop();
            $showPOP = true;

        } else {

            $popMessage = "Stack is empty !";
            $showPOP = false;

        }
    }

    if (isset($_POST['search'])) {
        $showPOP = false;
        $search_result = $util->Search($_POST['search']);
        if (!$search_result->isFinded()){

            echo "<script> alert('Not Finded !') </script>";

        }
    }

    if (isset($_POST['sort'])) {
        if ($util->Size() != 0) {
            $util->Sort();
        }else{
            echo "<script> alert('Stack size is 0 .') </script>";
        }
    }
}

$stack_size = $util->Size();
$_SESSION['util'] = serialize($util);

?>


<html>
<head>
    <title>StackSample - PHP</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

<section id="main_section">

    <div id="header_div">

        Stack sample with PHP - Benyamin Chookan

    </div>

    <div id="head_divider"></div>

    <!-- Left Side -->
    <div id="left_side">

        <div id="info">

            <p id="info_p">
                Stack Size : <?php echo $stack_size ?>
            </p>

            <div id="stack_items">

                <?php
                foreach ($util->getStack() as $item){
                    echo "<p id='stack_item'>".$item."</p>";
                }

                ?>
            </div>

        </div>

    </div>


    <!-- Right Side -->
    <div id="right_side">

        <div id="new_data">
            <p>
                <form action="" method="post">

                    <input id="form_text" name="push" type="text" placeholder="Enter a Number"/>

                    <input class="form_submit" type="submit" value="Push"/>

                </form>

                <form action="" method="post">

                    <input id="form_text" name="search" type="text" placeholder="Enter a Number"/>

                    <input class="form_submit" type="submit" value="search"/>

                </form>

                <form action="" method="post">

                    <input class="form_submit" name="pop" type="submit" value="Pop"/>

                    <input class="form_submit" name="sort" type="submit" value="Sort"/>

                    <input class="form_submit" name="reset_datas" type="submit" value="Reset Datas"/>

                </form>

            </p>

        </div>

        <div id="container">
            <?php


                if ($search_result->isFinded()){
                    echo "<div id='search_result' >
                                    
                                    Searched Value : ".$search_result->getSearched()." 
                                    <br>
                                    <br>
                                    Index in List : ".$search_result->getIndex()."
                                    <br>
                                    <br>
                                    Items After : ".$search_result->getAfter()."
                                    <br>
                                    <br>
                                    Items Before : ".$search_result->getBefore()."
                          </div>";
                }else{
                    if ($showPOP){

                        echo "<div id='main_operation'> <p> Stack Pop is :<br><br>".$popMessage."</p></div>";

                    }else{

                        echo "<div id='main_operation'> <p> $popMessage </p></div>";

                    }
                }

            ?>
        </div>

    </div>


</section>


</body>
</html>