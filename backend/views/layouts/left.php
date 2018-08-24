<?php

use mdm\admin\components\Helper;
use mdm\admin\components\MenuHelper;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/avatar5.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header"><?= 'Tahun Ajaran '.Yii::$app->is->tahunAjaran()->periode; ?></li>
        </ul>
        <?php $menuItems = [
//                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Tahun Ajaran '.Yii::$app->is->tahunAjaran()->periode, 'options' => ['class' => 'header']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Setting',
                        'icon' => 'gears',
                        'url' => '#',
                        'items' => [
                            ['label' => 'User', 'icon' => 'user-md', 'url' => ['/admin/user'], 'active' => (Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'user')],
                            ['label' => 'Assignment', 'icon' => 'american-sign-language-interpreting', 'url' => ['/admin/assignment'], 'active' => (Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'assignment')],
                            ['label' => 'Route', 'icon' => 'exchange', 'url' => ['/admin/route']],
                            ['label' => 'Permission', 'icon' => 'handshake-o', 'url' => ['/admin/permission'], 'active' => (Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'permission')],
                            ['label' => 'Menu', 'icon' => 'bars', 'url' => ['/admin/menu'], 'active' => (Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'menu')],
                            ['label' => 'Role', 'icon' => 'unlock-alt', 'url' => ['/admin/role'], 'active' => (Yii::$app->controller->module->id == 'admin' && Yii::$app->controller->id == 'role')],
                                ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']]
                        ],
                    ],
                    [
                        'label' => 'Master',
                        'icon' => 'database',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Tahun Ajaran', 'icon' => 'hourglass-3', 'url' => ['/tahunajaran'], 'active' => Yii::$app->controller->id == 'tahunajaran'],
                            ['label' => 'Dosen', 'icon' => 'user', 'url' => ['/dosen'], 'active' => Yii::$app->controller->id == 'dosen'],
                            ['label' => 'Ruangan', 'icon' => 'building', 'url' => ['/ruangan'], 'active' => Yii::$app->controller->id == 'ruangan'],
                            ['label' => 'Fakultas', 'icon' => 'graduation-cap', 'url' => ['/fakultas'], 'active' => Yii::$app->controller->id == 'fakultas'],
                            ['label' => 'Kelas', 'icon' => 'window-maximize', 'url' => ['/kelas'], 'active' => Yii::$app->controller->id == 'kelas'],
                            ['label' => 'Module', 'icon' => 'file-text', 'url' => ['/module'], 'active' => Yii::$app->controller->id == 'module'],
                            ['label' => 'Peran', 'icon' => 'blind', 'url' => ['/peran'], 'active' => Yii::$app->controller->id == 'peran'],
                            ['label' => 'Jabatan', 'icon' => 'handshake-o', 'url' => ['/jabatan'], 'active' => Yii::$app->controller->id == 'jabatan'],
                        ],
                    ],
                    [
                        'label' => 'Tahun Ajaran',
                        'icon' => 'calendar',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Dosen dan Fakultas', 'icon' => 'sitemap', 'url' => ['/dosenfakultas'], 'active' => Yii::$app->controller->id == 'dosenfakultas'],
                            ['label' => 'Module dan Tahun Ajaran', 'icon' => 'table', 'url' => ['/moduletahunajaran'], 'active' => Yii::$app->controller->id == 'moduletahunajaran'],
                            ['label' => 'Module dan Kelas', 'icon' => 'cubes', 'url' => ['/modulekelas'], 'active' => Yii::$app->controller->id == 'modulekelas'],
                            ['label' => 'Note Ijd', 'icon' => 'sticky-note-o', 'url' => ['/noteijd'], 'active' => Yii::$app->controller->id == 'noteijd'],
                            ['label' => 'Person Ijd', 'icon' => 'user-md', 'url' => ['/personijd'], 'active' => Yii::$app->controller->id == 'personijd'],
                        ],
                    ],
                    [
                        'label' => 'Transaction',
                        'icon' => 'window-restore',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Hitung Peran', 'icon' => 'calculator', 'url' => ['/peranhitung'], 'active' => Yii::$app->controller->id == 'peranhitung'],
                            ['label' => 'Hitung Imbal Jasa', 'icon' => 'th', 'url' => ['/transaksi'], 'active' => Yii::$app->controller->id == 'transaksi'],
                        ],
                    ],
                    [
                        'label' => 'Report',
                        'icon' => 'file-text-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gabung', 'icon' => 'file-text', 'url' => ['/report/gabung'], 'active' => (Yii::$app->controller->id == 'report' && Yii::$app->controller->action->id == 'gabung')],
                            ['label' => 'Pivot Dosen', 'icon' => 'files-o', 'url' => ['/report/pivotdosen'], 'active' => (Yii::$app->controller->id == 'report' && Yii::$app->controller->action->id == 'pivotdosen')],
                            ['label' => 'Pivot Fakultas', 'icon' => 'file-powerpoint-o', 'url' => ['/report/pivotfakultas'], 'active' => (Yii::$app->controller->id == 'report' && Yii::$app->controller->action->id == 'pivotfakultas')],
                            ['label' => 'Pivot Module', 'icon' => 'file-o', 'url' => ['/report/pivotmodule'], 'active' => (Yii::$app->controller->id == 'report' && Yii::$app->controller->action->id == 'pivotmodule')],
                        ],
                    ],
                ];
        
//        $menuItems = Helper::filter($menuItems);
//        echo '<pre>';        print_r($menuItems);die;
        
        $callback = function($menu){
            $data = $menu['data'];
            return [
                'label' => $menu['name'],
                'url' => [$menu['route']],
                'icon' => $menu['data'], 
                'items' => $menu['children']
            ];
        };
//        echo '<pre>';print_r(MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true));die;
        $menuItemss = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
        ?>
        
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
//                'items' => $menuItems,
                'items' => $menuItemss
            ]
        ) ?>

    </section>

</aside>
