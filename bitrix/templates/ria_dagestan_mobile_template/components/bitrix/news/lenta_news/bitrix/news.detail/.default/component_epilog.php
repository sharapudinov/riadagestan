<?php
/**
 * Created by PhpStorm.
 * User: Asus-
 * Date: 12.01.2015
 * Time: 5:10
 */
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH ."/css/photoswipe.css");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH ."/lib/simple-inheritance.min.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH ."/lib/code-photoswipe-1.0.11.min.js");
?>


<script type="text/javascript">
          Code.photoSwipe('a', '#Gallery');
</script>

