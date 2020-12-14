<?php

declare(strict_types=1);

namespace League\OpenAPIValidation\Schema\Exception;

use Exception;
use League\OpenAPIValidation\Schema\BreadCrumb;

class SchemaMismatch extends Exception
{
    /** @var BreadCrumb */
    protected $dataBreadCrumb;
    /** @var mixed */
    protected $data;
    /** @var mixed */
    protected $rawData;

    public function dataBreadCrumb() : ?BreadCrumb
    {
        return $this->dataBreadCrumb;
    }

    public function hydrateDataBreadCrumb(BreadCrumb $dataBreadCrumb) : void
    {
        if (!empty($dataBreadCrumb) ) {
             $this->rawData = json_encode($dataBreadCrumb->buildChain());
        }

        if ($this->dataBreadCrumb !== null or empty($dataBreadCrumb)) {
            return;
        }

        $this->dataBreadCrumb = $dataBreadCrumb;
    }

    public function withBreadCrumb(BreadCrumb $breadCrumb) : self
    {
        $this->dataBreadCrumb = $breadCrumb;

        return $this;
    }

    public function getRawData() : string
    {
        return $this->rawData;
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }
}
