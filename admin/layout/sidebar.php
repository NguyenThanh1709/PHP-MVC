<div id="sidebar" class="fl-left">
    <ul id="sidebar-menu">
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-map icon"></span>
                <span class="title">Trang</span>
            </a>
            <ul class="sub-menu" style="<?php if(isset($_GET['mod']) && $_GET['mod'] == 'pages') echo 'display: block;' ?>">
                <li class="nav-item">
                    <a href="?mod=pages&action=add" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=pages" title="" class="nav-link">Danh sách các trang</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-pencil-square-o icon"></span>
                <span class="title">Bài viết</span>
            </a>
            <ul class="sub-menu" style="<?php if(isset($_GET['mod']) && $_GET['mod'] == 'posts') echo 'display: block;' ?>">
                <li class="nav-item">
                    <a href="?mod=posts&action=add" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=posts" title="" class="nav-link">Danh sách bài viết</a>
                </li>
                <!-- <li class="nav-item">
                    <a href="?mod=posts&controller=cat" title="" class="nav-link">Danh mục bài viết</a>
                </li> -->
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa-brands fa-product-hunt icon"></span>
                <span class="title">Sản phẩm</span>
            </a>
            <ul class="sub-menu" style="<?php if(isset($_GET['mod']) && $_GET['mod'] == 'products') echo 'display: block'?>">
                <li class="nav-item">
                    <a href="?mod=products&action=add" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=products" title="" class="nav-link">Danh sách sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=products&controller=cat" title="" class="nav-link">Danh mục sản phẩm</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-database icon"></span>
                <span class="title">Bán hàng</span>
            </a>
            <ul class="sub-menu " style="<?php if(isset($_GET['mod']) && $_GET['mod'] == 'order') echo 'display: block'?>">
                <li class="nav-item">
                    <a href="?mod=order&action=add" title="" class="nav-link">Thêm mới thủ công</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=order" title="" class="nav-link">Danh sách đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=order&controller=revenue&action=index" title="" class="nav-link">Thống kê - báo cáo</a>
                </li>
            </ul>
        </li>
        <!-- <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <span class="fa fa-cubes icon"></span>
                <span class="title">Khối giao diện</span>
            </a>
            <ul class="sub-menu" style="<?php if(isset($_GET['mod']) && $_GET['mod'] == 'dashboard') echo 'display: block'?>">
                <li class="nav-item">
                    <a href="?mod=dashboard&action=addWidget" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=dashboard" title="" class="nav-link">Danh sách khối</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=dashboard&action=menu" title="" class="nav-link">Menu</a>
                </li>
            </ul>
        </li> -->
        <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <span class="fas fa-image"></span>
                <span class="title">Banners</span>
            </a>
            <ul class="sub-menu" style="<?php if(isset($_GET['mod']) && $_GET['mod'] == 'dashboard') echo 'display: block'?>">
                <li class="nav-item">
                    <a href="?mod=banners&action=add" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=banners" title="" class="nav-link">Danh sách banners</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <i class="fa fa-sliders" aria-hidden="true"></i>
                <span class="title">Slider</span>
            </a>
            <ul class="sub-menu" style="<?php if(isset($_GET['mod']) && $_GET['mod'] == 'sliders') echo 'display: block'?>">
                <li class="nav-item">
                    <a href="?mod=sliders&action=add" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=sliders" title="" class="nav-link">Danh sách slider</a>
                </li>
            </ul>
        </li>
        <!-- <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                <span class="title">Media</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?mod=media" title="" class="nav-link">Danh sách media</a>
                </li>
            </ul>
        </li> -->
    </ul>
</div>