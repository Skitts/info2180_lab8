<?php
//get environment variables
$ip = getenv('IP');
$user = getenv('C9_USER');
$results = "";
$xml = false;

//echo($user);

//connects to the sql database
mysql_connect(
//echo($ip);
"$ip",
"$user"
);


//selects the world database
mysql_select_db("world");

//checks if format parameter was passed to the php call 
if(array_key_exists('format', $_GET))
{
    //parse string value of the format parameter 
    $format = strval($_REQUEST['format']);
    
    if(strcmp($format,'xml') == 0)
    {
        $xml = true;
    }
    else
    {
        $xml = false;
    }
}


//checks if lookup parameter was passed to the php call 
if(array_key_exists('lookup', $_GET))
{
    //parse string value of the lookup parameter
    $LOOKUP = strval($_REQUEST['lookup']);
    
    if(strlen($LOOKUP)>0)
    {
         $results = mysql_query("SELECT * FROM countries WHERE name LIKE '%$LOOKUP%';");
    }
    
    //echo $temp[1];

}


//checks if all parameter was passed to the php call 
else if(array_key_exists('all', $_GET))
{
    
    $ALL = $_REQUEST['all'];
    if((boolean)$ALL == true)
    {  
    # execute a SQL query on the database
        $results = mysql_query("SELECT * FROM countries;");
    }
}

//checks whether or not xml formatting is enabled
if((boolean)$xml == true)
{
    header("content-type: application/xml");
    displayXML($results);
}
else
{
    displayText($results);
}


//format data in xml format
function displayXML($results)
{
    
    
    echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
    echo "\n<countrydata>\n";
    
    while ($row = mysql_fetch_array($results))
    {
    
    echo "<country>\n";
    echo "<name>".$row["name"]."</name>\n";
    echo "<ruler>".$row["head_of_state"]."</ruler>\n";
    echo "</country>\n";
    
    }
    echo "</countrydata>";
    
    
    //echo $xmlData;
}


//display data as text
function displayText($results)
{
    while ($row = mysql_fetch_array($results))
    {
    
         echo "<li>".$row["name"].", ruled by ".$row["head_of_state"]."</li>";
  
    }
}

?>

