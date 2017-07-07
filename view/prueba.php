<?php
//get the word submitted from the form
$word = "universo";
$img_pattern = "#<img src=http\S* width=[0-9]* height=[0-9]*>#";
// validate the word
if ($word != '') {
// initialise the session
$ch = curl_init();
// Set the URL
curl_setopt($ch, CURLOPT_URL, "http://images.google.com/images?gbv=1&hl=en&sa=1&q='hentay'&btnG=Search+images");
// Return the output from the cURL session rather than displaying in the browser.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//Execute the session, returning the results to $curlout, and close.
$curlout = curl_exec($ch);
curl_close($ch);
preg_match_all($img_pattern, $curlout, $img_tags);
//display the results - I'll leave the formatting to you
print("Resultado de la busqueda $word: ".sizeof($img_tags[0])."<br/>\n");
foreach ($img_tags[0] as $val){
print(" ".$val."\n");
}
}
?>