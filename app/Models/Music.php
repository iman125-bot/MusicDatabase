<?php

namespace App\Models;

class Music
{
    protected static $musics = [
        [
            'id' => 1,
            'title' => 'Bohemian Rhapsody',
            'artist' => 'Queen',
            'album' => 'A Night at the Opera',
            'year' => 1975,
            'genre' => 'Rock',
            'duration' => '00:05:56'
        ],
        [
            'id' => 2, 
            'title' => 'Billie Jean',
            'artist' => 'Michael Jackson',
            'album' => 'Thriller',
            'year' => 1982,
            'genre' => 'Pop',
            'duration' => '00:04:54'
        ]
    ];

    public static function all()
    {
        return self::$musics;
    }

    public static function find($id)
    {
        foreach (self::$musics as $music) {
            if ($music['id'] == $id) {
                return $music;
            }
        }
        return null;
    }

    public static function create($data)
    {
        $newId = count(self::$musics) + 1;
        $newMusic = [
            'id' => $newId,
            'title' => $data['title'],
            'artist' => $data['artist'],
            'album' => $data['album'] ?? null,
            'year' => $data['year'] ?? null,
            'genre' => $data['genre'] ?? null,
            'duration' => $data['duration'] ?? null
        ];
        
        array_push(self::$musics, $newMusic);
        return $newMusic;
    }

    public static function update($id, $data)
    {
        foreach (self::$musics as &$music) {
            if ($music['id'] == $id) {
                $music = array_merge($music, $data);
                return $music;
            }
        }
        return null;
    }

    public static function delete($id)
    {
        foreach (self::$musics as $key => $music) {
            if ($music['id'] == $id) {
                array_splice(self::$musics, $key, 1);
                return true;
            }
        }
        return false;
    }
}