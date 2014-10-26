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
    <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
  <!--<![endif]-->
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
</head>
<body>
<div class="header no-print">
    <div class="no-print home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="">Nano Bingo</a>
        <ul>
            <li class="pure-menu-selected"><a href="#">Home</a></li>
            <li class="pure-menu"><a href="#Card">Bingo Card</a></li>
            <li class="pure-menu"><a href="#Settings">Settings</a></li>
            <li class="pure-menu"><a href="http://nanowrimo.org/">NaNoWriMo</a></li>
        </ul>
    </div>
</div>

<div class="splash-container no-print">
    <div class="splash">
        <h1 class="splash-head">Novel Writing Bingo Card Generator</h1>
        <p class="splash-subhead">
            Writing 50,000 words in a month is the main course.  Let's add some spice!
        </p>
    </div>
</div>

<div class="content-wrapper">
    <div class="content">
        <h2 id="Card" class="content-head is-center">Your Bingo Card</h2>

        <div class="pure-g">
            <div class="l-box pure-u-1">
                <div class="pure-g">
                    <div class="pure-u-1 pure-u-lg-1-5">&nbsp;</div>
                    <div class="pure-u-1 pure-u--lg-3-5">
                    <table class="pure-table pure-table-bordered is-center">
<?
include('lists.php');

$pregen = false;
if(isset($_GET['seed'])) { mt_srand($_GET['seed']); }
else { 
    $pregen = true; 
    mt_srand();
    $seed = @mt_rand(0, 9999999);
    mt_srand($seed);
}

// Make the bingo items list
$items = Array();
foreach($ListItems as $key => $value) {
    if(isset($_GET[$key]) || $pregen) { $items = array_merge($items, $value); }
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
        if ( isset($_GET['free']) && ($i*5 + $j) == 12 ) { echo "<td>FREE TILE</td>"; }
        else { echo "<td>" . $bingoItems[($i*5) + $j] . "</td>"; }
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
                Your Bingo Card is ready to be used.  Simply save this link, or print out this page to use your bingo card for novel writing.
            </p>
        </div>
    </div>
</div>

<div class="ribbon l-box-lrg pure-g no-print">
    <!--<div class="l-box-lrg is-center pure-u-1 pure-u-md-1-2 pure-u-lg-2-5">
        <img class="pure-img-responsive" alt="File Icons" width="300" src="img/common/file-icons.png">
    </div>-->
    <div class="pure-u-1">

        <h2 id="Settings" class="content-head content-head-ribbon">Bingo Card Categories</h2>

        <p>
            You may select your bingo card challenge groups right here.  Make it as hard (or as simple) as you want.  Clicking 'Generate' will recreate the same card seen on the page now.  Changing the seed without changing selected categories will generate a new card with the same groups as before.  If you wish to save a copy of your bingo card, just 'print' the page!  You will get your bingo card and only your bingo card.
        </p>
        <p>
Many thanks to the countless individuals who helped make this possible on the forums, supplying ideas and constantly encouraging us!  Thank you!  List ideas are always welcome, see below to contact us.
        </p>
        <form class='pure-form' action='index.php' method="get"><fieldset>
        <div class="pure-g">
            <div class='pure-u-1 pure-u-md-1-2 pure-u-lg-1-4'>
                <div class='l-box'>
                <h3 class='content-head-ribbon'>Settings</h3>
                <label class='content-head-ribbon' for='seed'>Seed</label>
                <input id='seed' name='seed' type='text' placeholder='Seed Value' value='<?php echo (isset($_GET['seed']) ? $_GET['seed'] : $seed); ?>'>
                <label class='pure-checkbox content-head-ribbon' for='free'>
                <input type='checkbox' id='free' name='free' <? echo isset($_GET['free']) ? 'checked' : '';  ?>> Free Center Tile
                </label>
                <div class='l-box'>
                <h4 class='content-head-ribbon'>Include:</h4>
                <? foreach($ListItems as $key => $value) { 
                    echo "<label class='pure-checkbox content-head-ribbon' for='".$key."'>";
                    echo "<input type='checkbox' id='".$key."' name='".$key."'";
                    echo ( isset($_GET[$key]) || $pregen ) ? 'checked' : '';
                    echo "> ".$key."</label>"; 
                } ?>
                </div>
                <button type='submit' class='pure-button pure-button-primary'>Generate</button>
            </div>
</div>
<?
$sortedListIndex = Array();
foreach($ListItems as $key => $value) {
    $sortedListIndex[$key] = count($value);
}

asort($sortedListIndex);
$sortedListItems = Array();
foreach($sortedListIndex as $key => $value) {
    $sortedListItems[$key] = $ListItems[$key];
}


foreach($sortedListItems as $category => $items) {
    echo "<div class='pure-u-1 pure-u-md-1-2 pure-u-lg-1-4'>";
    echo "<div class='l-box'><h3 class='content-head-ribbon'>".$category."</h3>";
    echo "<ul>";
    foreach($items as $item) { echo "<li>".$item."</li>"; }
    echo "</ul>";
    echo "</div></div>";
}

?>
    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <div class="footer l-box is-center no-print">
        <p>Made by Collin '<a href="https://www.twitter.com/meddeveloper">Ridayah</a>' O'Connor with help from Alexandra '<a href="https://www.twitter.com/chomskyrabbit">Chomskyrabbit</a>' McGowan. &copy; 2014.  Questions, comments?  Contact <a href='mailto:webmaster_IfItsBetweenAndIncludesUnderscoresItsGone__@feather-mage.com'>Webmaster</a></p>
    </div>
</div>
</body>
</html>

