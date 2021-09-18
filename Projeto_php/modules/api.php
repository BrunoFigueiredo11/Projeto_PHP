<?php

class API
{


    public static function listaFilmes($page)
    {
        $url = 'https://api.themoviedb.org/3/discover/movie?api_key=4ec327e462149c3710d63be84b81cf4f&language=pt-br&sort_by=original_title.asc&include_adult=false&include_video=false&page=' . $page . '&with_watch_monetization_types=flatrate';
        $dados = json_decode(file_get_contents($url));
        API::exibeLista($dados);
    }
    public static function pesquisarFilmes($query, $page)
    {
        $url = 'https://api.themoviedb.org/3/search/movie?api_key=4ec327e462149c3710d63be84b81cf4f&language=pt-br&query=' . $query . '&page=' . $page . '&include_adult=false';
        @$dados = json_decode(file_get_contents($url));
        if (@$dados->results != null) {
            API::exibeLista($dados);
        } else {
            echo "<h2 class='erro'> " . $query . " Não Foi Encontrado!</h2>";
        }

        return @$dados->page;
    }
    public static function filmeId($idFilme)
    {
        $url = 'https://api.themoviedb.org/3/movie/' . $idFilme . '?api_key=4ec327e462149c3710d63be84b81cf4f&language=pt-br';
        @$dados = json_decode(file_get_contents($url));
        if (@$dados != null) {
            API::exibeFilme($dados);
        } else {
            echo "<h2 class='erro'> O Filme Não Foi Encontrado!";
        }
    }
    public static function exibeLista($dados)
    {

        echo "<section id='section-principal'>";
        foreach ($dados->results as $dados) {

            echo "<article id='films'>";
            echo "<div class='poster'><a href='DescFilme.php?id=" . $dados->id . "' class=''><img src='" . API::renderizaPoster($dados->poster_path) . "'  alt='Poster do filme'></a></div>";
            echo "<div class='content'>";
            echo "<h1>" . $dados->title . "</h1>";
            echo "<p>Data de lançamento: " . $dados->release_date . ".</p>";
            echo "<p>Genero: ";
            foreach ($dados->genre_ids as $da) {
                echo ' ' . API::listaGeneros($da) . ', ';
            }
            echo "</p>";
            echo "<p><h1>Resumo: </h1></p>";
            echo "<p>" . $dados->overview . "</p>";
            echo "</div>";
            echo "</article>";
        }

        echo "</section>";
    }

    public static function exibeFilme($dados)
    {
        echo "<section id='section-principal'>";

        echo "<article id='films'>";
        echo "<div class='bannerFilme'>";
        echo "<img class='banner' src='" . API::renderizaPoster($dados->backdrop_path) . "'  alt='Banner do filme'>";
        echo "<div ><img class='poster' src='" . API::renderizaPoster($dados->poster_path) . "'  alt='Poster do filme'></div>";
        echo "<div class='content'>";
        echo "<h2>" . $dados->title . "</h2> ";
        echo "<p><h1>Votação Média: " . $dados->vote_average . " / 10</h1></p> ";
        echo "<h1>Duração: " . API::time($dados->runtime) . "</h1>";
        echo "<p>Data de lançamento: " . $dados->release_date . ".</p>";
        echo "<p>Genero: ";
        foreach ($dados->genres as $da) {
            echo ' ' . API::listaGeneros($da->id) . ', ';
        }
        echo "</p>";
        echo "<p><h1>Resumo: </h1></p>";
        echo "<p>" . $dados->overview . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</article>";


        echo "</section>";
    }
    public static function renderizaPoster($urlPoster)
    {
        $poster = 'https://image.tmdb.org/t/p/w500/' . $urlPoster;
        return $poster;
    }
    public static function listaGeneros($idGenero)
    {
        $url = 'https://api.themoviedb.org/3/genre/movie/list?api_key=4ec327e462149c3710d63be84b81cf4f&language=pt-br';
        $dados = json_decode(file_get_contents($url));
        foreach ($dados->genres as $generos) {
            if ($generos->id == $idGenero) {
                return $generos->name;
            }
        }
    }

   public static function time($time)
    {
        $hora = floor($time/60);
        $minuto = ($time%60);
        return $hora.'h '.$minuto.' m';
    }
}
