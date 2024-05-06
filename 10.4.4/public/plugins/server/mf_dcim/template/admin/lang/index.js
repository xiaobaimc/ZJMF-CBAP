(function () {
  /* 宝塔 */
  const module_lang = {
    "zh-cn": {
      add: "添加",
      add_cycle: "添加周期",
      advance_config: "高级配置",
      advanced_bw: "智能带宽配置规则",
      allow: "允许",
      allow_back_num: "允许备份的数量",
      allow_optional: "允许选配",
      apply_discount: "是否应用等级优惠",
      area: "区域",
      auth_num: "数量",
      autofill: "自动填充",
      back: "返回",
      billing_cycle: "计费周期",
      billing_way: "计费方式",
      box_label23: "配置名称",
      box_title46: "型号",
      bw: "带宽",
      bw_limit: "带宽限制",
      bw_line: "带宽线路",
      bw_price_config: "线路价格配置",
      cancel: "取消",
      capacity: "容量",
      city: "城市",
      classific_manage: "分类管理",
      cloud_flow: "流量",
      config: "配置",
      config_name: "配置名称",
      cores: "核",
      country: "国家",
      cycle: "周期",
      cycle_name: "周期名称",
      cycle_price: "周期价格",
      cycle_ratio: "周期比例",
      cycle_time: "周期时长",
      data_center: "数据中心",
      data_center_config: "数据中心配置",
      data_cpu_limit: "数据中心与型号限制",
      data_disk: "数据盘",
      day: "天",
      defence: "防御峰值",
      delete: "删除",
      delete_tip: "注意：周期删除后，所有配置项的周期也将删除",
      description: "描述",
      disk: "硬盘",
      edit: "编辑",
      factor: "系数",
      fixed_model: "机型配置",
      flexible_model: "灵活机型",
      get_system: "拉取操作系统",
      group: "分组",
      hardware_config: "增值设置",
      hold: "保存",
      host_prefix: "主机名前缀",
      hour: "小时",
      in: "进",
      in_bw: "进站带宽",
      in_out: "进+出",
      index_text8: "序号",
      inflow_bw: "流入带宽",
      input: "请输入",
      install_text4: "配置信息",
      invoice_btn6: "新增",
      is_need_code1: "重置密码时需要短信验证",
      is_need_code2: "重装系统时需要短信验证",
      last_30days: "购买日循环",
      limit: "限制",
      line: "线路",
      line_name: "线路名称",
      login_no: "否",
      manage: "管理",
      manual_resources: "手动资源",
      max_number: "最大数量",
      max_size: "最高容量",
      max_slot: "最大槽位",
      max_value: "最大值",
      memory: "内存",
      memory_config: "内存配置",
      memory_slot: "内存槽位",
      memory_slot_num: "内存所占槽位数量",
      mf_bw: "带宽计费",
      mf_charge: "是否收费",
      mf_cpu: "处理器",
      mf_cpu_param: "处理器参数",
      mf_duration: "周期设置",
      mf_enable: "是否可用",
      mf_example: "例如",
      mf_flow: "流量计费",
      mf_gpu: "显卡",
      mf_icon: "系统图标",
      mf_limit: "配置限制",
      mf_notes: "注意：",
      mf_p10:
        "用户增加带宽从配置的带宽起开始计费（推荐配置30M，用户升级到100M，收取70M费用）",
      mf_p11: "推荐配置和可选配置的内存以及硬盘合计不可超过设定的最大值",
      mf_p13: "开启视为应用",
      mf_p14: "选配机器是否自动开通",
      mf_p15: "若开启，用户订购选配硬件的机器也会自动开通",
      mf_p16: "此处价格不包含选配，选配内容价格按照增值设置中硬件价格计算",
      mf_p17: "选配的内存以及硬盘合计不可超过设定的最大值",
      mf_p18: "增值选配",
      mf_p19: "允许增值选配",
      mf_p2: "例: 64核心128线程(2. 7GHz)",
      mf_p20: "开启后，用户可在前台进行增值选配",
      mf_p21: "不填写或填写0视为不可选配",
      mf_p22: "请输入或者下拉选择",
      mf_p23: "可增加条目数",
      mf_p24: "可选配参数",
      mf_p25: "可增加盘位数",
      mf_p26: "剩余容量",
      mf_p27: "启用增值选配时，需先至“增值设置”设置相应选配参数",
      mf_p28: "可增加显卡数量",
      mf_p29: "可增加显卡数",
      mf_p30: "开启后，用户只可在升降级处选配增值项",
      mf_p5: "开启后商品将不会通过接口开通商品，需要管理员手动分配资源",
      mf_p6: "请在此添加允许客户变更配置的机型规格",
      mf_p7: "不填写或填写0视为不限",
      mf_p8: "此处价格为推荐配置价格，包含带宽及 IP",
      mf_p9: "选配内容价格按照增值设置中硬件价格计算",
      mf_radio: "单选",
      mf_ratio: "比例",
      mf_ratio_tip1: "请按照业务场景设置周期比例",
      mf_ratio_tip2:
        "例如：周期「月」设为 1 ，周期「年」设为 10。则商品配置项中所有周期「月」的价格与「年」的价格比例为 1:10",
      mf_ratio_tip3: "在配置中填写某一周期价格后，其他周期价格自动按比例填充",
      mf_ratio_tip4:
        "用户续费时，若变更续费周期，新周期的价格将按照周期比例自动换算",
      mf_recommend: "推荐配置",
      mf_rule1: "数量平均",
      mf_rule2: "负载最低",
      mf_rule3: "内存最低",
      mf_step: "阶梯计费",
      mf_tip: "正在拉取新的操作系统",
      mf_tip12: "请在左侧选择需要编辑的配置或新增配置",
      mf_tip16: "CPU与内存限制",
      mf_tip17: "数据中心与计算限制",
      mf_tip18: "带宽与计算限制",
      mf_tip19:
        "创建的配置禁止购买，下拉数据来源已配置的数据。范围输入不受已配置数据限制，包含在内的配置均被限制。请确保限制后仍存在可选配置。",
      mf_tip2: "主机名长度（包含前缀），范围6-25位",
      mf_tip21: "流量输入0视为无限流量",
      mf_tip25: "请在此添加允许客户选择的机型规格",
      mf_tip26: "单Mbps价格",
      mf_tip28: "自然月：每月的最后一天清空流量",
      mf_tip29:
        "购买日循环：假如1月29日购买，以后每月的29日清空流量，2月没有对应日期，则顺延到3月1日清空流量，然后4月1日再清空",
      mf_tip30:
        "请注意，后续在配置周期价格时，所有周期均需填写价格，若不填写价格视为0",
      mf_tip31: "可直接输入NC，视为NO_CHANGE",
      mf_tip32:
        "可按 数量_分组id 分组输入，示例：2_2,2_1。每组用逗号隔开，公网IP数量等于多组数量之和",
      mf_tip39:
        "价格系数用于对所有配置的该周期价格同时进行折扣（包括周期价格）",
      mf_tip40: "订购是否显示",
      mf_tip41: "输入NC后，可输入用于前台显示的IP数量",
      mf_tip42: "输入NC后，可输入用于前台显示的带宽",
      mf_tip43: " 前台显示的IP数量",
      mf_tip44: " 前台显示的带宽",

      mf_tip6: "1、带宽存在多种配置方式，无法将存在数据的配置方式切换到其他",
      mf_tip7:
        "2、阶段计费计价规则：总价=每个区间价单价*区间数量相加，若区间之间存在断层，断层数量不会参与计算",
      mf_tip8: "3、总量计费计价规则：总价=当前区间价*数量",
      mf_tip9: "单G价格",
      mf_total: "总量计费",
      mf_way: "方式",
      min_cycle_price: "最小周期价格",
      min_step: "最小变化值",
      min_value: "最小值",
      model_config: "型号配置",
      model_name: "型号名称",
      model_specs: "机型规格",
      money: "金额",
      natural_month: "自然月",
      net_type: "网络类型",
      new_create: "新建",
      news_classific: "分类",
      nickname: "名称",
      no_optional: "不可选配",
      node: "节点",
      node_group: "节点分组",
      one: "个",
      operation: "操作",
      opt_system: "操作系统",
      optional_content: "选配内容",
      optional_disk: "可选配硬盘",
      optional_memory: "可选配内存",
      order_index: "序号",
      order_new: "新增",
      order_optional: "订购选配",
      order_text36: "提示",
      order_text53: "新增",
      order_text68: "序号",
      order_text86: "价格",
      other_setting: "其他设置",
      out: "出",
      out_bw: "出站带宽",
      price: "价格",
      price_config: "价格设置",
      price_factor: "价格系数",
      product: "商品",
      protect_price_config: "防护价格配置",
      public_ip_config: "公网IP价格配置",
      random_ssh: "随机SSH端口",
      rise: "起",
      sale_group: "销售分组",
      search: "搜索",
      select: "请选择",
      server_model: "服务器型号",
      sort: "排序",
      support_multili_mark: "支持多语言字段",
      sure: "确定",
      sure_del_cycle: "确认删除周期？",
      sureDelete: "确认删除？",
      system: "系统",
      system_classify: "系统分类",
      system_disk_size: "系统盘",
      system_name: "系统名称",
      traffic_billing: "流量计费",
      traffic_type: "计费方向",
      upAndDown: "升降级",
      update: "修改",
      verify12: "请输入大于等于0的金额，最多2位小数",
      verify16: "正整数",
      verify18: "之间的整数",
      verify2: "之间的数,最多两位小数",
      verify7: "请输入大于或等于0的整数",
      verify8: "字符长度区间为",
    },
    "zh-hk": {
      add: "添加",
      add_cycle: "添加周期",
      advance_config: "高級配置",
      advanced_bw: "智能帶寬配置規則",
      allow: "允許",
      allow_back_num: "允許備份的數量",
      allow_optional: "允許選配",
      apply_discount: "是否應用等級優惠",
      area: "區域",
      auth_num: "數量",
      autofill: "自動填充",
      back: "返回",
      billing_cycle: "計費周期",
      billing_way: "計費方式",
      box_label23: "配置名稱",
      box_title46: "型號",
      bw: "帶寬",
      bw_limit: "帶寬限制",
      bw_line: "帶寬線路",
      bw_price_config: "線路價格配置",
      cancel: "取消",
      capacity: "容量",
      city: "城市",
      classific_manage: "分類管理",
      cloud_flow: "流量",
      config: "配置",
      config_name: "配置名稱",
      cores: "核",
      country: "國家",
      cycle: "周期",
      cycle_name: "周期名稱",
      cycle_price: "周期價格",
      cycle_ratio: "周期比例",
      cycle_time: "周期時長",
      data_center: "數據中心",
      data_center_config: "數據中心配置",
      data_cpu_limit: "數據中心與型號限制",
      data_disk: "數據盤",
      day: "天",
      defence: "防禦峰值",
      delete: "刪除",
      delete_tip: "註意：周期刪除後，所有配置項的周期也將刪除",
      description: "描述",
      disk: "硬盤",
      edit: "編輯",
      factor: "系數",
      fixed_model: "機型配置",
      flexible_model: "靈活機型",
      get_system: "拉取操作系統",
      group: "分組",
      hardware_config: "增值設置",
      hold: "保存",
      host_prefix: "主機名前綴",
      hour: "小時",
      in: "進",
      in_bw: "進站帶寬",
      in_out: "進+出",
      index_text8: "序號",
      inflow_bw: "流入帶寬",
      input: "請輸入",
      install_text4: "配置信息",
      invoice_btn6: "新增",
      is_need_code1: "重置密碼時需要短信驗證",
      is_need_code2: "重裝系統時需要短信驗證",
      last_30days: "購買日循環",
      limit: "限制",
      line: "線路",
      line_name: "線路名稱",
      login_no: "否",
      manage: "管理",
      manual_resources: "手動資源",
      max_number: "最大數量",
      max_size: "最高容量",
      max_slot: "最大槽位",
      max_value: "最大值",
      memory: "內存",
      memory_config: "內存配置",
      memory_slot: "內存槽位",
      memory_slot_num: "內存所占槽位數量",
      mf_bw: "帶寬計費",
      mf_charge: "是否收費",
      mf_cpu: "處理器",
      mf_cpu_param: "處理器參數",
      mf_duration: "周期設置",
      mf_enable: "是否可用",
      mf_example: "例如",
      mf_flow: "流量計費",
      mf_gpu: "顯卡",
      mf_icon: "系統圖標",
      mf_limit: "配置限制",
      mf_notes: "註意：",
      mf_p10:
        "用戶增加帶寬從配置的帶寬起開始計費（推薦配置30M，用戶升級到100M，收取70M費用）",
      mf_p11: "推薦配置和可選配置的內存以及硬盤合計不可超過設定的最大值",
      mf_p13: "開啟視為應用",
      mf_p14: "選配機器是否自動開通",
      mf_p15: "若開啟，用戶訂購選配硬件的機器也會自動開通",
      mf_p16: "此處價格不包含選配，選配內容價格按照增值設置中硬件價格計算",
      mf_p17: "選配的內存以及硬盤合計不可超過設定的最大值",
      mf_p18: "增值選配",
      mf_p19: "允許增值選配",
      mf_p2: "例: 64核心128線程(2. 7GHz)",
      mf_p20: "開啟後，用戶可在前臺進行增值選配",
      mf_p21: "不填寫或填寫0視為不可選配",
      mf_p22: "請輸入或者下拉選擇",
      mf_p23: "可增加條目數",
      mf_p24: "可選配參數",
      mf_p25: "可增加盤位數",
      mf_p26: "剩余容量",
      mf_p27: "啟用增值選配時，需先至“增值設置”設置相應選配參數",
      mf_p28: "可增加顯卡數量",
      mf_p29: "可增加顯卡數",
      mf_p30: "開啟後，用戶只可在升降級處選配增值項",
      mf_p5: "開啟後商品將不會通過接口開通商品，需要管理員手動分配資源",
      mf_p6: "請在此添加允許客戶變更配置的機型規格",
      mf_p7: "不填寫或填寫0視為不限",
      mf_p8: "此處價格為推薦配置價格，包含帶寬及 IP",
      mf_p9: "選配內容價格按照增值設置中硬件價格計算",
      mf_radio: "單選",
      mf_ratio: "比例",
      mf_ratio_tip1: "請按照業務場景設置周期比例",
      mf_ratio_tip2:
        "例如：周期「月」設為 1 ，周期「年」設為 10。則商品配置項中所有周期「月」的價格與「年」的價格比例為 1:10",
      mf_ratio_tip3: "在配置中填寫某壹周期價格後，其他周期價格自動按比例填充",
      mf_ratio_tip4:
        "用戶續費時，若變更續費周期，新周期的價格將按照周期比例自動換算",
      mf_recommend: "推薦配置",
      mf_rule1: "數量平均",
      mf_rule2: "負載最低",
      mf_rule3: "內存最低",
      mf_step: "階梯計費",
      mf_tip: "正在拉取新的操作系統",
      mf_tip12: "請在左側選擇需要編輯的配置或新增配置",
      mf_tip16: "CPU與內存限制",
      mf_tip17: "數據中心與計算限制",
      mf_tip18: "帶寬與計算限制",
      mf_tip19:
        "創建的配置禁止購買，下拉數據來源已配置的數據。範圍輸入不受已配置數據限制，包含在內的配置均被限制。請確保限制後仍存在可選配置。",
      mf_tip2: "主機名長度（包含前綴），範圍6-25位",
      mf_tip21: "流量輸入0視為無限流量",
      mf_tip25: "請在此添加允許客戶選擇的機型規格",
      mf_tip26: "單Mbps價格",
      mf_tip28: "自然月：每月的最後壹天清空流量",
      mf_tip29:
        "購買日循環：假如1月29日購買，以後每月的29日清空流量，2月沒有對應日期，則順延到3月1日清空流量，然後4月1日再清空",
      mf_tip30:
        "請註意，後續在配置周期價格時，所有周期均需填寫價格，若不填寫價格視為0",
      mf_tip31: "可直接輸入NC，視為NO_CHANGE",
      mf_tip32:
        "可按 數量_分組id 分組輸入，示例：2_2,2_1。每組用逗號隔開，公網IP數量等於多組數量之和",
      mf_tip39:
        "價格系數用於對所有配置的該周期價格同時進行折扣（包括周期價格）",
      mf_tip40: "訂購是否顯示",

      mf_tip41: "輸入NC後，可輸入用於前臺顯示的IP數量",
      mf_tip42: "輸入NC後，可輸入用於前臺顯示的頻寬",
      mf_tip43: " 前臺顯示的IP數量",
      mf_tip44: " 前臺顯示的頻寬",

      mf_tip6: "1、帶寬存在多種配置方式，無法將存在數據的配置方式切換到其他",
      mf_tip7:
        "2、階段計費計價規則：總價=每個區間價單價*區間數量相加，若區間之間存在斷層，斷層數量不會參與計算",
      mf_tip8: "3、總量計費計價規則：總價=當前區間價*數量",
      mf_tip9: "單G價格",
      mf_total: "總量計費",
      mf_way: "方式",
      min_cycle_price: "最小周期價格",
      min_step: "最小變化值",
      min_value: "最小值",
      model_config: "型號配置",
      model_name: "型號名稱",
      model_specs: "機型規格",
      money: "金額",
      natural_month: "自然月",
      net_type: "網絡類型",
      new_create: "新建",
      news_classific: "分類",
      nickname: "名稱",
      no_optional: "不可選配",
      node: "節點",
      node_group: "節點分組",
      one: "個",
      operation: "操作",
      opt_system: "操作系統",
      optional_content: "選配內容",
      optional_disk: "可選配硬盤",
      optional_memory: "可選配內存",
      order_index: "序號",
      order_new: "新增",
      order_optional: "訂購選配",
      order_text36: "提示",
      order_text53: "新增",
      order_text68: "序號",
      order_text86: "價格",
      other_setting: "其他設置",
      out: "出",
      out_bw: "出站帶寬",
      price: "價格",
      price_config: "價格設置",
      price_factor: "價格系數",
      product: "商品",
      protect_price_config: "防護價格配置",
      public_ip_config: "公網IP價格配置",
      random_ssh: "隨機SSH端口",
      rise: "起",
      sale_group: "銷售分組",
      search: "搜索",
      select: "請選擇",
      server_model: "服務器型號",
      sort: "排序",
      support_multili_mark: "支持多語言字段",
      sure: "確定",
      sure_del_cycle: "確認刪除周期？",
      sureDelete: "確認刪除？",
      system: "系統",
      system_classify: "系統分類",
      system_disk_size: "系統盤",
      system_name: "系統名稱",
      traffic_billing: "流量計費",
      traffic_type: "計費方向",
      upAndDown: "升降級",
      update: "修改",
      verify12: "請輸入大於等於0的金額，最多2位小數",
      verify16: "正整數",
      verify18: "之間的整數",
      verify2: "之間的數,最多兩位小數",
      verify7: "請輸入大於或等於0的整數",
      verify8: "字符長度區間為",
    },
    "en-us": {
      add: "Add",
      add_cycle: "Add cycle",
      advance_config: "Advanced configuration",
      advanced_bw: "Intelligent bandwidth configuration rules",
      allow: "Allow",
      allow_back_num: "Number of allowed backups",
      allow_optional: "Allow optional",
      apply_discount: "Whether to apply level discount",
      area: "area",
      auth_num: "Quantity",
      autofill: "Autofill",
      back: "Return",
      billing_cycle: "Billing cycle",
      billing_way: "Billing method",
      box_label23: "Configuration name",
      box_title46: "Model",
      bw: "Bw",
      bw_limit: "Bandwidth limit",
      bw_line: "Bandwidth line",
      bw_price_config: "Line price configuration",
      cancel: "Cancel",
      capacity: "capacity",
      city: "City",
      classific_manage: "Classification management",
      cloud_flow: "Traffic",
      config: "Configuration",
      config_name: "Configuration name",
      cores: "core",
      country: "Country",
      cycle: "Cycle",
      cycle_name: "Cycle name",
      cycle_price: "Cycle price",
      cycle_ratio: "Cycle ratio",
      cycle_time: "Cycle length",
      data_center: "Data center",
      data_center_config: "Data center configuration",
      data_cpu_limit: "Data center and model limits",
      data_disk: "Data disk",
      day: "Day",
      defence: "Defense Peak",
      delete: "Delete",
      delete_tip:
        "Note: After the cycle is deleted, the cycles of all configuration items will also be deleted",
      description: "Description",
      disk: "Hard disk",
      edit: "Edit",
      factor: "Coefficient",
      fixed_model: "Model configuration",
      flexible_model: "Flexible model",
      get_system: "Pull operating system",
      group: "Ggroup",
      hardware_config: "Value-added Settings",
      hold: "Save",
      host_prefix: "Host name prefix",
      hour: "Hour",
      in: "Enter",
      in_bw: "Inbound bandwidth",
      in_out: "In + out",
      index_text8: "Serial number",
      inflow_bw: "Inflow bandwidth",
      input: "Please enter ",
      install_text4: "Configuration information",
      invoice_btn6: "New ",
      is_need_code1: "SMS verification is required when resetting password",
      is_need_code2:
        "SMS verification is required when reinstalling the system",
      last_30days: "Purchase Day Cycle",
      limit: "Limit",
      line: "Line",
      line_name: "line name",
      login_no: "No",
      manage: "Management",
      manual_resources: "Manual resources",
      max_number: "Maximum number",
      max_size: "Maximum capacity",
      max_slot: "Maximum slot",
      max_value: "maximum value",
      memory: "Memory",
      memory_config: "Memory configuration",
      memory_slot: "Memory slot",
      memory_slot_num: "Number of slots occupied by memory",
      mf_bw: "Bandwidth Billing",
      mf_charge: "Whether to charge",
      mf_cpu: "Processor",
      mf_cpu_param: "Processor parameters",
      mf_duration: "Period setting",
      mf_enable: "Whether available",
      mf_example: "For example",
      mf_flow: "Flow billing",
      mf_gpu: "Graphics card",
      mf_icon: "System icon",
      mf_limit: "Configuration Limit",
      mf_notes: "Note:",
      mf_p10:
        "When users increase bandwidth, they will be billed starting from the configured bandwidth (30M is recommended, and if the user upgrades to 100M, a 70M fee will be charged)",
      mf_p11:
        "The total memory and hard disk of the recommended configuration and optional configuration must not exceed the set maximum value",
      mf_p13: "Open as application",
      mf_p14: "Whether the optional machine is automatically activated",
      mf_p15:
        "If enabled, the machine that the user orders optional hardware will also be automatically enabled",
      mf_p16:
        "The price here does not include options. The price of optional content is calculated based on the hardware price in the value-added setting",
      mf_p17:
        "The total number of optional memory and hard disk cannot exceed the set maximum value",
      mf_p18: "Value-added options",
      mf_p19: "Allow value-added options",
      mf_p2: "Example: 64 cores 128 threads (2. 7GHz)",
      mf_p20:
        "After turning it on, users can make value-added options at the front desk",
      mf_p21: "Not filling in or filling in 0 is considered not optional",
      mf_p22: "Please enter or drop down to select",
      mf_p23: "Can be added number",
      mf_p24: "Optional parameters",
      mf_p25: "Can increase the number of disks",
      mf_p26: "Remaining capacity",
      mf_p27:
        "When enabling value-added options, you need to first go to 'Value-Added Settings' to set the corresponding option parameters",
      mf_p28: "The number of graphics cards can be increased",
      mf_p29: "Can be added graphics number",
      mf_p30:
        "After turning it on, users can only select value-added items at upgrade and downgrade levels",
      mf_p5:
        "After opening, the product will not be activated through the interface, and the administrator needs to manually allocate resources",
      mf_p6:
        "Please add the model specifications that allow customers to change the configuration here",
      mf_p7: "Not filling in or filling in 0 is considered unlimited",
      mf_p8:
        "The price here is the recommended configuration price, including bandwidth and IP",
      mf_p9:
        "The price of optional content is calculated according to the price of the hardware in the value-added setting",
      mf_radio: "Single selection",
      mf_ratio: "Ratio",
      mf_ratio_tip1:
        "Please set the period ratio according to the business scenario",
      mf_ratio_tip2:
        "For example: the period 'month' is set to 1, and the period 'year' is set to 10. Then the ratio of the price of 'month' to the price of 'year' in all periods of the product configuration item is 1:10",
      mf_ratio_tip3:
        "After filling in the price of a certain period in the configuration, the prices of other periods are automatically filled in proportion",
      mf_ratio_tip4:
        "When the user renews, if the renewal period is changed, the price of the new period will be automatically converted according to the period ratio",
      mf_recommend: "Recommended configuration",
      mf_rule1: "Quantity average",
      mf_rule2: "Minimum load",
      mf_rule3: "Minimum memory",
      mf_step: "Step billing",
      mf_tip: "Pulling new operating system",
      mf_tip12:
        "Please select the configuration to be edited or add a new configuration on the left",
      mf_tip16: "CPU and memory limits",
      mf_tip17: "Data center and computing limitations",
      mf_tip18: "Bandwidth and Computing Limitations",
      mf_tip19:
        "The created configuration prohibits purchase, and the drop-down data source is the configured data. The range input is not restricted by the configured data, and the included configurations are restricted. Please ensure that there are still optional configurations after the restriction.",
      mf_tip2: "Host name length (including prefix), range 6-25 characters",
      mf_tip21: "Flow rate input 0 is considered unlimited traffic",
      mf_tip25:
        "Please add the model specifications that customers can choose here",
      mf_tip26: "Price per Mbps",
      mf_tip28: "Natural month: Clear traffic on the last day of each month",
      mf_tip29:
        "Purchase day cycle: If you purchase on January 29th, the traffic will be cleared on the 29th of each month. If there is no corresponding date in February, the traffic will be cleared on March 1st, and then cleared on April 1st.",
      mf_tip30:
        "Please note that when configuring the period price later, the price must be filled in for all periods. If the price is not filled in, it will be regarded as 0",
      mf_tip31: "NC can be input directly, regarded as NO_CHANGE",
      mf_tip32:
        "You can enter groups according to quantity_group id, example: 2_2, 2_1. Each group is separated by commas, and the number of public network IPs is equal to the sum of the numbers of multiple groups",
      mf_tip39:
        "The price coefficient is used to discount all configured period prices at the same time (including period prices)",
      mf_tip40: "Whether ordering is displayed",
      mf_tip41:
        "After input NC, you can enter the number of IPs used for front-end display.",
      mf_tip42:
        "After input NC, you can enter the bandwidth for front-end display.",

      mf_tip43: "The number of IPs displayed on the front end",
      mf_tip44: "Bandwidth displayed on the front end",
      mf_tip6:
        "1. There are multiple configuration methods for bandwidth, and the configuration method with existing data cannot be switched to another",
      mf_tip7:
        "2. Stage billing and pricing rules: total price = unit price of each interval * sum of interval quantities. If there are gaps between intervals, the number of gaps will not be included in the calculation.",
      mf_tip8:
        "3. Total billing and pricing rules: total price = current range price * quantity",
      mf_tip9: "Single G price",
      mf_total: "Total billing",
      mf_way: "way",
      min_cycle_price: "Minimum cycle price",
      min_step: "Minimum change value",
      min_value: "minimum value",
      model_config: "Model configuration",
      model_name: "Model name",
      model_specs: "Model specifications",
      money: "Amount",
      natural_month: "Natural month",
      net_type: "Network type",
      new_create: "New ",
      news_classific: "Classification",
      nickname: "name",
      no_optional: "Not optional",
      node: "Node",
      node_group: "Node group",
      one: "One",
      operation: "Operation",
      opt_system: "Operating system",
      optional_content: "Optional content",
      optional_disk: "Optional hard drive",
      optional_memory: "Optional memory",
      order_index: "Serial number",
      order_new: "New ",
      order_optional: "Order options",
      order_text36: "Prompt",
      order_text53: "New ",
      order_text68: "Serial number",
      order_text86: "Price",
      other_setting: "Other settings",
      out: "Out",
      out_bw: "Outbound bandwidth",
      price: "Price",
      price_config: "Price Settings",
      price_factor: "Price factor",
      product: "Goods",
      protect_price_config: "Protection price configuration",
      public_ip_config: "Public IP price configuration",
      random_ssh: "Random SSH port",
      rise: "rise",
      sale_group: "Sales Group",
      search: "Search",
      select: "Please select ",
      server_model: "Server model",
      sort: "Sort",
      support_multili_mark: "Support multi-language fields",
      sure: "Sure",
      sure_del_cycle: "Confirm deletion cycle?",
      sureDelete: "Confirm deletion?",
      system: "System",
      system_classify: "System classification",
      system_disk_size: "system disk",
      system_name: "system name",
      traffic_billing: "Traffic billing",
      traffic_type: "Billing direction",
      upAndDown: "Upgrade and downgrade",
      update: "Modify ",
      verify12:
        "Please enter an amount greater than or equal to 0, up to 2 decimal places",
      verify16: "positive integer",
      verify18: "integer between",
      verify2: "The number between, up to two decimal places",
      verify7: "Please enter an integer greater than or equal to 0",
      verify8: "The character length range is",
    },
  };
  const DEFAULT_LANG = localStorage.getItem("backLang") || "zh-cn";
  window.module_lang = module_lang[DEFAULT_LANG];
})();