<div class="span3 sidebar">
  <div class="public-share">
    <a href="/<?=$user['user_login_name']?>">
      <img class="avatar" src="<?=$user['user_avatar']?>">
      <i class="m-icon-big-swapleft m-icon-white" style="position: absolute; left:32px; top:5px; display:none"></i>
    </a>
    <div class="user-info">
        <h3><a href="/<?=$user['user_login_name']?>"><?=$user['user_nice_name']?></a></h3>
        <a href="/<?=$user['user_login_name']?>"><?=$collect_count?> 应用</a>
        ·
        <a href="/<?=$user['user_login_name']?>/followers"><?=$followers_count?> 粉丝</a>

    </div>
    <p><?=$user['user_signature']?></p>
    
    <?php
      $follow_but_val   = '<i class="icon icon-plus icon-white"></i> 关注他';
      $follow_but_class = 'user-follow btn btn-danger';
      if(isset($sess_user) && $sess_user['user_id'] == $user['user_id']){
          $follow_but_val = '我自己';
          $follow_but_class = 'btn disabled';
      }else{
          if($ufollow_regard == UFOLLOW_REGARD_ACTIVE){
              $follow_but_val   = '<span>✔</span> 已关注';
              $follow_but_class = 'user-follow btn following';
          }
      }
    ?>
    <button data-api-uri="/follow/<?=$user['user_login_name']?>" class="<?=$follow_but_class?>" href="/login" >
       <?=$follow_but_val?>
    </button>
     <hr>
    <?php 
      if($followers){
    ?>
    <h4>他的粉丝</h4>
      <ul id="info-left-followers" class="collaborators">
        <?php 
          foreach ($followers as $follower) {
        ?>
        <li><a href="<?=$follower['user_login_name']?>" title="<?=$follower['user_nice_name']?>">
            <img data-placement="top" data-original-title="<?=$follower['user_nice_name']?>" class="avatar" title="<?=$follower['user_nice_name']?>" src="<?=$follower['user_avatar']?>"></a>
        </li>
        <?php } ?>
    </ul>
    <hr>
    <?php } ?>
  </div>

	
</div>