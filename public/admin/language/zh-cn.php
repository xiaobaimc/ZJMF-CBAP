<?php

return [
	'display_name' => '中文简体',//用于在语言切换下拉中显示
	'display_flag' => 'CN',//用于显示图片，使用国家代码大写
	

    'success_message' => '请求成功',
    'fail_message' => '请求失败',
    'create_success' => '创建成功',
    'create_fail' => '创建失败',
    'delete_success' => '删除成功',
    'delete_fail' => '删除失败',
    'update_success' => '修改成功',
    'update_fail' => '修改失败',
	'save_success' => '保存成功',
    'save_fail' => '保存失败',
    'register_success' => '注册成功',
    'register_fail' => '注册失败',
    'pay_success' => '支付成功',
    'pay_fail' => '支付失败',
    'id_error' => 'ID错误',
    'param_error' => '参数错误',
    'cannot_repeat_opreate' => '不可重复操作',
    'disable_success' => '禁用成功',
    'disable_fail' => '禁用失败',
    'enable_success' => '启用成功',
    'enable_fail' => '启用失败',
    'login_success' => '登录成功',
    'login_fail' => '登录失败',
    'move_success' => '移动成功',
    'move_fail' => '移动失败',
    'file_name_error' => '文件名不允许包含!@^&"\'/\\',
    'file_mime_error' => '文件mime类型错误',
    'file_less_than_64M' => '文件大小不超过64M',
    'upload_success' => '上传成功',
    'upload_fail' => '上传失败',
    'file_is_not_exist' => '文件不存在',
    'buy_fail' => '购买失败',
    'buy_success' => '购买成功',
    'client_credit_fail' => '用户余额修改失败',
    'client_credit_success' => '用户余额修改成功',
    'missing_route_paramters' => '缺少路由参数{param}',
    'range_of_values' => '{key}取值范围:{value}',
    'gateway_error' => '支付接口错误',
    'login_unauthorized' => '未授权',
    'remember_password_value_0_or_1' => '记住密码取值为0或1',
    'password_is_change_please_login_again' => '密码已修改,请重新授权',
    'logout_success' => '注销成功',
    'inconsistent_login_ip' => '登录ip不一致',
    'login_user_ID_is_inconsistent' => '登录用户ID不一致',
    'log_out_automatically_after_2_hours_without_operation' => '2个小时未操作自动退出登录',
    'login_captcha' => '请输入图形验证码',
    'login_captcha_token' => '请输入图形验证码唯一识别码',
    'login_captcha_error' => '图形验证码错误',
    'login_phone_code_require' => '请选择国家区号',
    'login_phone_code_error' => '国家区号错误',
    'login_phone_require' => '请输入手机号',
    'login_phone_is_not_right' => '请输入手机号',
    'login_phone_is_not_register' => '手机号未注册',
    'login_client_is_disabled' => '该帐号已停用/关闭，请联系管理员处理',
    'permission_denied' => '您没有访问{name}接口权限！',

    # 权限规则
    'auth_rule_admin_list' => '管理员列表',
    'auth_rule_admin_index' => '获取单个管理员',
    'auth_rule_admin_create' => '添加管理员',
    'auth_rule_admin_update' => '修改管理员',
    'auth_rule_admin_delete' => '删除管理员',
    'auth_rule_admin_status' => '管理员状态切换',
    'auth_rule_admin_role_list' => '管理员分组列表',
    'auth_rule_admin_role_index' => '获取单个管理员分组',
    'auth_rule_admin_role_create' => '添加管理员分组',
    'auth_rule_admin_role_update' => '修改管理员分组',
    'auth_rule_admin_role_delete' => '删除管理员分组',
    'auth_rule_client_list' => '用户列表',
    'auth_rule_client_index' => '用户详情',
    'auth_rule_client_create' => '新建用户',
    'auth_rule_client_update' => '修改用户',
    'auth_rule_client_delete' => '删除用户',
    'auth_rule_client_status' => '用户状态切换',
    'auth_rule_client_search' => '搜索用户',
    'auth_rule_client_login' => '以用户登录',
    'auth_rule_client_credit_list' => '用户余额变更记录列表',
    'auth_rule_client_credit_update' => '更改用户余额',
    'auth_rule_configuration_system' => '获取系统设置',
    'auth_rule_configuration_system_update' => '保存系统设置',
    'auth_rule_configuration_login' => '获取登录设置',
    'auth_rule_configuration_login_update' => '保存登录设置',
    'auth_rule_configuration_security' => '获取验证码设置',
    'auth_rule_configuration_security_update' => '保存验证码设置',
    'auth_rule_configuration_currency' => '获取货币设置',
    'auth_rule_configuration_currency_update' => '保存货币设置',
    'auth_rule_configuration_cron' => '获取自动化设置',
    'auth_rule_configuration_cron_update' => '保存自动化设置',
    'auth_rule_order_list' => '订单列表',
    'auth_rule_order_index' => '订单详情',
    'auth_rule_order_create' => '新建订单',
    'auth_rule_order_upgrade_amount' => '获取升降级订单金额',
    'auth_rule_order_amount_update' => '调整订单金额',
    'auth_rule_order_status_paid' => '标记支付',
    'auth_rule_order_delete' => '删除订单',
    'auth_rule_transaction_list' => '交易流水列表',
    'auth_rule_transaction_create' => '新增交易流水',
    'auth_rule_transaction_delete' => '删除交易流水',
    'auth_rule_host_list' => '产品列表',
    'auth_rule_host_index' => '产品详情',
    'auth_rule_host_update' => '修改产品',
    'auth_rule_host_delete' => '删除产品',
    'auth_rule_plugin_list' => '获取支付/短信/邮件/插件列表',
    'auth_rule_plugin_setting' => '获取单个插件配置',
    'auth_rule_plugin_status' => '禁用(启用)插件',
    'auth_rule_plugin_install' => '插件安装',
    'auth_rule_plugin_uninstall' => '插件卸载',
    'auth_rule_plugin_setting_update' => '保存配置',
    'auth_rule_email_template_list' => '邮件模板列表',
    'auth_rule_email_template_create' => '创建邮件模板',
    'auth_rule_email_template_index' => '获取单个邮件模板',
    'auth_rule_email_template_update' => '编辑邮件模板',
    'auth_rule_email_template_delete' => '删除邮件模板',
    'auth_rule_email_template_test' => '测试邮件模板',
    'auth_rule_sms_template_list' => '获取短信模板',
    'auth_rule_sms_template_create' => '创建短信模板',
    'auth_rule_sms_template_index' => '获取单个短信模板',
    'auth_rule_sms_template_update' => '编辑短信模板',
    'auth_rule_sms_template_delete' => '删除短信模板',
    'auth_rule_sms_template_test' => '测试短信模板',
    'auth_rule_notice_setting_list' => '发送管理',
    'auth_rule_notice_setting_update' => '发送设置',
    'auth_rule_task_list' => '任务列表',
    'auth_rule_task_retry' => '任务重试',
    'auth_rule_system_log_list' => '系统日志列表',
    'auth_rule_email_log_list' => '邮件日志列表',
    'auth_rule_sms_log_list' => '短信日志列表',
    'auth_rule_product_list' => '商品列表',
    'auth_rule_product_index' => '商品详情',
    'auth_rule_product_create' => '新建商品',
    'auth_rule_product_update' => '编辑商品',
    'auth_rule_product_order' => '商品拖动排序',
    'auth_rule_product_delete' => '删除商品',
    'auth_rule_product_hidden' => '隐藏/显示商品',
    'auth_rule_product_group_create' => '新建商品分组',
    'auth_rule_product_group_move_product' => '移动商品至其他商品组',
    'auth_rule_product_group_delete' => '删除商品分组',
    'auth_rule_product_group_first_list' => '获取商品一级分组',
    'auth_rule_product_group_second_list' => '获取商品二级分组',
    'auth_rule_product_group_update' => '编辑商品分组',
    'auth_rule_product_upgrade' => '获取商品关联的升降级商品',
    'auth_rule_server_group_list' => '接口分组列表',
    'auth_rule_server_group_create' => '新建接口分组',
    'auth_rule_server_group_update' => '修改接口分组',
    'auth_rule_server_group_delete' => '删除接口分组',
    'auth_rule_server_list' => '接口列表',
    'auth_rule_server_create' => '新建接口',
    'auth_rule_server_update' => '编辑接口',
    'auth_rule_server_delete' => '删除接口',
    'auth_rule_server_status' => '获取接口连接状态',
    'auth_rule_module_list' => '模块列表',
    'auth_rule_host_module' => '产品内页模块',
    'auth_rule_host_upgrade_config_option' => '产品升降级配置',
    'auth_rule_host_upgrade_config_option_price' => '产品升降级配置计算价格',
    'auth_rule_host_module_create' => '模块开通',
    'auth_rule_host_module_suspend' => '模块暂停',
    'auth_rule_host_module_unsuspend' => '模块解除暂停',
    'auth_rule_host_module_terminate' => '模块删除',
    'auth_rule_product_server_config_option' => '选择接口获取配置',
    'auth_rule_product_config_option' => '商品配置页面',
    'auth_rule_product_config_option_price' => '修改配置计算价格',
    'auth_rule_get_admin_menu' => '获取后台导航',
    'auth_rule_get_home_menu' => '获取前台导航',
    'auth_rule_save_admin_menu' => '保存后台导航',
    'auth_rule_save_home_menu' => '保存前台导航',

    #权限
    'auth_user_management' => '用户管理',
    'auth_user_list' => '用户列表',
    'auth_view' => '查看',
    'auth_add' => '新增',
    'auth_user_details' => '用户详情',
    'auth_management' => '管理',
    'auth_delete' => '删除',
    'auth_user_host' => '用户产品',
    'auth_user_order' => '用户订单',
    'auth_user_transaction' => '用户流水',
    'auth_user_log' => '用户日志',
    'auth_business_management' => '业务管理',
    'auth_order_management' => '订单管理',
    'auth_marker_payment' => '标记支付',
    'auth_adjustment_amount' => '调整金额',
    'auth_host_management' => '产品管理',
    'auth_host_details' => '产品详情',
    'auth_module_management' => '模块管理',
    'auth_transaction' => '交易流水',
    'auth_product_management' => '商品管理',
    'auth_product_group' => '商品分组',
    'auth_server_management' => '接口管理',
    'auth_server_group' => '接口分组',
    'auth_update' => '修改',
    'auth_system_settings' => '系统设置',
    'auth_login_settings' => '登录设置',
    'auth_admin_settings' => '管理员设置',
    'auth_admin_group' => '管理员分组',
    'auth_security_settings' => '验证码设置',
    'auth_currency_settings' => '货币设置',
    'auth_payment_gateway' => '支付接口',
    'auth_enable_disable' => '启用/停用',
    'auth_install_uninstall_config' => '安装/卸载/配置',
    'auth_notice' => '通知接口',
    'auth_sms_notice' => '短信通知',
    'auth_template_management' => '模板管理',
    'auth_email_notice' => '邮件通知',
    'auth_send_settings' => '发送设置',
    'auth_task' => '任务',
    'auth_log' => '日志',
    'auth_system_log' => '系统日志',
    'auth_notice_log' => '通知日志',
    'auth_auto' => '自动化',
    'auth_plugin' => '插件',
    'auth_plugin_list' => '插件列表',
    'auth_nav_management' => '导航管理',

    # 导航
    'nav_user_management' => '用户管理',
    'nav_user_list' => '用户列表',
    'nav_business_management' => '业务管理',
    'nav_order_management' => '订单管理',
    'nav_host_management' => '产品管理',
    'nav_transaction' => '交易流水',
    'nav_product_management' => '商品管理',
    'nav_server_management' => '接口管理',
    'nav_server_group' => '接口分组',
    'nav_system_settings' => '系统设置',
    'nav_admin_settings' => '管理员设置',
    'nav_security_settings' => '验证码设置',
    'nav_currency_settings' => '货币设置',
    'nav_payment_gateway' => '支付接口',
    'nav_notice' => '通知接口',
    'nav_sms_notice' => '短信通知',
    'nav_email_notice' => '邮件通知',
    'nav_send_settings' => '发送设置',
    'nav_management' => '管理',
    'nav_task' => '任务',
    'nav_log' => '日志',
    'nav_auto' => '自动化',
    'nav_plugin' => '插件',
    'nav_plugin_list' => '插件列表',
    'nav_navigation' => '导航管理',


    # 日志
    'admin_modify_user_profile' => '{admin}将{client}的{description}',
    'old_to_new' => '{field}{old}改为{new}',
    'admin_delete_user_host' => '{admin}将{client}的{host}删除',
    'admin_adjust_user_order_price' => '{admin}将{client}的{order}的价格{old}改为{new}',
    'admin_mark_user_order_payment_status' => '{admin}将{client}的{order}标记为已付款',
    'admin_delete_user_order' => '{admin}将{client}的{order}删除',
    'admin_delete_transaction' => '{admin}删除交易流水{transaction}，流水所属用户为{client}',
    'admin_add_transaction' => '{admin}新增交易流水{transaction}，流水所属用户为{client}',
    'admin_create_new_user' => '{admin}新建用户{client}',
    'admin_create_new_purchase_order' => '{admin}新建新购订单{order}，订单用户为{client}',
    'admin_create_upgrade_order' => '{admin}新建升降级订单{order}，订单用户为{client}',
    'admin_create_renew_order' => '{admin}新建续费订单{order}，订单用户为{client}',
    'admin_create_artificial_order' => '{admin}新建人工订单{order}，订单用户为{client}',
    'admin_edit_email_template' => '{admin}编辑邮件模板：{template}',
    'admin_delete_email_template' => '{admin}删除邮件模板：{template}',
    'admin_create_email_template' => '{admin}创建邮件模板：{template}',
    'admin_retry_task' => '{admin}重试任务：{task}{description}',
    'admin_configuration_system' => '{admin}将系统设置的{description}',
    'admin_configuration_login' => '{admin}将登录设置的{description}',
    'admin_configuration_security' => '{admin}将验证码设置的{description}',
    'admin_configuration_currency' => '{admin}将货币设置的{description}',
    'admin_configuration_cron' => '{admin}将自动化设置的{description}',
    'admin_configuration_send' => '{admin}将默认通知接口设置的{description}',
    'admin_old_to_new' => '{field}的{old}改为{new}',
    'admin_sms_template_log_create' => '{admin}短信接口"{sms_name}"创建模板"{sms_title}"成功',
    'admin_sms_template_log_update' => '{admin}短信接口"{sms_name}"模板修改：{description}',
    'admin_sms_template_log_delete' => '{admin}短信接口"{sms_name}"模板删除"{sms_title}"成功',
    'admin_notice_send_log_update' => '{admin}发送设置，{description}',

    'client_username' => '姓名',
    'client_email' => '邮箱',
    'client_phone_code' => '国际电话区号',
    'client_phone' => '手机号',
    'client_company' => '公司',
    'client_country' => '国家',
    'client_address' => '地址',
    'client_language' => '语言',
    'client_notes' => '备注',

    # 通用描述
    'log_admin_update_description' => '{field}{old}为{new}',

    'log_admin_login' => '{admin}登录系统',
    'log_admin_logout' => '{admin}注销登录',
    'log_login_by_client' => '{admin}用{client}登录前台系统',
    'log_create_admin' => '{admin}添加管理员{name}',
    'log_update_admin' => '{admin}修改管理员信息{name}:{description}',
    'log_update_admin_description' => '{field}为{content}',
    'admin_disable_admin' => '{admin}启用管理员{name}',
    'admin_enable_admin' => '{admin}禁用管理员{name}',
    'admin_delete_admin' => '{admin}删除管理员{name}',
    'admin_create_admin_role' => '{admin}添加人员分组{name}',
    'admin_update_admin_role' => '{admin}修改人员分组{name}',
    'admin_delete_admin_role' => '{admin}删除人员分组{name}',
    'log_change_password' => '修改密码',

    'admin_name' => '用户名',
    'admin_password' => '密码',
    'admin_email' => '邮箱',
    'admin_nickname' => '名称',
    'admin_status' => '状态',
    'admin_role_id' => '分组ID',

    'log_admin_create_product' => '{admin}新增商品{product}',
    'log_admin_delete_product' => '{admin}删除商品{product}',
    'log_admin_hidden_product' => '{admin}隐藏商品{product}',
    'log_admin_show_product' => '{admin}显示商品{product}',
    'log_admin_update_product' => '{admin}修改商品{product}:{description}',
    'log_admin_update_product_upgrade_product' => '升级商品ID{old}为{new}',

    'field_product_name' => '名称',
    'field_product_product_group_id' => '分组ID',
    'field_product_description' => '描述',
    'field_product_hidden' => '是否隐藏',
    'field_product_stock_control' => '库存控制',
    'field_product_qty' => '库存数量',
    'field_product_creating_notice_sms' => '开通中短信通知是否开启',
    'field_product_creating_notice_sms_api' => '开通中短信通知接口',
    'field_product_creating_notice_sms_api_template' => '开通中短信通知接口模板',
    'field_product_created_notice_sms' => '已开通短信通知是否开启',
    'field_product_created_notice_sms_api' => '已开通短信通知接口',
    'field_product_created_notice_sms_api_template' => '已开通短信通知接口模板',
    'field_product_creating_notice_mail' => '开通中邮件通知是否开启',
    'field_product_creating_notice_mail_template' => '开通中邮件通知模板',
    'field_product_created_notice_mail_template' => '已开通邮件通知模板',
    'field_product_pay_type' => '付款类型',
    'field_product_auto_setup' => '是否自动开通',
    'field_product_type' => '关联类型',
    'field_product_rel_id' => '关联ID',

    'log_admin_create_product_group' => '{admin}新增商品分组{product_group}',
    'log_admin_update_product_group' => '{admin}修改商品分组名称{old}为{new}',
    'log_admin_delete_product_group' => '{admin}删除商品分组{product_group}',

    'log_admin_plugin_gateway' => '支付',
    'log_admin_plugin_sms' => '短信',
    'log_admin_plugin_mail' => '邮件',
    'log_admin_plugin_addon' => '插件',
    'log_admin_install_plugin' => '{admin}安装{module}接口:{name}',
    'log_admin_uninstall_plugin' => '{admin}卸载{module}接口:{name}',
    'log_admin_enable_plugin' => '{admin}启用{module}接口:{name}',
    'log_admin_disable_plugin' => '{admin}禁用{module}接口:{name}',
    'log_admin_config_plugin' => '{admin}配置{module}接口:{name}',

    # 用户管理
    'client_is_not_exist' => '用户不存在',
    'client_is_disabled'  => '用户已被禁用',
    'client_name_cannot_exceed_20_chars' => '用户姓名最多不能超过20个字符',
    'please_enter_vaild_email' => '请输入正确的邮箱',
    'email_has_been_registered' => '邮箱已被注册',
    'please_select_phone_code' => '请选择国际电话区号',
    'please_enter_vaild_phone' => '请输入正确的手机号',
    'phone_has_been_registered' => '手机号已被注册',
    'please_enter_password' => '请输入密码',
    'password_formatted_incorrectly' => '密码格式错误，需为6~32位的字符',
    'please_enter_password_again' => '请重复输入密码',
    'passwords_not_match' => '两次输入的密码不一致',
    'company_cannot_exceed_255_chars' => '公司最多不能超过255个字符',
    'country_cannot_exceed_100_chars' => '国家最多不能超过100个字符',
    'address_cannot_exceed_255_chars' => '地址最多不能超过255个字符',
    'notes_cannot_exceed_1000_chars' => '备注最多不能超过1000个字符',

    # 用户余额管理
    'insufficient_credit_deduction_failed' => '用户余额不足，扣费失败',
    'please_enter_amount' => '请输入金额',
    'amount_formatted_incorrectly' => '金额格式错误',
    'please_enter_notes' => '请输入备注',

    # 订单管理
    'order_is_not_exist' => '订单不存在',
    'order_amount_adjustment_failed' => '订单金额调整失败，调整后的待付金额不得小于0',
    'please_select_order_type' => '请选择订单类型',
    'order_type_error' => '订单类型错误',
    'please_select_order_status' => '请选择订单状态',
    'order_status_error' => '订单状态错误',
    'please_enter_description' => '请输入描述',
    'description_cannot_exceed_1000_chars' => '描述最多不能超过1000个字符',
    'order_already_paid' => '订单已付款，无需重复操作',
    'order_already_paid_cannot_adjustment_amount' => '订单已付款，不可调整金额',
    'hosts_under_activation_in_the_order' => '订单中存在开通中的产品，不可删除订单',
    'please_select_order_delete_host' => '请选择是否删除订单下的产品',
    'client_credit_is_0' => '余额为0',
    'client_credit_is_used' => '您已使用过余额',
    'recharge_order_cannot_use_credit' => '充值订单不可使用余额',
    'active_host_can_be_upgraded' => '已开通的产品才可以升降级',
    'host_cannot_be_upgraded_to_the_product' => '该产品不可升降级到选择的商品',
    'please_select_host' => '请选择产品',
    'host_id_error' => '产品ID错误',
    'client_host_error' => '产品用户和选择的用户不一致',

    # 产品管理
    'host_is_not_exist' => '产品不存在',
    'please_select_product' => '请选择商品',
    'product_id_error' => '商品ID错误',
    'server_id_error' => '接口ID错误',
    'host_name_cannot_exceed_100_chars' => '产品标识最多不能超过100个字符',
    'please_enter_first_payment_amount' => '请输入订购金额',
    'first_payment_amount_formatted_incorrectly' => '订购金额格式错误',
    'please_enter_renew_amount' => '请输入续费金额',
    'renew_amount_formatted_incorrectly' => '续费金额格式错误',
    'please_select_billing_cycle' => '请选择计费周期',
    'billing_cycle_error' => '计费周期错误',
    'please_select_host_status' => '请选择产品状态',
    'host_status_error' => '产品状态错误',
    'active_time_formatted_incorrectly' => '开通时间格式错误',
    'due_time_formatted_incorrectly' => '到期时间格式错误',
    'order_is_paid_host_status_cannot_be_unpaid' => '订单已付款，产品状态不可修改为未付款',
    'order_is_unpaid_host_status_cannot_be_paid' => '订单未付款，产品状态不可修改为未付款以外的状态',
    'order_is_paid_host_amount_cannot_update' => '订单已付款，产品订购金额不可修改',
    'host_opening_cannot_delete' => '开通中的产品不可删除',
    'host_is_active' => '产品已开通',
    'host_is_suspended' => '产品已暂停',
    'host_is_not_active_cannot_suspend' => '产品未开通,不能暂停',
    'host_is_already_unsuspend' => '产品已解除暂停',
    'host_status_not_need_unsuspend' => '当前状态不需要解除暂停',
    'please_select_suspend_type' => '请选择暂停类型',
    'suspend_reason_length_cannot_exceed_1000_words' => '暂停原因不能超过1000个字',

    # 流水管理
    'transaction_is_not_exist' => '交易流水不存在',
    'please_select_gateway' => '请选择支付方式',
    'please_enter_transaction_number' => '请输入交易流水号',
    'transaction_number_formatted_incorrectly' => '交易流水号格式错误，只能为数字和字母',
    'please_select_client' => '请选择用户',
    'client_id_error' => '用户ID错误',
    'gateway_is_not_exist' => '支付方式不存在',

    # 任务管理
    'task_is_not_exist' => '任务不存在',
    'task_has_been_retried' => '任务已经发起重试，不可再次发起',
    'only_failed_task_can_retry' => '失败的任务才可以发起重试',

	# 系统设置
    'configuration_log_switch_1' =>'开启',
    'configuration_log_switch_0' =>'关闭',
    'configuration_log_lang_admin' =>'后台默认语言',
    'configuration_log_lang_home' =>'前台默认语言',
    'configuration_log_lang_home_open' =>'是否允许用户选择语言',
    'configuration_log_lang_home_open_0' =>'禁止',
    'configuration_log_lang_home_open_1' =>'允许',
    'configuration_log_maintenance_mode' =>'维护模式',
    'configuration_log_maintenance_mode_message' =>'维护模式内容',
    'configuration_log_website_name' =>'网站名称',
    'configuration_log_website_url' =>'网站域名地址',
    'configuration_log_terms_service_url' =>'服务条款地址',   
    'configuration_admin_default_language_cannot_empty' => '后台默认语言不能为空',
    'configuration_admin_default_language_error' => '后台默认语言设置错误',
    'configuration_home_default_language_open_cannot_empty' => '前台多语言开关不能为空',
    'configuration_home_default_language_error' => '前台多语言设置错误',
    'configuration_home_default_language_open' => '前台多语言开关值只能是1或0',
    'configuration_home_default_language_cannot_empty' => '前台默认语言不能为空',
    'configuration_maintenance_mode_cannot_empty' => '维护模式开关不能为空',
    'configuration_maintenance_mode' => '维护模式开关值只能是1或0',
    'configuration_website_name' => '网站名称不能为空',
    'configuration_website_name_cannot_exceed_255_chars' => '网站名称最多不能超过255个字符',
    'configuration_website_url' => '网站域名地址不能为空',
    'configuration_website_url_cannot_exceed_255_chars' => '网站域名地址最多不能超过255个字符',
    'configuration_website_url_error' => '请输入这样https://wwww.a.com的域名地址',
    'configuration_terms_service_url_cannot_exceed_255_chars' => '服务条款地址最多不能超过255个字符',
	# 登录设置
    'configuration_log_register_phone' =>'手机是否支持注册',
    'configuration_log_register_email' =>'邮箱是否支持注册',
    'configuration_log_login_phone_verify' =>'手机是否支持免密码登录',
    'configuration_log_register_1' =>'是',
    'configuration_log_register_0' =>'否',
    'configuration_register_email_cannot_empty' => '邮箱注册开关不能为空',
    'configuration_register_email' => '邮箱注册开关值只能是1或0',
    'configuration_register_phone_cannot_empty' => '手机号注册开关不能为空',
    'configuration_register_phone' => '手机号注册开关值只能是1或0',
    'configuration_login_phone_verify_cannot_empty' => '手机号登录短信验证开关不能为空',
    'configuration_login_phone_verify' => '手机号登录短信验证开关值只能是1或0',
	# 验证码设置
    'configuration_log_captcha_client_register' =>'新用户注册启用图形验证码',
    'configuration_log_captcha_client_login' =>'用户登录启用图形验证码',
    'configuration_log_captcha_admin_login' =>'后台系统登录启用图形验证码',
    'configuration_log_captcha_client_login_error' =>'客户登录失败时验证码',
    'configuration_log_captcha_client_login_error_1' =>'失败三次后显示',
    'configuration_log_captcha_client_login_error_0' =>'始终显示',
    'configuration_log_captcha_width' =>'图形验证码宽度',
    'configuration_log_captcha_height' =>'图形验证码高度',
    'configuration_log_captcha_length' =>'图形验证码字符长度',
    'configuration_log_code_client_email_register' =>'邮箱注册数字验证码',
	'configuration_captcha_client_register_cannot_empty' => '客户注册图形验证码开关不能为空',
	'configuration_captcha_client_register' => '客户注册图形验证码开关值只能是1或0',
	'configuration_captcha_client_login_cannot_empty' => '客户登录图形验证码开关不能为空',
	'configuration_captcha_client_login' => '客户登录图形验证码开关值只能是1或0',
	'configuration_captcha_client_login_error_cannot_empty' => '客户登录失败图形验证码开关不能为空',
	'configuration_captcha_client_login_error' => '客户登录失败图形验证码开关值只能是1或0',
	'configuration_captcha_admin_login_cannot_empty' => '管理员登录图形验证码开关不能为空',
	'configuration_captcha_admin_login' => '管理员登录图形验证码开关值只能是1或0',
	'configuration_captcha_width_cannot_empty' => '图形验证码宽度不能为空',
	'configuration_captcha_width' => '图形验证码宽度只能在200到400之间的数字',
	'configuration_captcha_height_cannot_empty' => '图形验证码高度不能为空',
	'configuration_captcha_height' => '图形验证码高度只能在50到100之间的数字',
	'configuration_captcha_length_cannot_empty' => '图形验证码字符长度不能为空',
	'configuration_captcha_length' => '图形验证码字符长度只能是在4到6之间的整数',
	# 货币设置
    'configuration_log_currency_code' =>'货币代码',
    'configuration_log_currency_prefix' =>'货币符号',
    'configuration_log_currency_suffix' =>'货币后缀',
    'configuration_log_recharge_open' =>'启用充值',
    'configuration_log_recharge_min' =>'单笔最小金额',
	'configuration_currency_code_cannot_empty' => '货币代码不能为空',
	'configuration_currency_prefix_cannot_empty' => '货币符号不能为空',
	'configuration_currency_suffix_cannot_empty' => '货币后缀不能为空',
	'configuration_recharge_open_cannot_empty' => '启用充值开关不能为空',
	'configuration_recharge_open' => '启用充值开关值只能是1或0',
	'configuration_recharge_min_float' => '单笔最小金额必须大于零的数字',
	'configuration_recharge_max_egt_recharge_min' => '单笔最大金额大于等于单笔最小金额',
	# 定时任务设置
    'configuration_log_cron_due_suspend_swhitch' =>'产品暂停',
    'configuration_log_cron_due_unsuspend_swhitch' =>'产品解除暂停',
    'configuration_log_cron_due_terminate_swhitch' =>'产品删除',
    'configuration_log_cron_due_renewal_first_swhitch' =>'第一次续费提醒',
    'configuration_log_cron_due_renewal_second_swhitch' =>'第二次续费提醒',
    'configuration_log_cron_overdue_first_swhitch' =>'第一次逾期提醒',
    'configuration_log_cron_overdue_second_swhitch' =>'第二次逾期提醒',
    'configuration_log_cron_overdue_third_swhitch' =>'第三次逾期提醒',
    'configuration_log_cron_ticket_close_swhitch' =>'已回复工单关闭',
    'configuration_log_cron_aff_swhitch' =>'推广成果',
    'configuration_log_cron_order_overdue_swhitch' =>'订单未付款通知',
    'configuration_log_cron_due_day' =>'天',
    'configuration_log_cron_due_hour' =>'小时',
    'configuration_cron_due_suspend_day_cannot_empty' => '产品到期暂停天数大于或等于0的整数',
    'configuration_cron_due_terminate_day_cannot_empty' => '产品到期删除天数大于或等于0的整数',
    'configuration_cron_due_renewal_first_day_cannot_empty' => '续费第一次提醒天数大于或等于0的整数',
    'configuration_cron_due_renewal_second_day_cannot_empty' => '续费第二次提醒天数大于或等于0的整数',
    'configuration_cron_overdue_first_day_cannot_empty' => '产品逾期第一次提醒天数大于或等于0的整数',
    'configuration_cron_overdue_second_day_cannot_empty' => '产品逾期第二次提醒天数大于或等于0的整数',
    'configuration_cron_overdue_third_day_cannot_empty' => '产品逾期第三次提醒天数大于或等于0的整数',
    'configuration_cron_ticket_close_day_cannot_empty' => '已回复状态的工单提醒小时大于或等于0的整数',  
    'configuration_cron_order_overdue_day_cannot_empty' => '订单未付款通知天数大于或等于0的整数',	
    'configuration_cron_due_suspend_swhitch' => '产品到期暂停开关值只能是1或0',
    'configuration_cron_due_unsuspend_swhitch' => '自动解除暂停开关值只能是1或0',
    'configuration_cron_due_terminate_swhitch' => '产品到期删除开关值只能是1或0',
    'configuration_cron_due_renewal_first_swhitch' => '续费第一次提醒开关值只能是1或0',
    'configuration_cron_due_renewal_second_swhitch' => '续费第二次提醒开关值只能是1或0',
    'configuration_cron_overdue_first_swhitch' => '产品逾期第一次提醒开关值只能是1或0',
    'configuration_cron_overdue_second_swhitch' => '产品逾期第二次提醒开关值只能是1或0',
    'configuration_cron_overdue_third_swhitch' => '产品逾期第三次提醒开关值只能是1或0',
    'configuration_cron_ticket_close_swhitch' => '自动关闭工单开关值只能是1或0',
    'configuration_cron_aff_swhitch' => '推介月报开关值只能是1或0',
    'configuration_cron_order_overdue_swhitch' => '订单未付款通知开关值只能是1或0',

    'configuration_cron_suspend_day_less_terminate_day' => '产品到期暂停天数应小于产品到期删除天数',
    'configuration_cron_renewal_first_day_less_renewal_second_day' => '第一次续费提醒天数应大于第二次续费提醒天数',
    'configuration_cron_overdue_day_less_terminate_day' => '第一次逾期提醒天数应小于第二次逾期提醒天数小于第三次逾期提醒天数小于产品到期删除天数',

    # 主题设置
    'configuration_theme_admin_theme_cannot_empty' => '后台主题不能为空',
    'configuration_theme_admin_theme_cannot_error' => '后台主题错误',
    'configuration_theme_clientarea_theme_cannot_empty' => '会员中心主题不能为空',
    'configuration_theme_clientarea_theme_cannot_error' => '会员中心主题错误',


    # 管理员与管理员分组
    'super_admin_cannot_delete' => '超级管理员不可删除',
    'super_admin_cannot_opreate' => '超级管理员不可操作',
    'super_admin_role_cannot_delete' => '超级管理员分组不可删除',
    'admin_is_not_exist' => '管理员不存在',
    'admin_password_is_same' => '新旧密码一样',
    'admin_role_name_cannot_empty' => '管理员分组名称不能为空',
    'admin_role_name_at_least_1_chars' => '管理员分组名称至少1个字符',
    'admin_role_name_cannot_exceed_50_chars' => '管理员分组名称最多不能超过50个字符',
    'admin_role_description_cannot_exceed_1_chars' => '管理员分组描述至少1个字符',
    'admin_role_description_cannot_exceed_1000_chars' => '管理员分组描述最多不能超过1000个字符',
    'admin_role_create_success' => '已成功添加管理员分组',
    'admin_role_is_not_exist' => '管理员分组不存在',
    'admin_role_has_admin_cannot_delete' => '管理员分组下有管理员,无法删除',
    'please_enter_admin_name' => '请填写管理员用户名',
    'admin_name_at_least_1_chars' => '管理员用户名至少1个字符',
    'admin_name_cannot_exceed_50_chars' => '管理员用户名最多不能超过50个字符',
    'admin_name_unique' => '管理员用户名已存在',
    'admin_email_unique' => '管理员邮箱已存在',
    'please_enter_admin_nickname' => '请输入管理员名称',
    'admin_nickname_cannot_exceed_20_chars' => '管理员名称最多不能超过20个字符',
    'admin_nickname_at_least_1_chars' => '管理员名称至少1个字符',
    'admin_is_disabled' => '管理员已被禁用',
    'admin_name_or_password_error' => '账号或密码错误',
    'auth_error' => '权限错误',
    'supper_admin_cannot_update_role' => '不可修改超级管理员所属分组',
    'default_admin_role_cannot_update' => '默认管理员分组不可修改',

    # 插件
    'plugin_is_not_exist' => '插件不存在',
    'plugin_is_installed' => '插件已安装',
    'plugin_information_is_missing' => '插件信息缺失',
    'plugin_install_success' => '插件安装成功',
    'plugin_install_fail' => '插件安装失败',
    'plugin_uninstall_success' => '插件卸载成功',
    'plugin_uninstall_fail' => '插件卸载失败',
    'plugin_uninstall_pre_fail' => '插件预卸载失败',
    'plugin_uninstall_cannot' => '默认插件不能卸载',
    'plugin_disabled_cannot' => '默认插件不能禁用',

    # 商品与商品分组
    'product_group_is_not_exist' => '商品分组不存在',
    'please_enter_product_group_name' => '请填写商品分组名称',
    'product_group_name_cannot_exceed_100_chars' => '商品分组名称最多不能超过100个字符',
    'product_group_has_son_cannot_delete' => '商品分组下存在子分组,不可删除',
    'product_group_has_product_cannot_delete' => '商品分组下存在商品,不可删除',
    'please_enter_product_group_first' => '请传入一级分组ID',
    'please_select_product_group_second' => '请选择商品二级分组',
    'please_enter_product_name' => '请填写商品名称',
    'product_name_cannot_exceed_100_chars' => '商品名称最多不能超过100个字符',
    'product_is_not_exist' => '商品不存在',
    'product_hidden' => '商品是否隐藏只能为0或1',
    'product_stock_control' => '商品是否开启库存控制只能为0或1',
    'product_creating_notice_sms' => '商品开通中短信通知是否开启只能为0或1',
    'product_created_notice_sms' => '商品已开通短信通知是否开启只能为0或1',
    'product_creating_notice_mail' => '商品开通中邮件通知是否开启只能为0或1',
    'product_created_notice_mail' => '商品已开通邮件通知是否开启只能为0或1',
    'product_qty_num' => '商品库存为自然数',
    'product_creating_notice_sms_cannot_use' => '开通中短信通知接口不可用',
    'product_created_notice_sms_cannot_use' => '已开通短信通知接口不可用',
    'product_creating_notice_mail_cannot_use' => '开通中通知邮件接口不可用',
    'product_created_notice_mail_cannot_use' => '已开通通知邮件接口不可用',
    'product_creating_notice_sms_api_template_is_not_exist' => '开通中短信通知模板不存在',
    'product_created_notice_sms_api_template_is_not_exist' => '已开通短信通知模板不存在',
    'product_creating_notice_mail_template_is_not_exist' => '开通中邮件通知模板不存在',
    'product_created_notice_mail_template_is_not_exist' => '已开通邮件通知模板不存在',
    'pre_product_id_require' => '移动后前一个商品ID必传',
    'pre_product_id_integer' => '移动后前一个商品ID为整数',
    'product_group_id_require' => '移动后的商品组ID必传',
    'product_group_id_integer' => '移动后的商品组ID为整数',
    'product_is_not_in_product_group' => '移动后的商品不在移动后商品分组下',
    'product_group_id_first_greater_than_0' => '一级分组ID大于0',
    'product_description_max' => '商品描述不超过1000个字符',
    'product_pay_type_require' => '商品费用类型必须',
    'product_pay_type_in' => '商品费用类型为free,onetime,recurring_prepayment,recurring_postpaid',
    'product_auto_setup_require' => '自动开通设置必须',
    'product_auto_setup_in' => '自动开通设置为0或1',
    'product_type_in' => '接口类型为server或server_group',
    'product_type_require' => '接口类型必须',
    'product_rel_id_require' => '关联ID必须',
    'product_rel_id_integer' => '关联ID只能是整数',
    'parent_product_id_integer' => '父级商品ID只能是整数',
    'product_upgrade_product_is_not_exist' => '升级商品不存在',
    'product_upgrade_product_cannot_self' => '升级商品不能是本商品',
    'parent_product_is_not_exist' => '父级商品不存在',
    'product_has_host' => '商品已使用,不可删除',
    'pre_product_group_id_require' => '移动后前一个分组ID必传',
    'pre_product_group_id_integer' => '移动后前一个分组ID为整数',
    'pre_first_product_group_id_require' => '移动后的一级分组ID必传',
    'pre_first_product_group_id_integer' => '移动后的一级分组ID为整数',
    'first_product_group_is_not_exist' => '移动后的一级分组不存在',
    'pre_product_group_is_not_exist' => '移动后前一个分组不存在',
    'first_product_group_id_is_not_exist' => '一级分组不存在',


    # 邮件模板
    'email_template_is_not_exist' => '邮件模板不存在',
    'please_enter_email_name' => '请输入邮件名称',
    'please_enter_email_subject' => '请输入邮件标题',
    'email_name_cannot_exceed_100_chars' => '邮件名称最多不能超过100个字符',
    'email_subject_cannot_exceed_100_chars' => '邮件标题最多不能超过100个字符',
    'please_enter_email_message' => '请输入邮件内容',
    'email_cannot_be_empty' => '邮箱不能为空',
    'email_format_error' => '邮箱格式错误',
	
	# 短信模板
    'sms_template_log_template_id' => '短信模板ID',
    'sms_template_log_type' => '模板类型',
    'sms_template_log_type_0' => '大陆',
    'sms_template_log_type_1' => '国际',
    'sms_template_log_title' => '模板标题',
    'sms_template_log_content' => '模版内容',
    'sms_template_log_notes' => '备注',
    'sms_template_log_status' => '状态',
    'sms_template_log_status_0' => '未提交',
    'sms_template_log_status_1' => '审核中',
    'sms_template_log_status_2' => '通过',
    'sms_template_log_status_3' => '未通过',
	'sms_template_is_not_exist' => '短信模板不存在',
	'sms_template_review_before_sending' => '短信模板审核通过才能发短信',
	'sms_template_cannot_be_modified' => '短信模板状态审核中，不能修改',
	'sms_please_enter_sms_type' => '请选择短信模板区域',
	'sms_type_must' => '请选择短信模板区域只能是1或0',
    'sms_title_cannot_empty' => '请输入短信标题',
    'sms_title_cannot_exceed_50_chars' => '短信标题最多不能超过50个字符',
    'sms_please_enter_content' => '请输入短信内容',
	'sms_content_cannot_exceed_255_chars' => '短信内容最多不能超过255个字符',
	'sms_notes_cannot_exceed_1000_chars' => '短信备注最多不能超过1000个字符',
    'sms_please_enter_sms_status' => '请选择短信模板状态',
    'sms_status_error' => '短信模板状态错误，只能是0,2,3',
    'sms_area_code_must_be_integer' => '短信区号必须是整数',
    'sms_phone_number_cannot_be_empty' => '手机号不能为空',
    'sms_phone_number_must_be_integer' => '手机号必须是整数',
	
	# 短信/邮件发送
    'send_notice_log_sms_global_name' => '短信国际接口',
    'send_notice_log_sms_global_template' => '短信国际接口模板',
    'send_notice_log_sms_name' => '短信国内接口',
    'send_notice_log_sms_template' => '短信国内接口模板',
    'send_notice_log_email_name' => '邮件接口',
    'send_notice_log_email_template' => '邮件接口模板',
	'send_wrong_action_name' => '动作名称错误',
    'send_sms_success' => '短信发送成功',
    'send_sms_error' => '短信发送失败',
    'send_sms_area_code_error' => '区号错误',
    'send_sms_interface_is_not_exist' => '短信接口不存在',
    'send_sms_interface_not_supported' => '短信接口不支持',
    'send_sms_interface_is_not_exist_domestic' => '国内短信接口不存在',
    'send_sms_interface_is_disabled_domestic' => '国内短信接口已禁用',
    'send_sms_interface_not_installed_domestic' => '国内短信接口未安装',
    'send_sms_interface_is_not_exist_global' => '国际短信接口不存在',
    'send_sms_interface_is_disabled_global' => '国际短信接口已禁用',
    'send_sms_interface_not_installed_global' => '国际短信接口未安装',   
    'send_sms_action_not_enabled' => '短信发送动作未开启',
    'send_sms_interface_not_set_domestic' => '国内短信发送接口未设置',
    'send_sms_template_not_set_domestic' => '国内短信发送模板未设置',
    'send_sms_template_is_not_exist_domestic' => '国内短信模板不存在',
    'send_sms_interface_not_set_global' => '国际短信发送接口未设置',
    'send_sms_template_not_set_global' => '国际短信发送模板未设置',
    'send_sms_template_is_not_exist_global' => '国际短信模板不存在',
    'send_mail_success' => '邮件发送成功',
    'send_mail_error' => '邮件发送失败',
	'send_mail_interface_is_not_exist' => '邮件接口不存在',
    'send_mail_interface_not_supported' => '邮件接口不支持',
    'send_mail_interface_is_disabled' => '邮件接口已禁用',
    'send_mail_interface_not_installed_' => '邮件接口未安装',
	'send_mail_action_not_enabled' => '邮件发送动作未开启',
    'send_mail_interface_not_set' => '邮件发送接口未设置',
    'send_mail_template_not_set' => '邮件发送模板未设置',
	
	
	# 发送管理
	'notice_action_code'=>'验证码',
	'notice_action_client_login_success'=>'用户登录',
	'notice_action_client_register_success'=>'用户注册',
	'notice_action_client_change_phone'=>'用户更改手机',
	'notice_action_client_change_email'=>'用户更改邮箱',
	'notice_action_client_change_password'=>'用户更改密码',
	'notice_action_order_create'=>'订单创建',
	'notice_action_host_pending'=>'产品开通中',
	'notice_action_host_active'=>'开通成功',
	'notice_action_host_suspend'=>'产品暂停通知',
	'notice_action_host_unsuspend'=>'产品解除暂停通知',
	'notice_action_host_terminate'=>'产品删除通知',
	'notice_action_host_upgrad'=>'产品升降级',
	'notice_action_admin_create_account'=>'超级管理员添加后台管理员',
	'notice_action_host_renewal_first'=>'第一次续费提醒',
	'notice_action_host_renewal_second'=>'第二次续费提醒',
	'notice_action_host_overdue_first'=>'逾期付款第一次提醒',
	'notice_action_host_overdue_second'=>'逾期付款第二次提醒',
	'notice_action_host_overdue_third'=>'逾期付款第三次提醒',
	'notice_action_order_overdue'=>'订单未付款通知',
	'notice_action_admin_order_amount'=>'订单金额修改',
	'notice_action_order_pay'=>'订单支付通知',
	'notice_action_order_recharge'=>'充值成功通知',
    'notice_setting_sms_global_template_error' => '国际短信模板ID错误',
    'notice_setting_sms_template_error' => '国内短信模板ID错误',
    'notice_setting_email_template_error' => '邮件接口模板ID错误',
    'notice_setting_sms_enable_error' => '短信启用参数只能是1或0',
    'notice_setting_email_enable_error' => '邮件启用参数只能是1或0',
    'notice_setting_name_not_exist' => '动作名称不能为空',

    # 接口管理
    'module_error' => '模块类型错误',
    'server_is_not_exist' => '接口不存在',
    'server_is_used_for_host_cannot_delete' => '产品正在使用该接口,不能删除',
    'server_is_used_for_product_cannot_delete' => '商品正在使用该接口,不能删除',
    'please_enter_server_name' => '请填写接口名称',
    'server_name_at_least_1_chars' => '接口名称至少1个字符',
    'server_name_cannot_exceed_50_chars' => '接口名称最多不能超过50个字符',
    'please_select_module' => '请选择模块类型',
    'module_at_least_1_chars' => '模块类型至少1个字符',
    'module_cannot_exceed_100_chars' => '模块类型最多不能超过100个字符',
    'please_enter_url' => '请填写地址',
    'please_enter_an_right_url' => '请输入正确的地址',
    'server_username_cannot_exceed_100_chars' => '用户名最多不能超过100个字符',
    'server_password_cannot_exceed_100_chars' => '密码最多不能超过100个字符',
    'server_status_only_zero_or_one' => '是否启用只能是0或1',
    'select_server_used_or_not_found' => '所选接口已使用或不存在',
    'select_server_module_is_different' => '所选接口模块不同',
    'server_group_not_found' => '接口分组不存在',
    'server_group_is_used_for_product_cannot_delete' => '商品正在使用该接口分组,不能删除',
    'server_group_have_server_cannot_delete' => '该分组下有接口则不能删除分组',
    'please_enter_server_group_name' => '请输入接口分组名称',
    'server_group_name_at_least_1_chars' => '接口分组名称至少1个字符',
    'server_group_name_cannot_exceed_50_chars' => '接口分组名称最多不能超过50个字符',
    'please_select_server' => '请选择接口',
    'server_must_be_array' => '接口只能是数组',
    'server_group_have_multi_server_cannot_modify_one_server_module' => '接口所属分组有其他接口,不能修改模块类型',
    
    # 模块功能
    'undefined_test_connect_function' => '未定义测试连接方法',
    'module_file_is_not_exist' => '模块文件不存在',
    'module_create_success' => '开通成功',
    'module_create_fail' => '开通失败',
    'module_suspend_success' => '暂停成功',
    'module_suspend_fail' => '暂停失败',
    'module_unsuspend_success' => '解除暂停成功',
    'module_unsuspend_fail' => '解除暂停失败',
    'module_cannot_find_template_file' => '模块找不到对应模板文件',
    'module_res_format_error' => '模块返回值格式错误',
    'module_operate_success' => '操作成功',
    'module_operate_fail' => '操作失败',
    'module_test_connect_success' => '连接成功',
    'module_test_connect_fail' => '连接失败',

    # 系统升级
    'get_new_version_failed' => '未获取到最新系统版本号,请稍后重试',
    'package_has_downloaded' => '安装包已下载',
    'root_cannot_read_write' => '根目录不可读/写',
    'upgrade_cannot_read_write' => '升级目录不可读/写',
    'version_is_last' => '您的系统已经是最新版本，无需升级',
    'open_remote_file_failed' => '打开远程文件失败！',
    'download_sucesss' => '已成功下载',
    'download_failed' => '下载压缩包失败',
    'upgrade_download_not_exist' => '当前不存在升级下载任务',

    # 导航管理
    'nav_is_not_exist' => '默认导航不存在',
];
