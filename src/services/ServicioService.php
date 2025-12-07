<?php

require_once __DIR__ . '/BaseServices.php';
require_once __DIR__ . '/../repositories/ServicioRepository.php';

class ServicioService extends BaseServices
{
    public function __construct()
    {
        parent::__construct(new ServicioRepository());
    }
}

?>