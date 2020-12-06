<?php

namespace dhope0000\Snap\Endpoint;

class Apps extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/apps';
    }

    public function all()
    {
        return $this->get($this->getEndpoint());
    }

    public function modify(array $names, string $action, bool $enable = false, bool $disable = false, bool $reload = false)
    {
    }
}
