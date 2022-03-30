<?php

namespace App\Repositories\ScrapperRepository;

use App\Models\BookingData;
use App\Repositories\Repository;
use Exception;
use Goutte\Client;

class ScrapperRepository extends Repository implements ScrapperRepositoryInterface
{
    protected $model;

    public function __construct(BookingData $model)
    {
        parent::__construct($model);
    }

    public function getBookingInfo(string $url)
    {
        $client = new Client();

        try {

            $crawler = $client->request('GET', $url);

            $this->array = [];

            $crawler->filter('.hp__hotel-name')->each(function ($node) {
                $this->array['name'] = $node->text();
            });

            $crawler->filter('.hp_address_subtitle')->each(function ($node) {
                $this->array['address'] = $node->text();
            });

            $crawler->filter('#property_description_content')->each(function ($node) {

                $this->array['description'] = $node->text();
            });

            $crawler->filter('.hp-desc-review-highlight > strong')->each(function ($node) {

                $this->array['rating'] = $node->text();
            });

            $this->array['facilities'] = [];

            $crawler->filter('.important_facility')->each(function ($node) {
                array_push($this->array['facilities'], $node->text());
            });

            $this->array['images'] = [];

            $crawler->filter('a > img')->each(function ($node) {
                $src = $node->extract(array('src'));
                array_push($this->array['images'], $src[0]);
            });

            $this->array['advantages'] = [];

            $crawler->filter('.property_usp_item')->each(function ($node) {
                array_push($this->array['advantages'], $node->text());
            });


            return $this->array;
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }
}
