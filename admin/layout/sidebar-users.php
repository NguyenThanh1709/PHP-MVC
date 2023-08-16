<div id="sidebar" class="fl-left">
    <ul id="list-cat">      
        <li>
            <a href="?mod=users&action=edit" class="<?php if(!empty($active) && $active == "edit") echo "active"?>" title="">Cập nhật thông tin</a>
        </li>
        <li>
            <a href="?mod=users&action=changepw" class="<?php if(!empty($active) && $active == "changepw") echo "active" ?>" title="">Đổi mật khẩu</a>
        </li>
        <li>
            <a href="?mod=users&controller=team" class="<?php if(!empty($active) && $active == "team") echo "active"?>" title="">Nhóm quản trị</a>
        </li>
        <li>
            <a href="?mod=users&action=logout" title="">Thoát</a>
        </li>
    </ul>
</div>