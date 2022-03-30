<?php

namespace App\Repositories\ScrapperRepository;


interface ScrapperRepositoryInterface{

    public function getBookingInfo(string $url);
    
}