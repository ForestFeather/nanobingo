<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A layout example that shows off a responsive product landing page.">
  <title>NaNoWriMo Bingo Card Generator </title>
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
  <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie.css">
  <![endif]-->
  <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive.css">
  <!--<![endif]-->
  <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
  <![endif]-->
  <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="css/layouts/marketing.css">
  <!--<![endif]-->
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
</head>
<body>
<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="">Nano Bingo</a>
        <ul>
            <li class="pure-menu-selected"><a href="#">Home</a></li>
        </ul>
    </div>
</div>

<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">NaNoWriMo Bingo Card Generator</h1>
        <p class="splash-subhead">
            Writing 50,000 words in a month is the main course.  Let's add some spice!
        </p>
    </div>
</div>

<div class="content-wrapper">
    <div class="content">
        <h2 class="content-head is-center">Your Bingo Card</h2>

        <div class="pure-g">
            <div class="l-box pure-u-1">
                <div class="pure-g">
                    <div class="pure-u-1 pure-u-lg-1-5">&nbsp;</div>
                    <div class="pure-u-1 pure-u--lg-3-5">
                    <table class="pure-table pure-table-bordered is-center">
<?
include('lists.php');

mt_srand();
if(isset($_GET['seed'])) { mt_srand($_GET['seed']); }

// Make the bingo items list
$items = Array();
foreach($ListItems as $key => $value) {
    if(isset($_GET[$key])) { $items = array_merge($items, $value); }
}

//print_r($items);

// Randomize it
$bingoItems = Array();
$usedNums = Array();
$num_items = count($items) - 1;
for ( $i = 25; $i >= 0; $i--)
{
    $j = 0;
    $counter = 0;
    $badValue = true;
    do {
        $j = @mt_rand(0, $num_items);

        if( !in_array($j, $usedNums)) {
            $badValue = false;
            array_push($usedNums, $j);
        } else {
            $counter++;
        }

    } while ( $badValue && $counter < 4 );

    $bingoItems[$i] = $items[$j];
}

$bingoHeader = Array('B','I','N','G','O');
echo "<thead><tr>";
for( $i = 0; $i < 5; $i++ ) {   echo "<th width='20%' class='is-center'>" . $bingoHeader[$i] . "</th>"; }
echo "</tr></thead>";
echo "<tbody>";
for( $i = 0; $i < 5; $i++ ) {
    echo "<tr>";
    for( $j = 0; $j < 5; $j++ ) {
        echo "<td>" . $bingoItems[($i*5) + $j] . "</td>";
        // echo "<td>SAMPLE CONTENT</td>";
    }
    echo "</tr>";
}
echo "</tbody>";
?>
            </table>
            </div>
            <div class="pure-u-1 pure-u-lg-1-5">&nbsp;</div>
            </div>
            <p class="is-center">
                Your Bingo Card is ready to be used.  Simply save this link, or print out this page to use your bingo card for NaNoWriMo.
            </p>
        </div>
    </div>
</div>

<div class="ribbon l-box-lrg pure-g">
    <!--<div class="l-box-lrg is-center pure-u-1 pure-u-md-1-2 pure-u-lg-2-5">
        <img class="pure-img-responsive" alt="File Icons" width="300" src="img/common/file-icons.png">
    </div>-->
    <div class="pure-u-1">

        <h2 class="content-head content-head-ribbon">Bingo Card Categories</h2>

        <p>
            You may select your bingo card challenge groups right here.  Make it as hard (or as simple) as you want.
        </p>
        <form class='pure-form' action='index.php' method="get"><fieldset>
        <label for='seed'>Seed</label>
        <input id='seed' name='seed' type='text' placeholder='Seed Value' value='<?php echo (isset($_GET['seed']) ? $_GET['seed'] : mt_rand()); ?>'>
        <div class="pure-g">
<?
foreach($ListItems as $category => $items) {
    echo "<div class='pure-u-1 pure-u-md-1-3 pure-u-lg-1-5'>";
    echo "<div class='l-box'><h3 class='content-head-ribbon'>".$category."</h3>";
    //echo "<label for='".$category$."'>";
    echo "<input type='checkbox' name='".$category."' id='".$category."' ";
    echo isset($_GET[$category]) ? 'checked' : '';
    echo ">";
    //echo "</label>";
    echo "<ul>";
    foreach($items as $item) { echo "<li>".$item."</li>"; }
    echo "</ul>";
    echo "</div></div>";
}

?>
    </div>
                    <button type='submit' class='pure-button pure-button-primary'>Generate</button>
                </fieldset>
            </form>
        </div>
    </div>

    <div class="footer l-box is-center">
        <p>Made by Collin 'Ridayah' O'Connor with help from Alexandra 'Chomskyrabbit' McGowan. &copy; 2014.  Questions, comments?  Contact <a href='mailto:webmaster_IfItsBetweenAndIncludesUnderscoresItsGone__@feather-mage.com'>Webmaster</a></p>
    </div>
</div>
</body>
</html>

