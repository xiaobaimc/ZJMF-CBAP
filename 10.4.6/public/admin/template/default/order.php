{include file="header"}
<!-- =======内容区域======= -->
<link rel="stylesheet" href="/{$template_catalog}/template/{$themes}/css/client.css">
<div id="content" class="order" v-cloak>
  <com-config>
    <t-card class="list-card-container">
      <div class="common-header">
        <div class="left flex">
          <t-button @click="addOrder" class="add" v-permission="'auth_business_order_create_order'">{{lang.create_order}}</t-button>
          <!-- 批量删除 -->
          <t-button @click="batchDel" class="add" v-permission="'auth_business_order_batch_delete_order'">{{lang.batch_dele}}</t-button>
          <!-- 回收站 -->
          <t-button @click="openRecyle" class="add" v-if="recycleConfig.order_recycle_bin == '0' && $checkPermission('auth_business_order_enable_recycle_bin')">
            {{lang.open_recycle_bin}}
          </t-button>
          <t-button @click="goRecycle" class="add" v-if="recycleConfig.order_recycle_bin == '1' && $checkPermission('auth_business_order_recycle_bin_view')">
            {{lang.recycle_bin}}
          </t-button>
        </div>
        <!-- 右侧搜索 -->
        <div class="right-search">
          <template v-if="!isAdvance">
            <!-- <t-select v-model="params.status" :placeholder="lang.box_title3" clearable>
              <t-option v-for="item in orderStatus" :value="item.value" :label="item.label" :key="item.value">
              </t-option>
            </t-select> -->
            <t-select v-model="searchType" class="com-list-type" @change="changeType">
              <t-option v-for="item in typeOption" :value="item.value" :label="item.label" :key="item.value"></t-option>
            </t-select>
            <t-input v-model="params.keywords" class="search-input" :placeholder="lang.input" @keypress.enter.native="search" clearable
            v-show="searchType !== 'product_id'" @clear="clearKey('keywords')">
            </t-input>
            <com-tree-select class="search-input" v-show="searchType === 'product_id'" :value="params.product_id" @choosepro="choosePro"></com-tree-select>
            <!-- <t-input v-model="params.username" class="search-input" :placeholder="`${lang.input}${lang.username}`" @keypress.enter.native="search" clearable></t-input>-->
            <t-button @click="search" style="margin-right: 20px;">{{lang.query}}</t-button>
          </template>
          <t-button @click="changeAdvance">{{isAdvance ? lang.pack_up : lang.advanced_filter}}</t-button>
          <com-view-filed view="order" @changefield="changeField"></com-view-filed>
        </div>
      </div>
      <!-- 高级搜索 -->
      <div class="advanced" v-show="isAdvance">
        <div class="search">
          <t-select v-model="searchType" class="com-list-type" @change="changeType">
            <t-option v-for="item in typeOption" :value="item.value" :label="item.label" :key="item.value"></t-option>
          </t-select>
          <t-input v-model="params.keywords" class="search-input" :placeholder="lang.input"
          @keypress.enter.native="search" clearable v-show="searchType !== 'product_id'" @clear="clearKey('keywords')">
          </t-input>
          <com-tree-select class="search-input" v-show="searchType === 'product_id'" :value="params.product_id" @choosepro="choosePro"></com-tree-select>
          <t-input v-model="params.username" class="search-input" :placeholder="`${lang.input}${lang.username}`"
          @keypress.enter.native="search" clearable @clear="clearKey('username')">
          </t-input>
          <t-input :placeholder="lang.money" v-model="params.amount" @keypress.enter.native="search" clearable
          @clear="clearKey('amount')" style="width: 150px;"></t-input>
          <t-date-range-picker allow-input clearable v-model="range" :placeholder="[`${lang.order_date}`,`${lang.order_date}`]"></t-date-range-picker>
          <t-select v-model="params.type" :placeholder="lang.order_type" clearable>
            <t-option v-for="item in orderTypes" :value="item.value" :label="item.label" :key="item.value">
            </t-option>
          </t-select>
          <t-select v-model="params.status" :placeholder="lang.box_title3" clearable>
            <t-option v-for="item in orderStatus" :value="item.value" :label="item.label" :key="item.value">
            </t-option>
          </t-select>
          <t-select v-model="params.gateway" :placeholder="lang.pay_way" clearable>
            <t-option value="Credit" :label="lang.balance_pay" key="credit"></t-option>
            <t-option v-for="item in payWays" :value="item.name" :label="item.title" :key="item.name">
            </t-option>
          </t-select>
        </div>
        <t-button @click="search">{{lang.query}}</t-button>
      </div>
      <!-- 高级搜索 end -->
      <t-enhanced-table ref="table" row-key="id" drag-sort="row-handler" :data="calcList" :columns="columns" resizable :tree="{ childrenKey: 'list', treeNodeColumnIndex: 0 }" :loading="loading" :hover="hover" :tree-expand-and-fold-icon="treeExpandAndFoldIconRender" @sort-change="sortChange" class="user-order" :hide-sort-tips="true" @select-change="rehandleSelectChange" :selected-row-keys="checkId">
        <template slot="sortIcon">
          <t-icon name="caret-down-small"></t-icon>
        </template>
        <template #id="{row}">
          <span @click="lookDetail(row)" v-if="row.type && $checkPermission('auth_business_order_check_order')" class="aHover">
            {{row.id}}
          </span>
          <span v-if="row.type && !$checkPermission('auth_business_order_check_order')">{{row.id}}</span>
          <span v-if="!row.type" class="child">-</span>
        </template>
        <template #type="{row}">
          {{lang[row.type]}}
        </template>
        <template #username_company="{row}">
          <a :href="`client_detail.htm?client_id=${row.client_id}`" class="aHover">
            <span v-if="row.client_name">{{row.client_name}}</span>
            <span v-if="row.company">({{row.company}})</span>
          </a>
        </template>
        <template #order_time="{row}">
          {{row.type ? moment(row.create_time * 1000).format('YYYY-MM-DD HH:mm') : ''}}
        </template>
        <template #order_type="{row}">
          <template v-if="row.type">
            <!-- <t-tooltip :content="lang[row.type]" theme="light" :show-arrow="false" placement="top-right">
              <img :src="`${rootRul}img/icon/${row.type}.png`" alt="" style="position: relative; top: 3px;">
            </t-tooltip> -->
            <img :src="`${rootRul}img/icon/${row.type}.png`" alt="" style="position: relative; top: 3px;">
            {{lang[row.type]}}
          </template>
        </template>
        <template #order_use_credit="{row}">
          {{currency_prefix}}&nbsp;{{row.credit}}
        </template>
        <template #order_refund_amount="{row}">
          {{currency_prefix}}&nbsp;{{row.refund_amount}}
        </template>
        <template #reg_time="{row}">
          {{row.reg_time ? moment(row.reg_time * 1000).format('YYYY-MM-DD HH:mm') : ''}}
        </template>
        <template #client_id="{row}">
          <a :href="`client_detail.htm?client_id=${row.client_id}`" class="aHover" v-if="showDetails">{{row.client_id}}</a>
          <span v-else>{{row.client_id}}</span>
        </template>
        <template #product_name={row}>
          <template v-if="row.product_names">
            <template v-if="row.description && $checkPermission('auth_business_order_check_order')">
              <t-tooltip theme="light" :show-arrow="false" placement="top-right">
                <div slot="content" class="tool-content">{{row.description}}</div>
                <!--  <span @click="itemClick(row)" class="hover">{{row.product_names[0]}}</span> -->
                <span class="aHover" @click="lookDetail(row)" v-if="$checkPermission('auth_business_order_check_order')">{{row.product_names[0]}}</span>
                <span v-else>{{row.product_names[0]}}</span>
                <span v-if="row.product_names.length>1 && $checkPermission('auth_business_order_check_order')" @click="lookDetail(row)" class="hover">{{lang.wait}}{{row.product_names.length}}{{lang.products}}</span>
                <span v-if="row.product_names.length>1 && !$checkPermission('auth_business_order_check_order')">{{lang.wait}}{{row.product_names.length}}{{lang.products}}</span>
              </t-tooltip>
            </template>
            <template v-else>
              <!--  @click="itemClick(row)" -->
              <span class="aHover" @click="lookDetail(row)" v-if="$checkPermission('auth_business_order_check_order')">{{row.product_names[0]}}</span>
              <span v-else>{{row.product_names[0]}}</span>
              <span v-if="row.product_names.length>1 && $checkPermission('auth_business_order_check_order')" @click="lookDetail(row)" class="hover">{{lang.wait}}{{row.product_names.length}}{{lang.products}}</span>
              <span v-if="row.product_names.length>1 && !$checkPermission('auth_business_order_check_order')">{{lang.wait}}{{row.product_names.length}}{{lang.products}}</span>
            </template>
          </template>

          <span v-else class="child-name">
            <t-tooltip theme="light" :show-arrow="false" placement="top-right">
              <div slot="content" class="tool-content">{{row.description}}</div>
              <!-- <span @click="childItemClick(row)">{{row.product_name ? row.product_name : row.description}}
              <span class="host-name" v-if="row.host_name">({{row.host_name}})</span>
            </span> -->
              <a :href="row.host_id ? `host_detail.htm?client_id=${father_client_id}&id=${row.host_id}` : 'javascript:;'" class="aHover">{{row.product_name ? row.product_name : row.description}}
                <span class="host-name" v-if="row.host_name">({{row.host_name}})</span>
              </a>
            </t-tooltip>
          </span>
        </template>
        <template #order_amount="{row}">
          {{currency_prefix}}&nbsp;{{row.amount}}
          <!-- 升降机为退款时不显示周期 -->
          <span v-if="row.billing_cycle && Number(row.amount) >= 0 && row.type!=='upgrade'">/{{row.billing_cycle}}</span>
        </template>
        <template #order_status="{row}">
          <t-tag theme="default" variant="light" v-if="(row.status || row.host_status)==='Cancelled'" class="canceled order-canceled">{{lang.canceled}}
          </t-tag>
          <t-tag theme="default" variant="light" v-if="(row.status || row.host_status)==='Refunded'" class="canceled order-refunded">{{lang.refunded}}
          </t-tag>
          <t-tag theme="warning" variant="light" v-if="(row.status || row.host_status)==='Unpaid'" class="order-unpaid">{{lang.Unpaid}}
          </t-tag>
          <t-tag theme="primary" variant="light" v-if="row.status==='Paid'" class="order-paid">{{lang.Paid}}
          </t-tag>
          <t-tag theme="primary" variant="light" v-if="row.host_status === 'Pending'">
            {{lang.Pending}}
          </t-tag>
          <t-tag theme="success" variant="light" v-if="(row.status || row.host_status)==='Active'">{{lang.Active}}
          </t-tag>
          <t-tag theme="danger" variant="light" v-if="(row.status || row.host_status)==='Failed'">{{lang.Failed}}
          </t-tag>
          <t-tag theme="default" variant="light" v-if="(row.status || row.host_status)==='Suspended'">
            {{lang.Suspended}}
          </t-tag>
          <t-tag theme="default" variant="light" v-if="(row.status || row.host_status)==='Deleted'" class="delted">{{lang.Deleted}}
          </t-tag>
        </template>
        <template #gateway="{row}">
          <template v-if="row.status === 'Unpaid'">
            --
          </template>
          <template v-else>
            <!-- 其他支付方式 -->
            <template v-if="row.credit == 0">
              {{row.gateway}}
            </template>
            <!-- 混合支付 -->
            <template v-if="row.credit * 1 >0 && row.credit * 1 < row.amount * 1">
              <t-tooltip :content="currency_prefix+row.credit" theme="light" placement="bottom-right">
                <span class="theme-color">{{lang.balance_pay}}</span>
              </t-tooltip>
              <span>{{row.gateway ? '+ ' + row.gateway: '' }}</span>
            </template>
            <template v-if="row.amount*1 != 0 && row.credit==row.amount">
              <!-- <t-tooltip :content="currency_prefix+row.credit" theme="light" placement="bottom-right">
                <span>{{lang.credit}}</span>
              </t-tooltip> -->
              <span>{{lang.balance_pay}}</span>
            </template>
          </template>
        </template>
        <template #certification="{row}">
          <t-tooltip :show-arrow="false" theme="light">
            <span slot="content">{{!row.certification ? lang.real_tip8 : row.certification_type === 'person' ?
                      lang.real_tip9 : lang.real_tip10}}</span>
            <t-icon :class="row.certification ? 'green-icon' : ''" :name="!row.certification ? 'user-clear': row.certification_type === 'person' ? 'user' : 'usergroup'" />
          </t-tooltip>
        </template>
        <template #client_status="{row}">
          <t-tag theme="success" class="com-status" v-if="row.client_status" variant="light">{{lang.enable}}</t-tag>
          <t-tag theme="danger" class="com-status" v-else variant="light">{{lang.deactivate}}</t-tag>
        </template>
        <template #op="{row}">
          <template v-if="row.type">
            <t-tooltip :content="`${lang.look}${lang.detail}`" :show-arrow="false" theme="light">
              <t-icon name="view-module" class="common-look" @click="lookDetail(row)" v-permission="'auth_business_order_check_order'"></t-icon>
            </t-tooltip>
            <t-tooltip :content="lang.update_price" :show-arrow="false" theme="light">
              <t-icon name="money-circle" class="common-look" @click="updatePrice(row, 'order')" v-if="row.status!=='Paid' && row.status!=='Cancelled' && row.status!=='Refunded' && $checkPermission('auth_business_order_adjust_order_amount')"></t-icon>
            </t-tooltip>
            <!-- <t-tooltip :content="lang.sign_pay" :show-arrow="false" theme="light" v-show="row.status!=='Paid' && row.status!=='Cancelled' && row.status!=='Refunded'">
            <t-icon name="discount" class="common-look" :class="{disable:row.status==='Paid'}" @click="signPay(row)"></t-icon>
          </t-tooltip> -->
            <t-tooltip :content="lang.delete" :show-arrow="false" theme="light">
              <t-icon name="delete" class="common-look" @click="delteOrder(row)" v-permission="'auth_business_order_delete_order'"></t-icon>
            </t-tooltip>
          </template>
          <template v-else>
            <t-tooltip :content="lang.edit" :show-arrow="false" theme="light" v-if="row.edit && $checkPermission('auth_business_order_adjust_order_amount')">
              <t-icon name="edit" size="18px" @click="updatePrice(row, 'sub')" class="common-look"></t-icon>
            </t-tooltip>
          </template>
        </template>
      </t-enhanced-table>
      <t-pagination show-jumper v-if="total" :total="total" :page-size="params.limit" :current="params.page" :page-size-options="pageSizeOptions" :on-change="changePage"></t-pagination>
    </t-card>
    <!-- 标记支付 -->
    <t-dialog :header="lang.sign_pay" :visible.sync="payVisible" width="600" class="sign_pay">
      <template slot="body">
        <t-form :data="signForm">
          <t-form-item :label="lang.order_amount">
            <t-input :label="currency_prefix" v-model="signForm.amount" disabled />
          </t-form-item>
          <t-form-item :label="lang.balance_paid">
            <t-input :label="currency_prefix" v-model="signForm.credit" disabled />
          </t-form-item>
          <t-form-item :label="lang.no_paid">
            <t-input :label="currency_prefix" v-model="(signForm.amount * 1).toFixed(2)" disabled />
          </t-form-item>
          <t-checkbox v-model="use_credit" class="checkDelete">{{lang.use_credit}}</t-checkbox>
        </t-form>
      </template>
      <template slot="footer">
        <div class="common-dialog">
          <t-button @click="sureSign" :loading="submitLoading">{{lang.sure}}</t-button>
          <t-button theme="default" @click="payVisible=false">{{lang.cancel}}</t-button>
        </div>
      </template>
    </t-dialog>
    <!-- 调整价格 -->
    <t-dialog :header="lang.update_price" :visible.sync="priceModel" :footer="false">
      <t-form :data="formData" ref="update_price" @submit="onSubmit" :rules="rules" v-if="priceModel">
        <t-form-item :label="lang.change_money" name="amount">
          <t-input v-model="formData.amount" type="tel" :label="currency_prefix" :placeholder="lang.money"></t-input>
        </t-form-item>
        <t-form-item :label="lang.description" name="description">
          <textarea class="t-textarea__inner" :placeholder="lang.description" v-model.lazy="formData.description"></textarea>
        </t-form-item>
        <div class="com-f-btn">
          <t-button theme="primary" type="submit" :loading="submitLoading">{{lang.sure}}</t-button>
          <t-button theme="default" variant="base" @click="priceModel=false">{{lang.cancel}}</t-button>
        </div>
      </t-form>
    </t-dialog>
    <!-- 删除 -->
    <t-dialog :header="deleteTit" :visible.sync="delVisible" class="delDialog" width="600">
      <template slot="body">
        <p>
          <t-icon name="error-circle" size="18" style="color:var(--td-warning-color);"></t-icon>
          &nbsp;&nbsp;{{lang.sureDelete}}
        </p>
        <div class="check">
          <t-checkbox v-model="delete_host"></t-checkbox>
          <div class="tips">
            <p class="tit">{{lang.deleteOrderTip1}}<span class="com-red">{{lang.deleteOrderTip3}}</span></p>
            <p class="tip">({{lang.deleteOrderTip2}})</p>
          </div>
        </div>
      </template>
      <template slot="footer">
        <div class="common-dialog">
          <t-button @click="onConfirm" :loading="submitLoading">{{lang.sure}}</t-button>
          <t-button theme="default" @click="delVisible=false">{{lang.cancel}}</t-button>
        </div>
      </template>
    </t-dialog>
    <!-- 开启回收站 -->
    <t-dialog :header="lang.open_recycle_bin" :visible.sync="recycleVisble" :footer="false" class="recycle-dialog">
      <div class="con">
        <div class="icon success">
          <svg>
            <use :xlink:href="`${rootRul}img/icon/icons.svg#cus-recycle`">
            </use>
          </svg>
        </div>
        <div class="text">
          <p class="tit">{{lang.recycle_tip1}}</p>
          <p class="des">{{lang.recycle_tip2}}</p>
        </div>
      </div>
      <div class="com-f-btn">
        <t-button theme="primary" :loading="submitLoading" @click="handleRecyle">{{lang.sure}}</t-button>
        <t-button theme="default" variant="base" @click="recycleVisble=false">{{lang.cancel}}</t-button>
      </div>
    </t-dialog>
  </com-config>
</div>
<script src="/{$template_catalog}/template/{$themes}/components/comViewFiled/comViewFiled.js"></script>
<script src="/{$template_catalog}/template/{$themes}/components/comTreeSelect/comTreeSelect.js"></script>
<script src="/{$template_catalog}/template/{$themes}/api/client.js"></script>
<script src="/{$template_catalog}/template/{$themes}/js/order.js"></script>
{include file="footer"}
