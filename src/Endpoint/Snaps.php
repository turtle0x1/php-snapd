<?php

namespace dhope0000\Snap\Endpoint;

class Snaps extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/snaps';
    }

    public function all()
    {
        return $this->get($this->getEndpoint());
    }

    public function info(string $name)
    {
        return $this->get($this->getEndpoint() . "/$name");
    }
}
