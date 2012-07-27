<div id="feed" class="span9 main_box">
	<h1>我的动态</h1>
	<ul class="feed-list">
		<?php 
			for ($i=0; $i <  10; $i++) { 
		?>
		<li>
			<div>
				<a href="#"><img src="https://secure.gravatar.com/avatar/4e7e29dcdb21812fc9e31fd1884cb74f/?default=https%3A%2F%2Fkippt.com%2Fstatic%2Fimg%2Fdefault-avatar.jpg&s=160"/></a>
				<div class="feed-event">
					<a href="/jorilallo">轩宇同学</a> 
					收集到 
					<a href="#">云工具</a> 
					<span class="timestamp">
						1分钟前
					</span>
				</div>

				<div class="feed-content">
					<a href="#" class="feed-title">淘真货-天猫淘宝正品精选，潮男美女的个性时尚购物商城</a>
					<div class="notes">
						<a href="#" class="clip-link">
							<div class="content">淘真货致力于打造iPad上最酷最便捷的网购工具,我们从天猫、淘宝和其他电商平台精选数百个品牌,优选了几千家货真价实的店铺。奢品、名品、风尚、潮牌、独立设计师、淘品牌,一网打尽;新品、折扣、闪购、促销、团购、聚划算,尽在掌中。</div>
						</a>
					</div>
					<div class="feed-actions">
						<!-- <span><a href=""> <i class="icon icon-share-alt"></i> 关注</a></span> -->
						<span><a href=""> <i class="icon icon-comment"></i> 评论</a></span>
						<span><a href=""> <i class="icon icon-heart"></i> 喜欢</a></span>
						<span><a href=""> <i class="icon icon-star"></i> 收藏</a></span>
					</div>
				</div>
				<div class="feed-comments">
					<div class="all-comments" style="display: block; ">后面还有35条评论<a href="#" class="clip-link" > 点击查看 >></a></div>
					<ul>
						<li>
							<a href="#"><img class="avatar" src="https://secure.gravatar.com/avatar/dacd777a0fee697f5ee1150e09267c3a/?default=https%3A%2F%2Fkippt.com%2Fstatic%2Fimg%2Fdefault-avatar.jpg&s=160"></a>
							<div class="body">
								<div style="float:right;"><span class="timestamp">1分钟前</span></div>
								<div class="body-text">
									<a href="">张蕊: </a>
									心很好，但是个人觉得双闪的使用要慎重，尤其是并线变道。。。绝大部分车型在双闪时，后车并不能准确判定其变道意图，容易引起不必要的事故。。。。。。
								</div>
							</div>
						</li>
					</ul>
					<div class="reply">
			            <form class="add-comment">
			                <img src="https://secure.gravatar.com/avatar/0198f53936a4d203d2db4644be5da52d/?default=https%3A%2F%2Fkippt.com%2Fstatic%2Fimg%2Fdefault-avatar.jpg&amp;s=160" width="32" class="avatar">
			                <input type="text" placeholder="没事说两句...">
			            </form>
			        </div>
				</div>
			</div>
		</li>
		<?php
			}
		?>
	</ul>
	<div class="load-more" style="display: block; ">
	    <a href="#" class="load">查看更多<i class="icon icon-chevron-down"></i></a>
	    <span class="loading-feed">Loading...</span>
	</div>	
</div>