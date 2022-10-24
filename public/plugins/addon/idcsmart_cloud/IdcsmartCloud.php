<?php
namespace addon\idcsmart_cloud;

use app\common\lib\Plugin;
use think\facade\Db;
use server\idcsmart_cloud\idcsmart_cloud\IdcsmartCloud as IC;
use app\common\model\ServerModel;
use addon\idcsmart_cloud\model\IdcsmartSecurityGroupLinkModel;
use addon\idcsmart_cloud\model\IdcsmartSecurityGroupRuleModel;
use addon\idcsmart_cloud\model\IdcsmartSecurityGroupRuleLinkModel;

require_once __DIR__ . '/common.php';
/*
 * 魔方云管理
 * @author theworld
 * @time 2022-06-08
 * @copyright Copyright (c) 2013-2021 https://www.idcsmart.com All rights reserved.
 */
class IdcsmartCloud extends Plugin
{
    #public function idcsmartSecurityGroupidcsmartauthorize(){}

    public $noNav;

    # 插件基本信息
    public $info = array(
        'name'        => 'IdcsmartCloud', //插件英文名,作为插件唯一标识,改成你的插件英文就行了
        'title'       => '魔方云管理',
        'description' => '魔方云管理',
        'author'      => '智简魔方',  //开发者
        'version'     => '1.0',      // 版本号
    );
    # 插件安装
    public function install()
    {
        $sql = [
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group`",
            "CREATE TABLE `idcsmart_addon_idcsmart_security_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '安全组ID',
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` varchar(20) NOT NULL DEFAULT 'host' COMMENT '类型',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '安全组名称',
  `description` varchar(1000) NOT NULL DEFAULT '' COMMENT '描述',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='安全组表'",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group_host_link`",
            "CREATE TABLE `idcsmart_addon_idcsmart_security_group_host_link` (
  `addon_idcsmart_security_group_id` int(11) NOT NULL DEFAULT '0' COMMENT '安全组ID',
  `host_id` int(11) NOT NULL DEFAULT '0' COMMENT '产品ID',
  KEY `host_id` (`host_id`),
  KEY `addon_idcsmart_security_group_id` (`addon_idcsmart_security_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='安全组产品关联表'",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group_link`",
            "CREATE TABLE `idcsmart_addon_idcsmart_security_group_link` (
  `addon_idcsmart_security_group_id` int(11) NOT NULL DEFAULT '0' COMMENT '安全组ID',
  `server_id` int(11) NOT NULL DEFAULT '0' COMMENT '接口ID',
  `security_id` int(11) NOT NULL DEFAULT '0' COMMENT '云系统安全组ID',
  KEY `server_id` (`server_id`),
  KEY `addon_idcsmart_security_group_id` (`addon_idcsmart_security_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='安全组外部关联表'",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group_rule`",
            "CREATE TABLE `idcsmart_addon_idcsmart_security_group_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '安全组规则ID',
  `addon_idcsmart_security_group_id` int(11) NOT NULL DEFAULT '0' COMMENT '安全组ID',
  `description` varchar(1000) NOT NULL DEFAULT '' COMMENT '描述',
  `direction` enum('in','out') NOT NULL DEFAULT 'in' COMMENT '规则方向',
  `protocol` varchar(255) NOT NULL DEFAULT '' COMMENT '协议all,tcp,udp,icmp',
  `port` varchar(255) NOT NULL DEFAULT '' COMMENT '端口范围',
  `ip` varchar(255) NOT NULL DEFAULT '' COMMENT '授权IP',
  `lock` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否锁定',
  `start_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '起始IP',
  `end_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '结束IP',
  `start_port` int(11) NOT NULL DEFAULT '0' COMMENT '起始端口',
  `end_port` int(11) NOT NULL DEFAULT '0' COMMENT '结束端口',
  `priority` int(11) NOT NULL DEFAULT '0' COMMENT '优先级',
  `action` varchar(20) NOT NULL DEFAULT '' COMMENT '授权策略,accept允许,drop拒绝',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `addon_idcsmart_security_group_id` (`addon_idcsmart_security_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='安全组规则表'",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group_rule_link`",
            "CREATE TABLE `idcsmart_addon_idcsmart_security_group_rule_link` (
  `addon_idcsmart_security_group_rule_id` int(11) NOT NULL DEFAULT '0' COMMENT '安全组规则ID',
  `server_id` int(11) NOT NULL DEFAULT '0' COMMENT '接口ID',
  `security_rule_id` int(11) NOT NULL DEFAULT '0' COMMENT '云系统安全组规则ID',
  KEY `server_id` (`server_id`),
  KEY `addon_idcsmart_security_group_rule_id` (`addon_idcsmart_security_group_rule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='安全组规则外部关联表'",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_vpc`",
            "CREATE TABLE `idcsmart_addon_idcsmart_vpc` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'VPC ID',
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `module_idcsmart_cloud_data_center_id` int(11) NOT NULL DEFAULT '0' COMMENT '云模块数据中心ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `ip` varchar(100) NOT NULL DEFAULT '' COMMENT 'IP',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `client_id` (`client_id`),
  KEY `module_idcsmart_cloud_data_center_id` (`module_idcsmart_cloud_data_center_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='VPC表'",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_vpc_host_link`",
            "CREATE TABLE `idcsmart_addon_idcsmart_vpc_host_link` (
  `addon_idcsmart_vpc_id` int(11) NOT NULL DEFAULT '0' COMMENT 'VPC ID',
  `host_id` int(11) NOT NULL DEFAULT '0' COMMENT '产品ID',
  KEY `addon_idcsmart_vpc_id` (`addon_idcsmart_vpc_id`),
  KEY `host_id` (`host_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='VPC产品关联表'",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_vpc_link`",
            "CREATE TABLE `idcsmart_addon_idcsmart_vpc_link` (
  `addon_idcsmart_vpc_id` int(11) NOT NULL DEFAULT '0' COMMENT 'VPC ID',
  `server_id` int(11) NOT NULL DEFAULT '0' COMMENT '接口ID',
  `vpc_network_id` int(111) NOT NULL DEFAULT '0' COMMENT '云系统VPC网络ID',
  KEY `addon_idcsmart_vpc_id` (`addon_idcsmart_vpc_id`),
  KEY `server_id` (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='VPC外部关联表'",
        ];
        foreach ($sql as $v){
            Db::execute($v);
        }
        # 安装成功返回true，失败false
        return true;
    }
    # 插件卸载
    public function uninstall()
    {
        $sql = [
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group`",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group_host_link`",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group_link`",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group_rule`",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_security_group_rule_link`",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_vpc`",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_vpc_host_link`",
            "DROP TABLE IF EXISTS `idcsmart_addon_idcsmart_vpc_link`",
        ];
        foreach ($sql as $v){
            Db::execute($v);
        }
        return true;
    }

    public function taskRun($param)
    {
        if($param['type']=='addon_idcsmart_security_group_rule'){
            $fail = false;
            $data = json_decode($param['task_data'], true);
            if($data){
                if($data['type']=='create'){
                    $idcsmartSecurityGroupRule = IdcsmartSecurityGroupRuleModel::find($param['rel_id']);
                    if(!empty($idcsmartSecurityGroupRule)){
                        $idcsmartSecurityGroupLink = IdcsmartSecurityGroupLinkModel::where('addon_idcsmart_security_group_id', $data['id'])->select()->toArray();
                        if(!empty($idcsmartSecurityGroupLink)){
                            $ServerModel = new ServerModel();
                            foreach ($idcsmartSecurityGroupLink as $key => $value) {
                                $idcsmartSecurityGroupRuleLink = IdcsmartSecurityGroupRuleLinkModel::where('addon_idcsmart_security_group_rule_id', $param['rel_id'])->where('server_id', $value['server_id'])->find();
                                if(empty($idcsmartSecurityGroupRuleLink)){
                                    $server = $ServerModel->indexServer($value['server_id']);
                                    $IC = new IC($server);
                                    $result = $IC->securityGroupRuleCreate($value['security_id'], $idcsmartSecurityGroupRule);
                                    if($result['status']==200){
                                        IdcsmartSecurityGroupRuleLinkModel::create([
                                            'addon_idcsmart_security_group_rule_id' => $param['rel_id'],
                                            'server_id' => $value['server_id'],
                                            'security_rule_id' => $result['data']['id'],
                                        ]);
                                    }else{
                                        $fail = true;
                                    }
                                }
                            }
                        }
                    }
                    
                }else if($data['type']=='update'){
                    $idcsmartSecurityGroupRule = IdcsmartSecurityGroupRuleModel::find($param['rel_id']);
                    if(!empty($idcsmartSecurityGroupRule)){
                        $idcsmartSecurityGroupRuleLink = IdcsmartSecurityGroupRuleLinkModel::where('addon_idcsmart_security_group_rule_id', $param['rel_id'])->select()->toArray();
                        foreach ($idcsmartSecurityGroupRuleLink as $key => $value) {
                            $server = $ServerModel->indexServer($value['server_id']);
                            $result = $IC->securityGroupRuleModify($value['security_rule_id'], $idcsmartSecurityGroupRule);
                            if($result['status']!=200){
                                $fail = true;
                            }
                        }
                    }
                }else if($data['type']=='delete'){
                    $idcsmartSecurityGroupRuleLink = IdcsmartSecurityGroupRuleLinkModel::where('addon_idcsmart_security_group_rule_id', $param['rel_id'])->select()->toArray();
                    foreach ($idcsmartSecurityGroupRuleLink as $key => $value) {
                        $server = $ServerModel->indexServer($value['server_id']);
                        $result = $IC->securityGroupRuleDelete($value['security_rule_id']);
                        if($result['status']!=200){
                            $fail = true;
                        }
                    }
                }
                
            }
            return $fail===false ? 'Finish' : 'Failed';
        }else if($param['type']=='addon_idcsmart_security_group'){
            $fail = false;
            $data = json_decode($param['task_data']);
            if($data){
                if($data['type']=='delete'){
                    $idcsmartSecurityGroupLink = IdcsmartSecurityGroupLinkModel::where('addon_idcsmart_security_group_id', $param['rel_id'])->select()->toArray();
                    foreach ($idcsmartSecurityGroupLink as $key => $value) {
                        $server = $ServerModel->indexServer($value['server_id']);
                        $result = $IC->securityGroupDelete($value['security_id']);
                        if($result['status']!=200){
                            $fail = true;
                        }
                    }
                }
            }
            return $fail===false ? 'Finish' : 'Failed';
        }

    }
}