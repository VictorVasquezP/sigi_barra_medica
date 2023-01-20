<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class PrintPdf extends AbstractAction
{
    public function getTitle()
    {
        return 'PDF';
    }

    public function getIcon()
    {
        return 'voyager-receipt';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-success pull-right',
            'style' => 'margin-right: 5px',
            'target' => '_blank'
        ];
    }

    public function getDefaultRoute()
    {
        return route('command.pdf', $this->data->id);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'commands';
    }
}