<!-- 统计图表 -->
<!-- 页面独有样式 -->
<link rel="stylesheet" href="/plugins/server/mf_dcim/template/clientarea/css/cloudTop.css">
<link rel="stylesheet" href="/plugins/server/mf_dcim/template/clientarea/css/dcimDetail.css">

<div class="template" id="product_detail_cloud">
  <!-- 自己的东西 -->
  <div class="main-card">
    <div class="card-top">
      <div class="top-operation">
        <div class="operation-row1">
          <img @click="goBack" class="back-img" src="/plugins/server/mf_dcim/template/clientarea/img/finance/back.png" />
          <span class="top-product-name">{{hostData.product_name}}</span>
          <div class="host-status" :class="hostData.status">{{hostData.status_name}}</div>
          <span class="top-area">
            <img class="country-img" :src="'/upload/common/country/' + cloudData.data_center.iso +'.png'">
            <span class="country">{{cloudData.data_center.country_name}}</span>
            <span class="city">{{cloudData.data_center.city}}</span>
          </span>
        </div>
        <div class="operation-row2">
          <div class="row2-left">
            <span class="name">{{hostData.name}}</span>
            <span class="ip">{{cloudData.ip}}</span>
          </div>
          <div class="row2-right" v-show="hostData.status == 'Active'">
            <!-- 停用-->
            {foreach $addons as $addon}
            {if ($addon.name=='IdcsmartRefund')}
            <span class="refund">
              <span class="refund-status" v-if="refundData && refundData.status != 'Cancelled' && refundData.status != 'Reject'">{{refundStatus[refundData.status]}}</span>
              <span class="refund-stop-btn" v-if="refundData && (refundData.status=='Pending' || refundData.status=='Suspend' || refundData.status=='Suspending')" @click="quitRefund">{{lang.common_cloud_btn8}}</span>
              <span class="refund-btn" @click="showRefund" v-if="!refundData || (refundData && (refundData.status=='Reject')) || (refundData && (refundData.status=='Cancelled'))">{{lang.common_cloud_btn9}}</span>
            </span>
            {/if}
            {/foreach}

            <!-- 控制台 -->
            <!-- <img class="console-img" src="/plugins/server/mf_dcim/template/clientarea/img/cloudDetail/console.png" :title="lang.common_cloud_text8" @click="doGetVncUrl" v-show="status != 'operating'"> -->
            <!-- 开关机 -->
            <span class="on-off">
              <el-popover placement="bottom" v-model="onOffvisible" trigger="click">
                <div class="sure-remind">
                  <span class="text">{{lang.common_cloud_text9}}</span>
                  <span class="status">{{status == 'on'?lang.common_cloud_text11:lang.common_cloud_text10}} </span>
                  <span>?</span>
                  <!-- 关机确认 -->
                  <span class="sure-btn" v-if="status == 'on'" @click="doPowerOff">{{lang.common_cloud_btn10}}</span>
                  <!-- 开机确认 -->
                  <span class="sure-btn" v-else @click="doPowerOn">{{lang.common_cloud_btn10}}</span>
                </div>
                <img :src="'/plugins/server/mf_dcim/template/clientarea/img/cloudDetail/'+status+'.png'" :title="statusText" v-show="(status != 'operating') && (status != 'fault')" slot="reference">
              </el-popover>
              <i class="el-icon-loading" :title="lang.common_cloud_text12" v-show="status == 'operating'"></i>
              <img :src="'/plugins/server/mf_dcim/template/clientarea/img/cloudDetail/'+status+'.png'" :title="statusText" v-show="status == 'fault'">
            </span>
            <!-- 重启 -->
            <!-- <span class="restart">
              <el-popover placement="bottom" v-model="rebotVisibel" trigger="click">
                <div class="sure-remind">
                  <span class="text">{{lang.common_cloud_text9}}</span>
                  <span class="status">{{lang.common_cloud_text13}}</span>
                  <span>?</span>
                  <span class="sure-btn" @click="doReboot">{{lang.common_cloud_btn10}}</span>
                </div>
                <img src="/plugins/server/mf_dcim/template/clientarea/img/cloudDetail/restart.png" :title="lang.common_cloud_text13" v-show="status != 'operating'" slot="reference">
              </el-popover>
            </span> -->

            <!-- 救援模式 -->
            <img class="fault" src="/plugins/server/mf_dcim/template/clientarea/img/cloudDetail/fault.png" v-show="isRescue && status != 'operating'" :title="lang.common_cloud_text14">
          </div>
        </div>
        <div class="operation-row3" v-show="hostData.status == 'Active'">
          <!-- 有备注 -->
          <span class="yes-notes" v-if="hostData.notes" @click="doEditNotes">
            <i class="el-icon-edit notes-icon"></i>
            <span class="notes-text">{{hostData.notes}}</span>
          </span>
          <!-- 无备注 -->
          <span class="no-notes" v-else @click="doEditNotes">
            {{lang.cloud_add_notes + ' +'}}
          </span>

        </div>
      </div>
      {foreach $addons as $addon}
      {if ($addon.name=='IdcsmartRefund')}
      <div class="refund-msg">
        <!-- 停用成功 -->
        <div class="refund-success" v-if="refundData && refundData.status == 'Suspending'">
          ({{lang.common_cloud_tip6}}{{refundData.create_time | formateTime}}{{lang.common_cloud_tip7}} {{refundData.type=='Expire'?lang.common_cloud_tip8:lang.common_cloud_tip9}}，{{lang.common_cloud_tip13}}<span v-if="refundData.type=='Expire'">{{hostData.due_time | formateTime}}</span> {{refundData.type=='Expire'? lang.common_cloud_tip10:lang.common_cloud_tip11}} {{lang.common_cloud_tip12}})
        </div>
        <!-- 停用失败 -->
        <div class="refund-fail" v-if="refundData && refundData.status == 'Reject'">
          ({{lang.common_cloud_tip6}}{{refundData.create_time | formateTime}}{{lang.common_cloud_tip7}} {{refundData.type=='Expire'?lang.common_cloud_tip8:lang.common_cloud_tip9}} {{lang.common_cloud_tip14}}，
          <el-popover placement="top-start" trigger="hover">
            <span>{{refundData.reject_reason}}</span>
            <span class="reason-text" slot="reference">{{lang.common_cloud_text15}}</span>
          </el-popover>

          )
        </div>
      </div>
      {/if}
      {/foreach}
      <div class="top-msg">
        <!-- 实例信息 -->
        <div class="msg-l">
          <div class="l-t">
            <div class="l-t-l">
              <span class="l-t-l-text">配置信息</span>
            </div>
          </div>
          <div class="l-b">
            <div class="row">
              <div class="row-l">
                <div class="label">CPU:</div>
                <div class="value" :title="cloudData.model_config?.cpu">{{cloudData.model_config?.cpu}}</div>
              </div>
              <div class="row-m">
                <div class="label">防御峰值:</div>
                <div class="value">{{cloudData.peak_defence}}G</div>
              </div>
              <div class="row-r">
                <div class="label">用户名:</div>
                <div class="value" :title="rescueStatusData.username">{{rescueStatusData.username}}</div>
              </div>
            </div>
            <div class="row">
              <div class="row-l">
                <div class="label">内存:</div>
                <div class="value" :title="cloudData.model_config?.memory">{{cloudData.model_config?.memory}}</div>
              </div>
              <div class="row-m">
                <div class="label">操作系统:</div>
                <div class="value" :title="cloudData.image?.name">{{ cloudData.image?.name}}</div>
              </div>
              <div class="row-r">
                <div class="label">密码:</div>
                <div class="value">
                  <span v-show="isShowPass"> {{rescueStatusData.password}} </span>
                  <span v-show="!isShowPass"> {{passHidenCode}} </span>
                  <img class="eyes" :src="isShowPass?'/plugins/server/mf_dcim/template/clientarea/img/cloud/pass-show.png':'/plugins/server/mf_dcim/template/clientarea/img/cloud/pass-hide.png'" @click="isShowPass=!isShowPass" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="row-l">
                <div class="label">硬盘:</div>
                <div class="value">{{cloudData.model_config?.disk}}</div>
              </div>
              <div class="row-m" v-if="cloudData.line?.bill_type === 'flow'">
                <div class="label">流量:</div>
                <div class="value" v-if="cloudData.flow !==0">{{cloudData.flow}}G</div>
                <div class="value" v-else>无限流量</div>
              </div>
              <div class="row-m" v-else>
                <div class="label">带宽:</div>
                <div class="value">{{cloudData.bw}}Mbps</div>
              </div>
              <div class="row-r">
                <div class="label">端口:</div>
                <div class="value">{{rescueStatusData.port}}</div>
              </div>
            </div>
            <div class="row">
              <div class="row-l">
                <div class="label">IP数量:</div>
                <div class="value">{{rescueStatusData.ip_num}}个</div>
              </div>
            </div>
          </div>
        </div>
        <!-- 付款信息 -->
        <div class="msg-r">
          <div class="r-t">
            <div class="r-t-l">
              <span class="r-t-l-text">{{lang.cloud_pay_title}}</span>
            </div>
            <!-- 续费 -->
            {foreach $addons as $addon}
            {if ($addon.name=='IdcsmartRenew')}
            <div class="r-t-r" v-show="hostData.status == 'Active' || 'Suspended'">
              <span>{{lang.common_cloud_text16}}：</span>
              <el-switch v-model="isShowPayMsg" active-color="#0052D9" @change="autoRenewChange">
              </el-switch>
              <el-popover placement="top" trigger="hover">
                <div class="sure-remind">
                  {{lang.common_cloud_tip15}}
                </div>
                <div class="help" slot="reference">?</div>
              </el-popover>
            </div>
            {/if}
            {/foreach}
          </div>
          <div class="r-b">
            <div class="row">
              <div class="row-l">
                <div class="label">{{lang.cloud_due_time}}:</div>
                <div class="value" :class="isRead?'red':''">{{hostData.due_time | formateTime}}</div>
              </div>
              <div class="row-r">
                <div class="label">{{lang.cloud_creat_time}}:</div>
                <div class="value">{{hostData.active_time | formateTime}}</div>
              </div>
            </div>
            <div class="row">
              <div class="row-l">
                <div class="label">{{lang.cloud_pay_style}}:</div>
                <div class="value">{{hostData.billing_cycle_name + lang.common_cloud_text17}}</div>
              </div>
              <div class="row-r">
                <div class="label">{{lang.cloud_first_pay}}:</div>
                <div class="value">{{commonData.currency_prefix + hostData.first_payment_amount + commonData.currency_suffix}}</div>
              </div>
            </div>
            <div class="row">
              <div class="row-l">
                <div class="label">{{lang.cloud_re_text}}:</div>
                <div class="value">{{commonData.currency_prefix + hostData.renew_amount + commonData.currency_suffix}}</div>
                {foreach $addons as $addon}
                {if ($addon.name=='IdcsmartRenew')}
                <span v-show="hostData.status == 'Active'" v-loading="renewBtnLoading" class="renew-btn" @click="showRenew" v-if="!refundData || refundData || (refundData && refundData.status=='Cancelled') || (refundData && refundData.status=='Reject')">{{lang.cloud_re_btn}}</span>
                <span v-show="hostData.status == 'Active'" class="renew-btn-disable" v-else>{{lang.cloud_re_btn}}</span>
                {/if}
                {/foreach}
              </div>
              <div class="row-r">
                <div class="label">{{lang.cloud_code}}:</div>
                <div class="value" :title="codeString">{{codeString?codeString:'--'}}</div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <el-tabs class="tabs" v-model="activeName" @tab-click="handleClick" v-show="hostData.status == 'Active'">

        <!-- 统计图表 -->
        <el-tab-pane label="统计图表" name="1">
          <el-select class="time-select" v-model="chartSelectValue" @change="chartSelectChange">
            <el-option value='1' label="过去24H"></el-option>
            <el-option value='2' label="过去3天"></el-option>
            <el-option value='3' label="过去7天"></el-option>
          </el-select>

          <div class="echart-main">
            <!-- 网络带宽 -->
            <div id="bw-echart" class="my-echart" v-loading="echartLoading"></div>
          </div>
        </el-tab-pane>
        <el-tab-pane :label="lang.common_cloud_tab2" name="2">
          <div class="manage-content">
            <!-- 第一行 -->
            <el-row>
              <el-col :span="8">
                <div class="manage-item">
                  <div class="item-top-btn" @click="showPowerDialog('on')" v-loading="loading1">
                    开机
                  </div>
                  <div class="item-bottom">
                    <div class="bottom-row">对实例进行开机操作</div>
                  </div>
                </div>
              </el-col>
              <el-col :span="8">
                <div class="manage-item">
                  <div class="item-top-btn" @click="showPowerDialog('off')" v-loading="loading2">
                    关机
                  </div>
                  <div class="item-bottom">
                    <div class="bottom-row">对实例执行关机操作</div>
                  </div>
                </div>
              </el-col>
              <el-col :span="8">
                <div class="manage-item">
                  <div class="item-top-btn" @click="showPowerDialog('rebot')" v-loading="loading3">
                    重启
                  </div>
                  <div class="item-bottom">
                    <div class="bottom-row">对实例执行重启操作</div>
                  </div>
                </div>
              </el-col>
            </el-row>
            <!-- 第二行 -->
            <el-row>
              <el-col :span="8">
                <div class="manage-item">
                  <div class="item-top-btn" @click="getVncUrl" v-loading="loading4">
                    控制台
                  </div>
                  <div class="item-bottom">
                    <div class="bottom-row">通过实体显示器与鼠标键盘控制您的实例</div>
                    <div class="bottom-row">即使实例没有网络也能控制</div>
                  </div>
                </div>
              </el-col>
              <el-col :span="8">
                <div class="manage-item">
                  <div class="item-top-btn" @click="showRePass">
                    重置密码
                  </div>
                  <div class="item-bottom">
                    <div class="bottom-row">如您忘记密码或密码无法进入</div>
                    <div class="bottom-row">可强制修改您的实例的root/administrator密码</div>
                  </div>
                </div>
              </el-col>
              <el-col :span="8">
                <div class="manage-item">
                  <div class="item-top-btn" @click="showRescueDialog">
                    救援模式
                  </div>
                  <div class="item-bottom">
                    <div class="bottom-row">如实例系统损坏无法启动</div>
                    <div class="bottom-row">可进入临时救援系统进行修复或数据拷贝</div>
                  </div>
                </div>
              </el-col>
            </el-row>
            <!-- 第三行 -->
            <el-row>
              <el-col :span="8">
                <div class="manage-item">
                  <div class="item-top-btn" @click="showUpgrade">
                    {{lang.common_cloud_btn16}}
                  </div>
                  <div class="item-bottom">
                    <div class="bottom-row">{{lang.common_cloud_tip24}}</div>
                  </div>
                </div>
              </el-col>
            </el-row>
          </div>
        </el-tab-pane>
        <el-tab-pane :label="lang.common_cloud_tab4" name="4">
          <div class="net">
            <div class="title">
              <span>{{lang.common_cloud_title3}}</span>
            </div>
            <div class="main_table">
              <el-table v-loading="netLoading" :data="netDataList" style="width: 100%;margin-bottom: .2rem;">
                <el-table-column prop="ip" :label="lang.common_cloud_label21" min-width="200" align="left">
                </el-table-column>
                <el-table-column prop="gateway" width="400" :label="lang.common_cloud_label22" align="left">
                </el-table-column>
                <el-table-column prop="subnet_mask" width="400" :label="lang.common_cloud_label23" align="left">
                </el-table-column>
              </el-table>
              <pagination :page-data="netParams" @sizechange="netSizeChange" @currentchange="netCurrentChange">
              </pagination>
            </div>
            <div class="title">{{lang.common_cloud_title4}}</div>
            <div class="flow-content">
              <div class="flow-item">
                <div class="flow-label">{{lang.common_cloud_label24}}:</div>
                <div class="flow-value">{{flowData.total}}</div>
              </div>
              <div class="flow-item">
                <div class="flow-label">{{lang.common_cloud_label25}}:</div>
                <div class="flow-value">{{flowData.leave}}</div>
              </div>
              <div class="flow-item">
                <div class="flow-label">{{lang.common_cloud_label26}}:</div>
                <div class="flow-value">{{flowData.reset_flow_date}}</div>
              </div>
            </div>
            <el-select class="time-select" v-model="chartSelectValue" @change="chartSelectChange">
              <el-option value='1' :label="lang.common_cloud_label15"></el-option>
              <el-option value='2' :label="lang.common_cloud_label16"></el-option>
              <el-option value='3' :label="lang.common_cloud_label17"></el-option>
            </el-select>
            <div class="echart-main">
              <!-- 网络带宽 -->
              <div id="bw2-echart" class="my-echart" v-loading="echartLoading2"></div>
            </div>

          </div>
        </el-tab-pane>
        <el-tab-pane :label="lang.common_cloud_tab6" name="6">
          <div class="log">
            <div class="main_table">
              <el-table v-loading="logLoading" :data="logDataList" style="width: 100%;margin-bottom: .2rem;">
                <el-table-column prop="id" :label="lang.common_cloud_label32" width="400" align="left">
                </el-table-column>
                <el-table-column prop="create_time" width="400" :label="lang.common_cloud_label33" align="left">
                  <template slot-scope="scope">
                    <span>{{scope.row.create_time | formateTime}}</span>
                  </template>
                </el-table-column>
                <el-table-column prop="description" :label="lang.common_cloud_label34" min-width="400" align="left" :show-overflow-tooltip="true">
                </el-table-column>
              </el-table>
              <pagination :page-data="logParams" @sizechange="logSizeChange" @currentchange="logCurrentChange">
              </pagination>
            </div>
          </div>
        </el-tab-pane>
      </el-tabs>


      <!-- 修改备注弹窗 -->
      <div class="notes-dialog">
        <el-dialog width="6.2rem" :visible.sync="isShowNotesDialog" :show-close=false @close="notesDgClose">
          <div class="dialog-title">
            {{hostData.notes?lang.common_cloud_title7:lang.common_cloud_title8}}
          </div>
          <div class="dialog-main">
            <div class="label">{{lang.common_cloud_label29}}</div>
            <el-input class="notes-input" v-model="notesValue"></el-input>
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="subNotes">{{lang.common_cloud_btn28}}</div>
            <div class="btn-no" @click="notesDgClose">{{lang.common_cloud_btn29}}</div>
          </div>
        </el-dialog>
      </div>

      <!-- 重装系统弹窗 -->
      <div class="reinstall-dialog">
        <el-dialog width="6.2rem" :visible.sync="isShowReinstallDialog" :show-close=false @close="reinstallDgClose">
          <div class="dialog-title">
            {{lang.common_cloud_title9}}
          </div>
          <div class="dialog-main">
            <div class="label">{{lang.common_cloud_label6}}</div>
            <div class="os-content">
              <!-- 镜像组选择框 -->
              <el-select class="os-select os-group-select" v-model="reinstallData.osGroupId" @change="osSelectGroupChange">
                <img class="os-group-img" :src="osIcon" slot="prefix" alt="">
                <el-option v-for="item in osData" :key='item.id' :value="item.id" :label="item.name">
                  <div class="option-label">
                    <img class="option-img" :src="'/plugins/server/mf_dcim/view/img/' + item.name + '.png'" alt="">
                    <span class="option-text">{{item.name}}</span>
                  </div>
                </el-option>
              </el-select>
              <!-- 镜像实际选择框 -->
              <el-select class="os-select" v-model="reinstallData.osId" @change="osSelectChange">
                <el-option v-for="item in osSelectData" :key="item.id" :value="item.id" :label="item.name +'-' + commonData.currency_prefix + item.price"></el-option>
              </el-select>
            </div>
            <div class="label">{{lang.common_cloud_label7}}</div>
            <div class="pass-content">
              <el-select class="pass-select" v-model="reinstallData.type">
                <el-option value="pass" :label="lang.common_cloud_label7"></el-option>

              </el-select>
              <el-popover placement="top-start" width="200" trigger="hover" content="1、长度6位及以上 2、只能输入大写字母、小写字母、数字、~!@#$&* ()_ -+=| {}[];:<>?,./中的特殊符号3、不能以“/”开头4、必须包含小写字母a~z，大写字母A~Z,字母0-9">
                <i class="el-icon-question help-icon" slot="reference"></i>
              </el-popover>
              <el-input class="pass-input" v-model="reinstallData.password" placeholder="请输入内容" v-show="reinstallData.type=='pass'">
                <div class="pass-btn" slot="suffix" @click="autoPass">{{lang.common_cloud_btn1}}</div>
              </el-input>
              <div class="key-select" v-show="reinstallData.type=='key'">
                <el-select v-model="reinstallData.key">
                  <el-option v-for="item in sshKeyData" :key="item.id" :value="item.id"></el-option>
                </el-select>
              </div>
            </div>
            <div class="label">{{lang.common_cloud_label13}}</div>
            <el-input class="pass-input" v-model="reinstallData.port" placeholder="请输入内容">
              <div class="pass-btn" slot="suffix" @click="autoPort">{{lang.common_cloud_btn1}}</div>
            </el-input>

            <div class="pay-img" v-show="isPayImg">
              {{lang.common_cloud_tip28}},{{commonData.currency_prefix + payMoney + '/次'}}
              <el-popover placement="top-start" width="200" trigger="hover">
                <div class="show-config-list">等级折扣金额：{{commonData.currency_prefix}}{{ payDiscount }}</div>
                <div class="show-config-list">优惠码折扣金额：{{commonData.currency_prefix}}{{ payCodePrice }}</div>
                <i class="el-icon-warning-outline total-icon" slot="reference" v-if="isShowLevel || isShowPromo"></i>
              </el-popover>

              <span class="img-buy-btn" @click="payImg">{{lang.common_cloud_btn5}}</span>
            </div>

            <div class="alert">
              <el-alert :title="errText" type="error" show-icon :closable="false" v-show="errText">
              </el-alert>

              <div class="remind" v-show="!errText">{{lang.common_cloud_tip29}}</div>
            </div>
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="doReinstall">{{lang.common_cloud_btn28}}</div>
            <div class="btn-no" @click="reinstallDgClose">{{lang.common_cloud_btn29}}</div>
          </div>
        </el-dialog>
      </div>
      <!-- 加入安全组 -->
      <el-dialog width="6.8rem" :visible.sync="safeDialogShow" :show-close=false @close="safeClose" class="safe-dialog">
        <div class="dialog-title">加入安全组</div>
        <div class="dialog-main">
          <div class="safe-main-card">
            <div class="safe-box">
              <span>选择安全组：</span>
              <el-select v-model="safeID">
                <el-option v-for="item in safeOptions" :key="item.id" :label="item.name" :value="item.id">
                </el-option>
              </el-select>
            </div>
          </div>
        </div>
        <div class="dialog-footer">
          <div class="btn-ok" @click="subAddSafe">保存</div>
          <div class="btn-no" @click="safeClose">取消</div>
        </div>
      </el-dialog>
      <!-- 续费弹窗 -->
      <div class="renew-dialog">
        <el-dialog width="6.9rem" :visible.sync="isShowRenew" :show-close=false @close="renewDgClose">
          <div class="dialog-title">
            {{lang.common_cloud_title10}}
          </div>
          <div class="dialog-main">
            <div class="renew-content">
              <div class="renew-item" :class="renewActiveId==item.id?'renew-active':''" v-for="item in renewPageData" :key="item.id" @click="renewItemChange(item)">
                <div class="item-top">{{item.billing_cycle}}</div>
                <div class="item-bottom" v-if="isShowPromo && renewParams.isUseDiscountCode">{{commonData.currency_prefix + item.base_price}}</div>
                <div class="item-bottom" v-else>{{commonData.currency_prefix + item.price}}</div>
                <div class="item-origin-price" v-if="item.price != item.base_price && !renewParams.isUseDiscountCode">{{commonData.currency_prefix + item.base_price}}</div>
                <i class="el-icon-check check" v-show="renewActiveId==item.id"></i>
              </div>
            </div>
            <div class="pay-content">
              <div class="pay-price">
                <div class="money" v-loading="renewLoading">
                  <span class="text">{{lang.common_cloud_label11}}:</span> <span>{{commonData.currency_prefix}}{{renewParams.totalPrice | filterMoney}}</span>
                  <el-popover placement="top-start" width="200" trigger="hover" v-if="isShowLevel || (isShowPromo && renewParams.isUseDiscountCode) || isShowCash">
                    <div class="show-config-list">
                      <p v-if="isShowLevel">{{lang.shoppingCar_tip_text2}}：{{commonData.currency_prefix}} {{ renewParams.clDiscount | filterMoney}}</p>
                      <p v-if="isShowPromo && renewParams.isUseDiscountCode">{{lang.shoppingCar_tip_text4}}：{{commonData.currency_prefix}} {{ renewParams.code_discount | filterMoney }}</p>
                      <p v-if="isShowCash && renewParams.customfield.voucher_get_id">代金券抵扣金额：{{commonData.currency_prefix}} {{ renewParams.cash_discount | filterMoney}}</p>
                    </div>
                    <i class="el-icon-warning-outline total-icon" slot="reference"></i>
                  </el-popover>
                  <p class="original-price" v-if="renewParams.customfield.promo_code && renewParams.totalPrice != renewParams.base_price">{{commonData.currency_prefix}} {{ renewParams.base_price | filterMoney}}</p>
                  <p class="original-price" v-if="!renewParams.customfield.promo_code && renewParams.totalPrice != renewParams.original_price">{{commonData.currency_prefix}} {{ renewParams.original_price | filterMoney}}</p>
                  <div class="code-box">
                    <!-- 代金券 -->
                    <cash-coupon ref="cashRef" v-show="isShowCash && !cashObj.code" :currency_prefix="commonData.currency_prefix" @use-cash="reUseCash" scene='renew' :product_id="[product_id]" :price="renewParams.original_price"></cash-coupon>
                    <!-- 优惠码 -->
                    <discount-code v-show="isShowPromo && !renewParams.customfield.promo_code" @get-discount="getRenewDiscount(arguments)" scene='renew' :product_id="product_id" :amount="renewParams.base_price" :billing_cycle_time="renewParams.duration"></discount-code>
                  </div>
                  <div class="code-number-text">
                    <div class="discount-codeNumber" v-show="renewParams.customfield.promo_code">{{ renewParams.customfield.promo_code }}<i class="el-icon-circle-close remove-discountCode" @click="removeRenewDiscountCode()"></i></div>
                    <div class="cash-codeNumber" v-show="cashObj.code">{{ cashObj.code }}<i class="el-icon-circle-close remove-discountCode" @click="reRemoveCashCode()"></i></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="subRenew">{{lang.common_cloud_btn30}}</div>
            <div class="btn-no" @click="renewDgClose">{{lang.common_cloud_btn29}}</div>
          </div>
        </el-dialog>
      </div>
      <!-- 新增VPC网络 -->
      <el-dialog width="6.8rem" :visible.sync="isShowAddVpc" :show-close=false @close="addVpcClose" class="addVpc-dialog">
        <div class="dialog-title">新增VPC网络</div>
        <div class="dialog-main">
          <div class="vpc-main-card">
            <div class="vpc-item">
              <span class="vpc-leabel">网络名称：</span>
              <span class="vpc-value">{{vpcName}}</span>
            </div>
            <div class="vpc-item">
              <span class="vpc-leabel">内部网段：</span>
              <el-select v-model="plan_way" class="w-select">
                <el-option :value="0" :label="lang.auto_plan"></el-option>
                <el-option :value="1" :label="lang.custom"></el-option>
              </el-select>
            </div>
            <div class="vpc-item" v-if="plan_way === 1">
              <span class="vpc-leabel">IP网段：</span>
              <div class="vpc">
                <!-- 自定义vpc -->
                <div class="custom">
                  <el-select v-model="vpc_ips.vpc1.value" @change="changeVpcIp">
                    <el-option v-for="item in vpc_ips.vpc1.select" :key="item" :label="item" :value="item">
                    </el-option>
                  </el-select>
                  <span>·</span>
                  <el-tooltip :content="vpc_ips.vpc1.tips" placement="top" effect="light">
                    <el-input-number :disabled="vpc_ips.vpc1.value === 192" v-model="vpc_ips.vpc2" :step="1" :controls="false" :min="vpc_ips.min" :max="vpc_ips.max"></el-input-number>
                  </el-tooltip>
                  <span class="mr-5 ml-5">·</span>
                  <el-tooltip :content="vpc_ips.vpc3Tips" placement="top" effect="light" :disabled="!vpc_ips.vpc3Tips">
                    <el-input-number :disabled="vpc_ips.vpc6.value === 16" @blur="changeVpc3" v-model="vpc_ips.vpc3" :step="1" :controls="false" :min="0" :max="255">
                    </el-input-number>
                  </el-tooltip>
                  <span class="mr-5 ml-5">·</span>
                  <el-tooltip :content="vpc_ips.vpc4Tips" placement="top" effect="light" :disabled="!vpc_ips.vpc4Tips">
                    <el-input-number :disabled="vpc_ips.vpc6.value < 25" @blur="changeVpc4" v-model="vpc_ips.vpc4" :step="1" :controls="false" :min="0" :max="255">
                    </el-input-number>
                  </el-tooltip>
                  <span class="mr-5 ml-5">/</span>
                  <el-select v-model="vpc_ips.vpc6.value" style="width: 70px" @change="changeVpcMask">
                    <el-option v-for="item in vpc_ips.vpc6.select" :key="item" :label="item" :value="item">
                    </el-option>
                  </el-select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="dialog-footer">
          <div class="btn-ok" @click="subAddVpc">保存</div>
          <div class="btn-no" @click="addVpcClose">取消</div>
        </div>
      </el-dialog>
      <!-- 分配主机 -->
      <el-dialog width="6.8rem" :visible.sync="isShowengine" :show-close=false @close="engineClose" class="engine-dialog">
        <div class="dialog-title">分配主机</div>
        <div v-loading="isSubmitEngine">
          <div class="dialog-main">
            <div class="label">主机将从现有VPC网络移除并添加到下方选择的VPC网络</div>
            <div class="engine-main-card">
              <div class="engine-box">
                <span>主机标识：</span>
                <el-select v-model="engineID" clearable filterable remote reserve-keyword placeholder="请输入主机标识" :remote-method="remoteMethod" :loading="engineSearchLoading">
                  <el-option v-for="item in productOptions" :key="item.id" :label="item.name" :value="item.id">
                  </el-option>
                </el-select>
              </div>
            </div>
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="subAddEngine">保存</div>
            <div class="btn-no" @click="engineClose">取消</div>
          </div>
        </div>
      </el-dialog>
      <!-- 新增附加IP -->
      <el-dialog width="6.8rem" :visible.sync="isShowIp" :show-close=false @close="ipClose" class="ip-dialog">
        <div class="dialog-title">公网IP</div>
        <div class="dialog-main">
          <div class="label">当前IP数量 {{netDataList.length}} 个,请选择你总共所需的公网IP数量</div>
          <div class="ip-main-card">
            <div class="ip-item" :class="ipValue === item.value ? 'active' : ''" v-for="item in ipValueData" :key="item.value" @click="selectIpValue(item.value)">
              {{item.value}} 个
            </div>
          </div>
        </div>
        <div class="dialog-footer">
          <span class="text">所需费用:</span>
          <span class="num" v-loading="ipPriceLoading">
            {{commonData.currency_prefix}}{{ipMoney >=0 ? ipMoney : 0}}
            <el-popover placement="top-start" width="200" trigger="hover">
              <div class="show-config-list">等级折扣金额：{{commonData.currency_prefix}}{{ ipDiscountkDisPrice }}</div>
              <div class="show-config-list">优惠码折扣金额：{{commonData.currency_prefix}}{{ ipCodePrice }}</div>
              <i class="el-icon-warning-outline total-icon" slot="reference" v-if="isShowLevel || isShowPromo"></i>
            </el-popover>
          </span>
          <div class="btn-ok" @click="subAddIp">确认</div>
          <div class="btn-no" @click="ipClose">取消</div>
        </div>
      </el-dialog>
      <!-- 停用弹窗（删除实例） -->
      <div class="refund-dialog">
        <el-dialog width="6.8rem" :visible.sync="isShowRefund" :show-close=false @close="refundDgClose">
          <div class="dialog-title">
            {{refundPageData.allow_refund == 1?lang.common_cloud_title11:lang.common_cloud_title12}}
          </div>
          <div class="dialog-main">
            <div class="label">{{lang.common_cloud_label35}}</div>
            <div class="host-content">
              <div class="host-item">
                <div class="left">{{lang.common_cloud_label36}}:</div>
                <div class="right">
                  <div class="right-row">
                    <div class="right-row-item">{{cloudData.cpu}} 核CPU</div>
                    <div class="right-row-item">{{(cloudData.memory)+ 'GB 内存'}}</div>
                    <div class="right-row-item">{{cloudData.system_disk?.size}} GB 存储容量</div>
                    <div class="right-row-item">{{cloudData.bw}} M 宽带</div>
                  </div>
                </div>
              </div>
              <div class="host-item">
                <div class="left">{{lang.common_cloud_label37}}:</div>
                <div class="right">{{refundPageData.host.create_time | formateTime}}</div>
              </div>
              <div class="host-item" v-if="refundPageData.allow_refund == 1">
                <div class="left">{{lang.common_cloud_label38}}:</div>
                <div class="right">{{commonData.currency_prefix + refundPageData.host.first_payment_amount}}</div>
              </div>
            </div>
            <div class="label">{{lang.common_cloud_label39}}</div>
            <el-select v-if="refundPageData.reason_custom == 0" v-model="refundParams.suspend_reason" multiple>
              <el-option v-for="item in refundPageData.reasons" :key="item.id" :value="item.id" :label="item.content"></el-option>
            </el-select>
            <el-input v-else v-model="refundParams.suspend_reason"></el-input>
            <div class="label">{{lang.common_cloud_label40}}</div>
            <el-select v-model="refundParams.type">
              <el-option value="Expire" :label="lang.common_cloud_label41"></el-option>
              <el-option value="Immediate" :label="lang.common_cloud_label42"></el-option>
            </el-select>
            <div class="label" v-if="refundPageData.allow_refund == 1">{{lang.common_cloud_label43}}</div>
            <div class="amount-content" v-if="refundPageData.allow_refund == 1">{{commonData.currency_prefix}}{{refundParams.type=='Immediate'?refundPageData.host.amount:'0.00'}}</div>
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="subRefund">{{refundPageData.allow_refund == 1? lang.common_cloud_btn31: lang.common_cloud_btn32}}</div>
            <div class="btn-no" @click="refundDgClose">{{lang.common_cloud_btn29}}</div>
          </div>
        </el-dialog>
      </div>

      <!-- 重置密码弹窗 -->
      <div class="repass-dialog">
        <el-dialog width="6.8rem" :visible.sync="isShowRePass" :show-close=false @close="rePassDgClose">
          <div class="dialog-title">
            {{lang.common_cloud_title13}}
            <span class="second-title">{{lang.common_cloud_text23}}</span>
          </div>
          <div class="dialog-main">
            <div class="label">
              {{lang.common_cloud_label7}}
              <el-popover placement="top-start" width="200" trigger="hover" content="1、长度6位及以上 2、只能输入大写字母、小写字母、数字、~!@#$&* ()_ -+=| {}[];:<>?,./中的特殊符号3、不能以“/”开头4、必须包含小写字母a~z，大写字母A~Z,字母0-9">
                <i class="el-icon-question" slot="reference"></i>
              </el-popover>

            </div>
            <el-input class="pass-input" v-model="rePassData.password" placeholder="请输入内容">
              <div class="pass-btn" slot="suffix" @click="autoPass">{{lang.common_cloud_btn1}}</div>
            </el-input>

            <div class="alert" v-show="powerStatus=='off'">
              <div class="title">{{lang.common_cloud_tip30}}</div>
              <div class="row"><span class="dot"></span> {{lang.common_cloud_tip31}}</div>
              <div class="row"><span class="dot"></span> {{lang.common_cloud_tip32}}
              </div>
            </div>
            <el-checkbox v-model="rePassData.checked" v-show="powerStatus=='off'">{{lang.common_cloud_text24}}</el-checkbox>
            <div class="alert-err-text">
              <el-alert :title="errText" type="error" show-icon :closable="false" v-show="errText">
              </el-alert>
            </div>
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="rePassSub" v-loading="loading5">{{lang.common_cloud_btn28}}</div>
            <div class="btn-no" @click="rePassDgClose">{{lang.common_cloud_btn29}}</div>
          </div>
        </el-dialog>
      </div>

      <!-- 救援系统弹窗 -->
      <div class="rescue-dialog">
        <el-dialog width="6.8rem" :visible.sync="isShowRescue" :show-close=false @close="rescueDgClose">
          <div class="dialog-title">
            救援系统
            <span class="second-title">当您系统损坏时，可进入救援模式，您的系统盘将会挂载作为数据盘</span>
          </div>
          <div class="dialog-main">
            <div class="label">救援系统类型</div>
            <el-select class="os-select" v-model="rescueData.type">
              <img class="os-img" :src="'/plugins/server/mf_dcim/view/img/' + (rescueData.type==1?'Windows':'Linux') + '.png'" slot="prefix" alt="">
              <el-option value="1" label="Windows">
                <div class="os-item">
                  <img class="item-os-img" src="/plugins/server/mf_dcim/view/img/Windows.png" alt="">
                  <span class="item-os-text">Windows</span>
                </div>
              </el-option>
              <el-option value="2" label="Linux">
                <div class="os-item">
                  <img class="item-os-img" src="/plugins/server/mf_dcim/view/img/Linux.png" alt="">
                  <span class="item-os-text">Linux</span>
                </div>
              </el-option>
            </el-select>
            <div class="label">临时密码</div>
            <el-input class="pass-input" v-model="rescueData.password" placeholder="请输入内容">
              <div class="pass-btn" slot="suffix" @click="autoPass">随机生成</div>
            </el-input>
            <div class="alert">
              <el-alert :title="errText" type="error" show-icon :closable="false" v-show="errText">
              </el-alert>
              <div class="remind" v-show="!errText">请妥善保存当前密码，该密码不会二次使用</div>
            </div>
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="rescueSub" v-loading="loading3">提交</div>
            <div class="btn-no" @click="rescueDgClose">取消</div>
          </div>
        </el-dialog>
      </div>

      <!-- 确认退出救援模式弹窗 -->
      <div class="quitRescu">
        <el-dialog width="6.8rem" :visible.sync="isShowQuit" :show-close=false @close="quitDgClose">
          <div class="dialog-title">
            退出救援模式
          </div>
          <div class="dialog-main">
            您将退出救援模式请确认操作
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="reQuitSub">确认</div>
            <div class="btn-no" @click="quitDgClose">取消</div>
          </div>
        </el-dialog>
      </div>

      <!-- 升降级弹窗 -->
      <div class="upgrade-dialog">
        <el-dialog width="9.5rem" :visible.sync="isShowUpgrade" :show-close=false @close="upgradeDgClose">
          <div class="dialog-title">
            升降级
          </div>
          <div class="dialog-main">
            <el-form ref="orderForm" label-position="left" label-width="100px" hide-required-asterisk>
              <!-- IP数量 -->
              <el-form-item label="IP数量">
                <el-radio-group v-model="ipName" @input="changeIp">
                  <el-radio-button :label="c.value + '个'" v-for="(c,cInd) in calcIPList" :key="cInd">
                  </el-radio-button>
                </el-radio-group>
              </el-form-item>
              <!-- 带宽 -->
              <el-form-item :label="lang.mf_bw" v-if="lineDetail.bill_type === 'bw' && lineDetail.bw.length > 0">
                <!-- 单选 -->
                <el-radio-group v-model="bwName" v-if="lineDetail.bw[0].type === 'radio'" @input="changeBw">
                  <el-radio-button :label="c.value + 'M'" v-for="(c,cInd) in lineDetail.bw" :key="cInd">
                  </el-radio-button>
                </el-radio-group>
                <!-- 拖动框 -->
                <el-tooltip effect="light" v-else :content="lang.mf_range + bwTip" placement="top">
                  <el-slider v-model="params.bw" show-input :step="1" :min="lineDetail.bw[0].min_value" :max="lineDetail.bw[lineDetail.bw.length - 1].max_value" @change="changeBwNum">
                  </el-slider>
                </el-tooltip>
              </el-form-item>
              <el-form-item label=" " v-if="lineDetail.bw && lineDetail.bw[0].type !== 'radio'">
                <div class="marks">
                  <span class="item" v-for="(item,index) in Object.keys(bwMarks)">{{bwMarks[item]}}GB</span>
                </div>
              </el-form-item>
              <!-- 流量 -->
              <el-form-item :label="lang.mf_flow" v-if="lineDetail.bill_type === 'flow' && lineDetail.flow.length > 0">
                <el-radio-group v-model="flowName" @input="changeFlow">
                  <el-radio-button :label="c.value > 0 ? (c.value + 'G') : lang.mf_tip28" v-for="(c,cInd) in lineDetail.flow" :key="cInd">
                  </el-radio-button>
                </el-radio-group>
              </el-form-item>
              <!-- 防御 -->
              <el-form-item :label="lang.mf_defense" v-if="lineDetail.defence && lineDetail.defence.length >0">
                <el-radio-group v-model="defenseName" @input="changeDefence">
                  <el-radio-button :label="c.value + 'G'" v-for="(c,cInd) in lineDetail.defence" :key="cInd">
                  </el-radio-button>
                </el-radio-group>
              </el-form-item>
            </el-form>
          </div>

          <div class="dialog-footer">
            <div class="footer-top">
              <div class="money-text">切换所需费用：</div>
              <div class="money" v-loading="upgradePriceLoading">
                <span class="money-num">{{commonData.currency_prefix }} {{ upParams.totalPrice | filterMoney}}</span>
                <el-popover placement="top-start" width="200" trigger="hover" v-if="isShowLevel || (isShowPromo && upParams.isUseDiscountCode) || isShowCash">
                  <div class="show-config-list">
                    <p v-if="isShowLevel">{{lang.shoppingCar_tip_text2}}：{{commonData.currency_prefix}} {{ upParams.clDiscount | filterMoney }}</p>
                    <p v-if="isShowPromo && upParams.isUseDiscountCode">{{lang.shoppingCar_tip_text4}}：{{commonData.currency_prefix}} {{ upParams.code_discount | filterMoney}}</p>
                    <p v-if="isShowCash && upParams.customfield.voucher_get_id">代金券抵扣金额：{{commonData.currency_prefix}} {{ upParams.cash_discount | filterMoney}}</p>
                  </div>
                  <i class="el-icon-warning-outline total-icon" slot="reference"></i>
                </el-popover>
                <p class="original-price" v-if="upParams.totalPrice != upParams.original_price">{{commonData.currency_prefix}} {{ upParams.original_price | filterMoney}}</p>
                <div class="code-box">
                  <!-- 代金券 -->
                  <cash-coupon ref="cashRef" v-show="isShowCash && !cashObj.code" :currency_prefix="commonData.currency_prefix" @use-cash="upUseCash" scene='upgrade' :product_id="[product_id]" :price="upParams.original_price"></cash-coupon>
                  <!-- 优惠码 -->
                  <discount-code v-show="isShowPromo && !upParams.customfield.promo_code  " @get-discount="getUpDiscount(arguments)" scene='upgrade' :product_id="product_id" :amount="upParams.original_price" :billing_cycle_time="hostData.billing_cycle_time"></discount-code>
                </div>
                <div class="code-number-text">
                  <div class="discount-codeNumber" v-show="upParams.customfield.promo_code">{{ upParams.customfield.promo_code }}<i class="el-icon-circle-close remove-discountCode" @click="removeUpDiscountCode()"></i></div>
                  <div class="cash-codeNumber" v-show="cashObj.code">{{ cashObj.code }}<i class="el-icon-circle-close remove-discountCode" @click="upRemoveCashCode()"></i></div>
                </div>
              </div>
            </div>
            <div class="footer-bottom">
              <div class="btn-ok" @click="upgradeSub" v-loading="loading4">提交</div>
              <div class="btn-no" @click="upgradeDgClose">取消</div>
            </div>
          </div>
        </el-dialog>
      </div>





      <!-- 电源操作确认弹窗 -->
      <div class="power-dialog">
        <el-dialog width="6.2rem" :visible.sync="isShowPowerChange" :show-close=false @close="powerDgClose">
          <div class="dialog-title">
            请确认您将{{powerTitle}}以下实例
          </div>
          <div class="dialog-main">
            <div class="label">主机名</div>
            <div class="value">{{hostData.name}}</div>
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="toChangePower()">提交</div>
            <div class="btn-no" @click="powerDgClose">取消</div>
          </div>
        </el-dialog>
      </div>

      <!-- 自动续费确认弹窗 -->
      <div class="power-dialog">
        <el-dialog width="6.2rem" :visible.sync="isShowAutoRenew" :show-close=false :close-on-click-modal=false>
          <div class="dialog-title">
            请确认您将为以下实例{{isShowPayMsg?'开启':'关闭'}}自动续费
          </div>
          <div class="dialog-main">
            <div class="label">主机名</div>
            <div class="value">{{hostData.name}}</div>
          </div>
          <div class="dialog-footer">
            <div class="btn-ok" @click="doAutoRenew">提交</div>
            <div class="btn-no" @click="autoRenewDgClose">取消</div>
          </div>
        </el-dialog>
      </div>

      <pay-dialog ref="topPayDialog" @payok="paySuccess" @paycancel="payCancel"></pay-dialog>
    </div>
  </div>
</div>
<!-- =======页面独有======= -->
<script src="/plugins/server/mf_dcim/template/clientarea/api/common.js"></script>
<script src="/plugins/server/mf_dcim/template/clientarea/api/dcim.js"></script>
<script src="/plugins/server/mf_dcim/template/clientarea/utils/util.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
<script src="/plugins/server/mf_dcim/template/clientarea/js/dcimDetail.js"></script>