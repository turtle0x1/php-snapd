<?php

namespace dhope0000\Snap\Endpoint;

class Icons extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/icons';
    }

    public function getIcon(string $snap)
    {
        return $this->get($this->getEndpoint() . "/$snap/icon");
    }
}
