<?php
/**
 * @package ImpressPages
 *
 */
namespace Ip\Module\Content;


class PublicController extends \Ip\Controller
{
    public function index()
    {
        //TODOX set page specific layout
        if (
            \Ip\ServiceLocator::getContent()->getLanguageUrl() != ipGetCurrentlanguage()->getUrl() ||
            ipGetCurrentPage()->getType() === 'error404'
        ) {
            return new \Ip\Response\PageNotFound();
        }

        if (in_array(ipGetCurrentPage()->getType(), array('subpage', 'redirect')) && !ipIsManagementState()) {
            return new \Ip\Response\Redirect(ipGetCurrentPage()->getLink());
        }

        ipSetBlockContent('main', ipGetCurrentPage()->generateContent());
        if (\Ip\Module\Admin\Service::isSafeMode()) {
            ipSetLayout(ipGetConfig()->coreModuleFile('Admin/View/safeModeLayout.php'));
        }

        if (\Ip\ServiceLocator::getContent()->isManagementState()) {
            $this->initManagement();
        }



    }

    private function initManagement()
    {
        ipAddJavascriptVariable('ipContentInit', Model::initManagementData());

        ipAddJavascript(ipGetConfig()->coreModuleUrl('Content/public/ipContentManagement.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Content/public/jquery.ip.contentManagement.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Content/public/jquery.ip.pageOptions.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Content/public/jquery.ip.widgetbutton.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Content/public/jquery.ip.block.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Content/public/jquery.ip.widget.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Content/public/exampleContent.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Content/public/drag.js'));


        ipAddJavascript(ipGetConfig()->coreModuleUrl('Assets/assets/js/jquery-ui/jquery-ui.js'));
        ipAddCss(ipGetConfig()->coreModuleUrl('Assets/assets/js/jquery-ui/jquery-ui.css'));

        ipAddJavascript(ipGetConfig()->coreModuleUrl('Assets/assets/js/jquery-tools/jquery.tools.ui.scrollable.js'));

        ipAddJavascript(ipGetConfig()->coreModuleUrl('Assets/assets/js/tiny_mce/jquery.tinymce.js'));

        ipAddJavascript(ipGetConfig()->coreModuleUrl('Assets/assets/js/plupload/plupload.full.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Assets/assets/js/plupload/plupload.browserplus.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Assets/assets/js/plupload/plupload.gears.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Assets/assets/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js'));


        ipAddJavascript(ipGetConfig()->coreModuleUrl('Upload/assets/jquery.ip.uploadImage.js'));
        ipAddJavascript(ipGetConfig()->coreModuleUrl('Upload/assets/jquery.ip.uploadFile.js'));

        ipAddCss(ipGetConfig()->coreModuleUrl('Content/public/widgets.css'));
        ipAddJavascriptVariable('isMobile', \Ip\Browser::isMobile());

    }

}