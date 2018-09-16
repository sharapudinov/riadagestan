<?php

$isDisableWrapper = $APPLICATION->GetProperty('disable-wrapper') == 'Y';
$isDisableContainer = $APPLICATION->GetProperty('disable-container') == 'Y';
$isDisableSidebar = $APPLICATION->GetProperty('disable-sidebar') == 'Y';
$isDisableSection = $APPLICATION->GetProperty('disable-section') == 'Y';

if (!$isDisableWrapper):
?>                    <?php if (!$isDisableSection): ?></div> <!--/l-section--><?php endif; ?>
                  </div> <!--/l-page__main-->

                  <?php if (!$isDisableSidebar): ?>
                  <aside class="l-page__sidebar">
                      <?php include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/sidebar.php'; ?>
                  </aside>
                  <?php endif; ?>

              </div> <!--/l-page__row-->

          </div> <!--/l-page-->
<?php endif; ?>
    <?$APPLICATION->IncludeFile(SITE_DIR."include/adv/before_footer.php",array(),array("MODE"=>"html"))?>
    <?php include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/footer/type1.php'; ?>
    </div> <!--/wrapper-->
    <?php include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/mobile_menu_nav.php'; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/side_aside.php'; ?>
    <?$APPLICATION->IncludeFile(SITE_DIR."include/footer/search_title.php",array(),array("MODE"=>"html"))?>
    <script>
    $.ajax({
      url: '<?=SITE_DIR.'include/icons.svg?4124'?>',
      localCache: true,
      dataType: 'text',
      thenResonse: function (data) {
        return data;
      },
    }).done(function (data) {
      $('#svg-icons').append(data);
    });
    </script>

    <?$APPLICATION->IncludeFile(
  		SITE_DIR."include/tuning/component.php",
  		Array(),
  		Array("MODE"=>"html")
  	);?>

    <?$APPLICATION->IncludeFile(SITE_DIR."include/template/body_end.php",array(),array("MODE"=>"html"))?>
</body>
</html>
