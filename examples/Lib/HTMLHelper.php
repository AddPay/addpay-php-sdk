<?php

class HTMLHelper
{
    public function getHeader($title = 'Example', $appendContent = '')
    {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="utf-8">';
        echo '<title>' . $title . '</title>';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<meta name="description" content="">';
        echo '<meta name="author" content="">';
        echo '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">';
        echo '<link href="https://fonts.googleapis.com/css?family=Quicksand:200,300,400,500,600,700" rel="stylesheet">';
        echo '<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>';
        echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
        echo '<style> body {padding-top: 60px; font-family: Quicksand, Roboto } h1,h2,h3,h4 { margin: 0; padding: 0; line-height: 22px; font-weight: 300 !important; }</style>';
        echo '</head>';
        echo '<body>';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-lg-12">';
        echo '<center><h1>' . $title . '</h1></center>';
        echo '</div>';
        echo '<div class="col-lg-12">';
        echo $appendContent;
    }

    public function getFooter($prependContent = '')
    {
        echo $prependContent;
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    }
}
