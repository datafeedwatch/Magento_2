<?php
/**
 * Created by Q-Solutions Studio
 * Date: 29.08.16
 *
 * @category    DataFeedWatch
 * @package     DataFeedWatch_Connector
 * @author      Lukasz Owczarczuk <lukasz@qsolutionsstudio.com>
 */

namespace DataFeedWatch\Connector\Block\Adminhtml\System\Config\Form\Button;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Refresh extends Field
{
    /**
     * @param AbstractElement $element
     *
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $url     = $this->getUrl('datafeedwatch/system_config_button/refresh');
        $onclick = sprintf("setLocation('%s')", $url);
        $html    = $this->getLayout()
                        ->createBlock('Magento\Backend\Block\Widget\Button')
                        ->setType('button')
                        ->setClass('scalable')
                        ->setLabel(__('Refresh'))
                        ->setOnClick($onclick)
                        ->toHtml();
        
        return $html;
    }
}