<div class="span3 sidenav">
    <ul>
        <li <?php if($this->uri->segment(2) == 'profile'){ ?> class="active" <?php } ?>><a href="/settings/profile/"><i class="icon-user"></i>个人资料</a></li>
        <li <?php if($this->uri->segment(2) == 'password'){ ?> class="active" <?php } ?>><a href="/settings/password/"><i class="icon-lock"></i>修改密码</a></li>
        <li <?php if($this->uri->segment(2) == 'connections'){ ?> class="active" <?php } ?>><a href="/settings/connections/"><i class="icon-globe"></i>社区绑定</a></li>
    </ul>
</div>