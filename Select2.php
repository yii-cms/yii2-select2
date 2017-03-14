<?php

namespace yiicms\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;


class Select2 extends InputWidget
{
    public $items = [];

    /**
     * @var array
     * @see https://select2.github.io/options.html
     */
    public $clientOptions = [];

    public $clientEvents = [];

    public function run()
    {
        $this->registerPlugin('select2');
        Html::addCssClass($this->options, 'form-control');

        if ($this->hasModel()) {
            return Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options);
        } else {
            return Html::dropDownList($this->name, $this->value, $this->items, $this->options);
        }
    }

    protected function registerPlugin($name)
    {
        $view = $this->getView();
        Select2Asset::register($view);
        $id = $this->options['id'];
        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
            $js = "jQuery('#$id').$name($options);";
            $view->registerJs($js);
        }
        $this->registerClientEvents();
    }

    protected function registerClientEvents()
    {
        if (!empty($this->clientEvents)) {
            $id = $this->options['id'];
            $js = [];
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "jQuery('#$id').on('$event', $handler);";
            }
            $this->getView()->registerJs(implode("\n", $js));
        }
    }
}
