<?php


namespace App\Services\ScrapperService;

use App\Repositories\ScrapperRepository\ScrapperRepositoryInterface;

class ScrapperService implements ScrapperServiceInterface

{

    /**
     * @var ScrapperRepositoryInterface
     */
    private $scrapperRepository;

    public function __construct(
        ScrapperRepositoryInterface $scrapperRepository
    )
    {
        $this->scrapperRepository = $scrapperRepository;
    }


    public function getBookingInfo($url) {
        return $this->scrapperRepository->getBookingInfo($url);
    }


}