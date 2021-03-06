<?php
if (!isset($_SESSION)) {
    session_start();
} else {
    $user = $_SESSION['user'];
}
if (PHPArcade\Users::isUserLoggedIn()) {
    ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php echo gettext('gamecategories'); ?> <span class="caret" />
        </a>
        <ul class="dropdown-menu" role="menu">
            <?php include_once __DIR__ . '/categoriesmenu.php'; ?>
        </ul>
    </li>
    <li class="dropdown ">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php echo gettext('myaccount'); ?>
            <span class="caret" />
        </a>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
            <li class="dropdown-header">
                <img alt="<?php $user['name'];?>'s Gravatar"
                     class="img img-responsive img-circle lazy"
                     data-src="<?php echo PHPArcade\Users::userGetGravatar($user['name'], 25); ?>"
                     style="float:left"
                />&nbsp;
                <?php
                echo $user['name']; ?>
            </li><?php
            if ($user['admin'] === 'Yes') {
                ?>
                <li class="divider" />
                <li>
                    <a href="<?php echo SITE_URL_ADMIN; ?>" target="_blank" rel="noopener">
                        <?php echo gettext('admin'); ?>
                    </a>
                </li><?php
            } ?>
            <li class="divider" />
            <li class="dropdown-header">
                <?php echo gettext('profile'); ?>
            </li>
            <li>
                <a href='<?php echo PHPArcade\Core::getLinkProfile($user['id']); ?>'>
                    <?php echo gettext('myprofile'); ?>
                </a>
            </li>
            <li>
                <a href='<?php echo PHPArcade\Core::getLinkProfileEdit(); ?>'>
                    <?php echo gettext('profileedit'); ?>
                </a>
            </li>
            <li class="divider" />
            <li>
                <a href='<?php echo PHPArcade\Core::getLinkLogout(); ?>'>
                    <?php echo gettext('logout'); ?>
                </a>
            </li>
        </ul>
    </li><?php
}
