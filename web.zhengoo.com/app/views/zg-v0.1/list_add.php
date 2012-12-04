<div class="modal fade" id="add_list" >
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>创建应用收藏夹</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" style="margin-left:35px" method="post" action="/list/create">
        <label for="list-create-name"><strong>标题</strong></label>
        <input type="text" id="list-create-name" class="span6" placeholder="例: 新闻阅读" name="list_title">
        
        <label for="list-create-description"><strong>描述</strong></label>
        <textarea id="list-create-description" class="span6" name="list_desc"></textarea>
        
       <!--  <div class="">
            <label class="radio" for="list-create-privacy-public">
                <input type="radio" id="list-create-privacy-public" name="list_permission" value="0" checked="checked"><strong>公开</strong><br>任何人都可以查看您的收藏和相关评论
            </label>
            <label class="radio" for="list-create-privacy-private">
                <input type="radio" id="list-create-privacy-private" name="list_permission" value="1"><strong>私有</strong> <i class="icon icon-lock"></i> <br>只能自己可以查看
            </label>
        </div> -->
    
  </div>
  <div class="modal-footer">
    <a href="javascript:;" data-dismiss="modal" class="btn">取消</a>
    <button type="submit" class="btn btn-success" >创建</button>
  </div>
  </form>
</div>