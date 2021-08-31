<?php
//
/*
this page is used to display information on tmdb.php
This will return a table of movie content and will post to the tmdb.php
called with ajax method post
*/
//
include 'tmdbtoken.php';// grabes token for API

$movieId =  $_POST["movieId"];
$webtmdb = "https://api.themoviedb.org/3/movie/".$movieId."?api_key=".$tmdbtoken; // API link

//getGenras()
/*
function gets genras from json file we get from TMDB API
needs a json object
reurns string for a table 
*/
//
function getGenras($json){
	 $output = "";
    foreach($json['genres'] as $genres){
        $output .= "<td>".$genres['name']."</td>";
    }
    return $output;
}


//getMovieDB()
/*
function gets displays movie content on the page 
needs a url of API and movie ID, 
reurns table 
*/
//
function getMovieDB($webtmdb, $movieId){
    $url = $webtmdb;
    $mid = $movieId;
    if(!$curld = curl_init()){ //initilize curl
            exit;
    }
    curl_setopt($curld, CURLOPT_URL, $url); //loads information from url, in our case a json 
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true); //ends transfer 
    $prepros = curl_exec($curld); //executes setopt we set previosly 
    curl_close($curld); //close connection 
    $json = json_decode($prepros, true); // decode json file we got from API
    //
    /*
    make a table 
        original_title - movie name 
        getGenras() - gets genras 
        homepage - dispalys link for a home page, becsause there is no youtube link I put home page link 
        overview - movie describtion 
        https://www.themoviedb.org/t/p/w300_and_h450_bestv2/".$json['poster_path'] - poster image on a page 
    */
    //
    $output = "<style>th,td{padding: 15px;text-align: left; border-bottom: 1px solid #ddd;}</style><table><tr><td>Original title - ".$json['original_title']."</td></tr><tr><td>Genres - </td>".getGenras($json)."</tr><tr><td>Homepage - <a href='".$json['homepage']."'>HomePage</a></td></tr><tr><td>".$json['overview']."</td></tr><tr><img height='200' src='https://www.themoviedb.org/t/p/w300_and_h450_bestv2/".$json['poster_path']."'></tr><div id='movie_number' style='display:none'>".$mid."</div></table>";
    return $output;
}

//echo '<pre>';
echo getMovieDB($webtmdb, $movieId);


?>