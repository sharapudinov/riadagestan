<div class="l-topbar">
    <div class="l-topbar__container">
        <div class="l-topbar__left">
            <?php
            $sTrendingFile = $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/header/trending.php';
            if (file_exists($sTrendingFile)) {
                include $sTrendingFile;
            }
            ?>
        </div>
        <div class="l-topbar__right d-none d-lg-block">
            <?php
            $sTopbarMenuFile = $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/header/topbar_menu.php';
            if (file_exists($sTopbarMenuFile)) {
                include $sTopbarMenuFile;
            }
            ?>
        </div>
    </div>
</div>
