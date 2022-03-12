<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?=Yii::$app->params['APP_NAME']?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=Yii::$app->user->identity->nama ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            $items = [
                ['label' => 'Dashboard', 'icon' => 'tachometer-alt', 'url' => ['admin/dashboard/index']],
            ];
            if(Yii::$app->user->can('admin')){
                array_push($items,['label' => 'Master Data', 'header' => true]);
                array_push($items,['label' => 'Pengguna', 'icon' => 'user', 'url' => ['admin/master/pengguna/index']]);
                array_push($items,['label' => 'Buku', 'icon' => 'book', 'url' => ['admin/master/buku/index']],);

                array_push($items,['label' => 'Transaksi', 'header' => true]);
                array_push($items,['label' => 'Tambah Peminjaman', 'icon' => 'book', 'url' => ['admin/peminjaman/create']],);
                array_push($items,['label' => 'Tambah Pengembalian', 'icon' => 'book', 'url' => ['admin/pengembalian/create']],);
            }
            array_push($items,['label' => 'Data', 'header' => true]);
            array_push($items,['label' => 'Peminjaman', 'icon' => 'book', 'url' => ['admin/peminjaman/index']],);
            array_push($items,['label' => 'Pengembalian', 'icon' => 'book', 'url' => ['admin/pengembalian/index']],);
            array_push($items,['label' => '', 'header' => true]);
            array_push($items,['label' => 'Profil', 'icon' => 'user', 'url' => ['admin/profil/index']],);
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => $items,
            ]);
            // [
                // [
                //     'label' => 'Starter Pages',
                //     'icon' => 'tachometer-alt',
                //     'badge' => '<span class="right badge badge-info">2</span>',
                //     'items' => [
                //         ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                //         ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                //     ]
                // ],
                // ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
            // ]
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>