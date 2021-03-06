<!DOCTYPE html>
<html>
<head>
	<title>MeloyAdmin - 数据管理工具</title>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

	{tea:inject}
	{tea:css css/semantic.min.css}
	{tea:css /__resource__/layout.css}
	{tea:js /__resource__/layout.js}
	{tea:js js/Array.min.js}
</head>
<body ng-app="app" ng-controller="controller" ng-class="{expanded:viewExpanded}">

<!-- 顶部导航 -->
<div class="ui menu inverted top-nav blue">
	<a href="{tea:url /}" class="item"><i class="icon home"></i>{MeloyAdmin - 数据管理工具} &nbsp; <sup>beta</sup></a>
	<div class="right menu">
		<div class="item link" ng-click="viewExpand()" title="放大或缩小工作区">
			<i class="icon" ng-class="{expand:!viewExpanded, compress:viewExpanded}"></i>
		</div>
		<div class="item">
			<i class="icon user"></i>
			{{loginUserName}}
		</div>
		<a href="{tea:url settings}" class="item" ng-class="{active: menu == 'settings'}"><i class="icon setting"></i>设置</a>
		<a href="{tea:url logout}" class="item" title="安全退出登录"><i class="icon sign out"></i>退出</a>
	</div>
</div>

<!-- 左侧主菜单 -->
<div class="main-menu" ng-cloak="">
	<div class="ui labeled icon menu vertical blue">
		<a href="{tea:url dashboard}" class="item" ng-class="{active:menu == 'dashboard'}">
			<i class="dashboard icon"></i>
			控制台
		</a>

		<!-- 数据管理模块 -->
		<a ng-repeat="module in meloyModules" href="{{Tea.url('@' + module.code)}}" class="item" ng-class="{active:menu == '@' + module.code}">
			<i class="browser icon"></i>
			{{module.menuName}}
		</a>

		<a href="{tea:url team}" class="item" ng-class="{active:menu == 'team'}">
			<i class="puzzle icon"></i>
			团队管理
		</a>
	</div>
</div>

<!-- 左侧子菜单（一般是服务器列表） -->
<div class="sub-menu" ng-if="subMenus.length > 0" ng-cloak="">
	<div class="ui menu vertical">
		<div ng-repeat="subMenu in subMenus">
			<div class="item blue" ng-class="{active:subMenu.active}" ng-if="subMenu.url.length > 0">
				<a href="{{subMenu.url}}">{{subMenu.name}}</a>
			</div>
			<div class="item blue" ng-class="{active:subMenu.active}" ng-if="!subMenu.url || subMenu.url.length == 0">
				{{subMenu.name}}
			</div>

			<!-- 第二层菜单 -->
			<div class="item" ng-if="subMenu.items.length > 0">
				<div class="menu">
					<div ng-repeat="item in subMenu.items">
						<a href="{{item.url}}" class="blue item" ng-class="{active:item.active}" >
							{{item.name}}
						</a>

						<!-- 第三层菜单 -->
						<div ng-if="item.items && item.items.length > 0" class="third-menu">
							<!--<div class="item"><strong ng-bind-html="item.items[0].name|allow"></strong></div>-->
							<div ng-repeat="(subIndex,subItem) in item.items" ng-if="subIndex > 0">
								<a class="item blue" ng-class="{active:subItem.active}" href="{{subItem.url}}"><i class="icon database"></i>{{subItem.name}}</a>

								<!-- 第四层菜单 -->
								<div ng-if="subItem.items && subItem.items.length > 0" class="fourth-menu">
									<!--<div class="item">
										<strong ng-bind-html="subItem.items[0].name|allow"></strong>
									</div>-->
									<div ng-repeat="(subSubIndex, subSubItem) in subItem.items" ng-if="subSubIndex > 0">
										<a class="item blue" ng-class="{active:subSubItem.active}" href="{{subSubItem.url}}">
											<i class="table icon"></i>{{subSubItem.name}}
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 右侧主操作栏 -->
<div class="main" ng-class="{'without-menu': !subMenus || subMenus.length == 0}" ng-cloak="">
	<!-- 操作菜单 -->
	<div class="ui top attached menu tabular tab-menu" ng-if="tabbar">
		<a class="item" ng-repeat="item in tabbar" ng-class="{active:item.active}" href="{{item.url}}">
			<var>{{item.name}}</var>
			<span ng-if="item.subName.length > 0">({{item.subName}})</span>
		</a>
	</div>

	<!-- 功能区 -->
	{tea:placeholder}

	<!-- 快速到顶部 -->
	<a href="" class="go-top-btn hidden" title="点击回到顶部" ng-click="goTop()" ><i class="icon up arrow circle"></i></a>
</div>

<!-- 右侧小助手 -->
<div id="helpers-box" class="ui menu vertical">
	<a class="item"></a>
	<div class="item" ng-repeat="moduleHelper in moduleHelpers" ng-click="showModuleHelper(moduleHelper, $index)" ng-class="{active:moduleHelperIndex == $index}" title="{{moduleHelper.name}}">
		<a href="">{{moduleHelper.name.substr(0, 1)}}</a>
	</div>
	<a class="item"></a>
	<a class="ui basic icon circular tooltip" data-tooltip="此侧边栏列出随插件安装的小助手" data-position="top right"><i class="icon question circle"></i></a>
</div>

<div id="helper-view">
	<!-- 小助手视图 -->
</div>

<!-- 底部 -->
<div id="footer" class="ui menu inverted light-blue">
	<div class="item">v{{meloy.version}}</div>
	<a href="https://meloy.cn" target="_blank" class="item">官网</a>
	<a href="https://git.oschina.net/liuxiangchao/meloy" target="_blank" class="item">OSC码云</a>
	<a href="https://github.com/iwind/meloy" target="_blank" class="item">GitHub</a>
	<div class="item">QQ群：199435611</div>
</div>

</body>
</html>