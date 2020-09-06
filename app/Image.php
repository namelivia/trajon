<?php
namespace App;

use Storage;

class Image {
    private $index;
    private $timestamp;
    private $url;
    private $download;
    private $year;
    private $month;
    private $day;
    private $hours;
    private $minutes;
    private $seconds;

    public function __construct(string $url)
    {
        $this->url = $url;
        $components = explode('-', $url);
        $this->index = $components[0];
        $this->timestamp = substr($components[1], 0, 14);
        $this->year = substr($this->timestamp, 0, 4);
        $this->month = substr($this->timestamp, 4, 2);
        $this->day = substr($this->timestamp, 6, 2);
        $this->hours = substr($this->timestamp, 8, 2);
        $this->minutes = substr($this->timestamp, 10, 2);
        $this->seconds = substr($this->timestamp, 12, 2);
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function getDownload()
    {
        return Storage::cloud()->temporaryUrl(
            $this->url, now()->addMinutes(5)
        );
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function getHours()
    {
        return $this->hours;
    }

    public function getMinutes()
    {
        return $this->minutes;
    }

    public function getSeconds()
    {
        return $this->seconds;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getThumb()
    {
        return Storage::cloud()->get($this->url);
    }
}
