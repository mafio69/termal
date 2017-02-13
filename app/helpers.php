<?php
function dayWeek($data)
{
    $day = false;
    $dzien_tyg = date("l", strtotime($data));
    switch ($dzien_tyg) {
        case 'Monday':
            $day = "poniedziałek";
            break;
        case 'Tuesday':
            $day = "wtorek";
            break;
        case 'Wednesday':
            $day = "środa";
            break;
        case 'Thursday':
            $day = "czwartek";
            break;
        case 'Friday':
            $day = "piątek";
            break;
        case 'Saturday':
            $day = "sobota";
            break;
        case 'Sunday':
            $day = "niedziela";
            break;
    }

    return $day;
}

function czas($data)
{ // zmienne pomocne przy obliczeniach (dlugość w sekundach)
    $tydzien = 7 * 24 * 60 * 60;
    $dzien = 24 * 60 * 60;
    $godzina = 60 * 60;
    $minuta = 60;


    If (time() > strtotime($data)) {
        $marker = time() - (strtotime($data));
        $time_stamp = $marker;


        if ((floor($marker / $tydzien) >= 1)) {

            $t = floor($marker / $tydzien);
            $marker = $marker - ($t * $tydzien);
        } else $t = 0;

        if ((floor($marker / $dzien) >= 1)) {
            $d = floor($marker / $dzien);
            $marker = $marker - ($d * $dzien);
        } else $d = 0;
        if ((floor($marker / $godzina) >= 1)) {
            $g = floor($marker / $godzina);
            $marker = $marker - ($g * $godzina);
        } else $g = 0;
        if ((floor($marker / $minuta) >= 1)) {
            $m = floor($marker / $minuta);

        } else $m = 0;

        if ($time_stamp < 60) {
            return '<span class="text-danger bg-danger"> Krótko po terminie </span>';
        } elseif ($t < 1 && $d > 0) {
            return '<span class="text-danger bg-danger">Po terminie: ' . $d . ' d, ' . $g . ' g, ' . $m . ' m.</span> ';
        } elseif ($t < 1 && $d < 1 && $g > 0) {
            return '<span class="text-danger bg-danger">Po terminie: ' . $g . '  g, ' . $m . ' m.</span>';
        } elseif ($t < 1 && $d < 1 && $g < 1 && $m > 0) {
            return '<span class="text-danger bg-danger">Po terminie: ' . $m . '  m. </span>';
        } elseif ($t > 1 && $t < 2) {
            return '<span class="text-danger bg-danger">Po terminie: ' . $t . ' tyg, ' . $d . ' d, ' . $g . ' g ' . $m . ' m .</span>';
        } else {
            //return $time_stamp . '-' . $t . '-' . $d;
            return '<span class="text-danger bg-danger">Po terminie więcej niż tydzeń.</span>';
        }
    } else {
        $marker = (strtotime($data)) - time();
        $time_stamp = $marker;
        //$marker = abs($marker);
        // zmienne pomocne przy obliczeniach (dlugość w sekundach)


        if ((floor($marker / $tydzien) >= 1)) {

            $t = floor($marker / $tydzien);
            $marker = $marker - ($t * $tydzien);
        } else $t = 0;

        if ((floor($marker / $dzien) >= 1)) {
            $d = floor($marker / $dzien);
            $marker = $marker - ($d * $dzien);
        } else $d = 0;
        if ((floor($marker / $godzina) >= 1)) {
            $g = floor($marker / $godzina);
            $marker = $marker - ($g * $godzina);
        } else $g = 0;
        if ((floor($marker / $minuta) >= 1)) {
            $m = floor($marker / $minuta);

        } else $m = 0;

        if ($time_stamp < 60) {
            return '<span class="text-warning bg-warning">Mało czasu pozostało</span>';
        } elseif ($t < 1 && $d > 0) {
            return '<span class="text-success bg-success">Pozostało: ' . $d . ' d, ' . $g . ' g, ' . $m . ' m. </span>';
        } elseif ($t < 1 && $d < 1 && $g > 0) {
            return '<span class="text-success bg-success">Pozostało: ' . $g . '  g, ' . $m . ' m.</span>';
        } elseif ($t < 1 && $d < 1 && $g < 1 && $m > 0) {
            return '<span class="text-warning bg-warning">Pozostało: ' . $m . '  m. </span>';
        } elseif ($t > 1 && $t < 2) {
            return '<span class="text-success bg-success ">Pozostało: ' . $t . ' tyg., ' . $d . ' d, ' . $g . ' g ' . $m . ' m .</span>';
        } else {
            //return $time_stamp . '-' . $t . '-' . $d;
            return '<span class="text-success bg-success">Pozostało jeszcze, więcej niż tydzień.</span>';
        }
    }
}
 function dzien($data)
 {
     $dzien = date("Y-m-d",strtotime($data));
     return $dzien;
 }
function godzina($data)
{
    $godzina = date("H:i:s",strtotime($data));
    return $godzina;
}