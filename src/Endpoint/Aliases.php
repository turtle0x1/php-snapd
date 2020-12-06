<?php

namespace dhope0000\Snap\Endpoint;

class Aliases extends AbstractEndpoint
{
    protected function getEndpoint()
    {
        return '/aliases';
    }

    public function all()
    {
        return $this->get($this->getEndpoint());
    }

    public function modify($action, $alias, $snap = "", $app = "")
    {
        return $this->post($this->getEndpoint(), [
            [
                "action"=>$action,
                "alias"=>$alias,
                "snap"=>$snap,
                "app"=>$app
            ]
        ]);
    }
}
