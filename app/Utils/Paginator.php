<?php

namespace App\Utils;

class Paginator
{
    private $totalItems;
    private $currentPage;
    private $itemsPerPage;
    private $totalPages;

    public function __construct($totalItems, $currentPage = 1, $itemsPerPage = 10)
    {
        $this->totalItems = $totalItems;
        $this->currentPage = $currentPage;
        $this->itemsPerPage = $itemsPerPage;
        $this->totalPages = ceil($totalItems / $itemsPerPage);
    }

    public function getOffset()
    {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getLimit()
    {
        return $this->itemsPerPage;
    }

    public function renderPaginationLinks($url)
    {
        $html = '<nav aria-label="Page navigation">
                    <ul class="pagination float-end">';
        
        if ($this->currentPage != 1) {
            $html .= '<li class="page-item">
                        <a class="page-link" href="' . BASE_PATH . $url . '?page=' . ($this->currentPage - 1) . '" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>';
        }

        for ($i = 1; $i <= $this->totalPages; $i++) {
            $active = ($i == $this->currentPage) ? 'active' : '';
            $html .= '<li class="page-item ' . $active . '">
                        <a class="page-link" href="' . BASE_PATH . $url . '?page=' . $i . '">' . $i . '</a>
                    </li>';
        }

        if ($this->currentPage != $this->totalPages) {
            $html .= '<li class="page-item">
                        <a class="page-link" href="' . BASE_PATH . $url . '?page=' . ($this->currentPage + 1) . '" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>';
        }

        $html .= '</ul></nav>';

        return $html;
    }

}
