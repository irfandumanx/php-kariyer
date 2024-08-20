<?php

namespace Controllers;

use Attributes\LoginRequiredAttribute;
use GearmanClient;
use GearmanWorker;
use Models\AdvertModel;

#[LoginRequiredAttribute]
class IndexController extends BaseController
{

    public function __construct(
        readonly AdvertModel $advertModel = new AdvertModel()
    ){}

    public function index(): void
    {
        $page = 0;
        if (array_key_exists("page", $this->routeDTO->getQueryString()) && is_numeric($this->routeDTO->getQueryString()["page"]))
            $page = $this->routeDTO->getQueryString()["page"] - 1;

        $pageDatas = $this->advertModel->paginate()->getDataPage($page);
        view("index", ['adverts' => $pageDatas['data'],
            'currentPage' => $pageDatas['current_page'], 'totalPages' => $pageDatas['total_page']]);
    }

}