<?php

namespace Application\View\Helper;
 
use Zend\View\Helper\AbstractHelper;

class RenderForm extends AbstractHelper
{

    public function __invoke($form) {
    
        $form->prepare();
        $html = $this->view->form()->openTag($form);
        $elements = $form->getElements();
      
        foreach ($elements as $element) {
            $html .= $this->view->formRow($element);
        }
      
        $html .= $this->view->form()->closeTag($form);
      
        return $html;

    }

}
