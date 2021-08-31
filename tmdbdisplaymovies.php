<?php
//
/*
this page is used to display information on index.php
This will return a table of movie content and will post to the index.php
called with ajax method post
*/
//
include 'sql.php';// grabes sql connection to database 
include 'tmdbtoken.php';// grabes token for API


$tmdbmovies = "SELECT * FROM moviedb;"; //selects all movies 

$tmdbmovies_res = mysqli_query($sql, $tmdbmovies); //checks for movies 

if (mysqli_num_rows($tmdbmovies_res) > 0) { // if there movies we will return movie title and poster 1 by 1
    while ($row = mysqli_fetch_row($tmdbmovies_res)){ // we get rows 
    $movieId =  $row[0]; // from databse we get movie ID that we have 
    $webtmdb = "https://api.themoviedb.org/3/movie/".$movieId."?api_key=".$tmdbtoken; //making API link for getMovieDB
    $out = getMovieDB($webtmdb, $movieId); // makes a table 
    echo $out; // post it to the html page 
    }
} else {
    echo "No Movies";
}

//not used 
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
function getMovieDB($webtmdb, $mid){
    $url = $webtmdb;

    if(!$curld = curl_init()){
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
        https://www.themoviedb.org/t/p/w300_and_h450_bestv2/".$json['poster_path'] - poster image on a page 
    */
    //
    $output = "<style>th,td{padding: 15px;text-align: left; border-bottom: 1px solid #ddd;} .img{vertical-align:bottom;}</style><tr><th><a href='tmdb.php/?movieId=".$mid."'>".$json['original_title']."</a></th><td class='img'><a href='tmdb.php/?movieId=".$mid."'><img height='200'  class='img' src='https://www.themoviedb.org/t/p/w300_and_h450_bestv2/".$json['poster_path']."'></a></td></tr><div id='movie_number' style='display:none'>".$mid."</div>";
    return $output;
}

//echo '<pre>';
//echo getMovieDB($webtmdb);


?>