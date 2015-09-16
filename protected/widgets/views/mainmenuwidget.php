<ul class="sidebar-menu">
<?php if (!empty($menu) && is_array($menu)) foreach ($menu as $k => $element) : ?>
    <li <?= !empty($element['submenu']) ? 'class="treeview"' : ''?>>
        <a href="<?= !empty($element['link']) ? $element['link'] : '#'?>">
            <i class="fa <?= !empty($element['icon']) ? $element['icon'] : '' ?>"></i>
            <span><?= !empty($element['name']) ? $element['name'] : 'Unnamed' ?></span>
            <!--i class="fa fa-angle-left pull-right"></i-->
            <?= !empty($element['submenu']) ? '<i class="fa fa-angle-left pull-right"></i>' : '' ?>
        </a>
        <?php if (!empty($element['submenu']) && is_array($element['submenu'])) : ?>
        <ul class="treeview-menu">
        <?php foreach ($element['submenu'] as $subelement) : ?>
        
            <li>
              <a href="<?= !empty($subelement['link']) ? $subelement['link'] : '#'?>">
                <i class="fa fa-angle-double-right"></i>
                <?= !empty($subelement['icon']) ? '<i class="fa '.$subelement['icon'].' pull-right"></i>' : '' ?>
                <?= !empty($subelement['name']) ? $subelement['name'] : 'Unnamed' ?>
              </a>
            </li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
    </li>
<?php endforeach ?>
</ul>