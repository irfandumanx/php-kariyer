<?php

namespace Controllers;

use Attributes\LoginRequiredAttribute;
use Guid;
use Models\AdvertModel;
use Models\AppealAdvertsModel;
use Models\UserModel;
use Reflections;
use Requests\CreateAdvertRequest;
use Responses\JsonResponse;

#[LoginRequiredAttribute]
class AdvertController extends BaseController
{
    public function __construct(
        readonly AdvertModel $advertModel = new AdvertModel(),
        readonly AppealAdvertsModel $appealAdvertsModel = new AppealAdvertsModel(),
        readonly UserModel $userModel = new UserModel(),
    ){}

    public function create(CreateAdvertRequest $request): void
    {
        if ($this->isGet()) {
            view("createadvert");
            return;
        }
        if (!empty($this->err)) {
            view("createadvert", ['error' => $this->err]);
            return;
        }

        $data = Reflections::toArray($request);
        $data['user_id'] = $_SESSION['id'];
        $data['username'] = $_SESSION['username'];
        $data['id'] = Guid::generate();
        $this->advertModel->insert($data);

        redirect("/");
    }

    public function submissions(): void
    {//birden fazla başvurusu olanlar için cacheden okunabilir.
        $page = 0;
        if (array_key_exists("page", $this->routeDTO->getQueryString()) && is_numeric($this->routeDTO->getQueryString()["page"]))
            $page = $this->routeDTO->getQueryString()["page"] - 1;
        $userId = $_SESSION['id'];
        $pageDatas = $this->appealAdvertsModel->where("owner_id", $userId)->paginate(2)->getDataPage($page);
        $appeals = $pageDatas['data'] ?? [];
        $data = [];

        //buraya optimizasyon gerekiyor, db sorgusunu azalt.
        foreach ($appeals as $appeal) {
            if(!array_key_exists($appeal['advert_id'], $data)) {
                $data[$appeal['advert_id']] = [
                    "entity" => $this->advertModel->where("id", $appeal['advert_id'])->find()
                ];
                $data[$appeal['advert_id']]["appeals"]
                    = [$appeal['user_id'] => [$this->userModel->where("id", $appeal['user_id'])->find(),
                    'created_at' => $appeal['created_at'],]];
            }
            else
                $data[$appeal['advert_id']]["appeals"][$appeal['user_id']]
                    = [$this->userModel->where("id", $appeal['user_id'])->find(), 'created_at' => $appeal['created_at']];
        }
        view("submissionsadvert", ["datas" => $data, 'currentPage' => $pageDatas['current_page'], 'totalPages' => $pageDatas['total_page'] ]);
    }

    public function appeal(): JsonResponse
    {
        $advertId = $this->routeDTO->getQueryString()['id'];
        $userId = $_SESSION['id'];

        $adv = $this->advertModel->where("id", $advertId)->find();
        if ($adv == null)
            return new JsonResponse(['success' => false, 'message' => 'Böyle bir ilan bulunamadı'], 404);
        if ($adv->user_id == $userId)
            return new JsonResponse(['success' => false, 'message' => 'Kendi ilanına başvuramazsın'], 403);

        $data = $this->appealAdvertsModel->insert(['advert_id' => $advertId, 'user_id' => $userId, 'owner_id' => $adv->user_id]);
        if ($data == -1)
            return new JsonResponse(['success' => false, 'message' => 'Bu ilana zaten başvurdun'], 409);

        return new JsonResponse(['success' => true, 'message' => 'Başvuru başarıyla yapıldı'], 201);
    }

}