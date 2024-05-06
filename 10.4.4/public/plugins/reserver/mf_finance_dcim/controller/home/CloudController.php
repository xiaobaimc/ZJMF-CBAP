<?php
namespace reserver\mf_finance_dcim\controller\home;

use app\admin\model\PluginModel;
use app\common\model\HostModel;
use app\common\model\MenuModel;
use app\common\model\OrderModel;
use app\common\model\ProductUpgradeProductModel;
use app\common\model\SupplierModel;
use app\common\model\UpstreamHostModel;
use app\common\model\UpstreamProductModel;
use reserver\mf_finance_dcim\logic\RouteLogic;
use reserver\mf_finance_dcim\model\SystemLogModel;
use think\facade\Cache;
use think\facade\View;
use app\common\model\SelfDefinedFieldModel;

/**
 * @title V10代理魔方财务DCIM-前台
 * @desc V10代理魔方财务DCIM-前台
 * @use reserver\mf_finance_dcim\controller\home\CloudController
 */
class CloudController
{
    /**
     * 时间 2023-02-06
     * @title 获取订购页面配置
     * @desc 获取订购页面配置
     * @url /console/v1/product/:id/remf_finance_dcim/order_page
     * @method  GET
     * @author wyh
     * @version v1
     * @param   int id - 商品ID require
     *
     */
    public function orderPage(){
        $param = request()->param();

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByProduct($param['id']);

            // TODO WYH 20240306 当前商品的上游商品也是代理商品时，继续调上游reserver
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id', $param['id'])->find();
            $upstreamProductUpstream = $upstreamProduct->where('product_id',$upstreamProduct['upstream_product_id'])->find();

            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/product/{$upstreamProduct['upstream_product_id']}/remf_finance_dcim/order_page", [], 'GET');
            }else{
                $postData = [
                    'pid' => $RouteLogic->upstream_product_id,
                    'billingcycle' => $param['billingcycle']??''
                ];

                $result = $RouteLogic->curl( 'cart/set_config', $postData, 'GET');
                if ($result['status']==200){
                    $cycles = [];
                    foreach ($result['product']['cycle'] as $item){
                        if ($item['billingcycle']!='ontrial'){
                            unset($item['product_price'],$item['setup_fee']);
                            $cycles[] = $item;
                        }
                    }
                    $result['product']['cycle'] = $cycles;
                }
            }

        }catch(\Exception $e){
            $result = json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception') . $e->getMessage()]);
        }
        return json($result);
    }

    /**
     * 时间 2023-02-06
     * @title 获取订购页面配置
     * @desc 获取订购页面配置(层级联动)
     * @url /console/v1/product/:id/remf_finance_dcim/link
     * @method  GET
     * @author wyh
     * @version v1
     * @param   int id - 商品ID require
     * @param   int cid - 配置项ID require
     * @param   int sub_id - 子项ID require
     *
     */
    public function link(){
        $param = request()->param();

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByProduct($param['id']);

            // TODO WYH 20240306 当前商品的上游商品也是代理商品时，继续调上游reserver
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id', $param['id'])->find();
            $upstreamProductUpstream = $upstreamProduct->where('product_id',$upstreamProduct['upstream_product_id'])->find();

            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/product/{$upstreamProduct['upstream_product_id']}/remf_finance_dcim/link", [
                    'cid' => $param['cid'],
                    'sub_id' => $param['sub_id'],
                    'billingcycle' => $param['billingcycle']??''
                ], 'GET');
            }else{
                $postData = [
                    'pid' => $RouteLogic->upstream_product_id,
                    'cid' => $param['cid'],
                    'sub_id' => $param['sub_id'],
                    'billingcycle' => $param['billingcycle']??''
                ];

                $result = $RouteLogic->curl( 'link_list', $postData, 'GET');
            }
        }catch(\Exception $e){
            $result = json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_act_exception') . $e->getMessage()]);
        }
        return json($result);
    }

    /**
     * 时间 2022-06-29
     * @title 获取实例详情
     * @desc 获取实例详情
     * @url /console/v1/remf_finance_dcim/:id
     * @method  GET
     * @author hh
     * @version v1
     * @param   int $id - 产品ID
     * @return host_data:基础数据@
     * @host_data  ordernum:订单id
     * @host_data  productid:产品id
     * @host_data  serverid:服务器id
     * @host_data  regdate:产品开通时间
     * @host_data  domain:主机名
     * @host_data  payment:支付方式
     * @host_data  firstpaymentamount:首付金额
     * @host_data  firstpaymentamount_desc:首付金额
     * @host_data  amount:续费金额
     * @host_data  amount_desc:续费金额
     * @host_data  billingcycle:付款周期
     * @host_data  billingcycle_desc:付款周期
     * @host_data  nextduedate:到期时间
     * @host_data  nextinvoicedate:下次帐单时间
     * @host_data  dedicatedip:独立ip
     * @host_data  assignedips:附加ip
     * @host_data  ip_num:IP数量
     * @host_data  domainstatus:产品状态
     * @host_data  domainstatus_desc:产品状态
     * @host_data  username:服务器用户名
     * @host_data  password:服务器密码
     * @host_data  suspendreason:暂停原因
     * @host_data  auto_terminate_end_cycle:是否到期取消
     * @host_data  auto_terminate_reason:取消原因
     * @host_data  productname:产品名
     * @host_data  groupname:产品组名
     * @host_data  bwusage:当前使用流量
     * @host_data  bwlimit:当前使用流量上限(0表示不限)
     * @host_data  os:操作系统
     * @host_data  port:端口
     * @host_data  remark:备注
     * @return config_options:可配置选项@
     * @config_options  name:配置名
     * @config_options  sub_name:配置项值
     * @return custom_field_data:自定义字段@
     * @custom_field_data  fieldname:字段名
     * @custom_field_data  value:字段值
     * @return download_data:可下载数据@
     * @download_data  id:文件id
     * @title  id:文件标题
     * @down_link  id:下载链接
     * @location  id:文件名
     * @return module_button:模块按钮@
     * @module_button  type:default:默认,custom:自定义
     * @module_button  type:func:函数名
     * @module_button  type:name:名称
     * @return module_client_area:模块页面输出
     * @return hook_output:钩子在本页面的输出，数组，循环显示的html
     * @return dcim.flowpacket:当前产品可购买的流量包@
     * @dcim.flowpacket  id:流量包ID
     * @dcim.flowpacket  name:流量包名称
     * @dcim.flowpacket  price:价格
     * @dcim.flowpacket  sale_times:销售次数
     * @dcim.flowpacket  stock:库存(0不限)
     * @return dcim.auth:服务器各种操作权限控制(on有权限off没权限)
     * @return dcim.area_code:区域代码
     * @return dcim.area_name:区域名称
     * @return dcim.os_group:操作系统分组@
     * @dcim.os_group  id:分组ID
     * @dcim.os_group  name:分组名称
     * @dcim.os_group  svg:分组svg号
     * @return dcim.os:操作系统数据@
     * @dcim.os  id:操作系统ID
     * @dcim.os  name:操作系统名称
     * @dcim.os  ostype:操作系统类型(1windows0linux)
     * @dcim.os  os_name:操作系统真实名称(用来判断具体的版本和操作系统)
     * @dcim.os  group_id:所属分组ID
     * @return  flow_packet_use_list:流量包使用情况@
     * @flow_packet_use_list  name:流量包名称
     * @flow_packet_use_list  capacity:流量包大小
     * @flow_packet_use_list  price:价格
     * @flow_packet_use_list  pay_time:支付时间
     * @flow_packet_use_list  used:已用流量
     * @flow_packet_use_list  used:已用流量
     * @return  host_cancel: 取消请求数据,空对象
     */
    public function detail(){
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete']){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}", [], 'GET');
            }else{
                $result = $RouteLogic->curl( 'host/header', ['host_id'=>$RouteLogic->upstream_host_id], 'GET');
                if ($result['status']==200){
                    if (isset($result['data']['host_data'])){
                        /*$host_data = [
                            "dedicatedip" => $result['data']['host_data']['dedicatedip'],
                            "domain" => $result['data']['host_data']['domain'],
                            "domainstatus" => $result['data']['host_data']['domainstatus'],
                        ];
                        $result['data']['host_data'] = $host_data;*/
                        unset(
                            $result['data']['host_data']['amount'],
                            $result['data']['host_data']['amount_desc'],
                            $result['data']['host_data']['firstpaymentamount'],
                            $result['data']['host_data']['firstpaymentamount_desc'],
                            $result['data']['host_data']['order_amount'],
                            $result['data']['host_data']['upstream_price_value']
                        );
                    }
                }
            }
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        if ($result['status']!=200){
            $result['status'] = 400;
        }
        return json($result);
    }

    /**
     * 时间 2022-06-22
     * @title 开机
     * @desc 开机
     * @url /console/v1/remf_finance_dcim/:id/on
     * @method  POST
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     */
    public function on()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete']){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/on", [
                    'os' => $param['os']??'',
                    'code' => $param['code']??'',
                ], 'POST');
            }else{
                $postData = [
                    'id'        => $RouteLogic->upstream_host_id,
                    'is_api'    => true
                ];

                $result = $RouteLogic->curl('dcim/on', $postData, 'POST');
            }

            if($result['status'] == 200){
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_boot_success', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }else{
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_boot_fail', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }
            active_log($description, 'host', $HostModel['id']);
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2022-06-22
     * @title 关机
     * @desc 关机
     * @url /console/v1/remf_finance_dcim/:id/off
     * @method  POST
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     */
    public function off()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/off", [
                    'os' => $param['os']??'',
                    'code' => $param['code']??'',
                ], 'POST');
            }else{
                $postData = [
                    'id'        => $RouteLogic->upstream_host_id,
                    'is_api'    => true
                ];

                $result = $RouteLogic->curl( 'dcim/off', $postData, 'POST');
            }

            if($result['status'] == 200){
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_off_success', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }else{
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_off_fail', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }
            active_log($description, 'host', $HostModel['id']);
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2022-06-22
     * @title 重启
     * @desc 重启
     * @url /console/v1/remf_finance_dcim/:id/reboot
     * @method  POST
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     */
    public function reboot()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/reboot", [
                    'os' => $param['os']??'',
                    'code' => $param['code']??'',
                ], 'POST');
            }else{
                $postData = [
                    'id'        => $RouteLogic->upstream_host_id,
                    'is_api'    => true
                ];

                $result = $RouteLogic->curl( 'dcim/reboot', $postData, 'POST');
            }
            if($result['status'] == 200){
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_reboot_success', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }else{
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_reboot_fail', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }
            active_log($description, 'host', $HostModel['id']);
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2022-06-22
     * @title 重置BMC
     * @desc 重置BMC
     * @url /console/v1/remf_finance_dcim/:id/reset_bmc
     * @method  POST
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     */
    public function resetBmc()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/reset_bmc", [
                ], 'POST');
            }else{
                $postData = [
                    'id'        => $RouteLogic->upstream_host_id,
                    'is_api'    => true
                ];

                $result = $RouteLogic->curl( 'dcim/bmc', $postData, 'POST');
            }

            if($result['status'] == 200){
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_reset_bmc_success', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }else{
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_reset_bmc_fail', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }
            active_log($description, 'host', $HostModel['id']);
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2022-06-29
     * @title 获取控制台地址(TODO)
     * @desc 获取控制台地址
     * @url /console/v1/remf_finance_dcim/:id/vnc
     * @method  POST
     * @author hh
     * @version v1
     * @return  string data.url - 控制台地址
     */
    public function vnc()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/vnc", [
                ], 'POST');
            }else{
                $postData = [
                    'id'        => $RouteLogic->upstream_host_id,
                    'is_api'    => true
                ];

                $result = $RouteLogic->curl( 'dcim/novnc', $postData, 'POST');
            }

            if($result['status'] == 200){
                // 获取的东西放入缓存
                $cache = [
                    'vnc_url' => base64_decode(urldecode($result['data']['url'])),
                    'vnc_pass'=> $result['data']['password'],
                    'password'=> aes_password_decode(''),
                ];
                
                $result['data']['url'] = request()->domain().'/console/v1/remf_finance_dcim/'.$param['id'].'/vnc';
                
                // 生成一个临时token
                $token = md5(rand_str(16));
                $cache['token'] = $token;

                Cache::set('remf_finance_dcim_vnc_'.$param['id'], $cache, 30*60);
                if(strpos($result['data']['url'], '?') !== false){
                    $result['data']['url'] .= '&tmp_token='.$token;
                }else{
                    $result['data']['url'] .= '?tmp_token='.$token;
                }
            }
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2022-07-01
     * @title 控制台页面
     * @desc 控制台页面
     * @url /console/v1/remf_finance_dcim/:id/vnc
     * @method  GET
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     */
    public function vncPage(){
        $param = request()->param();

        $cache = Cache::get('remf_finance_dcim_vnc_'.$param['id']);
        if(!empty($cache) && isset($param['tmp_token']) && $param['tmp_token'] === $cache['token']){
            View::assign($cache);
        }else{
            return lang_plugins('res_remf_finance_dcim_vnc_token_expired_please_reopen');
        }
        return View::fetch(WEB_ROOT . 'plugins/reserver/mf_dcim/view/vnc_page.html');
    }

    /**
     * 时间 2022-06-24
     * @title 获取实例状态
     * @desc 获取实例状态
     * @url /console/v1/remf_finance_dcim/:id/status
     * @method  GET
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     * @return  string data.status - 实例状态(on=开机,off=关机,operating=操作中,fault=故障)
     * @return  string data.desc - 实例状态描述
     */
    public function status()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/status", [
                ], 'GET');
            }else{
                $postData = [
                    'id'        => $RouteLogic->upstream_host_id,
                    'is_api'    => true
                ];

                $res = $RouteLogic->curl( 'dcim/refresh_all_power_status', $postData, 'POST');

                if($res['status'] == 200 && isset($res['data'][0]['status'])){
                    if($res['data'][0]['status'] == 'not_support'){
                        $status = [
                            'status' => 'fault',
                            'desc'   => lang_plugins('res_mf_finance_dcim_fault'),
                        ];
                    }else if($res['data'][0]['status'] == 'on'){
                        $status = [
                            'status' => 'on',
                            'desc'   => lang_plugins('res_mf_finance_dcim_on'),
                        ];
                    }else if($res['data'][0]['status'] == 'off'){
                        $status = [
                            'status' => 'off',
                            'desc'   => lang_plugins('res_mf_finance_dcim_off')
                        ];
                    }else if($res['data'][0]['status'] == 'error'){
                        $status = [
                            'status' => 'off',
                            'desc'   => lang_plugins('res_mf_finance_dcim_fault')
                        ];
                    }else{
                        $status = [
                            'status' => 'fault',
                            'desc'   => lang_plugins('res_mf_finance_dcim_fault'),
                        ];
                    }
                }else{
                    $status = [
                        'status' => 'fault',
                        'desc'   => lang_plugins('res_mf_finance_dcim_fault'),
                    ];
                }
                $result = [
                    'status' => 200,
                    'msg'    => lang_plugins('success_message'),
                    'data'   => $status,
                ];
            }

        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2022-06-24
     * @title 重置密码
     * @desc 重置密码
     * @url /console/v1/remf_finance_dcim/:id/reset_password
     * @method  POST
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     * @param   string password - 新密码 require
     */
    public function resetPassword()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/reset_password", [
                    'password' => $param['password']??'',
                ], 'POST');
            }else{
                $postData = [
                    'id'            => $RouteLogic->upstream_host_id,
                    'password'      => $param['password'] ?? '',
                    'is_api' => true
                ];

                $result = $RouteLogic->curl( 'dcim/crack_pass', $postData, 'POST');
            }

            if($result['status'] == 200){
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_reset_password_success', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }else{
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_reset_password_success', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }
            active_log($description, 'host', $HostModel['id']);
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2022-06-24
     * @title 救援模式
     * @desc 救援模式
     * @url /console/v1/remf_finance_dcim/:id/rescue
     * @method  POST
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     * @param   int type - 指定救援系统类型(1=windows,2=linux) require
     */
    public function rescue()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/rescue", [
                    'type' => $param['type']??'',
                ], 'POST');
            }else{
                $postData = [
                    'id'        => $RouteLogic->upstream_host_id,
                    'system'    => $param['type'] == 2 ? 1 : 2,
                    'is_api'    => true
                ];

                $result = $RouteLogic->curl( 'dcim/rescue', $postData, 'POST');
            }

            if($result['status'] == 200){
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_rescue_success', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }else{
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_rescue_fail', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }
            active_log($description, 'host', $HostModel['id']);
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2022-06-24
     * @title 取消救援
     * @desc 取消救援
     * @url /console/v1/remf_finance_dcim/:id/cancel_task
     * @method  POST
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     */
    public function cancelTask()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/cancel_task", [
                ], 'POST');
            }else{
                $postData = [
                    'id'        => $RouteLogic->upstream_host_id,
                    'is_api'    => true
                ];

                $result = $RouteLogic->curl( 'dcim/cancel_task', $postData, 'POST');
            }

            if($result['status'] == 200){
                $description = lang_plugins('res_mf_finance_dcim_log_host_cancel_rescue_success', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }else{
                $description = lang_plugins('res_mf_finance_dcim_log_host_cancel_rescue_fail', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }
            active_log($description, 'host', $HostModel['id']);
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }


    /**
     * 时间 2022-06-30
     * @title 重装系统
     * @desc 重装系统
     * @url /console/v1/remf_finance_dcim/:id/reinstall
     * @method  POST
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     * @param   int os - 重装系统的操作系统id require
     * @param   string password - 密码 require
     * @param   int port - 端口 require
     */
    public function reinstall()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/reinstall", [
                    'os' => $param['os']??'',
                    'port' => $param['port']??'',
                    'password' => $param['password']??'',
                ], 'POST');
            }else{
                $postData = [
                    'id'        => $RouteLogic->upstream_host_id,
                    'os'        => $param['os'] ?? '',
                    'password'  => $param['password'] ?? '',
                    'port'      => $param['port'] ?? '',
                    'is_api'    => true
                ];

                $result = $RouteLogic->curl( 'dcim/reinstall', $postData, 'POST');
            }

            if($result['status'] == 200){
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_reinstall_success', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }else{
                $description = lang_plugins('res_mf_finance_dcim_log_host_start_reinstall_fail', [
                    '{hostname}' => $HostModel['name'],
                ]);
            }
            active_log($description, 'host', $HostModel['id']);
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2020-07-06
     * @title 获取模块图表数据
     * @desc 获取模块图表数据
     * @url /console/v1/remf_finance_dcim/:id/chart
     * @method  GET
     * @author hh
     * @version v1
     * @param   int id - 产品ID require
     * @param   int start_time - 开始秒级时间
     * @return  array list - 图表数据
     * @return  int list[].time - 时间(秒级时间戳)
     * @return  float list[].in_bw - 进带宽
     * @return  float list[].out_bw - 出带宽
     * @return  string unit - 当前单位
     */
    public function chart()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        $data = [];

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $res = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/chart", [
                    'start_time' => $param['start_time']??'',
                ], 'POST');
            }else{
                $postData = [
                    'id'            => $RouteLogic->upstream_host_id,
                    'start_time'    => isset($param['start_time']) ? $param['start_time'].'000' : '',
                    'type'          => 'server',
                    // 'switch_id'     => $RouteLogic->upstream_host_id,
                    'is_api'        => true
                ];

                $res = $RouteLogic->curl( '/dcim/traffic', $postData, 'POST');
            }

            if(isset($res['data']['traffic'])){
                foreach($res['data']['traffic'] as $v){
                    if(!isset($data['list'][$v['time']])){
                        $data['list'][$v['time']] = [
                            'time'   => $v['time']/1000,
                            'in_bw'  => round($v['value'], 2),
                            'out_bw' => 0,
                        ];
                    }else{
                        $data['list'][$v['time']]['out_bw'] = round($v['value'], 2);
                    }
                }
                $data['unit'] = $res['data']['unit'];

                $data['list'] = array_values($data['list']);
            }

            $result = [
                'status' => 200,
                'msg'    => lang_plugins('success_message'),
                'data'   => $data,
            ];
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2022-09-26
     * @title 获取商品配置所有周期价格
     * @desc 获取商品配置所有周期价格
     * @url /console/v1/product/:id/remf_finance_dcim/duration
     * @method  GET
     * @author wyh
     * @version v1
     * @param   int id - 商品ID require
     * @return object duration - 周期
     * @return float duration.product_price - 价格
     * @return float duration.setup_fee - 初装费
     * @return string duration.billingcycle - 周期
     * @return string duration.billingcycle_zh - 周期
     * @return string duration.pay_ontrial_cycle - 试用
     */
    public function cartConfigoption()
    {
        $param = request()->param();

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByProduct($param['id']);

            unset($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $HostModel = HostModel::find($param['id']);
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/product/{$upstreamHost['upstream_host_id']}/remf_finance_dcim/duration", [
                    'billingcycle' => $param['billingcycle']??''
                ], 'GET');
            }else{
                $postData = [
                    'pid' => $RouteLogic->upstream_product_id,
                    'billingcycle' => $param['billingcycle']??''
                ];

                $result = $RouteLogic->curl( 'cart/set_config', $postData, 'GET');
            }

            if($result['status'] == 200){
                // 计算价格倍率
                foreach($result['product']['cycle'] as $k=>$v){
                    if($v['product_price'] > 0){
                        # 固定利润
                        if ($RouteLogic->profit_type==1){
                            $result['product']['cycle'][$k]['product_price'] = bcadd($v['product_price'], $RouteLogic->profit_percent*100);
                        }else{
                            $result['product']['cycle'][$k]['product_price'] = bcmul($v['product_price'], $RouteLogic->price_multiple);
                        }

                    }
                    if($v['setup_fee'] > 0){
                        # 固定利润
                        if ($RouteLogic->profit_type==1){
                            $result['product']['cycle'][$k]['setup_fee'] = bcadd($v['setup_fee'], 0);
                        }else{
                            $result['product']['cycle'][$k]['setup_fee'] = bcmul($v['setup_fee'], $RouteLogic->price_multiple);
                        }
                    }
                }
                $cycles = [];
                foreach ($result['product']['cycle'] as $item){
                    if ($item['billingcycle']!='ontrial'){
                        //unset($item['product_price'],$item['setup_fee']);
                        $cycles[] = $item;
                    }
                }
                $result['product']['cycle'] = $cycles;

                $res = [
                    'status' => 200,
                    'msg' => $result['msg'],
                    'data' => [
                        'duration' => $result['product']['cycle']??[]
                    ]
                ];
                return json($res);
            }else{
                return json($result);
            }
        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
    }

    /**
     * 时间 2023-02-09
     * @title 产品列表
     * @desc 产品列表
     * @url /console/v1/remf_finance_dcim
     * @method  GET
     * @author hh
     * @version v1
     * @param   int page 1 页数
     * @param   int limit - 每页条数
     * @param   string orderby - 排序(id,due_time,status)
     * @param   string sort - 升/降序
     * @param   string keywords - 关键字搜索,搜索套餐名称/主机名/IP
     * @param   string status - 产品状态(Unpaid=未付款,Pending=开通中,Active=已开通,Suspended=已暂停,Deleted=已删除)
     * @param   string tab - 状态using使用中expiring即将到期overdue已逾期deleted已删除
     * @param   int param.m - 菜单ID
     * @return  array data.list - 列表数据
     * @return  int data.list[].id - 产品ID
     * @return  string data.list[].name - 产品标识
     * @return  string data.list[].status - 产品状态(Unpaid=未付款,Pending=开通中,Active=已开通,Suspended=已暂停,Deleted=已删除)
     * @return  int data.list[].due_time - 到期时间
     * @return  int data.list[].active_time - 开通时间
     * @return  string data.list[].product_name - 商品名称
     * @return  int count - 总条数
     * @return  int expiring_count - 即将到期产品数量
     * @return  int self_defined_field[].id - 自定义字段ID
     * @return  string self_defined_field[].field_name - 自定义字段名称
     * @return  string self_defined_field[].field_type - 字段类型(text=文本框,link=链接,password=密码,dropdown=下拉,tickbox=勾选框,textarea=文本区)
     */
    public function list(){
        $param = request()->param();

        $result = [
            'status' => 200,
            'msg'    => lang_plugins('success_message'),
            'data'   => [
                'list'  => [],
                'count' => [],
            ]
        ];

        $clientId = get_client_id();
        if(empty($clientId)){
            return json($result);
        }

        $where = [];
        if(isset($param['m']) && !empty($param['m'])){
            // 菜单,菜单里面必须是下游商品
            $MenuModel = MenuModel::where('menu_type', 'res_module')
                ->where('module', 'mf_finance_dcim')
                ->where('id', $param['m'])
                ->find();
            if(!empty($MenuModel) && !empty($MenuModel['product_id'])){
                $MenuModel['product_id'] = json_decode($MenuModel['product_id'], true);
                if(!empty($MenuModel['product_id'])){
                    $upstreamProduct = UpstreamProductModel::whereIn('product_id', $MenuModel['product_id'])->where('res_module', 'mf_finance_dcim')->find();
                    if(!empty($upstreamProduct)){
                        $where[] = ['h.product_id', 'IN', $MenuModel['product_id'] ];
                    }
                }
            }
        }else{
            //return json($result);
        }

        $param['page'] = isset($param['page']) ? ($param['page'] ? (int)$param['page'] : 1) : 1;
        $param['limit'] = isset($param['limit']) ? ($param['limit'] ? (int)$param['limit'] : config('idcsmart.limit')) : config('idcsmart.limit');
        $param['sort'] = isset($param['sort']) ? ($param['sort'] ?: config('idcsmart.sort')) : config('idcsmart.sort');
        $param['orderby'] = isset($param['orderby']) && in_array($param['orderby'], ['id','due_time','status']) ? $param['orderby'] : 'id';
        $param['orderby'] = 'h.'.$param['orderby'];

        $where[] = ['h.client_id', '=', $clientId];
        $where[] = ['h.status', '<>', 'Cancelled'];

        // 前台是否展示已删除产品
        $homeShowDeletedHost = configuration('home_show_deleted_host');
        if($homeShowDeletedHost!=1){
            $where[] = ['h.status', '<>', 'Deleted'];
        }

        // 获取子账户可见产品
        $res = hook('get_client_host_id', ['client_id' => get_client_id(false)]);
        $res = array_values(array_filter($res ?? []));
        foreach ($res as $key => $value) {
            if(isset($value['status']) && $value['status']==200){
                $hostId = $value['data']['host'];
            }
        }
        if(isset($hostId) && !empty($hostId)){
            $where[] = ['h.id', 'IN', $hostId];
        }

        // hh 20240319 先做兼容处理,后续稳定后不用判断
        $supportOrderRecycleBin = is_numeric(configuration('order_recycle_bin'));
        if($supportOrderRecycleBin){
            $where[] = ['h.is_delete', '=', 0];
        }

        // theworld 20240401 获取即将到期数量
        $expiringCount = HostModel::alias('h')
                ->field('h.id')
                ->leftJoin('product p', 'h.product_id=p.id')
                ->join('upstream_product up', 'p.id=up.product_id AND up.res_module="mf_finance_dcim"')
                ->where($where)
                ->where(function($query){
                    $time = time();
                    $renewalFirstDay = configuration('cron_due_renewal_first_day');
                    $timeRenewalFirst = strtotime(date('Y-m-d 23:59:59', $time+$renewalFirstDay*24*3600));
                    $query->whereIn('h.status', ['Pending', 'Active'])->where('h.due_time', '>', $time)->where('h.due_time', '<=', $timeRenewalFirst)->where('billing_cycle', '<>', 'free')->where('billing_cycle', '<>', 'onetime');
                })
                ->count();

        // theworld 20240401 列表过滤条件移动
        if(isset($param['status']) && !empty($param['status'])){
            if($param['status'] == 'Pending'){
                $where[] = ['h.status', 'IN', ['Pending','Failed']];
            }else if(in_array($param['status'], ['Unpaid','Active','Suspended','Deleted'])){
                $where[] = ['h.status', '=', $param['status']];
            }
        }
        if(isset($param['tab']) && !empty($param['tab'])){
            if($param['tab']=='using'){
                $where[] = ['h.status', 'IN', ['Pending','Active']];
            }else if($param['tab']=='expiring'){
                $time = time();
                $renewalFirstDay = configuration('cron_due_renewal_first_day');
                $timeRenewalFirst = strtotime(date('Y-m-d 23:59:59', $time+$renewalFirstDay*24*3600));

                $where[] = ['h.status', 'IN', ['Pending','Active']];
                $where[] = ['h.due_time', '>', $time];
                $where[] = ['h.due_time', '<=', $timeRenewalFirst];
                $where[] = ['h.billing_cycle', '<>', 'free'];
                $where[] = ['h.billing_cycle', '<>', 'onetime'];
            }else if($param['tab']=='overdue'){
                $time = time();

                $where[] = ['h.status', 'IN', ['Pending', 'Active', 'Suspended', 'Failed']];
                $where[] = ['h.due_time', '<=', $time];
                $where[] = ['h.billing_cycle', '<>', 'free'];
                $where[] = ['h.billing_cycle', '<>', 'onetime'];
            }else if($param['tab']=='deleted'){
                $time = time();
                $where[] = ['h.status', '=', 'Deleted'];
            }
        }
        if(isset($param['keywords']) && $param['keywords'] !== ''){
            $where[] = ['h.name', 'LIKE', '%'.$param['keywords'].'%'];
        }

        $count = HostModel::alias('h')
            ->leftJoin('product p', 'h.product_id=p.id')
            ->join('upstream_product up', 'p.id=up.product_id AND up.res_module="mf_finance_dcim"')
            ->where($where)
            ->count();

        $host = HostModel::alias('h')
            ->field('h.id,h.product_id,h.name,h.status,h.active_time,h.due_time,p.name product_name,h.client_notes')
            ->leftJoin('product p', 'h.product_id=p.id')
            ->join('upstream_product up', 'p.id=up.product_id AND up.res_module="mf_finance_dcim"')
            ->where($where)
            ->withAttr('status', function($val){
                return $val == 'Failed' ? 'Pending' : $val;
            })
            ->limit($param['limit'])
            ->page($param['page'])
            ->order($param['orderby'], $param['sort'])
            ->group('h.id')
            ->select()
            ->toArray();
        if(!empty($host) && class_exists('app\common\model\SelfDefinedFieldModel')){
            $hostId = array_column($host, 'id');
            $productId = array_column($host, 'product_id');

            $SelfDefinedFieldModel = new SelfDefinedFieldModel();
            $selfDefinedField = $SelfDefinedFieldModel->getHostListSelfDefinedFieldValue([
                'product_id' => $productId,
                'host_id'    => $hostId,
            ]);
        }
        foreach($host as $k=>$v){
            $host[$k]['self_defined_field'] = $selfDefinedField['self_defined_field_value'][ $v['id'] ] ?? (object)[];
        }

        $result['data']['list']  = $host;
        $result['data']['count'] = $count;
        $result['data']['expiring_count'] = $expiringCount;     
        $result['data']['self_defined_field'] = $selfDefinedField['self_defined_field'] ?? [];
        return json($result);
    }

    /**
     * 时间 2022-07-01
     * @title 日志
     * @desc 日志
     * @url /console/v1/remf_finance_dcim/:id/log
     * @method  GET
     * @author hh
     * @version v1
     * @param int id - 产品ID
     * @param string keywords - 关键字
     * @param int page - 页数
     * @param int limit - 每页条数
     * @param string orderby - 排序 id,description,create_time,ip
     * @param string sort - 升/降序 asc,desc
     * @return array list - 系统日志
     * @return int list[].id - 系统日志ID
     * @return string list[].description - 描述
     * @return string list[].create_time - 时间
     * @return int list[].ip - IP
     * @return int count - 系统日志总数
     */
    public function log(){
        $param = request()->param();

        $SystemLogModel = new SystemLogModel();
        $result = $SystemLogModel->systemLogList($param);
        return json($result);
    }

    /**
     * 时间 2023-02-06
     * @title 升降级配置页面
     * @desc 升降级配置页面
     * @url /console/v1/remf_finance_dcim/:id/upgrade_config
     * @method  GET
     * @author wyh
     * @version v1
     * @param int id - 产品ID require
     * @return array host - 配置数据
     */
    public function upgradeConfig(){
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $HostModel = HostModel::find($param['id']);
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/upgrade_config", [
                ], 'GET');
            }else{
                $postData = [
                    'hid' => $RouteLogic->upstream_host_id,
                ];

                $result = $RouteLogic->curl( 'upgrade/index/'.$RouteLogic->upstream_host_id, $postData,'GET');
            }

        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2023-02-06
     * @title 升降级配置计算价格
     * @desc 升降级配置计算价格
     * @url /console/v1/remf_finance_dcim/:id/sync_upgrade_config_price
     * @method  POST
     * @author wyh
     * @version v1
     * @param int id - 产品ID require
     * @param array configoption - 配置信息{"配置ID":"子项ID"} require
     * @return float price - 价格
     */
    public function syncUpgradeConfigPrice(){
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
            $UpstreamHostModel = new UpstreamHostModel();
            $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
            $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
            $HostModel = HostModel::find($param['id']);
            $SupplierModel = new SupplierModel();
            $supplier = $SupplierModel->find($RouteLogic->supplier_id);
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
            if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
                // 上游商品
                $result = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/sync_upgrade_config_price", [
                    'configoption' => $param['configoption']??[]
                ], 'POST');
                if ($result['status']==200){

                    if (isset($result['data']['client_level_discount'])){
                        $result['data']['price'] = bcsub($result['data']['price'],floatval($result['data']['client_level_discount']),2);
                    }

                    if ($RouteLogic->profit_type==1){
                        $result['data']['price'] = bcadd($result['data']['price'],$RouteLogic->getProfitPercent()*100,2);
                    }else{
                        $result['data']['price'] = bcmul($result['data']['price'],(1+$RouteLogic->getProfitPercent()),2);
                    }

                    $PluginModel = new PluginModel();
                    $plugin = $PluginModel->where('status',1)->where('name','IdcsmartClientLevel')->find();
                    if (!empty($plugin)){
                        $IdcsmartClientLevelModel = new \addon\idcsmart_client_level\model\IdcsmartClientLevelModel();
                        // 获取商品折扣金额
                        $clientLevelDiscount = $IdcsmartClientLevelModel->productDiscount([
                            'id' => $HostModel['product_id'],
                            'amount' => $result['data']['price']
                        ]);
                        $result['data']['client_level_discount'] = $clientLevelDiscount??0;
                    }

                }
            }else{
                $postData = [
                    'hid' => $RouteLogic->upstream_host_id,
                    'configoption' => $param['configoption']??[]
                ];

                $result = $RouteLogic->curl( 'upgrade/upgrade_config_post', $postData,'POST');

                if ($result['status']==200){
                    $result = $RouteLogic->curl( 'upgrade/upgrade_config_page', ['hid' => $RouteLogic->upstream_host_id],'GET');
                    if ($result['status']==200){
                        $res['status'] = 200;
                        $res['msg'] = $result['msg'];
                        //$res['data'] = $result['data'];
                        if ($RouteLogic->profit_type==1){
                            $res['data']['price'] = bcadd(($result['data']['subtotal']??0)-($result['data']['saleproducts']??0), !empty($result['data']['alloption'])?$RouteLogic->getProfitPercent()*100:0,2);
                        }else{
                            $res['data']['price'] = bcmul(($result['data']['subtotal']??0)-($result['data']['saleproducts']??0), (1+$RouteLogic->getProfitPercent()),2);
                        }

                        if ($res['data']['price']<0){
                            $res['data']['price'] = bcsub(0,0,2);
                        }

                        $PluginModel = new PluginModel();
                        $plugin = $PluginModel->where('status',1)->where('name','IdcsmartClientLevel')->find();
                        if (!empty($plugin)){
                            $IdcsmartClientLevelModel = new \addon\idcsmart_client_level\model\IdcsmartClientLevelModel();
                            // 获取商品折扣金额
                            $clientLevelDiscount = $IdcsmartClientLevelModel->productDiscount([
                                'id' => $HostModel['product_id'],
                                'amount' => $res['data']['price']
                            ]);
                            $res['data']['client_level_discount'] = $clientLevelDiscount??0;
                        }

                        return json($res);
                    }
                }
            }

        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2023-02-06
     * @title 升降级配置结算(拉取页面，v10调用)
     * @desc 升降级配置结算(拉取页面，v10调用)
     * @url /console/v1/remf_finance_dcim/:id/upgrade_config_page
     * @method  GET
     * @author wyh
     * @version v1
     * @param int id - 产品ID require
     */
    public function upgradeConfigPostPage()
    {
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }
        $RouteLogic = new RouteLogic();
        $RouteLogic->routeByHost($param['id']);

        // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
        $UpstreamHostModel = new UpstreamHostModel();
        $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
        $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
        $HostModel = HostModel::find($param['id']);
        $SupplierModel = new SupplierModel();
        $supplier = $SupplierModel->find($RouteLogic->supplier_id);
        $UpstreamProductModel = new UpstreamProductModel();
        $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
        if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
            // 上游商品
            $res = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/upgrade_config_page", [
            ], 'GET');
        }else{
            $res = $RouteLogic->curl( 'upgrade/upgrade_config_page', ['hid' => $RouteLogic->upstream_host_id],'GET');
        }

        if ($res['status']!=200){
            return json($res);
        }
        $description = "";
        foreach ($res['data']['alloption'] as $item){
            $option_type = $item['option_type'];
            if ($option_type == 4 || $option_type == 7 || $option_type == 9 || $option_type == 11 || $option_type == 14 || $option_type == 15 ||$option_type == 16 || $option_type == 17 || $option_type == 18 || $option_type == 19){
                $description .= $item['option_name'] . ":" . ($item['old_qty']??0) . "=>" . (($item['qty']??0).($item['unit']??"")) . "\n";
            }else{
                $description .= $item['option_name'] . ":" . ($item['old_suboption_name']??'') . "=>" . $item['suboption_name'] . "\n";
            }
        }
        $res['data']['description'] = $description;
        $res['data']['subtotal'] = (isset($res['data']['subtotal']) && $res['data']['subtotal']>0)?$res['data']['subtotal']:bcsub(0,0,2);
        $res['data']['total'] = (isset($res['data']['total']) && $res['data']['total']>0)?$res['data']['total']:bcsub(0,0,2);

        $res['data']['subtotal'] = $RouteLogic->profit_type==1?bcadd(($res['data']['subtotal']??0),!empty($res['data']['alloption'])?$RouteLogic->getProfitPercent()*100:0,2):bcmul(($res['data']['subtotal']??0), (1+$RouteLogic->getProfitPercent()),2);
        $res['data']['saleproducts'] = $RouteLogic->profit_type==1?bcadd(($res['data']['saleproducts']??0),!empty($res['data']['alloption'])?$RouteLogic->getProfitPercent()*100:0,2):bcmul(($res['data']['saleproducts']??0), (1+$RouteLogic->getProfitPercent()),2);

        $PluginModel = new PluginModel();
        $plugin = $PluginModel->where('status',1)->where('name','IdcsmartClientLevel')->find();

        $recurringChange = 0;
        if (isset($res['data']['alloption']) && !empty($res['data']['alloption'])){
            foreach ($res['data']['alloption'] as &$item1){
                if ($RouteLogic->profit_type==1){
                    $amount = !empty($res['data']['alloption'])?$RouteLogic->getProfitPercent()*100:0;
                    $item1['upgrade_item']['recurring_change'] = bcadd(($item1['upgrade_item']['recurring_change']??0),$amount/count($res['data']['alloption']),2);
                }else{
                    $item1['upgrade_item']['recurring_change'] = bcmul(($item1['upgrade_item']['recurring_change']??0),(1+$RouteLogic->getProfitPercent()),2);
                }

                $recurringChange += ($item1['upgrade_item']['recurring_change'])??0;
            }
            if (!empty($plugin)){
                $IdcsmartClientLevelModel = new \addon\idcsmart_client_level\model\IdcsmartClientLevelModel();
                // 获取商品折扣金额
                $recurringChangeDiscount = $IdcsmartClientLevelModel->productDiscount([
                    'id' => $HostModel['product_id'],
                    'amount' => $recurringChange
                ]);
                $res['data']['recurring_change_discount'] = $recurringChangeDiscount??0;
            }
            // 降级
            if ($recurringChange<0){
                $res['data']['subtotal'] = $recurringChange;
                $res['data']['downgrade'] = true;
            }
        }

        if (!empty($plugin)){
            $IdcsmartClientLevelModel = new \addon\idcsmart_client_level\model\IdcsmartClientLevelModel();
            // 获取商品折扣金额
            $subtotalDiscount = $IdcsmartClientLevelModel->productDiscount([
                'id' => $HostModel['product_id'],
                'amount' => $res['data']['subtotal']
            ]);
            $totalDiscount = $IdcsmartClientLevelModel->productDiscount([
                'id' => $HostModel['product_id'],
                'amount' => $res['data']['total']
            ]);
            $saleproductsDiscount = $IdcsmartClientLevelModel->productDiscount([
                'id' => $HostModel['product_id'],
                'amount' => $res['data']['saleproducts']
            ]);
            $res['data']['subtotal_discount'] = $subtotalDiscount??0;
            // 二级代理及以下给下游的客户等级折扣数据
            $res['data']['total_discount'] = $totalDiscount??0;
            $res['data']['saleproducts_discount'] = $saleproductsDiscount??0;
        }


        return json($res);
    }

    /**
     * 时间 2023-02-06
     * @title 升降级配置结算
     * @desc 升降级配置结算
     * @url /console/v1/remf_finance_dcim/:id/upgrade_config
     * @method  POST
     * @author wyh
     * @version v1
     * @param int id - 产品ID require
     * @return int id - 订单ID
     */
    public function upgradeConfigPost(){
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }
        $RouteLogic = new RouteLogic();
        $RouteLogic->routeByHost($param['id']);

        // TODO WYH 20240306 当前产品的上游产品也是代理产品时，继续调上游reserver
        $UpstreamHostModel = new UpstreamHostModel();
        $upstreamHost = $UpstreamHostModel->where('host_id', $param['id'])->find();
        $upstreamHostUpstream = $UpstreamHostModel->where('host_id',$upstreamHost['upstream_host_id'])->find();
        $HostModel = HostModel::find($param['id']);
        $SupplierModel = new SupplierModel();
        $supplier = $SupplierModel->find($RouteLogic->supplier_id);
        $UpstreamProductModel = new UpstreamProductModel();
        $upstreamProduct = $UpstreamProductModel->where('product_id',$HostModel['product_id'])->find();
        if (!empty($supplier) && $supplier['type']=='default' && $upstreamProduct['res_module']=='mf_finance_dcim'){
            // 上游商品
            $res = $RouteLogic->curl( "console/v1/remf_finance_dcim/{$upstreamHost['upstream_host_id']}/upgrade_config_page", [
            ], 'GET');
        }else{
            $res = $RouteLogic->curl( 'upgrade/upgrade_config_page', ['hid' => $RouteLogic->upstream_host_id],'GET');
        }

        if ($res['status']!=200){
            return json($res);
        }
        $description = "";
        foreach ($res['data']['alloption'] as $item){
            $option_type = $item['option_type'];
            if ($option_type == 4 || $option_type == 7 || $option_type == 9 || $option_type == 11 || $option_type == 14 || $option_type == 15 ||$option_type == 16 || $option_type == 17 || $option_type == 18 || $option_type == 19){
                $description .= $item['option_name'] . ":" . ($item['old_qty']??0) . "=>" . (($item['qty']??0).($item['unit']??"")) . "\n";
            }else{
                $description .= $item['option_name'] . ":" . ($item['old_suboption_name']??'') . "=>" . $item['suboption_name'] . "\n";
            }
        }
        $res['data']['description'] = $description;

        $OrderModel = new OrderModel();

        $res['data']['subtotal'] = (isset($res['data']['subtotal']) && $res['data']['subtotal']>0)?$res['data']['subtotal']:bcsub(0,0,2);
        $res['data']['total'] = (isset($res['data']['total']) && $res['data']['total']>0)?$res['data']['total']:bcsub(0,0,2);

        if (isset($res['data']['downgrade']) && $res['data']['downgrade']){

        }else{
            if (isset($res['data']['subtotal_discount'])){
                $res['data']['subtotal'] = bcsub($res['data']['subtotal'],floatval($res['data']['subtotal_discount']),2);
            }
            if (isset($res['data']['total_discount'])){
                $res['data']['total'] = bcsub($res['data']['total'],floatval($res['data']['total_discount']),2);
            }
            if (isset($res['data']['saleproducts_discount'])){
                $res['data']['saleproducts'] = bcsub($res['data']['saleproducts'],floatval($res['data']['saleproducts_discount']),2);
            }
        }

        $recurringChange = 0;
        if (isset($res['data']['alloption']) && !empty($res['data']['alloption'])){
            foreach ($res['data']['alloption'] as $item1){
                $recurringChange += ($item1['upgrade_item']['recurring_change'])??0;
            }

            if ($recurringChange>0 && isset($res['data']['recurring_change_discount'])){ // 升级
                $recurringChange = bcsub($recurringChange,floatval($res['data']['recurring_change_discount']),2)>0?bcsub($recurringChange,floatval($res['data']['recurring_change_discount']),2):0;
            }elseif ($recurringChange<0 && isset($res['data']['recurring_change_discount'])) { // 降级
                $recurringChange = bcsub($recurringChange,floatval($res['data']['recurring_change_discount']),2);
            }
            // 降级
            if ($recurringChange<0){
                $res['data']['subtotal'] = $recurringChange;
                $res['data']['downgrade'] = true;
            }
        }
        $data = [
            'host_id'     => $param['id']??0,
            'client_id'   => get_client_id(),
            'type'        => 'upgrade_config',
            'amount'      => $RouteLogic->profit_type==1?bcadd(($res['data']['subtotal']??0)-($res['data']['saleproducts']??0),!empty($res['data']['alloption'])?$RouteLogic->getProfitPercent()*100:0,2):bcmul(($res['data']['subtotal']??0)-($res['data']['saleproducts']??0), (1+$RouteLogic->getProfitPercent()),2),//$res['data']['subtotal'],
            'description' => $res['data']['description'],
            'price_difference' => $RouteLogic->profit_type==1?bcadd(($res['data']['subtotal']??0)-($res['data']['saleproducts']??0),!empty($res['data']['alloption'])?$RouteLogic->getProfitPercent()*100:0,2):bcmul(($res['data']['subtotal']??0)-($res['data']['saleproducts']??0), (1+$RouteLogic->getProfitPercent()),2),//$res['data']['total'],
            //'renew_price_difference' => $RouteLogic->profit_type==1?bcadd(($res['data']['subtotal']??0)-($res['data']['saleproducts']??0),!empty($res['data']['alloption'])?$RouteLogic->getProfitPercent()*100:0,2):bcmul(($res['data']['subtotal']??0)-($res['data']['saleproducts']??0), (1+$RouteLogic->getProfitPercent()),2),// $res['data']['total'],
            'renew_price_difference' => $RouteLogic->profit_type==1?bcadd($recurringChange,!empty($res['data']['alloption'])?$RouteLogic->getProfitPercent()*100:0,2):bcmul($recurringChange, bcadd(1,$RouteLogic->getProfitPercent(),2),2),// $res['data']['total'],
            'upgrade_refund' => 0,
            'customfield' => $param['customfield']??[],
            'config_options' => [
                //'configoption' => $param['configoption']??[],
                // 取接口返回的配置
                'configoption' => $res['data']['configoptions']??[],
            ]
        ];

        $result = $OrderModel->createOrder($data);

        return json($result);
    }

    /**
     * 时间 2023-02-06
     * @title 升降级商品
     * @desc 升降级商品
     * @url /console/v1/remf_finance_dcim/:id/upgrade_product
     * @method  GET
     * @author wyh
     * @version v1
     * @param int id - 产品ID require
     * @return object old_host - 原产品数据
     * @return array host - 可升降级的商品数组
     * @return int host[].pid - 商品ID
     * @return string host[].host - 商品名称
     * @return array host[].cycle - 周期
     * @return float host[].cycle[].price - 价格
     * @return string host[].cycle[].billingcycle - 周期
     * @return string host[].cycle[].billingcycle_zh - 周期
     */
    public function upgradeProduct(){
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            $productId = $HostModel['product_id'];

            // 可升降级商品
            $ProductUpgradeProductModel = new ProductUpgradeProductModel();
            $upgradeProductIds = $ProductUpgradeProductModel->where('product_id',$productId)->column('upgrade_product_id');
            // 对应的上游商品ID
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProductIds = $UpstreamProductModel->whereIn('product_id',$upgradeProductIds)->column('upstream_product_id');

            $postData = [
                'need_pids' => $upstreamProductIds??[], // [4,5]
            ];

            $result = $RouteLogic->curl( 'upgrade/upgrade_product/'.$RouteLogic->upstream_host_id, $postData,'GET');

        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_act_exception')]);
        }
        return json($result);
    }

    /**
     * 时间 2023-02-06
     * @title 升降级商品计算价格
     * @desc 升降级商品计算价格
     * @url /console/v1/remf_finance_dcim/:id/sync_upgrade_product_price
     * @method  POST
     * @author wyh
     * @version v1
     * @param int id - 产品ID require
     * @param int product_id - 新商品ID require
     * @param string cycle - 周期,传billingcycle的值 require
     * @return float price - 价格
     */
    public function syncUpgradeProductPrice(){
        $param = request()->param();

        $HostModel = HostModel::find($param['id']);
        if(empty($HostModel) || $HostModel['client_id'] != get_client_id() || $HostModel['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_dcim_host_not_found')]);
        }

        try{
            $RouteLogic = new RouteLogic();
            $RouteLogic->routeByHost($param['id']);

            // 可升降级商品
            $productId = $HostModel['product_id'];
            $ProductUpgradeProductModel = new ProductUpgradeProductModel();
            $upgradeProductIds = $ProductUpgradeProductModel->where('product_id',$productId)->column('upgrade_product_id');
            // 对应的上游商品ID
            $UpstreamProductModel = new UpstreamProductModel();
            $upstreamProductIds = $UpstreamProductModel->whereIn('product_id',$upgradeProductIds)->column('upstream_product_id');
            if (!in_array($param['product_id']??0,$upstreamProductIds)){
                throw new \Exception("商品不可升降级");
            }

            $postData = [
                'hid' => $RouteLogic->upstream_host_id,
                'pid' => $param['product_id']??0,
                'billingcycle' => $param['cycle']??""
            ];

            $result = $RouteLogic->curl( 'upgrade/upgrade_product_post', $postData,'POST');
            if ($result['status']==200){
                $result = $RouteLogic->curl( 'upgrade/upgrade_product_page', ['hid' => $RouteLogic->upstream_host_id],'GET');
                if ($result['status']==200){
                    $res['status'] = 200;
                    $res['msg'] = $result['msg'];
                    $upstream = $UpstreamProductModel->where('upstream_product_id',$param['product_id']??0)
                        ->where('supplier_id',$RouteLogic->supplier_id)
                        ->find();
                    if ($RouteLogic->profit_type==1){
                        $res['data']['price'] = bcadd($result['data']['amount_total']??0, $upstream['profit_percent'],2);
                    }else{
                        $res['data']['price'] = bcmul($result['data']['amount_total']??0, (1+$upstream['profit_percent']),2);
                    }
                    if ($res['data']['price']<0){
                        $res['data']['price'] = bcsub(0,0,2);
                    }
                    return json($res);
                }
            }

        }catch(\Exception $e){
            return json(['status'=>400, 'msg'=>$e->getMessage()/*lang_plugins('res_mf_finance_dcim_act_exception')*/]);
        }
        return json($result);
    }

    /**
     * 时间 2023-02-06
     * @title 升降级商品结算
     * @desc 升降级商品结算
     * @url /console/v1/remf_finance_dcim/:id/upgrade_product
     * @method  POST
     * @author wyh
     * @version v1
     * @param int id - 产品ID require
     * @return int id - 订单ID
     */
    public function upgradeProductPost(){
        $param = request()->param();

        $host = HostModel::find($param['id']);
        if(empty($host) || $host['client_id'] != get_client_id() || $host['is_delete'] ){
            return json(['status'=>400, 'msg'=>lang_plugins('res_mf_finance_host_not_found')]);
        }
        $RouteLogic = new RouteLogic();
        $RouteLogic->routeByHost($param['id']);

        $res = $RouteLogic->curl( 'upgrade/upgrade_product_page', ['hid' => $RouteLogic->upstream_host_id],'GET');
        if ($res['status']!=200){
            return json($res);
        }

        // 上游商品ID
        $upstreamProductId = $res['data']['new_pid'];
        // 对应的本地商品ID
        $UpstreamProductModel = new UpstreamProductModel();
        $upstream = $UpstreamProductModel->where('upstream_product_id',$upstreamProductId)
            ->where('supplier_id',$RouteLogic->supplier_id)
            ->find();
        if (empty($upstream)){
            return json(['status'=>400,'msg'=>"商品不可升降级"]);
        }

        // 以新商品利润计算
        if ($RouteLogic->profit_type==1){
            $amount = bcadd($res['data']['amount_total']??0, $upstream['profit_percent'],2);
        }else{
            $amount = bcmul($res['data']['amount_total']??0, (1+$upstream['profit_percent']),2);
        }
        $amount = $amount>0?$amount:bcsub(0,0,2);

        // 自定义升降级产品订单逻辑
        $OrderModel = new OrderModel();
        $result = $OrderModel->createUpgradeOrder([
            'host_id' => $param['id'],
            'client_id' => get_client_id(),
            'upgrade_refund' => 0, # 不支持退款
            'product' => [
                'product_id' => $upstream['product_id'],
                'price' =>  $amount,
                'config_options' => [
                    'new_pid' => $upstreamProductId,//上游商品
                    'cycle' => $res['data']['billingcycle']??"",
                    'configoption' => [] //使用默认配置
                ]
            ]
        ]);

        return json($result);
    }
}