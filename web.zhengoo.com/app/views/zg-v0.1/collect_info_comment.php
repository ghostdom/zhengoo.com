<div class="comments clearfix">
	<ul id="comment-list" class="comment-list">
        <?php 
            foreach ($comments as $comment) {
        ?>
        <li>

            <a title="<?=$comment['user_nice_name']?>" href="/<?=$comment['user_login_name']?>"><img alt="<?=$comment['user_nice_name']?>" class="avatar" src="<?=$comment['user_avatar']?>"></a>
            <div>
                <div class="user">
                    <strong><a title="<?=$comment['user_nice_name']?>" href="/<?=$comment['user_login_name']?>"><?=$comment['user_nice_name']?></a></strong>
                    <span class="timestamp"><abbr title="<?=date('Y-m-d H:m:s', $comment['comment_time'])?>" class="timeago"><?=format_date($comment['comment_time'])?></abbr></span>
                    <?php 
                    if($sess_user['user_id'] == $comment['comment_uid']){
                    ?>
                        <a class="delete" data-placement="right" data-original-title="删除" href="/comment/delete/<?=$comment['comment_id']?>"><i class="icon icon-remove"></i></a>
                    <?php 
                        }
                    ?>
                </div>
                <div class="comment">
                   <?=$comment['comment_body']?>
                </div>
            </div>
        </li>
        <?php 
            }
        ?>
	</ul>

	<form class="new-comment" action="/comment/<?=$collect['collect_title']?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>" >
        <img width="42" height="42" title="<?$sess_user['user_nice_name']?>" class="avatar" src="<?=$sess_user['user_avatar']?>">
        <textarea name="comment_body" placeholder="发表下自己的看法..." ></textarea>
        <div class="actions">
            <input type="submit" class="comment btn button" data-loading-text="数据提交中..." value="发表评论"/>
        </div>
    </form>	
</div>