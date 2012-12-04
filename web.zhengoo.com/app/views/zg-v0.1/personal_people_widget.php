<div class="profile-follow">
    <?php 
        foreach ($followers as $user) {           
    ?>
    <div class="people-widget">
        <a href="/<?=$user['user_login_name']?>" title="<?=$user['user_nice_name']?>">
            <img title="<?=$user['user_nice_name']?>" alt="<?=$user['user_nice_name']?>" width="48" height="48" class="avatar" src="<?=$user['user_avatar']?>">
        </a>
        <div>
            <h3><a href="/<?=$user['user_login_name']?>" title="<?=$user['user_nice_name']?>"><?=$user['user_nice_name']?></a></h3>
            <a href="#">0 收藏夹</a> ·
            <a href="#">1 粉丝</a> ·
            <a href="#">0 关注</a>
        </div>
        <?php 
            $follow_btn_val = '<i class="icon icon-plus icon-white"></i> 关注他';
            $follow_btn_class = "user-follow btn btn-danger";
            if($sess_user){
                if($user['user_id'] == $sess_user['user_id']){
                    $follow_btn_val = '我自己';
                    $follow_btn_class = 'btn disabled';
                }else{
                     $ufollow = $this->ufollow->get_regard($sess_user['user_id'], $user['user_id']);
                    if($ufollow == UFOLLOW_REGARD_ACTIVE){
                        $follow_btn_val = '<span>✔</span> 已关注';
                        $follow_btn_class = $follow_btn_class." following";
                    }
                }
            }
        ?>
        <a data-api-uri="/follow/<?=$user['user_login_name']?>" class="<?=$follow_btn_class?>" href="#">
             <?=$follow_btn_val?>
        </a>
    </div>
    <?php 
        }
    ?>
</div>



				