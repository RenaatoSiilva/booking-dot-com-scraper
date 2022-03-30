<?php

namespace App\Services\ScrapperService;


interface ScrapperServiceInterface{

    public function getBookingInfo(string $url);

}