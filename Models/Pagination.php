<?php

namespace Models;

class Pagination
{

    public function __construct(private readonly BaseModel $model, private readonly int $perPageData){
    }

    public function getTotalPage(): float
    {
        return ceil($this->model->count(false) / $this->perPageData);
    }

    public function getDataPage($page): ?array
    {
        $totalPage = $this->getTotalPage() - 1;
        if ($page > $totalPage)
            $page = 0;
        else if ($page < 0)
            $page = $totalPage;
        $offset = $page * $this->perPageData;
        return ['current_page' => $page, 'total_page' => $totalPage,
            'data' => $this->model->limit($this->perPageData, $offset)];
    }

}