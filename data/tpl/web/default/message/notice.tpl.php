<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div id="message-notice"  ng-controller="messageNoticeCtrl" ng-cloak>
	<div class="btn-group we7-btn-group we7-padding-bottom">
		<a href="<?php  echo url('message/notice')?>" class="btn btn-default <?php  if(empty($type)) { ?> active <?php  } ?>">全部</a>
		
		<a href="<?php  echo url('message/notice', array('type' => MESSAGE_ACCOUNT_EXPIRE_TYPE))?>" class="btn btn-default <?php  if($type == MESSAGE_ACCOUNT_EXPIRE_TYPE) { ?> active <?php  } ?>">到期消息</a>
		
		
		<?php  if($_W['isfounder']) { ?>
		<a href="<?php  echo url('message/notice', array('type' => MESSAGE_REGISTER_TYPE))?>" class="btn btn-default <?php  if($type == MESSAGE_REGISTER_TYPE) { ?> active <?php  } ?>">注册提醒</a>
		<a href="<?php  echo url('message/notice', array('type' => MESSAGE_WORKORDER_TYPE))?>" class="btn btn-default <?php  if($type == MESSAGE_WORKORDER_TYPE) { ?> active <?php  } ?>">工单提醒</a>
		<?php  } ?>
		
	</div>
	<div class="btn-group we7-btn-group we7-padding-bottom" style="float: right;">
		<a href="javascript:;" ng-click="allRead()" class="btn">已读所有消息</a>
	</div>
<table class="table we7-table table-hover vertical-middle" >
	<col>
	<col>
	<col>
	<tr>
		<th colspan="3" class="text-left filter">
			<div class="dropdown dropdown-toggle we7-dropdown">
				<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					全部消息
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" aria-labelledby="dLabel">
					<li><a href="<?php  echo filter_url('is_read:');?>" class="active">全部消息</a></li>
					<li><a href="<?php  echo filter_url('is_read:' . MESSAGE_READ);?>" class="active">已读消息</a></li>
					<li><a href="<?php  echo filter_url('is_read:' . MESSAGE_NOREAD);?>" class="active">未读消息</a></li>
				</ul>
			</div>
		</th>
	</tr>
	<tr>
		<th>标题内容</th>
		<th class="text-center">提交时间</th>
		<th class="text-right">操作</th>
	</tr>
	<tr ng-repeat="list in lists">
		<td class="tip-before unread" ng-if ="list.is_read == 1" ng-bind="list.message"></td>
		<td class="tip-before " ng-if ="list.is_read == 2" ng-bind="list.message"></td>
		<td class="text-muted text-center" ng-bind = "list.create_time"></td>
		<td>
			<div class="link-group">
				
				<a ng-href="{{list.url}}" ng-if="list.type==3">进入工单</a>
				<a ng-href="{{list.url}}" ng-if="list.type==2">查看公众号</a>
				<a ng-href="{{list.url}}" ng-if="list.type==5">查看小程序</a>
				<a ng-href="{{list.url}}" ng-if="list.type==6">查看pc</a>
				<a ng-href="{{list.url}}" ng-if="list.type==4 && list.status==1">查看我的待审核用户</a>
				<a ng-href="{{list.url}}" ng-if="list.type==7">查看我的账号</a>
			</div>
		</td>
	</tr>
</table>

</div>
<div class="text-right we7-margin-top">
	<?php  echo $pager;?>
</div>
<script type="text/javascript">
	angular.module('messageApp').value('config', {
		'type' : '<?php  echo $type?>',
		'lists': <?php echo !empty($lists) ? json_encode($lists) : 'null'?>,
		'is_read' : "<?php  echo $is_read;?>",
		'all_read_url' : "<?php  echo url('message/notice/all_read')?>",
	});
	angular.bootstrap($('#message-notice'), ['messageApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>