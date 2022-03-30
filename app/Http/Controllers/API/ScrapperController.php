<?php

namespace App\Http\Controllers\API;

use App\Jobs\BookingDotCom;
use App\Models\BookingData;
use App\Repositories\ScrapperRepository\ScrapperRepository;
use App\Services\ScrapperService\ScrapperService;
use Illuminate\Http\Request;

class ScrapperController { 

    public function getInfo(Request $request){

        $url  = $request->url;
   
        $scrapper_repository = new ScrapperService(new ScrapperRepository(new BookingData()));

        $data = $scrapper_repository->getBookingInfo($url);

       return response($data);

    }

}